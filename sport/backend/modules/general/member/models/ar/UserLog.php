<?php

namespace app\modules\general\member\models\ar;

use Yii;

/**
 * This is the model class for table "user_log".
 *
 * @property integer $id
 * @property string $user_name
 * @property integer $user_id
 * @property string $Oid
 * @property string $login_ip
 * @property string $edlog
 * @property string $edtime
 * @property string $login_url
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'Oid', 'edlog'], 'required'],
            [['user_id'], 'integer'],
            [['edtime'], 'safe'],
            [['user_name'], 'string', 'max' => 16],
            [['Oid'], 'string', 'max' => 50],
            [['login_ip'], 'string', 'max' => 20],
            [['edlog', 'login_url'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => '会员名称',
            'user_id' => 'User ID',
            'Oid' => 'Oid',
            'login_ip' => 'IP地址',
            'edlog' => '操作内容',
            'edtime' => '登录时间',
            'login_url' => '登录网址',
        ];
    }
}
