<?php
namespace app\modules\lottery\modules\lzmlaft\util;

class BallUtil {
	function getDX($num, $type)
	{
		
	}
	function getDS($num, $type)
	{
	
	}
	/**
	 * 转化开奖结果，数字转化对应文字开奖结果
	 * @param unknown $num
	 * @param unknown $type
	 * @return number|string
	 */
	function Pk10_Auto_quick($num, $type)
	{
		$zh = $num[0] + $num[1];
		if ($type == 1)
		{
			return $zh;
		}
		if ($type == 2)
		{
			if ($zh == 11)
			{
				return '和';
			}
			if (11 < $zh)
			{
				return '大';
			}
			else
			{
				return '小';
			}
		}
		if ($type == 3)
		{
			if ($zh == 11)
			{
				return '和';
			}
			if (($zh % 2) == 0)
			{
				return '双';
			}
			else
			{
				return '单';
			}
		}
		if ($type == 4)
		{
			if ($num[9] < $num[0])
			{
				return '龙';
			}
			else
			{
				return '虎';
			}
		}
		if ($type == 5)
		{
			if ($num[8] < $num[1])
			{
				return '龙';
			}
			else
			{
				return '虎';
			}
		}
		if ($type == 6)
		{
			if ($num[7] < $num[2])
			{
				return '龙';
			}
			else
			{
				return '虎';
			}
		}
		if ($type == 7)
		{
			if ($num[6] < $num[3])
			{
				return '龙';
			}
			else
			{
				return '虎';
			}
		}
		if ($type == 8)
		{
			if ($num[5] < $num[4])
			{
				return '龙';
			}
			else
			{
				return '虎';
			}
		}
	}
	
	function BuLing($num)
	{
		if ($num < 10)
		{
			$num = '0' . $num;
		}
		return $num;
	}
	
	//读取第几球
	function getdid($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '冠军';
				break;
			case 2 :
				$r = '亚军';
				break;
			case 3 :
				$r = '第三名';
				break;
			case 4 :
				$r = '第四名';
				break;
			case 5 :
				$r = '第五名';
				break;
			case 6 :
				$r = '第六名';
				break;
			case 7 :
				$r = '第七名';
				break;
			case 8 :
				$r = '第八名';
				break;
			case 9 :
				$r = '第九名';
				break;
			case 10 :
				$r = '第十名';
				break;
			case 11 :
				$r = '冠亚军和';
				break;
		}
		return $r;
	}
	//读取玩法
	function getwan($type) {
		$r = '';
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
				$r = '大';
				break;
			case 12 :
				$r = '小';
				break;
			case 13 :
				$r = '单';
				break;
			case 14 :
				$r = '双';
				break;
			case 15 :
				$r = '龙';
				break;
			case 16 :
				$r = '虎';
				break;
		}
		return $r;
	}
	//读取玩法
	function getwan9($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '3';
				break;
			case 2 :
				$r = '4';
				break;
			case 3 :
				$r = '5';
				break;
			case 4 :
				$r = '6';
				break;
			case 5 :
				$r = '7';
				break;
			case 6 :
				$r = '8';
				break;
			case 7 :
				$r = '9';
				break;
			case 8 :
				$r = '10';
				break;
			case 9 :
				$r = '11';
				break;
			case 10 :
				$r = '12';
				break;
			case 11 :
				$r = '13';
				break;
			case 12 :
				$r = '14';
				break;
			case 13 :
				$r = '15';
				break;
			case 14 :
				$r = '16';
				break;
			case 15 :
				$r = '17';
				break;
			case 16 :
				$r = '18';
				break;
			case 17 :
				$r = '19';
				break;
			case 18 :
				$r = '大';
				break;
			case 19 :
				$r = '小';
				break;
			case 20 :
				$r = '单';
				break;
			case 21 :
				$r = '双';
				break;
		}
		return $r;
	}
	
	//读取生成图片的玩法
	function getimgwanfa($qiuone,$qiusecond) {
		if ($qiuone == 11) {
			switch ($qiusecond) {
				case '1': $wanfa = '3';break;
				case '2': $wanfa = '4';break;
				case '3': $wanfa = '5';break;
				case '4': $wanfa = '6';break;
				case '5': $wanfa = '7';break;
				case '6': $wanfa = '8';break;
				case '7': $wanfa = '9';break;
				case '8': $wanfa = '10';break;
				case '9': $wanfa = '11';break;
				case '10': $wanfa = '12';break;
				case '11': $wanfa = '13';break;
				case '12': $wanfa = '14';break;
				case '13': $wanfa = '15';break;
				case '14': $wanfa = '16';break;
				case '15': $wanfa = '17';break;
				case '16': $wanfa = '18';break;
				case '17': $wanfa = '19';break;
				case '18': $wanfa = '大';break;
				case '19': $wanfa = '小';break;
				case '20': $wanfa = '单';break;
				case '21': $wanfa = '双';break;
			}
		}
		else {
			switch ($qiusecond) {
				case '1': $wanfa = '1';break;
				case '2': $wanfa = '2';break;
				case '3': $wanfa = '3';break;
				case '4': $wanfa = '4';break;
				case '5': $wanfa = '5';break;
				case '6': $wanfa = '6';break;
				case '7': $wanfa = '7';break;
				case '8': $wanfa = '8';break;
				case '9': $wanfa = '9';break;
				case '10': $wanfa = '10';break;
				case '11': $wanfa = '大';break;
				case '12': $wanfa = '小';break;
				case '13': $wanfa = '单';break;
				case '14': $wanfa = '双';break;
				case '15': $wanfa = '龙';break;
				case '16': $wanfa = '虎';break;
			}
		}
	}
}