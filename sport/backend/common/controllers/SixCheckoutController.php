<?php
namespace app\common\controllers;

use Yii;

/**
 * 客户端结算接口
 */
class SixCheckoutController extends SixRuleController
{
    /*
	* 開獎說明：共計開出6顆球+1顆特別號
	* type：彩票類型
	* balls：開獎球數
	* jsType：是否為重算
	* simulation：模擬開獎結果
	*/
	public function actionLotteryCheckout($type, $balls, $qishu = '', $jsType = '0', $simulation = 'N', $simulationNum = [], $checkOrder = 'N'){
		parent::setType($type);
		
		$lottery_type = [
			'SIX' => [
				'table' => 'lottery_result_lhc',
				'rtype' => 0,
				'name' => '六合彩',
            ],
            'SPSIX' => [
				'table' => 'lottery_result_splhc',
				'rtype' => 0,
				'name' => '极速六合彩',
			],
		];
		$db = Yii::$app->db;
		$startTime = date('Y-m-d H:i:s');
		$table = $lottery_type[$type]['table'];
		
		if($simulation != 'Y'){
			#查詢目前未結算單據
			if($qishu == ''){
				$sql = 'select * from '.$table.' where state = 0 and datetime < NOW()';
			}else{
				$sql = 'select * from '.$table.' where qishu = "'.$qishu.'"';
			}
			$checkoutArray = $db->createCommand($sql)->queryAll();
		}else{
			#模擬時帶模擬陣列
			$checkoutArray[0] = $simulationNum;
		}		
		
		$qishuCount = 0;	//期別筆數
		$processCount = 0;	//成功筆數
		$failCount = 0;		//失敗筆數
		$qishuError = [];	//未處理完成期別

		if(count($checkoutArray) > 0){
			$filePath = "runtime/LotteryCheckout/".$type;
			$filename = $filePath . "/".date('Y-m-d').".json";
			if(!is_readable($filePath)){
				mkdir($filePath, 0700, true);
			}
			
			foreach($checkoutArray as $key2 => $value2){
				#如為重算，需要先把金額加回去
				if($jsType == '1'){
					$resetResult = parent::resetLottery($value2['qishu']);
					if(@$resetResult['code'] != true){
						return 'ERROR';
					}
				}
				#開獎球數：6+1顆
				for($i=1; $i<=$balls; $i++){
					//$numArray[$i] = $value2['ball_' . $i];
					$numArray[$i] = sprintf("%02d", $value2['ball_' . $i]);
				}

				#1-49號，開出6個號碼+1特別號(總合大小比對為175)
				$checkResult['common']['Balls'] = $numArray;
				$checkResult['common']['normalBalls'] = $numArray;

				unset($checkResult['common']['normalBalls'][7]);
				$checkResult['common'] += parent::ballGame($numArray, [0, 1, 2, 3, 4, 5], 25, $value2['datetime']);		#每顆球玩法(共用)
				$checkResult['common'] += parent::summaryGame($numArray, 175);											#總合玩法

				//echo '<pre>';
				//print_r($checkResult);
				//echo '</pre>';
				//exit;
				
				$params = [
					'lottery_number' => $value2['qishu'],
					'status' => 0
				];

				$updateLotterySubResult = parent::updateLotterySub($checkResult, $params, $lottery_type, $simulation, $checkOrder);
				if($simulation == 'Y'){
					return $updateLotterySubResult;
				}
				$qishuCount++;
				$failCount += $updateLotterySubResult['continueCount'];
				$processCount += $updateLotterySubResult['processCount'];
				if($updateLotterySubResult['continueCount'] > 0){
					$qishuError[] = $value2['qishu'];
				}

				//改為單一期號單次結算，移入迴圈
				parent::updateLottery($value2['qishu']);
				parent::updateLotteryStatus($table, $value2['qishu']);

			}
				

			//記錄log
			$content = [
				'startTime' => $startTime,
				'endTime' => date('Y-m-d H:i:s'),
				'qishuCount' => $qishuCount,
				'qishuError' => $qishuError,
				'success' => $processCount,
				'fail' => $failCount,
			];
			file_put_contents($filename, json_encode($content) . PHP_EOL, FILE_APPEND);
		}
		if($jsType == '1'){
			$re_sql_update_stauts = 'update '.$table.' SET state=2'.' where state = 1 and qishu = "'.$qishu.'"';
			$db->createCommand($re_sql_update_stauts)->execute();
		}
		return [
			'qishuCount' => $qishuCount,
			'qishuError' => $qishuError,
			'success' => $processCount,
			'fail' => $failCount,
		];
	}
}
