<?php
namespace app\common\filters;
use app\common\helpers\LogUtils;
//use app\modules\core\common\models\TraceSpeed;

class SpeedFilter extends \yii\base\ActionFilter
{
    private $_startTime;

    public function beforeAction($action)
    {
        $this->_startTime = microtime(true);
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $time = microtime(true) - $this->_startTime;
        if($time > 1) {
            LogUtils::trace("'{$action->uniqueId}' 执行了 $time 秒.");
//            $traceSpeed = new TraceSpeed();
//            $traceSpeed->action = $action->uniqueId;
//            $traceSpeed->second = $time;
//            $traceSpeed->createTime = date('Y-m-d H:i:s');
//            $traceSpeed->save(false);
        }
        return parent::afterAction($action, $result);
    }

}