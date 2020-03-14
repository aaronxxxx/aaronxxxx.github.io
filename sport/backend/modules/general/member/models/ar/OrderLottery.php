<?php

namespace app\modules\general\member\models\ar;

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

    //彩票 --和
    public static function getHe($s_time, $e_time, $id)
    {
        if ($id) {
            $sql = "SELECT SUM(IF(o_sub.is_win = 2, o_sub.bet_money, 0)) AS bet_he
                FROM user_list u, order_lottery o, order_lottery_sub o_sub
                WHERE u.user_id IN($id) AND o.order_num = o_sub.order_num AND o.user_id = u.user_id";

            if ($s_time) {
                $sql .= " AND o.bet_time >= '" . $s_time . "'";
            }

            if ($e_time) {
                $sql .= " AND o.bet_time <= '" . $e_time . "'";
            }

            $sql .= " GROUP BY o.user_id ORDER BY o_sub.id desc";
            $data = self::findBySql($sql)->asArray()->one();

            return $data['bet_he'];
        }

        return 0;
    }
}
