<?php
namespace app\modules\live\common;

use vendor\utils\string\RandStringUtil;
use app\modules\live\models\LiveUser;
use app\modules\live\models\UserList;

/**
 * LiveUserUtil 真人用户操作工具集
 */
class LiveUserUtil {
    
    /**
     * 获取或者创建真人用户信息
     * @param int $uid                  用户id
     * @param string $live_type         厅标识
     * @param LiveRpcConfig $rpc_config live_rpc_config记录对象
     * @return array 
     */
    public static function getOrCreateLiveUserInfo($uid, $live_type, $rpc_config) {
        $live_user = LiveUser::findOne(['user_id' => $uid, 'live_type' => $live_type]);
        if (!empty($live_user)) {
            return [
                'name' => $live_user['live_username'],
                'pwd' => $live_user['live_password'],
            ];
        }
        
        $user = UserList::findOne(['user_id' => $uid]);
        if (empty($user) || empty($rpc_config)) {
            return ['name' => '','pwd' => ''];
        }
        
        $live_user_new = self::_createLiveUser($user, $live_type, $rpc_config);
        
        return [
            'name' => $live_user_new->live_username,
            'pwd' => $live_user_new->live_password
        ];
    }
    
    /**
     * 更新真人用户、用户金额
     * @param int $uid              用户id
     * @param string $live_type     厅标识
     * @param decimal $money_add    增加的金额
     * @return boolean              true: 成功 false: 失败
     */
    public static function updateLiveUserAndUserMoney($uid, $live_type, $money_add) {
    	
        $live_user = LiveUser::find()
                ->joinWith('userList')
                ->where([
                    LiveUser::tableName().'.user_id' => $uid,
                    'live_type' => $live_type
                ])
                ->one();

        if (empty($live_user)) {
            return false;
        }
        
        $live_user->live_money += $money_add;
        $live_user['userList']->money += -1 * $money_add;

        return $live_user['userList']->save() && $live_user->save();
    }
    
    /* ============================ 华丽的分割线 =============================== */
    /**
     * 创建真人会员
     * @param UserList $user        用户对象
     * @param string $live_type     厅标识
     * @param string $rpc_config    live_rpc_config 对象
     * @return LiveUser             真人用户对象
     */
    private static function _createLiveUser($user, $live_type, $rpc_config) {
        $live_user = new LiveUser();
		$live_user->live_username = substr($rpc_config['live_name_prefix'] . $user['user_name'], 0, 16);
		$live_user->live_password = RandStringUtil::generateNumber(10);
		$live_user->user_id = $user['user_id'];
		$live_user->live_type = $live_type;
		$live_user->update_time = date("Y-m-d H:i:s", time());
		
        // $live_user->attributes = [
            // 'live_username' => substr($rpc_config['live_name_prefix'] . $user['user_name'], 0, 16),
            // 'live_password' => RandStringUtil::generateNumber(10),
            // 'user_id' => $user['user_id'],
            // 'live_type' => $live_type
        // ];
        
        $live_user->save();
        
        return $live_user;
    }
}
