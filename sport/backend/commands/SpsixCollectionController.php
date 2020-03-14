<?php
/**
 * @auth ada
 * @date 2017-11-14 18:41
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
class SpsixCollectionController extends Controller
{
    public function actionIndex()
    {
		$resultLottery = $this->actionCollectionLotteryUpdate();
		echo 'Lottery '.PHP_EOL;
		print_r($resultLottery);
		$this->setSchedule();
    }

	public function actionSetSchedule()
    {
		$resultLottery = $this->actionCollectionLotteryUpdate();
		echo 'Lottery '.PHP_EOL;
		print_r($resultLottery);
		$this->setSchedule(1);
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
	private function actionCollectionLotteryUpdate_(){
		$resultArray = [];

		$tableArray = [
			#採集Table => 後台Table
			'lottery_result_splhc'	=>	'lottery_result_splhc',
		];

		#取得目前各種彩票類型同步最後單號
		$tableQishu = $this->getMaxQishu($tableArray);

		$url = "http://127.0.0.1:8084/index.php?r=lottery-check/update";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tableQishu));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		$lotteryData = json_decode($output, true);

		foreach($lotteryData as $key1 => $value1){
			if($value1['count'] > 0){
				$use_table = $tableArray[$key1];
				$db = Yii::$app->db;
				$sql = $db->queryBuilder->batchInsert($use_table, $value1['fieldArray'], $value1['arrayData']);
				$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE qishu = VALUES(qishu)')
				->execute();
			}
			$resultArray[$key1] = $value1['count'];
		}

		return $resultArray;
	}

	//直接連採集資料庫
	private function actionCollectionLotteryUpdate(){
		$resultArray = [];

		$tableArray = [
			#採集Table => 後台Table
			'lottery_result_splhc'	=>	'lottery_result_splhc'
		];

		#取得目前各種彩票類型同步最後單號
		$tableQishu = $this->getMaxQishu($tableArray);

		foreach($tableQishu as $key1 => $value1){
			$fieldArray = [];

			$db2 = Yii::$app->db2;
			$arrayData = $db2->createCommand('SELECT * FROM '.$key1.' where qishu > \''.$value1.'\'')
			->queryAll();

			if(count($arrayData) > 0){
				$fieldArray = array_keys($arrayData[0]);
				$use_table = $tableArray[$key1];

				#刪除Id欄位
				$delcolumn = array_search('id',$fieldArray);
				if($delcolumn!==false){
					unset($fieldArray[$delcolumn]);
				}
				foreach($arrayData as $key2 => $value2){
					unset($arrayData[$key2]['id']);
				}

				$db = Yii::$app->db;
				$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $arrayData);
				$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE qishu = VALUES(qishu)')
				->execute();
			}
			$resultArray[$key1] = count($arrayData);
		}

		return $resultArray;
	}

	#取得開獎期別
	private function getQishu($dateTime){
		$hour = date('H', strtotime($dateTime));
		$minute = date('i', strtotime($dateTime));
		if($hour < 10){
			$ymd = date('Ymd', strtotime($dateTime .' -1 day'));
			$num = floor((($hour * 60) + $minute + (60 * 14))/5);	//凌晨要加上14小時
		}else{
			$ymd = date('Ymd', strtotime($dateTime));
			$num = floor((($hour * 60) + $minute - 600)/5);
		}

		$qishu = $ymd . sprintf("%03d", $num);
		return $qishu;
	}

	#取得開獎時間
	private function getDateTime($qishu){
		$num = (int)substr($qishu, -3);
		$minute = $num * 5;
		$baseTime = substr($qishu,0,4) . '-' . substr($qishu,4,2) . '-' . substr($qishu,6,2) .' 10:00:00';
		$dateTime = date('Y-m-d H:i:00', strtotime($baseTime . $minute . ' minute'));
		return $dateTime;
	}

	/*
	設定期別
	1.只留目前時間 ~ 後2天期別
	2.每天凌晨00:00 - 00:20 檢查更新
	*/
	private function setSchedule($is_frist=0){
		#凌晨新增設定
		if($is_frist == 0)
		{
			if(!(date('H:i') >= '00:00' && date('H:i') < '00:20')){
				return false;
			}
		}

		$result = [
			'count' => 0,
		];
		$db = Yii::$app->db;

		$currTime = date('Y-m-d H:i:00');
		$strDate = date('Y-m-d', strtotime($currTime . ' -1 day'));
		$endDate = date('Y-m-d', strtotime($currTime . ' 1 day'));
		$dateDiff = ceil((strtotime($endDate) - strtotime($strDate))/3600/24);

		for($d=1;$d<=$dateDiff;$d++){
			$currDate = date('Ymd', strtotime($strDate. ($d -1) .' day'));
			switch($d){
				default:
					$strNum = 1;
					$endNum = 216;
					break;
			}

			for($i=$strNum;$i<=$endNum;$i++){
				$qishu = $currDate . sprintf("%03d", $i);
				$kaijiang_time = $this->getDateTime($qishu);	//開獎
				$kaipan_time = date('Y-m-d H:i:s', strtotime($kaijiang_time . ' -5 minute,15 second'));	//開盤
				$fenpan_time = date('Y-m-d H:i:s', strtotime($kaijiang_time . ' -15 second'));	//封盤
				$this->saveSchecule($qishu, $kaipan_time, $fenpan_time, $kaijiang_time);
				$result['count']++;
			}
		}

		#刪除已失效排程
		$sql = 'delete from spsix_lottery_schedule where kaijiang_time < "' . $strDate . ' 00:00:00"';
		$db->createCommand($sql)->execute();
		return $result;
	}

	#開獎排程存檔
	private function saveSchecule($qishu, $kaipan_time, $fenpan_time, $kaijiang_time){
		$db = Yii::$app->db;
		$user_table = 'spsix_lottery_schedule';
		$fieldArray = ['qishu', 'kaipan_time', 'fenpan_time', 'kaijiang_time', 'create_time'];
		$valueArray[0] = [
			'qishu' => $qishu,
			'kaipan_time' => $kaipan_time,
			'fenpan_time' => $fenpan_time,
			'kaijiang_time' => $kaijiang_time,
			'create_time' => date('Y-m-d H:i:s')
		];

		$sql = $db->queryBuilder->batchInsert($user_table, $fieldArray, $valueArray);
		$db->createCommand($sql . ' ON DUPLICATE KEY UPDATE qishu = VALUES(qishu)')->execute();
	}
}