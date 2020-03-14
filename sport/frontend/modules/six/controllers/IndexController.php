<?php
namespace app\modules\six\controllers;

use app\common\base\BaseController;
use app\modules\six\models\CommonFc\CommonFc;
use app\modules\six\models\LotteryResultLhc;
use app\modules\six\models\MoneyLog;
use app\modules\six\models\SixLotteryOdds;
use app\modules\six\models\SixLotteryOrder;
use app\modules\six\models\SixLotteryOrderSub;
use app\modules\six\models\SixLotterySchedule;
use app\modules\six\models\SysAnnouncement;
use app\modules\six\models\UserGroup;
use app\modules\six\models\UserList;
use app\modules\six\helpers\Zodiac;
use app\modules\core\common\filters\LoginFilter;
use app\modules\core\common\filters\UserFilter;
use app\modules\six\helpers\DataValid;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * 六合彩
 * IndexController
 */
class IndexController extends BaseController  {
    public function init() {
        parent::init();
        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->layout = 'main';
    }
    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => LoginFilter::className(),
                'only' => ['six-order']
            ],
            [
                'class' => UserFilter::className(),
                'only' => ['six-order']
            ],
        ], parent::behaviors());
    }
/**
     * 主页面
     * @return type
     */
    public function actionIndex() {
        $CommonFc = new CommonFc();
        $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];             //正常登陆
        $rType = "SP";//A面
        $showTableN = 0;
        $getNews = Yii::$app->request->get();
        $lastOne=SixLotterySchedule::lastOne();
        $zodiac = $CommonFc->_zoadiacList(date('Y'));
        $class=@new Zodiac();
        if($class){
            $zodiacArr=$class->getArr();
        }
        $zodiacArray = $CommonFc->_zoadiacString(date('Y'));
        $lowestMoney=0;
        $maxMoney=0;
        $row=UserGroup::getLimitAndFsMoney($userid);
        $qishu = SixLotterySchedule::getNewQishu(); //获取当前期数 qishu=-1 未开盘
        $kjresult = LotteryResultLhc::getSixResult('',10);//近十期开奖结果
        if($row){
            $lowestMoney = $row['lhc_lower_bet'];
            $maxMoney = $row['lhc_max_bet'];
        }
        if (!empty($getNews['showTableN'])) {$showTableN = $getNews['showTableN'];}
        if (!empty($getNews['rtype'])) {
            $rType = $getNews['rtype'];
            if($getNews['rtype'] == 'NAP'){                                     //正码过关
                $odds_NAP1 = SixLotteryOdds::getOdds("NAP1");
                $odds_NAP2 = SixLotteryOdds::getOdds("NAP2");
                $odds_NAP3 = SixLotteryOdds::getOdds("NAP3");
                $odds_NAP4 = SixLotteryOdds::getOdds("NAP4");
                $odds_NAP5 = SixLotteryOdds::getOdds("NAP5");
                $odds_NAP6 = SixLotteryOdds::getOdds("NAP6");
                return $this->render('NAP',array(
                    'qishu'=>$qishu,
                    'zodiac'=>$zodiac,
                    'odds_NAP1'=>$odds_NAP1,
                    'odds_NAP2'=>$odds_NAP2,
                    'odds_NAP3'=>$odds_NAP3,
                    'odds_NAP4'=>$odds_NAP4,
                    'odds_NAP5'=>$odds_NAP5,
                    'odds_NAP6'=>$odds_NAP6,
                    'lowestMoney' => $lowestMoney,
                    'maxMoney'=>$maxMoney,
                    'zodiacArr'=>$zodiacArr,
                    'lastOne'=>$lastOne,
                    'is_login'=>$userid
                ));
            }
            if($getNews['rtype'] == 'CH'){                                      //连码
                $odds_CH = SixLotteryOdds::getOdds('CH');
                return $this->render('CH',array(
                    'qishu'=>$qishu,
                    'zodiac'=>$zodiac,
                    'zodiacArray'=>$zodiacArray,
                    'odds_CH'=>$odds_CH,
                    'lowestMoney' => $lowestMoney,
                    'maxMoney'=>$maxMoney,
                    'zodiacArr'=>$zodiacArr,
                    'lastOne'=>$lastOne,
                    'is_login'=>$userid
                ));
            }
            if($getNews['rtype'] == 'NI'){                                      //自选不中
                $odds_NI = SixLotteryOdds::getOdds("NI");
                return $this->render('NI',array(
                    'qishu'=>$qishu,
                    'zodiac'=>$zodiac,
                    'odds_NI'=>$odds_NI,
                    'lowestMoney' => $lowestMoney,
                    'maxMoney'=>$maxMoney,
                    'zodiacArr'=>$zodiacArr,
                    'lastOne'=>$lastOne,
                    'is_login'=>$userid
                ));
            }
            if($getNews['rtype'] == 'LX'){                                      //连肖
                $odds_LX2 = SixLotteryOdds::getOdds("LX2");
                $odds_LX3 = SixLotteryOdds::getOdds("LX3");
                $odds_LX4 = SixLotteryOdds::getOdds("LX4");
                $odds_LX5 = SixLotteryOdds::getOdds("LX5");
                $odds_LF2 = SixLotteryOdds::getOdds("LF2");
                $odds_LF3 = SixLotteryOdds::getOdds("LF3");
                $odds_LF4 = SixLotteryOdds::getOdds("LF4");
                $odds_LF5 = SixLotteryOdds::getOdds("LF5");
                return $this->render('LX',array(
                    'qishu'=>$qishu,
                    'zodiacArray'=>$zodiacArray,
                    'zodiac'=>$zodiac,
                    'odds_LX2'=>$odds_LX2,
                    'odds_LX3'=>$odds_LX3,
                    'odds_LX4'=>$odds_LX4,
                    'odds_LX5'=>$odds_LX5,
                    'odds_LF2'=>$odds_LF2,
                    'odds_LF3'=>$odds_LF3,
                    'odds_LF4'=>$odds_LF4,
                    'odds_LF5'=>$odds_LF5,
                    'lowestMoney' => $lowestMoney,
                    'maxMoney'=>$maxMoney,
                    'zodiacArr'=>$zodiacArr,
                    'lastOne'=>$lastOne,
                    'is_login'=>$userid
                ));
            }
            if($getNews['rtype'] == 'NX'){                                      //合肖
                $odds_NX = SixLotteryOdds::getOdds("NX");
                return $this->render('NX',array(
                    'qishu'=>$qishu,
                    'zodiac'=>$zodiac,
                    'zodiacArray'=>$zodiacArray,
                    'odds_NX'=>$odds_NX,
                    'lowestMoney' => $lowestMoney,
                    'maxMoney'=>$maxMoney,
                    'zodiacArr'=>$zodiacArr,
                    'lastOne'=>$lastOne,
                    'is_login'=>$userid
                ));
            }
        }
        return $this->render('index', array(
            'qishu'=>$qishu,
            'zodiac'=>$zodiac,
            'rType' => $rType,
            'showTableN' => $showTableN,
            'lowestMoney' => $lowestMoney,
            'maxMoney'=>$maxMoney,
            'kjresult'=>$kjresult,
            'zodiacArr'=>$zodiacArr,
            'lastOne'=>$lastOne,
            'is_login'=>$userid
        ));
    }

    /**
     * ajax返回数据,各类型数据
     * @return type
     */
    public function actionAjax() {
        $getNews = Yii::$app->request->get();
        $res = $this->_getTypeSP($getNews);
        return json_encode($res);
    }

    public function actionMenu(){
        $qishu = SixLotterySchedule::getNewQishu();  //期数 -1 是未开盘
        if($qishu==-1){$qishu="--";}
        $res= array(
            'qishu'=>"$qishu"

        );
        return json_encode($res);
    }
    /**
     * 获取服务器时间
     */
    public function actionTime(){
        $time=array();
        $time['y']= date('Y',time());
        $time['m']=date('m',time());
        $time['d']=date('d',time());
        echo  json_encode($time);
    }
    /**
     * 下注操作
     */
    public function actionSixOrder() {
        $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];             //正常登陆
        $oid = Yii::$app->session[Yii::$app->params['S_USER_OID']];
        $post_time = Yii::$app->session['post_time'];
        if(!empty($post_time)){//限制提交数据重复提交，5秒内提交一次
            if((time()-$post_time)<2){
                return  $this->out(false,'操作太快,请稍后操作!');
            }
        }
        Yii::$app->session['post_time']=time();
        $postNews =  Yii::$app->request->post();
        if(!$postNews){ return $this->out(false,'没有数据提交!'); exit;}
        if(!isset($postNews['period'])||$postNews['period']==0){
            return $this->out(false,'投注异常，请刷新页面！');
        }else{
            if(!$this->_getState($postNews['period'])){
                return $this->out(false,'已经封盘，无法投注！');
            }
        }
        if(empty($postNews['gold'])){$postNews['gold'] = 0;}
        if(empty($postNews['odds'])){$postNews['odds'] = 0;}
        $goldArray = $postNews['gold']; //投注金额数组
        $oddsArray = $postNews['odds']; //投注倍率数组
        $gid = trim($postNews['gid']);
        $rType = $gid;
        $showTableN = !empty($postNews['showTableN'])?$postNews['showTableN']:1;
        $balance = 0; //平衡  用来计算投注
        $assets = 0; //资产
        $bet_money_total = 0; //下注金额
        $bet_win_total = 0;
        $bet_money_one = 0;
        $betInfo_one = 0;
        $bet_rate_one = 0;
        $betInfoArray = array();
        $qishu = SixLotterySchedule::getNewQishu(); //获取当前期数 qishu=-1 未开盘
        $common = new CommonFc();
        $rTypeName = $common::getZhLhcName($rType);
        $rTypeNameDetail = $common::getZhLhcNameDetail($rType,$showTableN);
        $ggid = $gid;
        if (($gid == 'SP') || ($gid == 'SPbside')) {//特码AB面
            $ggid='SP';
        }
        if(in_array($gid, array('N1', 'N2', 'N3', 'N4', 'N5', 'N6'))){//正马特
            $ggid='NAS';
        }
        $type = ['SP','NAS','NA','NO','OEOU','SPA','C7','SPB','HB'];
        //特码   正马特 正码 正码1-6 两面 特码生肖 色波 头尾数 正肖 七色波 一肖 总肖 平特尾数 半波 半半波 数据验证处理
        if(in_array($ggid,$type)){
            $methodName = 'OrderValid'.$ggid;
            $res = $this->$methodName($gid,$goldArray,$oddsArray);
            if($res == false){
                return $this->out(false,'下注异常，请退出重新登录');
            }
        }
        if(empty($postNews['gold'])){ $postNews['gold'] = 0;}
        if(empty($postNews['totalArray'])){ $postNews['totalArray'] = 0;}

        $valid_type = ['CH','LX','LF','NI','NAP'];                      //驗證數量用
        if(in_array($gid,$valid_type)) {
            $ret = $this->data_valid($postNews, $gid);
            if ($ret) {
                return $ret;
            }
        }

        if ($gid == 'NAP') {//正码过关
            $result = $this->OrderNAP($postNews,$goldArray);
            $bet_win_total = $result['bet_win_total'];
            $bet_money_one = $goldArray;
            $betInfo_one = $result['betInfo_one'];
            $bet_rate_one = $result['bet_rate_one'];
            $bet_money_total = $result['bet_money_total'];
        } else if ($gid == 'CH') {//连码
            $result = $this->OrderCH($postNews,$bet_money_total,$bet_win_total);
            $goldArray =$result['goldArray'] ;
            $betInfoArray=$result['betInfoArray'] ;
            $oddsArray=$result['oddsArray']  ;
            $bet_money_total=$result['bet_money_total']  ;
            $bet_win_total=$result['bet_win_total']  ;
            $bet_money_one=$result['bet_money_one'] ;
            $rTypeName=$result['rTypeName']  ;
            $rTypeNameDetail=$result['rTypeNameDetail'] ;
        } else if ($gid == 'NI') {//自选不中
            $result = $this->OrderNI($postNews,$bet_money_total,$bet_win_total);
            $rTypeName = $result['rTypeName'] ;
            $goldArray =$result['goldArray'] ;
            $betInfoArray =$result['betInfoArray'] ;
            $oddsArray=$result['oddsArray'] ;
            $bet_money_total=$result['bet_money_total'] ;
            $bet_win_total=$result['bet_win_total'] ;
        } else if (($gid == 'LX') || ($gid == 'LF')) {//连肖
            $result = $this->OrderLX($postNews,$bet_money_total,$bet_win_total);
            if($result==false){
                return  $this->out(false,'下注错误');
            }
            $rTypeName=$result['rTypeName'];
            $goldArray=$result['goldArray'] ;
            $betInfoArray=$result['betInfoArray'] ;
            $oddsArray=$result['oddsArray'] ;
            $bet_money_total=$result['bet_money_total'];
            $bet_win_total=$result['bet_win_total'] ;
        } else if ($gid == 'NX') {//合肖
            $odds_NX = SixLotteryOdds::getOdds('NX');
            $number_nx = $postNews['num'];
            $select_count_nx = count(explode(',', $number_nx));
            $bet_money_one = $goldArray;
            $betInfo_one = $number_nx;
            $bet_rate_one = $odds_NX['h' . $select_count_nx];
            $bet_money_total = $bet_money_one;
            $bet_win_total = $bet_rate_one * $bet_money_total;
        } else {
            $result = $this->OrderOther($goldArray,$bet_money_total,$bet_win_total,$userid,$oddsArray,$gid,$qishu);
            if($result['status']==false){
                    return  $this->out(false,$result[1]);
            }
            $assets=$result['data']['assets'] ;
            $balance=$result['data']['balance'] ;
            $bet_money_total=$result['data']['bet_money_total'];
            $bet_win_total=$result['data']['bet_win_total'];
            $betInfoArray=$result['data']['betInfoArray'];
        }
        //return  $this->out(false,'錯誤');
        return $this->out(true,$this->_AddSixOrder($userid, $rTypeName, $rTypeNameDetail,$rType, $qishu, $bet_money_total, $balance, $bet_win_total,
            $assets, $goldArray, $oddsArray, $betInfoArray, $gid, $bet_money_one, $betInfo_one, $bet_rate_one));
