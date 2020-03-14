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
 * 六合彩-正码过关
 * NapController
 */
class NapController extends BaseController  {

    public function init() {
        parent::init();

        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->layout = 'main';
    }

    /**
     * 正码过关 注单显示处理
     * @return mixed
     */
    public function actionBetView() {
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->out(false,'未登录，请先登录');
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) { echo $this->out(false,'没有数据提交');exit;}
        $common = new CommonFc();
        for ($i=1;$i<=6;$i++){
            if (empty($postNews['game'.$i])) {$postNews['game'.$i] = '';}
            $game[$i]=  $postNews['game'.$i];
            $gameinfo[$i] = $common->getNapInfo($game[$i]);
            $odds_NAP[$i] = SixLotteryOdds::getOdds("NAP".$i);
        }
        $selectCount = ($game[1] ? 1 : 0) + ($game[2] ? 1 : 0) + ($game[3] ? 1 : 0) + ($game[4] ? 1 : 0) + ($game[5] ? 1 : 0) + ($game[6] ? 1 : 0);
        $row = SixLotterySchedule::getNewestLottery();
        $qishu=$row['qishu'];
        $row2 = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row2['lhc_lower_bet'];
        $maxMoney = $row2['lhc_max_bet'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        $boll = array('一','二','三','四','五','六');
        return $this->out(true,$this->render('BetViewPc',
                            array(  'userMoney'=>$userMoney,
                                'lowestMoney'=>$lowestMoney,
                                'maxMoney'=>$maxMoney,
                                'selectCount'=>$selectCount,
                                'qishu'=>$qishu,
                                'game'=>$game,
                                'gameInfo'=>$gameinfo,
                                'odds_NAP'=>$odds_NAP,
                                'boll'=>$boll
              )));
    }

    /**
     * 取消
     */
    public function actionTuichu() {
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $userid = '54971608';
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $user = UserList::getUserNewsByUserId($userid);
        $result['user_name'] = $user['user_name'];
        $result['money'] = $user['money'];
        echo json_encode($result);
    }

    /**
     * 正码过关手机端下注注单显示
     * @return string
     */
    public function actionMobileBetView()
    {
        $this->layout = false;
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            echo("未登录，请先登录");
            exit;
        } else {
            $userid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        }
        $postNews = Yii::$app->request->post();
        if (!$postNews) {
            echo '没有数据提交';
            exit;
        }
        $common = new CommonFc();
        for ($i=1;$i<=6;$i++){
            if (empty($postNews['game'.$i])) {$postNews['game'.$i] = '';}
            $game[$i] = $postNews['game'.$i];
            $gameInfo[$i] = $common->getNapInfo($game[$i]);
            $odds_NAP[$i] = SixLotteryOdds::getOdds("NAP".$i);
        }
        $selectCount = ($game[1] ? 1 : 0) + ($game[2] ? 1 : 0) + ($game[3] ? 1 : 0) + ($game[4] ? 1 : 0) + ($game[5] ? 1 : 0) + ($game[6] ? 1 : 0);
        $row = SixLotterySchedule::getNewestLottery();
        $qishu = $row['qishu'];
        $row2 = UserGroup::getLimitAndFsMoney($userid);
        $lowestMoney = $row2['lhc_lower_bet'];
        $maxMoney = $row2['lhc_max_bet'];
        $user = UserList::getUserNewsByUserId($userid);
        $userMoney = $user['money'];
        if($postNews) {
           return $this->render('BetView',
               array(
                   'postNews' => $postNews,
                   'game1Info' => $gameInfo[1],
                   'game2Info' => $gameInfo[2],
                   'game3Info' => $gameInfo[3],
                   'game4Info' => $gameInfo[4],
                   'game5Info' => $gameInfo[5],
                   'game6Info' => $gameInfo[6],
                   'odds_NAP1' => $odds_NAP[1],
                   'odds_NAP2' => $odds_NAP[2],
                   'odds_NAP3' => $odds_NAP[3],
                   'odds_NAP4' => $odds_NAP[4],
                   'odds_NAP5' => $odds_NAP[5],
                   'odds_NAP6' => $odds_NAP[6],
                   'qishu' => $qishu,
                   'selectCount' => $selectCount,
                   'lowestMoney' => $lowestMoney,
                   'maxMoney' => $maxMoney,
                   'userMoney' => $userMoney
               )
           );
        } else {
            echo "没有数据提交";
            exit;
        }
    }
}
