<?php

namespace app\modules\lottery\models\ar;

use Yii;

/**
 * This is the model class for table "lottery_schedule".
 *
 * @property string $id
 * @property string $lottery_type
 * @property string $qishu
 * @property string $kaipan_time
 * @property string $fenpan_time
 * @property string $kaijiang_time
 * @property string $state
 * @property string $type
 */
class LotterySchedule extends \yii\db\ActiveRecord
{
	
	public static function getNewSchedule($lotteryName=null)
	{

		$currenttime=date('H:i:s', time());
		$query=self::find()
		->where('lottery_type=:lottery_type and kaipan_time<=:kaipan_time and kaijiang_time>:kaijiang_time', [':lottery_type' => $lotteryName,':kaipan_time'=>$currenttime,':kaijiang_time'=>$currenttime])
		->orderBy('id');
		
// 		$comman=$query->createCommand();
// 		echo $comman->sql;
		$rsarr=$query->asArray()->one();
		return $rsarr;

	}
	public static function getNewScheduleForMlaft($lotteryName=null)//修正幸運飛艇的取得期數會有誇天問題需要分開寫
	{

		$currenttime=date('H:i:s', time());
		
		$condition1 = $currenttime > '23:59:00' && $currenttime < '23:59:59';
		$condition2 = $currenttime >= '00:00:00' && $currenttime < '00:04:00';
		if( $condition1 || $condition2)
		{
			$query=self::find()
			->where('lottery_type=:lottery_type and kaipan_time = :kaipan_time and kaijiang_time = :kaijiang_time', [':lottery_type' => $lotteryName,':kaipan_time'=>'23:59:00',':kaijiang_time'=>'00:04:00'])
			->orderBy('id');
		}
		else
		{
			$query=self::find()
			->where('lottery_type=:lottery_type and kaipan_time<=:kaipan_time and kaijiang_time>:kaijiang_time', [':lottery_type' => $lotteryName,':kaipan_time'=>$currenttime,':kaijiang_time'=>$currenttime])
			->orderBy('id');
		}
		$rsarr=$query->asArray()->one();
		return $rsarr;
	}
	public static function getFirstSchedule($lotteryName=null)
	{
		$query=self::find()
		->where('lottery_type=:lottery_type',[':lottery_type' => $lotteryName])
		->orderBy('id ASC')->limit(1);
// 		$comman=$query->createCommand();
// 		echo $comman->sql;
		$rsarr=$query->asArray()->one();
		return $rsarr;
	}
	
	public static function getLastSchedule($lotteryName=null)
	{
		$query=self::find()
		->where('lottery_type=:lottery_type',[':lottery_type' => $lotteryName])
		->orderBy('id DESC')->limit(1);
// 		$comman=$query->createCommand();
// 		echo $comman->sql;
		$rsarr=$query->asArray()->one();
		return $rsarr;
	}
}
