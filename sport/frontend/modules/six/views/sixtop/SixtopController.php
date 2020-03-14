<?php

namespace frontend\modules\six\controllers;

use app\modules\six\helpers\Zodiac;
use Yii;
use yii\web\Controller;
use frontend\modules\six\models\SixLotteryOrder;
use frontend\modules\six\models\SixLotteryOdds;
use frontend\modules\six\models\SixLotterySchedule;
use frontend\modules\six\models\OrderLottery;
use frontend\modules\six\models\LotteryResultLhc;
use frontend\modules\six\models\UserList;
use frontend\modules\six\models\SysAnnouncement;
use frontend\modules\six\models\CommonFc\CommonFc;

/**
 * 六合彩头部
 * SixtopController
 */
class SixtopController extends Controller {

    private $_assetUrl = '';
    private $_req = null;
    private $_session = null;
    private $_params = null;

    public function init() {
        parent::init();

        $this->enableCsrfValidation = false;                                    // 关闭csrf验证

        $this->_assetUrl = Yii::$app->getModule('six')->assetsUrl[1];
        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->getView()->title = '六合彩';
        $this->layout = 'main';
    }
    /**
     * 下注状况
     */
    public function actionXiaZhu() {
        $this->layout=false;
        $userid = $this->_session[$this->_params['S_USER_ID']];             //正常登陆
        if(!$userid){
        	echo("<script> alert('还未登录，请登录');</script>");
        	return;
        }
        $date = date("Y-m-d");
        $lhc_today_result = SixLotteryOrder::getOneDayOrder($userid, $date);
        $total_today_count = $lhc_today_result["bet_count"] ;
        $total_today_money = $lhc_today_result["bet_money"] ;
        return $this->render('XiaZhu',array('lhc_today_result'=>$lhc_today_result,'total_today_count'=>$total_today_count,'total_today_money'=>$total_today_money));

    }
    
