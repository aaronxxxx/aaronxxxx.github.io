<?php
namespace app\modules\general\agent\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\core\common\models\SysManage;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\models\AgentsMoneyLog;
use app\modules\general\agent\models\ar\AgentAddForm;
use app\modules\general\member\models\UserList;
use Yii;

class IndexController extends BaseController {

    private $_data = [];
    public $page = '20';

    public function init() {//初始化函数
        parent::init();
        $this->layout=false;
        Yii::$app->params['S_USER_ID'] = 1;
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $uid = 1;
        $quanxian = array('purview' => '');
        if ($uid) {
            $quanxian = SysManage::getPurview($uid);
        }
        Yii::$app->params['U_Purview'] = $quanxian['purview'];
    }

    /**
     * 代理页面
     * @return type
     */
    public function actionList() {
        $getNews = Yii::$app->request->get();
        if (!isset($getNews['selecttype'])) {
            $selecttype = $getNews['selecttype'] = 'agents_name';
            $arr = AgentsList::getAgentsNews();
        } else {
            $selecttype = $getNews['selecttype'];
            $news = trim($getNews['news']);
            if (empty($getNews['news'])) {
                $arr = AgentsList::getAgentsNews();
            } else {
                $arr = AgentsList::getAgentsNewsByNews($getNews['selecttype'], $news);
            }
        }
        $pages = new Pagination(['totalCount' => $arr->count(), 'pageSize' => $this->page]);
        $agents_list = $arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        //取得總代名稱
        foreach($agents_list as $key => $value) {
            if(isset($agents_list[$key]['agent_level'])){
                $agents_name = AgentsList::getAgentsNewsByID($agents_list[$key]['agent_level']);
                $agents_list[$key]['agent_top_name'] = $agents_name['agents_name'];
            }else{
                $agents_list[$key]['agent_top_name'] = '';
            }
        }
        if (!isset($getNews['news'])) {
            $getNews['news'] = '';
        }
        return $this->render("list", ['agents_list' => $agents_list, 'getNews' => $getNews, 'pages' => $pages]);
    }

    /**
     * 在线代理，异常代理，停用代理，全部代理，待审核代理
     * @return type
     */
    public function actionListType() {
        $getNews = Yii::$app->request->get();
        $getNews['selecttype'] = 'agents_name';
        $getNews['news'] = '';
        if (isset($getNews['isonline'])) {
            $type = 'online';
            $news = $getNews['isonline'];
        } if (isset($getNews['is_stop'])) {
            $type = 'status';
            $news = $getNews['is_stop'];
        } if (isset($getNews['remark'])) {
            $type = 'remark';
            $news = $getNews['remark'];
        } if (isset($getNews['tel'])) {
            $type = 'tel';
            $news = $getNews['tel'];
        } if (isset($getNews['agent_level'])) {
            $type = 'agent_level';//上層代理
            $news = $getNews['agent_level'];
        }
        $arr = AgentsList::getAgentsNewsByNews($type, $news);
        $pages = new Pagination(['totalCount' => $arr->count(), 'pageSize' => $this->page]);
        $agents_list = $arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        //取得總代名稱
        foreach($agents_list as $key => $value) {
            if(isset($agents_list[$key]['agent_level'])){
                $agents_name = AgentsList::getAgentsNewsByID($agents_list[$key]['agent_level']);
                $agents_list[$key]['agent_top_name'] = $agents_name['agents_name'];
            }
        }
        return $this->render("list", ['agents_list' => $agents_list, 'getNews' => $getNews, 'pages' => $pages]);
    }

