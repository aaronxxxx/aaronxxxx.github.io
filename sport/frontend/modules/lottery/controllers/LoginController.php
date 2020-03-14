<?php
namespace app\modules\lottery\controllers;

use app\common\helpers\LogUtils;
use app\modules\lottery\models\GameType;
use app\modules\lottery\services\VrService;

use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\models\LiveRpcConfig;
use Exception;
use Yii;
use yii\web\Controller;

/**
 * LoginController
 */
class LoginController extends Controller {
    private $_assetUrl = '';
    private $_req = null;
    private $_vr_srv = null;
    private $_data = null;
    
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        //$live_hall_service = LiveServiceUtil::getAllLiveHallService();
        //$this->_vr_srv = $live_hall_service['vr_srv'];
        //$this->_assetUrl = Yii::$app->getModule('game')->assetsUrl[1];
		
		$this->_assetUrl = '';	//目前未設定
        $this->_req = Yii::$app->request;
        $this->getView()->title = 'VR彩票';
        $this->layout = false;
    }
    
    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex() {
		$uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
		$type = $this->_req->get('type');
		$channel = $this->_req->get('channel');
		$live_type = LiveUtil::getLiveTypeByType($type, false);

		if($this->_req->get('actype') !== null){
			$actype = $this->_req->get('actype');
		}else{
			$actype = 1;	//預設為正式頻道
		}

        $this->_data = ['uid' => $uid, 'assetUrl' => $this->_assetUrl];
		
		switch ($type) {
			case 10:	//VR彩票
                return $this->_vr_game_loginHandler($uid, $live_type, $channel, $actype);
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
			if($this->_req->get('actype') != 0){
				echo '<script>alert("请先登录再进行操作"); window.location="/";</script>';
				return false;
			}
        }
        
        return true;
    }
    
	/* ============================ 华丽的分割线 =============================== */
	/**
	* AG 电子游艺登录处理方法
	* @param int $uid              用户id
	* @param string $live_type     厅标识
	* @param string $channel_id  	頻道
	* @param string $actype      	0.試玩/1.正式
	* @return string
	*/
    private function _vr_game_loginHandler($uid, $live_type, $channel = '', $actype = 1) {
		$live_user_info = LiveUtil::getLoginParamsByLiveType($uid, $live_type);
		if (empty($live_user_info)) {
			return '用户名或密码不能为空';
		}
		$rpc_config = $live_user_info['rpc_config'];

		try {
			$client = new VrService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['vr_server_class'], $rpc_config['rpc_client_name']);
			$result = $client->login($live_user_info['cagent'], $live_user_info['actype'], $channel, $live_user_info['name'], $live_user_info['pwd'], $rpc_config['rpc_server_domain']);
			if(!$result['status']) {
				return $client->getMsg();
			}
			return $this->render('index', ['login_url' => $result['data']]);
		} catch (Exception $e) {
			LogUtils::error_log($e);
			return '请求失败';
		}
    }
}