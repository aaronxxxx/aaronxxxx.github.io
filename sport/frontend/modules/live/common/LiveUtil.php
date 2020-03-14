<?php
namespace app\modules\live\common;

use app\modules\core\common\models\UserList;
use app\modules\live\models\LiveConfig;
use app\modules\live\models\LiveRpcConfig;
use vendor\utils\string\RandStringUtil;

/**
 * LiveUtil 真人操作工具集
 */
class LiveUtil {
    private static $_live_types = [
            '1' => 'AG',
            '2' => 'AG',
            '3' => 'AGIN',
            '4' => 'AGIN',
            '5' => 'AG_BBIN',
            '6' => 'AG_BBIN',
            '7' => 'DS',
            '8' => 'DS',
            '9' => 'AG_OG',
            '10' => 'AG_OG',
            '11' => 'AG_MG',
            '12' => 'AG_MG',
            '13' => 'OG',
            '14' => 'OG',
            '15' => 'KG',
            '16' => 'KG',
			'17' => 'PT',
            '18' => 'PT',
			'19' => 'VR',
            '20' => 'VR',
            '21' => 'AI',
            '22' => 'AI',
        ];
	private static $game_type=[//MG游戏厅升级参数调整
	   'ReelGems'=>'reelgems',
	   'HotInkV90'=>'HotInk',
	   'AvalonV90'=>'Avalon',
	   'thetwistedcircus'=>'thetwistedcircus',
	   'LuckyKoiV90'=>'LuckyKoi',//幸运的锦鲤
	   'Roulette'=>'EuropeanRouletteGold',
	   'octopays'=>'mermaidsmillions',
	   'AsianBeauty'=>'AsianBeauty',
	   'EuropeanAdvBJ'=>'europeanbjgold',
	   'RetroReelsV90'=>'retroreels',
	   'Gold'=>'ClassicBlackjackGold',//
	   'pureplatinum'=>'PurePlatinum',//白金俱乐部
	];

    /**
     * 获取厅标识
     * @param int $type         操作编号
     * @param boolean $isDouble 是否双组
     */
    public static function getLiveTypeByType($type, $isDouble = true) {
        if (!$isDouble) {
            self::$_live_types = [
                '1' => 'AG',
                '2' => 'AGIN',
                '3' => 'AG_BBIN',
                '4' => 'DS',
                '5' => 'AG_OG',
                '6' => 'AG_MG',
                '7' => 'OG',
                '8' => 'KG',
				'9' => 'PT',
                '10' => 'VR',
                '11' => 'AI'
            ];
        }

        $live_type = array_key_exists((string)$type, self::$_live_types) ?
                self::$_live_types["$type"] : '';

        return $live_type;
    }

	public static function getGameType($flash_id){//MG大厅获取游戏id

	}
    /**
     * 获取电子游艺厅标识
     * @param int $type         操作编号
     * @param boolean $isDouble 是否双组
     */
    public static function getGameLiveTypeByType($type, $isDouble = true) {
        if (!$isDouble) {
            self::$_live_types = [
                '1001' => 'AG',
                '1002' => 'AGIN',
                '1003' => 'AG_BBIN',
                '1004' => 'DS',
                '1005' => 'AG_OG',
                '1006' => 'AG_MG',
            ];
        }

        $live_type = array_key_exists((string)$type, self::$_live_types) ?
                self::$_live_types["$type"] : '';

        return $live_type;
    }

    /**
     * 获取厅标识对应的操作编号
     * @param string $live_type 厅标识
     * @param boolean $isDouble 是否双组
     * @return string
     */
    public static function getTypeByLiveType($live_type, $isDouble = false) {
        if (!$isDouble) {
            self::$_live_types = [
                '1' => 'AG',
                '2' => 'AGIN',
                '3' => 'AG_BBIN',
                '4' => 'DS',
                '5' => 'AG_OG',
                '6' => 'AG_MG',
                '7' => 'OG',
                '8' => 'KG',
				'9' => 'PT',
                '10' => 'VR',
                '11' => 'AI'
            ];
        }

        $types = array_flip(self::$_live_types);

        if (empty($types)) {
            return '';
        }

        $type = array_key_exists((string)$live_type, $types) ?
                $types["$live_type"] : '';

        return $type;
    }

    /**
     * 获取真人登录参数
     * @param string $live_type 厅标识
     * @return array
     */
    public static function getLoginParamsByLiveType($uid, $live_type) {
        $live_config = LiveConfig::findOne(['live_type' => $live_type, 'status' => 1]);
        $rpc_config = LiveRpcConfig::find()->one();
        $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);

        if (empty($live_config) || empty($rpc_config)) {
            return [];
        }

		if ($live_user_info['name'] == '' || $live_user_info['pwd'] == '') {
            return [];
        }

