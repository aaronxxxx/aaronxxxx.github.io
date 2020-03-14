<?php
namespace app\modules\general\member\models\ar;

use yii;
use yii\db\ActiveRecord;

/**
 * Money is the model behind the pay_set.
 */
class Money extends ActiveRecord{
    
    /**
     * 添加订单
     * @param type $uid                         用户ID
     * @param type $order_amount      金额
     * @param type $order_no               订单号
     * @param type $assets                    资产
     */
    public static function addMoenyNews($uid,$order_amount,$order_no,$assets) {
        $money = new Money;
        $money->user_id          = $uid;
        $money->order_value     = $order_amount;
        $money->order_num =$order_no;
        $money->status ='确认';
        $money->assets =$assets;
        $money->balance =$assets+$order_amount;
        $money->save();
        $r = $money->id;
        return $r;
    }
    
    public static function updateMoneyNews($m_id) {
        $sql = 'update money,user_list set money.status=\'成功\',money.update_time=now(),user_list.money=user_list.money+money.order_value,money.about=\'该订单在线冲值操作成功\',money.sxf=money.order_value/100,money.balance=user_list.money+money.order_value where money.user_id=user_list.user_id and money.id=' . $m_id . ' and money.`status`=\'确认\'';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }
    
    
}