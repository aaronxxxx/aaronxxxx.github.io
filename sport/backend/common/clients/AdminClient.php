<?php
namespace app\common\clients;
use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use Yii;

/**
 * 客户端远程接口
 * Class AdminClient
 * @package app\common\clients
 */
class AdminClient {
    private $_clt;
    private $_name;
    
    public function __construct() {
        $data = Yii::$app->db->createCommand("select * from live_rpc_config")->queryOne();
        $this->_name = $data['rpc_client_name'];
        try {
            $this->_clt = new Client('http://' . $data['rpc_server_domain'] . $data['sys_server_class'], false);
            $this->_clt->setTimeout(10000);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->_clt = null;
        }
    }
    
    /***
     * 登录授权
     */
    public function loginCheck() {
        try {
            $domainArr = $this->_clt->getAllowDomain($this->_name);
            $ipArr = $this->_clt->getAllowIp($this->_name);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return false;
        }

        if (!is_array($domainArr) || !is_array($ipArr)) {
            return false;
        }
        
        // 比较当前服务器域名
        $server_name = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $client_ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        
        if (count($domainArr) == 0 && count($ipArr) == 0) {
            return true;
        } else if (count($domainArr) != 0 && 
                !$this->array_value_exist($server_name, $domainArr)) {
            return false;
        } else if (count($ipArr) != 0 && 
                !$this->array_value_exist($client_ip, $ipArr)) {
            return false;
        }

        return true;
    }
    
    /**
     * 获取各厅的限额余额
     * @param type $live_type
     */
    public function getHallLimitBalance() {
        try {
            $hall_arr = $this->_clt->getHallLimitBalance($this->_name);
            if (empty($hall_arr) || !is_array($hall_arr)) {
                return array('ag_hall' => '', 'agin_hall' => '', 'ag_bbin_hall' => '',
                    'ag_og_hall' => '', 'ag_mg_hall' => '', 'ds_hall' => '', 'og_hall' => '', 'kg_hall' => '', 'vr_hall' => '', 'pt_hall' => ''
                );
            }
            
            return array(
                'ag_hall'       =>  $hall_arr['ag_hall'],
                'agin_hall'     =>  $hall_arr['agin_hall'],
                'ag_bbin_hall'  =>  $hall_arr['ag_bbin_hall'],
                'ag_og_hall'    =>  $hall_arr['ag_og_hall'],
                'ag_mg_hall'    =>  $hall_arr['ag_mg_hall'],
                'ds_hall'       =>  $hall_arr['ds_hall'],
                'og_hall'       =>  $hall_arr['og_hall'],
                'kg_hall'       =>  $hall_arr['kg_hall'],
                'vr_hall'       =>  $hall_arr['vr_hall'],
                'pt_hall'       =>  $hall_arr['pt_hall']
            );
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return array('ag_hall' => '', 'agin_hall' => '', 'ag_bbin_hall' => '',
                'ag_og_hall' => '', 'ag_mg_hall' => '', 'ds_hall' => '', 'og_hall' => '', 'kg_hall' => '', 'vr_hall' => '', 'pt_hall' => ''
            );
        }
    }
    
    /* ========================== 华丽的分割线 =============================== */
    private function array_value_exist($val, $arr) {
        $status = false;
        
        foreach ($arr as $v) {
            if ($val == $v) {
                $status = true;
                break;
            }
        }
        
        return $status;
    }
}
