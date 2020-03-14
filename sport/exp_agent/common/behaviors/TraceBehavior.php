<?php

namespace app\common\behaviors;

use app\common\helpers\LogUtils;
use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\log\DbTarget;
use yii\log\Logger;

/**
 * Class TraceBehavior
 * @package app\common\behaviors
 */
class TraceBehavior extends Behavior
{
    const EVENT_TRACE_ACTION = 'traceAction';
    const FILTER_ROUTE = [
        //会员管理
        "member/index", "member/user-log/list", "member/group", "member/historybank/list", "member/hacker/index",
        //彩票注单管理
        "lotteryorder/index", "lotteryorder/index/lotteryuser",
        //彩票结果管理
        "lotteryresult/ssc/list", "lotteryresult/cqsfc/list", "lotteryresult/bjpk10/list", "lotteryresult/bjkl8/list", "lotteryresult/tjsfc/list", "lotteryresult/gd11/list", "lotteryresult/gdsfc/list", "lotteryresult/ball3/list", "lotteryresult/gxsfc/list", "lotteryresult/ball3/list",
        //彩票赔率管理
        "lotteryodds/cqssc/index", "lotteryodds/cqsf/index", "lotteryodds/pk10/index", "lotteryodds/kl8/index", "lotteryodds/tjssc/index", "lotteryodds/tjsf/index", "lotteryodds/gd11/index", "lotteryodds/gdsf/index", "lotteryodds/shssl/index", "lotteryodds/gxsf/index", "lotteryodds/fc3d/index", "lotteryodds/pl3/index", "lotteryodds/default/index", "lotteryodds/default/money-set",
        //六合彩管理
        "six/index/index", "six/index/order", "six/index/result", "six/index/qishu", "six/odds/liangmian", "six/index/tema",
        //极速六合彩管理
        "spsix/index/index", "spsix/index/order", "spsix/index/result", "spsix/index/qishu", "spsix/odds/liangmian", "spsix/index/tema",
        //真人管理
        "live/order", "live/egame", "live/order/moneyonly", "live/user", "live/log", "live/fs",
        //代理管理
        "agent/index/list", "agent/report/index", "agent/cqk/index",
        //消息管理
        "message/bulletin/index", "message/user/index", "message/bulletin/list", "message/register/index", "message/user/list",
        //财务管理
        "finance/fund/money-save", "finance/fund/tixian", "finance/default/huikuan", "finance/fund/look-money", "finance/default/index", "finance/default/finance-log",
        //报表管理
        "report/index/index", "report/money/index", "report/lottery/index", "report/statement/six-detail", "report/statement/spsix-detail", "report/live-history/index",
        //管理员管理
        "admin/manage/list", "admin/log/list", "admin/online/list",
        //系统管理
        "sysmng/config", "sysmng/account", "sysmng/pay",
        //数据管理
        "dataset/clean/index"
    ];

    /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            self::EVENT_TRACE_ACTION => 'traceAction',
        ];
    }

    /**
     * @param $event
     * @return bool
     */
    public function traceAction($event)
    {
        try{
            $log = new DbTarget();
            $log->logTable = 'trace_log';
            $route = Yii::$app->requestedRoute;
            if(empty($route)) {
                return true;
            }
            if(in_array($route, self::FILTER_ROUTE)) {
                $data = [
                    'url' => Yii::$app->request->getAbsoluteUrl(),
                    'user' => Yii::$app->getSession()->get('S_USER_NAME', '未登录')
                ];
                $log->messages[] = [$data, Logger::LEVEL_TRACE, 'cacino', date("Y-m-d H:i:s",time())];
                $log->export();
            }
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
        }
        return true;
    }
}
