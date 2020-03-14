<?php
/**
 * @auth ada
 * @date 2017-10-19 18:41
 * @descript Data Collection To Server
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LiveCollectionController extends Controller
{
	private static $rootPath = 'collectionData';

    public function actionIndex()
    {
		// $resultDs = $this->actionCollectionDsUpdate(Yii::$app->params['collectionAuth']['ds']);
		// $resultAg = $this->actionCollectionAgUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultOg = $this->actionCollectionOgUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultVr = $this->actionCollectionVrUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultKg = $this->actionCollectionKgUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultPt = $this->actionCollectionPtUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultAgSport = $this->actionCollectionAgsportUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultBbSport = $this->actionCollectionBbsportUpdate(Yii::$app->params['collectionAuth']['common']);
		// $resultIg = $this->actionCollectionIgUpdate();
		$resultAi = $this->actionCollectionAiUpdate();

		// echo 'DS ('.$resultDs.')'.PHP_EOL;
		// echo 'AG ('.$resultAg.')'.PHP_EOL;
		// echo 'OG ('.$resultOg.')'.PHP_EOL;
		// echo 'VR ('.$resultVr.')'.PHP_EOL;
		// echo 'KG ('.$resultKg.')'.PHP_EOL;
		// echo 'Pt ('.$resultPt.')'.PHP_EOL;
		// echo 'agsport ('.$resultAgSport.')'.PHP_EOL;
		// echo 'bbsport ('.$resultBbSport.')'.PHP_EOL;
		// echo 'Ig ('.$resultIg.')'.PHP_EOL;
		echo 'Ai ('.$resultAi.')'.PHP_EOL;
	}

	private function actionCollectionAiUpdate()
	{
		/**************************** 先拿token ****************************/
		$url = 'http://x1.xianpk10.com/api/Neil/AgentLogin';

        $field = json_encode([
            'userid' => 'fly',
            'password' => 'test123'
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // 設定不要直接顯示在畫面
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'               // 設定使用json格式傳參
        ]);
		curl_setopt($ch, CURLOPT_POST, true);
        $output = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (isset($output['code']) && $output['code'] == 0) {
            $token = $output['data']['token'];
        } else {
            // 登入失敗
            return 'Login Error';
		}

		/**************************** 再撈遊戲紀錄 ****************************/
        $platformType = 'AI';
		$use_table = 'live_order';
		$processInfo = [];
		$lastOrderNum = 0;
        $count = 0;

		//查詢目前目錄採集進度
        $filename = Yii::$app->getBasePath() . "/" . self::$rootPath . "/collectionAi.json";

		if (file_exists($filename)) {
			$jsonData = file_get_contents($filename);
			$data = json_decode($jsonData, true);
			$lastOrderNum = isset($data['orderNum']) ? $data['orderNum'] : 0;
		}

        $processInfo['startTime'] = date('Y-m-d H:i:s');
        $start = date('Y-m-d H:i:s', strtotime('-1 Hour'));
        $url = "http://x1.xianpk10.com/api/Neil/QueryTicketsFromAgentIdByForex";

        $field = json_encode([
            'token' => $token,
            'startTime' => $start,
            'endTime' => date('Y-m-d H:i:s')
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // 設定不要直接顯示在畫面
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'               // 設定使用json格式傳參
        ]);
		curl_setopt($ch, CURLOPT_POST, true);
        $output = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (isset($output['code']) && $output['code'] == 0) {
            if (count($output['data']['tickets']) > 0) {
				$duplicatie_update_field = [];
				$fieldArray = [
					'live_username',
					'order_num',
					'order_time',
					'live_th',
					'live_type',
					'live_office',
					'live_result',
					'bet_info',
					'bet_money',
					'live_win',
					'ip',
					'game_type',
					'valid_bet_amount',
					'balanceAfter'
				];

                foreach ($output['data']['tickets'] as $key => $val) {
                    // 只新增orderid大於目前紀錄的單
                    if ($val['orderid'] > $lastOrderNum) {
						switch ($val['symbol']) {
							case 'USDCHF':
								$live_th = '美元/瑞士法郎';
								break;
							case 'GBPUSD':
								$live_th = '英鎊/美元';
								break;
							case 'EURUSD':
								$live_th = '歐元/美元';
								break;
							case 'USDJPY':
								$live_th = '美元/日元';
								break;
							case 'NZDUSD':
								$live_th = '紐幣/美元';
								break;
							case 'AUDUSD':
								$live_th = '澳幣/美元';
								break;
							case 'USDCAD':
								$live_th = '美元/加幣';
								break;
							case 'XAUUSD':
								$live_th = '黃金/美元';
								break;
							case 'XAGUSD':
								$live_th = '白銀/美元';
								break;
							case 'BTCEUR':
								$live_th = '比特/歐元';
								break;
							case 'BTCUSD':
								$live_th = '比特/美元';
								break;
							case 'ETHUSD':
								$live_th = '乙太/美元';
								break;
							case 'LTCUSD':
								$live_th = '萊特/美元';
								break;
							default:
								$live_th = $val['symbol'];
								break;
						}

						switch ($val['betType']) {
							case '4':
								$live_type = '大小';
								$bet_info = ($val['betValue'] == 1) ? '小' : '大';
								break;
							case '5':
								$live_type = '單雙';
								$bet_info = ($val['betValue'] == 1) ? '單' : '雙';
								break;
							case '6':
								$live_type = '龍虎';
								break;
							case '7':
								$live_type = '名次';
								break;
							default:
								$live_type = $val['betType'];
								break;
						}

						$count ++;
                        $valueArray[$val['orderid']] = [
                            'live_username' => $val['name'],
                            'order_num' => $val['orderid'],
                            // AI那邊的時間格式 2019-11-06T05:43:33.000Z
                            'order_time' => date("Y-m-d H:i:s", strtotime($val['createTime'])),
                            'live_th' => $live_th,                  // 遊戲名
                            'live_type' => $live_type,              // 下注類型，4:大小 5:單雙 6:龍虎 7:名次
                            'live_office' => $val['period'],        // AI的期數
                            'live_result' => null,
                            'bet_info' => $bet_info,
                            'bet_money' => $val['totalGold'],
                            'live_win' => $val['totalBonus'] - $val['totalGold'],    // 贏的錢 - 下注的錢
                            'ip' => null,
                            'game_type' => $platformType,
                            'valid_bet_amount' => $val['totalGold'],
                            'balanceAfter' => null
                        ];

                        $processInfo['orderNum'] = $val['orderid'];
                        $processInfo['lastDate'] = date("Y-m-d H:i:s", strtotime($val['createTime']));
                    }
                }

				ksort($valueArray);

				foreach ($fieldArray as $key => $val) {
					$duplicatie_update_field[] = $val . " = VALUES(" . $val . ")";
				}

				$db = Yii::$app->db;
				$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
				$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE ' . implode(', ', $duplicatie_update_field))
				->execute();
			}
        }

		// 把當次採集進度記錄起來
        file_put_contents($filename, json_encode($processInfo));

        return $count;
	}

	private function actionCollectionDsUpdate($authName){
		$content = [];
		$order_num_array = [];
		$platformType = 'DS';
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_ds where ok <> 1 and serverName = \''.$authName.'\'')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				if($value1['json'] != ''){
					$content = json_decode($value1['json'], true);
					//------暫時寫------//
					#變更時間，直接-8小時，因為push_client -8小時
					$timestamp = $content['endTime'];
					$betTime = $timestamp - (60 * 60 * 8) * 1000;
					//------暫時寫------//
					$gaemDate = Yii::$app->formatter->asDate(($betTime/1000), 'php:Y-m-d H:i:s');

					$valueArray[$content['id']] = [
						'live_username' => $content['userName'],
						'order_num' => $content['id'],
						'order_time' => $gaemDate,
						'live_th' => $content['tableInfoId'],
						'live_type' => $content['gameType'],
						'live_office' => $content['issueNo'],
						'live_result' => $content['bankerResult'],
						'bet_info' => $content['liveMemberReportDetails'][0]['betType'],
						'bet_money' => $content['stakeAmount'],
						'live_win' => $content['winLoss'],
						'ip' => $content['ip'],
						'game_type' => $platformType,
						'valid_bet_amount' => $content['validStake'],
						'balanceAfter' => round($content['balanceAfter'],2)
					];

					$order_ds_array[] = $value1['id'];
				}
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE order_num = VALUES(order_num),
						live_office = VALUES(live_office),
						bet_money = VALUES(bet_money),
						live_win = VALUES(live_win),
						valid_bet_amount = VALUES(valid_bet_amount)')
			->execute();

			$db2->createCommand('update order_ds set ok = 1 where id in ('.implode(',',$order_ds_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionAgUpdate($authName){
		$content = [];
		$order_num_array = [];
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_ag where (ok <> 1 or ok is null) and playerName like \''.$authName.'%\' limit 3000')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				switch($value1['platformType']){
					case "HUNTER":
						$platformType = 'AG_HUNTER';
						break;
					case "MG":
						$platformType = 'AG_MG';
						break;
					case "OG":
						$platformType = 'AG_OG';
						break;
					case "BBIN":
						$platformType = 'AG_BBIN';
						break;
					case "SBTA":
						$platformType = 'SBTA';
						if($value1['remark'] != ''){
						$temp = explode("\"}],\"category\"",$value1['remark']);
						$live_type = explode("\"name\":\"",$temp[0]);
						$value1['gameType'] = $live_type[1];
						}
						break;
					default:
						$platformType = $value1['platformType'];
						break;
				}
				$valueArray[$value1['billNo']] = [
					'live_username' => $value1['playerName'],
					'order_num' => $value1['billNo'],
					'order_time' => $value1['betTime'],
					'live_th' => $value1['tableCode'],
					'live_type' => $value1['gameType'],
					'live_office' => $value1['gameCode'],
					'live_result' => $value1['result'],
					'bet_info' => $value1['playType'],
					'bet_money' => $value1['betAmount'],
					'live_win' => $value1['netAmount'],
					'ip' => $value1['loginIP'],
					'game_type' => $platformType,
					'valid_bet_amount' => $value1['validBetAmount'],
					'balanceAfter' => $value1['beforeCredit']
				];

				$order_ag_array[] = $value1['id'];
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE order_num = VALUES(order_num)')
			->execute();

			$db2->createCommand('update order_ag set ok = 1 where id in ('.implode(',',$order_ag_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionAgsportUpdate($authName){
		$content = [];
		$order_num_array = [];
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_agsport where (ok <> 1 or ok is null) and playerName like \''.$authName.'%\' limit 3000')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				switch($value1['platformType']){
					case "SBTA":
						$platformType = 'SBTA';
						if($value1['remark'] != ''){
						$json = $value1['remark'];
						$a = json_decode($json,true);
						if ($a != null){
							$value1['gameType'] = $a['detail'][0]['sport'][0]['name'];
						 }
						}
						break;
					default:
						$platformType = $value1['platformType'];
						break;
				}
				$valueArray[$value1['billNo']] = [
					'live_username' => $value1['playerName'],
					'order_num' => $value1['billNo'],
					'order_time' => $value1['betTime'],
					'live_th' => $value1['tableCode'],
					'live_type' => $value1['gameType'],
					'live_office' => $value1['gameCode'],
					'live_result' => $value1['result'],
					'bet_info' => $value1['playType'],
					'bet_money' => $value1['betAmount'],
					'live_win' => $value1['netAmount'],
					'ip' => $value1['loginIP'],
					'game_type' => $platformType,
					'valid_bet_amount' => $value1['validBetAmount'],
					'balanceAfter' => $value1['beforeCredit']
				];

				$order_agsport_array[] = $value1['id'];
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE order_num = VALUES(order_num)')
			->execute();

			$db2->createCommand('update order_agsport set ok = 1 where id in ('.implode(',',$order_agsport_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionBbsportUpdate($authName){
		$content = [];
		$order_num_array = [];
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_bbsport where (ok <> 1 or ok is null) and playerName like \''.$authName.'%\' limit 3000')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				switch($value1['platformType']){
					case "BB_Sport":
						$platformType = 'BB_Sport';
						break;
					default:
						$platformType = $value1['platformType'];
						break;
				}
				$valueArray[$value1['billNo']] = [
					'live_username' => $value1['playerName'],
					'order_num' => $value1['billNo'],
					'order_time' => $value1['betTime'],
					'live_th' => $value1['tableCode'],
					'live_type' => $value1['gameType'],
					'live_office' => $value1['gameCode'],
					'live_result' => $value1['result'],
					'bet_info' => $value1['playType'],
					'bet_money' => $value1['betAmount'],
					'live_win' => $value1['netAmount'],
					'ip' => $value1['loginIP'],
					'game_type' => $platformType,
					'valid_bet_amount' => $value1['validBetAmount'],
					'balanceAfter' => $value1['beforeCredit']
				];

				$order_bbsport_array[] = $value1['id'];
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE order_num = VALUES(order_num)')
			->execute();

			$db2->createCommand('update order_bbsport set ok = 1 where id in ('.implode(',',$order_bbsport_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionOgUpdate($authName){
		$content = [];
		$order_num_array = [];
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_og where (ok <> 1 or ok is null) and playerName like \''.$authName.'%\'')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				$platformType = 'OG';
				$valueArray[$value1['billNo']] = [
					'live_username' => $value1['playerName'],
					'order_num' => $value1['billNo'],
					'order_time' => $value1['betTime'],
					'live_th' => $value1['tableCode'],
					'live_type' => $value1['gameType'],
					'live_office' => $value1['gameCode'],
					'live_result' => $value1['result'],
					'bet_info' => $value1['playType'],
					'bet_money' => $value1['betAmount'],
					'live_win' => $value1['netAmount'],
					'ip' => $value1['loginIP'],
					'game_type' => $platformType,
					'valid_bet_amount' => $value1['validBetAmount'],
					'balanceAfter' => $value1['beforeCredit']
				];
				$order_ag_array[] = $value1['id'];
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE order_num = VALUES(order_num)')
			->execute();

			$db2->createCommand('update order_og set ok = 1 where id in ('.implode(',',$order_ag_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionVrUpdate($authName){
		$content = [];
		$order_vr_array = [];
		$order_num_array = [];
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		//$arrayData = $db2->createCommand('SELECT * FROM order_vr where ok <> 1 and playerName like \''.$authName.'%\'')->queryAll();
		//state -1.全部 , 0.未颁奖 , 1.撤单 , 2.未中奖 ,3.中 奖
		$arrayData = $db2->createCommand('SELECT * FROM order_vr where ok <> 1 and state in (2,3) and playerName like \''.$authName.'%\'')->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'game_room', 'game_type', 'valid_bet_amount'];
			foreach($arrayData as $key1 => $value1){
				if($value1['json'] != ''){
					$content = json_decode($value1['json'], true);
					//------暫時寫------//
					#變更時間，直接+8小時，因為原資料是UTC+0小時
					$timestamp = strtotime($content['createTime']);
					//$betTime = $timestamp + (60 * 60 * 8);
					//------暫時寫------//
					$gaemDate = Yii::$app->formatter->asDate($timestamp, 'php:Y-m-d H:i:s');

					if($value1['dataType'] == 3){	//資料類型:1.投注 2.追注 3.打賞
						$valueArray[$content['serialNumber']] = [
							'live_username' => $content['playerName'],
							'order_num' => $content['serialNumber'],
							'order_time' => $gaemDate,
							'live_th' => $content['channelId'],
							'live_type' => $content['channelName'],
							'live_office' => '',
							'live_result' => '',
							'bet_info' => $content['giftName'],	//下注內容填內打賞名稱
							'bet_money' => $content['cost'],
							'live_win' => (0 - $content['cost']),
							'game_room' => $content['channelName'],
							'game_type' => 'VR',
							'valid_bet_amount' => $content['cost']
						];
					}else{
						$valueArray[$content['serialNumber']] = [
							'live_username' => $content['playerName'],
							'order_num' => $content['serialNumber'],
							'order_time' => $gaemDate,
							'live_th' => $content['channelId'],
							'live_type' => $content['channelCode'],
							'live_office' => $content['issueNumber'],
							'live_result' => count($content['prizeDetail'])==0?'':json_encode($content['prizeDetail']),
							'bet_info' => $content['number'],
							'bet_money' => $content['cost'],
							'live_win' => ($content['playerPrize'] - $content['cost']),
							'game_room' => $content['channelName'],
							'game_type' => 'VR',
							'valid_bet_amount' => $content['cost']
						];
					}

					$order_vr_array[] = $value1['id'];
				}
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE order_num = VALUES(order_num)')
			->execute();

			$db2->createCommand('update order_vr set ok = 1 where id in ('.implode(',',$order_vr_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionKgUpdate($authName){
		$content = [];
		$order_num_array = [];
		$use_table = 'live_order';

		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_kg where (ok <> 1 or ok is null) and playerName like \''.$authName.'%\'')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				$platformType = 'KG';
				$valueArray[$value1['billNo']] = [
					'live_username' => $value1['playerName'],
					'order_num' => $value1['billNo'],
					'order_time' => $value1['betTime'],
					'live_th' => $value1['tableCode'],
					'live_type' => $value1['gameType'],
					'live_office' => $value1['gameCode'],
					'live_result' => $value1['result'],
					'bet_info' => $value1['playType'],
					'bet_money' => $value1['betAmount'],
					'live_win' => $value1['netAmount'],
					'ip' => $value1['loginIP'],
					'game_type' => $platformType,
					'valid_bet_amount' => $value1['validBetAmount'],
					//'balanceAfter' => $value1['beforeCredit']
					'balanceAfter' => null
				];
				$order_kg_array[] = $value1['id'];
			}
			$duplicatie_update_field = [];
			foreach($fieldArray as $key1 => $value1){
				if($value1 != 'createtime'){
					$duplicatie_update_field[] = $value1 ." = VALUES(" . $value1 . ")";
				}
			}
			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE '.implode(', ',$duplicatie_update_field))
			->execute();

			$db2->createCommand('update order_kg set ok = 1 where id in ('.implode(',',$order_kg_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionPtUpdate($authName){
		$content = [];
		$order_num_array = [];
		$use_table = 'live_order';
		$authName =strtoupper($authName);
		$db2 = Yii::$app->db2;
		$arrayData = $db2->createCommand('SELECT * FROM order_pt where (ok <> 1 or ok is null) and playerName like \''.$authName.'%\'')
		->queryAll();

		if(count($arrayData) > 0){
			$fieldArray = ['live_username', 'order_num', 'order_time', 'live_th', 'live_type', 'live_office', 'live_result', 'bet_info', 'bet_money', 'live_win', 'ip', 'game_type', 'valid_bet_amount', 'balanceAfter'];
			foreach($arrayData as $key1 => $value1){
				$platformType = 'PT';
				$valueArray[$value1['billNo']] = [
					//KBETU-G05AAATAM5689 -> g05aaatam5689
					//$playerName = strtolower();
					'live_username' => $value1['playerName'],
					'order_num' => $value1['billNo'],
					'order_time' => $value1['betTime'],
					'live_th' => $value1['tableCode'],
					'live_type' => $value1['gameType'],
					'live_office' => $value1['gameCode'],
					'live_result' => $value1['result'],
					'bet_info' => $value1['playType'],
					'bet_money' => $value1['betAmount'],
					'live_win' => $value1['netAmount'],
					'ip' => $value1['loginIP'],
					'game_type' => $platformType,
					'valid_bet_amount' => $value1['validBetAmount'],
					//'balanceAfter' => $value1['beforeCredit']
					'balanceAfter' => null
				];
				$order_pt_array[] = $value1['id'];
			}
			$duplicatie_update_field = [];
			foreach($fieldArray as $key1 => $value1){
				if($value1 != 'createtime'){
					$duplicatie_update_field[] = $value1 ." = VALUES(" . $value1 . ")";
				}
			}
			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE '.implode(', ',$duplicatie_update_field))
			->execute();

			$db2->createCommand('update order_pt set ok = 1 where id in ('.implode(',',$order_pt_array).')')
			->execute();
		}

		return count($arrayData);
	}

	private function actionCollectionIgUpdate()
	{
		/**************************** 先拿token ****************************/
		$url = "https://admin-stage.iconic-gaming.com/service/login";

        $field = [
            'username' => 'yunhangCompany2019',
            'password' => '6VQeGKdsKyrd'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($field));
        $output = json_decode(curl_exec($ch), true);
		curl_close($ch);

        if (isset($output['data'])) {
            $token = ["Authorization: Bearer " . $output['token']];
        } else {
            // 登入失敗
            return 'Login Error';
		}

		/**************************** 再撈遊戲紀錄 ****************************/
        $platformType = 'IG';
        $use_table = 'live_order';
        $count = 0;

		//查詢目前目錄採集進度
        $filename = Yii::$app->getBasePath() . "/" . self::$rootPath . "/collectionIg.json";

		if (file_exists($filename)) {
			$jsonData = file_get_contents($filename);
			$data = json_decode($jsonData, true);
			$processInfo = $data;
		} else {
            $processInfo = [];
            $processInfo['orderNum'] = 0;
		}

        $processInfo['startTime'] = date('Y-m-d H:i:s');

        $start = strtotime(gmdate('Y-m-d H:i:s') . "-1 Hour") * 1000;
        $url = "https://admin-stage.iconic-gaming.com/service/api/v1/profile/rounds";
        $url .= "?status=finish";         // 該局狀態，finish為完成狀態
        $url .= "&order=asc";             // 正排序，時間越早排前面
        $url .= "&start=" . $start;       // 建立起始時間，時區 +0, 需補到毫秒 Ex. 1566230400000
        // $url .= "&end=" . $end;        // 建立結束時間，時區 +0, 需補到毫秒 Ex. 1566230400000
        $url .= "&pageSize=10000";        // 單頁顯示筆數，預設 10 筆，單次最大查詢 10,000 筆

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $token);
        $output = json_decode(curl_exec($ch), true);
		curl_close($ch);

        if ($output['totalSize'] > 0) {
            $fieldArray = [
                'live_username',
                'order_num',
                'order_time',
                'live_th',
                'live_type',
                'live_office',
                'live_result',
                'bet_info',
                'bet_money',
                'live_win',
                'ip',
                'game_type',
                'valid_bet_amount',
                'balanceAfter'
            ];

            foreach ($output['data'] as $key => $val) {
				// 只新增id大於目前紀錄的單
                if ($val['id'] > $processInfo['orderNum']) {
                    $count ++;
                    $valueArray[$val['id']] = [
                        'live_username' => $val['player'],
						'order_num' => $val['id'],
						// IG那邊的時間格式 2019-11-06T05:43:33.000Z
                        'order_time' => date("Y-m-d H:i:s", strtotime($val['createdAt'])),
                        'live_th' => $val['productId'],       // 遊戲代號
                        'live_type' => $val['gameType'],      // 遊戲類別
                        'live_office' => $val['game'],        // 遊戲名稱
                        'live_result' => null,
                        'bet_info' => null,
                        'bet_money' => $val['bet'] / 100,     // IG那邊的金錢單位必須除100才會等於正常單位
                        'live_win' => $val['win'] / 100,
                        'ip' => null,
                        'game_type' => $platformType,
                        'valid_bet_amount' => null,
                        'balanceAfter' => null
                    ];

                    $processInfo['orderNum'] = $val['id'];
                    $processInfo['lastDate'] = date("Y-m-d H:i:s", strtotime($val['createdAt']));
                }
			}

			$duplicatie_update_field = [];

			foreach ($fieldArray as $key => $val) {
                if ($val != 'createtime') {
                    $duplicatie_update_field[] = $val . " = VALUES(" . $val . ")";
                }
			}

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE ' . implode(', ', $duplicatie_update_field))
			->execute();
        }

		// 把當次採集進度記錄起來
        file_put_contents($filename, json_encode($processInfo));

        return $count;
	}
}