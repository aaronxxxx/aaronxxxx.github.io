<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 11:01
 */
return [
    'sort'=>11,
    'title' => '报表管理',
    'icon' => 'fa-bar-chart',
    'menus' => [
        [
            '报表明细'=>'#/report/index/index&user_group=&user_ignore_group=',
        ],
        [
            '金额明细'=>'#/report/money/index',
        ],
        [
            '彩票明细'=>'#/report/lottery/index&user_group=&user_ignore_group=',
        ],
        // [
        //     '六合彩明细'=>'#/report/statement/six-detail&user_in=&user_nin=',
        // ],
        [
            '极速六合彩明细'=>'#/report/spsix/six-detail&user_in=&user_nin=',
        ],
        '真人与游艺明细'=>'#/report/live-history/index&user_group=&user_ignore_group=',
    ]
];
