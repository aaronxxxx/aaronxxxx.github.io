<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "k_bet_cg_group".
 *
 * @property integer $id
 * @property string $order_num
 * @property integer $user_id
 * @property integer $cg_count
 * @property string $bet_money
 * @property string $win
 * @property string $bet_win
 * @property string $bet_time
 * @property string $bet_time_et
 * @property integer $status
 * @property string $update_time
 * @property string $balance
 * @property string $assets
 * @property string $ip
 * @property string $www
 * @property string $match_coverdate
 * @property string $fs
 * @property double $bet_reb
 * @property integer $check
 * @property string $bet_yx
 */
class KBetCgGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_bet_cg_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cg_count', 'bet_money', 'balance'], 'required'],
            [['user_id', 'cg_count', 'status', 'check'], 'integer'],
            [['bet_money', 'win', 'bet_win', 'balance', 'assets', 'fs', 'bet_reb', 'bet_yx'], 'number'],
            [['bet_time', 'bet_time_et', 'update_time', 'match_coverdate'], 'safe'],
            [['order_num', 'www'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_num' => 'Order Num',
            'user_id' => 'User ID',
            'cg_count' => 'Cg Count',
            'bet_money' => 'Bet Money',
            'win' => 'Win',
            'bet_win' => 'Bet Win',
            'bet_time' => 'Bet Time',
            'bet_time_et' => 'Bet Time Et',
            'status' => 'Status',
            'update_time' => 'Update Time',
            'balance' => 'Balance',
            'assets' => 'Assets',
            'ip' => 'Ip',
            'www' => 'Www',
            'match_coverdate' => 'Match Coverdate',
            'fs' => 'Fs',
            'bet_reb' => 'Bet Reb',
            'check' => 'Check',
            'bet_yx' => 'Bet Yx',
        ];
    }
}
