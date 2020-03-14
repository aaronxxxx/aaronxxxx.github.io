<?php
namespace app\modules\spsix\models\CommonFc;

use app\modules\spsix\helpers\Zodiac;

class CommonFc {

    static public function getZhLhcName($rType) {
        $rTypeName = "";
        $rType=trim($rType);
        if ($rType == "SP" || $rType == "SPbside") {
            $rTypeName = "特别号";
        } elseif (in_array($rType, array("N1", "N2", "N3", "N4", "N5", "N6"))) {
            $rTypeName = "正码特 " . substr($rType, 1, 1);
        } elseif ($rType == "NA") {
            $rTypeName = "正码";
        } elseif ($rType == "NO") {
            $rTypeName = "正码1-6";
        } elseif ($rType == "OEOU") {
            $rTypeName = "两面";
        } elseif ($rType == "SPA") {
            $rTypeName = "生肖";
        } elseif ($rType == "C7") {
            $rTypeName = "正肖";
        } elseif ($rType == "SPB") {
            $rTypeName = "一肖";
        }elseif($rType == "HB") {
            $rTypeName = "半波";
        }elseif ($rType == "NAP") {
            $rTypeName = "正码过关";
        } elseif ($rType == "NX") {
            $rTypeName = "合肖";
        } elseif ($rType == "LX") {
            $rTypeName = "连肖";
        } elseif ($rType == "LF") {
            $rTypeName = "连尾";
        } elseif ($rType == "NI") {
            $rTypeName = "自选不中";
        }
        return $rTypeName;
    }

    /**
     * 极速六合彩的详细分类
     * @param $rType
     * @param string $showTableN
     * @return string
     */
    static public function getZhLhcNameDetail($rType,$showTableN='') {
        $rTypeName = "";
        $rType=trim($rType);
        if ($rType == "SP" || $rType == "SPbside") {
            $rTypeName = "特别号";
        } elseif (in_array($rType, array("N1", "N2", "N3", "N4", "N5", "N6"))) {
            $rTypeName = "正码特 " . substr($rType, 1, 1);
        } elseif ($rType == "NA") {
            $rTypeName = "正码";
        } elseif ($rType == "NO") {
            $rTypeName = "正码1-6";
        } elseif ($rType == "OEOU") {
            $rTypeName = "两面";
        } elseif ($rType == "SPA"&&$showTableN==1) {
            $rTypeName = "生肖";
        } elseif ($rType == "SPA"&&$showTableN==2){
            $rTypeName = "色波";
        }elseif ($rType == "SPA"&&$showTableN==3) {
            $rTypeName = "头尾数";
        }elseif ($rType == "C7"&&$showTableN==1) {
            $rTypeName = "正肖";
        }elseif ($rType == "C7"&&$showTableN==2){
            $rTypeName = "七色波";
        } elseif ($rType == "SPB" &&$showTableN==1) {
            $rTypeName = "一肖";
        } elseif ($rType == "SPB" &&$showTableN==2) {
            $rTypeName = "平特尾数";
        }elseif ($rType == "SPB" &&$showTableN==3){
            $rTypeName = "总肖";
        }elseif($rType == "HB"&&$showTableN==1) {
            $rTypeName = "半波";
        }elseif ($rType == "HB"&&$showTableN==2){
            $rTypeName = "半半波";
        } elseif ($rType == "NAP") {
            $rTypeName = "正码过关";
        } elseif ($rType == "NX") {
            $rTypeName = "合肖";
        } elseif ($rType == "LX") {
            $rTypeName = "连肖";
        } elseif ($rType == "LF") {
            $rTypeName = "连尾";
        } elseif ($rType == "NI") {
            $rTypeName = "自选不中";
        }
        return $rTypeName;
    }


