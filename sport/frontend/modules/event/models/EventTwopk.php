<?php
namespace app\modules\event\models;

use Yii;

class EventTwopk extends \yii\db\ActiveRecord
{
    static public function getAllByOfficial($official_id)
    {
        $result = EventTwopk::find()
            ->select([
                "o1.*",
                "o2.player1_odds",
                "o2.player2_odds",
                "o3.title as p1_title",
                "o3.summary as p1_summary",
                "o3.img_url as p1_img_url",
                "o3.link1 as p1_link1",
                "o3.link2 as p1_link2",
                "o3.link3 as p1_link3",
                "o4.title as p2_title",
                "o4.summary as p2_summary",
                "o4.img_url as p2_img_url",
                "o4.link1 as p2_link1",
                "o4.link2 as p2_link2",
                "o4.link3 as p2_link3",
            ])
            ->from("event_twopk as o1")
            ->innerJoin("event_twopk_odds as o2", "o1.id = o2.twopk_id")
            ->innerJoin("event_player as o3", "o1.player1 = o3.id")
            ->innerJoin("event_player as o4", "o1.player2 = o4.id")
            ->where(['o1.official_id' => $official_id])
            ->andWhere(['o1.status' => 1])
            ->orderBy(['qishu' => SORT_DESC])
            ->asArray()
            ->all();

        return $result;
    }

    static public function getOne($id)
    {
        $result = EventTwopk::find()
            ->select([
                "o1.*",
                "o2.id as odds_id",
                "o2.player1_odds",
                "o2.player2_odds",
                "o2.adj_basic",
                "o2.start_amount",
            ])
            ->from("event_twopk as o1")
            ->innerJoin("event_twopk_odds as o2", "o1.id = o2.twopk_id")
            ->where(['o1.qishu' => $id])
            ->asArray()
            ->one();

        return $result;
    }
}
