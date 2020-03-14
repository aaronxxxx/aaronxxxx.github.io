<?php

namespace app\modules\lottery\modules\lztjssc\models\ar;

use Yii;

/**
 * This is the model class for table "lottery_result_cq".
 *
 * @property string $id
 * @property string $qishu
 * @property string $create_time
 * @property string $datetime
 * @property string $state
 * @property string $prev_text
 * @property integer $ball_1
 * @property integer $ball_2
 * @property integer $ball_3
 * @property integer $ball_4
 * @property integer $ball_5
 */
class LotteryResultTj extends \yii\db\ActiveRecord
{
	public static function getKJResult()
	{
        $lastResult = "select * from lottery_result_tj where datetime <= NOW() order by datetime desc limit 1";
        $rsarr = self::findBySql($lastResult)->asArray()->one();
        return $rsarr;
	}
	
	public static function getResultList($qishu_query=null,$query_time=null)
	{
		if($qishu_query==null){
			$query_time = date ( "Ymd", strtotime($query_time) );//跨天需要另外的參數
			$rslist=self::find()->where('LEFT(qishu, 8) = :query_time', [':query_time' => $query_time])->andWhere('datetime <= NOW()')->orderBy(['qishu' => SORT_DESC,])
			->asArray()
			->all();
			return $rslist;
		}else{
			$rslist=self::find()->where('DATE_FORMAT(datetime,"%Y-%m-%d") = :query_time and qishu=:qishu', [':query_time' => $query_time,':qishu'=>$qishu_query])->orderBy(['qishu' => SORT_DESC,])
			->asArray()
			->all();
			return $rslist;
		}
	}
}
