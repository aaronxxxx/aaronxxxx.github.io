<?php
namespace app\modules\live\util;

use app\modules\live\services\impl\AgService;
use app\modules\live\services\impl\DsService;
use app\modules\live\services\impl\SysService;
use app\modules\live\models\LiveConfig;
use app\modules\live\models\LiveRpcConfig;

/**
 * LiveServiceUtil 真人服务操作工具集
 */
class LiveServiceUtil {
    
    private static $_folder_name = 'server1';
    
    /**
     * 获取所有Live Service实例
     * @return array
     */
    public static function getAllLiveHallService() {
        $rpc_config = LiveRpcConfig::find()->one();
        
        if (empty($rpc_config)) {
            return ;
        }
        
        $live_config = self::_getAllLiveHallConfig('AG', 'DS');
        
        $server = 'http://' . $rpc_config['rpc_server_domain'];  // http://ademoka1266.com/
        $client_name = $rpc_config['rpc_client_name'];	// y12007
        
        $ag_server_url = str_replace(self::$_folder_name, $rpc_config['rpc_server_folder'], $rpc_config['ag_server_class']);   //server1 //y12007.com  // /RpcCenter/Server/server1/Service/live/AgServer.php
        $ag_deposit_name = $live_config['AG']['deposit_name'];	//IN
        $ag_withdraw_name = $live_config['AG']['withdraw_name']; //OUT
        
        $ds_server_url = str_replace(self::$_folder_name, $rpc_config['rpc_server_folder'], $rpc_config['ds_server_class']);   //server1 //y12007.com  // /RpcCenter/Server/server1/Service/live/DsServer.php
        $ds_deposit_name = $live_config['DS']['deposit_name'];
        $ds_withdraw_name = $live_config['DS']['withdraw_name'];

        // http://ademoka1266.com/RpcCenter/Server/y12007.com/Service/live/AgServer.php
        return [
            'ag_srv' => new AgService($server.$ag_server_url, $client_name, 
                    $ag_deposit_name, $ag_withdraw_name),
            'ds_srv' => new DsService($server.$ds_server_url, $client_name, 
                    $ds_deposit_name, $ds_withdraw_name),
        ];
    }
    
    /**
     * 获取Live Sys Service实例
     * @return array
     */
    public static function getSysService() {
        $rpc_config = LiveRpcConfig::find()->one();
        
        if (empty($rpc_config)) {
            return ;
        }

        $server = 'http://' . $rpc_config['rpc_server_domain'] . $rpc_config['sys_server_class'];
        $client_name = $rpc_config['rpc_client_name'];

        return new SysService($server, $client_name);
    }
    
    /* ============================ 华丽的分割线 =============================== */
    /**
     * 获取各厅真人配置
     * @param string $ag_live_type AG厅标识
     * @param string $ds_live_type DS厅标识
     * @return array
     */
    private static function _getAllLiveHallConfig($ag_live_type, $ds_live_type) {
        return [
            $ag_live_type => self::_getLiveConfigByLiveType($ag_live_type),
            $ds_live_type => self::_getLiveConfigByLiveType($ds_live_type),
        ];
    }
    
    /**
     * 获取指定厅真人配置
     * @param string $live_type 厅标识
     * @return array
     */
    private static function _getLiveConfigByLiveType($live_type) {
        $data = LiveConfig::findOne(['live_type' => $live_type, 'pid' => 0]);
        
        return empty($data) ? [] : $data;
    }
}
