<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * 用户组表
 */
class UserGroup extends ActiveRecord{

    /**
     * 查找全部用户组
     */
    static public function getAllGroup(){
        $userGroup = UserGroup::find()->groupBy(array('group_id'))->asArray()->all();
        return $userGroup;
    }

    /*
     * 修改彩票下注金额限制
     *  @param e $group_id    用户组ID
     *  @param type $bets     下注金额限制
     */
    static public function updateBetMonney($group_id,$bets){
        $result = false;
        $data = UserGroup::findOne(array('group_id'=>$group_id));
        if($data){
            foreach ($bets as $key=>$val){
                $data->$key = $val;
            }
            $result = $data->save();
        }
        return $result;
    }
}