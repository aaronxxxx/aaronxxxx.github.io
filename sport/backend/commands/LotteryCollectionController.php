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
class LotteryCollectionController extends Controller
{
    public function actionIndex()
    {
		$resultLottery = $this->actionCollectionLotteryUpdate();
		echo 'Lottery '.PHP_EOL;
		print_r($resultLottery);
    }
	public function actionIndexToday()
    {
		$resultLottery = $this->actionCollectionLotteryUpdate_today();
		echo 'Lottery '.PHP_EOL;
		print_r($resultLottery);
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
			'lottery_result_bjkn'	=>	'lottery_result_bjkn',
			'lottery_result_bjpk'	=>	'lottery_result_bjpk',
			'lottery_result_cq'		=>	'lottery_result_cq',
			'lottery_result_cqsf'	=>	'lottery_result_cqsf',
			'lottery_result_d3'		=>	'lottery_result_d3',
			'lottery_result_gd11'	=>	'lottery_result_gd11',
			'lottery_result_gdsf'	=>	'lottery_result_gdsf',
			'lottery_result_gxsf'	=>	'lottery_result_gxsf',
			'lottery_result_lhc'	=>	'lottery_result_lhc',
			'lottery_result_p3'		=>	'lottery_result_p3',
			'lottery_result_shssl'	=>	'lottery_result_t3',
			'lottery_result_mlaft'	=>	'lottery_result_mlaft',
			'lottery_result_ts'		=>	'lottery_result_ts',
			//'lottery_result_tj'		=>	'lotter_result_tj',
			'lottery_result_tjsf'	=>	'lottery_result_tjsf'
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
			'lottery_result_bjkn'	=>	'lottery_result_bjkn',
			'lottery_result_bjpk'	=>	'lottery_result_bjpk',
			'lottery_result_cq'		=>	'lottery_result_cq',
			'lottery_result_cqsf'	=>	'lottery_result_cqsf',
			'lottery_result_d3'		=>	'lottery_result_d3',
			'lottery_result_gd11'	=>	'lottery_result_gd11',
			'lottery_result_gdsf'	=>	'lottery_result_gdsf',
			'lottery_result_gxsf'	=>	'lottery_result_gxsf',
			'lottery_result_lhc'	=>	'lottery_result_lhc',
			'lottery_result_p3'		=>	'lottery_result_p3',
			'lottery_result_shssl'	=>	'lottery_result_t3',
			'lottery_result_mlaft'	=>	'lottery_result_mlaft',
			'lottery_result_ts'		=>	'lottery_result_ts',
			//'lottery_result_tj'		=>	'lottery_result_tj',
			'lottery_result_tjsf'	=>	'lottery_result_tjsf'
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

	//直接連採集資料庫
	private function actionCollectionLotteryUpdate_today(){
		$resultArray = [];

		$tableArray = [
			#採集Table => 後台Table
			'lottery_result_bjkn'	=>	'lottery_result_bjkn',
			'lottery_result_bjpk'	=>	'lottery_result_bjpk',
			'lottery_result_cq'		=>	'lottery_result_cq',
			'lottery_result_cqsf'	=>	'lottery_result_cqsf',
			'lottery_result_d3'		=>	'lottery_result_d3',
			'lottery_result_gd11'	=>	'lottery_result_gd11',
			'lottery_result_gdsf'	=>	'lottery_result_gdsf',
			'lottery_result_gxsf'	=>	'lottery_result_gxsf',
			'lottery_result_lhc'	=>	'lottery_result_lhc',
			'lottery_result_p3'		=>	'lottery_result_p3',
			'lottery_result_shssl'	=>	'lottery_result_t3',
			'lottery_result_mlaft'	=>	'lottery_result_mlaft',
			'lottery_result_ts'		=>	'lottery_result_ts',
			//'lottery_result_tj'		=>	'lottery_result_tj',
			'lottery_result_tjsf'	=>	'lottery_result_tjsf'
		];

		#取得目前各種彩票類型同步最後單號
		$tableQishu = $this->getMaxQishu($tableArray);

		foreach($tableQishu as $key1 => $value1){
			$fieldArray = [];
			$today = date('Y-m-d 00:00:00');
			$db2 = Yii::$app->db2;
			$arrayData = $db2->createCommand('SELECT * FROM '.$key1.' where qishu > \''.$value1.'\' AND create_time > \''.$today.'\'')
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
}