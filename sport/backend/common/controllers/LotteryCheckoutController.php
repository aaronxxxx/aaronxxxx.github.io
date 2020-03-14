<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票結算
 */

namespace app\common\controllers;

use Yii;

class LotteryCheckoutController extends LotteryRuleController
{
	public $lottery_type;
	public function __construct(){
		$this->lottery_type = [
			//=====LotteryCheckout01 ok=====//
			'BJPK' => [
				'table' => 'lottery_result_bjpk',
				'rtype' => 761,
				'name' => '北京PK拾',
			],
			'SSRC' => [
				'table' => 'lottery_result_ssrc',
				'rtype' => 762,
				'name' => '极速赛车',
			],
			'MLAFT' => [
				'table' => 'lottery_result_mlaft',
				'rtype' => 763,
				'name' => '幸运飞艇',
			],
			'ORPK' => [
				'table' => 'lottery_result_orpk',
				'rtype' => 765,
				'name' => '老PK拾',
			],
			//=====LotteryCheckout02 ok=====//
			'D3' => [
				'table' => 'lottery_result_d3',
				'rtype' => 745,
				'name' => '3D彩',
			],
			'P3' => [
				'table' => 'lottery_result_p3',
				'rtype' => 748,
				'name' => '排列三',
			],
			'T3' => [
				'table' => 'lottery_result_t3',
				'rtype' => 741,
				'name' => '上海时时乐',
			],
			
			//=====LotteryCheckout03 ok=====//
			'BJKN' => [
				'table' => 'lottery_result_bjkn',
				'rtype' => 751,
				'name' => '北京快乐8',
			],

			//=====LotteryCheckout04 ok=====//
			'TJ' => [
				'table' => 'lottery_result_tj',
				'rtype' => 721,
				'name' => '极速时时彩',
			],
			'TS' => [
				'table' => 'lottery_result_ts',
				'rtype' => 764,
				'name' => '极速时时彩',
			],
			'GD11' => [
				'table' => 'lottery_result_gd11',
				'rtype' => 731,
				'name' => '广东11选5',
			],
			'CQ' => [
				'table' => 'lottery_result_cq',
				'rtype' => 701,
				'name' => '重庆时时彩',
			],
			'GXSF' => [
				'table' => 'lottery_result_gxsf',
				'rtype' => 777,
				'name' => '广西十分彩',
			],
			
			//=====LotteryCheckout05 ok=====//
			'CQSF' => [
				'table' => 'lottery_result_cqsf',
				'rtype' => 791,
				'name' => '重庆快乐十分',
			],
			'GDSF' => [
				'table' => 'lottery_result_gdsf',
				'rtype' => 771,
				'name' => '广东快乐十分',
			],
			'TJSF' => [
				'table' => 'lottery_result_tjsf',
				'rtype' => 781,
				'name' => '天津快乐十分',
			],
		];
	}
	/*
	* 開獎說明：共計開出5顆球
	* 單球開獎：第一球 ~ 第五球 - 大小、單雙
	* 總合開獎：大小、單雙、龍虎和
	* type：彩票類型
	* balls：開獎球數
	* simulation：模擬開獎結果  *2018/11/6 Johnny
	*/
	public function actionLotteryCheckout($type, $balls, $qishu = '', $jsType = '0', $simulation = 'N', $simulationNum = [], $checkOrder = 'N'){
		$db = Yii::$app->db;
		$startTime = date('Y-m-d H:i:s');
		$table = $this->lottery_type[$type]['table'];
		
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
					$params = [
						'type' => $type,
						'lottery_number' => $value2['qishu']
					];
					$resetResult = parent::resetLottery($params, $this->lottery_type);
					if(@$resetResult['code'] != true){
						return 'ERROR';
					}
				}
				#開獎球數：5顆
				for($i=1; $i<=$balls; $i++){
					$numArray[$i] = $value2['ball_' . $i];
				}

				switch(true){
					case (in_array($type,array('BJPK','SSRC','MLAFT','ORPK'))):
						$ball_ch = ['', '冠军', '亚军', '第三名', '第四名', '第五名', '第六名', '第七名', '第八名', '第九名', '第十名'];
						$checkResult['ballGame']  = parent::ballGame(array_slice($numArray, 0 , 5, true), [0,1,2,3], 5, $numArray, -1, $ball_ch);		#每顆球玩法(1-5)
						$checkResult['ballGame'] += parent::ballGame(array_slice($numArray, 5 , 5, true), [0,1,2], 5, [], -1, $ball_ch);				#每顆球玩法(6-10)
						$summaryGame = parent::summaryGame(array_slice($numArray, 0 , 2, true), 11, [0,1,2], '');	#總合玩法(只取前2球)
						$checkResult['ballGame']['冠亚军和'] = $summaryGame['总和龙虎和'];
						break;
					case (in_array($type,array('D3', 'P3', 'T3'))):
						$checkResult['ballGame']  = parent::ballGame($numArray);								#每顆球玩法
						$checkResult['ballGame'] += parent::summaryGame($numArray, 13);							#總合玩法(最大加總為3 x 9 = 27,中間值為13.5)大於13為大 小於等於13為小
						#組合玩法(三連)
						$checkResult['ballGame'] += parent::groupGame($numArray, [14, 3]);						#組合玩法
						break;
					case (in_array($type,array('BJKN'))):
						$checkResult['ballGame']['balls'] = $numArray;											#全部開獎球號
						$summaryGame = parent::summaryGame($numArray, 810, [1,2,7], '总和', 810);
						$checkResult['ballGame']['和值'] = $summaryGame['总和龙虎和'];							#總合玩法
						$checkResult['ballGame'] += parent::groupGame($numArray, [5,6]);						#上中下/奇偶和
						break;
					case (in_array($type,array('TJ', 'CQ' , 'TS'))):
						#0-9號，開出5個號碼
						//0-4小, 5-9大$checkValue = (10/2)-1;
						$checkResult['ballGame']  = parent::ballGame($numArray);								#每顆球玩法
						$checkResult['ballGame'] += parent::summaryGame($numArray, 22);							#總合玩法(最大加總為5 x 9 = 45,中間值為22.5)大於22為大 小於等於22為小
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
				
				$updateLotterySubResult = parent::updateLotterySub($checkResult, $params, $this->lottery_type, $simulation, $checkOrder);
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