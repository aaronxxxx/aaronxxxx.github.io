<?php
namespace app\modules\live\services;

/**
 * ISysService 接口类
 */
interface ISysService {
    
    /**
     * 查询指定厅的限额余额
     * @param string $live_type 厅标识
     * @return int              余额
     */
    public function queryHallLimitBalance($live_type);
    
    /**
     * 查询各厅的限额余额
     * @return array
     */
    public function queryAllHallLimitBalance();
}