        return [
            'name' => $live_user_info['name'],
            'pwd' => $live_user_info['pwd'],
            'cagent' => $live_config['cagent'],
            'actype' => 1,
            'game_type' => $live_config['game_type'],
            'nickname' => '',
            'line' => 1,
			'rpc_config' => $rpc_config
        ];
    }

    /**
     * 获取电子游艺登录参数
     * @param string $live_type 厅标识
     * @return array
     */
    public static function getGameLoginParamsByLiveType($uid, $live_type, $actype) {
        $live_config = LiveConfig::findOne(['live_type' => $live_type, 'status' => 1]);
        $rpc_config = LiveRpcConfig::find()->one();
        $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);

        if (empty($live_config) || empty($rpc_config)) {
            return [];
        }

		if($actype == 0){	//試玩
			//查詢今日取號
			$currDate = date('Y-m-d');
			$filename = "testPlay.json";
			if(file_exists($filename)){
				$jsonData = file_get_contents($filename);
				$content = json_decode($jsonData,true);
				if(isset($content[$currDate])){
					$content[$currDate]['no']++;
					$no = $content[$currDate]['no'];
				}else{
					$content[$currDate]['no'] = 1;
					$no = 1;
				}
			}else{
				$no = 1;
				$content[$currDate]['no'] = 1;
			}
			file_put_contents($filename, json_encode($content));
			$accountName = 'test'.sprintf("%05d", $no);

			$userParams = [
				'name' => $accountName,
				'pwd' => 'password',
				'cagent' => $live_config['cagent'],
				'actype' => $actype,
				'game_type' => $live_config['e_game_type'],
				'nickname' => '',
				'line' => 1,
			];
		}else{
			$userParams = [
				'name' => $live_user_info['name'],
				'pwd' => $live_user_info['pwd'],
				'cagent' => $live_config['cagent'],
				'actype' => 1,
				'game_type' => $live_config['e_game_type'],
				'nickname' => '',
				'line' => 1,
			];
		}

        return $userParams;
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

    /**
     * 获取真人转账参数
     * @param int $uid          用户id
     * @param int $type         操作编号
     * @param int $credit       操作金额
     * @param string $live_type 厅标识
     * @return array
     */
    public static function getExchangeParamsByLiveType($uid, $type, $credit, $live_type) {
        $user = UserList::findOne(['user_id' => $uid]);
        $live_config = LiveConfig::findOne(['live_type' => $live_type, 'status' => 1]);
        $rpc_config = LiveRpcConfig::find()->one();
        $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);

        if (empty($user) || empty($live_config) || empty($rpc_config)) {
            return [];
        }

        return [
            'name' => $live_user_info['name'],
            'pwd' => $live_user_info['pwd'],
            'ai_userid' => $live_user_info['ai_userid'],
            'cagent' => $live_config['cagent'],
            'actype' => 1,
            'billno' => date("YmdHis") . RandStringUtil::generateNumber(4),
            'credit' => $credit,

            'live_type' => $live_type,
            'user_assets' => $user['money'],
            'user_id' => $uid,
            'zz_type' => $type,
            'about' => '真人转账',
        ];
    }

    /**
     * 获取OG真人转账参数
     * @param int $uid          用户id
     * @param int $type         操作编号
     * @param int $credit       操作金额
     * @param string $live_type 厅标识
     * @return array
     */
    public static function getExchangeParamsByLiveType2($uid, $type, $credit, $live_type) {
        $user = UserList::findOne(['user_id' => $uid]);
        $rpc_config = LiveRpcConfig::find()->one();
        $live_user_info = LiveUserUtil::getOrCreateLiveUserInfo($uid, $live_type, $rpc_config);
        $live_config = LiveConfig::findOne(['live_type' => $live_type, 'status' => 1]);

        if (empty($user) || empty($rpc_config)) {
            return [];
        }

        return [
            'name' => $live_user_info['name'],
            'pwd' => $live_user_info['pwd'],
            'ai_userid' => $live_user_info['ai_userid'],
            'actype' => 1,
            'billno' => $live_type . date("YmdHis") . RandStringUtil::generateNumber(4),
            'credit' => $credit,
            'live_type' => $live_type,
            'user_assets' => $user['money'],
            'user_id' => $uid,
            'zz_type' => $type,
            'about' => '真人转账',
            'rpc_server_domain' => $rpc_config['rpc_server_domain'],
			'cagent' => $live_config['cagent'],
			'deposit_name' => $live_config['deposit_name'],
			'withdraw_name' => $live_config['withdraw_name'],
			'rpc_client_name' => $rpc_config['rpc_client_name'],
			'og_server_class' => $rpc_config['og_server_class'],
			'kg_server_class' => $rpc_config['kg_server_class'],
			'vr_server_class' => $rpc_config['vr_server_class'],
			'pt_server_class' => $rpc_config['pt_server_class'],
        ];
    }

    /**
     * 获取真人可查询订单的真人标识，暂时只支持AG/AGIN/DS
     * @return array
     */
    public static function getQueryOrderLiveTypes() {
        return [
            self::$_live_types['1'],
            self::$_live_types['3'],
            self::$_live_types['7'],
        ];
    }

    /**
     * 获取AG真人对应操作编号
     * @return array
     */
    public static function getAgTypes() {
        return [
            1,2,3,4,5,6,9,10,11,12
        ];
    }

    /**
     * 获取DS真人对应操作编号
     * @return array
     */
    public static function getDsTypes() {
        return [
            7,8
        ];
    }

    /**
     * 获取OG真人对应操作编号
     * @return array
     */
    public static function getOgTypes() {
        return [
            13,14
        ];
    }

	/**
     * 获取KG真人对应操作编号
     * @return array
     */
    public static function getKgTypes() {
        return [
            15,16
        ];
    }

	/**
     * 获取PT对应操作编号
     * @return array
     */
    public static function getPtTypes() {
        return [
            17,18
        ];
    }

	/**
     * 获取VR彩票对应操作编号
     * @return array
     */
    public static function getVrTypes() {
        return [
            19,20
        ];
    }

	/**
     * 获取AI对应操作编号
     * @return array
     */
    public static function getAiTypes() {
        return [
            21,22
        ];
    }

    /* ============================ 华丽的分割线 =============================== */
}
