<?php
namespace app\modules\six\controllers;

use app\common\base\BaseController;
use app\modules\six\models\CommonFc\CommonFc;
use Yii;
use yii\web\Controller;
use app\modules\six\models\SixLotteryOdds;
use app\modules\six\models\SixLotterySchedule;
use app\modules\six\models\UserList;
use app\modules\six\models\UserGroup;

/**
 * 六合彩-连肖,连尾
 * NapController
 */
class LxController extends BaseController  {

    public function init() {
        parent::init();
        
        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->layout = 'main';
    }
    
    public function actionBetView(){
        $this->layout = false;
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->out(false,'未登录，请先登录');
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) {  return $this->out(false,'没有数据提交');}
        $rType = $postNews['rtype'];
        if(empty($postNews['lx'])){$postNews['lx'] = '';}
        if(empty($postNews['lf'])){$postNews['lf'] = '';}
        $lxArray = $postNews['lx'];
        $lfArray = $postNews['lf'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $row2 = SixLotterySchedule::getNewestLottery();
        $qishu = $row2['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['lhc_lower_bet'];
        $maxMoney = $row['lhc_max_bet'];
        $is_lx = "false";
        if (in_array($rType, array("LX2", "LX3", "LX4", "LX5"))) {
            $is_lx = "true";
        }
        elseif (in_array($rType, array("LF2", "LF3", "LF4", "LF5"))) {
            $is_lf = "true";
        }
        if ($is_lx == "true") {
            $lx_name = "连肖";
            $gid = "LX";
            if ($rType == "LX2") {
                $odds_LX = SixLotteryOdds::getOdds("LX2");
                $lx_sub_name = "二肖连";
                $minChk = 2;
            } elseif ($rType == "LX3") {
                $odds_LX = SixLotteryOdds::getOdds("LX3");
                $lx_sub_name = "三肖连";
                $minChk = 3;
            } elseif ($rType == "LX4") {
                $odds_LX = SixLotteryOdds::getOdds("LX4");
                $lx_sub_name = "四肖连";
                $minChk = 4;
            } elseif ($rType == "LX5") {
                $odds_LX = SixLotteryOdds::getOdds("LX5");
                $lx_sub_name = "五肖连";
                $minChk = 5;
            }
            $selectArray = $lxArray;
        } 
        elseif ($is_lf == "true") {
            $lx_name = "连尾";
            $gid = "LF";
            if ($rType == "LF2") {
                $odds_LF = SixLotteryOdds::getOdds("LF2");
                $lx_sub_name = "二尾碰";
                $minChk = 2;
            } elseif ($rType == "LF3") {
                $odds_LF = SixLotteryOdds::getOdds("LF3");
                $lx_sub_name = "三尾碰";
                $minChk = 3;
            } elseif ($rType == "LF4") {
                $odds_LF = SixLotteryOdds::getOdds("LF4");
                $lx_sub_name = "四尾碰";
                $minChk = 4;
            } elseif ($rType == "LF5") {
                $odds_LF = SixLotteryOdds::getOdds("LF5");
                $lx_sub_name = "五尾碰";
                $minChk = 5;
            }
            $selectArray = $lfArray;
        }
        $oddsValueArray = array();
        $tmpArray = array();
        $oddsIndexArray = array();
        $tmpArrayCount = 1;
        $common = new CommonFc();
        for ($j = 0; $j < count($selectArray); $j++) {
            $tmpArray[$tmpArrayCount] = $selectArray[$j] . "";
            $tmpArrayCount += 1;
        }
        $animalArray = array();
        $animalArray["A1"] = "鼠";
        $animalArray["A2"] = "牛";
        $animalArray["A3"] = "虎";
        $animalArray["A4"] = "兔";
        $animalArray["A5"] = "龙";
        $animalArray["A6"] = "蛇";
        $animalArray["A7"] = "马";
        $animalArray["A8"] = "羊";
        $animalArray["A9"] = "猴";
        $animalArray["AA"] = "鸡";
        $animalArray["AB"] = "狗";
        $animalArray["AC"] = "猪";

        $tmp2Array = array();
        $oddsValue=0;
        for ($i = 1; $i <= $minChk; $i++) {
            if ($is_lx == "true") {
                 $lx_current_odds = $odds_LX["h" . $common->getLxOddsCount($tmpArray[$i])];
                if ($i == 1) {
                    $oddsValue = $lx_current_odds;
                    $oddsIndex = $common->getLxOddsCount($tmpArray[$i]);
                } else {
                    if ($lx_current_odds < $oddsValue) {
                        $oddsValue = $lx_current_odds;
                        $oddsIndex = $common->getLxOddsCount($tmpArray[$i]);
                    }
                }
                $tmp2Array[] = $animalArray[$tmpArray[$i]];
            } else {
                $lf_current_odds = $odds_LF["h" . ($tmpArray[$i] + 1)];
                if ($i == 1) {
                    $oddsValue = $lf_current_odds;
                    $oddsIndex = $tmpArray[$i] + 1;
                } else {
                    if ($lf_current_odds < $oddsValue) {
                        $oddsValue = $lf_current_odds;
                        $oddsIndex = $tmpArray[$i] + 1;
                    }
                }
                $tmp2Array[] = $tmpArray[$i];
            }
        }

        $totalArray = array();
        $totalArray[] = implode(",", $tmp2Array);
        $oddsValueArray[] = $oddsValue;
        $oddsIndexArray[] = $oddsIndex;
        $oddsValue =0;
        if (count($selectArray) > $minChk) {
            $totalSelectArray = $this->_compile_array(count($selectArray), $minChk);
            //获取剩下组合
            for ($j = 0; $j < count($totalSelectArray); $j++) {
                $subArray = array();
                for ($k = 0; $k < $minChk; $k++) {
                    if ($is_lx == "true") {
                        $lx_current_odds = $odds_LX["h" . $common->getLxOddsCount($tmpArray[$totalSelectArray[$j][$k]])];
                        if (empty($oddsValue)) {
                            $oddsValue = $lx_current_odds;
                            $oddsIndex = $common->getLxOddsCount($tmpArray[$totalSelectArray[$j][$k]]);
                        } else {
                            if ($lx_current_odds < $oddsValue) {
                                $oddsValue = $lx_current_odds;
                                $oddsIndex = $common->getLxOddsCount($tmpArray[$totalSelectArray[$j][$k]]);
                            }
                        }
                        $subArray[] = $animalArray[$tmpArray[$totalSelectArray[$j][$k]]];
                    } else {
                        $lf_current_odds = $odds_LF["h" . ($tmpArray[$totalSelectArray[$j][$k]] + 1)];
                        if (empty($oddsValue)) {
                            $oddsValue = $lf_current_odds;
                            $oddsIndex = $tmpArray[$totalSelectArray[$j][$k]] + 1;
                        } else {
                            if ($lf_current_odds < $oddsValue) {
                                $oddsValue = $lf_current_odds;
                                $oddsIndex = $tmpArray[$totalSelectArray[$j][$k]] + 1;
                            }
                        }
                        $subArray[] = $tmpArray[$totalSelectArray[$j][$k]];
                    }
                }
                $totalArray[] = implode(",", $subArray);
                $oddsValueArray[] = $oddsValue;
                $oddsIndexArray[] = $oddsIndex;
                $oddsValue = null;  //清空$oddsValue2
                $oddsValue = null;
            }
        }
        return $this->out(true,$this->render('BetViewPc',array(
            'lx_name'=>$lx_name,
            'qishu'=>$qishu,
            'lowestMoney'=>$lowestMoney,
            'maxMoney'=>$maxMoney,
            'gid'=>$gid,
            'count'=>count($totalArray),
            'lx_sub_name'=>$lx_sub_name,
            'totalArray'=>$totalArray,
            'userMoney'=>$userMoney,
            'oddsValueArray'=>$oddsValueArray,
            'oddsIndexArray'=>$oddsIndexArray,

        )));

    }
    
    private function _compile_array($m, $n){
        $returnArray = array();
        $end = false;
        $number = array();
        for ($t = 0; $t < $m; $t++) {
            if ($t < $n) 
            {
                $number[$t] = 1;
            }
            else 
            {
                $number[$t] = 0;
            }
        }
        while (!$end) {
            $findfirst = false;
            $swap = false;
            for ($i = 0; $i < $m; $i++) 
            {
                if (!$findfirst && ($number[$i] != 0)) 
                {
                    $k = $i;
                    $findfirst = true;
                }
                if (($number[$i] != 0) && ($number[$i + 1] == 0)) 
                {
                    $number[$i] = 0;
                    $number[$i + 1] = 1;
                    $swap = true;
                    for ($l = 0; $l < ($i - $k);
                    $l++) 
                    {
                        $number[$l] = $number[$k + $l];
                    }
                    for ($l = $i - $k; $l < $i; $l++) 
                    {
                        $number[$l] = 0;
                    }
                    if (($k == $i) && (($i + 1) == $m - $n)) 
                    {
                        $end = true;
                    }
                }
                if ($swap) 
                {
                    break;
                }
            }
            $outputString = array();
            for ($b = 0; $b < $m; $b++) {
                if ($number[$b] == 1) 
                {
                    $outputString[] = $b + 1;
                }
            }
            $returnArray[] = $outputString;
        }
        return $returnArray;
    }

    /**
     * 连肖 连尾 手机端 注单 数据处理
     * @return mixed
     */
    public function actionMobileBetView(){
        $this->layout = false;
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            echo("未登录，请先登录");
            exit;
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) {echo '没有数据提交';exit;}
        $rType = $postNews['rtype'];
        if(empty($postNews['lx'])){$postNews['lx'] = '';}
        if(empty($postNews['lf'])){$postNews['lf'] = '';}
        $lxArray = $postNews['lx'];
        $lfArray = $postNews['lf'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $row2 = SixLotterySchedule::getNewestLottery();
        $qishu = $row2['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['lhc_lower_bet'];
        $maxMoney = $row['lhc_max_bet'];
        $is_lx = "false";
        if (in_array($rType, array("LX2", "LX3", "LX4", "LX5"))) {
            $is_lx = "true";
        }
        elseif (in_array($rType, array("LF2", "LF3", "LF4", "LF5"))) {
            $is_lf = "true";
        }
        if ($is_lx == "true") {
            $lx_name = "连肖";
            $gid = "LX";
            if ($rType == "LX2") {
                $odds_LX = SixLotteryOdds::getOdds("LX2");
                $lx_sub_name = "二肖连";
                $minChk = 2;
            } elseif ($rType == "LX3") {
                $odds_LX = SixLotteryOdds::getOdds("LX3");
                $lx_sub_name = "三肖连";
                $minChk = 3;
            } elseif ($rType == "LX4") {
                $odds_LX = SixLotteryOdds::getOdds("LX4");
                $lx_sub_name = "四肖连";
                $minChk = 4;
            } elseif ($rType == "LX5") {
                $odds_LX = SixLotteryOdds::getOdds("LX5");
                $lx_sub_name = "五肖连";
                $minChk = 5;
            }
            $selectArray = $lxArray;
        }
        elseif ($is_lf == "true") {
            $lx_name = "连尾";
            $gid = "LF";
            if ($rType == "LF2") {
                $odds_LF = SixLotteryOdds::getOdds("LF2");
                $lx_sub_name = "二尾碰";
                $minChk = 2;
            } elseif ($rType == "LF3") {
                $odds_LF = SixLotteryOdds::getOdds("LF3");
                $lx_sub_name = "三尾碰";
                $minChk = 3;
            } elseif ($rType == "LF4") {
                $odds_LF = SixLotteryOdds::getOdds("LF4");
                $lx_sub_name = "四尾碰";
                $minChk = 4;
            } elseif ($rType == "LF5") {
                $odds_LF = SixLotteryOdds::getOdds("LF5");
                $lx_sub_name = "五尾碰";
                $minChk = 5;
            }
            $selectArray = $lfArray;
        }
        $oddsValueArray = array();
        $tmpArray = array();
        $oddsIndexArray = array();
        $tmpArrayCount = 1;
        $common = new CommonFc();
        for ($j = 0; $j < count($selectArray); $j++) {
            $tmpArray[$tmpArrayCount] = $selectArray[$j] . "";
            $tmpArrayCount += 1;
        }
        $animalArray = array();
        $animalArray["A1"] = "鼠";
        $animalArray["A2"] = "牛";
        $animalArray["A3"] = "虎";
        $animalArray["A4"] = "兔";
        $animalArray["A5"] = "龙";
        $animalArray["A6"] = "蛇";
        $animalArray["A7"] = "马";
        $animalArray["A8"] = "羊";
        $animalArray["A9"] = "猴";
        $animalArray["AA"] = "鸡";
        $animalArray["AB"] = "狗";
        $animalArray["AC"] = "猪";

        $tmp2Array = array();
        for ($i = 1; $i <= $minChk; $i++) {
            if ($is_lx == "true") {
                $lx_current_odds = $odds_LX["h" . $common->getLxOddsCount($tmpArray[$i])];
                if ($i == 1) {
                    $oddsValue = $lx_current_odds;
                    $oddsIndex = $common->getLxOddsCount($tmpArray[$i]);
                } else {
                    if ($lx_current_odds < $oddsValue) {
                        $oddsValue = $lx_current_odds;
                        $oddsIndex = $common->getLxOddsCount($tmpArray[$i]);
                    }
                }
                $tmp2Array[] = $animalArray[$tmpArray[$i]];
            } else {
                $lf_current_odds = $odds_LF["h" . ($tmpArray[$i] + 1)];
                if ($i == 1) {
                    $oddsValue = $lf_current_odds;
                    $oddsIndex = $tmpArray[$i] + 1;
                } else {
                    if ($lf_current_odds > $oddsValue) {
                        $oddsValue = $lf_current_odds;
                        $oddsIndex = $tmpArray[$i] + 1;
                    }
                }
                $tmp2Array[] = $tmpArray[$i];
            }
        }

        $totalArray = array();
        $totalArray[] = implode(",", $tmp2Array);
        $oddsValueArray[] = $oddsValue;
        $oddsIndexArray[] = $oddsIndex;
        $oddsValue =0;
        if (count($selectArray) > $minChk) {
            $totalSelectArray = $this->_compile_array(count($selectArray), $minChk);
            //获取剩下组合
            for ($j = 0; $j < count($totalSelectArray); $j++) {
                $subArray = array();
                for ($k = 0; $k < $minChk; $k++) {
                    if ($is_lx == "true") {
                        $lx_current_odds = $odds_LX["h" . $common->getLxOddsCount($tmpArray[$totalSelectArray[$j][$k]])];
                        if (empty($oddsValue)) {
                            $oddsValue = $lx_current_odds;
                            $oddsIndex = $common->getLxOddsCount($tmpArray[$totalSelectArray[$j][$k]]);
                        } else {
                            if ($lx_current_odds < $oddsValue) {
                                $oddsValue = $lx_current_odds;
                                $oddsIndex = $common->getLxOddsCount($tmpArray[$totalSelectArray[$j][$k]]);
                            }
                        }
                        $subArray[] = $animalArray[$tmpArray[$totalSelectArray[$j][$k]]];
                    } else {
                        $lf_current_odds = $odds_LF["h" . ($tmpArray[$totalSelectArray[$j][$k]] + 1)];
                        if (empty($oddsValue)) {
                            $oddsValue = $lf_current_odds;
                            $oddsIndex = $tmpArray[$totalSelectArray[$j][$k]] + 1;
                        } else {
                            if ($lf_current_odds > $oddsValue) {
                                $oddsValue = $lf_current_odds;
                                $oddsIndex = $tmpArray[$totalSelectArray[$j][$k]] + 1;
                            }
                        }
                        $subArray[] = $tmpArray[$totalSelectArray[$j][$k]];
                    }
                }
                $totalArray[] = implode(",", $subArray);
                $oddsValueArray[] = $oddsValue;
                $oddsIndexArray[] = $oddsIndex;
                $oddsValue = null;  //清空$oddsValue2
                $oddsValue = null;
            }
        }
       return $this->render('BetView',array('qishu'=>$qishu,'totalArray'=>$totalArray,'lx_name'=>$lx_name,'lx_sub_name'=>$lx_sub_name,'gid'=>$gid,'maxMoney'=>$maxMoney,'lowestMoney'=>$lowestMoney,'oddsValueArray'=>$oddsValueArray,'oddsIndexArray'=>$oddsIndexArray));
    }
}