    static public function getBetInfo($key, $rType) {
        $betInfo = '';
        $rType=trim($rType);
        if (in_array($rType, array('SP', 'SPbside', 'NA', 'N1', 'N2', 'N3', 'N4', 'N5', 'N6'))) {
            $betSp = substr($key, 2, 2) + 0;
            if ((0 < $betSp) && ($betSp < 50)) {
                $betInfo = $betSp;
            } else if ($key == 'SP_ODD') {
                $betInfo = '特别号 单';
            } else if ($key == 'SP_EVEN') {
                $betInfo = '特别号 双';
            } else if ($key == 'SP_OVER') {
                $betInfo = '特别号 大';
            } else if ($key == 'SP_UNDER') {
                $betInfo = '特别号 小';
            } else if ($key == 'SF_OVER') {
                $betInfo = '特别号 尾大';
            } else if ($key == 'SP_SODD') {
                $betInfo = '特别号 和单';
            } else if ($key == 'SP_SEVEN') {
                $betInfo = '特别号 和双';
            } else if ($key == 'SP_SOVER') {
                $betInfo = '特别号 和大';
            } else if ($key == 'SP_SUNDER') {
                $betInfo = '特别号 和小';
            } else if ($key == 'SF_UNDER') {
                $betInfo = '特别号 尾小';
            } else if ($key == 'HS_EO') {
                $betInfo = '特别号 大双';
            } else if ($key == 'HS_EU') {
                $betInfo = '特别号 小双';
            } else if ($key == 'HS_OO') {
                $betInfo = '特别号 大单';
            } else if ($key == 'HS_OU') {
                $betInfo = '特别号 小单';
            } else if ($key == 'NA_ODD') {
                $betInfo = '总和 单';
            } else if ($key == 'NA_EVEN') {
                $betInfo = '总和 双';
            } else if ($key == 'NA_OVER') {
                $betInfo = '总和 大';
            } else if ($key == 'NA_UNDER') {
                $betInfo = '总和 小';
            }
        } else {
            if (($rType == 'NO') || ($rType == 'OEOU')) {
                $betNumber = substr($key, 2, 1);
                $betInfoPre = '';
                if ($betNumber == 1) {
                    $betInfoPre = '正码一';
                } else if ($betNumber == 2) {
                    $betInfoPre = '正码二';
                } else if ($betNumber == 3) {
                    $betInfoPre = '正码三';
                } else if ($betNumber == 4) {
                    $betInfoPre = '正码四';
                } else if ($betNumber == 5) {
                    $betInfoPre = '正码五';
                } else if ($betNumber == 6) {
                    $betInfoPre = '正码六';
                } else if (substr($key, 0, 2) == 'SP') {
                    $betInfoPre = '特别号';
                } else if (substr($key, 0, 2) == 'NA') {
                    $betInfoPre = '总和';
                }
                if (strpos($key, '_ODD') !== false) {
                    $betInfo = '单';
                } else if (strpos($key, '_EVEN') !== false) {
                    $betInfo = '双';
                } else if (strpos($key, '_OVER') !== false) {
                    $betInfo = '大';
                } else if (strpos($key, '_UNDER') !== false) {
                    $betInfo = '小';
                } else if (strpos($key, '_SODD') !== false) {
                    $betInfo = '和单';
                } else if (strpos($key, '_SEVEN') !== false) {
                    $betInfo = '和双';
                } else if (strpos($key, '_SOVER') !== false) {
                    $betInfo = '和大';
                } else if (strpos($key, '_SUNDER') !== false) {
                    $betInfo = '和小';
                } else if (strpos($key, '_FOVER') !== false) {
                    $betInfo = '尾大';
                } else if (strpos($key, '_FUNDER') !== false) {
                    $betInfo = '尾小';
                } else if (strpos($key, '_R') !== false) {
                    $betInfo = '红波';
                } else if (strpos($key, '_G') !== false) {
                    $betInfo = '绿波';
                } else if (strpos($key, '_B') !== false) {
                    $betInfo = '蓝波';
                }
                $betInfo = $betInfoPre . ' ' . $betInfo;
            } else if ($rType == 'SPA') {
                if ($key == 'SP_A1') {
                    $betInfo = '鼠';
                } else if ($key == 'SP_A2') {
                    $betInfo = '牛';
                } else if ($key == 'SP_A3') {
                    $betInfo = '虎';
                } else if ($key == 'SP_A4') {
                    $betInfo = '兔';
                } else if ($key == 'SP_A5') {
                    $betInfo = '龙';
                } else if ($key == 'SP_A6') {
                    $betInfo = '蛇';
                } else if ($key == 'SP_A7') {
                    $betInfo = '马';
                } else if ($key == 'SP_A8') {
                    $betInfo = '羊';
                } else if ($key == 'SP_A9') {
                    $betInfo = '猴';
                } else if ($key == 'SP_AA') {
                    $betInfo = '鸡';
                } else if ($key == 'SP_AB') {
                    $betInfo = '狗';
                } else if ($key == 'SP_AC') {
                    $betInfo = '猪';
                } else if ($key == 'SP_R') {
                    $betInfo = '红波';
                } else if ($key == 'SP_G') {
                    $betInfo = '绿波';
                } else if ($key == 'SP_B') {
                    $betInfo = '蓝波';
                } else if ($key == 'SH0') {
                    $betInfo = '头0';
                } else if ($key == 'SH1') {
                    $betInfo = '头1';
                } else if ($key == 'SH2') {
                    $betInfo = '头2';
                } else if ($key == 'SH3') {
                    $betInfo = '头3';
                } else if ($key == 'SH4') {
                    $betInfo = '头4';
                } else if ($key == 'SF0') {
                    $betInfo = '尾0';
                } else if ($key == 'SF1') {
                    $betInfo = '尾1';
                } else if ($key == 'SF2') {
                    $betInfo = '尾2';
                } else if ($key == 'SF3') {
                    $betInfo = '尾3';
                } else if ($key == 'SF4') {
                    $betInfo = '尾4';
                } else if ($key == 'SF5') {
                    $betInfo = '尾5';
                } else if ($key == 'SF6') {
                    $betInfo = '尾6';
                } else if ($key == 'SF7') {
                    $betInfo = '尾7';
                } else if ($key == 'SF8') {
                    $betInfo = '尾8';
                } else if ($key == 'SF9') {
                    $betInfo = '尾9';
                }
            } else if ($rType == 'C7') {
                if ($key == 'NA_A1') {
                    $betInfo = '鼠';
                } else if ($key == 'NA_A2') {
                    $betInfo = '牛';
                } else if ($key == 'NA_A3') {
                    $betInfo = '虎';
                } else if ($key == 'NA_A4') {
                    $betInfo = '兔';
                } else if ($key == 'NA_A5') {
                    $betInfo = '龙';
                } else if ($key == 'NA_A6') {
                    $betInfo = '蛇';
                } else if ($key == 'NA_A7') {
                    $betInfo = '马';
                } else if ($key == 'NA_A8') {
                    $betInfo = '羊';
                } else if ($key == 'NA_A9') {
                    $betInfo = '猴';
                } else if ($key == 'NA_AA') {
                    $betInfo = '鸡';
                } else if ($key == 'NA_AB') {
                    $betInfo = '狗';
                } else if ($key == 'NA_AC') {
                    $betInfo = '猪';
                } else if ($key == 'C7_R') {
                    $betInfo = '正肖 红波';
                } else if ($key == 'C7_G') {
                    $betInfo = '正肖 绿波';
                } else if ($key == 'C7_B') {
                    $betInfo = '正肖 蓝波';
                } else if ($key == 'C7_N') {
                    $betInfo = '正肖 和局';
                }
            } else if ($rType == 'SPB') {
                if ($key == 'SP_B1') {
                    $betInfo = '鼠';
                } else if ($key == 'SP_B2') {
                    $betInfo = '牛';
                } else if ($key == 'SP_B3') {
                    $betInfo = '虎';
                } else if ($key == 'SP_B4') {
                    $betInfo = '兔';
                } else if ($key == 'SP_B5') {
                    $betInfo = '龙';
                } else if ($key == 'SP_B6') {
                    $betInfo = '蛇';
                } else if ($key == 'SP_B7') {
                    $betInfo = '马';
                } else if ($key == 'SP_B8') {
                    $betInfo = '羊';
                } else if ($key == 'SP_B9') {
                    $betInfo = '猴';
                } else if ($key == 'SP_BA') {
                    $betInfo = '鸡';
                } else if ($key == 'SP_BB') {
                    $betInfo = '狗';
                } else if ($key == 'SP_BC') {
                    $betInfo = '猪';
                } else if ($key == 'NF0') {
                    $betInfo = '尾0';
                } else if ($key == 'NF1') {
                    $betInfo = '尾1';
                } else if ($key == 'NF2') {
                    $betInfo = '尾2';
                } else if ($key == 'NF3') {
                    $betInfo = '尾3';
                } else if ($key == 'NF4') {
                    $betInfo = '尾4';
                } else if ($key == 'NF5') {
                    $betInfo = '尾5';
                } else if ($key == 'NF6') {
                    $betInfo = '尾6';
                } else if ($key == 'NF7') {
                    $betInfo = '尾7';
                } else if ($key == 'NF8') {
                    $betInfo = '尾8';
                } else if ($key == 'NF9') {
                    $betInfo = '尾9';
                } else if ($key == 'TX2') {
                    $betInfo = '234肖';
                } else if ($key == 'TX5') {
                    $betInfo = '5肖';
                } else if ($key == 'TX6') {
                    $betInfo = '6肖';
                } else if ($key == 'TX7') {
                    $betInfo = '7肖';
                } else if ($key == 'TX_ODD') {
                    $betInfo = '总肖单';
                } else if ($key == 'TX_EVEN') {
                    $betInfo = '总肖双';
                }
            } else if ($rType == 'HB') {
                if ($key == 'HB_RODD') {
                    $betInfo = '红单';
                } else if ($key == 'HB_REVEN') {
                    $betInfo = '红双';
                } else if ($key == 'HB_ROVER') {
                    $betInfo = '红大';
                } else if ($key == 'HB_RUNDER') {
                    $betInfo = '红小';
                } else if ($key == 'HB_GODD') {
                    $betInfo = '绿单';
                } else if ($key == 'HB_GEVEN') {
                    $betInfo = '绿双';
                } else if ($key == 'HB_GOVER') {
                    $betInfo = '绿大';
                } else if ($key == 'HB_GUNDER') {
                    $betInfo = '绿小';
                } else if ($key == 'HB_BODD') {
                    $betInfo = '蓝单';
                } else if ($key == 'HB_BEVEN') {
                    $betInfo = '蓝双';
                } else if ($key == 'HB_BOVER') {
                    $betInfo = '蓝大';
                } else if ($key == 'HB_BUNDER') {
                    $betInfo = '蓝小';
                } else if ($key == 'HH_ROO') {
                    $betInfo = '红大单';
                } else if ($key == 'HH_ROE') {
                    $betInfo = '红大双';
                } else if ($key == 'HH_RUO') {
                    $betInfo = '红小单';
                } else if ($key == 'HH_RUE') {
                    $betInfo = '红小双';
                } else if ($key == 'HH_GOO') {
                    $betInfo = '绿大单';
                } else if ($key == 'HH_GOE') {
                    $betInfo = '绿大双';
                } else if ($key == 'HH_GUO') {
                    $betInfo = '绿小单';
                } else if ($key == 'HH_GUE') {
                    $betInfo = '绿小双';
                } else if ($key == 'HH_BOO') {
                    $betInfo = '蓝大单';
                } else if ($key == 'HH_BOE') {
                    $betInfo = '蓝大双';
                } else if ($key == 'HH_BUO') {
                    $betInfo = '蓝小单';
                } else if ($key == 'HH_BUE') {
                    $betInfo = '蓝小双';
                }
            }
        }
        return $betInfo;
    }

