<?php

namespace app\modules\agentht\models\ar;

use yii\db\ActiveRecord;

/**
 * SysConfig is the model behind the sys_config.
 */
class SysConfig extends ActiveRecord {

    /*
     * 獲取分頁筆數
     * @$type 要查詢的分頁字段（sport_show_row：體育；lhc_show_row：越南彩；caipiao_show_row：彩票）
     *
     */
    public static function getPagesize($type){
        $pageSize = 20;//默認的分頁筆數
        $data = SysConfig::find()->select($type)->orderBy(array('id'=>SORT_DESC))->one();
        if($data) $pageSize = $data[$type];

        return $pageSize;
    }
}
