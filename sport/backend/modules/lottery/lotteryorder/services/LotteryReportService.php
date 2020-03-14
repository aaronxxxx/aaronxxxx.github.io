<?php
namespace app\modules\lottery\lotteryorder\services;
use Yii;
use yii\base\Object;
use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\lottery\lotteryorder\model\OrderLottery;
use app\common\base\BaseService;

class LotteryReportService extends BaseService
{
    /*
     * 彩票各个彩种报表
     * 主页
     */
    public function lottery($userids,$start_time,$end_time){
        $user_id_string = $this->_arrayToSql($userids);
        $lottery_list = array();
        $d3_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "D3", $user_id_string);
        $p3_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "P3", $user_id_string);
        $t3_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "T3", $user_id_string);
        $cq_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "CQ", $user_id_string);
        $tj_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "TJ", $user_id_string);
        $gxsf_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "GXSF", $user_id_string);
        $gdsf_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "GDSF", $user_id_string);
        $tjsf_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "TJSF", $user_id_string);
        $cqsf_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "CQSF", $user_id_string);
        $gd11_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "GD11", $user_id_string);
        $bjpk_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "BJPK", $user_id_string);
        $bjkn_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "BJKN", $user_id_string);
        $ssrc_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "SSRC", $user_id_string);
        $mlaft_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "MLAFT", $user_id_string);
        $ts_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "TS", $user_id_string);
        $orpk_result = OrderLottery::getBetMoneyAndCount1($start_time, $end_time, "ORPK", $user_id_string);
        
        $d3_he = OrderLottery::getHe($start_time, $end_time, "D3", $user_id_string);
        $p3_he =  OrderLottery::getHe($start_time, $end_time, "P3", $user_id_string);
        $t3_he =  OrderLottery::getHe($start_time, $end_time, "T3", $user_id_string);
        $cq_he =  OrderLottery::getHe($start_time, $end_time, "CQ", $user_id_string);
        $tj_he =  OrderLottery::getHe($start_time, $end_time, "TJ", $user_id_string);
        $gxsf_he = OrderLottery::getHe($start_time, $end_time, "GXSF", $user_id_string);
        $gdsf_he = OrderLottery::getHe($start_time, $end_time, "GDSF", $user_id_string);
        $tjsf_he = OrderLottery::getHe($start_time, $end_time, "TJSF", $user_id_string);
        $cqsf_he = OrderLottery::getHe($start_time, $end_time, "CQSF", $user_id_string);
        $gd11_he = OrderLottery::getHe($start_time, $end_time, "GD11", $user_id_string);
        $bjpk_he = OrderLottery::getHe($start_time, $end_time, "BJPK", $user_id_string);
        $bjkn_he = OrderLottery::getHe($start_time, $end_time, "BJKN", $user_id_string);
        $ssrc_he = OrderLottery::getHe($start_time, $end_time, "SSRC", $user_id_string);
        $mlaft_he = OrderLottery::getHe($start_time, $end_time, "MLAFT", $user_id_string);
        $ts_he = OrderLottery::getHe($start_time, $end_time, "TS", $user_id_string);
        $orpk_he = OrderLottery::getHe($start_time, $end_time, "ORPK", $user_id_string);

        $d3_win = OrderLottery::getWin1($start_time, $end_time, "D3", $user_id_string);
        $p3_win =  OrderLottery::getWin1($start_time, $end_time, "P3", $user_id_string);
        $t3_win =  OrderLottery::getWin1($start_time, $end_time, "T3", $user_id_string);
        $cq_win =  OrderLottery::getWin1($start_time, $end_time, "CQ", $user_id_string);
        $tj_win =  OrderLottery::getWin1($start_time, $end_time, "TJ", $user_id_string);
        $gxsf_win = OrderLottery::getWin1($start_time, $end_time, "GXSF", $user_id_string);
        $gdsf_win = OrderLottery::getWin1($start_time, $end_time, "GDSF", $user_id_string);
        $tjsf_win = OrderLottery::getWin1($start_time, $end_time, "TJSF", $user_id_string);
        $cqsf_win = OrderLottery::getWin1($start_time, $end_time, "CQSF", $user_id_string);
        $gd11_win = OrderLottery::getWin1($start_time, $end_time, "GD11", $user_id_string);
        $bjpk_win = OrderLottery::getWin1($start_time, $end_time, "BJPK", $user_id_string);
        $bjkn_win = OrderLottery::getWin1($start_time, $end_time, "BJKN", $user_id_string);
        $ssrc_win = OrderLottery::getWin1($start_time, $end_time, "SSRC", $user_id_string);
        $mlaft_win = OrderLottery::getWin1($start_time, $end_time, "MLAFT", $user_id_string);
        $ts_win = OrderLottery::getWin1($start_time, $end_time, "TS", $user_id_string);
        $orpk_win = OrderLottery::getWin1($start_time, $end_time, "ORPK", $user_id_string);

        $all_bet_count = $d3_result['bet_count'] + $p3_result['bet_count'] + $t3_result['bet_count'] + $cq_result['bet_count'] + $tj_result['bet_count'] + $gxsf_result['bet_count'] + $gdsf_result['bet_count'] + $tjsf_result['bet_count'] + $gd11_result['bet_count'] + $bjpk_result['bet_count'] + $bjkn_result['bet_count'] + $cqsf_result['bet_count'] + $ssrc_result['bet_count'] + $mlaft_result['bet_count'] + $ts_result['bet_count'] + $orpk_result['bet_count'];
        $all_bet_money = $d3_result['bet_money'] + $p3_result['bet_money'] + $t3_result['bet_money'] + $cq_result['bet_money'] + $tj_result['bet_money'] + $gxsf_result['bet_money'] + $gdsf_result['bet_money'] + $tjsf_result['bet_money'] + $gd11_result['bet_money'] + $bjpk_result['bet_money'] + $bjkn_result['bet_money'] + $cqsf_result['bet_money'] + $ssrc_result['bet_money'] + $mlaft_result['bet_money'] + $ts_result['bet_money'] + $orpk_result['bet_money'];
        $all_win_money = $d3_win + $p3_win + $t3_win + $cq_win + $tj_win + $gxsf_win + $gdsf_win + $tjsf_win + $gd11_win + $bjpk_win + $bjkn_win + $cqsf_win + $ssrc_win + $mlaft_win + $ts_win + $orpk_win;
        $all_he = $d3_he + $p3_he + $t3_he + $cq_he + $tj_he + $tj_he + $gxsf_he + $gdsf_he + $tjsf_he + $cqsf_he + $bjkn_he + $gd11_he + $bjpk_he + $ssrc_he + $mlaft_he + $ts_he + $orpk_he;
        $lottery_list['d3_count'] = $d3_result['bet_count'];
        $lottery_list['d3_money'] = $d3_result['bet_money'];
        $lottery_list['d3_win'] = round($d3_win,2);
        $lottery_list['d3_result'] = $d3_result['bet_money'] - $d3_win - $d3_he;
        $lottery_list['p3_count'] = $p3_result['bet_count'];
        $lottery_list['p3_money'] = $p3_result['bet_money'];
        $lottery_list['p3_win'] = round($p3_win,2);
        $lottery_list['p3_result'] = $p3_result['bet_money'] - $p3_win - $p3_he;
        $lottery_list['t3_count'] = $t3_result['bet_count'];
        $lottery_list['t3_money'] = $t3_result['bet_money'];
        $lottery_list['t3_win'] = round($t3_win,2);
        $lottery_list['t3_result'] = $t3_result['bet_money'] - $t3_win - $t3_he;
        $lottery_list['cq_count'] = $cq_result['bet_count'];
        $lottery_list['cq_money'] = $cq_result['bet_money'];
        $lottery_list['cq_win'] = round($cq_win,2);
        $lottery_list['cq_result'] = $cq_result['bet_money'] - $cq_win - $cq_he;
        $lottery_list['tj_count'] = $tj_result['bet_count'];
        $lottery_list['tj_money'] = $tj_result['bet_money'];
        $lottery_list['tj_win'] = round($tj_win,2);
        $lottery_list['tj_result'] = $tj_result['bet_money'] - $tj_win - $tj_he;
        $lottery_list['gxsf_count'] = $gxsf_result['bet_count'];
        $lottery_list['gxsf_money'] = $gxsf_result['bet_money'];
        $lottery_list['gxsf_win'] = round($gxsf_win,2);
        $lottery_list['gxsf_result'] = $gxsf_result['bet_money'] - $gxsf_win - $gxsf_he;
        $lottery_list['gdsf_count'] = $gdsf_result['bet_count'];
        $lottery_list['gdsf_money'] = $gdsf_result['bet_money'];
        $lottery_list['gdsf_win'] = round($gdsf_win,2);
        $lottery_list['gdsf_result'] = $gdsf_result['bet_money'] - $gdsf_win - $gdsf_he;
        $lottery_list['tjsf_count'] = $tjsf_result['bet_count'];
        $lottery_list['tjsf_money'] = $tjsf_result['bet_money'];
        $lottery_list['tjsf_win'] = round($tjsf_win,2);
        $lottery_list['tjsf_result'] = $tjsf_result['bet_money'] - $tjsf_win - $tjsf_he;
        $lottery_list['cqsf_count'] = $cqsf_result['bet_count'];
        $lottery_list['cqsf_money'] = $cqsf_result['bet_money'];
        $lottery_list['cqsf_win'] = round($cqsf_win,2);
        $lottery_list['cqsf_result'] = $cqsf_result['bet_money'] - $cqsf_win - $cqsf_he;
        $lottery_list['bjkn_count'] = $bjkn_result['bet_count'];
        $lottery_list['bjkn_money'] = $bjkn_result['bet_money'];
        $lottery_list['bjkn_win'] = round($bjkn_win,2);
        $lottery_list['bjkn_result'] = $bjkn_result['bet_money'] - $bjkn_win - $bjkn_he;
        $lottery_list['gd11_count'] = $gd11_result['bet_count'];
        $lottery_list['gd11_money'] = $gd11_result['bet_money'];
        $lottery_list['gd11_win'] = round($gd11_win,2);
        $lottery_list['gd11_result'] = $gd11_result['bet_money'] - $gd11_win - $gd11_he;
        $lottery_list['bjpk_count'] = $bjpk_result['bet_count'];
        $lottery_list['bjpk_money'] = $bjpk_result['bet_money'];
        $lottery_list['bjpk_win'] = round($bjpk_win,2);
        $lottery_list['bjpk_result'] = $bjpk_result['bet_money'] - $bjpk_win - $bjpk_he;
        $lottery_list['ssrc_count'] = $ssrc_result['bet_count'];
        $lottery_list['ssrc_money'] = $ssrc_result['bet_money'];
        $lottery_list['ssrc_win'] = round($ssrc_win,2);
        $lottery_list['ssrc_result'] = $ssrc_result['bet_money'] - $ssrc_win - $ssrc_he;
        $lottery_list['mlaft_count'] = $mlaft_result['bet_count'];
        $lottery_list['mlaft_money'] = $mlaft_result['bet_money'];
        $lottery_list['mlaft_win'] = round($mlaft_win,2);
        $lottery_list['mlaft_result'] = $mlaft_result['bet_money'] - $mlaft_win - $mlaft_he;
        $lottery_list['ts_count'] = $ts_result['bet_count'];
        $lottery_list['ts_money'] = $ts_result['bet_money'];
        $lottery_list['ts_win'] = round($ts_win,2);
        $lottery_list['ts_result'] = $ts_result['bet_money'] - $ts_win - $ts_he;
        $lottery_list['orpk_count'] = $orpk_result['bet_count'];
        $lottery_list['orpk_money'] = $orpk_result['bet_money'];
        $lottery_list['orpk_win'] = round($orpk_win,2);
        $lottery_list['orpk_result'] = $orpk_result['bet_money'] - $orpk_win - $orpk_he;
        $lottery_list['all_count'] = $all_bet_count;
        $lottery_list['all_money'] = $all_bet_money;
        $lottery_list['all_win'] = $all_win_money;
        $lottery_list['all_result'] = $all_bet_money - $all_win_money - $all_he;
        return array($lottery_list);
    }
    /**
     * 查询个彩种下注信息
     */
    public function lotteryUser($gtype,$stime,$etime,$bid,$offset=0,$limit) {
        $userids = $this->_arrayToSql($bid);
        $t_allmoney = $t_sy = $bet_he = 0;
        $lotteryData = OrderLottery::selectUserData($stime,$etime,$gtype,$userids,$offset,$limit);
        $lotteryDatalCount = $lotteryData['count'] == null ? 0 : $lotteryData['count'];
        if(count($lotteryData['data'])>0){
            foreach($lotteryData['data'] as $key=> $v){
                $t_allmoney += round($v['bet_money_total'],2);
                $t_sy += round($v['win_total'],2);
                $bet_he += round($v['bet_he'],2);
            }
        }
        return ['data'=>$lotteryData['data'],'allmoney'=>round($t_allmoney,2),'win_total'=>round($t_sy,2),'bet_he'=>round($bet_he,2),'count'=>$lotteryDatalCount];
    }
    /**
     * @param $s_time
     * @param $ids
     * @return array
     */
    public function lotteryHe($s_time,$e_time,$ids){
        $bet_he = OrderLottery::getHe($s_time,$e_time,'ALL_LOTTERY',$ids);
        if($bet_he == null){
            $bet_he = 0;
        }
        return $bet_he;
    }

    //下注金额 、 下注笔数
    public function lotteryCount($s_time,$e_time,$ids){
        $id = $this->_arrayToSql($ids);
        $lottery = OrderLottery::reportIndex($s_time,$e_time,$id);
        return $lottery;
    }
    /**
     * array----> ('z','w')  db in方法使用
     * @param type $array
     * @return type
     */
    private function _arrayToSql($array) {
        $sql = '';
		if(count($array) > 0){
			foreach ($array as $key => $value) {
				$sql .= '\'' . trim($value) . '\'' . ',';
			}
			$sql = substr($sql, 0, -1);
		}
        return $sql;
    }
    public function TixianDetail($id,$stime,$etime) {
        $lotteryData = OrderLottery::selectTrueMoney($id,$stime,$etime);
        return round($lotteryData,2);

    }
}