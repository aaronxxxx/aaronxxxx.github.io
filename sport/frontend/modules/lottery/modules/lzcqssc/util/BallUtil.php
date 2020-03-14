<?php
namespace app\modules\lottery\modules\lzcqssc\util;

class BallUtil {
	function b5_niuniu($ball1, $ball2, $ball3, $ball4, $ball5)
	{
		$is_niu = 'false';
		$niu_ji = '';
		if ((($ball1 + $ball2 + $ball3) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball4 + $ball5) % 10;
		}
		else if ((($ball1 + $ball2 + $ball4) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball3 + $ball5) % 10;
		}
		else if ((($ball1 + $ball2 + $ball5) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball3 + $ball4) % 10;
		}
		else if ((($ball1 + $ball3 + $ball4) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball2 + $ball5) % 10;
		}
		else if ((($ball1 + $ball3 + $ball5) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball2 + $ball4) % 10;
		}
		else if ((($ball1 + $ball4 + $ball5) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball2 + $ball3) % 10;
		}
		else if ((($ball2 + $ball3 + $ball4) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball1 + $ball5) % 10;
		}
		else if ((($ball2 + $ball3 + $ball5) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball1 + $ball4) % 10;
		}
		else if ((($ball2 + $ball4 + $ball5) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball1 + $ball3) % 10;
		}
		else if ((($ball3 + $ball4 + $ball5) % 10) == 0)
		{
			$is_niu = 'true';
			$niu_ji = ($ball1 + $ball2) % 10;
		}
		if ($is_niu == 'true')
		{
			if ($niu_ji == '0')
			{
				$niu_ji = '牛';
			}
			return '牛' . $niu_ji;
		}
		else
		{
			return '无牛';
		}
	}
	
	function Ssc_Auto($num, $type)
	{
		$zh = $num[0] + $num[1] + $num[2] + $num[3] + $num[4];
		if ($type == 1)
		{
			return $zh;
		}
		if ($type == 2)
		{
			if (23 <= $zh)
			{
				return '总和大';
			}
			if ($zh <= 22)
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
			if ((($n1 == 0) || ($n2 == 0) || ($n3 == 0)) && (($n1 == 9) || ($n2 == 9) || ($n3 == 9)))
			{
				if ($n1 == 0)
				{
					$n1 = 10;
				}
				if ($n2 == 0)
				{
					$n2 = 10;
				}
				if ($n3 == 0)
				{
					$n3 = 10;
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
					if ((($n1 == 10) || ($n2 == 10) || ($n3 == 10)) && (($n1 == 9) || ($n2 == 9) || ($n3 == 9)) && (($n1 == 1) || ($n2 == 1) || ($n3 == 1)))
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
			if ((($n1 == 0) || ($n2 == 0) || ($n3 == 0)) && (($n1 == 9) || ($n2 == 9) || ($n3 == 9)))
			{
				if ($n1 == 0)
				{
					$n1 = 10;
				}
				if ($n2 == 0)
				{
					$n2 = 10;
				}
				if ($n3 == 0)
				{
					$n3 = 10;
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
					if ((($n1 == 10) || ($n2 == 10) || ($n3 == 10)) && (($n1 == 9) || ($n2 == 9) || ($n3 == 9)) && (($n1 == 1) || ($n2 == 1) || ($n3 == 1)))
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
			if ((($n1 == 0) || ($n2 == 0) || ($n3 == 0)) && (($n1 == 9) || ($n2 == 9) || ($n3 == 9)))
			{
				if ($n1 == 0)
				{
					$n1 = 10;
				}
				if ($n2 == 0)
				{
					$n2 = 10;
				}
				if ($n3 == 0)
				{
					$n3 = 10;
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
					if ((($n1 == 10) || ($n2 == 10) || ($n3 == 10)) && (($n1 == 9) || ($n2 == 9) || ($n3 == 9)) && (($n1 == 1) || ($n2 == 1) || ($n3 == 1)))
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
	
	function b5_niuds($value)
	{
		if (($value == '牛1') || ($value == '牛3') || ($value == '牛5') || ($value == '牛7') || ($value == '牛9'))
		{
			return '牛单';
		}
		else
		{
			if (($value == '牛2') || ($value == '牛4') || ($value == '牛6') || ($value == '牛8') || ($value == '牛牛'))
			{
				return '牛双';
			}
			else
			{
				return '无牛';
			}
		}
	}
	
	function b5_niudx($value)
	{
		if (($value == '牛1') || ($value == '牛2') || ($value == '牛3') || ($value == '牛4') || ($value == '牛5'))
		{
			return '牛小';
		}
		else
		{
			if (($value == '牛6') || ($value == '牛7') || ($value == '牛8') || ($value == '牛9') || ($value == '牛牛'))
			{
				return '牛大';
			}
			else
			{
				return '无牛';
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
			case 10 :
				$r = '牛牛';
				break;
		}
		return $r;
	}
	//读取玩法
	function getwan($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '0';
				break;
			case 2 :
				$r = '1';
				break;
			case 3 :
				$r = '2';
				break;
			case 4 :
				$r = '3';
				break;
			case 5 :
				$r = '4';
				break;
			case 6 :
				$r = '5';
				break;
			case 7 :
				$r = '6';
				break;
			case 8 :
				$r = '7';
				break;
			case 9 :
				$r = '8';
				break;
			case 10 :
				$r = '9';
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
	//读取玩法
	function getwan10($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '无牛';
				break;
			case 2 :
				$r = '牛1';
				break;
			case 3 :
				$r = '牛2';
				break;
			case 4 :
				$r = '牛3';
				break;
			case 5 :
				$r = '牛4';
				break;
			case 6 :
				$r = '牛5';
				break;
			case 7 :
				$r = '牛6';
				break;
			case 8 :
				$r = '牛7';
				break;
			case 9 :
				$r = '牛8';
				break;
			case 10 :
				$r = '牛9';
				break;
			case 11 :
				$r = '牛牛';
				break;
			case 12 :
				$r = '牛大';
				break;
			case 13 :
				$r = '牛小';
				break;
			case 14 :
				$r = '牛单';
				break;
			case 15 :
				$r = '牛双';
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