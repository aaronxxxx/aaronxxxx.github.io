<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * 极速六合彩赔率操作
 * SpsixLotteryOdds is the model behind the six_lottery_odds.
 */
class SpsixLotteryOdds extends ActiveRecord{


    /*public static function tableName()
    {
        return '{{spsix_lottery_odds}}';
    }*/
    
    /**
     * 获取不同类型的信息
     * @param type $sub_type    彩票类型
     * @param type $ball_type   类型中的类型
     * @return type
     */
    public  static function getOddsByBallType($sub_type, $ball_type=null){
        $row = array();
        $row = SpsixLotteryOdds::find()
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
        $data = SpsixLotteryOdds::findOne(array('sub_type'=>$sub_type,'ball_type'=>$ball_type));
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
        $row_sp_fs = SpsixLotteryOdds::find()
            ->where(['sub_type'=>'SP'])
            ->andWhere(['ball_type'=>'fs'])
            ->one();
        return $row_sp_fs;
    }
}