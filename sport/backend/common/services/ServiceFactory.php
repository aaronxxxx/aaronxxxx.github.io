<?php
namespace app\common\services;

use Yii;
use yii\base\Object;

/**
 * 服务工厂
 * Class ServiceFactory
 * @package app\common\services
 */
class ServiceFactory extends Object
{

    /**
     * 获取服务对象(搜索不到服务返回空对象，否则创建并返回服务实例)
     * @param $moduleName 模块名称
     * @param $serviceName 服务名称
     * @return null|object
     */
    public static function get($moduleName, $serviceName) {
        $id = $moduleName.'.'.$serviceName;
        $hasService = Yii::$app->has($id);
        if(!$hasService) {
            Yii::$app->set($id, Yii::$app->params['services'][$serviceName]);
        }
        return Yii::$app->get($id, false);
    }

}