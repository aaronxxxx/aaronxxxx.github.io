<?php
namespace app\modules\general\member\models\TransactionLog;

use yii\db\ActiveRecord;
use app\modules\lottery\models\ar\LotterySchedule;

/**
 * OrderLottery is the model behind the order_lottery.
 */
class OrderLottery extends ActiveRecord{
    
    /**
     * 获取一整天的彩票下注金额
     * @param type $user_id         用户ID
     * @param type $day             时间
     * @return type
     */
    public static function getOneDayTotalCount($user_id, $day) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '   '
                . ' FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '               '
                . ' WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '               '
                . ' AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        return $query;
    }
    
    /**
     * 获取一整天的彩票未结算的下注金额
     * @param type $user_id         用户ID
     * @param type $day             时间
     * @param type $statusString    状态
     * @return type
     */
    public static function getOneDayTotalCountStatus0($user_id, $day, $statusString) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '   '
                . ' FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '               '
                . ' WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '               '
                . ' AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '            ';
        $sql .= ' AND o_sub.status=\'' . $statusString . '\' ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        return $query;
    }
    
    /**
     * 获取一整天的彩票下注金额的最终结果
     * @param type $user_id 用户ID
     * @param type $day     时间
     * @return type
     */
    public static function getOneDayTotalWin($user_id, $day) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money' . "\r\n" . '          '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '              '
                . 'WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '      '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '          '
                . 'AND o_sub.is_win = \'1\' LIMIT 0,1' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal = $query[0]['win_money'];
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs' . "\r\n" . '                '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '                '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '                '
                . 'AND o_sub.is_win = \'0\' LIMIT 0,1' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_fs'];
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back' . "\r\n" . '                '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '                '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '                '
                . 'AND (o_sub.is_win = \'2\' OR o_sub.is_win = \'3\') LIMIT 0,1' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_back'];
        return $winTotal;
    }
    
    /**
     * 获取彩票中除六合彩以外的其他游戏一天的下注金额
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @param type $gType           查询的游戏
     * @param type $statusString    状态
     * @return type
     */
    public static function getOneDayTotalCountByType($user_id, $day, $gType) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '   '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '    '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '       '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' '
                . 'AND o.bet_time<=\'' . $oneDayEnd . '\' '
                . 'AND o.Gtype = \'' . $gType . '\'' . "\r\n" . '   ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        return $query;
    }
    
    /**
     * 获取彩票中除六合彩以外的其他游戏一天的未结算的下注金额
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @param type $gType           查询的游戏
     * @param type $statusString    状态
     * @return type
     */
    public static function getOneDayTotalCountByTypeStatus0($user_id, $day, $gType, $statusString) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '   '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '    '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\' AND o.Gtype = \'' . $gType . '\'' .   ' '
                . 'AND o_sub.status=\'' . $statusString . '\' '.             "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        return $query;
    }

     /**  20190104 獲取該期未開獎訂單
      * 
     * 获取彩票中除六合彩以外的其他游戏一天的未结算的下注金额
     * @param type $user_id         用户ID
     * @param type $gType           查询的游戏
     * @param type $statusString    状态
     * @return type
     */
    public static function getThisQishu($user_id, $gName, $gType, $statusString) {

        /*----------------------------------------------------------------------------------*/

        $firstSchedule = LotterySchedule::getFirstSchedule( $gName );
        $lastSchedule = LotterySchedule::getLastSchedule( $gName );
        $isLateNight=false;
        if ((date ( 'H:i:s', time () ) <= $firstSchedule ['kaipan_time']) || ($lastSchedule ['kaijiang_time'] <= date ( 'H:i:s', time () ))) {
                $scheduleinfo = $firstSchedule;
                if ($lastSchedule ['kaijiang_time'] <= date ( 'H:i:s', time () )) {
                        $isLateNight = true;
                }
        } else {
                $scheduleinfo = LotterySchedule::getNewSchedule ( $gName );
        }
        $isLateNight == true ? $time = time () + 86400 : $time = time ();
        $schedule['qishu']=date ( 'Ymd', $time ) . $scheduleinfo ['qishu'];
        // $schedule['kaipan_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['kaipan_time'];
        // $schedule['fenpan_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['fenpan_time'];
        // $schedule['kaijiang_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['kaijiang_time'];

        /*----------------------------------------------------------------------------------*/

        $sql = 'SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money' . "\r\n" . '   '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' '
                . 'AND o.order_num=o_sub.order_num' . "\r\n" . '    '
                . 'AND o.Gtype = \'' . $gType . '\'' .   ' '
                . 'AND o.lottery_number=\'' . $schedule['qishu'] . '\' '
                . 'AND o_sub.status=\'' . $statusString . '\' '.             "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        return $query;
    }
    
    /**
     * 获取彩票中除六合彩以外的其他游戏一天的最终下注金额
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @param type $gType           查询的游戏
     * @return type
     */
    public static function getOneDayTotalWinByType($user_id, $day, $gType) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money' . "\r\n" . '                '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '                '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '                '
                . 'AND o_sub.is_win = \'1\' AND o.Gtype = \'' . $gType . '\' LIMIT 0,1' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal = $query[0]['win_money'];
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs' . "\r\n" . '                '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '                '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '                '
                . 'AND o_sub.is_win = \'0\' AND o.Gtype = \'' . $gType . '\' LIMIT 0,1' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_fs'];
        $sql = 'SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back' . "\r\n" . '                '
                . 'FROM order_lottery o,order_lottery_sub o_sub' . "\r\n" . '                '
                . 'WHERE o.user_id=\'' . $user_id . '\' AND o.order_num=o_sub.order_num' . "\r\n" . '                '
                . 'AND o.bet_time>= \'' . $oneDayStart . '\' AND o.bet_time<=\'' . $oneDayEnd . '\'' . "\r\n" . '                '
                . 'AND (o_sub.is_win = \'2\' OR o_sub.is_win = \'3\') AND o.Gtype = \'' . $gType . '\' LIMIT 0,1' . "\r\n" . '            ';
        $query = OrderLottery::findBySql($sql)->asArray()->all();
        $winTotal += $query[0]['win_back'];
        return $winTotal;
    }
    
    /**
     * 获取获取彩票游戏的的数据
     * @param type $start_time      查询开始时间
     * @param type $end_time        查询结束时间
     * @param type $user_group      查询用户ID
     * @return type
     */
    public static function getLotteryOne($start_time,$end_time,$user_group,$type){
        $sql = "SELECT o.Gtype,o.lottery_number AS qishu,o.rtype_str,o.bet_time,o.order_num,o_sub.quick_type,
                        o_sub.number,o_sub.bet_money AS bet_money_one,o_sub.fs,
                        o_sub.bet_rate AS bet_rate_one,o_sub.is_win,o_sub.status,
                        o_sub.id AS id,o_sub.win AS win_sub,o_sub.balance,o_sub.order_sub_num
                FROM order_lottery o,order_lottery_sub o_sub
                WHERE o.bet_time>='$start_time' and o.bet_time<='$end_time' AND o.order_num=o_sub.order_num AND o.user_id='".$user_group."'AND o.Gtype='".$type."'
                order by o_sub.status asc,o_sub.id desc";
        return $sql;
    }


   /*
    * 订单作废
    * OrderLottery 与  manage_log user_list 都要修改
    * @$user 操作人名称
    * @$orderSubNum  子订单ID
    * @$reason 作废理由
    * @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
    *  修改子订单状态
    * manage_log  对作废理由，作废用户进行修改
    * user_list  对用户金额进行修改
    * OrderLottery  当订单的所有子订单都作废的情况下修改主订单的订单状态为作废
    */

    public static function cancelOrder( $orderSubNum='' ){

        $updateOrder  = $updateSub = $log = $updateMoney = 1;
        $orderSub = OrderLotterySub::findOne(array('id'=>$orderSubNum));
        $db = Yii::$app->db;
        $betMoney = 0;
        if($orderSub){
            $orderNum = $orderSub->order_num;
            $betMoney = $orderSub->bet_money;

            $order = OrderLottery::findOne(array('order_num'=>$orderNum));
            if($order){
                $userId = $order->user_id;
                $user = UserList::findOne(array('user_id'=>$userId));
                
                /*if($orderSub->status ==1 || $orderSub->status ==2){//如果注单已经结算或者重新结算状态，则需修改金额
                    if($orderSub->is_win==0){//未中奖
                        $betMoney = $betMoney-($orderSub->fs);
                        $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额 把下注金额退回，减除反水金额
                    }elseif($orderSub->is_win==1){//中奖
                        $betMoney=($betMoney-($orderSub->win)-($orderSub->fs));
                        $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额 把减去中奖金额与反水金额，加上下注金额
                    }
                }else{
                    $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额
                }*/
                // 僅未結算可修正
                if( $orderSub->status == 0 ){
                    $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额
                } else {
                    return false;
                }
                //修改子订单状态
                $updateSub =  $db->createCommand()
                ->update('order_lottery_sub', ['status' => 3 ], 'id = :id',[':id'=>$orderSubNum ] )->execute();

                $orderSubs = OrderLotterySub::find(array('order_num'=>$orderNum))->select('count(id) as count')->andWhere('status !=:status',array(':status'=>3))->asArray()->one();
                if($orderSubs['count'] == 0){
                    //当所有子订单都作废则修改主订单状态也为作废
                    $updateOrder =  $db->createCommand()
                    ->update('order_lottery', ['status' => 3 ], 'order_num = :order_num',[':order_num'=>$orderNum ] )->execute();
                }
                //金额记录
                $moneyLog = MoneyLog::lotteryCancel($userId,$orderSub['order_sub_num'],$betMoney,$user['money'],$user['money']+$betMoney,$order->rtype_str,'訂單:'.$orderSub['order_sub_num'].'作廢');
            }
        }
        if($updateSub && $log && $updateMoney && $updateOrder){
            return 0;
        }
        return false;
    }

}