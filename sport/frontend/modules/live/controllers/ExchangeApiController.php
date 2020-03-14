<?php
namespace app\modules\live\controllers;

use app\modules\core\common\models\UserList;
use app\modules\live\common\LiveExchangeUtil;
use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\common\LogUtil;
use app\modules\live\models\LiveUser;
use app\modules\game\services\AiService;
use app\modules\game\services\IgService;
use app\modules\live\services\OgService;
use app\modules\game\services\KgService;
use app\modules\game\services\PtService;
use app\modules\lottery\services\VrService;
use app\modules\live\models\LiveRpcConfig;
use app\modules\core\common\models\MoneyLog;
use Yii;
use yii\web\Controller;

/**
 * ExchangeApi Controller
 */
class ExchangeApiController extends Controller {
    private $_ag_srv = null;
    private $_ds_srv = null;
    private $_do_params = null;
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
     * @param int $type 转账类型 单:存款 双: 取款
     * code: 0 成功 1 请求失败 2 查询失败
     * @return json
     */
    public function actionIndex() {
        //轉換參數
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $type = (int)$this->_req->post('type');
        $credit = $this->_req->post('credit');
        $live_type = LiveUtil::getLiveTypeByType($type);

        if (!LiveExchangeUtil::checkMinimumLimit($credit)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '转账金额低于最小限额';

            return json_encode($this->_resp);
        }

        /************* 這些檢查綁了很多171的東西 先註解 *************/
        //檢查轉帳 轉帳金額是否大於最小金額 -> 是否存在异常订单 -> 確認金額是否足夠
        // $this->_prepareOperateHandler($uid);
        // if ($this->_resp['code'] != 0) {
        //     return json_encode($this->_resp);
        // }
        /************* 這些檢查綁了很多171的東西 先註解 *************/
        /* 找出要用的參數
         * ag.ds用getExchangeParamsByLiveType
           其餘使用 getExchangeParamsByLiveType2
         */
        if (in_array($type, LiveUtil::getAgTypes()) || in_array($type, LiveUtil::getDsTypes())) {
            $this->_do_params = LiveUtil::getExchangeParamsByLiveType($uid, $type, $credit, $live_type);
        } else {
            $this->_do_params = LiveUtil::getExchangeParamsByLiveType2($uid, $type, $credit, $live_type);
        }

        if (empty($this->_do_params)) {
            return json_encode($this->_resp);
        }

		switch(true){
			case (in_array($type, LiveUtil::getAgTypes())):
				return $this->_ag_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
				break;
			case (in_array($type, LiveUtil::getDsTypes())):
				return $this->_ds_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
				break;
			case (in_array($type, LiveUtil::getOgTypes())):
				return $this->_og_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
				break;
			case (in_array($type, LiveUtil::getKgTypes())):
				return $this->_kg_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
				break;
			case (in_array($type, LiveUtil::getVrTypes())):
				return $this->_vr_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
				break;
			case (in_array($type, LiveUtil::getPtTypes())):
				return $this->_pt_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
                break;
            case (in_array($type, LiveUtil::getAiTypes())):
				return $this->_ai_exchangeHandler($uid, $credit, $live_type, $type % 2 == 0);
				break;
			default:
				return false;
		}
        return json_encode($this->_resp);
    }

    /**
     * 校验金额处理方法
     * code: 0 成功 1 请求失败 2 低于最小限额 3 余额不足 4 厅限额不足 5 厅内余额不足
     * @return json
     */
    public function actionCheckMoney() {
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];

        $this->_prepareOperateHandler($uid);                                    // 预操作处理

