<?php
namespace app\modules\agent\models;

use yii;
use yii\db\ActiveRecord;
/**
 * 用戶表操作
 * UserList is the model behind the agents_list.
 */
class UserList extends ActiveRecord{

    public static function getUserIdByTopid($top_id){
        $r = UserList::find()
            ->select('user_id')
            ->where(['top_id'=>$top_id])
            ->asArray()
            ->all();
        return $r;
    }

    public static function getUserNewsByUserId($user_id){
        $r = UserList::find()
            ->select(['id','user_name','user_id','top_id'])
            ->where(['user_id'=>$user_id])
            ->orderBy('id DESC');
        return $r;
    }

    public static function getUserNameByUserId($user_id){
        $r = UserList::find()
                ->select('user_name')
                ->where(['user_id'=>$user_id])
                ->asArray()
                ->one();
        return $r;
    }
    /**
     * 更新會員的上屬代理信息，為主網站
     * @param type $uid         代理ID集合
     * @return type
     */
    public static function updateUserTopId($uid){
        $sql = 'update user_list set top_id=\'\' where top_id in (' . $uid . ')';
        $result = yii::$app->db->createCommand($sql)->execute(); 
        return $result;
    }
    
    public static function getUserIdJoinAgents($id){
        $user_id_arr = UserList::find()
                ->select(['u.id'])
                ->from('user_list as u')
                ->innerJoin('agents_list as a',"a.id = u.top_id")
                ->where(['a.id'=>$id])
                ->orderBy('u.id')
                ->asArray()
                ->all();
        return $user_id_arr;
    }
    /**
     * 獲取指定id的會員信息
     * @param type $id_arr
     * @return type
     */
    public static function getUserNewsByIdArray($id_arr){
        $res = UserList::find()
                ->select(['id','user_name','user_id','money','Oid','regtime','logintime','pay_name'])
                ->from('user_list')
                ->where(['in','id',$id_arr])
                ->orderBy('id desc');
          return $res;
    }
    
