<?php

namespace app\modules\general\thirdpay\controllers;

use YII;
use yii\helpers\Url;
use app\modules\general\finance\models\Money;
use app\modules\general\finance\models\MoneyLog;
use app\modules\general\thirdpay\models\ThirdPaySet;
use app\modules\general\thirdpay\models\ThirdPayLog;
use app\common\helpers\UAUtils;


/* 第三方支付異步回傳使用功能頁面，
   根據各第三方設定的 type， 製作 actionXXXX 作為回調頁面使用

*/

class ReCallController extends \yii\web\Controller
{

    public function actionBoshun(){

        $transData = $this->getParam('transData');

        if(empty($transData)){
            echo "noData"; exit;
        }

        $rsaPrivateKey = file_get_contents("public/common/ssl/private_key.pem");	//我方私鑰
        $rsaPublicKey = file_get_contents("public/common/ssl/public_key.pem");      //我方公


        //因長度問題，切割解密
        $crypto = '';
        foreach (str_split(base64_decode($transData), 128) as $chunk) {
        
            openssl_private_decrypt($chunk, $decryptData, $rsaPrivateKey);
        
            $crypto .= $decryptData;
        }

        //回傳資訊為result
        $reArr = json_decode($crypto, true);
        //儲存進資料庫LOG money_id/order_num/time/returnData/postData

        $tixianData = money::find()->where(['order_num'=>$reArr['order_num']])->andwhere(['pay_type'=>'boshun'])->asArray()->one();  //取得代付資料

        $payLog=new ThirdPayLog();
        $payLog->sign_info = $crypto;
        $payLog->update_time = date('Y-m-d H:i:s');
        $payLog->pay_type = 'boshun';
        $payLog->error_type = $reArr['respCode'];
        $payLog->error_msg = '异步回调_'.$reArr['respDesc'];
        $payLog->order_num = $tixianData['order_num'];
        $payLog->post_info = json_encode($parameter);
        $payLog->save();

        if($reArr['respCode'] == '0000'){
            Money::updateTixianStatus('1', $tixianData['id'], '代付成功');
        } else if($reArr['respCode'] == '0001') {
            Money::updateTixianStatus('3', $tixianData['id'], '代付至银行处理中');
        }


    }

    public function getParam($name, $def = null) {
        if(Yii::$app->request->isGet) {
            return Yii::$app->request->get($name, $def);
        } else {
            return Yii::$app->request->post($name, $def);
        }
    }
    

}
