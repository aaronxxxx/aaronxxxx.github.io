<?php

namespace app\modules\six\models;

use yii;
use yii\db\ActiveRecord;

/**
 * 六合彩表订单操作
 * SixLotteryOrder is the model behind the six_lottery_order.
 */
class SixLotteryOrder extends ActiveRecord {
    public static function getDrawSum($userid,$startTime,$endTime){
        $data = SixLotteryOrder::find()
            ->select("sum(o_sub.bet_money) as draw_total_money")
            ->where('o.user_id=:user_id',[':user_id' => $userid])
            ->andWhere('o.bet_time >= :start_time',[':start_time'=>$startTime])
            ->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime])
            ->andWhere('o_sub.is_win=2')
            ->from("six_lottery_order as o")
            ->leftJoin("six_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->asArray()->one();
        if(empty($data['draw_total_money'])){
            $data['draw_total_money']=0;
        }
        return $data['draw_total_money'];
    }
    /**
     * 添加下注订单
     * @param type $userid              用户ID
     * @param type $rtype_name          彩票类型名称
     * @param type $rType               彩票类型缩写
     * @param type $bet_info_sp         下单详细情况
     * @param type $bet_money_total     下注金额
     * @param type $bet_win_total       最高可以赢的金额
     * @param type $lottery_number      开奖期数
     * @return type
     */
    static public function addSixOrder($userid,$rtype_name,$rType,$bet_info_sp,$bet_money_total,$bet_win_total,$lottery_number,$rTypeNameDetail=''){
        if(empty($rtype_name)){
            return false;
        }
        if(empty($rType)){
            return false;
        }
        if(empty($bet_info_sp)){
            return false;
        }
        $data = new SixLotteryOrder;
        $data['user_id'] = $userid;
        $data['rtype_str'] = $rtype_name;
        $data['rtype_str_sub']=$rTypeNameDetail;
        $data['rtype'] = $rType;
        $data['bet_info'] = $bet_info_sp;
        $data['bet_money_total'] = $bet_money_total;
        $data['win_total'] = $bet_win_total;
        $data['lottery_number'] = $lottery_number;
        $data['bet_time'] = date('Y-m-d H:i:s', time());
        $r = $data->save();
        return $data['id'];
    }
    
    /**
     * 更新插入订单的单号
     * @param type $id      订单号ID
     * @param type $datereg 订单单号
     * @return type
     */
    static public function addSixOrderOrderNumById($id,$datereg){
        $data = SixLotteryOrder::find()                                                             
                ->where(['id'=>$id])
                ->one();
        $data['order_num'] = $datereg;
        $r = $data->save();
        return $r;
    }
    /**
     * 删除订单
     * @param type $id      订单号ID
     */
    static public function DelSixOrder($id){
        $r = SixLotteryOrder::findOne($id);                                                     
        $r->delete();
    }  
    /**
     * 获取指定期数的会员下注金额之和
     * @param type $user_id         用户ID
     * @param type $qishu           期数
     * @return type
     */
    static public function getMaxMoneyAlready_lhc($user_id, $qishu) {
        $querry= SixLotteryOrder::find()
            ->select('sum(bet_money_total) as total_money ')
            ->from('six_lottery_order')
            ->where('lottery_number=:lottery_number',[':lottery_number'=>$qishu])
            ->andWhere('user_id=:user_id',[':user_id'=>$user_id])
            ->groupBy('user_id')
            ->asArray()
            ->all();
        return $querry;
    }
    
    /**
     * 获取单天的六合彩下注信息
     * @param type $user_id             用户ID
     * @param type $day                 时间
     * @return type
     */
    static public function getOneDayOrder($user_id, $day) {
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $query = SixLotteryOrder::find()
            ->select('COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money')
            ->where('o.user_id=:user_id',[':user_id'=>$user_id])
            ->andWhere('o.bet_time>=:start_time',[':start_time'=>$oneDayStart])
            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$oneDayEnd])
            ->from('six_lottery_order o')
            ->innerJoin('six_lottery_order_sub o_sub','o.order_num=o_sub.order_num')
            ->asArray()
            ->all();
        return $query[0];
    }
    /**
     * 获取六合彩一天时间的最终下注金额结果
     * @param type $user_id         用户ID
     * @param type $day             查询时间
     * @return type
     */
    static public function getOneDayTotalWin($user_id, $day){
        $oneDayStart = $day . ' 00:00:00';
        $oneDayEnd = $day . ' 23:59:59';
        $query =SixLotteryOrder::find()
            ->select('IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money')
            ->from('six_lottery_order o')
            ->innerJoin('six_lottery_order_sub o_sub','o.order_num=o_sub.order_num')
            ->where('o.bet_time>=:start_time',[':start_time'=>$oneDayStart])
            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$oneDayEnd])
            ->andWhere('o_sub.is_win = 1')
            ->limit(1)
            ->asArray()
            ->all();
        $winTotal = $query[0]['win_money'];
        $query = SixLotteryOrder::find()
            ->select('IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs')
            ->from('six_lottery_order o')
            ->innerJoin('six_lottery_order_sub o_sub','o.order_num=o_sub.order_num')
            ->where('o.user_id=:user_id',[':user_id'=>$user_id])
            ->andWhere('o.bet_time>=:start_time',[':start_time'=>$oneDayStart])
            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$oneDayEnd])
            ->andWhere('o_sub.is_win = 0')
            ->limit(1)
            ->asArray()
            ->all();
        $winTotal += $query[0]['win_fs'];
