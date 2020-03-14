<?php
namespace app\modules\agentht\models;

use yii\db\ActiveRecord;
/**
 * SixLotteryOrder
 * SixLotteryOrder is the model behind the agents_list.
 */
class EventOrder extends ActiveRecord{
    
    public static function getOrderId($s_time,$e_time,$id){
        $sql="select id FROM event_order where bet_money>0 "
                . "and user_id=$id "
                . "and bet_time>='$s_time' and bet_time<='$e_time' "
                . "AND status!=0 AND status!=3 AND is_win!=2 order by id desc";
        $r = EventOrder::findBySql($sql)->asArray()->all();
        return $r;
    }

    public static function getOrderDetailEvent($arr_id){

        $r = EventOrder::find()
            ->select([
                "o1.*",
                "o2.title",
                "o4.user_name"
            ])
            ->from("event_order as o1")
            ->innerJoin("event_official as o2", "o1.official_id = o2.id")
            ->innerJoin("user_list as o4", "o1.user_id = o4.id");
            $r->andWhere(['in','o1.id',$arr_id])
                ->orderBy('o1.id desc');
        return $r;
    }

    /*
    * 賽事明细
    * 下注明细
    * 每个用户都只有一条总记录
    * event_order 与 event_official userlist联合查询\
    * @$startTime  下单起始时间
    * @$endTime     下单结束时间
    * @$userIn      用户名
    * @$userNin     忽略用户名
    * @$group     分组字段 user是按用户，num是按订单
     * @$user      查询的用户
    */
    public static function eventDetail($startTime,$endTime,$user_id,$group=''){
        $list = EventOrder::find()
            ->select(array("count(o1.order_num) count_total","o1.qishu","o1.game_type","sum(o1.bet_money) bet_money","SUM(o1.fs) AS fs",'o1.bet_rate',"o1.bet_time",
                "o1.status","o1.is_win","SUM(IF(o1.status=3,0,IF(o1.is_win=1,o1.win+o1.fs,IF(o1.is_win=0,o1.fs,IF(o1.is_win=2,o1.bet_money,0))))) is_win_total",
                "u.user_name",'u.pay_name','o1.order_num'))
            ->from("event_order as o1")
            ->innerJoin("event_official as o2","o1.official_id = o2.id")
            ->innerJoin("user_list as u","o1.user_id = u.id");
        $list->orWhere('o1.is_win is null');
        $list->orWhere('o1.is_win = 1');
        $list->orWhere('o1.is_win = 0');
        if(!empty($startTime)){
            $list->andWhere('o1.bet_time >= :start_time',[':start_time'=>$startTime]);
        }
        if(!empty($endTime)){
            $list->andWhere('o1.bet_time <= :end_time',[':end_time'=>$endTime]);
        }
        $list->andWhere(array('u.user_id' => $user_id));
        $list->andWhere(" o1.status != '0' AND o1.status != '3' ");
        if($group=='user'){
            $list->groupBy(array('u.user_name'));
        }else if($group=='num'){
            $list->groupBy(array('o1.qishu'));
        }
        return $list;
    }

    /*
    * 賽事明细
    * 订单注单
    * 每个订单都只有一条总记录
    * event_order 与 event_official userlist联合查询\
    * @$startTime  下单起始时间
    * @$endTime     下单结束时间
    * @$userIn      用户名
    * @$userNin     忽略用户名
    * @$group     分组字段 user是按用户，num是按订单
     * @$user      查询的用户
    */
    public static function getOrderById($agent_id,$user='',$startTime='',$endTime='',$qishu='',$orderSubNum=''){
        $list = EventOrder::find()
            ->select(array("o1.qishu","o1.game_type","o1.order_num","o1.bet_money","SUM(o1.fs) AS fs",
                "o1.user_id","o1.bet_time","o1.game_type","o1.bet_rate","o1.is_win","o1.id AS id","o1.win AS win_sub","o1.is_win",
                "o1.win","o1.status","SUM(IF(o1.is_win=1,o1.win+o1.fs,IF(o1.is_win=0,o1.fs,0))) is_win_total","u.user_name",'u.pay_name'))
            ->from("event_order as o1")
            ->innerJoin("user_list as u","o1.user_id = u.id and u.top_id=$agent_id");
        $list->andWhere('o1.status = 0');
        if(!empty($startTime)){
            $list->andWhere('o1.bet_time >= :start_time',[':start_time'=>$startTime]);
        }
        if(!empty($endTime)){
            $list->andWhere('o1.bet_time <= :end_time',[':end_time'=>$endTime]);
        }
        if($user){
            $list->andWhere('u.user_name = :user_name', [':user_name' => $user]);
        }
        if($qishu){
            $list->andWhere('o1.qishu = :qishu',[':qishu'=>$qishu]);
        }
        if($orderSubNum){
            $list->andWhere('order_num = :order_sub_num',[':order_num'=>$orderSubNum]);
        }
        $list->groupBy(array('o1.order_num'))->orderBy(array('bet_time' => SORT_DESC));
        return $list;
    }
}