<?php
namespace app\modules\live\services\impl;

use app\common\helpers\LogUtils;
use app\modules\live\services\IAgService;
use Exception;
use Hprose\Http\Client;

/**
 * AgService implements IAgService接口
 */
class AgService implements IAgService {
    private $_clt = null;
    private $_clt_name = '';
    private $_deposit_id = '';
    private $_withdraw_id = '';

    /**
     * 构造方法
     * @param string $server        服务端url
     * @param string $client_name   客户端标识
     * @param string $deposit_id    存款标识
     * @param string $withdraw_id   取款标识
     */
    public function __construct($server, $client_name, $deposit_id, $withdraw_id, $callback_domain) {
        try {
            $this->_clt = new Client($server, false);
            $this->_clt->setTimeout(10000);
            $this->_clt_name = $client_name;
            $this->_deposit_id = $deposit_id;
            $this->_withdraw_id = $withdraw_id;
			$this->_callback_domain = $callback_domain;
        } catch (Exception $e) {
            $this->_clt = null;
            LogUtils::error_log($e);
        }
    }

    /**
     * 登录
     * @param string $cagent
     * @param string $actype
     * @param string $gametype
     * @param string $username
     * @param string $password
     * @param string $flash_id
     * @return (-1:失败) or url
     */
	 
    public function login($cagent, $actype, $gametype, $username, $password, $flash_id = '') {
        try {
			#v1.0
            //$result = $this->_clt->login($cagent, $actype, $gametype, $username, $password, $flash_id);
			#v2.0
			$result = $this->_clt->login($this->_clt_name, $cagent, $actype, $gametype, $username, $password, $flash_id, $this->_callback_domain);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
        }
    }

    /**
     * 查询余额
     * @param string $cagent
     * @param string $actype
     * @param string $username
     * @param string $password
     * @return (-1:失败) or balance
     */
    public function queryBalance($cagent, $actype, $username, $password) {
        try {
            $result = $this->_clt->getBalance($this->_clt_name, $cagent, $actype, $username, $password);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
        }
    }
    
    /***
     * 存款
     */
    public function deposit($cagent, $actype, $billno, $credit, $live_type, $username, $password) {
        try {
            $result = $this->_clt->exchange($cagent, $actype, $billno, $this->_deposit_id,
                $credit, $this->_clt_name, $live_type, $username, $password);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
        }
    }
    
    /***
     * 取款
     */
    public function withdraw($cagent, $actype, $billno, $credit, $live_type, 
            $username, $password) {
        try {
            $result = $this->_clt->exchange($cagent, $actype, $billno, $this->_withdraw_id,
                $credit, $this->_clt_name, $live_type, $username, $password);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
        }
    }
    
    /***
     * 查询订单状态
     */
    public function queryOrderStatus($cagent, $billno, $actype) {
        try {
            $result = $this->_clt->queryOrderStatus($this->_clt_name,$cagent, $billno, $actype);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
        }
    }
}
