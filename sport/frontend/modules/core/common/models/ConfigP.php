<?php

namespace app\modules\core\common\models;

use yii\db\ActiveRecord;

/**
 * SysConfig is the model behind the sys_config.
 */
class ConfigP extends ActiveRecord {

    public static function getConfig(){
        $list = ConfigP::find()->where(array('parameter_key'=>'REGSTER_ENABLE'))
            ->orWhere(array('parameter_key'=>'REGSTER_TITLE'))
            ->orWhere(array('parameter_key'=>'REGSTER_CONTENT'))
            ->orWhere(array('parameter_key'=>'REGSTER_FROM'))
            ->asArray()->All();
        return $list;
    }
}
