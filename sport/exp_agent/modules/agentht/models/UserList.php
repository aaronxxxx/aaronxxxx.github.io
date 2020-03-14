<?php
namespace app\modules\agentht\models;

use yii\db\ActiveRecord;

/**
 * 用户表操作
 * UserList is the model behind the agents_list.
 */
class UserList extends ActiveRecord {

    static public function getUserNameByUserId($user_id) {
        $r = UserList::find()
                ->select('user_name')
                ->where(['user_id' => $user_id])
                ->asArray()
                ->one();
        return $r;
    }

    /**
     * 获取代理下属会员ID
     * @param type $id
     * @return type
     */
    static public function getUserIdJoinAgents($id) {
        $user_id_arr = UserList::find()
                ->select(['u.id'])
                ->from('user_list as u')
                ->innerJoin('agents_list as a', "a.id = u.top_id")
                ->where(['a.id' => $id])
                ->orderBy('u.id')
                ->asArray()
                ->all();
        return $user_id_arr;
    }

    static public function getOnlineUserIdjOinAgents($id){
        $user_id_arr = UserList::find()
            ->select(['u.id'])
            ->from('user_list as u')
            ->innerJoin('agents_list as a', "a.id = u.top_id")
            ->where(['a.id' => $id])
            ->andWhere(['!=','u.Oid',''])
            ->orderBy('u.id')
            ->asArray()
            ->all();
        return $user_id_arr;
    }
    /**
     * 获取指定id的会员信息
     * @param type $id_arr
     * @return type
     */
    static public function getUserNewsByIdArray($id_arr) {
        $res = UserList::find()
				->select(['id', 'user_name', 'user_id', 'money', 'Oid', 'regtime', 'logintime', 'pay_name'])
                ->from('user_list')
                ->where(['in', 'id', $id_arr])
                ->orderBy('logintime desc');
				/*->select(['u.id','u.user_name','u.user_id','u.money','u.Oid','u.regtime','u.logintime','u.pay_name'])
                ->from('user_list as u')
                ->leftJoin('order_lottery as a',"a.user_id = u.user_id AND (a.status=1 or a.status=2) AND a.bet_time>='$s_time' and a.bet_time<='$e_time'")
                ->leftJoin('six_lottery_order as b',"b.user_id = u.user_id AND (b.status=1 or b.status=2) AND b.bet_time>='$s_time' and b.bet_time<='$e_time'")
                ->leftJoin('spsix_lottery_order as c',"c.user_id = u.user_id AND (c.status=1 or c.status=2) AND c.bet_time>='$s_time' and c.bet_time<='$e_time'")
                ->leftJoin('live_user as l',"l.user_id = u.user_id")
                ->leftJoin('live_order as lo',"l.live_username = lo.live_username AND lo.order_time>='$s_time' and lo.order_time<='$e_time'")                
                ->where(['in','u.id',$id_arr])
                ->andWhere('a.id is not null or b.id is not null or c.id is not null or lo.id is not null')
                ->groupBy('u.id')
                ->orderBy('u.regtime desc');*/
        return $res;
    }

