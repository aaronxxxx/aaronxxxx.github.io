<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\message\controllers;

use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use app\modules\core\common\models\ConfigParam;
use Yii;
use yii\base\Exception;

class RegisterController extends BaseController
{

    public function actionIndex() {
        $this->layout = false;
        $model = new ConfigParam();
        $data = $model->loadMessageConfig();
        return $this->render('index', $data);
    }

    public function actionUpdate() {
        try{
            $param = Yii::$app->request->post();
            $model = new ConfigParam();
            $model->updateMessageConfig($param);
            return $this->out(true, null);
        }catch (Exception $e){
            LogUtils::error($e->getMessage());
            return $this->out(false, '更新失败');
        }
    }

}