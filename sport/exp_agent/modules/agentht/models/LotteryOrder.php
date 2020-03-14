<?php
namespace app\modules\agentht\models;

use yii;
use yii\db\ActiveRecord;
/**
 * lottery表
 * LotteryOrder is the model behind the agents_list.
 */
class LotteryOrder extends ActiveRecord{
    
    
    static public function getBetMoneyAndCount($id,$type,$s_time,$e_time){
        $sql="SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o.Gtype = '$type' "
                . "AND o.user_id=$id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    
    static public function getWin($id,$type,$s_time,$e_time){
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
                . "AND o.Gtype = '$type' AND o.user_id=$id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $r1 = UserList::findBySql($sql)->asArray()->all();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '0' "
                . "AND o.Gtype = '$type' AND o.user_id IN ('19052778') AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $r2 = UserList::findBySql($sql)->asArray()->all();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.Gtype = '$type' AND o.user_id=$id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $r3 = UserList::findBySql($sql)->asArray()->all();
        return $r1['win_money']+$r2['win_fs']+$r3['win_back'];
    }
    
}