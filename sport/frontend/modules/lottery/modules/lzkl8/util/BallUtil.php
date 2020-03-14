<?php

namespace app\modules\lottery\modules\lzkl8\util;

class BallUtil {
	/**
	 * 转化开奖结果，数字转化对应文字开奖结果
	 * 
	 * @param unknown $num        	
	 * @param unknown $type        	
	 * @return number string
	 */
	function Kl8_Auto_zh($num, $type) {
		$zh = $num [0] + $num [1] + $num [2] + $num [3] + $num [4] + $num [5] + $num [6] + $num [7] + $num [8] + $num [9] + $num [10] + $num [11] + $num [12] + $num [13] + $num [14] + $num [15] + $num [16] + $num [17] + $num [18] + $num [19];
		if ($type == 1) {
			return $zh;
		}
		if ($type == 2) {
			if (810 < $zh) {
				return '总和大';
			} else if ($zh < 810) {
				return '总和小';
			} else if ($zh == 810) {
				return '总和810';
			}
		}
		if ($type == 3) {
			if (($zh % 2) == 0) {
				return '总和双';
			} else {
				return '总和单';
			}
		}
		// 每个球 是40为界比大小，统计出40为界的球个数
		if ($type == 4) {
			$shang = 0;
			$xia = 0;
			for($i = 0; $i < 20; $i ++) {
				if ($num [$i] < 41) {
					$shang = $shang + 1;
				} else {
					$xia = $xia + 1;
				}
			}
			if ($xia < $shang) {
				return '上';
			} else if ($shang < $xia) {
				return '下';
			} else if ($shang == $xia) {
				return '中';
			}
		}
		
		// 每个球的是奇是偶，统计出球奇偶个数
		if ($type == 5) {
			$ji = 0;
			$ou = 0;
			for($i = 0; $i < 20; $i ++) {
				if (($num [$i] % 2) == 0) {
					$ou = $ou + 1;
				} else {
					$ji = $ji + 1;
				}
			}
			if ($ji < $ou) {
				return '偶';
			} else if ($ou < $ji) {
				return '奇';
			} else if ($ou == $ji) {
				return '和';
			}
		}
	}
	
	// 读取第几球
	function getdid($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '选一';
				break;
			case 2 :
				$r = '选二';
				break;
			case 3 :
				$r = '选三';
				break;
			case 4 :
				$r = '选四';
				break;
			case 5 :
				$r = '选五';
				break;
			case 6 :
				$r = '和值';
				break;
			case 7 :
				$r = '上中下';
				break;
			case 8 :
				$r = '奇和偶';
				break;
		}
		return $r;
	}
	// 读取玩法
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
				$r = '总和810';
				break;
		}
		return $r;
	}
	// 读取玩法
	function getwan7($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '上';
				break;
			case 2 :
				$r = '中';
				break;
			case 3 :
				$r = '下';
				break;
		}
		return $r;
	}
	// 读取玩法
	function getwan8($type) {
		$r = '';
		switch ($type) {
			case 1 :
				$r = '奇';
				break;
			case 2 :
				$r = '和';
				break;
			case 3 :
				$r = '偶';
				break;
		}
		return $r;
	}
	function Kl8_convert($name) {
		if ($name == 'SUM:OVER') {
			return '总和大';
		} else if ($name == 'SUM:UNDER') {
			return '总和小';
		} else if ($name == 'SUM:810') {
			return '总和810';
		} else if ($name == 'SUM:EVEN') {
			return '总和双';
		} else if ($name == 'SUM:ODD') {
			return '总和单';
		} else if ($name == 'TOP') {
			return '上';
		} else if ($name == 'MIDDLE') {
			return '中';
		} else if ($name == 'BOTTOM') {
			return '下';
		} else if ($name == 'EVEN') {
			return '偶';
		} else if ($name == 'ODD') {
			return '奇';
		} else if ($name == 'TIE') {
			return '和';
		}
	}
	function Kl8_Auto($num, $type) {
		$zh = $num [0] + $num [1] + $num [2] + $num [3] + $num [4] + $num [5] + $num [6] + $num [7] + $num [8] + $num [9] + $num [10] + $num [11] + $num [12] + $num [13] + $num [14] + $num [15] + $num [16] + $num [17] + $num [18] + $num [19];
		if ($type == 1) {
			return $zh;
		}
		if ($type == 2) {
			if (810 < $zh) {
				return 'SUM:OVER';
			} else if ($zh < 810) {
				return 'SUM:UNDER';
			} else if ($zh == 810) {
				return 'SUM:810';
			}
		}
		if ($type == 3) {
			if (($zh % 2) == 0) {
				return 'SUM:EVEN';
			} else {
				return 'SUM:ODD';
			}
		}
		if ($type == 4) {
			$shang = 0;
			$xia = 0;
			for($i = 0; $i < 20; $i ++) {
				if ($num [$i] < 41) {
					$shang = $shang + 1;
				} else {
					$xia = $xia + 1;
				}
			}
			if ($xia < $shang) {
				return 'TOP';
			} else if ($shang < $xia) {
				return 'BOTTOM';
			} else if ($shang == $xia) {
				return 'MIDDLE';
			}
		}
		if ($type == 5) {
			$ji = 0;
			$ou = 0;
			for($i = 0; $i < 20; $i ++) {
				if (($num [$i] % 2) == 0) {
					$ou = $ou + 1;
				} else {
					$ji = $ji + 1;
				}
			}
			if ($ji < $ou) {
				return 'EVEN';
			} else if ($ou < $ji) {
				return 'ODD';
			} else if ($ou == $ji) {
				return 'TIE';
			}
		}
		if ($type == 7) {
			if (($zh <= 695) && (210 <= $zh)) {
				return 'SUM:METAL';
			} else {
				if (($zh <= 763) && (696 <= $zh)) {
					return 'SUM:WOOD';
				} else {
					if (($zh <= 855) && (764 <= $zh)) {
						return 'SUM:WATER';
					} else {
						if (($zh <= 923) && (856 <= $zh)) {
							return 'SUM:FIRE';
						} else {
							if (($zh <= 1410) && (924 <= $zh)) {
								return 'SUM:EARTH';
							}
						}
					}
				}
			}
		}
	}
}