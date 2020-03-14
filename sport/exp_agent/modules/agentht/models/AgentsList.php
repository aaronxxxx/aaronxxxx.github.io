<?php
namespace app\modules\agentht\models;

use yii;
use yii\db\ActiveRecord;

/**
 * 代理表操作
 * AgentsList is the model behind the agents_list.
 */
class AgentsList extends ActiveRecord {
    
    /**
     * 代理登入
     * @param type $agents_name         代理用户名
     * @param type $agents_pass           密码
     * @return type
     */
    static public function AgentLogin($agents_name,$agents_pass){
        $res = AgentsList::findOne(['agents_name'=>$agents_name,'agents_pass'=>$agents_pass,'status'=>'正常']);
        return $res;        
    }
    /**
     * 通过ID获取单个代理会员
     * @param type $uid
     * @return type
     */
    static public function getAgentsNewsByID($uid) {
        $agents_list = AgentsList::find()
                ->where(['id' => $uid])
                ->asArray()
                ->one();
        return $agents_list;
    }
    /**
     * 通過總代ID獲取底下代理會員
     * @param type $uid
     * @return type
     */
    static public function getAgentsNewsByLevel($uid, $level = 1) {
        if( $level == 0){
            $agents_list = AgentsList::find()
                ->select(['id','agents_name'])
                ->where(['agent_level' => $uid])
                ->asArray()
                ->all();
        } else {
            $agents_list = AgentsList::find()
                ->select(['id','agents_name'])
                ->where(['id' => $uid])
                ->asArray()
                ->all();
        }
        return $agents_list;
    }
    /**
     * 代理报表金额5连发
     * @param type $id              代理ID
     * @param type $s_time      结算开始时间
     * @param type $e_time      结算结束时间
     * @return type                     结果集
     */
    static public function bbAgentLottery($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, order_lottery o, order_lottery_sub sub "
                . "WHERE a.id =$id AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    static public function bbAgentSix($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, six_lottery_order o, six_lottery_order_sub sub "
                . "WHERE a.id =$id AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    static public function bbAgentDs($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( k.bet_money > 0, k.bet_money, 0 )) bet_money_total, "
                . "SUM( IF (k.win > 0, k.win, 0) + IF (k.fs > 0, k.fs, 0)) win_total, u.top_id "
                . "FROM agents_list a, user_list u, k_bet k "
                . "WHERE a.id =$id AND a.id = u.top_id AND u.top_id != 0 AND k.status != 0 AND k.status != 3 AND k.check != '0' "
                . "AND u.user_id = k.user_id AND k.bet_time >= '$s_time' AND k.bet_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    static public function bbAgentCg($id, $s_time, $e_time){
        $sql="SELECT SUM(IF(k.bet_money>0,k.bet_money,0)) bet_money_total,SUM(IF(k.win>0,k.win,0)+IF(k.fs>0,k.fs,0)) win_total,u.top_id
                    FROM agents_list a,user_list u,k_bet_cg_group k
                    WHERE a.id =$id AND a.id=u.top_id AND u.top_id!=0 AND k.status!=0 AND k.status!=3 AND k.check=1 AND u.user_id=k.user_id
                     and k.bet_time>='$s_time'  and k.bet_time<='$e_time'  GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    static public function bbAgentLive($id, $s_time, $e_time){
        $sql="SELECT SUM( IF ( lo.bet_money > 0, lo.bet_money, 0 )) bet_money_total, SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total, u.top_id "
                . "FROM agents_list a, user_list u, live_user l, live_order lo WHERE a.id =$id AND a.id = u.top_id AND u.top_id != 0 "
                . "AND l.user_id = u.user_id AND lo.game_type = l.live_type AND l.live_username = lo.live_username "
                . "AND lo.order_time >= '$s_time' AND lo.order_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    
}
