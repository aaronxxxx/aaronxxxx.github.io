<?php
namespace app\modules\general\event\models;

use Yii;

class EventTwopk extends \yii\db\ActiveRecord
{
    static public function getAll($official_id)
    {
        $result = EventTwopk::find()
            ->select([
                "o1.*",
                "o2.title",
                "o2.type",
                "o2.kaipan_time",
                "o2.fenpan_time",
                "o2.kaijiang_time"
            ])
            ->from("event_twopk as o1")
            ->innerJoin("event_official as o2", "o1.official_id = o2.id")
            ->where(['o1.official_id' => $official_id])
            ->orderBy([
                'o1.qishu' => SORT_DESC
            ]);

        return $result;
    }
}
