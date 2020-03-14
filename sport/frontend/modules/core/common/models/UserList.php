<?php

namespace app\modules\core\common\models;

use yii;
use yii\db\ActiveRecord;

/**
 * UserList is the model behind the user_list.
 */
class UserList extends ActiveRecord {
    
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
    static public function getUserNewsByUserID($uid){
        $sql = "select * from user_list where user_id = '$uid' ";
        $r = UserList::findBySql($sql)->asArray()->one();
        return $r;
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
     *
     * @param $user_id  用户id
     */
    /**
     * 查询金额日志表，最后的一条记录和用户表金额对比
     * @param $user_id      用户ID
     * @return int          1：正常  2：异常
     */
    public static function isyichang($user_id){
        /*$sql = "select balance from money_log where user_id = $user_id ORDER by id desc limit 2 ";
        $r = UserList::findBySql($sql)->asArray()->all();
        if($r){
            $usernews = self::getUserNewsByUserID($user_id);
            if($r[0]['balance'] !=  $usernews['money'] && $r[1]['balance'] !=  $usernews['money']){
                $remark = date('Y-m-d H:i:s').'_前后金额不匹配，自动异常';
                Yii::$app->db->createCommand("UPDATE user_list SET status='异常',remark='".$remark."' WHERE user_id=$user_id")->execute();
                return 2;
            }
        }
        return 1;*/
        $sql = "select balance from money_log where user_id = $user_id ORDER by id desc limit 1 ";
        $r = UserList::findBySql($sql)->asArray()->one();
        if($r){
            $usernews = self::getUserNewsByUserID($user_id);
            if($r['balance'] !=  $usernews['money']){
                $remark = date('Y-m-d H:i:s').'_前后金额不匹配，自动异常,blance='.$r['balance'] .',money='.$usernews['money'];
                Yii::$app->db->createCommand("UPDATE user_list SET status='异常',remark='".$remark."' WHERE user_id=$user_id")->execute();
                return 2;
            }
        }
        return 1;
    }
}
