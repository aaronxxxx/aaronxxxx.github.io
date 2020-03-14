<?php
namespace app\modules\lottery\modules\lzgd11\controllers;

use app\modules\lottery\helpers\DataValid;
use app\modules\lottery\helpers\LiangMian;
use Yii;
use yii\web\Controller;
use app\modules\lottery\models\ar\OddsLottery;
use app\modules\lottery\models\ar\LotterySchedule;
use app\modules\lottery\models\ar\UserGroup;
use app\modules\lottery\models\ar\UserList;
use app\modules\lottery\models\ar\OrderLottery;
use app\modules\lottery\models\ar\OrderLotterySub;
use app\modules\lottery\models\ar\MoneyLog;
use app\modules\lottery\models\ar\WebClose;
use app\modules\lottery\modules\lzgd11\models\ar\LotteryResultGd11;
use app\modules\lottery\modules\lzgd11\util\BallUtil;
use app\modules\lottery\models\ar\HelperFun;
use app\modules\lottery\models\ar\Longhu;
use app\common\base\BaseController;
use yii\helpers\ArrayHelper;
use app\modules\core\common\filters\LoginFilter;
use app\modules\core\common\filters\UserFilter;
use yii\helpers\Json;

/**
 * IndexController
 */
class IndexController extends BaseController {
	const CONST_LOTTERY_TYPE='GD11';
	const CONST_LOTTERY_NAME='广东十一选五';
	
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();

