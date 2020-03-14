<?php

namespace app\modules\general\mobile\controllers;

use app\modules\core\common\models\UserList;
use app\modules\general\member\models\ar\SysConfig;
use Yii;
use app\common\base\BaseController;

/**
 * 交易记录-真人投注记录
 * LiveController
 */
class QuotaController extends BaseController {
    private $_session = null;
    private $_params = null;

    public function init() {
        parent::init();

        $this->getView()->title = '手机界面';
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->layout = 'game';
    }

    /**
     * 真人投注（额度转换）页面
     * @return string
     */
    public function actionIndex(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script language="javascript" charset="utf-8">';
            echo 'alert("对不起请先登陆！");window.location.href="/?r=mobile/disp/login"';
            echo '</script>';
            return false;
        }

        $data = [
            'user' => ['name' => '', 'money' => ''],
            'min_limit' => $this->_getMinimumChangeLimit()
        ];

        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->render('index', $data);
        }

        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(['user_id' => $uid]);
        if (empty($user)) {
            return $this->render('index', $data);
        }

        $data['user'] = [
            'name' => $user['user_name'],
            'money' => $user['money'],
        ];
        return $this->render('index',['data'=>$data]);
    }

    /**
     * 获取最小转账金额限制
     * @return int  限制值
     */
    private function _getMinimumChangeLimit() {
        $sys_config = SysConfig::find()->one();

        if (empty($sys_config)) {
            return 999999;
        }

        return (int)$sys_config['min_change_money'];
    }



}
