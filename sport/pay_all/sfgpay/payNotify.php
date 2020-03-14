<?php
	/* *
	 * 功能：服务器异步通知页面
	 * 日期：2019-2-18
	 */
	header("Content-type: text/html; charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('config.php'); 
	require_once('service.php');
	
	//記錄接收Log
	$filename = 'log/payNotify.log';
	//file_put_contents($filename, '1.'.date('Y-m-d H:i:s').json_encode($_GET).'---IP from:'.getIP().PHP_EOL, FILE_APPEND);
	file_put_contents($filename, '2.'.date('Y-m-d H:i:s').json_encode($_POST).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '3.'.date('Y-m-d H:i:s').json_encode($GLOBALS['HTTP_RAW_POST_DATA']).PHP_EOL, FILE_APPEND);
	##### html包体解决方式 #####
	//$postdata = file_get_contents("php://input",'r');
	//file_put_contents($filename, '4.'.date('Y-m-d H:i:s').$postdata.PHP_EOL, FILE_APPEND);
	$config = new PublicConf('sfgpay');
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	//$ApiKey = $configext["config"]["pay_key"];
	$appid = $configext["config"]["merchantappId"];
	$NotifyArray = $_POST;
	//var_dump($NotifyArray);exit;
	$verify_yn = 'N';
	
	if (isset($NotifyArray['pay_order_id'])) {
		
		$token = md5(urlencode($NotifyArray['order_id']) . urlencode($NotifyArray['money']) . urlencode($NotifyArray['mark_buy']) .
				 urlencode($NotifyArray['pay_order_id']) . urlencode($NotifyArray['time']) . $appid);
				 
		if ($NotifyArray['token'] == $token) {
			$verify_yn = 'Y';
		} else {
			echo '验签不正确'; exit;}
	} else {echo '回调异常'; exit;}
	
	
	#簽名比對若正確就做資料庫加款
	if ($verify_yn == 'Y') {
		$params['user_id'] = 'N';	//沒回傳資訊，也沒提供訂單查詢，所以不檢查
		$params['order_no'] = $NotifyArray['pay_order_id']; 	//单号
		$params['order_money'] = $NotifyArray['money'] * 0.01;	//如果同时存在多个用户支付同一金额，就会和price存在一定差额，差额一般在1-2分钱上下
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