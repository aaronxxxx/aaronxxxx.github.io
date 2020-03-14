<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票規則
 */

namespace app\common\controllers;

use Yii;

class LotteryRuleController
{
	/*
	* 單顆球玩法
	* gameType : 1.大小 2.單雙
	* checkValue：比對大小基準值，球號為0-9，4以上為大，球號為1-10，5以上為大
	*/
	public function ballGame($numArray, $gameType = [0, 1, 2], $checkValue = 4, $compareNumber = [], $tieNumber = -1, $ball_ch = []){
		$responseData = [];
		if(count($ball_ch) == 0){
			$ball_ch = ['', '第一球', '第二球', '第三球', '第四球', '第五球', '第六球', '第七球', '第八球', '第九球', '第十球'];
		}
		foreach($numArray as $key1 => $value1){
			$quick_type = $ball_ch[$key1];
			foreach($gameType as $key2 => $value2){
				switch($value2){
					case 0:	//猜開獎球號
						$responseData[$quick_type][$value2] = $value1;
						break;
					case 1:	//大小
						$responseData[$quick_type][$value2] = self::checkGame01($value1, $checkValue, $tieNumber);
						break;
					case 2:	//單雙
						$responseData[$quick_type][$value2] = self::checkGame02($value1);
						break;
					case 3:	//龍虎
						$compareKey = 10 - $key1 + 1;
						$responseData[$quick_type][$value2] = self::checkGame03($value1, $compareNumber[$compareKey]);
						break;
					case 4:	//尾大/小
						$str = substr($value1,-1,1);	//從後面取一碼
						$responseData[$quick_type][$value2] = '尾' . self::checkGame01($str, 4);
						break;
					case 5:	//尾單/雙
						$num2 = 0;
						for($i=0;$i<=strlen($value1);$i++){
							$num2 += substr($value1, $i, 1);
						}
						$responseData[$quick_type][$value2] = '合数' . self::checkGame02($num2);
						break;
					case 6:	//東西南北
						$responseData[$quick_type][$value2] = self::checkGame06($value1);
						break;
					case 7:	//中發白
						$responseData[$quick_type][$value2] = self::checkGame07($value1);
						break;
				}
			}
		}
		return $responseData;
	}
	
	/*
	* 總合玩法
	* 总和龙虎和
	* gameType : 1.大小　2.單雙　3.龍虎和　4.三連　5.跨度
	* checkValue：比對大小基準值
	* content：註記
	* tieNumber		和局數值
	*/
	public function summaryGame($numArray, $checkValue = 0, $gameType = [1, 2, 3], $content = '总和', $tieNumber = -1){
		$num1 = 0;
		$responseData = [];

		foreach($numArray as $key1 => $value1){
			$num1 += $value1;					//開獎總分
		}

		foreach($gameType as $key2 => $value2){
			$quick_type = '总和龙虎和';
			switch($value2){
				case 0:	//猜開獎總合
						$responseData[$quick_type][$value2] = $num1;
						break;
				case 1:	//大小
					if($tieNumber != -1){
						$responseData[$quick_type][$value2] = $content . self::checkGame01($num1, $checkValue, $tieNumber);
					}else{
						$responseData[$quick_type][$value2] = $content . self::checkGame01($num1, $checkValue);
					}
					break;
				case 2:	//單雙
					$responseData[$quick_type][$value2] = $content . self::checkGame02($num1);
					break;
				case 3:	//龙虎和
					$responseData[$quick_type][$value2] = self::checkGame03($numArray[1], end($numArray));
					break;
				/*
				case 4: //三連(目前國彩只有看到有開前三的類型，之後有需要比對中三、後三的再加)
					$responseData[$quick_type][$value2] = self::checkGame04(array_slice($numArray, 0 , 3));	//取前3筆
					break;
				case 5:	//跨度(最大 - 最小)
					$responseData[$quick_type][$value2] = self::checkGame05(min($numArray), max($numArray));
					break;
				*/
				case 6:	//總合尾大/小
					$str = substr($num1,-1,1);	//從後面取一碼
					$responseData[$quick_type][$value2] = '总和尾' . self::checkGame01($str, 4);
					break;
				case 7:	//总和810
					if($num1 == 810){
						$responseData[$quick_type][$value2] = '总和810';
					}else{
						$responseData[$quick_type][$value2] = 'NO_810';
					}
					break;
				case 6:	//總合尾大/小
					$str = substr($num1,-1,1);	//從後面取一碼
					$responseData[$quick_type][$value2] = '总和尾' . self::checkGame01($str, 4);
					break;
			}
		}
		return $responseData;
	}
	
