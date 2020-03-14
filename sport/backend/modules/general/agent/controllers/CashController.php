<?php
namespace app\modules\general\agent\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\agent\models\AgentsCash;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\services\TransactionService;
use app\modules\general\agent\models\WithdrawalRequestLog;

class CashController extends BaseController
{
    public $type = [];
    public $status = [];
    public $pageSize;

    public function init()
    {
        parent::init();

        $this->layout = false;

        $this->pageSize = 20;

        $this->type = [
            '01' => '銀行1',
            '02' => '銀行2',
            '03' => '銀行3',
            '04' => 'USDT',
            '05' => 'ETH_USDT'
        ];

        $this->status = [
            0 => '未審核',
            1 => '已審核',
            2 => '已作废',
            3 => '转款中',
            -1 => '交易請求失敗',
            -2 => '提現失敗'
        ];
    }

    public function actionIndex()
    {
        $agentsCash = AgentsCash::find()->orderBy([
            'order_num' => SORT_DESC
        ]);

        $pages = new Pagination([
            'totalCount' => $agentsCash->count(),
            'pageSize' => $this->pageSize
        ]);
        $list = $agentsCash
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        return $this->render('index', [
            'list' => $list,
            'pages' => $pages,
            'type' => $this->type,
            'status' => $this->status
        ]);
    }

    // 審核
    public function actionConfirm()
    {
		$id = $this->getParam('id', -1000);
        $agentsCash = TransactionService::getAgentsCash($id);

        if (empty($agentsCash)) {
            return $this->out(false, '查无资料或申请已作废');
        }

        switch ($agentsCash['type']) {
            case '04':
            case '05':
                $withdrawal_request = TransactionService::virtualCurrencyWithdrawal($agentsCash);

                switch ($withdrawal_request['status']) {
                    case '1000':
                        $save_withdrawal_log = TransactionService::saveWithdrawalLog($withdrawal_request['response'], $agentsCash['order_num']);
                        $update_order = TransactionService::updateOrder($id, 3, $withdrawal_request['response']['data']['id']);

                        break;
                    case '1001':    // curl傳輸錯誤
                        return $this->out(false, $withdrawal_request['response']);
                    case '1002':    // 交易請求不成功
                        $save_withdrawal_log = TransactionService::saveWithdrawalLog($withdrawal_request['response'], $agentsCash['order_num']);
                        $update_order = TransactionService::updateOrder($id, -1, false);

                        if (empty($update_order)) {
                            return $this->out(false, $withdrawal_request['response']['status'] . '  ' . $withdrawal_request['response']['message'] . ',更新订单失败');
                        }

                        return $this->out(false, $withdrawal_request['response']['status'] . '  ' . $withdrawal_request['response']['message']);
                    case '1003':    // 提現失敗
                        $save_withdrawal_log = TransactionService::saveWithdrawalLog($withdrawal_request['response'], $agentsCash['order_num']);
                        $update_order = TransactionService::updateOrder($id, -2, false);

                        if (empty($update_order)) {
                            return $this->out(false, '提現失敗,更新订单失败');
                        }

                        return $this->out(false, '提現失敗');
                    default:
                        break;
                }

                if (empty($update_order)) {
                    return $this->out(false, '更新订单失败');
                }

                break;
            default:
                return $this->out(false, '尚无此转帐服务');
                break;
        }

        return $this->out(true, '审核成功');
    }

    // 作廢
    public function actionCancel()
    {
		$id = $this->getParam('id', -1000);
        $agentsCash = AgentsCash::findOne(['id' => $id]);

        if ($agentsCash) {
            $agentsCash->status = 2;

			if ($agentsCash->save()) {
				return $this->out(true , '作廢成功');
			}
        }

        return $this->out(false , '作廢失败');
    }

    // 刪除
    public function actionDelete()
    {
		$id = $this->getParam('id', -1000);
        $agentsCash = AgentsCash::findOne(['id' => $id]);

        if ($agentsCash) {
			if ($agentsCash->delete()) {
				return $this->out(true , '删除成功');
			}
        }

        return $this->out(false , '删除失败');
    }

    public function actionLog()
    {
        $data['result'] = $this->getParam('result', '');
        $data['startTime'] = $this->getParam('startTime', '');
        $data['endTime'] = $this->getParam('endTime', '');
        $data['orderNum'] = $this->getParam('orderNum', '');

        $requestLog = WithdrawalRequestLog::getAll($data['result'], $data['startTime'], $data['endTime'], $data['orderNum']);

        $pages = new Pagination([
            'totalCount' => $requestLog->count(),
            'pageSize' => $this->pageSize
        ]);
        $log = $requestLog
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

        $list = WithdrawalRequestLog::getCodeMessage($log);
        
        return $this->render('log', [
            'pages' => $pages,
			'list' => $list,
            'result' => $data['result'],
			'startTime' => $data['startTime'],
			'endTime' => $data['endTime'],
            'orderNum' => $data['orderNum']
        ]);
    }
}
