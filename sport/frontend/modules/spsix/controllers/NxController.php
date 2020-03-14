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
 * 极速六合彩-合肖
 * NapController
 */
class NxController extends BaseController  {

    public function init() {
        parent::init();

        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->layout = 'main';
    }

    public function actionBetView(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->out(false,'未登录，请先登录');
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) { return $this->out(false,'没有数据提交');}
        $rType = $postNews['rtype'];
        $checkArray = $postNews['lt_nx'];
        $row = SpsixLotterySchedule::getNewestLottery();
        $qishu = $row['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['splhc_lower_bet'];
        $maxMoney = $row['splhc_max_bet'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $odds_NX = SpsixLotteryOdds::getOdds("NX");
        $selectCount = 0;
        $animalString = "";
        $unSelectAnimal = "";
        foreach ($checkArray as $value) {
            if ($value == "NX_A1") {
                $animalString .= "鼠,";
                $selectCount += 1;
            } elseif ($value == "NX_A2") {
                $animalString .= "牛,";
                $selectCount += 1;
            } elseif ($value == "NX_A3") {
                $animalString .= "虎,";
                $selectCount += 1;
            } elseif ($value == "NX_A4") {
                $animalString .= "兔,";
                $selectCount += 1;
            } elseif ($value == "NX_A5") {
                $animalString .= "龙,";
                $selectCount += 1;
            } elseif ($value == "NX_A6") {
                $animalString .= "蛇,";
                $selectCount += 1;
            } elseif ($value == "NX_A7") {
                $animalString .= "马,";
                $selectCount += 1;
            } elseif ($value == "NX_A8") {
                $animalString .= "羊,";
                $selectCount += 1;
            } elseif ($value == "NX_A9") {
                $animalString .= "猴,";
                $selectCount += 1;
            } elseif ($value == "NX_AA") {
                $animalString .= "鸡,";
                $selectCount += 1;
            } elseif ($value == "NX_AB") {
                $animalString .= "狗,";
                $selectCount += 1;
            } elseif ($value == "NX_AC") {
                $animalString .= "猪,";
                $selectCount += 1;
            }
        }
        $animalString = substr($animalString, 0, -1);
        if (strpos($animalString, "鼠") === false) {
            $unSelectAnimal .= "鼠,";
        }
        if (strpos($animalString, "牛") === false) {
            $unSelectAnimal .= "牛,";
        }
        if (strpos($animalString, "虎") === false) {
            $unSelectAnimal .= "虎,";
        }
        if (strpos($animalString, "兔") === false) {
            $unSelectAnimal .= "兔,";
        }
        if (strpos($animalString, "龙") === false) {
            $unSelectAnimal .= "龙,";
        }
        if (strpos($animalString, "蛇") === false) {
            $unSelectAnimal .= "蛇,";
        }
        if (strpos($animalString, "马") === false) {
            $unSelectAnimal .= "马,";
        }
        if (strpos($animalString, "羊") === false) {
            $unSelectAnimal .= "羊,";
        }
        if (strpos($animalString, "猴") === false) {
            $unSelectAnimal .= "猴,";
        }
        if (strpos($animalString, "鸡") === false) {
            $unSelectAnimal .= "鸡,";
        }
        if (strpos($animalString, "狗") === false) {
            $unSelectAnimal .= "狗,";
        }
        if (strpos($animalString, "猪") === false) {
            $unSelectAnimal .= "猪,";
        }
        $unSelectAnimal = substr($unSelectAnimal, 0, -1);
        if ($rType == "NX_IN") {
            $descName = "合肖 中";
            $oddsValue = $odds_NX["h" . $selectCount];
            $postAnimal = $animalString;
            $postCount = $selectCount;
            if ($selectCount < 2 || $selectCount > 11) {
                return  $this->out(false,"数据不正确");
            }
        } elseif ($rType == "NX_OUT") {
            $descName = "合肖 不中";
            $oddsValue = $odds_NX["h" . (12 - $selectCount)];
            $postAnimal = $unSelectAnimal;
            $postCount = 12 - $selectCount;
            if ($selectCount < 1 || $selectCount > 10) {
               return  $this->out(false,"数据不正确");
            }
        }
        $nums = explode(',',$animalString);
        if(count($nums)!=count(array_unique($nums))){//过滤号码是否有重复
            return $this->out(false,"号码错误，不能下注");
        }

        return $this->out(true,
            $this->render('BetViewPc',
                array(
                    'qishu'=>$qishu,
                    'descName'=>$descName,
                    'oddsValue'=>$oddsValue,
                    'animalString'=>$animalString,
                    'lowestMoney'=>$lowestMoney,
                    'maxMoney'=>$maxMoney,
                    'postCount'=>$postCount,
                    'postAnimal'=>$postAnimal,
                    'userMoney'=>$userMoney
                )
            )
        );


    }

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
        $checkArray = $postNews['lt_nx'];
        $row = SpsixLotterySchedule::getNewestLottery();
        $qishu = $row['qishu'];
        $row = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row['splhc_lower_bet'];
        $maxMoney = $row['splhc_max_bet'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $odds_NX = SpsixLotteryOdds::getOdds("NX");
        $selectCount = 0;
        $animalString = "";
        $unSelectAnimal = "";
        foreach ($checkArray as $value) {
            if ($value == "NX_A1") {
                $animalString .= "鼠,";
                $selectCount += 1;
            } elseif ($value == "NX_A2") {
                $animalString .= "牛,";
                $selectCount += 1;
            } elseif ($value == "NX_A3") {
                $animalString .= "虎,";
                $selectCount += 1;
            } elseif ($value == "NX_A4") {
                $animalString .= "兔,";
                $selectCount += 1;
            } elseif ($value == "NX_A5") {
                $animalString .= "龙,";
                $selectCount += 1;
            } elseif ($value == "NX_A6") {
                $animalString .= "蛇,";
                $selectCount += 1;
            } elseif ($value == "NX_A7") {
                $animalString .= "马,";
                $selectCount += 1;
            } elseif ($value == "NX_A8") {
                $animalString .= "羊,";
                $selectCount += 1;
            } elseif ($value == "NX_A9") {
                $animalString .= "猴,";
                $selectCount += 1;
            } elseif ($value == "NX_AA") {
                $animalString .= "鸡,";
                $selectCount += 1;
            } elseif ($value == "NX_AB") {
                $animalString .= "狗,";
                $selectCount += 1;
            } elseif ($value == "NX_AC") {
                $animalString .= "猪,";
                $selectCount += 1;
            }
        }
        $animalString = substr($animalString, 0, -1);
        if (strpos($animalString, "鼠") === false) {
            $unSelectAnimal .= "鼠,";
        }
        if (strpos($animalString, "牛") === false) {
            $unSelectAnimal .= "牛,";
        }
        if (strpos($animalString, "虎") === false) {
            $unSelectAnimal .= "虎,";
        }
        if (strpos($animalString, "兔") === false) {
            $unSelectAnimal .= "兔,";
        }
        if (strpos($animalString, "龙") === false) {
            $unSelectAnimal .= "龙,";
        }
        if (strpos($animalString, "蛇") === false) {
            $unSelectAnimal .= "蛇,";
        }
        if (strpos($animalString, "马") === false) {
            $unSelectAnimal .= "马,";
        }
        if (strpos($animalString, "羊") === false) {
            $unSelectAnimal .= "羊,";
        }
        if (strpos($animalString, "猴") === false) {
            $unSelectAnimal .= "猴,";
        }
        if (strpos($animalString, "鸡") === false) {
            $unSelectAnimal .= "鸡,";
        }
        if (strpos($animalString, "狗") === false) {
            $unSelectAnimal .= "狗,";
        }
        if (strpos($animalString, "猪") === false) {
            $unSelectAnimal .= "猪,";
        }
        $unSelectAnimal = substr($unSelectAnimal, 0, -1);
        if ($rType == "NX_IN") {
            $descName = "合肖 中";
            $oddsValue = $odds_NX["h" . $selectCount];
            $postAnimal = $animalString;
            $postCount = $selectCount;
            if ($selectCount < 2 || $selectCount > 11) {
                echo "数据不正确";
                exit;
            }
        } elseif ($rType == "NX_OUT") {
            $descName = "合肖 不中";
            $oddsValue = $odds_NX["h" . (12 - $selectCount)];
            $postAnimal = $unSelectAnimal;
            $postCount = 12 - $selectCount;
            if ($selectCount < 1 || $selectCount > 10) {
                echo "数据不正确";
                exit;
            }
        }

        return $this->render('BetView',
            array(
                'qishu'=>$qishu,
                'descName'=>$descName,
                'oddsValue'=>$oddsValue,
                'animalString'=>$animalString,
                'lowestMoney'=>$lowestMoney,
                'maxMoney'=>$maxMoney,
                'postCount'=>$postCount,
                'postAnimal'=>$postAnimal
            )
        );
    }

}