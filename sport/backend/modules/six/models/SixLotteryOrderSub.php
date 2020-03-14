<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * SixLotteryOrderSub is the model behind the six_lottery_order_sub.
 */
class SixLotteryOrderSub extends ActiveRecord {

    /*
     * 子订单修改下注内容
     * @$subId 子订单号
     * @$number 修改内容
     */
    public static function subUpdate($subId,$number){
        $orderSub = SixLotteryOrderSub::findOne(array('id'=>$subId));
        if($orderSub){
            $oldNumber = $orderSub->number;
            $orderSub->number = $number;
            $orderSub->save();
            $sixLog = new SixLotteryLog();
            $sixLog->id_sub = $orderSub->id;
            $sixLog->log_type = '修改投注内容';
            $sixLog->log_info = '投注内容：'.$oldNumber."修改为:".$number.'。';
            $sixLog->create_time = date('Y-m-d H:i:s');
            $sixLog->save();
            return true;
        }
        return false;
    }








    ////////////////////////////////////////////////////////
    /**
     * 添加订单信息
     * @param type $datereg                 单号
     * @param type $bet_info                号码，如1,2,3,单,双,大,小
     * @param type $bet_rate                下注赔率
     * @param type $bet_money_one           下注金额
     * @param type $win_money               可赢金额
     * @param type $fs_money                反水金额
     * @param type $balance                 下单后账号还有多少钱
     * @return type
     */
    public static function AddSixOrder($datereg,$bet_info,$bet_rate,$bet_money_one,$win_money,$fs_money,$balance){
        $subdata = new SixLotteryOrderSub;
        
        $subdata['order_num'] = $datereg;
        $subdata['number'] = $bet_info;
        $subdata['bet_rate'] = $bet_rate;
        $subdata['bet_money'] = $bet_money_one;
        $subdata['win'] = $win_money;
        $subdata['fs'] = $fs_money;
        $subdata['balance'] = $balance;
        $subdata->save();
        return $subdata['id'];
    }
    /**
     * 增加子订单号
     * @param type $id_sub          该表ID
     * @param type $datereg_sub     子订单号
     */
    public static function UpdateSixOrder($id_sub,$datereg_sub){
        $subdata = SixLotteryOrderSub::find()
                    ->where(['id'=>$id_sub])
                    ->one();
        $subdata['order_sub_num'] = $datereg_sub;
        $r = $subdata->save(); 
        return $r;
    }
    /**
     * 删除订单明细
     * @param type $id_sub      订单ID
     */
    public static function DelSixOrder($id_sub){
        $r = SixLotteryOrderSub::findOne($id_sub);
        $r->delete();
    }

    /**
     * @param $sub_id
     * @return array|null|ActiveRecord获取注单状态
     */
    public static function getOrderStatus($sub_id){
        return $result = SixLotteryOrderSub::find()->select('status')->where(['id'=>$sub_id])->asArray()->one();
    }
    /**
     *
     */
    public static function getTotalBetMoney($userid,$startTime='',$endTime=''){
        $result = SixLotteryOrderSub::find()
            ->select("sum(o_sub.bet_money) bet_money_valid_total")
            ->where('o.user_id=:user_id',[":user_id"=>$userid])
            ->andWhere('o.bet_time>=:start_time',[":start_time"=>$startTime])
            ->andWhere('o.bet_time<=:end_time',[":end_time"=>$endTime])
            ->andWhere(["in","o_sub.status",[0,1,2]])
            ->andWhere(['or',['in','o_sub.is_win',[0,1]],['o_sub.is_win'=>null]])
            ->from('six_lottery_order as o')
            ->innerJoin('six_lottery_order_sub as o_sub' ,"o.order_num=o_sub.order_num")
            ->andWhere('(o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3)')
            ->asArray()
            ->one();
        if(empty($result['bet_money_valid_total'])){
            $result['bet_money_valid_total']=0;
        }
        return $result;

    }

}
