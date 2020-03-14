<?php
	/* *
	 * 功能：服务器异步通知页面
	 * 日期：2018-10-15
	 */
	header("Content-type:text/html;charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('config.php');
	require_once('service.php');

	//記錄接收Log
	$filename = 'log/payNotify.log';
	//$Service = new Service();
	//$sendfromIP = $Service->getip();
	//file_put_contents($filename, '1.'.date('Y-m-d h:i:s').json_encode($_GET).PHP_EOL, FILE_APPEND);
	file_put_contents($filename, '2.'.date('Y-m-d h:i:s').json_encode($_POST).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '3.'.date('Y-m-d h:i:s').json_encode($GLOBALS['HTTP_RAW_POST_DATA']).PHP_EOL, FILE_APPEND);
	
	$config = new PublicConf('yihuei');
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	$rsaPublicKey = file_get_contents("lib/public_key.pem");
	$Appid = $configext["config"]["Appid"];
	//参数解析
	$NotifyArray = $_POST;
	//var_dump($NotifyArray);exit;
	if (isset($NotifyArray['PayResult']) && $NotifyArray['PayResult'] == 'SUCCESS') {
		$sign_str = $NotifyArray['Sign'];
		unset($NotifyArray['Sign'], $NotifyArray['Remark']);
		//var_dump($NotifyArray);exit;
		$Service = new Service();
		$str = $Service->getvalue($NotifyArray) . $Appid;
		$res = openssl_get_publickey($rsaPublicKey);
		$result = (bool)openssl_verify($str, base64_decode($sign_str), $res, OPENSSL_ALGO_SHA256);
		openssl_free_key($res);
		//var_dump($result);exit;
		$verify_yn = 'N';	
	} else {echo "交易不成功！中断程序"; exit;}

	#####################签名验证#####################
	//check订单状态是否成功->进行签名比对，都正确才做资料库加钱
	if($result)	$verify_yn = 'Y';
	else {echo "验签不正确！"; exit;}
	
	if ($verify_yn == 'Y') {
		$params['user_id'] = 'N';	//沒回傳資訊，也沒提供訂單查詢，所以不檢查
		$params['order_no'] = $NotifyArray['MchOrderNo'];
		$params['order_money'] = $NotifyArray['PayAmount'];	//如果同时存在多个用户支付同一金额，就会和price存在一定差额，差额一般在1-2分钱上下
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