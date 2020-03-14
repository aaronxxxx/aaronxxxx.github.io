<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "six_lottery_order".
 *
 * @property integer $id
 * @property string $order_num
 * @property integer $user_id
 * @property string $lottery_number
 * @property string $rtype_str
 * @property string $rtype
 * @property string $bet_info
 * @property string $bet_money_total
 * @property string $win_total
 * @property string $bet_time
 * @property string $status
 */
class SixLotteryOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'six_lottery_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_num', 'user_id', 'lottery_number', 'rtype_str', 'rtype', 'bet_info', 'bet_money_total', 'win_total', 'bet_time'], 'required'],
            [['user_id'], 'integer'],
            [['bet_money_total', 'win_total'], 'number'],
            [['bet_time'], 'safe'],
            [['order_num'], 'string', 'max' => 100],
            [['lottery_number', 'rtype_str', 'rtype'], 'string', 'max' => 255],
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
            'lottery_number' => 'Lottery Number',
            'rtype_str' => 'Rtype Str',
            'rtype' => 'Rtype',
            'bet_info' => 'Bet Info',
            'bet_money_total' => 'Bet Money Total',
            'win_total' => 'Win Total',
            'bet_time' => 'Bet Time',
            'status' => 'Status',
        ];
    }
}
