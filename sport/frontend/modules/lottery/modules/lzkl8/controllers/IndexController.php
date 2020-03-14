<?php
namespace app\modules\lottery\modules\lzkl8\controllers;

use app\modules\lottery\helpers\DataValid;
use app\modules\lottery\helpers\LiangMian;
use Yii;
use yii\web\Controller;
use app\modules\lottery\models\ar\OddsLottery;
use app\modules\lottery\models\ar\LotterySchedule;
use app\modules\lottery\models\ar\UserGroup;
use app\modules\lottery\models\ar\UserList;
use app\modules\lottery\models\ar\OrderLottery;
use app\modules\lottery\models\ar\OrderLotterySub;
use app\modules\lottery\models\ar\MoneyLog;
use app\modules\lottery\modules\lzkl8\models\ar\LotteryResultBjkn;
use app\modules\lottery\modules\lzkl8\util\BallUtil;
use app\modules\lottery\models\ar\WebClose;
use app\modules\lottery\models\ar\Luzhu;
use app\modules\lottery\models\ar\Longhu;
use app\common\base\BaseController;
use yii\helpers\ArrayHelper;
use app\modules\core\common\filters\LoginFilter;
use app\modules\core\common\filters\UserFilter;
use yii\helpers\Json;

/**
 * IndexController
 */
