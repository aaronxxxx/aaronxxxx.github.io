<?php
namespace app\modules\live\services;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use yii\base\Object;

class OgService extends Object {
    private $_client = null;
    //0 试玩 1 真钱
    private $_ACTYPE = 1;
    private $_status = true;
    private $_msg = '';

    /**
     * 构造方法
     * @param string $server        服务端url
     */
    public function __construct($server) {
        try {
            $this->_client = new Client($server, false);
        } catch (Exception $e) {
            $this->_client = null;
            LogUtils::error_log($e);
        }
    }

    /**
     * 登录
     * @param $name
     * @param $pwd
     * @param $clientdomain
     * @param $gametype 1 视讯网页版 2 手机版
     * @return
     */
    public function login($name, $pwd, $clientdomain, $gametype) {
        try {
            $this->_status = true;
            $result = $this->_client->loginOg($this->_ACTYPE, $name, $pwd, $clientdomain, 1, $gametype);
            $this->_checkDataStatus($result);
            if($result == "0") {
                $this->setErrorMsg("账号不可用");
            }
            if($result == "-2") {
                $this->setErrorMsg("创建用户密码格式不正确");
            }
            if($result == "-3") {
                $this->setErrorMsg("创建用户名称过长");
            }
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败");
        }
    }

    /**
     * 查询余额
     * @param $name
     * @param $pwd
     * @return
     */
    public function queryBalance($name, $pwd) {
        try {
            $this->_status = true;
            $result = $this->_client->getBalanceOg($this->_ACTYPE, $name, $pwd);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败");
        }
    }

    /**
     * 存款/取款
     * @param $name
     * @param $pwd
     * @param $billno
     * @param $credit
     * @param $isWithdraw
     * @return
     */
    public function exchange($name, $pwd, $billno, $credit, $isWithdraw) {
        try {
            $this->_status = true;
            $result = $this->_client->exchangeOg($this->_ACTYPE, $name, $pwd, $billno, $isWithdraw?'OUT':'IN', $credit);
            $this->_checkDataStatus($result);
            if($result == "0") {
                $this->setErrorMsg("转账失败");
            }
            if($result == "-6") {
                $this->setErrorMsg("余额不足");
            }
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败");
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
    public function queryOrderStatus($name, $pwd, $billno, $credit, $isWithdraw) {
        try {
            $this->_status = true;
            $result = $this->_client->queryExchangeOg($this->_ACTYPE, $name, $pwd, $billno, $credit, $isWithdraw?'OUT':'IN');
            $this->_checkDataStatus($result);
            if($result == "0") {
                $this->setErrorMsg("转账失败");
            }
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败");
        }
    }

    private function _checkDataStatus($result) {
        if($result == "-1") {
            $this->setErrorMsg("平台无响应");
        }
        if($result == "-4") {
            $this->setErrorMsg("密钥错误");
        }
        if($result == "-5") {
            $this->setErrorMsg("账号不存在");
        }
        if($result == "-7") {
            $this->setErrorMsg("没有权限");
        }
        if($result == "-8") {
            $this->setErrorMsg("参数错误");
        }
        if($result == "-10") {
            $this->setErrorMsg("代理错误");
        }
        if($result == "-11") {
            $this->setErrorMsg("其他异常信息");
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
