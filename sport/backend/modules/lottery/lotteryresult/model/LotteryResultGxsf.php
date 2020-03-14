<?php

namespace app\modules\lottery\lotteryresult\model;

use Yii;

/**
 * This is the model class for table "lottery_result_gxsf".
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
 * @property string $ball_quick
 */
class LotteryResultGxsf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lottery_result_gxsf';
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
            [['qishu', 'state', 'ball_quick'], 'string', 'max' => 255],
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
            'ball_quick' => 'Ball Quick',
        ];
    }
    public static function GxsfcList($time,$qihao){
        $list = self::find()
            ->select(['id','qishu','create_time','datetime','state','prev_text','ball_1','ball_2','ball_3','ball_4','ball_5'])
            ->orderBy(['datetime'=>SORT_DESC]);
        if($time != ''){
            $s_time = $time.' 00:00:00';
            $e_time = $time.' 23:59:59';
            $list->andWhere('datetime >= :start_time',[':start_time'=>$s_time]);
            $list->andWhere('datetime <= :end_time',[':end_time'=>$e_time]);
        }
        if($qihao){
            $list->andWhere('qishu = :query_time',[':query_time'=>$qihao]);
        }
        return $list;
    }
    //期数是否存在
    public static function Qishi($where){
        $gdsfc_qihao = self::find()
            ->select('id')
            ->where($where)
            ->limit(1)
            ->all();
        return $gdsfc_qihao;
    }
    public static function Edit($id){
        $where['id'] = $id;
        $resule_id = self::find()
            ->select('*')
            ->where($where);
        return $resule_id;
    }
    //修改做记录用
    public static function Up($where){
        $resule_id = self::find()
            ->select('*')
            ->where($where)
            ->limit('1')->asArray()->all();
        return $resule_id;
    }
}
