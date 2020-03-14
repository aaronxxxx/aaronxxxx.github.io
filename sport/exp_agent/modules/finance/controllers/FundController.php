<?php
namespace app\modules\finance\controllers;

use Yii;
use app\common\data\Pagination;
use app\common\base\BaseController;
use app\common\services\ServiceFactory;
use app\modules\agentht\models\UserList;
use app\modules\finance\models\HistoryBank;
use app\modules\finance\models\Money;
use app\modules\finance\models\MoneyLog;
use app\modules\finance\models\MsgAdd;
use app\modules\finance\models\Hacker;
use app\modules\agentht\models\ar\SysConfig;




/**
 * Default controller for the `FinanceModule` module
 */
class FundController extends BaseController
{
    private $_session = null;
    private $_params = null;
    private $_data = [];
    private $_resp = [];
    public $page = '20';

    public function init() {//初始化函數
        parent::init();
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
        $this->layout = '@app/modules/agentht/views/layouts/main';
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失敗
            'data' => [],
            'msg' => ''
        ];
    }
    /**
     * 存款管理
     */
    public function actionMoneySave() {
        $sum = $true = $false = $cl = $sxf_sum= 0;
        $time = $this->getParam('time','');
        $time_start = $this->getParam('time_start',date('Y-m-d 00:00:00', strtotime('-6 day')));
        $time_end = $this->getParam('time_end',date('Y-m-d 23:59:59'));
        $status = $this->getParam('status','全部存款');
        $order = $this->getParam('order','id');
        $username = $this->getParam('username','');
        $type = $this->getParam("type",'');
        if($type=='noTime'){
            $time_start = $time_end = '';
        }
        $pageSize = SysConfig::getPagesize("money_show_row");
        $allId = Money::selectCunkuanId($status, trim($username), $time_start, $time_end, $order);
        $pages = new Pagination(['totalCount' =>count($allId->asArray()->all()), 'pageSize' => $pageSize]);
	    $id = $allId->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $data = Money::selectCunkuanData($id, $order);
        for($i=0;$i<count($data);$i++){
            $userId = $data[$i]["user_id"];
            $name = UserList::selectCunkuanUsername($userId);
            $data[$i]['username']= $name['user_name'];
            $sum +=abs($data[$i]["order_value"]);
            $sxf_sum += $data[$i]["sxf"];
        }
            return $this->render('moneySave', [
                    'data' => $data,
                    'pages' => $pages,
                    'sum' => $sum,
                    'status'=>$status,
                    'sxf_sum' => $sxf_sum,
                    'order' => $order,
                    'time' => $time,
                    'time_start' => $time_start,
                    'time_end' => $time_end,
                    'username' => $username,
        ]);
    }
    
    public function actionLookMoney() {
        $time_start = $this->getParam('time_start',date('Y-m-d 00:00:00',strtotime('-6 day')));
        $time_end = $this->getParam('time_end',date('Y-m-d 23:59:59'));
        $status = $this->getParam('status','所有狀態');
        $username = $this->getParam("username","");
        $arr_m=array();
        $arr_m[1]	=0;
        $arr_m[2]	=0;
        $arr_m[3]	=0;
        $online_money = 0;
        $backend_money = 0;
        $qk_money = 0;
        $qk_admin_money = 0;
        $data = Money::selectCaiwuData($time_start, $time_end, trim($username), $status);//查詢財務數據
        $pageSize = SysConfig::getPagesize("money_show_row");
        $pages = new Pagination(['totalCount' =>count($data->asArray()->all()), 'pageSize' => $pageSize]);
        $list = $data->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render("lookMoney", [
                    'arr' => $list,
                    'arr_m' => $arr_m,
                    'time_start' => $time_start,
                    'time_end' => $time_end,
                    'username' => $username,
                    'backend_money' => $backend_money,
                    'online_money' => $online_money,
                    'qk_money' => $qk_money,
                    'qk_admin_money' => $qk_admin_money,
                    'status'=>$status,
                    'pages'=>$pages
        ]);
    }

    public function actionCkSet() {
		/*
        $ok = $this->getParam('ok');
        $mid = intval($this->getParam('id'));
		*/
		//submit為get...需要用get抓才行
		$ok = $_GET['ok'];
		$mid = $_GET['id'];
        $row = Money::selectCk($mid);//查詢存款數據
        $uid = $row["user_id"];
        $m_orderid = $row["order_num"];
        $m_oamount = $row["order_value"];
        $assets = $row["assets"];
        $balance = $m_oamount + $assets;

        if ($ok == 1) { //充值成功
            $q1 = Money::updateCkSuccess($mid);
            if ($q1 == 2) {
                $q3 = MoneyLog::InsertMoneyLog($uid, $m_orderid, $m_oamount, $assets, $balance);
                if ($q3 != 1) {
                    Money::updateCkStatus($mid);
                    return "支付失敗，插入金錢記錄失敗";
                }
                $msg = '操作成功';
            } else {
                $msg = '操作失敗';
            }
        } else {
            $q1 = Money::updateCkFalse($mid);
            if ($q1 == 1) {
                $msg ='操作成功';
            } else {
                $msg = '操作失敗';
            }
        }
        return $msg;
    }
    
    public function actionTixian() {
        $time = $this->getParam('time',"");
        $time_start = $this->getParam('time_start',date('Y-m-d 00:00:00', strtotime('-6 day')));
        $time_end = $this->getParam('time_end',date('Y-m-d 23:59:59'));
        $status = $this->getParam('status','全部提款');
        $order = $this->getParam('order','id');
        $username = $this->getParam("username",'');
        $type = $this->getParam("type",'');
        if($type=='noTime'){
            $time_start = $time_end = '';
        }
        $allId = Money::selectTikuanId($status, trim($username), $time_start, $time_end,$order);
        //分頁
        $pageSize = SysConfig::getPagesize("money_show_row");
        $pages = new Pagination(['totalCount' =>count($allId->asArray()->all()), 'pageSize' => $pageSize]);
	    $id = $allId->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        $data = Money::selectTiKuanData($id, $order);
        $c_sum = $m_sum = $t_sum = $f_sum = $sxf_sum = 0;
        foreach ($data as $rows) {
            $money = abs($rows["order_value"]);
            $m_sum += $money;
            $sxf_sum+= $rows["sxf"];
            if ($rows['status'] == "失敗") {
                $f_sum +=$money;
            } else if ($rows["status"] == "成功") {
                $t_sum +=$money;
            } else {
                $c_sum +=$money;
            }
        }
        $historybankData = HistoryBank::selectHistorybank($username);
        return $this->render("tixian",[
            'data'=>$data,
            'pages'=>$pages,
            'time_start'=>$time_start,
            'time_end'=>$time_end,
            'status'=>$status,
            'order'=>$order,
            'time'=>$time,
            'username'=>$username,
            'c_sum'=>$c_sum,
            'm_sum'=>$m_sum,
            'f_sum'=>$f_sum,
            't_sum'=>$t_sum,
            'sxf_sum'=>$sxf_sum,
            'historybank'=>$historybankData,
        ]);
                
    }
    
    public function actionTixianDetail() {
        $id = $this->getParam('id', '');
        $tixianData = Money::moneyDetail(trim($id));
        if ($tixianData['status'] == '未結算' || $tixianData['status'] == '審核中') {//查詢未結算用戶的數據
            $userid = $tixianData['user_id'];
            $lastMoney = Money::selectTxTime($userid);
            $tixianData['end_time'] = $lastMoney['update_time'];
            $tixianData['order_v'] = $lastMoney['order_value'];
            $s_time = date('Y-m-d');
            $todayTkCs = Money::selectTodayTkCs($userid, $s_time);
            $tixianData['today_tk_cs'] = $todayTkCs['today_tk_cs'];
            $totalTkCs = Money::selectTotalTkCs($userid);
            $tixianData['total_tk_cs'] = $totalTkCs['total_tk_cs'];

            $service = ServiceFactory::get('sport', 'sportReportService');
            $sport = $service->sportTotalMoney($userid,$tixianData['end_time']);
            $touzhu1 = $sport['dsResult']['s'];
            $touzhu2 = $sport['cgResult']['s'];
            $service = ServiceFactory::get('lottery', 'lotteryorderReportService');
            $touzhu3 = $service->TixianDetail($userid,$tixianData['end_time'],date('Y-m-d H:i:s'));
            $service = ServiceFactory::get('six', 'sixReportService');
            $six = $service->sixTotalBetMoney($userid,$tixianData['end_time'],date('Y-m-d H:i:s'));
            $touzhu4 = $six['bet_money_valid_total'];
            $service = ServiceFactory::get('live', 'liveService');
            $touzhu5 = $service->totalBetMoney($userid,$tixianData['end_time'],date('Y-m-d H:i:s'));
            $tixianData['tz_money'] = sprintf("%.2f", ($touzhu1 + $touzhu2 + $touzhu3 + $touzhu4 + $touzhu5));
        }
        //黑名單
        $hacker_list = array();
        $hacker = Hacker::find()->select('name')->asArray()->all();
        if ($hacker) {
            foreach ($hacker as $key => $val) {
                $hacker_list[] = $val['name'];
            }
        }
        return $this->render('tixianDetail', [
                    'rows' => $tixianData,
                    'hacker_list' => $hacker_list,
        ]);
    }
    
    public function actionDoTixian(){
        $mid = Yii::$app->request->get('m_id');
        $status = $this->getParam('status');
        $sxf = trim($this->getParam('sxf', ''));
        $about = $this->getParam('about', '');
        $title = $this->getParam('title','');
        if ($status == 1) {
            $q1 = Money::updateTixianStatus($status, $mid, $about, $sxf);
            if (!$q1) {
                return '操作失敗';
            }
        } elseif ($status == 0) {
                $order_num = $this->getParam('order_num');
            if (strpos($order_num, '代理額度')) { //代理申請額度失敗，要把申請額度記錄刪除
                Money::updateTixianStatus($status, $mid, $about);
            } else { //會員正常取款失敗，得還款到賬戶上
                $q1 = Money::updateFalse($about, $mid);
                if ($q1 != 2) {
                    return '更新金額失敗，操作失敗';
                }
                $row = Money::selectTixianFalseData($mid);
                $order = $row["order_num"];
                $pay_value = 0 - $row["order_value"];
                $balance = $row["u_balance"];
                $assets = $balance - $pay_value;
                $pay_value_log = 0 - $pay_value;
                $uid = $row["user_id"];
                $q3 = MoneyLog::InsertTixian($uid, $order, $about, $pay_value_log, $assets, $balance);
                if (!$q3) {
                    Money::updateMU($mid);
                    return '插入金錢記錄失敗，操作失敗';
                }
                if ($about != "") {
                    $web_name = isset($web_site['web_name']) ? $web_site['web_name'] : '' ;
                    MsgAdd::msg_add($uid, $web_name, $title, $about);
                }
            }
        } elseif($status == 3) {
            Money::updateTixianStatus($status, $mid);
        }else {
            return '操作無效';
        }
        return '操作成功';
    }

}
    