<?php
namespace app\modules\agentht\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\agentht\models\AgentsList;
use app\modules\agentht\models\UserList;
use app\modules\agentht\models\AgentsMoneyLog;
use app\modules\agentht\models\SixLotteryOrder;
use app\modules\agentht\models\SpsixLotteryOrder;
use app\modules\agentht\models\OrderLottery;
use app\modules\agentht\models\KBet;
use app\modules\agentht\models\EventOrder;

class OrderController extends Controller {
    public $gameType = [];
    private $_resp = [];
    public $page=20;

    public function init() {//初始化函数
        parent::init();
        $this->gameType = [
            1 => '兩方',
            2 => '多項目',
            '' => ''
        ];
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $this->layout = 'main';
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失败
            'data' => [],
            'msg' => ''
        ];
    }
    /**
     * 未结算注单 (six)
     * @return type
     */
    public function actionSix(){
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $time['user'] = isset($getNews['user_name']) && $getNews['user_name'] ? $getNews['user_name'] : '';
        $time['qishu'] = isset($getNews['qishu']) && $getNews['qishu'] ? $getNews['qishu'] : '';
        $time['order_sub_num'] = isset($getNews['order_sub_num']) && $getNews['order_sub_num'] ? $getNews['order_sub_num'] : '';
        $result = SixLotteryOrder::getOrderById($agent_id,$time['user'],$time['s_time'],$time['e_time'],$time['qishu'],$time['order_sub_num']);
        $pages = new Pagination(['totalCount' =>count($result->asArray()->all()), 'pageSize' => $this->page]);
        $list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('six',array(
            'list' => $list,
            'pages' => $pages,
            'time'=>$time,
        ));
    }

    public function actionSpsix(){
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $time['user'] = isset($getNews['user_name']) && $getNews['user_name'] ? $getNews['user_name'] : '';
        $time['qishu'] = isset($getNews['qishu']) && $getNews['qishu'] ? $getNews['qishu'] : '';
        $time['order_sub_num'] = isset($getNews['order_sub_num']) && $getNews['order_sub_num'] ? $getNews['order_sub_num'] : '';
        $result = SpsixLotteryOrder::getOrderById($agent_id,$time['user'],$time['s_time'],$time['e_time'],$time['qishu'],$time['order_sub_num']);
        $pages = new Pagination(['totalCount' =>count($result->asArray()->all()), 'pageSize' => $this->page]);
        $list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('spsix',array(
            'list' => $list,
            'pages' => $pages,
            'time'=>$time,
        ));
    }

    public function actionLottery(){
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $time['user'] = isset($getNews['user_name']) && $getNews['user_name'] ? $getNews['user_name'] : '';
        $time['qishu'] = isset($getNews['qishu']) && $getNews['qishu'] ? $getNews['qishu'] : '';
        $time['order_sub_num'] = isset($getNews['order_sub_num']) && $getNews['order_sub_num'] ? $getNews['order_sub_num'] : '';
        $t_sy = $bet_money = $list = 0;
        $uid = OrderLottery::getUserId($time['user']);
        if(!empty($time['user']) && empty($uid)){
            return $this->render('lottery',array(
                'time'=>$time,
                'list' => $list,
                'bet_money'=>$bet_money,
                't_sy'=>$t_sy,
            ));
        }
        $result = OrderLottery::getUserLotteryOrderList($agent_id,$uid,$time['s_time'],$time['e_time'],$time['qishu'],$time['order_sub_num']);
        $page = new Pagination(['totalCount' => $result->count(),'pagesize'=>$this->page]);
        $list = $result->offset($page->offset)->limit($page->limit)->orderBy(['o.id'=> SORT_DESC])->asArray()->all();
        foreach($list as $key => $val){
            $bet_money += $val['bet_money'];
            if ($val['is_win'] == "1") {
                $t_sy = $t_sy + $val['win'] + $val['fs'];
            } elseif ($val['is_win'] == "2") {
                $t_sy+=$val['bet_money'];
            } elseif ($val['is_win'] == "0" && $val['fs'] > 0) {
                $t_sy+=$val['fs'];
            }
        };
        return $this->render('lottery',array(
            'time'=>$time,
            'list' => $list,
            'pages' => $page,
            'bet_money'=>$bet_money,
            't_sy'=>$t_sy,
        ));
    }

    // public function actionSport(){
    //     if (empty(Yii::$app->session['S_AGENT_ID'])) {
    //         return $this->_getout(); exit;
    //     }
    //     $getNews = Yii::$app->request->get();
    //     $param = array();
    //     $agent_id = Yii::$app->session['S_AGENT_ID'];
    //     $param['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00',strtotime('-6 day'));
    //     $param['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
    //     $param['user_name'] = isset($getNews['user_name']) && $getNews['user_name'] ? $getNews['user_name'] : '';
    //     $param['match_id'] = isset($getNews['match_id']) && $getNews['match_id'] ? $getNews['match_id'] : '';
    //     $param['ball_sort'] = isset($getNews['ball_sort']) && $getNews['ball_sort'] ? $getNews['ball_sort'] : '';
    //     $param['tf_id'] = isset($getNews['tf_id']) && $getNews['tf_id'] ? $getNews['tf_id'] : '';
    //     $param['type'] = isset($getNews['type']) && $getNews['type'] ? $getNews['type'] : '';
    //     //查询注单的用户id
    //     $uid[0]['user_id'] = "";
    //     if($param['user_name']){
    //         $uid = UserList::find()->select(['user_id'])->where(['user_name'=>trim($param['user_name'])])->asArray()->all();
    //     }
    //     //获取注单id
    //     $orderId = KBet::selectOrderId($agent_id,$param['type'], $uid[0]['user_id'], trim($param['match_id']), $param['s_time'], $param['e_time'], $param['ball_sort'], trim($param['tf_id']));
    //     //获取注单数据，进行分页
    //     $pages = new Pagination(['totalCount' =>$orderId->count(), 'pagesize' => $this->page]);
    //     $id = $orderId->offset($pages->offset)->limit($pages->limit)->all();
    //     $data = KBet::selectOrderData($id);

    //     //获取注单用户名和投注金额，可赢金额
    //     $allOrderMoney = '';
    //     for($i=0;$i<count($data);$i++){
    //         $name = UserList::find()->select(['user_name'])->where(['user_id'=>$data[$i]['user_id']])->one();
    //         $data[$i]['user_name'] = $name['user_name'];
    //         $allOrderMoney += $data[$i]['bet_money'];

    //         //判断状态查询冠军信息
    //         $data[$i]['bet_result'] = "";
    //         if ($data[$i]["status"] != 0 && $data[$i]["status"] != 3) {
    //             if($data[$i]["ball_sort"] == "冠军") {
    //                 $tId = $data[$i]["match_id"];
    //                 $championResult = TGuanjun::selectResult($tId);
    //                 $data[$i]['bet_result'] = '<br/>' . $championResult["x_result"];
    //             } elseif ($data[$i]["MB_Inball"] != null && $data[$i]["MB_Inball"] != '') {
    //                 $data[$i]['bet_result'] = '<br/>[' . $data[$i]["MB_Inball"] . ':' . $data[$i]["TG_Inball"] . ']';
    //             }
    //         }
    //     }
    //     //前端页面需要的参数
    //     $param['all_order_money'] = $allOrderMoney;
    //     return $this->render('sport',[
    //         'data'=>$data,
    //         'pages'=>$pages,
    //         'param'=>$param,
    //     ]);
    // }
    
    private function _getout() {
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script language="javascript" charset="utf-8">';
        echo 'alert("请重新登入！");window.location.href="/?r=agentht/agent/index"';
        echo '</script>';
    }
    /**
     * 未结算注单 (event)
     * @return type
     */
    public function actionEvent(){
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->_getout(); exit;
        }
        $getNews = Yii::$app->request->get();
        $agent_id = Yii::$app->session['S_AGENT_ID'];
        $time['s_time'] = isset($getNews['s_time']) && $getNews['s_time'] ? $getNews['s_time'] : date('Y-m-d 00:00:00');
        $time['e_time'] = isset($getNews['e_time']) && $getNews['e_time'] ? $getNews['e_time'] : date('Y-m-d H:i:s');
        $time['user'] = isset($getNews['user_name']) && $getNews['user_name'] ? $getNews['user_name'] : '';
        $time['qishu'] = isset($getNews['qishu']) && $getNews['qishu'] ? $getNews['qishu'] : '';
        $time['order_sub_num'] = isset($getNews['order_sub_num']) && $getNews['order_sub_num'] ? $getNews['order_sub_num'] : '';
        $result = EventOrder::getOrderById($agent_id,$time['user'],$time['s_time'],$time['e_time'],$time['qishu'],$time['order_sub_num']);
        $pages = new Pagination(['totalCount' =>count($result->asArray()->all()), 'pageSize' => $this->page]);
        $list = $result->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('event',array(
            'list' => $list,
            'pages' => $pages,
            'gameType' => $this->gameType,
            'time'=>$time,
        ));
    }
}