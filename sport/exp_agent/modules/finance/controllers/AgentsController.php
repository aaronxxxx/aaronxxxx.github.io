<?php

namespace app\modules\finance\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\agentht\models\AgentsList;
use app\models\AgentsManageLog;
use app\modules\finance\models\AgentsMoney;
use app\modules\finance\models\AgentsTransferLog;
use app\modules\finance\models\Hacker;
use app\modules\agentht\models\ar\SysConfig;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `FinanceModule` module
 */
class AgentsController extends BaseController
{
    private $_session = null;
    private $_params = null;
    private $_data = [];
    private $_resp = [];
    private $_level = '';
    private $_id = '';
    public $page = '20';

    public function init() {//初始化函數
        parent::init();
        $this->_level = Yii::$app->session['S_AGENT_LEVEL'];
        $this->_id = Yii::$app->session['S_AGENT_ID'];
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }
        if ( $this->_level != 0 ) {
            return $this->redirect('/?r=finance/default/index');
        }
        $this->enableCsrfValidation = false;                                                //關閉表單驗證
        $this->layout = '@app/modules/agentht/views/layouts/main';
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失敗
            'data' => [],
            'msg' => ''
        ];
    }
    /**
     * 加款扣款页面
     * @return string
     */
    public function actionIndex()
    {
        $user = array();
        $userName = $this->getParam('username','');
        if( $userName ){
            $user  = AgentsList::find()->where(array('agents_name'=>trim($userName),'agent_level'=>$this->_id))->one();
        }
        //print_r($user); exit;
        //今日加款扣款
        $addMinusMoney  = AgentsMoney::selectAddMinusMoney();
        $pageTXT = array('who' => "總代理", 'user' => "代理");
        return $this->render('index',array('user'=>$user,'addMinus'=>$addMinusMoney));
    }

    /**
     * 加款扣款操作
     * @return string
     */
    public function actionMoneySet()
    {
        $user = array();
        $type = $this->getParam('type','add');
        $userId = $this->getParam('uid','');
        if($userId){
            $user  = AgentsList::find()->where(array('id'=>$userId))->one();
        }
        $parent = AgentsList::find()->where(array('id'=>$this->_id))->one();
        return $this->render('moneyset',array(
            'user'=>$user,
            'type'=>$type,
            'parent'=>$parent
        ));
    }

    /**
     * 加款扣款数据操作
     */
    public function actionDoMoneySet(){

        $save = $this->getParam('save','');
        if($save && $save=='ok'){

            $uid = $this->getParam('id',0);
            $money = $this->getParam('money',0);
            $about = $this->getParam('about','');
            $userName = $this->getParam('agents_name','');
            $money = floatval($money);
            $order = date("YmdHis")."_".$userName;
            $type = $this->getParam('type','');
                        
            $user  = AgentsList::find()->where(array('id'=>$uid))->one();           //代理
            $parent = AgentsList::find()->where(array('id'=>$this->_id))->one();    //總代

            if($type == 'tixian'){
                if( $user['money'] < $money ) {  //代理可用額度小於可用金額
                    return '可扣餘額不足，請重新確認後再試一次';
                }
            }else{
                if( $parent['money'] < $money ) {
                    return '可用餘額不足，請重新確認後再試一次';
                }
            }

            $rows_check = AgentsManageLog::find()
                ->select('edtime')
                ->where(['like','edlog','金额'])
                ->andWhere(['like','edlog',$userName])
                ->orderBy(['edtime'=>SORT_DESC])
                ->one();

            $time_diff = time()-strtotime($rows_check["edtime"]);            
            if($time_diff<20){
                return '操作失败，不允许在20秒内对同一个账号进行操作。(以当前操作时间开始计算)';
            }
            if(!$user['money']){$user['money'] = 0;}
            if($type=='add'){
                if(AgentsTransferLog::chongzhi($uid,$order,$money,$user['money'],$about."[總代撥款]")){
                    AgentsMoney::chongzhi($uid,$order,$money,$user['money'],$about."[總代撥款]");

                    AgentsTransferLog::tixian($this->_id,date("YmdHis")."_".$parent['agents_name'],$money,$parent['money'],$about."[總代->代理]");
                    AgentsMoney::tixian($this->_id,date("YmdHis")."_".$parent['agents_name'],$money,$parent['money'],$about."[總代->代理]");
                    return '加钱成功';
                }else{
                    return '加钱失败';
                }
            }elseif($type=='tixian'){  //新增總代理減少代理金額
                if(AgentsTransferLog::tixian_tixian($uid, $order, $money, $user['money'], $about."[代理->總代]")){  //1.扣掉代理的錢
                    AgentsMoney::tixian_tixian($uid,$order,$money,$user['money'],$about."[代理->總代]");//扣掉代理的錢
                    AgentsTransferLog::tixian_chongzhi($this->_id,date("YmdHis")."_".$parent['agents_name'],$money,$parent['money'],$about."[代理->總代]");
                    AgentsMoney::chongzhi($this->_id,date("YmdHis")."_".$parent['agents_name'],$money,$parent['money'],$about."[總代扣款]");
                    return '扣款成功';
                }else{
                    return '扣款失败';
                }
            }
            else{
                return '操作異常，請重整後再試';
            }
        }

    }



    /**
     * 财务日志
     */
    public function actionFinanceLog(){
        $monthArray = array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
        $month = $this->getParam('date_month',0);
        $userIn = $this->getParam('userIn','');
        $userNin = $this->getParam('userNin','');
        $startTime = $this->getParam('s_time',date('Y-m-d 00:00:00', strtotime('-6 day')));
        $endTime = $this->getParam('e_time',date('Y-m-d 23:59:59'));
        $start = date('Y-m-d 00:00:00',strtotime($startTime));
        $end = date('Y-m-d 23:59:59',strtotime($endTime));
        $userInArray = $userIn ? explode(',',trim($userIn)):array();
        $userNinArray = $userNin ? explode(',',trim($userNin)):array();
        $list = AgentsMoney::LogUser($userInArray,$userNinArray,$start,$end);
        $pageSize = SysConfig::getPagesize("money_show_row");
        $pages = new Pagination(['totalCount' =>$list->count(), 'pagesize' => $pageSize]);
        $data = $list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        if($data){
            $user = array();
            foreach ($data as $key=>$val){
                $user[] = $val['agents_name'];
            }

            $huikuan =  AgentsMoney::MoneyLog($userInArray,$userNinArray,$start,$end)->asArray()->all();
            $ckLog = AgentsMoney::ckLog($user,$start,$end,0)->asArray()->all();
            $qkLog =  AgentsMoney::qkLog($user,$start,$end,0)->asArray()->all();
            $ckLogHd = AgentsMoney::ckLog($user,$start,$end,1)->asArray()->all();
            $qkLogHd =  AgentsMoney::qkLog($user,$start,$end,1)->asArray()->all();
            foreach ($data as $key=>$val){
                $data[$key]['ck'] = 0;
                $data[$key]['qk'] = 0;
                $data[$key]['ckHd'] = 0;
                $data[$key]['qkHd'] = 0;
                $data[$key]['huikuan'] = 0;
                if($ckLog){
                    foreach ($ckLog as $ckey=>$ckval){
                        if($val['agents_name']==$ckval['agents_name']) {
                            $data[$key]['ck'] = $ckval['order_value'];
                        }
                    }
                }
                if($ckLogHd){
                    foreach ($ckLogHd as $cHkey=>$cHval){
                        if($val['agents_name']==$cHval['agents_name']) $data[$key]['ckHd'] = $cHval['order_value'];
                    }
                }
                if($qkLog){
                    foreach ($qkLog as $qkey=>$qkval){
                        if($val['agents_name']==$qkval['agents_name']) {
                            $data[$key]['qk'] = abs($qkval['order_value']);
                        }
                    }
                }
                if($qkLogHd){
                    foreach ($qkLogHd as $qHkey=>$qHval){
                        if($val['agents_name']==$qHval['agents_name']) $data[$key]['qkHd'] = $qHval['order_value'];
                    }
                }
                if($huikuan){
                    foreach ($huikuan as $hkey=>$hkval){
                        if($val['agents_name']==$hkval['agents_name']) {
                            $data[$key]['huikuan'] = $hkval['huikuan'];
                        }
                    }
                }
            }
        }
        return $this->render('financelog',array(
            'userIn'=>$userIn,
            'userNin'=>$userNin,
            'startTime'=>$startTime,
            'endTime'=>$endTime,
            'monthArray'=>$monthArray,
            'month'=>$month,
            'data'=>$data,
            'pages'=>$pages
        ));
    }

    /*
     * 汇款管理
     */
    public function actionHuikuan(){
        $params = Yii::$app->request->get();
        $httpStr = http_build_query($params);
        $url = ltrim($httpStr, "r=");
        $statusArray = array('未结算'=>'未处理','审核中'=>'处理审核中','成功'=>'汇款成功','失败'=>'汇款失败','全部'=>'全部汇款');
        $statusArray1 = array('未结算'=>'未处理','成功'=>'汇款成功','失败'=>'汇款失败','全部'=>'全部汇款');
        $orderArray = array('update_time'=>'提交时间','order_value'=>'汇款金额','zsjr'=>'赠送金额');
        $user = $this->getParam('agents_name','');
        $startTime = $this->getParam('start_time',date('Y-m-d 00:00:00',strtotime('-6 days')));
        $endTime = $this->getParam('end_time',date('Y-m-d 23:59:59'));
        $status = $this->getParam('status','全部');
        //排序条件
        $order = $this->getParam('order','update_time');
        $bank = $this->getParam('bank','');
        $start = date('Y-m-d 00:00:00',strtotime($startTime));
        $end = date('Y-m-d 23:59:59',strtotime($endTime));
        $type = $this->getParam("type",'');
        if($type=='noTime'){
            $start = $end = $startTime = $endTime = '';
        }
        $list = AgentsMoney::huikuan(trim($user),$start,$end,$order,$status,$bank);
        $pageSize = SysConfig::getPagesize("money_show_row");
        $pages = new Pagination(['totalCount' =>$list->count(), 'pagesize' => $pageSize]);
        $data = $list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('huikuan',array(
            'statusArray'=>$statusArray,
            'statusArray1'=>$statusArray1,
            'orderArray'=>$orderArray,
            'user'=>$user,
            'startime'=>$startTime,
            'endtime'=>$endTime,
            'status'=>$status,
            'order'=>$order,
            'data'=>$data,
            'url'=>$url,
            'pages'=>$pages
        ));
    }

    /**
     * 汇款明细
     */
    public function actionHuikuanDetail(){
        $id = $this->getParam('id',0);
        $update = $this->getParam('update','');
        $data = AgentsMoney::moneyDetail($id);
        //黑名单
        $hacker_list = array();
        $hacker = Hacker::find()->select('name')->asArray()->all();
        if($hacker){
            foreach ($hacker as $key=>$val){
                $hacker_list[] = $val['name'];
            }
        }
        $sysConfig = SysConfig::find()->asArray()->one();
        $zsbl = ArrayHelper::getValue($sysConfig, 'hk_sxf', 0);
        return $this->render('huikuanDetail',array(
            'data'=>$data,
            'update'=>$update,
            'hacker_list'=>$hacker_list,
            'zsbl'=>$zsbl
        ));
    }

    /**
     * 汇款记录
     */
    public function actionDoHuikuan(){
        $id = $this->getParam('id',0);
        $status = $this->getParam('status',0);
        $sxf = $this->getParam('sxf_bl','');
        $zsjr = $this->getParam('is_zsjr','');
        $sxfBl = $sxf && $zsjr ?$sxf:0;
        if($id==0){
            return '请选择要操作的汇款单';
        }
        if($status==0){
            return '请选择要操作的动作';
        }
        if(!($status==1 || $status==2 || $status==3)){
            return '要操作的动作不准确';
        }
        return AgentsMoney::updateMoney($id,$status,$sxfBl);
    }
}
