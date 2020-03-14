<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\modules\general\member\models\Hacker;

class HackerController extends BaseController
{
    public function actionIndex() {
        $this->layout = false;
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