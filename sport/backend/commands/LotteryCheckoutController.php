<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票結算 
 * Last Edith:新增 極速賽車結算
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\common\controllers\LotteryCheckoutController as LotteryCheckout;

class LotteryCheckoutController extends Controller
{
    public function actionIndex(){
		$lotteryConfig = [
			'BJPK' => [
				'name' => '北京PK拾',
				'balls' => 10,
			],
			'D3' => [
				'name' => '3D彩',
				'balls' => 3,
			],
			'P3' => [
				'name' => '排列三',
				'balls' => 3,
			],
			'T3' => [
				'name' => '上海时时乐',
				'balls' => 3,
			],
			'BJKN' => [
				'name' => '北京快乐8',
				'balls' => 20,
			],
			'TJ' => [
				'name' => '极速时时彩',
				'balls' => 5,
			],
			'CQ' => [
				'name' => '重庆时时彩',
				'balls' => 5,
			],
			'GD11' => [
				'name' => '广东11选5',
				'balls' => 5,
			],
			'GXSF' => [
				'name' => '广西十分彩',
				'balls' => 5,
			],
			'CQSF' => [
				'name' => '重庆快乐十分',
				'balls' => 8,
			],
			'GDSF' => [
				'name' => '广东快乐十分',
				'balls' => 8,
			],
			'TJSF' => [
				'name' => '天津快乐十分',
				'balls' => 8,
			],
			'SSRC' => [
				'name' => '极速赛车',
				'balls' => 10,
			],
			'MLAFT' => [
				'name' => '幸运飞艇',
				'balls' => 10,
			],
			'TS' => [
				'name' => '腾讯分分彩',
				'balls' => 5,
			],
			'ORPK' => [
				'name' => '老PK拾',
				'balls' => 10,
			],
		];
		
		$LotteryCheckout = new LotteryCheckout();
		foreach($lotteryConfig as $key1 => $value1){
			//$result = $this->actionLotteryCheckout($key1, $value1['balls']);
			$result = $LotteryCheckout->actionLotteryCheckout($key1, $value1['balls'], '');
			echo  $key1 . ' ' . json_encode($result) . PHP_EOL;
		}
    }
}