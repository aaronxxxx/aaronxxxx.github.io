<?php
namespace app\modules\general\member\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\core\common\models\SysConfig;
use app\modules\core\common\models\UserList;
use app\modules\general\member\models\LoginPwdForm;

/**
 * 会员中心-我的账户（包括 会员修改登陆密码，取款密码操作）
 * IndexController
 */
class IndexController extends BaseController {
    private $_req = null;
    private $_session = null;
    private $_params = null;
    private $_data = [];

    public function init() {
        parent::init();

        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->getView()->title = '会员中心';
        $this->layout = 'main';
    }

    /**
     * 主页
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户信息，传至主页显示
     */
    public function actionIndex(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }

        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(['user_id' => $uid]);
        // $userLevel=Yii::$app->db->createCommand("select * from user_level where level_id = '".$user['level_id']."' order by id asc")->queryOne();
        $user_view = [
            'name' => $user['user_name'],
            'money' => $user['money'],
            'login_time' => $user['logintime'],
            // 'user_level' => $userLevel
        ];

        return $this->render('index', ['user' => $user_view]);
    }

    /**
     * 修改登录密码页面展示与动作
     * 页面展示时返回空字符串，执行操作时返回操作结果
     * @return string
     */
    public function actionModifyLoginPwd(){
        $this->getView()->title = '修改登录密码';
        // $this->layout = false;

        if ($this->_req->isGet) {
            return $this->render('modify-login-pwd', ['msg' => '',]);
        }

        $model = new LoginPwdForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $this->_req->post()
        ];

        if (!$model->load($this->_data) || !$model->validate()) {
            return $this->render('modify-login-pwd', ['msg' => '数据校验失败']);
        }

        $msg = $this->_modifyLoginPwdHandler($model->pwd_old, $model->pwd);

        return $this->render('modify-login-pwd', ['msg' => $msg]);
    }

    /**
     * 修改取款密码页面展示与动作
     * 页面展示时返回空字符串，执行操作时返回操作结果
     * @return string
     */
    public function actionModifyWithdrawPwd(){
        $this->getView()->title = '修改取款密码';
        // $this->layout = false;

        if ($this->_req->isGet) {
            return $this->render('modify-withdraw-pwd', ['msg' => '']);
        }

        $model = new LoginPwdForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $this->_req->post()
        ];
        if (!$model->load($this->_data) || !$model->validate()) {
            return $this->render('modify-withdraw-pwd', ['msg' => '数据校验失败']);
        }
        $msg = $this->_modifyWithdrawPwdHandler($model->pwd_old, $model->pwd);

        return $this->render('modify-withdraw-pwd', ['msg' => $msg]);
    }

    /* ============================ 华丽的分割线 =============================== */
    /**
     * 修改登录密码处理
     * @param string $pwd_old   旧登录密码
     * @param string $pwd       新登录密码
     * @return string           状态提示
     */
    private function _modifyLoginPwdHandler($pwd_old, $pwd) {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return '请先登录再进行操作';
        }
        $sysconfig=SysConfig::find()->select(['add_pass'])->asarray()->one();
        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(
            ['user_id' => $uid, 'user_pass' => md5($pwd_old.$sysconfig['add_pass'])]
        );

        if (!isset($user)) {
            return '旧密码不正确';
        }

        $user->user_pass = md5($pwd.$sysconfig['add_pass']);
        $user->user_pass_naked = $pwd;

        return $user->save() ? '修改成功' : '修改失败';
    }

    /**
     * 修改取款密码处理
     * @param string $pwd_old   旧取款密码
     * @param string $pwd       新取款密码
     * @return string           状态提示
     */
    private function _modifyWithdrawPwdHandler($pwd_old, $pwd) {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return '请先登录再进行操作';
        }

        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(
            ['user_id' => $uid, 'qk_pass' => md5($pwd_old)]
        );

        if (!isset($user)) {
            return '旧取款密码不正确';
        }

        $user->qk_pass = md5($pwd);

        return $user->save() ? '修改成功' : '修改失败';
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaNewAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x42261F, // 背景颜色
                'maxLength' => 4, // 最大显示个数
                'minLength' => 4, // 最少显示个数
                'padding' => 2, // 间距
                'height' => 40, // 高度
                'width' => 106, // 宽度
                'foreColor' => 0xffffff, // 字体颜色
                'offset' => 4, // 设置字符偏移量 有效果
                'transparent' => true, // 显示为透明，当关闭该选项，才显示背景颜色
            ],
        ];
    }
}