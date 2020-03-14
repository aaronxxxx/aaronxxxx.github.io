<?php
	/* *
	 * 功能：服务器异步通知页面
	 * 日期：2019-2-18
	 */
	header("Content-type: text/html; charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('config.php'); 
	//require_once('service.php');
	
	//記錄接收Log
	$filename = 'log/payNotify.log';
	//file_put_contents($filename, '1.'.date('Y-m-d H:i:s').json_encode($_GET).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '2.'.date('Y-m-d H:i:s').json_encode($_POST).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '3.'.date('Y-m-d H:i:s').json_encode($GLOBALS['HTTP_RAW_POST_DATA']).PHP_EOL, FILE_APPEND);
	##### html包体解决方式 #####
	$postdata = file_get_contents("php://input",'r');
	file_put_contents($filename, '4.'.date('Y-m-d H:i:s').$postdata.PHP_EOL, FILE_APPEND);
	$config = new PublicConf('yisyun');
	
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	$ApiKey = trim($configext["config"]["pay_key"]);
	$partner = trim($configext["config"]["merchantappId"]);
	$verify_yn = 'N';
	$NotifyArray = json_decode($postdata, true);
	//var_dump($NotifyArray);exit;
	
	if (empty($NotifyArray)) {
		echo 'hey guess what?';
		exit;
	}

	$shop_no = isset($NotifyArray['shop_no']) ? $NotifyArray['shop_no'] : '';
	$trade_no = isset($NotifyArray['trade_no']) ? $NotifyArray['trade_no'] : '';
	$type = isset($NotifyArray['type']) ? $NotifyArray['type'] : '';
	$money = isset($NotifyArray['money']) ? floatval($NotifyArray['money']) : 0;
	$sign = isset($NotifyArray['sign']) ? $NotifyArray['sign'] : '';
	
	if($shop_no == '' || $trade_no == '' || $type == '' || $money == 0 || $sign == '') {
		echo '参数错误';
		exit;
	}
	
	if (isset($NotifyArray['shopAccountId']) && $NotifyArray['shopAccountId'] != $partner) {
		echo '此交易非本商户发起';
		exit;
	}
	
	if (isset($NotifyArray['status']) && $NotifyArray['status'] != '0') {
		echo '支付失败';
		exit;
	}
	
	$generateSign = md5($NotifyArray['shopAccountId'] . $NotifyArray['user_id'] . $NotifyArray['trade_no'] . $ApiKey . $NotifyArray['money'] . $NotifyArray['type']);
	
	#签名验证
	if ($NotifyArray['sign'] == $generateSign) {
		$verify_yn = 'Y';
	} else {
		echo '验签不正确';
		exit;
	}
			
	
	#簽名比對若正確就做資料庫加款
	if ($verify_yn == 'Y') {
		$params['user_id'] = 'N';	//沒回傳資訊，也沒提供訂單查詢，所以不檢查
		$params['order_no'] = $NotifyArray['shop_no']; 	//单号
		$params['order_money'] = $NotifyArray['money'];	//如果同时存在多个用户支付同一金额，就会和price存在一定差额，差额一般在1-2分钱上下
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
	
	
	function createSign($data, $Key) {
		$md5str = '';
		ksort($data);

		foreach ($data as $k => $v) {
			$md5str = $md5str . $v;
		}
		$sign = md5($md5str . $Key);
			
		return $sign;
	}
?>