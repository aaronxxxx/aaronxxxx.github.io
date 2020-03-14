<?php

namespace app\modules\lottery\controllers;

use YII;
// use app\modules\lottery\modules\lzmlaft\models\ar\LotteryResultMlaft;
// use app\modules\lottery\modules\lzfc3d\models\ar\LotteryResultD3;
// use app\modules\lottery\modules\lzpl3\models\ar\LotteryResultP3;
// use app\modules\lottery\modules\lzshssl\models\ar\LotteryResultT3;
// use app\modules\lottery\modules\lzcqssc\models\ar\LotteryResultCq;
// use app\modules\lottery\modules\lzgdsf\models\ar\LotteryResultGdsf;
// use app\modules\lottery\modules\lzgxsf\models\ar\LotteryResultGxsf;
// use app\modules\lottery\modules\lztjsf\models\ar\LotteryResultTjsf;
// use app\modules\lottery\modules\lzcqsf\models\ar\LotteryResultCqsf;
// use app\modules\lottery\modules\lzgd11\models\ar\LotteryResultGd11;
// use app\modules\lottery\modules\lzkl8\models\ar\LotteryResultBjkn;
// use app\modules\lottery\modules\lzpk10\models\ar\LotteryResultBjpk;
use app\modules\lottery\modules\lztjssc\models\ar\LotteryResultTj;
use app\modules\lottery\modules\lzssrc\models\ar\LotteryResultSsrc;
use app\modules\lottery\modules\lzorpk\models\ar\LotteryResultOrpk;
use app\modules\lottery\modules\lzcqssc\util\BallUtil; //CQ 開獎規則

error_reporting(0);
class LotteryResultApiController extends \yii\web\Controller {
	public static $result_array;
	public static $ballarray;
	public static $game_type_ssc;

	public function init() {
		parent::init ();
		$this->layout = 'lotteryresult';
		self::$ballarray=array();
		self::$result_array=array(
			"errorCode" => 0,
			"message" => "操作成功",
			"result" => array(
				"businessCode" => 0,
				"data" => array(),
				"message"=>"操作成功",
				),
		);
		self::$game_type_ssc=array(
			//牌型玩法
			'杂六' => 0,
			'半顺' => 1,
			'顺子' => 2,
			'对子' => 3,
			'豹子' => 4,
			//龍虎玩法//0:龍,1:虎,2和
			'龙'   => 0,
			'虎'   => 1,
			'和'   => 2,
		);
	}


	/**
  	* @description: 
  	* @param {type} 
  	* @return: 
	*/
    public function actionJsonResults($gtype = null)
    {
        $result = array();						 //回傳結果
        $query_time = date ( "Y-m-d", time () ); //時間
        $qishu_query = null;					 //預設期數為空
        switch ($gtype)
        {
            case 'TJ':
                $query_time = date ( "Y-m-d", time () );
                self::$ballarray=array('ball_1','ball_2','ball_3','ball_4','ball_5');
                $Now_tjssc = \app\modules\lottery\modules\lztjssc\controllers\IndexController::getTjsscInfo();
                $Now_tjssc['count_total'] = 800;		//一天共開800期
                $Now_tjssc['lotName'] = "极速时时彩";    //彩票名稱
                if($Now_tjssc['number'] - $Now_tjssc['numbers'] == 2)	//最新當期-最新開獎假 = 設資料差距兩期,代表目前未開
                {
                    $Now_tjssc['kaijiang'] = date("Y-m-d H:i:s",strtotime($Now_tjssc['kaijiang']." -108 sec"));    //將開獎時間改為上一期的資料, 不開獎
                }
                $HistoryList = LotteryResultTj::getResultList ( $qishu_query , $query_time );//撈取歷史資料
                $result = self::ResultIntodataInfo_FIVE($HistoryList,$Now_tjssc);//資料處理
                break;
            case 'SSRC':
                self::$ballarray=array('ball_1','ball_2','ball_3','ball_4','ball_5','ball_6','ball_7','ball_8','ball_9','ball_10');
                $Now_Ssrc = \app\modules\lottery\modules\lzssrc\controllers\IndexController::getSSrcInfo();
                $Now_Ssrc['count_total'] = 720;		//一天共開44期
                $Now_Ssrc['lotName'] = "极速赛车";  //彩票名稱
                if($Now_Ssrc['number'] - $Now_Ssrc['numbers'] == 2)	//最新當期-最新開獎假 = 設資料差距兩期,代表目前未開
                {
                    $Now_Ssrc['kaijiang'] = date("Y-m-d H:i:s",strtotime($Now_Ssrc['kaijiang']." -5 minutes"));//將開獎時間改為上一期的資料, 不開獎
                }
                $HistoryList = LotteryResultSsrc::getResultList ( $qishu_query , $query_time );//撈取歷史資料
                $result = self::ResultIntodataInfo_TEN($HistoryList,$Now_Ssrc);//資料處理
				break;
			case 'ORPK':
                self::$ballarray=array('ball_1','ball_2','ball_3','ball_4','ball_5','ball_6','ball_7','ball_8','ball_9','ball_10');
                $Now_Orpk = \app\modules\lottery\modules\lzorpk\controllers\IndexController::getorpkInfo();
                $Now_Orpk['count_total'] = 168;		//一天共開168期 10:00 ~ 23:59
				$Now_Orpk['lotName'] = "老PK拾";  //彩票名稱
                if($Now_Orpk['number'] - $Now_Orpk['numbers'] == 2)	//最新當期-最新開獎假 = 設資料差距兩期,代表目前未開
                {
                    $Now_Orpk['kaijiang'] = date("Y-m-d H:i:s",strtotime($Now_Orpk['kaijiang']." -5 minutes"));//將開獎時間改為上一期的資料, 不開獎
				}
                $HistoryList = LotteryResultOrpk::getResultList ( $qishu_query , $query_time );//撈取歷史資料
                $result = self::ResultIntodataInfo_TEN($HistoryList,$Now_Orpk);//資料處理
                break;
            default:
                array_push($result,"無法取得彩票票種");
                break; 
        }
    
        return json_encode($result);
    }
	 
	
	/**
  	* @description: 
  	* @param {type} 
  	* @return: 
	*/
    public function GetLotteryJsonResults($table , $num)
    {	
		$result = LotteryResultSsrc::getKJResultForTableNum($table , $num);
		return $result;
    }


