<?php

namespace app\modules\general\agent\models;

use Yii;
use yii\db\ActiveRecord;

class WithdrawalRequestLog extends ActiveRecord
{
    static public function getAll($result = '-1', $startTime = null, $endTime = null, $orderNum = null)
    {
        $list = self::find();

        if ($result != '-1') {
            $list->andWhere('result = :result', [':result' => $result]);
        }

        if ($startTime) {
            $list->andWhere('create_time >= :startTime', [':startTime' => $startTime]);
        }

        if ($endTime) {
            $list->andWhere('create_time <= :endTime', [':endTime' => $endTime]);
        }

        if ($orderNum) {
            $list->andWhere('order_num = :orderNum', [':orderNum' => $orderNum]);
        }

        $list->orderBy([
            'create_time' => SORT_DESC,
            'order_num' => SORT_DESC,
        ]);

        return $list;
    }

    // Status代碼表
    static public function getCodeMessage($arr)
    {
        foreach ($arr as $key1 => $value1) {
            switch ($value1['status']) {
                case '0':

                    break;

                case '9104':
                    $arr[$key1]['message'] = '尚未设置公司钱包';
                    break;

                case '9105':
                    $arr[$key1]['message'] = '余额不足';
                    break;

                case '9106':
                    $arr[$key1]['message'] = '该笔交易重复';
                    break;

                case '9107':
                    $arr[$key1]['message'] = '出金对象钱包地址有误';
                    break;

                case '9108':
                    $arr[$key1]['message'] = 'Hash value无效';
                    break;

                case '9109':
                    $arr[$key1]['message'] = '出金钱包的地址有误';
                    break;

                case '9110':
                    $arr[$key1]['message'] = '应删除存款设置,然后再尝试交易';
                    break;

                case '9111':
                    $arr[$key1]['message'] = '错误的金额';
                    break;

                case '9112':
                    $arr[$key1]['message'] = '时间戳已过期';
                    break;

                case '9998':
                    $arr[$key1]['message'] = '服务器维护中';
                    break;

                case '9999':
                    $arr[$key1]['message'] = '服务器错误';
                    break;
            }
        }
        return $arr;
    }
}
