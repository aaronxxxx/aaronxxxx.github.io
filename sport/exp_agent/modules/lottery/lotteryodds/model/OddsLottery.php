<?php

namespace app\modules\lottery\lotteryodds\model;

use Yii;

/**
 * This is the model class for table "odds_lottery".
 *
 * @property string $id
 * @property integer $sequence
 * @property string $lottery_type
 * @property string $sub_type
 * @property string $ball_type
 * @property string $h1
 * @property string $h2
 * @property string $h3
 * @property string $h4
 * @property string $h5
 * @property string $h6
 * @property string $h7
 * @property string $h8
 * @property string $h9
 * @property string $h10
 * @property string $h11
 * @property string $h12
 * @property string $h13
 * @property string $h14
 * @property string $h15
 * @property string $h16
 * @property string $h17
 * @property string $h18
 * @property string $h19
 * @property string $h20
 * @property string $h21
 * @property string $h22
 * @property string $h23
 * @property string $h24
 * @property string $h25
 * @property string $h26
 * @property string $h27
 * @property string $h28
 * @property string $h29
 * @property string $h30
 * @property string $h31
 * @property string $h32
 * @property string $h33
 * @property string $h34
 * @property string $h35
 * @property string $h36
 */
class OddsLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'odds_lottery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sequence'], 'required'],
            [['sequence'], 'integer'],
            [['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'h7', 'h8', 'h9', 'h10', 'h11', 'h12', 'h13', 'h14', 'h15', 'h16', 'h17', 'h18', 'h19', 'h20', 'h21', 'h22', 'h23', 'h24', 'h25', 'h26', 'h27', 'h28', 'h29', 'h30', 'h31', 'h32', 'h33', 'h34', 'h35', 'h36'], 'number'],
            [['lottery_type', 'sub_type', 'ball_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sequence' => 'Sequence',
            'lottery_type' => 'Lottery Type',
            'sub_type' => 'Sub Type',
            'ball_type' => 'Ball Type',
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
            'h7' => 'H7',
            'h8' => 'H8',
            'h9' => 'H9',
            'h10' => 'H10',
            'h11' => 'H11',
            'h12' => 'H12',
            'h13' => 'H13',
            'h14' => 'H14',
            'h15' => 'H15',
            'h16' => 'H16',
            'h17' => 'H17',
            'h18' => 'H18',
            'h19' => 'H19',
            'h20' => 'H20',
            'h21' => 'H21',
            'h22' => 'H22',
            'h23' => 'H23',
            'h24' => 'H24',
            'h25' => 'H25',
            'h26' => 'H26',
            'h27' => 'H27',
            'h28' => 'H28',
            'h29' => 'H29',
            'h30' => 'H30',
            'h31' => 'H31',
            'h32' => 'H32',
            'h33' => 'H33',
            'h34' => 'H34',
            'h35' => 'H35',
            'h36' => 'H36',
        ];
    }
}
