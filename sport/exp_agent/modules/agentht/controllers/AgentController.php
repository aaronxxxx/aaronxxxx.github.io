<?php

namespace app\modules\agentht\controllers;

use app\common\services\ServiceFactory;
use app\modules\agentht\models\HistoryLogin;
use Yii;
use app\common\base\BaseController;
use yii\data\Pagination;
use app\modules\agentht\models\ar\LoginForm;
use app\modules\agentht\models\ar\SysConfig;
use app\modules\agentht\models\AgentsList;
use app\modules\agentht\models\UserList;
use app\modules\agentht\models\AgentsMoneyLog;
use app\common\helpers\UAUtils;
use app\models\SysAgentLock;
use app\models\SysAgentOnline;

class AgentController extends BaseController {

    private $_session = null;
    private $_params = null;
    private $_data = [];
    private $_resp = [];
    public $page = '20';

    public function init() {//初始化函数
        parent::init();
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $this->layout = 'main';
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失败
            'data' => [],
            'msg' => ''
        ];
    }

    /**
     * 登入入口
     * @return type
     */
    public function actionIndex() {
        return $this->redirect('/agenththtml/login.html');
    }

    /**
     * 代理登入操作
     * @return type
     */
    public function actionLogin() {
        $model = new LoginForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => Yii::$app->request->post()
        ];
        if (!$model->load($this->_data) || !$model->validate()) {
            $this->_resp['code'] = 1;
            $msg = $model->getErrors();
            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    $this->_resp['msg'] = $value;                               //返回表单验证的错误信息
                    return json_encode($this->_resp);
                }
            }
        }
        //先关闭此功能
        $agents_pass = md5('0z' . md5($model['agents_pass'] . 'w0'));
        $r = AgentsList::AgentLogin($model['agents_name'], $agents_pass);
        if (!$r) {
            $this->_resp['code'] = 1;
            $this->_resp['msg'] = "帳戶密碼錯誤，或是無使用權限；請聯繫上層總代。";
        }else{

            $name = $model['agents_name'];
            $pwd = $model['agents_pass'];
            $bj_time_now = date("Y-m-d H:i:s",time());
            $client_ip = $this->_get_real_ip();

            /*---- 2018-11-09 新增登入資訊相關驗證 ----*/
            $session = Yii::$app->session;
            $cookies = Yii::$app->response->cookies;
            $run_str = $this->create_str(16);
            $loginbrowser = UAUtils::getClientBrowser();
            // 檢查session是否開啟
            if (!$session->isActive){
                $session->open();
            }
            $session_str = session_id();
            $computer_id = $cookies->get('computer_id');
            if (empty($computer_id)) {
                $computer_id = '第一次登入的瀏覽器:[' . $loginbrowser . '] 時間:[' . $bj_time_now . '] IP:[' . $client_ip . '] 賬號[' . $name . '] 標識:[' . $run_str . ']';
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'computer_id',
                    'value' => $computer_id,
                    'expire'=> time() + (60 * 60 * 24 * 365)
                ]));
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'run_str',
                    'value' => $run_str,
                    'expire'=> time() + (60 * 60 * 24 * 365)
                ]));
            } else {
                $run_str = $cookies->get('run_str');
            }
            $rs_cookie = SysAgentLock::find()->select('id,b_lock,run_str')->where(array('sys_cookie'=>$computer_id))->one();
            if ($rs_cookie['id'] == '') {
                $SysAgentLock = new SysAgentLock();
                $SysAgentLock->sys_cookie = $computer_id;
                $SysAgentLock->b_lock = 0;
                $SysAgentLock->run_str = $run_str;
                $SysAgentLock->save();
            }
            /*$rs_online = SysAgentOnline::find()->select('id,logintime,loginbrowser,loginip')->where(array('manage_name'=>$name))->one();
            if (0 < $rs_online['id']) {
                $this->_resp['msg'] = '這個賬號有其他用戶在登錄.登錄時間:[' . $rs_online['logintime'] . '] IP:[' . $rs_online['loginip'] . '] 瀏覽器:[' . $rs_online['loginbrowser'] . ']或者登錄超時.等待60秒後重新登錄';
                $this->_resp['code'] = 1;
            }*/

            $rs_online = SysAgentOnline::find()->select('id')->where(array('session_str'=>$session_str,'manage_name'=>$name))->one();
            if ($rs_online['id'] == '') {
                $SysAgentOnline = new SysAgentOnline();
                $SysAgentOnline->manage_name = $name;
                $SysAgentOnline->session_str = $session_str;
                $SysAgentOnline->logintime = $bj_time_now;
                $SysAgentOnline->onlinetime = $bj_time_now;
                $SysAgentOnline->loginip = $client_ip;
                $SysAgentOnline->loginbrowser = $loginbrowser;
                $SysAgentOnline->save();
            } else {
                $rs_online->manage_name = $name;
                $rs_online->session_str = $session_str;
                $rs_online->logintime = $bj_time_now;
                $rs_online->onlinetime = $bj_time_now;
                $rs_online->loginip = $client_ip;
                $rs_online->loginbrowser = $loginbrowser;
                $rs_online->save();
            }

            $session['ssid'] = $session_str;
            $session['S_USER_NAME'] = $name;

            /*---- 2018-11-09 新增登入資訊相關驗證 ----*/

            //修改用戶的在線狀態
            $r->online = 1;
            $r->loginip = Yii::$app->request->getUserIP();
            $r->logintime = date('Y-m-d H:i:s');
            $r->lognum = $r['lognum']+1;
            $r->save();
            Yii::$app->session['website_url'] = SysConfig::getPagesize("conf_www");
            Yii::$app->session['S_AGENT_ID'] = $r['id'];
            Yii::$app->session['S_AGENT_NAME'] = $r['agents_name'];
            Yii::$app->session['S_AGENT_LEVEL'] = $r['agent_level'];
            Yii::$app->session['S_AGENT_TYPE'] = $r['agents_type'];
        }
        return json_encode($this->_resp);
    }
    public function create_str($pw_length)
    {
        $randpwd = '';
        for ($i = 0; $i < $pw_length; $i++)
        {
            $randpwd .= chr(mt_rand(65, 90));
        }
        return $randpwd;
    }

    /**
     * 獲取會員真實的IP地址
     * @return bool
     */
    private function _get_real_ip(){
        $ip = false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                //if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $ips[$i])){
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        $ip = $ip ? $ip : $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    /**
     * 下属会员报表
     * @return type
     */
    public function actionAgentsList() {

        $getNews = Yii::$app->request->get();
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }
        if ( Yii::$app->session['S_AGENT_LEVEL'] == 0 && !isset($getNews['aid']) ) {
            return $this->redirect('/?r=agentht/agent/report');
        }

        $agent_id = Yii::$app->session['S_AGENT_ID'];
        if( Yii::$app->session['S_AGENT_LEVEL'] == 0 ) {
            $agent_temp = AgentsList::getAgentsNewsByID($getNews['aid']);
            if ($agent_temp['agent_level'] == Yii::$app->session['S_AGENT_ID'] ){
                $agent_id = $getNews['aid'];
            } else {
                return $this->redirect('/?r=agentht/agent/report');
            }
        }

        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $user_list = $pages = '';
        $Oid = Yii::$app->request->get('Oid');

        if($Oid){
            $user_id_arr = UserList::getOnlineUserIdJoinAgents($agent_id);
        }else{
            $user_id_arr = UserList::getUserIdJoinAgents($agent_id);
        }

        /*新增該頁加總*/
        $sumTotal = array();
        $sumTotal['live_bet_money'] = $sumTotal['six_bet_money'] = $sumTotal['spsix_bet_money'] =$sumTotal['lottery_bet_money'] = $sumTotal['event_bet_money']= $sumTotal['live_win'] = $sumTotal['lottery_win'] = $sumTotal['six_win'] = $sumTotal['six_win'] = $sumTotal['spsix_win'] = $sumTotal['bet_money'] = $sumTotal['win_money'] = $sumTotal['event_win'] = 0;

        if ($user_id_arr) {
            $arr_id = array();
            foreach ($user_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $user_news = UserList::getUserNewsByIdArray($arr_id,$time['s_time'],$time['e_time']);
            $pages = new Pagination(['totalCount' => count($user_news->asArray()->all()), 'pageSize' => $this->page]);
            $user_list = $user_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();

            foreach ($user_list as $key => $value) {
                $service = ServiceFactory::get('live', 'liveReportService');
                $live_result = $service->loadReportResult($time['s_time'], $time['e_time'], $value['user_id']);
                $sxzr_result = $live_result['sxzr_result'];
                $dzyy_result = $live_result['dzyy_result'];
                $user_list[$key]['live_bet_money'] = $sxzr_result['valid_bet_amount'] + $dzyy_result['valid_bet_amount'];
                $user_list[$key]['live_win'] = $sxzr_result['live_win'] + $dzyy_result['live_win'];
                if(count($value['user_id'])>0){
                    $arr['user_id'] = $value['user_id'];
                    $service = ServiceFactory::get('lottery', 'lotteryorderReportService');
                    $lottery_result = $service->lotteryCount($time['s_time'], $time['e_time'],$arr);
                    $user_list[$key]['lottery_bet_money'] = $lottery_result[1]['bet_money'];
                    $user_list[$key]['lottery_win'] = -($lottery_result[1]['bet_money'] - $lottery_result[0]);
                }else{
                    $user_list[$key]['lottery_bet_money'] = 0;
                    $user_list[$key]['lottery_win'] = 0;
                }

                $service = ServiceFactory::get('six', 'sixReportService');
                $six_result = $service->sixDetail($value['user_id'],$time['s_time'], $time['e_time']);
                $user_list[$key]['six_bet_money'] = $six_result['data'][0]['bet_money'];
                $user_list[$key]['six_win'] = -($six_result['data'][0]['bet_money'] - $six_result['data'][0]['is_win_total']);

                $service = ServiceFactory::get('spsix', 'spsixReportService');
				//echo "test"; exit;
                $six_result = $service->sixDetail($value['user_id'],$time['s_time'], $time['e_time']);
                $user_list[$key]['spsix_bet_money'] = $six_result['data'][0]['bet_money'];
                $user_list[$key]['spsix_win'] = -($six_result['data'][0]['bet_money'] - $six_result['data'][0]['is_win_total']);

                $service = ServiceFactory::get('event', 'eventReportService');
                $event_result = $service->eventDetail($value['user_id'],$time['s_time'], $time['e_time']);
                $user_list[$key]['event_bet_money'] = $event_result['data'][0]['bet_money'];
                $user_list[$key]['event_win'] = -($event_result['data'][0]['bet_money'] - $event_result['data'][0]['is_win_total']);


                // $user_list[$key]['bet_money'] = $user_list[$key]['sport_bet_money'] + $user_list[$key]['live_bet_money'] + $user_list[$key]['lottery_bet_money'] + $user_list[$key]['six_bet_money'];
                // $user_list[$key]['win_money'] = $user_list[$key]['sport_win'] +$user_list[$key]['live_win'] + $user_list[$key]['lottery_win'] + $user_list[$key]['six_win'];
                $user_list[$key]['bet_money'] = $user_list[$key]['live_bet_money'] + $user_list[$key]['lottery_bet_money'] + $user_list[$key]['six_bet_money'] + $user_list[$key]['event_bet_money'] + $user_list[$key]['spsix_bet_money'];
                $user_list[$key]['win_money'] = $user_list[$key]['live_win'] + $user_list[$key]['lottery_win'] + $user_list[$key]['six_win'] + $user_list[$key]['spsix_win'] + $user_list[$key]['event_win'];

                /*計算全加總*/
                $sumTotal['live_bet_money'] += $user_list[$key]['live_bet_money'];
                $sumTotal['six_bet_money'] += $user_list[$key]['six_bet_money'];
                $sumTotal['spsix_bet_money'] += $user_list[$key]['spsix_bet_money'];
                $sumTotal['lottery_bet_money'] += $user_list[$key]['lottery_bet_money'];
                $sumTotal['event_bet_money'] += $user_list[$key]['event_bet_money'];
                $sumTotal['live_win'] += $user_list[$key]['live_win'];
                $sumTotal['lottery_win'] += $user_list[$key]['lottery_win'];
                $sumTotal['six_win'] += $user_list[$key]['six_win'];
                $sumTotal['spsix_win'] += $user_list[$key]['spsix_win'];
                $sumTotal['event_win'] += $user_list[$key]['event_win'];
                $sumTotal['bet_money'] += $user_list[$key]['bet_money'];
                $sumTotal['win_money'] += $user_list[$key]['win_money'];


            }
        }

        return $this->render('agents_list', [
                    'time' => $time,
                    'user_list' => $user_list,
                    'pages' => $pages,
                    'getNews' => $getNews,
                    'agent_id' => $agent_id,
                    'sumTotal' => $sumTotal
                        ]
        );
    }

    /**
     * 下属会员详细信息
     * @return type
     */
    public function actionAgentsList2() {
        $getNews = Yii::$app->request->get();
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }
        if ( Yii::$app->session['S_AGENT_LEVEL'] == 0 && !isset($getNews['aid']) ) {
            return $this->redirect('/?r=agentht/agent/report');
        }

        $expired_time=date("Y-m-d H:i:s",time()-1200);
        UserList::updateAll(['online'=>0,'Oid'=>''],"TIMESTAMPDIFF(SECOND,logouttime,:expired_time)>0",[':expired_time' => $expired_time]);
        if($getNews['aid']){
            $agent_id = $getNews['aid'];
        }else{
            $agent_id = Yii::$app->session['S_AGENT_ID'];
        }

        $user_list =$pages= '';
        $Oid = Yii::$app->request->get('Oid');
        if($Oid){
            $user_id_arr = UserList::getOnlineUserIdJoinAgents($agent_id);
        }else{
            $user_id_arr = UserList::getUserIdJoinAgents($agent_id);
        }
        if ($user_id_arr) {
            $arr_id = array();
            foreach ($user_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $user_news = UserList::getUserNewsByIdArray($arr_id);
            $pages = new Pagination(['totalCount' => count($user_news->asArray()->all()), 'pageSize' => $this->page]);
            $user_list = $user_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        }
        return $this->render('agents_list2', [
                    'user_list' => $user_list,
                    'pages' => $pages,
                    'agent_id'=> $agent_id
                        ]
        );
    }

    /**
     * 代理报表
     * @return type
     */
    public function actionReport() {
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $agent_level = Yii::$app->session['S_AGENT_LEVEL'];
        $agents_news = AgentsList::getAgentsNewsByLevel($agent_id, $agent_level);

        $agentTotal = array('live_bet_money'=>0,'live_win'=>0,'lottery_bet_money'=>0,'lottery_win'=>0,'six_bet_money'=>0,'six_win'=>0,'spsix_bet_money'=>0,'spsix_win'=>0,'bet_money'=>0,'win_money'=>0,'event_bet_money'=>0,'event_win'=>0);

        for( $i=0;$i<count($agents_news);$i++ ) {
            //會員最後登錄的前一天時間大於查詢起始時間的會員ID
            $s_time = date("Y-m-d",(strtotime($time['s_time']) - 3600*24));
            $userIds = HistoryLogin::find()
                ->select('h.uid as user_id')
                ->from('history_login as h')
                ->innerJoin('user_list as u','u.user_id=h.uid')
                ->where(['>=','login_time',$s_time])
                ->andWhere(['u.top_id'=>$agents_news[$i]['id']])->distinct()
                ->asArray()->all();
            $ids = array_column($userIds,'user_id');

            // $service = ServiceFactory::get('sport', 'sportReportService');
            // $sport_list = $service->countSport($time['s_time'], $time['e_time'], $ids);
            // $agents_news['sport_bet_money'] = $sport_list['bet_money'];
            // $agents_news['sport_win'] = $sport_list['result'];
            $service = ServiceFactory::get('live', 'liveReportService');
            $live_result = $service->loadReportResult($time['s_time'], $time['e_time'], $ids);
            $sxzr_result = $live_result['sxzr_result'];
            $dzyy_result = $live_result['dzyy_result'];
            $agents_news[$i]['live_bet_money'] = $sxzr_result['bet_money'] + $dzyy_result['bet_money'];
            $agents_news[$i]['live_win'] = -($sxzr_result['live_win'] + $dzyy_result['live_win']);
            /*live總代理加總*/
            $agentTotal['live_bet_money']+=$agents_news[$i]['live_bet_money'];
            $agentTotal['live_win']+=$agents_news[$i]['live_win'];

            if(count($ids)>0){
                $service = ServiceFactory::get('lottery', 'lotteryorderReportService');
                $lottery_result = $service->lotteryCount($time['s_time'], $time['e_time'],$ids);
                $agents_news[$i]['lottery_bet_money'] = $lottery_result[1]['bet_money'];
                $agents_news[$i]['lottery_win'] = $lottery_result[1]['bet_money'] - $lottery_result[0];
            }else{
                $agents_news[$i]['lottery_bet_money'] = 0;
                $agents_news[$i]['lottery_win'] = 0;
            }
            /*lottery總代理加總*/
            $agentTotal['lottery_bet_money']+=$agents_news[$i]['lottery_bet_money'];
            $agentTotal['lottery_win']+=$agents_news[$i]['lottery_win'];

            $service = ServiceFactory::get('six', 'sixReportService');
            $six_result = $service->sixDetail($ids,$time['s_time'], $time['e_time']);

            $agents_news[$i]['six_bet_money'] = $six_result['data'][0]['bet_money'];
            $agents_news[$i]['six_win'] = $six_result['data'][0]['bet_money'] - $six_result['data'][0]['is_win_total'];

            $agentTotal['six_bet_money']+=$agents_news[$i]['six_bet_money'];
            $agentTotal['six_win']+=$agents_news[$i]['six_win'];

            $service = ServiceFactory::get('spsix', 'spsixReportService');
            $spsix_result = $service->sixDetail($ids,$time['s_time'], $time['e_time']);
            $agents_news[$i]['spsix_bet_money'] = $spsix_result['data'][0]['bet_money'];
            $agents_news[$i]['spsix_win'] = $spsix_result['data'][0]['bet_money'] - $spsix_result['data'][0]['is_win_total'];

            $agentTotal['spsix_bet_money']+=$agents_news[$i]['spsix_bet_money'];
            $agentTotal['spsix_win']+=$agents_news[$i]['spsix_win'];

            $service = ServiceFactory::get('event', 'eventReportService');
            $event_result = $service->eventDetail($ids,$time['s_time'], $time['e_time']);

            $agents_news[$i]['event_bet_money'] = $event_result['data'][0]['bet_money'];
            $agents_news[$i]['event_win'] = $event_result['data'][0]['bet_money'] - $event_result['data'][0]['is_win_total'];

            $agentTotal['event_bet_money']+=$agents_news[$i]['event_bet_money'];
            $agentTotal['event_win']+=$agents_news[$i]['event_win'];

            $agents_news[$i]['bet_money'] = $agents_news[$i]['live_bet_money'] + $agents_news[$i]['lottery_bet_money'] + $agents_news[$i]['six_bet_money']+ $agents_news[$i]['spsix_bet_money']+ $agents_news[$i]['event_bet_money'];
            $agents_news[$i]['win_money'] = $agents_news[$i]['live_win'] + $agents_news[$i]['lottery_win'] + $agents_news[$i]['six_win']+ $agents_news[$i]['spsix_win'] + $agents_news[$i]['event_win'];
        }

        /*總代理  總加總*/
        $agentTotal['bet_money'] = $agentTotal['live_bet_money'] + $agentTotal['lottery_bet_money'] + $agentTotal['six_bet_money'] + $agentTotal['spsix_bet_money'] + $agentTotal['event_bet_money'];
        $agentTotal['win_money'] = $agentTotal['live_win'] + $agentTotal['lottery_win'] + $agentTotal['six_win'] + $agentTotal['spsix_win'] + $agentTotal['event_win'];
        return $this->render('report', [
                    'time' => $time,
                    'agent_news' => $agents_news,
                    'agent_total' => $agentTotal
                        ]
        );
    }

    /**
     * 下属会员4种报表
     */
    public function actionReportType() {
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $row_game = array();
        $getNews = Yii::$app->request->get();
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');

        $row_game = array();
        $getNews = Yii::$app->request->get();
        $top_id = Yii::$app->session['S_AGENT_ID'];
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        // $sport_result = UserList::OneUserSport($getNews['user_id'], $time['s_time'], $time['e_time']);
        // $cg_result = UserList::OneUserCg($getNews['user_id'], $time['s_time'], $time['e_time']);
        $lottery_result = UserList::OneUserLottery($getNews['user_id'], $time['s_time'], $time['e_time']);
        $six_result =UserList::OneUserSix($getNews['user_id'], $time['s_time'], $time['e_time']);
        $spsix_result =UserList::OneUserSpSix($getNews['user_id'], $time['s_time'], $time['e_time']);
        $event_result =UserList::OneUserEvent($getNews['user_id'], $time['s_time'], $time['e_time']);
        $service = ServiceFactory::get('live', 'liveReportService');
        $live_result = $service->loadReportResult($time['s_time'], $time['e_time'], $getNews['user_id']);
        $game_result['bet_count'] = $live_result['dzyy_result']['bet_count'];
        $game_result['bet_money'] = $live_result['dzyy_result']['bet_money'];
        $game_result['live_win'] = $live_result['dzyy_result']['live_win'];
        $live_result = UserList::OneUserLive($getNews['user_id'], $time['s_time'], $time['e_time']);
        $lottery_win = UserList::OneUserLotteryWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $six_win = UserList::OneUserSixWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $spsix_win = UserList::OneUserSpSixWin($getNews['user_id'], $time['s_time'], $time['e_time']);
        $event_win = UserList::OneUserEventWin($getNews['user_id'], $time['s_time'], $time['e_time']);

        // $row_game['bet_count_sport']=$sport_result['bet_count']+$cg_result['bet_count'];
        // $row_game['bet_money_sport']=$sport_result['bet_money']+$cg_result['bet_money'];
        // $row_game['win_sport']=$sport_result['win_money']+$cg_result['win_money'];
        // $row_game['result_sport']=$row_game['bet_money_sport']-$row_game['win_sport'];
        $row_game['bet_count_lottery']=$lottery_result['bet_count'];
        $row_game['bet_money_lottery']=$lottery_result['bet_money'];
        $row_game['win_lottery']=$lottery_win;
        $row_game['result_lottery']=$row_game['bet_money_lottery']-$row_game['win_lottery'];
        $row_game['bet_count_six']=$six_result['bet_count'];
        $row_game['bet_money_six']=$six_result['bet_money'];
        $row_game['win_six']=$six_win;
        $row_game['result_six']=$row_game['bet_money_six']-$row_game['win_six'];

        $row_game['bet_count_spsix']=$spsix_result['bet_count'];
        $row_game['bet_money_spsix']=$spsix_result['bet_money'];
        $row_game['win_spsix']=$spsix_win;
        $row_game['result_spsix']=$row_game['bet_money_spsix']-$row_game['win_spsix'];

        $row_game['bet_count_event']=$event_result['bet_count'];
        $row_game['bet_money_event']=$event_result['bet_money'];
        $row_game['win_event']=$event_win;
        $row_game['result_event']=$row_game['bet_money_event']-$row_game['win_event'];

        $row_game['bet_count_live']=$live_result['bet_count'];
        $row_game['bet_money_live']=$live_result['bet_money'];
        $row_game['result_live']=-$live_result['win'];

        $row_game['bet_count_game']=$game_result['bet_count'];
        $row_game['bet_money_game']=$game_result['bet_money'];
        $row_game['result_game']= -$game_result['live_win'];
        $row_game['bet_count_all']=$row_game['bet_count_lottery'] + $row_game['bet_count_six'] + $row_game['bet_count_spsix'] + $row_game['bet_count_live'] +$row_game['bet_count_game'] + $row_game['bet_count_event'];
        $row_game['bet_money_all']=$row_game['bet_money_lottery'] +$row_game['bet_money_six'] +$row_game['bet_money_spsix'] +$row_game['bet_money_live'] + $row_game['bet_money_game'] + $row_game['bet_money_event'];
        $row_game['win_all']=$row_game['win_lottery'] + $row_game['win_six'] + $row_game['win_spsix'] + $row_game['win_event'];
        $row_game['result_all']=$row_game['bet_money_all'] - $row_game['win_all'] - $live_result['bet_money'] - $live_result['win']- $game_result['bet_money']-$game_result['live_win'];
        return $this->render('report-type', [
                    'time' => $time,
                    'user_id'=>$getNews['user_id'],
                    'row_game'=>$row_game,
                    'user_name'=>$user_name['user_name']
                        ]
        );
    }

    /**
     * 结算明细
     * @return type
     */
    public function actionJiesuan() {
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $accouny_id = AgentsMoneyLog::getAccountId($agent_id);
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
        return $this->render('jiesuan',['account_list'=>$agents_account_list,'pages'=>$pages]);
    }

    /**
     * 存取款报表
     * @return type
     */
    public function actionCqk() {

        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $all = array();
        $agent_user = $pages = $report_list = $all['user_group'] = '';
        $getNews = Yii::$app->request->get();
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $all['agent_status'] = isset($getNews['agent_status']) && $getNews['agent_status'] ? $getNews['agent_status']: '成功';
        $all['agent_status'] = isset($getNews['agent_status']) && $getNews['agent_status'] == '所有状态'?'':$all['agent_status'];
        if (!empty($getNews['user_group'])) {//查找指定的代理
            $all['user_group'] = $getNews['user_group'];
            $agent_user = $this->_StringToArray($getNews['user_group']);
        }
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        if(Yii::$app->session['S_AGENT_LEVEL'] == 0){$sum_top_id = $agent_id;}else{$sum_top_id = '';}
        $report_arr = UserList::getCqkNews($time['s_time'], $time['e_time'], $agent_id,$all['agent_status'],$agent_user,$sum_top_id);
        $pages = new Pagination(['totalCount' => count($report_arr->asArray()->all()), 'pageSize' => '1000']);
        $report_list = $report_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $online_money = $backend_money = $qk_money = $qk_admin_money = $hk_money = 0;
        foreach ($report_list as $key => $value) {
            if($value['order_value'] > 0){
                if ($value['type'] == '后台充值' && $value['status'] == '成功') {
                    $backend_money += abs($value['order_value']);
                } elseif($value['type'] == '在线支付' && $value['status'] == '成功') {
                    $online_money += abs($value['order_value']);
                }elseif($value['type'] == '银行汇款' && $value['status'] == '成功'){
                    $hk_money +=  abs($value['order_value']);
                }
            }else{
                if($value['type'] == '用户提款' && $value['status'] == '成功') {
                    $qk_money += abs($value['order_value']);
                }elseif($value['type'] == '后台扣款' && $value['status'] == '成功'){
                    $qk_admin_money += abs($value['order_value']);
                }
            }
        }
        $all['online_money'] = $online_money;
        $all['backend_money'] = $backend_money;
        $all['qk_money'] = $qk_money;
        $all['qk_admin_money'] = $qk_admin_money;
        $all['hk_money'] = $hk_money;
        return $this->render('cqk',[
            'time'=>$time,
            'pages'=>$pages,
            'report_list'=>$report_list,
            'all'=>$all,
        ]);
    }

    /**
     * 總代理報表
     * @return type
     */
    public function actionSumReport() {
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout();
        }
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $agent_money_list = AgentsMoneyLog::getListByTimeSumagent($time['s_time'],$time['e_time'],Yii::$app->session['S_AGENT_ID']);//公司對總代理
        $betMoney = array_sum(array_column($agent_money_list, 'ledger'));
        $winMoney = array_sum(array_column($agent_money_list, 'profig'));
        $settle = array_sum(array_column($agent_money_list, 'money'));
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $agent_level = Yii::$app->session['S_AGENT_LEVEL'];
        $agents_news = AgentsList::getAgentsNewsByLevel($agent_id, $agent_level);
        foreach ($agents_news as $key => $value) {
            $temp = AgentsMoneyLog::getAgentNews($time['s_time'],$time['e_time'],$value['id']);
            $agents_news[$key]['ledger'] = $temp['ledger'] ? $temp['ledger']:0;
            $agents_news[$key]['profig'] = $temp['profig'] ? $temp['profig']:0;
            $agents_news[$key]['money'] = $temp['money'] ? $temp['money']:0;
        }
        //公司淨利
        $company_proift = array_sum(array_column($agent_money_list, 'company_profit'));
        return $this->render("sum-report", [
                'time' => $time ,
                'agent_money_list'=>$agent_money_list,
                'company' => Yii::$app->session['S_USER_NAME'],
                'betMoney' => $betMoney,
                'winMoney' => $winMoney,
                'settle'=>$settle,
                'company_proift'=>$company_proift,
                'agents_news'=>$agents_news,
            ]
        );
    }

    /**
     * 修改密码
     * @return type
     */
    public function actionSetPass() {

        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script language="javascript" charset="utf-8">';
        echo 'alert("cant change password");window.location.href="/?r=agentht/agent/index"';
        echo '</script>';
		exit;
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $agent = AgentsList::findOne(['id'=>$agent_id]);
        $postNews = Yii::$app->request->post();
        if(isset($postNews['dl_pwd1'])){
            $agents_pass = md5('0z' . md5($postNews['dl_pwd1'] . 'w0'));
            $agent->agents_pass=$agents_pass;
            $r= $agent->save();
            if($r){
                Yii::$app->session->remove('S_AGENT_ID');
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo '<script language="javascript" charset="utf-8">';
                echo 'alert("修改成功！请重新登入！");window.location.href="/?r=agentht/agent/index"';
                echo '</script>';
            }
        }
        return $this->render('set-pass',[
            'agents_name'=>$agent['agents_name'],
        ]);
    }

    /**
     * 登出操作
     */
    public function actionOut() {
        Yii::$app->session->remove('S_AGENT_ID');
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script language="javascript" charset="utf-8">';
        echo 'alert("退出成功！");window.location.href="/?r=agentht/agent/index"';
        echo '</script>';
    }

    private function _getout() {
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script language="javascript" charset="utf-8">';
        echo 'alert("请重新登入！");window.location.href="/?r=agentht/agent/index"';
        echo '</script>';
    }

    /**
     * string(z,w,t,c)-->array('z','w','t'.'c')
     * @param type $string
     * @return string
     */
    function _StringToArray($string) {
        $arr = array();
        if (strpos($string, ',') !== false) {
            $arr = explode(',', trim($string));
        } else if (strpos($string, '，') !== false) {
            $arr = explode('，', trim($string));
        }else if ($string) {
            $arr[0] = $string;
        }
        return $arr;
    }

}