    public static function validateNumber($value, $type) {
        $array = explode(',', $value);
        if ($type == '连肖') {
            foreach ($array as $value) {
                if (!($value === '鼠') && !($value == '牛') && !($value == '虎') && !($value == '兔') && !($value == '龙') && !($value == '蛇') && !($value == '马') && !($value == '羊') && !($value == '猴') && !($value == '鸡') && !($value == '狗') && !($value == '猪')) {
                    CommonFc::error2('你选择的号码有问题，请重新下注。' . $type);
                }
            }
        } else if ($type == '连尾') {
            foreach ($array as $value) {
                if (!(-1 < intval($value)) && (intval($value) < 10)) {
                    CommonFc::error2('你选择的号码有问题，请重新下注。' . $type);
                }
            }
        } else if ($type == '正码过关') {
            foreach ($array as $value) {
                if (mb_substr($value, 0, 2, 'utf-8') != '正码') {
                    CommonFc::error2('你选择的号码有问题，请重新下注。' . $type);
                }
            }
        } else {
            foreach ($array as $value) {
                if (!(0 < intval($value)) && (intval($value) < 50)) {
                    CommonFc::error2('你选择的号码有问题，请重新下注。' . $type);
                }
            }
        }
    }

    static public function error1($msg) {//重新下
        echo "<div class=\"match_error\">" . $msg . "</div>";
        echo "<script>";
        echo "$(\"#post_s\").css(\"display\",\"none\");";
        echo "$(\"#touzhudiv\").css(\"display\",\"block\");";
        echo "waite();";
        echo "clear_input();";
        echo "$(\"#bet_money\").val(\"\");";
        echo "</script>";

        exit;
    }