    /**
     * 新增代理
     * @return type
     */
    public function actionAddAgent()
    {
        $getNews = Yii::$app->request->get();
        //取得所有總代ID&名稱   新增代理時選擇所屬總代
        $agent_level = AgentsList::getAgentsAll(1);
        $agent_level = $agent_level->asArray()->all();

        if (isset($getNews['code']) && $getNews['code'] == 1) {
            return $this->render('add-agent', ['agent_level' => $agent_level]);
        }

        $postNews = Yii::$app->request->post();
        $agent_form = new AgentAddForm();
        $formName = (string) $agent_form->formName();
        $this->_data = [
            $formName => $postNews
        ];

        if (! $agent_form->load($this->_data) || ! $agent_form->validate()) {
            $msg = $agent_form->getErrors();

            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    return $this->out(false, $value);
                }
            }
        }

        $r = AgentsList::getAgentsNewsByNews('agents_name', $agent_form['agents_name']);
        $arr = $r->asArray()->one();

        if (isset($arr['id'])) {
            return $this->out(false, '该账号已经存在！');
        }

        $arr = explode(',', $agent_form['agent_url']);

        foreach ($arr as $value) {
            $r = AgentsList::find()
                ->where(['like', 'agent_url', $value])->asArray()->one();

            if (isset($r['id'])) {
                return $this->out(false, '代理域名已经存在！，请确认后再次写入。');
            }
        }

        $topAgent = AgentsList::getAgentsNewsByID($postNews['agent_level']);

        if ($postNews['refunded_scale'] > $topAgent['refunded_scale']) {
            return $this->out(false, '退水比例不能高于總代理');
        }

        if ($postNews['total_1_scale'] > $topAgent['total_1_scale']) {
            return $this->out(false, '业绩等级1结算比例不能高于总代理');
        }

        if ($postNews['total_2_scale'] > $topAgent['total_2_scale']) {
            return $this->out(false, '业绩等级2结算比例不能高于总代理');
        }

        if ($postNews['total_3_scale'] > $topAgent['total_3_scale']) {
            return $this->out(false, '业绩等级3结算比例不能高于总代理');
        }

        if ($postNews['total_4_scale'] > $topAgent['total_4_scale']) {
            return $this->out(false, '业绩等级4结算比例不能高于总代理');
        }

        AgentsList::addAgents($agent_form);

        return $this->out(true, '添加成功！');
    }

    /**
     * 代理权限操作（启用，停用，审核，删除）
     * @return type
     */
    public function actionQuanxian() {
        $admin_name = Yii::$app->session['S_USER_NAME'];
        $postNews = Yii::$app->request->post();
        $arr = $postNews['uid']; //array
        $uid = '';
        $i = 0;
        foreach ($arr as $k => $v) {
            $uid .= $v . ',';
            $i++;
        }
        $uid = rtrim($uid, ','); //string
        if ($postNews['s_action'] == 2) {//启用代理
            $result = AgentsList::updateAgentQY($uid);
        }
        if ($postNews['s_action'] == 1) {//停用代理
            $result = AgentsList::updateAgentTY($admin_name, $uid);
        }
        if ($postNews['s_action'] == 3) {//审核代理
            $sh = AgentsList::selectAgentSH($arr); //查询是否已经审核通过了
            if ($sh) {
                $result = AgentsList::updateAgentSH($arr); //审核操作
            } else {
                return $this->out(false,'该代理已经通过审核了');
            }
        }
        if ($postNews['s_action'] == 4) {
            $result = AgentsList::deleteAgentNews($uid);
            if ($result) {
                AgentsMoneyLog::deleteAgentMoneyLog($uid); //删除代理结算信息
                \app\modules\general\agent\models\UserList::updateUserTopId($uid); //更新代理下属会员归属为主域名旗下
            } else {
                return $this->out(false, '删除失败！');
            }
        }
        if ($result) {
            return $this->out(true, '操作成功！');
        }
        return $this->out(false, '操作失败！');
    }

    /**
     * 代理权限操作（添加上層代理且同時更新所有會員sum_top_id）
     * @param type $uid         代理ID集合
     * @param type $agentlevel  總代理ID
     * @return type
     */
    public function actionSetAgentlevel() {
        $postNews = Yii::$app->request->post();

        if(!empty($postNews['agentlevel'])) {
            $agent=AgentsList::findOne(['id'=>$postNews['agentlevel']]);
            if(empty($agent)){
                return '該總代理ID不存在，請輸入總代理ID而不是代理名稱，請查詢後再輸入。';  // 該總代理ID不存在，請輸入總代理ID而不是總代理名稱，請查詢後再輸入。
            }
        }
        $agent_level = $postNews['agentlevel'];
        $uid = $postNews['uid'];
        $agents_list = AgentsList::getAgentsNewsByID($agent_level);
        $agents_type = $agents_list['agents_type'];//取得代理模式更新
        $res = AgentsList::updateAll(['agent_level'=>$agent_level,'agents_type'=>$agents_type], ['in','id',$uid]);//更新代理的上層代理(總代)&代理模式
        \app\modules\general\agent\models\UserList::updateAll(['sum_top_id'=>$agent_level], ['in','top_id',$uid]);//更新會員的總代理
        if ($res) {
            return $this->out(true, '操作成功！');
        }
        return $this->out(false, '修改失败！');
    }

    /**
     * 取得 agents_type
     * @return type
     */
    public function actionGetagentstype() {
        $postNews = Yii::$app->request->post();
        $agent=AgentsList::findOne(['id'=>$postNews['agent_id']]);

        return $agent->agents_type;
    }

    /**
     * 修改密码页面
     */
    public function actionSetpassword() {
        $postNews = Yii::$app->request->get();
        $uid = $postNews['uid'];
        $agents_list = AgentsList::getAgentsNewsByID($uid);
        $agents_name = $agents_list['agents_name'];
        return $this->render("set-password", ['agents_name' => $agents_name, 'uid' => $uid]);
    }

    /**
     * 修改密码操作
     * @return type
     */
    public function actionDopass() {
        $postNews = Yii::$app->request->post();
        $res = AgentsList::setPass($postNews['id'], $postNews['password']);
        if ($res) {
            return $this->out(true, '操作成功！');
        }
        return $this->out(false, '修改失败！');
    }

    /**
     * 代理信息页面和编辑
     * @return type
     */
    public function actionAgentsNews()
    {
        $postNews = Yii::$app->request->post();

        if (isset($postNews['code']) && $postNews['code'] == 1) {
            if (trim($postNews['remark']) == '') {
                return $this->out(false, '审核完毕的代理备注不能为空！');
            }

            $topAgent = AgentsList::getAgentsNewsByID($postNews['agent_level']);

            if ($postNews['refunded_scale'] > $topAgent['refunded_scale']) {
                return $this->out(false, '退水比例不能高于总代理');
            }

            if ($postNews['total_1_scale'] > $topAgent['total_1_scale']) {
                return $this->out(false, '业绩等级1结算比例不能高于总代理');
            }

            if ($postNews['total_2_scale'] > $topAgent['total_2_scale']) {
                return $this->out(false, '业绩等级2结算比例不能高于总代理');
            }

            if ($postNews['total_3_scale'] > $topAgent['total_3_scale']) {
                return $this->out(false, '业绩等级3结算比例不能高于总代理');
            }

            if ($postNews['total_4_scale'] > $topAgent['total_4_scale']) {
                return $this->out(false, '业绩等级4结算比例不能高于总代理');
            }

            $postNews['remark'] = trim($postNews['remark']);
            $res = AgentsList::updateAgents($postNews);

            if ($res) {
                return $this->out(true, '操作成功！');
            }

            return $this->out(false, '更新失败！');
        }

        $getNews = Yii::$app->request->get();
        $agents_list = AgentsList::getAgentsNewsByID($getNews['id']);

        //取得總代ID&名稱
        if (isset($agents_list['agent_level'])) {
            $agents_name = AgentsList::getAgentsNewsByID($agents_list['agent_level']);
            $agents_list['agent_top_name'] = $agents_name['agents_name'];
            $agents_list['agents_type'] = $agents_name['agents_type'];

        } else {
            $agents_list['agent_top_name'] = '';
        }

        return $this->render('agents-news', ['agents_list' => $agents_list]);
    }

    /**
     * 结算代理页面
     */
    public function actionAgentsJiesuan()
    {
        $getNews = Yii::$app->request->get();
        $e_time = date('Y-m-d', strtotime('-1 day'));
        $s_time = date('Y-m-d', strtotime('-2 day'));
        $agents_list = AgentsList::getAgentsNewsByID($getNews['id']);

        return $this->render('jiesuan', [
            'agents_list' => $agents_list,
            's_time' => $s_time,
            'e_time' => $e_time
        ]);
    }

    /**
     * 代理结算金额异步显示（未结算）
     */
    public function actionAgentsJiesuanAjax()
    {
        $lottery_bet_money = 0;
        $lottery_win = 0;
        $getNews = Yii::$app->request->get();
        $id = $getNews['id'];
        $s_time = $getNews['s_time'] . ' 00:00:00';
        $e_time = $getNews['e_time'] . ' 23:59:59';

        $topAgent = AgentsList::getAgentsNewsByID($getNews['agent_level']);

        if ($getNews['refunded'] > $topAgent['refunded_scale']) {
            $result['msg'] = '退水比例不能高于总代理';
            return json_encode($result);
        }

        $rows_lottery = AgentsList::jsAgentLottery($id, $s_time, $e_time);
        $rows_six = AgentsList::jsAgentSix($id, $s_time, $e_time);
        $rows_spsix = AgentsList::jsAgentSpSix($id, $s_time, $e_time);
        $rows_live = AgentsList::jsAgentLive($id, $s_time, $e_time);
        $rows_event = AgentsList::jsAgentEvent($id, $s_time, $e_time);

        if ($rows_lottery) {
            $lottery_bet_money += $rows_lottery['bet_money_total'];
            $lottery_win += $rows_lottery['bet_money_total'] - $rows_lottery['win_total'];
        }
        if ($rows_six) {
            $lottery_bet_money +=$rows_six['bet_money_total'];
            $lottery_win += $rows_six['bet_money_total'] - $rows_six['win_total'];
        }
        if ($rows_spsix) {
            $lottery_bet_money +=$rows_spsix['bet_money_total'];
            $lottery_win += $rows_spsix['bet_money_total'] - $rows_spsix['win_total'];
        }
        if ($rows_live) {
            $lottery_bet_money +=$rows_live['bet_money_total'];
            $lottery_win += - $rows_live['win_total'];
        }

        if ($rows_event) {
            $lottery_bet_money +=$rows_event['bet_money_total'];
            $lottery_win += $rows_event['bet_money_total'] - $rows_event['win_total'];
        }

        return json_encode($lottery_bet_money . ',' . $lottery_win);
    }

    /**
     * 代理结算操作
     */
    public function actionAgentsJiesuanDo()
    {
        $getNews = Yii::$app->request->post();
        $arr = AgentsMoneyLog::getJstime($getNews['id']);

        foreach ($arr as $key => $value) {
            if (($value['s_time'] <= $getNews['s_time']) && ($getNews['s_time'] <= $value['e_time'])) {
                return $this->out(false, "开始时间已经有结算过，请查询后再结算。");
            }

            if (($value['s_time'] <= $getNews['e_time']) && ($getNews['e_time'] <= $value['e_time'])) {
                return $this->out(false, "结束时间已经有结算过，请查询后再结算。");
            }
        }

        // 更新用戶錢包: 原金額 + 這次結算的錢
        $agent = AgentsList::getAgentsNewsByID($getNews['id']);
        $money = $agent['money'] + $getNews['money'];
        $setMoney = AgentsList::setmoney($getNews['id'], $money);

        // 新增log
        $id = $getNews['id'];
        $money = $getNews['money'];
        $s_time = $getNews['s_time'];
        $e_time = $getNews['e_time'];
        $ledger = $getNews['ledger'];
        $profig = $getNews['profig'];
        $ratio = $getNews['ratio'];
        $settlement_type = $getNews['agents_type'];
        $refund_scale = $getNews['refunded_scale'];
        $company_profit = $getNews['company_profit'];
        $r = AgentsMoneyLog::addAgentsMoneyLog($id, $money, $s_time, $e_time, $ledger, $profig, $ratio, $settlement_type, $refund_scale,$company_profit);

        if ($setMoney && $r) {
            return $this->out(true,  "结算成功！");
        } else {
            return $this->out(false,  "结算失败!");
        }
    }

    /**
     * 查看代理结算明细
     * @return type
     */
    public function actionAccount()
    {
        $getNews = Yii::$app->request->get();
        $accouny_id = AgentsMoneyLog::getAccountId($getNews['id']);
        $agents_account_list = $pages = '';
        $arr_id = array();

        foreach ($accouny_id as $key => $value) {
            $arr_id[$key] = $value['id'];
        }

        if ($arr_id) {
            $account_list = AgentsMoneyLog::getAccountList($arr_id);
            $pages = new Pagination(['totalCount' => $account_list->count(), 'pageSize' => $this->page]);
            $agents_account_list = $account_list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        }

        return $this->render('account', [
            'account_list' => $agents_account_list,
            'pages'=>$pages
        ]);
    }
}
