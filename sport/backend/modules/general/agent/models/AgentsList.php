<?php
namespace app\modules\general\agent\models;

use yii;
use yii\db\ActiveRecord;

/**
 * 代理表操作
 * AgentsList is the model behind the agents_list.
 */
class AgentsList extends ActiveRecord {


    //对代理中根据查询的用户名和忽略的用户名查到指定的用户id
    public static function getAgentIdByAgentsName2($agents_name,$agentsIgnoreName) {
        $agentsid = AgentsList::find()
            ->select("id")
            ->where("1=1");
        if($agents_name[0]){
            $agentsid = $agentsid->andWhere(["agents_name"=>$agents_name]);
        }
        if($agentsIgnoreName[0]){
            $agentsid = $agentsid->andWhere(["not in","agents_name",$agentsIgnoreName]);
        }
        $agentsid = $agentsid->asArray()->all();
        return $agentsid;
    }


    /**
     * 获取總代理会员的信息
     */
    public static function getAgentsAll($sum = 0) {
        $columns = array('id','agents_name','agents_type');
        if($sum==0){
            $agents_list = AgentsList::find()
                ->select($columns)
                ->where(['<>','agent_level', 0])
                ->orderBy("regtime DESC");
            return $agents_list;
        }else{
            $agents_list = AgentsList::find()
                ->select($columns)
                ->where(['=','agent_level', 0])
                ->orderBy("regtime DESC");
            return $agents_list;
        }

    }

    /**
     * 获取代理会员的信息
     */
    public static function getAgentsNews($sum = 0) {
        if($sum==0){
            $agents_list = AgentsList::find()
                ->where(['<>','agent_level', 0])
                ->orWhere('agent_level IS NULL')
                ->orderBy("regtime DESC");
            return $agents_list;
        }else{
            $agents_list = AgentsList::find()
                ->where(['=','agent_level', 0])
                ->orderBy("regtime DESC");
            return $agents_list;
        }

    }
    /**
     * 通过ID获取单个代理会员
     * @param type $uid
     * @return type
     */
    public static function getAgentsNewsByID($uid) {
        $agents_list = AgentsList::find()
                ->where(['id' => $uid])
                ->asArray()
                ->one();
        return $agents_list;
    }

    /**
     * 通過ID獲取總代理下的代理
     * @param type $uid
     * @return type
     */
    public static function getAgentsNewsBySumID($uid) {
        $agents_list = AgentsList::find()
            ->where(['agent_level' => $uid])
            ->asArray()
            ->all();
        return $agents_list;
    }

    /**
     * 根据指定的条件获取代理会员信息
     * @param type $type            条件
     * @param type $news           满足条件的参数
     */
    public static function getAgentsNewsByNews($type, $news, $sum=0) {
        if($sum==0){
            if ($type == 'remark') {
                $agents_list = AgentsList::find()
                        ->where(['remark'=>null]);
    //                    ->where(['or', "remark='' ", "remark=null"]);
                return $agents_list;
            }
            $agents_list = AgentsList::find()
                    ->where([$type => $news]);
            return $agents_list;
        }else{
            if ($type == 'remark') {
                $agents_list = AgentsList::find()
                    ->where(['remark'=>null])
                    ->andWhere(['=','agent_level', 0]);
                return $agents_list;
            }
            $agents_list = AgentsList::find()
                ->where([$type => $news])
                ->andWhere(['=','agent_level', 0]);
            return $agents_list;
        }
    }

