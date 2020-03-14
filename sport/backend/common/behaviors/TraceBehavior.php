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
            $data = [
                'url' => Yii::$app->request->getAbsoluteUrl(),
                'user' => Yii::$app->getSession()->get('S_USER_NAME', '未登录')
            ];
            $log->messages[] = [$data, Logger::LEVEL_TRACE, 'cacino', date("Y-m-d H:i:s",time())];
            $log->export();
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
        }
        return true;
    }
}
