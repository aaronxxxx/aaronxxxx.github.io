<?php

namespace app\modules\core\install\controllers;

use app\common\helpers\LogUtils;
use app\modules\core\install\helpers\DBUtils;
use Exception;
use Yii;

class IndexController extends BaseController
{

    /**
     * 安装协议
     * @return string
     */
    public function actionStep1() {
        return $this->render("step1");
    }

    /**
     * 环境检查
     * @return string
     */
    public function actionStep2() {
        $result = $this->checkServer();
        return $this->render("step2", $result);
    }

    /**
     * 数据库建立与设置
     * @return string
     */
    public function actionStep3() {
        $result = $this->checkServer();
        $hasMysql = (boolean) ((boolean)($result['mysqli'][0]) || (boolean)($result['pdo_mysql'][0]));
        return $this->render("step3", [
            'hasMysql' => $hasMysql
        ]);
    }

    /**
     * 安装结果
     * @return string
     */
    public function actionStep4() {
        return $this->render("step4");
    }

    /**
     * 初始化配置环境
     * @return string
     */
    public function actionInitEnv() {
        try {
            $dbname = 'testdb';
            if($this->getParam('server') == null || $this->getParam('port') == null || $this->getParam('dbuser') == null || $this->getParam('dbpwd') == null || $this->getParam('username') == null || $this->getParam('password') == null) {
                return $this->out(false, '请求参数不完整');
            }
            //init db
            $db = new DBUtils();
            $db->CreateDB($this->getParam('server'), $this->getParam('port'), $this->getParam('dbuser'), $this->getParam('dbpwd'), $dbname);
            $db->Open([
                $this->getParam('server'),
                $this->getParam('dbuser'),
                $this->getParam('dbpwd'),
                $dbname,
                $this->getParam('port'),
                true
            ]);
            $c = file_get_contents(Yii::$app->basePath.'/modules/core/install/tpl/db.sql');
            $c = $c."INSERT INTO `sys_manage` VALUES ('1', '".$this->getParam('username')."', '".md5('0z'.md5($this->getParam('password').'w0'))."', '0', '0', '|会员管理|彩票赔率管理|彩票注单管理|彩票结果管理|真人娱乐操作|系统管理|代理管理|消息管理|数据管理|管理员管理|六合彩管理');";
            $db->QueryMulti($c);
            $db->Close();
            //init config
            $dbconfig = file_get_contents(Yii::$app->basePath.'/modules/core/install/tpl/db.php');
            $dbconfig = str_replace('$host', $this->getParam('server'), $dbconfig);
            $dbconfig = str_replace('$port', $this->getParam('port'), $dbconfig);
            $dbconfig = str_replace('$dbname', $dbname, $dbconfig);
            $dbconfig = str_replace('$username', $this->getParam('dbuser'), $dbconfig);
            $dbconfig = str_replace('$password', $this->getParam('dbpwd'), $dbconfig);
            file_put_contents(Yii::$app->basePath.'/config/db.php', $dbconfig);
            $webconfig = file_get_contents(Yii::$app->basePath.'/modules/core/install/tpl/web.php');
            file_put_contents(Yii::$app->basePath.'/config/web.php', $webconfig);
            fopen(Yii::$app->basePath.'/install.lock', 'w');
            return $this->out(true);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return $this->out(false, '初始化环境失败,请检查提交的参数是否正确');
        }
    }

    /**
     * 已安装不能重复安装提示
     * @return string
     */
    public function actionInfo() {
        return $this->render("info");
    }
}