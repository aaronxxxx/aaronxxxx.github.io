<?php
namespace app\modules\game\services;

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
            $this->_client->setTimeout(10000);
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
    public function login($client_name, $name, $clientdomain, $gametype) {
       try {
		   //$result = $this->_client->test();
		    //?echo '<pre>';
		    //?print_r($this->_client->aaaa());
		    //?echo '</pre>';
		    //?exit;
            $this->_status = true;
			//echo 'Robin test login<br>';
			//echo 'Client:'.$client.'<br>';
			//echo 'Client Name:'.$client_name.'<br>';
			//echo 'Name:'.$name.'<br>';	
			//echo 'Client Domain:'.$clientdomain.'<br>';
			//echo 'gametype:'.$gametype.'<br>';
			//echo 'result_before:<br>';			
            $result = $this->_client->login($client_name, $this->_ACTYPE, $name, $clientdomain, $gametype, 1);
			
			//$result = $client->loginKg($client_name, $this->_ACTYPE, $name, $clientdomain, $gametype, 1);
			//print_r($result);//?
			//exit;//?
					
            //$this->_checkDataStatus($result);
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
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败或无权限访问");
        }
    }

    /***
     * 存款
     */
    public function deposit($client_name, $name, $ref, $amount, $live_type) {
		try {
            $result = $this->_client->exchange($client_name, $this->_ACTYPE, $name, $ref, 'deposit', $amount, $live_type);
            return $result;
        } catch (Exception $e) {
            LogUtils::error_log($e);
			return -1;
        } 
    }
    
    /***
     * 取款
     */
    public function withdraw($client_name, $name, $ref, $amount, $live_type) {
        try {
            $result = $this->_client->exchange($client_name, $this->_ACTYPE, $name, $ref, 'withdraw', $amount, $live_type);
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
