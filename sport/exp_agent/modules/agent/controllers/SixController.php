<?php

namespace app\modules\agent\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\modules\agent\models\UserList;
use app\modules\agent\models\SixLotteryOrder;

class SixController extends BaseController {
    public $page = 20;

    public function init() {//初始化函數
        parent::init();
        $this->layout = false;
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
    }
    /**
     * Six 詳細報表信息
     * @return type
     */
    public function actionIndex() {
        $getNews = Yii::$app->request->get();
        $time['s_time'] = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $time['e_time'] = $this->getParam('e_time', date('Y-m-d H:i:s'));
        $all = $arr_id = array();
        $pages = $six_list = $all['money'] = $all['sy'] = $all['result'] = 0;
        $order_id_arr = SixLotteryOrder::getOrderId($getNews['s_time'], $getNews['e_time'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if ($order_id_arr) {
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $six_arr = SixLotteryOrder::getOrderDelailSix($arr_id);
            $pages = new Pagination(['totalCount' => $six_arr->count(), 'pageSize' => $this->page]);
            $six_list = $six_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            foreach ($six_list as $key => $value) {
                $six_list[$key]['money_result'] = 0;
                if ($value['is_win'] == '1') {
                    $all['sy'] += $value['win_sub'] + $value['fs'];
                    $six_list[$key]['money_result'] = $value['win_sub'] + $value['fs'];
                } else if ($value['is_win'] == '2') {
                    $all['sy'] += $value['bet_money_one'];
                    $six_list[$key]['money_result'] = $value['bet_money_one'];
                } else {
                    if (($value['is_win'] == '0') && (0 < $value['fs'])) {
                        $all['sy'] += $value['fs'];
                        $six_list[$key]['money_result'] = $value['fs'];
                    }
                }
                $all['money'] += $value['bet_money_one'];
            }
            
        }
        return $this->render('index', [
                    'time' => $time,
                    'user_id'=>$getNews['user_id'],
                    'six_list'=>$six_list,
                    'pages'=>$pages,
                    'all' => $all
                        ]
        );
    }

}
