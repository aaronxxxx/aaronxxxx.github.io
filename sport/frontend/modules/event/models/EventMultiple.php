<?php
namespace app\modules\event\models;

use Yii;

class EventMultiple extends \yii\db\ActiveRecord
{
    static public function getAllByOfficial($official_id)
    {
        $result = EventMultiple::find()
            ->select([
                "o1.*"
            ])
            ->from("event_multiple as o1")
            ->where(['o1.official_id' => $official_id])
            ->andWhere(['o1.status' => 1])
            ->orderBy(['qishu' => SORT_DESC])
            ->asArray()
            ->all();

        return $result;
    }

    static public function getOne($id, $multipleId)
    {
        $result = EventMultiple::find()
            ->select([
                "o1.*",
                "o2.id as odds_id",
                "o2.odds"
            ])
            ->from("event_multiple as o1")
            ->innerJoin("event_multiple_odds as o2", "o1.id = o2.multiple_id")
            ->where(['o1.qishu' => $id])
            ->andWhere(['o2.id' => $multipleId])
            ->asArray()
            ->one();

        return $result;
    }
}
