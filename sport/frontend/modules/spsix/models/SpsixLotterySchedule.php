<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * 极速六合彩开盘时间表操作
 * SpsixLotterySchedule is the model behind the spsix_lottery_schedule.
 */
class SpsixLotterySchedule extends ActiveRecord {
    public static function tableName()
    {
        return '{{spsix_lottery_schedule}}';
    }
    /**
     * 查找开盘记录
     * @return type
     */
    static public function getNewestLottery() {
        $row = SpsixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy(['create_time'=>SORT_DESC])->limit(1)->asArray()->all();
        if($row){
            return $row[0];
        }else{
            return null;
        }
    }
    static public function getNextLottery() {
        $row = SpsixLotterySchedule::find()->where('kaipan_time > :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])
        ->orderBy(['kaipan_time'=>SORT_ASC])
        ->limit(1)
        ->asArray()
        ->all();
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
        $qishurs = SpsixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy('create_time DESC')->asArray()->all();
        $qishu = -1;
        if ($qishurs) {
            $qishu = $qishurs[0]['qishu'];
        }
        return $qishu;
    }
    static public function lastOne(){//获取最近一期的开奖信息
        $arr = SpsixLotterySchedule::find()->where('kaipan_time <= :kaipan_time', [':kaipan_time' => date('Y-m-d H:i:s', time())])->andWhere('fenpan_time > :fenpan_time',[':fenpan_time'=>date('Y-m-d H:i:s')])->orderBy('create_time DESC')->asArray()->all();
        if(!empty($arr)){
            return $arr[0];
        }else{
            return array();
        }
    }
}
