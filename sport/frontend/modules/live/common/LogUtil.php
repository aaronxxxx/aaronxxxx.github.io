<?php
namespace app\modules\live\common;

use app\modules\core\common\models\MoneyLog;
use app\modules\live\models\LiveLog;

/**
 * LogUtil 日志操作工具集
 */
class LogUtil {
    /**
     * 操作 money log
     * @param array $params 参数
     * @return boolean true: 成功 false: 失败
     */
    public static function money($op, $params) {
        switch (strtolower($op)) {
            case 'c' : 
                return self::_createMoneyLog($params);
            default : 
                return '';
        }
    }
    
    /**
     * 操作 live log
     * @param array $params 参数
     * @return boolean true: 成功 false: 失败
     */
    public static function live($op, $params) {
        switch (strtolower($op)) {
            case 'c' : 
                return self::_createLiveLog($params);
            default : 
                return '';
        }
    }
    
    /* ============================ 华丽的分割线 =============================== */
    /**
     * 创建money log
     * @param array $params 参数
     * @return boolean      true: 创建成功 false: 创建失败
     */
    private static function _createMoneyLog($params) {
        $log = new MoneyLog();
        
        if ($params['zz_type'] % 2 == 0) {
            $type = $params['live_type'] . '->系统 ' . $params['result'];
        } else {
            $type = '系统->' . $params['live_type'] . ' ' . $params['result'];
        }
        
        $log->user_id = $params['user_id'];
        $log->order_num = $params['billno'];
        $log->about = $params['about'];
        $log->update_time = date('Y-m-d H:i:s', time());
        $log->type = $type;
        $log->order_value = $params['credit'];
        $log->assets = $params['user_assets'];
        $log->balance = $params['user_balance'];
        
        return $log->save();
    }
    
    /**
     * 创建live log
     * @param array $params 参数
     * @return boolean      true: 创建成功 false: 创建失败
     */
    private static function _createLiveLog($params) {
        $log = new LiveLog();
        
        $log->live_type = $params['live_type'];
        $log->zz_type = $params['zz_type'];
        $log->user_id = $params['user_id'];
        $log->live_username = $params['name'];
        $log->zz_money = $params['credit'];
        $log->status = $params['status'];
        $log->result = $params['result'];
        $log->add_time = date('Y-m-d H:i:s', time());
        $log->do_time = date('Y-m-d H:i:s', time());
        $log->order_num = $params['billno'];
        
        return $log->save();
    }
}
