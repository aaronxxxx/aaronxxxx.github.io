<?php
namespace app\modules\lottery\modules\lzgxsf\util;

class BallUtil {
	function gxsf_Auto($num, $type)
	{
		$zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4];
		if ($type == 1)
		{
			return $zh;
		}
		if ($type == 2)
		{
			if (55 <= $zh)
			{
				return '总和大';
			}
			if ($zh < 55)
			{
				return '总和小';
			}
		}
		if ($type == 3)
		{
			if (($zh % 2) == 0)
			{
				return '总和双';
			}
			else
			{
				return '总和单';
			}
		}
		if ($type == 4)
		{
			if ($num[4] < $num[0])
			{
				return '龙';
			}
			if ($num[0] < $num[4])
			{
				return '虎';
			}
			if ($num[0] == $num[4])
			{
				return '和';
			}
		}
		if ($type == 5)
		{
			$n1 = $num[0];
			$n2 = $num[1];
			$n3 = $num[2];
			if ((($n1 == 1) || ($n2 == 1) || ($n3 == 1)) && (($n1 == 21) || ($n2 == 21) || ($n3 == 21)))
			{
				if ($n1 == 1)
				{
					$n1 = 22;
				}
				if ($n2 == 1)
				{
					$n2 = 22;
				}
				if ($n3 == 1)
				{
					$n3 = 22;
				}
			}
			if (($n1 == $n2) && ($n2 == $n3))
			{
				return '豹子';
			}
			else
			{
				if (($n1 == $n2) || ($n1 == $n3) || ($n2 == $n3))
				{
					return '对子';
				}
				else
				{
					if ((($n1 == 22) || ($n2 == 22) || ($n3 == 22)) && (($n1 == 21) || ($n2 == 21) || ($n3 == 21)) && (($n1 == 2) || ($n2 == 2) || ($n3 == 2)))
					{
						return '顺子';
					}
					else
					{
						if (((abs($n1 - $n2) == 1) && (abs($n2 - $n3) == 1)) || ((abs($n1 - $n2) == 2) && (abs($n1 - $n3) == 1) && (abs($n2 - $n3) == 1)) || ((abs($n1 - $n2) == 1) && (abs($n1 - $n3) == 1)))
						{
							return '顺子';
						}
						else
						{
							if ((abs($n1 - $n2) == 1) || (abs($n1 - $n3) == 1) || (abs($n2 - $n3) == 1))
							{
								return '半顺';
							}
							else
							{
								return '杂六';
							}
						}
					}
				}
			}
		}
		if ($type == 6)
		{
			$n1 = $num[1];
			$n2 = $num[2];
			$n3 = $num[3];
			if ((($n1 == 1) || ($n2 == 1) || ($n3 == 1)) && (($n1 == 21) || ($n2 == 21) || ($n3 == 21)))
			{
				if ($n1 == 1)
				{
					$n1 = 22;
				}
				if ($n2 == 1)
				{
					$n2 = 22;
				}
				if ($n3 == 1)
				{
					$n3 = 22;
				}
			}
			if (($n1 == $n2) && ($n2 == $n3))
			{
				return '豹子';
			}
			else
			{
				if (($n1 == $n2) || ($n1 == $n3) || ($n2 == $n3))
				{
					return '对子';
				}
				else
				{
					if ((($n1 == 22) || ($n2 == 22) || ($n3 == 22)) && (($n1 == 21) || ($n2 == 21) || ($n3 == 21)) && (($n1 == 2) || ($n2 == 2) || ($n3 == 2)))
					{
						return '顺子';
					}
					else
					{
						if (((abs($n1 - $n2) == 1) && (abs($n2 - $n3) == 1)) || ((abs($n1 - $n2) == 2) && (abs($n1 - $n3) == 1) && (abs($n2 - $n3) == 1)) || ((abs($n1 - $n2) == 1) && (abs($n1 - $n3) == 1)))
						{
							return '顺子';
						}
						else
						{
							if ((abs($n1 - $n2) == 1) || (abs($n1 - $n3) == 1) || (abs($n2 - $n3) == 1))
							{
								return '半顺';
							}
							else
							{
								return '杂六';
							}
						}
					}
				}
			}
		}
		if ($type == 7)
		{
			$n1 = $num[2];
			$n2 = $num[3];
			$n3 = $num[4];
			if ((($n1 == 1) || ($n2 == 1) || ($n3 == 1)) && (($n1 == 21) || ($n2 == 21) || ($n3 == 21)))
			{
				if ($n1 == 1)
				{
					$n1 = 22;
				}
				if ($n2 == 1)
				{
					$n2 = 22;
				}
				if ($n3 == 1)
				{
					$n3 = 22;
				}
			}
			if (($n1 == $n2) && ($n2 == $n3))
			{
				return '豹子';
			}
			else
			{
				if (($n1 == $n2) || ($n1 == $n3) || ($n2 == $n3))
				{
					return '对子';
				}
				else
				{
					if ((($n1 == 22) || ($n2 == 22) || ($n3 == 22)) && (($n1 == 21) || ($n2 == 21) || ($n3 == 21)) && (($n1 == 2) || ($n2 == 2) || ($n3 == 2)))
					{
						return '顺子';
					}
					else
					{
						if (((abs($n1 - $n2) == 1) && (abs($n2 - $n3) == 1)) || ((abs($n1 - $n2) == 2) && (abs($n1 - $n3) == 1) && (abs($n2 - $n3) == 1)) || ((abs($n1 - $n2) == 1) && (abs($n1 - $n3) == 1)))
						{
							return '顺子';
						}
						else
						{
							if ((abs($n1 - $n2) == 1) || (abs($n1 - $n3) == 1) || (abs($n2 - $n3) == 1))
							{
								return '半顺';
							}
							else
							{
								return '杂六';
							}
						}
					}
				}
			}
		}
	}
	
	//读取第几球
	function getdid($type) {
		$r = '';
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
				$r = '总和龙虎和';
				break;
			case 7 :
				$r = '前三';
				break;
			case 8 :
				$r = '中三';
				break;
			case 9 :
				$r = '后三';
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
				$r = '21';
				break;
			case 22 :
				$r = '大';
				break;
			case 23 :
				$r = '小';
				break;
			case 24 :
				$r = '单';
				break;
			case 25 :
				$r = '双';
				break;
		}
		return $r;
	}
	//读取玩法
	function getwan6($type) {
		$r = '';
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
				$r = '龙';
				break;
			case 6 :
				$r = '虎';
				break;
			case 7 :
				$r = '和';
				break;
		}
		return $r;
	}
	//读取玩法
	function getwan789($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '豹子';
				break;
			case 2 :
				$r = '顺子';
				break;
			case 3 :
				$r = '对子';
				break;
	
			case 4 :
				$r = '半顺';
				break;
			case 5 :
				$r = '杂六';
				break;
		}
		return $r;
	}
	
	function BuLing($num)
	{
		if ($num < 10)
		{
			$num = '0' . $num;
		}
		return $num;
	}
}