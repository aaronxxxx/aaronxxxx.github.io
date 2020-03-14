<?php
namespace app\modules\general\agent\models;

use yii\db\ActiveRecord;
/**
 * LiveOrder
 * LiveOrder is the model behind the agents_list.
 */
class LiveOrder extends ActiveRecord{
    
    public static function getOrderIdLive($s_tine,$e_time,$id){
        $sql="select lo.id FROM live_user l,live_order lo where l.live_username=lo.live_username "
                . "AND l.user_id=$id and lo.order_time>='$s_tine' and lo.order_time<='$e_time' order by lo.id desc";
        $rs = LiveOrder::findBySql($sql)->asArray()->all();
        return $rs;
    }
    
    public static function getOrderDelailLive($arr_id){
        $r = LiveOrder::find()
                ->select(['lo.*'])
                ->from('live_order as lo')
                ->innerJoin('live_user as l','l.live_username=lo.live_username')
                ->innerJoin('user_list as u','u.user_id=l.user_id')
                ->where(['in','lo.id',$arr_id])
                ->orderBy('lo.id desc');
        return $r;
    }
}