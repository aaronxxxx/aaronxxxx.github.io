<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 17:24
 */

namespace app\modules\lottery\models\ar;


class LotteryServices
{
    /*
     * 获取赢和总额
     * param:$s_time,$e_time,$uid
     * */
    public static function getWin($s_time,$e_time,$uid){
        $sql="SELECT SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)) AS win_money "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
            . "AND o.user_id in ($uid)  LIMIT 0,1";
        $r1 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT SUM(IFNULL(o_sub.fs,0)) AS win_fs "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '0' "
            . "AND o.user_id in ($uid) AND o_sub.is_win!=2 LIMIT 0,1";
        $r2 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT SUM(IFNULL(o_sub.bet_money,0)) AS win_back "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
            . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3')"
            . "AND o.user_id in ($uid) AND o_sub.is_win!=2 LIMIT 0,1";
        $r3 = OrderLottery::findBySql($sql)->asArray()->one();
        return $r1['win_money']+$r2['win_fs']+$r3['win_back'];
    }
    /**
     * 报表明细--彩票 (下注金额）
     * @param type $s_time
     * @param type $e_time
     * @param type $uid
     * @return bet_money
     */
    public static function getBetCountMoney($s_time,$e_time,$uid){
        $sql="SELECT SUM(IFNULL(o_sub.bet_money,0)) AS bet_money "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
            . "AND o.user_id in ($uid) AND o_sub.status in('1','2') LIMIT 0,1";
        $betMoneyCount = OrderLottery::findBySql($sql)->asArray()->one();
        return $betMoneyCount['bet_money'];
    }
}