<?php

namespace app\modules\live\models;

use yii\db\ActiveRecord;


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

    /**
     * 创建money log
     * @param array $params 参数
     * @return boolean      true: 创建成功 false: 创建失败
     */
    public static function createMoneyLog($params) {
        $log = new MoneyLog();
        if ($params['zz_type'] % 2 == 0) {
            $type = $params['live_type'] . '->系统 ' . $params['result'];
        } else {
            $type = '系统->' . $params['live_type'] . ' ' . $params['result'];
        }
        $log->user_id = $params['user_id'];
        $log->order_num = $params['billno'];
        $log->about = $params['about'];
        $log->update_time = date('Y-m-d H:i:s', time());
        $log->type = $type;
        $log->order_value = $params['credit'];
        $log->assets = $params['user_assets'];
        $log->balance = $params['user_balance'];
        return $log->save();
    }
}
