<?php
namespace app\modules\agent\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\core\common\models\SysManage;
use app\modules\agent\models\AgentsList;
use app\modules\agent\models\UserList;
use Yii;

class ReportController extends BaseController {
    public $page = 20;

    public function init() {//初始化函數
        parent::init();
        $this->layout = false;
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
     * 代理報表
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
            
            $rows_lottery = AgentsList::bbAgentLottery($id_sql, $time['s_time'], $time['e_time']);
            $rows_six = AgentsList::bbAgentSumSix($id_sql, $time['s_time'], $time['e_time']);
            $rows_ds = AgentsList::bbAgentDs($id_sql, $time['s_time'], $time['e_time']);
            $rows_cg = AgentsList::bbAgentCg($id_sql, $time['s_time'], $time['e_time']);
            $rows_live = AgentsList::bbAgentLive($id_sql, $time['s_time'], $time['e_time']);
            foreach ($agents_news as $key => $value) {
                $agents_news[$key]['sport_win'] = $agents_news[$key]['sport_bet_money'] = $agents_news[$key]['live_win'] = 0;
                $agents_news[$key]['live_bet_money'] = $agents_news[$key]['six_win'] = $agents_news[$key]['six_bet_money'] = 0;
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
                        $agents_news[$key]['live_win'] = $value_live['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['live_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['live_win'];
                        break;
                    }
                }
                foreach ($rows_ds as $key4 => $value_ds) {
                    if ($value['id'] == $value_ds['top_id']) {
                        $agents_news[$key]['sport_bet_money'] += $value_ds['bet_money_total'];
                        $agents_news[$key]['sport_win'] += $value_ds['bet_money_total'] - $value_ds['win_total'];
                        break;
                    }
                }
                foreach ($rows_cg as $key5 => $value_cg) {
                    if ($value['id'] == $value_cg['top_id']) {
                        $agents_news[$key]['sport_bet_money'] += $value_cg['bet_money_total'];
                        $agents_news[$key]['sport_win'] += $value_cg['bet_money_total'] - $value_cg['win_total'];
                        break;
                    }
                }
                $agents_news[$key]['bet_money'] += $agents_news[$key]['sport_bet_money'];
                $agents_news[$key]['win_money'] += $agents_news[$key]['sport_win'];
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
     * 代理報表
     * @return type
     */
    public function actionIndex() {
        $getNews = Yii::$app->request->get();
        $is_user = $user_group_not = $user_group_is = $where = $bid = $bet_money = $win_money = '';
        $userArray = $userIgnoreArray = array();
        $pages = '';
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
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
            $rows_lottery = AgentsList::bbAgentLottery($id_sql, $time['s_time'], $time['e_time']);
            $rows_six = AgentsList::bbAgentSix($id_sql, $time['s_time'], $time['e_time']);
            $rows_ds = AgentsList::bbAgentDs($id_sql, $time['s_time'], $time['e_time']);
            $rows_cg = AgentsList::bbAgentCg($id_sql, $time['s_time'], $time['e_time']);
            $rows_live = AgentsList::bbAgentLive($id_sql, $time['s_time'], $time['e_time']);
            foreach ($agents_news as $key => $value) {
                $agents_news[$key]['sport_win'] = $agents_news[$key]['sport_bet_money'] = $agents_news[$key]['live_win'] = 0;
                $agents_news[$key]['live_bet_money'] = $agents_news[$key]['six_win'] = $agents_news[$key]['six_bet_money'] = 0;
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
                        $agents_news[$key]['live_win'] = $value_live['win_total'];
                        $agents_news[$key]['bet_money'] += $agents_news[$key]['live_bet_money'];
                        $agents_news[$key]['win_money'] += $agents_news[$key]['live_win'];
                        break;
                    }
                }
                foreach ($rows_ds as $key4 => $value_ds) {
                    if ($value['id'] == $value_ds['top_id']) {
                        $agents_news[$key]['sport_bet_money'] += $value_ds['bet_money_total'];
                        $agents_news[$key]['sport_win'] += $value_ds['bet_money_total'] - $value_ds['win_total'];
                        break;
                    }
                }
                foreach ($rows_cg as $key5 => $value_cg) {
                    if ($value['id'] == $value_cg['top_id']) {
                        $agents_news[$key]['sport_bet_money'] += $value_cg['bet_money_total'];
                        $agents_news[$key]['sport_win'] += $value_cg['bet_money_total'] - $value_cg['win_total'];
                        break;
                    }
                }
                $agents_news[$key]['bet_money'] += $agents_news[$key]['sport_bet_money'];
                $agents_news[$key]['win_money'] += $agents_news[$key]['sport_win'];
            }
        } 
        return $this->render("index", [
                    'time' => $time,
                    'user_group' => $getNews['user_group'],
                    'user_ignore_group' => $getNews['user_ignore_group'],
                    'agent_level' => $agent_level,
                    'agents_list' => $agents_news,
                    'pages' => $pages,
                        ]
        );
    }
    /**
     * 單個代理的下屬會員報表信息
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
            $pages = new Pagination(['totalCount' => count($user_news->asArray()->all()), 'pageSize' => $this->page]);
            $user_list = $user_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            $list_lottery = UserList::bbUserLottery($agent_id, $time['s_time'], $time['e_time']);
            $list_six = UserList::bbUserSix($agent_id, $time['s_time'], $time['e_time']);
            $list_ds = UserList::bbUserDs($agent_id, $time['s_time'], $time['e_time']);
            $list_cg = UserList::bbUserCg($agent_id, $time['s_time'], $time['e_time']);
            $list_live = UserList::bbUserLive($agent_id, $time['s_time'], $time['e_time']);
            foreach ($user_list as $key => $value) {
                $user_list[$key]['lottery_bet_money'] = $user_list[$key]['lottery_win'] = $user_list[$key]['bet_money'] = $user_list[$key]['win_money'] = 0;
                $user_list[$key]['live_bet_money'] = $user_list[$key]['live_win'] = $user_list[$key]['sport_bet_money'] = $user_list[$key]['sport_win'] = 0;
                $user_list[$key]['six_bet_money'] = $user_list[$key]['six_win'] = 0;
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
                foreach ($list_live as $key6 => $value_live) {
                    if ($value['id'] == $value_live['id']) {
                        $user_list[$key]['live_bet_money'] = $value_live['bet_money_total'];
                        $user_list[$key]['live_win'] = -$value_live['win_total'];
                        $user_list[$key]['bet_money'] += $value_live['bet_money_total'];
                        $user_list[$key]['win_money'] += $user_list[$key]['live_win'];
                        break;
                    }
                }
                foreach ($list_ds as $key4 => $value_ds) {
                    if ($value['id'] == $value_ds['id']) {
                        $user_list[$key]['sport_bet_money'] += $value_ds['bet_money_total'];
                        $user_list[$key]['sport_win'] += $value_ds['win_total'] - $value_ds['bet_money_total'];
                        break;
                    }
                }
                foreach ($list_cg as $key5 => $value_cg) {
                    if ($value['id'] == $value_cg['id']) {
                        $user_list[$key]['sport_bet_money'] += $value_cg['bet_money_total'];
                        $user_list[$key]['sport_win'] += $value_cg['win_total'] - $value_cg['bet_money_total'];
                        break;
                    }
                }
                $user_list[$key]['bet_money'] += $user_list[$key]['sport_bet_money'];
				$user_list[$key]['win_money'] = $user_list[$key]['sport_win'] + $user_list[$key]['live_win'] + $user_list[$key]['six_win'] + $user_list[$key]['lottery_win'];
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
     * 代理下屬會員4種報表
     */
    public function actionReportType() {
        $row_game = array();
        $getNews = Yii::$app->request->get();
        $top_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $sport_result = UserList::OneUserSport($getNews['user_id'], $time['s_time'], $time['e_time']);
        $cg_result = UserList::OneUserCg($getNews['user_id'], $time['s_time'], $time['e_time']);
        $lottery_result = UserList::OneUserLottery($getNews['user_id'], $time['s_time'], $time['e_time']);
        $six_result =UserList::OneUserSix($getNews['user_id'], $time['s_time'], $time['e_time']);
        $live_result = UserList::OneUserLive($getNews['user_id'], $time['s_time'], $time['e_time']);
        $lottery_win = UserList::OneUserLotteryWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $six_win = UserList::OneUserSixWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        
        $row_game['bet_count_sport']=$sport_result['bet_count']+$cg_result['bet_count'];
        $row_game['bet_money_sport']=$sport_result['bet_money']+$cg_result['bet_money'];
        $row_game['win_sport']=$sport_result['win_money']+$cg_result['win_money'];
        $row_game['result_sport']=$row_game['win_sport']-$row_game['bet_money_sport'];
        $row_game['bet_count_lottery']=$lottery_result['bet_count'];
        $row_game['bet_money_lottery']=$lottery_result['bet_money'];
        $row_game['win_lottery']=$lottery_win;
        $row_game['result_lottery']=$row_game['win_lottery']-$row_game['bet_money_lottery'];
        $row_game['bet_count_six']=$six_result['bet_count'];
        $row_game['bet_money_six']=$six_result['bet_money'];
        $row_game['win_six']=$six_win;
        $row_game['result_six']=$row_game['win_six']-$row_game['bet_money_six'];
        $row_game['bet_count_live']=$live_result['bet_count'];
        $row_game['bet_money_live']=$live_result['bet_money'];
		$row_game['bet_result_live']=$live_result['bet_money'] - $live_result['win'];
        $row_game['result_live']= -$live_result['win'];
        
        $row_game['bet_count_all']=$row_game['bet_count_sport'] + $row_game['bet_count_lottery'] + $row_game['bet_count_six'] + $row_game['bet_count_live'];
        $row_game['bet_money_all']=$row_game['bet_money_sport'] +$row_game['bet_money_lottery'] +$row_game['bet_money_six'] +$row_game['bet_money_live'] ;
        $row_game['win_all']=$row_game['win_sport'] + $row_game['win_lottery'] + $row_game['win_six'] + $row_game['bet_result_live'];
        $row_game['result_all'] = $row_game['win_all'] - $row_game['bet_money_all'];
		//$row_game['result_all']=$row_game['bet_money_all']-$row_game['win_all'] - $live_result['bet_money'] - $live_result['win'];
        
        return $this->render('report-type', [
                    'time' => $time,
                    'user_id'=>$getNews['user_id'],
                    'row_game'=>$row_game,
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