	/*
	* 組合玩法
	* 总和龙虎和
	* gameType : 1.前三　12.中三　13.后三　2.跨度
	* checkValue：比對大小基準值
	* content：註記
	* tieNumber		和局數值
	*/
	public function groupGame($numArray, $gameType = [1, 2]){
		$responseData = [];
		foreach($gameType as $key2 => $value2){
			switch($value2){
				case 1: //三連(前三)
					$responseData['前三'] = self::checkGame04(array_slice($numArray, 0 , 3));	//取前3筆
					break;
				case 12: //三連(中三)
					$responseData['中三'] = self::checkGame04(array_slice($numArray, 1 , 3));	//中間3筆
					break;
				case 13: //三連(后三)
					$responseData['后三'] = self::checkGame04(array_slice($numArray, 2 , 3));	//後面3筆
					break;
				case 14: //三連(名稱帶不一樣而已)
					$responseData['三连'] = self::checkGame04(array_slice($numArray, 0 , 3));	//取前3筆
					break;
				case 2: //三連(前三) - 不含豹子、对子
					$responseData['前三'] = self::checkGame041(array_slice($numArray, 0 , 3));	//取前3筆
					break;
				case 22: //三連(中三) - 不含豹子、对子
					$responseData['中三'] = self::checkGame041(array_slice($numArray, 1 , 3));	//中間3筆
					break;
				case 23: //三連(后三) - 不含豹子、对子
					$responseData['后三'] = self::checkGame041(array_slice($numArray, 2 , 3));	//後面3筆
					break;
				case 3:	//跨度(最大 - 最小)
					$responseData['跨度'] = self::checkGame05(min($numArray), max($numArray));
					break;
				case 4:	//牛牛
					$responseData['牛牛'][0] = self::niuniuGame1($numArray);
					$responseData['牛牛'][1] = self::niuniuGame2($responseData['牛牛'][0]);
					$responseData['牛牛'][2] = self::niuniuGame3($responseData['牛牛'][0]);
					break;
				case 5:	//上中下
					$responseData['上中下'] = self::checkGame08($numArray);
					break;
				case 6:	//奇和偶
					$responseData['奇和偶'] = self::checkGame09($numArray);
					break;
			}
		}
		return $responseData;
	}
	
	/*
	* 玩法1：大小
	* checkNumber	檢查號碼
	* compareNumber	號碼大小比對值
	* tieNumber		和局數值
	*/
	private function checkGame01($checkNumber, $compareNumber, $tieNumber=-1){
		if(!is_numeric($checkNumber)){
			$result = 'Error';
		}else{
			if($checkNumber == $tieNumber){
				$result = "和";
			}else if($checkNumber > $compareNumber){
				$result = "大";
			}else{
				$result = "小";
			}
		}
		return $result;
	}
	
	/*
	* 玩法2：單雙
	* checkNumber	檢查號碼
	*/
	private function checkGame02($checkNumber){
		if(!is_numeric($checkNumber)){
			$result = 'Error';
		}else{
			if($checkNumber % 2 == 0){
				$result = "双";
			}else{
				$result = "单";
			}
		}
		return $result;
	}
	
	/*
	* 玩法3：龍虎
	* firstNumber	首個開獎號碼
	* lastNumber	最後開獎號碼
	*/
	private function checkGame03($firstNumber, $lastNumber){
		if ($firstNumber > $lastNumber){
			$result = "龙";
		}else if($firstNumber < $lastNumber){
			$result = "虎";
		}else{
			$result = "和";
		}
		return $result;
	}

