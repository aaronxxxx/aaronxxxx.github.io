<?php
	/*
	設定
	* @param $PublicConf	cleint端 pay_set 設定
	* @param $type    		prod：正式參數
	* @return array
	*/
	function configExt(array $PublicConf, $type = 'prod'){
		$config = [
			'prod' => [
				'prefex' => $PublicConf['user_key'],
				'merchantappId' => $PublicConf['merchant_id'],	//商戶號ID
				'merchantId' => $PublicConf['merchant_userNO'],//帳戶號
				'pay_key' => $PublicConf['pay_key'],		//加解密的key
				'public_key' => $PublicConf['public_key'],	//公鑰
				'return_url' => 'http://' . $PublicConf['f_url'].'/shunjie/payReturn.php',	//页面跳转同步通知页面路径
				'notify_url' => 'http://' . $PublicConf['f_url'].'/shunjie/payNotify.php',	//服务器异步通知页面路径
				'inquiry_url' => 'http://' . $PublicConf['f_url'].'/shunjie/order_inquiry.php',
				'qrimg_url' => 'http://' . $PublicConf['f_url'].'/shunjie/QRImg.php',	//服务器异步通知页面路径
				'input_charset' => 'UTF-8',					//字符编码格式 目前支持 utf-8
				'request_gateway' => 'http://pay.shunjie8686.com/orderpay.do'			//API URL
			]
		];
		
		$return = [
			'config' => $config[$type],
			'type' => [
				
				/*'ZHIFUBAO' => [
					'img' => 'radio-img-zfb',
					'name' => '支付宝',
					'value' => '0',
					'type' => 'pc'
				],
				'QQ' => [
					'img' => 'radio-img-qq',
					'name' => 'QQ錢包',
					'value' => '7',
					'type' => 'pc'
				],			
				'WEIXIN' => [
					'img' => 'radio-img-weixin',
					'name' => '微信',
					'value' => '1',
					'type' => 'pc'
				],	*/
				/*'UNIONPAY' => [
					'img' => 'radio-img-unionpay',
					'name' => '银联扫码',
					'value' => 'UNIONPAY',
					'type' => 'pc'
				],
				'WCKPAY' => [
					'img' => '',
					'name' => '快捷支付',
					'value' => 'WCKPAY',
					'type' => 'pc'
				],
				'WCKPAYWAP' => [
					'img' => '',
					'name' => '快捷支付WAP',
					'value' => 'WCKPAYWAP',
					'type' => 'pc'
				],
				/*
				'JDPAY' => [
					'img' => 'radio-img-jdpay',
					'name' => '京东扫码',
					'value' => 'JD',
					'type' => 'pc'
				],
				'JDPAYWAP' => [
					'img' => 'radio-img-jdpaywap',
					'name' => '京东WAP',
					'value' => 'JDWAP',
					'type' => 'mobile'
				],
				'BAIDU' => [
					'img' => '',
					'name' => '百度钱包',
					'value' => 'BAIDU',
					'type' => 'pc'
				],
				'BAIDUWAP' => [
					'img' => '',
					'name' => '百度钱包WAP',
					'value' => 'BAIDUWAP',
					'type' => 'mobile'
				],
				'WCKPAY' => [
					'img' => '',
					'name' => '快捷支付',
					'value' => 'WCKPAY',
					'type' => 'pc'
				],
				'61' => [
					'img' => 'radio-img-unionpay',
					'name' => '银联快捷',
					'value' => '0',
					'type' => 'all'
				],*/
				'02' => [
					'img' => 'radio-img-weixin',
					'name' => '微信H5',
					'value' => '0',
					'type' => 'mobile'
				],
				'12' => [
					'img' => 'radio-img-zfb',
					'name' => '支付宝H5',
					'value' => '0',
					'type' => 'mobile'
				],
				'11' => [
					'img' => 'radio-img-zfb',
					'name' => '支付宝',
					'value' => '0',
					'type' => 'pc'
				],
				/*'WXP' => [
					'img' => 'radio-img-weixin',
					'name' => '微信',
					'value' => '1',
					'type' => 'mobile'
				],
				/*'QQH5' => [
					'img' => 'radio-img-qq',
					'name' => 'QQ錢包',
					'value' => '7',
					'type' => 'mobile'
				],*/
				
				'71' => [
					'img' => 'radio-img-unionpay',
					'name' => '银联扫码',
					'value' => 'UNIONPAY',
					'type' => 'pc'
				],/*
				'GATEWAY' => [
					'img' => 'radio-img-gateway',
					'name' => '网关',
					'value' => 'GATEWAY',
					'type' => 'all'
				*/
				
			],
			
			'bankCode' => [		
				/*'1' => [
					'img' => 'radio-img-zfb',
					'name' => '支付宝',
					'value' => 'alipay',
				],
				'2' => [
					'img' => 'radio-img-weixin',
					'name' => '微信',
					'value' => 'WXP',
				],
				/*'ICBC' => [
					'img' => 'radio-img-icbc',
					'name' => '中国工商银行',
					'value' => 'ICBC'
				],
				'ABC' => [
					'img' => 'radio-img-abc',
					'name' => '中国农业银行',
					'value' => 'ABC'
				],
				'CCB' => [
					'img' => 'radio-img-ccb',
					'name' => '中国建设银行',
					'value' => 'CCB'
				],
				'BOC' => [
					'img' => 'radio-img-boc',
					'name' => '中国银行',
					'value' => 'BOC'
				],
				
				'CMB' => [
					'img' => 'radio-img-cmbc',
					'name' => '招商银行',
					'value' => 'CMB'
				],
				
				/*'BCCB' => [
					'img' => 'radio-img-bccb',
					'name' => '北京银行',
					'value' => 'BCCB'
				],*/
				/*
				'BOCO' => [
					'img' => 'radio-img-bocom',
					'name' => '交通银行',
					'value' => 'BOCO'
				],*/
				/*'CIB' => [
					'img' => 'radio-img-cib',
					'name' => '兴业银行',
					'value' => 'CIB'
				],/*
				'NJCB' => [
					'img' => 'radio-img-njcb',
					'name' => '南京银行',
					'value' => 'NJCB'
				],
				*/
				/*'CMBC' => [
					'img' => 'radio-img-cmbcs',
					'name' => '中国民生银行',
					'value' => 'CMBC'
				],
				'CEB' => [
					'img' => 'radio-img-cebbank',
					'name' => '中国光大银行',
					'value' => 'CEB'
				],*/
				/*
				'PINGANBANK' => [
					'img' => 'radio-img-pinganbank',
					'name' => '平安银行',
					'value' => 'PINGANBANK'
				],
				'CBHB' => [
					'img' => 'radio-img-cbhb',
					'name' => '渤海银行',
					'value' => 'CBHB'
				],
				'HKBEA' => [
					'img' => 'radio-img-hkbea',
					'name' => '东亚银行',
					'value' => 'HKBEA'
				],
				'NBCB' => [
					'img' => 'radio-img-nbcb',
					'name' => '宁波银行',
					'value' => 'NBCB'
				],
				'CTTIC' => [
					'img' => 'radio-img-cttic',
					'name' => '中信银行',
					'value' => 'CTTIC'
				],*//*
				'GDB' => [
					'img' => 'radio-img-cgb',
					'name' => '广发银行',
					'value' => 'GDB'
				],
				
				/*'SHB' => [
					'img' => 'radio-img-shb',
					'name' => '上海银行',
					'value' => 'SHB'
				],*/
				
				/*'SPDB' => [
					'img' => 'radio-img-spdb',
					'name' => '浦发银行',
					'value' => 'SPDB'
				],
				
				'PSBC' => [
					'img' => 'radio-img-psbc',
					'name' => '中国邮政储蓄银行',
					'value' => 'PSBC'
				],
				
				'HXB' => [
					'img' => 'radio-img-hxb',
					'name' => '华夏银行',
					'value' => 'HXB'
				],/*
				'BJRCB' => [
					'img' => 'radio-img-bjrcb',
					'name' => '北京农村商业银行',
					'value' => 'BJRCB'
				],
				'SRCB' => [
					'img' => 'radio-img-srcb',
					'name' => '上海农商银行',
					'value' => 'SRCB'
				],
				'SDB' => [
					'img' => 'radio-img-sdb',
					'name' => '深圳发展银行',
					'value' => 'SDB'
				],*/
				/*'CZB' => [
					'img' => 'radio-img-czb',
					'name' => '浙江稠州商业银行',
					'value' => 'CZB'
				],
				'61' => [
					'img' => 'radio-img-unionpay',
					'name' => '网关支付',
					'value' => 'WCKPAY'
				],*/
				
			]
		];
		
		return $return;
	}
?>