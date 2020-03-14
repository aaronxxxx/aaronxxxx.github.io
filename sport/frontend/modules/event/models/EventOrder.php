<?php
namespace app\modules\event\models;

use Yii;

class EventOrder extends \yii\db\ActiveRecord
{
    static public function getAllByUser($id)
    {
        $result = EventOrder::find()
            ->select([
                "o1.*"
            ])
            ->from("event_order as o1")
            ->where('o1.user_id = :id', [':id' => $id])
            ->orderBy([
                'bet_time' => SORT_DESC,
                'order_num' => SORT_DESC
            ])
            ->asArray()
            ->all();

        return $result;
    }

    static public function getAllByUserPagination($id, $date)
    {
        $result = EventOrder::find()
            ->select([
                "o1.*"
            ])
            ->from("event_order as o1")
            ->where('o1.user_id = :id', [':id' => $id]);

        if ($date) {
            $result->andWhere('DATE_FORMAT(o1.bet_time, "%Y/%m/%d") = :date', [':date' => $date]);
        }

        $result->orderBy([
            'bet_time' => SORT_DESC,
            'order_num' => SORT_DESC
        ]);

        return $result;
    }
}
