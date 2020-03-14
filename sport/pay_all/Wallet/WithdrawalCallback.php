<?php
	/* *
	 * 功能：接收虛擬幣入金回調通知
	 * 日期：2019-11-21
	 */
	header("Content-type: text/html; charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('../cbs/config.php'); 
	
	//記錄接收Log
	$filename = 'log/WithdrawalCallback.log';
	//file_put_contents($filename, '1.'.date('Y-m-d H:i:s').json_encode($_GET).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '2.'.date('Y-m-d H:i:s').json_encode($_POST).PHP_EOL, FILE_APPEND);
	//file_put_contents($filename, '3.'.date('Y-m-d H:i:s').json_encode($GLOBALS['HTTP_RAW_POST_DATA']).PHP_EOL, FILE_APPEND);
	##### html包体解决方式 #####
	$postdata = file_get_contents("php://input",'r');
	file_put_contents($filename, '4.'.date('Y-m-d H:i:s').$postdata.PHP_EOL, FILE_APPEND);	

	$config = new PublicConf('cbs');
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	$partner = trim($configext["config"]["merchantappId"]);

	$NotifyArray = json_decode($postdata, true);
	if (empty($NotifyArray)) {
		exit('Invalid request');
	}

	//回調內容存入DB
	$saveCallback = $config->save_withdrawal_callback(json_encode($NotifyArray));
	//var_dump($NotifyArray);exit;
	
	//重要參數過濾
	if (empty($NotifyArray['systemID']) ||
		!isset($NotifyArray['withdrawalHistories']['0']['status']) ||
		empty($NotifyArray['withdrawalHistories']['0']['uid']) ||
		empty($NotifyArray['withdrawalHistories']['0']['transID']) ||
		empty($NotifyArray['withdrawalHistories']['0']['coinName']) ||
		empty($NotifyArray['withdrawalHistories']['0']['amount'])
		) {
		exit('参数错误');
	}
	
	if ($NotifyArray['systemID'] != $partner) {
		exit('此交易非本商店发起');
	}

	if ($NotifyArray['withdrawalHistories']['0']['status'] != '1') {
		exit('该笔交易尚未成功出金');
	}


	$params = [
		'user_id' => $NotifyArray['withdrawalHistories']['0']['uid'],
		'order_no' => $NotifyArray['withdrawalHistories']['0']['transID'],
		'coinName' => $NotifyArray['withdrawalHistories']['0']['coinName'],
		'order_money' => $NotifyArray['withdrawalHistories']['0']['amount'],
		'order_time' => date('Y-m-d h:i:s')
	];

	$result = $config->syunibiWithdrawalTransaction($params);
	if ($result['status'] == 0) {
		$config->write_log($result['msg']);
	}
	elseif ($result['status'] == 1) {
		$config->write_log($result['msg'], true);
	}
