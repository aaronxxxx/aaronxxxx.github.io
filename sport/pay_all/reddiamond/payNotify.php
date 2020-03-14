<?php
	/* *
	 * 功能：服务器异步通知页面
	 * 日期：2018-10-15
	 */
	require_once('../PublicConf.class.php');
	require_once('config.php');
	require_once('service.php');
	require_once('Handle_RSA.php');
	//記錄接收Log
	$filename = 'log/payNotify.log';
	//file_put_contents($filename, '1.'.date('Y-m-d h:i:s').json_encode($_GET).PHP_EOL, FILE_APPEND);
	file_put_contents($filename, '2.'.date('Y-m-d h:i:s').json_encode($_POST).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '3.'.date('Y-m-d h:i:s').json_encode($GLOBALS['HTTP_RAW_POST_DATA']).PHP_EOL, FILE_APPEND);
	##### html包体解决方式 #####
	//$postdata = file_get_contents("php://input",'r');
	//file_put_contents($filename, '4.'.date('Y-m-d H:i:s').$postdata.PHP_EOL, FILE_APPEND);
	$config = new PublicConf('reddiamond');
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	$partner = $configext["config"]["merchantappId"];
	$rsaPublicKey = file_get_contents("lib/public_key.pem");
	$verify_yn = 'N';
	$NotifyArray = $_POST;
	
	if ($partner == $NotifyArray['partnerId']) {
		if (isset($NotifyArray['payResult']) && $NotifyArray['payResult'] == '1') {
			$signArray = $NotifyArray;
			unset($signArray['signMsg'], $signArray['signType'], $signArray['extraCommonParam']);
			//$signArray['inputCharset'] = '1';
			ksort($signArray);
			$Service = new Service();
			$signStr = $Service->ToUrlParams($signArray);
			$Handle_RSA = new Handle_RSA();
			$signResult = $Handle_RSA->verity($signStr, $NotifyArray['signMsg'], $rsaPublicKey);
			//var_dump($signResult);exit;
			
			#签名验证
			if ($signResult) {
				$verify_yn = 'Y';
			} else {echo '验签不正确'; exit;}
		} else {echo '支付失败'; exit;}
	} else {echo '此笔交易非本商户订单'; exit;}

	
	if ($verify_yn == 'Y') {
		$params['user_id'] = 'N';	//沒回傳資訊，也沒提供訂單查詢，所以不檢查
		$params['order_no'] = $NotifyArray['orderNo'];
		$params['order_money'] = $NotifyArray['orderAmount'] * 0.01;	//如果同时存在多个用户支付同一金额，就会和price存在一定差额，差额一般在1-2分钱上下
		$params['odds'] = 1;	//換算比例，預帶1
		//$params['order_time'] =  date("Y-m-d H:i:s", strtotime($_GET['transTime']));
		$params['order_time'] = date('Y-m-d h:i:s');	//沒回傳時間，以收到時間為主
		//$params['pay_card'] = $_GET['pay_type'];
		
		$result = $config->do_asynchronous($params);
		if ($result['status'] == 0) {
			$config->write_log($result['msg']);
		}elseif ($result['status'] == 1) {
			$config->write_log($result['msg'],true);
		}
	}
	else {
		echo "不合法数据";
		return false;
	}
?>