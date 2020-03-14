<?php
namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\modules\live\common\LiveExchangeUtil;
use app\modules\live\common\LiveServiceUtil;
use app\modules\live\common\LiveUserUtil;
use app\modules\live\common\LiveUtil;
use app\modules\live\models\LiveLog;
use app\modules\live\models\LiveUser;
use app\modules\live\models\MoneyLog;
use app\modules\live\models\UserList;
use app\modules\live\services\AiService;
use app\modules\live\services\KgService;
use app\modules\live\services\PtService;
use app\modules\live\services\OgService;
use app\modules\live\services\VrService;

/**
 * ExchangeApi Controller
 */
class ExchangeApiController extends BaseController
{
    private $_ag_srv = null;
    private $_ds_srv = null;
    private $_do_params = null;
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
     * @param int $type 转账类型 单:存款 双: 取款
     * code: 0 成功 1 请求失败 2 查询失败
     * @return json
     */
    public function actionIndex()
    {
        $uid = $this->getParam('userid');           // 用户id
        $credit = $this->getParam('amount');        //转账金额
    	$live_type = $this->getParam('platform');   //平台厅型号
        $transform = $this->getParam('transform');  //转账方式转入平台，平台转出

    	if ($transform == "in") {
            $isWithdraw = false; // 转入平台
    	} elseif ($transform == "out") {
    		$isWithdraw = true; // 厅平台出
        }

        $type = LiveUtil::getTypeByLiveType($live_type);

        if ($isWithdraw == true) {
        	$type = $type * 2; // 厅平台出
        } else {
            $type = $type * 2 - 1;  // 转入平台
        }

        // 预操作处理
        $this->_prepareOperateHandler($uid, $credit, $live_type, $isWithdraw);

        if ($this->_resp['code'] != 0) {
            return json_encode($this->_resp);
        }

        if( $live_type == "AG" || $live_type == "AG_OG" || $live_type == "AG_BBIN" || $live_type == "DS") {
            $this->_do_params = LiveUtil::getExchangeParamsByLiveType($uid, $type, $credit, $live_type);
        } else {
            $this->_do_params = LiveUtil::getExchangeParamsByLiveType2($uid, $type, $credit, $live_type);
        }

        if (empty($this->_do_params)) {
            return json_encode($this->_resp);
        }

        if ($live_type == 'DS') {
            return $this->_ds_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        } elseif ($live_type == 'AI') {
            return $this->_ai_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        } elseif ($live_type == 'OG') {
            return $this->_og_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        } elseif ($live_type == 'KG') {
            return $this->_kg_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        } elseif ($live_type == 'VR') {
            return $this->_vr_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        } elseif ($live_type == 'PT') {
            //PT轉帳
            return $this->_pt_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        } else {
            return $this->_ag_exchangeHandler($uid, $credit, $live_type, $isWithdraw);
        }

        return json_encode($this->_resp);
    }

