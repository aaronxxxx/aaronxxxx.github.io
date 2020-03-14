<?php

namespace app\modules\lottery\models\ar;

use Yii;

/**
 * This is the model class for table "odds_lottery_normal".
 *
 */
class OddsLotteryNormal extends \yii\db\ActiveRecord
{
    public static function getOdds($lotteryname,$subtype)
    {
        $query=static::find()
        ->where(['lottery_type' => $lotteryname,'sub_type'=>$subtype])
        ->orderBy('id');
        $rsarr=$query->asArray()->all();
        return $rsarr;
    }
    
}
