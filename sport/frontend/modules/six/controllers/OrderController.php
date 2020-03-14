<?php
//namespace app\modules\six\controllers;
//
//use app\common\base\BaseController;
//use Yii;
//use yii\web\Controller;
//use app\modules\six\models\SixLotterySchedule;
//use app\modules\six\models\SixLotteryOdds;
//use app\modules\six\models\SysAnnouncement;
//use app\modules\six\models\SixLotteryOrder;
//use app\modules\six\models\UserList;
//use app\modules\six\models\UserGroup;
//use app\modules\six\models\SixLotteryOrderSub;
//use app\modules\six\models\MoneyLog;
//use app\modules\six\models\LotteryResultLhc;
//use app\modules\six\helpers\Zodiac;
//use app\modules\six\models\CommonFc\CommonFc;
///**
// * 六合彩
// * IndexController
// */
//class OrderController extends BaseController  {
//
//    //public $_assetUrl = '';
//    private $_req = null;
//    private $_session = null;
//    private $_params = null;
//
//    public function init() {
//        parent::init();
//
//        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
//
//        //$this->_assetUrl = Yii::$app->getModule('six')->assetsUrl[1];
//        $this->_req = Yii::$app->request;
//        $this->_session = Yii::$app->session;
//        $this->_params = Yii::$app->params;
//        //$this->getView()->title = '六合彩';
//        $this->layout = false;
//    }
//	public function getMoney(){
//		 $uid = $this->_session[$this->_params['S_USER_ID']];//正常登陆
//		 if($uid){
//			 echo UserList::Money($uid);
//		 }else{
//			 echo -1;
//		 }
//	}
//
//    /*下注操作*/
//    public function actionSixOrder() {
//        $money=$this->getMoney();//
//        if($money==-1){
//            //header("Content-type: text/html; charset=utf-8");
//            echo('登录后才能下注。');
//            exit;
//        }
//        $postNews =  Yii::$app->request->post();
//        if(!$postNews){ echo '没有数据提交'; exit;}
//		if(!isset($postNews['period'])||$postNews['period']==0){
//			header("Content-type: text/html; charset=utf-8");
//			echo('投注异常，请刷新页面！');
//			exit;
//		}else{
//			if(!$this->_getState($postNews['period'])){
//				header("Content-type: text/html; charset=utf-8");
//				echo('已经封盘，无法投注！');
//				exit;
//			}
//		}
//        if(empty($postNews['gold'])){$postNews['gold'] = 0;}
//        if(empty($postNews['odds'])){$postNews['odds'] = 0;}
//        $goldArray = $postNews['gold']; //投注金额数组
//        $oddsArray = $postNews['odds']; //投注倍率数组
//        $gid = trim($postNews['gid']);
//        $rType = $gid;
//        $balance = 0; //平衡  用来计算投注
//        $assets = 0; //资产
//        $bet_money_total = 0; //下注金额
//        $bet_win_total = 0;
//        $bet_money_one = 0;
//        $betInfo_one = 0;
//        $bet_rate_one = 0;
//        $betInfoArray = array();
//        $rs_user = UserList::getUserNewsByUserId($userid);
//        $qishu = SixLotterySchedule::getNewQishu(); //获取当前期数 qishu=-1 未开盘
//        $common = new CommonFc;
//        $rTypeName = $common->getZhLhcName($rType);
//        $row=UserGroup::getLimitAndFsMoney($userid);
//        $lowestMoney=$row['lhc_lower_bet'];
//        $maxMoney = $row['lhc_max_bet'];
//        if (($gid == 'SP') || ($gid == 'SPbside')) {//特别号A面、特别号B面
//            if ($gid == 'SP') {//特别号A面
//                $odds_SP = SixLotteryOdds::getOddsByBallType('SP', 'a_side');
//            } else if ($gid == 'SPbside') {//特别号B面
//                $odds_SP = SixLotteryOdds::getOdds('SP');
//            }
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            for ($i = 1; $i < 50; $i++) {
//                $numString = ($i < 10 ? '0' . $i : $i);
//                if (0 < $goldArray['SP' . $numString]) {
//                    if ($odds_SP['h' . $i] != $oddsArray['SP' . $numString]) {
//                        echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                        exit;
//                    }
//                }
//            }
//            if (($oddsArray['SP_ODD'] != $odds_SP_other['h1']) || ($oddsArray['SP_EVEN'] != $odds_SP_other['h2']) || ($oddsArray['SP_OVER'] != $odds_SP_other['h3']) || ($oddsArray['SP_UNDER'] != $odds_SP_other['h4']) || ($oddsArray['SF_OVER'] != $odds_SP_other['h9']) || ($oddsArray['SP_SODD'] != $odds_SP_other['h5']) || ($oddsArray['SP_SEVEN'] != $odds_SP_other['h6']) || ($oddsArray['SP_SOVER'] != $odds_SP_other['h7']) || ($oddsArray['SP_SUNDER'] != $odds_SP_other['h8']) || ($oddsArray['SF_UNDER'] != $odds_SP_other['h10']) || ($oddsArray['HS_EO'] != $odds_SP_other['h16']) || ($oddsArray['HS_EU'] != $odds_SP_other['h17']) || ($oddsArray['HS_OO'] != $odds_SP_other['h14']) || ($oddsArray['HS_OU'] != $odds_SP_other['h15'])) {
//                echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                exit;
//            }
//
//        }else if (in_array($gid, array('N1', 'N2', 'N3', 'N4', 'N5', 'N6'))){//正码1-6
//            $oddsN = SixLotteryOdds::getOdds($gid);
//            for ($i = 1; $i < 50; $i++) {
//                $numString = ($i < 10 ? '0' . $i : $i);
//                if (0 < $goldArray[$gid . $numString]) {
//                    if ($oddsN['h' . $i] != $oddsArray[$gid . $numString]) {
//                        echo('用户异常，请退出重新登录。');
//                        exit;
//                    }
//                }
//            }
//        }else if ($gid == 'NA') {//正码
//            $odds_NA = SixLotteryOdds::getOdds('NA');
//            $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
//            for ($i = 1; $i < 50; $i++) {
//                $numString = ($i < 10 ? '0' . $i : $i);
//                if (0 < $goldArray[$gid . $numString]) {
//                    if ($odds_NA['h' . $i] != $oddsArray[$gid . $numString]) {
//                        echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                        exit;
//                    }
//                }
//            }
//            if (($oddsArray['NA_ODD'] != $odds_NA_other['h1']) || ($oddsArray['NA_EVEN'] != $odds_NA_other['h2']) || ($oddsArray['NA_OVER'] != $odds_NA_other['h3']) || ($oddsArray['NA_UNDER'] != $odds_NA_other['h4'])) {
//                echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                exit;
//            }
//        }else if ($gid == 'NO') {//正码1-6
//			for($i=1;$i<=6;$i++){
//				$var='odds'.$i.'_other';
//				$$var=SixLotteryOdds::getOddsByBallType('N'.$i, 'other');
//			}
//            for ($i = 1; $i < 7; $i++) {
//				$var='odds'.$i.'_other';
//				$odds_other=$$var;
//                if (($oddsArray['NO' . $i . '_ODD'] != $odds_other['h1']) || ($oddsArray['NO' . $i . '_EVEN'] != $odds_other['h2']) || ($oddsArray['NO' . $i . '_OVER'] != $odds_other['h3']) || ($oddsArray['NO' . $i . '_UNDER'] != $odds_other['h4']) || ($oddsArray['NO' . $i . '_SODD'] != $odds_other['h5']) || ($oddsArray['NO' . $i . '_SEVEN'] != $odds_other['h6']) || ($oddsArray['NO' . $i . '_SOVER'] != $odds_other['h7']) || ($oddsArray['NO' . $i . '_SUNDER'] != $odds_other['h8']) || ($oddsArray['NO' . $i . '_FOVER'] != $odds_other['h9']) || ($oddsArray['NO' . $i . '_FUNDER'] != $odds_other['h10']) || ($oddsArray['NO' . $i . '_R'] != $odds_other['h11']) || ($oddsArray['NO' . $i . '_G'] != $odds_other['h12']) || ($oddsArray['NO' . $i . '_B'] != $odds_other['h13'])) {
//                    echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                    exit;
//                }
//            }
//        }else if ($gid == 'OEOU') {//两面
//			for($i=1;$i<=6;$i++){
//				$var='odds'.$i.'_other';
//				$$var=SixLotteryOdds::getOddsByBallType('N'.$i, 'other');
//			}
//            $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            for ($i = 1; $i < 7; $i++) {
//				$var='odds'.$i.'_other';
//				$odds_other=$$var;
//                if (($oddsArray['NO' . $i . '_ODD'] != $odds_other['h1']) || ($oddsArray['NO' . $i . '_EVEN'] != $odds_other['h2']) || ($oddsArray['NO' . $i . '_OVER'] != $odds_other['h3']) || ($oddsArray['NO' . $i . '_UNDER'] != $odds_other['h4']) || ($oddsArray['NO' . $i . '_SODD'] != $odds_other['h5']) || ($oddsArray['NO' . $i . '_SEVEN'] != $odds_other['h6']) || ($oddsArray['NO' . $i . '_SOVER'] != $odds_other['h7']) || ($oddsArray['NO' . $i . '_SUNDER'] != $odds_other['h8'])) {
//                    echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                    exit;
//                }
//                if (($oddsArray['NA_ODD'] != $odds_NA_other['h1']) || ($oddsArray['NA_EVEN'] != $odds_NA_other['h2']) || ($oddsArray['NA_OVER'] != $odds_NA_other['h3']) || ($oddsArray['NA_UNDER'] != $odds_NA_other['h4'])) {
//                    echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                    exit;
//                }
//                if (($oddsArray['SP_ODD'] != $odds_SP_other['h1']) || ($oddsArray['SP_EVEN'] != $odds_SP_other['h2']) || ($oddsArray['SP_OVER'] != $odds_SP_other['h3']) || ($oddsArray['SP_UNDER'] != $odds_SP_other['h4']) || ($oddsArray['SP_SODD'] != $odds_SP_other['h5']) || ($oddsArray['SP_SEVEN'] != $odds_SP_other['h6']) || ($oddsArray['SP_SOVER'] != $odds_SP_other['h7']) || ($oddsArray['SP_SUNDER'] != $odds_SP_other['h8'])) {
//                    echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                    exit;
//                }
//            }
//        }else if ($gid == 'SPA') {//特码生肖
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            $odds_SPA = SixLotteryOdds::getOdds('SPA');
//            for ($i = 1; $i < 10; $i++) {
//                if (0 < $goldArray['SP_A' . $i]) {
//                    if ($odds_SPA['h' . $i] != $oddsArray['SP_A' . $i]) {
//                        echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                        exit;
//                    }
//                }
//            }
//            if (($oddsArray['SP_AA'] != $odds_SPA['h10']) || ($oddsArray['SP_AB'] != $odds_SPA['h11']) || ($oddsArray['SP_AC'] != $odds_SPA['h12']) || ($oddsArray['SH0'] != $odds_SPA['h13']) || ($oddsArray['SH1'] != $odds_SPA['h14']) || ($oddsArray['SH2'] != $odds_SPA['h15']) || ($oddsArray['SH3'] != $odds_SPA['h16']) || ($oddsArray['SH4'] != $odds_SPA['h17']) || ($oddsArray['SF0'] != $odds_SPA['h18']) || ($oddsArray['SF1'] != $odds_SPA['h19']) || ($oddsArray['SF2'] != $odds_SPA['h20']) || ($oddsArray['SF3'] != $odds_SPA['h21']) || ($oddsArray['SF4'] != $odds_SPA['h22']) || ($oddsArray['SF5'] != $odds_SPA['h23']) || ($oddsArray['SF6'] != $odds_SPA['h24']) || ($oddsArray['SF7'] != $odds_SPA['h25']) || ($oddsArray['SF8'] != $odds_SPA['h26']) || ($oddsArray['SF9'] != $odds_SPA['h27']) || ($oddsArray['SP_R'] != $odds_SP_other['h11']) || ($oddsArray['SP_G'] != $odds_SP_other['h12']) || ($oddsArray['SP_B'] != $odds_SP_other['h13'])) {
//                echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                exit;
//            }
//        }
//        else if ($gid == 'C7') {//七色波
//            $odds_C7 = SixLotteryOdds::getOdds('C7');
//            for ($i = 1; $i < 10; $i++) {
//                if (0 < $goldArray['NA_A' . $i]) {
//                    if ($odds_C7['h' . $i] != $oddsArray['NA_A' . $i]) {
//                        echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                        exit;
//                    }
//                }
//            }
//            if (($oddsArray['NA_AA'] != $odds_C7['h10']) || ($oddsArray['NA_AB'] != $odds_C7['h11']) || ($oddsArray['NA_AC'] != $odds_C7['h12']) || ($oddsArray['C7_R'] != $odds_C7['h13']) || ($oddsArray['C7_B'] != $odds_C7['h14']) || ($oddsArray['C7_G'] != $odds_C7['h15']) || ($oddsArray['C7_N'] != $odds_C7['h16'])) {
//                echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                exit;
//            }
//        }else if ($gid == 'SPB') {//一肖、总肖、平特尾数
//            $odds_SPB = SixLotteryOdds::getOdds('SPB');
//            for ($i = 1; $i < 10; $i++) {
//                if (0 < $goldArray['SP_B' . $i]) {
//                    if ($odds_SPB['h' . $i] != $oddsArray['SP_B' . $i]) {
//                        echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                        exit;
//                    }
//                }
//            }
//            if (($oddsArray['SP_BA'] != $odds_SPB['h10']) || ($oddsArray['SP_BB'] != $odds_SPB['h11']) || ($oddsArray['SP_BC'] != $odds_SPB['h12']) || ($oddsArray['NF0'] != $odds_SPB['h13']) || ($oddsArray['NF1'] != $odds_SPB['h14']) || ($oddsArray['NF2'] != $odds_SPB['h15']) || ($oddsArray['NF3'] != $odds_SPB['h16']) || ($oddsArray['NF4'] != $odds_SPB['h17']) || ($oddsArray['NF5'] != $odds_SPB['h18']) || ($oddsArray['NF6'] != $odds_SPB['h19']) || ($oddsArray['NF7'] != $odds_SPB['h20']) || ($oddsArray['NF8'] != $odds_SPB['h21']) || ($oddsArray['NF9'] != $odds_SPB['h22']) || ($oddsArray['TX2'] != $odds_SPB['h23']) || ($oddsArray['TX5'] != $odds_SPB['h24']) || ($oddsArray['TX6'] != $odds_SPB['h25']) || ($oddsArray['TX7'] != $odds_SPB['h26']) || ($oddsArray['TX_ODD'] != $odds_SPB['h27']) || ($oddsArray['TX_EVEN'] != $odds_SPB['h28'])) {
//                echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                exit;
//            }
//        }else if ($gid == 'HB') {//半波、半半波
//            $odds_HB = SixLotteryOdds::getOdds('HB');
//            if (($oddsArray['HB_RODD'] != $odds_HB['h1']) || ($oddsArray['HB_REVEN'] != $odds_HB['h2']) || ($oddsArray['HB_ROVER'] != $odds_HB['h3']) || ($oddsArray['HB_RUNDER'] != $odds_HB['h4']) || ($oddsArray['HB_GODD'] != $odds_HB['h5']) || ($oddsArray['HB_GEVEN'] != $odds_HB['h6']) || ($oddsArray['HB_GOVER'] != $odds_HB['h7']) || ($oddsArray['HB_GUNDER'] != $odds_HB['h8']) || ($oddsArray['HB_BODD'] != $odds_HB['h9']) || ($oddsArray['HB_BEVEN'] != $odds_HB['h10']) || ($oddsArray['HB_BOVER'] != $odds_HB['h11']) || ($oddsArray['HB_BUNDER'] != $odds_HB['h12']) || ($oddsArray['HH_ROO'] != $odds_HB['h13']) || ($oddsArray['HH_ROE'] != $odds_HB['h14']) || ($oddsArray['HH_RUO'] != $odds_HB['h15']) || ($oddsArray['HH_RUE'] != $odds_HB['h16']) || ($oddsArray['HH_GOO'] != $odds_HB['h17']) || ($oddsArray['HH_GOE'] != $odds_HB['h18']) || ($oddsArray['HH_GUO'] != $odds_HB['h19']) || ($oddsArray['HH_GUE'] != $odds_HB['h20']) || ($oddsArray['HH_BOO'] != $odds_HB['h21']) || ($oddsArray['HH_BOE'] != $odds_HB['h22']) || ($oddsArray['HH_BUO'] != $odds_HB['h23']) || ($oddsArray['HH_BUE'] != $odds_HB['h24'])) {
//                echo('<script>alert("用户异常，请退出重新登录。")</script>');
//                exit;
//            }
//        }
//
//
//
//        if(empty($postNews['gold'])){ $postNews['gold'] = 0;}
//        if(empty($postNews['totalArray'])){ $postNews['totalArray'] = 0;}
//        if ($gid == 'NAP') {//正码过关
//			for($i=1;$i<=6;$i++){
//				$var='odds_NAP'.$i;
//				$$var=SixLotteryOdds::getOdds('NAP'.$i);
//			}
//            if (empty($postNews['game1'])) { $postNews['game1'] = '';}
//            if (empty($postNews['game2'])) { $postNews['game2'] = '';}
//            if (empty($postNews['game3'])) { $postNews['game3'] = '';}
//            if (empty($postNews['game4'])) { $postNews['game4'] = '';}
//            if (empty($postNews['game5'])) { $postNews['game5'] = '';}
//            if (empty($postNews['game6'])) { $postNews['game6'] = '';}
//            if (empty($postNews['radio1'])) { $postNews['radio1'] = null;}
//            if (empty($postNews['radio2'])) { $postNews['radio2'] = null;}
//            if (empty($postNews['radio3'])) { $postNews['radio3'] = null;}
//            if (empty($postNews['radio4'])) { $postNews['radio4'] = null;}
//            if (empty($postNews['radio5'])) { $postNews['radio5'] = null;}
//            if (empty($postNews['radio6'])) { $postNews['radio6'] = null;}
//            if (empty($postNews['oddindex1'])) { $postNews['oddindex1'] = 20;}
//            if (empty($postNews['oddindex2'])) { $postNews['oddindex2'] = 20;}
//            if (empty($postNews['oddindex3'])) { $postNews['oddindex3'] = 20;}
//            if (empty($postNews['oddindex4'])) { $postNews['oddindex4'] = 20;}
//            if (empty($postNews['oddindex5'])) { $postNews['oddindex5'] = 20;}
//            if (empty($postNews['oddindex6'])) { $postNews['oddindex6'] = 20;}
//			$arr=array('game'=>'','radio'=>NULL,'oddindex'=>20);
//			foreach($arr as $k=>$v){
//				for($i=1;$i<=6;$i++){
//					$var=$k.$i;
//
//				}
//			}
//            $game1 = $postNews['game1'];
//            $game2 = $postNews['game2'];
//            $game3 = $postNews['game3'];
//            $game4 = $postNews['game4'];
//            $game5 = $postNews['game5'];
//            $game6 = $postNews['game6'];
//            $radio1 = $postNews['radio1'];
//            $radio2 = $postNews['radio2'];
//            $radio3 = $postNews['radio3'];
//            $radio4 = $postNews['radio4'];
//            $radio5 = $postNews['radio5'];
//            $radio6 = $postNews['radio6'];
//            $oddindex1 = $postNews['oddindex1'];
//            $oddindex2 = $postNews['oddindex2'];
//            $oddindex3 = $postNews['oddindex3'];
//            $oddindex4 = $postNews['oddindex4'];
//            $oddindex5 = $postNews['oddindex5'];
//            $oddindex6 = $postNews['oddindex6'];
//            $bet_info_nap = '';
//            $bet_rate_nap = '';
//            if ($game1 != '') {
//                if ($radio1 != $odds_NAP1['h' . $oddindex1]) {
//                    echo('用户异常，请退出重新登录。');
//                    exit;
//                }
//                $bet_info_nap .= $game1 . ',';
//                $bet_rate_nap .= $radio1 . ',';
//            }
//            if ($game2 != '') {
//                if ($radio2 != $odds_NAP2['h' . $oddindex2]) {
//                    echo('用户异常，请退出重新登录。');
//                    exit;
//                }
//                $bet_info_nap .= $game2 . ',';
//                $bet_rate_nap .= $radio2 . ',';
//            }
//            if ($game3 != '') {
//                if ($radio3 != $odds_NAP3['h' . $oddindex3]) {
//                    echo('用户异常，请退出重新登录。');
//                    exit;
//                }
//                $bet_info_nap .= $game3 . ',';
//                $bet_rate_nap .= $radio3 . ',';
//            }
//            if ($game4 != '') {
//                if ($radio4 != $odds_NAP4['h' . $oddindex4]) {
//                    echo('用户异常，请退出重新登录。');
//                    exit;
//                }
//                $bet_info_nap .= $game4 . ',';
//                $bet_rate_nap .= $radio4 . ',';
//            }
//            if ($game5 != '') {
//                if ($radio5 != $odds_NAP5['h' . $oddindex5]) {
//                    echo('用户异常，请退出重新登录。');
//                    exit;
//                }
//                $bet_info_nap .= $game5 . ',';
//                $bet_rate_nap .= $radio5 . ',';
//            }
//            if ($game6 != '') {
//                if ($radio6 != $odds_NAP6['h' . $oddindex6]) {
//                    echo('用户异常，请退出重新登录。');
//                    exit;
//                }
//                $bet_info_nap .= $game6 . ',';
//                $bet_rate_nap .= $radio6 . ',';
//            }
//            $bet_info_nap = substr($bet_info_nap, 0, -1);
//            $bet_rate_nap = substr($bet_rate_nap, 0, -1);
//            $bet_win_total = 0;
//            $bet_money_one = $goldArray;
//            $betInfo_one = $bet_info_nap;
//            $bet_rate_one = $bet_rate_nap;
//            $bet_money_total = $bet_money_one;
//        }
//        else if ($gid == 'CH') {//连码
//            $odds_CH = SixLotteryOdds::getOdds('CH');
//            if(empty($postNews['ch_name'])){ $postNews['ch_name'] = '';}
//            $totalArray = $postNews['totalArray'];
//            $bet_money_one = $postNews['gold'];
//            $ch_name =$postNews['ch_name'];
//            $rTypeName = $ch_name;
//            $goldArray = array();
//            $oddsArray = array();
//            $betInfoArray = array();
//            $minCount = count(explode(', ', $totalArray[0]));
//            if ($ch_name == '四全中') {
//                $oddsValue = $odds_CH['h1'];
//                if ($minCount != 4) { $validateOdd == 'false';}
//            } else if ($ch_name == '三全中') {
//                $oddsValue = $odds_CH['h2'];
//                if ($minCount != 3) { $validateOdd == 'false';}
//            } else if ($ch_name == '三中二') {
//                $oddsValue = $odds_CH['h4'];
//                if ($minCount != 3) { $validateOdd == 'false';}
//            } else if ($ch_name == '二全中') {
//                $oddsValue = $odds_CH['h5'];
//                if ($minCount != 2) { $validateOdd == 'false';}
//            } else if ($ch_name == '二中特') {
//                $oddsValue = $odds_CH['h7'];
//                if ($minCount != 2) { $validateOdd == 'false';}
//            } else if ($ch_name == '特串') {
//                $oddsValue = $odds_CH['h8'];
//                if ($minCount != 2) { $validateOdd == 'false';}
//            }
//            foreach ($totalArray as $key => $value) {
//                $goldArray[] = $bet_money_one;
//                $betInfoArray[] = $value;
//                $oddsArray[] = $oddsValue;
//                $bet_money_total = $bet_money_total + $bet_money_one;
//                $bet_win_total = $bet_win_total + ($bet_money_one * $oddsValue);
//            }
//        }
//        else if ($gid == 'NI') {//自选不中
//            $odds_NI = SixLotteryOdds::getOdds('NI');
//            if(empty($postNews['ni_name'])){ $postNews['ni_name'] = '';}
//            $totalArray = $postNews['totalArray'];
//            $bet_money_one = $postNews['gold'];
//            $ni_name = $postNews['ni_name'];
//            $rTypeName = $ni_name;
//            $goldArray = array();
//            $oddsArray = array();
//            $betInfoArray = array();
//            $minCount = count(explode(', ', $totalArray[0]));
//            if ($minCount == 5) {
//                $oddsValue = $odds_NI['h1'];
//            } else if ($minCount == 6) {
//                $oddsValue = $odds_NI['h2'];
//            } else if ($minCount == 7) {
//                $oddsValue = $odds_NI['h3'];
//            } else if ($minCount == 8) {
//                $oddsValue = $odds_NI['h4'];
//            } else if ($minCount == 9) {
//                $oddsValue = $odds_NI['h5'];
//            } else if ($minCount == 10) {
//                $oddsValue = $odds_NI['h6'];
//            } else if ($minCount == 11) {
//                $oddsValue = $odds_NI['h7'];
//            } else if ($minCount == 12) {
//                $oddsValue = $odds_NI['h8'];
//            }
//
//            foreach ($totalArray as $key => $value) {
//                $goldArray[] = $bet_money_one;
//
//                $betInfoArray[] = $value;
//                $oddsArray[] = $oddsValue;
//                $bet_money_total = $bet_money_total + $bet_money_one;
//                $bet_win_total = $bet_win_total + ($bet_money_one * $oddsValue);
//            }
//            $niArray = explode(',', $totalArray[0]);
//        }
//        else if (($gid == 'LX') || ($gid == 'LF')) {//连肖
//            $odds_LX2 = SixLotteryOdds::getOdds('LX2');
//            $odds_LX3 = SixLotteryOdds::getOdds('LX3');
//            $odds_LX4 = SixLotteryOdds::getOdds('LX4');
//            $odds_LX5 = SixLotteryOdds::getOdds('LX5');
//            $odds_LF2 = SixLotteryOdds::getOdds('LF2');
//            $odds_LF3 = SixLotteryOdds::getOdds('LF3');
//            $odds_LF4 = SixLotteryOdds::getOdds('LF4');
//            $odds_LF5 = SixLotteryOdds::getOdds('LF5');
//            if(empty($postNews['oddsIndexArray'])){ $postNews['oddsIndexArray'] = 0;}
//            if(empty($postNews['lx_name'])){ $postNews['lx_name'] = 0;}
//            $totalArray = $postNews['totalArray'];
//
//            $oddsIndexArray = $postNews['oddsIndexArray'];
//            $bet_money_one = $postNews['gold'];
//            $lx_name = $postNews['lx_name'];
//            $rTypeName = $lx_name;
//            $goldArray = array();
//            $oddsArray = array();
//            $betInfoArray = array();
//            $minCount = count(explode(',', $totalArray[0]));
//            if ($gid == 'LX') {//连肖
//                if ($minCount == 2) { $odds_select = $odds_LX2;}
//                else if ($minCount == 3) { $odds_select = $odds_LX3;}
//                else if ($minCount == 4) { $odds_select = $odds_LX4;}
//                else if ($minCount == 5) { $odds_select = $odds_LX5;}
//            } else if ($gid == 'LF') {//连尾
//                if ($minCount == 2) { $odds_select = $odds_LF2;}
//                else if ($minCount == 3) { $odds_select = $odds_LF3;}
//                else if ($minCount == 4) { $odds_select = $odds_LF4;}
//                else if ($minCount == 5) { $odds_select = $odds_LF5;}
//            }
//            foreach ($totalArray as $key => $value) {
//                $goldArray[] = $bet_money_one;
//                $betInfoArray[] = $value;
//
//                $oddsArray[] = $odds_select['h' . $oddsIndexArray[$key]];
//                $bet_money_total = $bet_money_total + $bet_money_one;
//                $bet_win_total = $bet_win_total + ($bet_money_one * $odds_select['h' . $oddsIndexArray[$key]]);
//            }
//        }
//        else if ($gid == 'NX') {//合肖
//            $odds_NX = SixLotteryOdds::getOdds('NX');
//            $number_nx = $postNews['num'];
//            $select_count_nx = count(explode(',', $number_nx));
//            $bet_money_one = $goldArray;
//            $betInfo_one = $number_nx;
//            $bet_rate_one = $odds_NX['h' . $select_count_nx];
//            $bet_money_total = $bet_money_one;
//            $bet_win_total = $bet_rate_one * $bet_money_total;
//        }
//        else {
//
//            foreach ($goldArray as $key => $value) {
//                if (intval($goldArray[$key]) < 0 ) {
//                    echo('输入金额为负数或者不大于0，请重新下注。');
//                    exit;
//                }
//                if(intval($goldArray[$key])>0){
//                    if(intval($goldArray[$key])<$lowestMoney ){
//                        echo('单笔投注金额受!');
//                        exit;
//                    }
//                }
//                if ($goldArray[$key]) {
//                    $bet_money_total = $bet_money_total + $goldArray[$key];
//                    $bet_win_total = $bet_win_total + ($goldArray[$key] * $oddsArray[$key]);
//                    $betInfoArray[$key] = $common->getBetInfo($key, $gid);
//                }
//            }
//            if (intval($rs_user['money']) > 0) {
//                $assets = round($rs_user['money'], 2);
//                $balance = $assets - $bet_money_total;
//            }
//            $max_money = UserList::getMaxMoney($userid);
//            if(!SixLotteryOrder::getMaxMoneyAlready_lhc($userid, $qishu)){$max_money_already=0;
//            }else{
//                $max_money_already = SixLotteryOrder::getMaxMoneyAlready_lhc($userid, $qishu);
//            }
//            if ((0 < $max_money) && ($max_money < ($max_money_already[0]['total_money'] + $bet_money_total))) {
//                echo '超过当期下注最大金额，请联系管理人员。';
//                exit();
//            }
//        }
//        $this->_AddSixOrder($userid, $rTypeName, $rType, $qishu, $bet_money_total, $balance, $bet_win_total,
//            $assets, $goldArray, $oddsArray, $betInfoArray, $gid, $bet_money_one, $betInfo_one, $bet_rate_one);
//    }
//
//    /**
//     * 数据处理
//     * @param type $getNews     ajax提交过来的数据包
//     * @return type
//     */
//    private function _getTypeSP($getNews) {
//        $rtype = $getNews['rtype'];
//        $rTypeN = '';
//        $showTableN = '';
//        $odds_SP = array();
//        $odds_SP_other = array();
//        if(!empty($getNews['rtypeN'])){$rTypeN = $getNews['rtypeN'];}
//        if(!empty($getNews['showTableN'])){$showTableN = $getNews['showTableN'];}
//        $commonfc = new CommonFc;
//        //北京时间
//        $bj_time_now = date("Y-m-d H:i:s", time());
//        $announcement = SysAnnouncement::getOneAnnouncement();
//        $kjresult = LotteryResultLhc::getSixResult(' ORDER BY qishu DESC limit 0,10');//近十期开奖结果
//        $row = SixLotterySchedule::getNewestLottery();                          //返回开盘信息
//
//        if(!$row){   //还未开盘
//            $qishu = -1;
//            $fengpanTime = -1;
//            $kaijiangTime = -1;
//            $is_close = 'true';
//            $is_close_no_game = 'true';
//            $kjresultstr=json_encode($kjresult);
//            echo '' . "\r\n" . '    { "isCloseAdmin":"true","Msg":"' . $announcement . '", "reason":"目前没有开盘，请咨询客服人员。","kjresult":'.$kjresultstr.'}' . "\r\n" . '    ';
//            exit();
//
//        }else{
//            $qishu=$row['qishu'];
//            $fengpanTime = strtotime($row['fenpan_time']);                          //封盘时间
//            $kaijiangTime = strtotime($row['kaijiang_time']);                         //开盘时间;
//        }
//        $differTime = $fengpanTime - strtotime($bj_time_now);
//        //显示开奖结果
//        if ((date('Y-m-d H:i:s', $fengpanTime) <= $bj_time_now) && ($bj_time_now <= date('Y-m-d H:i:s', $kaijiangTime)))
//        {
//            $is_close = 'true';
//            $row=LotteryResultLhc::getSixResultByQishu($qishu);
//            $ball_count = 0;
//            $result = '';
//            $animal = '';
//            if ($row){
//                if ($row['ball_1'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_1'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_1'], $kaijiangTime). '",';
//                }
//                if ($row['ball_2'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_2'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_2'], $kaijiangTime) . '",';
//                }
//                if ($row['ball_3'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_3'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_3'],$kaijiangTime) . '",';
//                }
//                if ($row['ball_4'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_4'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_4'], $kaijiangTime) . '",';
//                }
//                if ($row['ball_5'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_5'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_5'],$kaijiangTime) . '",';
//                }
//                if ($row['ball_6'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_6'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_6'],$kaijiangTime) . '",';
//                }
//                if ($row['ball_7'])
//                {
//                    $ball_count += 1;
//                    $result .= '"' . $row['ball_7'] . '",';
//                    $animal .= '"' . $commonfc->numToAnimal($row['ball_7'], $kaijiangTime) . '",';
//                }
//            }
//            if (0 < $ball_count)
//            {
//                $result = substr($result, 0, -1);
//                $animal = substr($animal, 0, -1);
//            }
//            $kjresultstr=json_encode($kjresult);
//            echo '{"BetLineD":"N","gID":null,"Line_M":"4","result":[' . $result . '],"resultAN":[' . $animal . '],"lenb":' . $ball_count . ',"stopTime":0,"stopTime2":null,"stopTime3":null,"CloseTime":{"1":' . $differTime . ',"2":' . $differTime . ',"3":' . ($differTime - 180) . '},"gNum":"","gTime":"","Msg":"' . $announcement . '","num":0,"HKtime":"' . $bj_time_now . '","timezone":"\\u7f8e\\u6771","iTime":' . time() . ',"kjresult":'.$kjresultstr.'}';
//            exit();
//
//        }
//
//
//        if ($rtype == "SP") {//特别号 A面
//            $odds_SP = SixLotteryOdds::getOddsByBallType('SP', 'a_side');
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            $res = array('BetLineD' => 'N', 'sTime' => $fengpanTime,'other_close' => '0', 'gID' => 'SP','Line_M' => '4',
//                'SP01' => $odds_SP['h1'], 'SP02' => $odds_SP['h2'], 'SP03' => $odds_SP['h3'], 'SP04' => $odds_SP['h4'], 'SP05' => $odds_SP['h5'], 'SP06' => $odds_SP['h6'],
//                'SP07' => $odds_SP['h7'], 'SP08' => $odds_SP['h8'], 'SP09' => $odds_SP['h9'], 'SP10' => $odds_SP['h10'], 'SP11' => $odds_SP['h11'], 'SP12' => $odds_SP['h12'],
//                'SP13' => $odds_SP['h13'], 'SP14' => $odds_SP['h14'], 'SP15' => $odds_SP['h15'], 'SP16' => $odds_SP['h16'], 'SP17' => $odds_SP['h17'], 'SP18' => $odds_SP['h18'],
//                'SP19' => $odds_SP['h19'], 'SP20' => $odds_SP['h20'], 'SP21' => $odds_SP['h21'], 'SP22' => $odds_SP['h22'], 'SP23' => $odds_SP['h23'], 'SP24' => $odds_SP['h24'],
//                'SP25' => $odds_SP['h25'], 'SP26' => $odds_SP['h26'], 'SP27' => $odds_SP['h27'], 'SP28' => $odds_SP['h28'], 'SP29' => $odds_SP['h29'], 'SP30' => $odds_SP['h30'],
//                'SP31' => $odds_SP['h31'], 'SP32' => $odds_SP['h32'], 'SP33' => $odds_SP['h33'], 'SP34' => $odds_SP['h34'], 'SP35' => $odds_SP['h35'], 'SP36' => $odds_SP['h36'],
//                'SP37' => $odds_SP['h37'], 'SP38' => $odds_SP['h38'], 'SP39' => $odds_SP['h39'], 'SP40' => $odds_SP['h40'], 'SP41' => $odds_SP['h41'], 'SP42' => $odds_SP['h42'],
//                'SP43' => $odds_SP['h43'], 'SP44' => $odds_SP['h44'], 'SP45' => $odds_SP['h45'], 'SP46' => $odds_SP['h46'], 'SP47' => $odds_SP['h47'], 'SP48' => $odds_SP['h48'],
//                'SP49' => $odds_SP['h49'],
//                'wtype' => 'SP',
//                'SP_ODD' => $odds_SP_other['h1'], 'SP_EVEN' => $odds_SP_other['h2'], 'SP_OVER' => $odds_SP_other['h3'],  'SP_UNDER' => $odds_SP_other['h4'],
//                'SP_SODD' => $odds_SP_other['h5'],  'SP_SEVEN' => $odds_SP_other['h6'], 'SP_SOVER' => $odds_SP_other['h7'], 'SP_SUNDER' => $odds_SP_other['h8'],
//                'HS_OO' => $odds_SP_other['h14'],  'HS_OU' => $odds_SP_other['h15'], 'HS_EO' => $odds_SP_other['h16'],  'HS_EU' => $odds_SP_other['h17'],
//                'SF_OVER' => $odds_SP_other['h9'],  'SF_UNDER' => $odds_SP_other['h10'], 'SP_R' => $odds_SP_other['h11'],  'SP_G' => $odds_SP_other['h12'],
//                'SP_B' => $odds_SP_other['h13'],
//                'result' => '[]', 'resultAN' => null, 'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4',  'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'],  'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult,
//                'kaijiangTime'=>$kaijiangTime
//            );
//        }
//        else if ($rtype == 'SPbside') {//特别号B面
//            $odds_SP = SixLotteryOdds::getOdds('SP');
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            $res = array('BetLineD' => 'N', 'sTime' => $fengpanTime, 'other_close' => '0', 'gID' => 'SPbside', 'Line_M' => '4',
//                'SP01' => $odds_SP['h1'], 'SP02' => $odds_SP['h2'], 'SP03' => $odds_SP['h3'], 'SP04' => $odds_SP['h4'], 'SP05' => $odds_SP['h5'], 'SP06' => $odds_SP['h6'],
//                'SP07' => $odds_SP['h7'], 'SP08' => $odds_SP['h8'], 'SP09' => $odds_SP['h9'], 'SP10' => $odds_SP['h10'], 'SP11' => $odds_SP['h11'], 'SP12' => $odds_SP['h12'],
//                'SP13' => $odds_SP['h13'], 'SP14' => $odds_SP['h14'], 'SP15' => $odds_SP['h15'], 'SP16' => $odds_SP['h16'], 'SP17' => $odds_SP['h17'], 'SP18' => $odds_SP['h18'],
//                'SP19' => $odds_SP['h19'], 'SP20' => $odds_SP['h20'], 'SP21' => $odds_SP['h21'], 'SP22' => $odds_SP['h22'], 'SP23' => $odds_SP['h23'], 'SP24' => $odds_SP['h24'],
//                'SP25' => $odds_SP['h25'], 'SP26' => $odds_SP['h26'], 'SP27' => $odds_SP['h27'], 'SP28' => $odds_SP['h28'], 'SP29' => $odds_SP['h29'], 'SP30' => $odds_SP['h30'],
//                'SP31' => $odds_SP['h31'], 'SP32' => $odds_SP['h32'], 'SP33' => $odds_SP['h33'], 'SP34' => $odds_SP['h34'], 'SP35' => $odds_SP['h35'], 'SP36' => $odds_SP['h36'],
//                'SP37' => $odds_SP['h37'], 'SP38' => $odds_SP['h38'], 'SP39' => $odds_SP['h39'], 'SP40' => $odds_SP['h40'], 'SP41' => $odds_SP['h41'], 'SP42' => $odds_SP['h42'],
//                'SP43' => $odds_SP['h43'], 'SP44' => $odds_SP['h44'], 'SP45' => $odds_SP['h45'], 'SP46' => $odds_SP['h46'], 'SP47' => $odds_SP['h47'], 'SP48' => $odds_SP['h48'],
//                'SP49' => $odds_SP['h49'],
//                'wtype' => 'SP',
//                'SP_ODD' => $odds_SP_other['h1'],  'SP_EVEN' => $odds_SP_other['h2'], 'SP_OVER' => $odds_SP_other['h3'], 'SP_UNDER' => $odds_SP_other['h4'],
//                'SP_SODD' => $odds_SP_other['h5'],  'SP_SEVEN' => $odds_SP_other['h6'],  'SP_SOVER' => $odds_SP_other['h7'],  'SP_SUNDER' => $odds_SP_other['h8'],
//                'HS_OO' => $odds_SP_other['h14'],  'HS_OU' => $odds_SP_other['h15'], 'HS_EO' => $odds_SP_other['h16'], 'HS_EU' => $odds_SP_other['h17'],
//                'SF_OVER' => $odds_SP_other['h9'],  'SF_UNDER' => $odds_SP_other['h10'], 'SP_R' => $odds_SP_other['h11'],  'SP_G' => $odds_SP_other['h12'],
//                'SP_B' => $odds_SP_other['h13'],
//                'result' => '[]',  'resultAN' => null, 'lenb' => 0,  'stopTime' => 4, 'stopTime2' => '4',   'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                              //特别号B面
//        else if ($rtype == 'OEOU') {//两面
//            $odds1_other = SixLotteryOdds::getOddsByBallType('N1', 'other');
//            $odds2_other = SixLotteryOdds::getOddsByBallType('N2', 'other');
//            $odds3_other = SixLotteryOdds::getOddsByBallType('N3', 'other');
//            $odds4_other = SixLotteryOdds::getOddsByBallType('N4', 'other');
//            $odds5_other = SixLotteryOdds::getOddsByBallType('N5', 'other');
//            $odds6_other = SixLotteryOdds::getOddsByBallType('N6', 'other');
//            $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            $res = array(  'BetLineD' => 'N', 'sTime' => $fengpanTime,  'other_close' => 0, 'gID' => 'OEOU',
//                'SP_ODD' => $odds_SP_other['h1'], 'SP_EVEN' => $odds_SP_other['h2'], 'SP_OVER' => $odds_SP_other['h3'], 'SP_UNDER' => $odds_SP_other['h4'],
//                'SP_SODD' => $odds_SP_other['h5'], 'SP_SEVEN' => $odds_SP_other['h6'], 'SP_SOVER' => $odds_SP_other['h7'], 'SP_SUNDER' => $odds_SP_other['h8'],
//                'HS_OO' => 0.02, 'HS_OU' => 0.02,
//                'NO1_ODD' => $odds1_other['h1'], 'NO2_ODD' => $odds2_other['h1'], 'NO3_ODD' => $odds3_other['h1'],
//                'NO4_ODD' => $odds4_other['h1'], 'NO5_ODD' => $odds5_other['h1'], 'NO6_ODD' => $odds6_other['h1'],
//                'NO1_EVEN' => $odds1_other['h2'], 'NO2_EVEN' => $odds2_other['h2'], 'NO3_EVEN' => $odds3_other['h2'],
//                'NO4_EVEN' => $odds4_other['h2'], 'NO5_EVEN' => $odds5_other['h2'], 'NO6_EVEN' => $odds6_other['h2'],
//                'NO1_OVER' => $odds1_other['h3'], 'NO2_OVER' => $odds2_other['h3'], 'NO3_OVER' => $odds3_other['h3'],
//                'NO4_OVER' => $odds4_other['h3'], 'NO5_OVER' => $odds5_other['h3'], 'NO6_OVER' => $odds6_other['h3'],
//                'NO1_UNDER' => $odds1_other['h4'], 'NO2_UNDER' => $odds2_other['h4'], 'NO3_UNDER' => $odds3_other['h4'],
//                'NO4_UNDER' => $odds4_other['h4'], 'NO5_UNDER' => $odds5_other['h4'], 'NO6_UNDER' => $odds6_other['h4'],
//                'NO1_SODD' => $odds1_other['h5'], 'NO2_SODD' => $odds2_other['h5'], 'NO3_SODD' => $odds3_other['h5'],
//                'NO4_SODD' => $odds4_other['h5'], 'NO5_SODD' => $odds5_other['h5'], 'NO6_SODD' => $odds6_other['h5'],
//                'NO1_SEVEN' => $odds1_other['h6'], 'NO2_SEVEN' => $odds2_other['h6'], 'NO3_SEVEN' => $odds3_other['h6'],
//                'NO4_SEVEN' => $odds4_other['h6'], 'NO5_SEVEN' => $odds5_other['h6'], 'NO6_SEVEN' => $odds6_other['h6'],
//                'NO1_SOVER' => $odds1_other['h7'], 'NO2_SOVER' => $odds2_other['h7'], 'NO3_SOVER' => $odds3_other['h7'],
//                'NO4_SOVER' => $odds4_other['h7'], 'NO5_SOVER' => $odds5_other['h7'], 'NO6_SOVER' => $odds6_other['h7'],
//                'NO1_SUNDER' => $odds1_other['h8'], 'NO2_SUNDER' => $odds2_other['h8'], 'NO3_SUNDER' => $odds3_other['h8'],
//                'NO4_SUNDER' => $odds4_other['h8'], 'NO5_SUNDER' => $odds5_other['h8'], 'NO6_SUNDER' => $odds6_other['h8'],
//                'wtype' => 'NA',
//                'somebady0' => 0,'somebady1' => 0,'somebady2' => 0,'somebady3' => 0,
//                'NA_ODD' => $odds_NA_other['h1'], 'NA_EVEN' => $odds_NA_other['h2'], 'NA_OVER' => $odds_NA_other['h3'], 'NA_UNDER' => $odds_NA_other['h4'],
//                'result' => '[]', 'resultAN' => null,
//                'lenb' => 0, 'stopTime' => 4, 'stopTime2' => '4', 'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                 //两面
//        else if ($rtype == 'NA') {//正码
//            $odds_NA =  SixLotteryOdds::getOdds('NA');
//            $odds_NA_other = SixLotteryOdds::getOddsByBallType('NA', 'other');
//            $res = array(
//                'BetLineD' => 'N', 'sTime' => $fengpanTime, 'other_close' => 0,  'gID' => 'NA',
//                'NA01' => $odds_NA['h1'], 'NA02' => $odds_NA['h2'],  'NA03' => $odds_NA['h3'], 'NA04' => $odds_NA['h4'],  'NA05' => $odds_NA['h5'],  'NA06' => $odds_NA['h6'],
//                'NA07' => $odds_NA['h7'], 'NA08' => $odds_NA['h8'],  'NA09' => $odds_NA['h9'], 'NA10' => $odds_NA['h10'], 'NA11' => $odds_NA['h11'],  'NA12' => $odds_NA['h12'],
//                'NA13' => $odds_NA['h13'], 'NA14' => $odds_NA['h14'], 'NA15' => $odds_NA['h15'], 'NA16' => $odds_NA['h16'], 'NA17' => $odds_NA['h17'], 'NA18' => $odds_NA['h18'],
//                'NA19' => $odds_NA['h19'], 'NA20' => $odds_NA['h20'], 'NA21' => $odds_NA['h21'], 'NA22' => $odds_NA['h22'], 'NA23' => $odds_NA['h23'], 'NA24' => $odds_NA['h24'],
//                'NA25' => $odds_NA['h25'], 'NA26' => $odds_NA['h26'], 'NA27' => $odds_NA['h27'], 'NA28' => $odds_NA['h28'], 'NA29' => $odds_NA['h29'], 'NA30' => $odds_NA['h30'],
//                'NA31' => $odds_NA['h31'], 'NA32' => $odds_NA['h32'], 'NA33' => $odds_NA['h33'],  'NA34' => $odds_NA['h34'], 'NA35' => $odds_NA['h35'], 'NA36' => $odds_NA['h36'],
//                'NA37' => $odds_NA['h37'], 'NA38' => $odds_NA['h38'], 'NA39' => $odds_NA['h39'], 'NA40' => $odds_NA['h40'],  'NA41' => $odds_NA['h41'], 'NA42' => $odds_NA['h42'],
//                'NA43' => $odds_NA['h43'], 'NA44' => $odds_NA['h44'], 'NA45' => $odds_NA['h45'], 'NA46' => $odds_NA['h46'], 'NA47' => $odds_NA['h47'], 'NA48' => $odds_NA['h48'],
//                'NA49' => $odds_NA['h49'],
//                'wtype' => 'NA',
//                'NA_ODD' => $odds_NA_other['h1'], 'NA_EVEN' => $odds_NA_other['h2'],  'NA_OVER' => $odds_NA_other['h3'],  'NA_UNDER' => $odds_NA_other['h4'],
//                'result' => '[]',  'resultAN' => null, 'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4',  'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                   //正码
//        else if ($rtype == 'NAS') {//正马特
//            $oddsN = SixLotteryOdds::getOdds($rTypeN);
//            $res = array(  "BetLineD" => "N", "sTime" => $fengpanTime, "gID" => " $rTypeN ",
//                $rTypeN . "01" => $oddsN['h1'],  $rTypeN . "02" => $oddsN['h2'], $rTypeN . "03" => $oddsN['h3'],  $rTypeN . "04" => $oddsN['h4'],  $rTypeN . "05" => $oddsN['h5'],
//                $rTypeN . "06" => $oddsN['h6'],  $rTypeN . "07" => $oddsN['h7'], $rTypeN . "08" => $oddsN['h8'],  $rTypeN . "09" => $oddsN['h9'],  $rTypeN . "10" => $oddsN['h10'],
//                $rTypeN . "11" => $oddsN['h11'], $rTypeN . "12" => $oddsN['h12'],  $rTypeN . "13" => $oddsN['h13'], $rTypeN . "14" => $oddsN['h14'], $rTypeN . "15" => $oddsN['h15'],
//                $rTypeN . "16" => $oddsN['h16'],  $rTypeN . "17" => $oddsN['h17'], $rTypeN . "18" => $oddsN['h18'],  $rTypeN . "19" => $oddsN['h19'],  $rTypeN . "20" => $oddsN['h20'],
//                $rTypeN . "21" => $oddsN['h21'],  $rTypeN . "22" => $oddsN['h22'],  $rTypeN . "23" => $oddsN['h23'],  $rTypeN . "24" => $oddsN['h24'],  $rTypeN . "25" => $oddsN['h25'],
//                $rTypeN . "26" => $oddsN['h26'],  $rTypeN . "27" => $oddsN['h27'], $rTypeN . "28" => $oddsN['h28'],  $rTypeN . "29" => $oddsN['h29'],  $rTypeN . "30" => $oddsN['h30'],
//                $rTypeN . "31" => $oddsN['h31'],  $rTypeN . "32" => $oddsN['h32'],   $rTypeN . "33" => $oddsN['h33'],  $rTypeN . "34" => $oddsN['h34'], $rTypeN . "35" => $oddsN['h35'],
//                $rTypeN . "36" => $oddsN['h36'],  $rTypeN . "37" => $oddsN['h37'], $rTypeN . "38" => $oddsN['h38'],  $rTypeN . "39" => $oddsN['h39'],  $rTypeN . "40" => $oddsN['h40'],
//                $rTypeN . "41" => $oddsN['h41'],  $rTypeN . "42" => $oddsN['h42'],  $rTypeN . "43" => $oddsN['h43'],  $rTypeN . "44" => $oddsN['h44'],  $rTypeN . "45" => $oddsN['h45'],
//                $rTypeN . "46" => $oddsN['h46'],  $rTypeN . "47" => $oddsN['h47'], $rTypeN . "48" => $oddsN['h48'], $rTypeN . "49" => $oddsN['h49'],
//                'result' => '[]',  'resultAN' => null,  'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                  //正马特
//        else if ($rtype == 'NO') {//正码1-6
//            $odds1_other = SixLotteryOdds::getOddsByBallType('N1', 'other');
//            $odds2_other = SixLotteryOdds::getOddsByBallType('N2', 'other');
//            $odds3_other = SixLotteryOdds::getOddsByBallType('N3', 'other');
//            $odds4_other = SixLotteryOdds::getOddsByBallType('N4', 'other');
//            $odds5_other = SixLotteryOdds::getOddsByBallType('N5', 'other');
//            $odds6_other = SixLotteryOdds::getOddsByBallType('N6', 'other');
//            $res = array("BetLineD" => "N",  "sTime" => $fengpanTime, "other_close" => "0", "gID" => "NO",
//                "NO1_ODD" => $odds1_other['h1'], "NO2_ODD" => $odds2_other['h1'], "NO3_ODD" => $odds3_other['h1'], "NO4_ODD" => $odds4_other['h1'],
//                "NO5_ODD" => $odds5_other['h1'],"NO6_ODD" => $odds6_other['h1'],
//                "NO1_EVEN" => $odds1_other['h2'], "NO2_EVEN" => $odds2_other['h2'], "NO3_EVEN" => $odds3_other['h2'],  "NO4_EVEN" => $odds4_other['h2'],
//                "NO5_EVEN" => $odds5_other['h2'], "NO6_EVEN" => $odds6_other['h2'],
//                "NO1_OVER" => $odds1_other['h3'],  "NO2_OVER" => $odds2_other['h3'],  "NO3_OVER" => $odds3_other['h3'],  "NO4_OVER" => $odds4_other['h3'],
//                "NO5_OVER" => $odds5_other['h3'],"NO6_OVER" => $odds6_other['h3'],
//                "NO1_UNDER" => $odds1_other['h4'], "NO2_UNDER" => $odds2_other['h4'], "NO3_UNDER" => $odds3_other['h4'], "NO4_UNDER" => $odds4_other['h4'],
//                "NO5_UNDER" => $odds5_other['h4'],  "NO6_UNDER" => $odds6_other['h4'],
//                "NO1_SODD" => $odds1_other['h5'],  "NO2_SODD" => $odds2_other['h5'],  "NO3_SODD" => $odds3_other['h5'],  "NO4_SODD" => $odds4_other['h5'],
//                "NO5_SODD" => $odds5_other['h5'], "NO6_SODD" => $odds6_other['h5'],
//                "NO1_SEVEN" => $odds1_other['h6'],"NO2_SEVEN" => $odds2_other['h6'], "NO3_SEVEN" => $odds3_other['h6'],  "NO4_SEVEN" => $odds4_other['h6'],
//                "NO5_SEVEN" => $odds5_other['h6'], "NO6_SEVEN" => $odds6_other['h6'],
//                "NO1_SOVER" => $odds1_other['h7'], "NO2_SOVER" => $odds2_other['h7'],  "NO3_SOVER" => $odds3_other['h7'], "NO4_SOVER" => $odds4_other['h7'],
//                "NO5_SOVER" => $odds5_other['h7'],  "NO6_SOVER" => $odds6_other['h7'],
//                "NO1_SUNDER" => $odds1_other['h8'], "NO2_SUNDER" => $odds2_other['h8'], "NO3_SUNDER" => $odds3_other['h8'],  "NO4_SUNDER" => $odds4_other['h8'],
//                "NO5_SUNDER" => $odds5_other['h8'],  "NO6_SUNDER" => $odds6_other['h8'],
//                "NO1_FOVER" => $odds1_other['h9'],  "NO2_FOVER" => $odds2_other['h9'],  "NO3_FOVER" => $odds3_other['h9'],  "NO4_FOVER" => $odds4_other['h9'],
//                "NO5_FOVER" => $odds5_other['h9'], "NO6_FOVER" => $odds6_other['h9'],
//                "NO1_FUNDER" => $odds1_other['h10'], "NO2_FUNDER" => $odds2_other['h10'], "NO3_FUNDER" => $odds3_other['h10'],  "NO4_FUNDER" => $odds4_other['h10'],
//                "NO5_FUNDER" => $odds5_other['h10'],  "NO6_FUNDER" => $odds6_other['h10'],
//                "NO1_R" => $odds1_other['h11'],  "NO2_R" => $odds2_other['h11'],  "NO3_R" => $odds3_other['h11'],  "NO4_R" => $odds4_other['h11'],
//                "NO5_R" => $odds5_other['h11'],  "NO6_R" => $odds6_other['h11'],
//                "NO1_G" => $odds1_other['h12'],  "NO2_G" => $odds2_other['h12'],  "NO3_G" => $odds3_other['h12'],  "NO4_G" => $odds4_other['h12'],
//                "NO5_G" => $odds5_other['h12'], "NO6_G" => $odds6_other['h12'],
//                "NO1_B" => $odds1_other['h13'],  "NO2_B" => $odds2_other['h13'],  "NO3_B" => $odds3_other['h13'], "NO4_B" => $odds4_other['h13'],
//                "NO5_B" => $odds5_other['h13'],  "NO6_B" => $odds6_other['h13'],
//                'result' => '[]', 'resultAN' => null, 'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4',  'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }
//        else if($rtype == 'NAP'){//正码过关
//            $odds_NAP1 = SixLotteryOdds::getOdds("NAP1");
//            $odds_NAP2 = SixLotteryOdds::getOdds("NAP2");
//            $odds_NAP3 = SixLotteryOdds::getOdds("NAP3");
//            $odds_NAP4 = SixLotteryOdds::getOdds("NAP4");
//            $odds_NAP5 = SixLotteryOdds::getOdds("NAP5");
//            $odds_NAP6 = SixLotteryOdds::getOdds("NAP6");
//            $res=array(
//                "BetLineD" => "N",
//                "sTime" => $fengpanTime,
//                "other_close" => "0",
//                "gID" => "SPA",
//                "show_table_n" => $showTableN,
//                'NAP1_h1'=>$odds_NAP1['h1'],
//                "NAP1_h2"=>$odds_NAP1['h2'],
//                "NAP1_h3"=>$odds_NAP1['h3'],
//                "NAP1_h4"=>$odds_NAP1['h4'],
//                "NAP1_h5"=>$odds_NAP1['h5'],
//                "NAP1_h6"=>$odds_NAP1['h6'],
//                "NAP1_h7"=>$odds_NAP1['h7'],
//                "NAP1_h8"=>$odds_NAP1['h8'],
//                "NAP1_h9"=>$odds_NAP1['h9'],
//                "NAP1_h10"=>$odds_NAP1['h10'],
//                "NAP1_h11"=>$odds_NAP1['h11'],
//                "NAP1_h12"=>$odds_NAP1['h12'],
//                "NAP1_h13"=>$odds_NAP1['h13'],
//                'NAP2_h1'=>$odds_NAP2['h1'],
//                "NAP2_h2"=>$odds_NAP2['h2'],
//                "NAP2_h3"=>$odds_NAP2['h3'],
//                "NAP2_h4"=>$odds_NAP2['h4'],
//                "NAP2_h5"=>$odds_NAP2['h5'],
//                "NAP2_h6"=>$odds_NAP2['h6'],
//                "NAP2_h7"=>$odds_NAP2['h7'],
//                "NAP2_h8"=>$odds_NAP2['h8'],
//                "NAP2_h9"=>$odds_NAP2['h9'],
//                "NAP2_h10"=>$odds_NAP2['h10'],
//                "NAP2_h11"=>$odds_NAP2['h11'],
//                "NAP2_h12"=>$odds_NAP2['h12'],
//                "NAP2_h13"=>$odds_NAP2['h13'],
//                'NAP3_h1'=>$odds_NAP3['h1'],
//                "NAP3_h2"=>$odds_NAP3['h2'],
//                "NAP3_h3"=>$odds_NAP3['h3'],
//                "NAP3_h4"=>$odds_NAP3['h4'],
//                "NAP3_h5"=>$odds_NAP3['h5'],
//                "NAP3_h6"=>$odds_NAP3['h6'],
//                "NAP3_h7"=>$odds_NAP3['h7'],
//                "NAP3_h8"=>$odds_NAP3['h8'],
//                "NAP3_h9"=>$odds_NAP3['h9'],
//                "NAP3_h10"=>$odds_NAP3['h10'],
//                "NAP3_h11"=>$odds_NAP3['h11'],
//                "NAP3_h12"=>$odds_NAP3['h12'],
//                "NAP3_h13"=>$odds_NAP3['h13'],
//                'NAP4_h1'=>$odds_NAP4['h1'],
//                "NAP4_h2"=>$odds_NAP4['h2'],
//                "NAP4_h3"=>$odds_NAP4['h3'],
//                "NAP4_h4"=>$odds_NAP4['h4'],
//                "NAP4_h5"=>$odds_NAP4['h5'],
//                "NAP4_h6"=>$odds_NAP4['h6'],
//                "NAP4_h7"=>$odds_NAP4['h7'],
//                "NAP4_h8"=>$odds_NAP4['h8'],
//                "NAP4_h9"=>$odds_NAP4['h9'],
//                "NAP4_h10"=>$odds_NAP4['h10'],
//                "NAP4_h11"=>$odds_NAP4['h11'],
//                "NAP4_h12"=>$odds_NAP4['h12'],
//                "NAP4_h13"=>$odds_NAP4['h13'],
//                'NAP5_h1'=>$odds_NAP5['h1'],
//                "NAP5_h2"=>$odds_NAP5['h2'],
//                "NAP5_h3"=>$odds_NAP5['h3'],
//                "NAP5_h4"=>$odds_NAP5['h4'],
//                "NAP5_h5"=>$odds_NAP5['h5'],
//                "NAP5_h6"=>$odds_NAP5['h6'],
//                "NAP5_h7"=>$odds_NAP5['h7'],
//                "NAP5_h8"=>$odds_NAP5['h8'],
//                "NAP5_h9"=>$odds_NAP5['h9'],
//                "NAP5_h10"=>$odds_NAP5['h10'],
//                "NAP5_h11"=>$odds_NAP5['h11'],
//                "NAP5_h12"=>$odds_NAP5['h12'],
//                "NAP5_h13"=>$odds_NAP5['h13'],
//                'NAP6_h1'=>$odds_NAP6['h1'],
//                "NAP6_h2"=>$odds_NAP6['h2'],
//                "NAP6_h3"=>$odds_NAP6['h3'],
//                "NAP6_h4"=>$odds_NAP6['h4'],
//                "NAP6_h5"=>$odds_NAP6['h5'],
//                "NAP6_h6"=>$odds_NAP6['h6'],
//                "NAP6_h7"=>$odds_NAP6['h7'],
//                "NAP6_h8"=>$odds_NAP6['h8'],
//                "NAP6_h9"=>$odds_NAP6['h9'],
//                "NAP6_h10"=>$odds_NAP6['h10'],
//                "NAP6_h11"=>$odds_NAP6['h11'],
//                "NAP6_h12"=>$odds_NAP6['h12'],
//                "NAP6_h13"=>$odds_NAP6['h13'],
//                'result' => '[]',
//                'resultAN' => null,
//                'lenb' => 0,
//                'stopTime' => 4,
//                'stopTime2' => '4',
//                'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//
//
//            );
//
//        }
//        else if($rtype == 'CH'){//连码
//            $odds_CH = SixLotteryOdds::getOdds('CH');
//            $class=new Zodiac();
//            $zodiacArray = $class->getArr();
//            $res=array(
//                "BetLineD" => "N",
//                "sTime" => $fengpanTime,
//                "other_close" => "0",
//                "gID" => "SPA",
//                "show_table_n" => $showTableN,
//                'chodds_1'=>$odds_CH['h1'],
//                'chodds_2'=>$odds_CH['h2'],
//                'chodds_3'=>$odds_CH['h3'],
//                'chodds_4'=>$odds_CH['h4'],
//                'chodds_5'=>$odds_CH['h5'],
//                'chodds_6'=>$odds_CH['h6'],
//                'chodds_7'=>$odds_CH['h7'],
//                'chodds_8'=>$odds_CH['h8'],
//                'result' => '[]',
//                'resultAN' => null,
//                'lenb' => 0,
//                'stopTime' => 4,
//                'stopTime2' => '4',
//                'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//
//            );
//        }
//        else if($rtype == 'LX'){//连码、连肖
//            $zodiacArray = array('09, 21, 33, 45', '10, 22, 34, 46', '11, 23, 35, 47', '12, 24, 36, 48', '01, 13, 25, 37, 49',
//                '02, 14, 26, 38', '03, 15, 27, 39', '04, 16, 28, 40', '05, 17, 29, 41', '06, 18, 30, 42', '07, 19, 31, 43', '08, 20, 32, 44');
//            $odds_LX2 = SixLotteryOdds::getOdds("LX2");
//            $odds_LX3 = SixLotteryOdds::getOdds("LX3");
//            $odds_LX4 = SixLotteryOdds::getOdds("LX4");
//            $odds_LX5 = SixLotteryOdds::getOdds("LX5");
//            $odds_LF2 = SixLotteryOdds::getOdds("LF2");
//            $odds_LF3 = SixLotteryOdds::getOdds("LF3");
//            $odds_LF4 = SixLotteryOdds::getOdds("LF4");
//            $odds_LF5 = SixLotteryOdds::getOdds("LF5");
//            $class=new Zodiac();
//            $zodiacArray = $class->getArr();
//            $res=array(
//                "LX2_1"=>$odds_LX2['h1'],
//                "LX2_2"=>$odds_LX2['h2'],
//                "LX2_3"=>$odds_LX2['h3'],
//                "LX2_4"=>$odds_LX2['h4'],
//                "LX2_5"=>$odds_LX2['h5'],
//                "LX2_6"=>$odds_LX2['h6'],
//                "LX2_7"=>$odds_LX2['h7'],
//                "LX2_8"=>$odds_LX2['h8'],
//                "LX2_9"=>$odds_LX2['h9'],
//                "LX2_A"=>$odds_LX2['h10'],
//                "LX2_B"=>$odds_LX2['h11'],
//                "LX2_C"=>$odds_LX2['h12'],
//                "LF20"=>$odds_LF2['h1'],
//                "LF21"=>$odds_LF2['h2'],
//                "LF22"=>$odds_LF2['h3'],
//                "LF23"=>$odds_LF2['h4'],
//                "LF24"=>$odds_LF2['h5'],
//                "LF25"=>$odds_LF2['h6'],
//                "LF26"=>$odds_LF2['h7'],
//                "LF27"=>$odds_LF2['h8'],
//                "LF28"=>$odds_LF2['h9'],
//                "LF29"=>$odds_LF2['h10'],
//                "LF30"=>$odds_LF3['h1'],
//                "LF31"=>$odds_LF3['h2'],
//                "LF32"=>$odds_LF3['h3'],
//                "LF33"=>$odds_LF3['h4'],
//                "LF34"=>$odds_LF3['h5'],
//                "LF35"=>$odds_LF3['h6'],
//                "LF36"=>$odds_LF3['h7'],
//                "LF37"=>$odds_LF3['h8'],
//                "LF38"=>$odds_LF3['h9'],
//                "LF39"=>$odds_LF3['h10'],
//                "LF40"=>$odds_LF4['h1'],
//                "LF41"=>$odds_LF4['h2'],
//                "LF42"=>$odds_LF4['h3'],
//                "LF43"=>$odds_LF4['h4'],
//                "LF44"=>$odds_LF4['h5'],
//                "LF45"=>$odds_LF4['h6'],
//                "LF46"=>$odds_LF4['h7'],
//                "LF47"=>$odds_LF4['h8'],
//                "LF48"=>$odds_LF4['h9'],
//                "LF49"=>$odds_LF4['h10'],
//                "LF50"=>$odds_LF5['h1'],
//                "LF51"=>$odds_LF5['h2'],
//                "LF52"=>$odds_LF5['h3'],
//                "LF53"=>$odds_LF5['h4'],
//                "LF54"=>$odds_LF5['h5'],
//                "LF55"=>$odds_LF5['h6'],
//                "LF56"=>$odds_LF5['h7'],
//                "LF57"=>$odds_LF5['h8'],
//                "LF58"=>$odds_LF5['h9'],
//                "LF59"=>$odds_LF5['h10'],
//                "LX3_1"=>$odds_LX3['h1'],
//                "LX3_2"=>$odds_LX3['h2'],
//                "LX3_3"=>$odds_LX3['h3'],
//                "LX3_4"=>$odds_LX3['h4'],
//                "LX3_5"=>$odds_LX3['h5'],
//                "LX3_6"=>$odds_LX3['h6'],
//                "LX3_7"=>$odds_LX3['h7'],
//                "LX3_8"=>$odds_LX3['h8'],
//                "LX3_9"=>$odds_LX3['h9'],
//                "LX3_A"=>$odds_LX3['h10'],
//                "LX3_B"=>$odds_LX3['h11'],
//                "LX3_C"=>$odds_LX3['h12'],
//                "LX4_1"=>$odds_LX4['h1'],
//                "LX4_2"=>$odds_LX4['h2'],
//                "LX4_3"=>$odds_LX4['h3'],
//                "LX4_4"=>$odds_LX4['h4'],
//                "LX4_5"=>$odds_LX4['h5'],
//                "LX4_6"=>$odds_LX4['h6'],
//                "LX4_7"=>$odds_LX4['h7'],
//                "LX4_8"=>$odds_LX4['h8'],
//                "LX4_9"=>$odds_LX4['h9'],
//                "LX4_A"=>$odds_LX4['h10'],
//                "LX4_B"=>$odds_LX4['h11'],
//                "LX4_C"=>$odds_LX4['h12'],
//                "LX5_1"=>$odds_LX5['h1'],
//                "LX5_2"=>$odds_LX5['h2'],
//                "LX5_3"=>$odds_LX5['h3'],
//                "LX5_4"=>$odds_LX5['h4'],
//                "LX5_5"=>$odds_LX5['h5'],
//                "LX5_6"=>$odds_LX5['h6'],
//                "LX5_7"=>$odds_LX5['h7'],
//                "LX5_8"=>$odds_LX5['h8'],
//                "LX5_9"=>$odds_LX5['h9'],
//                "LX5_A"=>$odds_LX5['h10'],
//                "LX5_B"=>$odds_LX5['h11'],
//                "LX5_C"=>$odds_LX5['h12'],
//                "BetLineD" => "N",
//                "sTime" => $fengpanTime,
//                "other_close" => "0",
//                "gID" => "SPA",
//                'result' => '[]',
//                'resultAN' => null,
//                'lenb' => 0,
//                'stopTime' => 4,
//                'stopTime2' => '4',
//                'stopTime3' => '1',
//                'zodiacArray'=>$zodiacArray,
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//
//
//            );
//        }
//        else if ($rtype == 'NI') {//自选不中
//            $odds_NI = SixLotteryOdds::getOdds("NI");
//            $res = array(
//                "NI1"=>$odds_NI['h1'],
//                "NI2"=>$odds_NI['h2'],
//                "NI3"=>$odds_NI['h3'],
//                "NI4"=>$odds_NI['h4'],
//                "NI5"=>$odds_NI['h5'],
//                "NI6"=>$odds_NI['h6'],
//                "NI7"=>$odds_NI['h7'],
//                "NI8"=>$odds_NI['h8'],
//                "BetLineD" => "N",
//                "sTime" => $fengpanTime,
//                "other_close" => "0",
//                "gID" => "SPA",
//                'result' => '[]',
//                'resultAN' => null,
//                'lenb' => 0,
//                'stopTime' => 4,
//                'stopTime2' => '4',
//                'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }
//        else if ($rtype == 'NX') {//合肖
//            $odds_NX = SixLotteryOdds::getOdds("NX");
//            $class=new Zodiac();
//            $zodiacArray = $class->getArr();
//            $res = array(
//                "odds_NX1"=>$odds_NX['h1'],
//                "odds_NX2"=>$odds_NX['h2'],
//                "odds_NX3"=>$odds_NX['h3'],
//                "odds_NX4"=>$odds_NX['h4'],
//                "odds_NX5"=>$odds_NX['h5'],
//                "odds_NX6"=>$odds_NX['h6'],
//                "odds_NX7"=>$odds_NX['h7'],
//                "odds_NX8"=>$odds_NX['h8'],
//                "odds_NX9"=>$odds_NX['h9'],
//                "odds_NX10"=>$odds_NX['h10'],
//                "odds_NX11"=>$odds_NX['h11'],
//                "BetLineD" => "N",
//                "sTime" => $fengpanTime,
//                "other_close" => "0",
//                "gID" => "SPA",
//                'result' => '[]',
//                'resultAN' => null,
//                'lenb' => 0,
//                'stopTime' => 4,
//                'stopTime2' => '4',
//                'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))), 'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult,
//                'zodiacArray'=>$zodiacArray
//            );
//        }
//        //正码1-6
//        else if ($rtype == 'SPA') {//色波
//            $odds_SP_other = SixLotteryOdds::getOddsByBallType('SP', 'other');
//            $odds_SPA = SixLotteryOdds::getOdds('SPA');
//            $res = array(
//                "BetLineD" => "N", "sTime" => $fengpanTime,  "other_close" => "0",  "gID" => "SPA",  "show_table_n" => $showTableN,
//                "SP_A1" => $odds_SPA['h1'],  "SP_A2" => $odds_SPA['h2'],  "SP_A3" => $odds_SPA['h3'], "SP_A4" => $odds_SPA['h4'],  "SP_A5" => $odds_SPA['h5'],  "SP_A6" => $odds_SPA['h6'],
//                "SP_A7" => $odds_SPA['h7'],  "SP_A8" => $odds_SPA['h8'],  "SP_A9" => $odds_SPA['h9'],  "SP_AA" => $odds_SPA['h10'], "SP_AB" => $odds_SPA['h11'], "SP_AC" => $odds_SPA['h12'],
//                "SH0" => $odds_SPA['h13'], "SH1" => $odds_SPA['h14'], "SH2" => $odds_SPA['h15'], "SH3" => $odds_SPA['h16'], "SH4" => $odds_SPA['h17'],  "SF0" => $odds_SPA['h18'],
//                "SF1" => $odds_SPA['h19'], "SF2" => $odds_SPA['h20'], "SF3" => $odds_SPA['h21'], "SF4" => $odds_SPA['h22'],  "SF5" => $odds_SPA['h23'],  "SF6" => $odds_SPA['h24'],
//                "SF7" => $odds_SPA['h25'],  "SF8" => $odds_SPA['h26'],  "SF9" => $odds_SPA['h27'],
//                "SP_R" => $odds_SP_other['h11'],  "SP_G" => $odds_SP_other['h12'], "SP_B" => $odds_SP_other['h13'],
//                'result' => '[]', 'resultAN' => null,  'lenb' => 0, 'stopTime' => 4, 'stopTime2' => '4',  'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                  //色波
//        else if ($rtype == 'SPB') {//一肖 、平特尾数
//            $odds_SPB = SixLotteryOdds::getOdds('SPB');
//            $res = array( "BetLineD" => "N",  "sTime" => $fengpanTime,  "other_close" => "0","gID" => "SPB",  "show_table_n" => "$showTableN",
//                "SP_B1" => $odds_SPB['h1'],  "SP_B2" => $odds_SPB['h2'],  "SP_B3" => $odds_SPB['h3'], "SP_B4" => $odds_SPB['h4'], "SP_B5" => $odds_SPB['h5'],"SP_B6" => $odds_SPB['h6'],
//                "SP_B7" => $odds_SPB['h7'], "SP_B8" => $odds_SPB['h8'],  "SP_B9" => $odds_SPB['h9'], "SP_BA" => $odds_SPB['h10'], "SP_BB" => $odds_SPB['h11'], "SP_BC" => $odds_SPB['h12'],
//                "NF0" => $odds_SPB['h13'],"NF1" => $odds_SPB['h14'], "NF2" => $odds_SPB['h15'],  "NF3" => $odds_SPB['h16'], "NF4" => $odds_SPB['h17'], "NF5" => $odds_SPB['h18'],
//                "NF6" => $odds_SPB['h19'], "NF7" => $odds_SPB['h20'], "NF8" => $odds_SPB['h21'], "NF9" => $odds_SPB['h22'],
//                "TX2" => $odds_SPB['h23'],"TX5" => $odds_SPB['h24'],  "TX6" => $odds_SPB['h25'],"TX7" => $odds_SPB['h26'],  "TX_ODD" => $odds_SPB['h27'],"TX_EVEN" => $odds_SPB['h28'],
//                'result' => '[]', 'resultAN' => null,  'lenb' => 0, 'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                  //一肖 、平特尾数
//        else if ($rtype == 'HB') {//半波 ，半半波
//            $odds_HB = SixLotteryOdds::getOdds('HB');
//            $res = array(
//                "BetLineD" => "N", "sTime" => $fengpanTime, "other_close" => 0,  "gID" => "HB",  "show_table_n" => "$showTableN",
//                "HB_RODD" => $odds_HB['h1'],"HB_REVEN" => $odds_HB['h2'],"HB_ROVER" => $odds_HB['h3'],"HB_RUNDER" => $odds_HB['h4'], "HB_GODD" => $odds_HB['h5'],"HB_GEVEN" => $odds_HB['h6'],
//                "HB_GOVER" => $odds_HB['h7'],"HB_GUNDER" => $odds_HB['h8'], "HB_BODD" => $odds_HB['h9'], "HB_BEVEN" => $odds_HB['h10'],"HB_BOVER" => $odds_HB['h11'], "HB_BUNDER" => $odds_HB['h12'],
//                "HH_ROO" => $odds_HB['h13'], "HH_ROE" => $odds_HB['h14'],"HH_RUO" => $odds_HB['h15'], "HH_RUE" => $odds_HB['h16'], "HH_GOO" => $odds_HB['h17'], "HH_GOE" => $odds_HB['h18'],
//                "HH_GUO" => $odds_HB['h19'], "HH_GUE" => $odds_HB['h20'], "HH_BOO" => $odds_HB['h21'], "HH_BOE" => $odds_HB['h22'], "HH_BUO" => $odds_HB['h23'], "HH_BUE" => $odds_HB['h24'],
//                'result' => '[]',  'resultAN' => null, 'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                   //半波 ，半半波
//        else if ($rtype == 'C7') {//正肖  、七色波
//            $odds_C7 = SixLotteryOdds::getOdds('C7');
//            $res = array(
//                "BetLineD" => "N", "sTime" => $fengpanTime, "gID" => "C7",  "show_table_n" => "$showTableN",
//                "NA_A1" => $odds_C7['h1'],  "NA_A2" => $odds_C7['h2'],  "NA_A3" => $odds_C7['h3'],  "NA_A4" => $odds_C7['h4'],  "NA_A5" => $odds_C7['h5'],  "NA_A6" => $odds_C7['h6'],
//                "NA_A7" => $odds_C7['h7'], "NA_A8" => $odds_C7['h8'],  "NA_A9" => $odds_C7['h9'], "NA_AA" => $odds_C7['h10'],  "NA_AB" => $odds_C7['h11'], "NA_AC" => $odds_C7['h12'],
//                "C7_R" => $odds_C7['h13'], "C7_B" => $odds_C7['h14'], "C7_G" => $odds_C7['h15'],  "C7_N" => $odds_C7['h16'],
//                'result' => '[]', 'resultAN' => null, 'lenb' => 0, 'stopTime' => 4,  'stopTime2' => '4', 'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'], 'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }                                   //正肖  、七色波
//        else {
//            $res = array(
//                'BetLineD' => 'N','gID' => $rtype, 'result' => '[]',  'resultAN' => null,  'lenb' => 0,  'stopTime' => 4,  'stopTime2' => '4',  'stopTime3' => '1',
//                'CloseTime' => (array('1' => $differTime, '2' => $differTime, '3' => ($differTime - 180))),
//                'gNum' => $row['qishu'],  'gTime' => $row['fenpan_time'],
//                'Msg' => $announcement,
//                'kjresult'=>$kjresult
//            );
//        }
//        return $res;
//    }
//
//    /**
//     * 下注处理器
//     * @param type $userid              用户ID
//     * @param type $rtype_name          彩票类型名称
//     * @param string $rType             彩票类型缩写
//     * @param type $lottery_number      开奖期数
//     * @param type $bet_money_total     下注金额
//     * @param type $balance             下注后金额
//     * @param type $bet_win_total       最高可以赢的金额
//     * @param type $assets              用户可用金额
//     * @param type $goldArray           投注金额数组
//     * @param type $oddsArray           投注倍率数组
//     * @param type $betInfoArray        所选择下注的号码数组
//     * @param type $gid                 下注的彩票类型
//     * @param type $bet_money_one       可赢金额（NAP）
//     * @param type $betInfo_one         下注号码（NAP）
//     * @param type $bet_rate_one        下注倍率（NAP）
//     * @return boolean
//     */
//    private function _AddSixOrder($userid, $rtype_name, $rType, $lottery_number, $bet_money_total, $balance, $bet_win_total,
//                                  $assets, $goldArray, $oddsArray, $betInfoArray, $gid, $bet_money_one, $betInfo_one, $bet_rate_one){
//        $bet_info_sp = "";
//        $bet_money_total = abs($bet_money_total);
//        if ($gid === 'SPbside') {//特别号B面
//            $rType = 'SP';
//            $bet_info_sp = 'SPbside';
//        } else {
//            $bet_info_sp = 'bet_info';
//        }
//        $id = SixLotteryOrder::addSixOrder($userid, $rtype_name, $rType, $bet_info_sp, $bet_money_total, $bet_win_total, $lottery_number); //添加下注订单
//        if(!$id){
//            $rs = new CommonFc;
//            $rs->error2('添加订单失败。');
//            return false;
//        }
//        $datereg = date('YmdHis') . $id;
//        $user = UserList::getUserNewsByUserId($userid);                                             //查找用户信息
//        $assets = $user['money'];
//        $balance = $assets - $bet_money_total; //用户资产-投注金额
//        $r = UserList::UpdateUserMoney($balance, $bet_money_total, $userid);                        //更改用户金额
//        if($r != 1){
//            SixLotteryOrder::DelSixOrder($id);                                                      //更改失败删除订单，退出方法
//            $rs = new CommonFc;
//            $rs->error2('更新用户金额失败。');
//            return false;
//        }
//        $money_log_id = MoneyLog::updateUserMoneyForSix($userid, $datereg, $bet_money_total, $assets, $balance); //添加金额日志
//        if(!$money_log_id){
//            SixLotteryOrder::DelSixOrder($id);                                                      //更改失败删除订单，退出方法
//            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                  //用户金额还原
//            $rs = new CommonFc;
//            $rs->error2('更新流水失败。');
//            return false;
//        }
//        $r = SixLotteryOrder::addSixOrderOrderNumById($id,$datereg);                                    //更新插入订单的单号
//        if($r != 1){
//            SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
//            MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
//            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
//            $rs = new CommonFc;
//            $rs->error2('更新订单号失败。');
//            return false;
//        }
//        $groupid = $user['group_id'];
//        $fsRow = UserGroup::getUserGroupByUserId($groupid);                                         //查找用户组信息
//        if($gid == 'NAP'){//正码过关                                                                          //更新投注明细（下注类型等）
//            $bet_rate = $bet_rate_one;
//            $bet_info = $betInfo_one;
//            if ($fsRow['lhc_bet'] <= $bet_money_one) {                                              //六合彩投注最小金额
//                $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
//            }
//            $win_money = 0;
//            $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance);//添加下注明细
//            $datereg_sub = date('YmdHis') . $id_sub;
//            $r = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);                              //更新插入下注明显的子订单号
//            if(!$id_sub || !$r){
//                SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
//                SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
//                MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
//                UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
//                $rs = new CommonFc;
//                $rs->error2('更新子单失败。');
//                return false;
//            }
//        }elseif($gid == 'NX'){//合肖
//            $bet_rate = $bet_rate_one;
//            $bet_info = $betInfo_one;
//            $win_money = $bet_rate * $bet_money_one;
//            if ($fsRow['lhc_bet'] <= $bet_money_one) {
//                $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
//            }
//            $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance);
//            $datereg_sub = date('YmdHis') . $id_sub;
//            $r = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);                                 //更新插入下注明显的子订单号
//            if(!$id_sub || !$r){
//                SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
//                SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
//                MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
//                UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
//                $rs = new CommonFc;
//                $rs->error2('更新子单失败。');
//                return false;
//            }
//        } else{
//            //var_dump($goldArray);
//            foreach ($goldArray as $key => $value) {
//                $fs_money = 0;
//                $bet_money_one = $goldArray[$key];
//                $bet_rate = $oddsArray[$key];
//
//
//                if($goldArray[$key]){
//
//                    $bet_info = $betInfoArray[$key];
//                    $win_money = $bet_rate * $bet_money_one;
//                    if ($goldArray[$key]) {
//                        if ($fsRow['lhc_bet'] <= $bet_money_one) {
//                            $fs_money = $bet_money_one * $fsRow['lhc_bet_reb'];
//                            if (($gid == 'SPbside') && (0 < intval($bet_info))) {
//                                $fs_money = 0;
//                            }
//                        }
//                        if (($gid == 'SP') && (0 < intval($bet_info))) {
//                            $row_sp_fs = SixLotteryOdds::getSubTypeSPballtypeFS();
//                            if ($row_sp_fs['h1'] <= $bet_money_one) {
//                                $fs_money = $bet_money_one * $row_sp_fs['h2'];
//                            } else {
//                                $fs_money = 0;
//                            }
//                        }
//
//                        $id_sub = SixLotteryOrderSub::AddSixOrder($datereg, $bet_info, $bet_rate, $bet_money_one, $win_money, $fs_money, $balance);
//                        $datereg_sub = date('YmdHis') . $id_sub;
//                        $r = SixLotteryOrderSub::UpdateSixOrder($id_sub, $datereg_sub);
//                        if(!$id_sub || !$r){
//
//                            SixLotteryOrderSub::DelSixOrder($id_sub);                                                   //删除订单明细
//                            SixLotteryOrder::DelSixOrder($id);                                                          //删除订单
//                            MoneyLog::DelUserMoneyLogWhenAddSixOrderErr($money_log_id);                                 //删除金额日志
//                            UserList::updateUserMoneyWhenMoneyLogIsErr($bet_money_total, $userid);                      //还原金额
//                            $rs = new CommonFc;
//                            $rs->error2('更新子单失败。');
//                            return false;
//                        }
//                    }
//                }
//            }
//        }
//        return true;
//    }
//    private function _getState($period=0){//判断当前期数是否已经封盘
//        $arr=SixLotterySchedule::lastOne();
//        if($arr){
//            if(strtotime($arr['fenpan_time'])<=time()){
//                return false;
//            }else{
//                return true;
//            }
//        }
//        return false;
//    }
//}