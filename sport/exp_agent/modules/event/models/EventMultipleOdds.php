<?php
namespace app\modules\event\models;

use Yii;

class EventMultipleOdds extends \yii\db\ActiveRecord
{
    static public function getAllByOfficial($id)
    {
		$sql = 'SELECT
                    o1.*,
                    o2.qishu,
                    o2.fs
                FROM
                    event_multiple_odds o1
					INNER JOIN event_multiple o2 ON o1.multiple_id = o2.id
                WHERE
					o1.official_id = '. $id .'
                ORDER BY
                    qishu DESC, official_id DESC, title ASC';

        $result = EventMultipleOdds::findBySql($sql)->asArray()->all();

        return $result;
    }
}
