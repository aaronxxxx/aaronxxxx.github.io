<?php
namespace app\modules\live\controllers;

use app\common\helpers\LogUtils;
use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\models\LiveRpcConfig;
use app\modules\live\models\LiveConfig;
use app\modules\live\models\LiveUser;
use app\modules\game\services\AiService;
use app\modules\game\services\IgService;
use app\modules\live\services\OgService;
use app\modules\game\services\KgService;
use app\modules\game\services\PtService;
use app\modules\lottery\services\VrService;

use Exception;
use Yii;
use yii\web\Controller;

/**
 * QueryBalanceApi Controller
 * code: 0 成功 1 请求失败 2 查询失败
 */
class QueryBalanceApiController extends Controller {
    private $_ag_srv = null;
    private $_ds_srv = null;
    private $_req = null;
    private $_resp = [];                                                        // 响应内容

    /**
     * 初始化方法
     */
    public function init() {
        parent::init();

        $live_hall_service = LiveServiceUtil::getAllLiveHallService();
        $this->_ag_srv = $live_hall_service['ag_srv'];
        $this->_ds_srv = $live_hall_service['ds_srv'];

        $this->_req = Yii::$app->request;
        $this->_resp = [
            'code' => 1,
            'data' => [],
            'msg' => '请求失败'
        ];

        $this->layout = false;                                                  // 关闭layout渲染
        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
    }

    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex() {
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $type = $this->_req->post('type');
        $live_type = LiveUtil::getLiveTypeByType($type, false);

        switch ($type) {
            case 1 :
            case 2 :
            case 3 :
            case 5 :
            case 6 :
                return $this->_ag_queryBalanceHandler($uid, $live_type);
            case 4 :
                return $this->_ds_queryBalanceHandler($uid, $live_type);
            case 7 :
                return $this->_og_queryBalanceHandler($uid, $live_type);
            case 8:
                return $this->_kg_queryBalanceHandler($uid);
			case 9:
                return $this->_pt_queryBalanceHandler($uid);
			case 10:
                return $this->_vr_queryBalanceHandler($uid);
            case 11:
                return $this->_ai_queryBalanceHandler($uid);
            default :
                return json_encode($this->_resp);
        }
    }

    /**
     * 内部Controller调用处理方法
     * @param int $type 操作编号
     * @return type
     */
    public function actionInnerQuery($type) {
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];

        $live_type = LiveUtil::getLiveTypeByType($type, false);

        switch ($type) {
            case 1 :
            case 2 :
            case 3 :
            case 5 :
            case 6 :
                return $this->_ag_queryBalanceHandler($uid, $live_type);
            case 4 :
                return $this->_ds_queryBalanceHandler($uid, $live_type);
            case 7 :
                return $this->_og_queryBalanceHandler($uid, $live_type);
            case 8:
                return $this->_kg_queryBalanceHandler($uid);
			case 9:
                return $this->_pt_queryBalanceHandler($uid);
			case 10:
                return $this->_vr_queryBalanceHandler($uid);
            case 11:
                return $this->_ai_queryBalanceHandler($uid);
            default :
                return json_encode($this->_resp);
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
            echo json_encode($this->_resp);
            return false;
        }

