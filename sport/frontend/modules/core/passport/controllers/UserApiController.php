<?php
namespace app\modules\core\passport\controllers;

use app\common\base\BaseController;
use app\common\helpers\IpUtils;
use app\modules\core\common\models\AgentsList;
use app\modules\core\common\models\ConfigP;
use app\modules\core\common\models\HistoryLogin;
use app\modules\core\common\models\LoginState;
use app\modules\core\common\models\SysConfig;
use app\modules\core\common\models\UserList;
use app\modules\core\common\models\UserMsg;
use app\modules\core\passport\models\AgentsRegisterForm;
use app\modules\core\passport\models\Hacker;
use app\modules\core\passport\models\LoginForm;
use app\modules\core\passport\models\RegisterForm;
use app\modules\core\passport\models\UserLog;
use app\modules\general\member\models\News\SysAnnouncement;
use Yii;

//use app\models\api\RegisterForm;

/**
 * UserApi Controller
 * code: 0 成功 1 校验错误 2 用户名或密码错误 3 用户未登录
 */
class UserApiController extends BaseController {
    private $_data = [];
    private $_resp = [];                                                        // 响应内容
    private $_session = null;
    private $_params = null;
    /**
     * 初始化方法
     */
    public function init() {
        parent::init();
        $this->layout = false;                                                  // 关闭layout渲染
        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->_resp = [
            'code' => 0,
            'data' => [],
            'msg' => ''
        ];
        LoginState::Check();
    }
    /**
     * 登录方法
     * 1. 刷新session生命周期，判断session不存在时返回登出状态码
     * 2. 表单验证客户提交的数据，验证未通过返回错误信息
     * 3. 进入登入处理器
     * 返回结果信息
     */
    public function actionLogin() {
        LoginState::Check();
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return json_encode($this->_getLoginedInfo());
        }
        $model = new LoginForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => Yii::$app->request->post()
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

        $this->_loginHandler($model->name, $model->pwd);

