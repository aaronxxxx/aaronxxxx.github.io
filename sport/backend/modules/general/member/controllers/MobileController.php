<?php
namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\modules\general\member\models\ar\UserList;

class MobileController extends BaseController
{
	public function init(){
		parent::init();
		$this->layout=false;//关闭layout页面结构布局
		$this->enableCsrfValidation=false;//关闭csrf验证
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