        return true;
    }

    private function _ai_queryBalanceHandler($uid)
    {
        try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'AI', $rpc_config);

            if (empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return json_encode($this->_resp);
            }

            $player = $live_user_info['ai_userid'];
            $client = new AiService();
            // 拿token
            $agent = $client->agentLogin();

            if (! $agent) {
                return json_encode($this->_resp);
            }

            // 註冊AI會員
            if (empty($live_user_info['ai_userid'])) {
                $player = AiService::register($agent, $live_user_info);

                // 會員創建失敗，可能帳號重複
                if (! $player) {
                    return json_encode($this->_resp);
                }
            }

            $balance = $client->queryBalance($agent['token'], $player);

            if (!$balance || !is_numeric($balance)) {
                return json_encode($this->_resp);
            }

            $this->_updateLiveUserMoney($uid, 'AI', $balance);

            $this->_resp = [
                'code' => 0,
                'data' => [
                    'name' => $live_user_info['name'],
                    'balance' => $balance ?: 0,
                    'time' => date('Y-m-d H:i:s'),
                ],
                'msg' => null
            ];

            return json_encode($this->_resp);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return json_encode($this->_resp);
        }
    }

    private function _ig_queryBalanceHandler($uid)
    {
        try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'IG', $rpc_config);

            if (empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return json_encode($this->_resp);
            }

            $token = IgService::getToken();

            if (! $token) {
                return json_encode($this->_resp);
            }

            // 判斷IG那邊是否存在會員資料
            $player = IgService::getPlayerByName($token, $live_user_info['name']);

            if (! $player) {
                $player = IgService::createNewPlayer($token, $live_user_info['name']);

                // 會員創建失敗，可能帳號重複
                if (! $player) {
                    return json_encode($this->_resp);
                }
            }

            // IG的金錢單位都要除100
            $balance = $player['balance'] / 100;
            $this->_updateLiveUserMoney($uid, 'IG', $balance);

            $this->_resp = [
                'code' => 0,
                'data' => [
                    'name' => $live_user_info['name'],
                    'balance' => $balance ?: 0,
                    'time' => date('Y-m-d H:i:s', time()),
                ],
                'msg' => null
            ];

            return json_encode($this->_resp);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return json_encode($this->_resp);
        }
    }

    private function _og_queryBalanceHandler($uid, $live_type) {
        try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);
			$live_config = LiveConfig::findOne(['live_type' => $live_type, 'status' => 1]);
            if(empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return json_encode($this->_resp);
            }
			$client = new OgService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['og_server_class'], $rpc_config['rpc_client_name']);
            $balance = $client->queryBalance($rpc_config['rpc_client_name'], $live_config['cagent'], 1, $live_user_info['name'], $live_user_info['pwd']);

            if($client->getStatus()) {
                $this->_updateLiveUserMoney($uid, $live_type, $balance);
            }

            $this->_resp = [
                'code' => 0,
                'data' => [
                    'name' => $live_user_info['name'],
                    'balance' => $client->getStatus() ? $balance : 0,
                    'time' => date('Y-m-d H:i:s', time()),
                ],
                'msg' => $client->getMsg(),
            ];
            return json_encode($this->_resp);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return json_encode($this->_resp);
        }
    }

    private function _kg_queryBalanceHandler($uid) {
        try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'KG', $rpc_config);
            if(empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return json_encode($this->_resp);
            }
            //$client = new KgService($rpc_config['og_rpc_domain']);
			$client = new KgService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['kg_server_class']);
            $result = $client->queryBalance($rpc_config['rpc_client_name'], $live_user_info['name']);
            if($client->getStatus()) {
                $this->_updateLiveUserMoney($uid, 'KG', $result);
            }
            $this->_resp = [
                'code' => 0,
                'data' => [
                    'name' => $live_user_info['name'],
                    'balance' => $client->getStatus() ? $result : 0,
                    'time' => date('Y-m-d H:i:s', time()),
                ],
                'msg' => $client->getMsg(),
            ];
            return json_encode($this->_resp);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return json_encode($this->_resp);
        }
    }

	private function _pt_queryBalanceHandler($uid) {
		try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, 'PT', $rpc_config);

            if(empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return json_encode($this->_resp);
            }

			$client = new PtService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['pt_server_class']);
			$result = $client->queryBalance($rpc_config['rpc_client_name'], $live_user_info['name']);

            if($client->getStatus()) {
                $this->_updateLiveUserMoney($uid, 'PT', $result);
            }
            $this->_resp = [
                'code' => 0,
                'data' => [
                    'name' => $live_user_info['name'],
                    'balance' => $client->getStatus() ? $result : 0,
                    'time' => date('Y-m-d H:i:s', time()),
                ],
                'msg' => $client->getMsg(),
            ];

            return json_encode($this->_resp);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return json_encode($this->_resp);
        }
    }

	private function _vr_queryBalanceHandler($uid) {
		$live_type = 'VR';
		$live_user_info = LiveUtil::getLoginParamsByLiveType($uid, $live_type);
		if (empty($live_user_info)) {
			return '用户名或密码不能为空';
		}

		try {
			$rpc_config = $live_user_info['rpc_config'];
			$client = new VrService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['vr_server_class'], $rpc_config['rpc_client_name']);
			$balance = $client->queryBalance($rpc_config['rpc_client_name'], $live_user_info['actype'], $live_user_info['name']);

			if($client->getStatus()) {
				$this->_updateLiveUserMoney($uid, $live_type, $balance);
			}

			$this->_resp = [
				'code' => 0,
				'data' => [
				'name' => $live_user_info['name'],
				'balance' => $client->getStatus() ? $balance : 0,
				'time' => date('Y-m-d H:i:s', time()),
			],
				'msg' => $client->getMsg(),
			];
			return json_encode($this->_resp);
		} catch (Exception $e) {
			LogUtils::error_log($e);
			return json_encode($this->_resp);
		}
    }

    /* ============================ 华丽的分割线 =============================== */
    /**
     * AG查询余额处理方法
     * @param int $uid          用户id
     * @param string $live_type 厅标识
     * @return string
     */
    private function _ag_queryBalanceHandler($uid, $live_type) {
        $query_params = LiveUtil::getQueryBalanceParamsByLiveType($uid, $live_type);
        if (empty($query_params)) {
            return json_encode($this->_resp);
        }

        $name = $query_params['name'];
        $pwd = $query_params['pwd'];
        $cagent = $query_params['cagent'];
        $actype = $query_params['actype'];

        $balance = $this->_ag_srv->queryBalance($cagent, $actype, $name, $pwd);
		$balance = $balance['data'];

        $this->_resp = [
            'code' => $balance < 0 ? 2 : 0,
            'data' => [
                'name' => $name,
                'balance' => (YII_DEBUG || $balance >= 0) ? $balance : '',
                'time' => date('Y-m-d H:i:s', time()),
            ],
            'msg' => $balance < 0 ? '查询失败' : '',
        ];

        if($balance==-2){
        	$balance=0;
        }

        $this->_updateLiveUserMoney($uid, $live_type, $balance);

        return json_encode($this->_resp);
    }

    /**
     * DS查询余额处理方法
     * @param int $uid          用户id
     * @param string $live_type 厅标识
     * @return string
     */
    private function _ds_queryBalanceHandler($uid, $live_type) {
        $query_params = LiveUtil::getQueryBalanceParamsByLiveType($uid, $live_type);
        if (empty($query_params)) {
            return json_encode($this->_resp);
        }

        $name = $query_params['name'];
        $pwd = $query_params['pwd'];
        $balance = $this->_ds_srv->queryBalance($name, $pwd);
		$balance = $balance['data'];
        $this->_resp = [
            'code' => $balance < 0 ? 2 : 0,
            'data' => [
                'name' => $name,
                'balance' => (YII_DEBUG || $balance >= 0) ? $balance : '',
                'time' => date('Y-m-d H:i:s', time()),
            ],
            'msg' => $balance < 0 ? '查询失败' : '',
        ];
        if($balance==-2){
        	$balance=0;
        }
        $this->_updateLiveUserMoney($uid, $live_type, $balance);

        return json_encode($this->_resp);
    }

    /**
     * 更新真人余额
     * @param int $uid          用户id
     * @param string $live_type 厅标识
     * @param int $balance      余额
     * @return boolean          true: 成功 false: 失败
     */
    private function _updateLiveUserMoney($uid, $live_type, $balance) {
        $live_user = LiveUser::findOne([
            'user_id' => $uid,
            'live_type' => $live_type,
        ]);

        if (empty($live_user)) {
            return false;
        }

        $live_user->live_money = $balance;
        return $live_user->save();
    }
}