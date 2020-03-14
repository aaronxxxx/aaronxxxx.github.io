<?php
namespace app\modules\general\member\controllers;

use YII;

use app\common\base\BaseController;
use app\modules\general\member\models\ar\HistoryLogin;

class LoginlogController extends BaseController
{
	public function init(){
		parent::init();
		$this->layout=false;//关闭layout页面结构布局
		$this->enableCsrfValidation=false;//关闭csrf验证
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
