<?php

namespace app\modules\general\member\models\ar;

use YII;
use yii\db\ActiveRecord;

use yii\db\Query;


/**
 * LiveUser is the model behind the live_user.
 */
class MoneyLog extends ActiveRecord {
	public static function getMoneyLogList($userid,$pageoffset,$pagelimit){
		$rs=MoneyLog::find()
		->where(['user_id'=>$userid])
		->orderBy([
   		 'update_time' => SORT_DESC,
   		 'id' => SORT_DESC,
		])
		->offset($pageoffset)->limit($pagelimit)->asArray()->all();
		return $rs;
	}
	
	public static function getMoneyLogCount($userid){
		$rs=MoneyLog::find()
		->select("count(*) as count")
		->where(['user_id'=>$userid])
		->orderBy([
   		 'update_time' => SORT_DESC,
   		 'id' => SORT_DESC,
				])
		->asArray()->one();
		
		return $rs;
	}
}
