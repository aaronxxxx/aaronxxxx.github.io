<?php

namespace app\modules\general\member\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_msg".
 *
 * @property integer $msg_id
 * @property string $msg_from
 * @property integer $user_id
 * @property string $msg_title
 * @property string $msg_info
 * @property string $msg_time
 * @property string $islook
 */
class UserMsg extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_msg';
    }

    public static function getLookName($islook)
    {
        $data = [
            1 => '已查看',
            0 => '未查看'
        ];
        return $data[$islook];
    }

    public function attributeLabels()
    {
        return [
            'islook' => '状态',
            'msg_time' => '发送时间',
            'msg_title' => '标题'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(UserList::className(), ['user_id' => 'user_id']);
    }
}
