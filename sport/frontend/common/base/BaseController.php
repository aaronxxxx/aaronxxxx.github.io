<?php
namespace app\common\base;

use app\common\filters\SpeedFilter;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\web\Controller;
use app\modules\lottery\models\ar\WebClose;
use app\modules\core\passport\models\IpList;

/**Index controller*/
class BaseController extends Controller{


    #极速六合彩维护(六合彩未实装)
    public function init() {

        /*先行判別使用者國別
        * 查詢完資料存至主機紀錄，並存session 做許可
        * 針對error狀況如何覆核後續再議
        */
        if( !isset($_SESSION['validate_country']) ){
          $userIP = $this->_get_real_ip();
          $ipdata = IpList::find()->where(['ip'=>$userIP])->asArray()->one();

          if( empty($ipdata) ){
            $checkCountry = $this->checkCountry($userIP);
            $insert = new IpList();
            $insert->ip = $userIP;
            $insert->code = $checkCountry;
            $insert->save();

            if($checkCountry=='tw' || $checkCountry=='error'){
                $_SESSION['validate_country'] = 'N';
              } else {
                $_SESSION['validate_country'] = 'Y';
              }

          } else {
              //判別是否為可放行 IP
              if($ipdata['code']=='tw' && $ipdata['allow']=='N'){
                $_SESSION['validate_country'] = 'N';
              } else {
                $_SESSION['validate_country'] = 'Y';
              }
          }

        }

        if( $_SESSION['validate_country'] == 'N' ){
            //導向錯誤檔案
            // echo '<html><head><meta name="viewport" content="width=device-width, minimum-scale=0.1"><title>forwardGame.do (2000×1000)</title></head><body style="margin: 0px; background: #0e0e0e;"><img style="-webkit-user-select: none;margin: auto;cursor: zoom-in;" src="/public/aomenPC/img/blockCountry.png" width="1351" height="675"></body></html>'; exit;
        }

        parent::init();
        if ($this->route == 'spsix/index' || $this->route == 'spsix/disp') {
            $Lottery_set = WebClose::getWebClose('spsix');
            return $Lottery_set;
        }
    }

    public function behaviors()
    {
        return [
            'speed' => [
                'class' => SpeedFilter::className()
            ]
        ];
    }

    public function getParam($name, $def = null) {
        if(Yii::$app->request->isGet) {
            return Yii::$app->request->get($name, $def);
        } else {
            return Yii::$app->request->post($name, $def);
        }
    }

	public function out($status, $msg = null) {
	    return Json::encode([
            'status' => $status,
            'msg' => $msg
        ]);
    }

    public function outCode($status, $msg, $code) {
        return Json::encode([
            'status' => $status,
            'msg' => $msg,
            'code' => $code
        ]);
    }

    public function outData($data) {
        return Json::encode([
            'status' => true,
            'data' => $data
        ]);
    }

    public function outPageData($data, $total) {
        return Json::encode([
            'status' => true,
            'data' => $data,
            'total' => $total
        ]);
    }

    protected function findModel(ActiveRecord $activeRecord, $id)
    {
        if (($model = $activeRecord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested model does not exist.');
        }
    }

    /* 判斷國別資訊
     * 透過爬取資料並正則取出資訊後確認國別資訊
     * 需再補上其他網站，避免單一網站出問題影響
     */
    function checkCountry($ip)
    {
        $result = 'error';
        $j = 1;
        switch ($j) {
            case 1:
                //取得回應代碼，如非200則代表該站失效
                $return = $this->get_http_response_code('https://www.ip-adress.com/what-is-my-ip-address');

                if ($return == "200") {
                    $data = file_get_contents('https://www.ip-adress.com/ip-address/ipv4/' . $ip);
                    preg_match('/<th>Country Code<\/th><td>(.*?)<\/td>/si', $data, $match);

                    if ( !empty($match[1]) ) {
                        //回傳國碼
                        $result = strtolower($match[1]);
                        break;
                    }
                }
            case 2:
                //取得回應代碼，如非200則代表該站失效
                $return = $this->get_http_response_code('http://tool.chinaz.com/ipwhois');

                if ($return == "200") {
                    $data = file_get_contents('http://tool.chinaz.com/ipwhois?q=' . $ip);
                    preg_match('/<br\/>country:(.*?)<br\/>/si', $data, $match);

                    if ( !empty($match[1]) ) {
                        //回傳國碼
                        $result = strtolower(trim($match[1]));
                        break;
                    }
                }
            case 3:
                //取得回應代碼，如非200則代表該站失效
                $return = $this->get_http_response_code('https://who.is');

                if ($return == "200") {
                    $data = file_get_contents('https://who.is/whois-ip/ip-address/' . $ip);
                    preg_match('/Country:(.*?)RegDate/si', $data, $match);

                    if ( !empty($match[1]) ) {
                        //回傳國碼
                        $result = strtolower(trim($match[1]));
                        break;
                    }
                }
        }

        return $result;
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

    public function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
}
