<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 11:01
 */
return [
    'sort'=>9,
    'title'=>'消息管理',
    'icon'=>'fa-commenting-o',
    'menus' => [
        [
            '公告管理'=>'#/message/bulletin/index',
            '站内消息'=>'#/message/user/index',
        ],
        [
            '注册消息'=>'#/message/register/index',
            '消息列表'=>'#/message/user/list',
        ],
        [
            '站内公告'=>'#/message/bulletin/list',
        ],

    ]
];