    public function actionJsonHistoryData($gtype = null)
    {
        $result = array();						 //回傳結果
        $query_time = date ( "Y-m-d", time () ); //時間
        $qishu_query = null;					 //預設期數為空
        switch ($gtype)
        {
            case 'TJ':
                $query_time = date ( "Y-m-d", time () );//跨天需要另外的參數
                self::$ballarray=array('ball_1','ball_2','ball_3','ball_4','ball_5');
                $HistoryList = LotteryResultTj::getResultList ( $qishu_query , $query_time );
                $result = self::ResultIntodataHistory_FIVE($HistoryList);
                break;
            case 'SSRC':
				self::$ballarray=array('ball_1','ball_2','ball_3','ball_4','ball_5','ball_6','ball_7','ball_8','ball_9','ball_10');
				$HistoryList = LotteryResultSsrc::getResultList ( $qishu_query , $query_time );
				$result = self::ResultIntodataHistory_TEN($HistoryList);
				break;
			case 'ORPK':
				self::$ballarray=array('ball_1','ball_2','ball_3','ball_4','ball_5','ball_6','ball_7','ball_8','ball_9','ball_10');
				$HistoryList = LotteryResultOrpk::getResultList ( $qishu_query , $query_time );
				$result = self::ResultIntodataHistory_TEN($HistoryList);
				break;
            default:
                array_push($result,"無法取得彩票票種");
                break; 
            
        }
        return json_encode($result);
    }
	/* 
	** 將資料轉成特定格式 適用票種 : CQ
	** input : $HistoryList-當天歷史資料 , $Now-當期開獎資訊
	** output : Array - 加工過的資料陣列
	*/
	public function ResultIntodataInfo_FIVE($HistoryList,$Now)
	{
		$drawCount = count($HistoryList);		//計算今日已開出期數
		$HistoryList = $HistoryList[0];			//取出最新開獎期數
		$rank=array();
		$result = array();
		// 放入排名陣列
		foreach (self::$ballarray as $key => $value) {
			array_push($rank, (int)$HistoryList[$value]);
		}
		$ballutil=new BallUtil();
		$hm[] = $ballutil->BuLing($rank[0]);
		$hm[] = $ballutil->BuLing($rank[1]);
		$hm[] = $ballutil->BuLing($rank[2]);
		$hm[] = $ballutil->BuLing($rank[3]);
		$hm[] = $ballutil->BuLing($rank[4]);
		
		$result['sumNum'] = array_sum($rank);	//開獎數字總和
		$result['preDrawCode'] = implode(',',$rank);	//開獎號碼
		$result['drawIssue'] = floatval($Now['number']);	//當期期數 
		$result['drawTime'] = date('Y-m-d H:i:s', strtotime($Now['kaijiang']) );	//當期開獎時間 	
		$result['preDrawTime'] = $HistoryList['datetime'];//上期開獎時間
		$result['preDrawDate'] = date( 'Y-m-d',strtotime($HistoryList['datetime']) );	//當天
		$result['firstNum'] = (int)$rank[0];		//開獎號碼(1)
		$result['preDrawIssue'] = floatval($HistoryList['qishu']);	//開獎期數編號
		$result['secondNum'] = (int)$rank[1];	//開獎號碼(2)
		$result['thirdNum'] = (int)$rank[2];		//開獎號碼(3)
		$result['fourthNum'] = (int)$rank[3];	//開獎號碼(4)
		$result['fifthNum'] = (int)$rank[4];		//開獎號碼(5)
		$result['drawCount'] = (int)$drawCount;  //已開期數
		$result['sumBigSmall'] = array_sum($rank)>22 ? 0:1;	//大于或等于 23 为总和大，小于或等于 22 为总和小,0為大
		$result['sumSingleDouble'] = (array_sum($rank)+1)%2;	//(第(1)個數字+第(2)個數字+1)%2,0為單
		$result['behindThree'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,5)];	//前三碼牌型
		$result['betweenThree'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,6)];	//中三碼牌型
		$result['dragonTiger'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,4)];//0:龍,1:虎,2和
		$result['fifthBigSmall'] = (int)$rank[4] > 4 ? 0:1;	//(5)大小 0=大 1=小
		$result['fifthSingleDouble'] = ((int)$rank[4]%2) != 0 ? 0:1;	//(5)單雙 0=單 1=雙
		$result['firstBigSmall'] = (int)$rank[0] > 4 ? 0:1;	//(1)大小 0=大 1=小
		$result['firstSingleDouble'] = ((int)$rank[0]%2) != 0 ? 0:1;	//(1)單雙 0=單 1=雙
		$result['fourthBigSmall'] = (int)$rank[3] > 4 ? 0:1;	//(4)大小 0=大 1=小
		$result['fourthSingleDouble'] = ((int)$rank[3]%2) != 0 ? 0:1;	//(4)單雙 0=單 1=雙
		$result['lastThree'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,7)];	//後三碼牌型;
		$result['sdrawCount'] = '';//js 中沒使用
		$result['secondBigSmall'] = (int)$rank[1] > 4 ? 0:1;	//(2)大小 0=大 1=小
		$result['secondSingleDouble'] = ((int)$rank[1]%2) != 0 ? 0:1;	//(2)單雙 0=單 1=雙
		$result['thirdBigSmall'] = (int)$rank[2] > 4 ? 0:1;	//(3)大小 0=大 1=小
		$result['thirdSingleDouble'] = ((int)$rank[2]%2) != 0 ? 0:1;	//(3)單雙 0=單 1=雙
		$result['id'] = (int)('4071'.substr($HistoryList['qishu'], -2) );//407152
		$result['status'] = 0;//沒用
		$result['frequency'] = ''; //沒用
		$result['totalCount'] = $Now['count_total'];
		$result['lotCode'] = 10002;	//URL參數 10002 為正常
		$result['iconUrl'] = '';	//沒用
		$result['shelves'] = 0;	//沒用
		$result['groupCode'] = 2;	//沒用
		$result['lotName'] = $Now['lotName'];
		$result['serverTime'] = date('Y-m-d H:i:s');	//主機時間 date('Y-m-d H:i:s',strtotime('+7 seconds',strtotime(date('Y-m-d H:i:s'))));
		$result['index'] = 100;
		self::$result_array['result']['data'] = $result;
		return self::$result_array;
	}
	/*
	** 將資料庫取的資料轉成特定格式(歷史資料) 適用票種 : TJSSC
	** input : $HistoryList-歷史資料
	** output : Array - 加工過的資料陣列
	*/
	public function ResultIntodataHistory_FIVE($HistoryList)
	{
		$returnList = array();
		foreach ($HistoryList as $key => $value) {
			
			$result = array();
			$rank=array();
			foreach (self::$ballarray as $key1 => $value1) {
				array_push($rank, $HistoryList[$key][$value1]);
			}
			$hm = array();
			$ballutil=new BallUtil();
			$hm[] = $ballutil->BuLing($rank[0]);
			$hm[] = $ballutil->BuLing($rank[1]);
			$hm[] = $ballutil->BuLing($rank[2]);
			$hm[] = $ballutil->BuLing($rank[3]);
			$hm[] = $ballutil->BuLing($rank[4]);
			$result['preDrawCode'] = implode(',',$rank);	//開獎號碼
			$result['groupCode'] = 2;						//分類預設彩票=1
			$result['preDrawTime'] = $HistoryList[$key]["datetime"];//開獎時間
			$result['preDrawIssue'] = floatval($HistoryList[$key]["qishu"]);	//開獎期數
			$result['sumNum'] = array_sum($rank);	//號碼總和
			$result['sumBigSmall'] = array_sum($rank)>22 ? 0:1;	//大于或等于 23 为总和大，小于或等于 22 为总和小,0為大
			$result['sumSingleDouble'] =  (array_sum($rank)+1)%2;	//(第(1)個數字+第(2)個數字+1)%2,0為單
			$result['behindThree'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,5)];	//前三碼牌型
			$result['betweenThree'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,6)];	//中三碼牌型
			$result['dragonTiger'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,4)];//0:龍,1:虎,2和
			$result['fifthBigSmall'] = (int)$rank[4] > 4 ? 0:1;	//(5)大小 0=大 1=小
			$result['fifthSingleDouble'] = ((int)$rank[4]%2) != 0 ? 0:1;	//(5)單雙 0=單 1=雙
			$result['firstBigSmall'] = (int)$rank[0] > 4 ? 0:1;	//(1)大小 0=大 1=小
			$result['firstSingleDouble'] = ((int)$rank[0]%2) != 0 ? 0:1;	//(1)單雙 0=單 1=雙
			$result['fourthBigSmall'] = (int)$rank[3] > 4 ? 0:1;	//(4)大小 0=大 1=小
			$result['fourthSingleDouble'] = ((int)$rank[3]%2) != 0 ? 0:1;	//(4)單雙 0=單 1=雙
			$result['lastThree'] = self::$game_type_ssc[$ballutil->Ssc_Auto($hm,7)];	//後三碼牌型;
			$result['secondBigSmall'] = (int)$rank[1] > 4 ? 0:1;	//(2)大小 0=大 1=小
			$result['secondSingleDouble'] = ((int)$rank[1]%2) != 0 ? 0:1;	//(2)單雙 0=單 1=雙
			$result['thirdBigSmall'] = (int)$rank[2] > 4 ? 0:1;	//(3)大小 0=大 1=小
			$result['thirdSingleDouble'] = ((int)$rank[2]%2) != 0 ? 0:1;	//(3)單雙 0=單 1=雙
			array_push($returnList,$result);
		}
		self::$result_array['result']['data'] = $returnList;
		return self::$result_array;
    }
    
    	/* 
	** 將資料轉成特定格式 適用票種 : BJPK , 賽艇 , 秒速賽車
	** input : $HistoryList-當天歷史資料 , $Now-當期開獎資訊
	** output : Array - 加工過的資料陣列
	*/
	public function ResultIntodataInfo_TEN($HistoryList,$Now)
	{
		$drawCount = count($HistoryList);		//計算今日已開出期數
		$HistoryList = $HistoryList[0];			//取出最新開獎期數
		$rank=array();
		$result = array();
		// 放入排名陣列
		foreach (self::$ballarray as $key => $value) {
			array_push($rank, sprintf("%02d", (int)$HistoryList[$value]));
		}
		$result['preDrawCode'] = implode(',',$rank);	//開獎號碼
		$result['drawIssue'] = floatval($Now['number']);	//當期期數 
		$result['drawTime'] = date('Y-m-d H:i:s', strtotime($Now['kaijiang']));	//當期開獎時間 	
		$result['preDrawTime'] = $HistoryList['datetime'];//上期開獎時間
		$result['preDrawDate'] = date( 'Y-m-d',strtotime($HistoryList['datetime']) );	//當天
		$result['firstNum'] = (int)$rank[0];		//開獎號碼(1)
		$result['preDrawIssue'] = floatval($HistoryList['qishu']);	//開獎期數編號
		$result['secondNum'] = (int)$rank[1];	//開獎號碼(2)
		$result['thirdNum'] = (int)$rank[2];		//開獎號碼(3)
		$result['fourthNum'] = (int)$rank[3];	//開獎號碼(4)
		$result['fifthNum'] = (int)$rank[4];		//開獎號碼(5)
		$result['sixthNum'] = (int)$rank[5];		//開獎號碼(6)
		$result['drawCount'] = (int)$drawCount;  //已開期數
		$result['sumSingleDouble'] = ($rank[0]+$rank[1]+1)%2;	//(第(1)個數字+第(2)個數字+1)%2,0為單
		$result['fifthDT'] = $rank[4]>$rank[5] ? 0:1;	//第(5)個數字大於第(6)個為0,0為龍
		$result['firstDT'] = $rank[0]>$rank[9] ? 0:1;	//第(1)個數字大於第(10)個為0,0為龍
		$result['fourthDT'] = $rank[3]>$rank[6] ? 0:1;	//第(4)個數字大於第(7)個為0,0為龍
		$result['secondDT'] = $rank[1]>$rank[8] ? 0:1;	//第(2)個數字大於第(9)個為0,0為龍
		$result['sumBigSamll'] = ($rank[0]+$rank[1])>11 ? 0:1;	//(第(1)個數字+第(2)個數字)>2=0,0為大
		$result['sumFS'] = ($rank[0]+$rank[1]);	//冠軍和
		$result['thirdDT'] = $rank[2]>$rank[7] ? 0:1;	//第(3)個數字大於第(8)個為0,0為龍
		$result['eighthNum'] = (int)$rank[7];	//8
		$result['ninthNum'] = (int)$rank[8];	//9
		$result['seventhNum'] = (int)$rank[6];	//7
		$result['tenthNum'] = (int)$rank[9];	//10
		$result['serverTime'] = date('Y-m-d H:i:s');	//主機時間 date('Y-m-d H:i:s',strtotime('+7 seconds',strtotime(date('Y-m-d H:i:s'))));
		$result['frequency'] = '';		//沒用
		$result['totalCount'] = $Now['count_total'];		//總開獎期數 待補
		$result['lotCode'] = 10001;	//URL參數 10001 為正常
		$result['iconUrl'] = '';	//沒用
		$result['shelves'] = 0;	//沒用
		$result['groupCode'] = 1;	//沒用
		$result['lotName'] = $Now['lotName'];	//
		$result['index'] = 100;	//
		self::$result_array['result']['data'] = $result;
		return self::$result_array;
    }
    
    	/*
	** 將資料庫取的資料轉成特定格式(歷史資料) 適用票種 : BJPK
	** input : $HistoryList-歷史資料
	** output : Array - 加工過的資料陣列
	*/
	public function ResultIntodataHistory_TEN($HistoryList)
	{
		$returnList = array();
		foreach ($HistoryList as $key => $value) {
			$result = array();
			$rank=array();
			foreach (self::$ballarray as $key1 => $value1) {
				array_push($rank, sprintf("%02d", (int)$HistoryList[$key][$value1]));
			}
			$result['preDrawCode'] = implode(',',$rank);	//開獎號碼
			$result['groupCode'] = 1;						//分類預設彩票=1
			$result['preDrawTime'] = $HistoryList[$key]["datetime"];//開獎時間
			$result['preDrawIssue'] = floatval($HistoryList[$key]["qishu"]);	//開獎期數
			$result['sumSingleDouble'] =  ($rank[0]+$rank[1]+1)%2;	//(第(1)個數字+第(2)個數字+1)%2,0為單
			$result['fifthDT'] = $rank[4]>$rank[5] ? 0:1;	//第(5)個數字大於第(6)個為0,0為龍
			$result['firstDT'] = $rank[0]>$rank[9] ? 0:1;	//第(1)個數字大於第(10)個為0,0為龍
			$result['fourthDT'] = $rank[3]>$rank[6] ? 0:1;	//第(4)個數字大於第(7)個為0,0為龍
			$result['secondDT'] = $rank[1]>$rank[8] ? 0:1;	//第(2)個數字大於第(9)個為0,0為龍
			$result['sumBigSamll'] = ($rank[0]+$rank[1])>11 ? 0:1;	//(第(1)個數字+第(2)個數字)>2=0,0為大
			$result['sumFS'] = ($rank[0]+$rank[1]);	//冠軍和
			$result['thirdDT'] = $rank[2]>$rank[7] ? 0:1;	//第(3)個數字大於第(8)個為0,0為龍
			array_push($returnList,$result);
		}
		self::$result_array['result']['data'] = $returnList;
		return self::$result_array;
	}
}
