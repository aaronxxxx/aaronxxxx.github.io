<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\member\controllers;

use app\common\base\BaseController;
use app\modules\member\models\UserLogSearch;
use Yii;

class UserLogController extends BaseController
{
    public function init(){
        parent::init();
        $this->layout='main';//關閉layout頁面結構佈局
        $this->enableCsrfValidation=false;//關閉csrf驗證
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }
        if ( Yii::$app->session['S_AGENT_LEVEL'] == 0 ) {
            return $this->redirect('/?r=agent/index/list');
        }
	}
    public function actionList() {

        $searchModel = new UserLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }

}