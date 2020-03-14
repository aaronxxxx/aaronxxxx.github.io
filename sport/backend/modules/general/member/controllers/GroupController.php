<?php

namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\modules\general\member\models\ar\UserGroup;
use Yii;


class GroupController extends BaseController
{
	public function init(){
		parent::init();
		$this->layout=false;//关闭layout页面结构布局
		$this->enableCsrfValidation=false;//关闭csrf验证
	}

	public function actionIndex(){
		$usergroup=UserGroup::find()->orderBy(['id' => SORT_ASC])->asArray()->all();
		return $this->render('index', [
		    'usergroup'=>$usergroup
        ]);
	}

	public function actionSave(){
		$post=Yii::$app->request->post();
		$groupid=$post['group_id'];
		$groupname=$post['group_name'];
		$usergroup=UserGroup::findOne(['group_id'=>$groupid]);
		$usergroup->group_name=$groupname;
		$usergroup->save();
		return true;
	}

	public function actionAddgroup(){

		$groupone=UserGroup::find()->orderBy(['group_id'=>SORT_DESC])->asArray()->one();
		$groupid=$groupone['group_id'];
		$groupid=$groupid+1000;
			
		$usergroup=new UserGroup();
		$usergroup->group_name='自定义分组';
		$usergroup->group_id=$groupid;
		$usergroup->default_group='否';
		
		$usergroup->save();
		return true;
	}
}