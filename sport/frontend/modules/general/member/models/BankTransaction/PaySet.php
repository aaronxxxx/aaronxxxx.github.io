<?php
namespace app\modules\general\member\models\BankTransaction;

use Yii;
use yii\db\ActiveRecord;

/**
 * PaySet is the model behind the pay_set.
 */
class PaySet extends ActiveRecord{
    /**
     * 更新在线支付pay_set表的金额
     * @param type $order_amount            订单金额
     * @param type $merchant_code          有效最高金额
     */
    public static function updateMoneyAleady($order_amount,$merchant_code) {
        $sql = 'update pay_set set money_Already=money_Already+' . $order_amount . ' where pay_id=\'' . $merchant_code . '\'';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }
    /**
     * 获取排序id最小且为启用状态，已有金额小于支付额限的数据
     * @return type     数组
     */
	public static function getPaySetByStartAndMoney($groupID = null){
        if($groupID !='null'){
            $sql = "select * from pay_set where b_start = 1 and money_Already < money_limits and group_set like '%|".$groupID."|%' group by pay_type order by order_id asc ,id ASC ";
        } else {
            $sql = "select * from pay_set where b_start = 1 and money_Already < money_limits group by pay_type order by order_id asc ,id ASC ";
        }
		$rows = PaySet::findBySql($sql)->asArray()->all();
		return $rows;
	}
    
    
    /**
     * 获取所有的在线支付信息列表
     * @return type
     */
    public static function getPaySetAll(){
        $sql = "select * from pay_set order by order_id asc";
        $rows = PaySet::findBySql($sql)->asArray()->all();
        return $rows;
    }
    
    /**
     * 获取排序id最小且已有金额小于支付额限并且未启动的数据，更改为为启用状态。
     * @return type     数组
     */
    public static function getPaySetByStartAndMoneyToSave(){
        $sql = "update pay_set set b_start = 1 where b_start != 1 and money_Already<money_limits order by order_id asc limit 1";
        $row = yii::$app->db->createCommand($sql)->execute();
        return $row;
    }
    
    /**
     * 获取在线支付数据
     * @param type $payid
     * @return type
     */
    public static function getPaySetById($payid){
        $pay_set = new PaySet;
        $rows_pay = $pay_set->find()
                ->where(['id' => $payid ])
                ->asArray()
                ->one();
        return $rows_pay;
    }

}

