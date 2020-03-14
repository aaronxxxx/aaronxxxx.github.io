<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\dataset\controllers;

use app\common\base\BaseController;
use Exception;
use Yii;

class CleanController extends BaseController
{

    public function actionIndex() {
        $this->layout = false;
        $startTime = date('Y-m-d',strtotime('-30 day'));
        $endTime = date('Y-m-d');
        return $this->render("index", [
            'startTime' => $startTime,
            'endTime' => $endTime
        ]);
    }

    public function actionStart() {
        $startTime = Yii::$app->request->post('startTime');
        $endTime = Yii::$app->request->post('endTime');
        if($startTime) {
            $startTime = $startTime." 00:00:00";
        } else {
            return $this->out(false, "开始时间不能为空".$startTime);
        }
        if($endTime) {
            $endTime = $endTime." 23:59:59";
        } else {
            return $this->out(false, "结束时间不能为空");
        }
        try {
            $connection = Yii::$app->db;
            $command = $connection->createCommand('DELETE FROM agents_money_log WHERE do_time<=:startTime or do_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM history_bank WHERE addtime<=:startTime or addtime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM history_login WHERE login_time<=:startTime or login_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM live_fs_list WHERE fstime<=:startTime or fstime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM live_log WHERE do_time<=:startTime or do_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM live_order WHERE order_time<=:startTime or order_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_bjkn WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_bjpk WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_cq WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_cqsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_d3 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_gd11 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_gdsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_gxsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_lhc WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_p3 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_t3 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_tj WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_tjsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM money WHERE update_time<=:startTime or update_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM money_log WHERE update_time<=:startTime or update_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE order_lottery,order_lottery_sub FROM order_lottery,order_lottery_sub WHERE order_lottery.order_num=order_lottery_sub.order_num and (order_lottery.bet_time<=:startTime or order_lottery.bet_time>=:endTime)');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE six_lottery_order,six_lottery_order_sub FROM six_lottery_order,six_lottery_order_sub WHERE six_lottery_order.order_num=six_lottery_order_sub.order_num and (six_lottery_order.bet_time<=:startTime or six_lottery_order.bet_time>=:endTime)');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM pay_error_log WHERE update_time<=:startTime or update_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM six_lottery_log WHERE create_time<=:startTime or create_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM sys_announcement WHERE end_time<=:startTime or end_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM user_log WHERE edtime<=:startTime or edtime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM user_msg WHERE msg_time<=:startTime or msg_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM six_lottery_log WHERE create_time<=:startTime or create_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            return $this->out(true, "操作成功");
        } catch (Exception $e) {
            return $this->out(false, "操作失败");
        }
    }

}