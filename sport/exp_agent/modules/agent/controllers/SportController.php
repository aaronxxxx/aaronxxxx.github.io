<?php

namespace app\modules\agent\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\agent\models\KBet;
use app\modules\agent\models\KBetCgGroup;
use app\modules\agent\models\UserList;

class SportController extends BaseController {
    public $page = 20;

    public function init() {//初始化函數
        parent::init();
        $this->layout = false;
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
    }
    /**
     * sport 報表匯總
     * @return type
     */
    public function actionIndex() {
        $getNews = Yii::$app->request->get();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $sport_list = array();
        $ft_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '足球', $getNews['user_id']);
        $bk_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '籃球', $getNews['user_id']);
        $tn_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '網球', $getNews['user_id']);
        $vl_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '排球', $getNews['user_id']);
        $bs_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '棒球', $getNews['user_id']);
        $gj_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '冠軍', $getNews['user_id']);
        $ds_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '單式', $getNews['user_id']);
        $other_result = KBet::getBetMoneyAndCount($time['s_time'], $time['e_time'], '其他', $getNews['user_id']);
        $ft_win = KBet::getWin($time['s_time'], $time['e_time'], '足球', $getNews['user_id']);
        $bk_win = KBet::getWin($time['s_time'], $time['e_time'], '籃球', $getNews['user_id']);
        $tn_win = KBet::getWin($time['s_time'], $time['e_time'], '網球', $getNews['user_id']);
        $vl_win = KBet::getWin($time['s_time'], $time['e_time'], '排球', $getNews['user_id']);
        $bs_win = KBet::getWin($time['s_time'], $time['e_time'], '棒球', $getNews['user_id']);
        $gj_win = KBet::getWin($time['s_time'], $time['e_time'], '冠軍', $getNews['user_id']);
        $ds_win = KBet::getWin($time['s_time'], $time['e_time'], '單式', $getNews['user_id']);
        $other_win = KBet::getWin($time['s_time'], $time['e_time'], '其他', $getNews['user_id']);
        $cg_result = KBetCgGroup::getBetMoneyAndCountCg($time['s_time'], $time['e_time'], $getNews['user_id']);
        $cg_win = KBetCgGroup::getWinCg($time['s_time'], $time['e_time'], $getNews['user_id']);
        $all_bet_count = $ft_result['bet_count'] + $bk_result['bet_count'] + $tn_result['bet_count'] +
                $vl_result['bet_count'] + $bs_result['bet_count'] + $gj_result['bet_count'] +
                $cg_result['bet_count'] + $other_result['bet_count'];
        $all_bet_money = $ft_result['bet_money'] + $bk_result['bet_money'] + $tn_result['bet_money'] +
                $vl_result['bet_money'] + $bs_result['bet_money'] + $gj_result['bet_money'] +
                $cg_result['bet_money'] + $other_result['bet_money'];
        $all_win_money = $ft_win['win_money'] + $bk_win['win_money'] + $tn_win['win_money'] +
                $vl_win['win_money'] + $bs_win['win_money'] + $gj_win['win_money'] +
                $cg_win['win_money'] + $other_win['win_money'];
        $sport_list['ft_count'] = $ft_result['bet_count'];
        $sport_list['bk_count'] = $bk_result['bet_count'];
        $sport_list['tn_count'] = $tn_result['bet_count'];
        $sport_list['vl_count'] = $vl_result['bet_count'];
        $sport_list['bs_count'] = $bs_result['bet_count'];
        $sport_list['gj_count'] = $gj_result['bet_count'];
        $sport_list['ds_count'] = $ds_result['bet_count'];
        $sport_list['cg_count'] = $cg_result['bet_count'];
        $sport_list['other_count'] = $other_result['bet_count'];
        $sport_list['ft_money'] = $ft_result['bet_money'];
        $sport_list['bk_money'] = $bk_result['bet_money'];
        $sport_list['tn_money'] = $tn_result['bet_money'];
        $sport_list['vl_money'] = $vl_result['bet_money'];
        $sport_list['bs_money'] = $bs_result['bet_money'];
        $sport_list['gj_money'] = $gj_result['bet_money'];
        $sport_list['ds_money'] = $ds_result['bet_money'];
        $sport_list['cg_money'] = $cg_result['bet_money'];
        $sport_list['other_money'] = $other_result['bet_money'];
        $sport_list['ft_win'] = $ft_win['win_money'];
        $sport_list['bk_win'] = $bk_win['win_money'];
        $sport_list['tn_win'] = $tn_win['win_money'];
        $sport_list['vl_win'] = $vl_win['win_money'];
        $sport_list['bs_win'] = $bs_win['win_money'];
        $sport_list['gj_win'] = $gj_win['win_money'];
        $sport_list['ds_win'] = $ds_win['win_money'];
        $sport_list['cg_win'] = $cg_win['win_money'];
        $sport_list['other_win'] = $other_win['win_money'];
        $sport_list['all_count'] = $all_bet_count;
        $sport_list['all_money'] = $all_bet_money;
        $sport_list['all_win'] = $all_win_money;
        return $this->render('index', [
                    'time' => $time,
                    'user_id' => $getNews['user_id'],
                    'sport_list' => $sport_list,
                        ]
        );
    }
    /**
     * sport 詳細信息
     * @return type
     */
    public function actionDetail() {
        $getNews = Yii::$app->request->get();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $type['type'] = $getNews['type'];
        $all['money'] = $all['sy'] = $all['result'] = 0;
        $pages = $sport_list = '';
        $type['name'] = $this->_typeToName($getNews['type']);
        $order_id_arr = KBet::getOrderId($getNews['s_time'], $getNews['e_time'],  $type['name'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if ($order_id_arr) {
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $sport_arr = KBet::getOrderDelail($arr_id);
            $pages = new Pagination(['totalCount' => $sport_arr->count(), 'pageSize' => $this->page]);
            $sport_list = $sport_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        }
        return $this->render('sport_detail', [
                    'type' => $type,
                    'time' => $time,
                    'user_id' => $getNews['user_id'],
                    'sport_list'=>$sport_list,
                    'pages'=>$pages,
                    'all' => $all
                        ]
        );
    }
    
    /**
     * sport-串關 詳細信息
     * @return type
     */
    public function actionDetailCg(){
        $getNews = Yii::$app->request->get();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $all['money'] = $all['sy'] = $all['result'] = 0;
        $pages = $cg_list = '';
        $order_id_arr = KBetCgGroup::getOrderIdCg($getNews['s_time'], $getNews['e_time'],$getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        $cg_yjs =$arr_id = array();
        if ($order_id_arr) {
            foreach ($order_id_arr as $key => $value) {
                $cg_yjs[$value['id']] =0;
                $arr_id[$key] = $value['id'];
            }
            $cg_arr = KBetCgGroup::getOrderDelailCg($arr_id);
            $pages = new Pagination(['totalCount' => $cg_arr->count(), 'pageSize' => $this->page]);
            $cg_list = $cg_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            $yjs_cg = KBetCgGroup::getOrderCgYjs($arr_id);
            foreach ($yjs_cg as $key => $value) {
                $cg_yjs[$value['gid']] = $value['num'];
            }
        }
        return $this->render('sport_detail_cg', [
                    'time' => $time,
                    'user_id' => $getNews['user_id'],
                    'cg_list'=>$cg_list,
                    'cg_yjs'=>$cg_yjs,
                    'pages'=>$pages,
                    'all' => $all
                        ]
        );
    }
    /**
     * 名稱裝換
     * @param type $type
     * @return string
     */
    function _typeToName($type) {
        $name = '';
        if ($type == 'ft')
            $name = '足球';
        if ($type == 'bk')
            $name = '籃球';
        if ($type == 'tn')
            $name = '網球';
        if ($type == 'vl')
            $name = '排球';
        if ($type == 'bs')
            $name = '棒球';
        if ($type == 'gj')
            $name = '冠軍';
        if ($type == 'ds')
            $name = '單式';
        if ($type == 'cg')
            $name = '串關';
        if ($type == 'other')
            $name = '其他';
        return $name;
    }
}
