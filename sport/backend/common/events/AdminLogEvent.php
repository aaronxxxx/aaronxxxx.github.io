<?php

namespace app\common\events;

use yii\base\Event;

/**
 * Class AdminLogEvent
 * @package app\common\events
 */
class AdminLogEvent extends Event
{
    //管理员
    public $manage_name;
    //登陆IP
    public $login_ip;
    //登陆时间
    public $login_time;
    //操作内容
    public $edlog;
    //登陆时候产生的guid
    public $session_str;
    //退出时间
    public $logout_time;
    //操作时间
    public $edtime;
    //浏览器标识
    public $runstr = '';
}