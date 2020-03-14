<?php

namespace app\modules\general\thirdpay\controllers;

use YII;
use yii\helpers\Url;
use app\modules\general\finance\models\Money;
use app\modules\general\finance\models\MoneyLog;
use app\modules\general\thirdpay\models\ThirdPaySet;
use app\modules\general\thirdpay\models\ThirdPayLog;
use app\modules\core\common\models\SysManageOnline;
use app\common\helpers\UAUtils;


/* 第三方支付異步回傳使用功能頁面 */

class DoPayController extends \yii\web\Controller
{
    public function init() {
        parent::init();
        $this->layout = false;
    }

    /*送出支付動作 須追加驗證身分 / 驗證金額是否與訂單一致
    
    成功 : 返回成功，修改提款單狀態為審核中，確認匯款成功後修改為已付款
    失敗 : 僅返回失敗資訊

    */
    public function actionPay()
    {
        $data=['code'=>'0','msg'=>'编辑更新失败'];
        $post = Yii::$app->getRequest()->post();
        /*POST資訊 :
            amount: 匯款金額 (僅提供匯款)
            id: 請款 id
            type: 選擇的第三方資料
        */

        // return Yii::$app->urlManager->createAbsoluteUrl('thirdpay/re-call');

        $tixianData = Money::moneyDetail(trim($post['id'])); //提款資訊
        $payData = ThirdPaySet::find()->where(['b_start'=>'1'])->andwhere(['pay_type'=>$post['type']])->asArray()->one();  //取得代付資料
        // return json_encode($tixianData);
        $ip = $this->GetIP();
        $loginbrowser = UAUtils::getClientBrowser();
        $ssid = Yii::$app->getSession()->get('ssid');
        $user = SysManageOnline::find()->where([
            'session_str' => $ssid,
            'loginip'=>$ip,
            'loginbrowser'=>$loginbrowser
        ])->one();

        //檢驗資訊，是否無資料 (請款資訊跟代付資訊)
        if(empty($tixianData) || $tixianData['status']!='未结算' || empty($payData) ){ 
            $data['msg'] = '资讯有误，请重新输入';
        }
        //檢驗身分
        else if(empty($user)){ 
            Yii::$app->user->logout(true);
            $data['msg'] = '請先登入';
        } 
        //核對金額
        else if ( abs($tixianData["order_value"]) != $post['amount'] ) {  
            $data['msg'] = '金額驗證失敗';
        } 
        //執行轉帳動作
        else { 

            $check = $this->StartPay($payData, $tixianData);

            $data['code'] = $check['status'];
            $data['msg'] = $check['msg'];

        }

        return json_encode($data);

    }

    public function StartPay($payData, $tixianData)
    {
        /* payData 資料
            pay_domain : 支付連結
            merchant_id : 商户编号
            pay_secret : 支付密钥
            pay_key : 支付key
            public_key : 對方公鑰


        */
        $returnMsg = array('status'=>0, 'msg'=>'失败'); // 回傳後續資訊，status = 1 則刷新頁面
        $rsaPrivateKey = file_get_contents("public/common/ssl/private_key.pem");	//我方私鑰
        $rsaPublicKey = file_get_contents("public/common/ssl/public_key.pem");      //我方公


        switch($payData['pay_type']){
            //博順支付
            case 'boshun':  

                //修改key為正確格式  註:需視實際情況使用
                $str = chunk_split($payData['public_key'], 64, "\n");
                $public_key = "-----BEGIN PUBLIC KEY-----\n$str-----END PUBLIC KEY-----\n";

                $amount = floor( abs($tixianData['order_value']) * 100);
                $value = str_pad($amount,12,'0',STR_PAD_LEFT); 

                //付款資料
                $parameter = [
                    'payKey' => $payData['pay_key'],
                    'cardNo' => $tixianData['pay_num'],
                    'cardName' => $tixianData['pay_name'],
                    'noticeUrl' => Yii::$app->urlManager->createAbsoluteUrl('thirdpay/re-call/'.$payData['pay_type']),
                    'orderNo' => $tixianData['order_num'],
                    'tranTime' => date('YmdHis'),
                    'tranAmt' => $value
                ];
                
                $sign = '';
                
                //修改為依照排序進行簽名檢查
                ksort($parameter);
                
                $str = substr($this->getvalue($parameter),0,-1);

                $encryptData = '';
                
                //因長度問題，切割加密
                foreach (str_split(utf8_encode(json_encode($parameter)), 117) as $chunk) {
                
                    openssl_public_encrypt($chunk, $encryptData, $public_key);
                
                    $sign .= $encryptData;
                }
                $sign_base64 = base64_encode($sign);
                
                $post = [
                    'merId' => md5($payData['merchant_id']),
                    'encryptData' => $sign_base64,
                    'signData' => strtoupper(md5( mb_convert_encoding($str."&paySecret=".$payData['pay_secret'],"UTF-8") ))
                ];

                $data_string = json_encode($post);
                $url = $payData['pay_domain'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  //去除SSL驗證
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  //去除SSL驗證
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
                );
                //execute post
                $result = curl_exec($ch);

                //因長度問題，切割解密
                $crypto = '';
                foreach (str_split(base64_decode($result), 128) as $chunk) {
        
                    openssl_private_decrypt($chunk, $decryptData, $rsaPrivateKey);
        
                    $crypto .= $decryptData;
                }

                //回傳資訊為result
                $reArr = json_decode($crypto, true);

                //儲存進資料庫LOG money_id/order_num/time/returnData/postData
                $payLog=new ThirdPayLog();
                $payLog->sign_info = $crypto;
                $payLog->update_time = date('Y-m-d H:i:s');
                $payLog->pay_type = $payData['pay_type'];
                $payLog->error_type = $reArr['respCode'];
                $payLog->error_msg = $reArr['respDesc'];
                $payLog->order_num = $tixianData['order_num'];
                $payLog->post_info = json_encode($parameter);
                $payLog->save();

                if($reArr['respCode'] == '0000'){
                    Money::updateTixianStatus('1', $tixianData['id'], '代付成功');
                    $returnMsg['status'] = 1;
                    $returnMsg['msg'] = '代付成功';
                    
                } else if($reArr['respCode'] == '0001') {
                    Money::updateTixianStatus('3', $tixianData['id'], '代付至银行处理中');
                    $returnMsg['status'] = 1;
                    $returnMsg['msg'] = '代付至银行处理中';
                } else {
                    $returnMsg['msg'] = '代付失败 : '.$reArr['respDesc'];
                }
                // var_dump($result); exit;
            break;



        }

        return $returnMsg;

        //取得當前網址
        // echo Yii::$app->urlManager->createAbsoluteUrl('thirdpay/re-call'); exit;
        // return $this->render('index');
    }

    //取得IP
    public function GetIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "none";
        }
        return $cip;
    }

    //取得類_GET 字串
    public function getvalue($data) {
        $str = "";
        foreach ($data as $k => $v) {
                $str .= $k."=".$v . "&";
        }
        return $str;
    }

}