    /**
     * 添加新注册的總代理账号
     * @param type $form
     */
    public static function addSumAgents($form) {
        $agent = new AgentsList;
        $agent->agents_name = $form['agents_name'];
        $pass = md5('0z' . md5($form['agents_pass'] . 'w0'));
        $agent->agents_pass = $pass;
        $agent->agent_url = $form['agent_url'];
        $agent->loginip = '';
        $agent->logintime = '0000-00-00 00:00:00';
        $agent->regtime = date('Y-m-d H:i:s');
        $agent->online = 0;
        $agent->lognum = 0;
        $agent->status = '正常';
        $agent->tel = $form['tel'];
        $agent->email = $form['email'];
        $agent->qq = '1234';
        $agent->othercon = $form['othercon'];
        $agent->agents_type = $form['agents_type'];
        $agent->total_1_1 = 0;
        $agent->total_1_2 = $form['total_1_2'];
        $agent->total_1_scale = $form['total_1_scale'];
        $agent->total_2_1 = $form['total_2_1'];
        $agent->total_2_2 = $form['total_2_2'];
        $agent->total_2_scale = $form['total_2_scale'];
        $agent->total_3_1 = $form['total_3_1'];
        $agent->total_3_2 = $form['total_3_2'];
        $agent->total_3_scale = $form['total_3_scale'];
        $agent->total_4_1 = $form['total_4_1'];
        $agent->total_4_2 = $form['total_4_2'];
        $agent->total_4_scale = $form['total_4_scale'];
        // $agent->total_5_1 = $form['total_5_1'];
        // $agent->total_5_2 = $form['total_5_2'];
        // $agent->total_5_scale = $form['total_5_scale'];
        $agent->refunded_scale = $form['refunded_scale'];
        $agent->remark = 1;
        $agent->agent_level = 0;
        $agent->limit_money = $form['limit_money'];
        $agent->money = $form['limit_money'];
        $agent->save();
    }

    /**
     * 添加新注册的代理账号
     * @param type $form
     */
    public static function addAgents($form) {
        $agent = new AgentsList;
        $agent->agents_name = $form['agents_name'];
        $agent->agents_pass = md5($form['agents_pass']);
        $agent->agent_url = $form['agent_url'];
        $agent->loginip = '';
        $agent->logintime = '0000-00-00 00:00:00';
        $agent->regtime = date('Y-m-d H:i:s');
        $agent->online = 0;
        $agent->lognum = 0;
        $agent->status = '正常';
        $agent->tel = $form['tel'];
        $agent->email = $form['email'];
        $agent->qq = $form['qq'];
        $agent->othercon = $form['othercon'];
        $agent->agents_type = $form['agents_type'];
        $agent->total_1_1 = 0;
        $agent->total_1_2 = $form['total_1_2'];
        $agent->total_1_scale = $form['total_1_scale'];
        $agent->total_2_1 = $form['total_2_1'];
        $agent->total_2_2 = $form['total_2_2'];
        $agent->total_2_scale = $form['total_2_scale'];
        $agent->total_3_1 = $form['total_3_1'];
        $agent->total_3_2 = $form['total_3_2'];
        $agent->total_3_scale = $form['total_3_scale'];
        $agent->total_4_1 = $form['total_4_1'];
        $agent->total_4_2 = $form['total_4_2'];
        $agent->total_4_scale = $form['total_4_scale'];
//        $agent->total_5_1 = $form['total_5_1'];
//        $agent->total_5_2 = $form['total_5_2'];
//        $agent->total_5_scale = $form['total_5_scale'];
        $agent->refunded_scale = $form['refunded_scale'];
        $agent->remark = 1;
        if(isset($form['agent_level'])){
            $agent->agent_level = $form['agent_level'];
        }
//        $agent->money = $form['limit_money'];
        $agent->save();
    }

