<?php
namespace app\modules\core\passport\controllers;

use app\common\base\BaseController;
use app\modules\core\common\models\SysConfig;

class CloseController extends BaseController
{
     public function actionIndex(){
         $this->layout = false;
         $sysConfig = SysConfig::find()->one();
         $endCloseTime = '';
         if(!empty($sysConfig) && !empty($sysConfig['end_close_time'])) {
             $endCloseTime = $sysConfig['end_close_time'];
         }
         return $this->render('index', [
             'endCloseTime' => $endCloseTime
         ]);
     }
}
