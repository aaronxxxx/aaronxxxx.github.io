<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "order_lottery".
 *
 * @property integer $id
 * @property string $order_num
 * @property integer $user_id
 * @property string $Gtype
 * @property string $lottery_number
 * @property string $rtype_str
 * @property string $rtype
 * @property string $bet_info
 * @property string $bet_rate
 * @property string $bet_money
 * @property string $win
 * @property string $bet_time
 * @property string $status
 */
class OrderLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_lottery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_num', 'user_id', 'Gtype', 'lottery_number', 'rtype_str', 'rtype', 'bet_info', 'bet_money', 'win', 'bet_time'], 'required'],
            [['user_id'], 'integer'],
            [['bet_money', 'win'], 'number'],
            [['bet_time'], 'safe'],
            [['order_num', 'bet_rate'], 'string', 'max' => 100],
            [['Gtype', 'lottery_number', 'rtype_str', 'rtype'], 'string', 'max' => 255],
            [['bet_info'], 'string', 'max' => 5000],
            [['status'], 'string', 'max' => 20],
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
            'Gtype' => 'Gtype',
            'lottery_number' => 'Lottery Number',
            'rtype_str' => 'Rtype Str',
            'rtype' => 'Rtype',
            'bet_info' => 'Bet Info',
            'bet_rate' => 'Bet Rate',
            'bet_money' => 'Bet Money',
            'win' => 'Win',
            'bet_time' => 'Bet Time',
            'status' => 'Status',
        ];
    }
}
