<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/11
 * Time: 11:13
 */

namespace app\modules\live\services;


use app\common\base\BaseService;
use app\modules\live\models\LiveFsList;
use app\modules\live\models\LiveOrder;

class LiveService extends BaseService
{
    /**
     * 聚合真人返水总金额
     * @param $startTime
     * @param $endTime
     * @return mixed
     */
    public function totalFsMoney($startTime, $endTime) {
        $query = LiveFsList::find()->where(['and',['>=','FSTIME', $startTime],['<=','FSTIME', $endTime]]);
        $total = $query->sum('FSMONEY');
        return $total == null ? 0 : $total;
    }

    /**
     * 查询用户有效的下注总金额
     * @param $userId
     * @param $startTime
     * @param $endTime
     */
    public function totalBetMoney($userId, $startTime, $endTime) {
        $query = LiveOrder::find()->leftJoin('live_user', 'live_order.live_username = live_user.live_username')->where([
            'and', ['=', 'live_user.user_id', $userId], ['!=', 'live_order.bet_money', 0], ['>=','live_order.order_time', $startTime], ['<=','live_order.order_time', $endTime]
        ]);
        $total = $query->sum('live_order.bet_money');
        return $total == null ? 0 : $total;
    }

}