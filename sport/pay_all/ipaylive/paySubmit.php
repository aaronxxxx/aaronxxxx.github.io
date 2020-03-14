<html>
<head>
<script type="text/javascript" src="/static2/jquery/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<?php
	header("Content-type:text/html;charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('config.php');
	require_once('service.php');
	
	//ini_set("display_errors", "On");
	$config = new PublicConf('ipaylive');
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	//获取获取支付方式
	$payType = $_POST['payType'];
	$bankCode = $_POST['bankCode'];
	$is_timer = False;
	$uid = $config->encrypt($_POST['uid'], 'D', $configdata['user_key']);		//回传参数
	$orderNo = $_POST['user_name'].'_'.date('YmdHis').mt_rand(100,999);			//訂單號嗎	
	// 往数据库添加数据
	$config->order_bak($orderNo, $_POST['totalAmount'], $uid, $_POST['user_name'], $bankCode);		
	$url = $configext["config"]["request_gateway"];		//支付接口
	$rsaPrivateKey = $configext["config"]["pay_key"];	//私鑰
	//$amount = floor($_POST['totalAmount']);				//订单金额
	$amount = sprintf("%.2f", $_POST['totalAmount']);

	switch($payType){
		case 'QRCODE':
			$parameter = [
				'agents_id' => $configext["config"]["merchantappId"],
				'order_no' => $orderNo,
				'postback_url' => $configext["config"]["notify_url"],
				'timestamp' => time(),
				'channel' => $bankCode,
				'email' => $configext["config"]["merchantappId"] . '+qrpay@gmail.com',
				'amount' => $amount,
			];
			//var_dump($parameter); exit;
			$Service = new Service();
			$order = $Service->buildForm($payType, $parameter, $url, "POST", $configext['config'], $rsaPrivateKey);
		break;

		case 'GATEWAY':
			if (check_mobile()) {
				echo '该方式仅支持使用浏览器支付，推荐使用IE浏览器为佳'; exit;
			}

			$parameter = [
				'agents_id' => $configext["config"]["merchantappId"],
				'order_no' => $orderNo,
				'postback_url' => $configext["config"]["notify_url"],
				'timestamp' => time(),
				'channel' => 12,
				'email' => $configext["config"]["merchantappId"] . '+vnet@gmail.com',
				'amount' => $amount,
				'bankcode' => $bankCode,
				//'browse_device' => 'pc'
			];
			//var_dump($parameter); exit;
			$Service = new Service();
			$order = $Service->buildForm($payType, $parameter, $url, "POST", $configext['config'], $rsaPrivateKey);
		break;
		
		case 'WAP':
			$parameter = [
				'agents_id' => $configext["config"]["merchantappId"],
				'order_no' => $orderNo,
				'postback_url' => $configext["config"]["notify_url"],
				'timestamp' => time(),
				'channel' => 12,
				'email' => $configext["config"]["merchantappId"] . '+vnet@gmail.com',
				'amount' => $amount,
				'bankcode' => $bankCode,
				//'browse_device' => 'pc'
			];

			//var_dump($parameter); exit;
			$Service = new Service();
			$order = $Service->buildForm($payType, $parameter, $url, "POST", $configext['config'], $rsaPrivateKey);
		break;

	}
	
	#取得使用者IP
	function getIP() {
		if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}else {
			$ip = $_SERVER["REMOTE_ADDR"];
		}
		return $ip;
	}
	
	#生成随机串
	function generateRandomString($length = 10) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 
		for ($i = 0; $i < $length; $i++) { 
			$randomString .= $characters[rand(0, strlen($characters) - 1)]; 
		} 
		return $randomString; 
	}
	
	function check_mobile(){
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
        $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";   
        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
        $regex_match.=")/i";
        return preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
    }
?>
<br/>
<br/>
<br/>
<br/>
<div>●二维扫码请于"<a id="timer">300</a>"秒内完成支付，超时自动关闭视窗</div>
<!--<div>●完成支付后 ，请自行关闭视窗或２０秒内系统自动关闭视窗。</div>-->
<script type="text/javascript">
	function check_order_status() {
		$.ajax({
			url: '<?=$configext["config"]["inquiry_url"]?>',
			type: 'POST',
			data: {
				order_No: '<?=$orderNo?>'
			},
			error: function(xhr) {
				return xhr;
				},
			success: function(response) {
				return response;
				}
		});
	}
	
	
	var time_count = 0;
	//10秒後,關閉視窗
	$().ready(
	function(){
		var xtime=15;
		for (var i = 0; i < 301; i++) {
			(function(num){
				setTimeout(function(){

					$("a#timer").html(300-num);
					if ((num+1)>xtime)
					{
						console.log('訪問訂單:');
						if(check_order_status() == 'ok')
						{
							console.log('ok');
							window.close();
						}
						else
						{
							console.log((num+1));
							if((num+1)>=300)
							{
								window.close();
							}
						}
						xtime = xtime + 15;
					}
					}, 1000 * (i + 1));
			})(i);
		}
	});
	
	function isValue(val){
    var v = val.value;
    if(v == 'NaN' || v == null || v == ''){
        return 0;
    }else{
        //全行轉半型
        result="";
        for(i=0;i <= v.length;i++){        
         if( v.charCodeAt(i)== 12288){
                result+=" ";
         }else{
                if(v.charCodeAt(i) > 65280 && v.charCodeAt(i) < 65375){
                 result += String.fromCharCode(v.charCodeAt(i) - 65248);
                }else{
                 result += String.fromCharCode(v.charCodeAt(i));
                }
         }
        }
        val.value = result;
        v=result;
        return v;
		}
	}
</script>
</body>
</html>