        return json_encode($this->_resp);
    }

    /**
     * 退出登录
     * 更新会员信息（登出时间，登入状态）
     * 清除会员session
     */
    public function actionLogout() {
        $cookies=Yii::$app->response->cookies;
        $cookies->remove('uid');
        $cookies->remove('oid');
        $user_id = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $data = UserList::find()
            ->where(['user_id' => $user_id])
            ->one();
        $data->Oid = '';
        $data->online = '0';
        $data->logouttime = date('Y-m-d H:i:s');
        $data->save();
        Yii::$app->session->destroy();
        return json_encode('退出成功');
    }

    /**
     * 注册
     * 1. 注册条件限制（开户协议，当日注册会员数超过9个）
     * 2. 数据信息验证
     * 3. 用户名唯一
     * 4. 进入注册处理器
     * 5. 返回注册结果
     */
    public function actionRegister()
    {
        $postNews = Yii::$app->request->post();

        if (! strstr($postNews['pararms'], 'agree')) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = '请勾选开户协议！';

            return json_encode($this->_resp);
        }

        $iipp = $this->_get_real_ip();
        $r = UserList::registToManay($iipp);

        if ($r['today_count'] && $r['today_count'] > 10) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = '抱歉!请不要频繁注册用户。请联系管理员';

            return json_encode($this->_resp);
        }

        $model = new RegisterForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews
        ];

        if (! $model->load($this->_data) || ! $model->validate()) {
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

        $hcaker = Hacker::find()->where(['name'=>$postNews['name']])->asArray()->one();

        if ($hcaker) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = '该用户名为恶意用户名，无法注册！';

            return json_encode($this->_resp);
        }

        $this->_registerHandler($model);

        return json_encode($this->_resp);
    }

    /**
     * 代理域名登入，或者代理ID登入，注册的时候自动存入介绍人
     * @return type
     */
    public function actionAgents(){
        $this->_resp['data']['user'] = [
            'agents_name' => '',
        ];
        if (Yii::$app->session->has(Yii::$app->params['S_AGENT_ID'])) {
            $agents_id = Yii::$app->session[Yii::$app->params['S_AGENT_ID']];
            $data = AgentsList::find()
                ->where(['id' => $agents_id])
                ->one();
            if(isset($data["agents_name"])){
                $this->_resp['data']['user'] = [
                    'agents_name' => $data['agents_name'],
                ];
            }
        }else{
            $server_name = $this->_prefix_url();
            $arr = explode('.',$server_name);
            if($arr[0]!='www' && $arr[0]!='' && $arr[0]!='wap'){
                $data = AgentsList::find()
                    ->where(['agents_name' => $arr[0]])
                    ->one();
            }else{
                $data = AgentsList::find()
                    ->where(['agents_name' => $arr[1]])
                    ->one();
            }
            if(isset($data["agents_name"])){
                $this->_resp['data']['user'] = [
                        'agents_name' => $data['agents_name'],
                    ];
            }
        }
        return json_encode($this->_resp);
    }

    /**
     * 代理会员注册
     * 1. 代理账户唯一（管理员后期会改动代理账户为代理域名）
     * 2. 数据信息验证
     * 3. 进入代理客户注册处理器
     * 返回结果
     */
    public function actionAgentsRegister(){
        $this->_resp['code'] = 0;
        $postNews = Yii::$app->request->post();
        $user_name = $postNews['username'];
        $agents = AgentsList::find()
            ->where(["agents_name"=>$user_name])
            ->one();
        if(!empty($agents)){
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = "此用户名已经存在";
            return json_encode($this->_resp);
        }
        $model = new AgentsRegisterForm;
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
        $this->_agentsregisterHandler($postNews);
        return json_encode($this->_resp);
    }
    /**
     * 添加代理下属会员注册情况下的代理ID session （地址栏直接输入代理ID方式）
     * @return type
     */
    public function actionAddAgents(){
        if(!empty($_POST['intr'])){
            Yii::$app->session[Yii::$app->params['S_AGENT_ID']] = $_POST['intr'];
            return $_POST['intr'];
        }
    }

    /**
     * 获取自定义公告信息
     * @return type
     */
    public function actionJson(){
        $noticeDef = SysAnnouncement::getDefNotice();
        $msg = $noticeDef[0]['content'];
        return json_encode($msg);
    }
    /**
     * 获取赛事公告信息
     * @return json
     */
    public function actionJsontef(){
        $noticeTef = SysAnnouncement::getTefNotice();
        $msgTef = $noticeTef[0]['content'];
        return json_encode($msgTef);
    }

    /**
     * 获取在线客服地址
     * @return mixed|string
     */
    public function actionOnlinekf(){
        $service_url = '#';
        $sysConfig = SysConfig::find()->one();
        if(!empty($sysConfig) && !empty($sysConfig['service_url'])) {
            $service_url = $sysConfig['service_url'];
        }
        return $service_url;
    }

    /**
     * 判断会员注册时所填写的真实姓名是否唯一
     * @return json
     */
    public function actionUniqueUserRealName(){
        $name = Yii::$app->request->get('name');
        $r = UserList::findOne(['pay_name'=>$name]);
        if($r){
            $this->_resp['code']='1';
        }
        return json_encode($this->_resp);
    }
    /**
     * 判断会员注册账户是否唯一
     * @return json
     */
    public function actionUniqueUserName(){
        $name = Yii::$app->request->get('name');
        $r = UserList::findOne(['user_name'=>$name]);
        if($r){
            $this->_resp['code']='1';
        }
        return json_encode($this->_resp);
    }
    /* ============================ 华丽的分割线 =============================== */

    /**
     * 登录处理器
     * 1. 密码比对
     * 2. 更新会员信息
     * 3. 插入会员登入日志
     * 4. 存入会员session，cookie
     */
    private function _loginHandler($name, $pwd) {
        $sysconfig=SysConfig::find()->select(['add_pass'])->asarray()->one();
        $data = UserList::find()
            ->where(['user_name' => $name, 'user_pass' => md5($pwd.$sysconfig['add_pass'])])
            ->one();

        if (!isset($data)) {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '用户名或密码错误';
            return;
        }
        if ($data['status'] != '正常') {
            $this->_resp['code'] = 2;
            $this->_resp['msg'] = '该用户已经被停用！请联系客服';
            return;
        }
        $str = time('s');
        $oid = strtolower(substr(md5($str), 0, 10) . substr(md5($name), 0, 10) . 'hh' . rand(0, 9));
        $iipp=$this->_get_real_ip();
        $address = IpUtils::convertip($iipp);
        $loginurl = 'http://'.$_SERVER['HTTP_HOST'];
        $data->device_type = 0;
        $data->Oid = $oid;
        $data->loginip = $iipp;
        $data->logintime = date('Y-m-d H:i:s');
        $data->OnlineTime = date('Y-m-d H:i:s');
        $data->logouttime = date('Y-m-d H:i:s');
        $data->online = '1';
        $data->lognum = $data['lognum']+1;
        $data->loginurl = $loginurl;
        $data->loginaddress = $address;
        $data->save();
        $history = new HistoryLogin();
        $history->uid = $data['user_id'];
        $history->username = $name;
        $history->ip = $iipp;
        $history->ip_address = $address;
        $history->login_time = date('Y-m-d H:i:s');
        $history->www = $loginurl;
        $history->save();
        $this->_resp['data']['user'] = [
            'name' => $data['user_name'],
            'money' => $data['money'],
            'msg_num' => $this->_getUserMsgCount($data['user_id'])
        ];
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

        LoginState::add($data['user_id'],$oid);
    }

    /**
     * 注册处理器
     * 1. 判断是否为代理注册（代理下属会员）
     * 2. 插入会员信息
     * 3. 插入注册信息
     * 4. 插入会员登入日志
     * 5. 存入会员session，cookie
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
            $sum_top_id = isset($data["agent_level"]) && $data["agent_level"] ? $data["agent_level"]: 0;
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
        $md5pwd = md5($pwd . $sysconfig['add_pass']);
        $str = time('s');
        $oid = strtolower(substr(md5($str), 0, 10) . substr(md5($username), 0, 10) . 'hh' . rand(0, 9));

        if ($form['email'] == 'shouji@shouji.com') {
            $oid = '';
        }

        $user_id = $this->_get_user_id();
        $iipp = $this->_get_real_ip();
        $address = IpUtils::convertip($iipp);
        $loginurl = 'http://' . $_SERVER['HTTP_HOST'];
        $regurl = 'http://' . $_SERVER['HTTP_HOST'];
        $userlist = new UserList;
        $userlist->user_id = $user_id;
        $userlist->Oid = $oid;
        $userlist->device_type = 0;
        $userlist->user_name = $username;
        $userlist->user_pass = $md5pwd;
        $userlist->user_pass_naked = $pwd;
        $userlist->qk_pass = md5($form['withdraw_pwd']);
        $userlist->pay_name = $form['real_name'];
        $userlist->top_id = $top_id;
        $userlist->sum_top_id = $sum_top_id;
        $userlist->tel = $form['phone'];
        $userlist->qq = $form['qq'];
        $userlist->email = $form['email'];
        $userlist->loginip = $iipp;
        $userlist->regip = $iipp;
        $userlist->logintime = date('Y-m-d H:i:s');
        $userlist->OnlineTime = date('Y-m-d H:i:s');
        $userlist->logouttime = date('Y-m-d H:i:s');
        $userlist->regtime = date('Y-m-d H:i:s');
        $userlist->online = '1';
        $userlist->lognum = '1';
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

            foreach ($configP as $key=>$val) {
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
     * 代理客户注册处理器
     * 插入代理客户注册信息
     */
    private function _agentsregisterHandler($postNews){
        $loginip = $this->_get_real_ip();
        $regtime =date("Y-m-d H:i:s");
        $user_name = $postNews['username'];
        $password = $postNews['password'];
        $real_name = $postNews['real_name'];
        $tel = $postNews['tel'];
        $email = $postNews['email'];
        $agentslist = new AgentsList;
        $agentslist->agents_name = $user_name;
        $agentslist->agents_pass = $password;
        $agentslist->real_name = $real_name;
        $agentslist->loginip = $loginip;
        $agentslist->regtime = $regtime;
        $agentslist->tel = $tel;
        $agentslist->email = $email;
        $agentslist->save();
    }

    /**
     * 获取用户登录后的信息
     * 返回会员账户名称，账户余额，账户信息数（包含：异地登出或被管理员提线）
     * @return array
     */
    private function _getLoginedInfo() {
        $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $oid = Yii::$app->session[Yii::$app->params['S_USER_OID']];
        $data = UserList::find()
            ->where(['user_id' => $uid])
            ->one();
        if (!isset($data)) {
            $this->_resp['code'] = 3;
            $this->_resp['msg'] = '用户未登录';
            return $this->_resp;
        }
        $data->logouttime = date('Y-m-d H:i:s');
        $data->save();
        if($oid != $data['Oid'] || $data['status'] != '正常'){
            LoginState::delete();
            $this->_resp['code'] = 3;
            $this->_resp['msg'] = '用户被强制登出！';
            return $this->_resp;
        }
        $this->_resp['data']['user'] = [
            'name' => $data['user_name'],
            'money' => $data['money'],
            'msg_num' => $this->_getUserMsgCount($uid)
        ];

        return $this->_resp;
    }

    /**
     * 获取用户消息数
     * @param int $uid  用户id
     * @return int      消息数
     */
    private function _getUserMsgCount($uid) {
        $data = UserMsg::find()
            ->where(['user_id' => $uid, 'islook' => 0])
            ->count();
        return isset($data) ? $data : 0;
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

    /**
     * 获取会员真实的IP地址
     * @return bool
     */
    function _get_real_ip(){
        $ip = false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        $ip = $ip ? $ip : $_SERVER['REMOTE_ADDR'];
        return $ip;
    }
    /**
     * 分割访问域名（判断代理下属会员注册时使用）
     * @return type
     */
    function _prefix_url(){
        $port = ($_SERVER['SERVER_PORT']==80) ? '' : ':'.$_SERVER['SERVER_PORT'];
        $server_name = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'].$port :
            getenv('SERVER_NAME').$port;
        return $server_name;
    }

    function actionLoginCheck() {
        if(Yii::$app->session->has(Yii::$app->params['S_USER_ID'])){
            return $this->out(true, '已登录');
        }
        return $this->out(false, '未登录');
    }

//    function actionTest(){
//        $server_name = $this->_prefix_url();
//        $data = AgentsList::find()
//            ->where(['like','agent_url',$server_name])
//            ->one();
//        $top_id = isset($data["id"]) && $data["id"] ? $data["id"]:0;
//        var_dump($top_id);
//    }
}