    /**
     * 更新代理信息
     * @param type $form     代理信息
     */
    public static function updateAgents($form) {
        $agent = AgentsList::find()
                ->where(['id' => $form['agents_id']])
                ->one();
        if ($agent['agents_name'] != $form['agents_name']) {
            $r = AgentsList::getAgentsNewsByNews('agents_name', $form['agents_name']);
            $arr = $r->asArray()->one();
            if (isset($arr['id'])) {
                return false;
            }
        }
        $agent->agents_name = $form['agents_name'];
        $agent->agent_url = $form['agent_url'];
        $agent->birthday = $form['birthday'];
        $agent->tel = $form['tel'];
        $agent->email = $form['email'];
        $agent->qq = $form['qq'];
        $agent->othercon = $form['othercon'];
        $agent->remark = $form['remark'];
        $agent->agents_type = $form['agents_type'];
        $agent->total_1_1 = 0;
        $agent->total_1_2 = $form['total_1_2'];
        $agent->total_1_scale = $form['total_1_scale'];
        $agent->total_2_1 = $form['total_2_1'];
        $agent->total_2_2 = $form['total_2_2'];
        $agent->total_2_scale = $form['total_2_scale'];
        $agent->total_3_1 = $form['total_3_1'];
        $agent->total_3_2 = $form['total_3_2'];
        $agent->total_3_scale = $form['total_3_scale'];
        $agent->total_4_1 = $form['total_4_1'];
        $agent->total_4_2 = $form['total_4_2'];
        $agent->total_4_scale = $form['total_4_scale'];
//        $agent->total_5_1 = $form['total_5_1'];
//        $agent->total_5_2 = $form['total_5_2'];
//        $agent->total_5_scale = $form['total_5_scale'];
        $agent->refunded_scale = $form['refunded_scale'];
        $agent->remark = 1;
//        $agent->agent_level = 0;
        $res = $agent->save();
        return $res;
    }

    /**
     * 启用代理
     * @param type $uid     代理ID集合
     * @return type
     */
    public static function updateAgentQY($uid) {
        $sql = 'UPDATE agents_list set status=\'正常\' where id in (' . $uid . ') and (status=\'停用\' or status=\'异常\')';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }

    /**
     * 停用代理
     * @param type $name    管理员
     * @param type $uid         代理ID集合
     */
    public static function updateAgentTY($name, $uid) {
        $sql = 'UPDATE agents_list set status=\'停用\',remark=concat_ws(\'，\',remark,\'管理员：' . $name . ' 停用此账户\') where id in (' . $uid . ') and status=\'正常\'';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }

    /**
     * 未通过审核代理
     * @param type $uid
     * @return type
     */
    public static function selectAgentSH($uid) {
        $agent_list = AgentsList::find()
                ->where(['in', 'id', $uid])
                ->andWhere(['remark'=>null])
                ->asArray()
                ->one();
        return $agent_list;
    }

    /**
     * 抓取總代理money與limit_money(目前只實現單個代理審核功能)
     */
    public static function getmoney($uid) {
        $agent_list = AgentsList::find()
            ->select('money,limit_money')
            ->where(['in', 'id', $uid])
            ->asArray()
            ->one();
        return $agent_list;
    }

    /**
     * 存代理money與limit_money
     */
    public static function setmoney($id, $money, $limit_money = null)
    {
        $agent_list = AgentsList::find()
            ->where(['id' => $id])
            ->one();

        $agent_list->money = $money;

        if ($limit_money) {
            $agent_list->limit_money = $limit_money;
        }

        $r = $agent_list->save();

        return $r;
    }

    /**
     * 审核代理(目前只实现单个代理审核功能)
     * @param type $agents_pass      代理密码
     * @param type $uid                     代理ID集合
     */
    public static function updateAgentSH($uid) {
        $agent_list = AgentsList::find()
                ->where(['in', 'id', $uid])
                ->andWhere(['remark'=>null])
                ->asArray()
                ->one();
        $agents_pass = md5('0z' . md5($agent_list['agents_pass'] . 'w0'));
        $sql = 'update agents_list set agents_pass=\'' . $agents_pass . '\' ,remark=1,loginip=null  where id=' . $agent_list['id'];
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }

    /**
     * 删除代理
     * @param type $uid     代理会员ID集合
     */
    public static function deleteAgentNews($uid) {
        $sql = 'delete from agents_list where id in (' . $uid . ')';
        $result = yii::$app->db->createCommand($sql)->execute();
        return $result;
    }

    /**
     * 修改代理密码
     * @param type $id          代理ID
     * @param type $pass      代理密码
     */
    public static function setPass($id, $pass) {
        $agent_list = AgentsList::find()
                ->where(['id' => $id])
                ->one();
        $pass = md5('0z' . md5($pass . 'w0'));
        $agent_list->agents_pass = $pass;
        $r = $agent_list->save();
        return $r;
    }

