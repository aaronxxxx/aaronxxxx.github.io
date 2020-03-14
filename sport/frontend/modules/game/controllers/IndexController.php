<?php
namespace app\modules\game\controllers;
use Yii;
use yii\web\Controller;
/**
 * IndexController
 */
class IndexController extends Controller {
    private $_assetUrl = '';
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        
        $this->_assetUrl = Yii::$app->getModule('game')->assetsUrl[1];
        $this->getView()->title = '电子游艺';
        $this->layout = false;
    }
    
    /**
     * 默认处理方法
     * @return string
     */
    public function actionIndex() {
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        } else {
            $uid = 0;
        }
        
        $data = [
            'uid' => $uid,
            'assetUrl' => $this->_assetUrl,
        ];

        return $this->render('index', $data);
    }
}