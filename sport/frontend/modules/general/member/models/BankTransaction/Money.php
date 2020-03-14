<?php
namespace app\modules\general\member\models\BankTransaction;
use yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

/**
 * 金额表操作
 * Money is the model behind the Money.
 */
class Money extends ActiveRecord{
    
    /**
     * 添加订单
     * @param type $uid                         用户ID
     * @param type $order_amount      金额
     * @param type $order_no               订单号
     * @param type $assets                    资产
     */
    public static function addMoenyNews($uid,$order_amount,$order_no,$assets) {
        $money = new Money;
        $money->user_id          = $uid;
        $money->order_value     = $order_amount;
        $money->order_num =$order_no;
        $money->status ='确认';
        $money->assets =$assets;
        $money->balance =$assets+$order_amount;
        $money->save();
        $r = $money->id;
        return $r; 
    }
    
    public static function updateMoneyNews($m_id) {
        $sql = 'update money,user_list set money.status=\'成功\',money.update_time=now(),user_list.money=user_list.money+money.order_value,money.about=\'该订单在线冲值操作成功\',money.sxf=money.order_value/100,money.balance=user_list.money+money.order_value where money.user_id=user_list.user_id and money.id=' . $m_id . ' and money.`status`=\'确认\'';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }
    /**
    * 添加汇款订单动作
    * @param type $uid          用户的id
    * @param type $uname        用户名
    * @param type $umoney        用户的金额
    * @param type $rows         汇款的信息
    * @return type
    */
    public static function addHKorder($uid,$uname,$umoney,$rows){
        $money = new Money;
        $money->assets          = $umoney;
        $money->order_value     = $rows['v_amount'];
        $money->pay_card        = $rows['IntoBank'];
        $money->date            = $rows['cn_date']." ".$rows["s_h"].":".$rows["s_i"].":".$rows["s_s"];
        $money->manner          = $rows['InType'];
        $money->balance         = $rows['v_amount'] + $umoney;
        $money->update_time     = date("Y-m-d H:i:s");
        $money->status          = '未结算';
        $money->user_id         = $uid;
        $money->order_num       = date('YmdHis')."_".$uname;
        $money->type            = "银行汇款";
        $r = $money->save();
        return $r;     
    }
    
    /**
     * 添加取款订单动作
     * @param type $user        用户信息
     * @param type $pay_value   取款金额
     * @return type
     */
    public static function addTKorder($user,$pay_value){
        $money = new Money;
        $money->user_id         = $user['user_id'];
        $money->order_value     = 0-$pay_value;
        $money->status          = '未结算';
        $money->order_num       = date('YmdHis')."_".$user['user_name'];
        $money->pay_card        = $user['pay_bank'];
        $money->pay_num         = $user["pay_num"];
        $money->pay_address     = $user["pay_address"];
        $money->pay_name        = $user["pay_name"];
        $money->about           = '';
        $money->assets          = $user['money'];
        $money->balance         = $user['money'] - $pay_value;
        $money->type            = "用户提款";
        $money->update_time     = date("Y-m-d H:i:s");
        $r = $money->save();
        return $r;
    }
    
    /**
     * 获取用户7天内在线存款记录
     * @param type $user_group  用户id
     * @return type
     */
    public static function getOnlineSeposit($user_group){
        $get_time = date('Y-m-d',strtotime('-6 day'))." 00:00:00";
        $sql="select id,order_value,order_num,update_time,user_id,assets,status,about "
                . "from money "
                . "where `user_id`='".$user_group."' "
                . "and (`type`='在线支付' or `type`='后台充值') "
                . "and `update_time`>='$get_time' order by id desc";
        $db = Yii::$app->db;
        $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
        $cunkuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
        return [$cunkuan_list,$pages];
    }
    
    /**
     * 获取用户汇款数据
     * @param type $user_group  用户ID
     * @return type
     */
    public static function getRemittanceRecords($user_group){
        $get_time = date('Y-m-d',strtotime('-6 day'))." 00:00:00";
        $sql="select id,order_value,order_num,update_time,user_id,assets,status,about,pay_card,manner "
                . "from money "
                . "where `user_id`='".$user_group."' "
                . "and `type`='银行汇款' "
                . "and `update_time`>='$get_time' "
                . "order by id desc";
        $db = Yii::$app->db;
        $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
        $huikuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
        return [$huikuan_list,$pages];
    }
    
    /**
     * 获取用户提款数据
     * @param type $user_group  用户ID
     * @return type
     */
    public static function getWithdrawRecord($user_group){
        $get_time = date('Y-m-d',strtotime('-6 day'))." 00:00:00";
        $sql="select id,order_value,order_num,update_time,user_id,assets,status,about "
                . "from money "
                . "where `user_id`='".$user_group."' "
                . "and (type='用户提款' or type='后台扣款') "
                . "and `update_time`>='$get_time' "
                . "order by id desc";
        $db = Yii::$app->db;
        $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
        $qukuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
        return [$qukuan_list,$pages];
    }
    
}
