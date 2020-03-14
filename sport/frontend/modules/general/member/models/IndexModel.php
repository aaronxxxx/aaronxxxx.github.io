<?php
namespace Home\Model;
use Think\Model;

class IndexModel extends Model{     //k_bet表，k_bet_cg_group表  不懂是什么的表
    /**
     * 体育投注额
     * @param type $userid  用户ID
     * @return type
     */
    public static function getTouZhu1($userid){
        $KBet = D("KBet");
        $arr1 = $KBet->query("SELECT sum(bet_money) as s FROM `k_bet` where user_id='$userid' and status='0'");
        return $arr1;
    }
    
    /**
     * 彩票投注额
     * @param type $userid  用户ID
     * @return type
     */
    public static function getTouZhu2($userid){
        $OrderLottery = D("OrderLottery");
        $arr2 = $OrderLottery->query("SELECT sum(bet_money) as s FROM `order_lottery` where user_id='$userid' and status='0'");
        return $arr2;
    }
    
    /**
     * 六合彩投注额
     * @param type $userid  用户ID
     * @return type
     */
    public static function getTouZhu3($userid){
        $SixLotteryOrder = D("SixLotteryOrder");
        $arr3 = $SixLotteryOrder->query("SELECT sum(bet_money_total) as s FROM `six_lottery_order` where user_id='$userid' and status='0'");
        return $arr3;
    }
    
    /**
     * 体育冠军组投注额（这个不是很清楚是不是这个）
     * @param type $userid  用户ID
     * @return type
     */
    public static function getTouZhu4($userid){
        $KBetCgGroup = D("KBetCgGroup");
        $arr4 = $KBetCgGroup->query("SELECT sum(bet_money) as s FROM `k_bet_cg_group` where user_id='$userid' and status='0'");
        return $arr4;
    }
    
    /**
     * 获取用户余额
     * @param type $userid  用户ID
     * @return type
     */
    public static function getUserMoney($userid){
        $userList = D("UserList");
        $arr5 = $userList->query("select money as s from user_list where user_id='$userid' limit 1");
        return $arr5;
    }
    
    /**
     * 获取真人余额
     * @param type $userid 用户ID
     * @return type
     */
    public static function getLiveMoney($userid){
        $userList = D("UserList");
        $arr6 = $userList->query("select u.money,u.user_name,l.live_money_a normal_money,l.live_money_b vip_money,l.update_time,l.live_type,l.live_username
                            from user_list u,live_user l
                            where u.user_id=l.user_id and u.user_id='$userid' and l.live_type='AG' limit 0,1");
        return $arr6;
    }
    
    /**
     * 获取系统公告信息
     */
    public static function getNotice(){
        $SysAnnouncement = D('SysAnnouncement');
        $time = date('Y-m-d H:i:s');
        $result = $SysAnnouncement->field("content,create_date,type")->where("is_show = '1' and end_time = '$time' ")->select();
        return $result;
    }
    
    /**
     * 更新用户在线时间和删除超时用户
     * @param type $datetime    在线时间
     * @param type $uid         在线ID
     * @param type $outtime     
     * @param type $needtime    
     */
    static function updateAndDelUserOnlineTime($datetime,$uid,$outtime,$needtime){
        $userlist = D('UserList');
        $sql = "update user_list set online=1,OnlineTime='$datetime' where Oid='$uid' and Oid!=''"; //更新在線時長
        $userlist->query($sql);
        $sql = "update user_list set online=0,Oid='' where OnlineTime<'$outtime' and OnlineTime>'$needtime' and (Oid<>'' or online=1)"; //刪除超時用戶
        $userlist->query($sql);
    }
    /**
     * 定时删除超时用户
     * @param type $outtime
     */
    static function deleteUserOnlineOnTime($outtime){
        $userlist = D('UserList');
        $sql = "update user_list set online=0,Oid='' where OnlineTime<'$outtime' and (Oid<>'' or online=1)"; //刪除超時用戶
        $userlist->query($sql);
    }
    /**
     * 判断用户是否在线
     * @param type $uid     用户在线ID
     * @return type         用户编号
     */
    static function existUserOnline($uid){
        $userlist = D('UserList');
        $user_id = $userlist->field('id')->where("oid='$uid' and Status='正常'")->find();
        return $user_id;   
    }
    
}

