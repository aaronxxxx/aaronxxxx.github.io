<?php
/**
 * @auth ada
 * @date 2018-06-05 22:00
 * @彩票規則
 */

namespace app\common\controllers;

use Yii;
use app\common\controllers\LunarController;

class SixRuleController
{
	/*
	*需要使用到的成員變數
	*/
	private $table_type = [
					'SIX' => [
						'odds' => 'six_lottery_odds',
						'order' => 'six_lottery_order',
						'order_sub' => 'six_lottery_order_sub',
					],
					'SPSIX' => [
						'odds' => 'spsix_lottery_odds',
						'order' => 'spsix_lottery_order',
						'order_sub' => 'spsix_lottery_order_sub',
					],
				];
	private $type;
	public function setType($type){
		$this->type=$type;
	}
	/*
	* 單顆球玩法
	* gameType : 1.大小 2.單雙
	* checkValue：比對大小基準值，球號為0-9，4以上為大，球號為1-10，5以上為大
	*/
	public function ballGame($numArray, $gameType = [0, 1, 2, 3, 4, 5], $checkValue = 4, $dateTime, $compareNumber = [], $tieNumber = -1, $ball_ch = []){
		$responseData = [];
		$tailArray = [];
		if(count($ball_ch) == 0){
			$ball_ch = ['', '正码一', '正码二', '正码三', '正码四', '正码五', '正码六', '特别号'];
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
					case 3:	//尾大/小
						$str = substr($value1,-1,1);	//從後面取一碼
						$responseData[$quick_type][$value2] = '尾' . self::checkGame01($str, 4);
						break;
					case 4:	//和數大/小
						$num2 = 0;
						for($i=0;$i<=strlen($value1);$i++){
							$num2 += (int) substr($value1, $i, 1);
						}
						$responseData[$quick_type][$value2] = '和' . self::checkGame01($num2, 6);
						break;
					case 5:	//和數單/雙
						$num2 = 0;
						for($i=0;$i<=strlen($value1);$i++){
							$num2 += (int) substr($value1, $i, 1);
						}
						$responseData[$quick_type][$value2] = '和' . self::checkGame02($num2);
						break;
				}
			}

