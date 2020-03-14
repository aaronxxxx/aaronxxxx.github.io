<?php
namespace app\modules\live\services;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use yii\base\Object;

class KgService extends Object {

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
     * @param $clientdomain
     * @param $gametype 1 斗地主 2 麻将
     * @return
     */
    public function login($name, $clientdomain, $gametype) {
        try {
            $this->_status = true;
            $result = $this->_client->loginKg($this->_ACTYPE, $name, $clientdomain, $gametype, 2);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /**
     * 查询余额
     * @param $name
     * @return
     */
    public function queryBalance($name) {
        try {
            $this->_status = true;
            $result = $this->_client->getBalanceKg($this->_ACTYPE, $name);
            $this->_checkDataStatus($result);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /**
     * 存款/取款
     * @param $name
     * @param $billno
     * @param $credit
     * @param $isWithdraw
     * @return
     */
    public function exchange($name, $billno, $credit, $isWithdraw) {
        try {
            $this->_status = true;
            $result = $this->_client->exchangeKg($this->_ACTYPE, $name, $billno, $isWithdraw?'OUT':'IN', $credit);
            $this->_checkDataStatus($result);
            if($result == "0") {
                $this->setErrorMsg("转账失败");
            }
            if($result == "-6") {
                $this->setErrorMsg("余额不足");
            }
            if($result == "-15") {
                $this->setErrorMsg("订单号重复");
            }
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    private function _checkDataStatus($result) {
        if($result == "-1") {
            $this->setErrorMsg("平台无响应");
        }
        if($result == "-4" || $result == "-17") {
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
        if($result == "-13") {
            $this->setErrorMsg("无效的账号");
        }
        if($result == "-18") {
            $this->setErrorMsg("无效渠道");
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
