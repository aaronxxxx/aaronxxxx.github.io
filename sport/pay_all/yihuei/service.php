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
		public function buildForm($dataType, $parameter, $gateway, $method, $config, $rsaPrivateKey, $Appid, $other_params = []) {
			
			switch($dataType){	
				case 'QRCODE':
					
					
				break;
					
				case 'GATEWAY':
					$data = $parameter;
					unset($parameter['ReturnUrl'], $parameter['remark']);					
					$str = $this->getvalue($parameter) . $Appid;
					//---------------RSA簽名----------------------
					$res = openssl_get_privatekey($rsaPrivateKey);
					$sign_falg = openssl_sign($str, $sign, $res, OPENSSL_ALGO_SHA256);
					openssl_free_key($res);
					//--------------------------------------------
					if ($sign_falg) {
						$sign_base64 = base64_encode($sign);
						$data['sign'] = $sign_base64;
					}else{
						echo 'wrong';exit;
					}
					//var_dump($data);exit;
					$result = $this->po($gateway, $data);
					exit;
					
				break;
				
				case 'WAP':
					$data = $parameter;
					unset($parameter['ReturnUrl'], $parameter['remark']);					
					$str = $this->getvalue($parameter) . $Appid;
					//---------------RSA簽名----------------------
					$res = openssl_get_privatekey($rsaPrivateKey);
					$sign_falg = openssl_sign($str, $sign, $res, OPENSSL_ALGO_SHA256);
					openssl_free_key($res);
					//--------------------------------------------
					if ($sign_falg) {
						$sign_base64 = base64_encode($sign);
						$data['sign'] = $sign_base64;
					}else{
						echo 'wrong';exit;
					}
					//var_dump($data);exit;
					$result = $this->po($gateway, $data);
					//$result = $this->send_curl_post($gateway, $data);
					//var_dump($result);
					exit;
					
				break;
			}
		}
		
		function po($apiurl, $data) {
			echo '<!DCOTYPE HTML> ';
			echo '<html>';
			echo '<head>';
			echo '<meta charset="utf-8">';
			echo '</head>';
			echo '<body onload="document.dinpayForm.submit();">';
			echo '<form name="dinpayForm" action="'.$apiurl.'" method="post">';
			foreach($data as $k=>$v) {
				echo '	<input type="hidden" name="'.$k.'" value="'.$v.'" >';
			}
			echo '</html> ';
			exit;
		}
		
		#curl post請求
		function send_curl_post($url, $requestData) {
			$ch = curl_init();//打开
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
			//规避SSL验证
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);
			//curl_close($ch);//关闭
			if ($response) {
				curl_close($ch);
				return $response;
			} else {
				$error = curl_errno($ch);
				curl_close($ch);
				echo 'curl出错，错误码:' . $error;	exit;
			}
			//var_dump($response);
			//$response = json_decode($response, true);
			return $response;
		}
			
		#一般post請求
		function send_post($gateway, $requestdata) {
			$postdata = http_build_query($requestdata);
			//var_dump($postdata);
				$options = array( 'http' => array( 'method' => 'POST','header' =>'Content-type:application/x-www-form-urlencoded','content' => $postdata,'timeout' =>  60 // 超时时间（单位:s）    
				)  );
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
			/*/while (list ($key, $val) = each ($data))
			{
				$sHtml.= "<input type='hidden' name='".$key."' value='".$val."' />";
			}*/
			foreach ($data as $key => $value) {
				$sHtml.= "<input type='hidden' name='".$key."' value='".$value."' />";
				//echo $key .':'. $value . "\n";
			}
			//echo $sHtml;
			$sHtml = $sHtml."<input type='submit' value='确定' style='display:none;'></form>";
			$sHtml = $sHtml."<script>document.forms['requestForm'].submit();</script>";
			return $sHtml;
		}
			
		//QR產生(use google API) 大陆当地会锁
		function generateQRwithGoogle($url, $widthHeight = '300', $EC_level = 'L', $margin = '0') {
			$url = urlencode($url); 
			echo '<img src="http://chart.apis.google.com/chart?chs='.$widthHeight.'x'.$widthHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$url.'" alt="QR code" widthHeight="'.$widthHeight.'" widthHeight="'.$widthHeight.'"/>';
		}
		
		function getvalue($data) {
			$str = "";
			foreach ($data as $k => $v) {
				$str .= $v . "|";
			}
			return $str;
		}
		
		/**
		* 取得加密签名
		* @param $params 要签名的数组
		* @param $key U付分配给商户的密钥
		* @param $sign_type 签名类型 默认值：RSA
		* return 签名结果字符串
		*/
		/*function buildMysignRSA($params, $pay_key) {
			//ksort($params);
			$string = '';
			$temp_array = [];
			foreach($params as $key1 => $value1) {
				if($value1 != '') {
					$temp_array[] = $key1 . '=' . $value1;
				}
			}
			$string = implode('&', $temp_array);
			$string = iconv("utf-8","gb2312//IGNORE",$string);
			$string = md5($string . $pay_key);
			return $string;
		}*/
		
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
		
		//unicode字元转utf-8(多个字符请用下方function)
		function unicode_to_utf8($unicode_str) {
			$utf8_str = '';
			$code = intval(hexdec($unicode_str));
			//这里注意转换出来的code一定得是整形，这样才会正确的按位操作
			$ord_1 = decbin(0xe0 | ($code >> 12));
			$ord_2 = decbin(0x80 | (($code >> 6) & 0x3f));
			$ord_3 = decbin(0x80 | ($code & 0x3f));
			$utf8_str = chr(bindec($ord_1)) . chr(bindec($ord_2)) . chr(bindec($ord_3));
			return $utf8_str;
		}
		
		#-------------unicode字串(含非unicode字元夹杂) 转utf-8处理---------------#
		function unicodestr_to_utf8str($unicode_str) {
			$strArray = explode("\\", $unicode_str);
			$unicodeArray = '';
			foreach ($strArray as $k => $v) {
				if ($v == "") continue;
				else {
					$v = substr($v, 0, 5);
					$v = "\\" . $v;
					$unicodeArray[$k] = $v;
				}
			}
			//var_dump($unicodeArray);exit;
			$utf8_Array = '';
			foreach ($unicodeArray as $k => $v) {
				$utf8_Array[$k] = $this->unicode_to_utf8($v);
			}
			//var_dump($utf8_Array);exit;
			foreach ($strArray as $k => $v) {
				if ($v == "") unset($strArray[$k]);
				else {
					$v = substr($v, 5);
					$strArray[$k] = $v;	
				}
			}
			//var_dump($strArray);exit;
			$utf8_Str = '';
			foreach ($utf8_Array as $k1 => $v1) {
				foreach ($strArray as $k2 => $v2) {
					if($k1 == $k2) {
						$utf8_Str .= $v1 . $v2;
					} else continue;
				}
			}
			return $utf8_Str;
		}
				
	}
?>