    static public function error2($msg) {//关闭
        echo "<div class=\"match_error\">" . $msg . "</div>";
        echo "<script>";
        echo "$(\"#post_s\").css(\"display\",\"none\");";
        echo "$(\"#touzhudiv\").html('');";
        echo "window.clearTimeout(winRedirect);";
        echo "clear_input();";
        echo "$(\"#bet_money\").val(\"\");";
        echo "$(\"#okclose\").css(\"display\",\"none\");";
        echo "$(\"#okbtn\").css(\"display\",\"none\");";
        echo "$(\"#closebtn\").css(\"display\",\"block\");";
        echo "$(\"#cg_num\").html('0');";
        echo "$(\"#cg_msg\").css(\"display\",\"none\");";
        echo "cg_count=0;";
        echo "</script>";
        exit;
    }

    static public function msgok($msg, $msg2, $money) {//关闭
        echo "<div class=\"match_ok\">" . $msg . "</div>";
        echo "<div class=\"match_ok\">" . $msg2 . "</div>";
        echo "<script>";
        echo "$(\"#post_s\").css(\"display\",\"none\");";
        echo "$(\"#touzhudiv\").html('');";
        echo "window.clearTimeout(winRedirect);";
        echo "clear_input();";
        echo "$(\"#bet_money\").val(\"\");";
        echo "$(\"#okclose\").css(\"display\",\"none\");";
        echo "$(\"#okbtn\").css(\"display\",\"none\");";
        echo "$(\"#closebtn\").css(\"display\",\"block\");";
        echo "$(\"#user_money\").html('" . $money . "');";
        echo "$(\"#cg_num\").html('0');";
        echo "$(\"#cg_msg\").css(\"display\",\"none\");";
        echo "cg_count=0;";

        echo "</script>";

        exit;
    }

