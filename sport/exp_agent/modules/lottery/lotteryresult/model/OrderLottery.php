<?php

namespace app\modules\lottery\lotteryresult\model;

use app\common\data\Pagination;
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
            [['order_num', 'user_id', 'rtype_str', 'rtype', 'bet_info', 'bet_money', 'win', 'bet_time'], 'required'],
            [['user_id'], 'integer'],
            [['bet_money', 'win'], 'number'],
            [['bet_time'], 'safe'],
            [['order_num', 'bet_rate'], 'string', 'max' => 100],
            [['Gtype', 'lottery_number'], 'string', 'max' => 50],
            [['rtype_str', 'rtype'], 'string', 'max' => 255],
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
    public static function chin($status,$type='',$uid='',$s_time='',$e_time='',$qishu='',$tf_id=''){
        $list = OrderLottery::find()
            ->select(array("o.order_num","o.Gtype","o.lottery_number","o.rtype_str","o_sub.quick_type","o_sub.bet_money","o_sub.fs","o_sub.bet_rate","o_sub.win","o_sub.is_win","o_sub.status","o_sub.number","o_sub.order_sub_num","o_sub.id","o.bet_time","o.user_id"))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num=o_sub.order_num")
            ->where($status);
        if($type != 'ALL_LOTTERY' && $type){
            $list->andWhere('o.Gtype = :Gtype', [':Gtype' => $type]);
        }
        if($uid){
            $list->andWhere('o.user_id=:user_id',[':user_id' => $uid]);
        }
        if($s_time){
            $list->andWhere('o.bet_time >= :start_time',[':start_time'=>$s_time]);
        }
        if($e_time){
            $list->andWhere('o.bet_time <= :end_time',[':end_time'=>$e_time]);
        }
        if($qishu){
            $list->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        if($tf_id){
            $list->andWhere('o_sub.order_sub_num = :order_sub_num',[':order_sub_num'=>$tf_id]);
        }
        return $list;
    }
    public static function uid($username){
        $uid = '';
        if ($username){
            $where['user_name'] = $username;
            $rows = (new \yii\db\Query())
                ->select('user_id')
                ->from('user_list')
                ->where($where)
                ->limit(1)
                ->all();
            if ($rows) {
                $uid = $rows['0']['user_id'];
            } else {
                $uid = "0";
            }
        }
        return $uid;
    }
    public static function username($uid){
        $username = '';
        if ($uid){
            $where['user_id'] = $uid;
            $rows = (new \yii\db\Query())
                ->select('user_name')
                ->from('user_list')
                ->where($where)
                ->limit(1)
                ->all();
            if ($rows) {
                $username = $rows['0']['user_name'];
            } else {
                $username = "0";
            }
        }
        return $username;
    }
    public static function rtype($type){
        switch ($type)
        {
            case 'CQSF':
                echo '重庆快乐十分';
                break;
            case 'CQ':
                echo '重庆时时彩';
                break;
            case 'D3':
                echo '福彩3D';
                break;
            case 'GD11':
                echo '广东11选5';
                break;
            case 'GDSF':
                echo '广东快乐十分';
                break;
            case 'GXSF':
                echo '广西十分彩';
                break;
            case 'JX':
                echo '江西时时彩';
                break;
            case 'BJKN':
                echo '北京快乐8';
                break;
            case 'BJPK':
                echo '北京PK10';
                break;
            case 'P3':
                echo '排列3';
                break;
            case 'T3':
                echo '上海时时乐';
                break;
            case 'TJSF':
                echo '天津快乐十分';
                break;
            case 'TJ':
                echo '极速时时彩';
                break;
        }
    }
    public static function realname($username){
        $realyname = '';
        if ($username){
            $where['user_name'] = $username;
            $rows = (new \yii\db\Query())
                ->select('pay_name')
                ->from('user_list')
                ->where($where)
                ->limit(1)
                ->all();;
            if ($rows) {
                $realyname = $rows['0']['pay_name'];
            } else {
                $realyname = "0";
            }
        }
        return $realyname;
    }
}
