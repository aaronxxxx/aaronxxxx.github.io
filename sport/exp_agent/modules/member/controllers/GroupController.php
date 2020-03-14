<?php

namespace app\modules\member\controllers;

use app\common\base\BaseController;
use app\modules\member\models\ar\UserGroup;
use Yii;


class GroupController extends BaseController
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
		$usergroup->group_name='自定義分組';
		$usergroup->group_id=$groupid;
		$usergroup->default_group='否';
		
		$usergroup->save();
		return true;
	}
}