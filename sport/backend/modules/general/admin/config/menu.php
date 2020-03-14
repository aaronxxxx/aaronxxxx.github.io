<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/4
 * Time: 11:01
 */
return [
    'sort'=>12,
    'title'=>'管理员管理',
    'icon'=>'fa-globe',
    'menus'=> [
        [
            '管理员列表'=>'#/admin/manage/list',
            '管理员日志'=>'#/admin/log/list',
        ],
        '在线管理员'=>'#/admin/online/list',
    ]
];