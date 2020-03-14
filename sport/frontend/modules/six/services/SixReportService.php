<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 16:05
 */
namespace app\modules\six\services;
use app\modules\six\models\SixLotteryOrder;

/**
 * 盈利统计
 */
class SixReportService{
    /**
     * @param $startTime开始时间
     * @param $endTime 结束时间
     * @param $userId 用户id
     * return 一个数组  profit 盈利金额  bet_money_total有效下注金额
     */
    public function SixLotteryProfit($startTime,$endTime,$userId){
           //获取总的中奖金额与反水金额
            $data = SixLotteryOrder::getProfit($startTime,$endTime,$userId);
            //获取有效下注总金额
            $result=SixLotteryOrder::getOrderValid($startTime,$endTime,$userId);
            $result['profit'] = $data['win_total']- $result['bet_money_total'];//利润
            return $result;
    }
}