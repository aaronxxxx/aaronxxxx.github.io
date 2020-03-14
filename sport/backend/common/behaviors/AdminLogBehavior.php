<?php

namespace app\common\behaviors;

use app\common\helpers\LogUtils;
use app\common\helpers\UAUtils;
use app\modules\general\admin\models\ManageLog;
use Yii;
use yii\base\Behavior;
use yii\base\Exception;

/**
 * Class AdminLogBehavior
 * @package app\common\behaviors
 */
class AdminLogBehavior extends Behavior
{
    const EVENT_AFTER_ACTION_LOG = 'afterActionLog';
    /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            self::EVENT_AFTER_ACTION_LOG => 'afterActionLog',
        ];
    }

    /**
     * @param \app\common\events\AdminLogEvent $event
     * @return bool
     */
    public function afterActionLog($event)
    {
        try{
            $manageLog = new ManageLog();
            $manageLog->manage_name = empty($event->manage_name) ? Yii::$app->getSession()->get('S_USER_NAME') : $event->manage_name;
            if(!empty($manageLog->manage_name) && !empty($event->edlog)) {
                $manageLog->edtime = empty($event->edtime) ? date("Y-m-d H:i:s",time()) : $event->edtime;
                $manageLog->login_ip = empty($event->login_ip) ? Yii::$app->request->getUserIP() : $event->login_ip;
                $manageLog->session_str = empty($event->session_str) ? session_id() : $event->session_str;
                $manageLog->run_str = empty($event->run_str) ? UAUtils::getClientBrowser() : $event->run_str;
                $manageLog->edlog = $event->edlog;
                $manageLog->save();
            }
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
        }
        return true;
    }
}
