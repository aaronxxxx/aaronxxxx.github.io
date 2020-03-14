<?php

namespace app\modules\live\models;

use yii\db\ActiveRecord;

/**
 * LiveRpcConfig is the model behind the live_rpc_config.
 */
class LiveRpcConfig extends ActiveRecord {
	public static function getLiveRpcConfig(){
		$rs=LiveRpcConfig::find()->asArray()->one();
		return $rs;
	}
}
