<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "history_login".
 *
 * @property integer $id
 * @property string $uid
 * @property string $username
 * @property string $ip
 * @property string $ip_address
 * @property string $login_time
 * @property string $www
 */
class HistoryLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'username', 'ip', 'ip_address'], 'required'],
            [['uid'], 'integer'],
            [['login_time'], 'safe'],
            [['username', 'ip_address'], 'string', 'max' => 45],
            [['ip'], 'string', 'max' => 15],
            [['www'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'username' => 'Username',
            'ip' => 'Ip',
            'ip_address' => 'Ip Address',
            'login_time' => 'Login Time',
            'www' => 'Www',
        ];
    }
}
