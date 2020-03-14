<?php

namespace app\modules\lottery\lotteryorder\model;

use app\modules\core\common\models\UserList;
use app\modules\general\member\models\ar\OrderLotterySub;
use app\modules\lottery\lotteryorder\model\MoneyLog;
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
    public static function chin($status,$type='',$uid='',$s_time='',$e_time='',$qishu='',$tf_id='',$excludeids=''){
        $list = OrderLottery::find()
            ->select(array("o.order_num","o.Gtype","o.lottery_number","o.rtype_str","o_sub.quick_type","o_sub.bet_money","o_sub.fs","o_sub.bet_rate","o_sub.win","o_sub.is_win","o_sub.status","o_sub.number","o_sub.order_sub_num","o_sub.id","o.bet_time","o.user_id"))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num=o_sub.order_num")
            ->orderBy(['o.id'=> SORT_DESC])
            ->where(1);
            if($status != '0,1,2,3'){
                $list->andWhere('o_sub.status = :status',[':status'=>$status]);
            }else{
                $list->andWhere(['in','o_sub.status',[0,1,2,3]]);
            }
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
        if($excludeids){
            $list->andWhere(['not in', 'o.user_id', array_column($excludeids,'user_id')]);
        }
        return $list;
    }
    public static function fschin($status,$type='',$uid='',$s_time='',$e_time='',$qishu='',$tf_id=''){
        $list = OrderLottery::find()
            ->select(array("o.order_num","o.Gtype","o.lottery_number","o.rtype_str","o_sub.quick_type","o_sub.bet_money","o_sub.fs","o_sub.bet_rate","o_sub.win","o_sub.is_win","o_sub.status","o_sub.number","o_sub.order_sub_num","o_sub.id","o.bet_time","o.user_id"))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num=o_sub.order_num")
            ->orderBy(['o.id'=> SORT_DESC])
            ->where(1);
            $list->andWhere(['in','o_sub.status',[1]]);
            if($status == '0'){
                $list->andWhere('o_sub.fs = :fs',[':fs'=>0]);
            }else{
                $list->andWhere('o_sub.fs > :fs',[':fs'=>0]);
            }
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
            case 'SSRC':
                echo '极速赛车';
                break;
            case 'MLAFT':
                echo '幸运飞艇';
                break;
            case 'TS':
                echo '腾讯分分彩';
                break;
            case 'ORPK':
                echo '老PK拾';
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
                ->all();
            if ($rows) {
                $realyname = $rows['0']['pay_name'];
            } else {
                $realyname = "0";
            }
        }
        return $realyname;
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
    public static function resultb5($gType,$s_time='',$e_time='',$qishu_query=''){
        $table = 'lottery_result_'."$gType";
        $b5 = OrderLottery::find()
            ->select(['id','qishu','create_time','datetime','state','prev_text','ball_1','ball_2','ball_3','ball_4','ball_5'])
            ->from($table)
            ->where('1=1');
        if($s_time != ''){
            $b5->andWhere('datetime >= :start_time',[':start_time'=>$s_time]);
            $b5->andWhere('datetime <= :end_time',[':end_time'=>$e_time]);
        }
        if($qishu_query != ''){
            $b5->andWhere('qishu = :query_time',[':query_time'=>$qishu_query]);
        }
        return $b5;
    }
    public  static function getOrderByOrderid($userId,$orderNum){
        $list = OrderLottery::find()
            ->select(array("o.lottery_number AS qishu","o.rtype_str","o.order_num","o_sub.bet_money","SUM(o_sub.fs) AS fs","o_sub.order_sub_num",
                "o.user_id","o.bet_time","o_sub.quick_type","o_sub.number","o_sub.bet_rate","o_sub.is_win","o_sub.id AS id","o_sub.win AS win_sub", "o_sub.balance","o_sub.is_win",
                "o.rtype_str","o_sub.win","o_sub.status","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) is_win_total","u.user_name"))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num=o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where(array('o.user_id'=>$userId))
            ->andWhere('o.order_num = :order_num',[':order_num'=>$orderNum]);
        $list->groupBy(array('o_sub.order_sub_num'))->orderBy(array('bet_time' => SORT_DESC));
        return $list;
    }
    public static function uids($status,$start_time,$end_time){
        $uids = OrderLottery::find()
            ->select('o.user_id')
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num = o_sub.order_num")
            ->innerJoin('user_list as u',"o.user_id=u.user_id")
            ->where($status)
            ->andWhere('o.bet_time >= :start_time',[':start_time'=>$start_time])
            ->andWhere('o.bet_time <= :end_time',[':end_time'=>$end_time])
            ->andWhere([">","o_sub.bet_money","0"])
            ->orderBy('o_sub.id desc')
            ->groupBy('o.user_id')
            ->asArray()->all();
        return $uids;
    }
    public static function ByUser($bid,$start_time,$end_time,$status,$qishu){
        $list = OrderLottery::find()
            ->select(array("u.user_name","u.pay_name","count(o_sub.id) bet_count","sum(o_sub.bet_money) bet_money_total","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=2,o_sub.bet_money,IF(o_sub.is_win=0,o_sub.fs,0)))) win_total"))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num = o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where(['o.user_id'=>$bid])
            ->andWhere('o.bet_time >= :start_time',[':start_time'=>$start_time])
            ->andWhere('o.bet_time <= :end_time',[':end_time'=>$end_time])
            ->andWhere($status)
            ->groupBy('o.user_id')
            ->orderBy('o_sub.id DESC');

        if($qishu){
            $list->andWhere('o.lottery_number = :lottery_number',[':lottery_number'=>$qishu]);
        }
        return $list;
    }
    public static function FsByUser($bid,$start_time,$end_time,$status,$js){
        $list = OrderLottery::find()
            ->select(array("sum(o_sub.fs) sum_fs","u.user_name","u.user_id user_id","u.pay_name","count(o_sub.id) bet_count","sum(o_sub.bet_money) bet_money_total","SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=2,o_sub.bet_money,IF(o_sub.is_win=0,o_sub.fs,0)))) win_total"))
            ->from("order_lottery as o")
            ->innerJoin("order_lottery_sub as o_sub","o.order_num = o_sub.order_num")
            ->innerJoin("user_list as u","o.user_id=u.user_id")
            ->where(['o.user_id'=>$bid])
            ->andWhere('o.bet_time >= :start_time',[':start_time'=>$start_time])
            ->andWhere('o.bet_time <= :end_time',[':end_time'=>$end_time])
            ->andWhere($status)
            ->groupBy('o.user_id')
            ->orderBy('o_sub.id DESC');

        if($js=='0'){
            $list->andWhere('o_sub.fs = :fs',[':fs'=>'0']);
        }
        elseif($js=='1'){
            $list->andWhere('o_sub.fs <> :fs',[':fs'=>'0']);
        }
        return $list;
    }
    //子订单获取主订单
    public static function getOrderNum($order_num_sub){
        $order_lottery_sub = self::find()
            ->select(['order_num','order_sub_num','quick_type','number','bet_rate','bet_money','win','fs','status','is_win'])
            ->from('order_lottery_sub')
            ->where(['order_sub_num' => $order_num_sub])
            ->limit(1)
            ->asArray()
            ->all();
        $order_lottery = self::find()
            ->select(['rtype_str','bet_time','lottery_number','user_id'])
            ->from('order_lottery')
            ->where(['order_num' => $order_lottery_sub[0]['order_num']])
            ->limit(1)
            ->asArray()
            ->all();
        $user_name = self::find()
            ->select('user_name')
            ->from('user_list')
            ->where(['user_id' => $order_lottery[0]['user_id']])
            ->limit(1)
            ->asArray()
            ->all();
        $list = array_merge($order_lottery_sub[0],$order_lottery[0],$user_name[0]);
        return $list;
    }
    /**
     * 彩票注单查询
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    public static function getBetMoneyAndCount1($s_time,$e_time,$type,$id){
        $rs = array('bet_count'=>0,'bet_money'=>0);
        if($id){
            $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o.Gtype = '$type' "
                . "AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) AND user_id IN ($id)";
            $rs = OrderLottery::findBySql($sql)
                ->asArray()->one();
        }
        return $rs;
    }
    /**
     * 各个类型的彩种 注单结果
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    public static function getWin1($s_time,$e_time,$type,$id){
        if($id){
            $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
                . "AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) "
                . " AND o.Gtype='$type' AND o.user_id in ($id) LIMIT 0,1";
            $r1 = OrderLottery::findBySql($sql)->asArray()->one();
            $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '0' "
                . "AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) "
                . "AND o.Gtype='$type' AND o.user_id in ($id) AND o_sub.is_win!=2 LIMIT 0,1";
            $r2 = OrderLottery::findBySql($sql)->asArray()->one();
            $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.Gtype='$type' AND  o.user_id in ($id) "
                . "AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
            $r3 = OrderLottery::findBySql($sql)->asArray()->one();
            return $r1['win_money']+$r2['win_fs']+$r3['win_back'];
        }
        return 0;
    }
    public static function selectOrderDetailnew($arr_id){
        $r = OrderLottery::find()
            ->select([
                'o.Gtype',
                'o.lottery_number AS qishu',
                'o.rtype_str',
                'o.bet_time',
                'o.order_num',
                'o_sub.quick_type',
                'o_sub.number',
                'o_sub.bet_money AS bet_money_one',
                'o_sub.fs',
                'o.user_id',
                'o_sub.bet_rate AS bet_rate_one',
                'o_sub.is_win',
                'o_sub.status',
                'o_sub.win',
                'o_sub.id AS id',
                'o_sub.win AS win_sub',
                'o_sub.balance',
                'o_sub.order_sub_num'
            ])
            ->from('order_lottery as o')
            ->innerJoin('order_lottery_sub as o_sub','o.order_num=o_sub.order_num')
            ->where(['in','o_sub.id',$arr_id])
            ->orderBy('o_sub.id desc');
        return $r;
    }
    //彩票 --和
    public static function getHe($s_time,$e_time,$type,$id){
        if($id){
            $sql = "SELECT sum(IF(o_sub.is_win=2,o_sub.bet_money,0)) as bet_he
                FROM user_list u,order_lottery o,order_lottery_sub o_sub
                WHERE u.user_id in($id) AND o.order_num=o_sub.order_num AND o.user_id=u.user_id 
                AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) ";
            if ($type != "ALL_LOTTERY") {
                $sql .= " and o.Gtype='" . $type . "'";
            }
            if ($s_time) {
                $sql.=" and o.bet_time>='" . $s_time . "'";
            }
            if ($e_time)
                $sql.=" and o.bet_time<='" . $e_time . "'";
            $sql.=" group by o.user_id order by o_sub.id desc";
            $data = self::findBySql($sql)->asArray()->one();
		
		    return $data['bet_he'];
		}
        return 0;
    }
    /**
     * 报表明细--彩票 （注单数，下注金额）
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    public static function getBetMoneyAndCount($s_time,$e_time,$id){
        $r = OrderLottery::find()
            ->select(['COUNT(o_sub.id) AS bet_count','IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money'])
            ->from('order_lottery as o')
            ->innerJoin("order_lottery_sub as o_sub","o.order_num=o_sub.order_num")
            ->where("o.bet_time >='$s_time' ")
            ->andWhere("o.bet_time <='$e_time'")
            ->andWhere(['in','user_id',$id])
            ->asArray()->one();
        return $r;
    }

    /**
     * 各个类型的彩种 注单结果
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    public static function getWin($s_time,$e_time,$id){
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' ";
        if($id){
            $sql .= " AND o.user_id in ($id)  LIMIT 0,1";
        }else{
            $sql .=  " LIMIT 0,1";
        }
        $r1 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '0' ";
        if($id){
            $sql .= "AND o.user_id in ($id) AND o_sub.is_win!=2 LIMIT 0,1";
        }else{
            $sql .= "AND o_sub.is_win!=2 LIMIT 0,1";
        }
        $r2 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
            . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3')";
        if($id){
            $sql .= "AND o.user_id in ($id) AND o_sub.is_win!=2 LIMIT 0,1";
        }else{
            $sql .= "AND o_sub.is_win!=2 LIMIT 0,1";
        }
        $r3 = OrderLottery::findBySql($sql)->asArray()->one();
        return $r1['win_money']+$r2['win_fs']+$r3['win_back'];
    }
    /**
     * 查询彩票用户信息
     * @param type $s_time
     * @param type $e_time
     * @param type $gtype
     * @param type $bid
     */
    public static function selectUserData($s_time, $e_time, $gtype, $bid,$offset,$limit) {
        $sql = "SELECT u.user_name,u.pay_name,u.user_id,sum(IF(o_sub.is_win=2,o_sub.bet_money,0)) as bet_he,"
                ." count(o_sub.id) bet_count,sum(o_sub.bet_money) bet_money_total,"
                ." SUM(IF(o_sub.is_win=1,o_sub.win+o_sub.fs,IF(o_sub.is_win=0,o_sub.fs,0))) win_total"
                ." FROM user_list u,order_lottery o,order_lottery_sub o_sub"
                ." WHERE u.user_id in($bid) AND o.order_num=o_sub.order_num AND o.user_id=u.user_id "
                ." AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) ";
        if ($gtype != "ALL_LOTTERY") {
            $sql .= " AND o.Gtype='" . $gtype . "'";
        }
        if ($s_time) {
            $sql.=" AND o.bet_time>='" . $s_time . "'";
        }
        if ($e_time)
            $sql.=" AND o.bet_time<='" . $e_time . "'";
        $sql.=" group by o.user_id order by o_sub.id desc";
        $dataCount = count(OrderLottery::findBySql($sql)->asArray()->all());
        $sql.=" LIMIT ".$limit."  OFFSET ".$offset."";
        $data = OrderLottery::findBySql($sql)->asArray()->all();
        return ['data'=>$data, 'count'=>$dataCount];
    }
    /*
     * 查询报表首页
     * param $s_time
     * param $e_time
     * param $id
     * return array
     * */
    public static function reportIndex($s_time,$e_time,$id){
        $sqlCount = "SELECT COUNT(o_sub.id) AS bet_count,IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money FROM order_lottery as o,order_lottery_sub as o_sub"
            ." WHERE o.order_num=o_sub.order_num AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time'";
		if($id){
            $sqlCount .= " AND o.user_id in ($id)  LIMIT 0,1";
        }else{
            $sqlCount .=  " LIMIT 0,1";
        }
        $dataCount = OrderLottery::findBySql($sqlCount)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' ";
        if($id){
            $sql .= " AND o.user_id in ($id)  LIMIT 0,1";
        }else{
            $sql .=  " LIMIT 0,1";
        }
		
        $r1 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '0' ";
        if($id){
            $sql .= "AND o.user_id in ($id) AND o_sub.is_win!=2 LIMIT 0,1";
        }else{
            $sql .= "AND o_sub.is_win!=2 LIMIT 0,1";
        }
        $r2 = OrderLottery::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
            . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
            . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
            . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3')";
        if($id){
            $sql .= "AND o.user_id in ($id) AND o_sub.is_win!=2 LIMIT 0,1";
        }else{
            $sql .= "AND o_sub.is_win!=2 LIMIT 0,1";
        }
        $r3 = OrderLottery::findBySql($sql)->asArray()->one();
        return array($r1['win_money']+$r2['win_fs']+$r3['win_back'],$dataCount);
    }
    /**
     * 查询彩票用户有效投注金额
     * @param type $s_time
     * @param type $e_time
     * @param type $gtype
     * @param type $bid
     */
    public static function selectTrueMoney($id,$s_time,$e_time) {
        $bet_total = OrderLottery::find()->select(['sum(bet_money) as bet_money_total'])->where(['user_id' => $id])->andWhere(['>', 'bet_time', $s_time])->andWhere(['<', 'bet_time', $e_time])
            ->andWhere(['status' => [1, 2]])->limit(1)->asArray()->one(); //彩票注单总金额
        if (!$bet_total || !$bet_total["bet_money_total"]) {
            $total = 0;
        } else {
            $total = $bet_total["bet_money_total"];
        }
        if($id){
            $sql = "SELECT sum(IF(o_sub.is_win=2,o_sub.bet_money,0)) as bet_he
            FROM user_list u,order_lottery o,order_lottery_sub o_sub
            WHERE u.user_id in($id) AND o.order_num=o_sub.order_num AND o.user_id=u.user_id 
            AND (o.status <> 0 AND o.status <> 3) AND (o_sub.status <> 0 AND o_sub.status <> 3) ";
            if ($s_time) {
                $sql.=" and o.bet_time>='" . $s_time . "'";
            }
            if ($e_time)
                $sql.=" and o.bet_time<='" . $e_time . "'";
            $sql.=" group by o.user_id order by o_sub.id desc";
            $data = self::findBySql($sql)->asArray()->one();
            $he = $data['bet_he'];
        }else{
            $he = 0;
        }
        return ($total - $he);
    }
    
    /*
    * 订单作废
    * OrderLottery 与  manage_log user_list 都要修改
    * @$user 操作人名称
    * @$orderSubNum  子订单ID
    * @$reason 作废理由
    * @$status 订单状态 0:未结算 1:已结算 2:重新结算 3:已作废
    *  修改子订单状态
    * manage_log  对作废理由，作废用户进行修改
    * user_list  对用户金额进行修改
    * OrderLottery  当订单的所有子订单都作废的情况下修改主订单的订单状态为作废
    */

    public static function cancelOrder($orderSubNum='',$reason){

        $updateOrder  = $updateSub = $log = $updateMoney = 1;
        $orderSub = OrderLotterySub::findOne(array('id'=>$orderSubNum));
        $db = Yii::$app->db;
        $betMoney = 0;
        if($orderSub){
            $orderNum = $orderSub->order_num;
            $betMoney = $orderSub->bet_money;

            $order = OrderLottery::findOne(array('order_num'=>$orderNum));
            if($order){
                $userId = $order->user_id;
                $user = UserList::findOne(array('user_id'=>$userId));
                
                /*if($orderSub->status ==1 || $orderSub->status ==2){//如果注单已经结算或者重新结算状态，则需修改金额
                    if($orderSub->is_win==0){//未中奖
                        $betMoney = $betMoney-($orderSub->fs);
                        $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额 把下注金额退回，减除反水金额
                    }elseif($orderSub->is_win==1){//中奖
                        $betMoney=($betMoney-($orderSub->win)-($orderSub->fs));
                        $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额 把减去中奖金额与反水金额，加上下注金额
                    }
                }else{
                    $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额
                }*/
                // 僅未結算可修正
                if( $orderSub->status == 0 ){
                    $updateMoney = UserList::updateMoney($userId,$betMoney);//修改用户账户余额
                } else {
                    return false;
                }
                //修改子订单状态
                $updateSub =  $db->createCommand()
                ->update('order_lottery_sub', ['status' => 3 ], 'id = :id',[':id'=>$orderSubNum ] )->execute();

                $orderSubs = OrderLotterySub::find(array('order_num'=>$orderNum))->select('count(id) as count')->andWhere('status !=:status',array(':status'=>3))->asArray()->one();
                if($orderSubs['count'] == 0){
                    //当所有子订单都作废则修改主订单状态也为作废
                    $updateOrder =  $db->createCommand()
                    ->update('order_lottery', ['status' => 3 ], 'order_num = :order_num',[':order_num'=>$orderNum ] )->execute();
                }
                //金额记录
                $moneyLog = MoneyLog::lotteryCancel($userId,$orderSub['order_sub_num'],$betMoney,$user['money'],$user['money']+$betMoney,$order->rtype_str,'訂單:'.$orderSub['order_sub_num'].'作廢');
            }
        }
        if($updateSub && $log && $updateMoney && $updateOrder){
            return 0;
        }
        return false;
    }

    public static function updateStatusByFs($liveusername,$rate,$start_order_time,$end_order_time){
        $status = ['in','o_sub.status',[1]];// 只輸出已結算的單
        $js = '0';
        $list = OrderLottery::find()
            ->select("o_sub.order_sub_num,o_sub.bet_money")
            ->from("order_lottery_sub as o_sub")
            ->innerJoin("order_lottery as o","o_sub.order_num = o.order_num")
            ->andWhere('o.bet_time >= :start_time',[':start_time'=>$start_order_time])
            ->andWhere('o.bet_time <= :end_time',[':end_time'=>$end_order_time])
            ->andWhere($status)
            ->andWhere('o_sub.fs = 0')
            ->andWhere('o.user_id = :user_id',[':user_id'=>$liveusername])
            ->orderBy('o_sub.id DESC')
            ->asArray()  
            ->all();
        foreach ($list as $key => $value) {
            $money = $rate*$value['bet_money']/1000;
            OrderLotterySub::updateAll(['fs' => $money], "order_sub_num=:order_sub_num and fs=0", [':order_sub_num' => $value['order_sub_num']]);
        }
        return $list;

    }

    public static function updateStatusByFsAll($liveusername,$rate,$start_order_time,$end_order_time){

        $db = Yii::$app->db;
        $sql = "UPDATE order_lottery_sub AS o_sub LEFT JOIN order_lottery AS o ".
               "ON o_sub.order_num = o.order_num ".
               "SET o_sub.fs = (o_sub.bet_money*".$rate."/1000 )".
            " WHERE o.bet_time >= '". $start_order_time ."' ".
            " AND o.bet_time <= '". $end_order_time ."' ".
            " AND o_sub.status = 1 ".
            " AND o_sub.fs = 0 ".
            " AND o.user_id = ". $liveusername ." ";
        $db->createCommand($sql)->execute();

        return true;

    }

}
