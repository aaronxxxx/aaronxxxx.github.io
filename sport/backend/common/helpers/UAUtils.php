<?php
namespace app\common\helpers;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 9:36
 */
class UAUtils extends Object
{
    static public function getClientBrowser()
    {
        if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("360SE"))) {
            return "360浏览器";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("360EE"))) {
            return "360极速浏览器";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("theworld"))) {
            return "世界之窗";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("Maxthon"))) {
            return "傲游浏览器";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("TencentTraveler"))) {
            return "腾讯TT";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("QQBrowser"))) {
            return "QQ浏览器";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("MetaSr"))) {
            return "搜狗高速浏览器";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("Alibrowser"))) {
            return "阿里云浏览器";
        } else if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), strtolower("TaoBrowser"))) {
            return "淘宝浏览器";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 8.0")) {
            return "Internet Explorer 8.0";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 7.0")) {
            return "Internet Explorer 7.0";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE 6.0")) {
            return "Internet Explorer 6.0";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "Firefox/3")) {
            return "火狐3";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "Firefox/2")) {
            return "火狐2";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "Chrome")) {
            return "Google Chrome";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "Safari")) {
            return "Safari";
        } else if (strpos($_SERVER["HTTP_USER_AGENT"], "Opera")) {
            return "Opera";
        } else {
            return "未知";
        }
    }
}