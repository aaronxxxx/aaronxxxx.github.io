<?php

namespace app\modules\spsix\models;

use app\modules\core\common\models\UserList;
use app\modules\general\finance\models\MoneyLog;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * 极速六合彩表订单操作
 * SpsixLotteryOrder is the model behind the spsix_lottery_order.
 */
class SpsixLotteryOrder extends ActiveRecord {
    /*
     * 用户注单
     * 每个用户都只有一条总记录
     * SpsixLotteryOrder 与 SpsixLotteryOrdersub 与 Userlist联合查询
     * @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
     * @$user 用户名
     * @$startTime 下订单的最小时间
     * @$endTime   下订单的最大时间
     * @$qishu     极速六合彩期数
     */
    public static function userOrder($status,$user='',$startTime='',$endTime='',$qishu='',$excludeids=''){
        $status= $status=='0,1,2,3' ? array('in','o.status',[0,1,2,3]):array('in','o_sub.status',[$status]);
        $list = SpsixLotteryOrder::find()
            ->select(array("o_sub.status",'o_sub.is_win',"u.user_name","u.pay_name","u.user_id","count(o_sub.id) bet_count","sum(IF(o_sub.status=3,o_sub.bet_money,0)) draw_money","sum(o_sub.bet_money) bet_money_total","SUM(IF(o_sub.status=3,0,IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,IF(o_sub.is_win=2,o_sub.bet_money,0))))) win_total"))
            ->from("spsix_lottery_order as o")
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where($status);
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
        if($excludeids){
            $list->andWhere(['not in', 'o.user_id', array_column($excludeids,'user_id')]);
        }
        $list->groupBy(array('u.user_id'));
        return $list;
    }

    /*
     * 订单注单
     * 每个订单都只有一条总记录
     * SpsixLotteryOrder 与 SpsixLotteryOrdersub 与 Userlist联合查询
     * @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
     * @$user 用户名
     * @$startTime 下订单的最小时间
     * @$endTime   下订单的最大时间
     * @$qishu     极速六合彩期数
     * @$orderSubNum  子订单ID
     */
     public  static function getOrderById($status,$user='',$startTime='',$endTime='',$qishu='',$orderSubNum='',$excludeids){
         $status= $status=='0,1,2,3' ? array('in','o_sub.status',[0,1,2,3]):array('in','o_sub.status',[$status]);
        $list = SpsixLotteryOrder::find()
            ->select(array("o.lottery_number AS qishu","o.order_num","o_sub.bet_money","SUM(o_sub.fs) AS fs","o_sub.order_sub_num",
                "o.user_id","o.bet_time","o_sub.number","o_sub.bet_rate","o_sub.id AS id","o_sub.win AS win_sub","o_sub.fs AS sub_fs", "o_sub.balance","o_sub.is_win",
                "o.rtype_str","o.rtype_str_sub","o_sub.win","o_sub.status","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,IF(o_sub.is_win=2,o_sub.bet_money,0)))) is_win_total","u.user_name"))
            ->from("spsix_lottery_order as o")
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where($status);
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
        if($excludeids){
            $list->andWhere(['not in', 'o.user_id', array_column($excludeids,'user_id')]);
        }
        $list->groupBy(array('o_sub.order_sub_num'))->orderBy(array('bet_time' => SORT_DESC));

        return $list;
    }

