<?php
namespace app\modules\lottery\services;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use yii\base\Object;

class VrService extends Object {
    private $_client = null;
	private $_clt_name = '';
    //0 试玩 1 真钱
    private $_ACTYPE = 1;
    private $_status = true;
    private $_msg = '';
	

    /**
     * 构造方法
     * @param string $server        服务端url
     */
    public function __construct($server, $client_name) {
        try {
            $this->_client = new Client($server, false);
            $this->_client->setTimeout(10000);
			$this->_clt_name = $client_name;
        } catch (Exception $e) {
            $this->_client = null;
            LogUtils::error_log($e);
        }
    }

    /**
     * 登录 ok
     * @param $name
     * @param $pwd
     * @param $clientdomain
     * @param $channel
     * @return
     */
    public function login($cagent, $actype, $channel, $username, $password, $clientdomain) {
        try {
            $this->_status = true;
			$result = $this->_client->login($this->_clt_name, $cagent, $actype, $channel, $username, $password, $clientdomain);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /**
     * 查询余额 ok
     * @param $name
     * @param $pwd
     * @return
     */
    public function queryBalance($rpc_client_name, $actype, $username) {
		try {
			$this->_status = true;
			$result = $this->_client->getBalance($rpc_client_name, $actype, $username);
			$this->_checkDataStatus($result);
			return $result['data'];
		} catch (Exception $e) {
			LogUtils::error_log($e);
			$this->setErrorMsg("请求失败或无权限访问");
		}
    }

    /**
     * 存款/取款 ok
     * @param $name
     * @param $pwd
     * @param $billno
     * @param $credit
     * @param $isWithdraw
     * @return
     */
	public function exchange($cagent, $actype, $billno, $tran_type, $credit, $live_type, $rpc_client_name, $username, $password) {
        try {
            $this->_status = true;
            $result = $this->_client->exchange($cagent, $actype, $billno, $tran_type, $credit, $live_type, $rpc_client_name, $username, $password);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /**
     * 查询订单状态
     * @param $name
     * @param $pwd
     * @param $billno
     * @param $credit
     * @param $isWithdraw
     * @return
     */
    public function queryOrderStatus($rpc_client_name,$cagent, $name, $pwd, $billno) {
        $result = $this->_client->queryOrderStatus($rpc_client_name, $cagent, $name, $pwd, $billno);
        if($result['totalRecords'] == 1 && $result['records'][0]['state'] == 0){
            $this->_status = true;
            return $result;
        }
        else
        {
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    private function _checkDataStatus($result) {
		switch($result['status']){
			case '0':
				$this->setErrorMsg("失敗");
				break;
			case '1':	//成功
				break;
		}
    }

    private function setErrorMsg($msg) {
        $this->_status = false;
        $this->_msg = $msg;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function getMsg() {
        return $this->_msg;
    }
}
