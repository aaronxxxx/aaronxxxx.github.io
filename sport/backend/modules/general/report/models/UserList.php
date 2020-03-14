<?php

namespace app\modules\general\report\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * 用户表操作
 * UserList is the model behind the agents_list.
 */
class UserList extends ActiveRecord {
    
    public static function getCeshiUserId(){
        $r = UserList::find()
                ->select(['user_id'])
                ->from('user_list')
                ->where(['group_id'=>'972'])
                ->orderBy('id desc')->asArray()->all();
         return $r;
    }

    public static function getUserIdByUserName($where) {
        $sql = "select user_id from user_list ";
        $sql .=$where;
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    //对报表中根据查询的用户名和忽略的用户名查到指定的用户id
    public static function getUserIdByUserName2($userNames,$userIgnoreName,$ExcludeGroup=null) {
        $user_ids = UserList::find()
            ->select("user_id")
            ->where("1=1");
        if($userNames[0]){
            $user_ids = $user_ids->andWhere(["user_name"=>$userNames]);
        }
        if($userIgnoreName[0]){
            $user_ids = $user_ids->andWhere(["not in","user_name",$userIgnoreName]);
        }
        if($ExcludeGroup){
            $user_ids = $user_ids->andWhere(['not in', 'user_id', $ExcludeGroup]);
        }
        
        $user_ids = $user_ids->asArray()->all();
        return $user_ids;
    }

    public static function getLiveUserNameByUserName($where) {
        $sql = "select l.live_username from user_list u,live_user l ";
        $sql .=$where;
        $sql .=" and u.user_id=l.user_id ";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }


    public static function getUserNameByUserId($user_id) {
        $r = UserList::find()
                ->select('user_name')
                ->where(['user_id' => $user_id])
                ->asArray()
                ->one();
        return $r;
    }

    /**
     * 查询会员名和忽略会员名user_id
     */
    public static function selectUserIdInOrNot($userGroupArray, $userIngoreArray) {
        $userId = Userlist::find()
                ->select(['user_id']);
        if ($userGroupArray && $userIngoreArray) {
            $userId = $userId->where(['user_name' => $userGroupArray])
                    ->andWhere(['not in', 'user_name', $userIngoreArray]);
        } elseif ($userGroupArray && !$userIngoreArray) {
            $userId = $userId->where(["user_name" => $userGroupArray]);
        } elseif (!$userGroupArray && $userIngoreArray) {
            $userId = $userId->where(['not in', 'user_name', $userIngoreArray]);
        }
        return $userId->asArray()->all();
    }

    /**
     * 查询彩票注单用户id
     * @param type $s_time
     * @param type $e_time
     * @param type $gtype
     * @param type $id
     * @return type
     */
    public static function selectLotteryOrder($s_time, $e_time, $gtype, $id) {
        $sql = "select o.user_id  FROM user_list u,order_lottery o,order_lottery_sub o_sub
               where u.user_id=o.user_id AND o_sub.bet_money>0 AND o.order_num=o_sub.order_num AND o.user_id in($id)";
        if ($s_time) {
            $sql.=" and o.bet_time>='" . $s_time . "'";
        }
        if ($e_time) {
            $sql.=" and o.bet_time<='" . $e_time . "'";
        }
        if ($gtype != "ALL_LOTTERY") {
            $sql.=" and o.Gtype='" . $gtype . "'";
        }
        $sql.=" group by o.user_id order by o_sub.id desc ";
        $data = UserList::findBySql($sql); //->AsArray()->all();
        return $data;
    }

    /**
     * 查询彩票用户信息
     * @param type $s_time
     * @param type $e_time
     * @param type $gtype
     * @param type $bid
     */
    public static function selectUserData($s_time, $e_time, $gtype, $bid) {
        $sql = "SELECT u.user_name,u.pay_name,u.user_id,
                count(o_sub.id) bet_count,sum(o_sub.bet_money) bet_money_total,
                SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) win_total
                FROM user_list u,order_lottery o,order_lottery_sub o_sub
                WHERE u.user_id in($bid) AND o.order_num=o_sub.order_num AND o.user_id=u.user_id";
        if ($gtype != "ALL_LOTTERY") {
            $sql .= " and o.Gtype='" . $gtype . "'";
        }
        if ($s_time) {
            $sql.=" and o.bet_time>='" . $s_time . "'";
        }
        if ($e_time)
            $sql.=" and o.bet_time<='" . $e_time . "'";
        $sql.=" group by o.user_id order by o_sub.id desc";
        $data = UserList::findBySql($sql)->asArray()->all();
        return $data;
    }

    public static function selectMoneyAndName($user_id) {
        $data = UserList::find()
                ->select(['user_name', 'money'])
                ->where(["user_id" => $user_id])
                ->asArray()
                ->one();
        return $data;
    }

}
