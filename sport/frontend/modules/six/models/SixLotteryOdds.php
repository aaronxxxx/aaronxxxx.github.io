<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * 六合彩表操作
 * SixLotteryOdds is the model behind the six_lottery_odds.
 */
class SixLotteryOdds extends ActiveRecord{
    /**
     * 获取不同类型的信息
     * @param type $sub_type    彩票类型
     * @param type $ball_type   类型中的类型
     * @return type
     */
    static public function getOddsByBallType($sub_type, $ball_type){
        $row = SixLotteryOdds::find()
                ->asArray()
                ->where(["sub_type"=>$sub_type])
                ->andWhere(['ball_type'=>$ball_type])
                ->all();
        return $row[0];
    }
    /**
     * 获取不同类型的信息 (类型中的类型为空)
     * @param type $sub_type    彩票类型
     * @return type
     */
    static public function getOdds($sub_type){
        $ball_type = '';
        $row = SixLotteryOdds::find()
                ->asArray()
                ->where(["sub_type"=>$sub_type])
                ->andWhere(['ball_type'=>null])
                ->all();
        return $row[0];
    }
    /**
     * 获取SP中fs的数据集合
     */
    static public function getSubTypeSPballtypeFS(){
        $row_sp_fs = SixLotteryOdds::find()
            ->where(['sub_type'=>'SP'])
            ->andWhere(['ball_type'=>'fs'])
            ->one();
        return $row_sp_fs;
    }
}