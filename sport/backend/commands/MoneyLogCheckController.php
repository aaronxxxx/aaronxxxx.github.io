<?php
/**
 * @auth ada
 * @date 2018-11-29 22:36
 * @異常處理 - Money彩票重覆結算
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

# command
# php yii money-log-check 2018-11-26 2018-11-29

class MoneyLogCheckController extends Controller
{
	public $strDate,$endDate;
    public function actionIndex($strDate = '', $endDate = '', $user_id = ''){
		if($strDate == '' || $endDate == ''){
			echo '請輸入執行日期!!';
			return false;
		}else{
			$this->strDate = $strDate;
			$this->endDate = $endDate;
		}

		if(!is_readable('runtime/MoneyLog')){
			mkdir('runtime/MoneyLog', 0755, true);
		}

		$result = $this->fixMoneyLog($user_id);
    }
	
	private function fixMoneyLog($user_id){
		$db = Yii::$app->db;
		$total_abnormal = 0;
		$abnormal = [];
		
		
		$filename = "runtime/MoneyLog/".date('YmdHis').".log";
		file_put_contents($filename,  date('Y-m-d H:i:s').'_' . $this->strDate . '_' . $this->endDate. PHP_EOL);

		$sql = 'select
					distinct user_id 
				from
					money_log
				where
					update_time between "'.$this->strDate.' 00:00:00" and "'.$this->endDate.' 23:59:59"
					and type like "彩票%"';
		if($user_id != ''){
			$sql .= ' and user_id = ' . $user_id;
		}
		$userList = $db->createCommand($sql)->queryAll();
		
		if(count($userList) > 0){
			foreach($userList as $key1 => $value1){
				$sql = 'select *
						  from money_log
						  where
							update_time between "'.$this->strDate.' 00:00:00" and "'.$this->endDate.' 23:59:59"
							and type like "彩票%"
							and user_id = ' . $value1['user_id'] .'
						  order by order_num, update_time';
				$logList = $db->createCommand($sql)->queryAll();
				
				$lastData = [];
				foreach($logList as $key2 => $value2){
					if($value2['order_num'] == @$lastData['order_num'] && $value2['type'] == @$lastData['type']){
						$sql = 'select id from money_log where type="重複结算-扣钱'.$value2['id'].'"';

						$checkLog = $db->createCommand($sql)->queryAll();

						if(count($checkLog) == 0){
							$abnormal[$value2['user_id']][] = $value2;
							$total_abnormal += $value2['order_value'];
							file_put_contents($filename, json_encode($value2) . PHP_EOL, FILE_APPEND );

							$transaction = $db->beginTransaction();
							try {
								#錢包餘額檢查
								$sql = 'select
											u1.money,
											(select m1.balance from money_log m1 where m1.user_id = u1.user_id order by m1.id desc limit 0,1) as balance
										from
											user_list u1
										where
											u1.user_id = '.$value2['user_id'].' for update';
								$dataArray = $db->createCommand($sql)->queryOne();
								if($dataArray['money'] <> $dataArray['balance']){
									$remark = $lottery_name.'(' . $value2['order_num'] .')重新结算后资金异常['.date('Y-m-d H:i:s').']';
									$sql = 'update user_list set online = 0, Oid="", status = "异常", remark = "'.$remark.'" where user_id = ' . $value2['user_id'] .' and status <> "异常"';
									$db->createCommand($sql)->execute();
									$transaction->commit(); //add transaction

									@$continueCount++;
									continue;	//本筆異常，跳下一筆
								}else{
									@$processCount++;
									$balance = $dataArray['money'];

									#更新錢包金額
									$sql = 'update user_list set money = money - '. $value2['order_value'] .' where user_id = ' . $value2['user_id'];
									$db->createCommand($sql)->execute();

									#新增交易記錄檔
									$sql = 'INSERT INTO money_log(user_id, order_num, about, update_time, type, order_value, assets, balance)
											VALUES ('.$value2['user_id'].', "'.$value2['order_num'].'", "'.$value2['about'].'", now(), "重複结算-扣钱'.$value2['id'].'", '.$value2['order_value'].','.$balance.','.($balance - $value2['order_value']).')';
									$result = $db->createCommand($sql)->execute();
									echo $sql;

								}
								
								$transaction->commit();
							} catch (\Exception $e) {
								$transaction->rollBack();
								throw $e;
							} catch (\Throwable $e) {
								$transaction->rollBack();
								throw $e;
							}
						}
					}
					$lastData = $value2;
				}
			}
		}
		
		file_put_contents($filename, 'Total Money:' . $total_abnormal . PHP_EOL, FILE_APPEND );
		
		#列出異常
		//echo '<pre>';
		//print_r($abnormal);
		//echo '</pre>';
		echo '總筆數：' . count($abnormal) . PHP_EOL;
		echo '總金額：' . $total_abnormal . PHP_EOL;
		
		exit;
	}
}