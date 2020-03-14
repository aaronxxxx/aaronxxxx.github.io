<?php
namespace app\modules\lottery\lotteryorder\model;

use app\modules\core\common\models\UserList;
use Yii;
use yii\db\ActiveRecord;

/**
 * 资金日志操作
 */
class MoneyLog extends ActiveRecord{

    /**
     * 插入注单作废日志
     * @param type $uid
     * @param type $order
     * @param type $about
     * @param type $money
     * @param type $assets
     * @param type $balance
     */
    public static function lotteryCancel($uid,$order,$money,$assets,$balance,$about,$type){
        $moneyLog = new MoneyLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = $type;
        $moneyLog->order_value = $money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }
}