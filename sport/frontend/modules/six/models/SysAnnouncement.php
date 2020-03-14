<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * msg表信息
 * SysAnnouncement is the model behind the sys_announcement.
 */
class SysAnnouncement extends ActiveRecord{
    static public function getOneAnnouncement() {
        $t = date('Y-m-d H:i:s');
        $row = SysAnnouncement::find()->where(['is_show'=>1])->andWhere('end_time > :end_time', [':end_time' => $t])->asArray()->all();
        if($row){
        	$msg = $row[0]['content'];
        }else{
        	$msg = '';
        }
        if ($msg == '') {
            $msg = '~欢迎光临~';
        }
        $msg = str_replace('\\', '\\\\', $msg);
        $msg = str_replace(PHP_EOL, ' ', $msg);
        $msg = str_replace('	', ' ', $msg);
        return $msg;
    }
    static public function getNewestAnnouncement() {
        $row = SysAnnouncement::find()->select('content,create_date,type')->where(['is_show'=>1])->andWhere('end_time > :end_time', [':end_time' => date('Y-m-d H:i:s')])->orderBy(['sort'=>SORT_DESC])->orderBy(['id'=>SORT_DESC])->limit(1)->asArray()->all();
        if($row){
            return $row[0]['content'];
        }
       return false;
    }
    
    static public function getAnnouncementList() {
        $rs = array();
        $row = SysAnnouncement::find()->select('content,create_date,type')->where(['is_show'=>1])->andWhere('end_time > :end_time', [':end_time' => date('Y-m-d H:i:s')])->orderBy(['sort'=>SORT_DESC])->orderBy(['id'=>SORT_DESC])->asArray()->all();
        foreach ($row as $key => $value) {
            $rs[] = $value;
        }
        return $rs;
    }
}