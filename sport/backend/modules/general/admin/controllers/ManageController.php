<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\admin\controllers;

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
use app\common\helpers\LogUtils;
use app\modules\core\common\models\SysManage;
use app\modules\general\admin\models\SysManageSearch;
use app\modules\general\sysmng\models\ar\SysConfig;
use Yii;
use yii\base\Exception;

class ManageController extends BaseController
{

    public function actionList() {
        $userName = Yii::$app->getSession()->get('S_USER_NAME');
        $this->layout = false;
        $searchModel = new SysManageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $qrswitch = SysConfig::getPagesize("why");
        return $this->render('list', [
            'username'=>$userName,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'qrswitch'=>$qrswitch,
        ]);
    }
    public function actionUpdateqrcode() {
        try{
            $switch = Yii::$app->request->post('switch');
            $SysConfig = new SysConfig();
            $data = SysConfig::find()->orderBy(array('id'=>SORT_DESC))->one();
            $data->why = $switch;
            $data->save();
            return $this->out(true, "修改成功");
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "修改失败");
        }
    }

    public function actionResetqrcode() {
        try{
            $ga = new PHPGangsta_GoogleAuthenticator();
            $secret = $ga->createSecret();
            $SysConfig = new SysConfig();
            $data = SysConfig::find()->orderBy(array('id'=>SORT_DESC))->one();
            $data->AGLiveUrl = $secret;
            $data->save();
            return $this->out(true, "刷新成功");
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "刷新失败");
        }
    }
    public function actionIndex() {
        $userName = Yii::$app->getSession()->get('S_USER_NAME');
        $this->layout = false;
        // $qx_str = "会员管理|彩票赔率管理|彩票注单管理|彩票结果管理|真人娱乐操作|系统管理|代理管理|消息管理|数据管理|管理员管理|六合彩管理|报表管理|财务管理|彩票开奖管理|极速六合彩管理|優惠活動管理|運動賽事管理";
        $qx_str = "会员管理|彩票赔率管理|彩票注单管理|彩票结果管理|真人娱乐操作|系统管理|代理管理|数据管理|管理员管理|报表管理|财务管理|极速六合彩管理";
        $qx = explode('|', $qx_str);
        $sysManage = new SysManage();
        $id = Yii::$app->request->get('id');
        if($id) {
            $sysManage = $this->findModel($sysManage, $id);
        }
        return $this->render('index', [
            'sysManage' => $sysManage,
            'username'=>$userName,
            'qx' => $qx
        ]);
    }

    public function actionDelete() {
        try{
            $id = Yii::$app->request->post('id');
            $sysManage = new SysManage();
            $count = SysManage::find()->count();
            if($count > 1) {
                $sysManage = $this->findModel($sysManage, $id);
                $sysManage->delete();
                return $this->out(true, "删除成功");
            } else {
                return $this->out(false, "只有一个管理员,不可删除");
            }
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "删除失败");
        }
    }

    public function actionUpdate() {
        try{
            $sysManage = new SysManage();
            $id = Yii::$app->request->post('id');
            if($id) {
                $sysManage = $this->findModel($sysManage, $id);
                $manage_pass=Yii::$app->request->post('manage_pass');
                if(!empty($manage_pass)){
                	$sysManage->manage_pass = md5('0z'.md5(Yii::$app->request->post('manage_pass').'w0'));
                }
            } else {
                $one = SysManage::find()->where([
                   'manage_name'=> Yii::$app->request->post('manage_name')
                ])->one();
                if($one != null) {
                    return $this->out(false, "用户名已存在");
                }
                $sysManage->manage_pass = md5('0z'.md5(Yii::$app->request->post('manage_pass').'w0'));
                $sysManage->manage_name = Yii::$app->request->post('manage_name');
                $sysManage->bindcomputer = 0;
            }
            $sysManage->login_one = Yii::$app->request->post('login_one');
            $sysManage->purview = Yii::$app->request->post('purview');
            $sysManage->save();
            return $this->out(true, '更新成功');
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "更新失败");
        }
    }

    public function actionSetpwdpage() {
        $this->layout = false;
        $userId = Yii::$app->getSession()->get('S_USER_ID');
        $userName = Yii::$app->getSession()->get('S_USER_NAME');
        return $this->render('setpwd', [
            'userId' => $userId,
            'userName' => $userName
        ]);
    }

    public function actionSetpwd() {
        $p1 = $this->getParam('p1');
        $p2 = $this->getParam('p2');
        $userId = $this->getParam('userId');
        $sysManage = new SysManage();
        $sysManage = $this->findModel($sysManage, $userId);
        $sysManage->manage_pass = md5('0z'.md5($p1.'w0'));
        $sysManage->save();
        return $this->out(false, '密码修改成功');
    }

}