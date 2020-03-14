<?php
namespace app\modules\general\event\models;

use Yii;

class EventResultPk extends \yii\db\ActiveRecord
{

    static public function getResultData ( $official_id ) {
        $result = EventOrder::find()
            ->select([
                "erpk.*",
                "ep.title",
                "ep.img_url"
            ])
            ->from(" ( select * from event_result_pk where official_id = ".$official_id." ) as erpk ")
            ->leftJoin("event_player as ep", "erpk.player = ep.id")
            ->orderBy(['erpk.player' => SORT_ASC])->asArray()->all();

            return $result;
    }

}
