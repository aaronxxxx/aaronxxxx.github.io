<?php

namespace app\modules\general\member\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\general\member\models\BankTransaction\PaySet;
use app\modules\general\member\models\ar\UserList;
use app\modules\general\member\models\ar\Money;
use app\modules\general\member\models\BankTransaction\MoneyLog;
/**
 * 线上存款页面（第三方支付地址存入）
 * DepositController
 */
class DepositController extends BaseController {
    private $_req = null;
    private $_resp = [];
    private $_session = null;
    private $_params = null;
    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->getView()->title = '线上存款';
        $this->layout = false;
        $this->_resp = [
            'code' => 0,
            'data' => [],
            'msg' => ''
        ];
    }

    /**
     * 主页
     */
   public function actionIndex() {
       if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
           return $this->redirect('no_login.php');
       }
       $this->layout = 'main';
       $uid = $this->_session[$this->_params['S_USER_ID']];
       $arr = UserList::getUserNewsByUserId($uid); //获取用户名
       $rows = PaySet::getPaySetByStartAndMoney($arr['group_id']);//获取所有正常且启动的支付表信息
	   //控制前段页面显示支付平台的底色
       $color = array('red_deposit','green-wechat','LightBlue-alipay','red_deposit','green-wechat','LightBlue-alipay','red_deposit','green-wechat','LightBlue-alipay','red_deposit','green-wechat','LightBlue-alipay');
       if (empty($rows)){
           return $this->render('index', ['urlarr' => [['payurl'=>'javascript:void(0)','pay_name'=>'暂未开启在线支付']],'color'=>$color]);
       }
       foreach($rows as $key=>$val){
           $pay_key = $this->_encrypt($arr['user_id'], 'E',$val['user_key']);
           $urlArr[$key]['payurl'] = "http://" . $val['pay_domain'] ."/?user_id=".$pay_key."&user_name=".$arr['user_name']."&pay_type=".$val['pay_type'];
           $urlArr[$key]['pay_name'] = "【".$val['platform_name'].'】';
       }
       return $this->render('index', ['urlarr' => $urlArr,'color'=>$color]);
   }
   /*


   $operation
   */
    /**
     * 用于user_id用户id进行加密
     * @param $string       用户ID
     * @param $operation    E：加密，D：解密
     * @param string $key   用户id加密秘钥
     * @return bool|string
     */
   public function _encrypt($string,$operation,$key=''){
        $key=md5($key);
        $key_length=strlen($key);
        $string=$operation=='D'?base64_decode(str_replace(' ','+',$string)):substr(md5($string.$key),0,8).$string;
        $string_length=strlen($string);
        $rndkey=$box=array();
        $result='';
        for($i=0;$i<=255;$i++){
            $rndkey[$i]=ord($key[$i%$key_length]);
            $box[$i]=$i;
        }
        for($j=$i=0;$i<256;$i++){
            $j=($j+$box[$i]+$rndkey[$i])%256;
            $tmp=$box[$i];
            $box[$i]=$box[$j];
            $box[$j]=$tmp;
        }
        for($a=$j=$i=0;$i<$string_length;$i++){
            $a=($a+1)%256;
            $j=($j+$box[$a])%256;
            $tmp=$box[$a];
            $box[$a]=$box[$j];
            $box[$j]=$tmp;
            $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
        }
        if($operation=='D'){
            if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){return substr($result,8);
            }else{return'';}
        }else{
            return urlencode(str_replace('=','',base64_encode($result)));
        }
    }
}
