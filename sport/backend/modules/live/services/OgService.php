<?php
namespace app\modules\live\services;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use yii\base\Object;

class OgService extends Object {
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
     * 登录ok
     * @param $name
     * @param $pwd
     * @param $clientdomain
     * @param $gametype 1 视讯网页版 2 手机版
     * @return
     */
    public function login($cagent, $actype, $gametype, $username, $password, $clientdomain) {
        try {
            $this->_status = true;
			$result = $this->_client->loginOg($this->_clt_name, $cagent, $actype, $gametype, $username, $password, $clientdomain);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /**
     * 查询余额ok
     * @param $name
     * @param $pwd
     * @return
     */
    public function queryBalance($rpc_client_name, $cagent, $actype, $username, $password) {
        try {
            $this->_status = true;
            $result = $this->_client->getBalanceOg($rpc_client_name, $cagent, $actype, $username, $password);
            //$this->_checkDataStatus($result);
            //return $result['data'];
			return $result;
		} catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /**
     * 存款/取款ok
     * @param $name
     * @param $pwd
     * @param $billno
     * @param $credit
     * @param $isWithdraw
     * @return
     */
	public function exchange($cagent, $actype, $billno, $tran_type, $credit, $live_type, $rpc_client_name, $username, $password) {
        // $result = $this->_client->exchangeOg($cagent, $actype, $billno, $tran_type, $credit, $live_type, $rpc_client_name, $username, $password);
        // return $result;
        try {
            $this->_status = true;
            $result = $this->_client->exchangeOg($cagent, $actype, $billno, $tran_type, $credit, $live_type, $rpc_client_name, $username, $password);
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
    public function queryOrderStatus($rpc_client_name,$cagent, $name, $pwd, $billno,$tran_type) {
        try {
            $this->_status = true;
            $result = $this->_client->queryOrderStatus($rpc_client_name, $cagent, $name, $pwd, $billno,$tran_type);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
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
			case '2':
				$this->setErrorMsg("密码错误");
				break;
			case '3':
				$this->setErrorMsg("用户名过长");
				break;
			case '10':
				$this->setErrorMsg("代理商不存在");
				break;
			case 'key_error':
				$this->setErrorMsg("密匙错误");
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
