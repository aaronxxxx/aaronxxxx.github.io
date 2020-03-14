<?php
namespace app\modules\general\mobile\controllers;

use Yii;
use app\common\base\BaseController;
use yii\data\Pagination;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;
use app\modules\lottery\models\ar\OrderLottery;
use app\modules\lottery\models\ar\UserGroup;
use app\modules\six\models\SixLotteryOrder;
use app\modules\general\mobile\models\user\UserList;
use app\modules\general\mobile\models\WithdrawSetCardForm;
use app\modules\general\mobile\models\vip\Money;
use app\modules\general\mobile\models\vip\LiveLog;
use app\modules\general\member\models\ar\SysConfig;
use app\modules\general\member\models\ar\SysHuikuanList;
use app\modules\general\member\models\BankTransaction\PaySet;
/**
 * IndexController
 */
class FinancialController extends BaseController {
    private $_session = null;
    private $_params = null;
    private $_data = [];
    public $enableCsrfValidation = false;
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        $this->getView()->title = '财务中心';
        $this->layout = 'member';
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
    }

    /**
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $uid = $this->_session[$this->_params['S_USER_ID']];
        $usernews = UserList::getUserNewsByUserID($uid);
         //$model = new SysHuikuanList();

		//根据type和status显示银行信息1-网银 2-微信 3-支付宝  4-财付通
        // $data =SysHuikuanList::find()->where('bank_status= 1')->groupBy('bank_type')->all();
		// $newdata = [
		// 	1=>['bank_xm'=>'','bank_name'=>'','bank_number'=>''],
		// 	2=>['bank_xm'=>'','bank_name'=>'','bank_number'=>''],
		// 	3=>['bank_xm'=>'','bank_name'=>'','bank_number'=>''],
        //     4=>['bank_xm'=>'','bank_name'=>'','bank_number'=>'']
		// ];
		// foreach($data as $key=>$val){
		// 	$newdata[$val['bank_type']] = $val;
        // }

        // $arr = SysHuikuanList::find()->where(['like', 'group_set', '|'.$usernews['group_id'].'|'])->andwhere(['bank_status'=>'1'])->asArray()->all();


        // 20190110 修正根據用戶的分組作篩選
        $tradition = SysHuikuanList::find()->where(['like', 'group_set', '|'.$usernews['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '1'])->asArray()->all();
        $weixin = SysHuikuanList::find()->where(['like', 'group_set', '|'.$usernews['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '2'])->asArray()->all();
        $zfb = SysHuikuanList::find()->where(['like', 'group_set', '|'.$usernews['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '3'])->asArray()->all();
        $cft = SysHuikuanList::find()->where(['like', 'group_set', '|'.$usernews['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '4'])->asArray()->all();

        $sysconfig=SysConfig::find()->limit(1)->one();
		$rows = PaySet::getPaySetByStartAndMoney($usernews['group_id']); //获取所有正常且启动的支付表信息
        $urlArr[0]['payurl'] = 'javascript:void(0)';
        $urlArr[0]['pay_name'] = '暂未开启在线支付';
        if (!empty($rows)){
            foreach($rows as $key=>$val){
                $pay_key = $this->_encrypt($usernews['user_id'], 'E',$val['user_key']);
                $urlArr[$key]['payurl'] = "http://" . $val['pay_domain'] ."/?user_id=".$pay_key."&user_name=".$usernews['user_name']."&pay_type=".$val['pay_type'];
                $urlArr[$key]['pay_name'] = "【".$val['platform_name'].'】';
            }
        }
        return $this->render('index',[
            'userlist'=>$usernews,
            // 'kuikuan_data'=>$arr,
            'tradition' => $tradition,
            'weixin' => $weixin,
            'zfb' => $zfb,
            'cft' => $cft,
            'min_huikuan_money'=>$sysconfig['min_huikuan_money'],
            'urlarr'=>$urlArr
        ]);
    }

    /**
     * 财务中心-提款页面
     */
    public function actionWithdraw()
    {
        if (! $this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }

        $uid = $this->_session[$this->_params['S_USER_ID']];
        $usernews = UserList::getUserNewsByUserID($uid);

        //获取用户信息,判断是否已经设置银行卡信息
        if ($usernews['pay_bank'] == '未填写' || $usernews['pay_bank'] == '') {
            $tradeType = [
                1 => 'USDT',
                2 => 'ETH_USDT'
            ];

            return $this->render('set_card', [
                'userlist' => $usernews,
                'tradeType' => $tradeType
            ]);
        }

        $sysconfig = SysConfig::find()->limit(1)->one();

        return $this->render('draw_money', [
            'userlist' => $usernews,
            'min_money' => $sysconfig['min_qukuan_money']
        ]);
    }

    /**
     * 用户第一次设置银行卡信息
     * @return type
     */
    public function actionSetCard()
    {
        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $postNews = Yii::$app->request->post();

        if (!isset($postNews['readrule']) || !isset($postNews['readrule2'])) {
            return '请勾选权限';
        }

        $model = new WithdrawSetCardForm;
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews
        ];

        if (!$model->load($this->_data) || !$model->validate()) {
            $msg = $model->getErrors();
            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    return $value;                                       //返回表单验证的错误信息
                }
            }
        }

        $r = UserList::setPayCard($user_id, $postNews);

        if ($r) {
            return '0';
        }

        return '取款密码错误';
    }

    /**
     * 财务中心-VIP报表页面
     */
    public function actionVip(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $user_group = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $usernews = UserList::getUserNewsByUserID($user_group);
        $data = [
//                'assetUrl' => $this->_assetUrl,
            ];
        $getNews = Yii::$app->request->get();
        $arr1['type'] = '';
        $arr1['order_num'] = '';
        $arr = array();
        $db = Yii::$app->db;
        if (empty($getNews['type'])) {                                          //在线存款记录
            $sql = Money::getOnlineSeposit($user_group);
            $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
            $cunkuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
            $sum = 0;
            if ($cunkuan_list && count($cunkuan_list) > 0) {
                $arr1['order_num'] = 1;
                foreach ($cunkuan_list as $key => $cunkuan_info) {
                    if ($cunkuan_info["status"] == "成功") {
                        $sum += $cunkuan_info["order_value"];
                        $statusString = '<span style="color:#FF0000;">成功</span>';
                    } else if ($cunkuan_info["status"] == "失败") {
                        $statusString = '<span style="color:#000000;">失败</span>';
                    } else {
                        $statusString = '<span style="color:#0000FF;">审核中</span>';
                    }
                    $cunkuan_list[$key]['statusString'] = $statusString;
                }
                $arr = $cunkuan_list;
            }
        } else if ($getNews['type'] == 'hk') {                                  //在线汇款记录
            $arr1['type'] = 'hk';
            $sql = Money::getRemittanceRecords($user_group);
            $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
            $huikuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
            if ($huikuan_list && count($huikuan_list) > 0) {
                $arr1['order_num'] = 1;
                foreach ($huikuan_list as $key => $value) {
                    if ($value['status'] == '未结算') {
                        $huikuan_list[$key]['status'] = '审核中';
                    } elseif($value['status'] == '失败') {
                        $huikuan_list[$key]['status'] = '交易失败';
                    }elseif($value['status'] == '成功'){
                        $huikuan_list[$key]['status'] = '交易成功';
                    }
                }
                $arr = $huikuan_list;
            }
        } else if ($getNews['type'] == 'qk') {                                  //在线取款记录
            $arr1['type'] = 'qk';
            $sql = Money::getWithdrawRecord($user_group);
            $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
            $qukuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
            if ($qukuan_list && count($qukuan_list) > 0) {
                $arr1['order_num'] = 1;
                foreach ($qukuan_list as $key => $value) {
                    if ($value['status'] == '未结算') {
                        $qukuan_list[$key]['status'] = '审核中';
                    } else if($value['status'] == '失败'){
                        $qukuan_list[$key]['status'] = '交易失败';
                    }else if($value['status'] == '成功'){
                        $qukuan_list[$key]['status'] = '交易成功';
                    }
                    $qukuan_list[$key]['order_value'] = 0 - $value['order_value'];
                }
                $arr = $qukuan_list;
            }
        } else if ($getNews['type'] == 'zz') {                                  //额度转换
            $arr1['type'] = 'zz';
            $sql = LiveLog::getLifeRecordByUser($user_group);
            $pages = new Pagination(['totalCount' => count($db->createCommand($sql)->queryAll()), 'pageSize' => 10]);
            $zzkuan_list = $db->createCommand($sql." limit ". $pages->limit." offset ". $pages->offset."")->queryAll();
            if ($zzkuan_list && count($zzkuan_list) > 0) {
                $arr1['order_num'] = 1;
                $in_ag_total = 0;
                $out_ag_total = 0;
                $in_agin_total = 0;
                $out_agin_total = 0;
                $in_ag_bbin_total = 0;
                $out_ag_bbin_total = 0;
                $in_ds_total = 0;
                $out_ds_total = 0;
                $in_ag_og_total = 0;
                $out_ag_og_total = 0;
                $in_mg_total = 0;
                $out_mg_total = 0;
                $in_og_total = 0;
                $out_og_total = 0;
                $in_kg_total = 0;
                $out_kg_total = 0;
                foreach ($zzkuan_list as $key => $userLive) {
                    $live_type = $userLive["live_type"];
                    $zzArray = $this->_getZztype($userLive["zz_type"], $userLive["live_type"],$userLive["result"],$userLive["zz_money"]);
                    $cancel_button = "";
                    if ($userLive["status"] == "0" || $userLive["status"] == "4") {
                        $cancel_button = '<input type="button" value="取消转账" onclick="rollbackDeal(\'' . $userLive["id"] . '\',\'' . $userLive["zz_type"] . '\',\'' . $live_type . '\')"/>';
                    }
                    $in_ag_total += $zzArray[1];
                    $out_ag_total += $zzArray[2];
                    $in_agin_total += $zzArray[3];
                    $out_agin_total += $zzArray[4];
                    $in_ag_bbin_total += $zzArray[5];
                    $out_ag_bbin_total += $zzArray[6];
                    $in_ds_total += $zzArray[7];
                    $out_ds_total += $zzArray[8];
                    $in_ag_og_total += $zzArray[9];
                    $out_ag_og_total += $zzArray[10];
                    $in_mg_total += $zzArray[11];
                    $out_mg_total += $zzArray[12];
                    $in_og_total += $zzArray[13];
                    $out_og_total += $zzArray[14];
                    $in_kg_total += $zzArray[15];
                    $out_kg_total += $zzArray[16];
                    $zzkuan_list[$key]['zz_type'] = $zzArray[0];
                    $zzkuan_list[$key]['cancel_button'] = $cancel_button;
                }
                $arr = $zzkuan_list;
                $arr1['in_ag_total'] = $in_ag_total;
                $arr1['out_ag_total'] = $out_ag_total;
                $arr1['in_agin_total'] = $in_agin_total;
                $arr1['out_agin_total'] = $out_agin_total;
                $arr1['in_ag_bbin_total'] = $in_ag_bbin_total;
                $arr1['out_ag_bbin_total'] = $out_ag_bbin_total;
                $arr1['in_ds_total'] = $in_ds_total;
                $arr1['out_ds_total'] = $out_ds_total;
                $arr1['in_ag_og_total'] = $in_ag_og_total;
                $arr1['out_ag_og_total'] = $out_ag_og_total;
                $arr1['in_mg_total'] = $in_mg_total;
                $arr1['out_mg_total'] = $out_mg_total;
                $arr1['in_og_total'] = $in_og_total;
                $arr1['out_og_total'] = $out_og_total;
                $arr1['in_kg_total'] = $in_kg_total;
                $arr1['out_kg_total'] = $out_kg_total;
            }
        }
        return $this->render('vip',['data'=>$data,'userlist'=>$usernews,'arr' => $arr, 'arr1' => $arr1, 'pages' => $pages]);
    }

    /**
     * 支付宝订单
     */
    public function actionZfb() {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $user_id = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $usernews = UserList::getUserNewsByUserID($user_id);
        $user_name = $usernews['user_name'];
        $user_money = $usernews['money'];
        $postNews = Yii::$app->request->post();
        $money = trim($postNews['zfb_PaySele']);
        $number = $postNews['zfb_acc_val'];
        $InType = "支付宝帐号：".$number;
        $r = Money::addZfborder($user_id,$user_name,$user_money, $InType,$money);     //汇款动作
        if($r){
            return 0;//成功
        }
        return '提交失败！若已经扣款，请联系客服！';

    }
    /**
     * 微信订单
     */
    public function actionWx() {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $user_id = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $usernews = UserList::getUserNewsByUserID($user_id);
        $user_name = $usernews['user_name'];
        $user_money = $usernews['money'];
        $postNews = Yii::$app->request->post();
        $money = trim($postNews['wx_PaySele']);
        $number = $postNews['wx_acc_val'];
        $InType = "微信帐号：".$number;
        $r = Money::addWxorder($user_id,$user_name,$user_money, $InType,$money);     //汇款动作
        if($r){
            return 0;//成功
        }
        return '提交失败！若已经扣款，请联系客服！';
    }
    /**
     * 财付通订单
     */
    public function actionCft() {
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/login');
        }
        $user_id = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $usernews = UserList::getUserNewsByUserID($user_id);
        $user_name = $usernews['user_name'];
        $user_money = $usernews['money'];
        $postNews = Yii::$app->request->post();
        $money = trim($postNews['cft_PaySele']);
        $number = $postNews['cft_acc_val'];
        $InType = "财付通帐号：".$number;
        $r = Money::addCftorder($user_id,$user_name,$user_money, $InType,$money);     //汇款动作
        if($r){
            return 0;//成功
        }
        return '提交失败！若已经扣款，请联系客服！';
    }

    static public function _getZztype($zz_type,$live_type,$result,$money){
        $in_ag_total = 0;
        $out_ag_total = 0;
        $in_agin_total = 0;
        $out_agin_total = 0;
        $in_ag_bbin_total = 0;
        $out_ag_bbin_total = 0;
        $in_ds_total = 0;
        $out_ds_total = 0;
        $in_ag_og_total = 0;
        $out_ag_og_total = 0;
        $in_mg_total = 0;
        $out_mg_total = 0;
        $in_og_total = 0;
        $out_og_total = 0;
        $in_kg_total = 0;
        $out_kg_total = 0;
        if ($zz_type == "1" && $live_type == 'AG') {
            $zz_type = "转入AG极速厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_total += $money;
            }
        }elseif ( $zz_type == "2" && $live_type ==  'AG') {
            $live_type =  'AG';
            $zz_type = "从AG极速厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_total += $money;
            }
        }
        if ($zz_type == "3" && $live_type == 'AGIN') {
            $live_type = 'AGIN';
            $zz_type = "转入AG国际厅";
            if (strpos($result, "[成功]") !== false) {
                $in_agin_total += $money;
            }
        } elseif ($zz_type == "4" && $live_type == 'AGIN') {
            $live_type = 'AGIN';
            $zz_type = "从AG国际厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_agin_total += $money;
            }
        }
        if ($zz_type == "5" && $live_type == 'AG_BBIN') {
            $live_type = 'AG_BBIN';
            $zz_type = "转入AG BBIN厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_bbin_total += $money;
            }
        } elseif ($zz_type == "6" && $live_type == 'AG_BBIN') {
            $live_type = 'AG_BBIN';
            $zz_type = "从AG BBIN厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_bbin_total += $money;
            }
        }
        if ($zz_type == "7" && $live_type == 'DS') {
            $live_type = 'DS';
            $zz_type = "转入DS厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ds_total += $money;
            }
        } elseif ($zz_type == "8" && $live_type == 'DS') {
            $live_type = 'DS';
            $zz_type = "从DS厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ds_total += $money;
            }
        }
        if ($zz_type == "9" && $live_type == 'AG_OG') {
            $live_type = 'AG_OG';
            $zz_type = "转入AG OG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_ag_og_total += $money;
            }
        } elseif ($zz_type == "10" && $live_type == 'AG_OG') {
            $live_type = 'AG_OG';
            $zz_type = "从AG OG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_ag_og_total += $money;
            }
        }
        if ($zz_type == "11" && $live_type == 'AG_MG') {
            $live_type = 'AG_MG';
            $zz_type = "转入AG MG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_mg_total += $money;
            }
        } elseif ($zz_type == "12" && $live_type == 'AG_MG') {
            $live_type = 'AG_MG';
            $zz_type = "从AG MG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_mg_total += $money;
            }
        }
        if ($zz_type == "13" && $live_type == 'OG') {
            $live_type = 'OG';
            $zz_type = "转入OG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_og_total += $money;
            }
        } elseif ($zz_type == "14" && $live_type == 'OG') {
            $live_type = 'OG';
            $zz_type = "从OG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_og_total += $money;
            }
        }
        if ($zz_type == "15" && $live_type == 'KG') {
            $live_type = 'KG';
            $zz_type = "转入KG厅";
            if (strpos($result, "[成功]") !== false) {
                $in_kg_total += $money;
            }
        } elseif ($zz_type == "16" && $live_type == 'KG') {
            $live_type = 'KG';
            $zz_type = "从KG厅转出";
            if (strpos($result, "[成功]") !== false) {
                $out_kg_total += $money;
            }
        }

        return array($zz_type,$in_ag_total,$out_ag_total,$in_agin_total,$out_agin_total,$in_ag_bbin_total,$out_ag_bbin_total
                ,$in_ds_total,$out_ds_total,$in_ag_og_total,$out_ag_og_total,$in_mg_total,$out_mg_total,$in_og_total,$out_og_total,$in_kg_total,$out_kg_total);
    }
    public function _getCondition($userid,$update_time){
        $rs1 = (new \yii\db\Query())->select('sum(bet_money) as s')->from("k_bet")->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2, 4, 5]])->limit(1)->one(); //体育单式注单总金额
        if (!$rs1 || !$rs1["s"]) {
            $touzhu1 = 0;
        } else {
            $touzhu1 = $rs1["s"];
        }
        $rs2 = OrderLottery::find()->select(['sum(bet_money) as s'])->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2]])->limit(1)->asArray()->one(); //彩票注单总金额
        if (!$rs2 || !$rs2["s"]) {
            $touzhu2 = 0;
        } else {
            $touzhu2 = $rs2["s"];
        }
        $rs3 = SixLotteryOrder::find()->select(['sum(bet_money_total) as s'])->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2]])->limit(1)->asArray()->one(); //六合彩投注总金额
        if (!$rs3 || !$rs3["s"]) {
            $touzhu3 = 0;
        } else {
            $touzhu3 = $rs3["s"];
        }
        $rs4 = (new \yii\db\Query())->select('sum(bet_money) as s')->from("k_bet_cg_group")->where(['user_id' => $userid])
            ->andWhere(['>', 'bet_time', $update_time])->andWhere(['status' => [1, 2]])->limit(1)->one(); //体育串关投注总金额
        if (!$rs4 || !$rs4["s"]) {
            $touzhu4 = 0;
        } else {
            $touzhu4 = $rs4["s"];
        }
        $rs = LiveUser::find()->select(['live_username'])->where(['user_id' => $userid])->andWhere(['live_type' => 'AG'])->asArray()->one();
        $rs5 = LiveOrder::find()->select(['sum(bet_money) as s'])->where(['live_username' => $rs['live_username']])
            ->andWhere(['>', 'order_time', $update_time])->asArray()->one();  //真人投注总金额
        if (!$rs5 || !$rs5["s"]) {
            $touzhu5 = 0;
        } else {
            $touzhu5 = $rs5["s"];
        }
        $lottery_he = OrderLottery::getHe($update_time,date('Y-m-d H:i:s'),$userid);
        $six_he = SixLotteryOrder::getDrawSum($userid,$update_time,date('Y-m-d H:i:s'));
        $condition = sprintf("%.2f", ($touzhu1 + $touzhu2 + $touzhu3 + $touzhu4 + $touzhu5 -$lottery_he - $six_he));
        return $condition;
    }

    /**
     * 第三方支付加密方式
     * @param $string           用户ID
     * @param $operation        E：加密，D：解密
     * @param string $key       用户id加密秘钥
     * @return bool|string
     */
    public function _encrypt($string,$operation,$key=''){
        $key=md5($key);
        $key_length=strlen($key);
        $string=$operation=='D'?base64_decode(str_replace(' ','+',$string)):substr(md5($string.$key),0,8).$string;
        $string_length=strlen($string);
        $rndkey=$box=array();
        $result='';
        for($i=0;$i<=255;$i++){
            $rndkey[$i]=ord($key[$i%$key_length]);
            $box[$i]=$i;
        }
        for($j=$i=0;$i<256;$i++){
            $j=($j+$box[$i]+$rndkey[$i])%256;
            $tmp=$box[$i];
            $box[$i]=$box[$j];
            $box[$j]=$tmp;
        }
        for($a=$j=$i=0;$i<$string_length;$i++){
            $a=($a+1)%256;
            $j=($j+$box[$a])%256;
            $tmp=$box[$a];
            $box[$a]=$box[$j];
            $box[$j]=$tmp;
            $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
        }
        if($operation=='D'){
            if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){return substr($result,8);
            }else{return'';}
        }else{
            return urlencode(str_replace('=','',base64_encode($result)));
        }
    }


}