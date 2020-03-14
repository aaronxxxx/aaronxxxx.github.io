<?php
namespace app\modules\pay\controllers;

use app\common\base\BaseServerController;
use app\modules\pay\services\PayService;

class IndexController extends BaseServerController{
    public function actionIndex() {
        $this->addService(new PayService());
        $this->publish();
    }
}