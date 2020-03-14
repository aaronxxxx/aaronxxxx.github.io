<?php
namespace app\controllers;

use app\common\helpers\LogUtils;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

/**Error controller*/
class ErrorController extends Controller
{
    public $layout = false;

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if (property_exists($exception, 'statusCode') && $exception->statusCode == 404) {
                return $this->render('404');
            }
            LogUtils::error_log($exception);
            if (Yii::$app->request->isAjax) {
                return Json::encode([
                    'status' => false,
                    'msg' => '请求接口出错了'
                ]);
            }
            return $this->render('index');
        } else {
            return $this->render('index');
        }
    }
}
