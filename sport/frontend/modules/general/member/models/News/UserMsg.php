<?php
namespace app\modules\general\member\models\News;

use yii\db\ActiveRecord;

/**
 * 用户个人信息表
 * SysAnnouncement is the model behind the SysAnnouncement.
 */
class UserMsg extends ActiveRecord{
    
    /**
     * 获取用户个人的所以信息
     * @param type $user_id     用户ID
     * @return type
     */
    public static function getUserMassageList($user_id) {
        $data = UserMsg::find()
            ->where(['user_id'=>$user_id])
            ->orderBy('msg_time','desc');
        return $data;
    }
    
    /**
     * 获取单个用户信息
     * @param type $mid     信息ID
     */
    public static function getOneMsg($mid){
        $row = UserMsg::find()
                ->asArray()
                ->where(['msg_id'=>$mid])
                ->one();
        return $row;
    }
    /**
     * 更新信息的阅读状态
     * @param type $mid     信息ID
     */
    public static function updateMsgislook($mid){
        $row = UserMsg::find()
                ->where(['msg_id'=>$mid])
                ->one();
        $row->islook= 1;
        $r = $row->save();
        return $r;
    }

    /**
     * 删除单个用户信息
     * @param type $mid     信息ID
     */
    public static function delMsg($mid){
        $row = UserMsg::find()
                ->where(['msg_id'=>$mid])
                ->one();
        $r = $row->delete();
        return $r;
    }
}