//        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.user_id='{$user_id}' AND o.order_num=o_sub.order_num AND o.bet_time>= '{$oneDayStart}' AND o.bet_time<='{$oneDayEnd}' AND (o_sub.is_win = 2 OR o_sub.is_win = 3) LIMIT 0,1";
//        $query = SixLotteryOrder::findBySql($sql)->asArray()->all();
        $query = SixLotteryOrder::find()
            ->select('IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back')
            ->from('six_lottery_order o')
            ->innerJoin('six_lottery_order_sub o_sub','o.order_num=o_sub.order_num')
            ->where('o.user_id=:user_id',[':user_id'=>$user_id])
            ->andWhere('o.bet_time>=:start_time',[':start_time'=>$oneDayStart])
            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$oneDayEnd])
            ->andWhere(['or','o_sub.is_win = 2','o_sub.is_win = 3'])
            ->limit(1)
            ->asArray()
            ->all();
        $winTotal += $query[0]['win_back'];
        return $winTotal;
    }
    
//    static public function getId($day,$where){
//        $oneDayStart = $day . ' 00:00:00';
//        $oneDayEnd = $day . ' 23:59:59';
//        $sql = "select o_sub.id  FROM six_lottery_order o,six_lottery_order_sub o_sub
//                    where o_sub.bet_money>0 AND o.order_num=o_sub.order_num
//                    AND o.bet_time>= '" . $oneDayStart . "' AND o.bet_time<='" . $oneDayEnd . "' {$where}";
//        $r = SixLotteryOrder::findBySql($sql)->asArray()->all();
////        $r = SixLotteryOrder::find()
////            ->select('o_sub.id')
////            ->from('six_lottery_order o')
////            ->where('o_sub.bet_money>0')
////            ->andWhere('o.bet_time>=:start_time',[':start_time'=>$oneDayStart])
////            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$oneDayEnd])
////            ->andWhere($where)
////            ->innerJoin('six_lottery_order_sub o_sub','o.order_num=o_sub.order_num')
////            ->asArray()
////            ->all();
//        return $r;
//    }
    
    static public function getAllNews($bid){
        $r = SixLotteryOrder::find()
            ->select('o.lottery_number AS qishu,o.rtype_str,o.bet_time,o.order_num,
                        o_sub.number,o_sub.bet_money AS bet_money_one,o_sub.fs,
                        o_sub.bet_rate AS bet_rate_one,o_sub.is_win,o_sub.status,
                        o_sub.id AS id,o_sub.win AS win_sub,o_sub.balance,o_sub.order_sub_num')
            ->where(['in','o_sub.id',$bid])
            ->from('six_lottery_order o')
            ->innerJoin('six_lottery_order_sub o_sub','o.order_num=o_sub.order_num')
            ->orderBy(array('o_sub.id' => SORT_DESC))
            ->asArray()->all();
        return $r;
    }

    /**
     * 获取总的中奖金额与反水金额
     * @param $startTime
     * @param $endTime
     * @param $userId
     */
    static public  function getProfit($startTime,$endTime,$userId){
        //总的中奖金额
        $data_win = SixLotteryOrder::find()
            ->select('sum(win) as win_total')
            ->from('six_lottery_order_sub as o_sub')
            ->innerJoin('six_lottery_order as o','o.order_num=o_sub.order_num')
            ->where(['in','o_sub.status',[1,2]])
            ->andWhere('o_sub.is_win=1')
            ->andWhere('o.bet_time>=:start_time',[':start_time'=>$startTime])
            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$endTime])
            ->andWhere('o.user_id=:user_id',[':user_id'=>$userId])
            ->asArray()
            ->one();
        if (empty($data_win['win_total'])){
            $data_win['win_total']=0;
        }
        //-------------------------------------------------------
        //总的反水金额
        $data_fs = SixLotteryOrder::find()
            ->select('sum(fs) as fs_total')
            ->from('six_lottery_order_sub as o_sub')
            ->innerJoin('six_lottery_order as o','o.order_num=o_sub.order_num')
            ->where(['in','o_sub.status',[1,2]])
            ->andWhere(['in','o_sub.is_win',[0,1]])
            ->andWhere('o.bet_time>=:start_time',[':start_time'=>$startTime])
            ->andWhere('o.bet_time<=:end_time',[':end_time'=>$endTime])
            ->andWhere('o.user_id=:user_id',[':user_id'=>$userId])
            ->asArray()
            ->one();
        if (empty($data_fs['fs_total'])){
            $data_fs['fs_total']=0;
        }
        //总的金额为中奖金额加上反水金额
        $data['win_total']= $data_win['win_total']+$data_fs['fs_total'];
        return $data;
    }

    /**
     * 获取有效下注总金额
     * @param $startTime
     * @param $endTime
     * @param $userId
     */
    static  public function getOrderValid($startTime,$endTime,$userId){
            $data = SixLotteryOrder::find()
                ->select('sum(bet_money) as bet_money_total')
                ->from('six_lottery_order_sub as o_sub')
                ->innerJoin('six_lottery_order as o','o.order_num=o_sub.order_num')
                ->where(['in','o_sub.status',[1,2]])
                ->andWhere('o.bet_time>=:start_time',[':start_time'=>$startTime])
                ->andWhere('o.bet_time<=:end_time',[':end_time'=>$endTime])
                ->andWhere('o.user_id=:user_id',[':user_id'=>$userId])
                ->asArray()
                ->one();
            if(empty($data['bet_money_total'])){
                $data['bet_money_total']=0;
            }
            return $data;
    }
}
