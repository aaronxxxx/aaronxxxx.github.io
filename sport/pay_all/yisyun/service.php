<?php
	/* *
	 * 类名：Service
	 * 功能：支付接口构造类
	 * 详细：构造支付接口请求参数
	 * 版本：1.0
	 * 日期：2018-10-30
	 */
	header("Content-type: text/html; charset=utf-8");
	require_once('../PublicConf.class.php');
	require_once('config.php');
	//ini_set("display_errors", "On");
	class Service {
		private $config;
		/**
		 * 构造提交表单HTML数据
		 * @param $para_temp 请求参数数组
		 * @param $gateway 网关地址
		 * @param $method 提交方式。两个值可选：post、get
		 * @param $button_name 确认按钮显示文字
		 * @return 提交表单HTML文本
		 */
		public function buildForm($dataType, $parame, $gateway, $method, $config, $ApiKey, $other_params = []) {
			
			switch($dataType){	
				case 'QRCODE':
					$parame['sign'] = md5($parame['shopAccountId'] . $parame['shopUserId'] . $parame['amountInString'] . $parame['shopNo'] . $parame['payChannel'] . $ApiKey);
					
					$response = $this->buildRequestForm($gateway, $parame);
					var_dump($response);
					exit;
				break;
					
				case 'GATEWAY':

				
				break;
				
				case 'WAP':
					
					
				break;
			}
		}
		
		function curlPost($payApi, $json) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $payApi);
			curl_setopt($ch, CURLOPT_HEADER, false);		
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);	
			curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Content-Length: ' . strlen($json)
			]);
			
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			
			$result = curl_exec($ch);
			
			if(curl_errno($ch)) {
				echo 'Curl error: ', curl_error($ch), "\n";
			}
			curl_close($ch);
			
			return $result;
		}
		
		#curl post請求
		function send_curl_post($url, $requestData) {
			//dump($post_data);die;
			//$serialize_data=http_build_query($post_data);
			//dump($serialize_data);die;
			$ch = curl_init();//打开
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			//curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			#规避SSL验证
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);
			//curl_close($ch);//关闭
			if ($response) {
				curl_close($ch);
				var_dump($response); exit;
				//$response = json_decode($response, true);
				return $response;
			} else {
				$error = curl_errno($ch);
				curl_close($ch);
				echo 'curl出错，错误码:' . $error;	exit;
			}
			return $response;
		}
			
		#一般post請求
		function send_post($gateway, $requestdata) {
			//$postdata = http_build_query($requestdata);
			//var_dump($postdata);
				$options = array( 'http' => array( 
					'method' => 'POST',
					//'header' =>'Content-type:application/json',
					'header' => 'Content-type:application/x-www-form-urlencoded',
					'content' => $requestdata,
					'timeout' =>  20,
					'ignore_errors' => true// 超时时间（单位:s）    
				));
				$context = stream_context_create($options);
				$output = file_get_contents($gateway, false, $context);
				//$data = json_decode($output ,true);
			echo $output;
		}
		
		/**
		 * 建立跳转请求表单
		 * @param string $url 数据提交跳转到的URL
		 * @param array $data 请求参数数组
		 * @param string $method 提交方式：post或get 默认post
		 * @return string 提交表单的HTML文本
		 */
		function buildRequestForm($url, $data, $method = 'post')
		{
			$sHtml = "<form id='requestForm' name='requestForm' action='".$url."' method='".$method."'>";
			/*while (list ($key, $val) = each ($data))
			{
				$sHtml.= "<input type='hidden' name='".$key."' value='".$val."' />";
			}*/
			foreach ($data as $key => $value) {
				$sHtml.= "<input type='hidden' name='".$key."' value='".$value."' />";
				//echo $key .':'. $value . "\n";
			}
			//$sHtml.= "<input type='hidden' name='url' value='".$data."'/>";
			//echo $sHtml; exit;

			$sHtml = $sHtml."<input type='submit' value='确定' style='display:none;'></form>";
			$sHtml = $sHtml."</form>";
			//echo $sHtml;exit;
			$sHtml = $sHtml."<script>document.forms['requestForm'].submit();</script>";
			echo $sHtml;
			//return $sHtml;
		}
			
		//QR產生
		function generateQRwithGoogle($url,$widthHeight ='300',$EC_level='L',$margin='0') {
			$url = urlencode($url); 
			echo '<img src="http://chart.apis.google.com/chart?chs='.$widthHeight.'x'.$widthHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$url.'" alt="QR code" widthHeight="'.$widthHeight.'" widthHeight="'.$widthHeight.'"/>';
		}

		
		function createSign($data) {
			$md5str = '';
			ksort($data);

			foreach ($data as $k => $v) {
				$md5str = $md5str . $v;
			}
			$sign = md5($md5str);
			
			return $sign;
		}
		
		function buildMysignRSA($params, $pay_key) {
			ksort($params);
			$signStr = urldecode(http_build_query($params));
			$signStr .= '&key=' . $pay_key;
			return md5($signStr);
		}
		
		function buildKey($aims) {
			$key = '';
			foreach($aims as $k => $v) {
				$key .= $v;
			}
			$key = md5($key);
			return $key;
		}
		
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
	}
?>