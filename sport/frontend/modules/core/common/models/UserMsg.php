<?php

namespace app\modules\core\common\models;

use yii\db\ActiveRecord;

/**
 * UserMsg is the model behind the user_msg.
 */
class UserMsg extends ActiveRecord {

    public static function msg_add($uid, $from, $title, $info)
    {
        $uid = intval($uid);
        $userMsg = new UserMsg();
        $userMsg->user_id = $uid;
        $userMsg->msg_from = $from;
        $userMsg->msg_title = $title;
        $userMsg->msg_info = $info;
        return $userMsg->save();
    }
}
