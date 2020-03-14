<?php
namespace app\modules\live\common;

use app\modules\general\sysmng\models\ar\SysConfig;
use app\modules\live\models\UserList;
use Yii;

/**
 * LiveExchangeUtil 真人转账操作工具集
 */
class LiveExchangeUtil {
	
// 	/**
// 	 * 是否允许转账到真人平台
// 	 * @param string $uid  用户id
// 	 * @return boolean      true: 通过 false: 未通过
// 	 */
// 	public static function checkTransferToLive($uid) {
// 		$userone=UserList::findOne(['user_id'=>$uid]);
// 		$flag=$userone["is_allow_live"];
// 		return $flag==1 ? true : false;
// 	}
	
	/**
	 * 校验最小转账金额限额
	 * @param int $credit   操作金额
	 * @return boolean      true: 通过 false: 未通过
	 */
	public static function checkMinimumLimit($credit) {
		$sys_config = SysConfig::find()->one();
	
		if (empty($sys_config)) {
			return false;
		}
		return $credit < (int)$sys_config['min_change_money'] ? false : true;
	}
	
    /**
     * 校验金额
     * @param int $uid              用户id
     * @param int $credit           操作金额
     * @param string $live_type     真人标识
     * @param boolean $isWithdraw   是否取款
     * @return json
     */
    public static function checkMoney($uid, $credit, $live_type, $isWithdraw = false) {
        if (!$isWithdraw) {
            return self::_checkMoney_deposit($uid, $credit, $live_type);  // 转入平台
        } else {
            return self::_checkMoney_withdraw($uid,$credit, $live_type);			// 转出平台
        }
    }
    

    
    /* ============================ 华丽的分割线 =============================== */
    /**
     * 校验存款金额
     * @param int $uid          用户id
     * @param int $credit       操作金额
     * @param string $live_type 厅标识
     * @return json
     */
    private static function _checkMoney_deposit($uid, $credit, $live_type) {
        $data = [
            'code' => 0,
            'data' => [],
            'msg' => '',
        ];
        
        if (!self::_checkBalanceLimit($uid, $credit)) {
            $data['code'] = 3;
            $data['msg'] = '该账户余额不足';
        } else if (!self::_checkHallBalanceLimit ($credit, $live_type)) {
            $data['code'] = 4;
            $data['msg'] = '单次转账超过厅最大限额!';
        }
        
        return $data;
    }

    /**
     * 校验取款金额
     * @param int $uid      用户id
     * @param int $credit   操作金额
     * @return boolean      true: 通过 false: 未通过
     */
    private static function _checkBalanceLimit($uid, $credit) {
        $user = UserList::findOne(['user_id' => $uid]);
        if (empty($user)) {
            return false;
        }
        
        return $credit > (int)$user['money'] ? false : true;
    }

    /**
     * 校验厅限额余额
     * @param int $credit       操作金额
     * @param type $live_type   厅标识
     * @return boolean          true: 通过 false: 未通过
     */
    private static function _checkHallBalanceLimit($credit, $live_type) {
        $sys_srv = LiveServiceUtil::getSysService();
        $balance = $sys_srv->queryHallLimitBalance($live_type);
        
        if (empty($balance) || !is_numeric($balance)) {
            return false;
        }

        return $balance >= $credit ? true : false;
    }
    
    /**
     * 校验取款金额
     * @param int $credit       操作金额
     * @param string $live_type 厅标识
     * @return json
     */
    private static function _checkMoney_withdraw($uid,$credit, $live_type) {
    	$data = [
    	'code' => 0,
    	'data' => [],
    	'msg' => '',
    	];
    	if (!self::_checkLiveBalance($uid, $credit, $live_type)) {
    		$data['code'] = 5;
    		$data['msg'] = $live_type . '厅余额不足';
    	}
    
    	return $data;
    }
    
    /**
     * 校验真人余额
     * @param int $credit       操作金额
     * @param type $live_type   厅标识
     * @return boolean          true: 通过 false: 未通过
     */
    private static function _checkLiveBalance($uid,$credit, $live_type) {
        $params = [
        	'uid' => $uid,
            'type' => LiveUtil::getTypeByLiveType($live_type),
        ];
    	$query_ret = Yii::$app->runAction('live/query-balance-api/inner-query', $params);
    	$json = json_decode($query_ret);

    	if (empty($json) || (int)$json->code != 0) {
    		return false;
    	}
    
    	return (int)$json->data->balance >= $credit ? true : false;
    }
}

