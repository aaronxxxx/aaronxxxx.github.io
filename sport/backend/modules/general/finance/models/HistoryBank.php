<?php
namespace app\modules\general\finance\models;
use Yii;
use yii\db\ActiveRecord;

class HistoryBank extends ActiveRecord{
    
    /**
     * 查询提款的银行信息
     * @param type $username
     * @return type
     */
    static public function selectHistorybank($username){
        $data = HistoryBank::find()
                ->select(['pay_name','pay_card','pay_num','pay_address','addtime'])
                ->where("username=:username",[":username"=>trim($username)])
                ->orderBy(['uid'=>SORT_ASC])
                ->orderBy(["id"=>SORT_DESC])
                ->asArray()
                ->all();
        return $data;
          
    }
}