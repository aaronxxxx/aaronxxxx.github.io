<?php
namespace app\modules\general\event\models;

use Yii;

class EventResultMultiple extends \yii\db\ActiveRecord
{

    static public function getResultData ( $official_id )
    {
        $result = EventResultMultiple::find()
            ->select([
                "erml.*",
                "em.title as m_title",
                "emi.title as i_title"
            ])
            ->from("( select * from event_result_multiple where official_id = ".$official_id.") as erml")
            ->leftJoin("event_multiple as em", "erml.multiple_id = em.id")
            ->leftJoin("event_multiple_odds as emi", "erml.item_id = emi.id")
            ->orderBy(['erml.multiple_id' => SORT_ASC])->asArray()->all();

            return $result;
    }

}
