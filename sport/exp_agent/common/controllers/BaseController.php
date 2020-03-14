<?php
namespace app\common\controllers;

use app\common\behaviors\AdminLogBehavior;
use app\common\behaviors\TraceBehavior;
use app\common\events\AdminLogEvent;
use app\common\events\TraceEvent;
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

    public $layout = "/main2";

	public function init(){//初始化函数
		parent::init();
        if(!empty(Yii::$app->session['S_USER_ID'])){
            Yii::$app->params['U_Purview'] = Yii::$app->session['purview'];
            Yii::$app->params['S_USER_ID'] = Yii::$app->session['S_USER_ID'];
//            $this->render('/?r=index/index');
        }else{
            $this->redirect('/?r=login/login');
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
            ]
        ];
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

    public function getParam($name) {
        if(Yii::$app->request->isGet) {
            return Yii::$app->request->get($name);
        } else {
            return Yii::$app->request->post($name);
        }
    }

	public function out($status, $msg) {
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

   public function create_str($pw_length)
    {
        $randpwd = '';
        for ($i = 0; $i < $pw_length; $i++)
        {
            $randpwd .= chr(mt_rand(65, 90));
        }
        return $randpwd;
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
