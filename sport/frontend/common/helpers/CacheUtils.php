<?php
namespace app\common\helpers;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 9:36
 */
class CacheUtils extends Object
{
    public static function headerCache($second = 0) {
        header("Cache-Control: public,max-age=$second");
        header("Pragma: cache");
        $ExpStr = "Expires: ".gmdate("D, d M Y H:i:s", time() + $second)." GMT";
        header($ExpStr);
    }
}