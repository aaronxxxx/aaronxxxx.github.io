<?php
namespace app\modules\general\mobile\models\News;

use yii\db\ActiveRecord;

/**
 * 系统公告表
 * SysAnnouncement is the model behind the SysAnnouncement.
 */
class SysAnnouncement extends ActiveRecord{
    /**
     * 获取系统公告信息
     */
    static public function getNotice(){
        $data = SysAnnouncement::find()
                ->Where(['is_show' => 1 ])
                ->andwhere(['>','end_time' ,date('Y-m-d H:i:s')])
                ->asArray()
                ->all();
        return $data;
    }
    /**
     * 
     * @param type $id
     */
    static public function getNoticeById($id){
        $row = SysAnnouncement::find()
                ->asArray()
                ->where(['id'=>$id])
                ->one();
        return $row;
    }
}