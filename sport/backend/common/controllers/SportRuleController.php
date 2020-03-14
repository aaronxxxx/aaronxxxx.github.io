<?php
namespace app\common\controllers;

use Yii;
use app\modules\general\event\models\EventResult;
use app\modules\general\event\models\EventResultPk;
use app\modules\general\event\models\EventResultMultiple;
use app\modules\general\event\models\EventOfficial;
use app\modules\general\event\models\EventPlayer;
use app\modules\general\event\models\EventOrder;
use app\modules\general\event\models\EventTwopk;
use app\modules\general\event\models\EventMultiple;

class SportRuleController
{
	//組合出PK用資訊 : [ event_pk_id => [ playid => score, play2id => score2 ] ]
	public function getPK( $official_id ){
		$returnResult = array();
		//取得score
		$pkTemp = EventResultPk::find()->where(['official_id'=>$official_id])->asArray()->all();
		$playScore = array();
		foreach( $pkTemp as $key => $val ){
			$playerScore[$val['player']] = $val['score'];
		}

		//取得比賽項目，注入資訊
		$pkTemp = EventTwopk::find()->where(['official_id'=>$official_id])->asArray()->all();
		foreach( $pkTemp as $key => $val ){
			//補入相關分數
			$scoreTemp = array();
			$scoreTemp[ $val['player1'] ] = $playerScore[ $val['player1'] ];
			$scoreTemp[ $val['player2'] ] = $playerScore[ $val['player2'] ];
			$returnResult[ $val['id'] ] = $scoreTemp;
		}

		return $returnResult;

	}

	//組合出multi用資訊 : [ event_multi_id => win_id ]
	public function getMulti( $official_id ){
		$returnResult = array();
		//取得multi
		$temp = EventResultMultiple::find()->where(['official_id'=>$official_id])->asArray()->all();
		foreach( $temp as $key => $val ){
			$returnResult[$val['multiple_id']] = $val['item_id'];
		}


		return $returnResult;

	}

