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
	require_once('Handle_RSA.php');
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
		public function buildForm($dataType, $param, $gateway, $method, $config, $rsaPrivateKey, $other_params = []) {
			
			switch($dataType){	
				case 'QRCODE':
					$parArray = $param;
					$param['signMsg'] = $this->MakeSign($parArray, $rsaPrivateKey);
					$response = $this->postCurl($param, $gateway);
					$response = json_decode($response, true);
					//var_dump($response);
					if ($response['errCode'] == '0000') {
						echo $this->generateQRwithGoogle($response['qrCode']);
					}else {
						echo "支付失败，发生错误！" . "<br>" . "错误代码:".$response['errCode'] . "<br>" . "错误描述:".$response['errMsg'];
						exit;
					}	
				break;
					
					
				case 'GATEWAY':
					$parArray = $param;
					$param['signMsg'] = $this->MakeSign($parArray, $rsaPrivateKey);
					$response = $this->postCurl($param, $gateway);
					$response = json_decode($response, true);
					//var_dump($response);
					if ($response['errCode'] == '0000') {
						header('Location:'.$response['retHtml']);
					}else {
						echo "支付失败，发生错误！" . "<br>" . "错误代码:".$response['errCode'] . "<br>" . "错误描述:".$response['errMsg'];
						exit;
					}		
				break;
				
				case 'WAP':
					$parArray = $param;
					$param['signMsg'] = $this->MakeSign($parArray, $rsaPrivateKey);
					$response = $this->postCurl($param, $gateway);
					$response = json_decode($response, true);
					//var_dump($response);
					if ($response['errCode'] == '0000') {
						header('Location:'.$response['retHtml']);
					}else {
						echo "支付失败，发生错误！" . "<br>" . "错误代码:".$response['errCode'] . "<br>" . "错误描述:".$response['errMsg'];
						exit;
					}			
				break;
			}
		}
		
		/**
		 * 设置签名，详见签名生成算法 + 生成签名
		 * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
		 */
		function MakeSign($parArray, $key) {
			unset($parArray['signType']);
			ksort($parArray);
			$signStr = $this->ToUrlParams($parArray);
			$Handle_RSA = new Handle_RSA();
			$result = $Handle_RSA->get_sign($signStr, $key);
			return $result;
		}
		
		/**
		 * 格式化参数格式化成url参数
		 */
		function ToUrlParams($arrayToUrl) {
			$buff = "";
			foreach ($arrayToUrl as $k => $v) {
				if ($k != "SIGN_DAT" && $v != "" && !is_array($v)) {
					$buff .= $k . "=" . $v . "&";
				}
			}
			$buff = trim($buff, "&");
			return $buff;
		}	
		
		/**
		* 以post方式提交json到对应的接口url
		* 
		* @param string $jsonStr  需要post的数据
		* @param string $url  url
		* @param int $second   url执行超时时间，默认30s
		* @throws PayException
		*/
	
		function postCurl($postdata, $url) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			//要求结果为字符串且输出到屏幕上
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//post提交方式
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			//运行curl
			$data = curl_exec($ch);
			//返回结果
			if ($data) {
				curl_close($ch);
				return $data;
			} else {
				$error = curl_errno($ch);
				curl_close($ch);
				echo 'curl出错，错误码:' . $error;
				exit;
			}
		}
		
		#curl post請求
		function send_curl_post($url, $returndata) {
			//dump($post_data);die;
			//$serialize_data=http_build_query($post_data);
			//dump($serialize_data);die;
			$ch = curl_init();//打开
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			//curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $returndata);
			$response  = curl_exec($ch);
			curl_close($ch);//关闭
			//var_dump($response);
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
			
		//QR產生
		function generateQRwithGoogle($url,$widthHeight ='300',$EC_level='L',$margin='0') {
			$url = urlencode($url); 
			echo '<img src="http://chart.apis.google.com/chart?chs='.$widthHeight.'x'.$widthHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$url.'" alt="QR code" widthHeight="'.$widthHeight.'" widthHeight="'.$widthHeight.'"/>';
		}
		
		/**
		* 取得加密签名
		* @param $params 要签名的数组
		* @param $key U付分配给商户的密钥
		* @param $sign_type 签名类型 默认值：RSA
		* return 签名结果字符串
		*/
		function buildMysignRSA($params, $pay_key) {
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
		}
			
		//陣列轉XML
		function arr_to_XML($arr,$key=null){
			if (!$key){
				$str = '<xml>';
			}else{
				$str = '<'.$key.'>';
			}
			foreach ($arr as $k=>$v){
				if (is_array($v)){
					$str .= $this->arr_to_XML($v,$k);
				}else {
					$str .= "<" . $k . ">" . $v . "</" . $k . ">";
				}
			}
			if (!$key) {
				$str .= "</xml>";
			}else{
				$str .= '</'.$key.'>';
			}
			return $str;
		}
		
		function xmlToArray($xml)
		{
			//禁止引用外部xml实体
			libxml_disable_entity_loader(true);
			$values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			return $values;
		}
		//反驗證
		function verifySign($sign,$data,$signMethod = OPENSSL_ALGO_SHA1,$privatekey='')
		{
			$sign = base64_decode($sign);
			$pem = file_get_contents('lib/public_key.pem');
			$verifyKey = openssl_pkey_get_public($pem);
			$r = openssl_verify($data,$sign,$verifyKey,$signMethod);
			openssl_free_key($verifyKey);
			return $r;
		}	
		//寫入log
		function logResult($word='') {
			$fp = fopen("log/".date('Y-m-d').".log","a");
			flock($fp, LOCK_EX) ;
			fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."=========".$word."\n");
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		
		public function ToXml($para_temp)
		{
			if(!is_array($para_temp) 
				|| count($para_temp) <= 0)
			{
				throw new CorefireAliPayException("数组数据异常！");
			}
			
			$xml = "<xml>";
			foreach ($para_temp as $key=>$val)
			{
				if (is_numeric($val)){
					$xml.="<".$key.">".$val."</".$key.">";
				}else{
					$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
				}
			}
			$xml.="</xml>";
			return $xml; 
		}
		public function FromXml($xml)
		{	
			if(!$xml){
				throw new CorefireAliPayException("xml数据异常！");
			}
			//将XML转为array
			//禁止引用外部xml实体
			libxml_disable_entity_loader(true);
			
			$this->values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);	
			
			return $this->values;
		}
		public static function postXmlCurl($xml, $url,$second = 30)
		{		
			$ch = curl_init();
			//设置超时
			curl_setopt($ch, CURLOPT_TIMEOUT, $second);
			
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);//TRUE
			curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//2严格校验
			//设置header
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			//要求结果为字符串且输出到屏幕上
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
			//post提交方式
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			//运行curl
			$data = curl_exec($ch);
			//返回结果
			if($data){
				curl_close($ch);
				return $data;
			} else { 
				$error = curl_errno($ch);
				curl_close($ch);
				throw new CorefireAliPayException("curl出错，错误码:$error");
			}
		}	
	}
?>