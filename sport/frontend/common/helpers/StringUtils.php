<?php
namespace app\common\helpers;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 9:36
 */
class StringUtils extends Object
{
    public static function format($text, $array = []) {
        $str = preg_replace_callback('/\\{(0|[1-9]\\d*)\\}/', create_function('$match', '$args = '.var_export($array, true).'; return isset($args[$match[1]]) ? $args[$match[1]] : $match[0];'), $text);
        return $str;
    }
}