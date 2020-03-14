<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SysManage;
use app\common\controllers\BaseController;

/* * Index controller */

class IndexController extends BaseController {

    public $code;

    public function init() {//初始化函数
        parent::init();
    }

    public function actionIndex() {//网站(默认)主页)
        return $this->render('index');
    }

}
