<?php

namespace app\modules\general\member\models\ar;

use Yii;

/**
 * This is the model class for table "order_lottery_sub".
 *
 * @property integer $id
 * @property string $order_num
 * @property string $order_sub_num
 * @property string $quick_type
 * @property string $number
 * @property string $bet_rate
 * @property string $bet_money
 * @property string $win
 * @property string $fs
 * @property string $balance
 * @property string $status
 * @property string $is_win
 */
class OrderLotterySub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_lottery_sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_num', 'order_sub_num', 'number', 'bet_rate', 'bet_money', 'win'], 'required'],
            [['bet_money', 'win', 'fs', 'balance'], 'number'],
            [['order_num', 'order_sub_num', 'quick_type', 'bet_rate'], 'string', 'max' => 100],
            [['number'], 'string', 'max' => 2000],
            [['status'], 'string', 'max' => 10],
            [['is_win'], 'string', 'max' => 20],
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
            'order_sub_num' => 'Order Sub Num',
            'quick_type' => 'Quick Type',
            'number' => 'Number',
            'bet_rate' => 'Bet Rate',
            'bet_money' => 'Bet Money',
            'win' => 'Win',
            'fs' => 'Fs',
            'balance' => 'Balance',
            'status' => 'Status',
            'is_win' => 'Is Win',
        ];
    }
}
