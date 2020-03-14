<?php

namespace app\modules\general\member\models\ar;

use Yii;

/**
 * This is the model class for table "money".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $order_num
 * @property string $status
 * @property string $about
 * @property string $update_time
 * @property string $pay_card
 * @property string $pay_num
 * @property string $pay_address
 * @property string $type
 * @property string $pay_name
 * @property string $sxf
 * @property string $order_value
 * @property string $assets
 * @property string $balance
 * @property string $manner
 * @property string $zsjr
 * @property string $date
 */
class Money extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'money';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'order_num', 'about', 'update_time', 'pay_card', 'pay_num', 'pay_address', 'pay_name', 'order_value'], 'required'],
            [['user_id'], 'integer'],
            [['update_time', 'date'], 'safe'],
            [['sxf', 'order_value', 'assets', 'balance', 'zsjr'], 'number'],
            [['order_num', 'pay_card', 'pay_num', 'pay_address'], 'string', 'max' => 50],
            [['status', 'type'], 'string', 'max' => 10],
            [['about', 'manner'], 'string', 'max' => 255],
            [['pay_name'], 'string', 'max' => 20],
            [['order_num'], 'unique'],
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
            'order_num' => 'Order Num',
            'status' => 'Status',
            'about' => 'About',
            'update_time' => 'Update Time',
            'pay_card' => 'Pay Card',
            'pay_num' => 'Pay Num',
            'pay_address' => 'Pay Address',
            'type' => 'Type',
            'pay_name' => 'Pay Name',
            'sxf' => 'Sxf',
            'order_value' => 'Order Value',
            'assets' => 'Assets',
            'balance' => 'Balance',
            'manner' => 'Manner',
            'zsjr' => 'Zsjr',
            'date' => 'Date',
        ];
    }
}
