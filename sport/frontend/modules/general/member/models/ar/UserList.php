<?php

namespace app\modules\general\member\models\ar;

use app\modules\lottery\models\ar\OrderLotterySub;
use Yii;
use yii\db\ActiveRecord;

/**
 * 用户表操作
 * UserList is the model behind the user_list.
 */
class UserList extends ActiveRecord {

    /**
     * 获取用户信息（通过用户ID）   用户ID
     * @param type $user_id
     */
    public static function getUserNewsByUserId($user_id) {
        $arr = UserList::find()->where(['user_id' => $user_id])->asArray()->one();
        return $arr;
    }

    /**
     * 获取用户ID（通过用户名）（判断是否在线）
     * @param type $Attach      用户名
     * @return type
     */
    public static function getUserIdByUsername($Attach) {
        $sql = "select id from user_list where user_name= '$Attach' ";
        $r = UserList::findBySql($sql)->asArray()->one();
        return $r;
    }

    /**
     * 添加用户银行卡信息
     * @param type $uid  用户ID
     * @param type $rows 银行卡信息
     */
    public static function setPayCard($uid, $rows)
    {
        $qk_pass = md5($rows['qk_pwd']);
        $r = FALSE;
        $userlist = UserList::find()
            ->where(["user_id" => $uid, "qk_pass" => $qk_pass])
            ->one();

        if ($userlist != null) {
            if ($rows['pay_name']) {
                $userlist->pay_name = $rows['pay_name'];
                $userlist->mz = md5($rows['pay_name']);
            }

            $userlist->pay_bank = $rows['pay_card'];
            $userlist->pay_num = $rows['pay_num'];
            $userlist->pay_address = $rows['add1'] . $rows['add2'] . $rows['add3'];
            $userlist->pay_num = $rows['pay_num'];
            $r = $userlist->save();
        }

        return $r;
    }

    /**
     * 更新用户的余额
     * @param type $uid 用户ID
     * @param type $pay_value 用户取款金额
     * @return type
     */
    public static function saveMoney($uid, $pay_value) {
        $userlist = UserList::find()
                ->where(["user_id" => $uid])
                ->one();
        $money = $userlist['money'];
        $userlist->money = $money - $pay_value;
        $r2 = $userlist->save();
        return $r2;
    }

    /**
     * 查询金额日志表，最后的一条记录和用户表金额对比
     * @param $user_id      用户ID
     * @return int          1：正常  2：异常
     */
    public static function isyichang($user_id){
//		return 1;
        $sql = "select balance from money_log where user_id = $user_id ORDER by id desc limit 1 ";
        $r = UserList::findBySql($sql)->asArray()->one();
        if($r){
            $usernews = self::getUserNewsByUserID($user_id);
            if($r['balance'] !=  $usernews['money']){
                $remark = date('Y-m-d H:i:s').'_前后金额不匹配，自动异常';
                Yii::$app->db->createCommand("UPDATE user_list SET status='异常',remark='$remark' WHERE user_id=$user_id")->execute();
                return 2;
            }
        }
        return 1;
    }

    /**
     * 北京快乐8，异常订单判断
     * @param $user_id
     * @return bool
     */
    public static function getLottery_kl8($user_id){
        $arr = ['选二','选三','选四','选五'];
        $lottery_bjkl8 = OrderLotterySub::find()
            ->select(['os.id','os.number','os.order_sub_num'])
            ->from('order_lottery_sub as os')
            ->innerJoin("order_lottery as ol","ol.order_num = os.order_num")
            ->where(['ol.user_id'=>$user_id])
            ->andWhere(['in','os.quick_type',$arr])
            ->asArray()->All();
        foreach ($lottery_bjkl8 as $key =>$value) {
            $arr = explode(',',$value['number']);
            $unique_arr = array_unique ($arr);
            $repeat_arr = array_diff_assoc ($arr, $unique_arr);
            if(!empty($repeat_arr)){
                $remark = '彩票 北京快乐8订单：'.$value['order_sub_num'].' 存在异常，会员提款或真人转账后自动异常。（该订单异常属于恶意操作）';
                Yii::$app->db->createCommand("UPDATE user_list SET status='异常',remark='$remark' WHERE user_id=$user_id")->execute();
                return false;
            }
        }
        return true;
    }
}