    /**
     * 订单注单 优化后的测试
     * @param $status
     * @param string $user
     * @param string $startTime
     * @param string $endTime
     * @param string $qishu
     * @param string $orderSubNum
     */
    public  static function getOrderByIdByOptimize($status,$user='',$startTime='',$endTime='',$qishu='',$orderSubNum='',$page=0,$pageSize=20){
        $status= $status=='0,1,2,3' ? array('in','o_sub.status',[0,1,2,3]):array('in','o_sub.status',[$status]);
        if($user){
            $select_str = '*';
        }else{
            $select_str = 'order_num';
        }

        $sql1 =  (new Query())->select($select_str)->from('spsix_lottery_order');
        if($startTime){
            $sql1->andWhere('bet_time>=:start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $sql1->andWhere('bet_time<=:end_time',[':end_time'=>$endTime]);
        }
         if($user){
             $sql1->andWhere('user_id = :user_id', [':user_id' => $user]);
        }else{
             $sql1->limit(1);
         }
        if($qishu){
            $sql1->andWhere('lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        $sql1_sub = (new Query())->from(['or'=>$sql1]);
        $sql2 = SpsixLotteryOrderSub::find()
            ->select('id')
            ->from('spsix_lottery_order_sub')
            ->where(['=','order_num',$sql1_sub]);
        if(empty($user)){
            $sql2->limit(1);
        }

        $sql2_sub = (new Query())->from(['o_sub_id'=>$sql2]);
        $list = SpsixLotteryOrder::find()
            ->select(array("o.lottery_number AS qishu","o.order_num","o_sub.bet_money","o_sub.fs","o_sub.order_sub_num",
                "o.user_id","o.bet_time","o_sub.number","o_sub.bet_rate","o_sub.id AS id","o_sub.win AS win_sub","o_sub.fs AS sub_fs", "o_sub.balance","o_sub.is_win",
                "o.rtype_str","o.rtype_str_sub","o_sub.win","o_sub.status","u.user_name"))
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where($status)
            ->orderBy('o_sub.id desc');
//            ->offset($page)
//            ->limit($pageSize);
        if($user){
            $list->from(['o'=>$sql1]);
        }else{
            $list->from("spsix_lottery_order as o");
            $list->andWhere(['>=','o_sub.id',$sql2_sub]);
        }

        if($qishu){
            $list->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
//        if($user){
//            $list->andWhere('u.user_name = :user_name', [':user_name' => $user]);
//        }
        if($orderSubNum){
            $list->andWhere('o_sub.order_sub_num = :order_sub_num',[':order_sub_num'=>$orderSubNum]);
        }
//        echo $list->createCommand()->getRawSql();
//        exit;
        return $list;

    }

    /**统计子订单条数
     * @param $status
     * @param string $user
     * @param string $startTime
     * @param string $endTime
     * @param string $qishu
     * @param string $orderSubNum
     * @param int $page
     * @param int $pageSize
     */
    public  static function getOrderByIdByOptimizeCount($status,$startTime='',$endTime='',$qishu='',$orderSubNum=''){
        if(!empty($orderSubNum)){
            return 1;
        }
        $status= $status=='0,1,2,3' ? array('in','status',[0,1,2,3]):array('in','status',[$status]);
        $sql1_min = (new Query())
            ->select('order_num')
            ->from('spsix_lottery_order')
            ->limit(1);
        if($startTime){
            $sql1_min->andWhere('bet_time>=:start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $sql1_min->andWhere('bet_time<=:end_time',[':end_time'=>$endTime]);
        }if($qishu){
            $sql1_min->andWhere('lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        $sql1_sub_min = (new Query())->from(['o'=>$sql1_min]);

        $sql2_min = (new Query())
            ->select('id')
            ->from('spsix_lottery_order_sub')
            ->where(['=','order_num',$sql1_sub_min])
            ->limit(1);
        $sql2_sub_min = (new Query())->from( ['os'=>$sql2_min]);
//-------------------------------------------------
        $sql1_max = (new Query())
            ->select('order_num')
            ->from('spsix_lottery_order')
            ->orderBy(array('id' => SORT_DESC))
            ->limit(1);
        if($startTime){
            $sql1_max->andWhere('bet_time>=:start_time',[':start_time'=>$startTime]);
        }
        if($endTime){
            $sql1_max->andWhere('bet_time<=:end_time',[':end_time'=>$endTime]);
        }if($qishu){
            $sql1_max->andWhere('lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        $sql1_sub_max = (new Query())->from(['o'=>$sql1_max]);

        $sql2_max = (new Query())
            ->select('id')
            ->from('spsix_lottery_order_sub')
            ->where(['=','order_num',$sql1_sub_max])
            ->orderBy(array('id' => SORT_DESC))
            ->limit(1);
        $sql2_sub_max = (new Query())->from( ['os'=>$sql2_max])->limit(1);
//------------------------------------------
        $data = SpsixLotteryOrderSub::find()
            ->select("count(*) as count")
            ->from('spsix_lottery_order_sub')
            ->where($status)
            ->andwhere(['>=','id',$sql2_sub_min])
            ->andWhere(['<=','id',$sql2_sub_max])
            ->asArray()
            ->one();
        return $data['count'];

    }

    public static function getUserId($userName){
        return $rsult = UserList::find()
            ->select('user_id')
            ->where('user_name=:user_name',[':user_name'=>$userName])
            ->asArray()
            ->one();

    }


    /**
     * 计算下注人数
     * sql优化后的处理
     * @param $status
     * @param string $user
     * @param string $startTime
     * @param string $endTime
     * @param string $qishu
     * @param string $orderSubNum
     * @return $this
     */
    public  static function userOrderCountByOptimize($status,$user='',$startTime='',$endTime='',$qishu='',$orderSubNum='')
    {
        $status = $status == '0,1,2,3' ? array('in', 'o.status', [0, 1, 2, 3]) : array('in', 'o.status', [$status]);
        $list = SpsixLotteryOrder::find()
            ->select("o.user_id ")
            ->distinct()
            ->from("spsix_lottery_order o")
            ->where($status);
        if($startTime){
            $list->andWhere("o.bet_time >=:start_time",[":start_time"=>$startTime]);
        }
        if($endTime){
            $list->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime]);
        }
        if($qishu){
            $list->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        return $list;
    }

    /**
     * 用户注单 sql优化后的处理
     * @param $status
     * @param string $user
     * @param string $startTime
     * @param string $endTime
     * @param string $qishu
     * @param string $orderSubNum
     */
    public  static function userOrderByOptimize($status,$user='',$startTime='',$endTime='',$qishu='',$page=0,$pageSize=20)
    {
        $status = $status == '0,1,2,3' ? array('in', 'o.status', [0, 1, 2, 3]) : array('in', 'o.status', [$status]);
        if(!empty($user)){//通过用户名获取用户的user_id
            $users = UserList::find()
                ->select("u.user_id")
                ->where("u.user_name=:user_name",[":user_name"=>$user])
                ->from('user_list u')
                ->asArray()
                ->one();
            $sql_sub = $users['user_id'];
        }else{
            $sql = (new  Query())
                ->select('o.user_id')
                ->distinct()
                ->from("spsix_lottery_order o")
                ->where($status)
                ->offset($page)
                ->limit($pageSize);
            if($startTime){
                $sql->andWhere("o.bet_time >=:start_time",[":start_time"=>$startTime]);
            }
            if($endTime){
                $sql->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime]);
            }
            if($qishu){
                $sql->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
            }
            $sql_sub = (new Query())->from(["us"=>$sql]);
        }
        $result_sql  = SpsixLotteryOrder::find()
            ->select(array("u.user_id,`o_sub`.`status`, `o_sub`.`is_win`, `u`.`user_name`, `u`.`pay_name`,   count(o_sub.id) bet_count, sum(IF(o_sub.status=3,o_sub.bet_money,0)) draw_money, sum(o_sub.bet_money) bet_money_total, SUM(IF(o_sub.status=3,0,IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,IF(o_sub.is_win=2,o_sub.bet_money,0))))) win_total "))
            ->from("spsix_lottery_order o")
            ->where(["o.user_id" => $sql_sub])
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->groupBy('u.user_id');
            if($startTime){
                $result_sql->andWhere("o.bet_time >=:start_time",[":start_time"=>$startTime]);
            }
            if($endTime){
                $result_sql->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime]);
            }
            if($qishu){
                $result_sql->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
            }
            $result = $result_sql->asArray()->all();
        return $result;
    }

    /*
    * 订单作废
    * SpsixLotteryOrder 与 SpsixLotteryOrdersub manage_log user_list 都要修改
    * @$user 操作人名称
    * @$orderSubNum  子订单ID
    * @$reason 作废理由
    * @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
    * SpsixLotteryOrdersub 修改子订单状态
    * manage_log  对作废理由，作废用户进行修改
    * user_list  对用户金额进行修改
    * SpsixLotteryOrder  当订单的所有子订单都作废的情况下修改主订单的订单状态为作废
    */
    public static function cancelOrder($orderSubNum='',$reason){
        $updateOrder  = $updateSub = $log = $updateMoney = 1;
        $orderSub = SpsixLotteryOrderSub::findOne(array('id'=>$orderSubNum));
        $betMoney = 0;
        if($orderSub){
            $orderNum = $orderSub->order_num;
            $betMoney = $orderSub->bet_money;
//            $orderSub->status = 3;
//            $updateSub = $orderSub->save();//修改子订单状态
            $order = SpsixLotteryOrder::findOne(array('order_num'=>$orderNum));
            if($order){
                $userId = $order->user_id;
                $user = UserList::findOne(array('user_id'=>$userId));

                if($orderSub->status ==1 || $orderSub->status ==2){//如果注单已经结算或者重新结算状态，则需修改金额
                    if($orderSub->is_win==0){//未中奖
                        $betMoney = $betMoney-($orderSub->fs);
                        $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额 把下注金额退回，减除反水金额
                    }elseif($orderSub->is_win==1){//中奖
                        $betMoney=($betMoney-($orderSub->win)-($orderSub->fs));
                        $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额 把减去中奖金额与反水金额，加上下注金额
                    }
                }else{
                    $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额
                }
                $orderSub->status = 3;
                $updateSub = $orderSub->save();//修改子订单状态
                $orderSubs = SpsixLotteryOrderSub::find(array('order_num'=>$orderNum))->select('count(id) as count')->andWhere('status !=:status',array(':status'=>3))->asArray()->one();
                if(!$orderSubs){
                    $order->status = 3;
                    $updateOrder = $order->save();//当所有子订单都作废则修改主订单状态也为作废
                }
                //金额记录
                $moneyLog = MoneyLog::SixCancel($userId,$orderNum,$betMoney,$user['money'],$user['money']+$betMoney);
            }
        }
        if($updateSub && $log && $updateMoney && $updateOrder){
            return true;
        }
        return false;
    }

    /*
     * 极速六合彩特码明细
     * 特码A面。特码B面下注明细
     * 每个用户都只有一条总记录
     * SpsixLotteryOrder 与 SpsixLotteryOrdersub 联合查询
     * @$qishu     极速六合彩期数
     * @$order     排序字段
     */
    public static function tema($qishu,$order){
        $list = array();
        $spa = SpsixLotteryOrder::find()
            ->select(array("sum(o_sub.bet_money) bet_money","o_sub.number",'o.bet_info'))
            ->from("spsix_lottery_order as o")
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
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
            $keys = array();
            foreach ($listNumber as $key=>$list){
                $keys[]=$list['bet_info']+$list['SPbside'];
            }
            array_multisort($keys,SORT_DESC,$listNumber);//对数组排序
        }
        return $listNumber;
    }

    /*
    * 极速六合彩明细
    * 特码A面。特码B面下注明细
    * 每个用户都只有一条总记录
    * SpsixLotteryOrder 与 SpsixLotteryOrdersub userlist联合查询\
    * @$startTime  下单起始时间
    * @$endTime     下单结束时间
    * @$userIn      用户名
    * @$userNin     忽略用户名
    * @$group     分组字段 user是按用户，num是按订单
     * @$user      查询的用户
    */
    public static function sixDetail($startTime,$endTime,$user_id,$group=''){
        $list = SpsixLotteryOrder::find()
            ->select(array("count(o.order_num) count_total","o.lottery_number","o.rtype_str","sum(o_sub.bet_money) bet_money","SUM(o_sub.fs) AS fs",'o_sub.bet_rate',"o.bet_time",
                "o_sub.number","o_sub.status","o_sub.is_win","SUM(IF(o_sub.status=3,0,IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,IF(o_sub.is_win=2,o_sub.bet_money,0))))) is_win_total",
                "u.user_name",'u.pay_name','o_sub.order_sub_num'))
            ->from("spsix_lottery_order as o")
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->andWhere('(o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3)');
        if(!empty($startTime)){
            $list->andWhere('o.bet_time >= :start_time',[':start_time'=>$startTime]);
        }
        if(!empty($endTime)){
            $list->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime]);
        }
		if(count($user_id) > 0){
			$list->andWhere(array('u.user_id' => $user_id));
		}
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
     * SpsixLotteryOrder 与 SpsixLotteryOrdersub 联合查询
     * @$userId 用户ID
     * @$orderSubNum  主订单ID
     */
    public  static function getOrderByOrderid($userId,$orderNum,$type){
        $list = SpsixLotteryOrder::find()
            ->select(array("o.lottery_number AS qishu","o.rtype_str","o.order_num","o_sub.bet_money","SUM(o_sub.fs) AS fs","o_sub.order_sub_num",
                "o.user_id","o.bet_time","o_sub.number","o_sub.bet_rate","o_sub.is_win","o_sub.id AS id","o_sub.win AS win_sub", "o_sub.balance","o_sub.is_win",
                "o.rtype_str","o_sub.win","o_sub.status","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) is_win_total","u.user_name"))
            ->from("spsix_lottery_order as o")
            ->innerJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where(array('o.user_id'=>$userId));
        if($type!='极速六合彩' && $type!='彩票下注' && $type!='极速六合彩作废'){
            $list->andWhere('o_sub.order_sub_num = :order_num',[':order_num'=>$orderNum]);
        }else{
            $list->andWhere('o.order_num = :order_num',[':order_num'=>$orderNum]);
        }

        $list->groupBy(array('o_sub.order_sub_num'))->orderBy(array('bet_time' => SORT_DESC));
        return $list;
    }

    /**
     * 获取和局总金额
     * @param $userInArray
     * @param string $startTime
     * @param string $endTime
     */
    public static function getDrawSum($userid,$startTime,$endTime){
        $data = SpsixLotteryOrder::find()
            ->select("sum(o_sub.bet_money) as draw_total_money")
            ->where('o.user_id=:user_id',[':user_id' => $userid])
            ->andWhere('o.bet_time >= :start_time',[':start_time'=>$startTime])
            ->andWhere('o.bet_time <= :end_time',[':end_time'=>$endTime])
             ->andWhere('o_sub.is_win=2')
            ->from("spsix_lottery_order as o")
            ->leftJoin("spsix_lottery_order_sub as o_sub","o.order_num=o_sub.order_num");
        return $data;

    }
}
