<?php
namespace app\modules\finance\models;
use Yii;
use yii\db\ActiveRecord;

class HistoryBank extends ActiveRecord{
    
    /**
     * 查詢提款的銀行信息
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