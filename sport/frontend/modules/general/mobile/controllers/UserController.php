<?php
namespace app\modules\general\mobile\controllers;

use app\common\helpers\IpUtils;
use app\modules\core\common\models\AgentsList;
use app\modules\core\common\models\ConfigP;
use app\modules\core\common\models\HistoryLogin;
use app\modules\core\common\models\LoginState;
use app\modules\core\common\models\SysConfig;
use app\modules\core\common\models\UserMsg;
use app\modules\core\passport\models\UserLog;
use app\modules\general\mobile\models\LoginForm;
use app\modules\general\mobile\models\LoginPwdForm;
use app\modules\general\mobile\models\MobileRegisterForm;
use app\modules\general\mobile\models\user\UserList;
use Yii;
use app\common\base\BaseController;

/**
 * IndexController
 */
class UserController extends BaseController {
    private $_data = [];
    private $_resp = [];
    private $_session = null;
    private $_params = null;
    public $enableCsrfValidation = false;
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        LoginState::Check();
        $this->getView()->title = '手机登陆注册页面';
        $this->layout = 'member';
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->_resp = [
            'code' => 0,
            'msg' => '',
			'url'=>''
        ];
    }

    /**
    *登陆操作
    */
    public function actionDoLogin(){
        $postNews = Yii::$app->request->post();
        $model = new LoginForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews
        ];

        if (!$model->load($this->_data) || !$model->validate()) {
            $this->_resp['code'] = 1;
            $msg = $model->getErrors();
            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    $this->_resp['msg'] = $value;                               //返回表单验证的错误信息
                    return json_encode($this->_resp);
                }
            }
        }
        $name = $postNews['name'];
        $pwd = $postNews['pwd'];
        $sysconfig=SysConfig::find()->select(['add_pass'])->asarray()->one();
        $data = UserList::find()
                ->where(['user_name' => $name, 'user_pass' => md5($pwd.$sysconfig['add_pass'])])
                ->one();

        if (!isset($data)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '用户名或密码错误';
            return json_encode($this->_resp);;
        }
        if ($data['status'] != '正常') {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '该用户已经被停用！请联系客服';
            return json_encode($this->_resp);
        }
        $str = time('s');
        $oid = strtolower(substr(md5($str), 0, 10) . substr(md5($name), 0, 10) . 'hh' . rand(0, 9));
        $iipp=$this->_get_real_ip();
        $loginurl = 'http://'.$_SERVER['HTTP_HOST'];
        $data->Oid = $oid;
        $data->device_type = 1;
        $data->loginip = $iipp;
        $data->logintime = date('Y-m-d H:i:s');
        $data->OnlineTime = date('Y-m-d H:i:s');
		$data->logouttime = date('Y-m-d H:i:s');
        $data->online = '1';
        $data->loginurl = $loginurl;
        $this->_resp['url']=(isset($postNews['gourl']))?$postNews['gourl']:'';//登入后返回的url
        $this->_resp['url']=str_replace('[]','/?r=',$this->_resp['url']);
        $this->_resp['url']=str_replace('{}','&',$this->_resp['url']);
        if(isset($postNews['talk_user'])&&!empty($postNews['talk_user'])&&empty($data['auth_talk'])){
            $data->auth_talk = $postNews['talk_user'];
        }
        $data->save();
        // 添加用户登入日志
        $userlog=new UserLog();

        $userlog->user_id=$data['user_id'];
        $userlog->Oid=$oid;
        $userlog->user_name=$name;
        $userlog->login_ip=$iipp;
        $userlog->edlog='会员 登入';
        $userlog->edtime=date('Y-m-d H:i:s');
        $userlog->login_url=$loginurl;
        $userlog->save();

        $history = new HistoryLogin();
        $history->uid = $data['user_id'];;
        $history->username = $name;
        $history->ip = $iipp;
        $history->ip_address = IpUtils::convertip($iipp);;
        $history->login_time = date('Y-m-d H:i:s');
        $history->www = $loginurl;
        $history->save();

		LoginState::add($data['user_id'],$oid);
        return json_encode($this->_resp);
    }

    /**
     * 退出登录
     */
    public function actionLogout() {
		$cookies=Yii::$app->response->cookies;
		$cookies->remove('uid');
		$cookies->remove('oid');
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/index');
        }
        $user_id = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $data = UserList::find()
                ->where(['user_id' => $user_id])
                ->one();
        $data->Oid = '';
        $data->online = '0';
        $data->logouttime = date('Y-m-d H:i:s');
        $data->save();
        Yii::$app->session->remove(Yii::$app->params['S_USER_ID']);

        return $this->redirect('/?r=mobile/disp/index');
    }

    /**
     * 用户信息页面
     */
    public function actionUserNews(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script language="javascript" charset="utf-8">';
            echo 'alert("对不起请先登陆！");window.location.href="/?r=mobile/disp/login"';
            echo '</script>';
        }
        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(['user_id' => $uid]);
        return $this->render("usernews",['user'=>$user]);
    }
     /**
     * 会员大厅
     */
    public function actionUserHall(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script language="javascript" charset="utf-8">';
            echo 'alert("对不起请先登陆！");window.location.href="/?r=mobile/disp/login"';
            echo '</script>';
        }
        $uid = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::findOne(['user_id' => $uid]);
        return $this->render("userhall",['user'=>$user]);
    }





    public function actionUpdatePwd(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $getNews = Yii::$app->request->get();
        if($getNews['code'] == 1){
            $data = [
                'title' => '登陆密码修改',
                'code'=>1,
            ];
        }
        if($getNews['code'] == 2){
            $data = [
                'title' => '取款密码修改',
                'code'=>2
            ];
        }
        return $this->render('updatepwd', ['data'=>$data]);
    }

    /**
     * 会员密码修改
     */
    public function actionDoUpdatePwd(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script language="javascript" charset="utf-8">';
            echo 'alert("对不起请先登陆！");window.location.href="/?r=mobile/disp/login"';
            echo '</script>';
        }
        $this->_resp = [
                'code' => 0,
                'msg' => '',
            ];
        $uid = $this->_session[$this->_params['S_USER_ID']];
        $postNews = Yii::$app->request->post();

        $model = new LoginPwdForm();

        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews
        ];
        if (!$model->load($this->_data) || !$model->validate()) {
            $this->_resp = [
                'code' => 1,
                'msg' => '数据校验失败',
            ];
            return json_encode($this->_resp);
        }
        $getNews = Yii::$app->request->get();
        $pwd_old = $postNews['oldLoginpwd'];
        $pwd = $postNews['pwd'];
        $sysconfig=SysConfig::find()->select(['add_pass'])->asarray()->one();
        if($getNews['code'] == 1){                                              //修改登陆密码
            $user = UserList::findOne(
                ['user_id' => $uid, 'user_pass' => md5($pwd_old.$sysconfig['add_pass'])]
            );
            if (!isset($user)) {
                $this->_resp = [
                    'code' => 1,
                    'msg' => '旧密码不正确',
                ];
                return json_encode($this->_resp);
            }
            $user->user_pass = md5($pwd.$sysconfig['add_pass']);
            $user->user_pass_naked = $pwd;
            $user->save();
        }
        if($getNews['code'] == 2){                                              //修改取款密码
            $user = UserList::findOne(
                ['user_id' => $uid, 'qk_pass' => md5($pwd_old)]
            );
            if (!isset($user)) {
                $this->_resp = [
                    'code' => 1,
                    'msg' => '旧密码不正确',
                ];
                return json_encode($this->_resp);
            }
            $user->qk_pass = md5($pwd);
            $user->save();
        }
        return json_encode($this->_resp);
    }

    /**
     * 注册
     */
    public function actionRegister()
    {
        $postNews = Yii::$app->request->post();

        if (! strstr($postNews['pararms'],'agree')) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = '请勾选开户协议！';

            return json_encode($this->_resp);
        }

        $iipp = $this->_get_real_ip();
        $r = UserList::registToManay($iipp);

        if ($r['today_count'] && $r['today_count'] > 9) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = '抱歉!请不要频繁注册用户。请联系管理员';

            return json_encode($this->_resp);
        }

        $model = new MobileRegisterForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews
        ];

        if (!$model->load($this->_data) || !$model->validate()) {
            $this->_resp['code'] = 1;
            $msg = $model->getErrors();

            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    $this->_resp['msg'] = $value;                               //返回表单验证的错误信息
                    return json_encode($this->_resp);
                }
            }
        }

        $rs = UserList::existUsername($postNews['name']);

        if (! empty($rs)) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = '该用户名已经存在！';

            return json_encode($this->_resp);
        }

        $this->_registerHandler($model);

        return json_encode($this->_resp);
    }

    /**
     * 注册处理器
     */
    private function _registerHandler($form)
    {
        $top_id = Yii::$app->session[Yii::$app->params['S_AGENT_ID']] ? Yii::$app->session[Yii::$app->params['S_AGENT_ID']] : 0;

        if (isset($form['agent_name'])) {
            $server_name = $this->_prefix_url();
            $data = AgentsList::find()
                ->where(['like', 'agent_url', $server_name])
                ->one();

            $top_id = isset($data["id"]) && $data["id"] ? $data["id"] : 0;
            $sum_top_id = isset($data["agent_level"]) && $data["agent_level"] ? $data["agent_level"] : 0;
        }

        if (! empty($form['agent_name'])) {
            $agents = AgentsList::find()
                ->where(["agents_name" => $form['agent_name']])
                ->one();

            $top_id = $agents['id'];
            $sum_top_id = $agents['agent_level'];
        }

        //指定為平台下層
        if ($top_id == 0) {
            $top_id = 109;
            $sum_top_id = 105;
        }

        $username = $form['name'];
        $pwd = $form['pwd'];
        $sysconfig = SysConfig::find()->select(['add_pass'])->asarray()->one();
        $md5pwd = md5($pwd.$sysconfig['add_pass']);
        $str = time('s');
        $oid = strtolower(substr(md5($str), 0, 10) . substr(md5($username), 0, 10) . 'hh' . rand(0, 9));
        $user_id = $this->_get_user_id();
        $iipp= $this->_get_real_ip();
        $address = IpUtils::convertip($iipp);
        $loginurl = 'http://' . $_SERVER['HTTP_HOST'];
        $regurl = 'http://' . $_SERVER['HTTP_HOST'];
        $userlist = new UserList;
        $userlist->user_id = $user_id;
        $userlist->Oid = $oid;
        $userlist->device_type = 1;
        $userlist->user_name = $username;
        $userlist->user_pass = $md5pwd;
        $userlist->user_pass_naked = $pwd;
        $userlist->sum_top_id = $sum_top_id;
        $userlist->qk_pass = md5($form['withdraw_pwd']);
        $userlist->pay_name = $form['real_name'];
        $userlist->top_id = $top_id;
        $userlist->tel = $form['phone'];
        $userlist->email = $form['email'];
        $userlist->loginip = $iipp;
        $userlist->regip = $iipp;
		$userlist->qq = $form['qq'];
        $userlist->logintime = date('Y-m-d H:i:s');
        $userlist->OnlineTime = date('Y-m-d H:i:s');
		$userlist->logouttime = date('Y-m-d H:i:s');
        $userlist->regtime = date('Y-m-d H:i:s');
		$userlist->lognum = '1';
        $userlist->online = '1';
        $userlist->group_id = '553';
        $userlist->loginurl = $loginurl;
        $userlist->regurl = $regurl;
        // $userlist->mz = md5($form['real_name']);
        $userlist->trade_type = $form['trade_type'];
        $userlist->save();
        $enable = $title = $content = '';
        $configP = ConfigP::getConfig();

        if ($configP) {
            $form = $title = $content = '';

            foreach ($configP as $key => $val) {
                if ($val['parameter_key'] == "REGSTER_ENABLE") {
                    $enable = $val['parameter_value'];
                } elseif ($val['parameter_key'] == "REGSTER_TITLE") {
                    $title = $val['parameter_value'];
                } elseif ($val['parameter_key'] == "REGSTER_CONTENT") {
                    $content = $val['parameter_value'];
                } elseif ($val['parameter_key'] == "REGSTER_FROM") {
                    $form = $val['parameter_value'];
                }
            }

            if ($enable == "on") {
                UserMsg::msg_add($user_id, $form, $title, $content);
            }
        }

        $history = new HistoryLogin();
        $history->uid = $userlist['user_id'];;
        $history->username = $username;
        $history->ip = $iipp;
        $history->ip_address = $address;
        $history->login_time = date('Y-m-d H:i:s');
        $history->www = $loginurl;
        $history->save();
        $this->_resp['data']['user'] = [
            'name' => $username,
            'money' => 0,
            'msg_num' => 0
        ];
        LoginState::add($user_id, $oid);
    }

    /**
     * 分割访问域名
     * @return type
     */
    function _prefix_url(){
        $s = !isset($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';

        $protocol = strtolower($_SERVER['SERVER_PROTOCOL']);
        $protocol = substr($protocol,0,strpos($protocol,'/')).$s.'://';

        $port     = ($_SERVER['SERVER_PORT']==80) ? '' : ':'.$_SERVER['SERVER_PORT'];

        $server_name = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'].$port :
            getenv('SERVER_NAME').$port;
        return $server_name;
    }

    /**
     * 获得一个唯一的 user_id（注册动作时调用）
     * @return type
     */
    function _get_user_id() {
		$id = UserList::find()->select('id')->orderBy('id desc')->asArray()->one();
        $user_id = $id['id'] + 1;
        $data = UserList::find()
                ->where(['user_id' => $user_id])
                ->one();
        while ($data['user_id'] != NULL) {
            list($tmp1, $tmp2) = explode(' ', microtime());
            $m = sprintf('%.0f', (floatval($tmp1) + floatval($tmp2)) * 1000);
            $m = substr($m,5);
            $user_id = $id['id'] + $m;
			$data = UserList::find()
                ->where(['user_id' => $user_id])
                ->one();
        }
        return $user_id;
    }

    function _get_real_ip(){
        if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) /* 存在 X-Forwarded-For 吗? */
            return $_SERVER['REMOTE_ADDR']; /* 兼容已有程序 */
        return explode(',',$_SERVER['HTTP_X_FORWARDED_FOR'])[0]; /* 返回用户真实 IP, 如为多个 IP 时, 则取第一个 */
    }
    /**
     * 优惠活动
     */
    function actionPromotions(){
        $this->layout = 'member';
		return $this->render('promotions');
    }
}