    private function _ai_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false)
    {
        // 當前時間_會員ID(年只有兩位) 當作單號，長度限制18字元
        $orderId = substr(date('Y'), -2) . date('mdHis') . '_' . $this->_do_params['ai_userid'];

        $client = new AiService();
        $agent = $client->agentLogin();

        if (! $agent) {
            $this->_resp['msg'] = '请求错误或无权限访问';
        	return json_encode($this->_resp);
        }

        $ret = $isWithdraw ?
            $client->withdraw($agent['token'], $this->_do_params['ai_userid'], $credit, $orderId) :
            $client->deposit($agent['token'], $this->_do_params['ai_userid'], $credit, $orderId);

		if (isset($ret['id']) && isset($ret['tradeid'])) {
			$ret = 0;
		}

        $this->_resp = [
            'code' => $ret == 0 ? 0 : 1,
            'data' => [],
			'msg' => $ret == 0 ? '' : $live_type . '转账失败',
        ];

        if ($ret == 0) {
            $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
        }

        return json_encode($this->_resp);
    }

    private function _vr_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
		if($isWithdraw){
			$tran_type = $this->_do_params['withdraw_name'];
		}else{
			$tran_type = $this->_do_params['deposit_name'];
		}

		$client = new VrService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['vr_server_class'], $this->_do_params['rpc_client_name']);
		$ret = $client->exchange($this->_do_params['cagent'], $this->_do_params['actype'], $this->_do_params['billno'], $tran_type, $this->_do_params['credit'], $this->_do_params['live_type'], $this->_do_params['rpc_client_name'], $this->_do_params['name'], $this->_do_params['pwd']);

		if (!$client->getStatus()) {	// 进行订单查询确认
			$ret = $client->queryOrderStatus($this->_do_params['rpc_client_name'], $this->_do_params['cagent'], $this->_do_params['name'], $this->_do_params['pwd'], $this->_do_params['billno']);
		}

        $this->_resp = [
            'code' => $client->getStatus() ? 0 : -1,
            'data' => [],
            'msg' => $client->getMsg(),
        ];

        if($client->getStatus()) {
            $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
        }
        return json_encode($this->_resp);
    }

    private function _og_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
        if($isWithdraw){
			$tran_type = $this->_do_params['withdraw_name'];
		}else{
			$tran_type = $this->_do_params['deposit_name'];
        }

        $client = new OgService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['og_server_class'], $this->_do_params['rpc_client_name']);
		$ret = $client->exchange($this->_do_params['cagent'], $this->_do_params['actype'], $this->_do_params['billno'], $tran_type, $this->_do_params['credit'], $this->_do_params['live_type'], $this->_do_params['rpc_client_name'], $this->_do_params['name'], $this->_do_params['pwd']);
		if (!$client->getStatus()) {                                 // 进行订单查询确认
            $ret = $client->queryOrderStatus($this->_do_params['rpc_client_name'], $this->_do_params['cagent'], $this->_do_params['name'], $this->_do_params['pwd'], $this->_do_params['billno'],$tran_type);
        }

        $this->_resp = [
            'code' => $client->getStatus() ? 0 : -1,
            'data' => [],
            'msg' => $client->getMsg(),
        ];
        if($client->getStatus()) {
            $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
        }
        return json_encode($this->_resp);
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
			$ret = $this->_Pt_deposit($client, $live_type, $this->_do_params);

            if($ret['status'] == 1){
                $ret = 0;
            }

            $this->_resp = [
                'code' => $ret == 0 ? 0 : $ret,
                'data' => [],
                'msg' => $ret == 0 ? '' : $live_type . '转账失败',
            ];
			$this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理

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

    private function _kg_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {

		$client = new KgService('http://'.$this->_do_params['rpc_server_domain'].$this->_do_params['kg_server_class']);

		$ret = $isWithdraw ? $this->_Kg_withdraw($client, $live_type, $this->_do_params) : $this->_Kg_deposit($client, $live_type, $this->_do_params);

		if($ret['status'] == 1){
			$ret = 0;
		}

        $this->_resp = [
            'code' => $ret == 0 ? 0 : $ret,
            'data' => [],
			'msg' => $ret == 0 ? '' : $live_type . '转账失败',
        ];
        if($ret == 0) {
            $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
        }
        return json_encode($this->_resp);
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


	//Kg End
    /**
     * 校验金额处理方法
     * code: 0 成功 1 请求失败 2 低于最小限额 3 余额不足 4 厅限额不足 5 厅内余额不足
     * @return json
     */
    public function actionCheckMoney() {
    	$uid = $this->getParam('userid');// 用户id
    	$live_type = $this->getParam('platform');//平台厅型号
        $credit = $this->getParam('amount');//转账金额
        $transform = $this->getParam('transform');//转账方式转入平台，平台转出
        if (!LiveExchangeUtil::checkMinimumLimit($credit)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '转账金额低于最小限额';
            return json_encode($this->_resp);
        }
        if($transform=="in")
        {
        	$isWithdraw=false; // 转入平台
        }elseif($transform=="out"){
        	$isWithdraw=true; // 厅平台出
        }
        $this->_resp = LiveExchangeUtil::checkMoney($uid, $credit, $live_type, $isWithdraw);
        return json_encode($this->_resp);
    }

    /**
     * 校验账号处理方法
     * code: 0 成功 1 请求失败 2 厅账号不存在 3 该账户真人停用状态
     * @return json
     */
    public function actionCheckAccount() {
    	$uid = $this->getParam('userid');// 用户id
        $live_type = $this->getParam('platform');//平台厅型号
        // 真人用是否激活状态
        $userlist=UserList::findOne(['user_id' => $uid]);
        $allow=$userlist->is_allow_live;
        $username=$userlist->user_name;
        if($allow==2){
        	$this->_resp['code'] = 3;
        	$this->_resp['msg'] = $username . '该账户目前真人停用状态';
        	return json_encode($this->_resp);
        }
        // 是否已经存在对应的厅真人账户
        $live_user = LiveUser::findOne(['user_id' => $uid, 'live_type' => $live_type]);
        if (empty($live_user)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = $live_type . '厅账号不存在，请先通知客户访问对应视讯厅';
            return json_encode($this->_resp);
        }
        $this->_resp['code'] = 0;
        $this->_resp['msg'] = '';
        return json_encode($this->_resp);
    }


    /* ============================ 华丽的分割线 =============================== */
    /**
     * AG转账处理方法
     * @param int $uid              用户id
     * @param decimal $credit       操作金额
     * @param string $live_type     厅标识
     * @param boolean $isWithdraw   是否取款
     * @return string
     */
    private function _ag_exchangeHandler($uid, $credit, $live_type, $isWithdraw = false) {
        $ret = $isWithdraw ? $this->_ag_withdraw($live_type, $this->_do_params) :
		$this->_ag_deposit($live_type, $this->_do_params);
		if($ret['status'] == 1){
			$ret = 0;
		}

        if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
            $ret = $this->_ag_queryOrderHandler($live_type, $this->_do_params);
        }

        $this->_resp = [
            'code' => $ret == 0 ? 0 : $ret,
            'data' => [],
            'msg' => $ret == 0 ? '' : $live_type . '转账失败',
        ];
        if($ret == 0) {
            $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
        }
        return json_encode($this->_resp);
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
        if (!in_array($live_type, LiveUtil::getQueryOrderLiveTypes())) {
            return $this->_resp['code'];
        }

        $cagent = $param['cagent'];
        $actype = $param['actype'];
        $billno = $param['billno'];

        for ($i = 0; $i < 3; ++$i) {                                            // 尝试3次，每次间隔5s
            $ret = $this->_ag_srv->queryOrderStatus($cagent, $billno, $actype);
            if (strpos($ret,'异常') === false) {
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
        $ret = $isWithdraw ? $this->_ds_withdraw($live_type, $this->_do_params) :
        $this->_ds_deposit($live_type, $this->_do_params);
		if($ret['status'] == 1){
			$ret = 0;
		}

        if ($ret == -1 || strpos($ret,'异常')) {                                 // 进行订单查询确认
            $ret = $this->_ds_queryOrderHandler($live_type, $this->_do_params);
        }

        $this->_resp = [
            'code' => $ret == 0 ? 0 : $ret,
            'data' => [],
            'msg' => $ret == 0 ? '' : $live_type . '转账失败',
        ];
        if($ret == 0) {
            $this->_finishOperateHandler($uid, $credit, $live_type, $isWithdraw);   // 结束操作处理
        }
        return json_encode($this->_resp);
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
        if (!in_array($live_type, LiveUtil::getQueryOrderLiveTypes())) {
            return $this->_resp['code'];
        }

        $ref = $param['billno'];

        for ($i = 0; $i < 3; ++$i) {                                            // 尝试3次，每次间隔5s
            $ret = $this->_ds_srv->queryOrderStatus($ref);
            if (strpos($ret,'异常') === false) {
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
    private function _prepareOperateHandler($uid,$credit,$live_type,$isWithdraw) {
        if (!LiveExchangeUtil::checkMinimumLimit($credit)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '转账金额低于最小限额';

            return $this->_resp;
        }
        $this->_resp = LiveExchangeUtil::checkMoney($uid, $credit, $live_type, $isWithdraw);
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
    private function _finishOperateHandler($uid, $credit, $live_type, $isWithdraw = false) {
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

        MoneyLog::createMoneyLog($this->_do_params);                            // 生成金额日志
        LiveLog::createLiveLog($this->_do_params);                              // 生成转账日志
    }
}