<?php

namespace app\modules\general\agent\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\core\common\models\SysManage;
use app\modules\general\agent\models\UserList;
use app\modules\general\agent\models\AgentsList;
use app\modules\general\finance\services\MoneyService;


class CqkController extends BaseController {

    public $page = '20';

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

    public function actionIndex() {
        $getDatas = Yii::$app->request->get();//获取前端参数
        $sort = $this->getParam('sort','');
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        //获取用户名和忽略用户名查询到的用户id
        $userIds = AgentsList::getAgentIdByAgentsName2($userNames,$userIgnoreName);
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        $ids = [];


        foreach ($userIds as $value) {
            array_unshift($ids,$value['id']);
        }

        //僅取得 代理 ID 與 姓名
        // $agents_news = AgentsList::getAgentsReportList($ids);

        $arr_ck = ['在线支付','后台充值'];
        $arr_hk = ['银行汇款'];
        $arr_tk = ['用户提款','后台扣款'];

        //資料流分析，依據 獲取到的 代理ID 取得 所屬 代理資訊，底下所有的用戶加總
        //使用yii 子查詢方式join  加入不等於總代的條件
        $agents_news = (new \yii\db\Query())
        ->select(new \yii\db\Expression("ag.id, ag.agents_name, 
        SUM( m.ck_money ) AS ck_money,
        SUM( m.hk_money ) AS hk_money,
        SUM( m.tk_money ) AS tk_money,
        SUM( m.win_money ) AS win_money,
        SUM( m_ht.ck_money_ht ) AS ck_money_ht,
        SUM( m_ht.tk_money_ht ) AS tk_money_ht "))
        ->from("agents_list AS ag")
        ->leftJoin('user_list AS u', 'u.top_id = ag.id')
        ->leftJoin(['m' => MoneyService::moneyFilter($time['s_time'], $time['e_time'], false)],'m.user_id = u.user_id')
        ->leftJoin(['m_ht' => MoneyService::moneyFilter($time['s_time'], $time['e_time'])],'m_ht.user_id = u.user_id')
        ->where(["ag.id" => $ids])
        ->andWhere(['<>','agent_level', 0])
        ->groupBy('ag.id'); //所有该会员的存款取款记录

        if( !empty($sort) ){
			$temp = explode(';',$sort);
			$agents_news = $agents_news->orderBy($temp[0]." ".$temp[1]);
		}

        // print_r($agents_news->createCommand()->getRawSql());exit;

        $pages = new Pagination(['totalCount' => $agents_news->count(), 'pageSize' => $this->page]);
        // $agents_news = $agents_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $agents_news = $agents_news->offset($pages->offset)->limit($pages->limit)->all();

        /*新增該頁加總*/
        $sumTotal = array();
        $sumTotal['ck_money'] = $sumTotal['hk_money'] = $sumTotal['tk_money'] =$sumTotal['ck_money_ht'] = $sumTotal['tk_money_ht'] = $sumTotal['win_money'] = 0;

        foreach ($agents_news as $key => $value){
            //舊資訊
            // $user_id = UserList::getUserIdByTopid($value['id']);
            // $row_ck = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_ck, $time['s_time'], $time['e_time'], false);
            // $row_hk = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_hk, $time['s_time'], $time['e_time'], false);
            // $row_tk = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_tk, $time['s_time'], $time['e_time'], false);
            // $row_ck_ht = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_ck, $time['s_time'], $time['e_time']);
            // $row_tk_ht = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_tk, $time['s_time'], $time['e_time']);
            // $win_money = $row_ck + $row_hk +$row_tk;
            // $agents_news[$key]['ck_money'] = $row_ck;
            // $agents_news[$key]['hk_money'] = $row_hk;
            // $agents_news[$key]['qk_money'] = $row_tk;
            // $agents_news[$key]['ck_money_ht'] = $row_ck_ht;
            // $agents_news[$key]['tk_money_ht'] = $row_tk_ht;
            // $agents_news[$key]['win_money'] = $win_money;

            // $sumTotal['ck_money'] += $row_ck;
            // $sumTotal['hk_money'] += $row_hk;
            // $sumTotal['qk_money'] += $row_tk;
            // $sumTotal['ck_money_ht'] += $row_ck_ht;
            // $sumTotal['tk_money_ht'] += $row_tk_ht;
            // $sumTotal['win_money'] += $win_money;

            //使用新修正排序後計算
            $sumTotal['ck_money'] += $agents_news[$key]['ck_money'];
            $sumTotal['hk_money'] += $agents_news[$key]['hk_money'];
            $sumTotal['tk_money'] += $agents_news[$key]['tk_money'];
            $sumTotal['ck_money_ht'] += $agents_news[$key]['ck_money_ht'];
            $sumTotal['tk_money_ht'] += $agents_news[$key]['tk_money_ht'];
            $sumTotal['win_money'] += $agents_news[$key]['win_money'];

        }
        // foreach ($agents_news as $key => $row) {
        //     $win[$key]  = $row['win_money'];
        // }
        // array_multisort($win, SORT_DESC, $agents_news);
        return $this->render("index", [
                    'time' => $time,
                    'user_group' => $getDatas['user_group'],
                    'user_ignore_group' => $getDatas['user_ignore_group'],
                    'sort' => $sort,
                    'agents_list' => $agents_news,
                    'sumTotal' => $sumTotal,
                    'pages' => $pages,
                        ]
        );
    }

    public function actionChildList() {
        $getDatas = Yii::$app->request->get();//获取前端参数
        //对获取的前端用户名进行处理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //对获取前端忽略用户名进行处理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        //获取用户名和忽略用户名查询到的用户id
        $ids = [];
        if(isset($getDatas['id']) && empty($userNames[0]) && empty($userIgnoreName[0])){
            $ids = $getDatas['id'];
        }else{
            $userIds = AgentsList::getAgentIdByAgentsName2($userNames,$userIgnoreName);
            foreach ($userIds as $value) {
                array_unshift($ids,$value['id']);
            }
        }
        $user_id = UserList::getUserIdByTopid($ids);//获取对应的下属会员ID
        $user_list = UserList::getUserNewsByUserId($user_id);
        $pages = new Pagination(['totalCount' => $user_list->count(), 'pageSize' => $this->page]);
        $user_news = $user_list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $arr_ck = ['在线支付','后台充值'];
        $arr_hk = ['银行汇款'];
        $arr_tk = ['用户提款','后台扣款'];
        foreach ($user_news as $key => $value) {
            $agents_name = AgentsList::find()->select('agents_name')->where(['id'=>$value['top_id']])->asArray()->one();
            $user_news[$key]['agents_name'] = $agents_name['agents_name'];
            $list_ck = MoneyService::totalOrderValueByUserIdAndType($value['user_id'], $arr_ck, $time['s_time'], $time['e_time'], false);
            $list_hk = MoneyService::totalOrderValueByUserIdAndType($value['user_id'], $arr_hk, $time['s_time'], $time['e_time'], false);
            $list_qk = MoneyService::totalOrderValueByUserIdAndType($value['user_id'], $arr_tk, $time['s_time'], $time['e_time'], false);
            $list_ck_ht = MoneyService::totalOrderValueByUserIdAndType($value['user_id'], $arr_ck, $time['s_time'], $time['e_time']);
            $list_qk_ht = MoneyService::totalOrderValueByUserIdAndType($value['user_id'], $arr_tk, $time['s_time'], $time['e_time']);
            $win_money = $list_ck + $list_hk +$list_qk;
            $user_news[$key]['ck_money'] = $list_ck;
            $user_news[$key]['hk_money'] = $list_hk;
            $user_news[$key]['qk_money'] = $list_qk;
            $user_news[$key]['ck_money_hd'] = $list_ck_ht;
            $user_news[$key]['qk_money_hd'] = $list_qk_ht;
            $user_news[$key]['win_money'] = $win_money;
        }
        return $this->render('child_list', [
                    'id' => $getDatas['id'],
                    'time' => $time,
                    'agent_name'=>$getDatas['name'],
                    'user_group' => $getDatas['user_group'],
                    'user_ignore_group' => $getDatas['user_ignore_group'],
                    'user_list' => $user_news,
                    'pages' => $pages,
                        ]
        );
    }

}