class IndexController extends BaseController {
    const CONST_LOTTERY_TYPE='BJKN';
    const CONST_LOTTERY_NAME='北京快乐8';
    private $_server = 1;

    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        $this->getView()->title = self::CONST_LOTTERY_NAME;
        $view = Yii::$app->view;
        $view->params['type']=self::CONST_LOTTERY_TYPE;
        $Lottery_set = WebClose::getWebClose('kl8');
        $view->params['close'] = $Lottery_set['close'];
        $view->params['name'] = $Lottery_set['name'];
        $this->layout = '@app/modules/lottery/views/layouts/lottery';
        $this->enableCsrfValidation = false;
    }
    /**
     * 判断登录状态
     * 用于prepare-order insert-order
     * */
    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => LoginFilter::className(),
                'only' => ['prepare-order','insert-order']
            ],
            [
                'class' => UserFilter::className(),
                'only' => ['prepare-order','insert-order']
            ],
        ], parent::behaviors());
    }
    /**
     * 默认处理方法
     *
     * @return string
     */
    public function actionIndex() {
        $Lottery_set = WebClose::getWebClose('kl8');
        $result = LotteryResultBjkn::getKJResult();
        $oddslist=$this->GetOddsList();
        return $this->render ( 'index', [
            'oddslist' => $oddslist,
            'result' => $result,
            'close'=>$Lottery_set['close']
        ] );
    }
    /**
     * 新增的静态方法
     * lotter/indexController调用
     * 返回下期arr('下期开奖期号'，'下期封盘倒计时'，'下期开奖倒计时'，'最后一期开奖期号','最后一期开奖结果')
     * */
    public static function getBjkl8Info(){
        $schedule = self::GetScheduleInfo();//返回时间为年月日
        $currenttime=date("Y-m-d H:i:s",time());//当前时间没问题
        $nextQishu=$schedule["qishu"];
        $opentime=strtotime($schedule["kaijiang_time"])-strtotime($currenttime);
        $differtime=strtotime($schedule["fenpan_time"])-strtotime($currenttime);
        $KJResult=LotteryResultBjkn::getKJResult();
        if ($KJResult){
            $lastQishu = $KJResult['qishu'];
            $hm [] = $KJResult ['ball_1'];
            $hm [] = $KJResult ['ball_2'];
            $hm [] = $KJResult ['ball_3'];
            $hm [] = $KJResult ['ball_4'];
            $hm [] = $KJResult ['ball_5'];
            $hm [] = $KJResult ['ball_6'];
            $hm [] = $KJResult ['ball_7'];
            $hm [] = $KJResult ['ball_8'];
            $hm [] = $KJResult ['ball_9'];
            $hm [] = $KJResult ['ball_10'];
            $hm [] = $KJResult ['ball_11'];
            $hm [] = $KJResult ['ball_12'];
            $hm [] = $KJResult ['ball_13'];
            $hm [] = $KJResult ['ball_14'];
            $hm [] = $KJResult ['ball_15'];
            $hm [] = $KJResult ['ball_16'];
            $hm [] = $KJResult ['ball_17'];
            $hm [] = $KJResult ['ball_18'];
            $hm [] = $KJResult ['ball_19'];
            $hm [] = $KJResult ['ball_20'];
        }
        else{
            $lastQishu = '00000000';
            $hm = array();
        }
        $frontinfo = array (
            'number' => $nextQishu,
            'opentime' => $opentime,
            'fengpan' => $differtime,
            'numbers' => $lastQishu,
            'hm' => $hm,
        );
        return $frontinfo;
    }
    /**
     * 获取彩票信息
     * $number 当期开奖期号
     * $fengpan  下期封盘时间
     * $opentime 下期开奖时间
     * */
    public function actionGetFrontInfo() {
        $schedule=$this->GetScheduleInfo();
        $currenttime=date("Y-m-d H:i:s",time());
        $qishu=$schedule["qishu"];
        $opentime=strtotime($schedule["kaijiang_time"])-strtotime($currenttime);
        $differtime=strtotime($schedule["fenpan_time"])-strtotime($currenttime);
        $frontinfo = array (
            'number' => $qishu,
            'opentime' => $opentime,
            'fengpan' => $differtime
        );
        $json_string = json_encode($frontinfo);
        return $json_string;
    }
    /**
     * 获取最后一期开奖结果
     * */
    public function actionGetKJResult() {
        $KJResult=LotteryResultBjkn::getKJResult();
        if ($KJResult)
        {
            $qishu = $KJResult ['qishu'];
            $hm [] = $KJResult ['ball_1'];
            $hm [] = $KJResult ['ball_2'];
            $hm [] = $KJResult ['ball_3'];
            $hm [] = $KJResult ['ball_4'];
            $hm [] = $KJResult ['ball_5'];
            $hm [] = $KJResult ['ball_6'];
            $hm [] = $KJResult ['ball_7'];
            $hm [] = $KJResult ['ball_8'];
            $hm [] = $KJResult ['ball_9'];
            $hm [] = $KJResult ['ball_10'];
            $hm [] = $KJResult ['ball_11'];
            $hm [] = $KJResult ['ball_12'];
            $hm [] = $KJResult ['ball_13'];
            $hm [] = $KJResult ['ball_14'];
            $hm [] = $KJResult ['ball_15'];
            $hm [] = $KJResult ['ball_16'];
            $hm [] = $KJResult ['ball_17'];
            $hm [] = $KJResult ['ball_18'];
            $hm [] = $KJResult ['ball_19'];
            $hm [] = $KJResult ['ball_20'];
        } else {
            $qishu = '00000000';
            $hm = array ();
        }

        $KJinfo = array (
            'numbers' => $qishu,
            'hm' => $hm,
        );

        $json_string = json_encode($KJinfo);
        echo $json_string;
    }
    /**
     * 投注前验证
     * 正确返回投注信息
     * 错误返回错误信息
     * */
    public function actionPrepareOrder() {
        $data=$this->getParam('data','');
        $data=$this->object_array(json_decode($data));
        $ret = $this->data_valid ( $data );
        foreach($data as $k=>$v){
            $arr = explode('_',$k);
            $this->_server = $arr[1];
            break;
        }
        if ($ret) {
            return $ret;
        }

        $ballutil=new BallUtil();
        $oddslist=$this->GetOddsList();

        $names = array_keys ( $data );
        $sumbetball = 0;
        $x2x5=null;
        $Nosame = [];
        for($i = 0; $i < count ( $data ); $i ++) {
            $qiu = explode ( '_', $names [$i] );
            if (($qiu[1] < 6) && (1 < $qiu[1])) {
                if ((0 < $qiu[2]) && ($qiu[2] < 81)) {
                    if(in_array($qiu[2],$Nosame)){
                        $valid= ["code" => 11];
                        $json_string = json_encode($valid);
                        return $json_string;
                    }else{
                        $Nosame[] = trim($qiu[2]);
                    }
                    $x2x5 = $x2x5 . $qiu[2] . ',';
                }
            }
        }
        $x2x5 = rtrim($x2x5, ',');
        $wanfa_multi = $x2x5;

        $flag=1;
        $summoney=0;
        $ballmsg=null;
        for($i = 0; $i < count ( $data ); $i ++) {
            if($this->_server==1||$this->_server == 6 ||$this->_server == 7 ||$this->_server == 8) {
                $summoney = $summoney + $data [$names [$i]];
                $sumbetball++;
            }else {
                $summoney=$data [$names [$i]];
                $sumbetball = 1;
            }
            $qiu = explode ( '_', $names [$i] );
            $qiuhao = $ballutil->getdid($qiu [1]);
            if ($qiu [1] == 1) {
                $wanfa = $qiu [2];
                $odd = $oddslist['ball'] [1] [1];
            } else if ($qiu [1] == 6) {
                $wanfa = $ballutil->getwan6($qiu [2]);
                $odd = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
            } else if ($qiu [1] == 7) {
                $wanfa = $ballutil->getwan7($qiu [2]);
                $odd = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
            } else if ($qiu [1] == 8) {
                $wanfa = $ballutil->getwan8($qiu [2]);
                $odd = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
            } else {
                if($flag==1){
                    if($qiu [1] == 2){
                        $flag=0;
                        $odd = $oddslist['ball'][2][1];
                        $wanfa=$wanfa_multi;
                    }else if($qiu [1] == 3){
                        $flag=0;
                        $odd = $oddslist['ball'][3][1].','.$oddslist['ball'][3][2];
                        $wanfa=$wanfa_multi;
                    }else if($qiu [1] == 4){
                        $flag=0;
                        $odd = $oddslist['ball'][4][1] . ',' . $oddslist['ball'][4][2] . ',' . $oddslist['ball'][4][3];
                        $wanfa=$wanfa_multi;
                    }else if($qiu [1] == 5){
                        $flag=0;
                        $odd = $oddslist['ball'][5][1] . ',' . $oddslist['ball'][5][2] . ',' . $oddslist['ball'][5][3];
                        $wanfa=$wanfa_multi;
                    }
                }else{
                    continue;
                }
            }
            $ballmsg = $ballmsg . $qiuhao . "[" . $wanfa . "] @ " . $odd . " x ￥" . $data [$names [$i]] . "<br />";
        }
        $promptinfo = array(
            'summoney' => $summoney,
            'sumbetball' => $sumbetball,
            'ballmsg' => $ballmsg,
        );
        $json_string = json_encode($promptinfo);
        return $json_string;
    }
    /**
     * 投注函数
     * 验证数据正确性
     * 入库顺序主订单、更新余额、日志、子订单
     * 正常返回code10 失败返回code 8
     * */
    public function actionInsertOrder() {
        $data=$this->getParam('data','');
        $data=$this->object_array(json_decode($data));
        // 效验数据
        $ret = $this->data_valid ( $data );
        if ($ret) {
            return $ret;
        }

        // 效验数据(球號)
        $check = $this->dataCheck ( $data );
        if ($check) {
            return $check;
        }

        $innerTransaction = Yii::$app->db->beginTransaction();
    try {
        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $oddslist=$this->GetOddsList();
        $schedule=$this->GetScheduleInfo();
        $currenttime=date("Y-m-d H:i:s",time());

        $orderlottery=new OrderLottery();

        $orderlottery->user_id=$userid;
        $orderlottery->Gtype=self::CONST_LOTTERY_TYPE;
        $orderlottery->rtype_str='快速-北京快乐8';
        $orderlottery->rtype='751';
        $orderlottery->bet_info='bet_info';

        $orderlottery->bet_money=$this->sum_bet_money($data);
        $orderlottery->win=0;
        $orderlottery->lottery_number=$schedule['qishu'];
        $orderlottery->bet_time=$currenttime;
        $orderlottery->save();

        $olid=$orderlottery->id;
        $ordernum=date ( 'YmdHis' ) . $olid;
        //$moneylog=new MoneyLog();
        $userinfo=UserList::getUserInfo($userid);
        $usermoney=$userinfo['money'];  //提取用户金额
        //$money_usermoney = MoneyLog::GetLastMoney($userid);
        $balance=$usermoney-$this->sum_bet_money ( $data );

        $sum = $this->sum_bet_money ( $data ); //投注总额
        $uid = $userinfo['id'];  //user_list id
        //new
        // 更新用户余额
        Yii::$app->db->createCommand("update user_list set money=money-$sum where id=:id", [
            ':id' => $uid,
        ])->execute();

        // 用户投注日志
        $lotteryName = self::CONST_LOTTERY_NAME;
        $type = '彩票下注';
        $sql = "INSERT INTO money_log(user_id,order_num,about,update_time,`type`,order_value,assets,balance) select $userid as user_id,$ordernum as order_num,'$lotteryName' as about,'$currenttime' as update_time,'$type' as `type`,$sum as order_value,money+$sum as assets,money as balance from user_list where id=$uid";
        Yii::$app->db->createCommand($sql)->execute();

        $orderlottery=OrderLottery::findOne($olid);
        $orderlottery->order_num=$ordernum;
        $orderlottery->save();

        // 订单明细表入库
        $ballutil=new BallUtil();
        $names=array_keys($data);
        $x2x5=null;
        $Nosame = [];
        $count = count ( $data );
        for($i = 0; $i < $count; $i ++) {
            $qiu = explode ( '_', $names [$i] );

            if (($qiu[1] < 6) && (1 < $qiu[1])) {
                //判別是否為多選號項目
                if ((0 < $qiu[2]) && ($qiu[2] < 81)) {
                    if(in_array($qiu[2],$Nosame)){
                        $valid= ["code" => 11];
                        $json_string = json_encode($valid);
                        return $json_string;
                    }else{
                        $Nosame[] = trim($qiu[2]);
                        $x2x5 = $x2x5 . trim($qiu[2]) . ',';
                    }
                } else {
                    //多選號且為許可外號碼
                    $valid= ["code" => 11];
                    $json_string = json_encode($valid);
                    return $json_string;
                }
            }
        }

        $x2x5 = rtrim($x2x5, ',');
        $wanfa_multi = $x2x5;

        $flag=1;
        $win_money_total=0;
        for($i = 0; $i < count ( $data ); $i ++) {
            $qiu = explode ( '_', $names [$i] );
            $qiuhao = $ballutil->getdid($qiu [1]);
            if ($qiu [1] == 1) {
                $wanfa = $qiu [2];
                $odd = $oddslist['ball'] [$qiu [1]] [1];
            } else if ($qiu [1] == 6) {
                $wanfa = $ballutil->getwan6($qiu [2]);
                $odd = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
            } else if ($qiu [1] == 7) {
                $wanfa = $ballutil->getwan7($qiu [2]);
                $odd = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
            } else if ($qiu [1] == 8) {
                $wanfa = $ballutil->getwan8($qiu [2]);
                $odd = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
            } else {
                if($flag==1){
                    if($qiu [1] == 2){
                        $flag=0;
                        $odd = $oddslist['ball'][2][1];
                        $wanfa=$wanfa_multi;
                    }else if($qiu [1] == 3){
                        $flag=0;
                        $odd = $oddslist['ball'][3][1].','.$oddslist['ball'][3][2];
                        $wanfa=$wanfa_multi;
                    }else if($qiu [1] == 4){
                        $flag=0;
                        $odd = $oddslist['ball'][4][1] . ',' . $oddslist['ball'][4][2] . ',' . $oddslist['ball'][4][3];
                        $wanfa=$wanfa_multi;
                    }else if($qiu [1] == 5){
                        $flag=0;
                        $odd = $oddslist['ball'][5][1] . ',' . $oddslist['ball'][5][2] . ',' . $oddslist['ball'][5][3];
                        $wanfa=$wanfa_multi;
                    }
                }else{
                    continue;
                }
            }

            $money = $data [$names[$i]];

            $bet_rate = $odd;
            $bet_money_one = $money;
            $win_money = $bet_money_one * $odd;
            $win_money_total += $win_money;

            // 反水金额
            $ugul=UserGroup::getUserGroupInfo($userid);
            $fsOdds=$ugul[strtolower ( self::CONST_LOTTERY_TYPE ) . '_bet_reb'];
            $fs_money = $bet_money_one * $fsOdds;

            $orderlotterysub=new OrderLotterySub();
            $orderlotterysub->order_num = $ordernum;
            $orderlotterysub->quick_type = $qiuhao;
            $orderlotterysub->number = $wanfa;
            $orderlotterysub->bet_rate = $bet_rate;
            $orderlotterysub->bet_money = $bet_money_one;
            $orderlotterysub->win = $win_money;
            $orderlotterysub->fs = $fs_money;
            $orderlotterysub->balance = $balance ;
            $orderlotterysub->save();

            $olsid=$orderlotterysub->id;
            $datereg_sub = date ( 'YmdHis' ) . $olsid;

            $order_lottery_sub=OrderLotterySub::findOne($olsid);
            $order_lottery_sub->order_sub_num=$datereg_sub;
            $order_lottery_sub->save();

            $orderlottery=OrderLottery::findOne($olid);
            $orderlottery->win=$win_money_total;
            $orderlottery->save();
        }
            $innerTransaction->commit();
            $valid= ["code" => 10];
            $json_string = json_encode($valid);
            return $json_string;
        } catch (Exception $e) {
            error_log('IndexController.insert：'.$e->getTraceAsString().'online:'.$e->getLine().'，type：lzkl8，time:'.date('Y-m-d h:i:s',time()).''."\r\n", 3, "error.log");
            $innerTransaction->rollBack();
            $valid= ["code" => 8];
            $json_string = json_encode($valid);
            return $json_string;
        }
    }

    /**
     * 获得倍率
     */
    public function GetOddsList() {
        $lottery_subtype=['选号','其他'];
        $odds=OddsLottery::getOdds(self::CONST_LOTTERY_NAME, $lottery_subtype);
        // 设置赔率
        $oddslist ['ball'] [1] [1] = $odds [0] ['h10'];
        $oddslist ['ball'] [2] [1] = $odds [0] ['h9'];
        $oddslist ['ball'] [3] [1] = $odds [0] ['h7'];
        $oddslist ['ball'] [3] [2] = $odds [0] ['h8'];
        $oddslist ['ball'] [4] [1] = $odds [0] ['h4'];
        $oddslist ['ball'] [4] [2] = $odds [0] ['h5'];
        $oddslist ['ball'] [4] [3] = $odds [0] ['h6'];
        $oddslist ['ball'] [5] [1] = $odds [0] ['h1'];
        $oddslist ['ball'] [5] [2] = $odds [0] ['h2'];
        $oddslist ['ball'] [5] [3] = $odds [0] ['h3'];
        $oddslist ['ball'] [6] [1] = $odds [1] ['h3'];
        $oddslist ['ball'] [6] [2] = $odds [1] ['h4'];
        $oddslist ['ball'] [6] [3] = $odds [1] ['h1'];
        $oddslist ['ball'] [6] [4] = $odds [1] ['h2'];
        $oddslist ['ball'] [6] [5] = $odds [1] ['h5'];
        $oddslist ['ball'] [7] [1] = $odds [1] ['h6'];
        $oddslist ['ball'] [7] [2] = $odds [1] ['h7'];
        $oddslist ['ball'] [7] [3] = $odds [1] ['h8'];
        $oddslist ['ball'] [8] [1] = $odds [1] ['h9'];
        $oddslist ['ball'] [8] [2] = $odds [1] ['h10'];
        $oddslist ['ball'] [8] [3] = $odds [1] ['h11'];
        return $oddslist;
    }

    /**
     * 期数
     * 开奖时间
     */
    public function GetScheduleInfo() {
        $firstSchedule = LotterySchedule::getFirstSchedule( self::CONST_LOTTERY_NAME );
        $lastSchedule = LotterySchedule::getLastSchedule( self::CONST_LOTTERY_NAME );

        $isLateNight=false;
        if ((date ( 'H:i:s', time () ) <= $firstSchedule ['kaipan_time']) || ($lastSchedule ['kaijiang_time'] <= date ( 'H:i:s', time () ))) {
            $scheduleinfo = $firstSchedule;
            if ($lastSchedule ['kaijiang_time'] <= date ( 'H:i:s', time () )) {
                $isLateNight = true;
            }
        } else {
            $scheduleinfo = LotterySchedule::getNewSchedule ( self::CONST_LOTTERY_NAME );
        }

        $times = date ( 'H:i:s', time () );
        $jiaodui = WebClose::getWebClose('bjpn_jia');
        $Lottery_set['kl8']['ktime']	= isset($jiaodui['kaijiang_time'])?date('Y-m-d',strtotime($jiaodui['kaijiang_time'])):'2017-01-01'; //default:2017-01-01
        $Lottery_set['kl8']['knum']	=	isset($jiaodui['qishu'])?$jiaodui['qishu']:'800590';//default:800590
        $lasttime = $Lottery_set ['kl8'] ['ktime'] . ' ' . $times;
        $thistime = date ( 'Y-m-d H:i:s', time () );

        $strto_time = strtotime($thistime) - strtotime($lasttime);
        $lost_days = round($strto_time/86400); //计算两个日期时间差
        if ($isLateNight == true)
        {
            $lost_days += 1;
        }

        $schedule['qishu']=(($lost_days * 179) + $Lottery_set['kl8']['knum'] + $scheduleinfo['qishu']) - 1;

        $isLateNight == true ? $time = time () + 86400 : $time = time ();
        $schedule['kaipan_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['kaipan_time'];
        $schedule['fenpan_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['fenpan_time'];
        $schedule['kaijiang_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['kaijiang_time'];

        return $schedule;
    }
    /**
     * 对数据进行效验，效验以下内容：
     * 数据是否为空
     * 数据是否为数字
     * 数据是否为正数
     * 只要一项出错，则返回数据效验失败
     */
    function data_except_valid($data) {
        $names = array_keys ( $data );
        if (count ( $data ) < 1) {
            return false; // 没有选择数据，请重新下注。
        }
        for($i = 0; $i < count ( $data ); $i ++) {
            $bet_money_temp = $data ['' . $names [$i] . ''];
            if (! is_numeric ( $bet_money_temp ) || ! is_int ( $bet_money_temp * 1 ) || (0 > intval ( $bet_money_temp ))) {
                return false;
            }
        }
        return true;
    }
    /**
     * 验证投注金额是否小于用户余额
     * */
    function user_money_limit($data) {
        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $bet_money_total = $this->sum_bet_money ( $data );
        $userinfo=UserList::getUserInfo($userid);
        $assets=$userinfo['money'];

        $balance = $assets - $bet_money_total;
        if ($balance < 0) {
            return false;
        }
        return true;
    }
    /**
     * 对用户金额效验及系统的最大投注限额进行效验
     *
     * @param unknown $userid
     * @param unknown $data
     */
    function system_bet_limit( $data) {
        $bet_money_total = $this->sum_bet_money ( $data );

        $schedule=$this->GetScheduleInfo();
        $qishu=date('Ymd', time()).$schedule["qishu"];

        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];

        $ugul=UserGroup::getUserGroupInfo($userid);
        $maxMoney=$ugul[strtolower ( self::CONST_LOTTERY_TYPE ) . '_max_bet'];

        $max_money_already = OrderLottery::getSumBetMoney ( $userid, self::CONST_LOTTERY_TYPE, $qishu );
        // 校验该用户最大的投注金额

        if ((0 < $maxMoney) && ($maxMoney < ($max_money_already + $bet_money_total))) {
            return false;
        }
        return true;
    }
    /**
     * 验证时间是否在规定时间内
     * */
    function bet_time_limit() {
        $schedule=$this->GetScheduleInfo();
        $fengpanTime= $schedule['fenpan_time'];
        $kaijiangTime= $schedule["kaijiang_time"];
        $currenttime=date("Y-m-d H:i:s",time());
        $diffkaipan=strtotime($schedule["kaipan_time"])-strtotime($currenttime);

        if($diffkaipan>0){
            return false;
        }

        if(($fengpanTime <= $currenttime) && ($currenttime <= $kaijiangTime)) {
            return false;
        }
        return true;
    }
    /**
     * 有点重复 验证投注金额小于用户余额
     * */
    function count_one( $data) {
        $bet_money_total = self::sum_bet_money ( $data );
        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $ugul=UserList::getUserInfo($userid);
        $maxMoney=$ugul['allow_total_money'];
        if ($bet_money_total > $maxMoney && $maxMoney > 0) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * 数据校验
     * @param unknown $data
     * @return number
     */
    function data_valid($data) {
        $data_valid = new DataValid();
        $flag = $this->bet_time_limit ( $data );
        if (! $flag) {
            return $this->out(false,'已经封盘了，超出了投注时间!');
        }
        $flag = $data_valid->data_except_valid ( $data );
        if (! $flag) {
            return $this->out(false,'请输入有效金额!');
        }
        $flag = $data_valid->data_count_valid ( $data );
        if (! $flag) {
            return $this->out(false,'不符合可选择数量!');
        }
        $flag = $this->count_one ( $data );
        if (! $flag) {
            return $this->out(false,'超过当期下注最大金额，请联系管理人员!');
        }
        $flag = $data_valid->bet_scope_limit ( $data,self::CONST_LOTTERY_TYPE );
        if (! $flag) {
            return $this->out(false,'单注金额受限!');
        }
        $flag = $this->user_money_limit ( $data );
        if (! $flag) {
            return $this->out(false,'账户余额不足!');
        }
        $flag = $this->system_bet_limit ( $data );
        if (! $flag) {
            return $this->out(false,'投注总金额不得超过用户所在组最大投注限额!');
        }
    }
    /**
     * 统计投注总额
     * */
    function sum_bet_money($data){
        $bet_money_total=0;
        foreach($data as $k=>$v){
            $arr = explode('_',$k);
            $this->_server = $arr[1];
            break;
        }
        if($this->_server == 1 ||$this->_server == 6 ||$this->_server == 7 ||$this->_server == 8) {
            foreach ($data as $key => $value) {
                $bet_money_total += $value;
            }
        }else{
            foreach ($data as $key => $value) {
                $bet_money_total = $value;
                break;
            }
        }
        return $bet_money_total;
    }
    /**
     * 对象转为数组
     * */
    function object_array($array){
        if(is_object($array)){
            $array = (array)$array;
        }
        if(is_array($array)){
            foreach($array as $key=>$value){
                $array[$key] =$this-> object_array($value);
            }
        }
        return $array;
    }
    /**
     * 总和大小 露珠图
     * tp:1:大小，0：单双
     * 返回页面 适用于load局部调用
     * */
    public function actionOrderList(){
        $type=$this->getParam('tp',0);
        $start=date('Y-m-d',time());
        $list=LotteryResultBjkn::getResultList(NULL,$start);
        $list=array_slice($list,0,120);
        for($b_a=0;$b_a<count($list);$b_a++){
            $ball_count = 0;
            for($i=1;$i<21;$i++){
                $ball_count += $list[$b_a]['ball_'.$i];
            }
            foreach ($list as $row=>$v){
                $list[$b_a]['ball_count'] = $ball_count;
            }

        }
        $heper=new Luzhu($list,1,80,20,$type,1600);
        $return=$heper->cout();
        return $this->renderPartial('@app/modules/lottery/views/luzhutu-danqiu',['arrs'=>$return,'type'=>$type]);
    }
    /**
     * 左侧两面长龙
     * */
    public function actionAjaxchanglong(){
        $start=date('Y-m-d',time());
        $list=LotteryResultBjkn::getResultList(NULL,$start);
        $liangmian = new LiangMian();

        $changlong = [];
        $changlong['总和 - 单'] = $liangmian->count_single($list,20);
        $changlong['总和 - 双'] = $liangmian->count_double($list,20);
        $changlong['总和 - 大'] = $liangmian->count_big($list,20,810);
        $changlong['总和 - 小'] = $liangmian->count_small($list,20,810);
        arsort($changlong);
        return $this->renderpartial("@app/modules/lottery/views/changlong",["changlong"=>$changlong]);
/*

        $count_big = 0;
        $count_small = 0;
        $count_single = 0;
        $count_double = 0;

        $count_ball_big = 0;
        for($i=0;$i<count($list);$i++){  //长龙总和大
            for($ball_count = 1;$ball_count < 21;$ball_count++){
                $count_ball_big += $list[$i]['ball_'.$ball_count];
            }
            if($count_ball_big > 810){
                $count_big  =  $i + 1;
            }else{
                $count_big = $i;
                break;
            }
            $count_ball_big = 0;
        };
        for($i_s=0;$i_s<count($list);$i_s++){
            for($ball_count = 1;$ball_count<21;$ball_count++){
                $count_ball_big += $list[$i_s]['ball_'.$ball_count];
            }
            if($count_ball_big <810){
                $count_small =  $i_s + 1;
            }else{
                $count_small = $i_s;
                break;
            }
        };
        for($i_single=0;$i_single<count($list);$i_single++){
            $single_count = 0;
            for($ball_count = 1;$ball_count<21;$ball_count++){
                $single_count += $list[$i_single]['ball_'.$ball_count];
            }
            if($this->issingle($single_count)){
                $count_single =  $i_single + 1;
            }else{
                $count_single = $i_single;
                break;
            }
        }
        for($i_double=0;$i_double<count($list);$i_double++){
            $double_count = 0;
            for($ball_count = 1;$ball_count<21;$ball_count++){
                $double_count += $list[$i_double]['ball_'.$ball_count];
            }
            if($this->isdouble($double_count)){
                $count_double =  $i_double + 1;
            }else{
                $count_double = $i_double;
                break;
            }
        }
        $return_cl =array(
            array('type' => '总和 - 大','times' => $count_big),
            array('type' => '总和 - 小','times' => $count_small),
            array('type' => '总和 - 单','times' => $count_single),
            array('type' => '总和 - 双','times' => $count_double),
        );
        $lists = array();
        if (is_array($return_cl)) {
            foreach ($return_cl as $val) {
                if($val['times']>1){
                    $order_arr[] = $val['times'];
                    $lists[] = $val;
                }
            }
            $order =  SORT_DESC;
            $type = SORT_NUMERIC;
            if(count($lists) > 0){
                array_multisort($order_arr, $order, $type, $lists);
            }
        }
        return $this->renderpartial("@app/modules/lottery/views/changlong",["changlong"=>$lists]);*/
    }

    /**
     * 数据校验 20190819
     * 驗證北京快乐8前端送出的參數是否在正常範圍
     */
    function dataCheck($data) {
        $names = array_keys($data);

        foreach ($names as $key => $val) {
            $qiu = explode('_', $val);
            //$qiu EX:Array ( [0] => ball [1] => 5 [2] => 14 )
            if($qiu[0]!= 'ball' || count($qiu)!=3 || !is_numeric($qiu[1]) || !is_numeric($qiu[2])){
                return $this->out(false, '错误的下注内容');
            }elseif(!(substr($qiu[1],0,1))|| !(substr($qiu[2],0,1))){  //EX:"ball_04_01":"2"
                return $this->out(false, '错误的下注内容');
            }
            //各別檢查
            switch ($qiu[1]) {
                case '1':
                case '2':
                case '3':
                case '4':
                case '5':
                    if ($qiu[2] < 1 || $qiu[2] > 80) {
                        return $this->out(false, '错误的下注内容');
                    }

                    break;
                case '6':
                    if ($qiu[2] < 1 || $qiu[2] > 5) {
                        return $this->out(false, '错误的下注内容');
                    }

                    break;
                case '7':
                case '8':
                    if ($qiu[2] < 1 || $qiu[2] > 3) {
                        return $this->out(false, '错误的下注内容');
                    }

                    break;
                default:
                    return $this->out(false, '错误的下注内容');
                    break;
            }
        }
    }
}