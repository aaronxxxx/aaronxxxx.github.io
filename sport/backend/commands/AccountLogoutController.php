<?php
/**
 * @auth yang
 * @date 2018-08-30
 * @logout
 */

namespace app\commands;
use Yii;
use yii\console\Controller;
use app\modules\core\passport\controllers\LoginController as ll;

class AccountLogoutController extends Controller{
    public function actionIndex(){
        $db = Yii::$app->db;
        $sql = "DELETE FROM sys_manage_online WHERE logintime < date_sub(now(), interval 14 hour)";
        $db->createCommand($sql)->execute();
        echo '成功';
    }
}
?>