        return json_encode($this->_resp);
    }

    /**
     * 校验账号处理方法
     * code: 0 成功 1 请求失败 2 厅账号不存在
     * @return json
     */
    public function actionCheckAccount() {
        $type = $this->_req->post('type');
        $live_type = LiveUtil::getLiveTypeByType($type);
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];

        $userlist=UserList::findOne(['user_id' => $uid]);
        $allow=$userlist->is_allow_live;
        $username=$userlist->user_name;

        if($allow==2){
        	$this->_resp['code'] = 3;
        	$this->_resp['msg'] = $username . '该账户目前真人停用状态';
        	return json_encode($this->_resp);
        }

        $live_user = LiveUser::findOne(['user_id' => $uid, 'live_type' => $live_type]);
        if (empty($live_user)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = $live_type . '厅账号不存在，请先访问对应视讯厅';
            return json_encode($this->_resp);
        }

        $this->_resp['code'] = 0;
        $this->_resp['msg'] = '';
        return json_encode($this->_resp);
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

    private function _ai_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false)
    {
        $player = $this->_do_params['ai_userid'];
        $client = new AiService();
        // 拿token
        $agent = $client->agentLogin();

        if (! $agent) {
            $this->_resp = [
                'code' => -1,
                'msg' => '请求错误或无权限访问',
            ];

            return json_encode($this->_resp);
        }

        // 註冊AI會員
        if (empty($this->_do_params['ai_userid'])) {
            $player = $client->register($agent['token'], $this->_do_params);

            // 會員創建失敗，可能帳號重複
            if (! $player) {
                $this->_resp = [
                    'code' => -1,
                    'msg' => '会员资料错误',
                ];

                return json_encode($this->_resp);
            }
        }

        // 當前時間_會員ID(年只有兩位) 當作單號，長度限制18字元
        $orderId = substr(date('Y'), -2) . date('mdHis') . '_' . $player;

		if ($isWithdraw) {
             // 取款
            $result = $client->withdraw($agent['token'], $player, $credit, $orderId);

            if (isset($result['id']) && isset($result['tradeid'])) {
                $this->_resp = [
                    'code' => 0,
                    'data' => [],
                    'msg' => null,
                    'test' => $this->_do_params,
                ];
            }
		} else {
            // 存款
            // 转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
            $result = $client->deposit($agent['token'], $player, $credit, $orderId);

            if (isset($result['id']) && isset($result['tradeid'])) {
                $this->_resp = [
                    'code' => 0,
                    'data' => [],
                    'msg' => null,
                    'test' => $this->_do_params,
                ];
            }

            if (isset($result['id']) && isset($result['tradeid'])) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
            } else {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
            }
        }

        // 结束操作处理
        $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);

        return json_encode($this->_resp);
    }

    private function _ig_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false)
    {
        // 先拿token
        $token = IgService::getToken();

        if (! $token) {
            $this->_resp = [
                'code' => -1,
                'msg' => '请求错误或无权限访问',
            ];

            return json_encode($this->_resp);
        }

        // 判斷IG那邊是否存在會員資料
        $player = IgService::getPlayerByName($token, $this->_do_params['name']);

        if (! $player) {
            $player = IgService::createNewPlayer($token, $this->_do_params['name']);

            // 會員創建失敗，可能帳號重複
            if (! $player) {
                $this->_resp = [
                    'code' => -1,
                    'msg' => '会员资料错误',
                ];

                return json_encode($this->_resp);
            }
        }

        // 會員帳號 + 當前時間當作單號
        $transactionId = $player['username'] . date('YmdHis');
        // IG的金錢單位都要乘100
        $amount = $credit * 100;

		if ($isWithdraw) {    // 取款
            $client = IgService::withdraw($token, $transactionId, $amount, $player['username']);

            $this->_resp = [
                'code' => isset($client['username']) ? 0 : -1,
                'data' => [],
                'msg' => isset($client['message']) ? $client['message'] : null,
                'test' => $this->_do_params,
            ];
		} else {    // 存款
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);

            $client = IgService::deposit($token, $transactionId, $amount, $player['username']);

            $this->_resp = [
                'code' => isset($client['username']) ? 0 : -1,
                'data' => [],
                'msg' => isset($client['message']) ? $client['message'] : null,
                'test' => $this->_do_params,
            ];

            if ($client['username']) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
            } else {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
            }
        }

        // 结束操作处理
        $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);

        return json_encode($this->_resp);
    }

    private function _og_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
		if($isWithdraw){
            $tran_type = $this->_do_params['withdraw_name'];
            $client = new OgService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['og_server_class'], $this->_do_params['rpc_client_name']);
            $ret = $client->exchange($this->_do_params['cagent'], $this->_do_params['actype'], $this->_do_params['billno'], $tran_type, $this->_do_params['credit'], $this->_do_params['live_type'], $this->_do_params['rpc_client_name'], $this->_do_params['name'], $this->_do_params['pwd']);

            if (!$client->getStatus()) {                                 // 进行订单查询确认
                for($i=0;$i<=3;$i++){
                    $ret = $client->queryOrderStatus($this->_do_params['rpc_client_name'], $this->_do_params['cagent'], $this->_do_params['name'], $this->_do_params['pwd'], $this->_do_params['billno'],$tran_type);
                    if ($client->getStatus()){
                        break;
                    }
                    sleep(10);
                }
            }
            $this->_resp = [
                'code' => $client->getStatus() ? 0 : -1,
                'data' => [],
                'msg' => $client->getMsg(),
                'test'=>$this->_do_params,
            ];

            //if($client->getStatus()) {
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            //}
		}else{
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
            $tran_type = $this->_do_params['deposit_name'];
            $client = new OgService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['og_server_class'], $this->_do_params['rpc_client_name']);
            $ret = $client->exchange($this->_do_params['cagent'], $this->_do_params['actype'], $this->_do_params['billno'], $tran_type, $this->_do_params['credit'], $this->_do_params['live_type'], $this->_do_params['rpc_client_name'], $this->_do_params['name'], $this->_do_params['pwd']);

            if (!$client->getStatus()) {                                 // 进行订单查询确认
                for($i=0;$i<=3;$i++){
                    $ret = $client->queryOrderStatus($this->_do_params['rpc_client_name'], $this->_do_params['cagent'], $this->_do_params['name'], $this->_do_params['pwd'], $this->_do_params['billno'],$tran_type);
                    if ($client->getStatus()){
                        break;
                    }
                    sleep(10);
                }
            }
            $this->_resp = [
                'code' => $client->getStatus() ? 0 : -1,
                'data' => [],
                'msg' => $client->getMsg(),
                'test'=>$this->_do_params,
            ];

            if($client->getStatus()) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }else{
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }
        }
        return json_encode($this->_resp);
    }

    private function _kg_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
		$client = new KgService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['kg_server_class']);
		if($isWithdraw)
        {
            $ret = $this->_Kg_withdraw($client, $live_type, $this->_do_params);
            if($ret['status'] == 1){
                $ret = 0;
            }else{
                $ret = -1;
            }
            if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
                for($i=0;$i<=3;$i++){
                    $ret = $client->queryOrderStatus($live_type, $this->_do_params);
                    if($ret['status'] == 1){
                        $ret = 0;
                        break;
                    }
                    sleep(10);
                }
            }
            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            //if($ret == 0) {
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            //}
            return json_encode($this->_resp);
        }
        else
        {
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
            $ret = $this->_Kg_deposit($client, $live_type, $this->_do_params);
            if($ret['status'] == 1){
                $ret = 0;
            }else{  //假設失敗 更改狀態為-1
                $ret = -1;
            }

            if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
                for($i=0;$i<=3;$i++){
                    $ret = $client->queryOrderStatus($live_type, $this->_do_params);
                    if($ret['status'] == 1){
                        $ret = 0;
                        break;
                    }
                    sleep(10);
                }
            }
            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            if($ret == 0) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }else{
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }
            return json_encode($this->_resp);
        }


    }

	//Kg Start
	/**
     * Kg存款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _Kg_deposit($client, $live_type, $param) {
        $client_name = $param['rpc_client_name'];
		$name = $param['name'];
        $ref = $param['billno'];
        $amount = $param['credit'];

        return $client->deposit($client_name, $name, $ref, $amount, $live_type);
    }

    /**
     * Kg取款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */

    private function _Kg_withdraw($client, $live_type, $param) {
		$client_name = $param['rpc_client_name'];
        $name = $param['name'];
        $ref = $param['billno'];
        $amount = $param['credit'];

        return $client->withdraw($client_name, $name, $ref, $amount, $live_type);
    }

    /**
     * Kg查询订单状态处理
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    // private function _Kg_queryOrderHandler($live_type, $param) {


	// 	$client_name = $param['rpc_client_name'];
    //     $ref = $param['billno'];
    //     return 'KG';
    //     for ($i = 0; $i < 3; ++$i) {                                            // 尝试3次，每次间隔5s
    //         $ret = $client->queryOrderStatus($client_name, $ref);
    //         if (strpos($ret,'异常') === false) {
    //             break;
    //         }

    //         sleep(5);
    //     }

    //     return $ret;
    // }
	//Kg End

	private function _vr_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
        if($isWithdraw)
        {
            $tran_type = $this->_do_params['withdraw_name'];
            $client = new VrService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['vr_server_class'], $this->_do_params['rpc_client_name']);

            $ret = $client->exchange($this->_do_params['cagent'], $this->_do_params['actype'], $this->_do_params['billno'], $tran_type, $this->_do_params['credit'], $this->_do_params['live_type'], $this->_do_params['rpc_client_name'], $this->_do_params['name'], $this->_do_params['pwd']);

            if (!$client->getStatus()) {	// 进行订单查询确认
                for($i=0;$i<=3;$i++){
                    $ret = $client->queryOrderStatus($this->_do_params['rpc_client_name'], $this->_do_params['cagent'], $this->_do_params['name'], $this->_do_params['pwd'], $this->_do_params['billno']);
                    if ($client->getStatus()){
                        break;
                    }
                    sleep(10);
                }
            }

            $this->_resp = [
                'code' => $client->getStatus() ? 0 : -1,
                'data' => [],
                'msg' => $client->getMsg(),
            ];

            //if($client->getStatus()) {
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            //}
            return json_encode($this->_resp);
        }
        else
        {
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
            $tran_type = $this->_do_params['deposit_name'];
            $client = new VrService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['vr_server_class'], $this->_do_params['rpc_client_name']);

            $ret = $client->exchange($this->_do_params['cagent'], $this->_do_params['actype'], $this->_do_params['billno'], $tran_type, $this->_do_params['credit'], $this->_do_params['live_type'], $this->_do_params['rpc_client_name'], $this->_do_params['name'], $this->_do_params['pwd']);

            if (!$client->getStatus()) {	// 进行订单查询确认
                for($i=0;$i<=3;$i++){
                    $ret = $client->queryOrderStatus($this->_do_params['rpc_client_name'], $this->_do_params['cagent'], $this->_do_params['name'], $this->_do_params['pwd'], $this->_do_params['billno']);
                    if ($client->getStatus()){
                        break;
                    }
                    sleep(10);
                }
            }

            $this->_resp = [
                'code' => $client->getStatus() ? 0 : -1,
                'data' => [],
                'msg' => $client->getMsg(),
            ];

            if($client->getStatus()) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
                //加回金额后 , 重新进行扣款 与 写入记录
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }else{
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }
            return json_encode($this->_resp);
		}


	}

    /* ============================ 华丽的分割线 =============================== */
    /**
     * AG转账处理方法
     * @param int $uid              用户id
     * @param decimal $credit       操作金额
     * @param string $live_type     厅标识
     * @param boolean $isWithdraw   是否取款 true => AG->我的錢包 , false => 我的錢包->AG
     * @return string
     */
    private function _ag_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
        if($isWithdraw)  // 取款 AG->我的錢包 (確認AG扣錢 系統跟著帳戶加錢)
        {
            $ret = $this->_ag_withdraw($live_type, $this->_do_params);
            if($ret['status']){
                $ret = 0;
            }else{  //假設失敗 更改狀態為-1
                $ret = -1;
            }
            if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
                $ret = $this->_ag_queryOrderHandler($live_type, $this->_do_params);
                if($ret['status']){
                    $ret = 0;
                }else{
                    $ret = -1;
                }
            }

            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            //if($ret == 0) {
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            //}
            return json_encode($this->_resp);
        }
        else    // 入款 我的錢包->AG  (先將系統錢 , 先扣除 , 再送到AG加錢) 20190115 老薑說只能讓使用者少錢 不能讓代理賠錢
        {
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
			$ret = $this->_ag_deposit($live_type, $this->_do_params);
            if($ret['status']){
                $ret = 0;
            }else{
                $ret = -1;
            }
            if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
                $ret = $this->_ag_queryOrderHandler($live_type, $this->_do_params);
                if($ret['status']){
                    $ret = 0;
                }else{
                    $ret = -1;
                }
            }

            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            if($ret == 0) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
                //加回金额后 , 重新进行扣款 与 写入记录
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }else{
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }
            return json_encode($this->_resp);

        }

    }

    /**
     * AG存款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _ag_deposit($live_type, $param) {
        $name = $param['name'];
        $pwd = $param['pwd'];
        $cagent = $param['cagent'];
        $actype = $param['actype'];
        $billno = $param['billno'];
        $credit = $param['credit'];

        return $this->_ag_srv->deposit($cagent, $actype, $billno, $credit, $live_type,
            $name, $pwd);
    }

    /**
     * AG取款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _ag_withdraw($live_type, $param) {
        $name = $param['name'];
        $pwd = $param['pwd'];
        $cagent = $param['cagent'];
        $actype = $param['actype'];
        $billno = $param['billno'];
        $credit = $param['credit'];

        return $this->_ag_srv->withdraw($cagent, $actype, $billno, $credit, $live_type,
            $name, $pwd);
    }

    /**
     * AG查询订单状态处理
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _ag_queryOrderHandler($live_type, $param) {
        // if (!in_array($live_type, LiveUtil::getQueryOrderLiveTypes())) {
        //     return $this->_resp['code'];
        // }???

        $cagent = $param['cagent'];
        $actype = $param['actype'];
        $billno = $param['billno'];

        for ($i = 0; $i < 3; ++$i) {                                            // 尝试3次，每次间隔5s
            $ret = $this->_ag_srv->queryOrderStatus($cagent, $billno, $actype);
            if ($ret['status']) {
                break;
            }

            sleep(5);
        }

        return $ret;
    }

    /**
     * DS转账处理方法
     * @param int $uid              用户id
     * @param decimal $credit       操作金额
     * @param string $live_type     厅标识
     * @param boolean $isWithdraw   是否取款
     * @return string
     */
    private function _ds_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
        if($isWithdraw)  // 取款 AG->我的錢包 (確認AG扣錢 系統跟著帳戶加錢)
        {
            $ret = $this->_ds_withdraw($live_type, $this->_do_params);
            if($ret['status']){
                $ret = 0;
            }else{
                $ret = -1;
            }
            if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
                $ret = $this->_ds_queryOrderHandler($live_type, $this->_do_params);
                if($ret['status']){
                    $ret = 0;
                }else{
                    $ret = -1;
                }
            }
            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            //if($ret == 0) {
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            //}
            return json_encode($this->_resp);
        }
        else
        {
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
            $ret = $this->_ds_deposit($live_type, $this->_do_params);
            if($ret['status']){
                $ret = 0;
            }else{
                $ret=-1;
            }
            if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
                $ret = $this->_ds_queryOrderHandler($live_type, $this->_do_params);
                if($ret['status']){
                    $ret = 0;
                }else{
                    $ret=-1;
                }
            }
            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            if($ret == 0) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }else{
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }
            return json_encode($this->_resp);
        }


    }

    /**
     * DS存款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _ds_deposit($live_type, $param) {
        $name = $param['name'];
        $pwd = $param['pwd'];
        $ref = $param['billno'];
        $amount = $param['credit'];

        return $this->_ds_srv->deposit($name, $pwd, $ref, $amount, $live_type);
    }

    /**
     * DS取款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _ds_withdraw($live_type, $param) {
        $name = $param['name'];
        $pwd = $param['pwd'];
        $ref = $param['billno'];
        $amount = $param['credit'];

        return $this->_ds_srv->withdraw($name, $pwd, $ref, $amount, $live_type);
    }

    /**
     * DS查询订单状态处理
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _ds_queryOrderHandler($live_type, $param) {
        $ref = $param['billno'];
        for ($i = 0; $i < 3; ++$i) {                                            // 尝试3次，每次间隔5s
            $ret = $this->_ds_srv->queryOrderStatus($ref);
            if ($ret['status'] && $ret['data']=='6601') {
                break;
            }

            sleep(5);
        }

        return $ret;
    }

    /**
     * 预操作处理方法,如校验金额等
     * @param int $uid  用户id
     * @return json
     */
    private function _prepareOperateHandler($uid) {
        $type = $this->_req->post('type');
        $credit = $this->_req->post('credit');

        if (!LiveExchangeUtil::checkMinimumLimit($credit)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '转账金额低于最小限额';

            return $this->_resp;
        }
        $kl8 = \app\modules\general\member\models\ar\UserList::getLottery_kl8($uid);
        if(!$kl8){
            $this->_resp['msg'] = '该账户存在异常订单，不予转账，详情请联系客服';
            return $this->_resp;
        }
        $live_type = LiveUtil::getLiveTypeByType($type);
        $this->_resp = LiveExchangeUtil::checkMoney($uid, $credit, $live_type, $type % 2 == 0);

        return $this->_resp;
    }

    /**
     * 结束操作处理方法，如更新日志、余额等
     * @param int $uid              用户id
     * @param int $credit           操作金额
     * @param string $live_type     厅标识
     * @param boolean $isWithdraw   是否取款
     * @return string
     */
    private function _finishOperateHandler($uid, $credit, $live_type, $isWithdraw = false)
    {
        $isSuccessful = $this->_resp['code'] == 0 ? true : false;               // 操作是否成功

        if ($isWithdraw) {
            $money_add = $isSuccessful ? (-1 * $credit) : 0;
            $balance = $this->_do_params['user_assets'] + $credit;
        } else {
            $money_add = $isSuccessful ? (1 * $credit) : 0;
            $balance = $this->_do_params['user_assets'] - $credit;
        }

        $ret = LiveUserUtil::updateLiveUserAndUserMoney($uid, $live_type, $money_add);  // 更新真人帐号中的金额

        if (!$ret) {
            $isSuccessful = false;
        }

        $this->_do_params['status'] = $isSuccessful ? 1 : 2;
        $this->_do_params['result'] = $isSuccessful ? '[成功]' : '[失败]';
        $this->_do_params['user_balance'] = $isSuccessful ? $balance : $this->_do_params['user_assets'];
        LogUtil::money('c', $this->_do_params);                                 // 生成金额日志
        LogUtil::live('c', $this->_do_params);                                  // 生成转账日志
    }
    /**
     * 20190115 入款 我的錢包->AG  (先將系統錢 , 先扣除)
     * @param int $uid              用户id
     * @param int $credit           操作金额
     * @param string $live_type     厅标识
     * @return string
     */
     private function _PrepareTransportOperateHandler($uid, $credit, $live_type) {

        $userlist=UserList::findOne(['user_id' => $uid]);
        $money = $userlist['money'];
        $userlist->money = $money - $credit;
        $r = $userlist->save();

        $log = new MoneyLog();
        $log->user_id = $uid;
        $log->order_num = $this->_do_params['billno'].'_'.'Prepare';
        $log->about = $live_type.'预先转账处理';
        $log->update_time = date('Y-m-d H:i:s', time());
        $log->type = '预先转账处理,先将转账至第三方金额从账户扣除';
        $log->order_value = $credit;
        $log->assets = $money;
        $log->balance = $money - $credit;
		$log->save();
     }

     /**
     * 20190115 入款 我的錢包->AG  (先將系統錢 , 先扣除) 最后再加回去
     * @param int $uid              用户id
     * @param int $credit           操作金额
     * @param string $live_type     厅标识
     * @return string
     */
     private function _PrepareFinshOperateHandler($uid, $credit, $live_type , $type) {

        $userlist=UserList::findOne(['user_id' => $uid]);
        $money = $userlist['money'];
        $userlist->money = $money + $credit;
        $r = $userlist->save();

        $log = new MoneyLog();
        $log->user_id = $uid;
        $log->order_num = $this->_do_params['billno'].'_'.'Finsh';
        $log->about = $live_type.'转帐结束';
        $log->update_time = date('Y-m-d H:i:s', time());
        $log->type = $type . '加回预先扣除金额';
        $log->order_value = $credit;
        $log->assets = $money;
        $log->balance = $money + $credit;
		$log->save();
     }


	 /*
	  pt轉帳
	 */
	 private function _pt_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
		$client = new PtService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['pt_server_class']);
		if($isWithdraw)
        {
			$ret = $this->_Pt_withdraw($client, $live_type, $this->_do_params);

            if($ret['status'] == 1){
                $ret = 0;
            }

            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            //if($ret == 0) {
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            //}
            return json_encode($this->_resp);
        }
        else
        {
            //转账过程开始 , 预先扣除金额
            $this->_PrepareTransportOperateHandler($uid, $credit, $live_type);
			$ret = $this->_Pt_deposit($client, $live_type, $this->_do_params);


            if($ret['status'] == 1){
                $ret = 0;
            }

            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
            if(!$ret) {
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账成功');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }else{
                //转账过程正常结束 , 加回预扣金额
                $this->_PrepareFinshOperateHandler($uid, $credit, $live_type , '转账失败');
                $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
            }
            return json_encode($this->_resp);
        }


    }

	/**
     * PT存款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */
    private function _Pt_deposit($client, $live_type, $param) {
        $client_name = $param['rpc_client_name'];
		$name = $param['name'];
		$pwd = $param['pwd'];
        $ref = $param['billno'];
        $amount = $param['credit'];

        return $client->deposit($client_name, $name, $pwd, $ref, $amount, $live_type);
    }

    /**
     * PT取款
     * @param string $live_type 真人标识
     * @param array $param      参数数组
     * @return status           响应状态
     */

    private function _Pt_withdraw($client, $live_type, $param) {
		$client_name = $param['rpc_client_name'];
        $name = $param['name'];
		$pwd = $param['pwd'];
        $ref = $param['billno'];
        $amount = $param['credit'];

        return $client->withdraw($client_name, $name, $pwd, $ref, $amount, $live_type);
    }
}