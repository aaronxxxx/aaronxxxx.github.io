<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\admin\controllers;

use app\common\base\BaseController;
use app\modules\general\admin\models\ManageLogSearch;
use Yii;

class LogController extends BaseController
{

    public function actionList() {  
        $this->layout = false;
        $searchModel = new ManageLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

}