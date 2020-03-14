<?php
namespace app\modules\core\common\models;

use yii\db\ActiveRecord;

/**
 * 用户表
 */
class UserList extends ActiveRecord{
    /**
     * 六合彩订单作废修改用户金额
     * @$uid 用户ID
     * $betMoney 订单下注金额
     */
    static public function updateMoney($uid,$betMoney){
        $user = UserList::findOne(array('user_id'=>$uid));
        $user->money += $betMoney;
        $result = $user->save();
        return $result;
    }
    
    /**
     * 查询存款的用户名
     */
    static public function selectCunkuanUsername($userId){
		/*
        $username = UserList::find()
                ->select(["user_name"])
                ->where(["user_id"=>$userId])
                ->asArray()
                ->one();
		*/
		$sql = "select user_name from user_list where user_id = '".$userId."' for update";
        $username = UserList::findBySql($sql)->asArray()->one();
        return $username;
    }
}