    /**
     * 更新代理類型
     * @param type $agents_type      代理類型
     * @param type $uid              代理ID集合
     * 隨著總代變更而更動
     */
    public static function updateAgentType($uid,$agents_type) {
        $result = 1;
        $agent_list = AgentsList::find()
            ->where(['agent_level' => $uid])
            ->one();
        if($agent_list){
            $sql = 'update agents_list set agents_type=\'' . $agents_type . '\'   where agent_level =' . $uid;
            $result = yii::$app->db->createCommand($sql)->execute();
        }
        return $result;
    }

    /**
     * 代理结算金额5连发
     * @param type $id              代理ID
     * @param type $s_time      结算开始时间
     * @param type $e_time      结算结束时间
     * @return type                     结果集
     */
    public static function jsAgentLottery($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, order_lottery o, order_lottery_sub sub "
                . "WHERE a.id = '$id' AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function jsAgentSix($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, six_lottery_order o, six_lottery_order_sub sub "
                . "WHERE a.id = '$id' AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function jsAgentSpSix($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, spsix_lottery_order o, spsix_lottery_order_sub sub "
            . "WHERE a.id = '$id' AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->one();
        return $rs;
    }
    public static function jsAgentLive($id, $s_time, $e_time){
        $sql="SELECT SUM( IF ( lo.bet_money > 0, lo.bet_money, 0 )) bet_money_total, SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total, u.top_id "
                . "FROM agents_list a, user_list u, live_user l, live_order lo WHERE a.id = '$id' AND a.id = u.top_id AND u.top_id != 0 "
                . "AND l.user_id = u.user_id AND lo.game_type = l.live_type AND l.live_username = lo.live_username "
                . "AND lo.order_time >= '$s_time' AND lo.order_time <= '$e_time' "
                . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    // 代理賽事結算 不篩選未結算
    public static function jsAgentEventNoStatus($id, $s_time, $e_time)
    {
        $sql = "SELECT SUM( IF ( o.bet_money > 0, IF ( o.is_win != 2, o.bet_money, 0 ), 0 )) bet_money_total,"
            . "SUM( IF ( o.is_win = 1, o.win + o.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, event_order o "
            . "WHERE a.id = '$id' AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '3' "    // 只篩選廢單
            . "AND u.user_id = o.user_id "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->one();

        return $rs;
    }

    //代理賽事結算
    public static function jsAgentEvent($id, $s_time, $e_time){
        $sql="SELECT SUM( IF ( o.bet_money > 0, IF ( o.is_win != 2, o.bet_money, 0 ), 0 )) bet_money_total,"
            . "SUM( IF ( o.is_win = 1, o.win + o.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, event_order o "
            . "WHERE a.id = '$id' AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->one();
        return $rs;
    }

    /* 總代理專用 總代理賽事結算 */
    public static function jsAgentEventSum($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( o.bet_money > 0, IF ( o.is_win != 2, o.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( o.is_win = 1, o.win + o.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, event_order o "
            . "WHERE  a.id IN ($id)  AND a.id=u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0'  AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.sum_top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    public static function jsAgentLotterySum($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, order_lottery o, order_lottery_sub sub "
            . "WHERE a.id IN ($id) AND a.id=u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    /* 總代理專用 */
    public static function jsAgentSixSum($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, six_lottery_order o, six_lottery_order_sub sub "
            . "WHERE a.id IN ($id) AND a.id=u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    /* 總代理專用 */
    public static function jsAgentSpSixSum($id, $s_time, $e_time) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, spsix_lottery_order o, spsix_lottery_order_sub sub "
            . "WHERE a.id IN ($id) AND a.id=u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    /*總代理專用 */
    public static function jsAgentLiveSum($id, $s_time, $e_time){
        $sql="SELECT SUM( IF ( lo.bet_money > 0, lo.bet_money, 0 )) bet_money_total, SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total, u.top_id "
            . "FROM agents_list a, user_list u, live_user l, live_order lo WHERE a.id IN ($id) AND a.id = u.top_id AND u.top_id != 0 "
            . "AND l.user_id = u.user_id AND lo.game_type = l.live_type AND l.live_username = lo.live_username "
            . "AND lo.order_time >= '$s_time' AND lo.order_time <= '$e_time' "
            . "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    /**
     * 通过代理名获取代理ID
     * @param type $where
     * @return type
     */
    public static function getAgentsIdByAgentsName($where){
        $sql = "select id from agents_list ";
        $sql .= $where;
        $res = AgentsList::findBySql($sql)->asArray()->all();
        return $res;
    }
    /**
     * 通过指定的ID集合，获取代理ID号和代理名
     * @param type $is_user     代理ID集合
     * @return type
     */
    public static function getAgentsReportList($is_user,$sum=0,$agent_level=''){
        if($sum==0){
            if($agent_level!=''){
                $res = AgentsList::find()
                    ->select(['id','agents_name'])
                    ->where(['id'=>$is_user])
                    ->andWhere(['<>','agent_level', 0])
                    ->andWhere(['agent_level'=>$agent_level])
                    ->orderBy('regtime DESC');
                return $res;
            }
            $res = AgentsList::find()
                    ->select(['id','agents_name'])
                    ->where(['id'=>$is_user])
                    ->andWhere(['<>','agent_level', 0])
                    ->orderBy('regtime DESC');
            return $res;
        }else{
            $res = AgentsList::find()
                ->select(['id','agents_name'])
                ->where(['id'=>$is_user])
                ->andWhere(['=','agent_level', 0])
                ->orderBy('regtime DESC');
            return $res;
        }
    }

    /**
     * 代理报表金额5连发
     * @param type $id              代理ID
     * @param type $s_time      结算开始时间
     * @param type $e_time      结算结束时间
     * @return type                     结果集
     */
    public static function bbAgentLottery($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, order_lottery o, order_lottery_sub sub "
                . "WHERE a.id in ($id) AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' ";
                if($ExcludeGroup) {
                    $sql .= "AND u.user_id not in ($ExcludeGroup)";
                }
            $sql .= "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbAgentSix($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, six_lottery_order o, six_lottery_order_sub sub "
                . "WHERE a.id in ($id) AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' ";
                if($ExcludeGroup) {
                    $sql .= "AND u.user_id not in ($ExcludeGroup)";
                }
            $sql .= "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbAgentSpsix($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
                . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
                . "FROM agents_list a, user_list u, spsix_lottery_order o, spsix_lottery_order_sub sub "
                . "WHERE a.id in ($id) AND a.id = u.top_id AND u.top_id != 0 "
                . "AND o. STATUS != '0' AND o. STATUS != '3' "
                . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
                . "AND o.bet_time >= '$s_time' "
                . "AND o.bet_time <= '$e_time' ";
                if($ExcludeGroup) {
                    $sql .= "AND u.user_id not in ($ExcludeGroup)";
                }
            $sql .= "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
    public static function bbAgentLive($id, $s_time, $e_time,$ExcludeGroup=null){
		//原下注金額 bet_money 改為 valid_bet_amount
		$sql = "SELECT
					SUM( IF ( lo.valid_bet_amount > 0, lo.valid_bet_amount, 0 )) bet_money_total,
					SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total,
					u.top_id
				FROM
					agents_list a
					left join user_list u on a.id = u.top_id AND u.top_id != 0
					inner join live_user l on l.user_id = u.user_id
					inner join live_order lo on (lo.game_type = l.live_type) AND l.live_username = lo.live_username
				WHERE
					a.id in ($id)
					AND lo.order_time >= '".$s_time."'
                    AND lo.order_time <= '".$e_time."'";
                if($ExcludeGroup) {
                    $sql .= " AND u.user_id not in ($ExcludeGroup) ";
                }

				$sql .= "GROUP BY u.top_id ORDER BY a.regtime DESC";

		//因為 live_order 沒有對應資料，需另外抓'YOPLAY','AG_HUNTER','XIN','SBTA','Bb_Sport'
		$sql1 = "SELECT
					SUM( IF ( lo.valid_bet_amount > 0, lo.valid_bet_amount, 0 )) bet_money_total,
					SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total,
					u.top_id
				FROM
					agents_list a
					left join user_list u on a.id = u.top_id AND u.top_id != 0
					inner join live_user l on l.user_id = u.user_id  and l.live_type = 'AG'
					inner join live_order lo on lo.game_type in ('YOPLAY','AG_HUNTER','XIN','SBTA','Bb_Sport') AND l.live_username = lo.live_username
				WHERE
					a.id in ($id)
					AND lo.order_time >= '".$s_time."'
                    AND lo.order_time <= '".$e_time."'";
                if($ExcludeGroup) {
                    $sql1 .= " AND u.user_id NOT IN ($ExcludeGroup) ";
                }
				$sql1 .= "GROUP BY u.top_id ORDER BY a.regtime DESC";

		$responseData = [];
        $rs = AgentsList::findBySql($sql)->asArray()->all();
		foreach($rs as $key1 => $value1){
			$responseData[$value1['top_id']]['bet_money_total'] = $value1['bet_money_total'];
			$responseData[$value1['top_id']]['win_total'] = $value1['win_total'];
			$responseData[$value1['top_id']]['top_id'] = $value1['top_id'];
		}

		$rs = AgentsList::findBySql($sql1)->asArray()->all();
		foreach($rs as $key1 => $value1){
			if(isset($responseData[$value1['top_id']])){
				$responseData[$value1['top_id']]['bet_money_total'] += $value1['bet_money_total'];
				$responseData[$value1['top_id']]['win_total'] += $value1['win_total'];
				$responseData[$value1['top_id']]['top_id'] = $value1['top_id'];
			}else{
				$responseData[$value1['top_id']]['bet_money_total'] = $value1['bet_money_total'];
				$responseData[$value1['top_id']]['win_total'] = $value1['win_total'];
				$responseData[$value1['top_id']]['top_id'] = $value1['top_id'];
			}
		}

        return $responseData;
    }

    public static function bbAgentEvent($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( o.bet_money > 0, IF ( o.is_win != 2, o.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( o.is_win = 1, o.win + o.fs, IF (is_win = 0, fs, 0))) win_total, u.top_id "
            . "FROM agents_list a, user_list u, event_order o "
            . "WHERE a.id in ($id) AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' ";
        if($ExcludeGroup) {
            $sql .= "AND u.user_id not in ($ExcludeGroup)";
        }
        $sql .= "GROUP BY u.top_id ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    /**
     * 總代理报表金额5连发
     * @param type $id              總代理ID
     * @param type $s_time      结算开始时间
     * @param type $e_time      结算结束时间
     * @return type                     结果集
     */
    public static function bbAgentSumLottery($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, a.agent_level top_id  "
            . "FROM agents_list a, user_list u, order_lottery o, order_lottery_sub sub "
            . "WHERE a.agent_level in ($id) AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' ";
        if($ExcludeGroup) {
            $sql .= "AND u.user_id not in ($ExcludeGroup)";
        }
        $sql .= "GROUP BY a.agent_level ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    public static function bbAgentSumSix($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, a.agent_level top_id "
            . "FROM agents_list a, user_list u, six_lottery_order o, six_lottery_order_sub sub "
            . "WHERE a.agent_level in ($id) AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' ";
        if($ExcludeGroup) {
            $sql .= "AND u.user_id not in ($ExcludeGroup)";
        }
        $sql .= "GROUP BY a.agent_level ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    public static function bbAgentSumSpsix($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF ( sub.bet_money > 0, IF ( sub.is_win != 2, sub.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF ( sub.is_win = 1, sub.win + sub.fs, IF (is_win = 0, fs, 0))) win_total, a.agent_level top_id "
            . "FROM agents_list a, user_list u, spsix_lottery_order o, spsix_lottery_order_sub sub "
            . "WHERE a.agent_level in ($id) AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id AND o.order_num = sub.order_num "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' ";
        if($ExcludeGroup) {
            $sql .= "AND u.user_id not in ($ExcludeGroup)";
        }
        $sql .= "GROUP BY a.agent_level ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }

    public static function bbAgentSumLive($id, $s_time, $e_time,$ExcludeGroup=null){
        //原下注金額 bet_money 改為 valid_bet_amount
        $sql = "SELECT
					SUM( IF ( lo.valid_bet_amount > 0, lo.valid_bet_amount, 0 )) bet_money_total,
					SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total,
					a.agent_level top_id
				FROM
					agents_list a
					left join user_list u on a.id = u.top_id AND u.top_id != 0
					inner join live_user l on l.user_id = u.user_id
					inner join live_order lo on (lo.game_type = l.live_type) AND l.live_username = lo.live_username
				WHERE
                    a.agent_level in ($id)
					AND lo.order_time >= '".$s_time."'
					AND lo.order_time <= '".$e_time."'";
        if($ExcludeGroup) {
            $sql .= " AND u.user_id not in ($ExcludeGroup) ";
        }

        $sql .= "GROUP BY a.agent_level  ORDER BY a.regtime DESC";

        //因為 live_order 沒有對應資料，需另外抓'YOPLAY','AG_HUNTER','XIN'
        $sql1 = "SELECT
					SUM( IF ( lo.valid_bet_amount > 0, lo.valid_bet_amount, 0 )) bet_money_total,
					SUM( IF ( lo.live_win IS NOT NULL, lo.live_win, 0 )) win_total,
					a.agent_level top_id
				FROM
					agents_list a
					left join user_list u on a.id = u.top_id AND u.top_id != 0
					inner join live_user l on l.user_id = u.user_id  and l.live_type = 'AG'
					inner join live_order lo on lo.game_type in ('YOPLAY','AG_HUNTER','XIN') AND l.live_username = lo.live_username
				WHERE
                    a.agent_level in ($id)
					AND lo.order_time >= '".$s_time."'
					AND lo.order_time <= '".$e_time."'";
        if($ExcludeGroup) {
            $sql1 .= " AND u.user_id NOT IN ($ExcludeGroup) ";
        }
        $sql1 .= "GROUP BY  a.agent_level  ORDER BY a.regtime DESC";

        $responseData = [];
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        foreach($rs as $key1 => $value1){
            $responseData[$value1['top_id']]['bet_money_total'] = $value1['bet_money_total'];
            $responseData[$value1['top_id']]['win_total'] = $value1['win_total'];
            $responseData[$value1['top_id']]['top_id'] = $value1['top_id'];
        }

        $rs = AgentsList::findBySql($sql1)->asArray()->all();
        foreach($rs as $key1 => $value1){
            if(isset($responseData[$value1['top_id']])){
                $responseData[$value1['top_id']]['bet_money_total'] += $value1['bet_money_total'];
                $responseData[$value1['top_id']]['win_total'] += $value1['win_total'];
                $responseData[$value1['top_id']]['top_id'] = $value1['top_id'];
            }else{
                $responseData[$value1['top_id']]['bet_money_total'] = $value1['bet_money_total'];
                $responseData[$value1['top_id']]['win_total'] = $value1['win_total'];
                $responseData[$value1['top_id']]['top_id'] = $value1['top_id'];
            }
        }

        return $responseData;
    }

    public static function bbAgentSumEvent($id, $s_time, $e_time,$ExcludeGroup=null) {
        $sql = "SELECT SUM( IF (  o.bet_money > 0, IF (  o.is_win != 2,  o.bet_money, 0 ), 0 )) bet_money_total, "
            . "SUM( IF (  o.is_win = 1,  o.win +  o.fs, IF (is_win = 0, fs, 0))) win_total, a.agent_level top_id "
            . "FROM agents_list a, user_list u,event_order o "
            . "WHERE a.agent_level in ($id) AND a.id = u.top_id AND u.top_id != 0 "
            . "AND o. STATUS != '0' AND o. STATUS != '3' "
            . "AND u.user_id = o.user_id "
            . "AND o.bet_time >= '$s_time' "
            . "AND o.bet_time <= '$e_time' ";
        if($ExcludeGroup) {
            $sql .= "AND u.user_id not in ($ExcludeGroup)";
        }
        $sql .= "GROUP BY a.agent_level ORDER BY a.regtime DESC";
        $rs = AgentsList::findBySql($sql)->asArray()->all();
        return $rs;
    }
}
