<?php
namespace app\modules\live\controllers;

use app\common\helpers\LogUtils;
use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\models\LiveRpcConfig;
use app\modules\live\services\OgService;
use Exception;
use Yii;
use yii\web\Controller;

/**
 * LoginController
 */
class LoginController extends Controller {
    private $_assetUrl = '';
    private $_req = null;
    private $_ag_srv = null;
    private $_ds_srv = null;
    
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();

        $live_hall_service = LiveServiceUtil::getAllLiveHallService();
        $this->_ag_srv = $live_hall_service['ag_srv'];
        $this->_ds_srv = $live_hall_service['ds_srv'];

        $this->_assetUrl = Yii::$app->getModule('live')->assetsUrl[1];
        $this->_req = Yii::$app->request;
        
        $this->getView()->title = '真人娱乐';
        $this->layout = false;
    }
    
    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex() {
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $type = $this->_req->get('type');
        $live_type = LiveUtil::getLiveTypeByType($type, false);
        
        switch ($type) {
            case 1 :
            case 2 : 
            case 3 : 
            case 5 : 
            case 6 : 
                return $this->_ag_loginHandler($uid, $live_type);
            case 4 : 
                return $this->_ds_loginHandler($uid, $live_type);
            case 7 :
                return $this->_og_loginHandler($uid, $live_type);
            default : 
                return '<script>alert("不支持的类型"); window.location="/";</script>';
        }
    }
    
    /**
     * 登录校验
     * @return boolean  true: 通过 false: 未通过
     */
    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        } else if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            echo '<script>alert("请先登录再进行操作"); window.location="/";</script>';
            return false;
        }
        
        return true;
    }

    private function _og_loginHandler($uid, $live_type) {
		$login_params = LiveUtil::getLoginParamsByLiveType($uid, $live_type);
        if (empty($login_params)) {
            return '用户名或密码不能为空';
        }
		
        try {
			$rpc_config = LiveRpcConfig::find()->one();
			$client = new OgService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['og_server_class'], $rpc_config['rpc_client_name']);
            $result = $client->login($login_params['cagent'], $login_params['actype'], $login_params['game_type'], $login_params['name'], $login_params['pwd'], $rpc_config['rpc_server_domain']);

            if(!$result['status']) {
                return $client->getMsg();
            }
            return $this->render('index', ['login_url' => $result['data']]);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return '请求失败';
        }
    }
    
    /* ============================ 华丽的分割线 =============================== */
    /**
     * AG登录处理方法
     * @param int $uid          用户id
     * @param string $live_type 厅标识
     * @return string
     */
    private function _ag_loginHandler($uid, $live_type) {
        $login_params = LiveUtil::getLoginParamsByLiveType($uid, $live_type);
        if (empty($login_params)) {
            return '用户名或密码不能为空';
        }
        $name = $login_params['name'];
        $pwd = $login_params['pwd'];
        $cagent = $login_params['cagent'];
        $actype = $login_params['actype'];
        $gametype = $login_params['game_type'];
        $result = $this->_ag_srv->login($cagent, $actype, $gametype, $name, $pwd);
        if(trim($result['status']) != 1) {
            return '请求失败或无权限访问';
        }
        return $this->render('index', ['login_url' => $result['data']]);
    }
    
    /**
     * DS登录处理方法
     * @param int $uid          用户id
     * @param string $live_type 厅标识
     * @return string
     */
    private function _ds_loginHandler($uid, $live_type) {
        $login_params = LiveUtil::getLoginParamsByLiveType($uid, $live_type);
        if (empty($login_params)) {
            return '用户名或密码不能为空';
        }
        $name = $login_params['name'];
        $pwd = $login_params['pwd'];
        $nickname = $login_params['nickname'];
        $line = $login_params['line'];
        $result = $this->_ds_srv->login($name, $pwd, $nickname, $line);

        if(trim($result['status']) != 1) {
            return '请求失败或无权限访问';
        }
        return $this->render('index', ['login_url' => $result['data']]);
    }
    
    
}