    /**
     * 六合彩下注详情
     */
//    public function actionHistorydate(){
//        $this->layout=false;
//        $getNews = Yii::$app->request->get();
//        $userid = $this->_session[$this->_params['S_USER_ID']];             //正常登陆
//        if(!$userid){
//        	echo("<script> alert('还未登录，请登录');</script>");
//
//        }
//        $t_allmoney = 0;
//        $t_sy = 0;
//        $uid = '';
//        $rows = array();
//        $type = 'LT';
//        if(isset($getNews['gtype'])){
//            $type = $getNews['gtype'];
//        }
//        if (isset($getNews['username'])) {
//            $username = $getNews['username'];
//            $rows = UserList::getUserNewsByUserName($username);
//            if ($rows) {
//                $uid = $rows['user_id'];
//            } else {
//                $uid = "0";
//            }
//        }
//
//        $day = $getNews["gamedate"];
//
//        $where = '';
//        $where .=" and o.user_id='" . $userid . "'";
//        if (isset($getNews['tf_id'])){
//            $where.=" and o_sub.order_sub_num=" . $getNews['tf_id'] . "";
//        }
//        $where .=" order by o_sub.id desc ";
//        if($type=='LT'){
//            $arr = SixLotteryOrder::getId($day, $where);
//        }else{
//            $arr = OrderLottery::getId($day, $where,$type);
//        }
//        $bid = '';
//        foreach ($arr as $key => $value) {
//            $bid .=$value['id']. ',';
//        }
//        $bid = rtrim($bid, ',');
//        if($bid){
//            if($type=='LT'){
//                $rows = SixLotteryOrder::getAllNews($bid);
//            }else{
//                $rows = OrderLottery::getAllNews($bid);
//            }
//        }
//       if($rows){
//           foreach ($rows as $key => $value) {
//               $t_allmoney += $value['bet_money_one'];
//               $bet_rate = $value['bet_rate_one'];
//               if (strpos($bet_rate, ",") !== false) {
//                   $bet_rate_array = explode(",", $bet_rate);
//                   $bet_rate = $bet_rate_array[0];
//               }
//               $rows[$key]['bet_rate'] = $bet_rate;
//               $money_result = 0;
//               if ($value['is_win'] == "1") {
//                   $money_result = $value['win_sub'] + $value['fs'];
//               } elseif ($value['is_win'] == "2") {
//                   $money_result = $value['fs'];
//               } elseif ($value['is_win'] == "0" || empty($value['is_win'])) {
//                   if(empty($value['status']) || $value['status']==3){
//                       $money_result =0;
//                   }else{
//                       $money_result = 0-($value['bet_money_one']-$value['fs']);
//                   }
//                  // $money_result = $value['fs'];
//               }
//               $t_sy += $money_result;
//               $rows[$key]['money_result'] = $money_result;
//               if($type!='LT'){
//                   $rows[$key]['rtype_str'] = $value['quick_type'].'-'.$value['rtype_str'];
//               }
//           }
//       }
//
//       return $this->render('HistoryDate',array('rows'=>$rows,'t_allmoney'=>$t_allmoney,'t_sy'=>$t_sy,'day'=>$day));
//
//
//    }
//
    /**
     * 下注历史
     */
    public function actionHistory() {
        $this->layout=false;
        $userid = $this->_session[$this->_params['S_USER_ID']];             //正常登陆
        if(!$userid){
        	echo("<script> alert('还未登录，请登录');</script>");
        	return;
        }
        
        $lhc_today_result = SixLotteryOrder::getOneDayOrder($userid, date("Y-m-d"));
        $lhc_day1_result = SixLotteryOrder::getOneDayOrder($userid, date('Y-m-d', strtotime('-1 day')));
        $lhc_day2_result = SixLotteryOrder::getOneDayOrder($userid, date('Y-m-d', strtotime('-2 day')));
        $lhc_day3_result = SixLotteryOrder::getOneDayOrder($userid, date('Y-m-d', strtotime('-3 day')));
        $lhc_day4_result = SixLotteryOrder::getOneDayOrder($userid, date('Y-m-d', strtotime('-4 day')));
        $lhc_day5_result = SixLotteryOrder::getOneDayOrder($userid, date('Y-m-d', strtotime('-5 day')));
        $lhc_day6_result = SixLotteryOrder::getOneDayOrder($userid, date('Y-m-d', strtotime('-6 day')));

        $lhc_today_win = SixLotteryOrder::getOneDayTotalWin($userid, date("Y-m-d"));
        $lhc_day1_win = SixLotteryOrder::getOneDayTotalWin($userid, date('Y-m-d', strtotime('-1 day')));
        $lhc_day2_win = SixLotteryOrder::getOneDayTotalWin($userid, date('Y-m-d', strtotime('-2 day')));
        $lhc_day3_win = SixLotteryOrder::getOneDayTotalWin($userid, date('Y-m-d', strtotime('-3 day')));
        $lhc_day4_win = SixLotteryOrder::getOneDayTotalWin($userid, date('Y-m-d', strtotime('-4 day')));
        $lhc_day5_win = SixLotteryOrder::getOneDayTotalWin($userid, date('Y-m-d', strtotime('-5 day')));
        $lhc_day6_win = SixLotteryOrder::getOneDayTotalWin($userid, date('Y-m-d', strtotime('-6 day')));

        
        $bet_money_total = $lhc_today_result["bet_money"] +  $lhc_day1_result["bet_money"]
                + $lhc_day2_result["bet_money"] + $lhc_day3_result["bet_money"]
                + $lhc_day4_result["bet_money"] +  $lhc_day5_result["bet_money"]
                + $lhc_day6_result["bet_money"] ;

        $bet_win_total = $lhc_today_win  + $lhc_day1_win + $lhc_day2_win +  $lhc_day3_win
                            + $lhc_day4_win  + $lhc_day5_win  + $lhc_day6_win ;
        return $this->render('History',
                                array( 'lhc_today_result'=>$lhc_today_result,
                                        'lhc_day1_result'=>$lhc_day1_result,
                                        'lhc_day2_result'=>$lhc_day2_result,
                                        'lhc_day3_result'=>$lhc_day3_result,
                                        'lhc_day4_result'=>$lhc_day4_result,
                                        'lhc_day5_result'=>$lhc_day5_result,
                                        'lhc_day6_result'=>$lhc_day6_result,

                                        'lhc_today_win'=>$lhc_today_win,
                                        'lhc_day1_win'=>$lhc_day1_win,
                                        'lhc_day2_win'=>$lhc_day2_win,
                                        'lhc_day3_win'=>$lhc_day3_win,
                                        'lhc_day4_win'=>$lhc_day4_win,
                                        'lhc_day5_win'=>$lhc_day5_win,
                                        'lhc_day6_win'=>$lhc_day6_win,

                                        'bet_money_total'=>$bet_money_total,
                                        'bet_win_total'=>$bet_win_total

                        ));


    }
    
    /**
     * 下注历史中的指定时间段的数据
     */
    public function actionDatecount(){
        $this->layout=false;
        $userid = $this->_session[$this->_params['S_USER_ID']];             //正常登陆
        if(!$userid){
        	echo("<script> alert('还未登录，请登录');</script>");
        }
        $getNews = Yii::$app->request->get();
        if(isset($getNews['gamedate'])){
            $date_select = $getNews['gamedate'];
        }
        $lhc_result = SixLotteryOrder::getOneDayOrder($userid,$date_select);
        $lhc_win = SixLotteryOrder::getOneDayTotalWin($userid,$date_select);

        
        $total_bet_money = $lhc_result["bet_money"];
        $total_win_money = $lhc_win ;
        return $this->render('Datecount',array('date_select'=>$date_select,'lhc_result'=>$lhc_result,'lhc_win'=>$lhc_win,'total_bet_money'=>$total_bet_money,'total_win_money'=>$total_win_money));
    }
    
