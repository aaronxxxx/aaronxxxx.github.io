<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票結算
 */

namespace app\commands;

use Yii;

class LotteryCheckoutCheckController extends LotteryRuleCheckController
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
		foreach($lotteryConfig as $key1 => $value1){
			$result = $this->actionLotteryCheckout($key1, $value1['balls']);
			echo  $key1 . ' ' . json_encode($result) . PHP_EOL;
		}
    }
	
	/*
	* 開獎說明：共計開出5顆球
	* 單球開獎：第一球 ~ 第五球 - 大小、單雙
	* 總合開獎：大小、單雙、龍虎和
	* type：彩票類型
	* balls：開獎球數
	*/
	public function actionLotteryCheckout($type, $balls){
		$db = Yii::$app->db;
		$startTime = date('Y-m-d H:i:s');
		$table = $this->lottery_type[$type]['table'];
		
		#查詢目前未結算單據
		$sql = 'select * from '.$table.' where state = 0 and datetime < NOW()';
		$checkoutArray = $db->createCommand($sql)->queryAll();
		
		$qishuCount = 0;	//期別筆數
		$processCount = 0;	//成功筆數
		$failCount = 0;		//失敗筆數
		$qishuError = [];	//未處理完成期別
		if(count($checkoutArray) > 0){
			$filePath = "runtime/LotteryCheckoutCheck/".$type;
			$filename = $filePath . "/".date('Y-m-d').".json";
			if(!is_readable($filePath)){
				mkdir($filePath, 0700, true);
			}
			
			foreach($checkoutArray as $key2 => $value2){
				#開獎球數：5顆
				for($i=1; $i<=$balls; $i++){
					$numArray[$i] = $value2['ball_' . $i];
				}
				switch(true){
					case (in_array($type,array('BJPK'))):
						$ball_ch = ['', '冠军', '亚军', '第三名', '第四名', '第五名', '第六名', '第七名', '第八名', '第九名', '第十名'];
						$checkResult['ballGame']  = parent::ballGame(array_slice($numArray, 0 , 5, true), [0,1,2,3], 5, $numArray, -1, $ball_ch);		#每顆球玩法(1-5)
						$checkResult['ballGame'] += parent::ballGame(array_slice($numArray, 5 , 5, true), [0,1,2], 5, [], -1, $ball_ch);				#每顆球玩法(6-10)
						$summaryGame = parent::summaryGame(array_slice($numArray, 0 , 2, true), 11, [0,1,2], '');	#總合玩法(只取前2球)
						$checkResult['ballGame']['冠亚军和'] = $summaryGame['总和龙虎和'];
						break;
					case (in_array($type,array('D3', 'P3', 'T3'))):
						$checkResult['ballGame']  = parent::ballGame($numArray);								#每顆球玩法
						$checkResult['ballGame'] += parent::summaryGame($numArray, 13);							#總合玩法(最大加總為3 x 9 = 27) 大於13為大 小於等於13為小
						#組合玩法(三連)
						$checkResult['ballGame'] += parent::groupGame($numArray, [14, 3]);						#組合玩法
						break;
					case (in_array($type,array('BJKN'))):
						$checkResult['ballGame']['balls'] = $numArray;											#全部開獎球號
						$summaryGame = parent::summaryGame($numArray, 810, [1,2,7], '总和', 810);
						$checkResult['ballGame']['和值'] = $summaryGame['总和龙虎和'];							#總合玩法
						$checkResult['ballGame'] += parent::groupGame($numArray, [5,6]);						#上中下/奇偶和
						break;
					case (in_array($type,array('TJ', 'CQ'))):
						#0-9號，開出5個號碼
						//0-4小, 5-9大$checkValue = (10/2)-1;
						$checkResult['ballGame']  = parent::ballGame($numArray);								#每顆球玩法
						$checkResult['ballGame'] += parent::summaryGame($numArray, 22);							#總合玩法(最大加總為5 x 9 = 45,中間值為22.5),大于22 为大 其他为小
						#組合玩法(三連)
						$checkResult['ballGame'] += parent::groupGame($numArray, [1, 12, 13, 4]);				#組合玩法
						break;
					case (in_array($type,array('GD11'))):
						#0-11號，開出5個號碼
						$checkResult['ballGame']  = parent::ballGame($numArray, [0, 1, 2], 5);					#每顆球玩法
						$checkResult['ballGame'] += parent::summaryGame($numArray, 31, [1, 2, 3], '总和', 30);	#總合玩法(最大加總為5 x 9 = 45)
						#組合玩法(三連)
						$checkResult['ballGame'] += parent::groupGame($numArray, [2, 22, 23]);					#組合玩法
						break;
					case (in_array($type,array('GXSF'))):
						#1-20號，開出5個號碼(10為中間值，21為和)
						$checkResult['ballGame']  = parent::ballGame($numArray, [0, 1, 2], 10, [], 21);			#每顆球玩法
						$checkResult['ballGame'] += parent::summaryGame($numArray, 54);							#總合玩法(最大加總為5 x 20 = 100),大于54 为大 其他为小
						#組合玩法(三連)
						$checkResult['ballGame'] += parent::groupGame($numArray, [2, 22, 23]);					#組合玩法
						break;
					case (in_array($type,array('CQSF', 'GDSF', 'TJSF'))):
						#1-20號，開出8個號碼
						$checkResult['ballGame']  = parent::ballGame($numArray, [0, 1, 2, 4, 5, 6, 7], 10);		#每顆球玩法
						$summaryGame = parent::summaryGame($numArray, 84, [1, 2, 3, 6], '总和', 84);			#總合玩法(最小加總1~8=36, 最大加總為13~20=132, 和值為(132-36)/2+36=84)
						$checkResult['ballGame']['总和龙虎'] = $summaryGame['总和龙虎和'];
						break;
					default: 
						return false;
						break;
				}

				//print_r($checkResult).PHP_EOL;
				//exit;

				$params = [
					'type' => $type,
					'lottery_number' => $value2['qishu'],
					'status' => 0
				];
				
				$updateLotterySubResult = parent::updateLotterySub($checkResult, $params);
				$qishuCount++;
				$failCount += $updateLotterySubResult['continueCount'];
				$processCount += $updateLotterySubResult['processCount'];
				if($updateLotterySubResult['continueCount'] > 0){
					$qishuError[] = $value2['qishu'];
				}
			}

			parent::updateLottery();
			parent::updateLotteryStatus($table);

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
		return [
			'qishuCount' => $qishuCount,
			'qishuError' => $qishuError,
			'success' => $processCount,
			'fail' => $failCount,
		];
	}
}