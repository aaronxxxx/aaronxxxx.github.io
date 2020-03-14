<?php

namespace app\modules\six\controllers;

use app\common\base\BaseController;
use yii\web\Controller;
/**
 * 六合彩规则
 */
class RuleController extends BaseController  {
    
    public function actionRule(){
        $this->layout = false;
        return $this->render('BetView');
    }
}

