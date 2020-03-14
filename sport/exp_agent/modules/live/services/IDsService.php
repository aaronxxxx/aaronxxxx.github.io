<?php
namespace app\modules\live\services;

/**
 * IDsService 接口类
 */
interface IDsService {
    
    /**
     * 登录
     * @param string $username  用户名
     * @param string $password  密码
     * @param string $nickname  昵称
     * @param string $line      线路
     */
    public function login($username, $password, $nickname, $line);
    
    /**
     * 查询余额
     * @param string $username  用户名
     * @param string $password  密码
     */
    public function queryBalance($username, $password);
    
    /**
     * 存款
     * @param string $username          用户名
     * @param string $password          密码
     * @param string $ref               订单号
     * @param string $amount            金额
     * @param string $live_type         厅标识
     */
    public function deposit($username, $password, $ref, $amount, $live_type);
    
    /**
     * 取款
     * @param string $username          用户名
     * @param string $password          密码
     * @param string $ref               订单号
     * @param string $amount            金额
     * @param string $live_type         厅标识
     */
    public function withdraw($username, $password, $ref, $amount, $live_type);

    /**
     * 查询订单状态
     * @param string $ref   订单号
     */
    public function queryOrderStatus($ref);
}
