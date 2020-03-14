<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * 极速六合彩开盘时间表操作
 * SpsixLotterySchedule is the model behind the spsix_lottery_schedule.
 */
class SpsixLotterySchedule extends ActiveRecord {
    /**
     * 获取当前期数
     * @return type
     */
    public static function getNewQishu() {
        $qishurs = SpsixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy('create_time DESC')->asArray()->all();
        $qishu = -1;
        if ($qishurs) {
            $qishu = $qishurs[0]['qishu'];
        }
        return $qishu;
    }
}
