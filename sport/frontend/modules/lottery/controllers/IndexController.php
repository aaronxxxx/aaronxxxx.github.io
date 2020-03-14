<?php
namespace app\modules\lottery\controllers;

use app\modules\lottery\models\ar\WebClose;
use app\modules\mobile\controllers\lottery\WebcloseController;
use yii\web\Controller;
use YII;
use app\modules\lottery\models\ar\UserList;
use app\modules\lottery\models\ar\OrderLottery;
use app\modules\lottery\models\ar\LotterySchedule;
/**
 * TestController
 */
class IndexController extends Controller {

    /*
     * 获取所有游戏封盘时间
     * 下期开奖期号、剩余封盘时间、剩余开奖时间
     * 最后一期开奖期号、开奖号码
     * */
    public function actionAjaxFengpan(){
        $cqssc = \app\modules\lottery\modules\lzcqssc\controllers\IndexController::getCqsscInfo();
        $cqsfc = \app\modules\lottery\modules\lzcqsf\controllers\IndexController::getCqsfcInfo();
        $fc3d = \app\modules\lottery\modules\lzfc3d\controllers\IndexController::getFc3dInfo();
        $gd11 = \app\modules\lottery\modules\lzgd11\controllers\IndexController::getGd11x5Info();
        $gdsfc = \app\modules\lottery\modules\lzgdsf\controllers\IndexController::getGdsfInfo();
        $gxsf = \app\modules\lottery\modules\lzgxsf\controllers\IndexController::getGxsfInfo();
        $kl8 = \app\modules\lottery\modules\lzkl8\controllers\IndexController::getBjkl8Info();
        $pk10 = \app\modules\lottery\modules\lzpk10\controllers\IndexController::getBjpk10Info();
        $pl3 = \app\modules\lottery\modules\lzpl3\controllers\IndexController::getPl3Info();
        $shssl = \app\modules\lottery\modules\lzshssl\controllers\IndexController::getShsslInfo();
        $tjsf = \app\modules\lottery\modules\lztjsf\controllers\IndexController::getTjsfcInfo();
        $tjssc = \app\modules\lottery\modules\lztjssc\controllers\IndexController::getTjsscInfo();
        $lotterInfo = [
            'cqssc' => $cqssc,
            'cqsfc' => $cqsfc,
            'fc3d' => $fc3d,
            'gd11' => $gd11,
            'gdsfc' => $gdsfc,
            'gxsf' => $gxsf,
            'kl8' => $kl8,
            'pk10' => $pk10,
            'pl3' => $pl3,
            'shssl' => $shssl,
            'tjsf' => $tjsf,
            'tjssc' => $tjssc,
        ];
        return json_encode($lotterInfo);
    }
}