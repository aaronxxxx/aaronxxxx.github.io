<?php
namespace app\modules\game\controllers;

use app\common\helpers\LogUtils;
use app\modules\game\models\GameType;
use app\modules\game\services\AiService;
use app\modules\game\services\IgService;
use app\modules\game\services\KgService;
use app\modules\game\services\PtService;
use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\models\LiveUser;
use app\modules\live\models\LiveRpcConfig;
use Exception;
use Yii;
use yii\web\Controller;

/**
 * LoginController
 */
class LoginController extends Controller
{
    private $_assetUrl = '';
    private $_req = null;
    private $_ag_srv = null;
    private $_ds_srv = null;
    private $_data = null;

    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();

        $live_hall_service = LiveServiceUtil::getAllLiveHallService();
        $this->_ag_srv = $live_hall_service['ag_srv'];
        $this->_ds_srv = $live_hall_service['ds_srv'];

        $this->_assetUrl = Yii::$app->getModule('game')->assetsUrl[1];
        $this->_req = Yii::$app->request;
        $this->getView()->title = '电子游艺';
        $this->layout = false;
    }

    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex() {
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $type = $this->_req->get('type');
        $game_hall_id = $this->_req->get('game_id');
        $flash_id = $this->_req->get('flash_id');
        $live_type = LiveUtil::getGameLiveTypeByType($type, false);
        $game = $this->_req->get('game');
		if($this->_req->get('actype') !== null){
			$actype = $this->_req->get('actype');
		}else{
			$actype = 1;	//預設為正式頻道
		}

        $this->_data = ['uid' => $uid, 'assetUrl' => $this->_assetUrl];
        if($type==1006){//MG游戏厅
		   if($game_hall_id){//如果原本就有大厅代号
			   $game_type=GameType::getGameType($game_hall_id);
               $game_hall_id=$game_type?:$game_hall_id;
		   }elseif($flash_id){//通过flash_id获取
			    //$game_type=GameType::getGameType($flash_id);
                //$game_hall_id=$game_type?:$game_hall_id;
                $game_hall_id=$flash_id;
		   }
        }

        switch ($type) {
            case 'AI' :
                return $this->_ai_game_loginHandler($uid, $game);
            case 1001 :
            case 1002 :
            case 1003 :
            case 1005 :
            case 1006 :
                return $this->_ag_game_loginHandler($uid, $live_type, $game_hall_id, $flash_id, $actype);
            case 'KG' :
                return $this->_kg_game_loginHandler($uid, $game);
            case 'IG' :
                return $this->_ig_game_loginHandler($uid, $game);
            case 'igBack' :
                return $this->igGameCallBack();
			case 1009:
				return $this->_pt_game_loginHandler($uid, $game);
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

    private function _ai_game_loginHandler($uid, $game)
    {
        $rpc_config = LiveRpcConfig::find()->one();
        $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'AI', $rpc_config);

        if (empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
            echo "
                <script>
                    alert('用户名或密码不能为空');
                    window.close();
                </script>";
            exit;
        }

        $agent = AiService::agentLogin();

        if (! $agent) {
            echo "
                <script>
                    alert('请求错误或无权限访问');
                    window.close();
                </script>";
            exit;
        }

        // 判斷AI那邊是否存在會員資料
        $player = null;

        if ($live_user_info['ai_userid']) {
            $player = AiService::queryMemberId($agent['token'], $live_user_info['name']);
        }

        if (! $player) {
            $player = AiService::register($agent, $live_user_info);

            // 會員創建失敗，可能帳號重複
            if (! $player) {
                echo "
                    <script>
                        alert('创建会员失败');
                        window.close();
                    </script>";
                exit;
            }

            // 當前時間_會員ID(年只有兩位) 當作單號，長度限制18字元
            $orderId = substr(date('Y'), -2) . date('mdHis') . '_' . $player;
            // 活動: 首次遊戲玩家贈送10000
            // $deposit = AiService::deposit($agent['token'], $player, 10000, $orderId);
        }

        // 會員登入 返回遊戲連結
        $url = AiService::userLogin($agent['token'], $player);

        if (! $url) {
            echo "
                <script>
                    alert('游戏启动失败');
                    window.close();
                </script>";
            exit;
        }

        header('location: ' . $url);
        die;
    }

    /**
     * AG 电子游艺登录处理方法
     * @param int $uid              用户id
     * @param string $live_type     厅标识
     * @param string $game_hall_id  游戏厅标识
     * @param string $flash_id      游戏标识
     * @return string
     */
    private function _ag_game_loginHandler($uid, $live_type, $game_hall_id = '', $flash_id = '', $actype = 1) {
		/*
		if($actype == 0){	//試玩
			$login_params = [
				'name' => 'vtest1',
				'pwd' => '',
				'cagent' => 'G05_AGIN',
				'game_type' => '8'	//AGIN
			];
		}else{
		*/

		$login_params = LiveUtil::getGameLoginParamsByLiveType($uid, $live_type, $actype);
		if (empty($login_params)) {
			return $this->render('index', ['login_url' => '']);
		}

        $name = $login_params['name'];
        $pwd = $login_params['pwd'];
        $cagent = $login_params['cagent'];
        $actype = $actype;
        $gametype = isset($game_hall_id) ? $game_hall_id : $login_params['game_type'];
        $result = $this->_ag_srv->login($cagent, $actype, $gametype, $name, $pwd, $flash_id);

        if(trim($result['status']) != 1) {
            return '请求错误或无权限访问';
        }
        return $this->render('index', ['login_url' => $result['data']]);
    }

    private function _kg_game_loginHandler($uid, $game) {
        //try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'KG', $rpc_config);
            if(empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return '用户名或密码不能为空';
            }
            //$client = new KgService($rpc_config['og_rpc_domain']);
			//$server = 'http://' . $rpc_config['rpc_server_domain'] . $rpc_config['kg_server_class'];
			//$client = new KgService($server);
			//$client = new KgService($rpc_config['kg_server_class']);
			$client = new KgService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['kg_server_class']);
			//echo 'Robin test_loginHandler<br>';
			//echo 'client_name:'.$rpc_config['rpc_client_name'].'<br>';
			//echo 'name:'.$live_user_info['name'].'<br>';
			//echo 'rpc_server_domain:'.$rpc_config['rpc_server_domain'].'<br>';
			//echo 'kg_server_class:'.$rpc_config['kg_server_class'].'<br>';
			//echo 'game:'.$game.'<br>';
            //$result = $client->login($client, $rpc_config['rpc_client_name'], $live_user_info['name'], $rpc_config['rpc_server_domain'], $game);
			$result = $client->login($rpc_config['rpc_client_name'], $live_user_info['name'], $rpc_config['rpc_server_domain'], $game);

			//print_r($result);
			//exit;
            //if(!$client->getStatus()) {
                //return $client->getMsg();
            //}
			//echo 'ok';
			//exit;

			//if(trim($result['status']) != 1) {
				//return '请求失败或无权限访问';
			//}

            return $this->render('index', ['login_url' => $result['data']]);
		/*
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return '请求失败';
        }
		*/
    }

	/**
     * PT 电子游艺登录处理方法
     * @param int $uid              用户id
     * @param string $game_hall_id  游戏厅标识
     * @return string
     */
    private function _pt_game_loginHandler($uid, $game = '', $actype = 1) {
		$rpc_config = LiveRpcConfig::find()->one();
		$live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'PT', $rpc_config);
		if(empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
			return '用户名或密码不能为空';
		}

		$client = new PtService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['pt_server_class']);
		$result = $client->login($rpc_config['rpc_client_name'], $live_user_info['name'], $live_user_info['pwd'], $rpc_config['rpc_server_domain'], $game);

		if($result['status']){
			return json_encode($live_user_info);
		}else{
			return '請求失敗!';
		}
    }

    private function _ig_game_loginHandler($uid, $game)
    {
        $rpc_config = LiveRpcConfig::find()->one();
        $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'IG', $rpc_config);

        if (empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
            return '用户名或密码不能为空';
        }

        $token = IgService::getToken();

        if (! $token) {
            return '请求错误或无权限访问';
        }

        // 判斷IG那邊是否存在會員資料
        $player = IgService::getPlayerByName($token, $live_user_info['name']);

        if (! $player) {
            $player = IgService::createNewPlayer($token, $live_user_info['name']);

            // 會員創建失敗，可能帳號重複
            if (! $player) {
                return '会员资料错误';
            }

            // 會員帳號 + 當前時間當作單號
            $transactionId = $player['username'] . date('YmdHis');
            // 活動: 首次遊戲玩家贈送10000
            $deposit = IgService::deposit($token, $transactionId, 1000000, $player['username']);
        }

        // 設置token
        $setToken = IgService::setUserToken($uid);
        // 遊戲連結
        $url = IgService::launchGame($setToken, $game);

        return $this->render('index', ['login_url' => $url]);
    }

    /**
     * IG回調網址 /?r=game/login/index&type=igBack&token=一些token
     */
    public function igGameCallBack()
    {
        $data['statusCode'] = 999;    // 999為錯誤，0為正確
        $token = $this->_req->get('token');

        $live_user = LiveUser::findOne(['ig_token' => $token, 'live_type' => 'IG']);

        if ($live_user) {
            $data['statusCode'] = 0;
            $data['username'] = $live_user['live_username'];
        } else {
            // 可自定義錯誤訊息
            $error['title'] = 'Undefined Errors';
            $error['description'] = 'Undefined Errors';

            $result['error'] = $error;
        }

        $result['data'] = $data;

        return json_encode($result);
    }
}