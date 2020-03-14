<?php
namespace app\modules\event\models;

use Yii;

class EventTwopkOdds extends \yii\db\ActiveRecord
{
    static public function getAllByOfficial($id)
    {
		$sql = 'SELECT
                    o1.*,
                    o2.qishu,
                    o2.player1,
                    o2.player2
                FROM
                    event_twopk_odds o1
                    INNER JOIN event_twopk o2 ON o1.twopk_id = o2.id
                WHERE
					o1.official_id = '. $id .'
                ORDER BY
                    twopk_id DESC, id DESC';

        $result = EventTwopkOdds::findBySql($sql)->asArray()->all();

        return $result;
    }
}
