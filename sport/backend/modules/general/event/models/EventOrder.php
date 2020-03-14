<?php
namespace app\modules\general\event\models;

use Yii;
use app\modules\core\common\models\UserList;
use app\modules\general\finance\models\MoneyLog;

class EventOrder extends \yii\db\ActiveRecord
{
    static public function getAll($status = 0, $startTime = null, $endTime = null, $qishu = null, $orderNum = null, $userName = null)
    {
        $result = EventOrder::find()
            ->select([
                "o1.*",
                "o2.user_name"
            ])
            ->from("event_order as o1")
            ->innerJoin("user_list as o2", "o1.user_id = o2.user_id");

        if ($status >= 0) {
            $result->andWhere('o1.status = :status', [':status' => $status]);
        }

        if ($startTime) {
            $result->andWhere('o1.bet_time >= :startTime', [':startTime' => $startTime]);
        }

        if ($endTime) {
            $result->andWhere('o1.bet_time <= :endTime', [':endTime' => $endTime]);
        }

        if ($qishu) {
            $result->andWhere('o1.qishu = :qishu', [':qishu' => $qishu]);
        }

        if ($orderNum) {
            $result->andWhere('o1.order_num = :orderNum', [':orderNum' => $orderNum]);
        }

        if ($userName) {
            $result->andWhere('o2.user_name = :user_name', [':user_name' => $userName]);
        }

        $result->orderBy([
            'o1.bet_time' => SORT_DESC,
            'order_num' => SORT_DESC,
        ]);

        return $result;
    }

    static public function cancelOrder($id)
    {
        $eventOrder = EventOrder::findOne(['id' => $id]);
        $refund = 0;    // 退款金額

        if ($eventOrder) {
            $orderNum = $eventOrder->order_num;
            $userId = $eventOrder->user_id;
            $user = UserList::findOne(['user_id' => $userId]);

            if ($user) {
                //修改訂單狀態
                $eventOrder->status = 3;
                $updateOrdrer = $eventOrder->save();

                //修改用户账户余额
                if ($eventOrder->status == 1 || $eventOrder->status == 2) {
                    //如果注单已经结算或者重新结算状态，则需修改金额
                    $refund -= $eventOrder->win_total;
                } else {
                    $refund = $eventOrder->bet_money;
                }

                $updateMoney = UserList::updateMoney($userId, $refund);

                //金额记录
                $moneyLog = MoneyLog::EventCancel($userId, $orderNum, $refund, $user['money'], $user['money'] + $refund);

                if ($updateOrdrer && $updateMoney && $moneyLog) {
                    return true;
                }
            }
        }

        return false;
    }
}
