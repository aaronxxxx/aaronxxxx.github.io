<?php
namespace app\modules\general\agent\models;

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
}