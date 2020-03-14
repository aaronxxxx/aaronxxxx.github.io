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
	$config = new PublicConf('hongyun');
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
	$rsaPrivateKey = trim($configext["config"]["pay_key"]);	//私鑰
	//$amount = floor($_POST['totalAmount']);				//订单金额
	$amount = sprintf("%.2f", $_POST['totalAmount']);

	
	switch($payType){
		case 'QRCODE':
			$parameter1 = [
				'mchid' => trim($configext["config"]["merchantappId"]),
				'timestamp' => time(),
				'nonce' => generateRandomString(),
			];
			
			$parameter2 = [
				'paytype' => $bankCode,
				'out_trade_no' => $orderNo,
				'goodsname' => 'online-pay',
				'total_fee' => $amount,
				'notify_url' => $configext["config"]["notify_url"],
				'return_url' => $configext["config"]["return_url"],
				'requestip' => getIP()
			];
			//var_dump($parameter1, $parameter2); exit;
			$Service = new Service();
			$order = $Service->buildForm($payType, $parameter1, $url, "POST", $configext['config'], $rsaPrivateKey, $parameter2);
		
		break;

		case 'GATEWAY':
		
			exit;
		break;
		
		case 'WAP':
			
			exit;
		break;

	}
	
	#获取客户端IP
	function getIP() {
		
		$onlineip = 'Unknown';
		
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
			
            $real_ip = $ips['0'];
			
            if ($_SERVER['HTTP_X_FORWARDED_FOR'] && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $real_ip))
            {
                $onlineip = $real_ip;
            }
			
            else if (isset($_SERVER['HTTP_CLIENT_IP']) == true && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP']))
            {
                $onlineip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
		
        if ($onlineip == 'Unknown' && isset($_SERVER['HTTP_CDN_SRC_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CDN_SRC_IP']))
        {
            $onlineip = $_SERVER['HTTP_CDN_SRC_IP'];
            $c_agentip = 0;
        }
		
        if ($onlineip == 'Unknown' && isset($_SERVER['HTTP_NS_IP']) && preg_match ( '/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER ['HTTP_NS_IP'] ))
        {
            $onlineip = $_SERVER ['HTTP_NS_IP'];
            $c_agentip = 0;
        }
		
        if ($onlineip == 'Unknown' && isset($_SERVER['REMOTE_ADDR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['REMOTE_ADDR']))
        {
            $onlineip = $_SERVER['REMOTE_ADDR'];
            $c_agentip = 0;
        }
		
        return $onlineip;
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