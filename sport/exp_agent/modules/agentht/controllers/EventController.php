<?php
namespace app\modules\agentht\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\agent\models\UserList;
use app\modules\agentht\models\EventOrder;
use app\modules\event\models\EventPlayer;
use app\modules\event\models\EventMultipleOdds;

/**
 * Order controller for the event module
 */
class EventController extends Controller
{
    public $gameType = [];
    public $status = [];
    public $eventPlayer = [];
    public $page = 20;

    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $this->layout = 'main';

        $this->page = 20;

        $this->eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();

        $this->gameType = [
            1 => '兩方',
            2 => '多項目'
        ];

        $this->status = [
            0 => '未结算',
            1 => '已结算',
            2 => '重新结算',
            3 => '已作废'
        ];
    }

    public function actionIndex()
    {
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $all = $arr_id = array();
        $pages = $event_list = $all['money'] = $all['sy'] = $all['result'] = 0;
        $order_id_arr = EventOrder::getOrderId($getNews['s_time'], $getNews['e_time'], $getNews['user_id']);
        $user_name = UserList::getUserNameByUserId($getNews['user_id']);
        $all['user_name'] = $user_name['user_name'];
        if ($order_id_arr) {
            foreach ($order_id_arr as $key => $value) {
                $arr_id[$key] = $value['id'];
            }
            $event_arr = EventOrder::getOrderDetailEvent($arr_id);
            $pages = new Pagination(['totalCount' => $event_arr->count(), 'pageSize' => $this->page]);
            $event_list = $event_arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();

            foreach ($event_list as $key => $value) {
                $event_list[$key]['money_result'] = 0;
                if ($value['is_win'] == '1') {
                    $all['sy'] += $value['win'] + $value['fs'];
                    $event_list[$key]['money_result'] = $value['win'] + $value['fs'];
                } else if ($value['is_win'] == '2') {
                    $all['sy'] += $value['bet_money'];
                    $event_list[$key]['money_result'] = $value['bet_money'];
                } else {
                    if (($value['is_win'] == '0') && (0 < $value['fs'])) {
                        $all['sy'] += $value['fs'];
                        $event_list[$key]['money_result'] = $value['fs'];
                    }
                }

                $all['money'] += $value['bet_money'];
            }
        }
        return $this->render('index', [
                'time' => $time,
                'user_id'=>$getNews['user_id'],
                'event_list'=>$event_list,
                'pages'=>$pages,
                'gameType' => $this->gameType,
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
