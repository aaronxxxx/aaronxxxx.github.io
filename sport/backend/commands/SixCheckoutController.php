<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票結算
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\common\controllers\SixCheckoutController as SixCheckout;

class SixCheckoutController extends Controller
{
    public function actionIndex($params1='SIX'){
		if($params1 == 'SPSIX'){
			$lotteryConfig = [
				'SPSIX' => [
					'name' => '极速六合彩',
					'balls' => 7,
				],
			];
		}else{
			$lotteryConfig = [
				'SIX' => [
					'name' => '六合彩',
					'balls' => 7,
				],
			];
		}
		

		$SixCheckout = new SixCheckout();
		foreach($lotteryConfig as $key1 => $value1){
			//$result = $this->actionLotteryCheckout($key1, $value1['balls']);
			$result = $SixCheckout->actionLotteryCheckout($key1, $value1['balls'], '');
			echo  $key1 . ' ' . json_encode($result) . PHP_EOL;
		}
    }
	
	
}