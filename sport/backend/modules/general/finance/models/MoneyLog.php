<?php
namespace app\modules\general\finance\models;

use app\modules\core\common\models\UserList;
use Yii;
use yii\db\ActiveRecord;

/**
 * 资金日志操作
 */
class MoneyLog extends ActiveRecord{

    public static function chongzhi($uid, $order, $money, $assets, $about = '')
    {
        $result = 0;
        $uid = intval($uid);

        $innerTransaction = Yii::$app->db->beginTransaction();
		try {
			$user = UserList::find()->where(array('user_id'=>$uid))->one();
			if($user){
				$user->money = $user->money + $money;
				$result = $user->save();
			}
			$moneyLog = new MoneyLog();
			$moneyLog->user_id = $uid;
			$moneyLog->order_num = $order;
			$moneyLog->about = $about;
			$moneyLog->update_time = date('Y-m-d H:i:s');
			$moneyLog->type = '后台充值';
			$moneyLog->order_value = $money;
			$moneyLog->assets = $assets;
			$moneyLog->balance = $assets+$money;
			$moneyLog->save();
			$innerTransaction->commit();
		} catch (Exception $e) {
			error_log('app\modules\general\finance\models\MoneyLog(chongzhi)：'.$e->getTraceAsString().'online:'.$e->getLine().'，time:'.date('Y-m-d h:i:s',time()).''."\r\n", 3, "error.log");
			$innerTransaction->rollBack();
			$result = false;
		}

        return $result;
    }
    public static function tixian($uid,$order, $money, $assets,$about = '')
    {
        $session = Yii::$app->session;
        $result = 0;
        $uid = intval($uid);
        if ($order == '0')
        {
            $order = date('YmdHis') . '_' . $session['S_USER_NAME'];
        }
		$innerTransaction = Yii::$app->db->beginTransaction();
		try {
			$user = UserList::find()->where(array('user_id'=>$uid))->one();
			if($user){
				$user->money = $user->money - $money;
				$user->money = $user->money <=0 ? 0 : $user->money;
				$result = $user->save();
			}
			$moneyLog = new MoneyLog();
			$moneyLog->user_id = $uid;
			$moneyLog->order_num = $order;
			$moneyLog->about = $about;
			$moneyLog->update_time = date('Y-m-d H:i:s');
			$moneyLog->type = '后台提现';
			$moneyLog->order_value = $money;
			$moneyLog->assets = $assets;
			$moneyLog->balance = ($assets-$money) <=0 ? 0 : $assets-$money;
			$moneyLog->save();
			$innerTransaction->commit();
		} catch (Exception $e) {
			error_log('app\modules\general\finance\models\MoneyLog(tixian)：'.$e->getTraceAsString().'online:'.$e->getLine().'，time:'.date('Y-m-d h:i:s',time()).''."\r\n", 3, "error.log");
			$innerTransaction->rollBack();
			$result = false;
		}
        return $result;
    }

    /**
     * 存款成功后插入日志
     * @param type $uid
     * @param type $m_order
     * @param type $m_oamount
     * @param type $assets
     * @param type $balancee
     * @return type
     */
    public static function InsertMoneyLog($uid,$m_orderid,$m_oamount,$assets,$balance){
        $moneyLog = new MoneyLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $m_orderid;
        $moneyLog->about = '';
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '该订单手工操作成功';
        $moneyLog->order_value = $m_oamount;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }

    /**
     * 插入用户提现失败信息
     * @param type $uid
     * @param type $order
     * @param type $about
     * @param type $pay_value_log
     * @param type $assets
     * @param type $balance
     * @return type
     */
    public static function InsertTixian($uid,$order,$about,$pay_value_log,$assets,$balance){
       $moneyLog = new MoneyLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '用户提现失败';
        $moneyLog->order_value = $pay_value_log;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }


    /**
     * 插入六合彩注单作废日志
     * @param type $uid
     * @param type $order
     * @param type $about
     * @param type $money
     * @param type $assets
     * @param type $balance
     */
    public static function SixCancel($uid,$order,$money,$assets,$balance){
        $moneyLog = new MoneyLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = '六合彩';
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '六合彩作废';
        $moneyLog->order_value = $money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }

    /**
     * 新运彩注单作废日志
     */
    public static function EventCancel($uid, $order, $money, $assets, $balance)
    {
        $moneyLog = new MoneyLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = '新运彩';
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '新运彩作废';
        $moneyLog->order_value = $money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }
}