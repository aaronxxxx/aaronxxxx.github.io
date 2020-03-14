<?php

namespace app\modules\core\passport\controllers;

class PHPGangsta_GoogleAuthenticator
{
    protected $_codeLength = 6;

    /**
     * Create new secret.
     * 16 characters, randomly chosen from the allowed base32 characters.
     *
     * @param int $secretLength
     *
     * @return string
     */
    public function createSecret($secretLength = 16)
    {
        $validChars = $this->_getBase32LookupTable();

        // Valid secret lengths are 80 to 640 bits
        if ($secretLength < 16 || $secretLength > 128) {
            throw new Exception('Bad secret length');
        }
        $secret = '';
        $rnd = false;
        if (function_exists('random_bytes')) {
            $rnd = random_bytes($secretLength);
        } elseif (function_exists('mcrypt_create_iv')) {
            $rnd = mcrypt_create_iv($secretLength, MCRYPT_DEV_URANDOM);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $rnd = openssl_random_pseudo_bytes($secretLength, $cryptoStrong);
            if (!$cryptoStrong) {
                $rnd = false;
            }
        }
        if ($rnd !== false) {
            for ($i = 0; $i < $secretLength; ++$i) {
                $secret .= $validChars[ord($rnd[$i]) & 31];
            }
        } else {
            throw new Exception('No source of secure random');
        }

        return $secret;
    }

    /**
     * Calculate the code, with given secret and point in time.
     *
     * @param string   $secret
     * @param int|null $timeSlice
     *
     * @return string
     */
    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30);
        }

        $secretkey = $this->_base32Decode($secret);

        // Pack time into binary string
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
        // Hash it with users secret key
        $hm = hash_hmac('SHA1', $time, $secretkey, true);
        // Use last nipple of result as index/offset
        $offset = ord(substr($hm, -1)) & 0x0F;
        // grab 4 bytes of the result
        $hashpart = substr($hm, $offset, 4);

        // Unpak binary value
        $value = unpack('N', $hashpart);
        $value = $value[1];
        // Only 32 bits
        $value = $value & 0x7FFFFFFF;

        $modulo = pow(10, $this->_codeLength);

        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }

    /**
     * Get QR-Code URL for image, from google charts.
     *
     * @param string $name
     * @param string $secret
     * @param string $title
     * @param array  $params
     *
     * @return string
     */
    public function getQRCodeGoogleUrl($name, $secret, $title = null, $params = array())
    {
        $width = !empty($params['width']) && (int) $params['width'] > 0 ? (int) $params['width'] : 200;
        $height = !empty($params['height']) && (int) $params['height'] > 0 ? (int) $params['height'] : 200;
        $level = !empty($params['level']) && array_search($params['level'], array('L', 'M', 'Q', 'H')) !== false ? $params['level'] : 'M';

        $urlencoded = urlencode('otpauth://totp/'.$name.'?secret='.$secret.'');
        if (isset($title)) {
            $urlencoded .= urlencode('&issuer='.urlencode($title));
        }

        return 'https://chart.googleapis.com/chart?chs='.$width.'x'.$height.'&chld='.$level.'|0&cht=qr&chl='.$urlencoded.'';
    }

    /**
     * Check if the code is correct. This will accept codes starting from $discrepancy*30sec ago to $discrepancy*30sec from now.
     *
     * @param string   $secret
     * @param string   $code
     * @param int      $discrepancy      This is the allowed time drift in 30 second units (8 means 4 minutes before or after)
     * @param int|null $currentTimeSlice time slice if we want use other that time()
     *
     * @return bool
     */
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }

        if (strlen($code) != 6) {
            return false;
        }

        for ($i = -$discrepancy; $i <= $discrepancy; ++$i) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($this->timingSafeEquals($calculatedCode, $code)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Set the code length, should be >=6.
     *
     * @param int $length
     *
     * @return PHPGangsta_GoogleAuthenticator
     */
    public function setCodeLength($length)
    {
        $this->_codeLength = $length;

        return $this;
    }

    /**
     * Helper class to decode base32.
     *
     * @param $secret
     *
     * @return bool|string
     */
    protected function _base32Decode($secret)
    {
        if (empty($secret)) {
            return '';
        }

        $base32chars = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);

        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues = array(6, 4, 3, 1, 0);
        if (!in_array($paddingCharCount, $allowedValues)) {
            return false;
        }
        for ($i = 0; $i < 4; ++$i) {
            if ($paddingCharCount == $allowedValues[$i] &&
                substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i])) {
                return false;
            }
        }
        $secret = str_replace('=', '', $secret);
        $secret = str_split($secret);
        $binaryString = '';
        for ($i = 0; $i < count($secret); $i = $i + 8) {
            $x = '';
            if (!in_array($secret[$i], $base32chars)) {
                return false;
            }
            for ($j = 0; $j < 8; ++$j) {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0; $z < count($eightBits); ++$z) {
                $binaryString .= (($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48) ? $y : '';
            }
        }

        return $binaryString;
    }

    /**
     * Get array with all 32 characters for decoding from/encoding to base32.
     *
     * @return array
     */
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '=',  // padding char
        );
    }

    /**
     * A timing safe equals comparison
     * more info here: http://blog.ircmaxell.com/2014/11/its-all-about-time.html.
     *
     * @param string $safeString The internal (safe) value to be checked
     * @param string $userString The user submitted (unsafe) value
     *
     * @return bool True if the two strings are identical
     */
    private function timingSafeEquals($safeString, $userString)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($safeString, $userString);
        }
        $safeLen = strlen($safeString);
        $userLen = strlen($userString);

        if ($userLen != $safeLen) {
            return false;
        }

        $result = 0;

        for ($i = 0; $i < $userLen; ++$i) {
            $result |= (ord($safeString[$i]) ^ ord($userString[$i]));
        }

        // They are only identical strings if $result is exactly 0...
        return $result === 0;
    }
}