	/*
	simulation：模擬結算 *2018/11/6 Johnny
	*/
	public function updateSportSub($checkResult, $official_id, $simulation = 'N')
	{
		$db = Yii::$app->db;
		$continueCount = 0;    // 跳過記錄筆數
		$processCount = 0;    // 處理記錄筆數

		/*
		 * 模擬結算
		 * $simulationReturn['bet_money'] = 總投注額
		 * $simulationReturn['win'] = 總贏金額
		 * $simulationReturn['result'][ type(1=PK, 2=multi) ][ issue_id ][ [ bet, win ] ]
		 */
		$simulationReturn = [];
		$detail = [];
		$sum_bet_money = 0;    // 下注金額加總
		$sum_win = 0;    // 贏分加總

		$eventOrder = EventOrder::find()
			->where(['official_id' => $official_id])
			->andWhere(['!=', 'status', 3])    // status=3 廢單
			->asArray()
			->all();

		foreach ($eventOrder as $key => $value) {
			$isWin = 0;
			$continueRecord = 'N';    // 跳過記錄
			$checkField = $value['game_type'];

			switch ($checkField) {
				// 兩方比 使用 userPlayer 跟 targetPlayer 做比對
				case 1:
					$userPlayer = null;
					$targetPlayer = null;
					$resultData = $checkResult['pk'][$value['game_id']];

					foreach ($resultData as $pID => $pScore) {
						if ($pID == $value['game_item_id']) {
							$userPlayer = $pScore + $value['bet_handicap'];
						} else {
							$targetPlayer = $pScore;
						}
					}

					if ($userPlayer > $targetPlayer) {
						$isWin = 1;
					}

					break;
				// 多項目
				case 2:
					$resultData = $checkResult['multi'][$value['game_id']];

					if ($value['game_item_id'] == $resultData) {
						$isWin = 1;
					}

					break;
				// 表示該筆數據有異常，跳過
				default:
					$continueRecord = 'Y';
					break;
			}

			if ($continueRecord == 'Y') {
				$continueCount++;
				continue;
			} else {
				$processCount++;
				$sum_bet_money += $value['bet_money'];
			}

			if ($isWin == 0) {
				#結算-輸
				$checkoutAmount = $value['fs'];					//結算金額：返水
				$note = "运彩反水";
			} else {
				#結算-贏
				$checkoutAmount = $value['win'] + $value['fs'];	//結算金額：贏分 + 返水
				$note = "运彩中奖";
			}

			$sum_win += $checkoutAmount;
			$win_total = $checkoutAmount - $value['bet_money'];

			// 如不是模擬時，更新資料庫
			if ($simulation != 'Y') {
				$transaction = $db->beginTransaction();
				try {
					// 錢包餘額檢查
					$sql = 'SELECT
								u1.money,
								(SELECT
									m1.balance
								FROM
									money_log m1
								WHERE
									m1.user_id = u1.user_id
								ORDER BY m1.id desc limit 0, 1) as balance
							FROM
								user_list u1
							WHERE
								u1.user_id = '. $value['user_id'] .' for update';
					$dataArray = $db->createCommand($sql)->queryOne();

					if ($dataArray['money'] <> $dataArray['balance']) {
						$remark = '新运彩(' . $value['order_num'] . ')自动结算后资金异常[' . date('Y-m-d H:i:s') . ']';
						$sql = 'UPDATE
									user_list
								SET
									online = 0,
									Oid = "",
									status = "异常",
									remark = "'. $remark .'"
								WHERE
									user_id = ' . $value['user_id'] . ' and status <> "异常"';
						$db->createCommand($sql)->execute();
						$transaction->commit();
						continue;	// 本筆異常，跳下一筆
					} else {
						$balance = $dataArray['money'];
						// 更新下注記錄
						$sql = 'UPDATE
									event_order
								SET
									status = 1,
									is_win = ' . $isWin . ',
									win_total = ' . $win_total .'
								WHERE
									id = ' . $value['id'] . ' and status = 0';
						$result = $db->createCommand($sql)->execute();

						if ($result) {
							// 更新賽事結算狀態
							$eventOfficial = EventOfficial::findOne(['id' => $value['official_id']]);
							$eventOfficial->status = 2;
							$eventOfficial->save();

							if ($checkoutAmount > 0) {
								// 更新錢包金額
								$sql = 'UPDATE
											user_list
										SET
											money = money + '. $checkoutAmount .'
										WHERE
											user_id = ' . $value['user_id'];
								$db->createCommand($sql)->execute();

								// 新增交易記錄檔
								$sql = 'INSERT INTO money_log(user_id, order_num, about, update_time, type, order_value, assets, balance)
										VALUES ('.$value['user_id'].', '.$value['order_num'].', "新运彩", now(), "新运彩自动结算-'.$note.'", '.$checkoutAmount.','.$balance.','.($balance+$checkoutAmount).')';
								$result = $db->createCommand($sql)->execute();
							}

							$transaction->commit();
						} else {
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

			// 模擬結算
			if ($simulation == 'Y') {
				// 以賽事為單位，計算每場賽事的金額
				if (! isset($simulationReturn['result'][$checkField][ $value['game_id'] ]['bet']) ) {
					$simulationReturn['result'][$checkField][ $value['game_id'] ]['bet'] = 0;
					$simulationReturn['result'][$checkField][ $value['game_id'] ]['win'] = 0;
					$simulationReturn['result'][$checkField][ $value['game_id'] ]['count'] = 0;
				}

				$simulationReturn['result'][ $checkField ][ $value['game_id'] ]['bet'] += $value['bet_money'];
				$simulationReturn['result'][ $checkField ][ $value['game_id'] ]['win'] += $checkoutAmount;
				$simulationReturn['result'][ $checkField ][ $value['game_id'] ]['count'] ++;

				// 以賽事的item為單位，計算每個單位的金額
				if (! isset($detail[$checkField][$value['game_id']][$value['game_item_id']]['bet_money'])) {
					$detail[$checkField][$value['game_id']][$value['game_item_id']]['bet_money'] = 0;
					$detail[$checkField][$value['game_id']][$value['game_item_id']]['win'] = 0;
				}

				$detail[$checkField][$value['game_id']][$value['game_item_id']]['title'] = $value['title'];
				$detail[$checkField][$value['game_id']][$value['game_item_id']]['bet_money'] += $value['bet_money'];
				$detail[$checkField][$value['game_id']][$value['game_item_id']]['win'] += $checkoutAmount;
			}
		}

		// 返回模擬資訊
		if ($simulation == 'Y') {
			$simulationReturn['bet_total'] = $sum_bet_money;
			$simulationReturn['win'] = $sum_win;
			$simulationReturn['detail'] = $detail;

			return $simulationReturn;
		}

		return [
			'continueCount' => $continueCount,
			'processCount'  => $processCount,
			'sum_bet_money' => $sum_bet_money,
			'sum_win' => $sum_win,
			'scale' => ($sum_bet_money == 0 ? 0 : round($sum_win / $sum_bet_money, 4))
		];
	}

	/*
	更新彩票期別結算狀態
	修正為針對單一期數結算
	*/
	public function updateResultStatus($qishu)
	{
		$db = Yii::$app->db;
		$sql = 'update event_result set state = 1 where official_id = '.$qishu. ' ';
		$db->createCommand($sql)->execute();
	}

	/*
	還原運彩結算
	*/
	public function resetLottery($official_id)
	{
		$db = Yii::$app->db;
		$continueCount = 0;			//跳過記錄筆數
		$processCount = 0;			//處理記錄筆數

		$eventOrder = EventOrder::find()
			->where(['official_id' => $official_id])
			->andWhere(['!=', 'status', 3])    // status=3 廢單
			->asArray()
			->all();

		foreach ($eventOrder as $key => $value) {
			$transaction = $db->beginTransaction();
			try {
				// 錢包餘額檢查
				$sql = 'SELECT
							u1.money,
							(SELECT
								m1.balance
							FROM
								money_log m1
							WHERE
								m1.user_id = u1.user_id
							ORDER BY m1.id desc limit 0, 1) as balance
						FROM
							user_list u1
						WHERE
							u1.user_id = '. $value['user_id'] .' for update';
				$dataArray = $db->createCommand($sql)->queryOne();

				if ($dataArray['money'] <> $dataArray['balance']) {
					$remark = '新运彩(' . $value['order_sub_num'] . ')重新结算后资金异常[' . date('Y-m-d H:i:s') . ']';
					$sql = 'UPDATE
								user_list
							SET
								online = 0,
								Oid = "",
								status = "异常",
								remark = "' . $remark . '"
							WHERE
								user_id = ' . $value['user_id'] . ' and status <> "异常"';
					$db->createCommand($sql)->execute();
					$transaction->commit();
					$continueCount++;
					continue;	//本筆異常，跳下一筆
				} else {
					$processCount++;
					$balance = $dataArray['money'];

					if ( in_array($value['is_win'], ['1', '2']) || (($value['is_win'] == '0') && (0 < $value['fs'])) ) {
						$bet_money_total = 0;

						if ($value['is_win'] == '1') {
							$bet_money_total = $value['win'] + $value['fs'];
						} elseif ($value['is_win'] == '2') {
							$bet_money_total = $value['bet_money'];
						} else {
							if (($value['is_win'] == '0') && (0 < $value['fs'])) {
								$bet_money_total = $value['fs'];
							}
						}

						// 更新錢包金額
						$sql = 'UPDATE
									user_list
								SET
									money = money - '. $bet_money_total .'
								WHERE
									user_id = ' . $value['user_id'];
						$db->createCommand($sql)->execute();

						// 新增交易記錄檔
						$sql = 'INSERT INTO money_log(user_id, order_num, about, update_time, type, order_value, assets, balance)
								VALUES ('.$value['user_id'].', "'.$value['order_num'].'", "新运彩", now(), "新运彩重新结算-扣钱", '.$bet_money_total.','.$balance.','.($balance - $bet_money_total).')';
						$result = $db->createCommand($sql)->execute();
					}
				}

				// 更新訂單內容
				$sql = 'UPDATE
							event_order
						SET
							status = 0
						WHERE
							id = '. $value['id'] . ' and status <> 0';
				$result = $db->createCommand($sql)->execute();

				if ($result) {
					$transaction->commit();
				} else {
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
			'processCount' => $processCount
		];
	}
}
