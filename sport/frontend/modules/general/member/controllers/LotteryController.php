<?php

namespace app\modules\general\member\controllers;

use Yii;
use yii\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\member\models\TransactionLog\OrderLottery;
use app\modules\general\member\models\TransactionLog\SixLotteryOrder;
use app\modules\general\member\models\TransactionLog\SpsixLotteryOrder;
/**
 * 交易记录-彩票投注记录
 * LotteryController
 */
class LotteryController extends BaseController {
    private $_req = null;
    private $_session = null;
    private $_params = null;
    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;

        $this->getView()->title = '交易记录';
        $this->layout = 'main';
    }

    /**
     * 彩票投注记录
     * @return string
     */
    public function actionLottery() {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
			return '<script>alert("请先登录再进行操作"); window.location="/";</script>';
        }
        $user_group = $this->_session[$this->_params['S_USER_ID']];
        $getNews = Yii::$app->request->get();
        $arr1['time2'] = date("Y-m-d");
        $date_POST = date("Y-m-d");
        if (!empty($getNews['time'])) {
            $date_POST = $getNews['time'];
        }
        $arr1['time'] = $date_POST;
        $lhc_result = SixLotteryOrder::getOneDayOrder($user_group, $date_POST);
        $splhc_result = SpsixLotteryOrder::getOneDayOrder($user_group, $date_POST);
        $d3_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "D3");
        $p3_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "P3");
        $t3_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "T3");
        $cq_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "CQ");
        $tj_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "TJ");
        $jx_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "JX");
        $gxsf_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "GXSF");
        $gdsf_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "GDSF");
        $tjsf_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "TJSF");
        $gd11_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "GD11");
        $bjpk_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "BJPK");
        $bjkn_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "BJKN");
        $cqsf_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "CQSF");
        $mlaft_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "MLAFT");
        $ssrc_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "SSRC");
        $ts_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "TS");
        $orpk_result = OrderLottery::getOneDayTotalCountByType($user_group, $date_POST, "ORPK");

        $lhc_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, $date_POST, "0");
        $splhc_result_status0 = SpsixLotteryOrder::getOneDayOrderStatue0($user_group, $date_POST, "0");
        $d3_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "D3", "0");
        $p3_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "P3", "0");
        $t3_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "T3", "0");
        $cq_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "CQ", "0");
        $tj_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "TJ", "0");
        $jx_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "JX", "0");
        $gxsf_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "GXSF", "0");
        $gdsf_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "GDSF", "0");
        $tjsf_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "TJSF", "0");
        $gd11_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "GD11", "0");
        $bjpk_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "BJPK", "0");
        $bjkn_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "BJKN", "0");
        $cqsf_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "CQSF", "0");
        $mlaft_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "MLAFT", "0");
        $ssrc_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "SSRC", "0");
        $ts_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "TS", "0");
        $orpk_result_status0 = OrderLottery::getOneDayTotalCountByTypeStatus0($user_group, $date_POST, "ORPK", "0");

        $lhc_win = SixLotteryOrder::getOneDayTotalWin($user_group, $date_POST);
        $splhc_win = SpsixLotteryOrder::getOneDayTotalWin($user_group, $date_POST);
        $d3_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "D3");
        $p3_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "P3");
        $t3_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "T3");
        $cq_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "CQ");
        $tj_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "TJ");
        $jx_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "JX");
        $gxsf_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "GXSF");
        $gdsf_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "GDSF");
        $tjsf_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "TJSF");
        $gd11_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "GD11");
        $bjpk_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "BJPK");
        $bjkn_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "BJKN");
        $cqsf_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "CQSF");
        $mlaft_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "MLAFT");
        $ssrc_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "SSRC");
        $ts_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "TS");
        $orpk_win = OrderLottery::getOneDayTotalWinByType($user_group, $date_POST, "ORPK");
        
        $arr1['lhc'] = $lhc_result[0]['bet_money'];
        $arr1['splhc'] = $splhc_result[0]['bet_money'];
        $arr1['d3'] = $d3_result[0]['bet_money'];
        $arr1['p3'] = $p3_result[0]['bet_money'];
        $arr1['t3'] = $t3_result[0]['bet_money'];
        $arr1['cq'] = $cq_result[0]['bet_money'];
        $arr1['jx'] = $jx_result[0]['bet_money'];
        $arr1['tj'] = $tj_result[0]['bet_money'];
        $arr1['gxsf'] = $gxsf_result[0]['bet_money'];
        $arr1['gdsf'] = $gdsf_result[0]['bet_money'];
        $arr1['tjsf'] = $tjsf_result[0]['bet_money'];
        $arr1['gd11'] = $gd11_result[0]['bet_money'];
        $arr1['bjpk'] = $bjpk_result[0]['bet_money'];
        $arr1['bjkn'] = $bjkn_result[0]['bet_money'];
        $arr1['cqsf'] = $cqsf_result[0]['bet_money'];
        $arr1['mlaft'] = $mlaft_result[0]['bet_money'];
        $arr1['ssrc'] = $ssrc_result[0]['bet_money'];
        $arr1['ts'] = $ts_result[0]['bet_money'];
        $arr1['orpk'] = $orpk_result[0]['bet_money'];
        $arr1['sum'] = $arr1['lhc'] + $arr1['d3'] + $arr1['p3'] + $arr1['t3'] + $arr1['cq'] + $arr1['jx'] + $arr1['tj'] + $arr1['gxsf'] + $arr1['gdsf'] + $arr1['tjsf'] + $arr1['gd11'] + $arr1['bjpk'] + $arr1['bjkn'] + $arr1['cqsf'] + $arr1['mlaft'] + $arr1['ssrc']+ $arr1['ts']+ $arr1['orpk'];

        $arr2['lhc'] = $lhc_result_status0[0]['bet_money'];
        $arr2['splhc'] = $splhc_result_status0[0]['bet_money'];
        $arr2['d3'] = $d3_result_status0[0]['bet_money'];
        $arr2['p3'] = $p3_result_status0[0]['bet_money'];
        $arr2['t3'] = $t3_result_status0[0]['bet_money'];
        $arr2['cq'] = $cq_result_status0[0]['bet_money'];
        $arr2['jx'] = $jx_result_status0[0]['bet_money'];
        $arr2['tj'] = $tj_result_status0[0]['bet_money'];
        $arr2['gxsf'] = $gxsf_result_status0[0]['bet_money'];
        $arr2['gdsf'] = $gdsf_result_status0[0]['bet_money'];
        $arr2['tjsf'] = $tjsf_result_status0[0]['bet_money'];
        $arr2['gd11'] = $gd11_result_status0[0]['bet_money'];
        $arr2['bjpk'] = $bjpk_result_status0[0]['bet_money'];
        $arr2['bjkn'] = $bjkn_result_status0[0]['bet_money'];
        $arr2['cqsf'] = $cqsf_result_status0[0]['bet_money'];
        $arr2['mlaft'] = $mlaft_result_status0[0]['bet_money'];
        $arr2['ssrc'] = $ssrc_result_status0[0]['bet_money'];
        $arr2['ts'] = $ts_result_status0[0]['bet_money'];
        $arr2['orpk'] = $orpk_result_status0[0]['bet_money'];
        $arr2['sum'] = $arr2['lhc'] + $arr2['d3'] + $arr2['p3'] + $arr2['t3'] + $arr2['cq'] + $arr2['jx'] + $arr2['tj'] + $arr2['gxsf'] + $arr2['gdsf'] + $arr2['tjsf'] + $arr2['gd11'] + $arr2['bjpk'] + $arr2['bjkn'] + $arr2['cqsf'] + $arr2['mlaft'] + $arr2['ssrc'] + $arr2['ts']+ $arr2['orpk'];

        $arr3['lhc'] = $lhc_win;
        $arr3['splhc'] = $splhc_win;
        $arr3['d3'] = $d3_win;
        $arr3['p3'] = $p3_win;
        $arr3['t3'] = $t3_win;
        $arr3['cq'] = $cq_win;
        $arr3['tj'] = $tj_win;
        $arr3['jx'] = $jx_win;
        $arr3['gxsf'] = $gxsf_win;
        $arr3['gdsf'] = $gdsf_win;
        $arr3['tjsf'] = $tjsf_win;
        $arr3['gd11'] = $gd11_win;
        $arr3['bjpk'] = $bjpk_win;
        $arr3['bjkn'] = $bjkn_win;
        $arr3['cqsf'] = $cqsf_win;
        $arr3['mlaft'] = $mlaft_win;
        $arr3['ssrc'] = $ssrc_win;
        $arr3['ts'] = $ts_win;
        $arr3['orpk'] = $orpk_win;
        $arr3['sum'] = $arr3['lhc'] + $arr3['splhc'] + $arr3['d3'] + $arr3['p3'] + $arr3['t3'] + $arr3['cq'] + $arr3['jx'] + $arr3['tj'] + $arr3['gxsf'] + $arr3['gdsf'] + $arr3['tjsf'] + $arr3['gd11'] + $arr3['bjpk'] + $arr3['bjkn'] + $arr3['cqsf'] + $arr3['mlaft'] + $arr3['ssrc'] + $arr3['ts']+$arr3['orpk'];

        return $this->render('lottery', ['arr1' => $arr1, 'arr2' => $arr2, 'arr3' => $arr3]);
    }
    /**
     * 返回指定类型的彩票数据信息(六合彩以外的)
     */
    public function actionLotteryOne() {
        $user_group = $this->_session[$this->_params['S_USER_ID']];
        $getNews = Yii::$app->request->get();
        $time = $getNews['time'];
        $type = $getNews['type'];
        $arr1['time'] = $time;
        $start_time = $time . " 00:00:00";
        $end_time = $time . " 23:59:59";
        $arr1['result'] = 1;
        $arr2 = array();
        $sql = OrderLottery::getLotteryOne($start_time, $end_time, $user_group, $type);
        $db = Yii::$app->db;
        $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
        $query = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
        $t_allmoney = 0;
        $t_sy = 0;
        if ($query && count($query) > 0) {
            $arr1['result'] = 0;
            foreach ($query as $key => $rows) {
                $t_allmoney+=$rows['bet_money_one'];
                $rows['money_result'] = 0;
                if ($rows['is_win'] == "1") {
                    $t_sy = $t_sy + $rows['win_sub'] + $rows['fs'];
                    $rows['money_result'] = $rows['win_sub'] + $rows['fs'];
                } elseif ($rows['is_win'] == "2") {
                    $t_sy+=$rows['bet_money_one'];
                    $rows['money_result'] = $rows['bet_money_one'];
                } elseif ($rows['is_win'] == "0" && $rows['fs'] > 0) {
                    $t_sy+=$rows['fs'];
                    $rows['money_result'] = $rows['fs'];
                }
                $rows['contentName'] = $this->_getName($rows['number'], $rows['Gtype'], $rows['rtype_str'], $rows['quick_type']);
                $rows['bet_time'] = substr($rows["bet_time"], 11);

                $bet_rate = $rows['bet_rate_one'];
                $rows['bet_rate'] = $rows['bet_rate_one'];
                if (strpos($bet_rate, ",") !== false) {
                    $bet_rate_array = explode(",", $bet_rate);
                    $rows['bet_rate'] = $bet_rate_array[0];
                }

                if ($rows['status'] == 0) {
                    $status_result = "未结算";
                } elseif ($rows['status'] == 1) {
                    $status_result = "已结算";
                } elseif ($rows['status'] == 2) {
                    $status_result = "已结算";
                } elseif ($rows['status'] == 3) {
                    $status_result = "作废";
                } else {
                    $status_result = "未结算";
                }
                $rows['status_result'] = $status_result;
                $query[$key] = $rows;
            }
            $arr2 = $query;
        }
        $type = $this->_getZhPageTitle($type);
        $arr1['type'] = $type;
        return $this->render('lotteryOne', ['arr1' => $arr1, 'arr2' => $arr2,'pages'=>$pages]);
    }
    
    /**
     * 返回六合彩的数据信息
     */
    public function actionLotteryLhc(){
        $user_group = $this->_session[$this->_params['S_USER_ID']];
        $getNews = Yii::$app->request->get();
        $time = $getNews['time'];
        $arr1['time'] = $time;
        $start_time = $time . " 00:00:00";
        $end_time = $time . " 23:59:59";
        $arr1['result'] = 1;
        $arr1['time'] = $time;
        $arr1['type'] = '六合彩';
        $sql= SixLotteryOrder::getOneDayNews($start_time, $end_time, $user_group);
        $db = Yii::$app->db;
        $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
        $query = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
        $t_allmoney=0;
        $t_sy=0;
        $arr2 = array();
        if($query && count($query)>0){
            $arr1['result'] = 0;
            foreach ($query as $key =>$rows) {
                $t_allmoney+=$rows['bet_money_one'];
                $money_result = 0;
                if($rows['is_win']=="1"){
                    $t_sy= $t_sy + $rows['win_sub'] + $rows['fs'];
                    $money_result = $rows['win_sub'] + $rows['fs'];
                }elseif($rows['is_win']=="2"){
                    $t_sy+=$rows['bet_money_one'];
                    $money_result = $rows['bet_money_one'];
                }elseif($rows['is_win']=="0" && $rows['fs']>0){
                    $t_sy+=$rows['fs'];
                    $money_result = $rows['fs'];
                }
                $bet_time = substr($rows["bet_time"],11);
                $bet_rate = $rows['bet_rate_one'];
                if(strpos($bet_rate,",") !== false){
                    $bet_rate_array = explode(",", $bet_rate);
                    $bet_rate = 1;
                    foreach ($bet_rate_array as $k=>$v){
                        $bet_rate = $v*$bet_rate;
                    }
                    $bet_rate = sprintf("%.2f", $bet_rate);
                }
                if($rows['status']==0){
                    $status_result = "未结算";
                }elseif($rows['status']==1){
                    $status_result = "已结算";
                }elseif($rows['status']==2){
                    $status_result = "已结算";
                }elseif($rows['status']==3){
                    $status_result = "作废";
                }else{
                    $status_result = "未结算";
                }
                $rows['money_result'] = $money_result;
                $rows['bet_time'] = $bet_time;
                $rows['bet_rate'] = $bet_rate;
                $rows['status_result'] = $status_result;
                $query[$key] = $rows;
            }
            $arr2 = $query;
        }
        return $this->render('lotteryLhc', ['arr1' => $arr1, 'arr2' => $arr2,'pages'=>$pages]);
    }
    /**
     * 返回极速六合彩的数据信息
     */
     public function actionLotteryspLhc(){
        $user_group = $this->_session[$this->_params['S_USER_ID']];
        $getNews = Yii::$app->request->get();
        $time = $getNews['time'];
        $arr1['time'] = $time;
        $start_time = $time . " 00:00:00";
        $end_time = $time . " 23:59:59";
        $arr1['result'] = 1;
        $arr1['time'] = $time;
        $arr1['type'] = '极速六合彩';
        $sql= SpsixLotteryOrder::getOneDayNews($start_time, $end_time, $user_group);
        $db = Yii::$app->db;
        $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
        $query = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
        $t_allmoney=0;
        $t_sy=0;
        $arr2 = array();
        if($query && count($query)>0){
            $arr1['result'] = 0;
            foreach ($query as $key =>$rows) {
                $t_allmoney+=$rows['bet_money_one'];
                $money_result = 0;
                if($rows['is_win']=="1"){
                    $t_sy= $t_sy + $rows['win_sub'] + $rows['fs'];
                    $money_result = $rows['win_sub'] + $rows['fs'];
                }elseif($rows['is_win']=="2"){
                    $t_sy+=$rows['bet_money_one'];
                    $money_result = $rows['bet_money_one'];
                }elseif($rows['is_win']=="0" && $rows['fs']>0){
                    $t_sy+=$rows['fs'];
                    $money_result = $rows['fs'];
                }
                $bet_time = substr($rows["bet_time"],11);
                $bet_rate = $rows['bet_rate_one'];
                if(strpos($bet_rate,",") !== false){
                    $bet_rate_array = explode(",", $bet_rate);
                    $bet_rate = 1;
                    foreach ($bet_rate_array as $k=>$v){
                        $bet_rate = $v*$bet_rate;
                    }
                    $bet_rate = sprintf("%.2f", $bet_rate);
                }
                if($rows['status']==0){
                    $status_result = "未结算";
                }elseif($rows['status']==1){
                    $status_result = "已结算";
                }elseif($rows['status']==2){
                    $status_result = "已结算";
                }elseif($rows['status']==3){
                    $status_result = "作废";
                }else{
                    $status_result = "未结算";
                }
                $rows['money_result'] = $money_result;
                $rows['bet_time'] = $bet_time;
                $rows['bet_rate'] = $bet_rate;
                $rows['status_result'] = $status_result;
                $query[$key] = $rows;
            }
            $arr2 = $query;
        }
        return $this->render('lotteryLhc', ['arr1' => $arr1, 'arr2' => $arr2,'pages'=>$pages]);
    }
    /**
     * 返回彩票历史记录（前6天）
     * @return type
     */
    public function actionLotteryDate() {
        $arr['time1'] = date('Y-m-d');
        $arr['time2'] = date('Y-m-d', strtotime('-1 day'));
        $arr['time3'] = date('Y-m-d', strtotime('-2 day'));
        $arr['time4'] = date('Y-m-d', strtotime('-3 day'));
        $arr['time5'] = date('Y-m-d', strtotime('-4 day'));
        $arr['time6'] = date('Y-m-d', strtotime('-5 day'));
        $arr['time7'] = date('Y-m-d', strtotime('-6 day'));
        $user_group = $this->_session[$this->_params['S_USER_ID']];

        $lhc_today_result = SixLotteryOrder::getOneDayOrder($user_group, date("Y-m-d"));
        $lhc_day2_result = SixLotteryOrder::getOneDayOrder($user_group, date('Y-m-d', strtotime('-1 day')));
        $lhc_day3_result = SixLotteryOrder::getOneDayOrder($user_group, date('Y-m-d', strtotime('-2 day')));
        $lhc_day4_result = SixLotteryOrder::getOneDayOrder($user_group, date('Y-m-d', strtotime('-3 day')));
        $lhc_day5_result = SixLotteryOrder::getOneDayOrder($user_group, date('Y-m-d', strtotime('-4 day')));
        $lhc_day6_result = SixLotteryOrder::getOneDayOrder($user_group, date('Y-m-d', strtotime('-5 day')));
        $lhc_day7_result = SixLotteryOrder::getOneDayOrder($user_group, date('Y-m-d', strtotime('-6 day')));

        $lhc_today_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date("Y-m-d"), "0");
        $lhc_day2_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date('Y-m-d', strtotime('-1 day')), "0");
        $lhc_day3_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date('Y-m-d', strtotime('-2 day')), "0");
        $lhc_day4_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date('Y-m-d', strtotime('-3 day')), "0");
        $lhc_day5_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date('Y-m-d', strtotime('-4 day')), "0");
        $lhc_day6_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date('Y-m-d', strtotime('-5 day')), "0");
        $lhc_day7_result_status0 = SixLotteryOrder::getOneDayOrderStatue0($user_group, date('Y-m-d', strtotime('-6 day')), "0");

        $lhc_today_win = SixLotteryOrder::getOneDayTotalWin($user_group, date("Y-m-d"));
        $lhc_day2_win = SixLotteryOrder::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-1 day')));
        $lhc_day3_win = SixLotteryOrder::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-2 day')));
        $lhc_day4_win = SixLotteryOrder::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-3 day')));
        $lhc_day5_win = SixLotteryOrder::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-4 day')));
        $lhc_day6_win = SixLotteryOrder::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-5 day')));
        $lhc_day7_win = SixLotteryOrder::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-6 day')));

        $today_result = OrderLottery::getOneDayTotalCount($user_group, date("Y-m-d"));
        $day2_result = OrderLottery::getOneDayTotalCount($user_group, date('Y-m-d', strtotime('-1 day')));
        $day3_result = OrderLottery::getOneDayTotalCount($user_group, date('Y-m-d', strtotime('-2 day')));
        $day4_result = OrderLottery::getOneDayTotalCount($user_group, date('Y-m-d', strtotime('-3 day')));
        $day5_result = OrderLottery::getOneDayTotalCount($user_group, date('Y-m-d', strtotime('-4 day')));
        $day6_result = OrderLottery::getOneDayTotalCount($user_group, date('Y-m-d', strtotime('-5 day')));
        $day7_result = OrderLottery::getOneDayTotalCount($user_group, date('Y-m-d', strtotime('-6 day')));

        $today_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date("Y-m-d"), "0");
        $day2_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date('Y-m-d', strtotime('-1 day')), "0");
        $day3_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date('Y-m-d', strtotime('-2 day')), "0");
        $day4_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date('Y-m-d', strtotime('-3 day')), "0");
        $day5_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date('Y-m-d', strtotime('-4 day')), "0");
        $day6_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date('Y-m-d', strtotime('-5 day')), "0");
        $day7_result_status0 = OrderLottery::getOneDayTotalCountStatus0($user_group, date('Y-m-d', strtotime('-6 day')), "0");

        $today_win = OrderLottery::getOneDayTotalWin($user_group, date("Y-m-d"));
        $day2_win = OrderLottery::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-1 day')));
        $day3_win = OrderLottery::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-2 day')));
        $day4_win = OrderLottery::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-3 day')));
        $day5_win = OrderLottery::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-4 day')));
        $day6_win = OrderLottery::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-5 day')));
        $day7_win = OrderLottery::getOneDayTotalWin($user_group, date('Y-m-d', strtotime('-6 day')));

        //$arr2 一天的下注金额
        $arr2['time1'] = $lhc_today_result[0]['bet_money'] + $today_result[0]['bet_money'];
        $arr2['time2'] = $lhc_day2_result[0]['bet_money'] + $day2_result[0]['bet_money'];
        $arr2['time3'] = $lhc_day3_result[0]['bet_money'] + $day3_result[0]['bet_money'];
        $arr2['time4'] = $lhc_day4_result[0]['bet_money'] + $day4_result[0]['bet_money'];
        $arr2['time5'] = $lhc_day5_result[0]['bet_money'] + $day5_result[0]['bet_money'];
        $arr2['time6'] = $lhc_day6_result[0]['bet_money'] + $day6_result[0]['bet_money'];
        $arr2['time7'] = $lhc_day7_result[0]['bet_money'] + $day7_result[0]['bet_money'];
        $arr2['time_sum'] = $arr2['time1'] + $arr2['time2'] + $arr2['time3'] + $arr2['time4'] + $arr2['time5'] + $arr2['time6'] + $arr2['time7'];

        //$arr3 一天的未结算金额 
        $arr3['time1'] = $lhc_today_result_status0[0]['bet_money'] + $today_result_status0[0]['bet_money'];
        $arr3['time2'] = $lhc_day2_result_status0[0]['bet_money'] + $day2_result_status0[0]['bet_money'];
        $arr3['time3'] = $lhc_day3_result_status0[0]['bet_money'] + $day3_result_status0[0]['bet_money'];
        $arr3['time4'] = $lhc_day4_result_status0[0]['bet_money'] + $day4_result_status0[0]['bet_money'];
        $arr3['time5'] = $lhc_day5_result_status0[0]['bet_money'] + $day5_result_status0[0]['bet_money'];
        $arr3['time6'] = $lhc_day6_result_status0[0]['bet_money'] + $day6_result_status0[0]['bet_money'];
        $arr3['time7'] = $lhc_day7_result_status0[0]['bet_money'] + $day7_result_status0[0]['bet_money'];
        $arr3['time_sum'] = $arr3['time1'] + $arr3['time2'] + $arr3['time3'] + $arr3['time4'] + $arr3['time5'] + $arr3['time6'] + $arr3['time7'];

        //$arr4 一天的结果
        $arr4['time1'] = $today_win + $lhc_today_win;
        $arr4['time2'] = $day2_win + $lhc_day2_win;
        $arr4['time3'] = $day3_win + $lhc_day3_win;
        $arr4['time4'] = $day4_win + $lhc_day4_win;
        $arr4['time5'] = $day5_win + $lhc_day5_win;
        $arr4['time6'] = $day6_win + $lhc_day6_win;
        $arr4['time7'] = $day7_win + $lhc_day7_win;
        $arr4['time_sum'] = $arr4['time1'] + $arr4['time2'] + $arr4['time3'] + $arr4['time4'] + $arr4['time5'] + $arr4['time6'] + $arr4['time7'];

        return $this->render('lotteryDate', ['arr4' => $arr4, 'arr3' => $arr3, 'arr2' => $arr2, 'arr' => $arr]);
    }

    /**
     * type名称转换处理
     * @param type $gType
     * @return string
     */
    function _getZhPageTitle($gType) {
        if ($gType == "T3") {
            return "上海时时乐";
        } elseif ($gType == "P3") {
            return "排列三";
        } elseif ($gType == "CQ") {
            return "重庆时时彩";
        } elseif ($gType == "TJ") {
            return "极速时时彩";
        } elseif ($gType == "BJKN") {
            return "北京快乐8";
        } elseif ($gType == "GXSF") {
            return "广西十分彩";
        } elseif ($gType == "GDSF") {
            return "广东十分彩";
        } elseif ($gType == "TJSF") {
            return "天津十分彩";
        } elseif ($gType == "BJPK") {
            return "北京PK拾";
        } elseif ($gType == "GD11") {
            return "广东十一选五";
        } elseif ($gType == "CQSF") {
            return "重庆十分彩";
        } elseif ($gType == "LT") {
            return "六合彩";
        } elseif ($gType == "SSRC") {
            return "极速赛车";
        }elseif ($gType == "MLAFT") {
            return "幸运飞艇";
        }elseif ($gType == "TS") {
            return "腾讯分分彩";
        } elseif ($gType == "ORPK") {
            return "老PK拾";
        } else {
            return "3D彩";
        }
    }

    /**
     * 获取彩票游戏名 处理 (处理器=>调用的方法)
     * _getNameGd11
     * _getNameBJPK =>_getCommonName
     * _getNameBJKN
     * _getNameGXSF =>_getCommonName
     * _getNameGDSF =>_getCommonName
     * _getNameTJSF =>_getCommonName
     * _getNameB5   =>_get535NameByCode
     * _getNameB3   =>_getOeouNameByCode
     */
    function _getName($contentName, $gType, $rTypeName = "", $quickType = "") {
        $name = $contentName;
        if (strpos($rTypeName, "快速-") !== false) {
            $name = $quickType . "-" . $contentName;
            return $name;
        }
        if ($gType == "GD11") {
            $name = $this->_getNameGd11($contentName);
        } elseif ($gType == "BJPK") {
            $name = $this->_getNameBJPK($contentName);
        } elseif ($gType == "BJKN") {
            $name = $this->_getNameBJKN($contentName);
        } elseif ($gType == "GXSF") {
            $name = $this->_getNameGXSF($contentName);
        } elseif ($gType == "GDSF") {
            $name = $this->_getNameGDSF($contentName);
        } elseif ($gType == "TJSF") {
            $name = $this->_getNameTJSF($contentName);
        } elseif ($gType == "CQ" || $gType == "TJ" || $gType == "JX") {
            $name = $this->_getNameb5($contentName);
        } elseif ($gType == "D3" || $gType == "P3" || $gType == "T3") {
            $name = $this->_getNameB3($contentName);
        }
        return $name;
    }

    function _getNameGd11($contentName) {
        $number = $contentName;
        $betInfo = explode(":", $contentName);
        $name_gd11 = $contentName;

        if ($betInfo[1] == "LOCATE") {//每球定位
            $selectBall = $betInfo[2];
            if ($selectBall == "1") {
                $name_gd11 = "正码一 " . $betInfo[0];
            } elseif ($selectBall == "2") {
                $name_gd11 = "正码二 " . $betInfo[0];
            } elseif ($selectBall == "3") {
                $name_gd11 = "正码三 " . $betInfo[0];
            } elseif ($selectBall == "4") {
                $name_gd11 = "正码四 " . $betInfo[0];
            } elseif ($selectBall == "5") {
                $name_gd11 = "正码五 " . $betInfo[0];
            }
        } elseif ($betInfo[1] == "MATCH") {
            $name_gd11 = $betInfo[0];
        } elseif ($betInfo[0] == "TOTAL") {
            if ($betInfo[1] == "OVER") {
                $name_gd11 = "总和大";
            } elseif ($betInfo[1] == "UNDER") {
                $name_gd11 = "总和小";
            } elseif ($betInfo[1] == "ODD") {
                $name_gd11 = "总和单";
            } elseif ($betInfo[1] == "EVEN") {
                $name_gd11 = "总和双";
            } elseif ($betInfo[1] == "DRAGON") {
                $name_gd11 = "龙";
            } elseif ($betInfo[1] == "TIGER") {
                $name_gd11 = "虎";
            } elseif ($betInfo[1] == "TIE") {
                $name_gd11 = "和";
            }
        } elseif ($betInfo[0] == "BEFORE" || $betInfo[0] == "MIDDLE" || $betInfo[0] == "AFTER") {
            if ($number == "BEFORE:SHUNZI") {
                $name_gd11 = "前三 顺子";
            } elseif ($number == "BEFORE:BANSHUN") {
                $name_gd11 = "前三 半顺";
            } elseif ($number == "BEFORE:ZALIU") {
                $name_gd11 = "前三 杂六";
            } elseif ($number == "MIDDLE:SHUNZI") {
                $name_gd11 = "中三 顺子";
            } elseif ($number == "MIDDLE:BANSHUN") {
                $name_gd11 = "中三 半顺";
            } elseif ($number == "MIDDLE:ZALIU") {
                $name_gd11 = "中三 杂六";
            } elseif ($number == "AFTER:SHUNZI") {
                $name_gd11 = "后三 顺子";
            } elseif ($number == "AFTER:BANSHUN") {
                $name_gd11 = "后三 半顺";
            } elseif ($number == "AFTER:ZALIU") {
                $name_gd11 = "后三 杂六";
            }
        } else {
            if ($betInfo[0] == "1") {
                $name_gd11_pre = "正码一 ";
            } elseif ($betInfo[0] == "2") {
                $name_gd11_pre = "正码二 ";
            } elseif ($betInfo[0] == "3") {
                $name_gd11_pre = "正码三 ";
            } elseif ($betInfo[0] == "4") {
                $name_gd11_pre = "正码四 ";
            } elseif ($betInfo[0] == "5") {
                $name_gd11_pre = "正码五 ";
            }
            if ($betInfo[1] == "OVER") {
                $name_gd11 = $name_gd11_pre . "大";
            } elseif ($betInfo[1] == "UNDER") {
                $name_gd11 = $name_gd11_pre . "小";
            } elseif ($betInfo[1] == "ODD") {
                $name_gd11 = $name_gd11_pre . "单";
            } elseif ($betInfo[1] == "EVEN") {
                $name_gd11 = $name_gd11_pre . "双";
            } elseif ($betInfo[1] . ":" . $betInfo[2] == "SUM:ODD") {
                $name_gd11 = $name_gd11_pre . "和单";
            } elseif ($betInfo[1] . ":" . $betInfo[2] == "SUM:EVEN") {
                $name_gd11 = $name_gd11_pre . "和双";
            } elseif ($betInfo[1] . ":" . $betInfo[2] == "LAST:OVER") {
                $name_gd11 = $name_gd11_pre . "尾大";
            } elseif ($betInfo[1] . ":" . $betInfo[2] == "LAST:UNDER") {
                $name_gd11 = $name_gd11_pre . "尾小";
            }
        }
        return $name_gd11;
    }

    function _getNameBJPK($contentName) {
        $betInfo = explode(":", $contentName);
        $name_bjpk = $contentName;

        if ($betInfo[1] == "LOCATE") {//每球定位
            $selectBall = $betInfo[2];
            if ($selectBall == "1") {
                $name_bjpk = "冠军 " . $betInfo[0];
            } elseif ($selectBall == "2") {
                $name_bjpk = "亚军 " . $betInfo[0];
            } elseif ($selectBall == "3") {
                $name_bjpk = "季军 " . $betInfo[0];
            } elseif ($selectBall == "4") {
                $name_bjpk = "第四名 " . $betInfo[0];
            } elseif ($selectBall == "5") {
                $name_bjpk = "第五名 " . $betInfo[0];
            } elseif ($selectBall == "6") {
                $name_bjpk = "第六名 " . $betInfo[0];
            } elseif ($selectBall == "7") {
                $name_bjpk = "第七名 " . $betInfo[0];
            } elseif ($selectBall == "8") {
                $name_bjpk = "第八名 " . $betInfo[0];
            } elseif ($selectBall == "9") {
                $name_bjpk = "第九名 " . $betInfo[0];
            } elseif ($selectBall == "10") {
                $name_bjpk = "第十名 " . $betInfo[0];
            }
        } elseif ($betInfo[0] > 0) {
            $selectBall = $betInfo[0];
            if ($selectBall == "1") {
                if ($betInfo[2]) {
                    $name_bjpk = "冠军 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "冠军 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "2") {
                if ($betInfo[2]) {
                    $name_bjpk = "亚军 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "亚军 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "3") {
                if ($betInfo[2]) {
                    $name_bjpk = "季军 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "季军 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "4") {
                if ($betInfo[2]) {
                    $name_bjpk = "第四名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第四名 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "5") {
                if ($betInfo[2]) {
                    $name_bjpk = "第五名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第五名 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "6") {
                if ($betInfo[2]) {
                    $name_bjpk = "第六名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第六名 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "7") {
                if ($betInfo[2]) {
                    $name_bjpk = "第七名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第七名 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "8") {
                if ($betInfo[2]) {
                    $name_bjpk = "第八名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第八名 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "9") {
                if ($betInfo[2]) {
                    $name_bjpk = "第九名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第九名 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "10") {
                if ($betInfo[2]) {
                    $name_bjpk = "第十名 " . $this->_getCommonName($betInfo[2]);
                } else {
                    $name_bjpk = "第十名 " . $this->_getCommonName($betInfo[1]);
                }
            }
        } elseif ("SUM:FIRST:2" == $betInfo[0] . ":" . $betInfo[1] . ":" . $betInfo[2]) {
            if ($betInfo[3] == "OVER") {
                $name_bjpk = "和大";
            } elseif ($betInfo[3] == "UNDER") {
                $name_bjpk = "和小";
            } elseif ($betInfo[3] == "ODD") {
                $name_bjpk = "和单";
            } elseif ($betInfo[3] == "EVEN") {
                $name_bjpk = "和双";
            } else {
                $name_bjpk = substr($contentName, 15);
            }
        }

        return $name_bjpk;
    }

    function _getNameBJKN($contentName) {
        $name_bjkn = $contentName;

        if ($contentName == "ALL:SUM:ODD") {
            $name_bjkn = "和单";
        } elseif ($contentName == "ALL:SUM:EVEN") {
            $name_bjkn = "和双";
        } elseif ($contentName == "ALL:SUM:OVER") {
            $name_bjkn = "和大";
        } elseif ($contentName == "ALL:SUM:UNDER") {
            $name_bjkn = "和小";
        } elseif ($contentName == "ALL:SUM:810") {
            $name_bjkn = "和 810";
        } elseif ($contentName == "TOP") {
            $name_bjkn = "上盘";
        } elseif ($contentName == "MIDDLE") {
            $name_bjkn = "中盘";
        } elseif ($contentName == "BOTTOM") {
            $name_bjkn = "下盘";
        } elseif ($contentName == "ODD") {
            $name_bjkn = "奇盘";
        } elseif ($contentName == "TIE") {
            $name_bjkn = "和盘";
        } elseif ($contentName == "EVEN") {
            $name_bjkn = "偶盘";
        } elseif ($contentName == "ALL:SUM:METAL") {
            $name_bjkn = "金";
        } elseif ($contentName == "ALL:SUM:WOOD") {
            $name_bjkn = "木";
        } elseif ($contentName == "ALL:SUM:WATER") {
            $name_bjkn = "水";
        } elseif ($contentName == "ALL:SUM:FIRE") {
            $name_bjkn = "火";
        } elseif ($contentName == "ALL:SUM:EARTH") {
            $name_bjkn = "土";
        } elseif ($contentName == "ALL:SUM:UNDER:ODD") {
            $name_bjkn = "小单";
        } elseif ($contentName == "ALL:SUM:UNDER:EVEN") {
            $name_bjkn = "小双";
        } elseif ($contentName == "ALL:SUM:OVER:ODD") {
            $name_bjkn = "大单";
        } elseif ($contentName == "ALL:SUM:OVER:EVEN") {
            $name_bjkn = "大双";
        }

        return $name_bjkn;
    }

    function _getNameGXSF($contentName) {
        $betInfo = explode(":", $contentName);
        $name_gxsf = $contentName;

        if ($betInfo[1] == "LOCATE") {//每球定位
            $selectBall = $betInfo[2];
            if ($selectBall == "1") {
                $name_gxsf = "正码一 " . $betInfo[0];
            } elseif ($selectBall == "2") {
                $name_gxsf = "正码二 " . $betInfo[0];
            } elseif ($selectBall == "3") {
                $name_gxsf = "正码三 " . $betInfo[0];
            } elseif ($selectBall == "4") {
                $name_gxsf = "正码四 " . $betInfo[0];
            } elseif ($selectBall == "S") {
                $name_gxsf = "特别号 " . $betInfo[0];
            }
        } elseif ($betInfo[1] == "MATCH") {
            $name_gxsf = $betInfo[0];
        } elseif ($betInfo[0] > 0 || $betInfo[0] == "S") {
            $selectBall = $betInfo[0];
            if ($selectBall == "1") {
                if (count($betInfo) == 4) {
                    $name_gxsf = "正码一 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[3]);
                } elseif ($betInfo[2]) {
                    $name_gxsf = "正码一 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gxsf = "正码一 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "2") {
                if (count($betInfo) == 4) {
                    $name_gxsf = "正码二 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[3]);
                } elseif ($betInfo[2]) {
                    $name_gxsf = "正码二 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gxsf = "正码二 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "3") {
                if (count($betInfo) == 4) {
                    $name_gxsf = "正码三 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[3]);
                } elseif ($betInfo[2]) {
                    $name_gxsf = "正码三 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gxsf = "正码三 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "4") {
                if (count($betInfo) == 4) {
                    $name_gxsf = "正码四 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[3]);
                } elseif ($betInfo[2]) {
                    $name_gxsf = "正码四 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gxsf = "正码四 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "S") {
                if (count($betInfo) == 4) {
                    $name_gxsf = "特别号 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[3]);
                } elseif ($betInfo[2]) {
                    $name_gxsf = "特别号 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gxsf = "特别号 " . $this->_getCommonName($betInfo[1]);
                }
            }
        }

        return $name_gxsf;
    }

    function _getNameGDSF($contentName) {
        $betInfo = explode(":", $contentName);
        $name_gdsf = $contentName;

        if ($betInfo[1] == "LOCATE") {//每球定位
            $selectBall = $betInfo[2];
            if ($selectBall == "1") {
                $name_gdsf = "第一球 " . $betInfo[0];
            } elseif ($selectBall == "2") {
                $name_gdsf = "第二球 " . $betInfo[0];
            } elseif ($selectBall == "3") {
                $name_gdsf = "第三球 " . $betInfo[0];
            } elseif ($selectBall == "4") {
                $name_gdsf = "第四球 " . $betInfo[0];
            } elseif ($selectBall == "5") {
                $name_gdsf = "第五球 " . $betInfo[0];
            } elseif ($selectBall == "6") {
                $name_gdsf = "第六球 " . $betInfo[0];
            } elseif ($selectBall == "7") {
                $name_gdsf = "第七球 " . $betInfo[0];
            } elseif ($selectBall == "S") {
                $name_gdsf = "第八球 " . $betInfo[0];
            }
        } elseif ($betInfo[1] == "MATCH") {
            $name_gdsf = $betInfo[0];
        } elseif ($betInfo[0] > 0 || $betInfo[0] == "S") {
            $selectBall = $betInfo[0];
            if ($selectBall == "1") {
                if ($betInfo[2]) {
                    $name_gdsf = "第一球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第一球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "2") {
                if ($betInfo[2]) {
                    $name_gdsf = "第二球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第二球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "3") {
                if ($betInfo[2]) {
                    $name_gdsf = "第三球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第三球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "4") {
                if ($betInfo[2]) {
                    $name_gdsf = "第四球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第四球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "5") {
                if ($betInfo[2]) {
                    $name_gdsf = "第五球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第五球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "6") {
                if ($betInfo[2]) {
                    $name_gdsf = "第六球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第六球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "7") {
                if ($betInfo[2]) {
                    $name_gdsf = "第七球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第七球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "S") {
                if ($betInfo[2]) {
                    $name_gdsf = "第八球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_gdsf = "第八球 " . $this->_getCommonName($betInfo[1]);
                }
            }
            if ($contentName == "1:S:DRAGON") {
                $name_gdsf = "龙";
            } elseif ($contentName == "1:S:TIGER") {
                $name_gdsf = "虎";
            }
        } else {
            if ($contentName == "ALL:SUM:OVER") {
                $name_gdsf = "总和大";
            } elseif ($contentName == "ALL:SUM:UNDER") {
                $name_gdsf = "总和小";
            } elseif ($contentName == "ALL:SUM:ODD") {
                $name_gdsf = "总和单";
            } elseif ($contentName == "ALL:SUM:EVEN") {
                $name_gdsf = "总和双";
            } elseif ($contentName == "ALL:SUM:LAST:OVER") {
                $name_gdsf = "总和尾数大";
            } elseif ($contentName == "ALL:SUM:LAST:UNDER") {
                $name_gdsf = "总和尾数小";
            }
        }

        return $name_gdsf;
    }

    function _getNameTJSF($contentName) {
        $betInfo = explode(":", $contentName);
        $name_tjsf = $contentName;

        if ($betInfo[1] == "LOCATE") {//每球定位
            $selectBall = $betInfo[2];
            if ($selectBall == "1") {
                $name_tjsf = "第一球 " . $betInfo[0];
            } elseif ($selectBall == "2") {
                $name_tjsf = "第二球 " . $betInfo[0];
            } elseif ($selectBall == "3") {
                $name_tjsf = "第三球 " . $betInfo[0];
            } elseif ($selectBall == "4") {
                $name_tjsf = "第四球 " . $betInfo[0];
            } elseif ($selectBall == "5") {
                $name_tjsf = "第五球 " . $betInfo[0];
            } elseif ($selectBall == "6") {
                $name_tjsf = "第六球 " . $betInfo[0];
            } elseif ($selectBall == "7") {
                $name_tjsf = "第七球 " . $betInfo[0];
            } elseif ($selectBall == "S") {
                $name_tjsf = "特别号 " . $betInfo[0];
            }
        } elseif ($betInfo[1] == "MATCH") {
            $name_tjsf = $betInfo[0];
        } elseif ($betInfo[0] > 0 || $betInfo[0] == "S") {
            $selectBall = $betInfo[0];
            if ($selectBall == "1") {
                if ($betInfo[2]) {
                    $name_tjsf = "第一球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第一球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "2") {
                if ($betInfo[2]) {
                    $name_tjsf = "第二球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第二球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "3") {
                if ($betInfo[2]) {
                    $name_tjsf = "第三球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第三球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "4") {
                if ($betInfo[2]) {
                    $name_tjsf = "第四球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第四球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "5") {
                if ($betInfo[2]) {
                    $name_tjsf = "第五球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第五球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "6") {
                if ($betInfo[2]) {
                    $name_tjsf = "第六球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第六球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "7") {
                if ($betInfo[2]) {
                    $name_tjsf = "第七球 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "第七球 " . $this->_getCommonName($betInfo[1]);
                }
            } elseif ($selectBall == "S") {
                if ($betInfo[2]) {
                    $name_tjsf = "特别号 " . $this->_getCommonName($betInfo[1] . ":" . $betInfo[2]);
                } else {
                    $name_tjsf = "特别号 " . $this->_getCommonName($betInfo[1]);
                }
            }
            if ($contentName == "1:S:DRAGON") {
                $name_tjsf = "龙";
            } elseif ($contentName == "1:S:TIGER") {
                $name_tjsf = "虎";
            }
        } else {
            if ($contentName == "ALL:SUM:OVER") {
                $name_tjsf = "总和大";
            } elseif ($contentName == "ALL:SUM:UNDER") {
                $name_tjsf = "总和小";
            } elseif ($contentName == "ALL:SUM:ODD") {
                $name_tjsf = "总和单";
            } elseif ($contentName == "ALL:SUM:EVEN") {
                $name_tjsf = "总和双";
            } elseif ($contentName == "ALL:SUM:LAST:OVER") {
                $name_tjsf = "总和尾数大";
            } elseif ($contentName == "ALL:SUM:LAST:UNDER") {
                $name_tjsf = "总和尾数小";
            }
        }

        return $name_tjsf;
    }

    function _getNameB5($contentName) {
        $name_b5 = $this->_get535NameByCode($contentName);
        return $name_b5;
    }

    function _get535NameByCode($aConcede) {
        $name = $aConcede;
        if ($aConcede == "535-ODD") {
            $name = "万 单";
        } elseif ($aConcede == "535-EVEN") {
            $name = "万 双";
        } elseif ($aConcede == "540-OVER") {
            $name = "万 大";
        } elseif ($aConcede == "540-UNDER") {
            $name = "万 小";
        } elseif ($aConcede == "545-PRIME") {
            $name = "万 质";
        } elseif ($aConcede == "545-COMPO") {
            $name = "万 合";
        } elseif ($aConcede == "536-ODD") {
            $name = "仟 单";
        } elseif ($aConcede == "536-EVEN") {
            $name = "仟 双";
        } elseif ($aConcede == "541-OVER") {
            $name = "仟 大";
        } elseif ($aConcede == "541-UNDER") {
            $name = "仟 小";
        } elseif ($aConcede == "546-PRIME") {
            $name = "仟 质";
        } elseif ($aConcede == "546-COMPO") {
            $name = "仟 合";
        } elseif ($aConcede == "537-ODD") {
            $name = "佰 单";
        } elseif ($aConcede == "537-EVEN") {
            $name = "佰 双";
        } elseif ($aConcede == "542-OVER") {
            $name = "佰 大";
        } elseif ($aConcede == "542-UNDER") {
            $name = "佰 小";
        } elseif ($aConcede == "547-PRIME") {
            $name = "佰 质";
        } elseif ($aConcede == "547-COMPO") {
            $name = "佰 合";
        } elseif ($aConcede == "538-ODD") {
            $name = "拾 单";
        } elseif ($aConcede == "538-EVEN") {
            $name = "拾 双";
        } elseif ($aConcede == "543-OVER") {
            $name = "拾 大";
        } elseif ($aConcede == "543-UNDER") {
            $name = "拾 小";
        } elseif ($aConcede == "548-PRIME") {
            $name = "拾 质";
        } elseif ($aConcede == "548-COMPO") {
            $name = "拾 合";
        } elseif ($aConcede == "539-ODD") {
            $name = "个 单";
        } elseif ($aConcede == "539-EVEN") {
            $name = "个 双";
        } elseif ($aConcede == "544-OVER") {
            $name = "个 大";
        } elseif ($aConcede == "544-UNDER") {
            $name = "个 小";
        } elseif ($aConcede == "549-PRIME") {
            $name = "个 质";
        } elseif ($aConcede == "549-COMPO") {
            $name = "个 合";
        } elseif ($aConcede == "550-ODD") {
            $name = "万仟 单";
        } elseif ($aConcede == "550-EVEN") {
            $name = "万仟 双";
        } elseif ($aConcede == "560-OVER") {
            $name = "万仟 大";
        } elseif ($aConcede == "560-UNDER") {
            $name = "万仟 小";
        } elseif ($aConcede == "570-PRIME") {
            $name = "万仟 质";
        } elseif ($aConcede == "570-COMPO") {
            $name = "万仟 合";
        } elseif ($aConcede == "551-ODD") {
            $name = "万佰 单";
        } elseif ($aConcede == "551-EVEN") {
            $name = "万佰 双";
        } elseif ($aConcede == "561-OVER") {
            $name = "万佰 大";
        } elseif ($aConcede == "561-UNDER") {
            $name = "万佰 小";
        } elseif ($aConcede == "571-PRIME") {
            $name = "万佰 质";
        } elseif ($aConcede == "571-COMPO") {
            $name = "万佰 合";
        } elseif ($aConcede == "552-ODD") {
            $name = "万拾 单";
        } elseif ($aConcede == "552-EVEN") {
            $name = "万拾 双";
        } elseif ($aConcede == "562-OVER") {
            $name = "万拾 大";
        } elseif ($aConcede == "562-UNDER") {
            $name = "万拾 小";
        } elseif ($aConcede == "572-PRIME") {
            $name = "万拾 质";
        } elseif ($aConcede == "572-COMPO") {
            $name = "万拾 合";
        } elseif ($aConcede == "553-ODD") {
            $name = "万个 单";
        } elseif ($aConcede == "553-EVEN") {
            $name = "万个 双";
        } elseif ($aConcede == "563-OVER") {
            $name = "万个 大";
        } elseif ($aConcede == "563-UNDER") {
            $name = "万个 小";
        } elseif ($aConcede == "573-PRIME") {
            $name = "万个 质";
        } elseif ($aConcede == "573-COMPO") {
            $name = "万个 合";
        } elseif ($aConcede == "554-ODD") {
            $name = "仟佰 单";
        } elseif ($aConcede == "554-EVEN") {
            $name = "仟佰 双";
        } elseif ($aConcede == "564-OVER") {
            $name = "仟佰 大";
        } elseif ($aConcede == "564-UNDER") {
            $name = "仟佰 小";
        } elseif ($aConcede == "574-PRIME") {
            $name = "仟佰 质";
        } elseif ($aConcede == "574-COMPO") {
            $name = "仟佰 合";
        } elseif ($aConcede == "555-ODD") {
            $name = "仟拾 单";
        } elseif ($aConcede == "555-EVEN") {
            $name = "仟拾 双";
        } elseif ($aConcede == "565-OVER") {
            $name = "仟拾 大";
        } elseif ($aConcede == "565-UNDER") {
            $name = "仟拾 小";
        } elseif ($aConcede == "575-PRIME") {
            $name = "仟拾 质";
        } elseif ($aConcede == "575-COMPO") {
            $name = "仟拾 合";
        } elseif ($aConcede == "556-ODD") {
            $name = "仟个 单";
        } elseif ($aConcede == "556-EVEN") {
            $name = "仟个 双";
        } elseif ($aConcede == "566-OVER") {
            $name = "仟个 大";
        } elseif ($aConcede == "566-UNDER") {
            $name = "仟个 小";
        } elseif ($aConcede == "576-PRIME") {
            $name = "仟个 质";
        } elseif ($aConcede == "576-COMPO") {
            $name = "仟个 合";
        } elseif ($aConcede == "557-ODD") {
            $name = "佰拾 单";
        } elseif ($aConcede == "557-EVEN") {
            $name = "佰拾 双";
        } elseif ($aConcede == "567-OVER") {
            $name = "佰拾 大";
        } elseif ($aConcede == "567-UNDER") {
            $name = "佰拾 小";
        } elseif ($aConcede == "577-PRIME") {
            $name = "佰拾 质";
        } elseif ($aConcede == "577-COMPO") {
            $name = "佰拾 合";
        } elseif ($aConcede == "558-ODD") {
            $name = "佰个 单";
        } elseif ($aConcede == "558-EVEN") {
            $name = "佰个 双";
        } elseif ($aConcede == "568-OVER") {
            $name = "佰个 大";
        } elseif ($aConcede == "568-UNDER") {
            $name = "佰个 小";
        } elseif ($aConcede == "578-PRIME") {
            $name = "佰个 质";
        } elseif ($aConcede == "578-COMPO") {
            $name = "佰个 合";
        } elseif ($aConcede == "559-ODD") {
            $name = "拾个 单";
        } elseif ($aConcede == "559-EVEN") {
            $name = "拾个 双";
        } elseif ($aConcede == "569-OVER") {
            $name = "拾个 大";
        } elseif ($aConcede == "569-UNDER") {
            $name = "拾个 小";
        } elseif ($aConcede == "579-PRIME") {
            $name = "拾个 质";
        } elseif ($aConcede == "579-COMPO") {
            $name = "拾个 合";
        } elseif ($aConcede == "580-ODD") {
            $name = "前三 单";
        } elseif ($aConcede == "580-EVEN") {
            $name = "前三 双";
        } elseif ($aConcede == "583-OVER") {
            $name = "前三 大";
        } elseif ($aConcede == "583-UNDER") {
            $name = "前三 小";
        } elseif ($aConcede == "586-PRIME") {
            $name = "前三 质";
        } elseif ($aConcede == "586-COMPO") {
            $name = "前三 合";
        } elseif ($aConcede == "581-ODD") {
            $name = "中三 单";
        } elseif ($aConcede == "581-EVEN") {
            $name = "中三 双";
        } elseif ($aConcede == "584-OVER") {
            $name = "中三 大";
        } elseif ($aConcede == "584-UNDER") {
            $name = "中三 小";
        } elseif ($aConcede == "587-PRIME") {
            $name = "中三 质";
        } elseif ($aConcede == "587-COMPO") {
            $name = "中三 合";
        } elseif ($aConcede == "582-ODD") {
            $name = "后三 单";
        } elseif ($aConcede == "582-EVEN") {
            $name = "后三 双";
        } elseif ($aConcede == "585-OVER") {
            $name = "后三 大";
        } elseif ($aConcede == "585-UNDER") {
            $name = "后三 小";
        } elseif ($aConcede == "588-PRIME") {
            $name = "后三 质";
        } elseif ($aConcede == "588-COMPO") {
            $name = "后三 合";
        }
        return $name;
    }

    function _getNameB3($contentName) {
        $name_b3 = $this->_getOeouNameByCode($contentName);
        if ($name_b3 == $contentName) {
            if (strpos($contentName, "*") !== false) {
                $betInfo = explode("*", $contentName);
                if (in_array($betInfo[0], array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9"))) {
                    return $name_b3;
                }
                if ($betInfo[2]) {
                    $name_b3 = $this->_getOeouNameByCode($betInfo[0]) . "*" . $this->_getOeouNameByCode($betInfo[1]) . "*" . $this->_getOeouNameByCode($betInfo[2]);
                } else {
                    $name_b3 = $this->_getOeouNameByCode($betInfo[0]) . "*" . $this->_getOeouNameByCode($betInfo[1]);
                }
            }
        }
        return $name_b3;
    }

    function _getOeouNameByCode($aConcede) {
        $name = $aConcede;
        if ($aConcede == "M_ODD") {
            $name = "佰 单";
        } elseif ($aConcede == "M_EVEN") {
            $name = "佰 双";
        } elseif ($aConcede == "M_OVER") {
            $name = "佰 大";
        } elseif ($aConcede == "M_UNDER") {
            $name = "佰 小";
        } elseif ($aConcede == "M_PRIME") {
            $name = "佰 质";
        } elseif ($aConcede == "M_COMPO") {
            $name = "佰 合";
        } elseif ($aConcede == "C_ODD") {
            $name = "拾 单";
        } elseif ($aConcede == "C_EVEN") {
            $name = "拾 双";
        } elseif ($aConcede == "C_OVER") {
            $name = "拾 大";
        } elseif ($aConcede == "C_UNDER") {
            $name = "拾 小";
        } elseif ($aConcede == "C_PRIME") {
            $name = "拾 质";
        } elseif ($aConcede == "C_COMPO") {
            $name = "拾 合";
        } elseif ($aConcede == "U_ODD") {
            $name = "个 单";
        } elseif ($aConcede == "U_EVEN") {
            $name = "个 双";
        } elseif ($aConcede == "U_OVER") {
            $name = "个 大";
        } elseif ($aConcede == "U_UNDER") {
            $name = "个 小";
        } elseif ($aConcede == "U_PRIME") {
            $name = "个 质";
        } elseif ($aConcede == "U_COMPO") {
            $name = "个 合";
        } elseif ($aConcede == "MC_ODD") {
            $name = "佰拾 单";
        } elseif ($aConcede == "MC_EVEN") {
            $name = "佰拾 双";
        } elseif ($aConcede == "MC_OVER") {
            $name = "佰拾 大";
        } elseif ($aConcede == "MC_UNDER") {
            $name = "佰拾 小";
        } elseif ($aConcede == "MC_PRIME") {
            $name = "佰拾 质";
        } elseif ($aConcede == "MC_COMPO") {
            $name = "佰拾 合";
        } elseif ($aConcede == "MU_ODD") {
            $name = "佰个 单";
        } elseif ($aConcede == "MU_EVEN") {
            $name = "佰个 双";
        } elseif ($aConcede == "MU_OVER") {
            $name = "佰个 大";
        } elseif ($aConcede == "MU_UNDER") {
            $name = "佰个 小";
        } elseif ($aConcede == "MU_PRIME") {
            $name = "佰个 质";
        } elseif ($aConcede == "MU_COMPO") {
            $name = "佰个 合";
        } elseif ($aConcede == "CU_ODD") {
            $name = "拾个 单";
        } elseif ($aConcede == "CU_EVEN") {
            $name = "拾个 双";
        } elseif ($aConcede == "CU_OVER") {
            $name = "拾个 大";
        } elseif ($aConcede == "CU_UNDER") {
            $name = "拾个 小";
        } elseif ($aConcede == "CU_PRIME") {
            $name = "拾个 质";
        } elseif ($aConcede == "CU_COMPO") {
            $name = "拾个 合";
        } elseif ($aConcede == "MCU_ODD") {
            $name = "佰拾个 单";
        } elseif ($aConcede == "MCU_EVEN") {
            $name = "佰拾个 双";
        } elseif ($aConcede == "MCU_OVER") {
            $name = "佰拾个 大";
        } elseif ($aConcede == "MCU_UNDER") {
            $name = "佰拾个 小";
        } elseif ($aConcede == "MCU_PRIME") {
            $name = "佰拾个 质";
        } elseif ($aConcede == "MCU_COMPO") {
            $name = "佰拾个 合";
        }
        return $name;
    }

    function _getCommonName($content) {
        $name = "";
        if ($content == "OVER") {
            $name = "大";
        } elseif ($content == "UNDER") {
            $name = "小";
        } elseif ($content == "ODD") {
            $name = "单";
        } elseif ($content == "EVEN") {
            $name = "双";
        } elseif ($content == "DRAGON") {
            $name = "龙";
        } elseif ($content == "TIGER") {
            $name = "虎";
        } elseif ($content == "SUM:ODD") {
            $name = "和单";
        } elseif ($content == "SUM:EVEN") {
            $name = "和双";
        } elseif ($content == "LAST:OVER") {
            $name = "尾大";
        } elseif ($content == "LAST:UNDER") {
            $name = "尾小";
        } elseif ($content == "RED") {
            $name = "红波";
        } elseif ($content == "BLUE") {
            $name = "蓝波";
        } elseif ($content == "GREEN") {
            $name = "绿波";
        } elseif ($content == "OVER:ODD") {
            $name = "大单";
        } elseif ($content == "OVER:EVEN") {
            $name = "大双";
        } elseif ($content == "UNDER:ODD") {
            $name = "小单";
        } elseif ($content == "UNDER:EVEN") {
            $name = "小双";
        } elseif ($content == "SPRING") {
            $name = "春";
        } elseif ($content == "SUMMER") {
            $name = "夏";
        } elseif ($content == "FALL") {
            $name = "秋";
        } elseif ($content == "WINTER") {
            $name = "冬";
        } elseif ($content == "METAL") {
            $name = "金";
        } elseif ($content == "WOOD") {
            $name = "木";
        } elseif ($content == "WATER") {
            $name = "水";
        } elseif ($content == "FIRE") {
            $name = "火";
        } elseif ($content == "EARTH") {
            $name = "土";
        } elseif ($content == "EAST") {
            $name = "东";
        } elseif ($content == "SOUTH") {
            $name = "南";
        } elseif ($content == "WEST") {
            $name = "西";
        } elseif ($content == "NORTH") {
            $name = "北";
        } elseif ($content == "ZHONG") {
            $name = "中";
        } elseif ($content == "FA") {
            $name = "发";
        } elseif ($content == "BAI") {
            $name = "白";
        }
        return $name;
    }

}
