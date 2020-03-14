<?php

return [
    'adminEmail' => 'admin@example.com',
    'logActions' => [
        ['action' => 'login/login-handler', 'log' => '管理员登录'],
        ['action' => 'login/logout', 'log' => '管理员登出', 'trigger' => 'before'],
        ['action' => 'admin/online/delete', 'log' => '踢出管理员[{0}][{1}]', 'params' => ['managename', 'sessionstr']],
        ['action' => 'admin/manage/delete', 'log' => '删除了管理员,管理员ID为{0}', 'params' => ['id']],
        ['action' => 'admin/manage/update', 'log' => '编辑了管理员,管理员ID为{0}', 'params' => ['id']],
        ['action' => 'dataset/clean/start', 'log' => '保留这段时间的数据(其余时间段数据删除):[{0}] ~ [{1}]', 'params' => ['startTime','endTime']]
    ]
];