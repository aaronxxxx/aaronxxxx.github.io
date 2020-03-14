<?php
/* *
* 功能：服务器异步通知页面
* 日期：2019-2-18
*/
header("Content-type: text/html; charset=utf-8");
require_once('../PublicConf.class.php');
require_once('config.php');


$config = new PublicConf('cbs');
//获取配置信息
$configdata = $config->get_config();
$configext = configExt($configdata, 'prod');


$postdata = file_get_contents("php://input", 'r');
$data = json_decode($postdata, true);
//var_dump($data);exit;
$hashKey = trim($configext["config"]["key"]);
$authorization = trim($configext["config"]["token"]);
$postUrl = 'http://api-trading.git4u.net:63344/Wallet/Withdrawal';

$data['timestamp'] = time();
$data['hashValue'] = buildHashValue($data, $hashKey);

//$jsonData = json_encode($data);
$result = curlPost($postUrl, $data, $authorization);
var_dump($result);exit;



//transID coinName amount destAddress timestamp
function buildHashValue($data, $key)
{
	$hashStr = strtolower($data['transID']) . strtolower($data['coinName']) . sprintf("%.8f", $data['amount']) . strtolower($data['destAddress']) . $data['timestamp'] . $key;
	$hashValue = base64_encode(hash('sha256', $hashStr, true));
	return substr($hashValue, 0, 20);
}

#curl post請求
function curlPost($url, $data, $authorization)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_HEADER, false);		
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($ch, CURLOPT_POST, true);

	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json; charset=utf-8',
		'Accept: application/json',
		'Authorization: bearer ' . $authorization,
	]);

	$result = curl_exec($ch);

	if (curl_errno($ch)) {
		echo 'Curl error: ', curl_error($ch), "\n";
	}

	curl_close($ch);

	return $result;
}
