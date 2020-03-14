<?php

namespace app\modules\general\member\models;

use Yii;
use yii\db\ActiveRecord;

class DepositCallback extends ActiveRecord
{
    static public function getAll($startTime = null, $endTime = null, $orderNum = null)
    {
        $list = self::find();

        if ($startTime) {
            $list->andWhere('create_time >= :startTime', [':startTime' => $startTime]);
        }

        if ($endTime) {
            $list->andWhere('create_time <= :endTime', [':endTime' => $endTime]);
        }

        if ($orderNum) {
            $list->andWhere('order_num = :orderNum', [':orderNum' => $orderNum]);
        }

        $list->orderBy([
            'create_time' => SORT_DESC,
            'order_num' => SORT_DESC,
        ]);

        return $list;
    }
}