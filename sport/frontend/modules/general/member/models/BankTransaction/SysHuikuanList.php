<?php
namespace app\modules\general\member\models\BankTransaction;

use yii\db\ActiveRecord;

/**
 * PaySet is the model behind the pay_set.
 */
class SysHuikuanList extends ActiveRecord{
    /**
     * 获取汇款列表
     * @return type
     */
    public static function getHuikuanList(){
        $arr = SysHuikuanList::find()->asArray()->all();
        return $arr;
    }
    
}