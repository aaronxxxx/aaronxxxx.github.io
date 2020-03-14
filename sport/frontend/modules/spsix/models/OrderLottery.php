<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * 金额日志
 * MoneyLog is the model behind the money_log.
 */
class OrderLottery extends ActiveRecord {
    
    static public function getOneDayOrder($user_id, $day, $gType) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND o.Gtype = '{$gType}'";
        $row = OrderLottery::findBySql($sql)->asArray()->all();
        return $row[0];
    }
    
    /**
     * 获取一整天的彩票下注金额
     * @param type $user_id         用户ID
     * @param type $day             时间
     * @return type
     */
    static public function getOneDayTotalCount($user_id, $day) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money  FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}'";
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        return $query[0];
    }
    /**
     * 获取一整天的彩票下注金额的最终结果
     * @param type $user_id 用户ID
     * @param type $day     时间
     * @return type
     */
    static public function getOneDayTotalWin($user_id, $day) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND o_sub.is_win = 1 LIMIT 0,1";
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal = $query[0]['win_money'];
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND o_sub.is_win = 0 LIMIT 0,1";
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_fs'];
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}'AND (o_sub.is_win = 2 OR o_sub.is_win = 3) LIMIT 0,1";
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_back'];
        return $winTotal;
    }
    
    
    static public function getOneDayTotalWinByType($user_id, $day, $gType) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>='{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND o_sub.is_win = 1 AND o.Gtype ='{$gType}' LIMIT 0,1";
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal = $query[0]['win_money'];
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>='{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND o_sub.is_win = 0 AND o.Gtype ='{$gType}' LIMIT 0,1";
        $query2 = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query2[0]['win_fs'];
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back FROM order_lottery o,order_lottery_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num
AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND (o_sub.is_win = 2 OR o_sub.is_win = 3) AND o.Gtype ='{$gType}' LIMIT 0,1";
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_back'];
        return $winTotal;
    }

    static public function getId($day,$where,$gType){
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = "select o_sub.id  FROM order_lottery o,order_lottery_sub o_sub
                    where o_sub.bet_money>0 AND o.order_num=o_sub.order_num
                    AND o.bet_time>= '" . $oneDayStart . "' AND o.bet_time<='" .$oneDayEnd ."' AND o.Gtype='".$gType."' {$where}";
        $r = OrderLottery::findBySql($sql)->asArray()->all();
        return $r;
    }

    static public function getAllNews($bid){
        $sql = "SELECT o.lottery_number AS qishu,o.rtype_str,o.bet_time,o.order_num,
                        o_sub.number,o_sub.bet_money AS bet_money_one,o_sub.fs,
                        o_sub.bet_rate AS bet_rate_one,o_sub.is_win,o_sub.status,o_sub.quick_type,
                        o_sub.id AS id,o_sub.win AS win_sub,o_sub.balance,o_sub.order_sub_num
              FROM order_lottery o,order_lottery_sub o_sub
              WHERE o_sub.id in($bid) AND o.order_num=o_sub.order_num
              order by o_sub.id desc";
        $r = OrderLottery::findBySql($sql)->asArray()->all();
        return $r;
    }
}