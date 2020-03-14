<?php
namespace app\modules\agentht\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\agentht\models\UserList;
use app\modules\agentht\models\SpsixLotteryOrder;

class SpsixController extends Controller {
    private $_resp = [];
    public $page=20;

    public function init() {//初始化函数
        parent::init();
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $this->layout = 'main';
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失败
            'data' => [],
            'msg' => ''
        ];
    }
    
    public function actionIndex(){
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $top_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $all = $arr_id = array();
        $pages = $six_list = $all['money'] = $all['sy'] = $all['result'] = 0;
        $order_id_arr = SpsixLotteryOrder::getOrderId($getNews['s_time'], $getNews['e_time'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if ($order_id_arr) {
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $six_arr = SpsixLotteryOrder::getOrderDelailSpSix($arr_id);
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
                    'spsix_list'=>$six_list,
                    'pages'=>$pages,
                    'all' => $all
                        ]
        );
    }
    
    private function _getout() {
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script language="javascript" charset="utf-8">';
        echo 'alert("请重新登入！");window.location.href="/?r=agentht/agent/index"';
        echo '</script>';
    }
}