<?php
namespace app\modules\live\services\impl;

use app\modules\live\services\IAgService;
use Exception;
use Hprose\Http\Client;
use Yii;

/**
 * AgService implements IAgService接口
 */
class AgService implements IAgService {
    private $_clt = null;
    private $_clt_name = '';
    private $_deposit_id = '';
    private $_withdraw_id = '';
    private $_AGNAME = "AgService";
    
    /**
     * 构造方法
     * @param string $server        服务端url
     * @param string $client_name   客户端标识_clt_name
     * @param string $deposit_id    存款标识
     * @param string $withdraw_id   取款标识
     */
    public function __construct($server, $client_name, $deposit_id, $withdraw_id) {
        try {
            $this->_clt = new Client($server, false);
            $this->_clt->setTimeout(10000);
            $this->_clt_name = $client_name;
            $this->_deposit_id = $deposit_id;
            $this->_withdraw_id = $withdraw_id;
        } catch (Exception $e) {
            $this->_clt = null;
            Yii::error($e->getMessage(), $this->_AGNAME);
        }
    }
    
    /***
     * 登录
     */
    public function login($cagent, $actype, $gametype, $username, $password, $flash_id = '') {
        try {
            $result = $this->_clt->login($cagent, $actype, $gametype, $username, $password, $flash_id);
            Yii::trace($result, $this->_AGNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_AGNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
    
    /***
     * 查询余额
     */
    public function queryBalance($cagent, $actype, $username, $password) {
        try {
            $result = $this->_clt->getBalance($cagent, $actype, $username, $password);
            Yii::trace($result, $this->_AGNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_AGNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
    
    /***
     * 存款
     */
    public function deposit($cagent, $actype, $billno, $credit, $live_type, 
            $username, $password) {
        try {
            $result = $this->_clt->exchange($cagent, $actype, $billno, $this->_deposit_id,
                $credit, $this->_clt_name, $live_type, $username, $password);
            Yii::trace($result, $this->_AGNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_AGNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
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
            Yii::trace($result, $this->_AGNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_AGNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
    
    /***
     * 查询订单状态
     */
    public function queryOrderStatus($cagent, $billno, $actype) {
        try {
            $result = $this->_clt->queryOrderStatus($cagent, $billno, $actype);
            Yii::trace($result, $this->_AGNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_AGNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
}
