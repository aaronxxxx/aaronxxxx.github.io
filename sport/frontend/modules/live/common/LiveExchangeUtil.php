<?php
namespace app\modules\live\common;

use app\modules\core\common\models\SysConfig;
use app\modules\core\common\models\UserList;
use Yii;

/**
 * LiveExchangeUtil 真人转账操作工具集
 */
class LiveExchangeUtil {

    /**
     * 校验金额
     * @param int $uid              用户id
     * @param int $credit           操作金额
     * @param string $live_type     真人标识
     * @param boolean $isWithdraw   是否取款
     * @return json
     */
    public static function checkMoney($uid, $credit, $live_type, $isWithdraw = false) {
        if (!$isWithdraw) {
            return self::_checkMoney_deposit($uid, $credit, $live_type);
        } else {
            return self::_checkMoney_withdraw($credit, $live_type);
        }
    }

    /**
     * 校验最小转账金额限额
     * @param int $credit   操作金额
     * @return boolean      true: 通过 false: 未通过
     */
    public static function checkMinimumLimit($credit) {
        $sys_config = SysConfig::find()->one();

        if (empty($sys_config)) {
            return false;
        }

        return $credit < (int)$sys_config['min_change_money'] ? false : true;
    }

    /* ============================ 华丽的分割线 =============================== */
    /**
     * 校验存款金额
     * @param int $uid          用户id
     * @param int $credit       操作金额
     * @param string $live_type 厅标识
     * @return json
     */
    private static function _checkMoney_deposit($uid, $credit, $live_type) {
        $data = [
            'code' => 0,
            'data' => [],
            'msg' => '',
        ];

        if (!self::_checkBalanceLimit($uid, $credit)) {
            $data['code'] = 3;
            $data['msg'] = '余额不足';
        } else if (!self::_checkHallBalanceLimit ($credit, $live_type)['limit']) {
            $data['code'] = 4;
            $data['balance'] = self::_checkHallBalanceLimit ($credit, $live_type)['balance'];
            $data['msg'] = '余额不足';
        }

        return $data;
    }

    /**
     * 校验取款金额
     * @param int $credit       操作金额
     * @param string $live_type 厅标识
     * @return json
     */
    private static function _checkMoney_withdraw($credit, $live_type) {
        $data = [
            'code' => 0,
            'data' => [],
            'msg' => '',
        ];

        if (!self::_checkLiveBalance($credit, $live_type)) {
            $data['code'] = 5;
            $data['msg'] = $live_type . '厅余额不足';
        }

        return $data;
    }

    /**
     * 校验取款金额
     * @param int $uid      用户id
     * @param int $credit   操作金额
     * @return boolean      true: 通过 false: 未通过
     */
    private static function _checkBalanceLimit($uid, $credit) {
        $user = UserList::findOne(['user_id' => $uid]);
        if (empty($user)) {
            return false;
        }

        return $credit > (int)$user['money'] ? false : true;
    }

    /**
     * 校验真人余额
     * @param int $credit       操作金额
     * @param type $live_type   厅标识
     * @return boolean          true: 通过 false: 未通过
     */
    private static function _checkLiveBalance($credit, $live_type) {
        $params = [
            'type' => LiveUtil::getTypeByLiveType($live_type),
        ];

        $query_ret = Yii::$app->runAction('live/query-balance-api/inner-query', $params);
        $json = json_decode($query_ret);

        if (empty($json) || (int)$json->code != 0) {
            return false;
        }

        return (int)$json->data->balance >= $credit ? true : false;
    }

    /**
     * 校验厅限额余额
     * @param int $credit       操作金额
     * @param type $live_type   厅标识
     * @return boolean          true: 通过 false: 未通过
     */
    private static function _checkHallBalanceLimit($credit, $live_type)
    {
        if ($live_type == 'AI') {
            $sys_config = SysConfig::find()->one();
            $balance = $sys_config['ai_max_change'];
        } else {
            $sys_srv = LiveServiceUtil::getSysService();
            $balance = $sys_srv->queryHallLimitBalance($live_type);

            if (empty($balance) || !is_numeric($balance)) {
                return false;
            }
        }

        $result = [
            'limit' => $balance >= $credit ? true : false,
            'balance' => $balance,
        ];

        return $result;
    }
}

