<?php
namespace app\modules\general\mobile\models\News;

use yii\db\ActiveRecord;
use app\modules\general\mobile\models\Pagination;

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
    static public function getUserMassageList($user_id) {
        $data = UserMsg::find()
                ->asArray()
                ->where(['user_id'=>$user_id])
                ->orderBy('msg_time','desc')
                ->all();
        $sum = count($data);
        $page_obj = new Pagination($sum);
        $data = UserMsg::find()
                ->asArray()
                ->where(['user_id'=>$user_id])
                ->limit($page_obj->limit)
                ->orderBy('msg_time','desc')
                ->all();
        $page_list = $page_obj->fpage(array(3,4,5,6,7));
        return array($data,$page_list);
    }
    
    /**
     * 获取单个用户信息
     * @param type $mid     信息ID
     */
    static public function getOneMsg($mid){
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
    static public function updateMsgislook($mid){
        $row = UserMsg::find()
                ->where(['msg_id'=>$mid])
                ->one();
        if($row){
            $row->islook= 1;
            $r = $row->save();
            return $r;
        }
    }

        /**
     * 删除单个用户信息
     * @param type $mid     信息ID
     */
    static public function delMsg($mid){
        $row = UserMsg::find()
                ->where(['msg_id'=>$mid])
                ->all();
        $r = $row[0]->delete();
        return $r;
    }
}