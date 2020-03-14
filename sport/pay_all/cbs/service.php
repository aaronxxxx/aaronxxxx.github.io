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
		public function buildForm($dataType, $parame, $gateway, $method, $config, $Token) {
			
			switch($dataType){	
				case 'QRCODE':
					
					
				break;
					
				case 'GATEWAY':

				
				break;
				
				case 'WAP':
					$url_new = $gateway . '/New?uID=' . $parame['uID'] . '&coinName=' . $parame['coinName'];
					$new_result = $this->curlGet($url_new, $Token);
					
					if (empty($new_result['data']) || $new_result['status'] != '0') {
						echo '错误:' . $new_result['status'] . '  描述:' . $new_result['message'];
						exit;
					}
					
					
					$url_get = $gateway . '/Get?uID=' . $parame['uID'] . '&coinName=' . $parame['coinName'];
					$get_result = $this->curlGet($url_get, $Token);
					
					if (empty($get_result['data']) || $get_result['status'] != '0') {
						echo '错误代号：' . $get_result['status'] . '  描述：' . $get_result['message'];
						exit;
					}
					
					if ($get_result['data']['addressList']['0']['coinName'] == 'ETH_USDT') {
						echo $get_result['data']['addressList']['0']['address'] . '   ' . $get_result['data']['addressList']['0']['contract'];
					}
					else if ($get_result['data']['addressList']['0']['coinName'] == 'USDT') {
						echo $get_result['data']['addressList']['0']['address'];
					}
					else {
						echo '发生不知名的错误！请关闭再重新选取交易！';
					}
					exit;
					
				break;
			}
		}
		
		
		function curlGet($url, $authorization) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Accept: application/json',
				'Authorization: bearer ' . $authorization,	
			]);
			
			$result = curl_exec($ch);
			
			if(curl_errno($ch)) {
				echo 'Curl error: ', curl_error($ch), "\n";
			}
			
			curl_close($ch);
			
			return json_decode($result, true);
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
			$postdata = http_build_query($requestdata);
			//var_dump($postdata);exit;
			$options = array( 'http' => array( 
				'method' => 'POST',
				//'header' =>'Content-type:application/json',
				'header' => 'Content-type:application/x-www-form-urlencoded;charset=UTF-8',
				'content' => $postdata,
				'timeout' =>  20,
				'ignore_errors' => true// 超时时间（单位:s）    
			));
			$context = stream_context_create($options);
			$output = file_get_contents($gateway, false, $context);
			$data = json_decode($output ,true);
			
			return $data;
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

		
		function getSign ($array, $key) {
			
			ksort($array);
			
			foreach ($array as $k => $v) {
				if ($array[$k] == '' || $k == 'sign' || $k == 'sign_type' || $k == 'key') {
					unset($array[$k]);//去除多余参数
				}
			}
			
			$arg = "";
			
			foreach ($array as $k1 => $v1) {
				$arg .= $k1 . "=" . $v1 . "&";
			}
			
			$arg = substr($arg, 0, count($arg) - 2);
			
			//如果存在转义字符，那么去掉转义
			if (get_magic_quotes_gpc()) {
				$arg = stripslashes($arg);
			}
			
			return strtolower(md5($arg . "&key=" . $key));
		}
		
		
		function buildMysignRSA($params, $pay_key) {
			ksort($params);
			$signStr = urldecode(http_build_query($params));
			$signStr .= '&key=' . $pay_key;
			return md5($signStr);
		}
		
		
		function buildToken($data, $app_secret) {
			$str = '';
			foreach ($data as $k => $v) {
				$str .= $v .',';
			}
			$str .= $app_secret;
			
			return strtoupper(hash('sha256', $str));
		}
		
	}
?>