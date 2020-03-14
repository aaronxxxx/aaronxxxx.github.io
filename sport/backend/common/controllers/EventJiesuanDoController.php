<?php
namespace app\common\controllers;

use Yii;
use yii\console\Controller;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\models\AgentsMoneyLog;

class EventJiesuanDoController extends Controller
{
    public function __construct(){}

    public function actionAgentsJiesuan($agent, $s_time, $e_time)
    {
        $lottery_bet_money = 0;
        $lottery_win = 0;

        $arr = AgentsMoneyLog::getJstime($agent['id']);

        foreach ($arr as $key => $value) {
            if (($value['s_time'] <= substr($s_time, 0, 10)) && (substr($s_time, 0, 10) <= $value['e_time'])) {
                return "開始時間已經有結算過，請查詢後再結算。";
            }

            if (($value['s_time'] <= substr($e_time, 0, 10)) && (substr($e_time, 0, 10) <= $value['e_time'])) {
                return "結束時間已經有結算過，請查詢後再結算。";
            }
        }

        $id = $agent['id'];
        $rows_event = AgentsList::jsAgentEventNoStatus($id, $s_time, $e_time);

        if ($rows_event) {
            $lottery_bet_money += $rows_event['bet_money_total'];
            $lottery_win += $rows_event['bet_money_total'] - $rows_event['win_total'];
        }

        $ratio = 0;
        $ledger = $betMoneyTotal = $lottery_bet_money;
        $profig = $winMoneyTotal = $lottery_win;

        //結算金額 = 總投注金額 * 退水(12%)
        $money = $betMoneyTotal * ($agent['refunded_scale'] / 100);
        //退水金額 = 總投注金額 * 退水(12%)
        $return_water = $betMoneyTotal * ($agent['refunded_scale'] / 100);
        //公司淨利 = 未分成盈利 - 退水金額
        $company_profit = $winMoneyTotal - $return_water;
        //營利退回 = 0
        $profig_return = 0;

        // 更新用戶錢包: 原金額 + 這次結算的錢
        $agent = AgentsList::getAgentsNewsByID($agent['id']);
        $money = $money + $agent['money'];
        $setMoney = AgentsList::setmoney($agent['id'], $money);

        $refund_scale = $agent['refunded_scale'];
        $settlement_type = $agent['agents_type'];
        AgentsMoneyLog::addAgentsMoneyLog($agent['id'], $money, $s_time, $e_time, $ledger, $profig, $ratio, $settlement_type, $refund_scale, $company_profit);

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