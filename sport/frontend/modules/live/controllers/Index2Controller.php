<?php
namespace app\modules\live\controllers;

use Yii;
use yii\web\Controller;

/**
 * IndexController
 */
class Index2Controller extends Controller {

    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();

        $this->getView()->title = '真人娱乐';
        $this->layout = false;
    }

    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex2() {
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        } else {
            $uid = 0;
        }

        return $this->render('index2', ['uid' => $uid]);
    }
}