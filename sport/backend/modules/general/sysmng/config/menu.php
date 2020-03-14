<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 11:01
 */
return [
    'sort'=>13,
    'title'=>'系统管理',
    'icon'=>'fa-gear',
    'menus' => [
        '系统设置'=>'#/sysmng/config',
        // '版面設置(手機輪播圖)'=>'#/sysmng/banner/&type=手機輪播圖',
        // '版面設置(優惠活動)'=>'#/sysmng/banner/&type=優惠活動',
        '设置汇款信息'=>'#/sysmng/account',
        '第三方支付设置'=>'#/sysmng/pay',
        // '代付设置'=>'#/sysmng/third-party-pay', //暫時不開放
        // '会员等级设置'=>'#/sysmng/level-set'
    ]
];