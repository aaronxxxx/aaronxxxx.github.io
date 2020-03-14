<?php

namespace app\modules\agent\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\core\common\models\SysManage;
use app\modules\agent\models\UserList;
use app\modules\agent\models\AgentsList;
use app\modules\finance\services\MoneyService;

class CqkController extends BaseController {

    public $page = '20';

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

    public function actionIndex() {
        $getDatas = Yii::$app->request->get();//獲取前端參數
        //對獲取的前端用戶名進行處理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //對獲取前端忽略用戶名進行處理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        //獲取用戶名和忽略用戶名查詢到的用戶id
        $userIds = AgentsList::getAgentIdByAgentsName2($userNames,$userIgnoreName);
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        $ids = [];
        foreach ($userIds as $value) {
            array_unshift($ids,$value['id']);
        }
        $agents_news = AgentsList::getAgentsReportList($ids);
        $pages = new Pagination(['totalCount' => $agents_news->count(), 'pageSize' => $this->page]);
        $agents_news = $agents_news->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $arr_ck = ['在線支付','後台充值'];
        $arr_hk = ['銀行匯款'];
        $arr_tk = ['用戶提款','後台扣款'];
        foreach ($agents_news as $key => $value){
            $user_id = UserList::getUserIdByTopid($value['id']);
            $row_ck = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_ck, $time['s_time'], $time['e_time'], false);
            $row_hk = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_hk, $time['s_time'], $time['e_time'], false);
            $row_tk = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_tk, $time['s_time'], $time['e_time'], false);
            $row_ck_ht = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_ck, $time['s_time'], $time['e_time']);
            $row_tk_ht = MoneyService::totalOrderValueByUserIdAndType($user_id, $arr_tk, $time['s_time'], $time['e_time']);
            $win_money = $row_ck + $row_hk +$row_tk;
            $agents_news[$key]['ck_money'] = $row_ck;
            $agents_news[$key]['hk_money'] = $row_hk;
            $agents_news[$key]['qk_money'] = $row_tk;
            $agents_news[$key]['ck_money_hd'] = $row_ck_ht;
            $agents_news[$key]['qk_money_hd'] = $row_tk_ht;
            $agents_news[$key]['win_money'] = $win_money;
        }
        return $this->render("index", [
                    'time' => $time,
                    'user_group' => $getDatas['user_group'],
                    'user_ignore_group' => $getDatas['user_ignore_group'],
                    'agents_list' => $agents_news,
                    'pages' => $pages,
                        ]
        );
    }

    public function actionChildList() {
        $getDatas = Yii::$app->request->get();//獲取前端參數
        //對獲取的前端用戶名進行處理
        $userNames = explode(",", rtrim(ArrayHelper::getValue($getDatas,'user_group'), ","));
        //對獲取前端忽略用戶名進行處理
        $userIgnoreName = explode(",",rtrim(ArrayHelper::getValue($getDatas,'user_ignore_group'),","));
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time',date('Y-m-d 00:00:00'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d H:i:s'));
        //獲取用戶名和忽略用戶名查詢到的用戶id
        $ids = [];
        if(isset($getDatas['id']) && empty($userNames[0]) && empty($userIgnoreName[0])){
            $ids = $getDatas['id'];
        }else{
            $userIds = AgentsList::getAgentIdByAgentsName2($userNames,$userIgnoreName);
            foreach ($userIds as $value) {
                array_unshift($ids,$value['id']);
            }
        }
        $user_id = UserList::getUserIdByTopid($ids);//獲取對應的下屬會員ID
        $user_list = UserList::getUserNewsByUserId($user_id);
        $pages = new Pagination(['totalCount' => $user_list->count(), 'pageSize' => $this->page]);
        $user_news = $user_list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $arr_ck = ['在線支付','後台充值'];
        $arr_hk = ['銀行匯款'];
        $arr_tk = ['用戶提款','後台扣款'];
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