	/*
	* 玩法4：三連
	* numArray	開獎號碼
	*/
	private function checkGame04($numArray){
		$countItems = array_count_values($numArray);
		rsort($countItems);
		if($countItems[0] >= 3){
			$result = "豹子";
		}else if($countItems[0] == 2){
			$result = "对子";
		}else if(static::sorts_1($numArray)){
			$result = "顺子";
		}else if(static::sorts($numArray)){
			$result = "半顺";
		}else{
			$result = "杂六";
		}
		return $result;
	}
	
	/*
	* 玩法4：三連(不含豹子、对子)
	* numArray	開獎號碼
	*/
	private function checkGame041($numArray){
		$countItems = array_count_values($numArray);
		rsort($countItems);
		if(static::sorts_1($numArray)){
			$result = "顺子";
		}else if(static::sorts($numArray)){
			$result = "半顺";
		}else{
			$result = "杂六";
		}
		return $result;
	}
	
	/*
	* 玩法5：跨度
	* minNumber	最小號碼
	* maxNumber	最大號碼
	*/
	private function checkGame05($minNumber, $maxNumber){
		$result = $maxNumber - $minNumber;
		return $result;
	}
	
	/*
	* 玩法6：东	南	西	北
	* 东 => 01,05,09,13,17
	* 南 => 02,06,10,14,18
	* 西 => 03,07,11,15,19
	* 北 => 04,08,12,16,20
	* checkNumber	檢查號碼
	*/
	private function checkGame06($checkNumber){
		$checkNumberMod = $checkNumber % 4;
		switch($checkNumberMod){
			case 1:
				$result = '东';
				break;
			case 2:
				$result = '南';
				break;
			case 3:
				$result = '西';
				break;
			case 0:
				$result = '北';
				break;
		}
		return $result;
	}
	
	/*
	* 玩法7：中	发	白
	* 中 => 01 - 07
	* 发 => 08 - 14
	* 白 => 15 - 20
	* checkNumber	檢查號碼
	*/
	private function checkGame07($checkNumber){
		$checkNumber = (int)$checkNumber;
		if($checkNumber <= 7){
			$result = '中';
		}else if($checkNumber > 7 && $checkNumber <= 14){
			$result = '发';
		}else{
			$result = '白';
		}
		return $result;
	}
	
	/*
	* 玩法8：上中下
	* checkNumber	檢查號碼
	*/
	private function checkGame08($numArray, $checkNumber = 41){
		$num1 = 0;
		$num2 = 0;
		foreach($numArray as $key1 => $value1){
			if($value1 < $checkNumber){
				$num1++;
			}else{
				$num2++;
			}
		}
		if($num1 == $num2){
			$result = '中';
		}else if($num1 > $num2){
			$result = '上';
		}else{
			$result = '下';
		}
		return $result;
	}

	/*
	* 玩法9：奇和偶
	* checkNumber	檢查號碼
	*/
	private function checkGame09($numArray, $checkNumber = 41){
		$num1 = 0;
		$num2 = 0;
		foreach($numArray as $key1 => $value1){
			if($value1 % 2 != 0){
				$num1++;
			}else{
				$num2++;
			}
		}
		if($num1 == $num2){
			$result = '和';
		}else if($num1 > $num2){
			$result = '奇';
		}else{
			$result = '偶';
		}
		return $result;
	}
	
