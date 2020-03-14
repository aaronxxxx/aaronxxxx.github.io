<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use app\modules\general\member\models\ar\HistoryBank;
use app\modules\general\member\models\UserList;
use Exception;
use Yii;

class HistorybankController extends BaseController
{
    public $layout = false;

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
                return $this->out(false, '会员不存在');
            }
            $params['uid'] = $uid;
            $historyBank->load($params, '');
            $historyBank->save();
            return $this->out(true, '保存成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '保存失败');
        }
    }

}