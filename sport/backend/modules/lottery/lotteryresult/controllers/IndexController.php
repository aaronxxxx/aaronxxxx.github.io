<?php
namespace app\modules\lottery\lotteryresult\controllers;

use app\common\base\BaseController;
//use app\common\clients\ARSSClient;
use app\common\controllers\LotteryCheckoutController;
/*
 * 注单控制器
 */
class IndexController extends BaseController{

	//结算
	public function actionJiesuan(){
		$qishu  = $_POST['qihao'];
		$jsType = $_POST['jstype'];
		$gtype  = strtoupper($_POST['gtype']);
		$jsway  = $_POST['jsway'];
		
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

		$LotteryCheckout = new LotteryCheckoutController();
		$result = $LotteryCheckout->actionLotteryCheckout($gtype, $lotteryConfig[$gtype]['balls'], $qishu, $jsType);
		if(isset($result)){
			if($result['fail'] > 0){
				echo '結算結果 - '.PHP_EOL.' 成功：'.round($result['success']).' 筆, 失敗：'.round($result['fail']).' 筆';
				exit;
			}else{
				if($jsType == '1')
				{
					return '1';
				}
				return '0';
			}
		}else{
			return '结算有误，请稍后再试';
		}
		/*
		$arss = new ARSSClient();
		$result = $arss -> LotteryOrderSettle($qihao,$jstype,$gtype,$jsway);
		return $result;
		*/
	}
}
