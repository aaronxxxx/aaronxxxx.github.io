<?php
namespace app\modules\spsix\controllers;

use app\common\base\BaseController;
use Yii;
use yii\web\Controller;
use app\modules\spsix\models\SpsixLotteryOdds;
use app\modules\spsix\models\SpsixLotterySchedule;
use app\modules\spsix\models\UserList;
use app\modules\spsix\models\UserGroup;
/**
 * 极速六合彩-自选不中
 * NapController
 */
class NiController extends BaseController  {

    public function init() {
        parent::init();
        
        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->layout = 'main';
    }

    /**
     * PC端 下注数据处理
     * @return mixed
     */
    public function actionBetView(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->out(false,"未登录，请先登录");
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) { return $this->out(false,'没有数据提交');}
        $rType = $postNews['rtype'];
        $numArray = $postNews['num'];
        $odds_NI = SpsixLotteryOdds::getOdds("NI");
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $row2 = SpsixLotterySchedule::getNewestLottery();
        $qishu = $row2['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['splhc_lower_bet'];
        $maxMoney = $row['splhc_max_bet'];
        if ($rType == "NI5") {
            $ni_name = "五不中";
            $minChk = 5;
            $oddsValue = $odds_NI["h1"];
        } elseif ($rType == "NI6") {
            $ni_name = "六不中";
            $minChk = 6;
            $oddsValue = $odds_NI["h2"];
        } elseif ($rType == "NI7") {
            $ni_name = "七不中";
            $minChk = 7;
            $oddsValue = $odds_NI["h3"];
        } elseif ($rType == "NI8") {
            $ni_name = "八不中";
            $minChk = 8;
            $oddsValue = $odds_NI["h4"];
        } elseif ($rType == "NI9") {
            $ni_name = "九不中";
            $minChk = 9;
            $oddsValue = $odds_NI["h5"];
        } elseif ($rType == "NIA") {
            $ni_name = "十不中";
            $minChk = 10;
            $oddsValue = $odds_NI["h6"];
        } elseif ($rType == "NIB") {
            $ni_name = "十一不中";
            $minChk = 11;
            $oddsValue = $odds_NI["h7"];
        } elseif ($rType == "NIC") {
            $ni_name = "十二不中";
            $minChk = 12;
            $oddsValue = $odds_NI["h8"];
        }

        $tmp2Array = array();
        for ($i = 0; $i < $minChk; $i++) {
            $tmp2Array[] = $numArray[$i];
        }
        $totalArray = array();
        $totalArray[] = implode(", ", $tmp2Array);

        if (count($numArray) > $minChk) {
            $totalSelectArray = $this->_compile_array(count($numArray), $minChk);

            //获取剩下组合
            for ($j = 0; $j < count($totalSelectArray); $j++) {
                $subArray = array();
                for ($k = 0; $k < $minChk; $k++) {
                    $subArray[] = $numArray[$totalSelectArray[$j][$k] - 1];
                }
                $totalArray[] = implode(", ", $subArray);
            }
        }
        $postInfo = '';
        $betInfo = '';
        foreach ($numArray as $key => $value) {
            if ($key == 5 && count($numArray) > 6) {
                $betInfo .= $value . ',<br />';
            } else {
                $betInfo .= $value . ',';
            }
        }
        $betInfo = substr($betInfo, 0, -1);
        return $this->out(true,$this->render('BetViewPc',array(
                                        'qishu'=>$qishu,
                                        'totalArray'=>$totalArray,
                                        'ni_name'=>$ni_name,
                                        'oddsValue'=>$oddsValue,
                                        'betInfo'=>$betInfo,
                                        'lowestMoney'=>$lowestMoney,
                                        'maxMoney'=>$maxMoney,
                                        'userMoney'=>$userMoney
        )));
    }

    /**
     * 对数字分组
     * @param $m 需要分组的数字
     * @param $n 每一组数字的长度
     * @return array
     */
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
     * 手机端下注数据处理
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
        if (!$postNews || !isset($postNews['rtype']) || empty($postNews['rtype'])|| !isset($postNews['num']) || empty($postNews['num'])) {echo '没有数据提交'; exit;}
        $rType = $postNews['rtype'];
        $numArray = $postNews['num'];
        $odds_NI = SpsixLotteryOdds::getOdds("NI");
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $row2 = SpsixLotterySchedule::getNewestLottery();
        $qishu = $row2['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['splhc_lower_bet'];
        $maxMoney = $row['splhc_max_bet'];
        if ($rType == "NI5") {
            $ni_name = "五不中";
            $minChk = 5;
            $oddsValue = $odds_NI["h1"];
        } elseif ($rType == "NI6") {
            $ni_name = "六不中";
            $minChk = 6;
            $oddsValue = $odds_NI["h2"];
        } elseif ($rType == "NI7") {
            $ni_name = "七不中";
            $minChk = 7;
            $oddsValue = $odds_NI["h3"];
        } elseif ($rType == "NI8") {
            $ni_name = "八不中";
            $minChk = 8;
            $oddsValue = $odds_NI["h4"];
        } elseif ($rType == "NI9") {
            $ni_name = "九不中";
            $minChk = 9;
            $oddsValue = $odds_NI["h5"];
        } elseif ($rType == "NIA") {
            $ni_name = "十不中";
            $minChk = 10;
            $oddsValue = $odds_NI["h6"];
        } elseif ($rType == "NIB") {
            $ni_name = "十一不中";
            $minChk = 11;
            $oddsValue = $odds_NI["h7"];
        } elseif ($rType == "NIC") {
            $ni_name = "十二不中";
            $minChk = 12;
            $oddsValue = $odds_NI["h8"];
        }

        $tmp2Array = array();
        for ($i = 0; $i < $minChk; $i++) {
            $tmp2Array[] = $numArray[$i];
        }
        $totalArray = array();
        $totalArray[] = implode(", ", $tmp2Array);

        if (count($numArray) > $minChk) {
            $totalSelectArray = $this->_compile_array(count($numArray), $minChk);

            //获取剩下组合
            for ($j = 0; $j < count($totalSelectArray); $j++) {
                $subArray = array();
                for ($k = 0; $k < $minChk; $k++) {
                    $subArray[] = $numArray[$totalSelectArray[$j][$k] - 1];
                }
                $totalArray[] = implode(", ", $subArray);
            }
        }
        $betInfo = '';
        foreach ($numArray as $key => $value) {
            if ($key == 5 && count($numArray) > 6) {
                $betInfo .= $value . ',<br />';
            } else {
                $betInfo .= $value . ',';
            }
        }
        $betInfo = substr($betInfo, 0, -1);
        return $this->render('BetView',array('qishu'=>$qishu,'totalArray'=>$totalArray,'ni_name'=>$ni_name,'oddsValue'=>$oddsValue,'betInfo'=>$betInfo,'lowestMoney'=>$lowestMoney,'maxMoney'=>$maxMoney));
    }
}