    public function getNapInfo($enName) {
        $name = '';
        $number = '';
        $subString = substr($enName, 4);
        if ($subString == '_ODD') {
            $name = '单';
            $number = '1';
        } else if ($subString == '_EVEN') {
            $name = '双';
            $number = '2';
        } else if ($subString == '_OVER') {
            $name = '大';
            $number = '3';
        } else if ($subString == '_UNDER') {
            $name = '小';
            $number = '4';
        } else if ($subString == '_SODD') {
            $name = '和单';
            $number = '5';
        } else if ($subString == '_SEVEN') {
            $name = '和双';
            $number = '6';
        } else if ($subString == '_SOVER') {
            $name = '和大';
            $number = '7';
        } else if ($subString == '_SUNDER') {
            $name = '和小';
            $number = '8';
        } else if ($subString == '_FOVER') {
            $name = '尾大';
            $number = '9';
        } else if ($subString == '_FUNDER') {
            $name = '尾小';
            $number = '10';
        } else if ($subString == '_R') {
            $name = '红波';
            $number = '11';
        } else if ($subString == '_G') {
            $name = '绿波';
            $number = '12';
        } else if ($subString == '_B') {
            $name = '蓝波';
            $number = '13';
        }
        $info = array($name, $number);
        return $info;
    }
    
