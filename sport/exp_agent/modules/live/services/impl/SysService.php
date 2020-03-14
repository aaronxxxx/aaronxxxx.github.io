<?php
namespace app\modules\live\services\impl;

use app\modules\live\services\ISysService;
use Exception;
use Hprose\Http\Client;
use Yii;

/**
 * SysService implements ISysService接口
 */
class SysService implements ISysService {
    private $_clt = null;
    private $_clt_name = '';
    private $_SYSNAME = "SYSService";
    
    /**
     * 构造方法
     * @param string $server            服务端url
     * @param string $live_client_name  真人客户端标识
     */
    public function __construct($server, $live_client_name) {
        $this->_clt_name = $live_client_name;
        try {
           $this->_clt = new Client($server, false);
            $this->_clt->setTimeout(10000);
        } catch (Exception $e) {
            $this->_clt = null;
            Yii::error($e->getMessage(), $this->_SYSNAME);
        }
    }
    
    /***
     * 查询指定厅的限额余额
     */
    public function queryHallLimitBalance($live_type) {
        $balance = 0;
        
        try {
            $hall_balance = $this->_clt->getHallLimitBalance($this->_clt_name, $live_type);
            if (!is_numeric($hall_balance)) {
                return $balance;
            }
            
            return (int)$hall_balance;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_SYSNAME);
            return $balance;
        }
    }
    
    /***
     * 查询各厅的限额余额
     */
    public function queryAllHallLimitBalance() {
        $default_data = ['ag_hall' => '', 'agin_hall' => '', 'ag_bbin_hall' => '',
                    'ag_og_hall' => '', 'ag_mg_hall' => '', 'ds_hall' => ''];
        try {
            $hall_arr = $this->_clt->getHallLimitBalance($this->_clt_name);
            if (empty($hall_arr) || !is_array($hall_arr)) {
                return $default_data;
            }
            
            return [
                'ag_hall'       =>  $hall_arr['ag_hall'],
                'agin_hall'     =>  $hall_arr['agin_hall'],
                'ag_bbin_hall'  =>  $hall_arr['ag_bbin_hall'],
                'ag_og_hall'    =>  $hall_arr['ag_og_hall'],
                'ag_mg_hall'    =>  $hall_arr['ag_mg_hall'],
                'ds_hall'       =>  $hall_arr['ds_hall']
            ];
        } catch (Exception $e) {
            Yii::error($e->getMessage(), $this->_SYSNAME);
            return $default_data;
        }
    }
}
