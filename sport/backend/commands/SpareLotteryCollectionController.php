<?php
/*
 * @Description: 備用採集主機,當234.210皆無法使用時,可使用此commands
 * @Author: lai
 * @Date: 2019-01-09 14:36:33
 * @LastEditTime: 2019-01-11 17:09:55
 * @LastEditors: Please set LastEditors
 */
namespace app\commands;
use Yii;
use yii\console\Controller;
use linslin\yii2\curl;

class SpareLotteryCollectionController extends Controller{
    //預設參數
    private static $_staticParams = [
		'rootPath' => 'collectionData',
		'lotteryType' => '',
		'startTime' => ''
    ];
    /**
     * @description: 主執行
     * @param $lotteryType 採票類型
     * @return: 
     */
     public function actionIndex($lotteryType = '')
     {
         if($lotteryType == ''){
            echo '目前限制需輸入彩票類型';
            return false;
         }else{
            self::$_staticParams['lotteryType'] = $lotteryType;
         }
         
         self::$_staticParams['startTime'] = date('Y-m-d H:i:s');
 
         //查詢目前目錄採集進度
         $filename = Yii::$app->basePath.'/'.self::$_staticParams['rootPath']."/processLottery.json";
         if(file_exists($filename)){
             $jsonData = file_get_contents($filename);
             $content = json_decode($jsonData,true);
         }else{
             $content = []; 
         }
         
         if(@$content['status']['processLocked'] == 'Y'){
             #處理時間超過1分鐘時可以跑(判斷可能有問題)
             #彩票的部份不限制了
             $start = strtotime($content['status']['startTime']);
             $end = strtotime(date('Y-m-d H:i:s'));
             $diffMin = floor(($end - $start)/ 60);
             if($diffMin < 0){
                 return 'Process is Busy.';
             }
         }
         $content['status'] = [
             'startTime' => date('Y-m-d H:i:s'),
             'endTime' => '',
             'processLocked' => 'Y'
         ];
         file_put_contents($filename, json_encode($content));
 
         self::$_staticParams['process'] = $content;
         
         $this->actionGetJson();
         $this->actionSetProcesLog('finish');
     }
     /**
      * @description: 取得資料
      * @param {type} 
      * @return: 
      */
     private function actionGetJson()
     {
         $recordList = [];
         
         $db = Yii::$app->db;
         $urlfilename = Yii::$app->basePath.'\\'.self::$_staticParams['rootPath']."\\collectionLotteyURL.json";
         if(file_exists($urlfilename)){
            $jsonData = file_get_contents($urlfilename);
            $arrayData = json_decode($jsonData,true)[self::$_staticParams['lotteryType']];
        }else{
            return 'no url data'; 
        }
        //  $arrayData = $db->createCommand('SELECT * FROM lottery_setting where use_yn = 1 and TIME(now()) between start_time and end_time and table_suffix = "'.self::$_staticParams['lotteryType'].'"')->queryAll();
        //  print_r($arrayData);
        //  return ;
         if(count($arrayData) > 0){
             //print_r($arrayData);
             foreach($arrayData as $key1 => $value1){
                 if($value1['collection_url'] != ''){
                     if(isset(self::$_staticParams['process']['lotteryType'][$value1['lottery_type']])){
                         $serverParam['request']['params']['except'] = round(self::$_staticParams['process']['lotteryType'][$value1['lottery_type']]['lastFile']);
                     }else{
                         $serverParam['request']['params']['except'] = 0;
                     }
                     $apiURL = $value1['collection_url'];
                     $curl = new curl\Curl();
                     /* 2種方式都可以
                     $response = $curl->setRequestBody(json_encode($serverParam['request']))
                     ->setHeaders([
                         'Content-Type' => 'application/json',
                         'Content-Length' => strlen(json_encode($serverParam['request']))
                     ])->post($apiURL);
                     */
                     $response = $curl->get($apiURL);
                     
                     switch ($curl->responseCode) {
                         case 'timeout':
                             //timeout error logic here
                             echo 'timeout';
                             break;
                         case 200:
                             $resultJson = json_decode($response, true);
                             switch ($value1['jsonFormat']){
                                 case "1":
                                     $recordList = @$resultJson['data'];
                                     break;
                                 default:
                                     $recordList = @$resultJson;
                                     break;
                             }
                             //print_r($resultJson);
                             echo 'Type:'.$value1['lottery_type'].' connect success('.count($recordList).')'.PHP_EOL;
                             
                             if(count($recordList) > 0){
                                 $result = $this->actionCreateMultiple($value1, $recordList, $value1['jsonFormat']);
                                 #set Log
                                 $this->actionSetProcesLog('save', $value1['lottery_type'], $result['opentime'], $result['except']);
                             }
                             break;
                         case 404:
                             //404 Error logic here
                             echo '404 Error';
                             break;
                     }
                     $curl->reset();
                 }
             }
         }
     }
    /**
      * @description: 寫入紀錄的json檔
      * @param $processKind=執行動作 $platformType=採種 $porsessDate=動作日期 $file=記錄檔位置
      * @return: 
      */
     private function actionSetProcesLog($processKind, $platformType = '', $porsessDate = '', $file = '')
     {
         $filename = Yii::$app->basePath.'/'.self::$_staticParams['rootPath']."/processLottery.json";
         switch($processKind){
             case "download":
                 self::$_staticParams['process']['lotteryType'][$platformType]['lastDownload'] = $file;
                 break;
             case "save":
                 self::$_staticParams['process']['lotteryType'][$platformType]['lastDate'] = $porsessDate;
                 self::$_staticParams['process']['lotteryType'][$platformType]['lastFile'] = $file;
                 self::$_staticParams['process']['lotteryType'][$platformType]['processTime'] = date('Y-m-d H:i:s');
                 break;
             case "finish":
                 self::$_staticParams['process']['status']['endTime'] = date('Y-m-d H:i:s');
                 self::$_staticParams['process']['status']['processLocked'] = 'N';
                 break;
         }
         file_put_contents($filename, json_encode(self::$_staticParams['process']));
     }
     /**
      * @description: 寫入資料庫
      * @param {type} 
      * @return: 
      */
     public function actionCreateMultiple(array $apiInfo, array $insertData, $jsonFormat)
    {
		$ball_array = [];
		$processInfo = ['except' => 0];

		$use_table = 'lottery_result_'.$apiInfo['table_suffix'];
		$fieldArray = ['qishu', 'create_time', 'datetime', 'from_url'];
		$duplicatie_update_field[] = 'qishu = VALUES(qishu)';
		
		if(count($insertData) > 0){
			foreach($insertData as $key1 => $value1){
				switch ($jsonFormat){
					case "1":
						$expectNo = $value1['expect'];
						$ballString = explode("+", $value1['opencode']);
						$opentime = $value1['opentime'];
						break;
					case "2":
						$expectNo = $key1;
						$ballString = explode("+", $value1['number']);
						$opentime = $value1['dateline'];
						break;
					case "3":
						$expectNo = $value1['issue'];
						$ballString = explode("+", $value1['openNum']);
						$opentime = date('Y-m-d H:i:s', substr($value1['openDateTime'], 0, 10));
						break;
					default:
						$expectNo = $value1['expect'];
						$ballString = explode("+", $value1['number']);
						$opentime = $value1['dateline'];
						break;
				}
				
				$ballArray = explode(",", $ballString[0]);
				
				#香港彩還要加上特別號
				switch($apiInfo['lottery_type']){
					case 'gdkl10f':	//單號後3碼改為2碼 20171104084 -> 2017110484
						$expectNo = substr($expectNo, 0, -3).substr($expectNo, -2);
						break;
					case 'k3beijing':	//單號改為數值 093618 -> 93618
						$expectNo = (int)$expectNo;
						break;
						
					case 'hk6':
						$ballArray[] .= $ballString[1];
						break;
				}
				$ball_count = count($ballArray);
				
				$valueArray[$expectNo] = [
					$expectNo,
					date('Y-m-d H:i:s'),	//這個之後要改成資料庫時間
					$opentime,
					$apiInfo['collection_url']
				];
				
				$valueArray[$expectNo] = array_merge($valueArray[$expectNo], $ballArray);
				
				$processInfo = [
					'opentime' => $opentime,
					'except' => $expectNo
				];
			}
			for($i = 1; $i <= $ball_count; $i++){
				$fieldArray[] .= 'ball_'.$i;
				$duplicatie_update_field[] = 'ball_'.$i.' = VALUES(ball_'.$i.')';
			}
			ksort($valueArray);

			$db = Yii::$app->db;
			$sql = $db->queryBuilder->batchInsert($use_table, $fieldArray, $valueArray);
			//$update_rule = ' ON DUPLICATE KEY UPDATE '.implode(', ',$duplicatie_update_field);
			$update_rule = ' ON DUPLICATE KEY UPDATE qishu = VALUES(qishu)';
			$db->createCommand($sql . $update_rule)->execute();

			$filename = Yii::$app->basePath.'/'.self::$_staticParams['rootPath']."/processLotteryLog.json";
			$logText[] = '【'.$apiInfo['table_suffix'].'】';
			$logText[] = self::$_staticParams['startTime'];
			$logText[] = date('Y-m-d H:i:s');
			//$logText[] = 'count:'.count($insertData);
			$logText[] = json_encode(end($valueArray));
			file_put_contents($filename, implode(' - ', $logText).PHP_EOL, FILE_APPEND);
			return $processInfo;
		}
    }
}

?>