<?php
namespace app\modules\general\member\models\TransactionLog;

use yii\db\ActiveRecord;
use app\modules\six\models\SixLotterySchedule;

/**
 * 六合彩
 * SixLotteryOrder is the model behind the six_lottery_order.
 */
class SixLotteryOrder extends ActiveRecord{
    
    public static function getOneDayNews($start_time, $end_time, $user_group){
        $sql	= "SELECT o.lottery_number AS qishu,o.rtype_str,o.rtype_str_sub,o.bet_time,o.order_num,
                        o_sub.number,o_sub.bet_money AS bet_money_one,o_sub.fs,
                        o_sub.bet_rate AS bet_rate_one,o_sub.is_win,o_sub.status,
                        o_sub.id AS id,o_sub.win AS win_sub,o_sub.balance,o_sub.order_sub_num
              FROM six_lottery_order o,six_lottery_order_sub o_sub
              WHERE o.bet_time>='$start_time' and o.bet_time<='$end_time' AND o.order_num=o_sub.order_num AND o.user_id='".$user_group."'
              order by o_sub.status asc,o_sub.id desc";
        return $sql;
    }   
    
    /**
     * 获取六合彩一天时间的下注金额
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @return type
     */
    public static function getOneDayOrder($user_id, $day){
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '  '
                . 'FROM six_lottery_order o,six_lottery_order_sub o_sub' . "\r\n" . '   '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '    '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '     ';           
        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        return $query;
    }
    /**
     * 获取六合彩一天时间的未结算的下注金额
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @param type $statusString    状态
     * @return type
     */
    public static function getOneDayOrderStatue0($user_id, $day, $statusString){
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '  '
                . 'FROM six_lottery_order o,six_lottery_order_sub o_sub' . "\r\n" . '   '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '    '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\'' .' '
                . 'AND o_sub.status=\'' . $statusString . '\' '. "\r\n" . '     ';
        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        return $query;
    }


    /** 20190104
     * 获取六合彩當期的未结算的下注金额
     * @param type $user_id         用户ID
     * @param type $statusString    状态
     * @return type
     */
    public static function getThisQishu($user_id, $statusString){

        $qishu = SixLotterySchedule::getNewQishu();

        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '  '
                . 'FROM six_lottery_order o,six_lottery_order_sub o_sub' . "\r\n" . '   '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '    '
                . 'AND o.lottery_number = \'' . $qishu . '\' '
                . 'AND o_sub.status=\'' . $statusString . '\' '. "\r\n" . '     ';
        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        return $query;
    }
    
    /**
     * 获取六合彩一天时间的最终下注金额结果
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @return type
     */
    public static function getOneDayTotalWin($user_id, $day){
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money' . "\r\n" . ' '
                . 'FROM six_lottery_order o,six_lottery_order_sub o_sub' . "\r\n" . '   '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '      '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '     '
                . 'AND o_sub.is_win = \'1\' LIMIT 0,1' . "\r\n" . '            ';
        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        $winTotal = $query[0]['win_money'];
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs' . "\r\n" . '     '
                . 'FROM six_lottery_order o,six_lottery_order_sub o_sub' . "\r\n" . '    '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '      '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '      '
                . 'AND o_sub.is_win = \'0\' LIMIT 0,1' . "\r\n" . '            ';
        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_fs'];
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back' . "\r\n" . '  '
                . 'FROM six_lottery_order o,six_lottery_order_sub o_sub' . "\r\n" . '     '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '     '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '       '
                . 'AND (o_sub.is_win = \'2\' OR o_sub.is_win = \'3\') LIMIT 0,1' . "\r\n" . '            ';
        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_back'];
        return $winTotal;
    }
}