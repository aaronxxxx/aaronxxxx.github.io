<?php
namespace app\modules\live\services\impl;

use app\modules\live\services\IDsService;
use Exception;
use Hprose\Http\Client;
use Yii;

/**
 * DsService implements IDsService接口
 */
class DsService implements IDsService {
    private $_clt = null;
    private $_clt_name = '';
    private $_deposit_id = '';
    private $_withdraw_id = '';
    private $_DSNAME = "DSService";
    
    /**
     * 构造方法
     * @param string $server        服务端url
     * @param string $client_name   客户端标识
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
            Yii::error($e->getMessage(), $this->_DSNAME);
        }
    }
    
    /***
     * 登录
     */
    public function login($username, $password, $nickname, $line) {
        try{
            $result = $this->_clt->login($username, $password, $nickname, $line);
            Yii::trace($result, $this->_DSNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_DSNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
    
    /***
     * 查询余额
     */
    public function queryBalance($username, $password) {
        try {
            $result = $this->_clt->getBalance($this->_clt_name, $username, $password);
            Yii::trace($result, $this->_DSNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_DSNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
    
    /***
     * 存款
     */
    public function deposit($username, $password, $ref, $amount, $live_type) {
        try {
            $result = $this->_clt->exchange($username, $password, $ref, $amount,
                    $this->_deposit_id, $this->_clt_name, $live_type);
            Yii::trace($result, $this->_DSNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_DSNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        } 
    }
    
    /***
     * 取款
     */
    public function withdraw($username, $password, $ref, $amount, $live_type) {
        try {
            $result = $this->_clt->exchange($username, $password, $ref, $amount,
                $this->_withdraw_id, $this->_clt_name, $live_type);
            Yii::trace($result, $this->_DSNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_DSNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        } 
    }
    
    /***
     * 查询订单状态
     */
    public function queryOrderStatus($ref) {
        try {
            $result = $this->_clt->checkRef($ref);
            Yii::trace($result, $this->_DSNAME);
            return $result;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_DSNAME);
            return YII_DEBUG ? 'rpc调用异常: '.$e->getMessage() : '';
        }
    }
}
