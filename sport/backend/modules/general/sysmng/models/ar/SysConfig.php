<?php

namespace app\modules\general\sysmng\models\ar;

use yii\db\ActiveRecord;

/**
 * SysConfig is the model behind the sys_config.
 */
class SysConfig extends ActiveRecord {

    /*
     * 获取分页条数
     * @$type 要查询的分页字段（sport_show_row：体育；lhc_show_row：六合彩；caipiao_show_row：彩票）
     *
     */
    public static function getPagesize($type){
        $pageSize = 20;//默认的分页条数
        $data = SysConfig::find()->select($type)->orderBy(array('id'=>SORT_DESC))->one();
        if($data) $pageSize = $data[$type];

        return $pageSize;
    }
    public static function setdata($type,$switch){
        
    }

}
