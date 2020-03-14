<?php
namespace app\modules\general\mobile\models\vip;

use yii\db\ActiveRecord;

/**
 * 真人表（额度转换表）
 * LiveLog is the model behind the live-log.
 */
class LiveLog extends ActiveRecord{
    /**
     * 获取额度转换记录
     * @param type $userId  用户ID
     * @return type
     */
    static public function getLifeRecordByUser($userId){//额度转换记录和在线存款 (与视讯直播相同)
        $get_time = date("Y-m-d", strtotime("-6 day")) . " 00:00:00";
        $sql = "select id,order_num, live_type, zz_type, user_id, live_username, zz_money, status, result, add_time, do_time  "
                . "from live_log "
                . "where user_id='" . $userId . "' "
                . "and do_time>'" . $get_time . "' "
                . "order by do_time desc";
        return $sql;
    }
    
    
    static public function getNewsById($id){
        $sql = "select status,zz_money,user_id,do_time,live_type,live_username,order_num
                            from live_log where id ='$id' limit 0,1";
        $row = LiveLog::findBySql($sql)->asArray()->all();
        return $row[0];
    }
    
    static public function updateNewsById($id){
        $date = date('Y-m-d H-i-s');
        $live = LiveLog::find()
                ->where(['id' => $id])
                ->one();
        $live->status = 1;
        $live->result = '[转账已取消]';
        $live->do_time = $date;
        $live->
        $live->save();
    }
}