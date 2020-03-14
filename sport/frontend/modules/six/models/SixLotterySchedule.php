<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * 六合彩开盘时间表操作
 * SixLotterySchedule is the model behind the six_lottery_schedule.
 */
class SixLotterySchedule extends ActiveRecord {

    /**
     * 查找开盘记录
     * @return type
     */
    static public function getNewestLottery() {
        $row = SixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy(['create_time'=>SORT_DESC])->limit(1)->asArray()->all();
        if($row){
            return $row[0];
        }else{
            return null;
        }
    }

    /**
     * 获取当前期数
     * @return type
     */
    static public function getNewQishu() {
        $qishurs = SixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy('create_time DESC')->asArray()->all();
        $qishu = -1;
        if ($qishurs) {
            $qishu = $qishurs[0]['qishu'];
        }
        return $qishu;
    }
    static public function lastOne(){//获取最近一期的开奖信息
        $arr = SixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy('create_time DESC')->asArray()->all();
        if(!empty($arr)){
            return $arr[0];
        }else{
            return array();
        }
    }
}