use app\common\base\BaseController;
use app\common\helpers\UAUtils;
use app\modules\core\common\models\SysManage;
use app\modules\core\common\models\SysManageLock;
use app\modules\core\common\models\SysManageOnline;
use app\modules\core\passport\models\LoginForm;
use app\modules\general\sysmng\models\ar\SysConfig;
use Yii;

/**Index controller*/
class LoginController extends BaseController{
	private $data = [];

	public function init(){//初始化函数
		//parent::init();
	}

    /**
	 * 注册验证码方法
	 * @return array
	 */
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
				'transparent' => true, // 显示为透明，当关闭该选项，才显示背景颜
			],
		];
	}

//    public function behaviors()
//    {
//        return ArrayHelper::merge(parent::behaviors(), [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['login', 'logout', 'login-handler'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['login', 'login-handler'],
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'allow' => true,
//                        'actions' => ['logout'],
//                        'roles' => ['@'],
//                    ],
//                ],
//            ]
//        ]);
//    }

    public function actionLogin(){//网站登录页)
        $this->layout = false;
        $isqrcode = SysConfig::getPagesize("why");
        if($isqrcode == '1'){
            $secret = SysConfig::getPagesize("AGLiveUrl");
        }else{
            $secret = "99999999";
        }
        return $this->render('login',[
            'isqrcode'=>$isqrcode,
            'secret'=>$secret,
            ]);
    }

    /**
	 * 登录处理器
	 */
	public function actionLoginHandler() {
		$result['status'] = 0;
		$result['msg'] = 0;
        $params = Yii::$app->request->post();
        //檢查登入的字數限制
        if(strlen($params['manage_name']) > 16 || strlen($params['manage_pass']) > 20 || strlen($params['yzm']) > 4 ||strlen($params['code']) > 6)
        {
            return $this->out(0,"输入长度错误");
        }
		$model = new LoginForm();
		$formName = (string)$model->formName();
		$this->data = [$formName=>Yii::$app->request->post()];
        $client_ip = $this->_get_real_ip();
		if(!$model->load($this->data) || !$model->validate()){
			$result['status'] = 0;
			$msg = $model->getErrors();
			foreach ($msg as $k => $v) {
				foreach ($v as $key => $value) {
					$result['msg'] = $value;                               //返回表单验证的错误信息
                    $this->loginFailLog($params['manage_name'], '不可见', $client_ip);
					return $this->out(0,$value);
				}
			}
		}
		if(Yii::$app->params['securityCodeEnable']) {
            $code = file_get_contents(Yii::$app->params['securityCodeUrl']."/code.txt");
            if(empty($code) || empty($params['code']) || ($code != $params['code'])) {
                $this->loginFailLog($params['manage_name'], '不可见', $client_ip);
                return $this->out(0, "安全码不正确");
            } else {
                file_get_contents(Yii::$app->params['securityCodeUrl']);
            }
        }
        //先关闭此功能
        $otp_code_get = $_POST['code'];
        $secret = SysConfig::getPagesize("AGLiveUrl");
        $otp_code = substr($otp_code_get, 0, 6);// $otp_code 有開頭為 0 的狀況，不適用 int
        $ga = new PHPGangsta_GoogleAuthenticator();
        $is_success = $ga->verifyCode($secret, $otp_code, 2);// 2 = 2*30sec clock tolerance
        if ($is_success) {
        }else{
            return $this->out(0, "安全码不正确");
        }
        //先关闭此功能
		$name = $params['manage_name'];
		$pwd = $params['manage_pass'];
		$bj_time_now = date("Y-m-d H:i:s",time());

		$data = SysManage::find()
			->where(['manage_name' => $name, 'manage_pass' =>md5('0z'.md5($pwd.'w0'))])
			->one();

		if ($data) {
			$session = Yii::$app->session;
			$cookies = Yii::$app->response->cookies;
			$run_str = $this->create_str(16);
			$loginbrowser = UAUtils::getClientBrowser();
			// 检查session是否开启
			if (!$session->isActive){
				$session->open();
            }
			$session_str = session_id();
			$computer_id = $cookies->get('computer_id');
			if (empty($computer_id)) {
				$computer_id = '第一次登入的浏览器:[' . $loginbrowser . '] 时间:[' . $bj_time_now . '] IP:[' . $client_ip . '] 账号[' . $name . '] 标识:[' . $run_str . ']';
				$cookies->add(new \yii\web\Cookie([
					'name' => 'computer_id',
					'value' => $computer_id,
					'expire'=> time() + (60 * 60 * 24 * 365)
				]));
				$cookies->add(new \yii\web\Cookie([
					'name' => 'run_str',
					'value' => $run_str,
					'expire'=> time() + (60 * 60 * 24 * 365)
				]));
			} else {
				$run_str = $cookies->get('run_str');
			}
			$rs_cookie = SysManageLock::find()->select('id,b_lock,run_str')->where(array('sys_cookie'=>$computer_id))->one();
			if ($rs_cookie['id'] == '') {
				$sysManageLock = new SysManageLock();
				$sysManageLock->sys_cookie = $computer_id;
				$sysManageLock->b_lock = 0;
				$sysManageLock->run_str = $run_str;
				$sysManageLock->save();
				if ($data['bindcomputer'] == 1) {
					$result['message'] = '浏览器被限制';
                    $this->loginFailLog($params['manage_name'], '不可见', $client_ip);
					return $this->out(false, '浏览器被限制');
				}
			}
			if ($data['login_one'] == '1') {
				$rs_online = SysManageOnline::find()->select('id,logintime,loginbrowser,loginip')->where(array('manage_name'=>$name))->one();
				if (0 < $rs_online['id']) {
					$result['message'] = '这个账号有其他管理员在登陆.登陆时间:[' . $rs_online['logintime'] . '] IP:[' . $rs_online['loginip'] . '] 浏览器:[' . $rs_online['loginbrowser'] . ']或者登录超时.等待60秒后重新登录';
                    $this->loginFailLog($params['manage_name'], '不可见', $client_ip);
					return $this->out(false, $result['message']);
				}
			}
			$rs_online = SysManageOnline::find()->select('id')->where(array('session_str'=>$session_str,'manage_name'=>$name))->one();
			if ($rs_online['id'] == '') {
				//準備先刪除原本帳號登入的資料,並檢查有沒有長久登入
				SysManageOnline::deleteallbyname($name);
				SysManageOnline::deleteallbydate();
				$sysManageOnline = new SysManageOnline();
				$sysManageOnline->manage_name = $name;
				$sysManageOnline->session_str = $session_str;
				$sysManageOnline->logintime = $bj_time_now;
				$sysManageOnline->onlinetime = $bj_time_now;
				$sysManageOnline->loginip = $client_ip;
				$sysManageOnline->loginbrowser = $loginbrowser;
				$sysManageOnline->save();
			} else {
				$rs_online->manage_name = $name;
				$rs_online->session_str = $session_str;
				$rs_online->logintime = $bj_time_now;
				$rs_online->onlinetime = $bj_time_now;
				$rs_online->loginip = $client_ip;
				$rs_online->loginbrowser = $loginbrowser;
				$rs_online->save();
			}
			$session->set('S_USER_ID',$data['id']);
			$session['ssid'] = $session_str;
			$session['purview'] = $data['purview'];
			$session['S_USER_NAME'] = $name;
			$session['S_LOGIN_TIME'] = $bj_time_now;
			$result['code'] = 1;
			$result['message'] = '登录成功';
            Yii::$app->user->login($data, 3600*24*30);
			return $this->out(true, '登录成功');
		} else {
            $this->loginFailLog($params['manage_name'], $params['manage_pass'], $client_ip);
			return $this->out(false, '用户名，密码错误');
		}
	}

	/*
	 * 用户登出
	 */
	public function actionLogout(){
		$this->layout = false;
        $session = Yii::$app->session;
		$SysManegeOnline = SysManageOnline::findOne(array('session_str'=>$session->get('ssid'), 'manage_name'=>$session->get('S_USER_NAME')));
        if($SysManegeOnline){
            $SysManegeOnline->delete();
        }
        Yii::$app->user->logout(true);
        $result = array('code'=>1,'message'=>'退出成功');
		return json_encode($result);
	}

	public function create_str($pw_length)
	{
		$randpwd = '';
		for ($i = 0; $i < $pw_length; $i++)
		{
			$randpwd .= chr(mt_rand(65, 90));
		}
		return $randpwd;
	}

	private function loginFailLog($user, $pwd, $ip) {
        error_log(date('Y-m-d H:i:s').' 登录失败信息：用户名：'.$user.' 密码：'.$pwd.' IP：'.$ip."\r\n", 3, "login_fail.log");
    }

    /**
     * 获取会员真实的IP地址
     * @return bool
     */
    private function _get_real_ip(){
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
}
