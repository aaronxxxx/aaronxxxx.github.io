<?php
namespace app\modules\core\common\filters;

use app\modules\core\common\models\UserList;
use Yii;
use yii\helpers\Json;

class LoginFilter extends \yii\base\ActionFilter
{

    public function beforeAction($action)
    {
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
            $oid = Yii::$app->session[Yii::$app->params['S_USER_OID']];
            //更新用户最后操作时间
            $data = UserList::find()->where(['user_id' => $userid])->one();
            if($data){
                $data->logouttime = date('Y-m-d H:i:s');
                $data->save();
            }
            if($oid != $data['Oid']){
                Yii::$app->session->remove(Yii::$app->params['S_USER_ID']);
                Yii::$app->session->remove(Yii::$app->params['S_USER_OID']);
                echo Json::encode([
                    'status' => false,
                    'msg' => '异地登录'
                ]);
                exit;
            }
        } else {
            echo Json::encode([
                'status' => false,
                'msg' => '未登录，请先登录'
            ]);
            exit;
        }
        return parent::beforeAction($action);
    }

}