<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/10
 * Time: 10:28
 */

namespace app\modules\general\finance\services;


use app\common\base\BaseService;
use app\modules\finance\models\Money;
use RuntimeException;
use yii\helpers\ArrayHelper;

/**
 * Money金額操作接口
 * Class MoneyService
 * @package app\modules\general\finance\services
 */
class MoneyService extends BaseService
{
    /**
     * 新增money記錄
     * @param $modelArray [
     *      user_id:用戶id 必填
     *      order_num:單號 必填
     *      order_value:訂單金額 必填
     *      assets:當前用戶金額 必填
     *      status:狀態
     *      about:備註
     *      update_time:更新時間
     *      pay_name:支付名稱
     *      pay_card:支付卡
     *      pay_num:支付卡號
     *      pay_address:支付地址
     *      type:支付類型
     *      sxf:手續費
     *      manner:匯款方式
     *      zsjr:贈送金額
     *      date:匯款時間
     * ]
     */
    public function saveMoney($modelArray) {
        if(ArrayHelper::getValue($modelArray, 'user_id', '') == '') {
            throw new RuntimeException("user_id不能為空");
        }
        if(ArrayHelper::getValue($modelArray, 'order_num', '') == '') {
            throw new RuntimeException("order_num不能為空");
        }
        if(ArrayHelper::getValue($modelArray, 'order_value', '') == '') {
            throw new RuntimeException("order_value不能為空");
        }
        if(ArrayHelper::getValue($modelArray, 'assets', '') == '') {
            throw new RuntimeException("assets不能為空");
        }
        $money = new Money();
        $money->user_id = ArrayHelper::getValue($modelArray, 'user_id');
        $money->order_num = ArrayHelper::getValue($modelArray, 'order_num');
        $money->order_value = ArrayHelper::getValue($modelArray, 'order_value');
        $money->assets = ArrayHelper::getValue($modelArray, 'assets');
        $money->balance = $money->order_value + $money->assets;
        $money->status = ArrayHelper::getValue($modelArray, 'status', '未結算');
        $money->pay_card = ArrayHelper::getValue($modelArray, 'pay_card', '');
        $money->pay_name = ArrayHelper::getValue($modelArray, 'pay_name', '');
        $money->pay_num = ArrayHelper::getValue($modelArray, 'pay_num', '');
        $money->pay_address = ArrayHelper::getValue($modelArray, 'pay_address', '');
        $money->about = ArrayHelper::getValue($modelArray, 'about', '');
        $money->type = ArrayHelper::getValue($modelArray, 'type', '在線支付');
        $money->sxf = ArrayHelper::getValue($modelArray, 'sxf', 0.00);
        $money->manner = ArrayHelper::getValue($modelArray, 'manner', null);
        $money->zsjr = ArrayHelper::getValue($modelArray, 'zsjr', 0.00);
        $money->date = ArrayHelper::getValue($modelArray, 'date', null);
        $money->update_time = date("Y-m-d H:i:s");
        $money->save();
    }

    /**
     * 根據筆件獲取所有金額記錄
     * @param $type string|array
     * @param $status string|array
     * @param $startTime
     * @param $endTime
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findAllMoneyByTypeAndStatus($type, $status, $startTime, $endTime) {
        $query = Money::find()->where(['and', ['type'=> $type], ['status'=> $status], ['>=', 'update_time', $startTime], ['<=', 'update_time', $endTime]]);
        return $query->orderBy('id desc')->asArray()->all();
    }

    /**
     * 根據筆件聚合交易總金額
     * @param $userId
     * @param $type string|array
     * @param $startTime
     * @param $endTime
     * @param $isActivity bool
     * @return mixed
     */
    public function totalOrderValueByUserIdAndType($userId, $type, $startTime, $endTime, $isActivity = true) {
        $query = Money::find()->where(['and', ['user_id'=>$userId], ['type'=>$type], ['>=', 'update_time', $startTime], ['<=', 'update_time', $endTime], ['status'=> '成功']]);
        if($isActivity) {
            $query->andWhere(['and', ['like', 'about', '用於活動']]);
        } else {
            $query->andWhere(['and', ['not like', 'about', '用於活動']]);
        }
        $total = $query->sum('order_value');
        return $total == null ? 0 : $total;
    }
}