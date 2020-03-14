<?php
namespace app\modules\general\agent\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\general\agent\models\OrderLottery;
use app\common\data\Pagination;
use app\modules\general\agent\models\UserList;
use app\modules\general\agent\models\GetContentName;

class LotteryController extends BaseController {
    public $page = 20;

    public function init() {//初始化函数
        parent::init();
        $this->layout = false;
        $this->enableCsrfValidation = false;                                                //关闭表单验证
    }

    /**
     * 彩票各个彩种报表
     * @return type
     */
    public function actionIndex() {
        $getNews = Yii::$app->request->get();
        $lottery_list = array();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $d3_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'D3', $getNews['user_id']);
        $p3_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'P3', $getNews['user_id']);
        $t3_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'T3', $getNews['user_id']);
        $cq_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'CQ', $getNews['user_id']);
        $tj_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'TJ', $getNews['user_id']);
        $ts_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'TS', $getNews['user_id']);
        $jx_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'JX', $getNews['user_id']);
        $gxsf_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'GXSF', $getNews['user_id']);
        $gdsf_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'GDSF', $getNews['user_id']);
        $tjsf_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'TJSF', $getNews['user_id']);
        $cqsf_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'CQSF', $getNews['user_id']);
        $gd11_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'GD11', $getNews['user_id']);
        $bjpk_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'BJPK', $getNews['user_id']);
        $bjkn_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'BJKN', $getNews['user_id']);
        $ssrc_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'SSRC', $getNews['user_id']);
        $mlaft_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'MLAFT', $getNews['user_id']);
        $orpk_result = OrderLottery::getBetMoneyAndCount($time['s_time'], $time['e_time'], 'ORPK', $getNews['user_id']);

        $d3_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'D3', $getNews['user_id']);
        $p3_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'P3', $getNews['user_id']);
        $t3_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'T3', $getNews['user_id']);
        $cq_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'CQ', $getNews['user_id']);
        $tj_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'TJ', $getNews['user_id']);
        $ts_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'TS', $getNews['user_id']);
        $jx_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'JX', $getNews['user_id']);
        $gxsf_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'GXSF', $getNews['user_id']);
        $gdsf_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'GDSF', $getNews['user_id']);
        $tjsf_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'TJSF', $getNews['user_id']);
        $cqsf_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'CQSF', $getNews['user_id']);
        $gd11_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'GD11', $getNews['user_id']);
        $bjpk_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'BJPK', $getNews['user_id']);
        $bjkn_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'BJKN', $getNews['user_id']);
        $ssrc_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'SSRC', $getNews['user_id']);
        $mlaft_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'MLAFT', $getNews['user_id']);
        $orpk_win = OrderLottery::getWin($time['s_time'], $time['e_time'], 'ORPK', $getNews['user_id']);

        $all_bet_count = $d3_result['bet_count'] + $p3_result['bet_count'] + $t3_result['bet_count'] + $cq_result['bet_count'] + $tj_result['bet_count'] + $ts_result['bet_count'] + $jx_result['bet_count'] + $gxsf_result['bet_count'] + $gdsf_result['bet_count'] + $tjsf_result['bet_count'] + $gd11_result['bet_count'] + $bjpk_result['bet_count'] + $bjkn_result['bet_count'] + $cqsf_result['bet_count'] + $ssrc_result['bet_count'] + $mlaft_result['bet_count'] + $orpk_result['bet_count'];
        $all_bet_money = $d3_result['bet_money'] + $p3_result['bet_money'] + $t3_result['bet_money'] + $cq_result['bet_money'] + $tj_result['bet_money'] + $ts_result['bet_money'] + $jx_result['bet_money'] + $gxsf_result['bet_money'] + $gdsf_result['bet_money'] + $tjsf_result['bet_money'] + $gd11_result['bet_money'] + $bjpk_result['bet_money'] + $bjkn_result['bet_money'] + $cqsf_result['bet_money'] + $ssrc_result['bet_money'] + $mlaft_result['bet_money'] + $orpk_result['bet_money'];
        $all_win_money = $d3_win + $p3_win + $t3_win + $cq_win + $tj_win + $ts_win + $jx_win + $gxsf_win + $gdsf_win + $tjsf_win + $gd11_win + $bjpk_win + $bjkn_win + $cqsf_win + $ssrc_win + $mlaft_win + $orpk_win;
        $lottery_list['d3_count'] = $d3_result['bet_count'];
        $lottery_list['d3_money'] = $d3_result['bet_money'];
        $lottery_list['d3_win'] = $d3_win;
        $lottery_list['d3_result'] = $d3_result['bet_money'] - $d3_win;
        $lottery_list['p3_count'] = $p3_result['bet_count'];
        $lottery_list['p3_money'] = $p3_result['bet_money'];
        $lottery_list['p3_win'] = $p3_win;
        $lottery_list['p3_result'] = $p3_result['bet_money'] - $p3_win;
        $lottery_list['t3_count'] = $t3_result['bet_count'];
        $lottery_list['t3_money'] = $t3_result['bet_money'];
        $lottery_list['t3_win'] = $t3_win;
        $lottery_list['t3_result'] = $t3_result['bet_money'] - $t3_win;
        $lottery_list['cq_count'] = $cq_result['bet_count'];
        $lottery_list['cq_money'] = $cq_result['bet_money'];
        $lottery_list['cq_win'] = $cq_win;
        $lottery_list['cq_result'] = $cq_result['bet_money'] - $cq_win;
        $lottery_list['jx_count'] = $jx_result['bet_count'];
        $lottery_list['jx_money'] = $jx_result['bet_money'];
        $lottery_list['jx_win'] = $jx_win;
        $lottery_list['jx_result'] = $jx_result['bet_money'] - $jx_win;
        $lottery_list['tj_count'] = $tj_result['bet_count'];
        $lottery_list['tj_money'] = $tj_result['bet_money'];
        $lottery_list['tj_win'] = $tj_win;
        $lottery_list['tj_result'] = $tj_result['bet_money'] - $tj_win;
        $lottery_list['ts_count'] = $ts_result['bet_count'];
        $lottery_list['ts_money'] = $ts_result['bet_money'];
        $lottery_list['ts_win'] = $ts_win;
        $lottery_list['ts_result'] = $ts_result['bet_money'] - $ts_win;
        $lottery_list['gxsf_count'] = $gxsf_result['bet_count'];
        $lottery_list['gxsf_money'] = $gxsf_result['bet_money'];
        $lottery_list['gxsf_win'] = $gxsf_win;
        $lottery_list['gxsf_result'] = $gxsf_result['bet_money'] - $gxsf_win;
        $lottery_list['gdsf_count'] = $gdsf_result['bet_count'];
        $lottery_list['gdsf_money'] = $gdsf_result['bet_money'];
        $lottery_list['gdsf_win'] = $gdsf_win;
        $lottery_list['gdsf_result'] = $gdsf_result['bet_money'] - $gdsf_win;
        $lottery_list['tjsf_count'] = $tjsf_result['bet_count'];
        $lottery_list['tjsf_money'] = $tjsf_result['bet_money'];
        $lottery_list['tjsf_win'] = $tjsf_win;
        $lottery_list['tjsf_result'] = $tjsf_result['bet_money'] - $tjsf_win;
        $lottery_list['cqsf_count'] = $cqsf_result['bet_count'];
        $lottery_list['cqsf_money'] = $cqsf_result['bet_money'];
        $lottery_list['cqsf_win'] = $cqsf_win;
        $lottery_list['cqsf_result'] = $cqsf_result['bet_money'] - $cqsf_win;
        $lottery_list['bjkn_count'] = $bjkn_result['bet_count'];
        $lottery_list['bjkn_money'] = $bjkn_result['bet_money'];
        $lottery_list['bjkn_win'] = $bjkn_win;
        $lottery_list['bjkn_result'] = $bjkn_result['bet_money'] - $bjkn_win;
        $lottery_list['gd11_count'] = $gd11_result['bet_count'];
        $lottery_list['gd11_money'] = $gd11_result['bet_money'];
        $lottery_list['gd11_win'] = $gd11_win;
        $lottery_list['gd11_result'] = $gd11_result['bet_money'] - $gd11_win;
        $lottery_list['bjpk_count'] = $bjpk_result['bet_count'];
        $lottery_list['bjpk_money'] = $bjpk_result['bet_money'];
        $lottery_list['bjpk_win'] = $bjpk_win;
        $lottery_list['bjpk_result'] = $bjpk_result['bet_money'] - $bjpk_win;
        $lottery_list['ssrc_count'] = $ssrc_result['bet_count'];
        $lottery_list['ssrc_money'] = $ssrc_result['bet_money'];
        $lottery_list['ssrc_win'] = $ssrc_win;
        $lottery_list['ssrc_result'] = $ssrc_result['bet_money'] - $ssrc_win;
        $lottery_list['mlaft_count'] = $mlaft_result['bet_count'];
        $lottery_list['mlaft_money'] = $mlaft_result['bet_money'];
        $lottery_list['mlaft_win'] = $mlaft_win;
        $lottery_list['mlaft_result'] = $mlaft_result['bet_money'] - $mlaft_win;

        $lottery_list['orpk_count'] = $orpk_result['bet_count'];
        $lottery_list['orpk_money'] = $orpk_result['bet_money'];
        $lottery_list['orpk_win'] = $orpk_win;
        $lottery_list['orpk_result'] = $orpk_result['bet_money'] - $orpk_win;

        $lottery_list['all_count'] = $all_bet_count;
        $lottery_list['all_money'] = $all_bet_money;
        $lottery_list['all_win'] = $all_win_money;
        $lottery_list['all_result'] = $all_bet_money - $all_win_money;
        return $this->render('index', [
                    'time' => $time,
                    'lottery_list' => $lottery_list,
                    'user_id' => $getNews['user_id'],
                        ]
        );
    }

    /**
     * 报表的详细信息（精确到每一单）
     */
    public function actionDetail() {
        $arr_id = $all = array();
        $all['money'] = $all['sy'] = $all['result'] = 0;
        $pages =$lottery_list = '';
        $getNews = Yii::$app->request->get();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $type['type'] = $getNews['type'];
        $type['name'] = $this->_typeToName($getNews['type']);
        $order_id_arr = OrderLottery::getOrderId($getNews['s_time'], $getNews['e_time'], $getNews['type'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if ($order_id_arr) {
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $lottery_arr = OrderLottery::getOrderDelail($arr_id);
            $pages = new Pagination(['totalCount' => $lottery_arr->count(), 'pageSize' => $this->page]);
            $lottery_list = $lottery_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            foreach ($lottery_list as $key => $value) {
                $lottery_list[$key]['contentName'] = GetContentName::getName($value['number'], $value['Gtype'], $value['rtype_str'], $value['quick_type']);
                $bet_rate = $value['bet_rate_one'];
                if (strpos($bet_rate, ',') !== false) {
                    $bet_rate_array = explode(',', $bet_rate);
                    $bet_rate = $bet_rate_array[0];
                }
                $lottery_list[$key]['rate'] = $bet_rate;
                $all['money'] += $value['bet_money_one'];
                if ($value['is_win'] == '1') {
                    $all['sy'] = $all['sy'] + $value['win_sub'] + $value['fs'];
                    $lottery_list[$key]['money_result'] = $value['win_sub'] + $value['fs'];
                } else if ($value['is_win'] == '2') {
                    $all['sy'] += $value['bet_money_one'];
                    $lottery_list[$key]['money_result'] = $value['bet_money_one'];
                } else {
                    if (($value['is_win'] == '0') && (0 < $value['fs'])) {
                        $all['sy'] += $value['fs'];
                        $lottery_list[$key]['money_result'] = $value['fs'];
                    }else{
                    $all['sy'] += $value['fs'];
                    $lottery_list[$key]['money_result'] = $value['fs'];
                    }
                }
            }
        }
        return $this->render('lottery_detail', [
                    'type' => $type,
                    'time' => $time,
                    'user_id' => $getNews['user_id'],
                    'lottery_list' => $lottery_list,
                    'all' => $all,
                    'pages'=>$pages
                        ]
        );
    }

    /**
     * 名称装换
     * @param type $type
     * @return string
     */
    function _typeToName($type) {
        $name = '';
        if ($type == 'd3')
            $name = '3D彩';
        if ($type == 'p3')
            $name = '排列三';
        if ($type == 't3')
            $name = '上海时时乐';
        if ($type == 'cq')
            $name = '重庆时时彩';
        if ($type == 'jx')
            $name = '江西时时彩';
        if ($type == 'tj')
            $name = '极速时时彩';
        if ($type == 'ts')
            $name = '腾讯分分彩';
        if ($type == 'gxsf')
            $name = '广西十分彩';
        if ($type == 'gdsf')
            $name = '广东十分彩';
        if ($type == 'tjsf')
            $name = '天津十分彩';
        if ($type == 'cqsf')
            $name = '重庆十分彩';
        if ($type == 'bjkn')
            $name = '北京快乐8';
        if ($type == 'gd11')
            $name = '广东十一选五';
        if ($type == 'bjpk')
            $name = '北京PK拾';
        if ($type == 'ssrc')
            $name = '极速赛车';
        if ($type == 'orpk')
            $name = '老PK拾';
        return $name;
    }

}
