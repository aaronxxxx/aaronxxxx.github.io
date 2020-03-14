<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\member\controllers;

use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use app\modules\member\models\ar\HistoryBank;
use app\modules\member\models\UserList;
use Exception;
use Yii;

class HistorybankController extends BaseController
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
        $historyBank = new HistoryBank();
        $id = $this->getParam('id');
        if($id != null) {
            $historyBank = $this->findModel($historyBank, $id);
        }
        return $this->render('index',[
            'historyBank' => $historyBank
        ]);
    }

    public function actionList() {
        $usernames = $this->getParam('usernames');
        if(empty($usernames)) {
            $list = HistoryBank::find()->limit(100)->asArray()->all();
        } else {
            $list = HistoryBank::find()->where([
                'username'=>explode(",", $usernames)
            ])->asArray()->all();
        }
        return $this->render('list', [
            'list'=>$list,
            'usernames'=>$usernames
        ]);
    }

    public function actionSave() {
        try{
            $historyBank = new HistoryBank();
            $id = $this->getParam('id');
            if($id != null) {
                $historyBank = $this->findModel($historyBank, $id);
            }
            $uid = null;
            $params = Yii::$app->request->post();
            if($this->getParam('username') != null) {
                $user = UserList::findOne(['user_name' => $this->getParam('username')]);
                if($user != null) {
                    $uid = $user->user_id;
                }
            }
            if($uid == null) {
                return $this->out(false, '會員不存在');
            }
            $params['uid'] = $uid;
            $historyBank->load($params, '');
            $historyBank->save();
            return $this->out(true, '保存成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '保存失敗');
        }
    }

}