	/*
	牛牛判斷
	*/
	private function niuniuGame1($numArray){
		$str = false;
		if (($numArray[1] + $numArray[2] + $numArray[3]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[4] + $numArray[5]) % 10);
		}else if (($numArray[1] + $numArray[2] + $numArray[4]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[3] + $numArray[5]) % 10);
		}else if (($numArray[1] + $numArray[2] + $numArray[5]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[3] + $numArray[4]) % 10);
		}else if (($numArray[1] + $numArray[3] + $numArray[4]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[2] + $numArray[5]) % 10);
		}else if (($numArray[1] + $numArray[3] + $numArray[5]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[2] + $numArray[4]) % 10);
		}else if (($numArray[1] + $numArray[4] + $numArray[5]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[2] + $numArray[3]) % 10);
		}else if (($numArray[2] + $numArray[3] + $numArray[4]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[1] + $numArray[5]) % 10);
		}else if (($numArray[2] + $numArray[3] + $numArray[5]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[1] + $numArray[4]) % 10);
		}else if (($numArray[2] + $numArray[4] + $numArray[5]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[1] + $numArray[3]) % 10);
		}else if (($numArray[3] + $numArray[4] + $numArray[5]) % 10 == 0){
			$str = true;
			$str1 = (($numArray[1] + $numArray[2]) % 10);
		}
		if ($str == false){
			$result = "无牛";
		}else if($str1 == 0){
			$result ="牛牛";
		}else{
			$result ="牛" . $str1;
		}
		return $result;
	}
	
	/*
	牛牛：牛单/牛双
	*/
	private function niuniuGame2($content){
		if(in_array($content, array('无牛'))){
			$result = $content;
		}else if(in_array($content, array('牛1', '牛3', '牛5', '牛7', '牛9'))){
			$result = '牛单';
		}else{
			$result = '牛双';
		}
		return $result;
	}

	/*
	牛牛：牛小/牛大
	*/
	private function niuniuGame3($content){
		if(in_array($content, array('无牛'))){
			$result = $content;
		}else if(in_array($content, array('牛1', '牛2', '牛3', '牛4', '牛5'))){
			$result = '牛小';
		}else{
			$result = '牛大';
		}
		return $result;
	}
	
	/*
	* 半順
	*/
	private static function sorts($numArray){
		for ($i = 0; $i < count($numArray) - 1; $i++){
			for ($j = 0; $j < count($numArray) - $i - 1; $j++){
				if ($numArray[$j] < $numArray[$j + 1]){
					$num = $numArray[$j];
					$numArray[$j] = $numArray[$j + 1];
					$numArray[$j + 1] = $num;
				}
			}
		}
		if ($numArray[0] - $numArray[1] != 1 && $numArray[1] - $numArray[2] != 1 && $numArray[0] - $numArray[2] != 9){
			return false;
		}
		return true;
	}
	
	/*
	* 順子
	*/
	private static function sorts_1($numArray){
		for($i = 0; $i < count($numArray) - 1; $i++){
			for ($j = 0; $j < count($numArray) - $i - 1; $j++){
				if ($numArray[$j] < $numArray[$j + 1])
				{
					$num = $numArray[$j];
					$numArray[$j] = $numArray[$j + 1];
					$numArray[$j + 1] = $num;
				}
			}
		}
		if ($numArray[0] - $numArray[1] == 1 && $numArray[1] - $numArray[2] == 1){
			return true;
		}
		if ($numArray[0] == 9 && $numArray[2] == 0 && $numArray[1] == 1){
			return true;
		}
		if ($numArray[0] == 9 && $numArray[2] == 0 && $numArray[1] == 8){
			return true;
		}
		return false;
	}
	
	/*
	結算下注記錄明細檔
	simulation：模擬結算 *2018/11/6 Johnny
	checkOrder：是否要統計目前結果供下期開獎 *2018/11/6 Johnny
	*/
	public function updateLotterySub($checkResult, $params, $lottery_type, $simulation = 'N', $checkOrder = 'N'){
		$checkOrderArray = [];
		$db = Yii::$app->db;
		$sql = 'SELECT
					o_sub.quick_type,
					o.id,
					o.order_num,
					o.user_id,
					o_sub.order_sub_num,
					o.lottery_number AS qishu,
					o.bet_info,
					o.rtype_str,
					o.bet_money AS bet_monel_total,
					o.win AS win_total,
					o.status AS order_status,
					o_sub.number,
					o_sub.bet_rate,
					o_sub.bet_money,
					o_sub.win,
					o_sub.fs,
					o_sub.id AS sub_id,
					o_sub.status AS sub_status,
					o_sub.is_win,
					o.lottery_number
				FROM
					order_lottery o
					inner join order_lottery_sub o_sub on o.order_num = o_sub.order_num
				WHERE
					o.Gtype = :type
					AND o.lottery_number = :lottery_number
					AND o.status = :status';
		if($simulation == 'N'){
			$sql .= ' limit 20000';
		}
		$orderLottery = $db->createCommand($sql, $params)->queryAll();
		//echo $db->createCommand($sql, $params)->getRawSql();

		$continueCount = 0;			//跳過記錄筆數
		$processCount = 0;			//處理記錄筆數
		$sum_bet_money = 0;			//下注金額加總
		$sum_win = 0;				//贏分加總

		foreach($orderLottery as $key3 => $value3){
			$isWin = 0;
			$continueRecord = 'N';	//跳過記錄
			if($value3['sub_status'] == 0){
				#比對下注結果
				$checkField = $value3['quick_type'];

				switch($checkField){
					case '选一':
						$chooseItems = explode(',', $value3['number']);
						$cpmoareResult = array_intersect($chooseItems, $checkResult['ballGame']['balls']);
						if(count($cpmoareResult) == 1){
							$isWin = 1;
						}
						break;
					case '选二':
						$chooseItems = explode(',', $value3['number']);
						$cpmoareResult = array_intersect($chooseItems, $checkResult['ballGame']['balls']);
						if(count($cpmoareResult) == 2){
							$isWin = 1;
						}
						break;
					case '选三':
						$chooseItems = explode(',', $value3['number']);
						$cpmoareResult = array_intersect($chooseItems, $checkResult['ballGame']['balls']);
						if(count($cpmoareResult) == 3){
							$isWin = 1;
						}
						break;
					case '选四':
						$chooseItems = explode(',', $value3['number']);
						$cpmoareResult = array_intersect($chooseItems, $checkResult['ballGame']['balls']);
						if(count($cpmoareResult) == 4){
							$isWin = 1;
						}
						break;
					case '选五':
						$chooseItems = explode(',', $value3['number']);
						$cpmoareResult = array_intersect($chooseItems, $checkResult['ballGame']['balls']);
						if(count($cpmoareResult) == 5){
							$isWin = 1;
						}
						break;
					default:
						if(isset($checkResult['ballGame'][$checkField])){
							if(is_array($checkResult['ballGame'][$checkField])){
								if(in_array($value3['number'], $checkResult['ballGame'][$checkField])){
									$isWin = 1;
								}
							}else{
								if($value3['number'] == $checkResult['ballGame'][$checkField]){
									$isWin = 1;
								}
							}
						}else{
							$continueRecord = 'Y';
						}
						break;
				}
				if($continueRecord == 'Y'){
					$continueCount++;
					continue;
				}else{
					$processCount++;
					$sum_bet_money +=  $value3['bet_money'];
				}

				if($isWin == 0){
					#結算-輸
					$checkoutAmount = $value3['fs'];					//結算金額：返水
					$note = "彩票反水";
				}else{
					#結算-贏
					$checkoutAmount = $value3['win'] + $value3['fs'];	//結算金額：贏分 + 返水
					$note = "彩票中奖";

					$sum_win += $checkoutAmount;
				}

				#統計號碼開出金額次數
				if($checkOrder == 'Y'){
					$currentNum = (int)$value3['number'];
					if($currentNum >= 0 && $currentNum <= 9){
						//@$checkOrderArray[$currentNum]['cnt']++;
						//@$checkOrderArray[$currentNum]['win_money'] += $value1['win'];
						@$checkOrderArray[$currentNum] += $value3['win'];
					}

					//$betArray = explode(',', $value1['number']);
					//foreach($betArray as $key2 => $value2){
					//	$currentNum = (int)$value2;
					//	if($currentNum > 1 && $currentNum <= 49){
					//		@$checkOrderArray[$currentNum]['cnt']++;
					//		@$checkOrderArray[$currentNum]['win_money']++;
					//	}
					//}
				}
				
				//print_r($dataArray);
				//exit;
				#如不是模擬時，更新資料庫
				if($simulation != 'Y'){
					$transaction = $db->beginTransaction();
					try {
						#錢包餘額檢查
						$sql = 'select
									u1.money,
									(select m1.balance from money_log m1 where m1.user_id = u1.user_id order by m1.id desc limit 0,1) as balance
								from
									user_list u1
								where
									u1.user_id = '.$value3['user_id'].' for update';
						$dataArray = $db->createCommand($sql)->queryOne();
						if($dataArray['money'] <> $dataArray['balance']){
							$remark = $lottery_type[$params['type']]['name'] . '(' . $value3['order_sub_num'] .')自动结算后资金异常['.date('Y-m-d H:i:s').']';
							$sql = 'update user_list set online = 0, Oid="", status = "异常", remark = "'.$remark.'" where user_id = ' . $value3['user_id'] .' and status <> "异常"';
							$db->createCommand($sql)->execute();
							$transaction->commit(); //add transaction
							continue;	//本筆異常，跳下一筆
						}else{
							$balance = $dataArray['money'];
							
							#更新下注記錄明細檔
							$sql = 'update order_lottery_sub set status = 1, is_win = ' .$isWin. ' where id = ' . $value3['sub_id'] . ' and status = 0';
							$result = $db->createCommand($sql)->execute();
							
							if($result){
								if($checkoutAmount > 0){
									#更新錢包金額
									$sql = 'update user_list set money = money + '. $checkoutAmount .' where user_id = ' . $value3['user_id'];
									$db->createCommand($sql)->execute();

									#新增交易記錄檔
									$sql = 'INSERT INTO money_log(user_id, order_num, about, update_time, type, order_value, assets, balance)
											VALUES ('.$value3['user_id'].', '.$value3['order_sub_num'].', "'.$lottery_type[$params['type']]['name'].'", now(), "彩票自动结算-'.$note.'", '.$checkoutAmount.','.$balance.','.($balance+$checkoutAmount).')';
									$result = $db->createCommand($sql)->execute();
								}
								$transaction->commit();
							}else{
								$transaction->rollBack();
							}
						}
					} catch (\Exception $e) {
						$transaction->rollBack();
						throw $e;
					} catch (\Throwable $e) {
						$transaction->rollBack();
						throw $e;
					}
				}
			}
		}
		return [
			'continueCount' => $continueCount,
			'processCount'  => $processCount,
			'sum_bet_money' => $sum_bet_money,
			'sum_win' => $sum_win,
			'scale' => ($sum_bet_money==0?0:round($sum_win/$sum_bet_money,4)),
			'checkOrderArray' => $checkOrderArray
		];
	}
	
	/*
	更新單身資料處理完成的主檔 2018-09-28 作廢視同有效訂單，補上判斷
	修正為針對單一期數結算
	*/
	public function updateLottery( $qishu ){
		$db = Yii::$app->db;
		#更新下注單頭狀態 
		$sql = 'select
					o1.id, 
					count(o2.id) as cnt, 
					sum(case when o2.status = 1 then 1 when o2.status = 3 then 1 else 0 end) as success_cnt,
					sum(case when o2.is_win = 1 then (o2.win + o2.fs) else fs end) as checkoutAmount
				from
					( select * from order_lottery where lottery_number = \''.$qishu.'\' ) o1
					inner join order_lottery_sub o2 on o1.order_num = o2.order_num
				where
					o1.status = 0
				group by
					o1.id
				having
					cnt = success_cnt';
		$dataArray = $db->createCommand($sql)->queryAll();
		if(count($dataArray) > 0){
			foreach($dataArray as $key2 => $value2){
				$temp_array[] = $value2['id'];
			}
			$sql = 'update order_lottery set status = 1 where id in ('.implode(',', $temp_array) . ') and status = 0';
			$db->createCommand($sql)->execute();
		}
	}
	
	/*
	更新彩票期別結算狀態
	修正為針對單一期數結算
	*/
	public function updateLotteryStatus($table, $qishu){
		$db = Yii::$app->db;
		$sql = 'select
					l1.id, l1.qishu, 
					count(o1.id) as cnt, 
					sum(case when o1.status = 1 then 1 else 0 end) as checkoutCnt
				from
					(select * from '.$table.' where qishu = \''.$qishu.'\' ) l1 
					left join order_lottery o1 on o1.lottery_number = l1.qishu
				where
					l1.state = 0
				group by
					l1.qishu
				having cnt = checkoutCnt';
		$dataArray = $db->createCommand($sql)->queryAll();
		if(count($dataArray) > 0){
			foreach($dataArray as $key2 => $value2){
				$temp_array[] = $value2['id'];
			}
			$sql = 'update '.$table.' set state = 1 where id in ('.implode(',', $temp_array) . ')';
			$db->createCommand($sql)->execute();
		}
	}
	
	/*
	還原彩票結算
	*/
	public function resetLottery($params, $lottery_type){
		$lottery_name = $lottery_type[$params['type']]['name'];
		$db = Yii::$app->db;
		$sql = 'SELECT
					o.id,
					o.order_num,
					o.user_id,
					o_sub.id AS sub_id,
					o_sub.order_sub_num,
					o_sub.bet_money,
					o_sub.win,
					o_sub.fs,
					o_sub.is_win
				FROM
					order_lottery o
					inner join order_lottery_sub o_sub on o.order_num = o_sub.order_num
				WHERE
					o.Gtype = :type
					AND o.lottery_number = :lottery_number
					and o_sub.status not in (0,3)';
		$orderLottery = $db->createCommand($sql, $params)->queryAll();
		//echo $db->createCommand($sql, $params)->getRawSql();

		$continueCount = 0;			//跳過記錄筆數
		$processCount = 0;			//處理記錄筆數
		foreach($orderLottery as $key1 => $value1){
			$transaction = $db->beginTransaction();
			try {
				#錢包餘額檢查
				$sql = 'select
							u1.money,
							(select m1.balance from money_log m1 where m1.user_id = u1.user_id order by m1.id desc limit 0,1) as balance
						from
							user_list u1
						where
							u1.user_id = '.$value1['user_id'].' for update';
				$dataArray = $db->createCommand($sql)->queryOne();
				if($dataArray['money'] <> $dataArray['balance']){
					$remark = $lottery_name.'(' . $value1['order_sub_num'] .')重新结算后资金异常['.date('Y-m-d H:i:s').']';
					$sql = 'update user_list set online = 0, Oid="", status = "异常", remark = "'.$remark.'" where user_id = ' . $value1['user_id'] .' and status <> "异常"';
					$db->createCommand($sql)->execute();
					$transaction->commit(); //add transaction
					
					$continueCount++;
					continue;	//本筆異常，跳下一筆
				}else{
					$processCount++;
					$balance = $dataArray['money'];
					if (in_array($value1['is_win'], array('1', '2')) || (($value1['is_win'] == '0') && (0 < $value1['fs']))) {
						$bet_money_total = 0;
						if ($value1['is_win'] == '1') {
							$bet_money_total = $value1['win'] + $value1['fs'];
						}else if ($value1['is_win'] == '2') {
							$bet_money_total = $value1['bet_money'];
						}else {
							if (($value1['is_win'] == '0') && (0 < $value1['fs'])) {
								$bet_money_total = $value1['fs'];
							}
						}
						
						#更新錢包金額
						$sql = 'update user_list set money = money - '. $bet_money_total .' where user_id = ' . $value1['user_id'];
						$db->createCommand($sql)->execute();

						#新增交易記錄檔
						$sql = 'INSERT INTO money_log(user_id, order_num, about, update_time, type, order_value, assets, balance)
								VALUES ('.$value1['user_id'].', "'.$value1['order_sub_num'].'", "'.$lottery_name.'", now(), "'.$lottery_name.'重新结算-扣钱", '.$bet_money_total.','.$balance.','.($balance - $bet_money_total).')';
						$result = $db->createCommand($sql)->execute();
					}
				}
				
				$sql = 'update order_lottery set status = 0 where id = '. $value1['id'];
				$result = $db->createCommand($sql)->execute();
				$sql = 'update order_lottery_sub set status = 0, is_win = NULL where id = '. $value1['sub_id'] . ' and status <> 0';
				$result = $db->createCommand($sql)->execute();
				
				if($result){
					$transaction->commit();
				}else{
					$transaction->rollBack();
				}
			} catch (\Exception $e) {
				$transaction->rollBack();
				throw $e;
			} catch (\Throwable $e) {
				$transaction->rollBack();
				throw $e;
			}
		}
		return [
			'code' => true,
			'continueCount' => $continueCount,
			'processCount'  => $processCount
		];
	}
}