    function getLxOddsCount($lx_name) {
        $count = "";
        if ($lx_name == "A1") {
            $count = "1";
        } elseif ($lx_name == "A2") {
            $count = "2";
        } elseif ($lx_name == "A3") {
            $count = "3";
        } elseif ($lx_name == "A4") {
            $count = "4";
        } elseif ($lx_name == "A5") {
            $count = "5";
        } elseif ($lx_name == "A6") {
            $count = "6";
        } elseif ($lx_name == "A7") {
            $count = "7";
        } elseif ($lx_name == "A8") {
            $count = "8";
        } elseif ($lx_name == "A9") {
            $count = "9";
        } elseif ($lx_name == "AA") {
            $count = "10";
        } elseif ($lx_name == "AB") {
            $count = "11";
        } elseif ($lx_name == "AC") {
            $count = "12";
        }
        return $count;
    }


    static public function year_change1(){
        $zodiacArray = array(
            '09, 21, 33, 45'
        , '08, 20, 32, 44'
        , '07, 19, 31, 43'
        , '06, 18, 30, 42'
        , '05, 17, 29, 41'
        , '04, 16, 28, 40'
        , '03, 15, 27, 39'
        , '02, 14, 26, 38'
        , '01, 13, 25, 37, 49'
        , '12, 24, 36, 48'
        , '11, 23, 35, 47'
        ,'10, 22, 34, 46'

        );
        return $zodiacArray;
    }
    static public function year_change2(){
        $zodiac = 'zodiac : ["10, 22, 34, 46","11, 23, 35, 47","12, 24, 36, 48","01, 13, 25, 37, 49","02, 14, 26, 38","03, 15, 27, 39","04, 16, 28, 40","05, 17, 29, 41","06, 18, 30, 42","07, 19, 31, 43","08, 20, 32, 44","09, 21, 33, 45"],';
        return $zodiac;
    }
    static public function  year_change3(){//过年之后修改（数组进一）
        $xArray['A1'] = array('09', '21', '33', '45');//鼠
        $xArray['A2'] = array('08', '20', '32', '44');//牛
        $xArray['A3'] = array('07', '19', '31', '43');//虎
        $xArray['A4'] = array('06', '18', '30', '42');//兔
        $xArray['A5'] = array('05', '17', '29', '41');//龙
        $xArray['A6'] = array('04', '16', '28', '40');//蛇
        $xArray['A7'] = array('03', '15', '27', '39');//马
        $xArray['A8'] = array('02', '14', '26', '38');//羊
        $xArray['A9'] = array('01', '13', '25', '37', '49');//猴
        $xArray['AA'] = array('12', '24', '36', '48');//鸡
        $xArray['AB'] = array('11', '23', '35', '47');//狗
        $xArray['AC'] = array('10', '22', '34', '46');//猪
        $xArray['year'] = "2016-02-08 00:00:01";
        return $xArray;
    }