        $this->getView()->title = self::CONST_LOTTERY_NAME;
        $view = Yii::$app->view;
        $view->params['type']=self::CONST_LOTTERY_TYPE;
        $Lottery_set = WebClose::getWebClose('gd11');
        $view->params['close'] = $Lottery_set['close'];
        $view->params['name'] = $Lottery_set['name'];
        $this->layout = '@app/modules/lottery/views/layouts/lottery';
        $this->enableCsrfValidation = false;
    }
    /**
     * 判断登录状态
     * 用于prepare-order insert-order
     * */
    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => LoginFilter::className(),
                'only' => ['prepare-order','insert-order']
            ],
            [
                'class' => UserFilter::className(),
                'only' => ['prepare-order','insert-order']
            ],
        ], parent::behaviors());
    }
	/**
	 * 默认处理方法
	 * 
	 * @return string
	 */
	public function actionIndex() {
        $Lottery_set = WebClose::getWebClose('gd11');
		$result = LotteryResultGd11::getKJResult();
        $oddslist=$this->GetOddsList();
		return $this->render ( 'index', [
            'oddslist' => $oddslist,
			'result' => $result,
            'close'=>$Lottery_set['close']
		] );
	}
    /**
     * 新增的静态方法
     * lotter/indexController调用
     * 返回下期arr('下期开奖期号'，'下期封盘倒计时'，'下期开奖倒计时'，'最后一期开奖期号','最后一期开奖结果')
     * */
    public static function getGd11x5Info(){
        $schedule = self::GetScheduleInfo();//返回时间为年月日
        $currenttime=date("Y-m-d H:i:s",time());//当前时间没问题
        $nextQishu=$schedule["qishu"];
        $opentime=strtotime($schedule["kaijiang_time"])-strtotime($currenttime);
        $differtime=strtotime($schedule["fenpan_time"])-strtotime($currenttime);
        $KJResult=LotteryResultGd11::getKJResult();
        if ($KJResult){
            $lastQishu = $KJResult['qishu'];
            $hm[] = $KJResult['ball_1'];
            $hm[] = $KJResult['ball_2'];
            $hm[] = $KJResult['ball_3'];
            $hm[] = $KJResult['ball_4'];
            $hm[] = $KJResult['ball_5'];
        }
        else{
            $lastQishu = '00000000';
            $hm = array();
        }
        $frontinfo = array (
            'number' => $nextQishu,
            'opentime' => $opentime,
            'fengpan' => $differtime,
            'numbers' => $lastQishu,
            'hm' => $hm,
        );
        return $frontinfo;
    }
    /**
	 * 获取彩票信息
	 * $number 当期开奖期号
	 * $fengpan  下期封盘时间
	 * $opentime 下期开奖时间
	 * */
	public function actionGetFrontInfo() {
		$schedule=$this->GetScheduleInfo();
		$currenttime=date("Y-m-d H:i:s",time());
		$qishu=$schedule["qishu"];
		$opentime=strtotime($schedule["kaijiang_time"])-strtotime($currenttime);
		$differtime=strtotime($schedule["fenpan_time"])-strtotime($currenttime);
		$frontinfo = array (
				'number' => $qishu,
				'opentime' => $opentime,
				'fengpan' => $differtime
		);
		$json_string = json_encode($frontinfo);
		return $json_string;
	}
    /**
     * 获取最后一期开奖结果
     * */
	public function actionGetKJResult() {
		$KJResult=LotteryResultGd11::getKJResult();
		 
		if ($KJResult)
		{
			$qishu = $KJResult['qishu'];
			$hm[] = $KJResult['ball_1'];
			$hm[] = $KJResult['ball_2'];
			$hm[] = $KJResult['ball_3'];
			$hm[] = $KJResult['ball_4'];
			$hm[] = $KJResult['ball_5'];
		} else {
			$qishu = '00000000';
			$hm = array ();
		}
		 
		$KJinfo = array (
				'numbers' => $qishu,
				'hm' => $hm,
		);
		 
		$json_string = json_encode($KJinfo);
		echo $json_string;
	}
    /**
     * 投注前验证
     * 正确返回投注信息
     * 错误返回错误信息
     * */
	public function actionPrepareOrder() {
		$postarr=Yii::$app->request->post();
		$data=$postarr['data'];
		$data=DataValid::object_array(json_decode($data));
		$ret = $this->data_valid ( $data );
		if ($ret) {
			return $ret;
		}
		$ballutil=new BallUtil();
		$oddslist=$this->GetOddsList();
		
		$names = array_keys ( $data );
		$sumbetball = 0;
		$summoney=0;
		$ballmsg=null;
		for($i = 0; $i < count ( $data ); $i ++) {
			$summoney = $summoney + $data [$names [$i]];
			$sumbetball ++;
			$qiu = explode ( '_', $names [$i] );
			$odd = $oddslist ['ball'] [$qiu [1]] [$qiu [2]];
			$qiuhao = $ballutil->getdid($qiu [1]);
			if ($qiu [1] == 6) {
				$wanfa = $ballutil->getwan6($qiu [2]);
			} else if (($qiu [1] == 7) || ($qiu [1] == 8) || ($qiu [1] == 9)) {
				$wanfa = $ballutil->getwan789($qiu [2]);
			} else {
				$wanfa = $ballutil->getwan($qiu [2]);
			}
			$ballmsg = $ballmsg . $qiuhao . "[" . $wanfa . "] @ " . $odd . " x ￥" . $data [$names [$i]] . "<br />";
		}
        $promptinfo = array(
            'summoney' => $summoney,
            'sumbetball' => $sumbetball,
            'ballmsg' => $ballmsg,
        );
        $json_string = json_encode($promptinfo);
        return $json_string;
	}
    /**
     * 投注函数
     * 验证数据正确性
     * 主订单、更新余额、日志、子订单
     * 正常返回code10 失败返回code 8
     * */
	public function actionInsertOrder() {
		$postarr=Yii::$app->request->post();
		$data=$postarr['data'];
		$data=DataValid::object_array(json_decode($data));
		// 效验数据
		$ret = $this->data_valid ( $data );
		if ($ret) {
			return $ret;
		}

        // 效验数据(球號)
        $check = $this->dataCheck ( $data );
        if ($check) {
            return $check;
        }

        $innerTransaction = Yii::$app->db->beginTransaction();
    try {
		$userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
		$oddslist=$this->GetOddsList();
		$schedule=$this->GetScheduleInfo();
		$currenttime=date("Y-m-d H:i:s",time());
		$orderlottery=new OrderLottery();
		$orderlottery->user_id=$userid;
		$orderlottery->Gtype=self::CONST_LOTTERY_TYPE;
		$orderlottery->rtype_str='快速-广东11选5';
		$orderlottery->rtype='731';
		$orderlottery->bet_info='bet_info';
		$orderlottery->bet_money=DataValid::sum_bet_money($data);
		$orderlottery->win=0;
		$orderlottery->lottery_number=$schedule['qishu'];
		$orderlottery->bet_time=$currenttime;
		$orderlottery->save();
		
		$olid=$orderlottery->id;
		$ordernum=date ( 'YmdHis' ) . $olid;
		//$moneylog=new MoneyLog();
		$userinfo=UserList::getUserInfo($userid);
        $usermoney=$userinfo['money'];  //提取用户金额
        //$money_usermoney = MoneyLog::GetLastMoney($userid);
		$balance=$usermoney-DataValid::sum_bet_money ( $data );

        $sum = DataValid::sum_bet_money ( $data ); //投注总额
        $uid = $userinfo['id'];  //user_list id
        //new
        // 更新用户余额
        Yii::$app->db->createCommand("update user_list set money=money-$sum where id=:id", [
            ':id' => $uid,
        ])->execute();
		
		// 用户投注日志
        $lotteryName = self::CONST_LOTTERY_NAME;
        $type = '彩票下注';
        $sql = "INSERT INTO money_log(user_id,order_num,about,update_time,`type`,order_value,assets,balance) select $userid as user_id,$ordernum as order_num,'$lotteryName' as about,'$currenttime' as update_time,'$type' as `type`,$sum as order_value,money+$sum as assets,money as balance from user_list where id=$uid";
        Yii::$app->db->createCommand($sql)->execute();
		
		$orderlottery=OrderLottery::findOne($olid);
		$orderlottery->order_num=$ordernum;
		$orderlottery->save();
		
		// 订单明细表入库
		$ballutil=new BallUtil();
		$names=array_keys($data);
		$win_money_total=0;
		for($i = 0; $i < count ( $data ); $i ++) {
			$qiu = explode ( '_', $names [$i] );
			$qiuhao = $ballutil->getdid($qiu [1]);
			if ($qiu [1] == 6) {
				$wanfa = $ballutil->getwan6($qiu [2]);
				$number = $wanfa;
			} else if (($qiu [1] == 7) || ($qiu [1] == 8) || ($qiu [1] == 9)) {
				$wanfa = $ballutil->getwan789($qiu [2]);
				$number = $wanfa;
			} else {
				$wanfa = $ballutil->getwan($qiu [2]);
				$number = $wanfa;
			}
				
			$money = $data [$names[$i]];
			$odds = $oddslist['ball'] [$qiu [1]] [$qiu [2]];
			$bet_rate = $odds;
			$bet_money_one = $money;
			$win_money = $bet_money_one * $odds;
			$win_money_total += $win_money;
				
			// 反水金额
			$ugul=UserGroup::getUserGroupInfo($userid);
			$fsOdds=$ugul[strtolower ( self::CONST_LOTTERY_TYPE ) . '_bet_reb'];
			$fs_money = $bet_money_one * $fsOdds;

			$orderlotterysub=new OrderLotterySub();
			$orderlotterysub->order_num = $ordernum;
			$orderlotterysub->quick_type = $qiuhao;
			$orderlotterysub->number = $number;
			$orderlotterysub->bet_rate = $bet_rate;
			$orderlotterysub->bet_money = $bet_money_one;
			$orderlotterysub->win = $win_money;
			$orderlotterysub->fs = $fs_money;
			$orderlotterysub->balance = $balance ;
			$orderlotterysub->save();
			
			$olsid=$orderlotterysub->id;
			$datereg_sub = date ( 'YmdHis' ) . $olsid;
			$order_lottery_sub=OrderLotterySub::findOne($olsid);
			$order_lottery_sub->order_sub_num=$datereg_sub;
			$order_lottery_sub->save();
			
			$orderlottery=OrderLottery::findOne($olid);
			$orderlottery->win=$win_money_total;
			$orderlottery->save();
		}
          $innerTransaction->commit();
          $valid= ["code" => 10];
          $json_string = json_encode($valid);
          return $json_string;
      } catch (Exception $e) {
          error_log('IndexController.insert：'.$e->getTraceAsString().'online:'.$e->getLine().'，type：lzgd11，time:'.date('Y-m-d h:i:s',time()).''."\r\n", 3, "error.log");
          $innerTransaction->rollBack();
          $valid= ["code" => 8];
          $json_string = json_encode($valid);
          return $json_string;
      }
	}
	
    /**
     * 获得倍率
     */
    public function GetOddsList() {
    	$lottery_subtype=['正码和特别号','总和龙虎和','顺子杂六'];
    	$odds=OddsLottery::getOdds(self::CONST_LOTTERY_NAME, $lottery_subtype);
    	$num = count ( $odds );
    	// 设置赔率
        for($s = 0; $s < $num ; $s ++) {
        	for ($i = 1; $i < 16; $i++)
			{
				$oddslist ['ball'] [$s+1] [$i] = $odds[$s] ['h' . $i];
			}
    	}
    	return $oddslist;
    }
    
    /**
     * 期数
     * 开奖时间
     */
    public function GetScheduleInfo() {
    	$firstSchedule = LotterySchedule::getFirstSchedule( self::CONST_LOTTERY_NAME );
    	$lastSchedule = LotterySchedule::getLastSchedule( self::CONST_LOTTERY_NAME );
    	
    	$isLateNight=false;
    	if ((date ( 'H:i:s', time () ) <= $firstSchedule ['kaipan_time']) || ($lastSchedule ['kaijiang_time'] <= date ( 'H:i:s', time () ))) {
    		$scheduleinfo = $firstSchedule;
    		if ($lastSchedule ['kaijiang_time'] <= date ( 'H:i:s', time () )) {
    			$isLateNight = true;
    		}
    	} else {
    		$scheduleinfo = LotterySchedule::getNewSchedule ( self::CONST_LOTTERY_NAME );
    	}
    	
    	$isLateNight == true ? $time = time () + 86400 : $time = time ();
    	
    	$schedule['qishu']=date ( 'Ymd', $time ) . $scheduleinfo ['qishu'];
    	
    	$schedule['kaipan_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['kaipan_time'];
    	$schedule['fenpan_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['fenpan_time'];
    	$schedule['kaijiang_time']=date ( 'Y-m-d', $time ) . ' ' . $scheduleinfo ['kaijiang_time'];
    	
    	return $schedule;
    }
    
    /**
     * 对用户金额效验及系统的最大投注限额进行效验
     *
     * @param unknown $userid
     * @param unknown $data
     */
    function system_bet_limit( $data) {
    	$bet_money_total = DataValid::sum_bet_money ( $data );
    	
    	$schedule=$this->GetScheduleInfo();
    	$qishu=date('Ymd', time()).$schedule["qishu"];
    	
    	$userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
    	
    	$ugul=UserGroup::getUserGroupInfo($userid);
    	$maxMoney=$ugul[strtolower ( self::CONST_LOTTERY_TYPE ) . '_max_bet'];
    	
    	$max_money_already = OrderLottery::getSumBetMoney ( $userid, self::CONST_LOTTERY_TYPE, $qishu );
    	// 校验该用户最大的投注金额
    	if ((0 < $maxMoney) && ($maxMoney < ($max_money_already + $bet_money_total))) {
    		return false;
    	}
    	return true;
    }
    /**
     * 判断是否在规定时间内
     * */
    function bet_time_limit() {
    	$schedule=$this->GetScheduleInfo();
    	$fengpanTime=  $schedule['fenpan_time'];
    	$kaijiangTime= $schedule["kaijiang_time"];
    	$currenttime=date("Y-m-d H:i:s",time());
    	$diffkaipan=strtotime($schedule["kaipan_time"])-strtotime($currenttime);
    	 
    	if($diffkaipan>0){
    		return false;
    	}
    	if(($fengpanTime <= $currenttime) && ($currenttime <= $kaijiangTime)) {
    		return false;
    	}
    	return true;
    }
    
	/**
	 * 数据校验
	 * @param unknown $data
	 * @return number
	 */
    function data_valid($data) {
        $data_valid = new DataValid();
        $flag = $this->bet_time_limit ( $data );
        if (! $flag) {
            return $this->out(false,'已经封盘了，超出了投注时间!');
        }
        $flag = $data_valid->data_except_valid ( $data );
        if (! $flag) {
            return $this->out(false,'请输入有效金额!');
        }
        $flag = $data_valid->count_one ( $data );
        if (! $flag) {
            return $this->out(false,'超过当期下注最大金额，请联系管理人员!');
        }
        $flag = $data_valid->bet_scope_limit ( $data,self::CONST_LOTTERY_TYPE );
        if (! $flag) {
            return $this->out(false,'单注金额受限!');
        }
        $flag = $data_valid->user_money_limit ( $data );
        if (! $flag) {
            return $this->out(false,'账户余额不足!');
        }
        $flag = $this->system_bet_limit ( $data );
        if (! $flag) {
            return $this->out(false,'投注总金额不得超过用户所在组最大投注限额!');
        }
    }

    /**
     * 总和大小 露珠图
     * tp:1:大小，0：单双
     * 返回页面 适用于load局部调用
     * */
	public function actionOrderList(){
		$type=$this->getParam('tp',0);
		$start=date('Y-m-d',time());
		$list=LotteryResultGd11::getResultList(NULL,$start);
		$list=array_slice($list,0,120);
        if($type ==1){
            foreach ($list as $row=>$v){
                $guanyanhe = $v['ball_1'] + $v['ball_2'] + $v['ball_3'] + $v['ball_4'] + $v['ball_5'];
                if($guanyanhe == 30){
                    $longhuhe = 2;
                }else{
                    if($guanyanhe < 30){
                        $longhuhe = 0;
                    }else{
                        $longhuhe = 1;
                    }
                }
                $list[$row]['longhuhe'] = $longhuhe;
            }
        }else{
            foreach ($list as $row=>$v){
                $guanyanhe = $v['ball_1'] + $v['ball_2'] + $v['ball_3'] + $v['ball_4'] + $v['ball_5'];
                if($guanyanhe%2 ==1){
                    $danshuang = 1;
                }else{
                    $danshuang = 0;
                }
                $list[$row]['longhuhe'] = $danshuang;
            }
        }
        $heper=new Longhu($list,5,1,5);
        $return=$heper->cout();
        return $this->renderPartial('@app/modules/lottery/views/luzhutu-zonghe',['arrs'=>$return,'type'=>$type]);
	}

    /**
     * 龙虎和露珠图
     * 返回页面 适用于load局部调用
     * */
	public function actionLonghu(){
		$start=date('Y-m-d',time());
		$list=LotteryResultGd11::getResultList(NULL,$start);
		$list=array_slice($list,0,120);
		for($b_a=0;$b_a<count($list);$b_a++){
			if($list[$b_a]['ball_1'] > $list[$b_a]['ball_5']){
				$longhuhe = 0;
			}else if($list[$b_a]['ball_1'] < $list[$b_a]['ball_5']){
				$longhuhe = 1;
			}else{
				$longhuhe = 2;
			}
			foreach ($list as $row=>$v){
				$list[$b_a]['longhuhe'] = $longhuhe;
			}
		}
		$heper=new Longhu($list,5,1,55);
		$return=$heper->cout();
        return $this->renderPartial('@app/modules/lottery/views/luzhutu-zonghe',['arrs'=>$return,'type'=>2]);
	}
	/**
	 * 左侧两面长龙
	 * */
	public function actionAjaxchanglong(){
		$start=date('Y-m-d',time());
		$list=LotteryResultGd11::getResultList(NULL,$start);
        $liangmian = new LiangMian();
        $changlong = [];
        $arr = ['一',"二","三","四","五"];
        $changlong['总和 - 单'] = $liangmian->count_single($list,5);
        $changlong['总和 - 双'] = $liangmian->count_double($list,5);
        $changlong['总和 - 大'] = $liangmian->count_big($list,5,30);
        $changlong['总和 - 小'] = $liangmian->count_small($list,5,30);
        for($i=1;$i<=5;$i++){
            $changlong['第'.$arr[$i-1].'球 - 大'] = $liangmian->ball_big($list,$i,5);
        }
        for($i=1;$i<=5;$i++){
            $changlong['第'.$arr[$i-1].'球 - 小'] = $liangmian->ball_small($list,$i,6);
        }
        for($i=1;$i<=5;$i++){
            $changlong['第'.$arr[$i-1].'球 - 单'] = $liangmian->ball_single($list,$i);
        }
        for($i=1;$i<=5;$i++){
            $changlong['第'.$arr[$i-1].'球 - 双'] = $liangmian->ball_double($list,$i);
        }
        $changlong['龙虎 - 龙'] = $liangmian->long($list,1,5);
        $changlong['龙虎 - 虎'] = $liangmian->hu($list,1,5);
        $changlong['龙虎 - 合'] = $liangmian->he($list,1,5);
        arsort($changlong);
        return $this->renderpartial("@app/modules/lottery/views/changlong",["changlong"=>$changlong]);
	}

    /**
     * 单球露珠图
     * param:$w 第几球
     * param:$tp 类型 1：大小；0：单双；2：开奖结果
     * 返回页面 适用于load局部调用
     * */
	public function actionLuzhutu(){
		$which=$this->getParam('w',1);
		$type=$this->getParam('tp',0);
		$start=date('Y-m-d',time());
		$list=LotteryResultGd11::getResultList(NULL,$start);
		$list=array_slice($list,0,120);
		for($b_a=0;$b_a<count($list);$b_a++){
			foreach ($list as $row=>$v){
				$list[$b_a]['ball_num'] = $list[$b_a]['ball_'.$which];
			}
		}
		$heper=new HelperFun($list,$which,11,5,$type,9);
		$return=$heper->cout();
		$ball_nums = $heper->ball_num();
        return $this->renderPartial('@app/modules/lottery/views/luzhutu-danqiu',['arrs'=>$return,'ball_nums'=>$ball_nums,'type'=>$type]);
	}

    /**
     * 数据校验 20190819
     * 驗證广东11选5前端送出的參數是否在正常範圍
     */
    function dataCheck($data) {
        $names = array_keys($data);

        foreach ($names as $key => $val) {
            $qiu = explode('_', $val);
            //$qiu EX:Array ( [0] => ball [1] => 5 [2] => 14 )
            if($qiu[0]!= 'ball' || count($qiu)!=3 || !is_numeric($qiu[1]) || !is_numeric($qiu[2])){
                return $this->out(false, '错误的下注内容');
            }elseif(!(substr($qiu[1],0,1))|| !(substr($qiu[2],0,1))){  //EX:"ball_04_01":"2"
                return $this->out(false, '错误的下注内容');
            }
            //各別檢查
            switch ($qiu[1]) {
                case '1':
                case '2':
                case '3':
                case '4':
                case '5':
                    if ($qiu[2] < 1 || $qiu[2] > 15) {
                        return $this->out(false, '错误的下注内容');
                    }

                    break;
                case '6':
                    if ($qiu[2] < 1 || $qiu[2] > 6) {
                        return $this->out(false, '错误的下注内容');
                    }

                    break;
                case '7':
                case '8':
                case '9':
                    if ($qiu[2] < 1 || $qiu[2] > 3) {
                        return $this->out(false, '错误的下注内容');
                    }

                    break;
                default:
                    return $this->out(false, '错误的下注内容');
                    break;
            }
        }
    }
}