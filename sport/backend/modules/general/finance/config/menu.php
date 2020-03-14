<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 11:01
 */
return [
    'sort'=>10,
    'title' => '财务管理',
    'icon' => 'fa-cny ',
    'menus' => [
        [
            '存款管理' => '#/finance/fund/money-save&status=在线支付',
            '提款管理' => '#/finance/fund/tixian&status=成功',
        ],
            '汇款管理' => '#/finance/default/huikuan&status=成功',
            '会员存/取/汇款' => '#/finance/fund/look-money&type=0',

            '加款扣款' => '#/finance/default/index',
            '财务日志' => '#/finance/default/finance-log',

       
    ]
];
