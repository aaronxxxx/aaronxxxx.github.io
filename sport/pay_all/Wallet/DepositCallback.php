<?php
	/* *
	 * 功能：接收虛擬幣入金回調通知
	 * 日期：2019-11-21
	 */
	header("Content-type: text/html; charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('../cbs/config.php'); 
	
	//記錄接收Log
	$filename = 'log/DepositCallback.log';
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
	
	//重要參數過濾
	if (empty($NotifyArray['systemID']) ||
		empty($NotifyArray['depositHistories']['0']['uid']) ||
		empty($NotifyArray['depositHistories']['0']['id']) ||
		empty($NotifyArray['depositHistories']['0']['coinName']) ||
		empty($NotifyArray['depositHistories']['0']['amount'])
		) {
		exit('参数错误');
	}
	
	if ($NotifyArray['systemID'] != $partner) {
		exit('此交易非本商店发起');
	}

	//回調內容存入DB
	$saveCallback = $config->save_deposit_callback(json_encode($NotifyArray), $NotifyArray['depositHistories']['0']['id']);
	//var_dump($NotifyArray);exit;

	//$getRate = $config->get_rate('in');
	//$rate = $getRate ['in_rate'];

	$params = [
		'user_id' => $NotifyArray['depositHistories']['0']['uid'],
		'order_no' => $NotifyArray['depositHistories']['0']['id'],
		'coinName' => $NotifyArray['depositHistories']['0']['coinName'],
		'order_money' => $NotifyArray['depositHistories']['0']['amount'],
		//'odds' => $rate, //語法有問題，返回應是陣列
		'odds' => 1,
		'order_time' => date('Y-m-d h:i:s')
	];

	$result = $config->syunibiDepositTransaction($params);
	if ($result['status'] == 0) {
		$config->write_log($result['msg']);
	}
	elseif ($result['status'] == 1) {
		$config->write_log($result['msg'], true);
	}
