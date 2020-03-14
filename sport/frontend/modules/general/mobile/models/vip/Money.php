<?php
namespace app\modules\general\mobile\models\vip;

use yii\db\ActiveRecord;
use app\modules\general\mobile\models\Pagination;

/**
 * 金额表操作
 * Money is the model behind the Money.
 */
class Money extends ActiveRecord{
    
    /**
    * 添加支付宝订单动作
    * @param type $uid                       用户的id
    * @param type $uname                 用户名
    * @param type $umoney               用户的金额
    * @param type $InType                 汇款的信息
    * @param type $order_value         订单金额
    * @return type
    */
    static public function addZfborder($uid,$uname,$umoney,$InType,$order_value){
        $money = new Money;
        $money->assets          = $umoney;
        $money->order_value     = $order_value;
        $money->manner          = $InType;
        $money->pay_card        = "支付宝";
        $money->pay_address     = "移动端支付";
        $money->balance         = $order_value + $umoney;
        $money->update_time     = date("Y-m-d H:i:s");
        $money->status          = '未结算';
        $money->user_id         = $uid;
        $money->order_num       = date('YmdHis')."_".$uname;
        $money->type            = "银行汇款";
        $r = $money->save();
        return $r;     
    }
    
    /**
    * 添加微信订单动作
    * @param type $uid              用户的id
    * @param type $uname        用户名
    * @param type $umoney        用户的金额
    * @param type $InType         汇款的信息
    * @param type $order_value         订单金额
    * @return type
    */
    static public function addWxorder($uid,$uname,$umoney,$InType,$order_value){
        $money = new Money;
        $money->assets          = $umoney;
        $money->order_value     = $order_value;
        $money->manner          = $InType;
        $money->pay_card        = "微信";
        $money->pay_address     = "移动端支付";
        $money->balance         = $order_value + $umoney;
        $money->update_time     = date("Y-m-d H:i:s");
        $money->status          = '未结算';
        $money->user_id         = $uid;
        $money->order_num       = date('YmdHis')."_".$uname;
        $money->type            = "银行汇款";
        $r = $money->save();
        return $r;     
    }
    
    /**
    * 添加财付通订单动作
    * @param type $uid              用户的id
    * @param type $uname        用户名
    * @param type $umoney        用户的金额
    * @param type $InType         汇款的信息
    * @param type $order_value         订单金额
    * @return type
    */
    static public function addCftorder($uid,$uname,$umoney,$InType,$order_value){
        $money = new Money;
        $money->assets          = $umoney;
        $money->order_value     = $order_value;
        $money->manner          = $InType;
        $money->pay_card        = "财付通";
        $money->pay_address     = "移动端支付";
        $money->balance         = $order_value + $umoney;
        $money->update_time     = date("Y-m-d H:i:s");
        $money->status          = '未结算';
        $money->user_id         = $uid;
        $money->order_num       = date('YmdHis')."_".$uname;
        $money->type            = "银行汇款";
        $r = $money->save();
        return $r;     
    }    

    /**
    * 添加汇款订单动作
    * @param type $uid          用户的id
    * @param type $uname        用户名
    * @param type $umoney        用户的金额
    * @param type $rows         汇款的信息
    * @return type
    */
    static public function addHKorder($uid,$uname,$umoney,$rows){
        $money = new Money;
        $money->assets          = $umoney;
        $money->order_value     = $rows['v_amount'];
        $money->pay_card        = $rows['IntoBank'];
        $money->date            = $rows['cn_date']." ".$rows["s_h"].":".$rows["s_i"].":".$rows["s_s"];
        $money->manner          = $rows['InType'];
        $money->pay_address     = $rows['v_site'];
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
    static public function addTKorder($user,$pay_value){
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
    static public function getOnlineSeposit($user_group){
        $get_time = date('Y-m-d',strtotime('-6 day'))." 00:00:00";
        $sql="select id,order_value,order_num,update_time,user_id,assets,status,about "
                . "from money "
                . "where `user_id`='".$user_group."' "
                . "and (`type`='在线支付' or `type`='后台充值') "
                . "and `update_time`>='$get_time' order by id desc";
        return $sql;
    }
    
    /**
     * 获取用户汇款数据
     * @param type $user_group  用户ID
     * @return type
     */
    static public function getRemittanceRecords($user_group){
        $get_time = date('Y-m-d',strtotime('-6 day'))." 00:00:00";
        $sql="select id,order_value,order_num,update_time,user_id,assets,status,about,pay_card,manner "
                . "from money "
                . "where `user_id`='".$user_group."' "
                . "and `type`='银行汇款' "
                . "and `update_time`>='$get_time' "
                . "order by id desc";
        return $sql;
    }
    
    /**
     * 获取用户提款数据
     * @param type $user_group  用户ID
     * @return type
     */
    static public function getWithdrawRecord($user_group){
        $get_time = date('Y-m-d',strtotime('-6 day'))." 00:00:00";
        $sql="select id,order_value,order_num,update_time,user_id,assets,status,about "
                . "from money "
                . "where `user_id`='".$user_group."' "
                . "and (type='用户提款' or type='后台扣款') "
                . "and `update_time`>='$get_time' "
                . "order by id desc";
        return $sql;
    }
    
}