    /**
     * 代理下属会员报表明细5连发
     * @param type $id              代理ID
     * @param type $s_time      开始时间
     * @param type $e_time      结束时间
     * @param type $status       结算状态
     * @return type
     */
    static public function bbUserLottery($id, $s_time, $e_time, $status='' ) {
        if($status == 1){
            $where = " and o.status in (1,2) ";
        }else{
            $where = " and o.status in (0,3) ";
        }
        $sql = "SELECT SUM(IF(sub.bet_money>0,IF(sub.is_win!=2,sub.bet_money,0),0)) bet_money_total,"
                . "SUM(IF(sub.is_win=1,sub.win+sub.fs,IF(is_win=0,fs,0))) win_total,u.id "
                . "FROM user_list u,order_lottery o,order_lottery_sub sub "
                . "WHERE u.top_id=$id AND u.user_id=o.user_id $where "
                . "AND o.order_num=sub.order_num and o.bet_time>='$s_time' and o.bet_time<='$e_time' "
                . "GROUP BY u.id ORDER BY u.regtime DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    static public function bbUserSix($id, $s_time, $e_time, $status='') {
        if($status == 1){
            $where = " and o.status in (1,2) ";
        }else{
            $where = " and o.status in (0,3) ";
        }
        $sql = "SELECT SUM(IF(sub.bet_money>0,IF(sub.is_win!=2,sub.bet_money,0),0)) bet_money_total,"
                . "SUM(IF(sub.is_win=1,sub.win+sub.fs,IF(is_win=0,fs,0))) win_total,u.id "
                . "FROM user_list u,six_lottery_order o ,six_lottery_order_sub sub "
                . "WHERE u.top_id=$id "
                . "AND u.user_id=o.user_id AND o.order_num=sub.order_num $where "
                . "and o.bet_time>='$s_time' and o.bet_time<='$e_time' GROUP BY u.id "
                . "ORDER BY u.regtime DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    static public function bbUserSpSix($id, $s_time, $e_time, $status='') {
        if($status == 1){
            $where = " and o.status in (1,2) ";
        }else{
            $where = " and o.status in (0,3) ";
        }
        $sql = "SELECT SUM(IF(sub.bet_money>0,IF(sub.is_win!=2,sub.bet_money,0),0)) bet_money_total,"
                . "SUM(IF(sub.is_win=1,sub.win+sub.fs,IF(is_win=0,fs,0))) win_total,u.id "
                . "FROM user_list u,spsix_lottery_order o ,spsix_lottery_order_sub sub "
                . "WHERE u.top_id=$id "
                . "AND u.user_id=o.user_id AND o.order_num=sub.order_num $where "
                . "and o.bet_time>='$s_time' and o.bet_time<='$e_time' GROUP BY u.id "
                . "ORDER BY u.regtime DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }


    static public function bbUserCg($id, $s_time, $e_time, $status='') {
//        if($status == 1){
//            $where = " and k.status in (1,2) ";
//        }else{
//            $where = " and k.status in (0,3) ";
//        }
//        $sql = "SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.id "
//                . "FROM user_list u,k_bet_cg_group k "
//                . "WHERE u.top_id=$id AND k.check=1 $where "
//                . "AND u.user_id=k.user_id and k.bet_time>='$s_time' and k.bet_time<='$e_time' "
//                . "GROUP BY u.id ORDER BY u.regtime DESC ";
        $sql = "SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.id 
                  FROM user_list u,k_bet_cg_group k 
                  WHERE u.top_id=$id AND u.top_id!=0 AND k.status!=0 AND k.status!=3 AND k.check=1 
                  AND u.user_id=k.user_id and k.bet_time>='$s_time' and k.bet_time<='$e_time' 
                  GROUP BY u.id ORDER BY u.regtime DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    static public function bbUserDs($id, $s_time, $e_time, $status='') {
//        if($status == 1){
//            $where = " and k.status in (1,2) ";
//        }else{
//            $where = " and k.status in (0,3) ";
//        }
//        $sql = "SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.id "
//                . "FROM user_list u,k_bet k "
//                . "WHERE u.top_id=$id AND k.check!=0 $where "
//                . "AND u.user_id=k.user_id and k.bet_time>='$s_time' and k.bet_time<='$e_time' "
//                . "GROUP BY u.id ORDER BY u.regtime DESC";
        $sql = "SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.id 
                  FROM user_list u,k_bet k 
                  WHERE u.top_id=$id AND u.top_id!=0 AND k.status!=0 AND k.status!=3 
                  AND k.check!=0 AND u.user_id=k.user_id and k.bet_time>='$s_time' and k.bet_time<='$e_time' 
                  GROUP BY u.id ORDER BY u.regtime DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    static public function bbUserLive($id, $s_time, $e_time) {
        $sql = "SELECT SUM(IF(lo.bet_money>0,lo.bet_money,0)) bet_money_total,SUM(IF(lo.live_win is not null,lo.live_win,0)) win_total,u.id "
                . "FROM user_list u,live_user l,live_order lo "
                . "WHERE u.top_id=$id AND u.top_id!=0 AND l.user_id=u.user_id AND lo.game_type=l.live_type "
                . "AND l.live_username=lo.live_username and lo.order_time>='$s_time' "
                . "and lo.order_time<='$e_time' GROUP BY u.id ORDER BY u.regtime DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    /**
     * 代理下属会员游戏报表N连发(代理下属会员结算，未结算，已中奖，未中奖，平局，游戏类型，彩种类型，赔率......疯了··)
     * @param type $user_id     下属会员ID
     * @param type $s_time       开始时间
     * @param type $e_time       结束时间
     */
    // static public function OneUserSport($user_id, $s_time, $e_time) {
    //     $sql = "SELECT COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(bet_money,0)),0) AS bet_money,SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money "
    //             . "FROM k_bet WHERE bet_time>= '$s_time' AND bet_time<='$e_time' "
    //             . "AND user_id=$user_id  AND status!=0 AND status!=3 AND `check`!=0 LIMIT 0,1";
    //     $rs = UserList::findBySql($sql)->asArray()->one();
    //     return $rs;
    // }

    static public function OneUserCg($user_id, $s_time, $e_time) {
        $sql = "SELECT COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(bet_money,0)),0) AS bet_money,SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money "
                . "FROM k_bet_cg_group WHERE bet_time>= '$s_time' AND bet_time<='$e_time' "
                . "AND user_id=$user_id AND status!=0 AND status!=3 AND `check`!=0 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    static public function OneUserLottery($user_id, $s_time, $e_time) {
        $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    static public function OneUserSix($user_id, $s_time, $e_time) {
        $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub "
                . "WHERE o.order_num=o_sub.order_num AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    static public function OneUserSpSix($user_id, $s_time, $e_time) {
        $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM spsix_lottery_order o,spsix_lottery_order_sub o_sub "
                . "WHERE o.order_num=o_sub.order_num AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    public static function OneUserEvent($user_id,$s_time,$e_time){
        $sql = "SELECT COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(bet_money,0)),0) AS bet_money "
            . "FROM event_order WHERE "
            . "bet_time>= '$s_time' AND bet_time<='$e_time' "
            . "AND user_id=$user_id AND status!=0 AND status!=3 AND is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    static public function OneUserLive($user_id, $s_time, $e_time) {
        $sql = "SELECT count(lo.id) bet_count,IFNULL(SUM(IF(lo.bet_money>0,lo.bet_money,0)),0) bet_money,"
                . "IFNULL(SUM(IF(lo.valid_bet_amount>0,lo.valid_bet_amount,0)),0) valid_money,"
                . "IFNULL(SUM(IF(lo.live_win is not null,lo.live_win,0)),0) win FROM live_user l,live_order lo "
                . "WHERE l.live_username=lo.live_username AND l.live_type=lo.game_type "
                . "AND lo.order_time>= '$s_time' AND lo.order_time<='$e_time' "
                . "AND l.user_id =$user_id LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    static public function OneUserLotteryWin($user_id, $s_time, $e_time) {
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o_sub.is_win = '1' AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $rs1 = UserList::findBySql($sql)->asArray()->one();
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time'  "
                . "AND o_sub.is_win =0 AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $rs2 = UserList::findBySql($sql)->asArray()->one();
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time'  "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $rs3 = UserList::findBySql($sql)->asArray()->one();
        return $rs1['win_money'] + $rs2['win_fs'] + $rs3['win_back'];
    }

    static public function OneUserSixWin($user_id, $s_time, $e_time) {
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs1 = UserList::findBySql($sql)->asArray()->one();
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o_sub.is_win = '0' AND o.user_id=$user_id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs2 = UserList::findBySql($sql)->asArray()->one();
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.user_id=$user_id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs3 = UserList::findBySql($sql)->asArray()->one();
        return $rs1['win_money'] + $rs2['win_fs'] + $rs3['win_back'];
    }

    static public function OneUserSpSixWin($user_id, $s_time, $e_time) {
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM spsix_lottery_order o,spsix_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs1 = UserList::findBySql($sql)->asArray()->one();
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM spsix_lottery_order o,spsix_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o_sub.is_win = '0' AND o.user_id=$user_id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs2 = UserList::findBySql($sql)->asArray()->one();
        $sql = "SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM spsix_lottery_order o,spsix_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.user_id=$user_id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs3 = UserList::findBySql($sql)->asArray()->one();
        return $rs1['win_money'] + $rs2['win_fs'] + $rs3['win_back'];
    }

    public static function OneUserEventWin($user_id,$s_time,$e_time){
        $sql="SELECT IFNULL(SUM(IFNULL(win,0)+IFNULL(fs,0)),0) AS win_money "
            . "FROM event_order WHERE "
            . "bet_time>= '$s_time' AND bet_time<='$e_time' "
            . "AND is_win = '1' AND user_id=$user_id AND status!=0 AND status!=3 "
            . "AND is_win!=2 LIMIT 0,1";
        $rs1 = UserList::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(fs,0)),0) AS win_fs "
            . "FROM event_order "
            . "WHERE bet_time>= '$s_time' AND bet_time<='$e_time'  "
            . "AND is_win =0  AND user_id=$user_id AND status!=0 AND status!=3 "
            . "AND is_win!=2 LIMIT 0,1";
        $rs2 = UserList::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(bet_money,0)),0) AS win_back "
            . "FROM event_order "
            . "WHERE bet_time>= '$s_time' AND bet_time<='$e_time'  "
            . "AND (is_win = '2' OR is_win = '3') AND user_id=$user_id AND status!=0 AND status!=3 "
            . "AND is_win!=2 LIMIT 0,1";
        $rs3 = UserList::findBySql($sql)->asArray()->one();
        return $rs1['win_money']+$rs2['win_fs']+$rs3['win_back'];
    }

    static public function getCqkNews($s_time, $e_time, $top_id, $status, $userArray = '',$sum_top_id= '') {
        $r = UserList::find()
                ->select([
                    'u.user_name', 'm.status', 'm.order_value', 'm.order_num', 'm.update_time', 'm.about', 'm.id',
                    'm.assets', 'm.balance', 'm.type', 'm.pay_card',
                ])
                ->from('user_list as u')
                ->innerJoin('money as m', 'm.user_id=u.user_id')
                ->Where("m.update_time >= '$s_time'")
                ->andWhere("m.update_time <= '$e_time'")
				->andWhere(['and', ['not like', 'about', '用于活动']]);
        if($sum_top_id){
            $r->andWhere("u.sum_top_id = $sum_top_id");
        }else{
            $r->andWhere("u.top_id = $top_id");
        }
        if ($status) {
            $r->andWhere("m.status = '$status' ");
        }
        if ($userArray) {
            $r->andWhere(['in', 'u.user_name', $userArray]);
        }
        $r->orderBy('m.update_time desc');
        return $r;
    }

    static public function Test($id,$s_time,$e_time) {
        $r=(new \yii\db\Query())
                ->select([
                    'u1.user_id','u1.user_name as uname','t1.cg_bm','t1.cg_wm'
                    ])
                ->from("(select user_id,uesr_name from user_list where top_id=$id order by id desc)as u1")
                ->leftJoin("(select user_id,SUM(bet_money) cg_bm,SUM(win) cg_wm from k_bet_cg_group "
                        . "where `status` NOT IN (1, 2) and bet_time >= '$s_time' and bet_time <='$e_time' "
                        . "order by user_id asc) as t1","u1.user_id = t1.user_id")
                ->all();
         return $r;
    }

    public static function getLiveOrderResult($user_id, $s_time, $e_time,$egames){
        $liveNames = LiveOrder::find()->select(['live_username'])->from('live_user')->where(['user_id'=>$user_id])->asArray()->all();
        $r = LiveOrder::find()
            ->select(['count(id) as bet_count','sum(bet_money) as bet_money','sum(valid_bet_amount) as valid_bet_amount','sum(live_win) as live_win'])
            ->from('live_order')
            ->where(['and', ['>=', 'order_time', $s_time], ['<=', 'order_time', $e_time]])
            ->andWhere(['in','live_username',$liveNames])
            ->andWhere(['in','live_type', $egames['egametype']]);
//            ->createCommand()->getRawSql();
//        return $r;
        return $r->asArray()->one();
    }
}
