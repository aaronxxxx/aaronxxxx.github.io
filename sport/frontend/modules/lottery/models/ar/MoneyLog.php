<?php

namespace app\modules\lottery\models\ar;

use Yii;

/**
 * This is the model class for table "lottery_schedule".
 *
 * @property string $id
 * @property string $lottery_type
 * @property string $qishu
 * @property string $kaipan_time
 * @property string $fenpan_time
 * @property string $kaijiang_time
 * @property string $state
 * @property string $type
 */
class MoneyLog extends \yii\db\ActiveRecord
{
    public static function GetLastMoney($id){
        $where['user_id'] = $id;
        $UserMoney = self::find()
            ->select('balance')
            ->where($where)
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->asArray()
            ->all();
        return $UserMoney[0]['balance'];
    }
	
}
