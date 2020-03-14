<?php
namespace app\modules\general\member\models\BankTransaction;

use yii\db\ActiveRecord;


/**
 * 金额记录表操作
 * MoneyLog is the model behind the Money.
 */
class MoneyLog extends ActiveRecord{
    
    /**
     * 添加订单
     */
    public static function addMoenyLog($uid,$user,$order_value,$assets) {
        $moneylog = new MoneyLog;
        $moneylog->user_id          = $uid;
        $moneylog->order_value     = $order_value;
        $moneylog->order_num       =date('YmdHis')."_".$user;
        $moneylog->update_time     = date('Y-m-d H:i:s');
        $moneylog->type = '用户提款';
        $moneylog->assets =$assets;
        $moneylog->about = '';
        $moneylog->balance =$assets-$order_value;
        $moneylog->save();
    }
    
}
