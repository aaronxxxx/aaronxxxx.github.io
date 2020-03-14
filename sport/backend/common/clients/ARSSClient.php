<?php
namespace app\common\clients;

use app\common\helpers\LogUtils;
use Exception;
use Hprose\Http\Client;
use Yii;

/**
 * 客户端远程结算接口
 * Class ARSSClient
 * @package app\common\clients
 */
class ARSSClient
{
    const ERROR_CODE = -1;
    private $_clt;

    public function __construct()
    {
        try {
            $this->_clt = new Client(Yii::$app->params['settleDomain'], false);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            $this->_clt = null;
        }
    }

    /**
     * 6hc结算
     * @param $qishu
     * @param $jstype
     * @param $jsway
     * @return ret -1:客户端结算接口连接不上
     */
    public function LhcOrderSettle($qishu, $jstype, $jsway)
    {
        try {
            $ret = $this->_clt->LhcOrderSettle($qishu, $jstype, $jsway);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 6hc单个注单结算
     * @param $qishu
     * @param $jstype
     * @param $sixorderid
     * @return ret -1:客户端结算接口连接不上
     */
    public function LhcSingleOrderSettle($qishu, $jstype, $sixorderid)
    {
        try {
            $ret = $this->_clt->LhcSingleOrderSettle($qishu, $jstype, $sixorderid);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 彩票结算
     * @param $qishu
     * @param $jstype
     * @param $gtype
     * @param $jsway
     * @return ret -1:客户端结算接口连接不上
     */
    public function LotteryOrderSettle($qishu, $jstype, $gtype, $jsway)
    {
        try {
            $ret = $this->_clt->LotteryOrderSettle($qishu, $jstype, $gtype, $jsway);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 彩票单个注单结算
     * @param $qishu
     * @param $jstype
     * @param $gtype
     * @param $orderid
     * @return ret -1:客户端结算接口连接不上
     */
    public function LotterySingleOrderSettle($qishu, $jstype, $gtype, $orderid)
    {
        try {
            $ret = $this->_clt->LotterySingleOrderSettle($qishu, $jstype, $gtype, $orderid);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 彩票注单作废
     * @param $ordersubid
     * @return ret -1:客户端结算接口连接不上
     */
    public function LotteryOrderCancel($ordersubid)
    {
        try {
            $ret = $this->_clt->LotteryOrderCancel($ordersubid);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育滚球审核
     * @param $bid
     * @param $status
     * @param $loseok
     * @return ret -1:客户端结算接口连接不上
     */
    public function GqLoseSettle($bid, $status, $loseok)
    {
        try {
            $ret = $this->_clt->GqLoseSettle($bid, $status, $loseok);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育单式结算全场
     * @param $bid
     * @param $status
     * @param $mb_inball
     * @param $tg_inball
     * @return ret -1:客户端结算接口连接不上
     */
    public function BfDSSettle($bid, $status, $mb_inball, $tg_inball)
    {
        try {
            $ret = $this->_clt->BfDSSettle($bid, $status, $mb_inball, $tg_inball);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育串关结算全场
     * @param $bid_cg
     * @param $status_cg
     * @param $mb_inball_cg
     * @param $tg_inball_cg
     * @return ret -1:客户端结算接口连接不上
     */
    public function BfCgSettle($bid_cg, $status_cg, $mb_inball_cg, $tg_inball_cg)
    {
        try {
            $ret = $this->_clt->BfCgSettle($bid_cg, $status_cg, $mb_inball_cg, $tg_inball_cg);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育单式重新结算
     * @param $bid
     * @param $status
     * @return ret -1:客户端结算接口连接不上
     */
    public function ReBfDSSettle($bid, $status)
    {
        try {
            $ret = $this->_clt->ReBfDSSettle($bid, $status);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育串关重新结算
     * @param $bid_cg
     * @return ret -1:客户端结算接口连接不上
     */
    public function ReBfCgSettle($bid_cg)
    {
        try {
            $ret = $this->_clt->ReBfCgSettle($bid_cg);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育串关设为作废
     * @param $bid_cg_gp
     * @return ret -1:客户端结算接口连接不上
     */
    public function InvalidCgSettle($bid_cg_gp)
    {
        try {
            $ret = $this->_clt->InvalidCgSettle($bid_cg_gp);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育串关设为取消
     * @param $bid_cg_gp
     * @return ret -1:客户端结算接口连接不上
     */
    public function ReCgSettle($bid_cg_gp)
    {
        try {
            $ret = $this->_clt->ReCgSettle($bid_cg_gp);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育串关结算
     * @param $ok
     * @param $gid
     * @param $gids
     * @return ret -1:客户端结算接口连接不上
     */
    public function CgSettle($ok, $gid, $gids)
    {
        try {
            $ret = $this->_clt->CgSettle($ok, $gid, $gids);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育冠军单式结算
     * @param $match_id
     * @param $bid
     * @return ret -1:客户端结算接口连接不上
     */
    public function GJDSSettle($match_id, $bid)
    {
        try {
            $ret = $this->_clt->GJDSSettle($match_id, $bid);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育单式设为无效
     * @param $bid
     * @param $uid
     * @param $order_num
     * @param $sys_about
     * @param $back_bet_money
     * @return ret -1:客户端结算接口连接不上
     */
    public function InvalidSettle($bid, $uid, $order_num, $sys_about, $back_bet_money)
    {
        try {
            $ret = $this->_clt->InvalidSettle($bid, $uid, $order_num, $sys_about, $back_bet_money);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育单式结算
     * @param $bid
     * @param $status
     * @param $mb_inball
     * @param $tg_inball
     * @return ret -1:客户端结算接口连接不上
     */
    public function DSSettle($bid, $status, $mb_inball, $tg_inball)
    {
        try {
            $ret = $this->_clt->DSSettle($bid, $status, $mb_inball, $tg_inball);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

    /**
     * 体育单式重新审核
     * @param $bid
     * @param $status
     * @return ret -1:客户端结算接口连接不上
     */
    public function CancelSettle($bid, $status)
    {
        try {
            $ret = $this->_clt->CancelSettle($bid, $status);
            return $ret;
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return self::ERROR_CODE;
        }
    }

}
