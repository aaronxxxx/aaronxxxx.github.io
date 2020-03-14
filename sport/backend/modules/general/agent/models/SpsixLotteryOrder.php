<?php
namespace app\modules\general\agent\models;

use yii\db\ActiveRecord;
/**
 * SixLotteryOrder
 * SixLotteryOrder is the model behind the agents_list.
 */
class SpsixLotteryOrder extends ActiveRecord{
    
    public static function getOrderId($s_time,$e_time,$id){
        $sql="select o_sub.id FROM spsix_lottery_order o,spsix_lottery_order_sub o_sub where o_sub.bet_money>0 "
                . "AND o.order_num=o_sub.order_num AND o.user_id=$id "
                . "and o.bet_time>='$s_time' and o.bet_time<='$e_time' "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 order by o_sub.id desc";
        $r = SpsixLotteryOrder::findBySql($sql)->asArray()->all();
        return $r;
    }

    public static function getOrderDelailSix($arr_id){
        $r = SpsixLotteryOrder::find()
                ->select([
                    'o.lottery_number AS qishu','o.rtype_str','o.bet_time','o.order_num','o_sub.number','o_sub.bet_money AS bet_money_one',
                    'o_sub.fs','o_sub.bet_rate AS bet_rate_one','o_sub.is_win','o_sub.status','o.user_id','o_sub.id AS id',
                    'o_sub.win AS win_sub','o_sub.balance','o_sub.order_sub_num'
                    ])
                ->from('spsix_lottery_order as o')
                ->innerJoin('spsix_lottery_order_sub as o_sub','o.order_num = o_sub.order_num')
                ->where(['in','o_sub.id',$arr_id])
                ->orderBy('o_sub.id desc');
        return $r;
    }
//    public static function getBetMoneyAndCount($s_time, $e_time, $id) {
//        $sql="SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
//                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
//                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o.user_id=$id "
//                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
//        $r = SixLotteryOrder::findBySql($sql)->asArray()->one();
//        return $r;
//    }
    
//    public static function getWin($s_time, $e_time, $id) {
//        $sql="";
//        $r = SixLotteryOrder::findBySql($sql)->asArray()->one();
//        return $r;
//    }
    
    
}