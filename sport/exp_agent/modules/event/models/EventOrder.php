<?php
namespace app\modules\general\event\models;

use Yii;

class EventOrder extends \yii\db\ActiveRecord
{
    static public function getAll($status = 0, $startTime = null, $endTime = null, $qishu = null, $orderNum = null, $userName = null)
    {
        $result = EventOrder::find()
            ->select([
                "o1.*",
                "o2.title",
                // "o3.player1",
                // "o3.player2",
                "o4.user_name"
            ])
            ->from("event_order as o1")
            ->innerJoin("event_official as o2", "o1.official_id = o2.id")
            // ->innerJoin("event_twopk as o3", "o1.game_id = o3.id")
            ->innerJoin("user_list as o4", "o1.user_id = o4.id");

        if ($status > 0) {
            $result->andWhere('o1.status = :status', [':status' => $status]);
        }

        if ($startTime) {
            $result->andWhere('o1.bet_time >= :startTime', [':startTime' => $startTime]);
        }

        if ($endTime) {
            $result->andWhere('o1.bet_time <= :endTime', [':endTime' => $endTime]);
        }

        if ($qishu) {
            $result->andWhere('o1.qishu = :qishu', [':qishu' => $qishu]);
        }

        if ($orderNum) {
            $result->andWhere('o1.order_num = :orderNum', [':orderNum' => $orderNum]);
        }

        if ($userName) {
            $result->andWhere('o4.user_name = :user_name', [':user_name' => $userName]);
        }

        // if ($excludeids) {
        //     $result->andWhere(['not in', 'o.user_id', array_column($excludeids,'user_id')]);
        // }

        return $result;
    }
}
