<?php
namespace app\modules\six\controllers;

use yii\web\Controller;

/**
 * TestController
 */
class TestController extends Controller {
    
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        
        $this->getView()->title = '六合彩-测试';
        // $this->layout = 'main';
    }
    
    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex() {
        $msg = 'Hello, I am Six Module\'s Test Controller index action!';
        // var_dump($msg);
        return $this->render('index', ['msg' => $msg]);
    }
}