    /**
     * 开奖结果
     */
    public function actionKaijiang() {
        $this->layout=false;
        $CommonFc = new CommonFc();
        $query_time = date('Y-m-d', time());
        $getNews = Yii::$app->request->get();
        $qishu_query = null;
        $getNews['gtype'] = 'LT';
        if (isset($getNews['s_time'])) {
            $query_time = $getNews['s_time'];
        }
        if (isset($getNews['qishu_query'])) {
            $qishu_query = $getNews['qishu_query'];
        }

        $time = (new Zodiac())->getNewYearTime();
        $arr = LotteryResultLhc::getSixResult($qishu_query,'',$time);
        $hasRow = 'false';
        foreach ($arr as $key => $rows) {
            $arr[$key]['Animal'] = $CommonFc->numToAnimal($rows['ball_1'], time($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_2'], time($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_3'],
                    time($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_4'], time($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_5'],
                    time($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_6'], time($rows['datetime'])) . '+' . $CommonFc->numToAnimal($rows['ball_7'], time($rows['datetime']));
        }

         return $this->render('kaijiang',array('qishu_query'=>$qishu_query,'query_time'=>$query_time,'arr'=>$arr,'hasRow'=>$hasRow));


    }
    
    /**
     * 公告
     */
    public function actionNews(){
        $this->layout=false;
        $newestAnnouncement = SysAnnouncement::getNewestAnnouncement();
        $announcementArray = SysAnnouncement::getAnnouncementList();
        return $this->render('News',array('announcementArray'=>$announcementArray,'newestAnnouncement'=>$newestAnnouncement));
    }
    
    /**
     * 快选金额
     */
    public function actionQuick(){
        $this->layout=false;
        return $this->render('Quick');
    }
    /**
     * 快选金额修改存储
     */
    public function actionGold_act(){
        echo "SaveIsOk";
    }
    
    /**
     * 开奖处理器
     * @param type $ball        开奖号码
     * @param type $dateTime    开奖时间
     * @return string           返回开奖动物
     */
   private function _lhc_sum_sx($ball, $dateTime) {
	$animal = '';
        $arr = CommonFc::year_change3();
        $date = $arr['year'];
	if (strtotime($dateTime) < strtotime($date)) {
            if (in_array($this->_BuLing($ball), $arr['A1'])) { $animal = '猪'; }
            else if (in_array($this->_BuLing($ball), $arr['A2'])) { $animal = '鼠';}
            else if (in_array($this->_BuLing($ball), $arr['A3'])) { $animal = '牛';}
            else if (in_array($this->_BuLing($ball), $arr['A4'])) { $animal = '虎';}
            else if (in_array($this->_BuLing($ball), $arr['A5'])) { $animal = '兔';}
            else if (in_array($this->_BuLing($ball), $arr['A6'])) { $animal = '龙';}
            else if (in_array($this->_BuLing($ball), $arr['A7'])) { $animal = '蛇';}
            else if (in_array($this->_BuLing($ball), $arr['A8'])) { $animal = '马';}
            else if (in_array($this->_BuLing($ball), $arr['A9'])) { $animal = '羊';}
            else if (in_array($this->_BuLing($ball), $arr['AA'])) { $animal = '猴';}
            else if (in_array($this->_BuLing($ball), $arr['AB'])) { $animal = '鸡';}
            else if (in_array($this->_BuLing($ball), $arr['AC'])) { $animal = '狗';}
	}
	else if (in_array($this->_BuLing($ball), $arr['A2'])) { $animal = '牛';}
	else if (in_array($this->_BuLing($ball), $arr['A3'])) { $animal = '虎';}
	else if (in_array($this->_BuLing($ball), $arr['A4'])) { $animal = '兔';}
	else if (in_array($this->_BuLing($ball), $arr['A5'])) { $animal = '龙';}
	else if (in_array($this->_BuLing($ball), $arr['A6'])) { $animal = '蛇';}
	else if (in_array($this->_BuLing($ball), $arr['A7'])) { $animal = '马';}
	else if (in_array($this->_BuLing($ball), $arr['A8'])) { $animal = '羊';}
	else if (in_array($this->_BuLing($ball), $arr['A9'])) { $animal = '猴';}
	else if (in_array($this->_BuLing($ball), $arr['AA'])) { $animal = '鸡';}
	else if (in_array($this->_BuLing($ball), $arr['AB'])) { $animal = '狗';}
	else if (in_array($this->_BuLing($ball), $arr['AC'])) { $animal = '猪';}
	else if (in_array($this->_BuLing($ball), $arr['A1'])) { $animal = '鼠';}
	return $animal;
    }
    /**
     * 开奖处理器2（小于10的开奖号码前面加0，形成新的字符串）
     * @param string $num   开奖号码
     * @return string
     */
    public function _BuLing($num) {
        if ($num < 10) { $num = '0' . $num; }
        return $num;
    }
}
