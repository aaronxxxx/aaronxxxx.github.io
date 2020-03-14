<?php
namespace app\modules\spsix\models;

use yii;
use yii\db\ActiveRecord;

/**
 * 用户表操作
 * UserList is the model behind the user_list.
 */
class UserList extends ActiveRecord {
    /**
     * 获取用户信息（通过用户ID）   用户ID
     * @param type $user_id
     */
    static public function getUserNewsByUserId($user_id) {
        $arr = UserList::find()->where(['user_id' => $user_id])->asArray()->one();
        return $arr;
    }
    
    /**
     * 获取用户信息（通过用户名）   
     * @param type $username    用户名
     */
    static public function getUserNewsByUserName($username) {
        $arr = UserList::find()->where(['user_name' => $username])->asArray()->one();
        return $arr;
    }
    /**
     * 获取最大下注金额 
    */
    static public function getMaxMoney($user_id) {
    	if(!$user_id){$user_id="326056544";}
        $userlist = UserList::find()
                ->where(['user_id'=>$user_id])
                ->all();
        return $userlist[0]['allow_total_money'];
    }
    static public function updateUserMoneyWhenMoneyLogIsErr($bet_money_total,$userid){
        $sql = 'update user_list set money=money+' . $bet_money_total . ' where user_id=' . $userid ;
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }

    /**
     * 当用户余额>投注金额时 更新用户余额
     * @param type $balance             投注之后的金额
     * @param type $bet_money_total     今天的投注金额     
     * @param type $userid              用户ID
     */
    static public function UpdateUserMoney($balance,$bet_money_total,$userid){
        $sql = 'update user_list set money=' . $balance . ' where money>=' . $bet_money_total . ' and ' . $balance . '>=0 and user_id=' . $userid;
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }

    /**
     * 获取总用户数量
     * @return int|string
     */
    static public function getCountUser(){
        return UserList::find()->count();
    }

    /**
     * 获取用户user_id
     * @param $page
     * @return array|null|ActiveRecord
     */
    static public function getUserId($page){
        $data = UserList::find()->select('user_id')->offset($page)->limit(1)->asArray()->one();
        return $data;
    }
}