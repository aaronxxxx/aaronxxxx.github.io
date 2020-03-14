<?php

namespace app\modules\lottery\lotteryresult\model;

use Yii;

/**
 * This is the model class for table "lottery_result_tj".
 *
 * @property string $id
 * @property string $qishu
 * @property string $create_time
 * @property string $datetime
 * @property string $state
 * @property string $prev_text
 * @property integer $ball_1
 * @property integer $ball_2
 * @property integer $ball_3
 * @property integer $ball_4
 * @property integer $ball_5
 * @property string $from_url
 */
class LotteryResultTj extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lottery_result_tj';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qishu', 'create_time'], 'required'],
            [['create_time', 'datetime'], 'safe'],
            [['ball_1', 'ball_2', 'ball_3', 'ball_4', 'ball_5'], 'integer'],
            [['qishu', 'state'], 'string', 'max' => 255],
            [['prev_text'], 'string', 'max' => 2000],
            [['from_url'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qishu' => 'Qishu',
            'create_time' => 'Create Time',
            'datetime' => 'Datetime',
            'state' => 'State',
            'prev_text' => 'Prev Text',
            'ball_1' => 'Ball 1',
            'ball_2' => 'Ball 2',
            'ball_3' => 'Ball 3',
            'ball_4' => 'Ball 4',
            'ball_5' => 'Ball 5',
            'from_url' => 'From Url',
        ];
    }
}
