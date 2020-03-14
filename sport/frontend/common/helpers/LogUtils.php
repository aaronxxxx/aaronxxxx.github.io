<?php
namespace app\common\helpers;
use Exception;
use Yii;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 9:36
 */
class LogUtils extends Object
{
    public static function trace($message) {
        Yii::trace($message, "casino");
    }

    public static function info($message) {
        Yii::info($message, "casino");
    }

    public static function error($message) {
        Yii::error($message, "casino");
    }

    public static function error_log($exception) {
        if($exception instanceof Exception) {
            error_log(date('Y-m-d H:i:s').' 文件：'.$exception->getFile().' 错误行：'.$exception->getLine().' 错误信息：'.$exception->getMessage()."\r\n", 3, "error.log");
        } else {
            error_log(date('Y-m-d H:i:s').' 错误信息：'.$exception."\r\n", 3, "error.log");
        }
    }
}