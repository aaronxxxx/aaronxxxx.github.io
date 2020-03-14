<?php
namespace app\common\base;

use app\common\behaviors\AdminLogBehavior;
use app\common\behaviors\TraceBehavior;
use app\common\events\AdminLogEvent;
use app\common\filters\AccessIpFilter;
use app\common\filters\SpeedFilter;
use app\common\helpers\LogUtils;
use app\common\helpers\StringUtils;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\web\Controller;

/**Index controller*/
class BaseController extends Controller{

    const LOG_BEFORE_ACTION = 0;
    const LOG_AFTER_ACTION = 1;

	public function init(){//初始化函数
		parent::init();
		/*
        Yii::$app->params['purviews'] = [];
        if(Yii::$app->user->isGuest) {
            $this->goBack('?r=passport/login/login');
        } else {
            Yii::$app->params['U_Purview'] = Yii::$app->session['purview'];
            Yii::$app->params['S_USER_ID'] = Yii::$app->session['S_USER_ID'];
            Yii::$app->params['purviews'] =  explode("|", Yii::$app->session['purview']);
        }
		*/
	}

    public function behaviors()
    {
        return [
            'adminlog' => [
                'class' => AdminLogBehavior::className()
            ],
            'trace' => [
                'class' => TraceBehavior::className()
            ],
            'speed' => [
                'class' => SpeedFilter::className()
            ],
//            'accessIp' => [
//                'class' => AccessIpFilter::className()
//            ]
        ];
    }

    public function beforeAction($action)
    {
        $this->doTraceEvent($action);
        $this->doAdminLogEvent(self::LOG_BEFORE_ACTION);
        return parent::beforeAction($action);
    }

    /*
* 確認管理者登入ip與更新online_time
*/
    public function checkadminAndDoupdateonlinetime()
    {
        // 讀取session , 用用戶名過濾資料
        $session = Yii::$app->session;

        if(empty($session->get('ssid')) || empty($session->get('S_USER_NAME'))) {
            // Yii::$app->user->logout(true);
            $this->goBack('/agenththtml/login.html');
        }

        $rs_count = SysAgentOnline::find()->select('count(id) count')->where(array('manage_name'=>$session->get('S_USER_NAME')))->asArray()->one();
        //假設超過2個帳號登入,刪除較舊的紀錄
        if((int)$rs_count['count'] > 1 )
        {
            $SysManegeOnline = SysAgentOnline::find(array('manage_name'=>$session->get('S_USER_NAME')))->orderBy(['logintime'=>SORT_ASC])->one();
            $SysManegeOnline->delete();
        }
        //去除重複登入後,抓取本身帳號的資料
        $rs_online = SysAgentOnline::find()->select('*')->where(array('session_str'=>$session->get('ssid')))->asArray()->one();
        //假如帳號不存在,登出+轉至登入畫面
        //var_dump($rs_online);
        if(!$rs_online){
            // Yii::$app->user->logout(true);
            $this->goBack('/agenththtml/login.html');
            return false;
        }
        //比對ip 是否符合
        $client_ip = $this->_get_real_ip();
        //假如登入IP換過
        if($client_ip != $rs_online['loginip']){
            $SysManegeOnline = SysAgentOnline::findOne(array('session_str'=>$session->get('ssid'), 'manage_name'=>$session->get('S_USER_NAME')));
            if($SysManegeOnline){
                $SysManegeOnline->delete();
            }
            // Yii::$app->user->logout(true);
            $this->goBack('/agenththtml/login.html');
            return false;
        }
        //資料沒問題,刷新online_time
        $SysManegeOnline = SysAgentOnline::findOne(array('session_str'=>$session->get('ssid'), 'manage_name'=>$session->get('S_USER_NAME')));
        $SysManegeOnline->onlinetime = date('Y-m-d H:i:s');
        $SysManegeOnline->save();
        return true;
    }

    /**
     * 獲取會員真實的IP地址
     * @return bool
     */
    private function _get_real_ip(){
        $ip = false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                //if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $ips[$i])){
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        $ip = $ip ? $ip : $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    public function afterAction($action, $result)
    {
        $this->doAdminLogEvent(self::LOG_AFTER_ACTION);
        return parent::afterAction($action, $result);
    }

    public function getParam($name, $def = null) {
        if(Yii::$app->request->isGet) {
            return Yii::$app->request->get($name, $def);
        } else {
            return Yii::$app->request->post($name, $def);
        }
    }

	public function out($status, $msg = null) {
	    return Json::encode([
            'status' => $status,
            'msg' => $msg
        ]);
    }

    public function outCode($status, $msg, $code) {
        return Json::encode([
            'status' => $status,
            'msg' => $msg,
            'code' => $code
        ]);
    }

    public function outData($data) {
        return Json::encode([
            'status' => true,
            'data' => $data
        ]);
    }

    public function outPageData($data, $total) {
        return Json::encode([
            'status' => true,
            'data' => $data,
            'total' => $total
        ]);
    }

    protected function findModel(ActiveRecord $activeRecord, $id)
    {
        if (($model = $activeRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested model does not exist.');
        }
    }

    private function doAdminLogEvent($type) {
        try{
            $logActions = Yii::$app->params['logActions'];
            $logAction = null;
            if(isset($_REQUEST['r'])) {
                $r = $_REQUEST['r'];
                foreach ($logActions as $action) {
                    if($type == self::LOG_BEFORE_ACTION) {
                        if($action['action'] == $r && isset($action['trigger']) && $action['trigger'] == 'before') {
                            $logAction = $action;
                            break;
                        }
                    } else {
                        if($action['action'] == $r && (!isset($action['trigger']) || $action['trigger'] == 'after')) {
                            $logAction = $action;
                            break;
                        }
                    }
                }
                if($logAction != null) {
                    $params = [];
                    if(isset($logAction['params'])) {
                        for ($i=0;$i<count($logAction['params']);$i++) {
                            $params[$i] = $this->getParam($logAction['params'][$i]);
                        }
                    }
                    $log = StringUtils::format($logAction['log'], $params);
                    $this->trigger(AdminLogBehavior::EVENT_AFTER_ACTION_LOG, new AdminLogEvent([
                        'edlog' => $log,
                    ]));
                }
            }
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
        }
    }

    function doTraceEvent($action) {
        try{
            $this->trigger(TraceBehavior::EVENT_TRACE_ACTION);
        }catch (Exception $e) {
            Yii::error($e->getMessage());
        }
    }
}