//        return $this->actionTest($userid, $rTypeName, $rType, $qishu, $bet_money_total, $balance, $bet_win_total,
//            $assets, $goldArray, $oddsArray, $betInfoArray, $gid, $bet_money_one, $betInfo_one, $bet_rate_one);

    }

    /**
     *盘式 数据处理
     * @param type $getNews     ajax提交过来的数据包
     * @return type
     */
    private function _getTypeSP($getNews) {
        $rtype = $getNews['rtype'];
        $rTypeN = '';
        $showTableN = '';
        if(!empty($getNews['rtypeN'])){$rTypeN = $getNews['rtypeN'];}
        if(!empty($getNews['showTableN'])){$showTableN = $getNews['showTableN'];}
        $commonfc = new CommonFc();
        //北京时间
        $bj_time_now = date("Y-m-d H:i:s", time());
        $announcement = SysAnnouncement::getOneAnnouncement();
        $kjresult = LotteryResultLhc::getSixResult('',10);//近十期开奖结果
        $row = SixLotterySchedule::getNewestLottery();                          //返回开盘信息

        if(!$row){   //还未开盘
            $result_show['isCloseAdmin']="true";
            $result_show['Msg'] =$announcement;
            $result_show['reason'] = "目前没有开盘，请咨询客服人员。";
            $result_show['kjresult'] = $kjresult;
            return $result_show;

        }else{
            $qishu=$row['qishu'];
            $fengpanTime = strtotime($row['fenpan_time']);                          //封盘时间
            $kaijiangTime = strtotime($row['kaijiang_time']);                         //开盘时间;
        }
        $differTime = $fengpanTime - strtotime($bj_time_now);
        //显示开奖结果
        if ((date('Y-m-d H:i:s', $fengpanTime) <= $bj_time_now) && ($bj_time_now <= date('Y-m-d H:i:s', $kaijiangTime)))
        {
            $row=LotteryResultLhc::getSixResultByQishu($qishu);
            $ball_count = 0;
            $result = '';
            $animal = '';
            if ($row){
                for ($i=1;$i<=7;$i++){
                    if ($row['ball_'.$i])
                    {
                        $ball_count += 1;
                        $result .= '"' . $row['ball_'.$i] . '",';
                        $animal .= '"' . $commonfc->numToAnimal($row['ball_'.$i], $kaijiangTime). '",';
                    }
                }
            }
            if (0 < $ball_count)
            {
                $result = substr($result, 0, -1);
                $animal = substr($animal, 0, -1);
            }
            $data['BetLineD'] = "N";
            $data['gID'] =null;
            $data['Line_M']=4;
            $data['result']=$result;
            $data['resultAN']=$animal;
            $data['lenb']=$ball_count;
            $data['stopTime']=0;
            $data['stopTime2']=null;
            $data['stopTime3']=null;
            $data['CloseTime'][1]=$differTime;
            $data['CloseTime'][2]=$differTime;
            $data['CloseTime'][3]=$differTime - 180;
            $data['gNum']='';
            $data['gTime']='';
            $data['Msg']=$announcement;
            $data['num']=0;
            $data['HKtime']=$bj_time_now;
            $data['timezone']='美東';
            $data['iTime']=time() ;
            $data['kjresult']=$kjresult;
            return $data;

        }
        $methodName='Show'.$rtype;
        if(method_exists($this,$methodName)){
            $res = $this->$methodName($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime);
        }else{
            $res = $this->ShowOther($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime);
        }
        return $res;
    }


    /**
     * 下注处理器
     * @param type $userid              用户ID
     * @param type $rtype_name          彩票类型名称
     * @param string $rType             彩票类型缩写
     * @param type $lottery_number      开奖期数
     * @param type $bet_money_total     下注金额
     * @param type $balance             下注后金额
     * @param type $bet_win_total       最高可以赢的金额
     * @param type $assets              用户可用金额
     * @param type $goldArray           投注金额数组
     * @param type $oddsArray           投注倍率数组
     * @param type $betInfoArray        所选择下注的号码数组
     * @param type $gid                 下注的彩票类型
     * @param type $bet_money_one       可赢金额（NAP）
     * @param type $betInfo_one         下注号码（NAP）
     * @param type $bet_rate_one        下注倍率（NAP）
     * @return boolean
     */
    private function _AddSixOrder($userid, $rtype_name, $rTypeNameDetail,$rType, $lottery_number, $bet_money_total, $balance, $bet_win_total,
                                  $assets, $goldArray, $oddsArray, $betInfoArray, $gid, $bet_money_one, $betInfo_one, $bet_rate_one){

        $bet_info_sp = "";
        $bet_money_total = abs($bet_money_total);
        if ($gid === 'SPbside') {
            $rType = 'SP';
            $bet_info_sp = 'SPbside';
        } else {
            $bet_info_sp = 'bet_info';
        }

        $user = UserList::getUserNewsByUserId($userid);                                             //查找用户信息
        $assets = $user['money'];
        $balance = $assets - $bet_money_total; //用户资产-投注金额
        if($balance<0){//判断用户余额是否足够
            return '金额不足，不能下注';
        }

        if(!$userid || !$rtype_name || !$rType || !$bet_info_sp || !$bet_money_total || !$lottery_number){
            return '下注失败';
        }
        $id = SixLotteryOrder::addSixOrder($userid, $rtype_name,$rType, $bet_info_sp, $bet_money_total, $bet_win_total, $lottery_number,$rTypeNameDetail); //添加下注订单
        if(!$id){
            return '添加订单失败';
        }
        $datereg = date('YmdHis') . $id;
        $money_log_id = MoneyLog::updateUserMoneyForSix($userid, $datereg, $bet_money_total, $assets, $balance); //添加金额日志
        $r = UserList::UpdateUserMoney($balance, $bet_money_total, $userid);                        //更改用户金额
        if($r != 1){
            SixLotteryOrder::DelSixOrder($id);                                                      //更改失败删除订单，退出方法
            return '更新用户金额失败';
        }
        if(!$money_log_id){
            SixLotteryOrder::DelSixOrder($id);                                                      //更改失败删除订单，退出方法
            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                  //用户金额还原
            $rs = new CommonFc();
            return '更新流水失败';
        }
        $r = SixLotteryOrder::addSixOrderOrderNumById($id,$datereg);                                    //更新插入订单的单号
        if($r != 1){
            SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
            MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
            return '更新订单号失败';
        }
        $groupid = $user['group_id'];
        $fsRow = UserGroup::getUserGroupByUserId($groupid);                                         //查找用户组信息
        $fs_money = 0;
        if($gid == 'NAP'){                                                                          //更新投注明细（下注类型等）
            $bet_rate = $bet_rate_one;
            $bet_info = $betInfo_one;
            if(isset($fsRow['lhc_bet']) && $fsRow['lhc_bet']){
                if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩反水最小金额
                    $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
                }
            }
            $oddsarr = explode(',',$bet_rate);
            $win_money= $bet_money_one*array_product($oddsarr);//-$bet_money_one;本金乘以赔率
            //$win_money = 0;
            if(!$bet_info || !$bet_rate || !$bet_money_one){
                return '下注失败了';
            }
            $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance,$gid,$this->module->params['boll']);//添加下注明细

            if(!$id_sub){
//                SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
                SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
                MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
                UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
                return '号码错误,生成订单失败';
            }

            $datereg_sub = date('YmdHis') . $id_sub;
            $r = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);                              //更新插入下注明显的子订单号
            if(!$id_sub || !$r){
                SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
                SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
                MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
                UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
                return '更新子单失败';
            }
            $this->_NapPaint($rtype_name,$bet_info,$bet_rate,$bet_money_total,$datereg_sub);
        }elseif($gid == 'NX'){
            $bet_rate = $bet_rate_one;
            $bet_info = $betInfo_one;
            $win_money = $bet_rate * $bet_money_one;
            if(isset($fsRow['lhc_bet']) && $fsRow['lhc_bet']){
                if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩投注最小金额
                    $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
                }
            }else{
                $fs_money = 0;
            }
            if(!$bet_info || !$bet_rate || !$bet_money_one){
                return '下注失败';
            }
            $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance,$gid,$this->module->params['boll']);

            if(!$id_sub ){
//                SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
                SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
                MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
                UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
                return '号码错误,生成订单失败';
            }

            $datereg_sub = date('YmdHis') . $id_sub;
            $r = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);                           //更新插入下注明显的子订单号
            if(!$id_sub || !$r){
                SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
                SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
                MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
                UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
                return '更新子单失败';
            }
            $this->_paint($rtype_name,$bet_info,$bet_rate,$bet_money_total,$datereg_sub);
        } else{
            foreach ($goldArray as $key => $value) {
                $fs_money = 0;
                $bet_money_one = $goldArray[$key];
                $bet_rate = $oddsArray[$key];
                if($goldArray[$key]){
                    $bet_info = $betInfoArray[$key];
                    $win_money =  $bet_rate *  $bet_money_one;
                    if ($goldArray[$key]) {
                        if(isset($fsRow['lhc_bet']) && $fsRow['lhc_bet']){
                            if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩投注最小金额
                                $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
                            }
                            if (($gid == 'SPbside') && (0 < intval($bet_info))) {
                                $fs_money = 0;
                            }
                        }
                        if (($gid == 'SP') && (0 < intval($bet_info))) {
                            $row_sp_fs = SixLotteryOdds::getSubTypeSPballtypeFS();
                            if ($row_sp_fs['h1'] <= $bet_money_one) {
                                $fs_money = $bet_money_one * $row_sp_fs['h2'];
                            } else {
                                $fs_money = 0;
                            }
                        }
                        if(!$bet_info || !$bet_rate || !$bet_money_one){
                            return '下注失败';
                        }
                        $arr = explode(',',$bet_info);
                        foreach ($arr as $a){
                            if(is_numeric($a) && ($a >49 || $a<0)){//验证球号是否有错误
                                return '球号错误';
                            }
                        }
                        $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance,$gid,$this->module->params['boll']);

                        if(!$id_sub){
//                            SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
                            SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
                            MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
                            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
                            return '号码错误,生成订单失败';
                        }

                        $datereg_sub = date('YmdHis') . $id_sub;
                        $r = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);
                        if(!$id_sub || !$r){
                            SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
                            SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
                            MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
                            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
                            return '更新子单失败';
                        }
                        $this->_paint($rtype_name,$bet_info,$bet_rate,$bet_money_one,$datereg_sub);
                    }
                }
            }
        }
        return '操作成功';
    }

    /**
     * 判断当前期数是否已经封盘
     * @param int $period
     * @return bool
     */
    private function _getState($period=0){
        $arr=SixLotterySchedule::lastOne();
        if($arr){
            if(strtotime($arr['fenpan_time'])<=time()){
                return false;
            }else{
                if(!isset($arr['qishu'])||($arr['qishu']!=$period)){
                    return false;
                }else{
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 下注的注单生成图片
     * @param $rtype_name
     * @param $bet_info
     * @param $bet_rate
     * @param $bet_money_total
     * @param $id_sub
     */
    public function _NapPaint($rtype_name,$bet_info,$bet_rate,$bet_money_total,$id_sub){

        $url = Yii::getAlias('@resource');
        $width = 7+$this->str_leng($rtype_name . '====' . $bet_info . '===' . $bet_rate . '===' . $bet_money_total . $id_sub . '===' . date('Y-m-d H:i:s')); //宽
        $height = 20; //高
        $im = imagecreate($width, $height);
        $bkg = imagecolorallocate($im, 255, 255, 255); //背景色
        $font = imagecolorallocate($im, 255, 255, 255); //边框色
        $sort_c = imagecolorallocate($im, 0, 0, 0); //字体色
        $name_c = imagecolorallocate($im, 243, 118, 5); //字体色
        $guest_c = imagecolorallocate($im, 34, 93, 156); //字体色
        $info_c = imagecolorallocate($im, 51, 102, 0); //字体色
        $money_c = imagecolorallocate($im, 255, 0, 0); //字体色
        $fnt =  Yii::$app->basePath.'/common/font/simhei.ttf';
        imagettftext($im, 10, 0, 7, 18, $sort_c, $fnt, $rtype_name);
        imagettftext($im, 10, 0, $this->str_leng($rtype_name . '=='), 18, $name_c, $fnt, $bet_info);
        imagettftext($im, 10, 0, $this->str_leng($rtype_name .  $bet_rate . '===')*1.5, 18, $guest_c, $fnt, $bet_rate);
        imagettftext($im, 10, 0, $this->str_leng($rtype_name .  $bet_info . $bet_rate.'===')*1.2, 18, $info_c, $fnt, $bet_money_total);
        imagettftext($im, 10, 0, $this->str_leng($rtype_name .  $bet_info . $bet_rate .$bet_money_total . '===')*1.5, 18, $money_c, $fnt, date('Y-m-d H:i:s'));
        imagerectangle($im, 0, 0, $width - 1, $height - 1, $font); //画边框
        if (!is_dir($url . "/order"))
            mkdir($url . "/order");
        if (!is_dir($url . "/order/" . substr($id_sub, 0, 8)))
            mkdir($url . "/order/" . substr($id_sub, 0, 8));
        $q4 = imagejpeg($im, $url . "/order/" . substr($id_sub, 0, 8) . "/$id_sub.jpg"); //生成图片

        imagedestroy($im);
    }

    /**
     * 下注的注单生成图片
     * @param $rtype_name
     * @param $bet_info
     * @param $bet_rate
     * @param $bet_money_total
     */
    public function _paint($rtype_name,$bet_info,$bet_rate,$bet_money_total,$id_sub){

        $url = Yii::getAlias('@resource');
        $width = 7+$this->str_leng($rtype_name . '====' . $bet_info . '===' . $bet_rate . '===' . $bet_money_total . $id_sub . '===' . date('Y-m-d H:i:s')); //宽
        $height = 20; //高
        $im = imagecreate($width, $height);
        $bkg = imagecolorallocate($im, 255, 255, 255); //背景色
        $font = imagecolorallocate($im, 255, 255, 255); //边框色
        $sort_c = imagecolorallocate($im, 0, 0, 0); //字体色
        $name_c = imagecolorallocate($im, 243, 118, 5); //字体色
        $guest_c = imagecolorallocate($im, 34, 93, 156); //字体色
        $info_c = imagecolorallocate($im, 51, 102, 0); //字体色
        $money_c = imagecolorallocate($im, 255, 0, 0); //字体色
        $fnt =  Yii::$app->basePath.'/common/font/simhei.ttf';
        @imagettftext($im, 10, 0, 7, 18, $sort_c, $fnt, $rtype_name);
        @imagettftext($im, 10, 0, $this->str_leng($rtype_name . '=='), 18, $name_c, $fnt, $bet_info);
        @imagettftext($im, 10, 0, $this->str_leng($rtype_name .  $bet_rate . '===')*1.5, 18, $guest_c, $fnt, $bet_rate);
        @imagettftext($im, 10, 0, $this->str_leng($rtype_name .  $bet_info . $bet_rate.'===')*2, 18, $info_c, $fnt, $bet_money_total);
        @imagettftext($im, 10, 0, $this->str_leng($rtype_name .  $bet_info . $bet_rate .$bet_money_total . '===')*2, 18, $money_c, $fnt, date('Y-m-d H:i:s'));
        @imagerectangle($im, 0, 0, $width - 1, $height - 1, $font); //画边框
        if (!is_dir($url . "/order"))
            mkdir($url . "/order");
        if (!is_dir($url . "/order/" . substr($id_sub, 0, 8)))
            mkdir($url . "/order/" . substr($id_sub, 0, 8));
        $q4 = imagejpeg($im, $url . "/order/" . substr($id_sub, 0, 8) . "/$id_sub.jpg"); //生成图片

        imagedestroy($im);
    }

    //取字符串长度并转换为utf8格式
    public function str_leng($str) {
        mb_internal_encoding("UTF-8");
        return mb_strlen($str) * 12;
    }

    /**
     * 测试下单修改为事务处理
     * @param $userid
     * @param $rtype_name
     * @param $rType
     * @param $lottery_number
     * @param $bet_money_total
     * @param $balance
     * @param $bet_win_total
     * @param $assets
     * @param $goldArray
     * @param $oddsArray
     * @param $betInfoArray
     * @param $gid
     * @param $bet_money_one
     * @param $betInfo_one
     * @param $bet_rate_one
     * @return string
     *
     */
    public function actionTest($userid, $rtype_name, $rType, $lottery_number, $bet_money_total, $balance, $bet_win_total,
                               $assets, $goldArray, $oddsArray, $betInfoArray, $gid, $bet_money_one, $betInfo_one, $bet_rate_one){

         $transaction = Yii::$app->db->beginTransaction();

        $bet_info_sp = "";
        $bet_money_total = abs($bet_money_total);
        if ($gid === 'SPbside') {
            $rType = 'SP';
            $bet_info_sp = 'SPbside';
        } else {
            $bet_info_sp = 'bet_info';
        }

        if(!$userid || !$rtype_name || !$rType || !$bet_info_sp || !$bet_money_total || !$lottery_number){
            return '下注失败';
        }
        $id = SixLotteryOrder::addSixOrder($userid, $rtype_name, $rType, $bet_info_sp, $bet_money_total, $bet_win_total, $lottery_number); //添加下注订单

        $datereg = date('YmdHis') . $id;
        $user = UserList::getUserNewsByUserId($userid);                                             //查找用户信息
        $assets = $user['money'];
        $balance = $assets - $bet_money_total; //用户资产-投注金额
        $money_log_id = MoneyLog::updateUserMoneyForSix($userid, $datereg, $bet_money_total, $assets, $balance); //添加金额日志
        $r = UserList::UpdateUserMoney($balance, $bet_money_total, $userid);                        //更改用户金额


        $r1 = SixLotteryOrder::addSixOrderOrderNumById($id,$datereg);                                    //更新插入订单的单号

        $groupid = $user['group_id'];
        $fsRow = UserGroup::getUserGroupByUserId($groupid);                                         //查找用户组信息
        $fs_money = 0;
        if($gid == 'NAP'){                                                                          //更新投注明细（下注类型等）
            $bet_rate = $bet_rate_one;
            $bet_info = $betInfo_one;
            if(isset($fsRow['lhc_bet']) && $fsRow['lhc_bet']){
                if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩反水最小金额
                    $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
                }
            }
            $win_money = 0;
            if(!$bet_info || !$bet_rate || !$bet_money_one){
                return '下注失败';
            }
            $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance,$gid);//添加下注明细
            $datereg_sub = date('YmdHis') . $id_sub;
            $r2 = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);                              //更新插入下注明显的子订单号

            $this->_NapPaint($rtype_name,$bet_info,$bet_rate,$bet_money_total,$datereg_sub);
        }elseif($gid == 'NX'){
            $bet_rate = $bet_rate_one;
            $bet_info = $betInfo_one;
            $win_money = $bet_rate * $bet_money_one;
            if(isset($fsRow['lhc_bet']) && $fsRow['lhc_bet']){
                if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩投注最小金额
                    $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
                }
            }else{
                $fs_money = 0;
            }
            if(!$bet_info || !$bet_rate || !$bet_money_one){
                return '下注失败';
            }
            $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance,$gid);
            $datereg_sub = date('YmdHis') . $id_sub;
            $r2 = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);                           //更新插入下注明显的子订单号

            $this->_paint($rtype_name,$bet_info,$bet_rate,$bet_money_total,$datereg_sub);
        } else{
            foreach ($goldArray as $key => $value) {
                $fs_money = 0;
                $bet_money_one = $goldArray[$key];
                $bet_rate = $oddsArray[$key];
                if($goldArray[$key]){
                    $bet_info = $betInfoArray[$key];
                    $win_money = $bet_rate * $bet_money_one;
                    if ($goldArray[$key]) {
                        if(isset($fsRow['lhc_bet']) && $fsRow['lhc_bet']){
                            if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩投注最小金额
                                $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
                            }
                            if (($gid == 'SPbside') && (0 < intval($bet_info))) {
                                $fs_money = 0;
                            }
                        }
                        if (($gid == 'SP') && (0 < intval($bet_info))) {
                            $row_sp_fs = SixLotteryOdds::getSubTypeSPballtypeFS();
                            if ($row_sp_fs['h1'] <= $bet_money_one) {
                                $fs_money = $bet_money_one * $row_sp_fs['h2'];
                            } else {
                                $fs_money = 0;
                            }
                        }
                        if(!$bet_info || !$bet_rate || !$bet_money_one){
                            return '下注失败';
                        }
                        $arr = explode(',',$bet_info);
                        foreach ($arr as $a){
                            if(is_numeric($a) && $a >49){//验证球号是否有错误
                                return '球号错误';
                            }
                        }
                        $id_subs=array();
                        $id_subs[$key] = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance,$gid);
                        $datereg_sub = date('YmdHis') . $id_subs[$key];
                        $rs[$key] = SixLotteryOrderSub::UpdateSixOrder($id_subs[$key], $datereg_sub);

                        $this->_paint($rtype_name,$bet_info,$bet_rate,$bet_money_one,$datereg_sub);
                    }
                }
            }
        }

        if($gid == 'NAP' || $gid == 'NX'){

            if ($id && $money_log_id && $r && $r1 && $fsRow && $id_sub &&$r2){
                $transaction->commit();
                return  '事务提交了';
            }else{
                $transaction->rollBack();
                return '事务回滚了';
            }
        }else{
            if ($id && $money_log_id && $r && $r1  && $fsRow && !in_array(' ',$id_subs) && !in_array('',$rs)){
                $transaction->commit();
                //$transaction->rollBack();
                return '事务提交了';
            }else{
                $transaction->rollBack();
                return '事务回滚了';
            }
        }


    }

