<?php
namespace app\modules\member\controllers;

use app\common\base\BaseController;
use app\modules\member\models\ar\UserList;
use Yii;
class MobileController extends BaseController
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
	
    public function actionIndex()
    {		
   		$rs=UserList::find()->select('distinct count(id) AS count,tel')->groupBy('tel')->orderBy(['count'=>SORT_DESC])->asArray()->all();
//     	$rs=UserList::find()->select('distinct count(id) AS count,tel')->groupBy('tel')->orderBy(['count'=>SORT_DESC])->createCommand()->sql;
//     	echo $rs;exit();
    	$data=['rs'=>$rs];
    	return $this->render('index',$data);
    }
}
