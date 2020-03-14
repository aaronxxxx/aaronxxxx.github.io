<?php

namespace app\modules\general\mobile\models\user;

use yii\db\ActiveRecord;

/**
 * UserList is the model behind the user_list.
 */
class UserList extends ActiveRecord {

    /**
     * 根据用户ID获取用户信息
     * @param type $uid
     * @return type
     */
    static public function getUserNewsByUserID($uid){
        $sql = "select * from user_list where user_id = '$uid' ";
        $r = UserList::findBySql($sql)->asArray()->one();
        return $r;
    }
	static public function Money($uid){
		$sql="select money from user_list where user_id=".$uid;
        $r = UserList::findBySql($sql)->asArray()->one();
		return isset($r['money'])?(float)number_format($r['money'],2,'.',''):0;
	}
    /**
     * 防止暴力注册
     * @param type $regip   注册IP地址
     * @return type
     */
    static public function registToManay($regip){
        $s_time = date('Y-m-d');
        $sql = "select count(id) today_count from user_list where regip='" . $regip . "' and logintime>='" . $s_time . " 00:00:00' and logintime<='" . $s_time . " 23:59:59' limit 0,1";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs[0];
    }
    /**
     * 判断用户名是否存在
     * @param type $user_name 提交的用户名
     * @return type
     */
    static public function existUsername($user_name){
        $sql = "select user_name from user_list where user_name='" . $user_name . "' limit 1";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    /**
     * 添加用户银行卡信息
     * @param type $uid  用户ID
     * @param type $rows 银行卡信息
     */
    static public function setPayCard($uid, $rows)
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
}
