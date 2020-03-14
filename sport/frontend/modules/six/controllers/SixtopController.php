<?php

namespace app\modules\six\controllers;

use app\common\base\BaseController;
use app\modules\six\helpers\Zodiac;
use Yii;
use yii\web\Controller;
use app\modules\six\models\SixLotteryOrder;
use app\modules\six\models\SixLotteryOdds;
use app\modules\six\models\SixLotterySchedule;
use app\modules\six\models\OrderLottery;
use app\modules\six\models\LotteryResultLhc;
use app\modules\six\models\UserList;
use app\modules\six\models\SysAnnouncement;
use app\modules\six\models\CommonFc\CommonFc;

/**
 * 六合彩头部
 * SixtopController
 */
class SixtopController extends BaseController  {

    public function init() {
        parent::init();

        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->getView()->title = '六合彩';
        $this->layout = 'main';
    }

    /**
     * 开奖结果
     */
    public function actionKaijiang() {
        $this->layout=false;
        $CommonFc = new CommonFc();
        $query_time = date('Y-m-d', time());
        $getNews = Yii::$app->request->get();
        $qishu_query = null;
        $getNews['gtype'] = 'LT';
        if (isset($getNews['s_time'])) {
            $query_time = $getNews['s_time'];
        }
        if (isset($getNews['qishu_query'])) {
            $qishu_query = $getNews['qishu_query'];
        }

        $time =  (new Zodiac())->getNewYearTime();
        $arr = LotteryResultLhc::getSixResult($qishu_query,'',$time);
        $hasRow = 'false';
        foreach ($arr as $key => $rows) {
            $arr[$key]['Animal'] = $CommonFc->numToAnimal($rows['ball_1'], strtotime($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_2'], strtotime($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_3'],
                    strtotime($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_4'], strtotime($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_5'],
                    strtotime($rows['datetime'])) . $CommonFc->numToAnimal($rows['ball_6'], strtotime($rows['datetime'])) . '+' . $CommonFc->numToAnimal($rows['ball_7'], strtotime($rows['datetime']));
        }
        return $this->render('Kaijiang',array('qishu_query'=>$qishu_query,'query_time'=>$query_time,'arr'=>$arr,'hasRow'=>$hasRow));

    }

    /**
     * 公告
     */
    public function actionNews(){
        $this->layout=false;
        $newestAnnouncement = SysAnnouncement::getNewestAnnouncement();
        $announcementArray = SysAnnouncement::getAnnouncementList();
        return $this->render('News',array('announcementArray'=>$announcementArray,'newestAnnouncement'=>$newestAnnouncement));
    }

    /**
     * 快选金额
     */
    public function actionQuick(){
        $this->layout=false;
        return $this->render('Quick');
    }
    /**
     * 快选金额修改存储
     */
    public function actionGold_act(){
        echo "SaveIsOk";
    }
}
