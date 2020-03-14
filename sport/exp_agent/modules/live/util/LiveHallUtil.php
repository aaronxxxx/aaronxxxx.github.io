<?php
namespace app\modules\live\util;

use app\modules\live\models\LiveConfig;
use app\modules\live\models\LiveRpcConfig;

use app\modules\live\common\LiveUserUtil;

class LiveHallUtil{
	
	const AG_JS_LIVETYPE = 'AG';        // AG 极速厅真人类型1
	const AG_GJ_LIVETYPE = 'AGIN';      // AG 国际厅真人类型2
	const AG_BBIN_LIVETYPE = 'AG_BBIN'; // AG BBIN厅真人类型3
	const AG_OG_LIVETYPE = 'AG_OG';     // AG OG厅真人类型5
	const AG_MG_LIVETYPE = 'AG_MG';     // AG MG厅真人类型6
	const DS_LIVETYPE = 'DS';           // DS 真人类型4
	
	const AG_JS_CAGENT = 'G05_AG';     // AG 极速厅代理号1
	const AG_GJ_CAGENT = 'G05_AGIN';   // AG 国际厅代理号2
	const AG_BBIN_CAGENT = 'G05_BBIN'; // AG BBIN厅代理号3
	const AG_OG_CAGENT = 'G05_OG';     // AG OG厅代理号5
	const AG_MG_CAGENT = 'G05_NMG';    // AG MG厅代理号6
	const DS_CAGENT = 'G05_DS';        // DS 代理号
	
	public static function getLiveHallArr(){
		$arr=[
			'1'=>'AG',
			'2'=>'AGIN',
			'3'=>'AG_BBIN',
			'4'=>'DS',
			'5'=>'AG_OG',
			'6'=>'AG_MG',
            '7'=>'OG',
            '8'=>'KG',
    	];
		return $arr;
	}
	public static function getLiveAgentArr(){
		$arr=[
			'1'=>'G05_AG',
			'2'=>'G05_AGIN',
			'3'=>'G05_BBIN',
			'4'=>'G05_DS',
			'5'=>'G05_OG',
			'6'=>'G05_DS',
    	];
		return $arr;
	}
	
	/**
	 * 获取真人查询余额参数
	 * @param int $uid          用户id
	 * @param string $live_type 厅标识
	 * @return array
	 */
	public static function getQueryBalanceParamsByLiveType($uid, $live_type) {
		$live_config = LiveConfig::findOne(['live_type' => $live_type, 'status' => 1]);
		$rpc_config = LiveRpcConfig::find()->one();
		$live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);
	
		if (empty($live_config) || empty($rpc_config)) {
			return [];
		}
	
		return [
		'name' => $live_user_info['name'],
		'pwd' => $live_user_info['pwd'],
		'cagent' => $live_config['cagent'],
		'actype' => 1,
		];
	}
}