    /**
     * 开奖处理器
     * @param type $ball        开奖号码
     * @param type $dateTime    开奖时间
     * @return string           返回开奖动物
     */
    static public function lhcSumSx($ball, $dateTime) {
        $animal = '';
        $arr = CommonFc::year_change3();
        $date = $arr['year'];
        if (strtotime($dateTime) < strtotime($date)) {
            if (in_array(CommonFc::BuLing($ball), $arr['A1'])) { $animal = '猪'; }
            else if (in_array(CommonFc::BuLing($ball), $arr['A2'])) { $animal = '鼠';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A3'])) { $animal = '牛';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A4'])) { $animal = '虎';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A5'])) { $animal = '兔';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A6'])) { $animal = '龙';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A7'])) { $animal = '蛇';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A8'])) { $animal = '马';}
            else if (in_array(CommonFc::BuLing($ball), $arr['A9'])) { $animal = '羊';}
            else if (in_array(CommonFc::BuLing($ball), $arr['AA'])) { $animal = '猴';}
            else if (in_array(CommonFc::BuLing($ball), $arr['AB'])) { $animal = '鸡';}
            else if (in_array(CommonFc::BuLing($ball), $arr['AC'])) { $animal = '狗';}
        }
        else if (in_array(CommonFc::BuLing($ball), $arr['A2'])) { $animal = '牛';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A3'])) { $animal = '虎';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A4'])) { $animal = '兔';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A5'])) { $animal = '龙';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A6'])) { $animal = '蛇';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A7'])) { $animal = '马';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A8'])) { $animal = '羊';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A9'])) { $animal = '猴';}
        else if (in_array(CommonFc::BuLing($ball), $arr['AA'])) { $animal = '鸡';}
        else if (in_array(CommonFc::BuLing($ball), $arr['AB'])) { $animal = '狗';}
        else if (in_array(CommonFc::BuLing($ball), $arr['AC'])) { $animal = '猪';}
        else if (in_array(CommonFc::BuLing($ball), $arr['A1'])) { $animal = '鼠';}
        return $animal;
    }
    /**
     * 开奖处理器2（小于10的开奖号码前面加0，形成新的字符串）
     * @param string $num   开奖号码
     * @return string
     */
    static public function BuLing($num) {
        if ($num < 10) { $num = '0' . $num; }
        return $num;
    }

    /**
     * 获取号码生肖
     * @param string $num   开奖号码
     * @param string $time  对应时间（时间戳）
     * @return string
     */
    public function numToAnimal($num,$time) {
        //年份处理
        $year_list = (new Zodiac())->getYearList();
        $year = date('Y',$time);
        asort($year_list);
        foreach ($year_list as $key=>$y){
            if((date('Y-m-d',$time)>=$y)&&(date('Y-m-d',$time)<$year_list[$key+1])){
                $year = substr($y,0,4);
                break;
            }
        }
        $zodiac=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
        $lists = $this->_zoadiacList($year);
        if($lists){
            foreach ($lists as $key=>$val){
                if($val){
                    if(in_array($num,$val)){
                        return $zodiac[$key];
                    }
                }
            }
        }
        return false;
    }
    /**
     * 获取每年的生肖号码数组
     * @param $currentYear
     * @return array
     */
    public function _zoadiacString($currentYear){
        if(!$currentYear) $currentYear=date('Y',time());
        $lists=array();
        for($i=0;$i<49;$i++){
            $k=($currentYear-1948-$i)%12;
            if(isset($lists[$k])){
                $lists[$k].=',';
            }else{
                $lists[$k]='';
            }
            $lists[$k].=str_pad($i+1,2,'0',STR_PAD_LEFT);
            ksort($lists);
        }
        return $lists;
    }
    /**
     * 获取每年的生肖号码数组
     * @param $currentYear
     * @return array
     */
    public function _zoadiacList($currentYear){
        if(!$currentYear) $currentYear=date('Y',time());
        $lists=array();
        for($i=0;$i<49;$i++){
            $k=($currentYear-1948-$i)%12;
            if(isset($lists[$k])){
                $lists[$k].=',';
            }else{
                $lists[$k]='';
            }
            $lists[$k].=str_pad($i+1,2,'0',STR_PAD_LEFT);
        }
        ksort($lists);
        if($lists){
            foreach ($lists as $key=>$val){
                $lists[$key] = explode(',',$val);
            }
        }
        return $lists;
    }
    
    /*
  * 获取色波
  * @params $num 单个号码数
  * @return int （1；红，2:蓝，3:绿）
  */
    static public function sebo($num){
        if($num<1||$num>49){return -1;}
        if($num%20==1){
            return $num>20?($num>40?2:3):1;
        }else{
            $arr=array(array(1,2,7,8),array(3,4,9,10),array(0,5,6));
            foreach($arr as $k=>$v){
                if(in_array($num%11,$v)){
                    return $k+1;
                }
            }
        }
    }
	static function tms($num){
		$num=(int)$num;
		$tis=array();
		$tis[0]=(int)($num/3600);
		$tis[1]=(int)($num/60)%60;
		$tis[2]=(int)($num-$tis[0]*3600-$tis[1]*60);
		foreach($tis as $k=>$v){
			if($v<10){
				$tis[$k]='0'.$v;
			}
		}
		return implode(':',$tis);
	}
}


