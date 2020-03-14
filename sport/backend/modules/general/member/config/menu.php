<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 11:01
 */
return [
    'sort'=>1,
    'title'=>'会员管理',
    'icon'=>'fa-user',
    'menus' => [
        [
            '会员列表'=>'#/member/index',
            '会员日志'=>'#/member/user-log/list',
        ],
        '会员存/取/汇款'=>'#/finance/fund/look-money&type=0',
        '会员存款交易记录'=>'#/member/transaction/deposit-log',
        '会员组列表'=>'#/member/group',
        '历史银行信息'=>'#/member/historybank/list',
        '黑名单列表'=>'#/member/hacker/index',
        // '会员彩票诱彩设定'=>'#/member/index/lure-lottery',
    ]
];