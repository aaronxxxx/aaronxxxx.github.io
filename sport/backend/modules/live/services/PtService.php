<?php
namespace app\modules\live\services;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use yii\base\Object;

class PtService extends Object {

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
            $this->_client->setTimeout(10000);
        } catch (Exception $e) {
            $this->_client = null;
            LogUtils::error_log($e);
        }
    }

    /**
     * 登录
	 * @client_name 代理前綴
     * @param $name 用戶名稱
     * @param $clientdomain 授權伺服器Domain
     * @param $gametype 遊戲代碼
     * @return
     */
    public function login($client_name, $name, $password, $clientdomain, $gametype) {
       try {
            $this->_status = true;
            $result = $this->_client->login($client_name, $this->_ACTYPE, $name, $password, $clientdomain, $gametype, 1);
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
    public function queryBalance($client_name, $name){
        try {
            $this->_status = true;
            $result = $this->_client->getBalance($client_name, $name);   
            $this->_checkDataStatus($result);
            return ["status" => $this->_status , "data"=> $result];
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /***
     * 存款
     */
    public function deposit($client_name, $name, $pwd, $ref, $amount, $live_type) {
		try {
            $result = $this->_client->exchange($client_name, $this->_ACTYPE, $name, $pwd, $ref, 'deposit', $amount, $live_type);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
			return -1;
        }
    }
    
    /***
     * 取款
     */
    public function withdraw($client_name, $name, $pwd, $ref, $amount, $live_type) {
        try {
            $result = $this->_client->exchange($client_name, $this->_ACTYPE, $name, $pwd, $ref, 'withdraw', $amount, $live_type);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
        } 
    }
    
    /***
     * 查询订单状态
     */
    public function queryOrderStatus($client_name, $ref) {
        return $this->_client->checkRef($client_name, $ref);
        try {
            $result = $this->_clt->checkRef($client_name, $ref);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return -1;
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
