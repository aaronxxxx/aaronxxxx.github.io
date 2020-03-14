<?php
namespace app\modules\general\agent\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\core\common\models\SysManage;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\models\AgentsLimit;
use app\modules\general\agent\models\AgentsLimitCount;
use app\modules\general\agent\models\AgentsMoneyLog;
use app\modules\general\agent\models\ar\AgentAddForm;
use Yii;

class SumIndexController extends BaseController {

    private $_data = [];
    public $page = '20';

    public function init() {//初始化函數
        parent::init();
        $this->layout=false;
        Yii::$app->params['S_USER_ID'] = 1;
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
        $uid = 1;
        $quanxian = array('purview' => '');
        if ($uid) {
            $quanxian = SysManage::getPurview($uid);
        }
        Yii::$app->params['U_Purview'] = $quanxian['purview'];
    }
    /**
     * 總代理頁面
     * @return type
     */
    public function actionList() {
        $getNews = Yii::$app->request->get();
        if (!isset($getNews['selecttype'])) {
            $selecttype = $getNews['selecttype'] = 'agents_name';
            $arr = AgentsList::getAgentsNews(1);
        } else {
            $selecttype = $getNews['selecttype'];
            $news = trim($getNews['news']);
            if (empty($getNews['news'])) {
                $arr = AgentsList::getAgentsNews(1);
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
     * 在線總代理，異常總代理，停用總代理，全部總代理，待審核總代理
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
        }

        $arr = AgentsList::getAgentsNewsByNews($type, $news,1);
        $pages = new Pagination(['totalCount' => $arr->count(), 'pageSize' => $this->page]);
        $agents_list = $arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("list", ['agents_list' => $agents_list, 'getNews' => $getNews, 'pages' => $pages]);
    }

    /**
     * 新增總代理
     * @return type
     */
    public function actionAddAgent() {
        $getNews = Yii::$app->request->get();
        if (isset($getNews['code']) && $getNews['code'] == 1) {
            return $this->render('add-agent');
        }
        $postNews = Yii::$app->request->post();//print_r($postNews);exit;
        $agent_form = new AgentAddForm();
        $formName = (string) $agent_form->formName();
        $this->_data = [
            $formName => $postNews
        ];
        if (!$agent_form->load($this->_data) || !$agent_form->validate()) {
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
            return $this->out(false, '該賬號已經存在！');
        }

        AgentsList::addSumAgents($agent_form);
        return $this->out(true, '添加成功！');
    }

    /**
     * 總代理權限操作（啟用，停用，審核，刪除）
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
        if ($postNews['s_action'] == 2) {//啟用總代理
            $result = AgentsList::updateAgentQY($uid);
        }
        if ($postNews['s_action'] == 1) {//停用總代理
            $result = AgentsList::updateAgentTY($admin_name, $uid);
        }
        if ($postNews['s_action'] == 3) {//審核總代理
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
                AgentsMoneyLog::deleteAgentMoneyLog($uid); //刪除總代理結算信息
                \app\modules\general\agent\models\UserList::updateUserTopId($uid); //更新總代理下屬會員歸屬為主域名旗下
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
    //新增總代理限額
    public function actionDoAddMoney() {
        $postNews = Yii::$app->request->post();
        if(is_numeric($postNews['money']))
        {
            $res = AgentsList::getmoney($postNews['id']);
            if (!$res) {return $this->out(true, '修改失敗！');}
            $money=(int)$res['money']+(int)$postNews['money'];
            $limit_money=(int)$res['limit_money']+(int)$postNews['money'];
            $res = AgentsList::setmoney($postNews['id'],$money,$limit_money);
            if ($res) {
                return $this->out(true, '操作成功！');
            }
            else{return $this->out(false, '修改失敗！');}
        }
        else
        {
            return $this->out(false, '修改失敗！');
        }

    }
    //刪除總代理限額
    public function actionDoReduceMoney() {
        $postNews = Yii::$app->request->post();
        if(is_numeric($postNews['money']))
        {
            $res = AgentsList::getmoney($postNews['id']);
            if (!$res) {return $this->out(true, '修改失敗！');}
            $money=(int)$res['money']-(int)$postNews['money'];
            $limit_money=(int)$res['limit_money']-(int)$postNews['money'];
            if($limit_money<0){return $this->out(false, '修改失敗！');}
            $res = AgentsList::setmoney($postNews['id'],$money,$limit_money);
            if ($res) {
                return $this->out(true, '操作成功！');
            }
            else{return $this->out(false, '修改失敗！');}
        }
        else
        {
            return $this->out(false, '修改失敗！');
        }

    }

    /**
     * 總代理信息頁面和編輯
     * @return type
     */
    public function actionAgentsNews()
    {
        $postNews = Yii::$app->request->post();

        if (isset($postNews['code']) && $postNews['code'] == 1) {
            if (trim($postNews['remark']) == '') {
                return $this->out(false, '審核完畢的總代理備註不能為空！');
            }

            $agents = AgentsList::getAgentsNewsBySumID($postNews['agents_id']);

            foreach ($agents as $key => $val) {
                if ($val['refunded_scale'] > $postNews['refunded_scale']) {
                    return $this->out(false, '退水比例不能低于代理');
                }

                if ($val['total_1_scale'] > $postNews['total_1_scale']) {
                    return $this->out(false, '业绩等级1结算比例不能低于代理');
                }

                if ($val['total_2_scale'] > $postNews['total_2_scale']) {
                    return $this->out(false, '业绩等级2结算比例不能低于代理');
                }

                if ($val['total_3_scale'] > $postNews['total_3_scale']) {
                    return $this->out(false, '业绩等级3结算比例不能低于代理');
                }

                if ($val['total_4_scale'] > $postNews['total_4_scale']) {
                    return $this->out(false, '业绩等级4结算比例不能低于代理');
                }
            }

            $postNews['remark'] = trim($postNews['remark']);
            $res = AgentsList::updateAgents($postNews);

            if ($res) {
                // 隨總代變更代理類型而更動
                $res = AgentsList::updateAgentType($postNews['agents_id'], $postNews['agents_type']);
                // if($res){
                    return $this->out(true, '操作成功！');
                // }
            }

            return $this->out(false, '更新失敗！');
        }

        $getNews = Yii::$app->request->get();
        $agents_list = AgentsList::getAgentsNewsByID($getNews['id']);

        return $this->render('agents-news', ['agents_list' => $agents_list]);
    }

    /**
     * 結算總代理頁面
     */
    public function actionAgentsJiesuan()
    {
        $getNews = Yii::$app->request->get();
        $e_time = date('Y-m-d', strtotime('-1 day'));
        $s_time = date('Y-m-d', strtotime('-1 day'));
        $agents_list = AgentsList::getAgentsNewsByID($getNews['id']);

        return $this->render('jiesuan', [
            'agents_list' => $agents_list,
            's_time' => $s_time,
            'e_time' => $e_time
        ]);
    }

    /**
     * 總代理結算金額異步顯示（未結算）
     */
    public function actionAgentsJiesuanAjax()
    {
        $lottery_bet_money = 0;
        $lottery_win = 0;
        $money = 0;
        $getNews = Yii::$app->request->get();
        $id = $getNews['id'];
        $type = $getNews['type'];
        $refunded = $getNews['refunded'];
        $s_time = $getNews['s_time'] . ' 00:00:00';
        $e_time = $getNews['e_time'] . ' 23:59:59';
        $agent = AgentsList::getAgentsNewsByID($getNews['id']);

        if ($agent['agent_level'] == 0) {
            $tmp = array();
            $res = AgentsList::getAgentsNewsBySumID($id);

            foreach ($res as $key => $val) {
                if ($val['refunded_scale'] > $refunded) {
                    $result['msg'] = '退水比例不能低于代理';
                    return json_encode($result);
                }

                // if ($type == '流水分成') {
                //     // 賽事結算
                //     $rows_event = AgentsList::jsAgentEvent($val['id'], $s_time, $e_time);

                //     $lottery_bet_money += $rows_event['bet_money_total'];
                //     $lottery_win += $rows_event['bet_money_total'] - $rows_event['win_total'];
                //     // 總代直接算淨賺: (總代抽的趴數 - 代理抽的趴數) * 該代理的總下注額
                //     $money += ($refunded - $val['refunded_scale']) / 100 * $rows_event['bet_money_total'];
                // }

                array_push($tmp, $val['id']);
            }

            $id = implode (",", $tmp);
        }

        // if ($type == '流水分成') {
        //     return json_encode($lottery_bet_money . ',' . $lottery_win . ',' . $money);
        // }

        if ($id == '') {
            return json_encode('0,0');
        }

        $rows_lottery = AgentsList::jsAgentLotterySum($id, $s_time, $e_time);
        $rows_six = AgentsList::jsAgentSixSum($id, $s_time, $e_time);
        $rows_spsix = AgentsList::jsAgentSpSixSum($id, $s_time, $e_time);
        $rows_live = AgentsList::jsAgentLiveSum($id, $s_time, $e_time);
        $rows_event = AgentsList::jsAgentEventSum($id, $s_time, $e_time);    //賽事結算

        if ($rows_lottery) {
            foreach ($rows_lottery as $key => $value) {
                $lottery_bet_money+=$value['bet_money_total'];
                $lottery_win += $value['bet_money_total'] - $value['win_total'];
            }
        }
        if ($rows_six) {
            foreach ($rows_six as $key1 => $value1) {
                $lottery_bet_money +=$value1['bet_money_total'];
                $lottery_win += $value1['bet_money_total'] - $value1['win_total'];
            }
        }
        if ($rows_spsix) {
            foreach ($rows_spsix as $key1 => $value1) {
                $lottery_bet_money +=$value1['bet_money_total'];
                $lottery_win += $value1['bet_money_total'] - $value1['win_total'];
            }
        }
        if ($rows_live) {
            foreach ($rows_live as $key2 => $value2) {
                $lottery_bet_money +=$value2['bet_money_total'];
                $lottery_win += $value2['bet_money_total'] - $value2['win_total'];
            }
        }

        if ($rows_event) {
            foreach ($rows_event as $key2 => $value2) {
                $lottery_bet_money +=$value2['bet_money_total'];
                $lottery_win += $value2['bet_money_total'] - $value2['win_total'];
            }
        }

        return json_encode($lottery_bet_money . ',' . $lottery_win);
    }

    /**
     * 總代理結算操作
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
     * 查看總代理結算明細
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
            'pages' => $pages
        ]);
    }
}
