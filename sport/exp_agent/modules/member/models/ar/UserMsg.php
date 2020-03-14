<?php

namespace app\modules\member\models\ar;

use Yii;

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
class UserMsg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_msg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msg_from', 'user_id', 'msg_title'], 'required'],
            [['user_id', 'islook'], 'integer'],
            [['msg_time'], 'safe'],
            [['msg_from'], 'string', 'max' => 20],
            [['msg_title'], 'string', 'max' => 50],
            [['msg_info'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msg_id' => 'Msg ID',
            'msg_from' => 'Msg From',
            'user_id' => 'User ID',
            'msg_title' => 'Msg Title',
            'msg_info' => 'Msg Info',
            'msg_time' => 'Msg Time',
            'islook' => 'Islook',
        ];
    }
}
