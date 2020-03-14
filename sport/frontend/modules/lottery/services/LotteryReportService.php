<?php
namespace app\modules\lottery\services;

use app\modules\lottery\models\ar\LotteryServices;
use Yii;

/*
 * lotteryreportservices
 * */
class LotteryReportService{
    public function getWinMoney($startTime,$endTime,$uid){
        $allBetMoney = LotteryServices::getBetCountMoney($startTime,$endTime,$uid);
        $winMoney = LotteryServices::getWin($startTime,$endTime,$uid);
        $profitMoney = $winMoney - $allBetMoney;
        return [
            'allMoney' => round($allBetMoney,2),
            'winMoney' => round($profitMoney,2)
        ];
    }
}