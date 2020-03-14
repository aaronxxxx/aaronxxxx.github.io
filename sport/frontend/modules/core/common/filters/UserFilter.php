<?php
namespace app\modules\core\common\filters;

use app\modules\core\common\models\UserList;
use Yii;
use yii\helpers\Json;

class UserFilter extends \yii\base\ActionFilter
{

    public function beforeAction($action)
    {
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
            $result = UserList::isyichang($userid);
            if($result == 2){
                echo Json::encode([
                    'status' => false,
                    'msg' => '账户资金异常'
                ]);
                exit;
            }
        }
        return parent::beforeAction($action);
    }

}