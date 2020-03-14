<?php
namespace app\modules\agentht\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\agentht\models\LiveOrder;
use app\modules\agentht\models\UserList;


class LiveController extends Controller {
    private $_resp = [];
    public $page =20;//真人分页，需要*6(对应6种平台)ps:存在真人平台数的细微差别

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
        $all['money'] = $all['sy'] = $live_list = $pages = 0;
        $order_id_arr = LiveOrder::getOrderIdLive($getNews['s_time'], $getNews['e_time'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if($order_id_arr){
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $live_arr = LiveOrder::getOrderDelailLive($arr_id);
            $pages = new Pagination(['totalCount' => $live_arr->count(), 'pageSize' => $this->page*6]);
            $live_list = $live_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            foreach ($live_list as $key => $value) {
                $all['money'] += $value['bet_money'];
                $all['sy'] -= $value['live_win'];
            }
        }
        return $this->render('index', [
                    'time' => $time,
                    'all'=>$all,
                    'user_id'=>$getNews['user_id'],
                    'live_list'=>$live_list,
                    'pages'=>$pages,
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