<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * 六合彩赔率操作
 * SixLotteryOdds is the model behind the six_lottery_odds.
 */
class SixLotteryOdds extends ActiveRecord{
    /**
     * 获取不同类型的信息
     * @param type $sub_type    彩票类型
     * @param type $ball_type   类型中的类型
     * @return type
     */
    public  static function getOddsByBallType($sub_type, $ball_type=null){
        $row = array();
        $row = SixLotteryOdds::find()
                ->asArray()
                ->where(["sub_type"=>$sub_type])
                ->andWhere(['ball_type'=>$ball_type])
                ->all();
        if(!empty($row)){
            return $row[0];
        }
       return $row;
    }

    /*
     * 修改两面赔率
     *  @param e $sub_type    彩票类型
     *  @param type $odds   赔率数组
     *  @param type $ball_type   类型中的类型
     */
     public  static function updateLiangmian($sub_type,$odds,$ball_type=null){
        $result = false;
        $data = SixLotteryOdds::findOne(array('sub_type'=>$sub_type,'ball_type'=>$ball_type));
        if($data){
            foreach ($odds as $key=>$val){
                $data->$key = floatval($val);
            }
            $result = $data->save();
        }
        return $result;
    }

    /**
     * 获取SP中fs的数据集合
     */
    public  static function getSubTypeSPballtypeFS(){
        $row_sp_fs = SixLotteryOdds::find()
            ->where(['sub_type'=>'SP'])
            ->andWhere(['ball_type'=>'fs'])
            ->one();
        return $row_sp_fs;
    }
}