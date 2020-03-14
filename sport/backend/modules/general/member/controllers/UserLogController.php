<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\modules\general\member\models\UserLogSearch;
use Yii;

class UserLogController extends BaseController
{
    public function actionList() {
        $this->layout = false;
        $searchModel = new UserLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }

}