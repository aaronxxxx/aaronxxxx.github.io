<?php
/**
 * @auth Johnny
 * @date 2019-08-30
 * @運動項目結算
 */

namespace app\common\controllers;

use Yii;

class SportCheckoutController extends SportRuleController
{
	// public $lottery_type;
	// public function __construct(){
	// 	$this->lottery_type = [

	// 	];
	// }

	/*
	* qishu：如輸入改為單筆
	* jsType：如1 為重算
	* simulation：模擬開獎結果  *2018/11/6 Johnny
	* simulationNum：模擬開獎資料
	*/
	public function actionLotteryCheckout($qishu = '', $jsType = '0', $simulation = 'N', $simulationNum = [])
	{
		$db = Yii::$app->db;
		$startTime = date('Y-m-d H:i:s');
		$table = 'event_result';

		if ($simulation != 'Y') {
            // 查詢目前未結算單據
            if ($qishu == '') {
                $sql = 'select * from ' . $table . ' where state = 0 and datetime < NOW()';
            } else {
                $sql = 'select * from ' . $table . ' where official_id = "' . $qishu . '"';
			}

			$checkoutArray = $db->createCommand($sql)->queryAll();
		} else {
			#模擬時帶模擬陣列
			$checkoutArray[0] = $simulationNum;
		}

		$qishuCount = 0;	//期別筆數
		$processCount = 0;	//成功筆數
		$failCount = 0;		//失敗筆數
		$qishuError = [];	//未處理完成期別

		if (count($checkoutArray) > 0) {
			//寫入資料
			$filePath = "runtime/LotteryCheckout/sport";
			$filename = $filePath . "/" . date('Y-m-d') . ".json";
			if (! is_readable($filePath)) {
				mkdir($filePath, 0700, true);
			}

			// 根據需結算期數進行計算
			foreach ($checkoutArray as $key => $value) {
				// 如為重算，需要先把金額加回去
				if ($jsType == '1') {
					$resetResult = parent::resetLottery($value['official_id']);

					if (@$resetResult['code'] != true) {
						return 'ERROR';
					}
				}

				/*取得各級資訊
				*$checkResult['pk'] = [ event_pk_id => [ playid => score, play2id => score2 ] ]
				*$checkResult['multi'] = [ event_multi_id => win_item_id ]
				*/

				// 模擬試算自帶資料
				if ( $simulation == 'Y' ) {
					$checkResult['pk'] = $simulationNum['pk'];
					$checkResult['multi'] = $simulationNum['multi'];
				} else {
					$checkResult['pk'] = parent::getPK($value['official_id']);
					$checkResult['multi'] = parent::getMulti($value['official_id']);
				}

				$updateLotterySubResult = parent::updateSportSub($checkResult, $value['official_id'], $simulation);

				if ($simulation == 'Y') {
					return $updateLotterySubResult;
				}

				$qishuCount++;
				$failCount += $updateLotterySubResult['continueCount'];
				$processCount += $updateLotterySubResult['processCount'];

				if ($updateLotterySubResult['continueCount'] > 0) {
					$qishuError[] = $value['official_id'] . ' - ' . $value['title'];
				}

				//改為單一期號單次結算，移入迴圈
				parent::updateResultStatus($value['official_id']);
			}

			//記錄log
			$content = [
				'startTime' => $startTime,
				'endTime' => date('Y-m-d H:i:s'),
				'qishuCount' => $qishuCount,
				'qishuError' => $qishuError,
				'success' => $processCount,
				'fail' => $failCount
			];

			//寫入json
			file_put_contents($filename, json_encode($content) . PHP_EOL, FILE_APPEND);
		}

		if ($jsType == '1') {
			$sql = 'update '.$table.' SET state=2'.' where state = 1 and official_id = "'.$qishu.'"';
			$db->createCommand($sql)->execute();
		}

		return [
			'qishuCount' => $qishuCount,
			'qishuError' => $qishuError,
			'success' => $processCount,
			'fail' => $failCount
		];
	}
}
