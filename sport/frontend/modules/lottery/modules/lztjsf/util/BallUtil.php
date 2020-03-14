<?php
namespace app\modules\lottery\modules\lztjsf\util;

class BallUtil {
	// 开奖结果 补0
	function BuLing($num) {
		if ($num < 10) {
			$num = '0' . $num;
		}
		return $num;
	}
	
	/*
	 * 计算总和大小，单双，龙虎和
	*/
	function G10_Auto($num, $type) {
		$zh = $num [0] + $num [1] + $num [2] + $num [3] + $num [4] + $num [5] + $num [6] + $num [7];
		if ($type == 1) {
			return $zh;
		}
		if ($type == 2) {
			if ((85 <= $zh) && ($zh <= 132)) {
				return '总和大';
			}
			if ((36 <= $zh) && ($zh <= 83)) {
				return '总和小';
			}
			if ($zh == 84) {
				return '和';
			}
		}
		if ($type == 3) {
			if (($zh % 2) == 0) {
				return '总和双';
			} else {
				return '总和单';
			}
		}
		if ($type == 4) {
			$zhws = substr ( $zh, strlen ( $zh ) - 1 );
			if (5 <= $zhws) {
				return '总和尾大';
			} else {
				return '总和尾小';
			}
		}
		if ($type == 5) {
			if ($num [7] < $num [0]) {
				return '龙';
			} else {
				return '虎';
			}
		}
	}
	
	// 读取第几球
	function getdid($type) {
		switch ($type) {
			case 1 :
				$r = '第一球';
				break;
			case 2 :
				$r = '第二球';
				break;
			case 3 :
				$r = '第三球';
				break;
			case 4 :
				$r = '第四球';
				break;
			case 5 :
				$r = '第五球';
				break;
			case 6 :
				$r = '第六球';
				break;
			case 7 :
				$r = '第七球';
				break;
			case 8 :
				$r = '第八球';
				break;
			case 9 :
				$r = '总和龙虎';
				break;
		}
		return $r;
	}
	// 读取玩法
	function getwan($type) {
		switch ($type) {
			case 1 :
				$r = '1';
				break;
			case 2 :
				$r = '2';
				break;
			case 3 :
				$r = '3';
				break;
			case 4 :
				$r = '4';
				break;
			case 5 :
				$r = '5';
				break;
			case 6 :
				$r = '6';
				break;
			case 7 :
				$r = '7';
				break;
			case 8 :
				$r = '8';
				break;
			case 9 :
				$r = '9';
				break;
			case 10 :
				$r = '10';
				break;
			case 11 :
				$r = '11';
				break;
			case 12 :
				$r = '12';
				break;
			case 13 :
				$r = '13';
				break;
			case 14 :
				$r = '14';
				break;
			case 15 :
				$r = '15';
				break;
			case 16 :
				$r = '16';
				break;
			case 17 :
				$r = '17';
				break;
			case 18 :
				$r = '18';
				break;
			case 19 :
				$r = '19';
				break;
			case 20 :
				$r = '20';
				break;
			case 21 :
				$r = '大';
				break;
			case 22 :
				$r = '小';
				break;
			case 23 :
				$r = '单';
				break;
			case 24 :
				$r = '双';
				break;
			case 25 :
				$r = '尾大';
				break;
			case 26 :
				$r = '尾小';
				break;
			case 27 :
				$r = '合数单';
				break;
			case 28 :
				$r = '合数双';
				break;
			case 29 :
				$r = '东';
				break;
			case 30 :
				$r = '南';
				break;
			case 31 :
				$r = '西';
				break;
			case 32 :
				$r = '北';
				break;
			case 33 :
				$r = '中';
				break;
			case 34 :
				$r = '发';
				break;
			case 35 :
				$r = '白';
				break;
		}
		return $r;
	}
	// 读取玩法
	function getwan9($type) {
		switch ($type) {
			case 1 :
				$r = '总和大';
				break;
			case 2 :
				$r = '总和小';
				break;
			case 3 :
				$r = '总和单';
				break;
			case 4 :
				$r = '总和双';
				break;
			case 5 :
				$r = '总和尾大';
				break;
			case 6 :
				$r = '总和尾小';
				break;
			case 7 :
				$r = '龙';
				break;
			case 8 :
				$r = '虎';
				break;
		}
		return $r;
	}
}