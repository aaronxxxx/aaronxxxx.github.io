<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\deploy\controllers;


use app\common\base\BaseServerController;
use app\modules\general\deploy\services\DeployService;
use app\modules\general\msc\models\ModuleControl;

class IndexController extends BaseServerController
{

    public function actionIndex() {
        $this->addService(new DeployService());
        $this->publish();
    }
}