    /**
     * 代理下屬會員報表明細5連發
     * @param type $id              代理ID
     * @param type $s_time      開始時間
     * @param type $e_time      結束時間
     * @return type
     */
    public static function bbUserLottery($id,$s_time,$e_time){
        $sql = "SELECT SUM(IF(sub.bet_money>0,IF(sub.is_win!=2,sub.bet_money,0),0)) bet_money_total,"
                . "SUM(IF(sub.is_win=1,sub.win+sub.fs,IF(is_win=0,fs,0))) win_total,u.id "
                . "FROM user_list u,order_lottery o,order_lottery_sub sub "
                . "WHERE u.top_id=$id AND u.top_id!=0 AND o.status!='0' AND o.status!='3' AND u.user_id=o.user_id "
                . "AND o.order_num=sub.order_num and o.bet_time>='$s_time' and o.bet_time<='$e_time' "
                . "GROUP BY u.id ORDER BY u.id DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbUserSix($id,$s_time,$e_time){
        $sql="SELECT SUM(IF(sub.bet_money>0,IF(sub.is_win!=2,sub.bet_money,0),0)) bet_money_total,"
                . "SUM(IF(sub.is_win=1,sub.win+sub.fs,IF(is_win=0,fs,0))) win_total,u.id "
                . "FROM user_list u,six_lottery_order o ,six_lottery_order_sub sub "
                . "WHERE u.top_id=$id AND u.top_id!=0 AND o.status!='0' AND o.status!='3' "
                . "AND u.user_id=o.user_id AND o.order_num=sub.order_num "
                . "and o.bet_time>='$s_time' and o.bet_time<='$e_time' GROUP BY u.id "
                . "ORDER BY u.id DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbUserCg($id,$s_time,$e_time){
        $sql="SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.id "
                . "FROM user_list u,k_bet_cg_group k "
                . "WHERE u.top_id=$id AND u.top_id!=0 AND k.status!=0 AND k.status!=3 AND k.check=1 "
                . "AND u.user_id=k.user_id and k.bet_time>='$s_time' and k.bet_time<='$e_time' "
                . "GROUP BY u.id ORDER BY u.id DESC ";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbUserDs($id,$s_time,$e_time){
        $sql="SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.id "
                . "FROM user_list u,k_bet k "
                . "WHERE u.top_id=$id AND u.top_id!=0 AND k.status!=0 AND k.status!=3 AND k.check!=0 "
                . "AND u.user_id=k.user_id and k.bet_time>='$s_time' and k.bet_time<='$e_time' "
                . "GROUP BY u.id ORDER BY u.id DESC";
        $rs = UserList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbUserLive($id,$s_time,$e_time){
        //原下注金額 bet_money 改為 valid_bet_amount
		$sql = "SELECT
					SUM(IF(lo.valid_bet_amount>0,lo.valid_bet_amount,0)) bet_money_total,
					SUM(IF(lo.live_win is not null,lo.live_win,0)) win_total,u.id
				FROM
					user_list u
					inner join live_user l on l.user_id=u.user_id 
					inner join live_order lo on lo.game_type=l.live_type AND l.live_username = lo.live_username 
				WHERE
					u.top_id = ".$id."
					and u.top_id!=0
					and lo.order_time >= '".$s_time."'
					and lo.order_time <= '".$e_time."'
				GROUP BY
					u.id
				ORDER BY
					u.id DESC";
		//因為 live_order 沒有對應資料，需另外抓'YOPLAY','AG_HUNTER','XIN'
		$sql1 = "SELECT
					SUM(IF(lo.valid_bet_amount>0,lo.valid_bet_amount,0)) bet_money_total,
					SUM(IF(lo.live_win is not null,lo.live_win,0)) win_total,
					u.id
				FROM
					user_list u
					inner join live_user l on l.user_id = u.user_id  and l.live_type = 'AG'
					inner join live_order lo on lo.game_type in ('YOPLAY','AG_HUNTER','XIN') AND l.live_username = lo.live_username
				WHERE
					u.top_id = ".$id."
					and u.top_id!=0
					and lo.order_time >= '".$s_time."'
					and lo.order_time <= '".$e_time."'
				GROUP BY
					u.id
				ORDER BY
					u.id DESC";
		$responseData = [];
        $rs = UserList::findBySql($sql)->asArray()->all();
		foreach($rs as $key1 => $value1){
			$responseData[$value1['id']]['bet_money_total'] = $value1['bet_money_total'];
			$responseData[$value1['id']]['win_total'] = $value1['win_total'];
			$responseData[$value1['id']]['id'] = $value1['id'];
		}
		
        $rs = UserList::findBySql($sql1)->asArray()->all();
        foreach($rs as $key1 => $value1){
			if(isset($responseData[$value1['id']])){
				$responseData[$value1['id']]['bet_money_total'] += $value1['bet_money_total'];
				$responseData[$value1['id']]['win_total'] += $value1['win_total'];
				$responseData[$value1['id']]['id'] = $value1['id'];
			}else{
				$responseData[$value1['id']]['bet_money_total'] = $value1['bet_money_total'];
				$responseData[$value1['id']]['win_total'] = $value1['win_total'];
				$responseData[$value1['id']]['id'] = $value1['id'];
			}
		}

        return $responseData;
    }
    
    public static function getUserIdByUserName($top_id,$where){
        $sql="select id from user_list where top_id='$top_id'";
        $sql .=$where;
        $sql .= ' GROUP by id ';
        $res = UserList::findBySql($sql)->asArray()->all();
        return $res;
    }
    
    public static function getUserNewsForAgents($id){
        $res = UserList::find()
                ->select(['id','user_name','user_id'])
                ->where(['in','id',$id])
                ->orderBy('id DESC');
        return $res;
    }
    
    /**
     * 代理下屬會員遊戲報表N連發(代理下屬會員結算，未結算，已中獎，未中獎，平局，遊戲類型，彩種類型，賠率......瘋了··)
     * @param type $user_id     下屬會員ID
     * @param type $top_id       代理ID
     * @param type $s_time       開始時間
     * @param type $e_time       結束時間
     */
    public static function OneUserSport($user_id,$s_time,$e_time){
        $sql="SELECT COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(bet_money,0)),0) AS bet_money,SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money "
                . "FROM k_bet WHERE bet_time>= '$s_time' AND bet_time<='$e_time' "
                . "AND user_id=$user_id  AND status!=0 AND status!=3 AND `check`!=0 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function OneUserCg($user_id,$s_time,$e_time){
        $sql = "SELECT COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(bet_money,0)),0) AS bet_money,SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money "
                . "FROM k_bet_cg_group WHERE bet_time>= '$s_time' AND bet_time<='$e_time' "
                . "AND user_id=$user_id AND status!=0 AND status!=3 AND `check`!=0 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function OneUserLottery($user_id,$s_time,$e_time){
        $sql = "SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function OneUserSix($user_id,$s_time,$e_time){
        $sql="SELECT COUNT(o_sub.id) AS bet_count, IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS bet_money "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub "
                . "WHERE o.order_num=o_sub.order_num AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs = UserList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function OneUserLive($user_id,$s_time,$e_time){
		$sql = "SELECT
					count(lo.id) bet_count,
					IFNULL(SUM(IF(lo.bet_money > 0,lo.bet_money,0)),0) bet_money,
					IFNULL(SUM(IF(lo.valid_bet_amount > 0,lo.valid_bet_amount,0)),0) val_money,
					IFNULL(SUM(IF(lo.live_win is not null,lo.live_win,0)),0) win
				FROM
					live_user l
					inner join live_order lo on l.live_username=lo.live_username AND l.live_type=lo.game_type
				WHERE
					l.user_id = ".$user_id."
					and lo.order_time >= '".$s_time."'
					and lo.order_time <= '".$e_time."'";

		$sql1 = "SELECT
					count(lo.id) bet_count,
					IFNULL(SUM(IF(lo.bet_money > 0,lo.bet_money,0)),0) bet_money,
					IFNULL(SUM(IF(lo.valid_bet_amount > 0,lo.valid_bet_amount,0)),0) val_money,
					IFNULL(SUM(IF(lo.live_win is not null,lo.live_win,0)),0) win
				FROM
					live_user l
					inner join live_order lo on lo.game_type in ('YOPLAY','AG_HUNTER','XIN') AND l.live_username = lo.live_username
				WHERE
					l.user_id = ".$user_id."
					and lo.order_time >= '".$s_time."'
					and lo.order_time <= '".$e_time."'
					and l.live_type = 'AG'";
		
		$responseData = [];
        $rs = UserList::findBySql($sql)->asArray()->one();
		$responseData = $rs;
		
		$rs = UserList::findBySql($sql1)->asArray()->one();
		$responseData['bet_count'] += $rs['bet_count'];
		$responseData['bet_money'] += $rs['bet_money'];
		$responseData['val_money'] += $rs['val_money'];
		$responseData['win'] += $rs['win'];

        return $responseData;
    }
    public static function OneUserLotteryWin($user_id,$s_time,$e_time){
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o_sub.is_win = '1' AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $rs1 = UserList::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time'  "
                . "AND o_sub.is_win =0 AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $rs2 = UserList::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM order_lottery o,order_lottery_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time'  "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 "
                . "AND o_sub.is_win!=2 LIMIT 0,1";
        $rs3 = UserList::findBySql($sql)->asArray()->one();
        return $rs1['win_money']+$rs2['win_fs']+$rs3['win_back'];
    }
    public static function OneUserSixWin($user_id,$s_time,$e_time){
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.win,0)+IFNULL(o_sub.fs,0)),0) AS win_money "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' AND o_sub.is_win = '1' "
                . "AND o.user_id=$user_id AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs1 = UserList::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.fs,0)),0) AS win_fs "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND o_sub.is_win = '0' AND o.user_id=$user_id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs2 = UserList::findBySql($sql)->asArray()->one();
        $sql="SELECT IFNULL(SUM(IFNULL(o_sub.bet_money,0)),0) AS win_back "
                . "FROM six_lottery_order o,six_lottery_order_sub o_sub WHERE o.order_num=o_sub.order_num "
                . "AND o.bet_time>= '$s_time' AND o.bet_time<='$e_time' "
                . "AND (o_sub.is_win = '2' OR o_sub.is_win = '3') AND o.user_id=$user_id "
                . "AND o.status!=0 AND o.status!=3 AND o_sub.is_win!=2 LIMIT 0,1";
        $rs3 = UserList::findBySql($sql)->asArray()->one();
        return $rs1['win_money']+$rs2['win_fs']+$rs3['win_back'];
    }
    
    
    
}
