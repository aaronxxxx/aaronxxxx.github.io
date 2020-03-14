<?php
namespace app\modules\general\mobile\models\ar;

use yii\db\ActiveRecord;

/**
 * PaySet is the model behind the pay_set.
 */
class PaySet extends ActiveRecord{
    
    /**
     * 获取排序id最小且为启用状态，已有金额小于支付额限的数据
     * @return type     数组
     */
    static public function getPaySetByStartAndMoney(){
        $sql = "select * from pay_set where b_start = 1 and money_Already<money_limits order by order_id asc";
        $rows = PaySet::findBySql($sql)->asArray()->all();
        return $rows;
    }
    
    
    /**
     * 获取所有的在线支付信息列表
     * @return type
     */
    static public function getPaySetAll(){
        $sql = "select * from pay_set order by order_id asc";
        $rows = PaySet::findBySql($sql)->asArray()->all();
        return $rows;
    }
    
    /**
     * 获取排序id最小且已有金额小于支付额限并且未启动的数据，更改为为启用状态。
     * @return type     数组
     */
    static public function getPaySetByStartAndMoneyToSave(){
        $sql = "select * from pay_set where b_start != 1 and money_Already<money_limits order by order_id asc limit 1";
        $row = PaySet::findBySql($sql)->one();
        $row->b_start='1';
        $row->save();
        return $row;
    }
    
    /**
     * 获取在线支付数据
     * @param type $payid
     * @return type
     */
    static public function getPaySetById($payid){
        $pay_set = new PaySet;
        $rows_pay = $pay_set->find()
                ->where(['id' => $payid ])
                ->asArray()
                ->one();
        return $rows_pay;
    }
    /**
     * 更新在线支付pay_set表的金额
     * @param type $order_amount            订单金额
     * @param type $merchant_code          有效最高金额
     */
    static public function updateMoneyAleady($order_amount,$merchant_code) {
        $sql = 'update pay_set set money_Already=money_Already+' . $order_amount . ' where pay_id=\'' . $merchant_code . '\'';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }
}