			if($key1 == 7){
				#特別號加開
				$responseData[$quick_type][] = $responseData[$quick_type][1].$responseData[$quick_type][2];			//大小+單雙
				$colorString = self::checkGame03($value1);
				$responseData['生肖'][] = $colorString;																//生肖 - 色波
				$responseData['半波'][] = mb_substr($colorString, 0, 1, 'utf-8'). $responseData[$quick_type][1];	//半波(大小)
				$responseData['半波'][] = mb_substr($colorString, 0, 1, 'utf-8'). $responseData[$quick_type][2];	//半波(單雙)
				$responseData['半波'][] = mb_substr($colorString, 0, 1, 'utf-8'). $responseData[$quick_type][1].$responseData[$quick_type][2];	//半半波

				$responseData['生肖'][] = self::checkGame06($value1);												//生肖 - 头
				$responseData['生肖'][] = self::checkGame07($value1);												//生肖 - 尾
			}else{
				#一般號碼加開(色波)
				$responseData[$quick_type][] = self::checkGame03($value1);
			}
			$tail = self::checkGame07($value1);
			$tailArray[] = $tail;	//每顆球尾數
			$responseData['尾全部'][$key1] = $tail;
		}

		$animalArray = self::checkGame05($numArray, $dateTime);
		$responseData['生肖全部'] = $animalArray;
		$responseData['生肖'][] = $animalArray[7];																	//生肖
		$responseData['合肖'] = $animalArray[7];																	//合肖

		$animalArray = array_unique($animalArray);
		$responseData['一肖'] = array_unique($tailArray);								//尾單/雙(6+1號)
		$responseData['一肖'] = array_merge($responseData['一肖'], $animalArray);		//生肖(6+1號)
		if(count($animalArray) % 2 == 1){
			$responseData['一肖'][] = '总肖单';
		}else{
			$responseData['一肖'][] = '总肖双';
		}

		if(count($animalArray) <= 4){
			$responseData['一肖'][] = '234肖';
		}else{
			$responseData['一肖'][] = count($animalArray).'肖';
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
	public function summaryGame($numArray, $checkValue = 0, $gameType = [1, 2, 3], $content = '总和 ', $tieNumber = -1){
		$num1 = 0;
		$responseData = [];

		foreach($numArray as $key1 => $value1){
			$num1 += $value1;					//開獎總分
		}

		foreach($gameType as $key2 => $value2){
			$quick_type = '总和';
			switch($value2){
				case 0:	//猜開獎總合
						$responseData[$quick_type][$value2] = $num1;
						break;
				case 1:	//大小
					if($tieNumber != -1){
						$responseData[$quick_type][$value2] = self::checkGame01($num1, $checkValue, $tieNumber);
					}else{
						$responseData[$quick_type][$value2] = self::checkGame01($num1, $checkValue);
					}
					break;
				case 2:	//單雙
					$responseData[$quick_type][$value2] = self::checkGame02($num1);
					break;
				case 3:	//正肖
					$responseData['正肖'] = self::checkGame04($numArray);
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
	* 玩法3：紅藍波
	* checkNumber	檢查號碼
	*/
	private function checkGame03($checkNumber){
		$ball = sprintf("%02d", $checkNumber);
		if(in_array($ball, array('01','02','12','13','23','24','34','35','45','46','07','08','18','19','29','30','40'))){
			$color = '红波';
		}else if (in_array($ball, array('11','21','22','32','33','43','44','05','06','16','17','27','28','38','39','49'))){
			$color = '绿波';
		}else {
			$color = '蓝波';
		}
		return $color;
	}

	/*
	* 玩法4：正肖
	* 6+1個號碼做計算
	* numArray	出獎號碼
	*/
	private function checkGame04($numArray){
		$r = 0;
		$g = 0;
		$b = 0;
		foreach($numArray as $key1 => $value1){
			$color = self::checkGame03($value1);
			if($key1 == 7){
				$score = 1.5;
			}else{
				$score = 1;
			}
			switch($color){
				case '红波':
					$r += $score;
					break;
				case '绿波':
					$g += $score;
					break;
				case '蓝波':
					$b += $score;
					break;
			}
		}

		if ((($r == 3) && ($g == 3) && ($b == 1.5)) || (($r == 3) && ($g == 1.5) && ($b == 3)) || (($r == 1.5) && ($g == 3) && ($b == 3))) {
			$response = "和局";
		} else {
			if (($b < $r) && ($g < $r)){
				$response = "红波";
			}else if(($r < $g) && ($b < $g)){
				$response = "绿波";
			} else {
				$response = "蓝波";
			}
		}
		return $response;
	}

	/*
	* 玩法5：生肖
	* checkNumber	檢查號碼
	*/
	function checkGame05($numArray, $dateTime = '') {
		if($dateTime == ''){
			$dateTime = date('Y-m-d H:i:s');
		}

		$year = date('Y', strtotime($dateTime));
		$month = date('m', strtotime($dateTime));
		$day = date('d', strtotime($dateTime));

		#抓出目前期別生肖
		$Lunar = new LunarController();
		$dateInfo = $Lunar->convertSolarToLunar($year, $month, $day);
		$firstAminal = $dateInfo[6];

		$tempArray = [1=>'鼠', 2=>'牛', 3=>'虎', 4=>'兔', 5=>'龙', 6=>'蛇', 7=>'马', 8=>'羊', 9=>'猴', 10=>'鸡', 11=>'狗', 12=>'猪'];
		$animanIndex = array_search($firstAminal, $tempArray);

		#生肖排序
		$animalTotal = $animanIndex + 1;
		foreach($tempArray as $key1 => $value1){
			$index = $animalTotal - $key1;
			if($index < 0){
				$index += 12;
			}
			if($index == 12){  // 最終位生肖會導致差異，故修正導向 [0]
				$index = 0;
			}
			$animanArray[$index] = $value1;
		}

		#號碼群組
		for($i=1;$i<=49;$i++){
			$group = $i % 12;
			$animalNumber[$group][] = sprintf("%02d", $i);
		}

		foreach($numArray as $key1 => $value1){
			foreach($animalNumber as $key2 => $value2){
				if(in_array($value1, $value2)){
					$result[$key1] = $animanArray[$key2];
					break;
				}
			}
		}
		return $result;
	}

	/*
	* 玩法6：開頭號碼
	* checkNumber	檢查號碼
	*/
	function checkGame06($checkNumber) {
		$ball = sprintf("%02d", $checkNumber);
		$a = substr($ball, 0, 1);
		$result = '头'.$a;
		return $result;
	}

	/*
	* 玩法7：尾數號碼
	* checkNumber	檢查號碼
	*/
	function checkGame07($checkNumber) {
		$ball = sprintf("%02d", $checkNumber);
		$a = substr($ball, -1);
		$result = '尾'.$a;
		return $result;
	}

	/*
	結算下注記錄明細檔
	simulation：模擬結算
	checkOrder：是否要統計目前結果供下期開獎
	*/
	public function updateLotterySub($checkResult, $params, $lottery_type, $simulation = 'N', $checkOrder = 'N'){
		$checkOrderArray = [];
		$db = Yii::$app->db;
		$sql = 'select * from '.$this->table_type[$this->type]['odds'].' where sub_type = "CH"';
		$odds_CH = $db->createCommand($sql, $params)->queryOne();

		$sql = 'SELECT
					o.id,
					o.order_num,
					o.user_id,
					o_sub.order_sub_num,
					o.lottery_number AS qishu,
					o.bet_info,
					o.rtype_str,
					o.rtype,
					o.bet_money_total,
					o.win_total,
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
					'.$this->table_type[$this->type]['order'].' o
					inner join '.$this->table_type[$this->type]['order_sub'].' o_sub on o.order_num = o_sub.order_num
				WHERE
					o.lottery_number = :lottery_number
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

		foreach($orderLottery as $key1 => $value1){
			$isWin = 0;
			$continueRecord = 'N';	//跳過記錄
			if($value1['sub_status'] == 0){
				#以下有前後比對順序
				switch(true){
					case ($value1['rtype_str'] == '正码过关'):
						$is_win_nap = [];
						$chooseItems = explode(',', $value1['number']);
						foreach($chooseItems as $key2 => $value2){
							$checkItem = mb_substr($value2, 0, 3, 'utf-8');
							$checkValue = trim(str_replace($checkItem, '', $value2));

							$tempNumArray = $checkResult['common'][$checkItem];
							$tempNumArray1 = $checkResult['common'][$checkItem];	//不含色波
							unset($tempNumArray1[6]);								//刪除色波項目

							if (in_array($checkValue, $tempNumArray1) && ($tempNumArray1[0] == '49')) {
								$is_win_nap[] = 'tie';
							}else if (in_array($checkValue, $tempNumArray)) {
								$is_win_nap[] = 1;
							}else {
								$is_win_nap[] = 0;
							}
						}

						$isWin = 1;
						foreach ($is_win_nap as $key2 => $value2 ) {
							if ($value2 == 0) {
								$isWin = 0;
							}
						}
						break;
					case ($value1['rtype_str'] == '特别号' || mb_substr($value1['number'], 0, 3, 'utf-8') == '特别号'):
						$checkItem = '特别号';
						$checkValue = trim(str_replace($checkItem, '', $value1['number']));
						if(in_array($checkValue, $checkResult['common'][$checkItem])){
							$isWin = 1;
						}
						break;
					case (mb_substr($value1['number'], 0, 2, 'utf-8') == '总和'):
						$checkItem = mb_substr($value1['number'], 0, 2, 'utf-8');
						$checkValue = trim(str_replace($checkItem, '', $value1['number']));
						if(in_array($checkValue, $checkResult['common'][$checkItem])){
							$isWin = 1;
						}
						break;
					case (in_array($value1['rtype_str'], array('生肖', '一肖', '半波'))):
						$checkItem = $value1['rtype_str'];
						$checkValue = $value1['number'];
						if(in_array($checkValue, $checkResult['common'][$checkItem])){
							$isWin = 1;
						}
						break;
					case (mb_substr($value1['number'], 0, 2, 'utf-8') == '正码'):
						$checkItem = mb_substr($value1['number'], 0, 3, 'utf-8');
						$checkValue = trim(str_replace($checkItem, '', $value1['number']));
						if(in_array($checkValue, $checkResult['common'][$checkItem])){
							$isWin = 1;
						}
						break;
					case ($value1['rtype_str'] == '正码'):
						$checkValue = $value1['number'];
						if(in_array($checkValue, $checkResult['common']['normalBalls'])){
							$isWin = 1;
						}
						break;
					case (mb_substr($value1['rtype_str'], 0, 3, 'utf-8') == '正码特'):
						$checkItem = trim(mb_substr($value1['rtype_str'], 4, 2, 'utf-8'));
						if($value1['number'] == $checkResult['common']['Balls'][$checkItem]){
							$isWin = 1;
						}
						break;
					case ($value1['rtype_str'] == '合肖'):
						if($checkResult['common']['Balls'][7] == '49'){
							$isWin = 'tie';
						}else{
							$checkValue = $checkResult['common']['合肖'];
							$chooseItems = explode(',', $value1['number']);
							if(in_array($checkValue, $chooseItems)){
								$isWin = 1;
							}
						}
						break;
					case ($value1['rtype_str'] == '正肖'):
						$win_number = 0;
						if(mb_substr($value1['number'], 0, 2, 'utf-8') == '正肖'){
							$checkItem = mb_substr($value1['number'], 0, 2, 'utf-8');
							$checkValue = trim(str_replace($checkItem, '', $value1['number']));

							if($checkValue == $checkResult['common'][$checkItem]){
								$isWin = 1;
							}else if(mb_substr($value1['number'], 0, 2, 'utf-8') == '正肖'){
								if(in_array($checkValue, array('红波', '蓝波', '绿波')) && $checkResult['common'][$checkItem][0] == '和局'){
									$isWin = 'tie';
								}
							}
						}else{
							foreach($checkResult['common']['生肖全部'] as $key2 => $value2){
								if($key2 < 7){
									if($value2 == $value1['number']){
										$isWin = 1;
										$win_number ++;
									}
								}
							}
						}
						break;
					case ($value1['rtype'] == 'NI'):	//N號不中
						$betArray = explode(',', $value1['number']);
						$cpmoareResult = array_intersect($betArray, $checkResult['common']['Balls']);
						if(count($cpmoareResult) == 0){
							$isWin = 1;
						}
						/*
						foreach ($checkResult['common']['Balls'] as $key2 => $value2 ) {
							if (in_array($value2, $betArray)) {
								$isWin = 0;
								break;
							}
						}
						*/
						break;
					case ($value1['rtype'] == 'LX'):	//连肖:二肖连,三肖连,四肖连,五肖连
						$betArray = explode(',', $value1['number']);
						$isWin = 1;
						foreach ($betArray as $key2 => $value2 ) {
							if (!in_array($value2, $checkResult['common']['生肖全部'])) {
								$isWin = 0;
								break;
							}
						}
						break;
					case ($value1['rtype'] == 'LF'):	//连尾:二尾碰,三尾碰
						$betArray = explode(',', $value1['number']);
						$isWin = 1;
						foreach ($betArray as $key2 => $value2 ) {
							$str = substr($value2,-1,1);	//從後面取一碼
							if (!in_array('尾' . $str, $checkResult['common']['尾全部'])) {
								$isWin = 0;
								break;
							}
						}
						break;
					case ($value1['rtype'] == 'CH'):
						$betArray = explode(',', $value1['number']);
						$is_win_san_te = 0;
						$is_win_er_te = 0;
						if(in_array($value1['rtype_str'], array('四全中', '三全中', '二全中'))){
							$isWin = 1;
							foreach ($betArray as $key2 => $value2 ) {
								if (!in_array($value2, $checkResult['common']['normalBalls'])) {
									$isWin = 0;
									break;
								}
							}
						} else if ($value1['rtype_str'] == '三中二') {
							$cpmoareResult = array_intersect($betArray, $checkResult['common']['normalBalls']);
							if(count($cpmoareResult) == 2){
								$is_win_san_te = 1;
								$isWin = 1;
							}
							if(count($cpmoareResult) == 3){
								$isWin = 1;
							}
						} else if ($value1['rtype_str'] == '二中特') {
							$cpmoareResult = array_intersect($betArray, $checkResult['common']['normalBalls']);
							if(count($cpmoareResult) == 1 && in_array($checkResult['common']['Balls'][7] ,$betArray)){
								$isWin = 1;
								$is_win_er_te = 1;
							}
							if(count($cpmoareResult) == 2){
								$isWin = 1;
							}
						} else if ($value1['rtype_str'] == '特串') {
							$cpmoareResult = array_intersect($betArray, $checkResult['common']['normalBalls']);
							if(count($cpmoareResult) == 1 && in_array($checkResult['common']['Balls'][7] ,$betArray)){
								$isWin = 1;
							}
						}
						break;
					default:
						$continueRecord = 'Y';
						break;
				}

				if($continueRecord == 'Y'){
					$continueCount++;
					continue;
				}else{
					$processCount++;
					$sum_bet_money +=  $value1['bet_money'];
				}

				if($isWin === 0){			#結算-輸
					$win_sign = '0';
					$checkoutAmount = $value1['fs'];		//結算金額：返水
					$note = "六合彩反水";
				}else if($isWin === 'tie'){	#結算-和局
					$win_sign = '2';
					$checkoutAmount = $value1['bet_money'];	//返回下注金額
					$note = '六合彩和局';
				}else{
					#結算-贏
					$win_sign = '1';
					$checkoutAmount = $value1['win'] + $value1['fs'];	//結算金額：贏分 + 返水
					$note = "六合彩中奖";

					//額外判斷
					if ($value1['rtype_str'] == '正肖' && $win_number > 0) {
						$win_money = ($value1['bet_money'] * ($value1['bet_rate'] - 1) * $win_number) + $value1['bet_money'];
						$checkoutAmount = $win_money + $value1['fs'];
					} else if ($value1['rtype'] == 'NAP') {
						$betRateArray = explode(',', $value1['bet_rate']);
						$total_bet_rate_nap = 1;
						foreach ($is_win_nap as $key2 => $value2 )
						{
							if ($value2 == 'tie') {
								$bet_rate_nap = 1;
							} else {
								$bet_rate_nap = $betRateArray[$key2];
							}
							$total_bet_rate_nap = $total_bet_rate_nap * $bet_rate_nap * 1;
						}
						$win_money = $value1['bet_money'] * $total_bet_rate_nap;
						$checkoutAmount = $win_money + $value1['fs'];
					}else if (($value1['rtype_str'] == '三中二') || ($value1['rtype_str'] == '二中特')) {
						if ($is_win_san_te == 1) {
							$bet_rate_ch = $odds_CH['h3'];
						}else if ($value1['rtype_str'] == '三中二') {
							$bet_rate_ch = $odds_CH['h4'];
						}else if ($is_win_er_te == 1) {
							$bet_rate_ch = $odds_CH['h6'];
						}else if ($value1['rtype_str'] == '二中特') {
							$bet_rate_ch = $odds_CH['h7'];
						}
						$win_money = $value1['bet_money'] * $bet_rate_ch;
						$checkoutAmount = $win_money + $value1['fs'];
					}
					$sum_win += $checkoutAmount;
				}

				#統計號碼開出金額次數
				if($checkOrder == 'Y'){
					$currentNum = (int)$value1['number'];
					if($currentNum > 1 && $currentNum <= 49){
						//@$checkOrderArray[$currentNum]['cnt']++;
						//@$checkOrderArray[$currentNum]['win_money'] += $value1['win'];
						@$checkOrderArray[$currentNum] += $value1['win'];
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
									u1.user_id = '.$value1['user_id'].' for update';
						$dataArray = $db->createCommand($sql)->queryOne();
						if($dataArray['money'] <> $dataArray['balance']){
							$remark = $lottery_type[$this->type]['name'] . '(' . $value1['order_sub_num'] .')自动结算后资金异常['.date('Y-m-d H:i:s').']';
							$sql = 'update user_list set online = 0, Oid="", status = "异常", remark = "'.$remark.'" where user_id = ' . $value1['user_id'] .' and status <> "异常"';
							$db->createCommand($sql)->execute();
							$transaction->commit(); //add transaction
							continue;	//本筆異常，跳下一筆
						}else{
							$balance = $dataArray['money'];

							#更新下注記錄明細檔
							if (($value1['rtype_str'] == '正肖' && $win_number > 0) || ($value1['rtype'] == 'NAP' && $isWin == 1) || (in_array($value1['rtype_str'], array('三中二', '二中特')) && $isWin == 1)) {
								$sql = 'update '.$this->table_type[$this->type]['order_sub'].' set status = 1, is_win = ' .$win_sign. ', win = ' .$win_money. ' where id = ' . $value1['sub_id'] . ' and status = 0';
							} else {
								$sql = 'update '.$this->table_type[$this->type]['order_sub'].' set status = 1, is_win = ' .$win_sign. ' where id = ' . $value1['sub_id'] . ' and status = 0';
							}
							$db->createCommand($sql)->execute();

							if($checkoutAmount <> 0){
								#更新錢包金額
								$sql = 'update user_list set money = money + '. $checkoutAmount .' where user_id = ' . $value1['user_id'];
								$db->createCommand($sql)->execute();

								#新增交易記錄檔
								$sql = 'INSERT INTO money_log(user_id, order_num, about, update_time, type, order_value, assets, balance)
										VALUES ('.$value1['user_id'].', '.$value1['order_sub_num'].', "'.$lottery_type[$this->type]['name'].'", now(), "彩票自动结算-'.$note.'", '.$checkoutAmount.','.$balance.','.($balance+$checkoutAmount).')';
								$result = $db->createCommand($sql)->execute();
							}
							$transaction->commit();
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
					( select * from '.$this->table_type[$this->type]['order'].' where lottery_number = \''.$qishu.'\' ) o1
					inner join '.$this->table_type[$this->type]['order_sub'].' o2 on o1.order_num = o2.order_num
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
			$sql = 'update '.$this->table_type[$this->type]['order'].' set status = 1 where id in ('.implode(',', $temp_array) . ') and status = 0';
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
					left join '.$this->table_type[$this->type]['order'].' o1 on o1.lottery_number = l1.qishu
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
	public function resetLottery($qishu){
		$params = [
			'lottery_number' => $qishu
		];
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
                    '.$this->table_type[$this->type]['order'].' o
					inner join '.$this->table_type[$this->type]['order_sub'].' o_sub on o.order_num = o_sub.order_num
				WHERE
					o.lottery_number = :lottery_number
					and o_sub.status <> 0';
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
					$remark = '六合彩(' . $value1['order_sub_num'] .')重新结算后资金异常['.date('Y-m-d H:i:s').']';
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
								VALUES ('.$value1['user_id'].', '.$value1['order_sub_num'].', "六合彩", now(), "六合彩重新结算-扣钱", '.$bet_money_total.','.$balance.','.($balance - $bet_money_total).')';
						$result = $db->createCommand($sql)->execute();
					}
				}

				$sql = 'update '.$this->table_type[$this->type]['order'].' set status = 0 where id = '. $value1['id'];
				$result = $db->createCommand($sql)->execute();
				//$sql = 'update '.$this->table_type[$this->type]['order'].' set status = 0, is_win = NULL where id = '. $value1['sub_id'];
				$sql = 'update '.$this->table_type[$this->type]['order_sub'].' set status = 0, is_win = NULL where id = '. $value1['sub_id'];
				$result = $db->createCommand($sql)->execute();
				$transaction->commit();
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