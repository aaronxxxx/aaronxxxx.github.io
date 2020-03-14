<?php
namespace app\modules\member\controllers;

use YII;

use app\common\base\BaseController;
use app\modules\member\models\ar\HistoryLogin;

class LoginlogController extends BaseController
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
	
    public function actionIndex($ip)
    {
		$rs=HistoryLogin::find()->where(['ip'=>$ip])->asArray()->all();
		
		$data=['rs'=>$rs,'ip'=>$ip,'username'=>''];
		return $this->render('index',$data);
    }
    public function actionSearch()
    {
    	$post=Yii::$app->request->get();
    	
    	$ipstr=$post['ip'];
    	$usernamestr=$post['username'];
    	
    	$iparr=explode(',', $ipstr);
    	$usernamearr=explode(',', $usernamestr);

    	$history=HistoryLogin::find();
    	
    	if($iparr[0]!==""){
    		$history=$history->andwhere(['ip'=>$iparr]);
    	}
    	if($usernamearr[0]!==""){
    		$history=$history->andWhere(['username'=>$usernamearr]);
    	}
    	
    	$rs=$history->asArray()->all();

    	$data=['rs'=>$rs,'ip'=>$ipstr,'username'=>$usernamestr];
    	return $this->render('index',$data);
    }
}
