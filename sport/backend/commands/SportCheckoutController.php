<?php
/**
 * @auth Johnny
 * @date 2019-08-30
 * @運動項目結算
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\common\controllers\SportCheckoutController as SportCheckout;

class SportCheckoutController extends Controller
{
    public function actionIndex(){

		//啟動結算動作
		$result = SportCheckout::actionLotteryCheckout();
		echo  json_encode($result) . PHP_EOL;
		
    }
}