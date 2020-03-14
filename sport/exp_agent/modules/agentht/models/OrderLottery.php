<?php
namespace app\modules\agentht\models;

use yii;
use yii\db\ActiveRecord;
/**
 * lottery表
 * OrderLottery is the model behind the agents_list.
 */
class OrderLottery extends ActiveRecord{
    
    /**
     * 各个类型的彩种 注单注单数，和下注金额
     * @param type $s_time
     * @param type $e_time
     * @param type $type            注单类型
     * @param type $id              
     * @return type
     */
    static public function getBetMoneyAndCount($s_time,$e_time,$type,$id){
        $sql="SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o.Gtype = '$type' "
                . "AND o.user_id=$id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = OrderLottery::findBySql($sql)->asArray()->one();
        return $rs;
    }
    /**
     * 各个类型的彩种 注单结果
     * @param type $s_time
     * @param type $e_time
     * @param type $type            注单类型
     * @param type $id              
     * @return type
     */
    static public function getWin($s_time,$e_time,$type,$id){
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
                . "AND o.Gtype = '$type' AND o.user_id=$id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $r1 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '0' "
                . "AND o.Gtype = '$type' AND o.user_id=$id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $r2 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.Gtype = '$type' AND o.user_id=$id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $r3 = OrderLottery::findBySql($sql)->asArray()->one();
        return $r1['win_money']+$r2['win_fs']+$r3['win_back'];
    }
    
    /**
     * 获取对应的结算的非平局订单号
     * @param type $s_time
     * @param type $e_time
     * @param type $type
     * @param type $id
     * @return type
     */
    static public function getOrderId($s_time,$e_time,$type,$id){
        $sql="select o_sub.id from order_lottery o,order_lottery_sub o_sub "
                . "where o_sub.bet_money>0 AND o.order_num=o_sub.order_num and o.Gtype='$type' "
                . "AND o.user_id=$id and o.bet_time>='$s_time' and o.bet_time<='$e_time' "
                . "AND o.status!='0' AND o.status!='3' AND o_sub.is_win!=2 order by o_sub.id desc";
        $r = OrderLottery::findBySql($sql)->asArray()->all();
        return $r;
    }
    
    static public function getOrderDelail($arr_id){
        $r = OrderLottery::find()
                ->select([
                    'o.Gtype',
                    'o.lottery_number AS qishu',
                    'o.rtype_str',
                    'o.bet_time',
                    'o.order_num',
                    'o_sub.quick_type',
                    'o_sub.number',
                    'o_sub.bet_money AS bet_money_one',
                    'o_sub.fs',
                    'o.user_id',
                    'o_sub.bet_rate AS bet_rate_one',
                    'o_sub.is_win',
                    'o_sub.status',
                    'o_sub.id AS id',
                    'o_sub.win AS win_sub',
                    'o_sub.balance',
                    'o_sub.order_sub_num'
                    ])
                ->from('order_lottery as o')
                ->innerJoin('order_lottery_sub as o_sub','o.order_num=o_sub.order_num')
                ->where(['in','o_sub.id',$arr_id])
                ->orderBy('o_sub.id desc');
        return $r;
    }

    public static function getUserId($user_name){
        $uid = '';
        if ($user_name){
            $where['user_name'] = $user_name;
            $rows = (new \yii\db\Query())
                ->select('user_id')
                ->from('user_list')
                ->where($where)
                ->limit(1)
                ->all();
            if ($rows) {
                $uid = $rows['0']['user_id'];
            } else {
                $uid = "";
            }
        }
        return $uid;
    }
    public static function getUserLotteryOrderList($agent_id,$uid='',$s_time='',$e_time='',$qishu='',$tf_id=''){
        $list = OrderLottery::find()
            ->select(array("o.order_num","o.Gtype","o.lottery_number","o.rtype_str",
                "o_sub.quick_type","o_sub.bet_money","o_sub.fs","o_sub.bet_rate",
                "o_sub.win","o_sub.is_win","o_sub.status","o_sub.number","o_sub.order_sub_num",
                "o_sub.id","o.bet_time","o.user_id",'u.user_name'))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin('user_list as u',"o.user_id=u.user_id and u.top_id=$agent_id ")
            ->where(['o_sub.status'=> 0]);
//            ->createCommand()->getrawSql();return $list;
        if($uid){
            $list->andWhere('o.user_id=:user_id',[':user_id' => $uid]);
        }
        if($s_time){
            $list->andWhere('o.bet_time >= :start_time',[':start_time'=>$s_time]);
        }
        if($e_time){
            $list->andWhere('o.bet_time <= :end_time',[':end_time'=>$e_time]);
        }
        if($qishu){
            $list->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        if($tf_id){
            $list->andWhere('o_sub.order_sub_num = :order_sub_num',[':order_sub_num'=>$tf_id]);
        }
        return $list;
    }


}