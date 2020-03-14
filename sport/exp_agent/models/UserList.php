<?php
namespace app\models;

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
}