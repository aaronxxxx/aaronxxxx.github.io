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
	$config = new PublicConf('yihuei');
	//获取配置信息
	$configdata = $config->get_config();
	$configext = configExt($configdata, 'prod');
	//获取获取支付方式
	$payType = $_POST['payType'];
	$bankCode = $_POST['bankCode'];
	echo $payType . ' '. $bankCode;exit;
	$is_timer = False;
	$uid = $config->encrypt($_POST['uid'], 'D', $configdata['user_key']);		//回传参数
	$orderNo = date('YmdHis') . mt_rand(10000,99999);			//訂單號嗎
	// 往数据库添加数据
	$config->order_bak($orderNo, $_POST['totalAmount'], $uid, $_POST['user_name'], $bankCode);		
	$url = $configext["config"]["request_gateway"];		//支付接口
	$rsaPrivateKey = file_get_contents("lib/private_key.pem");	//私鑰
	$Appid = $configext["config"]["Appid"];
	//$amount = floor($_POST['totalAmount']);				//订单金额
	$amount = number_format($_POST['totalAmount'], 2);
	
	
	switch($payType){
		case 'QRCODE':
			exit;
		break;

		case 'GATEWAY':
			$parameter = [
				'Version' => '1.0',
				'MchId' => $configext["config"]["merchantappId"],
				'MchOrderNo' => $orderNo,
				'PayType' => $bankCode,
				//'PayType' => $bankCode,
				'Amount' => $amount,
				'OrderTime' => date('YmdHis'),
				'ClientIp' => $_SERVER['REMOTE_ADDR'],
				'NotifyUrl' => $configext["config"]["notify_url"],
				'ReturnUrl' => $configext["config"]["return_url"],
				'remark' => $_POST['user_name'],
			];			
			//var_dump($parameter);	exit;
			$Service = new Service();
			$order = $Service->buildForm($payType, $parameter, $url, "POST", $configext['config'], $rsaPrivateKey, $Appid);
			
		break;
		
		case 'WAP':
			$parameter = [
				'Version' => '1.0',
				'MchId' => $configext["config"]["merchantappId"],
				'MchOrderNo' => $orderNo,
				'PayType' => $bankCode,
				//'PayType' => $bankCode,
				'Amount' => $amount,
				'OrderTime' => date('YmdHis'),
				'ClientIp' => $_SERVER['REMOTE_ADDR'],
				'NotifyUrl' => $configext["config"]["notify_url"],
				'ReturnUrl' => $configext["config"]["return_url"],
				'remark' => $_POST['user_name'],
			];
			//var_dump($parameter);	exit;
			$Service = new Service();
			$order = $Service->buildForm($payType, $parameter, $url, "POST", $configext['config'], $rsaPrivateKey, $Appid);
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