<?php

namespace app\modules\general\agent\services;

use Yii;
use app\common\base\BaseService;
use app\modules\general\agent\models\AgentsCash;
use app\modules\general\agent\models\WithdrawalRequestLog;

class TransactionService extends BaseService
{
    // 取得未审核订单资讯
    public function getAgentsCash($id)
    {
        $agentsCash = AgentsCash::find()->where(['id' => $id, 'status' => '0'])->asArray()->one();

        if (empty($agentsCash)) {
            return false;
        }

        return $agentsCash;
    }

    // 向API发起出金交易
    public function virtualCurrencyWithdrawal($params)
    {
        if ($params['type'] == '04') {
            $params['type'] = 'USDT';
        } else if ($params['type'] == '05') {
            $params['type'] = 'ETH_USDT';
        } else {
            return '非虛擬幣出金交易';
        }

        $hashKey = '7e8f481e-2221-4501-9f82-9960afb71b96';
        $authorization = '8b8d5aa0-008f-49de-83c7-73cec6f778b4';
        $postUrl = 'http://api-trading.git4u.net:63344/Wallet/Withdrawal';

        $data = array(
            'uID' => trim($params['agents_name']),
            'coinName' => $params['type'],
            'destAddress' => trim($params['account']),
            'amount' => $params['money'],
            'transID' => $params['order_num'],
            'timestamp' => time()
        );

        $data['hashValue'] = TransactionService::buildHashValue($data, $hashKey);
        $result = TransactionService::curlPost($postUrl, $data, $authorization);

        // curl傳輸錯誤
        if (empty($result)) {
            $arr = [
                'status' => '1001',
                'response' => 'curl error'
            ];
            return $arr;
        }

        // 交易請求不成功
        if ($result['status'] != 0) {
            $arr = [
                'status' => '1002',
                'response' => $result
            ];
            return $arr;
        }

        // 提現失敗
        if (!$result['data']['result']) {
            $arr = [
                'status' => '1003',
                'response' => $result
            ];
            return $arr;
        }

        $arr = [
            'status' => '1000',
            'response' => $result
        ];
        return $arr;
    }

    // 儲存交易返回的資訊
    public function saveWithdrawalLog($arr, $order_num)
    {
        $jsonlog = json_encode($arr);
        try {
            $responselog = new WithdrawalRequestLog();
            $responselog->json_content = $jsonlog;
            $responselog->order_num = $order_num;
            $responselog->status = $arr['status'];
            if (empty($arr['data'])) {
                $responselog->result = 0;
            } else {
                $responselog->result = $arr['data']['result'];
            }
            $responselog->message = $arr['message'];
            $responselog->create_time = date('Y-m-d h:i:s');
            $result = $responselog->save();
            return $result;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    // 更新出金订单
    public function updateOrder($id, $status, $withdrawal_number)
    {
        $modify_time = date('Y-m-d h:i:s');

        try {
            $connection = Yii::$app->db;

            if ($withdrawal_number) {
                $sql = "update agents_cash set status=:status, withdrawal_number=:withdrawal_number, modify_time=:modify_time where id=:id";
            } else {
                $sql = "update agents_cash set status=:status, modify_time=:modify_time where id=:id";
            }

            $command = $connection->createCommand($sql);
            $command->bindParam(':status', $status);

            if ($withdrawal_number) {
                $command->bindParam(':withdrawal_number', $withdrawal_number);
            }

            $command->bindParam(':modify_time', $modify_time);
            $command->bindParam(':id', $id);
            $result = $command->execute();

            return $result;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    private function buildHashValue($data, $key)
    {
        $hashStr = strtolower($data['transID']) . strtolower($data['coinName']) . sprintf("%.8f", $data['amount']) . strtolower($data['destAddress']) . $data['timestamp'] . $key;
        $hashValue = base64_encode(hash('sha256', $hashStr, true));
        return substr($hashValue, 0, 20);
    }

    private function curlPost($url, $data, $authorization)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_HEADER, false);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json; charset=utf-8',
            'Accept: application/json',
            'Authorization: bearer ' . $authorization
        ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ', curl_error($ch), "\n";
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        return json_decode($result, true);
    }
}
