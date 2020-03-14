<?php
namespace app\modules\live\controllers;

use app\common\helpers\LogUtils;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\models\LiveRpcConfig;
use app\modules\live\services\KgService;
use app\modules\live\services\OgService;
use Exception;
use Yii;
use app\common\base\BaseController;
use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\models\LiveUser;


/**
 * QueryBalanceApi Controller
 * code: 0 成功 1 请求失败 2 查询失败
 */
class QueryBalanceApiController extends BaseController {
    private $_ag_srv = null;
    private $_ds_srv = null;
    private $_resp = [];                                                        // 响应内容
    
    /**
     * 初始化方法
     */
    public function init() {
        parent::init();
        
        $live_hall_service = LiveServiceUtil::getAllLiveHallService();
        $this->_ag_srv = $live_hall_service['ag_srv'];
        $this->_ds_srv = $live_hall_service['ds_srv'];

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
        $type = $this->getParam('type');
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
            case 'KG':
                return $this->_kg_queryBalanceHandler($uid, $live_type);
            default : 
                return json_encode($this->_resp);
        }
    }
    
    /**
     * 内部Controller调用处理方法
     * @param int $type 操作编号
     * @return type
     */
    public function actionInnerQuery($uid,$type) {

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
            case 'KG':
                return $this->_kg_queryBalanceHandler($uid, $live_type);
            default : 
                return json_encode($this->_resp);
        }
    }

    private function _kg_queryBalanceHandler($uid, $live_type) {
        try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);
            if(empty($live_user_info['name'])) {
                return json_encode($this->_resp);
            }
            $client = new KgService($rpc_config['og_rpc_domain']);
            $result = $client->queryBalance($live_user_info['name']);
            if($client->getStatus()) {
                $this->_updateLiveUserMoney($uid, $live_type, $result);
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

    private function _og_queryBalanceHandler($uid, $live_type) {
        try {
            $rpc_config = LiveRpcConfig::find()->one();
            $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);
            if(empty($live_user_info['name']) || empty($live_user_info['pwd'])) {
                return json_encode($this->_resp);
            }
            $client = new OgService($rpc_config['og_rpc_domain']);
            $result = $client->queryBalance($live_user_info['name'], $live_user_info['pwd']);
            if($client->getStatus()) {
                $this->_updateLiveUserMoney($uid, $live_type, $result);
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
        $this->_resp = [
            'code' => $balance < 0 ? 2 : 0,
            'data' => [
                'name' => $name,
                'balance' => (YII_DEBUG || $balance >= 0) ? $balance : '',
                'time' => date('Y-m-d H:i:s', time()),
            ],
            'msg' => $balance < 0 ? '查询失败' : '',
        ];
        
        $this->_updateLiveUserMoney($uid, $live_type, $balance < 0 ? 0 : $balance);
        
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
        $this->_resp = [
            'code' => $balance < 0 ? 2 : 0,
            'data' => [
                'name' => $name,
                'balance' => $balance < 0 ? '' : $balance,
                'time' => date('Y-m-d H:i:s', time()),
            ],
            'msg' => $balance < 0 ? '查询失败' : '',
        ];
        
        $this->_updateLiveUserMoney($uid, $live_type, $balance < 0 ? 0 : $balance);
        
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