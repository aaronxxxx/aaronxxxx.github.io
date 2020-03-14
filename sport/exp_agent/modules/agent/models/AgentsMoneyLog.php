<?php
namespace app\modules\agent\models;

use yii;
use yii\db\ActiveRecord;
/**
 * 代理金額表
 * AgentsMoneyLog is the model behind the agents_list.
 */
class AgentsMoneyLog extends ActiveRecord{
    
    /**
     * 刪除代理的結算日誌
     * @param type $uid
     * @return type
     */
    static public function deleteAgentMoneyLog($uid){
        $sql = 'delete from agents_money_log where agents_id in (' . $uid . ')';
        $result = yii::$app->db->createCommand($sql)->execute(); 
        return $result;
    }
    
    /**
     * 獲取代理明細的ID集合
     * @param type $id      代理ID
     */
    static public function getAccountId($id){
        $account = AgentsMoneyLog::find()
                ->select(array('id'))
                ->where(['agents_id'=>$id])
                ->asArray()
                ->all();
        return $account;
    }

     /**
     * 查詢代理結算明細
     * @param type $id      查詢的代理結算ID集合
     * @return type
     */
    static public function getAccountList($id){
        $list = AgentsMoneyLog::find()
                ->select(["al.*","a.agents_name"])
                ->from("agents_money_log as al")
                ->innerJoin("agents_list as a","al.agents_id=a.id")
                ->where(['in','al.id',$id])
                ->orderBy('al.do_time desc');
        return $list;
    }
    
    /**
     * 查找代理結算的時間
     * @param type $id      代理ID
     */
    static public function getJstime($id){
        $sql = 'select s_time,e_time from agents_money_log where agents_id=' . $id;
        $rs = AgentsMoneyLog::findBySql($sql)->asArray()->all();
        return $rs;
    }
    /**
     * 結算入庫
     * @param type $id                  代理ID
     * @param type $money          結算金額
     * @param type $s_time          開始時間
     * @param type $e_time          結算時間
     * @param type $ledger          流水總額
     * @param type $profig          盈利總額
     * @param type $ratio             成分比例
     * @return type
     */
    static public function addAgentsMoneyLog($id,$money,$s_time,$e_time,$ledger,$profig,$ratio,$settlement_type,$refund_scale,$company_profit){
        $res = new AgentsMoneyLog;
        $res->agents_id = $id;
        $res->money = $money;
        $res->s_time =$s_time;
        $res->e_time = $e_time;
        $res->do_time = date('Y-m-d H:i:s');
        $res->ledger=$ledger;
        $res->profig = $profig;
        $res->ratio = $ratio;
        $res->settlement_type = $settlement_type;
        $res->refund_scale = $refund_scale;
        $res->company_profit = $company_profit;
        $r = $res->save();
        return $r;
    }

    /**
     * 查詢一段時間內的結算明細 公司對此總代理的撥款
     * @param type stime,etime
     * @return type
     */
     public static function getListByTimeSumagent($s_time,$e_time,$agent_id){
        $list = AgentsMoneyLog::find()
                ->select(["al.*","a.agents_name"])
                ->from("agents_money_log as al")
                ->innerJoin("agents_list as a","al.agents_id=a.id")
                ->where("al.s_time >= '$s_time'")
                ->andwhere("al.s_time <= '$e_time'")
                ->andwhere("a.id = '$agent_id'")
                ->andwhere("a.agent_level = '0'")
                ->orderBy('al.s_time desc')
                ->asArray()
                ->all();
        return $list;
    }

    /**
     * 查詢一段時間子代理在一段時間內的獲利
     * @param type stime,etime
     * @return type
     */
     public static function getAgentNews($s_time,$e_time,$agent_id){
        $list = AgentsMoneyLog::find()
                ->select(["sum(ledger) as ledger","sum(profig) as profig","sum(money) as money"])
                ->from("agents_money_log as al")
                ->where("al.s_time >= '$s_time'")
                ->andwhere("al.s_time <= '$e_time'")
                ->andwhere("al.agents_id = '$agent_id'")
                ->orderBy('al.s_time desc')
                ->asArray()
                ->one();
        return $list;
    }
}
