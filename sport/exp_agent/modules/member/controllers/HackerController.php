<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\member\controllers;

use app\common\base\BaseController;
use app\modules\member\models\Hacker;

class HackerController extends BaseController
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
    
    public function actionIndex() {
        return $this->render('index',[
            'list' => Hacker::find()->asArray()->all(),
            'userName' => $this->getParam('user_name')
        ]);
    }

    public function actionCreate() {
    	$this->layout = false;
    	return $this->render('create');
    }
    public function actionAdd() {
    	$userarea = $this->getParam('userarea');
        if($userarea != null && $userarea != "") {
            $userlist=explode("\n", $userarea);
            foreach($userlist as $key=>$value){
                if($value != null && $value != "") {
                    $hacker=new Hacker();
                    $hacker->name=$value;
                    $hacker->save();
                }
            }
        }
        return true;
    }
}