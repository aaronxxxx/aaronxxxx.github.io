<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 11:01
 */
return [
    'sort'=>8,
    'title' => '代理管理',
    'icon' => 'fa-eye',
    'menus' => [
            '總代理列表' => '#/agent/sum-index/list',
            '總代理報表' => '#/agent/report/sum-index',
            '總代理匯款' => '#/agent/default/index',
            '總代理匯款日誌' => '#/agent/default/huikuan',
            '代理列表' => '#/agent/index/list',
            '代理报表' => '#/agent/report/index',
            '代理存取报表' => '#/agent/cqk/index&user_group=&user_ignore_group=',
            '公司總報表' => '#/agent/report/sum-report',
            '請款申請' => '#/agent/cash/index',
            '請款申請交易纪录' => '#/agent/cash/log',
    ]
];
