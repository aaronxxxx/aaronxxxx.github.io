<?php
namespace app\modules\general\member\models\News;

use yii\db\ActiveRecord;

/**
 * 系统公告表
 * SysAnnouncement is the model behind the SysAnnouncement.
 */
class SysAnnouncement extends ActiveRecord{
    /**
     * 获取系统公告信息
     */
    public static function getNotice(){
        $data = SysAnnouncement::find()
                ->Where(['is_show' => 1 ])
                ->andwhere(['>','end_time' ,date('Y-m-d H:i:s')]);
        	return $data;//有信息
    }
	/**
     * 获取自定义公告信息
     */
    public static function getDefNotice(){
        $arrDef=array('0'=>array('content'=>'欢迎光临'));//当无符合条件的公告信息时返回该数组
        $dataDef = SysAnnouncement::find()
            ->Where(['is_show' => 1 ])
            ->andwhere(['type' => null ])
            ->andWhere(['sort' => 1 ])
            ->andwhere(['>','end_time' ,date('Y-m-d H:i:s')])
            ->asArray()
            ->all();
        if(empty($dataDef)){
            return $arrDef;//无,返回代替数组
        }else{
            return $dataDef;//有信息
        }
    }
	/**
     * 获取赛事公告信息
     */
    public static function getTefNotice(){
        $arrTef=array('0'=>array('content'=>'欢迎光临'));//当无符合条件的公告信息时返回该数组
        $dataTef = SysAnnouncement::find()
            ->Where(['is_show' => 1 ])
            ->Where(['type' => 0 ])
            ->andwhere(['>','end_time' ,date('Y-m-d H:i:s')])
            ->asArray()
            ->all();
        if(empty($dataTef)){
            return $arrTef;//无,返回代替数组
        }else{
            return $dataTef;//有信息
        }
    }
}