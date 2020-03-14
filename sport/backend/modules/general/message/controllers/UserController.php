<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\message\controllers;


use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use app\modules\general\member\models\UserGroup;
use app\modules\general\member\models\UserList;
use app\modules\general\member\models\UserMsg;
use app\modules\general\message\models\UserMsgSearch;
use Yii;
use yii\base\Exception;

class UserController extends BaseController
{

    public function actionIndex() {
        $this->layout = false;
        $userGroups = UserGroup::getUserGroupList();
        return $this->render('index', [
            'userGroups' => $userGroups
        ]);
    }

    public function actionAdd() {
        try{
            $param = Yii::$app->request->post();
            $userList = null;
            if(isset($param['type'])) {
                if($param['type'] == "all") {
                    $userList = UserList::find()->all();
                } else if($param['type'] == "user_g") {
                    $userList = UserList::findAll([
                        'group_id' => $param['group']
                    ]);
                } else if($param['type'] == "login") {
                    $userList = UserList::findAll([
                        'online' => '1'
                    ]);
                }
            } else {
                $usernames = explode(',',rtrim(trim($param['user_name']),','));
                $userList = array();
                for ($i=0; $i<count($usernames);$i++) {
                    $username = $usernames[$i];
                    $user = UserList::findOne([
                        'user_name' => $username
                    ]);
                    $userList[$i] = $user;
                }
            }
            if($userList != null) {
                foreach ($userList as $user) {
                    $model = new UserMsg();
                    $model->user_id = $user->user_id;
                    $model->msg_from = $param['msg_from'];
                    $model->msg_title = $param['msg_title'];
                    $model->msg_info = $param['msg_info'];
                    $model->save();
                }
            }
            return $this->out(true, null);
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '发布失败');
        }
    }

    public function actionList() {
        $this->layout = false;
        $searchModel = new UserMsgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

}