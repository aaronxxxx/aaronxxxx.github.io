<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/10
 * Time: 10:28
 */

namespace app\modules\general\finance\services;


use app\common\base\BaseService;
use app\modules\general\finance\models\Money;
use RuntimeException;
use yii\helpers\ArrayHelper;

/**
 * Money金额操作接口
 * Class MoneyService
 * @package app\modules\general\finance\services
 */
class MoneyService extends BaseService
{
    /**
     * 新增money记录
     * @param $modelArray [
     *      user_id:用户id 必填
     *      order_num:单号 必填
     *      order_value:订单金额 必填
     *      assets:当前用户金额 必填
     *      status:状态
     *      about:备注
     *      update_time:更新时间
     *      pay_name:支付名称
     *      pay_card:支付卡
     *      pay_num:支付卡号
     *      pay_address:支付地址
     *      type:支付类型
     *      sxf:手续费
     *      manner:汇款方式
     *      zsjr:赠送金额
     *      date:汇款时间
     * ]
     */
    public static function saveMoney($modelArray) {
        if(ArrayHelper::getValue($modelArray, 'user_id', '') == '') {
            throw new RuntimeException("user_id不能为空");
        }
        if(ArrayHelper::getValue($modelArray, 'order_num', '') == '') {
            throw new RuntimeException("order_num不能为空");
        }
        if(ArrayHelper::getValue($modelArray, 'order_value', '') == '') {
            throw new RuntimeException("order_value不能为空");
        }
        if(ArrayHelper::getValue($modelArray, 'assets', '') == '') {
            throw new RuntimeException("assets不能为空");
        }
        $money = new Money();
        $money->user_id = ArrayHelper::getValue($modelArray, 'user_id');
        $money->order_num = ArrayHelper::getValue($modelArray, 'order_num');
        $money->order_value = ArrayHelper::getValue($modelArray, 'order_value');
        $money->assets = ArrayHelper::getValue($modelArray, 'assets');
        $money->balance = $money->order_value + $money->assets;
        $money->status = ArrayHelper::getValue($modelArray, 'status', '未结算');
        $money->pay_card = ArrayHelper::getValue($modelArray, 'pay_card', '');
        $money->pay_name = ArrayHelper::getValue($modelArray, 'pay_name', '');
        $money->pay_num = ArrayHelper::getValue($modelArray, 'pay_num', '');
        $money->pay_address = ArrayHelper::getValue($modelArray, 'pay_address', '');
        $money->about = ArrayHelper::getValue($modelArray, 'about', '');
        $money->type = ArrayHelper::getValue($modelArray, 'type', '在线支付');
        $money->sxf = ArrayHelper::getValue($modelArray, 'sxf', 0.00);
        $money->manner = ArrayHelper::getValue($modelArray, 'manner', null);
        $money->zsjr = ArrayHelper::getValue($modelArray, 'zsjr', 0.00);
        $money->date = ArrayHelper::getValue($modelArray, 'date', null);
        $money->update_time = date("Y-m-d H:i:s");
        $money->save();
    }

    /**
     * 根据条件获取所有金额记录
     * @param $type string|array
     * @param $status string|array
     * @param $startTime
     * @param $endTime
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findAllMoneyByTypeAndStatus($type, $status, $startTime, $endTime) {
        $query = Money::find()->where(['and', ['type'=> $type], ['status'=> $status], ['>=', 'update_time', $startTime], ['<=', 'update_time', $endTime]]);
        return $query->orderBy('id desc')->asArray()->all();
    }

    /**
     * 根据条件聚合交易总金额
     * @param $userId
     * @param $type string|array
     * @param $startTime
     * @param $endTime
     * @param $isActivity bool
     * @return mixed
     */
    public static function totalOrderValueByUserIdAndType($userId, $type, $startTime, $endTime, $isActivity = true) {
        $query = Money::find()->where(['and', ['user_id'=>$userId], ['type'=>$type], ['>=', 'update_time', $startTime], ['<=', 'update_time', $endTime], ['status'=> '成功']]);
        if($isActivity) {
            $query->andWhere(['and', ['like', 'about', '用于活动']]);
        } else {
            $query->andWhere(['and', ['not like', 'about', '用于活动']]);
        }
        $total = $query->sum('order_value');
        return $total == null ? 0 : $total;
    }

    public static function moneyFilter($startTime, $endTime, $isActivity = true) {
        $query = Money::find();
        if($isActivity) {
            $query->select(new \yii\db\Expression("user_id,
            SUM( IF ( type = '在线支付' || type = '后台充值', order_value, 0 ) ) AS ck_money_ht,
            SUM( IF ( type = '用户提款' || type = '后台扣款', order_value, 0 ) ) AS tk_money_ht "));
            $query->Where(['and', ['like', 'about', '用于活动']]);
        } else {
            $query->select(new \yii\db\Expression("user_id,
            SUM( IF ( type = '在线支付' || type = '后台充值', order_value, 0 ) ) AS ck_money,
            SUM( IF ( type = '银行汇款', order_value, 0 ) ) AS hk_money,
            SUM( IF ( type = '用户提款' || type = '后台扣款', order_value, 0 ) ) AS tk_money,
            SUM( order_value ) AS win_money "));
            $query->Where(['and', ['not like', 'about', '用于活动']]);
        }
        $query->andwhere(['and', ['>=', 'update_time', $startTime], ['<=', 'update_time', $endTime], ['status'=> '成功']]);
        $query->groupBy('user_id');
        // $total = $query->sum('order_value');
        return $query;
    }
}