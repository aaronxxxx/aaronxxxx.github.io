<?php
namespace app\modules\finance\models;

use app\modules\agentht\models\AgentsList;
use Yii;
use yii\db\ActiveRecord;

/**
 * 資金日誌操作
 */
class AgentsTransferLog extends ActiveRecord{
    
    public static function chongzhi($uid, $order, $money, $assets, $about = '')
    {
        $result = 0;
        $uid = intval($uid);
        $moneyLog = new AgentsTransferLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '後台充值';
        $moneyLog->order_value = $money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $assets+$money;
        $moneyLog->save();
        $user = AgentsList::find()->where(array('id'=>$uid))->one();
        if($user){
            $user->money = $user->money + $money;
            $result = $user->save();
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
        $moneyLog = new AgentsTransferLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '轉入下層';
        $moneyLog->order_value = 0-$money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = ($assets-$money) <=0 ? 0 : $assets-$money;
        $moneyLog->save();
        $user = AgentsList::find()->where(array('id'=>$uid))->one();
        if($user){
            $user->money = $user->money - $money;
            $user->money = $user->money <=0 ? 0 : $user->money;
            $result = $user->save();
        }
        return $result;
    }
    /**
     * @description: 代理對代理扣錢時 增加總ㄅ代理金額
     * @param {type} 
     * @return: 
     */
    public static function tixian_chongzhi($uid, $order, $money, $assets, $about = '')
    {
        $result = 0;
        $uid = intval($uid);
        $moneyLog = new AgentsTransferLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '總代扣款-回加總代理';
        $moneyLog->order_value = $money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $assets+$money;
        $moneyLog->save();
        $user = AgentsList::find()->where(array('id'=>$uid))->one();
        if($user){
            $user->money = $user->money + $money;
            $result = $user->save();
        }

        return $result;
    }
    /**
     * @description: 總代理對代理扣錢時新增扣除代理金額
     * @param {$uid,$order, $money, $assets,$about = ''} 
     *        {總代id,單號,扣除金額,代理餘額,原因}
     * @return: 
     */
    public static function tixian_tixian($uid,$order, $money, $assets,$about = '')
    {
        $session = Yii::$app->session;
        $result = 0;
        $uid = intval($uid);
        if ($order == '0')
        {
            $order = date('YmdHis') . '_' . $session['S_USER_NAME'];
        }
        $moneyLog = new AgentsTransferLog();
        $moneyLog->user_id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '總代扣款-扣代理';
        $moneyLog->order_value = 0-$money;
        $moneyLog->assets = $assets;
        $moneyLog->balance = ($assets-$money) <=0 ? 0 : $assets-$money;
        $moneyLog->save();
        $user = AgentsList::find()->where(array('id'=>$uid))->one();
        if($user){
            $user->money = $user->money - $money;
            $user->money = $user->money <=0 ? 0 : $user->money;
            $result = $user->save();
        }
        return $result;
    }
    /**
     * 存款成功後插入日誌
     * @param type $uid
     * @param type $m_order
     * @param type $m_oamount
     * @param type $assets
     * @param type $balancee
     * @return type
     */
    public static function InsertMoneyLog($uid,$m_orderid,$m_oamount,$assets,$balance){
        $moneyLog = new AgentsTransferLog();
        $moneyLog->id = $uid;
        $moneyLog->order_num = $m_orderid;
        $moneyLog->about = '';
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '該訂單手工操作成功';
        $moneyLog->order_value = $m_oamount;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }
    
    /**
     * 插入用戶提現失敗信息
     * @param type $uid
     * @param type $order
     * @param type $about
     * @param type $pay_value_log
     * @param type $assets
     * @param type $balance
     * @return type
     */
    public static function InsertTixian($uid,$order,$about,$pay_value_log,$assets,$balance){
       $moneyLog = new AgentsTransferLog(); 
        $moneyLog->id = $uid;
        $moneyLog->order_num = $order;
        $moneyLog->about = $about;
        $moneyLog->update_time = date('Y-m-d H:i:s');
        $moneyLog->type = '用戶提現失敗';
        $moneyLog->order_value = $pay_value_log;
        $moneyLog->assets = $assets;
        $moneyLog->balance = $balance;
        $r =$moneyLog->save();
        return $r;
    }


}