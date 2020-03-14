<?php

namespace app\modules\six\controllers;

//use app\common\base\BaseController;
use app\common\base\BaseController;
use Yii;
use yii\web\Controller;
use app\modules\six\models\SixLotteryOdds;
use app\modules\six\models\SixLotterySchedule;
use app\modules\six\models\UserList;
use app\modules\six\models\UserGroup;
use app\modules\six\helpers\Zodiac;

/**
 * 六合彩-连码
 * ChController
 */
class ChController extends BaseController  {

    public function init() {
        parent::init();

        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->layout = 'main';
    }

    /**
     * 连码 PC端的下注注单显示数据
     * @return string
     */
    public function actionBetView(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return  $this->out(false,"未登录，请先登录");
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) { return  $this->out(false,"未提交数据");}
        $odds_CH = SixLotteryOdds::getOdds('CH');
        $rType = $postNews['rtype'];
        if(empty($postNews['OfTouch'])){$postNews['OfTouch'] = '';}
        if(empty($postNews['OfTouch2'])){$postNews['OfTouch2'] = '';}
        if(empty($postNews['OfTouch3'])){$postNews['OfTouch3'] = '';}
        if(empty($postNews['OfTouch5'])){$postNews['OfTouch5'] = '';}
        $ofTouch = $postNews['OfTouch'];
        $ofTouch2 = $postNews['OfTouch2'];
        $ofTouch3 = $postNews['OfTouch3'];
        $ofTouch5 = $postNews['OfTouch5'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $row2 = SixLotterySchedule::getNewestLottery();
        $qishu = $row2['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['lhc_lower_bet'];
        $maxMoney = $row['lhc_max_bet'];
        if ($rType == 'CH_4') {
            $ch_name = '四全中';
            $odds_string = $odds_CH['h1'];
            $minChk = 4;
        } else if ($rType == 'CH_3') {
            $ch_name = '三全中';
            $odds_string = $odds_CH['h2'];
            $minChk = 3;
        } else if ($rType == 'CH_32') {
            $ch_name = '三中二';
            $odds_string = '<br />中二 ' . $odds_CH['h3'] . '<br />中三 ' . $odds_CH['h4'];
            $minChk = 3;
        } else if ($rType == 'CH_2') {
            $ch_name = '二全中';
            $odds_string = $odds_CH['h5'];
            $minChk = 2;
        } else if ($rType == 'CH_2S') {
            $ch_name = '二中特';
            $odds_string = '<br />中特 ' . $odds_CH['h6'] . '<br />中二 ' . $odds_CH['h7'];
            $minChk = 2;
        } else if ($rType == 'CH_2SP') {
            $ch_name = '特串';
            $odds_string = $odds_CH['h8'];
            $minChk = 2;
        }
        $totalArray = array();
        if ($ofTouch != '' || $ofTouch2 != '' || $ofTouch3 != '' || $ofTouch5 != '') {
            $numArray = array();
            if ($ofTouch || $ofTouch2) {
                if ($ofTouch) {
                    $selectArray = $postNews['spa'];
                } else if ($ofTouch2) {
                    $selectArray = $postNews['nf'];
                }
                $a1 = explode(', ', $selectArray[0]);
                $a2 = explode(', ', $selectArray[1]);
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    $numArray[] = $a1[$i2];
                }
                for ($i3 = 0; $i3 < count($a2); $i3++) {
                    $numArray[] = $a2[$i3];
                }
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    for ($i3 = 0; $i3 < count($a2); $i3++) {
                        $totalArray[] = $a1[$i2] . ', ' . $a2[$i3];
                    }
                }
            } else if ($ofTouch3) {//肖串尾数
                $x = $postNews['X'];
                $f = $postNews['F'];
                if(!preg_match('/A[1-9A-C]/',$x)||!preg_match('/[0-9]/',$f)){
                    return ;
                }
                $_class=new Zodiac();
                if(!$_class){
                    return '';
                }
                $xArray = $_class->getLetterArr();
                $fArray = $this->_getFArray();
                $a11 = $xArray[$x];
                $a22 = $fArray[$f];
                $a1 = $xArray[$x];
                $a2 = $fArray[$f];
                for ($i2 = 0; $i2 < count($a11); $i2++) {
                    for ($i3 = 0; $i3 < count($a22); $i3++) {
                        if ($a11[$i2] == $a22[$i3]) {
                            array_splice($a2, $i3, 1);
                        }
                    }
                }
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    $numArray[] = $a1[$i2];
                }
                for ($i3 = 0; $i3 < count($a2); $i3++) {
                    $numArray[] = $a2[$i3];
                }
                if($a1){
                    foreach ($a1 as $key=>$val){
                        $a1Array = explode(',',$val);
                    }
                }
                //去掉相同的数字
                foreach ($a1Array as $key=>$val){
                    foreach ($a2 as $key1=>$val1){
                        if($val==$val1) {
                            unset($a2[$key1]);
                        }
                    }
                }
                foreach ($a1Array as $key=>$val){
                    foreach ($a2 as $key1=>$val1){
                        $totalArray[] = $a1Array[$key] . ', ' . $a2[$key1];
                    }
                }
            } else if ($ofTouch5) {
                $a1 = $postNews['Dantuo1'];
                $a2 = $postNews['Dantuo2'];
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    $numArray[] = $a1[$i2];
                }
                for ($i3 = 0; $i3 < count($a2); $i3++) {
                    $numArray[] = $a2[$i3];
                }
                if ($minChk == 2) {
                    for ($i2 = 0; $i2 < count($a1); $i2++) {
                        for ($i3 = 0; $i3 < count($a2); $i3++) {
                            $totalArray[] = $a1[$i2] . ', ' . $a2[$i3];
                        }
                    }
                } else if ($minChk == 3) {
                    if (count($a1) == 1) {
                        $minChk_sub = 2;
                        $totalArray_21 = array();
                        $tmp2Array = array();
                        for ($n = 0; $n < $minChk_sub; $n++) {
                            $tmp2Array[] = $a2[$n];
                        }
                        $totalArray_21[] = $tmp2Array;
                        if ($minChk_sub < count($a2)) {
                            $totalSelectArray_21 = $this->compile_array(count($a2), $minChk_sub);
                            for ($j = 0; $j < count($totalSelectArray_21); $j++) {
                                $subArray_21 = array();
                                for ($k = 0; $k < $minChk_sub; $k++) {
                                    $subArray_21[] = $a2[$totalSelectArray_21[$j][$k] - 1];
                                }
                                $totalArray_21[] = $subArray_21;
                            }
                        }
                        for ($i2 = 0; $i2 < count($totalArray_21); $i2++) {
                            $totalArray[] = $a1[0] . ', ' . $totalArray_21[$i2][0] . ', ' . $totalArray_21[$i2][1];
                        }
                    } else if (count($a1) == 2) {
                        for ($i3 = 0; $i3 < count($a2); $i3++) {
                            $totalArray[] = $a1[0] . ', ' . $a1[1] . ', ' . $a2[$i3];
                        }
                    }
                } else if ($minChk == 4) {
                    if ((count($a1) == 1) || (count($a1) == 2)) {
                        if (count($a1) == 1) {
                            $minChk_sub = 3;
                        } else if (count($a1) == 2) {
                            $minChk_sub = 2;
                        }
                        $totalArray_21 = array();
                        $tmp2Array = array();
                        for ($n = 0; $n < $minChk_sub; $n++) {
                            $tmp2Array[] = $a2[$n];
                        }
                        $totalArray_21[] = $tmp2Array;
                        if ($minChk_sub < count($a2)) {
                            $totalSelectArray_21 = $this->compile_array(count($a2), $minChk_sub);
                            for ($j = 0; $j < count($totalSelectArray_21); $j++) {
                                $subArray_21 = array();
                                for ($k = 0; $k < $minChk_sub; $k++) {
                                    $subArray_21[] = $a2[$totalSelectArray_21[$j][$k] - 1];
                                }
                                $totalArray_21[] = $subArray_21;
                            }
                        }
                        if (count($a1) == 1) {
                            for ($i2 = 0; $i2 < count($totalArray_21); $i2++) {
                                $totalArray[] = $a1[0] . ', ' . $totalArray_21[$i2][0] . ', ' . $totalArray_21[$i2][1] . ', ' . $totalArray_21[$i2][2];
                            }
                        } else if (count($a1) == 2) {
                            for ($i2 = 0; $i2 < count($totalArray_21); $i2++) {
                                $totalArray[] = $a1[0] . ', ' . $a1[1] . ', ' . $totalArray_21[$i2][0] . ', ' . $totalArray_21[$i2][1];
                            }
                        }
                    } else if (count($a1) == 3) {
                        for ($i3 = 0; $i3 < count($a2); $i3++) {
                            $totalArray[] = $a1[0] . ', ' . $a1[1] . ', ' . $a1[2] . ', ' . $a2[$i3];
                        }
                    }
                }
            }
        } else {
            $numArray = $postNews['num'];
            $tmp2Array = array();
            for ($i = 0; $i < $minChk; $i++) {
                $tmp2Array[] = $numArray[$i];
            }
            $totalArray[] = implode(', ', $tmp2Array);
            if ($minChk < count($numArray)) {
                $totalSelectArray = $this->_compile_array(count($numArray), $minChk);
                for ($j = 0; $j < count($totalSelectArray); $j++) {
                    $subArray = array();
                    for ($k = 0; $k < $minChk; $k++) {
                        $subArray[] = $numArray[$totalSelectArray[$j][$k] - 1];
                    }
                    $totalArray[] = implode(', ', $subArray);
                }
            }
        }
        $betInfo = '';
        foreach ($numArray as $key => $value) {
                $betInfo .= $value . ',';
        }
        $betInfo = substr($betInfo, 0, -1);
        return $this->out(true,$this->render('BetViewPc',array(
                                'qishu'=>$qishu,
                                'ch_name'=>  $ch_name,
                                'odds_string'=>$odds_string,
                                'betInfo'=>$betInfo,
                                'count'=>count($totalArray),
                                'lowestMoney'=>$lowestMoney,
                                'maxMoney'=>$maxMoney,
                                'userMoney'=>$userMoney,
                                'totalArray'=>$totalArray
        )));
    }

    /**
     * 号码分组
     * @param $m
     * @param $n
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
    static public function _getFArray() {
        $fArray = array();
        $fArray[0] = array('10', '20', '30', '40');
        $fArray[1] = array('01', '11', '21', '31', '41');
        $fArray[2] = array('02', '12', '22', '32', '42');
        $fArray[3] = array('03', '13', '23', '33', '43');
        $fArray[4] = array('04', '14', '24', '34', '44');
        $fArray[5] = array('05', '15', '25', '35', '45');
        $fArray[6] = array('06', '16', '26', '36', '46');
        $fArray[7] = array('07', '17', '27', '37', '47');
        $fArray[8] = array('08', '18', '28', '38', '48');
        $fArray[9] = array('09', '19', '29', '39', '49');
        return $fArray;
    }

    /**
     * 移动端下注
    */
    public function actionMobileBetView(){
        $this->layout = false;
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            echo '未登录，请先登录';
            exit;
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) { echo '没有数据提交';exit; }
        $rType = $postNews['rtype'];
        if(empty($postNews['OfTouch'])){$postNews['OfTouch'] = '';}
        if(empty($postNews['OfTouch2'])){$postNews['OfTouch2'] = '';}
        if(empty($postNews['OfTouch3'])){$postNews['OfTouch3'] = '';}
        if(empty($postNews['OfTouch5'])){$postNews['OfTouch5'] = '';}
        $ofTouch = $postNews['OfTouch'];
        $ofTouch2 = $postNews['OfTouch2'];
        $ofTouch3 = $postNews['OfTouch3'];
        $ofTouch5 = $postNews['OfTouch5'];
        $row2 = SixLotterySchedule::getNewestLottery();
        $qishu = $row2['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['lhc_lower_bet'];
        $maxMoney = $row['lhc_max_bet'];
        if ($rType == 'CH_4') {
            $ch_name = '四全中';
            $minChk = 4;
        } else if ($rType == 'CH_3') {
            $ch_name = '三全中';
            $minChk = 3;
        } else if ($rType == 'CH_32') {
            $ch_name = '三中二';
            $minChk = 3;
        } else if ($rType == 'CH_2') {
            $ch_name = '二全中';
            $minChk = 2;
        } else if ($rType == 'CH_2S') {
            $ch_name = '二中特';
            $minChk = 2;
        } else if ($rType == 'CH_2SP') {
            $ch_name = '特串';
            $minChk = 2;
        }
        $totalArray = array();
        if ($ofTouch != '' || $ofTouch2 != '' || $ofTouch3 != '' || $ofTouch5 != '') {
            $numArray = array();
            if ($ofTouch || $ofTouch2) {
                if ($ofTouch) {
                    $selectArray = $postNews['spa'];
                } else if ($ofTouch2) {
                    $selectArray = $postNews['nf'];
                }
                $a1 = explode(', ', $selectArray[0]);
                $a2 = explode(', ', $selectArray[1]);
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    $numArray[] = $a1[$i2];
                }
                for ($i3 = 0; $i3 < count($a2); $i3++) {
                    $numArray[] = $a2[$i3];
                }
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    for ($i3 = 0; $i3 < count($a2); $i3++) {
                        $totalArray[] = $a1[$i2] . ', ' . $a2[$i3];
                    }
                }
            }
            else if ($ofTouch3) {//肖串尾数
                $x = $postNews['X'];
                $f = $postNews['F'];
                if(!preg_match('/A[1-9A-C]/',$x)||!preg_match('/[0-9]/',$f)){
                    return ;
                }
                $_class=new Zodiac();
                if(!$_class){
                    return '';
                }
                $xArray = $_class->getLetterArr();
                $fArray = $this->_getFArray();
                $a11 = $xArray[$x];
                $a22 = $fArray[$f];
                $a1 = $xArray[$x];
                $a2 = $fArray[$f];
                for ($i2 = 0; $i2 < count($a11); $i2++) {
                    for ($i3 = 0; $i3 < count($a22); $i3++) {
                        if ($a11[$i2] == $a22[$i3]) {
                            array_splice($a2, $i3, 1);
                        }
                    }
                }
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    $numArray[] = $a1[$i2];
                }
                for ($i3 = 0; $i3 < count($a2); $i3++) {
                    $numArray[] = $a2[$i3];
                }
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    for ($i3 = 0; $i3 < count($a2); $i3++) {
                        $totalArray[] = $a1[$i2] . ', ' . $a2[$i3];
                    }
                }
            }
            else if ($ofTouch5) {
                $a1 = $postNews['Dantuo1'];
                $a2 = $postNews['Dantuo2'];
                for ($i2 = 0; $i2 < count($a1); $i2++) {
                    $numArray[] = $a1[$i2];
                }
                for ($i3 = 0; $i3 < count($a2); $i3++) {
                    $numArray[] = $a2[$i3];
                }
                if ($minChk == 2) {
                    for ($i2 = 0; $i2 < count($a1); $i2++) {
                        for ($i3 = 0; $i3 < count($a2); $i3++) {
                            $totalArray[] = $a1[$i2] . ', ' . $a2[$i3];
                        }
                    }
                } else if ($minChk == 3) {
                    if (count($a1) == 1) {
                        $minChk_sub = 2;
                        $totalArray_21 = array();
                        $tmp2Array = array();
                        for ($n = 0; $n < $minChk_sub; $n++) {
                            $tmp2Array[] = $a2[$n];
                        }
                        $totalArray_21[] = $tmp2Array;
                        if ($minChk_sub < count($a2)) {
                            $totalSelectArray_21 = $this->_compile_array(count($a2), $minChk_sub);
                            for ($j = 0; $j < count($totalSelectArray_21); $j++) {
                                $subArray_21 = array();
                                for ($k = 0; $k < $minChk_sub; $k++) {
                                    $subArray_21[] = $a2[$totalSelectArray_21[$j][$k] - 1];
                                }
                                $totalArray_21[] = $subArray_21;
                            }
                        }
                        for ($i2 = 0; $i2 < count($totalArray_21); $i2++) {
                            $totalArray[] = $a1[0] . ', ' . $totalArray_21[$i2][0] . ', ' . $totalArray_21[$i2][1];
                        }
                    } else if (count($a1) == 2) {
                        for ($i3 = 0; $i3 < count($a2); $i3++) {
                            $totalArray[] = $a1[0] . ', ' . $a1[1] . ', ' . $a2[$i3];
                        }
                    }
                } else if ($minChk == 4) {
                    if ((count($a1) == 1) || (count($a1) == 2)) {
                        if (count($a1) == 1) {
                            $minChk_sub = 3;
                        } else if (count($a1) == 2) {
                            $minChk_sub = 2;
                        }
                        $totalArray_21 = array();
                        $tmp2Array = array();
                        for ($n = 0; $n < $minChk_sub; $n++) {
                            $tmp2Array[] = $a2[$n];
                        }
                        $totalArray_21[] = $tmp2Array;
                        if ($minChk_sub < count($a2)) {
                            $totalSelectArray_21 = compile_array(count($a2), $minChk_sub);
                            for ($j = 0; $j < count($totalSelectArray_21); $j++) {
                                $subArray_21 = array();
                                for ($k = 0; $k < $minChk_sub; $k++) {
                                    $subArray_21[] = $a2[$totalSelectArray_21[$j][$k] - 1];
                                }
                                $totalArray_21[] = $subArray_21;
                            }
                        }
                        if (count($a1) == 1) {
                            for ($i2 = 0; $i2 < count($totalArray_21); $i2++) {
                                $totalArray[] = $a1[0] . ', ' . $totalArray_21[$i2][0] . ', ' . $totalArray_21[$i2][1] . ', ' . $totalArray_21[$i2][2];
                            }
                        } else if (count($a1) == 2) {
                            for ($i2 = 0; $i2 < count($totalArray_21); $i2++) {
                                $totalArray[] = $a1[0] . ', ' . $a1[1] . ', ' . $totalArray_21[$i2][0] . ', ' . $totalArray_21[$i2][1];
                            }
                        }
                    } else if (count($a1) == 3) {
                        for ($i3 = 0; $i3 < count($a2); $i3++) {
                            $totalArray[] = $a1[0] . ', ' . $a1[1] . ', ' . $a1[2] . ', ' . $a2[$i3];
                        }
                    }
                }
            }
        }
        else {
            $numArray = $postNews['num'];
            $tmp2Array = array();
            for ($i = 0; $i < $minChk; $i++) {
                $tmp2Array[] = $numArray[$i];
            }
            $totalArray[] = implode(', ', $tmp2Array);
            if ($minChk < count($numArray)) {
                $totalSelectArray = $this->_compile_array(count($numArray), $minChk);
                for ($j = 0; $j < count($totalSelectArray); $j++) {
                    $subArray = array();
                    for ($k = 0; $k < $minChk; $k++) {
                        $subArray[] = $numArray[$totalSelectArray[$j][$k] - 1];
                    }
                    $totalArray[] = implode(', ', $subArray);
                }
            }
        }
        $betInfo = '';
        foreach ($numArray as $key => $value) {
                $betInfo .= $value . ', ';
        }
        $betInfo = substr($betInfo, 0, -2);
        return $this->render('BetView',array('qishu'=>$qishu,'ch_name'=>$ch_name,'betInfo'=>$betInfo,'totalArray'=>$totalArray,'lowestMoney'=>$lowestMoney,'maxMoney'=>$maxMoney,'postInfo'=>$totalArray));
    }

    /**
     * 号码分组
     * @param $m
     * @param $n
     * @return array
     */
    function compile_array($m, $n)
    {
        $returnArray = array();
        $end = false;
        $number = array();
        for ($t = 0; $t < $m; $t++)
        {
            if ($t < $n)
            {
                $number[$t] = 1;
            }
            else
            {
                $number[$t] = 0;
            }
        }
        while (!$end)
        {
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
            for ($b = 0; $b < $m; $b++)
            {
                if ($number[$b] == 1)
                {
                    $outputString[] = $b + 1;
                }
            }
            $returnArray[] = $outputString;
        }
        return $returnArray;
    }
}