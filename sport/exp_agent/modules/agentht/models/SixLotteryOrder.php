<?php

namespace app\modules\agentht\models;

use yii;
use yii\db\ActiveRecord;

/**
 * 六合彩表订单操作
 * SixLotteryOrder is the model behind the six_lottery_order.
 */
class SixLotteryOrder extends ActiveRecord {

    static public function getOrderId($s_time,$e_time,$id){
        $sql="select o_sub.id FROM six_lottery_order o,six_lottery_order_sub o_sub where o_sub.bet_money>0 "
            . "AND o.order_num=o_sub.order_num AND o.user_id=$id "
            . "and o.bet_time>='$s_time' and o.bet_time<='$e_time' "
            . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 order by o_sub.id desc";
        $r = SixLotteryOrder::findBySql($sql)->asArray()->all();
        return $r;
    }

    static public function getOrderDelailSix($arr_id){
        $r = SixLotteryOrder::find()
            ->select([
                'o.lottery_number AS qishu','o.rtype_str','o.bet_time','o.order_num','o_sub.number','o_sub.bet_money AS bet_money_one',
                'o_sub.fs','o_sub.bet_rate AS bet_rate_one','o_sub.is_win','o_sub.status','o.user_id','o_sub.id AS id',
                'o_sub.win AS win_sub','o_sub.balance','o_sub.order_sub_num'
            ])
            ->from('six_lottery_order as o')
            ->innerJoin('six_lottery_order_sub as o_sub','o.order_num = o_sub.order_num')
            ->where(['in','o_sub.id',$arr_id])
            ->orderBy('o_sub.id desc');
        return $r;
    }
    /*
     * 订单注单
     * 每个订单都只有一条总记录
     * SixLotteryOrder 与 SixLotteryOrdersub 与 Userlist联合查询
     * @$agent_id 代理ID
     * @$user       用户名
     * @$startTime 下订单的最小时间
     * @$endTime   下订单的最大时间
     * @$qishu     六合彩期数
     * @$orderSubNum  子订单ID
     */
     public  static function getOrderById($agent_id,$user='',$startTime='',$endTime='',$qishu='',$orderSubNum=''){
        $list = SixLotteryOrder::find()
            ->select(array("o.lottery_number AS qishu","o.rtype_str","o.order_num","o_sub.bet_money","SUM(o_sub.fs) AS fs","o_sub.order_sub_num",
                "o.user_id","o.bet_time","o_sub.number","o_sub.bet_rate","o_sub.is_win","o_sub.id AS id","o_sub.win AS win_sub", "o_sub.balance","o_sub.is_win",
                "o.rtype_str","o_sub.win","o_sub.status","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) is_win_total","u.user_name",'u.pay_name'))
            ->from("six_lottery_order as o")
            ->innerJoin("six_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id and u.top_id=$agent_id ")
            ->where(['o.status'=>0]);
//            ->createCommand()->getrawSql();return $list;
        if($user){
            $list->andWhere('u.user_name = :user_name', [':user_name' => $user]);
        }
        if($startTime){
            $list->andWhere('o.bet_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime]);
        }
        if($qishu){
            $list->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        if($orderSubNum){
            $list->andWhere('o_sub.order_sub_num = :order_sub_num',[':order_sub_num'=>$orderSubNum]);
        }
        $list->groupBy(array('o_sub.order_sub_num'))->orderBy(array('bet_time' => SORT_DESC));

        return $list;
    }



    /*
     * 六合彩特码明细
     * 特码A面。特码B面下注明细
     * 每个用户都只有一条总记录
     * SixLotteryOrder 与 SixLotteryOrdersub 联合查询
     * @$qishu     六合彩期数
     * @$order     排序字段
     */
    public static function tema($qishu,$order){
        $list = array();
        $spa = SixLotteryOrder::find()
            ->select(array("sum(o_sub.bet_money) bet_money","o_sub.number",'o.bet_info'))
            ->from("six_lottery_order as o")
            ->innerJoin("six_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->where(array('o.lottery_number'=>$qishu,'o.rtype'=>'SP'))
            ->groupBy(array('o_sub.number','o.bet_info'));
        if($order =='number'){
            $spa->orderBy(array('o_sub.number'=>SORT_ASC));
        }else if($order=='bet_money'){
            $spa->orderBy(array('sum(o_sub.bet_money)'=>SORT_DESC));
        }
        $data = $spa->asArray()->all();

        if($data){
            foreach ($data as $key=>$val){
                $list[$val['number']][$val['bet_info']] = $val['bet_money'];
                $list[$val['number']]['number'] = $val['number'];
                foreach ($data as $k=>$v){
                    if($val['number']==$v['number']){
                        $list[$val['number']][$v['bet_info']] = $v['bet_money'];
                    }
                }
            }
        }
        if($order =='number'){
            for($i=1;$i<50;$i++){
                if($i<10){
                    if(isset($list['0'.$i])){
                        $listNumber['0'.$i]['bet_info'] = isset($list['0'.$i]['bet_info']) ? $list['0'.$i]['bet_info']:0;
                        $listNumber['0'.$i]['SPbside'] = isset($list['0'.$i]['SPbside']) ? $list['0'.$i]['SPbside']:0 ;
                        $listNumber['0'.$i]['number'] = $i;
                    }else{
                        $listNumber['0'.$i]['bet_info'] = 0;
                        $listNumber['0'.$i]['SPbside'] = 0;
                        $listNumber['0'.$i]['number'] = $i;
                    }
                }else {
                    if(isset($list[$i])){
                        $listNumber[$i]['bet_info'] = isset($list[$i]['bet_info']) ? $list[$i]['bet_info']:0;
                        $listNumber[$i]['SPbside'] = isset($list[$i]['SPbside']) ? $list[$i]['SPbside']:0 ;
                        $listNumber[$i]['number'] = $i;
                    }else{
                        $listNumber[$i]['bet_info'] = 0;
                        $listNumber[$i]['SPbside'] = 0;
                        $listNumber[$i]['number'] = $i;
                    }
                }
            }
        }else{
            for($i=1;$i<50;$i++){
                if($i<10){
                    if(isset($list['0'.$i])){
                        $listNumber['0'.$i]['bet_info'] = isset($list['0'.$i]['bet_info']) ? $list['0'.$i]['bet_info']:0;
                        $listNumber['0'.$i]['SPbside'] = isset($list['0'.$i]['SPbside']) ? $list['0'.$i]['SPbside']:0 ;
                        $listNumber['0'.$i]['number'] = $i;
                    }else{
                        $listNumber['0'.$i]['bet_info'] = 0;
                        $listNumber['0'.$i]['SPbside'] = 0;
                        $listNumber['0'.$i]['number'] = $i;
                    }
                }else {
                    if(isset($list[$i])){
                        $listNumber[$i]['bet_info'] = isset($list[$i]['bet_info']) ? $list[$i]['bet_info']:0;
                        $listNumber[$i]['SPbside'] = isset($list[$i]['SPbside']) ? $list[$i]['SPbside']:0 ;
                        $listNumber[$i]['number'] = $i;
                    }else{
                        $listNumber[$i]['bet_info'] = 0;
                        $listNumber[$i]['SPbside'] = 0;
                        $listNumber[$i]['number'] = $i;
                    }
                }
            }
        }
        return $listNumber;
    }

    /*
    * 六合彩明细
    * 特码A面。特码B面下注明细
    * 每个用户都只有一条总记录
    * SixLotteryOrder 与 SixLotteryOrdersub userlist联合查询\
    * @$startTime  下单起始时间
    * @$endTime     下单结束时间
    * @$userIn      用户名
    * @$userNin     忽略用户名
    * @$group     分组字段
     * @$user      查询的用户
    */
    public static function sixDetail($startTime,$endTime,$userIn,$userNin,$group,$user){
        $list = array();
        $list = SixLotteryOrder::find()
            ->select(array("count(o.order_num) count_total","o.lottery_number","o.rtype_str","sum(o_sub.bet_money) bet_money","SUM(o_sub.fs) AS fs",'o_sub.bet_rate',"o.bet_time",
                "o.bet_time","o_sub.number","o_sub.bet_rate","o_sub.status","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) is_win_total",
                "u.user_name",'u.pay_name','o_sub.status','o_sub.order_sub_num'))
            ->from("six_lottery_order as o")
            ->innerJoin("six_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id");

        if($startTime){
            $list->andWhere('o.bet_time >= :start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $list->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime]);
        }
        if($userIn){
            $list->andWhere( array('in','u.user_name',$userIn));
        }
        if($userNin){
            $list->andWhere( array('not in','u.user_name',$userNin));
        }
        if($user){
            $list->andWhere( array('u.user_name'=>$user));
        }
		$list->andWhere(" o.status != '0' AND o.status != '3' ");
        if($group=='user'){
            $list->groupBy(array('u.user_name'));
        }else if($group=='num'){
            $list->groupBy(array('o_sub.order_sub_num'));
        }

        return $list;
    }

    /*
     * 订单注单
     * 订单总表下的订单ID的订单明细
     * SixLotteryOrder 与 SixLotteryOrdersub 联合查询
     * @$userId 用户ID
     * @$orderSubNum  主订单ID
     */
    public  static function getOrderByOrderid($userId,$orderNum,$type){
        $list = SixLotteryOrder::find()
            ->select(array("o.lottery_number AS qishu","o.rtype_str","o.order_num","o_sub.bet_money","SUM(o_sub.fs) AS fs","o_sub.order_sub_num",
                "o.user_id","o.bet_time","o_sub.number","o_sub.bet_rate","o_sub.is_win","o_sub.id AS id","o_sub.win AS win_sub", "o_sub.balance","o_sub.is_win",
                "o.rtype_str","o_sub.win","o_sub.status","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) is_win_total","u.user_name"))
            ->from("six_lottery_order as o")
            ->innerJoin("six_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where(array('o.user_id'=>$userId));
        if($type!='六合彩' && $type!='彩票下注'){
            $list->andWhere('o_sub.order_sub_num = :order_num',[':order_num'=>$orderNum]);
        }else{
            $list->andWhere('o.order_num = :order_num',[':order_num'=>$orderNum]);
        }

        $list->groupBy(array('o_sub.order_sub_num'))->orderBy(array('bet_time' => SORT_DESC));
        return $list;
    }
}
