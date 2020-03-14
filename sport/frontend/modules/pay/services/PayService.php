<?php

namespace app\modules\pay\services;

use Yii;
use app\common\base\BaseService;
use app\modules\pay\models\Money;
use app\modules\pay\models\MoneyLog;
use app\modules\pay\models\PaySet;
use app\modules\pay\models\DepositCallback;
use app\modules\pay\models\WithdrawalCallback;
use app\modules\pay\models\AgentsCash;
class PayService extends BaseService
{
    /*
		payment init
		wait modify later
	*/
    public function begin()
    { }

    /**
     * 获取pay_set表信息
     * @param $pay_type
     * @param int $submit_type
     * @return array
     */
    public function getPayNews($pay_type, $submit_type = 0)
    {
        $arr = [];
        $config = PaySet::find()
            ->where('pay_type=:pay_type', [':pay_type' => $pay_type])
            ->andWhere('submit_type=:submit_type', [':submit_type' => $submit_type])
            ->andWhere(['b_start' => 1])->asArray()->all();
        foreach ($config as $key => $value) {
            if ($value['money_limits'] > $value['money_Already']) {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    /**
     * 获取会员ID，会员名，会员余额
     * @param $user_id          会员ID
     * @return array|false      false：失败，array：成功
     */
    public function getUserNewsByUserid($user_id)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "select user_id,user_name,money from user_list where user_id=:user_id limit 1";
            $command = $connection->createCommand($sql);
            $command->bindParam(':user_id', $user_id);
            $user_list = $command->queryOne();
            return $user_list;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }
    /**
     * 获取会员ID，会员名，会员余额
     * @param $user_name        会员名
     * @return array|false      false：失败，array：成功
     */
    public function getUserNewsByUsername($user_name)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "select user_id,user_name,money from user_list where user_name=:user_name limit 1";
            $command = $connection->createCommand($sql);
            $command->bindParam(':user_name', $user_name);
            $user_list = $command->queryOne();
            return $user_list;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }
    /**
     * 添加原始订单
     * @param $arr          订单所需数据（数组）
     * @return bool|int     true：成功，false:失败
     */
    public function addOrder($arr)
    {
        try {
            $money = new Money();
            $money->user_id = $arr['user_id'];
            $money->order_num = $arr['order_num'];
            $money->status = $arr['status'];
            $money->about = $arr['about'];
            $money->update_time = date('Y-m-d H:i:s');
            $money->pay_card = $arr['pay_card'];
            $money->pay_num = $arr['pay_num'];
            $money->pay_address = $arr['pay_address'];
            $money->type = $arr['type'];
            $money->pay_name = $arr['pay_name'];
            $money->sxf = $arr['sxf'];
            $money->order_value = $arr['order_value'];
            $money->zsjr = $arr['zsjr'];
            $money->assets = $arr['assets'];
            $money->balance = $arr['balance'];
            $money->date = $arr['date'];
            $r = $money->save();
            return $r;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 查询订单
     * @param $order_num                    订单号
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    public function selectOrder($order_num)
    {
        try {
            $r = Money::find()->where('order_num=:order_num', [':order_num' => $order_num])->asArray()->one();
            return $r;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 更新会员金额
     * @param $totalAmount
     * @param $odds
     * @param $user_id          会员ID
     * @return bool|int         false:失败
     */
    public function updateUserMoney($money, $user_id)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "update user_list set money= money+:money where user_id=:user_id";
            $command = $connection->createCommand($sql);
            $command->bindParam(':money', $money);
            $command->bindParam(':user_id', $user_id);
            $user_list = $command->execute();
            return $user_list;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 更新代理金额
     * @param $totalAmount      出款金额
     * @param $id               代理ID
     * @return bool|int         false:失败
     */
    public function updateAgentsMoney($money, $agents_id)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "update agents_list set money= money+:money where id=:agents_id";
            $command = $connection->createCommand($sql);
            $command->bindParam(':money', $money);
            $command->bindParam(':agents_id', $agents_id);
            $result = $command->execute();
            return $result;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 更新代理出金订单
     * @param array $params
     * @return bool|int         false:失败
     */
    public function updateAgentsCash($params)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "update agents_cash set status=:status, modify_time=:modify_time where id=:id";
            $command = $connection->createCommand($sql);
            $command->bindParam(':status', $params['status']);
            $command->bindParam(':modify_time', $params['modify_time']);
            $command->bindParam(':id', $params['order_id']);
            $result = $command->execute();
            return $result;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 更新订单表
     * @param $arr          订单参数
     * @return bool|int     false:失败
     */
    public function updateOrder($arr)
    {
        try {
            $update_time = date('Y-m-d H:i:s');
            $connection = Yii::$app->db;
            /*
            $sql = "update money set `status`='成功',`about`=:about,`update_time`='$update_time',type='在线支付',order_value=:order_value,
            `assets`=:assets,`balance`=:balance,`date`=:order_time where user_id=:user_id and order_num=:order_num";
            $command = $connection->createCommand($sql);
            $command->bindParam(':about', $arr['about']);
            $command->bindParam(':order_value', $arr['order_value']);
            $command->bindParam(':assets', $arr['assets']);
            $command->bindParam(':balance', $arr['balance']);
            $command->bindParam(':order_time', $arr['order_time']);
            $command->bindParam(':user_id', $arr['user_id']);
            $command->bindParam(':order_num', $arr['order_num']);
			*/

            $field_array = [
                "type = '在线支付'",
                "status = '成功'",
                "update_time = '$update_time'"
            ];
            foreach ($arr as $key1 => $value1) {
                if (!in_array($key1, array('user_id', 'order_num'))) {
                    $field_array[] = $key1 . " = '" . $value1 . "'";
                }
            }

            $sql = "update
						money
					set
						" . implode(',', $field_array) . "
					where
						order_num = :order_num";
            $command = $connection->createCommand($sql);
            $command->bindParam(':order_num', $arr['order_num']);
            $user_list = $command->execute();

            return $user_list;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 添加金额日志
     * @param $arr      添加的信息
     * @return bool     false:失败
     */
    public function addMoneyLog($arr)
    {
        try {
            $moneylog = new MoneyLog();
            $moneylog->user_id = $arr['user_id'];
            $moneylog->order_value = $arr['order_value'];
            $moneylog->order_num = $arr['order_num'];
            $moneylog->update_time = $arr['update_time'];
            $moneylog->about = $arr['about'];
            $moneylog->type = $arr['type'];
            $moneylog->assets = $arr['assets'];
            $moneylog->balance = $arr['balance'];
            $r = $moneylog->save();
            return $r;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 儲存充值回調          儲存的信息
     * @param $arr      
     * @return bool     false:失败
     */
    public function savaDepositCallback($arr)
    {
        try {
            $callbacklog = new DepositCallback();
            $callbacklog->content = $arr['content'];
            $callbacklog->order_num = $arr['order_num'];
            $callbacklog->create_time = $arr['create_time'];
            $result = $callbacklog->save();
            return $result;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 儲存提現回調          儲存的信息
     * @param $arr      
     * @return bool     false:失败
     */
    public function savaWithdrawalCallback($arr)
    {
        try {
            $callbacklog = new WithdrawalCallback();
            $callbacklog->content = $arr['content'];
            $callbacklog->create_time = $arr['create_time'];
            $result = $callbacklog->save();
            return $result;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     * 取得出入金匯率
     * @param $string   $mode  in_rate or out_rate 
     * @return bool     false:失败
     */
    public function getRate($mode)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "select $mode from sys_config where id = 1";
            $command = $connection->createCommand($sql);
            $rate = $command->queryOne();
            return $rate;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     *取得会员虚拟币交易种类
     * @param $string   $user_name 会员名称     
     * @return bool     false:失败
     */
    public function getTradeType($user_name)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "select trade_type from user_list where user_name = :user_name";
            $command = $connection->createCommand($sql);
            $command->bindParam(':user_name', $user_name);
            $result = $command->queryOne();
            if (empty($result)) {
                return '查无此会员';
            }

            if ($result['trade_type'] == '1') {
                $trade_type = 'USDT';
                return $trade_type;
            }
            else if ($result['trade_type'] == '2') {
                $trade_type = 'ETH_USDT';
                return $trade_type;
            }
            else {
                return $result['trade_type'];
            }
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     *查询代理出金订单资讯
     * @param $string   订单号     
     * @return bool     false:失败
     */
    public function findAgentsOrder($ordernum)
    {
        try {
            $orderinfo = AgentsCash::find()->where(['order_num' => $ordernum])->asArray()->one();
            if (empty($orderinfo)) {
                return false;
            }
            return $orderinfo;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    /**
     *查询代理资讯
     * @param $string   订单号     
     * @return bool     false:失败
     */
    public function findAgentsInfo($id)
    {
        try {
            $connection = Yii::$app->db;
            $sql = "select id,agents_name,status,money from agents_list where id = :id";
            $command = $connection->createCommand($sql);
            $command->bindParam(':id', $id);
            $agentsinfo = $command->queryOne();
            if (empty($agentsinfo)) {
                return false;
            }
            return $agentsinfo;
        } catch (\yii\db\Exception $e) {
            return false;
        }
    }

    public function test()
    {
        return '成功调用服务';
    }
}