//=================================================================================下注的部分类型的验证处理
    /**
     * 特码 下注验证处理
     * @param $gid 下注类型
     * @param $goldArray 号码数组
     * @param $oddsArray 赔率数组
     * @return bool|string
     */
    private  function  OrderValidSP($gid,$goldArray,$oddsArray){
        if ($gid == 'SP') {
            $odds_SP = SixLotteryOdds::getOddsByBallType('SP', 'a_side');
        } else if ($gid == 'SPbside') {
            $odds_SP = SixLotteryOdds::getOdds('SP');
        }
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        for ($i = 1; $i < 50; $i++) {
            $numString = ($i < 10 ? '0' . $i : $i);
            if (0 < $goldArray['SP' . $numString]) {
                if ($odds_SP['h' . $i] != $oddsArray['SP' . $numString]) {
                    return   false ;//'赔率异常，请退出重新登录。';
                    //break;
                }
            }
        }
        if (($oddsArray['SP_ODD'] != $odds_SP_other['h1'])
            || ($oddsArray['SP_EVEN'] != $odds_SP_other['h2'])
            || ($oddsArray['SP_OVER'] != $odds_SP_other['h3'])
            || ($oddsArray['SP_UNDER'] != $odds_SP_other['h4'])
            || ($oddsArray['SF_OVER'] != $odds_SP_other['h9'])
            || ($oddsArray['SP_SODD'] != $odds_SP_other['h5'])
            || ($oddsArray['SP_SEVEN'] != $odds_SP_other['h6'])
            || ($oddsArray['SP_SOVER'] != $odds_SP_other['h7'])
            || ($oddsArray['SP_SUNDER'] != $odds_SP_other['h8'])
            || ($oddsArray['SF_UNDER'] != $odds_SP_other['h10'])
            || ($oddsArray['HS_EO'] != $odds_SP_other['h16'])
            || ($oddsArray['HS_EU'] != $odds_SP_other['h17'])
            || ($oddsArray['HS_OO'] != $odds_SP_other['h14'])
            || ($oddsArray['HS_OU'] != $odds_SP_other['h15'])) {
            return  false ;//'赔率异常，请退出重新登录。';
        }
        return true;
    }
    /**正马特下注验证处理
     *  @param $gid 下注类型
     * @param $goldArray 号码数组
     * @param $oddsArray 赔率数组
     * @return bool|string
     */
    private function OrderValidNAS($gid,$goldArray,$oddsArray){
        $oddsN = SixLotteryOdds::getOdds($gid);
        for ($i = 1; $i < 50; $i++) {
            $numString = ($i < 10 ? '0' . $i : $i);
            if (0 < $goldArray[$gid . $numString]) {
                if ($oddsN['h' . $i] != $oddsArray[$gid . $numString]) {
                    return false;//'下注异常，请退出重新登录。';
                }
            }
        }
        return true;
    }
    /**
     * 正码下注验证处理
     * @param $gid
     * @param $goldArray
     * @param $oddsArray
     * @return bool
     */
    private function OrderValidNA($gid,$goldArray,$oddsArray){
        $odds_NA = SixLotteryOdds::getOdds('NA');
        $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
        for ($i = 1; $i < 50; $i++) {
            $numString = ($i < 10 ? '0' . $i : $i);
            if (0 < $goldArray[$gid . $numString]) {
                if ($odds_NA['h' . $i] != $oddsArray[$gid . $numString]) {
                    return false;//'用户异常，请退出重新登录。';
                }
            }
        }
        if (($oddsArray['NA_ODD'] != $odds_NA_other['h1']) || ($oddsArray['NA_EVEN'] != $odds_NA_other['h2']) || ($oddsArray['NA_OVER'] != $odds_NA_other['h3']) || ($oddsArray['NA_UNDER'] != $odds_NA_other['h4'])) {
            return false;//,'用户异常，请退出重新登录。');
        }
        return true;
    }
    /**
     * 正码1到6 下注验证处理
     * @param $gid
     * @param $goldArray
     * @param $oddsArray
     * @return bool
     */
    private function OrderValidNO($gid,$goldArray,$oddsArray){
        $odds1_other = SixLotteryOdds::getOddsByBallType('N1', 'other');
        $odds2_other = SixLotteryOdds::getOddsByBallType('N2', 'other');
        $odds3_other = SixLotteryOdds::getOddsByBallType('N3', 'other');
        $odds4_other = SixLotteryOdds::getOddsByBallType('N4', 'other');
        $odds5_other = SixLotteryOdds::getOddsByBallType('N5', 'other');
        $odds6_other = SixLotteryOdds::getOddsByBallType('N6', 'other');
        for ($i = 1; $i < 7; $i++) {
            if ($i == 1) {
                $odds_other = $odds1_other;
            } else if ($i == 2) {
                $odds_other = $odds2_other;
            } else if ($i == 3) {
                $odds_other = $odds3_other;
            } else if ($i == 4) {
                $odds_other = $odds4_other;
            } else if ($i == 5) {
                $odds_other = $odds5_other;
            } else if ($i == 6) {
                $odds_other = $odds6_other;
            }
            if (($oddsArray['NO' . $i . '_ODD'] != $odds_other['h1'])
                || ($oddsArray['NO' . $i . '_EVEN'] != $odds_other['h2'])
                || ($oddsArray['NO' . $i . '_OVER'] != $odds_other['h3'])
                || ($oddsArray['NO' . $i . '_UNDER'] != $odds_other['h4'])
                || ($oddsArray['NO' . $i . '_SODD'] != $odds_other['h5'])
                || ($oddsArray['NO' . $i . '_SEVEN'] != $odds_other['h6'])
                || ($oddsArray['NO' . $i . '_SOVER'] != $odds_other['h7'])
                || ($oddsArray['NO' . $i . '_SUNDER'] != $odds_other['h8'])
                || ($oddsArray['NO' . $i . '_FOVER'] != $odds_other['h9'])
                || ($oddsArray['NO' . $i . '_FUNDER'] != $odds_other['h10'])
                || ($oddsArray['NO' . $i . '_R'] != $odds_other['h11'])
                || ($oddsArray['NO' . $i . '_G'] != $odds_other['h12'])
                || ($oddsArray['NO' . $i . '_B'] != $odds_other['h13'])) {
                return false;//,'用户异常，请退出重新登录。';
            }
        }
        return true;
    }
    /**
     * 两面 下注验证处理
     * @param $gid 下注类型
     * @param $goldArray 号码数组
     * @param $oddsArray 赔率数组
     * @return bool|string
     */
    private function OrderValidOEOU($gid,$goldArray,$oddsArray){
        $odds1_other = SixLotteryOdds::getOddsByBallType('N1', 'other');
        $odds2_other = SixLotteryOdds::getOddsByBallType('N2', 'other');
        $odds3_other = SixLotteryOdds::getOddsByBallType('N3', 'other');
        $odds4_other = SixLotteryOdds::getOddsByBallType('N4', 'other');
        $odds5_other = SixLotteryOdds::getOddsByBallType('N5', 'other');
        $odds6_other = SixLotteryOdds::getOddsByBallType('N6', 'other');
        $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        for ($i = 1; $i < 7; $i++) {
            if ($i == 1) {
                $odds_other = $odds1_other;
            } else if ($i == 2) {
                $odds_other = $odds2_other;
            } else if ($i == 3) {
                $odds_other = $odds3_other;
            } else if ($i == 4) {
                $odds_other = $odds4_other;
            } else if ($i == 5) {
                $odds_other = $odds5_other;
            } else if ($i == 6) {
                $odds_other = $odds6_other;
            }
            if (($oddsArray['NO' . $i . '_ODD'] != $odds_other['h1']) || ($oddsArray['NO' . $i . '_EVEN'] != $odds_other['h2']) || ($oddsArray['NO' . $i . '_OVER'] != $odds_other['h3']) || ($oddsArray['NO' . $i . '_UNDER'] != $odds_other['h4']) || ($oddsArray['NO' . $i . '_SODD'] != $odds_other['h5']) || ($oddsArray['NO' . $i . '_SEVEN'] != $odds_other['h6']) || ($oddsArray['NO' . $i . '_SOVER'] != $odds_other['h7']) || ($oddsArray['NO' . $i . '_SUNDER'] != $odds_other['h8'])) {
                return false;//,'用户异常，请退出重新登录。');
            }
            if (($oddsArray['NA_ODD'] != $odds_NA_other['h1']) || ($oddsArray['NA_EVEN'] != $odds_NA_other['h2']) || ($oddsArray['NA_OVER'] != $odds_NA_other['h3']) || ($oddsArray['NA_UNDER'] != $odds_NA_other['h4'])) {
                return false;//,'用户异常，请退出重新登录。');
            }
            if (($oddsArray['SP_ODD'] != $odds_SP_other['h1']) || ($oddsArray['SP_EVEN'] != $odds_SP_other['h2']) || ($oddsArray['SP_OVER'] != $odds_SP_other['h3']) || ($oddsArray['SP_UNDER'] != $odds_SP_other['h4']) || ($oddsArray['SP_SODD'] != $odds_SP_other['h5']) || ($oddsArray['SP_SEVEN'] != $odds_SP_other['h6']) || ($oddsArray['SP_SOVER'] != $odds_SP_other['h7']) || ($oddsArray['SP_SUNDER'] != $odds_SP_other['h8'])) {
                return false;//,'用户异常，请退出重新登录。');
            }
        }
        return true;
    }
    /**
     * 特码生肖 色波 头尾数
     * 下注验证处理
     * @param $gid 下注类型
     * @param $goldArray 号码数组
     * @param $oddsArray 赔率数组
     * @return bool|string
     */
    private function OrderValidSPA($gid,$goldArray,$oddsArray){
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        $odds_SPA = SixLotteryOdds::getOdds('SPA');
        for ($i = 1; $i < 10; $i++) {
            if (0 < $goldArray['SP_A' . $i]) {
                if ($odds_SPA['h' . $i] != $oddsArray['SP_A' . $i]) {
                    return false;//,'用户异常，请退出重新登录。');
                }
            }
        }
        if (($oddsArray['SP_AA'] != $odds_SPA['h10'])
            || ($oddsArray['SP_AB'] != $odds_SPA['h11'])
            || ($oddsArray['SP_AC'] != $odds_SPA['h12'])
            || ($oddsArray['SH0'] != $odds_SPA['h13'])
            || ($oddsArray['SH1'] != $odds_SPA['h14'])
            || ($oddsArray['SH2'] != $odds_SPA['h15'])
            || ($oddsArray['SH3'] != $odds_SPA['h16'])
            || ($oddsArray['SH4'] != $odds_SPA['h17'])
            || ($oddsArray['SF0'] != $odds_SPA['h18'])
            || ($oddsArray['SF1'] != $odds_SPA['h19'])
            || ($oddsArray['SF2'] != $odds_SPA['h20'])
            || ($oddsArray['SF3'] != $odds_SPA['h21'])
            || ($oddsArray['SF4'] != $odds_SPA['h22'])
            || ($oddsArray['SF5'] != $odds_SPA['h23'])
            || ($oddsArray['SF6'] != $odds_SPA['h24'])
            || ($oddsArray['SF7'] != $odds_SPA['h25'])
            || ($oddsArray['SF8'] != $odds_SPA['h26'])
            || ($oddsArray['SF9'] != $odds_SPA['h27'])
            || ($oddsArray['SP_R'] != $odds_SP_other['h11'])
            || ($oddsArray['SP_G'] != $odds_SP_other['h12'])
            || ($oddsArray['SP_B'] != $odds_SP_other['h13'])) {
            return false;//,'用户异常，请退出重新登录。');
        }
        return true;
    }
    /**
     * 正肖 七色波
     * 下注验证处理
     * @param $gid 下注类型
     * @param $goldArray 号码数组
     * @param $oddsArray 赔率数组
     * @return bool|string
     */
    private function OrderValidC7($gid,$goldArray,$oddsArray){
        $odds_C7 = SixLotteryOdds::getOdds('C7');
        for ($i = 1; $i < 10; $i++) {
            if (0 < $goldArray['NA_A' . $i]) {
                if ($odds_C7['h' . $i] != $oddsArray['NA_A' . $i]) {
                    return false;//,'用户异常，请退出重新登录。');
                }
            }
        }
        if (($oddsArray['NA_AA'] != $odds_C7['h10']) || ($oddsArray['NA_AB'] != $odds_C7['h11']) || ($oddsArray['NA_AC'] != $odds_C7['h12']) || ($oddsArray['C7_R'] != $odds_C7['h13']) || ($oddsArray['C7_B'] != $odds_C7['h14']) || ($oddsArray['C7_G'] != $odds_C7['h15']) || ($oddsArray['C7_N'] != $odds_C7['h16'])) {
            return false;//,'用户异常，请退出重新登录。');
        }
        return true;
    }
    /**
     * 一肖 总肖 平特尾数 下注验证处理
     * @param $gid 下注类型
     * @param $goldArray 号码数组
     * @param $oddsArray 赔率数组
     * @return bool|string
     * @return bool
     */
    private function OrderValidSPB($gid,$goldArray,$oddsArray){
        $odds_SPB = SixLotteryOdds::getOdds('SPB');
        for ($i = 1; $i < 10; $i++) {
            if (0 < $goldArray['SP_B' . $i]) {
                if ($odds_SPB['h' . $i] != $oddsArray['SP_B' . $i]) {
                    return false;//,'用户异常，请退出重新登录。');
                }
            }
        }
        if (($oddsArray['SP_BA'] != $odds_SPB['h10']) || ($oddsArray['SP_BB'] != $odds_SPB['h11']) || ($oddsArray['SP_BC'] != $odds_SPB['h12']) || ($oddsArray['NF0'] != $odds_SPB['h13']) || ($oddsArray['NF1'] != $odds_SPB['h14']) || ($oddsArray['NF2'] != $odds_SPB['h15']) || ($oddsArray['NF3'] != $odds_SPB['h16']) || ($oddsArray['NF4'] != $odds_SPB['h17']) || ($oddsArray['NF5'] != $odds_SPB['h18']) || ($oddsArray['NF6'] != $odds_SPB['h19']) || ($oddsArray['NF7'] != $odds_SPB['h20']) || ($oddsArray['NF8'] != $odds_SPB['h21']) || ($oddsArray['NF9'] != $odds_SPB['h22']) || ($oddsArray['TX2'] != $odds_SPB['h23']) || ($oddsArray['TX5'] != $odds_SPB['h24']) || ($oddsArray['TX6'] != $odds_SPB['h25']) || ($oddsArray['TX7'] != $odds_SPB['h26']) || ($oddsArray['TX_ODD'] != $odds_SPB['h27']) || ($oddsArray['TX_EVEN'] != $odds_SPB['h28'])) {
            return false;//,'用户异常，请退出重新登录。');
        }
        return true;
    }

    /**
     * 半波   半半波 下注验证处理
     * @param $gid
     * @param $goldArray
     * @param $oddsArray
     * @return bool
     */
    private  function OrderValidHB($gid,$goldArray,$oddsArray){
        $odds_HB = SixLotteryOdds::getOdds('HB');
        if (($oddsArray['HB_RODD'] != $odds_HB['h1']) || ($oddsArray['HB_REVEN'] != $odds_HB['h2']) || ($oddsArray['HB_ROVER'] != $odds_HB['h3']) || ($oddsArray['HB_RUNDER'] != $odds_HB['h4']) || ($oddsArray['HB_GODD'] != $odds_HB['h5']) || ($oddsArray['HB_GEVEN'] != $odds_HB['h6']) || ($oddsArray['HB_GOVER'] != $odds_HB['h7']) || ($oddsArray['HB_GUNDER'] != $odds_HB['h8']) || ($oddsArray['HB_BODD'] != $odds_HB['h9']) || ($oddsArray['HB_BEVEN'] != $odds_HB['h10']) || ($oddsArray['HB_BOVER'] != $odds_HB['h11']) || ($oddsArray['HB_BUNDER'] != $odds_HB['h12']) || ($oddsArray['HH_ROO'] != $odds_HB['h13']) || ($oddsArray['HH_ROE'] != $odds_HB['h14']) || ($oddsArray['HH_RUO'] != $odds_HB['h15']) || ($oddsArray['HH_RUE'] != $odds_HB['h16']) || ($oddsArray['HH_GOO'] != $odds_HB['h17']) || ($oddsArray['HH_GOE'] != $odds_HB['h18']) || ($oddsArray['HH_GUO'] != $odds_HB['h19']) || ($oddsArray['HH_GUE'] != $odds_HB['h20']) || ($oddsArray['HH_BOO'] != $odds_HB['h21']) || ($oddsArray['HH_BOE'] != $odds_HB['h22']) || ($oddsArray['HH_BUO'] != $odds_HB['h23']) || ($oddsArray['HH_BUE'] != $odds_HB['h24'])) {
            return false;//,'用户异常，请退出重新登录。');
        }
        return true;
    }
    //========================================================================下面是下注的部分数据处理

    /**
     * 正码过关下注数据处理
     * @param $goldArray
     * @return mixed
     */
    private function OrderNAP($postNews,$goldArray){
        for ($i=1;$i<=6;$i++){
            $odds_NAP[$i] = SixLotteryOdds::getOdds('NAP'.$i);
        }
        for ($i =1;$i<=6;$i++){
            if (empty($postNews['game'.$i])) { $postNews['game'.$i] = '';}
            if (empty($postNews['radio'.$i])) { $postNews['radio'.$i] = null;}
            if (empty($postNews['oddindex'.$i])) { $postNews['oddindex'.$i] = 20;}
            $game[$i] = $postNews['game'.$i];
            $radio[$i] = $postNews['radio'.$i];
            $oddindex[$i] = $postNews['oddindex'.$i];
        }
        $bet_info_nap = '';
        $bet_rate_nap = '';
        for ($i=1 ;$i<=6;$i++){
            if ($game[$i] != '') {
                if ($radio[$i] != $odds_NAP[$i]['h' . $oddindex[$i]]) {
                    $this->out(false,'用户异常，请退出重新登录。');
                    exit;
                }
                $bet_info_nap .= $game[$i] . ',';
                $bet_rate_nap .= $radio[$i] . ',';
            }
        }
        $bet_info_nap = substr($bet_info_nap, 0, -1);
        $bet_rate_nap = substr($bet_rate_nap, 0, -1);
        $data['bet_win_total'] = 0;
        $data['bet_money_one'] = $goldArray;
        $data['betInfo_one'] = $bet_info_nap;
        $data['bet_rate_one'] = $bet_rate_nap;
        $data['bet_money_total'] = $data['bet_money_one'];
        return $data;
    }

    /**
     * 连码 下注数据处理
     * @param $postNews
     * @param $bet_money_total
     * @param $bet_win_total
     * @return mixed
     */
    private function OrderCH($postNews,$bet_money_total,$bet_win_total){
        $odds_CH = SixLotteryOdds::getOdds('CH');
        if(empty($postNews['ch_name'])){ $postNews['ch_name'] = '';}
        $totalArray = $postNews['totalArray'];
        $bet_money_one = $postNews['gold'];
        $ch_name =$postNews['ch_name'];
        $rTypeName = $ch_name;
        $goldArray = array();
        $oddsArray = array();
        $betInfoArray = array();
        $minCount = count(explode(', ', $totalArray[0]));
        $rTypeNameDetail =$rTypeName;
        if ($ch_name == '四全中') {
            $oddsValue = $odds_CH['h1'];
            if ($minCount != 4) { $validateOdd = 'false';}
        } else if ($ch_name == '三全中') {
            $oddsValue = $odds_CH['h2'];
            if ($minCount != 3) { $validateOdd = 'false';}
        } else if ($ch_name == '三中二') {
            $oddsValue = $odds_CH['h4'].'<br/>'.$odds_CH['h3'];
            $rTypeNameDetail=$ch_name.'<br/>'.'三中三';
            $Detail_oddsValue = $odds_CH['h4'];
            if ($minCount != 3) { $validateOdd = 'false';}
        } else if ($ch_name == '二全中') {
            $oddsValue = $odds_CH['h5'];
            if ($minCount != 2) { $validateOdd = 'false';}
        } else if ($ch_name == '二中特') {
            $oddsValue = $odds_CH['h6'].'<br/>'.$odds_CH['h7'];
            $rTypeNameDetail=$ch_name.'<br/>'.'二中二';
            $Detail_oddsValue = $odds_CH['h6'];
            if ($minCount != 2) { $validateOdd = 'false';}
        } else if ($ch_name == '特串') {
            $oddsValue = $odds_CH['h8'];
            if ($minCount != 2) { $validateOdd = 'false';}
        }
        if($totalArray){
            foreach ($totalArray as $key => $value) {
                $goldArray[] = $bet_money_one;
                $betInfoArray[] = $value;
                $oddsArray[] = $oddsValue;
                $bet_money_total = $bet_money_total + $bet_money_one;
                if($rTypeNameDetail <> $rTypeName){
                    $bet_win_total = $bet_win_total + ($bet_money_one * $Detail_oddsValue);
                }else{
                    $bet_win_total = $bet_win_total + ($bet_money_one * $oddsValue);
                }
//                $bet_win_total = $bet_win_total + ($bet_money_one * $oddsValue); //20190729 因應php7以上修改
            }
        }
        $data['goldArray'] = $goldArray;
        $data['betInfoArray'] = $betInfoArray;
        $data['oddsArray'] = $oddsArray;
        $data['bet_money_total'] = $bet_money_total;
        $data['bet_win_total'] = $bet_win_total;
        $data['bet_money_one'] =$bet_money_one;
        $data['rTypeName'] = $rTypeName;
        $data['rTypeNameDetail'] =$rTypeNameDetail;
        return $data;
    }

    /**
     * 自选不中 下注数据处理
     * @param $postNews
     * @param $bet_money_total
     * @param $bet_win_total
     * @return mixed
     */
    private function OrderNI($postNews,$bet_money_total,$bet_win_total){
        $odds_NI = SixLotteryOdds::getOdds('NI');
        if(empty($postNews['ni_name'])){ $postNews['ni_name'] = '';}
        $totalArray = $postNews['totalArray'];
        $bet_money_one = $postNews['gold'];
        $ni_name = $postNews['ni_name'];
        $rTypeName = $ni_name;
        $goldArray = array();
        $oddsArray = array();
        $betInfoArray = array();
        $minCount = count(explode(', ', $totalArray[0]));
        $num = [5=>'h1',6=>'h2',7=>'h3',8=>'h4',9=>'h5',10=>'h6',11=>'h7',12=>'h8'];
        $oddsValue = $odds_NI[$num[$minCount]];
        foreach ($totalArray as $key => $value) {
            $goldArray[] = $bet_money_one;

            $betInfoArray[] = $value;
            $oddsArray[] = $oddsValue;
            $bet_money_total = $bet_money_total + $bet_money_one;
            $bet_win_total = $bet_win_total + ($bet_money_one * $oddsValue);
        }
        $data['rTypeName'] =$rTypeName;
        $data['goldArray'] =$goldArray;
        $data['betInfoArray'] =$betInfoArray;
        $data['oddsArray'] = $oddsArray;
        $data['bet_money_total'] =$bet_money_total;
        $data['bet_win_total'] =$bet_win_total;
        return $data;
    }

    /**
     * 连肖，连尾下注数据处理
     * @param $postNews
     * @param $bet_money_total
     * @param $bet_win_total
     */
    private function OrderLX($postNews,$bet_money_total,$bet_win_total){
        $gid = trim($postNews['gid']);
        for ($i=2;$i<=5;$i++){
            $odds_LX[$i] = SixLotteryOdds::getOdds('LX'.$i);
            $odds_LF[$i] = SixLotteryOdds::getOdds('LF'.$i);
        }
        if(empty($postNews['oddsIndexArray'])){ $postNews['oddsIndexArray'] = 0;}
        if(empty($postNews['lx_name'])){ $postNews['lx_name'] = 0;}
        $totalArray = $postNews['totalArray'];

        $oddsIndexArray = $postNews['oddsIndexArray'];
        $bet_money_one = $postNews['gold'];
        $lx_name = $postNews['lx_name'];
        $rTypeName = $lx_name;
        $goldArray = array();
        $oddsArray = array();
        $betInfoArray = array();
        $minCount = count(explode(',', trim($totalArray[0],',')));
        if ($gid == 'LX') {
            $odds_select = $odds_LX[$minCount];
        } else if ($gid == 'LF') {
            $odds_select = $odds_LF[$minCount];
        }
        $flag='';//用来标记肖数量
        foreach ($totalArray as $key => $value) {
            if(empty($flag)){
                $flag=count(explode(',', trim($value,',')));
            }
            $count_l = count(explode(',', trim($value,','))) ;
            if($count_l<2||$count_l>5 ||$count_l!=$flag){//如果肖数不在范围之内或者几组肖数不相同
                return false;
            }
            $goldArray[] = $bet_money_one;
            $betInfoArray[] = $value;

            $oddsArray[] = $odds_select['h' . $oddsIndexArray[$key]];
            $bet_money_total = $bet_money_total + $bet_money_one;
            $bet_win_total = $bet_win_total + ($bet_money_one * $odds_select['h' . $oddsIndexArray[$key]]);
        }
        $data['rTypeName']=$rTypeName;
        $data['goldArray'] =$goldArray;
        $data['betInfoArray'] =$betInfoArray;
        $data['oddsArray'] =$oddsArray;
        $data['bet_money_total']=$bet_money_total;
        $data['bet_win_total'] =$bet_win_total;
        return $data;
    }

    /**
     * 除了 正码过关 连码 自选不中 连肖 连尾 合肖 之外的其他下注类型数据处理
     * @return mixed
     */
    private function OrderOther($goldArray,$bet_money_total,$bet_win_total,$userid,$oddsArray,$gid,$qishu){
        $row=UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney=$row['lhc_lower_bet'];
        $balance = 0; //平衡  用来计算投注
        $assets = 0; //资产
        foreach ($goldArray as $key => $value) {
            if (floatval($goldArray[$key]) < 0 ) {
                return [
                         'status'=>false,
                         'data'=>'输入金额为负数或者不大于0，请重新下注。'
                        ];
            }
            if(floatval($goldArray[$key])>0){
                if(floatval($goldArray[$key])<$lowestMoney ){
                    return [
                             'status'=>false,
                             'data'=>'单笔投注金额不能低于最低限额!'
                            ];
                }
            }
            if ($goldArray[$key]) {
                $bet_money_total = $bet_money_total + $goldArray[$key];
                $bet_win_total = $bet_win_total + ($goldArray[$key] * $oddsArray[$key]);
                $betInfoArray[$key] = (new  CommonFc())->getBetInfo($key, $gid);
            }
        }
        $rs_user = UserList::getUserNewsByUserId($userid);
        if (floatval($rs_user['money']) > 0) {
            $assets = round($rs_user['money'], 2);
            $balance = $assets - $bet_money_total;
        }
        $max_money = UserList::getMaxMoney($userid);
        $money_already = SixLotteryOrder::getMaxMoneyAlready_lhc($userid, $qishu);
        if(!$money_already){
            $max_money_already=0;
        }else{
            $max_money_already = $money_already;
        }
        if ((0 < $max_money) && ($max_money < ($max_money_already[0]['total_money'] + $bet_money_total))) {
            return [
                    'status'=>false,
                    'data'=>'超过当期下注最大金额，请联系管理人员。'
                    ];
        }
        $data['assets'] =$assets;
        $data['balance'] =$balance;
        $data['bet_money_total']=$bet_money_total;
        $data['bet_win_total']=$bet_win_total;
        $data['betInfoArray']=$betInfoArray;
        return [
                 'status'=>true,
                 'data'=>$data
                 ];
    }



    //==========================================================================下面是盘式显示的数据处理
    /**
     * 特别号A面
     */
    private function ShowSP($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_SP = SixLotteryOdds::getOddsByBallType('SP', 'a_side');
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        $res = array('BetLineD' => 'N', 'sTime' => $fengpanTime,'other_close' => '0', 'gID' => 'SP','Line_M' => '4',
            'wtype' => 'SP',
            'SP_ODD' => $odds_SP_other['h1'],
            'SP_EVEN' => $odds_SP_other['h2'],
            'SP_OVER' => $odds_SP_other['h3'],
            'SP_UNDER' => $odds_SP_other['h4'],
            'SP_SODD' => $odds_SP_other['h5'],
            'SP_SEVEN' => $odds_SP_other['h6'],
            'SP_SOVER' => $odds_SP_other['h7'],
            'SP_SUNDER' => $odds_SP_other['h8'],
            'HS_OO' => $odds_SP_other['h14'],
            'HS_OU' => $odds_SP_other['h15'],
            'HS_EO' => $odds_SP_other['h16'],
            'HS_EU' => $odds_SP_other['h17'],
            'SF_OVER' => $odds_SP_other['h9'],
            'SF_UNDER' => $odds_SP_other['h10'],
            'SP_R' => $odds_SP_other['h11'],
            'SP_G' => $odds_SP_other['h12'],
            'SP_B' => $odds_SP_other['h13'],
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult,
            'kaijiangTime'=>$kaijiangTime
        );
        for ($i=1;$i<=49;$i++){
            $num = $i<10?'SP0'.$i:'SP'.$i;
            $res[$num]=$odds_SP['h'.$i];
        }
        return $res;
    }

    /**
     * 特别号B面
     */
    private function ShowSPbside($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_SP = SixLotteryOdds::getOdds('SP');
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        $res = array('BetLineD' => 'N', 'sTime' => $fengpanTime, 'other_close' => '0', 'gID' => 'SPbside', 'Line_M' => '4',
            'wtype' => 'SP',
            'SP_ODD' => $odds_SP_other['h1'],  'SP_EVEN' => $odds_SP_other['h2'], 'SP_OVER' => $odds_SP_other['h3'], 'SP_UNDER' => $odds_SP_other['h4'],
            'SP_SODD' => $odds_SP_other['h5'],  'SP_SEVEN' => $odds_SP_other['h6'],  'SP_SOVER' => $odds_SP_other['h7'],  'SP_SUNDER' => $odds_SP_other['h8'],
            'HS_OO' => $odds_SP_other['h14'],  'HS_OU' => $odds_SP_other['h15'], 'HS_EO' => $odds_SP_other['h16'], 'HS_EU' => $odds_SP_other['h17'],
            'SF_OVER' => $odds_SP_other['h9'],  'SF_UNDER' => $odds_SP_other['h10'], 'SP_R' => $odds_SP_other['h11'],  'SP_G' => $odds_SP_other['h12'],
            'SP_B' => $odds_SP_other['h13'],
            'result' => '[]',  'resultAN' => null, 'lenb' => 0,  'stopTime' => 4, 'stopTime2' => '4',   'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($i=1;$i<=49;$i++){
            $num = $i<10?'SP0'.$i:'SP'.$i;
            $res[$num]=$odds_SP['h'.$i];
        }
        return $res;
    }

    /**
     * 两面
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowOEOU($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        for ($i=1;$i<=6;$i++){
            $odds_other[$i] = SixLotteryOdds::getOddsByBallType('N'.$i, 'other');
        }
        $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        $res = array(
            'BetLineD' => 'N',
            'sTime' => $fengpanTime,
            'other_close' => 0,
            'gID' => 'OEOU',
            'SP_ODD' => $odds_SP_other['h1'],
            'SP_EVEN' => $odds_SP_other['h2'],
            'SP_OVER' => $odds_SP_other['h3'],
            'SP_UNDER' => $odds_SP_other['h4'],
            'SP_SODD' => $odds_SP_other['h5'],
            'SP_SEVEN' => $odds_SP_other['h6'],
            'SP_SOVER' => $odds_SP_other['h7'],
            'SP_SUNDER' => $odds_SP_other['h8'],
            'HS_OO' => 0.02,
            'HS_OU' => 0.02,
            'wtype' => 'NA',
            'somebady0' => 0,
            'somebady1' => 0,
            'somebady2' => 0,
            'somebady3' => 0,
            'NA_ODD' => $odds_NA_other['h1'],
            'NA_EVEN' => $odds_NA_other['h2'],
            'NA_OVER' => $odds_NA_other['h3'],
            'NA_UNDER' => $odds_NA_other['h4'],
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($i=1;$i<=6;$i++){
            $res['NO'.$i.'_ODD'] = $odds_other[$i]['h1'];
            $res['NO'.$i.'_EVEN']= $odds_other[$i]['h2'];
            $res['NO'.$i.'_OVER']=$odds_other[$i]['h3'];
            $res['NO'.$i.'_UNDER']=$odds_other[$i]['h4'];
            $res['NO'.$i.'_SODD']=$odds_other[$i]['h5'];
            $res['NO'.$i.'_SEVEN']=$odds_other[$i]['h6'];
            $res['NO'.$i.'_SOVER']=$odds_other[$i]['h7'];
            $res['NO'.$i.'_SUNDER']=$odds_other[$i]['h8'];
        }
        return $res;
    }

    /**
     * 正码
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowNA($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_NA =  SixLotteryOdds::getOdds('NA');
        $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
        $res = array(
            'BetLineD' => 'N',
            'sTime' => $fengpanTime,
            'other_close' => 0,
            'gID' => 'NA',
            'wtype' => 'NA',
            'NA_ODD' => $odds_NA_other['h1'],
            'NA_EVEN' => $odds_NA_other['h2'],
            'NA_OVER' => $odds_NA_other['h3'],
            'NA_UNDER' => $odds_NA_other['h4'],
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($i=1;$i<=49;$i++){
            $key = $i<10?'NA0'.$i:'NA'.$i;
            $res[$key]=$odds_NA['h'.$i];
        }
        return $res;
    }

    /**
     * 正马特
     */
    private function ShowNAS($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $oddsN = SixLotteryOdds::getOdds($rTypeN);
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "gID" => " $rTypeN ",
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($i=1;$i<=49;$i++){
            $key= $i<10?$rTypeN.'0'.$i:$rTypeN.$i;
            $res[$key]= $oddsN['h'.$i];
        }
        return $res;
    }

    /**
     * 正码1-6
     * @param $rTypeN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowNO($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        for ($i=1;$i<=6;$i++){
            $odds_other[$i] = SixLotteryOdds::getOddsByBallType('N'.$i, 'other');
        }
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "NO",
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($i=1;$i<=6;$i++){
            $res['NO'.$i.'_ODD']=$odds_other[$i]['h1'];
            $res['NO'.$i.'_EVEN']=$odds_other[$i]['h2'];
            $res['NO'.$i.'_OVER']=$odds_other[$i]['h3'];
            $res['NO'.$i.'_UNDER']=$odds_other[$i]['h4'];
            $res['NO'.$i.'_SODD']=$odds_other[$i]['h5'];
            $res['NO'.$i.'_SEVEN']=$odds_other[$i]['h6'];
            $res['NO'.$i.'_SOVER']=$odds_other[$i]['h7'];
            $res['NO'.$i.'_SUNDER']=$odds_other[$i]['h8'];
            $res['NO'.$i.'_FOVER']=$odds_other[$i]['h9'];
            $res['NO'.$i.'_FUNDER']=$odds_other[$i]['h10'];
            $res['NO'.$i.'_R']=$odds_other[$i]['h11'];
            $res['NO'.$i.'_G']=$odds_other[$i]['h12'];
            $res['NO'.$i.'_B']=$odds_other[$i]['h13'];
        }
        return $res;
    }

    /**
     * 正码过关
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowNAP($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        for ($i=1;$i<=6;$i++){
            $odds_NAP[$i] = SixLotteryOdds::getOdds("NAP".$i);
        }
        $res=array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPA",
            "show_table_n" => $showTableN,
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($j=1;$j<=6;$j++){
            for ($i=1;$i<=13;$i++){
                $res['NAP'.$j.'_h'.$i]=$odds_NAP[$j]['h'.$i];
            }
        }

        return $res;

    }

    /**
     * 连码
     */
    private function ShowCH($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_CH = SixLotteryOdds::getOdds('CH');
        $class=new Zodiac();
        $zodiacArray = $class->getArr();
        $res=array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPA",
            "show_table_n" => $showTableN,
            'chodds_1'=>$odds_CH['h1'],
            'chodds_2'=>$odds_CH['h2'],
            'chodds_3'=>$odds_CH['h3'],
            'chodds_4'=>$odds_CH['h4'],
            'chodds_5'=>$odds_CH['h5'],
            'chodds_6'=>$odds_CH['h6'],
            'chodds_7'=>$odds_CH['h7'],
            'chodds_8'=>$odds_CH['h8'],
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult

        );
        return $res;
    }

    /**
     * 连肖 连尾
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowLX($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $zodiacArray = array('09, 21, 33, 45', '10, 22, 34, 46', '11, 23, 35, 47', '12, 24, 36, 48', '01, 13, 25, 37, 49',
            '02, 14, 26, 38', '03, 15, 27, 39', '04, 16, 28, 40', '05, 17, 29, 41', '06, 18, 30, 42', '07, 19, 31, 43', '08, 20, 32, 44');
        for ($i=2;$i<=5;$i++){
            $odds_LX[$i] = SixLotteryOdds::getOdds("LX".$i);
            $odds_LF[$i] = SixLotteryOdds::getOdds("LF".$i);
        }
        $class=new Zodiac();
        $zodiacArray = $class->getArr();
        $res=array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPA",
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'zodiacArray'=>$zodiacArray,
            'CloseTime' => (
                array(
                    '1' => $differTime,
                    '2' => $differTime,
                    '3' => ($differTime - 180)
                )
            ),
            'gNum' => $row['qishu'],
            'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($j=2;$j<=5;$j++){
            for ($i=0;$i<10;$i++){//连尾
                    $res["LF".$j.$i]=$odds_LF[$j]['h'.($i+1)];
            }
            for ($i=1;$i<=12;$i++){//连肖
                if($i<10){
                    $res['LX'.$j.'_'.$i]=$odds_LX[$j]['h'.$i];
                }else{
                    $num=[10=>'A',11=>'B',12=>'C'];
                    $res['LX'.$j.'_'.$num[$i]]=$odds_LX[$j]['h'.$i];
                }

            }
        }
        return $res;
    }

    /**
     * 自选不中
     */
    private function ShowNI($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_NI = SixLotteryOdds::getOdds("NI");
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPA",
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        for ($i=1;$i<=8;$i++){
            $res["NI".$i]=$odds_NI['h'.$i];
        }
        return $res;
    }

    /**
     * 合肖
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowNX($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_NX = SixLotteryOdds::getOdds("NX");
        $class=new Zodiac();
        $zodiacArray = $class->getArr();
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPA",
            'result' => '[]',
            'resultAN' => null,
            'lenb' => 0,
            'stopTime' => 4,
            'stopTime2' => '4',
            'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult,
            'zodiacArray'=>$zodiacArray
        );
        for ($i=1;$i<=11;$i++){
            $res["odds_NX".$i]=$odds_NX['h'.$i];
        }
        return $res;
    }

    /**
     *  特码生肖 色波 头尾数
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowSPA($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
        $odds_SPA = SixLotteryOdds::getOdds('SPA');
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPA",
            "show_table_n" => $showTableN,
            "SP_A1" => $odds_SPA['h1'],
            "SP_A2" => $odds_SPA['h2'],
            "SP_A3" => $odds_SPA['h3'],
            "SP_A4" => $odds_SPA['h4'],
            "SP_A5" => $odds_SPA['h5'],
            "SP_A6" => $odds_SPA['h6'],
            "SP_A7" => $odds_SPA['h7'],
            "SP_A8" => $odds_SPA['h8'],
            "SP_A9" => $odds_SPA['h9'],
            "SP_AA" => $odds_SPA['h10'],
            "SP_AB" => $odds_SPA['h11'],
            "SP_AC" => $odds_SPA['h12'],
            "SH0" => $odds_SPA['h13'],
            "SH1" => $odds_SPA['h14'],
            "SH2" => $odds_SPA['h15'],
            "SH3" => $odds_SPA['h16'],
            "SH4" => $odds_SPA['h17'],
            "SF0" => $odds_SPA['h18'],
            "SF1" => $odds_SPA['h19'],
            "SF2" => $odds_SPA['h20'],
            "SF3" => $odds_SPA['h21'],
            "SF4" => $odds_SPA['h22'],
            "SF5" => $odds_SPA['h23'],
            "SF6" => $odds_SPA['h24'],
            "SF7" => $odds_SPA['h25'],
            "SF8" => $odds_SPA['h26'],
            "SF9" => $odds_SPA['h27'],
            "SP_R" => $odds_SP_other['h11'],
            "SP_G" => $odds_SP_other['h12'],
            "SP_B" => $odds_SP_other['h13'],
            'result' => '[]', 'resultAN' => null,  'lenb' => 0, 'stopTime' => 4, 'stopTime2' => '4',  'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
            'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        return $res;
    }

    /**
     * 一肖 总肖 平特尾数
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     */
    private function ShowSPB($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_SPB = SixLotteryOdds::getOdds('SPB');
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => "0",
            "gID" => "SPB",
            "show_table_n" => "$showTableN",
            "SP_B1" => $odds_SPB['h1'],
            "SP_B2" => $odds_SPB['h2'],
            "SP_B3" => $odds_SPB['h3'],
            "SP_B4" => $odds_SPB['h4'],
            "SP_B5" => $odds_SPB['h5'],
            "SP_B6" => $odds_SPB['h6'],
            "SP_B7" => $odds_SPB['h7'],
            "SP_B8" => $odds_SPB['h8'],
            "SP_B9" => $odds_SPB['h9'],
            "SP_BA" => $odds_SPB['h10'],
            "SP_BB" => $odds_SPB['h11'],
            "SP_BC" => $odds_SPB['h12'],
            "NF0" => $odds_SPB['h13'],
            "NF1" => $odds_SPB['h14'],
            "NF2" => $odds_SPB['h15'],
            "NF3" => $odds_SPB['h16'],
            "NF4" => $odds_SPB['h17'],
            "NF5" => $odds_SPB['h18'],
            "NF6" => $odds_SPB['h19'],
            "NF7" => $odds_SPB['h20'],
            "NF8" => $odds_SPB['h21'],
            "NF9" => $odds_SPB['h22'],
            "TX2" => $odds_SPB['h23'],
            "TX5" => $odds_SPB['h24'],
            "TX6" => $odds_SPB['h25'],
            "TX7" => $odds_SPB['h26'],
            "TX_ODD" => $odds_SPB['h27'],
            "TX_EVEN" => $odds_SPB['h28'],
            'result' => '[]', 'resultAN' => null,  'lenb' => 0, 'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
            'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        return $res;
    }

    /**
     * 半波  半半波
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowHB($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_HB = SixLotteryOdds::getOdds('HB');
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "other_close" => 0,
            "gID" => "HB",
            "show_table_n" => "$showTableN",
            "HB_RODD" => $odds_HB['h1'],
            "HB_REVEN" => $odds_HB['h2'],
            "HB_ROVER" => $odds_HB['h3'],
            "HB_RUNDER" => $odds_HB['h4'],
            "HB_GODD" => $odds_HB['h5'],
            "HB_GEVEN" => $odds_HB['h6'],
            "HB_GOVER" => $odds_HB['h7'],
            "HB_GUNDER" => $odds_HB['h8'],
            "HB_BODD" => $odds_HB['h9'],
            "HB_BEVEN" => $odds_HB['h10'],
            "HB_BOVER" => $odds_HB['h11'],
            "HB_BUNDER" => $odds_HB['h12'],
            "HH_ROO" => $odds_HB['h13'],
            "HH_ROE" => $odds_HB['h14'],
            "HH_RUO" => $odds_HB['h15'],
            "HH_RUE" => $odds_HB['h16'],
            "HH_GOO" => $odds_HB['h17'],
            "HH_GOE" => $odds_HB['h18'],
            "HH_GUO" => $odds_HB['h19'],
            "HH_GUE" => $odds_HB['h20'],
            "HH_BOO" => $odds_HB['h21'],
            "HH_BOE" => $odds_HB['h22'],
            "HH_BUO" => $odds_HB['h23'],
            "HH_BUE" => $odds_HB['h24'],
            'result' => '[]',  'resultAN' => null, 'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
            'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        return $res;
    }

    /**
     * 正肖 七色波
     * @param $rTypeN
     * @param $showTableN
     * @param $fengpanTime
     * @param $row
     * @param $differTime
     * @param $announcement
     * @param $kjresult
     * @return array
     */
    private function ShowC7($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $odds_C7 = SixLotteryOdds::getOdds('C7');
        $res = array(
            "BetLineD" => "N",
            "sTime" => $fengpanTime,
            "gID" => "C7",
            "show_table_n" => "$showTableN",
            "NA_A1" => $odds_C7['h1'],
            "NA_A2" => $odds_C7['h2'],
            "NA_A3" => $odds_C7['h3'],
            "NA_A4" => $odds_C7['h4'],
            "NA_A5" => $odds_C7['h5'],
            "NA_A6" => $odds_C7['h6'],
            "NA_A7" => $odds_C7['h7'],
            "NA_A8" => $odds_C7['h8'],
            "NA_A9" => $odds_C7['h9'],
            "NA_AA" => $odds_C7['h10'],
            "NA_AB" => $odds_C7['h11'],
            "NA_AC" => $odds_C7['h12'],
            "C7_R" => $odds_C7['h13'],
            "C7_B" => $odds_C7['h14'],
            "C7_G" => $odds_C7['h15'],
            "C7_N" => $odds_C7['h16'],
            'result' => '[]', 'resultAN' => null, 'lenb' => 0, 'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
            'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        return $res;
    }

    /**
     * 其他的 所有分类没有的时候 默认数据
     */
    private function ShowOther($rtype,$rTypeN,$showTableN,$fengpanTime,$row,$differTime,$announcement,$kjresult,$kaijiangTime){
        $res = array(
            'BetLineD' => 'N','gID' => $rtype, 'result' => '[]',  'resultAN' => null,  'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4',  'stopTime3' => '1',
            'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
            'gNum' => $row['qishu'],  'gTime' => $row['fenpan_time'],
            'Msg' => $announcement,
            'kjresult'=>$kjresult
        );
        return $res;
    }

    /**
     * 数据校验
     * @param unknown $data
     * @return number
     */
    function data_valid($data, $gid) {
        $data_valid = new DataValid();
        if($gid == 'NAP'){
            $flag = $data_valid->data_nap_valid ( $data , $gid);
        }else{
            $flag = $data_valid->data_count_valid ( $data , $gid);
        }
        if (! $flag) {
            return $this->out(false,'不符合可选择数量!');
        }
    }
}