<?php
namespace app\modules\lottery\lotteryresult\controllers;

use app\common\base\BaseController;
use app\common\clients\ARSSClient;
/*
 * 注单控制器
 */
class IndexController extends BaseController{

	//结算
	public function actionJiesuan(){
		$qihao  = $_POST['qihao'];
		$jstype = $_POST['jstype'];
		$gtype  = $_POST['gtype'];
		$jsway  = $_POST['jsway'];
		$arss = new ARSSClient();
		$result = $arss -> LotteryOrderSettle($qihao,$jstype,$gtype,$jsway);
		return $result;
	}
}
