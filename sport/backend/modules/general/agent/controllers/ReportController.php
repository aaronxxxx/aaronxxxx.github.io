<?php
namespace app\modules\general\agent\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\core\common\models\SysManage;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\agent\models\UserList;
use app\modules\general\agent\models\AgentsMoneyLog;
use app\modules\general\sysmng\models\ar\SysConfig;
use Yii;

class ReportController extends BaseController {
    public $page = 20;

    public function init() {//初始化函数
        parent::init();
        $this->layout = false;
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
     * 代理报表
     * @return type
     */
    public function actionIndex() {
        $getNews = Yii::$app->request->get();
        $is_user = $user_group_not = $user_group_is = $where = $bid = $bet_money = $win_money = '';
        $win = []; //增加預設值 可能為空值
        $userArray = $userIgnoreArray = array();
        $pages = '';
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        /*新增該頁加總*/
        $sumTotal = array();
        $sumTotal['live_bet_money'] = $sumTotal['six_bet_money'] = $sumTotal['spsix_bet_money'] =$sumTotal['lottery_bet_money'] = $sumTotal['live_win'] = $sumTotal['lottery_win'] = $sumTotal['six_win'] = $sumTotal['six_win'] = $sumTotal['spsix_win'] = $sumTotal['bet_money'] = $sumTotal['event_bet_money'] = $sumTotal['win_money'] = $sumTotal['event_win'] = 0;
        $agent_level = $this->getParam('agent_level', 0);
        if (!empty($getNews['user_group'])) {//查找指定的代理
            $user_group = $getNews['user_group'];
            $arr = $this->_StringToArray($getNews['user_group']);
            $userArray = $arr[0];
            $user_group_is = $arr[1];
            if ($userArray) {
                $user_group_is = $this->_ArrayToSql($userArray);
            }
            $where = "where agents_name in ($user_group_is)";
        } elseif (!empty($getNews['user_ignore_group']) && empty($getNews['user_group'])) {//忽略的代理
            $arr = $this->_StringToArray($getNews['user_ignore_group']);
            $userIgnoreArray = $arr[0];
            $user_group_not = $arr[1];
            if ($userIgnoreArray) {
                $user_group_not = $this->_ArrayToSql($userIgnoreArray);
            }
            $where = "where agents_name not in  ($user_group_not) ";
        } else {
            $getNews['user_group'] = $getNews['user_ignore_group'] = '';
        }
        $id_arr = AgentsList::getAgentsIdByAgentsName($where);
        $agents_news = AgentsList::getAgentsReportList($id_arr,0,$agent_level);
        $pages = new Pagination(['totalCount' => $agents_news->count(), 'pageSize' => $this->page]);
        $agents_news = $agents_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        foreach ($agents_news as $key => $value) {
            $bid .=$value['id'] . ',';
        }
        if (!empty($bid)) {
            $bid = rtrim($bid, ',');
            $arr = $this->_StringToArray($bid);
            $id_sql = $arr[1];
            if ($arr[0]) {
                $id_sql = $this->_ArrayToSql($arr[0]);
            }
            $sql = "SELECT ul.user_id
            FROM user_list as ul
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
            $ExcludeGroup = implode(',',array_column($ExcludeGroup, 'user_id'));
            $rows_lottery = AgentsList::bbAgentLottery($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_six = AgentsList::bbAgentSix($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_spsix = AgentsList::bbAgentSpsix($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_live = AgentsList::bbAgentLive($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_event = AgentsList::bbAgentEvent($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);

            foreach ($agents_news as $key => $value) {
                $agents_news[$key]['live_win']=$agents_news[$key]['event_win'] = 0;
                $agents_news[$key]['live_bet_money']  =$agents_news[$key]['event_bet_money']=$agents_news[$key]['spsix_win'] = $agents_news[$key]['spsix_bet_money'] = $agents_news[$key]['six_win'] = $agents_news[$key]['six_bet_money'] = 0;
                $agents_news[$key]['lottery_win'] = $agents_news[$key]['lottery_bet_money'] = $agents_news[$key]['bet_money'] = $agents_news[$key]['win_money'] = 0;
                foreach ($rows_lottery as $key1 => $value_lottery) {
                    if ($value['id'] == $value_lottery['top_id']) {
                        $agents_news[$key]['lottery_bet_money'] = $value_lottery['bet_money_total'];
                        $agents_news[$key]['lottery_win'] = $agents_news[$key]['valid_bet_amount'] = $value_lottery['bet_money_total'] - $value_lottery['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['lottery_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['lottery_win'];
                        break;
                    }
                }
                foreach ($rows_six as $key2 => $value_six) {
                    if ($value['id'] == $value_six['top_id']) {
                        $agents_news[$key]['six_bet_money'] = $value_six['bet_money_total'];
                        $agents_news[$key]['six_win'] = $value_six['bet_money_total'] - $value_six['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['six_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['six_win'];
                        break;
                    }
                }
                foreach ($rows_live as $key3 => $value_live) {
                    if ($value['id'] == $value_live['top_id']) {
                        $agents_news[$key]['live_bet_money'] = $value_live['bet_money_total'];
                        $agents_news[$key]['live_win'] = -$value_live['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['live_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['live_win'];
                        break;
                    }
                }
                foreach ($rows_spsix as $key4 => $value_spsix) {
                    if ($value['id'] == $value_spsix['top_id']) {
                        $agents_news[$key]['spsix_bet_money'] = $value_spsix['bet_money_total'];
                        $agents_news[$key]['spsix_win'] = $value_spsix['bet_money_total'] - $value_spsix['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['spsix_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['spsix_win'];
                        break;
                    }
                }
                foreach ($rows_event as $key5 => $value_event) {
                    if ($value['id'] == $value_event['top_id']) {
                        $agents_news[$key]['event_bet_money'] = $value_event['bet_money_total'];
                        $agents_news[$key]['event_win'] = $value_event['bet_money_total'] - $value_event['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['event_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['event_win'];
                        break;
                    }
                }

                /*計算全加總*/
                $sumTotal['live_bet_money'] += $agents_news[$key]['live_bet_money'];
                $sumTotal['six_bet_money'] += $agents_news[$key]['six_bet_money'];
                $sumTotal['spsix_bet_money'] += $agents_news[$key]['spsix_bet_money'];
                $sumTotal['lottery_bet_money'] += $agents_news[$key]['lottery_bet_money'];
                $sumTotal['event_bet_money'] += $agents_news[$key]['event_bet_money'];
                $sumTotal['live_win'] += $agents_news[$key]['live_win'];
                $sumTotal['lottery_win'] += $agents_news[$key]['lottery_win'];
                $sumTotal['six_win'] += $agents_news[$key]['six_win'];
                $sumTotal['spsix_win'] += $agents_news[$key]['spsix_win'];
                $sumTotal['event_win'] += $agents_news[$key]['event_win'];
                $sumTotal['bet_money'] += $agents_news[$key]['bet_money'];
                $sumTotal['win_money'] += $agents_news[$key]['win_money'];

            }
            foreach ($agents_news as $key => $row) {
                $win[$key]  = $row['bet_money'];
            }
            array_multisort($win, SORT_DESC, $agents_news);
        } 
        foreach ($agents_news as $key => $row) {
            $win[$key]  = $row['bet_money'];
        }
        array_multisort($win, SORT_DESC, $agents_news);
        return $this->render("index", [
                    'time' => $time,
                    'user_group' => $getNews['user_group'],
                    'user_ignore_group' => $getNews['user_ignore_group'],
                    'agent_level' => $agent_level,
                    'agents_list' => $agents_news,
                    'sumTotal' => $sumTotal,
                    'pages' => $pages,
                        ]
        );
    }

    /**
     * 總代理報表
     * @return type
     */
    public function actionSumIndex() {
        $getNews = Yii::$app->request->get();
        $is_user = $user_group_not = $user_group_is = $where = $bid = $bet_money = $win_money = '';
        $userArray = $userIgnoreArray = array();
        $pages = '';
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        if (!empty($getNews['user_group'])) {//查找指定的代理
            $user_group = $getNews['user_group'];
            $arr = $this->_StringToArray($getNews['user_group']);
            $userArray = $arr[0];
            $user_group_is = $arr[1];
            if ($userArray) {
                $user_group_is = $this->_ArrayToSql($userArray);
            }
            $where = "where agents_name in ($user_group_is)";
        } elseif (!empty($getNews['user_ignore_group']) && empty($getNews['user_group'])) {//忽略的代理
            $arr = $this->_StringToArray($getNews['user_ignore_group']);
            $userIgnoreArray = $arr[0];
            $user_group_not = $arr[1];
            if ($userIgnoreArray) {
                $user_group_not = $this->_ArrayToSql($userIgnoreArray);
            }
            $where = "where agents_name not in  ($user_group_not) ";
        } else {
            $getNews['user_group'] = $getNews['user_ignore_group'] = '';
        }
        $id_arr = AgentsList::getAgentsIdByAgentsName($where);
        $agents_news = AgentsList::getAgentsReportList($id_arr,1);
        $pages = new Pagination(['totalCount' => $agents_news->count(), 'pageSize' => $this->page]);
        $agents_news = $agents_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        foreach ($agents_news as $key => $value) {
            $bid .=$value['id'] . ',';
        }
        if (!empty($bid)) {
            $bid = rtrim($bid, ',');
            $arr = $this->_StringToArray($bid);
            $id_sql = $arr[1];
            if ($arr[0]) {
                $id_sql = $this->_ArrayToSql($arr[0]);
            }
            $sql = "SELECT ul.user_id
            FROM user_list as ul
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name = '测试组会员'";
            $ExcludeGroup = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
            $ExcludeGroup = implode(',',array_column($ExcludeGroup, 'user_id'));
            $rows_lottery = AgentsList::bbAgentSumLottery($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_six = AgentsList::bbAgentSumSix($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_spsix = AgentsList::bbAgentSumSpsix($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_live = AgentsList::bbAgentSumLive($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);
            $rows_event = AgentsList::bbAgentSumEvent($id_sql, $time['s_time'], $time['e_time'],$ExcludeGroup);

            /*
            * 總代理改法紀錄
            * 先改SQL
            * 移除break
            * 將數值改成用 +=
            */

            foreach ($agents_news as $key => $value) {
                $agents_news[$key]['sport_win'] = $agents_news[$key]['sport_bet_money'] = $agents_news[$key]['live_win'] = $agents_news[$key]['valid_bet_amount'] = $agents_news[$key]['event_bet_money'] = $agents_news[$key]['event_win']= 0;
                $agents_news[$key]['live_bet_money']  =$agents_news[$key]['spsix_win'] = $agents_news[$key]['spsix_bet_money'] =  $agents_news[$key]['six_win'] = $agents_news[$key]['six_bet_money'] = 0;
                $agents_news[$key]['lottery_win'] = $agents_news[$key]['lottery_bet_money'] = $agents_news[$key]['bet_money'] = $agents_news[$key]['win_money'] = 0;
                foreach ($rows_lottery as $key1 => $value_lottery) {
                    if ($value['id'] == $value_lottery['top_id']) {
                        $agents_news[$key]['lottery_bet_money'] += $value_lottery['bet_money_total'];
                        $agents_news[$key]['lottery_win'] += $value_lottery['bet_money_total'] - $value_lottery['win_total'];
                        $agents_news[$key]['valid_bet_amount'] += $value_lottery['bet_money_total'] - $value_lottery['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['lottery_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['lottery_win'];
                    }
                }
                foreach ($rows_six as $key2 => $value_six) {
                    if ($value['id'] == $value_six['top_id']) {

                        $agents_news[$key]['six_bet_money'] += $value_six['bet_money_total'];
                        $agents_news[$key]['six_win'] += $value_six['bet_money_total'] - $value_six['win_total'];
                        $agents_news[$key]['bet_money'] += $value_six['bet_money_total'];
                        $agents_news[$key]['win_money'] += $value_six['bet_money_total'] - $value_six['win_total'];
                    }
                }
                foreach ($rows_live as $key3 => $value_live) {
                    if ($value['id'] == $value_live['top_id']) {
                        $agents_news[$key]['live_bet_money'] += $value_live['bet_money_total'];
                        $agents_news[$key]['live_win'] += $value_live['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['live_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['live_win'];
                    }
                }
                foreach ($rows_spsix as $key4 => $value_spsix) {
                    if ($value['id'] == $value_spsix['top_id']) {
                        $agents_news[$key]['spsix_bet_money'] = $value_spsix['bet_money_total'];
                        $agents_news[$key]['spsix_win'] = $value_spsix['bet_money_total'] - $value_spsix['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['spsix_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['spsix_win'];
                        break;
                    }
                }
                foreach ($rows_event as $key5 => $value_event) {
                    if ($value['id'] == $value_event['top_id']) {
                        $agents_news[$key]['event_bet_money'] += $value_event['bet_money_total'];
                        $agents_news[$key]['event_win'] += $value_event['bet_money_total'] - $value_event['win_total'];
                        $agents_news[$key]['valid_bet_amount'] += $value_event['bet_money_total'] - $value_event['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['event_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['event_win'];
                    }
                }
            }
        }
        return $this->render("sumindex", [
                'time' => $time,
                'user_group' => $getNews['user_group'],
                'user_ignore_group' => $getNews['user_ignore_group'],
                'agents_list' => $agents_news,
                'pages' => $pages,
            ]
        );
    }

    /**
     * 单个代理的下属会员报表信息
     * @return type
     */
    public function actionOneAgent() {
        $user_list = $arr_id = array();
        $pages = $agent_id = $bid = '';
        $getNews = Yii::$app->request->get();
        if (isset($getNews['id'])) {
            $agent_id = $getNews['id'];
        }
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $user_id_arr = UserList::getUserIdJoinAgents($agent_id);
        if ($user_id_arr) {
            foreach ($user_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $user_news = UserList::getUserNewsByIdArray($arr_id);
//            $user_news = UserList::getUserHaveOrderByIdArray($arr_id, $time['s_time'], $time['e_time']);
            $pages = new Pagination(['totalCount' => count($user_news->asArray()->all()), 'pageSize' => $this->page]);
            $user_list = $user_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            $list_lottery = UserList::bbUserLottery($agent_id, $time['s_time'], $time['e_time']);
            $list_six = UserList::bbUserSix($agent_id, $time['s_time'], $time['e_time']);
            $list_spsix = UserList::bbUserSpsix($agent_id, $time['s_time'], $time['e_time']);
            $list_live = UserList::bbUserLive($agent_id, $time['s_time'], $time['e_time']);
            $list_event = UserList::bbUserEvent($agent_id, $time['s_time'], $time['e_time']);

            foreach ($user_list as $key => $value) {
                $user_list[$key]['lottery_bet_money'] = $user_list[$key]['lottery_win'] = $user_list[$key]['bet_money'] = $user_list[$key]['win_money'] = 0;
                $user_list[$key]['live_bet_money'] = $user_list[$key]['live_win'] = $user_list[$key]['sport_bet_money'] = $user_list[$key]['sport_win'] = 0;
                $user_list[$key]['six_bet_money'] = $user_list[$key]['six_win'] = 0;
                $user_list[$key]['spsix_bet_money'] = $user_list[$key]['spsix_win'] = 0;
                $user_list[$key]['event_bet_money'] = $user_list[$key]['event_win'] = 0;
                foreach ($list_lottery as $key2 => $value_lottery) {
                    if ($value['id'] == $value_lottery['id']) {
                        $user_list[$key]['lottery_bet_money'] = $value_lottery['bet_money_total'];
                        $user_list[$key]['lottery_win'] = $value_lottery['win_total'] - $value_lottery['bet_money_total'];
                        $user_list[$key]['bet_money'] += $value_lottery['bet_money_total'];
                        $user_list[$key]['win_money'] += $value_lottery['win_total'] - $value_lottery['bet_money_total'];
                        break;
                    }
                }
                foreach ($list_six as $key3 => $value_six) {
                    if ($value['id'] == $value_six['id']) {
                        $user_list[$key]['six_bet_money'] = $value_six['bet_money_total'];
                        $user_list[$key]['six_win'] = $value_six['win_total'] - $value_six['bet_money_total'];
                        $user_list[$key]['bet_money'] += $value_six['bet_money_total'];
                        $user_list[$key]['win_money'] += $value_six['bet_money_total'] - $value_six['win_total'];
                        break;
                    }
                }
                foreach ($list_spsix as $key3 => $value_spsix) {
                    if ($value['id'] == $value_spsix['id']) {
                        $user_list[$key]['spsix_bet_money'] = $value_spsix['bet_money_total'];
                        $user_list[$key]['spsix_win'] = $value_spsix['win_total'] - $value_spsix['bet_money_total'];
                        $user_list[$key]['bet_money'] += $value_spsix['bet_money_total'];
                        $user_list[$key]['win_money'] += $value_spsix['bet_money_total'] - $value_spsix['win_total'];
                        break;
                    }
                }
                foreach ($list_live as $key4 => $value_live) {
                    if ($value['id'] == $value_live['id']) {
                        $user_list[$key]['live_bet_money'] = $value_live['bet_money_total'];
                        $user_list[$key]['live_win'] = $value_live['win_total'];
                        $user_list[$key]['bet_money'] += $value_live['bet_money_total'];
                        $user_list[$key]['win_money'] += $user_list[$key]['live_win'];
                        break;
                    }
                }
                foreach ($list_event as $key5 => $value_event) {
                    if ($value['id'] == $value_event['id']) {
                        $user_list[$key]['event_bet_money'] = $value_event['bet_money_total'];
                        $user_list[$key]['event_win'] = $value_event['win_total'] - $value_event['bet_money_total'];
                        $user_list[$key]['bet_money'] += $value_event['bet_money_total'];
                        $user_list[$key]['win_money'] += $value_event['win_total'] - $value_event['bet_money_total'];
                    }
                }
				$user_list[$key]['win_money'] = $user_list[$key]['live_win'] + $user_list[$key]['six_win'] +$user_list[$key]['spsix_win'] + $user_list[$key]['lottery_win'] + $user_list[$key]['event_win'];
                //$user_list[$key]['win_money'] += $user_list[$key]['sport_win'];
            }
        }
        return $this->render('one-agent', [
            'id' => $getNews['id'],
            'time' => $time, 
            'user_list' => $user_list,
            'pages' => $pages
        ]);
    }
    
    /**
     * 代理下属会员4种报表
     */
    public function actionReportType() {
        $row_game = array();
        $getNews = Yii::$app->request->get();
        $top_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $lottery_result = UserList::OneUserLottery($getNews['user_id'], $time['s_time'], $time['e_time']);
        $event_result = UserList::OneUserEvent($getNews['user_id'], $time['s_time'], $time['e_time']);
        $six_result =UserList::OneUserSix($getNews['user_id'], $time['s_time'], $time['e_time']);
        $spsix_result =UserList::OneUserSpsix($getNews['user_id'], $time['s_time'], $time['e_time']);
        $live_result = UserList::OneUserLive($getNews['user_id'], $time['s_time'], $time['e_time']);
        $lottery_win = UserList::OneUserLotteryWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $event_win = UserList::OneUserEventWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $six_win = UserList::OneUserSixWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $spsix_win = UserList::OneUserSpsixWin($getNews['user_id'], $time['s_time'], $time['e_time']);

        $row_game['bet_count_lottery']=$lottery_result['bet_count'];
        $row_game['bet_money_lottery']=$lottery_result['bet_money'];
        $row_game['win_lottery']=$lottery_win;
        $row_game['result_lottery']=$row_game['win_lottery']-$row_game['bet_money_lottery'];
        $row_game['bet_count_six']=$six_result['bet_count'];
        $row_game['bet_money_six']=$six_result['bet_money'];
        $row_game['bet_count_spsix']=$spsix_result['bet_count'];
        $row_game['bet_money_spsix']=$spsix_result['bet_money'];
        $row_game['win_six']=$six_win;
        $row_game['result_six']=$row_game['win_six']-$row_game['bet_money_six'];
        $row_game['win_spsix']=$spsix_win;
        $row_game['result_spsix']=$row_game['win_spsix']-$row_game['bet_money_spsix'];
        $row_game['bet_count_live']=$live_result['bet_count'];
        $row_game['bet_money_live']=$live_result['bet_money'];
		$row_game['bet_result_live']=$live_result['bet_money'] - $live_result['win'];
        $row_game['result_live']= $live_result['win'];
        $row_game['bet_count_event']=$event_result['bet_count'];
        $row_game['bet_money_event']=$event_result['bet_money'];
        $row_game['win_event']=$event_win;
        $row_game['result_event']=$row_game['win_event']-$row_game['bet_money_event'];


        $row_game['bet_count_all']= $row_game['bet_count_lottery'] + $row_game['bet_count_six'] + $row_game['bet_count_spsix'] + $row_game['bet_count_live']+ $row_game['bet_count_event'];
        $row_game['bet_money_all']= $row_game['bet_money_lottery'] +$row_game['bet_money_six'] +$row_game['bet_money_spsix']+$row_game['bet_money_live']+$row_game['bet_money_event'] ;
        $row_game['win_all']= $row_game['win_lottery'] + $row_game['win_six']+$row_game['win_spsix'] + $row_game['bet_result_live']+ $row_game['win_event'];
        $row_game['result_all'] = $row_game['bet_money_all'] - $row_game['win_all'];
		//$row_game['result_all']=$row_game['bet_money_all']-$row_game['win_all'] - $live_result['bet_money'] - $live_result['win'];
        
        return $this->render('report-type', [
                    'time' => $time,
                    'user_id'=>$getNews['user_id'],
                    'row_game'=>$row_game,
                        ]
        );
    }

    /**
     * 公司總報表
     * @return type
     */
    public function actionSumReport() {
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $agent_money_list = AgentsMoneyLog::getListByTime($time['s_time'],$time['e_time']);//公司對總代理
        $betMoney = array_sum(array_column($agent_money_list, 'ledger'));
        $winMoney = array_sum(array_column($agent_money_list, 'profig'));
        $settle = array_sum(array_column($agent_money_list, 'money'));
        //公司名稱
        $sysconfig=SysConfig::find()->limit(1)->asArray()->one();
        //公司淨利
        $company_proift = array_sum(array_column($agent_money_list, 'company_profit'));
        return $this->render("sum-report", [
                'time' => $time ,
                'agent_money_list'=>$agent_money_list,
                'company' => $sysconfig["web_name"],
                'betMoney' => $betMoney,
                'winMoney' => $winMoney,
                'settle'=>$settle,
                'company_proift'=>$company_proift,
            ]
        );

    }

    /**
     * string(z,w,t,c)-->array('z','w','t'.'c')
     * @param type $string
     * @return string
     */
    function _StringToArray($string) {
        $arr = array('', '');
        if (strpos($string, ',') !== false) {
            $arr[0] = explode(',', trim($string));
        } else if (strpos($string, '，') !== false) {
            $arr[0] = explode('，', trim($string));
        } else if ($string) {
            $arr[1] = '\'' . $string . '\'';
        }
        return $arr;
    }
    /**
     * array----> ('z','w')  db in方法使用
     * @param type $array
     * @return type
     */
    function _ArrayToSql($array) {
        $sql = '';
        foreach ($array as $key => $value) {
            $sql .= '\'' . trim($value) . '\'' . ',';
        }
        $sql = substr($sql, 0, -1);
        return $sql;
    }

}
