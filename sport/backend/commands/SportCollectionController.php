<?php
/**
 * @auth ada
 * @date 2018-05-19 11:15
 * @descript Data Collection To Server
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class SportCollectionController extends Controller
{
    public function actionIndex()
    {
		/*echo '早盤/足球/波膽/半場=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqzcsbbd');
		sleep(1);

		echo '早盤/足球/總入球=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqzcrqs');
		sleep(1);

		echo '早盤/足球/獨贏&讓球&大小&單/雙=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqzcds');
		sleep(1);

		echo '早盤/足球/[半場/全場]';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqzcbqc');
		sleep(1);

		echo '早盤/足球/波膽/全場';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqzcbd');
		sleep(1);

		//$sportGames = $this->actionCollectionSportUpdate('BK');

		echo '今日賽事/足球/獨贏&讓球&大小&單/雙=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqds');
		sleep(1);

		echo '今日賽事/足球/波膽/全場=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqbd');
		sleep(1);

		echo '今日賽事/足球/波膽/半場=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqsbbd');
		sleep(1);

		echo '今日賽事/足球/總入球=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqrqs');
		sleep(1);

		echo '今日賽事/足球/半場/全場=';
		$sportGames = $this->actionCollectionSportUpdateFT('sport_zqbqc');
		sleep(1);

		echo '足球結果=';
		$sportGames = $this->actionCollectionSportUpdateFT('score_zqbf');
		sleep(1);

		echo'籃球賽事=';
		$sportGames = $this->actionCollectionSportUpdate('BK');
		sleep(1);*/

		echo'網球賽事=';
		$sportGames = $this->actionCollectionSportUpdate('TN');
		sleep(1);

		//echo 'Lottery '.PHP_EOL;
		//print_r($resultLottery);
    }

	//取得表格最大期別號
	private function getMaxQishu(array $table){
		$query = [];
		foreach($table as $key1 => $value1){
			$query[] = 'select \''.$key1.'\' as lotteryType,max(qishu) as maxQishu from '.$value1;
		}

		$db = Yii::$app->db;
		$result = $db->createCommand(implode(' union ', $query))
		->queryAll();

		foreach($result as $key1 => $value1){
			$tableQishu[$value1['lotteryType']] = $value1['maxQishu'];
		}
		return $tableQishu;
	}

	//使用API方式
	private function actionCollectionSportUpdate($sportType){
		$returnData = [];
		$resultArray = [];

		$tableArray = [
			#採集Table => 後台Table
			#棒球
			'BS' => [
				'collection' => [
					'sport_bqds',	#棒球比賽賠率
					'sport_bqzc',	#棒球滾地賠率
				],
				'save' => 'baseball_match',

			],
			#籃球
			'BK' => [
				'collection' => [
					'sport_lqds',	#籃球比賽賠率
					//'sport_lqgq',	#美式足球賠率(目前看好像沒有抓，之後再確認一下)
					//'sport_lqzc',	#籃球滾地賠率
				],
				'save' => 'lq_match',
				'fieldArray' => [
					'Match_ID', 'Match_Date', 'Match_Time', 'Match_Name', 'Match_Master', 'Match_Guest', 'Match_IsLose', 'Match_Type',
					'Match_ShowType', 'Match_Ho', 'Match_Ao', 'Match_RGG', 'Match_DxGG', 'Match_Dxdpl', 'Match_Dxxpl', 'Match_Dsdpl',
					'Match_Dsspl', 'Match_BzM', 'Match_BzG', 'Match_BzH', 'Match_CoverDate', 'Match_MasterID', 'Match_GuestID',
					'Match_MatchTime', 'iPage', 'iSn', 'Match_LstTime'
				]
			],
			#排球
			'VB' => [
				'collection' => [
					'sport_pqds',	#排球比賽賠率
					'sport_pqzc',	#排球滾地賠率
				],
				'save' => 'volleyball_match'
			],
			#網球
			'TN' => [
				'collection' => [
					'sport_wqds',	#網球比賽賠率
					//'sport_wqzc',	#網球滾地賠率
				],
				'save' => 'tennis_match',
				'fieldArray' => [
					'Match_ID', 'Match_Date', 'Match_Time', 'Match_Name', 'Match_Master', 'Match_Guest', 'Match_IsLose', 'Match_Type',
					'Match_Ho', 'Match_Ao', 'Match_RGG', 'Match_BzM', 'Match_BzG', 'Match_DxGG', 'Match_DxDpl', 'Match_DxXpl', 'Match_DsDpl',
					'Match_DsSpl', 'Match_CoverDate', 'Match_MasterID', 'Match_GuestID', 'Match_MatchTime', 'match_showtype', 'Match_LstTime'
				]
			],
			/*#足球
			'FT' => [
				'collection' => [
					'sport_gjsj_team',	#早盤/足球/冠軍(含point)
					'sport_gjds',		#早盤/足球/冠軍
					'sport_zqzcsbbd',	#早盤/足球/波膽/半場
					'sport_zqzcrqs',	#早盤/足球/總入球
					'sport_zqzcds',		#早盤/足球/獨贏&讓球&大小&單/雙
					'sport_zqzcbqc',	#早盤/足球/[半場/全場]
					'sport_zqsbbd',		#今日賽事/足球/波膽/半場，預測一場比賽的比分
					'sport_zqrqs',		#今日賽事/足球/總入球
					'sport_zqgq',		#滾球/足球 / 獨贏&讓球&大小&單/雙
					'sport_zqds',		#今日賽事/足球/獨贏&讓球&大小&單/雙
					'sport_zqbqc',		#今日賽事/足球/半場/全場
					'sport_zqbd',		#今日賽事/足球/波膽/全場
				],
				'save' => 'bet_match'
			],*/
		];

		$key = '34f82e04-5a1e-1036-aa37-9d52c3dbfe6a';
		$param_array = [
			'type' => $sportType,
			'table' => json_encode($tableArray[$sportType]['collection'])
		];
		foreach($param_array as $key1 => $value1){
			$temp_array[] = $key1 . '=' . $value1;
		}
		$string = implode('&', $temp_array);
		$param_array['sign'] = md5($string . $key);

		$url = "http://127.0.0.1:8084/index.php?r=sport-check/games";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param_array));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		$responseData = json_decode($output, true);
		//var_dump($responseData);
		//return;
		if($responseData['code'] == 1){
			$db = Yii::$app->db;
			$use_table = $tableArray[$sportType]['save'];
			$fieldArray = $tableArray[$sportType]['fieldArray'];
			foreach($fieldArray as $key1 => $value1){
				if($value1 != 'created_at'){
					$duplicatie_update_field[] = $value1 ." = VALUES(" . $value1 . ")";
				}
			}

			if(count($responseData['result']) > 0){
				$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $responseData['result']);
                $update_rule = ' ON DUPLICATE KEY UPDATE '.implode(', ',$duplicatie_update_field);
                $result = $db->createCommand($sql . $update_rule)->execute();
                $returnData['code'] = $result;
			}
			echo $result;
		}else{
			echo $responseData['msg'];
		}
	}

	//使用API方式(足球太複雜,分開寫吧)
	private function actionCollectionSportUpdateFT($sportType){
		$returnData = [];
		$resultArray = [];
		$tableArray = [
			#足球 sport_zqzcbqc  #早盤/足球/[半場/全場]
			'sport_zqzcbqc' => [
				'collection' => [
					'sport_zqzcbqc',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_Type','Match_BqMM','Match_BqMH','Match_BqMG','Match_BqHM','Match_BqHH','Match_BqHG','Match_BqGM','Match_BqGH','Match_BqGG','Match_CoverDate','Match_LstTime'
				]
			],
			#足球 sport_zqzcbd  #早盤/足球/波膽/全場
			'sport_zqzcbd' => [
				'collection' => [
					'sport_zqzcbd',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_Date','Match_Time','Match_Name','Match_Master','Match_Guest','Match_IsLose','Match_CoverDate','Match_Bd10','Match_Bd20','Match_Bd21','Match_Bd30','Match_Bd31','Match_Bd32','Match_Bd40','Match_Bd41','Match_Bd42','Match_Bd43','Match_Bd00','Match_Bd11','Match_Bd22','Match_Bd33','Match_Bd44','Match_Bdgup5','Match_Bdg10','Match_Bdg20','Match_Bdg21','Match_Bdg30','Match_Bdg31','Match_Bdg32','Match_Bdg40','Match_Bdg41','Match_Bdg42','Match_Bdg43','Match_Type','Match_MasterID','Match_GuestID','iPage','iSn','Match_LstTime'
				]
			],
			#足球 sport_zqzcsbbd  #早盤/足球/波膽/半場
			'sport_zqzcsbbd' => [
				'collection' => [
					'sport_zqzcsbbd',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_Date','Match_Time','Match_Name','Match_Master','Match_Guest','Match_IsLose','Match_CoverDate','Match_Hr_Bd10','Match_Hr_Bd20','Match_Hr_Bd21','Match_Hr_Bd30','Match_Hr_Bd31','Match_Hr_Bd32','Match_Hr_Bd40','Match_Hr_Bd41','Match_Hr_Bd42','Match_Hr_Bd43','Match_Hr_Bd00','Match_Hr_Bd11','Match_Hr_Bd22','Match_Hr_Bd33','Match_Hr_Bd44','Match_Hr_Bdup5','Match_Hr_Bdg10','Match_Hr_Bdg20','Match_Hr_Bdg21','Match_Hr_Bdg30','Match_Hr_Bdg31','Match_Hr_Bdg32','Match_Hr_Bdg40','Match_Hr_Bdg41','Match_Hr_Bdg42','Match_Hr_Bdg43','Match_Type','Match_MasterID','Match_GuestID','Match_LstTime'
				]
			],
			#足球 score_zqbf  #結果
			'score_zqbf' => [
				'collection' => [
					'score_zqbf',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','MB_Inball','TG_Inball','MB_Inball_HR','TG_Inball_HR','Match_LstTime','match_js'
				]
			],
			#足球sport_zqds  #今日賽事/足球/獨贏&讓球&大小&單/雙
			'sport_zqds' => [
				'collection' => [
					'sport_zqds',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_HalfId','Match_Date','Match_Time','Match_Name','Match_Master','Match_Guest','Match_IsLose','Match_CoverDate','Match_Type','Match_MasterID','Match_GuestID','iPage','iSn','Match_ShowType','Match_Ho','Match_Ao','Match_RGG','Match_BzM','Match_BzG','Match_BzH','Match_DxGG','Match_DxDpl','Match_DxXpl','Match_DsDpl','Match_DsSpl','Match_Hr_ShowType','Match_BRpk','Match_BHo','Match_BAo','Match_Bdpl','Match_Bxpl','Match_Bdxpk','Match_Bmdy','Match_Bgdy','Match_Bhdy','Match_TypePlay','Match_MatchTime','Match_LstTime'
					]
			],
			#足球 sport_zqrqs  #今日賽事/足球/總入球
			'sport_zqrqs' => [
				'collection' => [
					'sport_zqrqs',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_Total01Pl','Match_Total23Pl','Match_Total46Pl','Match_Total7upPl','Match_CoverDate','Match_LstTime'
				]
			],
			#足球 sport_zqbqc  #今日賽事/足球/半場/全場
			'sport_zqbqc' => [
				'collection' => [
					'sport_zqbqc',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_BqMM','Match_BqMH','Match_BqMG','Match_BqHM','Match_BqHH','Match_BqHG','Match_BqGM','Match_BqGH','Match_BqGG','Match_CoverDate','Match_LstTime'
				]
			],
			#足球 sport_zqbd  #今日賽事/足球/波膽/全場
			'sport_zqbd' => [
				'collection' => [
					'sport_zqbd',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_Date','Match_Time','Match_Name','Match_Master','Match_Guest','Match_IsLose','Match_CoverDate','Match_Bd10','Match_Bd20','Match_Bd21','Match_Bd30','Match_Bd31','Match_Bd32','Match_Bd40','Match_Bd41','Match_Bd42','Match_Bd43','Match_Bd00','Match_Bd11','Match_Bd22','Match_Bd33','Match_Bd44','Match_Bdgup5','Match_Bdg10','Match_Bdg20','Match_Bdg21','Match_Bdg30','Match_Bdg31','Match_Bdg32','Match_Bdg40','Match_Bdg41','Match_Bdg42','Match_Bdg43','Match_Type','Match_MasterID','Match_GuestID','iPage','iSn','Match_LstTime'
				]
			],
			#足球 sport_zqzcds  #早盤/足球/獨贏&讓球&大小&單/雙
			'sport_zqzcds' => [
				'collection' => [
					'sport_zqzcds',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID', 'Match_Date', 'Match_Time', 'Match_Name', 'Match_Master', 'Match_Guest', 'Match_IsLose', 'Match_CoverDate', 'Match_Type', 'Match_MasterID', 'Match_GuestID', 'iPage', 'iSn', 'Match_ShowType', 'Match_Ho', 'Match_Ao', 'Match_RGG', 'Match_BzM', 'Match_BzG', 'Match_BzH', 'Match_DxGG', 'Match_DxDpl', 'Match_DxXpl', 'Match_DsDpl', 'Match_DsSpl', 'Match_Hr_ShowType', 'Match_BRpk', 'Match_BHo', 'Match_BAo', 'Match_Bdpl', 'Match_Bxpl', 'Match_Bdxpk', 'Match_Bmdy', 'Match_Bgdy', 'Match_Bhdy', 'Match_TypePlay', 'Match_MatchTime','Match_LstTime'
				]
			],
			#足球 sport_zqsbbd  #今日賽事/足球/波膽/半場
			'sport_zqsbbd' => [
				'collection' => [
					'sport_zqsbbd',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_CoverDate','Match_Hr_Bd10','Match_Hr_Bd20','Match_Hr_Bd21','Match_Hr_Bd30','Match_Hr_Bd31','Match_Hr_Bd32','Match_Hr_Bd40','Match_Hr_Bd41','Match_Hr_Bd42','Match_Hr_Bd43','Match_Hr_Bd00','Match_Hr_Bd11','Match_Hr_Bd22','Match_Hr_Bd33','Match_Hr_Bd44','Match_Hr_Bdup5','Match_Hr_Bdg10','Match_Hr_Bdg20','Match_Hr_Bdg21','Match_Hr_Bdg30','Match_Hr_Bdg31','Match_Hr_Bdg32','Match_Hr_Bdg40','Match_Hr_Bdg41','Match_Hr_Bdg42','Match_Hr_Bdg43','Match_MasterID','Match_GuestID','Match_LstTime'
				]
			],
			#足球 sport_zqzcrqs  #早盤/足球/總入球
			'sport_zqzcrqs' => [
				'collection' => [
					'sport_zqzcrqs',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_Type','Match_Total01Pl','Match_Total23Pl','Match_Total46Pl','Match_Total7upPl','Match_CoverDate','Match_LstTime'
				]
			],

			#足球 sport_zqds	#今日賽事/足球/獨贏&讓球&大小&單/雙
			'FT' => [
				'collection' => [
					'sport_zqds',
				],
				'save' => 'bet_match',
				'fieldArray' => [
					'Match_ID','Match_HalfId','Match_Date','Match_Time','Match_Name','Match_Master','Match_Guest','Match_IsLose','Match_CoverDate','Match_Type','Match_MasterID','Match_GuestID','iPage','iSn','Match_ShowType','Match_Ho','Match_Ao','Match_RGG','Match_BzM','Match_BzG','Match_BzH','Match_DxGG','Match_DxDpl','Match_DxXpl','Match_DsDpl','Match_DsSpl','Match_Hr_ShowType','Match_BRpk','Match_BHo','Match_BAo','Match_Bdpl','Match_Bxpl','Match_Bdxpk','Match_Bmdy','Match_Bgdy','Match_Bhdy','Match_TypePlay','Match_MatchTime','Match_LstTime'
				]
			],
		];

		$key = '34f82e04-5a1e-1036-aa37-9d52c3dbfe6a';
		$param_array = [
			'type' => $sportType,
			'table' => json_encode($tableArray[$sportType]['collection'])
		];
		foreach($param_array as $key1 => $value1){
			$temp_array[] = $key1 . '=' . $value1;
		}
		$string = implode('&', $temp_array);
		$param_array['sign'] = md5($string . $key);

		$url = "http://127.0.0.1:8084/index.php?r=sport-check/games";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param_array));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//var_dump($output);
		$responseData = json_decode($output, true);
		//var_dump($responseData);
		//return;
		if($responseData['code'] == 1){
			$db = Yii::$app->db;
			$use_table = $tableArray[$sportType]['save'];
			$fieldArray = $tableArray[$sportType]['fieldArray'];
			foreach($fieldArray as $key1 => $value1){
				if($value1 != 'created_at'){
					$duplicatie_update_field[] = $value1 ." = VALUES(" . $value1 . ")";
				}
			}

			if(count($responseData['result']) > 0){
				$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $responseData['result']);
                $update_rule = ' ON DUPLICATE KEY UPDATE '.implode(', ',$duplicatie_update_field);
                $result = $db->createCommand($sql . $update_rule)->execute();
                $returnData['code'] = $result;
			}
			echo $result;
		}else{
			echo $responseData['msg'];
		}
	}



}