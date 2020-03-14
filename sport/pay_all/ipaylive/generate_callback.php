<?php
	
	/* *
	 * 功能：偽造第三方回調
	 * 详细：校驗接口端请求参数並回傳回調，僅提供KCY平台API送參測試
	 * 版本：1.0
	 * 日期：2019-08-08
	 */
	 
	 
	header("Content-type: text/html; charset=utf-8");
	//ini_set("display_errors", "On");
	//error_reporting(E_ALL);
	
	$postArray = $_POST;
	//var_dump($postArray);exit;
	$error_vrfy = '68d7cba04c61387cc5d912d465a17c4ddc6895b77b111bc3186d4576fbbeda1c';	//目前EXC的vrfy僅qrpay出現過
	
	$site = array (
		'22092' => array (
			'card_type' => 'qrpay',
			'rcode' => 'bc8b89c3368bb8d3400dc01fdb6f8dfb9ac1789d',
			'rate' => 0.026,
			'currency' => 'CNY',
			'tx_action' => 'PREAUTH',
			'status' => 1		//1-正常 0-異常
		),
		
		'22104' => array (
			'card_type' => 'h5pay',
			'rcode' => 'bc8b89c3368bb8d3400dc01fdb6f8dfb9ac1789d',
			'rate' => 0.026,
			'currency' => 'CNY',
			'tx_action' => 'PREAUTH',
			'status' => 1		//1-正常 0-異常
		)
	);
	//var_dump($site);exit;

	
	//------------------------測試hash取得----------------------------------
	/*$testhash = array (
		'sid' => '22104',
		'timestamp' => '1786666666',
		'item_amount_unit[]' => 200,
		'currency' => 'CNY',
	);
	
	$hash = getHash($testhash , $site['22104']['rcode']);
	echo $hash ;exit;*/
	
	//---------------------------END----------------------------------------
	
	//校驗API必填參數與部分字段固定值
	if (//empty($postArray['tid']) ||
		empty($postArray['timestamp']) ||
		empty($postArray['card_type']) ||
		empty($postArray['email']) ||
		empty($postArray['currency']) ||
		empty($postArray['amount_shipping']) ||
		empty($postArray['amount_coupon']) ||
		empty($postArray['amount_tax']) ||
		empty($postArray['item_quantity']['0']) ||
		empty($postArray['item_name']['0']) ||
		empty($postArray['item_no']['0']) ||
		empty($postArray['item_desc']['0']) ||
		empty($postArray['item_amount_unit']['0']) ||
		empty($postArray['tx_action']) ||
		$postArray['currency'] != 'CNY' ||
		$postArray['tx_action'] != 'PREAUTH' ||
		$postArray['item_amount_unit']['0'] == 0
		) { 
			if (empty($postArray['sid']) || empty($postArray['postback_url']) || empty($postArray['redirect_url'])) {
				//不回傳任何回調，因無通道資訊或回調地址
				echo json_encode(['result' => 'err', 'msg' => "未收到sid或回調地址，無法辨別商戶"], JSON_UNESCAPED_UNICODE);
				exit;
			}
			
			else {
				$createOrdermsg = getInvalidHash($postArray['sid'], $error_vrfy);
				send_post($postArray['postback_url'], $createOrdermsg);
				exit;
			}	
		}
		
	//校驗sid與card_type資訊
	$checksid = false;
	$check_card_type = false;
	
	foreach ($site as $k => $v) {
		foreach ($v as $k2 => $v2) {
			if ($k == $postArray['sid'] && $v2 == $postArray['card_type']) {
				$checksid = true;
				$check_card_type = true;
				//echo $k . $v2;
				break;
			}
		}
	}
	
	if (!$checksid || !$check_card_type) {
		//sid錯誤不回傳任何回調，card_type錯誤並無EXC範例，故先採不發送假想的回調
		echo json_encode(['result' => 'err', 'msg' => "sid錯誤或card_type錯誤"], JSON_UNESCAPED_UNICODE);
		exit;
	}
	
	
	//確認hash是否存在，目前已知若未夾帶hash，澳洲方將不會有回調，會帶參數跳轉至redirect_url
	if (empty($postArray['hash'])) {
		$createOrdermsg = getInvalidHash($postArray['sid'], $error_vrfy);
		$createOrdermsg = http_build_query($createOrdermsg);
		header('Location:' . $postArray['redirect_url'] . '?' . $createOrdermsg);
		exit;
	}
	
	
	//正式進入流程
	switch($postArray['card_type']) {

		case 'qrpay':
			
			//校驗hash
			$getOrderHash = md5($postArray['sid'] . $postArray['timestamp'] . $postArray['item_amount_unit']['0'] . $postArray['currency'] . $site['22092']['rcode']);
			
			if ($getOrderHash != $postArray['hash']) {
				$createOrdermsg = getInvalidHash($postArray['sid'], $error_vrfy);
				send_post($postArray['postback_url'], $createOrdermsg);
				exit;
			}
			
			//訂單建立成功回調
			$createOrdermsg = array (
				'sid' => $postArray['sid'],
				'status' => 'OK',
				'parent_txid' => getRandomOrder(),
				'txid' => getRandomOrder(),
				'tx_action' => $postArray['tx_action'],
				'amount' => $postArray['item_amount_unit']['0'],
				'currency' => $postArray['currency'],
				'tid' => $postArray['tid'],
				'comment' => '下单成功',
				'descriptor' => 'RX FW QR CUP',
			);
			
			$createOrdermsg['vrfy'] = getVRFY($createOrdermsg, $site['22092']['rcode']);
			//var_dump($createOrdermsg);exit;
			send_post($postArray['postback_url'], $createOrdermsg);
			

			//訂單支付成功回調
			$fees = $postArray['item_amount_unit']['0'] * $site['22092']['rate'];
			$actual_amount = $postArray['item_amount_unit']['0'] - $fees;
			
			$createPayresultmsg = array (
				'sid' => $postArray['sid'],
				'status' => 'OK',
				'parent_txid' => getRandomOrder(),
				'txid' => getRandomOrder(),
				'tx_action' => 'SETTLEMENT',
				'amount' => $postArray['item_amount_unit']['0'],
				'currency' => $postArray['currency'],
				'tid' => $postArray['tid'],
				'sitereceive' => $actual_amount,
				'settlementamount' => $actual_amount,
				'settlementcurrency' => $postArray['currency'],
			);
			
			$createPayresultmsg['vrfy'] = getVRFY($createPayresultmsg, $site['22092']['rcode']);
			//var_dump($createPayresultmsg);exit;
			send_post($postArray['postback_url'], $createPayresultmsg);
			
			break;
			
			
			
		case 'h5pay':
			
			//驗證card_no
			if (empty($postArray['card_no'])) {
				//h5pay類型通道若不輸入card_no會帶參數跳轉至redirect_url，並不會產生回調
				$createOrdermsg = array (
					'sid' => $postArray['sid'],
					'status' => 'EXC',
					'parent_txid' => getRandomOrder(),
					'txid' => getRandomOrder(),
					'tx_action' => $postArray['tx_action'],
					'amount' => $postArray['item_amount_unit']['0'],
					'currency' => $postArray['currency'],
					'tid' => $postArray['tid'],
					'comment' => '',
					'descriptor' => 'Mobile H5',
					'error_msg' => '参数有误,卡号不能为空',
					'paymentinfo' => 'user redirect'
				);
				$createOrdermsg['vrfy'] = getVRFY($createOrdermsg, $site['22104']['rcode']);
				$createOrdermsg = http_build_query($createOrdermsg);
				header('Location:' . $postArray['redirect_url'] . '?' . $createOrdermsg);
				exit;
			}
			
			//校驗hash
			$getOrderHash = md5($postArray['sid'] . $postArray['timestamp'] . $postArray['item_amount_unit']['0'] . $postArray['currency'] . $site['22104']['rcode']);
			
			if ($getOrderHash != $postArray['hash']) {
				$createOrdermsg = getInvalidHash($postArray['sid'], $error_vrfy);
				send_post($postArray['postback_url'], $createOrdermsg);
				exit;
			}
			
			//訂單建立成功回調
			$createOrdermsg = array (
				'sid' => $postArray['sid'],
				'status' => 'OK',
				'parent_txid' => getRandomOrder(),
				'txid' => getRandomOrder(),
				'tx_action' => $postArray['tx_action'],
				'amount' => $postArray['item_amount_unit']['0'],
				'currency' => $postArray['currency'],
				'tid' => $postArray['tid'],
				'comment' => '下单成功',
				'descriptor' => 'Mobile H5',
				'paymentinfo' => 'user redirect'
			);
			
			$createOrdermsg['vrfy'] = getVRFY($createOrdermsg, $site['22104']['rcode']);
			//var_dump($createOrdermsg);exit;
			send_post($postArray['postback_url'], $createOrdermsg);
			
			
			//訂單支付成功回調
			$fees = $postArray['item_amount_unit']['0'] * $site['22104']['rate'];
			$actual_amount = $postArray['item_amount_unit']['0'] - $fees;
			
			$createPayresultmsg = array (
				'sid' => $postArray['sid'],
				'status' => 'OK',
				'parent_txid' => getRandomOrder(),
				'txid' => getRandomOrder(),
				'tx_action' => 'SETTLEMENT',
				'amount' => $postArray['item_amount_unit']['0'],
				'currency' => $postArray['currency'],
				'tid' => $postArray['tid'],
				'sitereceive' => $actual_amount,
				'settlementamount' => $actual_amount,
				'settlementcurrency' => $postArray['currency'],
			);
			
			$createPayresultmsg['vrfy'] = getVRFY($createPayresultmsg, $site['22104']['rcode']);
			//var_dump($createPayresultmsg);exit;
			send_post($postArray['postback_url'], $createPayresultmsg);
			
			break;
	}
	
	
	
	function getRandomOrder () {
		
        $characters = '0123456789';
        $randomOrderNumber = '15';
		
        for ($i = 0; $i < 14; $i++) { 
            $randomOrderNumber .= $characters[rand(0, strlen($characters) - 1)]; 
        }
		
		return $randomOrderNumber;
	}
	
	function getHash ($data, $rcode) {
		
		$Hash = md5($data['sid'] . $data['timestamp'] . $data['item_amount_unit[]'] . $data['currency'] . $rcode);
		
		return $Hash;
	}
	
	function getVRFY ($data, $rcode) {
		
        $hashStr = $data['sid'] . ';' . $rcode . ';' . $data['txid'] . ';' . $data['status'] . ';' . $data['amount'] . ';' . $data['currency'] . ';' . $data['tx_action'];
        $hashData = hash('sha256', $hashStr);
		
        return $hashData;
    }
	
	function getInvalidHash ($sid, $vrfy) {
		
		$parame = array (
			'sid' => $sid,
			'status' => 'EXC',
			'error_msg' => 'Invalid Hash',
			'vrfy' => $vrfy
		);
		
		return $parame;
	}

	function send_post ($gateway, $requestdata) {
		
        $postdata = http_build_query($requestdata);
        $options = array( 'http' => array( 
            'method' => 'POST',
            'header' =>'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' =>  10, // 超时时间（单位:s） 
            'ignore_errors' => true   
            )  
        );
        $context = stream_context_create($options);
        $output = file_get_contents($gateway, false, $context);
        //$data = json_decode($output ,true);
        return $output;
    }
?>