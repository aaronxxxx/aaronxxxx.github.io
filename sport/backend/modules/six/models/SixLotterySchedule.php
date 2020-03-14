<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * 六合彩开盘时间表操作
 * SixLotterySchedule is the model behind the six_lottery_schedule.
 */
class SixLotterySchedule extends ActiveRecord {
    /**
     * 获取当前期数
     * @return type
     */
    public static function getNewQishu() {
        $qishurs = SixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy('create_time DESC')->asArray()->all();
        $qishu = -1;
        if ($qishurs) {
            $qishu = $qishurs[0]['qishu'];
        }
        return $qishu;
    }
}
