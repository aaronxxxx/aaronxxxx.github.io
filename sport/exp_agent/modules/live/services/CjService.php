<?php
namespace app\modules\live\services;

use app\common\helpers\LogUtils;
use app\modules\live\models\LiveRpcConfig;
use Exception;
use Hprose\Http\Client;
use Yii;
use yii\base\Object;

/**
 * Class CjService 采集服务
 * @package app\modules\live\services
 */
class CjService extends Object {
    private $_client = null;
    private $_status = true;
    private $_msg = '';
    private $_live_prefix = '';

    /**
     * 构造方法
     */
    public function __construct() {
        try {
            $live_rpc_config = LiveRpcConfig::find()->one();
            $this->_client = new Client(Yii::$app->params['cjDomain'], false);
            $this->_live_prefix = $live_rpc_config['live_name_prefix'];
        } catch (Exception $e) {
            LogUtils::error_log($e);
        }
    }

    /**
     * 重置AG注单状态
     * @param $time_type
     */
    public function resetAgLiveOrder($time_type) {
        try {
            $result = $this->_client->resetLiveOrder($this->_live_prefix, $time_type);
            $this->_checkDataStatus($result);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->setErrorMsg("请求失败");
        }
    }

    private function _checkDataStatus($result) {
        $this->_status = true;
        if($result == "0") {
            $this->setErrorMsg("操作失败");
        }
    }

    private function setErrorMsg($msg) {
        $this->_status = false;
        $this->_msg = $msg;
    }

    public function getStatus() {
        return $this->_status;
    }

    public function getMsg() {
        return $this->_msg;
    }
}
