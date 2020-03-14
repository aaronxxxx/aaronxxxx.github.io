<?php
namespace app\modules\general\mobile\controllers;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 11:10
 */
use app\modules\general\member\models\TransactionLog\LiveUser;
use Yii;
use yii\helpers\ArrayHelper;
use app\common\base\BaseController;
use app\modules\six\services\SixReportService;
use app\modules\spsix\services\SpsixReportService;
use app\modules\lottery\services\LotteryReportService;

class MoneyLogController extends BaseController{

    public function init() {
        parent::init();

        $this->getView()->title = '交易记录';
        $this->layout = 'member.php';
    }

    /**
     * 盈利统计展示
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户盈利数据信息，传至盈利统计页面
     * @return mixed
     */
    public function actionIndex(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }
        $live = $lottery = array();
        $getDatas = Yii::$app->request->get();
        $user_id = Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $time['s_time'] = ArrayHelper::getValue($getDatas,'s_time', date('Y-m-d'));
        $time['e_time'] = ArrayHelper::getValue($getDatas,'e_time', date('Y-m-d'));
        $type = ArrayHelper::getValue($getDatas,'type', 1);
        $s_time = $time['s_time']." 00:00:00";
        $e_time = $time['e_time']." 23:59:59";
        $sev_six = new SixReportService();
        $six = $sev_six->SixLotteryProfit($s_time, $e_time, $user_id);
        $sev_spsix = new SpsixReportService();
        $spsix = $sev_spsix->SixLotteryProfit($s_time, $e_time, $user_id);
        $service = new LotteryReportService();
        $lottery = $service->getWinMoney($s_time,$e_time,$user_id);
        $live = LiveUser::getLiveBetMoneyAndCount($time['s_time'], $time['e_time'], $user_id);
        $this->layout = 'member.php';
        return $this->render('index',[
            'six'=>$six,
            'spsix'=>$spsix,
            'live'=>$live,
            'lottery'=>$lottery,
            'time'=>$time,
            'type'=>$type
        ]);
    }





}