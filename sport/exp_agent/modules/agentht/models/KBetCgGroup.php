<?php
namespace app\modules\agentht\models;

use yii\db\ActiveRecord;
/**
 * KBetCgGroup
 * KBetCgGroup is the model behind the agents_list.
 */
class KBetCgGroup extends ActiveRecord{
    
    /**
     * 串关下注笔数，和投注金额
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    static public function getBetMoneyAndCountCg($s_time, $e_time, $id) {
        $sql="select COUNT(id) AS bet_count, IFNULL(SUM(IFNULL(bet_money,0)),0) AS bet_money "
                . "from k_bet_cg_group "
                . "where bet_time>= '$s_time' and bet_time<='$e_time' and user_id=$id "
                . "and status!=0 and status!=3 and `check`!=0 limit 0,1";
        $rs = KBetCgGroup::findBySql($sql)->asArray()->one();
        return $rs;
    }
    
    /**
     * 串关赢取的金额
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    static public function getWinCg($s_time, $e_time, $id) {
        $sql="select SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money from k_bet_cg_group "
                . "where bet_time>= '$s_time' and bet_time<='$e_time' and user_id=$id "
                . "and status!=0 and status!=3 and `check`!=0 limit 0,1";
        $rs = KBetCgGroup::findBySql($sql)->asArray()->one();
        return $rs;
    }
    
    /**
     * 串关的订单ID
     * @param type $s_time
     * @param type $e_time
     * @param type $id
     * @return type
     */
    static public function getOrderIdCg($s_time, $e_time, $id){
        $sql="select id from k_bet_cg_group where 1=1 AND user_id=$id and bet_time>='$s_time' and bet_time<='$e_time' "
                . "AND status!=0 AND status!=3 AND `check`!=0 order by bet_time desc";
        $rs = KBetCgGroup::findBySql($sql)->asArray()->all();
        return $rs;
    }
    
    /**
     * 串关已结算
     */
    static public function getOrderCgYjs($arr_id){
        $arr = ['0','3'];
        $r = KBetCgGroup::find()
                ->select(['gid','count(*) as num'])
                ->from('k_bet_cg')
                ->where(['not in','status',$arr])
                ->andWhere(['in','gid',$arr_id ])
                ->groupBy('gid')
                ->asArray()->all();
        return $r;
    }
    
    /**
     * 串关订单详情
     * @param type $arr_id
     * @return type
     */
    static public function getOrderDelailCg($arr_id){
        $r = KBetCgGroup::find()
                ->select([
                    'id','order_num','cg_count','bet_win','bet_money','win',
                    'bet_time','bet_time_et','status','balance','assets',
                    'www','fs'
                    ])
                ->from('k_bet_cg_group')
                ->where(['in','id',$arr_id])
                ->orderBy('id desc');
        return $r;
    }
}

