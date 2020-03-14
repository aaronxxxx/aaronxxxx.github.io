<?php
namespace app\modules\live\services;

/**
 * IAgService 接口类
 */
interface IAgService {
    
    /**
     * 登录
     * @param string $cagent    代理标识
     * @param string $actype    操作类型, 0: 试玩 1: 真钱
     * @param string $gametype  游戏类型
     * @param string $username  用户名
     * @param string $password  密码
     * @param string $flash_id  游戏标识
     */
    public function login($cagent, $actype, $gametype, $username, $password, 
            $flash_id = '');
    
    /**
     * 查询余额
     * @param string $cagent    代理标识
     * @param string $actype    操作类型, 0: 试玩 1: 真钱
     * @param string $username  用户名
     * @param string $password  密码
     */
    public function queryBalance($cagent, $actype, $username, $password);
    
    /**
     * 存款
     * @param string $cagent            代理标识
     * @param string $actype            操作类型, 0: 试玩 1: 真钱
     * @param string $billno            注单号
     * @param string $credit            金额
     * @param string $live_type         厅标识
     * @param string $username          用户名
     * @param string $password          密码
     */
    public function deposit($cagent, $actype, $billno, $credit, $live_type, 
            $username, $password);
    
    /**
     * 取款
     * @param string $cagent            代理标识
     * @param string $actype            操作类型, 0: 试玩 1: 真钱
     * @param string $billno            注单号
     * @param string $credit            金额
     * @param string $live_type         厅标识
     * @param string $username          用户名
     * @param string $password          密码
     */
    public function withdraw($cagent, $actype, $billno, $credit, $live_type, 
            $username, $password);
    
    /**
     * 查询订单状态
     * @param string $cagent            代理标识
     * @param string $billno            注单号
     * @param string $actype            操作类型, 0: 试玩 1: 真钱
     */
    public function queryOrderStatus($cagent, $billno, $actype);
}
