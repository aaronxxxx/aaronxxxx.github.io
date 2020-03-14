<?php

namespace app\modules\lottery\lotteryresult\model;

use Yii;

/**
 * This is the model class for table "lottery_result_cq".
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
class LotteryResultCq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lottery_result_cq';
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
    public static function Ssclist($gType,$s_time='',$e_time='',$qishu_query=''){
        $table = 'lottery_result_'."$gType";
        $ssc = OrderLottery::find()
            ->select(['id','qishu','create_time','datetime','state','prev_text','ball_1','ball_2','ball_3','ball_4','ball_5'])
            ->from($table)
            ->orderBy(['datetime'=>SORT_DESC])
            ->where('1');
        if($s_time){
            $ssc->andWhere('datetime >= :start_time',[':start_time'=>$s_time]);
            $ssc->andWhere('datetime <= :end_time',[':end_time'=>$e_time]);
        }
        if($qishu_query){
            $ssc->andWhere('qishu = :query_time',[':query_time'=>$qishu_query]);
        }
        return $ssc;
    }
    public static function check_result($gType='',$qishu=''){
        if($qishu){
            $where['qishu'] = $qishu;
            $table = 'lottery_result_'."$gType";
            $rows = (new \yii\db\Query())
                ->select('id')
                ->from($table)
                ->where($where)
                ->limit(1)
                ->all();
        }
        if ($rows) {
            return $rows;
        }
    }
}
