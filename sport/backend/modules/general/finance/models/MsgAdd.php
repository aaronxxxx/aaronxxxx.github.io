<?php
namespace app\modules\general\finance\models;
use Yii;
use app\modules\general\member\models\ar\UserMsg;

class MsgAdd 
{
    static public function msg_add($uid, $from, $title, $info) 
    {
		$uid = intval($uid);
                $trans = Yii::$app->db->beginTransaction();
                $msg = new UserMsg();
                $msg->user_id = $uid;
                $msg->msg_from = $from;
                $msg->msg_title = $title;
                $msg->msg_info = $info;
                $r = $msg->save();
                if($r){
                     $trans->commit();  
                     return true;
                }else{
                    $trans->rollBack();
                    return false;
                }
                
	}
}

