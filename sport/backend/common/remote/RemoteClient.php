<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/27
 * Time: 17:16
 */

namespace app\common\remote;

use Hprose\Http\Client;
use Yii;

class RemoteClient extends Client
{
    public function __construct($key, $async = false)
    {
        $url = Yii::$app->params['services'][$key];
        parent::__construct($url, $async);
    }
}