<?php
namespace app\modules\general\member\models;

use Yii;
use app\modules\live\models\LiveOrder;
use app\modules\general\member\models\ar\LiveUser;
use app\modules\general\member\models\ar\OrderLottery;
use app\modules\general\member\models\ar\SixLotteryOrder;

class UserDama extends \yii\db\ActiveRecord
{
    /**
     * 获取打码量方法  （后期由各自模块人员提供）
     * @param $userid
     * @param $update_time
     * @return string
     */
    public static function _getCondition($userid, $update_time)
    {
        $touzhu1 = 0;
        // $rs1 = (new \yii\db\Query())->select('sum(bet_money) as s')->from("k_bet")->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
        //     ->andWhere(['status' => [1, 2, 4, 5]])->limit(1)->one(); //体育单式注单总金额
        // if (!$rs1 || !$rs1["s"]) {
        //     $touzhu1 = 0;
        // } else {
        //     $touzhu1 = $rs1["s"];
        // }

        $rs2 = OrderLottery::find()
            ->select(['sum(bet_money) as s'])
            ->where(['user_id' => $userid])
            ->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2]])
            ->asArray()
            ->one();    // 彩票注单总金额

        if (!$rs2 || !$rs2["s"]) {
            $touzhu2 = 0;
        } else {
            $touzhu2 = $rs2["s"];
        }

        $rs3 = SixLotteryOrder::find()
            ->select(['sum(bet_money_total) as s'])
            ->where(['user_id' => $userid])
            ->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2]])
            ->asArray()
            ->one();    // 六合彩投注总金额

        if (!$rs3 || !$rs3["s"]) {
            $touzhu3 = 0;
        } else {
            $touzhu3 = $rs3["s"];
        }

        $touzhu4 = 0;
        // $rs4 = (new \yii\db\Query())->select('sum(bet_money) as s')->from("k_bet_cg_group")->where(['user_id' => $userid])
        //     ->andWhere(['>', 'bet_time', $update_time])->andWhere(['status' => [1, 2]])->limit(1)->one(); //体育串关投注总金额
        // if (!$rs4 || !$rs4["s"]) {
        //     $touzhu4 = 0;
        // } else {
        //     $touzhu4 = $rs4["s"];
        // }

        $rs = LiveUser::find()
            ->select(['live_username'])
            ->where(['user_id' => $userid])
            // ->andWhere(['live_type' => 'AG'])
            ->asArray()
            ->one();

        $rs5 = LiveOrder::find()
            ->select(["IFNULL(SUM(IF(live_order.valid_bet_amount > 0, live_order.valid_bet_amount, 0)), 0) s"])
            ->where(['live_username' => $rs['live_username']])
            ->andWhere(['>', 'order_time', $update_time])
            ->asArray()
            ->one();    // 真人投注总金额

        if (!$rs5 || !$rs5["s"]) {
            $touzhu5 = 0;
        } else {
            $touzhu5 = $rs5["s"];
        }

        $lottery_he = OrderLottery::getHe($update_time, date('Y-m-d H:i:s'), $userid);
        $six_he = SixLotteryOrder::getDrawSum($userid, $update_time, date('Y-m-d H:i:s'));
        $condition = sprintf("%.2f", ($touzhu1 + $touzhu2 + $touzhu3 + $touzhu4 + $touzhu5 - $lottery_he - $six_he));

        return $condition;
    }
}
