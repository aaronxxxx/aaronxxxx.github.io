<?php
defined('REQUEST_METHOD') or define('REQUEST_METHOD', INPUT_POST);
$cmd = filter_input(REQUEST_METHOD, 'cmd');
$user_name = filter_input(REQUEST_METHOD, 'name');
$user_pwd = filter_input(REQUEST_METHOD, 'pwd');
$yzm = filter_input(REQUEST_METHOD, 'yzm');
$ret = [
    'code' => 1,
    'data' => array(),
    'msg' => '不支持的请求类型'
];
switch (strtolower($cmd)) {
    case 'login' : 
        login_handler($ret);
        break;
    case 'register' : 
        register_handler($ret);
        break;
    default :
        echo json_encode($ret);
}
function login_handler($ret) {
    $ret['code'] = 0;
    $ret['msg'] = '';
    $ret['data'] = [
        'user' => [
            'name' => 'test1',
            'money' => '1000.00',
            'msg_count' => '1'
        ]
    ];
    echo json_encode($ret);
}
function register_handler($ret) {
    $ret['code'] = 0;
    $ret['msg'] = '';
    $ret['data'] = [
        'user' => [
            'name' => 'test2',
            'money' => '2000.00',
            'msg_count' => '2'
        ]
    ];  
    echo json_encode($ret);
}