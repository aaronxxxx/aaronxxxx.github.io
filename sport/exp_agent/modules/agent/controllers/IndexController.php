<?php

namespace app\modules\agent\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\core\common\models\SysManage;
use app\modules\agent\models\AgentsList;
use app\modules\agent\models\AgentsMoneyLog;
use app\modules\agent\models\ar\AgentAddForm;
use Yii;

class IndexController extends BaseController {

    private $_session = null;
    private $_params = null;
    private $_data = [];
    private $_resp = [];
    private $_level = '';
    private $_id = '';
    public $page = '20';

    public function init() {//初始化函數
        parent::init();
        $this->_level = Yii::$app->session['S_AGENT_LEVEL'];
        $this->_id = Yii::$app->session['S_AGENT_ID'];
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->layout = '@app/modules/agentht/views/layouts/main';
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }
        if ( $this->_level != 0 ) {
            return $this->redirect('/?r=member/index');
        }
        /*$this->layout=false;
        Yii::$app->params['S_USER_ID'] = 1;
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
        $uid = 1;
        $quanxian = array('purview' => '');
        if ($uid) {
            $quanxian = SysManage::getPurview($uid);
        }
        Yii::$app->params['U_Purview'] = $quanxian['purview'];*/
    }

    /**
     * 代理頁面
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
        if (!isset($getNews['news'])) {
            $getNews['news'] = '';
        }
        return $this->render("list", ['agents_list' => $agents_list, 'getNews' => $getNews, 'pages' => $pages]);
    }

    /**
     * 在線代理，異常代理，停用代理，全部代理，待審核代理
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
            $type = 'agent_level';
            $news = $getNews['agent_level'];
        }
        $arr = AgentsList::getAgentsNewsByNews($type, $news);
        $pages = new Pagination(['totalCount' => $arr->count(), 'pageSize' => $this->page]);
        $agents_list = $arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("list", ['agents_list' => $agents_list, 'getNews' => $getNews, 'pages' => $pages]);
    }

    /**
     * 新增代理
     * @return type
     */
    public function actionAddAgent()
    {
        $getNews = Yii::$app->request->get();

        if (isset($getNews['code']) && $getNews['code'] == 1) {
            return $this->render('add-agent');
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

        if (empty($postNews['agents_pass'])) {
            return $this->out(false, '請輸入密碼。');
        }

        if (isset($arr['id'])) {
            return $this->out(false, '該賬號已經存在！');
        }

        $topAgent = AgentsList::getAgentsNewsByID($this->_id);

        if ($postNews['refunded_scale'] > $topAgent['refunded_scale']) {
            return $this->out(false, '退水比例不能高于總代理');
        }

        // if ( empty($agent_form['agent_url']) ) {
        //     return $this->out(false, '請輸入代理域名資訊');
        // }
        // $arr = explode(',',$agent_form['agent_url']);
        // foreach ($arr as $value){
        //     $r = AgentsList::find()
        //         ->where(['like','agent_url',$value])->asArray()->one();
        //     if (isset($r['id'])) {
        //         return $this->out(false, '代理域名已經存在！，請確認後再次寫入。');
        //     }
        // }
        AgentsList::addAgents($agent_form);

        return $this->out(true, '添加成功！');
    }

    /**
     * 代理權限操作（啟用，停用，審核，刪除）
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
        if ($postNews['s_action'] == 2) {//啟用代理
            $result = AgentsList::updateAgentQY($uid);
        }
        if ($postNews['s_action'] == 1) {//停用代理
            $result = AgentsList::updateAgentTY($admin_name, $uid);
        }
        if ($postNews['s_action'] == 3) {//審核代理
            $sh = AgentsList::selectAgentSH($arr); //查詢是否已經審核通過了
            if ($sh) {
                $result = AgentsList::updateAgentSH($arr); //審核操作
            } else {
                return $this->out(false,'該代理已經通過審核了');
            }
        }
        if ($postNews['s_action'] == 4) {
            $result = AgentsList::deleteAgentNews($uid);
            if ($result) {
                AgentsMoneyLog::deleteAgentMoneyLog($uid); //刪除代理結算信息
                \app\modules\agent\models\UserList::updateUserTopId($uid); //更新代理下屬會員歸屬為主域名旗下
            } else {
                return $this->out(false, '刪除失敗！');
            }
        }
        if ($result) {
            return $this->out(true, '操作成功！');
        }
        return $this->out(false, '操作失敗！');
    }

    /**
     * 修改密碼頁面
     */
    public function actionSetpassword() {
        $postNews = Yii::$app->request->get();
        $uid = $postNews['uid'];
        $agents_list = AgentsList::getAgentsNewsByID($uid);
        $agents_name = $agents_list['agents_name'];
        return $this->render("set-password", ['agents_name' => $agents_name, 'uid' => $uid]);
    }

    /**
     * 修改密碼操作
     * @return type
     */
    public function actionDopass() {
        $postNews = Yii::$app->request->post();
        $res = AgentsList::setPass($postNews['id'], $postNews['password']);
        if ($res) {
            return $this->out(true, '操作成功！');
        }
        return $this->out(false, '修改失敗！');
    }

    /**
     * 代理信息頁面和編輯
     * @return type
     */
    public function actionAgentsNews()
    {
        $postNews = Yii::$app->request->post();

        if (isset($postNews['code']) && $postNews['code'] == 1) {
            if (trim($postNews['remark']) == '') {
                return $this->out(false, '審核完畢的代理備註不能為空！');
            }

            $topAgent = AgentsList::getAgentsNewsByID($this->_id);

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

            $postNews['remark'] = trim($postNews['remark']);
            $res = AgentsList::updateAgents($postNews);

            if ($res == 1) {
                return $this->out(true, '操作成功！');
            } else {
                return $this->out(false, $res);
            }
        }

        $getNews = Yii::$app->request->get();
        $agents_list = AgentsList::getAgentsNewsByID($getNews['id']);

        return $this->render('agents-news', ['agents_list' => $agents_list]);
    }

    /**
     * 結算代理頁面
     */
    public function actionAgentsJiesuan() {
        $getNews = Yii::$app->request->get();
        $e_time = date('Y-m-d', strtotime('-1 day'));
        $s_time = date('Y-m-d', strtotime('-1 day'));
        $agents_list = AgentsList::getAgentsNewsByID($getNews['id']);
        return $this->render('jiesuan', ['agents_list' => $agents_list, 's_time' => $s_time, 'e_time' => $e_time]);
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

        /*
        $rows_lottery = \app\modules\agent\models\AgentsList::jsAgentLottery($id, $s_time, $e_time);
        $rows_six = AgentsList::jsAgentSix($id, $s_time, $e_time);
        $rows_spsix = AgentsList::jsAgentSpSix($id, $s_time, $e_time);
        $rows_live = AgentsList::jsAgentLive($id, $s_time, $e_time);
        */
        $rows_event = AgentsList::jsAgentEvent($id, $s_time, $e_time);

        /*
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
            $lottery_win += $rows_live['bet_money_total'] - $rows_live['win_total'];
        }
        */

        if ($rows_event) {
            $lottery_bet_money += $rows_event['bet_money_total'];
            $lottery_win += $rows_event['bet_money_total'] - $rows_event['win_total'];
        }

        return json_encode($lottery_bet_money . ',' . $lottery_win);
    }

    /**
     * 代理結算操作
     */
    public function actionAgentsJiesuanDo()
    {
        $getNews = Yii::$app->request->post();
        $arr = AgentsMoneyLog::getJstime($getNews['id']);

        foreach ($arr as $key => $value) {
            if (($value['s_time'] <= $getNews['s_time']) && ($getNews['s_time'] <= $value['e_time'])) {
                return $this->out(false, "開始時間已經有結算過，請查詢後再結算。");
            }
            if (($value['s_time'] <= $getNews['e_time']) && ($getNews['e_time'] <= $value['e_time'])) {
                return $this->out(false, "結束時間已經有結算過，請查詢後再結算。");
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
            return $this->out(true, "結算成功！");
        } else {
            return $this->out(false, "結算失敗!");
        }
    }

    /**
     * 查看代理結算明細
     * @return type
     */
    public function actionAccount() {
        $getNews = Yii::$app->request->get();
        $accouny_id = AgentsMoneyLog::getAccountId($getNews['id']);
        $agents_account_list = $pages = '';
        $arr_id = array();
        foreach ($accouny_id as $key => $value) {
            $arr_id[$key] = $value['id'];
        }
        if ($arr_id) {
            $account_list = AgentsMoneyLog::getAccountList($arr_id);
            $pages = new Pagination(['totalCount' =>$account_list->count(), 'pageSize' => $this->page]);
            $agents_account_list = $account_list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        }
        return $this->render('account',['account_list'=>$agents_account_list,'pages'=>$pages]);
    }
}
