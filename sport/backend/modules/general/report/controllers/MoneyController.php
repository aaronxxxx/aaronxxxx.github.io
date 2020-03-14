<?php

namespace app\modules\general\report\controllers;

use app\common\base\BaseController;
use app\common\services\ServiceFactory;
use app\modules\general\finance\services\MoneyService;

/*
 * 金额明细
 */

class MoneyController extends BaseController {

    public function init() {
        parent::init();
        $this->layout = false;
    }

    public function actionIndex() {
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $money['yyhh'] = $money['zzck'] = $money['yhtk'] = $money['zsjr'] = $money['sxf1'] = $money['sxf2'] = 0;

        //银行汇款开始
        $yyhh_result = MoneyService::findAllMoneyByTypeAndStatus('银行汇款', '成功', $time['s_time'], $time['e_time']);
        foreach ($yyhh_result as $key => $value) {
            $money['yyhh'] +=$value['order_value'];
            $money['zsjr'] += $value['zsjr'];
        }

        //银行汇款结束
        //在线存款开始
        $zzck_result = MoneyService::findAllMoneyByTypeAndStatus('在线支付', '成功', $time['s_time'], $time['e_time']);
        foreach ($zzck_result as $key => $value) {
            $money['zzck'] +=$value['order_value'];
            $money['sxf1'] += $value['sxf'];
        }
        //在线存款结束
        //会员取款开始
        $yhtk_result = MoneyService::findAllMoneyByTypeAndStatus('用户提款', '成功', $time['s_time'], $time['e_time']);
        foreach ($yhtk_result as $key => $value) {
            $money['yhtk'] +=$value['order_value'];
            $money['sxf2'] += $value['sxf'];
        }
        $money['yhtk'] = -$money['yhtk'];
        //会员取款结束
        //反水计算开始
        $service = ServiceFactory::get('live', 'liveService');
        $money['fs'] = $service->totalFsMoney($time['s_time'], $time['e_time']);
        return $this->render('index', [
            'time' => $time,
            'money'=>$money
        ]);
    }

}
