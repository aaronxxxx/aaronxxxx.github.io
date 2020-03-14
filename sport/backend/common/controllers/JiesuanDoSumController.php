<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票結算
 */

namespace app\common\controllers;

use Yii;
use yii\console\Controller;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\models\AgentsMoneyLog;

class JiesuanDoSumController extends Controller
{
    public function __construct(){}
    public function actionAgentsJiesuan($id,$s_time,$e_time){
        $lottery_bet_money = 0;
        $lottery_win = 0;
        $agent = AgentsList::getAgentsNewsByID($id);
        $arr = AgentsMoneyLog::getJstime($agent['id']);
        foreach ($arr as $key => $value) {
            if (($value['s_time'] <= substr($s_time,0,10)) && (substr($s_time,0,10) <= $value['e_time'])) {
                return  "開始時間已經有結算過，請查詢後再結算。";
            }
            if (($value['s_time'] <= substr($e_time,0,10)) && (substr($e_time,0,10) <= $value['e_time'])) {
                return "結束時間已經有結算過，請查詢後再結算。";
            }
        }
        $tmp = array($id);
        $res = AgentsList::getAgentsNewsBySumID($id);
        foreach($res as $val){
            array_push($tmp,$val['id']);
        }
        $id = implode (",",$tmp);


        $rows_lottery = AgentsList::jsAgentLotterySum($id, $s_time, $e_time);
        $rows_six = AgentsList::jsAgentSixSum($id, $s_time, $e_time);
        $rows_spsix = AgentsList::jsAgentSpSixSum($id, $s_time, $e_time);
        $rows_live = AgentsList::jsAgentLiveSum($id, $s_time, $e_time);
        $rows_event = AgentsList::jsAgentEventSum($id, $s_time, $e_time);//賽事結算

        if ($rows_lottery) {
            foreach ($rows_lottery as $key => $value) {
                $lottery_bet_money+=$value['bet_money_total'];
                $lottery_win += $value['bet_money_total'] - $value['win_total'];
            }
        }
        if ($rows_six) {
            foreach ($rows_six as $key1 => $value1) {
                $lottery_bet_money +=$value1['bet_money_total'];
                $lottery_win += $value1['bet_money_total'] - $value1['win_total'];
            }
        }

        if ($rows_spsix) {
            foreach ($rows_spsix as $key2 => $value2) {
                $lottery_bet_money +=$value2['bet_money_total'];
                $lottery_win += $value2['bet_money_total'] - $value2['win_total'];
            }
        }

        if ($rows_live) {
            foreach ($rows_live as $key3 => $value3) {
                $lottery_bet_money +=$value3['bet_money_total'];
                $lottery_win += $value3['bet_money_total'] - $value3['win_total'];
            }
        }

        if ($rows_event) {
            foreach ($rows_event as $key4 => $value4) {
                $lottery_bet_money +=$value4['bet_money_total'];
                $lottery_win += $value4['bet_money_total'] - $value4['win_total'];
            }
        }

        $ratio = 0;
        $ledger = $betMoneyTotal = $lottery_bet_money;
        $profig = $winMoneyTotal = $lottery_win;

        if($agent['agents_type'] == '贏利分成'){
            // if ($lottery_win > 0) {
            //     if ($lottery_win < $agent['total_1_2']) {
            //         $ratio = $agent['total_1_scale'];
            //     }elseif ($lottery_win < $agent['total_2_2']){
            //         $ratio = $agent['total_2_scale'];
            //     }elseif ($lottery_win < $agent['total_3_2']){
            //         $ratio = $agent['total_3_scale'];
            //     }elseif ($lottery_win < $agent['total_4_2']){
            //         $ratio = $agent['total_4_scale'];
            //     }
            // }elseif ($lottery_win < 0){
                if (abs($lottery_win) < $agent['total_1_2']) {
                    $ratio = $agent['total_1_scale'];
                }elseif (abs($lottery_win)  < $agent['total_2_2']){
                    $ratio = $agent['total_2_scale'];
                }elseif (abs($lottery_win)  < $agent['total_3_2']){
                    $ratio = $agent['total_3_scale'];
                }elseif (abs($lottery_win)  > $agent['total_4_1']){
                    $ratio = $agent['total_4_scale'];
                }
            // }
            //退水 = 總投注金額 * 退水(12%) * 公司贏利分成(100-ratio)%
            $return_water = $betMoneyTotal*($agent['refunded_scale']/100)*((100-$ratio)/100);
            //公司淨利 = 未分成盈利*公司分成(100-ratio)% - 總投注金額*退水(12%)*公司負擔退水(100-ratio)%
            $company_profit = $winMoneyTotal*(1-($ratio/100)) - $betMoneyTotal*($agent['refunded_scale']/100)*(1-($ratio/100));
            //盈利退回 = 未分成盈利*公負擔的盈利(100-ratio)% *-1
            //要負的 ????
            $profig_return = $winMoneyTotal*((100-$ratio)/100);
            //結算金額 = 退水金額 + 盈利退回
            $money = $return_water + $profig_return;

        }elseif($agent['agents_type'] == '流水分成'){
            //結算金額 = 總投注金額 * 退水(12%)
            $money = $betMoneyTotal*($agent['refunded_scale']/100);
            //退水金額 = 總投注金額 * 退水(12%)
            $return_water = $betMoneyTotal*($agent['refunded_scale']/100);
            //公司淨利 = 未分成盈利 - 退水金額
            $company_profit = $winMoneyTotal - $return_water;
            //營利退回 = 0
            $profig_return = 0;
        }

        $refund_scale = $agent['refunded_scale'];
        $settlement_type = $agent['agents_type'];
        AgentsMoneyLog::addAgentsMoneyLog( $agent['id'], $money, $s_time, $e_time, $ledger, $profig, $ratio, $settlement_type, $refund_scale,$company_profit);

        $data = array();
        $data['id'] = $agent['id'];
        $data['s_time'] = $s_time;
        $data['e_time'] = $e_time;
        $data['ratio'] = $ratio;
        $data['money'] = $money;
        $data['profig_return'] = $profig_return;
        $data['company_profit'] = $company_profit;
        $data['agents_type'] = $agent['agents_type'];
        $data['return_water'] = $return_water;
        $data['profig'] = $profig;
        $data['ledger'] = $ledger;
        $data['refund_scale'] = $refund_scale;

        return json_encode($data);
    }
}