<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * 金额日志
 * MoneyLog is the model behind the money_log.
 */
class MoneyLog extends ActiveRecord {
    
    /**
     * 更新用户六合下注之后的金额日志
     * @param type $userid              用户ID
     * @param type $datereg             单号
     * @param type $bet_money_total     产生的金额
     * @param type $assets              下注前金额
     * @param type $balance             下注后金额
     */
    static public function updateUserMoneyForSix($userid,$datereg,$bet_money_total,$assets,$balance){
        $moneylog = new MoneyLog;
        $moneylog['user_id'] = $userid;
        $moneylog['order_num'] = $datereg;
        $moneylog['about'] = '极速六合彩';
        $moneylog['update_time'] = date('Y-m-d H:i:s', time());
        $moneylog['type'] = '彩票下注';
        $moneylog['order_value'] = $bet_money_total;
        $moneylog['assets'] = $assets;
        $moneylog['balance'] = $balance;
        $moneylog->save();
        return $moneylog['id'];
    }
    /**
     * 删除金额日志
     * @param type $money_log_id    金额表ID
     */
    static public function DelUserMoneyLogWhenAddSixOrderErr($money_log_id){
        $r = MoneyLog::findOne($money_log_id);
        $r->delete();
    }
}