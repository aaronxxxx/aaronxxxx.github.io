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
use app\modules\core\common\models\SysManageOnline;
use app\common\helpers\UAUtils;

/**Index controller*/
class BaseController extends Controller{

    const LOG_BEFORE_ACTION = 0;
    const LOG_AFTER_ACTION = 1;

	public function init(){//初始化函数
        parent::init();
        Yii::$app->params['purviews'] = [];
        $ssid = Yii::$app->getSession()->get('ssid');
        $ip = $this->GetIP();
        $loginbrowser = UAUtils::getClientBrowser();
        $user = SysManageOnline::find()->where([
            'session_str' => $ssid,
            'loginip'=>$ip,
            'loginbrowser'=>$loginbrowser
        ])->one();
        if(empty($user)){
            Yii::$app->user->logout(true);
            $this->goBack('?r=passport/login/login');
            return 'exit';
        }
        if(Yii::$app->user->isGuest) {
            $this->goBack('?r=passport/login/login');
        } else {
            Yii::$app->params['U_Purview'] = Yii::$app->session['purview'];
            Yii::$app->params['S_USER_ID'] = Yii::$app->session['S_USER_ID'];
            Yii::$app->params['purviews'] =  explode("|", Yii::$app->session['purview']);
        }
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
            'accessIp' => [
                'class' => AccessIpFilter::className()
            ]
        ];
    }
    public function GetIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "none";
        }
        return $cip;
    }

    public function beforeAction($action)
    {
        $this->doTraceEvent($action);
        $this->doAdminLogEvent(self::LOG_BEFORE_ACTION);
        return parent::beforeAction($action);
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
