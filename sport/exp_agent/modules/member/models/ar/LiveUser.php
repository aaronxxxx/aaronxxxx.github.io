<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "live_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $live_uid
 * @property string $live_type
 * @property string $user
 * @property string $live_username
 * @property string $live_password
 * @property string $live_money
 * @property string $live_money_b
 * @property string $update_time
 * @property string $oddlists
 * @property string $live_bet_money
 * @property string $live_win_money
 * @property string $fs_rate
 */
class LiveUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'live_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user', 'live_username', 'live_password', 'update_time'], 'required'],
            [['user_id', 'live_uid'], 'integer'],
            [['live_money', 'live_money_b', 'live_bet_money', 'live_win_money', 'fs_rate'], 'number'],
            [['update_time'], 'safe'],
            [['live_type'], 'string', 'max' => 10],
            [['user', 'live_username'], 'string', 'max' => 20],
            [['live_password'], 'string', 'max' => 32],
            [['oddlists'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'live_uid' => 'Live Uid',
            'live_type' => 'Live Type',
            'user' => 'User',
            'live_username' => 'Live Username',
            'live_password' => 'Live Password',
            'live_money' => 'Live Money',
            'live_money_b' => 'Live Money B',
            'update_time' => 'Update Time',
            'oddlists' => 'Oddlists',
            'live_bet_money' => 'Live Bet Money',
            'live_win_money' => 'Live Win Money',
            'fs_rate' => 'Fs Rate',
        ];
    }
}
