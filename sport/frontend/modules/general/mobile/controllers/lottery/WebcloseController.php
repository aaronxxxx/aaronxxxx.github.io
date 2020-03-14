<?php

namespace app\modules\general\mobile\controllers\lottery;

use YII;
use app\modules\lottery\models\ar\WebClose;
use app\modules\lottery\models\ar\OddsLottery;
use app\modules\lottery\models\ar\OddsLotteryNormal;

class WebcloseController extends \app\common\base\BaseController {
	public function init() {
		parent::init ();
        // $this->layout = false;
        $this->layout = 'lottery';
	}

	public function actionIndex($type = null, $s_time = null, $qishu_query = null) {
	    if(!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])){
            return '<script>alert("请先登录再进行操作"); window.location="/?r=mobile/disp/login";</script>';
        }
		if ($type == "fc3d") {
			$Lottery_set = WebClose::getWebClose('d3');
            $oddslists = $this->GetOddsListFc3d();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render ( 'fc3d',[
			    'oddslists' => $oddslists,
            ] );
		}
		else if ($type == 'bjkl8') {
			$Lottery_set = WebClose::getWebClose('kl8');
            $oddslists = $this->GetOddsListKl8();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
					'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('bjkl8',[
                'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'bjpk10') {
			$Lottery_set = WebClose::getWebClose('pk10');
            $oddslists = $this->GetOddsListBjpk10();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('bjpk10',[
			    'oddslists' => $oddslists,
            ]);
        } 
        else if ($type == 'orpk') {  //老PK拾
			$Lottery_set = WebClose::getWebClose('orpk');
            $oddslists = $this->GetOddsListOrpk();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('orpk',[
			    'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'cqkl10') {
			$Lottery_set = WebClose::getWebClose('cqsf');
            $oddslists = $this->GetOddsListCqsf();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('cqkl10',[
                'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'cqssc') {
			$Lottery_set = WebClose::getWebClose('cq');
            $oddslists = $this -> GetOddsListCq();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('cqssc',[
                'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'gd11x5') {
			$Lottery_set = WebClose::getWebClose('gd11');
            $oddslists = $this->GetOddsListGd11x5();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('gd11x5',[
			    'oddslists'=>$oddslists,
            ]);
		}
		else if ($type == 'gdkl10') {
			$Lottery_set = WebClose::getWebClose('gdsf');
            $oddslists = $this->GetOddsListGdsfc();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('gdkl10',[
			        'oddslists' => $oddslists,
			    ]);
		}
		else if ($type == 'gxsfc') {
			$Lottery_set = WebClose::getWebClose('gxsf');
            $oddslists = $this->GetOddsListGxsfc();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('gxsfc',[
			    'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'pl3') {
			$Lottery_set = WebClose::getWebClose('p3');
            $oddslists = $this->GetOddsListPl3();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('pl3',[
			    'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'shssl') {
			$Lottery_set = WebClose::getWebClose('t3');
            $oddslists = $this->GetOddsListShssl();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('shssl',[
			    'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'tjkl10') {
			$Lottery_set = WebClose::getWebClose('tjsf');
            $oddslists = $this->GetOddsListTjsfc();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('tjkl10',[
			    'oddslists' => $oddslists,
            ]);
		}
		else if ($type == 'tjssc') {
			$Lottery_set = WebClose::getWebClose('tj');
            $oddslists = $this->GetOddsListTjssc();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('tjssc',[
			    'oddslists' => $oddslists,
            ]);
        }		
        else if ($type == 'ts') {
			$Lottery_set = WebClose::getWebClose('ts');
            $oddslists = $this->GetOddsListTs();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			return $this->render('ts5',[
			    'oddslists' => $oddslists,
            ]);
        }
        else if ($type == 'ssrc') {
			$Lottery_set = WebClose::getWebClose('ssrc');
            $oddslists = $this->GetOddsListSsrc();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('ssrc',[
			    'oddslists' => $oddslists,
            ]);
        }
        else if ($type == 'mlaft') {
			$Lottery_set = WebClose::getWebClose('mlaft');
            $oddslists = $this->GetOddsListMlaft();
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
				]);
			}
			return $this->render('mlaft',[
			    'oddslists' => $oddslists,
            ]);
		}
        else if ($type == 'spsix') {
			$Lottery_set = WebClose::getWebClose('spsix');
			if($Lottery_set['close'] == 1){
				return $this->render ('lotteryclose',[
						'lotteryname'=>$Lottery_set['name'],
						]);
			}
			/*return $this->render('spsix',[
			    'oddslists' => $oddslists,
            ]);*/
        }
		else {
			echo "error!";exit();
		}
	}
    /**
     * 获得倍率 北京快乐8
     */
    public function GetOddsListKl8() {
        $lottery_type = '北京快乐8';
        $lottery_subtype=['选号','其他'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        $oddslist ['ball'] [1] [1] = $odds [0] ['h10'];
        $oddslist ['ball'] [2] [1] = $odds [0] ['h9'];
        $oddslist ['ball'] [3] [1] = $odds [0] ['h7'];
        $oddslist ['ball'] [3] [2] = $odds [0] ['h8'];
        $oddslist ['ball'] [4] [1] = $odds [0] ['h4'];
        $oddslist ['ball'] [4] [2] = $odds [0] ['h5'];
        $oddslist ['ball'] [4] [3] = $odds [0] ['h6'];
        $oddslist ['ball'] [5] [1] = $odds [0] ['h1'];
        $oddslist ['ball'] [5] [2] = $odds [0] ['h2'];
        $oddslist ['ball'] [5] [3] = $odds [0] ['h3'];
        $oddslist ['ball'] [6] [1] = $odds [1] ['h3'];
        $oddslist ['ball'] [6] [2] = $odds [1] ['h4'];
        $oddslist ['ball'] [6] [3] = $odds [1] ['h1'];
        $oddslist ['ball'] [6] [4] = $odds [1] ['h2'];
        $oddslist ['ball'] [6] [5] = $odds [1] ['h5'];
        $oddslist ['ball'] [7] [1] = $odds [1] ['h6'];
        $oddslist ['ball'] [7] [2] = $odds [1] ['h7'];
        $oddslist ['ball'] [7] [3] = $odds [1] ['h8'];
        $oddslist ['ball'] [8] [1] = $odds [1] ['h9'];
        $oddslist ['ball'] [8] [2] = $odds [1] ['h10'];
        $oddslist ['ball'] [8] [3] = $odds [1] ['h11'];
        return $oddslist;
    }
    /**
     * 获得倍率cqsf
     */
    public function GetOddsListCqsf() {
        $lottery_type = '重庆十分彩';
        $lottery_subtype=['正码和特别号','总和龙虎','方位中发白'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 10 ; $s ++) {
            for($i = 1; $i < 25; $i ++) {
                if($s==8){
                    $oddslist ['ball'] [$s+1] [$i] = $odds [16] ['h' . $i];
                }else{
                    $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . $i];
                }
            }
            $oddslist ['ball'] [$s+1] [25] = $odds [$s] ['h27'];
            $oddslist ['ball'] [$s+1] [26] = $odds [$s] ['h28'];
            $oddslist ['ball'] [$s+1] [27] = $odds [$s] ['h25'];
            $oddslist ['ball'] [$s+1] [28] = $odds [$s] ['h26'];
            if($s<8){
                $oddslist ['ball'] [$s+1] [29] = $odds [$s+8] ['h1'];
                $oddslist ['ball'] [$s+1] [30] = $odds [$s+8] ['h2'];
                $oddslist ['ball'] [$s+1] [31] = $odds [$s+8] ['h3'];
                $oddslist ['ball'] [$s+1] [32] = $odds [$s+8] ['h4'];
                $oddslist ['ball'] [$s+1] [33] = $odds [$s+8] ['h5'];
                $oddslist ['ball'] [$s+1] [34] = $odds [$s+8] ['h6'];
                $oddslist ['ball'] [$s+1] [35] = $odds [$s+8] ['h7'];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率北京pk拾
     */
    public function GetOddsListBjpk10() {
        $lottery_type = '北京PK拾';
        $lottery_subtype=['定位','冠亚军和-快速','主盘势'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 11 ; $s ++) {
            for($i = 1; $i < 22; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s+10] ['h' . $i];
            }
            if ($s < 10) {
                $oddslist ['ball'] [$s+1] [11] = $odds [$s] ['h1'];
                $oddslist ['ball'] [$s+1] [12] = $odds [$s] ['h2'];
                $oddslist ['ball'] [$s+1] [13] = $odds [$s] ['h3'];
                $oddslist ['ball'] [$s+1] [14] = $odds [$s] ['h4'];
                $oddslist ['ball'] [$s+1] [15] = $odds [$s] ['h5'];
                $oddslist ['ball'] [$s+1] [16] = $odds [$s] ['h6'];
            }
        }
        return $oddslist;
    }
     /**
     * 获得倍率老pk拾
     */
    public function GetOddsListOrpk() {
        $lottery_type = '老PK拾';
        $lottery_subtype=['定位','冠亚军和-快速','主盘势'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 11 ; $s ++) {
            for($i = 1; $i < 22; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s+10] ['h' . $i];
            }
            if ($s < 10) {
                $oddslist ['ball'] [$s+1] [11] = $odds [$s] ['h1'];
                $oddslist ['ball'] [$s+1] [12] = $odds [$s] ['h2'];
                $oddslist ['ball'] [$s+1] [13] = $odds [$s] ['h3'];
                $oddslist ['ball'] [$s+1] [14] = $odds [$s] ['h4'];
                $oddslist ['ball'] [$s+1] [15] = $odds [$s] ['h5'];
                $oddslist ['ball'] [$s+1] [16] = $odds [$s] ['h6'];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率极速赛车
     */
     public function GetOddsListSsrc() {
        $lottery_type = '极速赛车';
        $lottery_subtype=['定位','冠亚军和-快速','主盘势'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 11 ; $s ++) {
            for($i = 1; $i < 22; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s+10] ['h' . $i];
            }
            if ($s < 10) {
                $oddslist ['ball'] [$s+1] [11] = $odds [$s] ['h1'];
                $oddslist ['ball'] [$s+1] [12] = $odds [$s] ['h2'];
                $oddslist ['ball'] [$s+1] [13] = $odds [$s] ['h3'];
                $oddslist ['ball'] [$s+1] [14] = $odds [$s] ['h4'];
                $oddslist ['ball'] [$s+1] [15] = $odds [$s] ['h5'];
                $oddslist ['ball'] [$s+1] [16] = $odds [$s] ['h6'];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率幸运飞艇
     */
     public function GetOddsListMlaft() {
        $lottery_type = '幸运飞艇';
        $lottery_subtype=['定位','冠亚军和-快速','主盘势'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 11 ; $s ++) {
            for($i = 1; $i < 22; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s+10] ['h' . $i];
            }
            if ($s < 10) {
                $oddslist ['ball'] [$s+1] [11] = $odds [$s] ['h1'];
                $oddslist ['ball'] [$s+1] [12] = $odds [$s] ['h2'];
                $oddslist ['ball'] [$s+1] [13] = $odds [$s] ['h3'];
                $oddslist ['ball'] [$s+1] [14] = $odds [$s] ['h4'];
                $oddslist ['ball'] [$s+1] [15] = $odds [$s] ['h5'];
                $oddslist ['ball'] [$s+1] [16] = $odds [$s] ['h6'];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率cqssc
     */
    public function GetOddsListCq() {
        $lottery_type = '重庆时时彩';
        $lottery_subtype=['万定位','仟定位','佰定位','拾定位','个定位','总和龙虎和','豹子顺子(前三)','豹子顺子(中三)','豹子顺子(后三)','牛牛','两面'];
        $odds=OddsLotteryNormal::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 16; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . ($i - 1)];
            }
            if ($s < 6) {
                $ss = ($s+1) * 4;
                $oddslist ['ball'] [$s+1] [11] = $odds [10]['h' . ($ss - 4)];
                $oddslist ['ball'] [$s+1] [12] = $odds [10]['h' . ($ss - 3)];
                $oddslist ['ball'] [$s+1] [13] = $odds [10]['h' . ($ss - 2)];
                $oddslist ['ball'] [$s+1] [14] = $odds [10]['h' . ($ss - 1)];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率gxsfc
     */
    public function GetOddsListGxsfc() {
        $lottery_type = '广西十分彩';
        $lottery_subtype=['正码和特别号','总和龙虎和','顺子杂六'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 26; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . $i];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率fc3d
     */
    public function GetOddsListFc3d() {
        $lottery_type = '3D彩';
        $lottery_subtype=['佰定位','拾定位','个定位','总和龙虎和','3连','跨度','两面'];
        $odds=OddsLotteryNormal::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 11; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s] ['h' . ($i - 1)];
            }
            if ($s < 3) {
                $ss = ($s+1) * 4;
                $oddslist ['ball'] [$s+1] [11] = $odds [6] ['h' . ($ss - 4)];
                $oddslist ['ball'] [$s+1] [12] = $odds [6] ['h' . ($ss - 3)];
                $oddslist ['ball'] [$s+1] [13] = $odds [6] ['h' . ($ss - 2)];
                $oddslist ['ball'] [$s+1] [14] = $odds [6] ['h' . ($ss - 1)];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率gd11x5
     */
    public function GetOddsListGd11x5() {
        $lottery_type = '广东十一选五';
        $lottery_subtype=['正码和特别号','总和龙虎和','顺子杂六'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for ($i = 1; $i < 16; $i++)
            {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s] ['h' . $i];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率gdsfc
     */
    public function GetOddsListGdsfc() {
        $lottery_type = '广东十分彩';
        $lottery_subtype=['单面双码','总和龙虎','方位中发白'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 9 ; $s ++) {
            for($i = 1; $i < 25; $i ++) {
                if($s==8){
                    $oddslist ['ball'] [$s+1] [$i] = $odds [16] ['h' . $i];
                }else{
                    $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . $i];
                }
            }
            $oddslist ['ball'] [$s+1] [25] = $odds [$s] ['h27'];
            $oddslist ['ball'] [$s+1] [26] = $odds [$s] ['h28'];
            $oddslist ['ball'] [$s+1] [27] = $odds [$s] ['h25'];
            $oddslist ['ball'] [$s+1] [28] = $odds [$s] ['h26'];
            if($s!=8){
                $oddslist ['ball'] [$s+1] [29] = $odds [$s+8] ['h1'];
                $oddslist ['ball'] [$s+1] [30] = $odds [$s+8] ['h2'];
                $oddslist ['ball'] [$s+1] [31] = $odds [$s+8] ['h3'];
                $oddslist ['ball'] [$s+1] [32] = $odds [$s+8] ['h4'];
                $oddslist ['ball'] [$s+1] [33] = $odds [$s+8] ['h5'];
                $oddslist ['ball'] [$s+1] [34] = $odds [$s+8] ['h6'];
                $oddslist ['ball'] [$s+1] [35] = $odds [$s+8] ['h7'];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率pl3
     */
    public function GetOddsListPl3() {
        $lottery_type = '排列三';
        $lottery_subtype=['佰定位','拾定位','个定位','总和龙虎和','3连','跨度','两面'];
        $odds=OddsLotteryNormal::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 11; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds[$s] ['h' . ($i - 1)];
            }
            if ($s < 3) {
                $ss = ($s+1) * 4;
                $oddslist ['ball'] [$s+1] [11] = $odds [6] ['h' . ($ss - 4)];
                $oddslist ['ball'] [$s+1] [12] = $odds [6] ['h' . ($ss - 3)];
                $oddslist ['ball'] [$s+1] [13] = $odds [6] ['h' . ($ss - 2)];
                $oddslist ['ball'] [$s+1] [14] = $odds [6] ['h' . ($ss - 1)];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率shssl
     */
    public function GetOddsListShssl() {
        $lottery_type = '上海时时乐';
        $lottery_subtype=['佰定位','拾定位','个定位','总和龙虎和','3连','跨度','两面'];
        $odds=OddsLotteryNormal::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 11; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . ($i - 1)];
            }
            if ($s < 3) {
                $ss = ($s+1) * 4;
                $oddslist ['ball'] [$s+1] [11] = $odds [6]['h' . ($ss - 4)];
                $oddslist ['ball'] [$s+1] [12] = $odds [6]['h' . ($ss - 3)];
                $oddslist ['ball'] [$s+1] [13] = $odds [6]['h' . ($ss - 2)];
                $oddslist ['ball'] [$s+1] [14] = $odds [6]['h' . ($ss - 1)];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率tjsfc
     */
    public function GetOddsListTjsfc() {
        $lottery_type = '天津十分彩';
        $lottery_subtype=['正码和特别号','总和龙虎','方位中发白'];
        $odds=OddsLottery::getOdds($lottery_type, $lottery_subtype);
        // 设置赔率
        for($s = 0; $s < 9 ; $s ++) {
            for($i = 1; $i < 25; $i ++) {
                if($s==8){
                    $oddslist ['ball'] [$s+1] [$i] = $odds [16] ['h' . $i];
                }else{
                    $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . $i];
                }
            }
            $oddslist ['ball'] [$s+1] [25] = $odds [$s] ['h27'];
            $oddslist ['ball'] [$s+1] [26] = $odds [$s] ['h28'];
            $oddslist ['ball'] [$s+1] [27] = $odds [$s] ['h25'];
            $oddslist ['ball'] [$s+1] [28] = $odds [$s] ['h26'];
            if($s!=8){
                $oddslist ['ball'] [$s+1] [29] = $odds [$s+8] ['h1'];
                $oddslist ['ball'] [$s+1] [30] = $odds [$s+8] ['h2'];
                $oddslist ['ball'] [$s+1] [31] = $odds [$s+8] ['h3'];
                $oddslist ['ball'] [$s+1] [32] = $odds [$s+8] ['h4'];
                $oddslist ['ball'] [$s+1] [33] = $odds [$s+8] ['h5'];
                $oddslist ['ball'] [$s+1] [34] = $odds [$s+8] ['h6'];
                $oddslist ['ball'] [$s+1] [35] = $odds [$s+8] ['h7'];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率tjssc
     */
    public function GetOddsListTjssc() {
        $lottery_type = '极速时时彩';
        $lottery_subtype=['万定位','仟定位','佰定位','拾定位','个定位','总和龙虎和','豹子顺子(前三)','豹子顺子(中三)','豹子顺子(后三)','牛牛','两面'];
        $odds=OddsLotteryNormal::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 16; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . ($i - 1)];
            }
            if ($s < 6) {
                $ss = ($s+1) * 4;
                $oddslist ['ball'] [$s+1] [11] = $odds [10]['h' . ($ss - 4)];
                $oddslist ['ball'] [$s+1] [12] = $odds [10]['h' . ($ss - 3)];
                $oddslist ['ball'] [$s+1] [13] = $odds [10]['h' . ($ss - 2)];
                $oddslist ['ball'] [$s+1] [14] = $odds [10]['h' . ($ss - 1)];
            }
        }
        return $oddslist;
    }
    /**
     * 获得倍率tjssc
     */
     public function GetOddsListTs() {
        $lottery_type = '腾讯分分彩';
        $lottery_subtype=['万定位','仟定位','佰定位','拾定位','个定位','总和龙虎和','豹子顺子(前三)','豹子顺子(中三)','豹子顺子(后三)','牛牛','两面'];
        $odds=OddsLotteryNormal::getOdds($lottery_type, $lottery_subtype);
        $num = count ( $odds );
        // 设置赔率
        for($s = 0; $s < $num ; $s ++) {
            for($i = 1; $i < 16; $i ++) {
                $oddslist ['ball'] [$s+1] [$i] = $odds [$s] ['h' . ($i - 1)];
            }
            if ($s < 6) {
                $ss = ($s+1) * 4;
                $oddslist ['ball'] [$s+1] [11] = $odds [10]['h' . ($ss - 4)];
                $oddslist ['ball'] [$s+1] [12] = $odds [10]['h' . ($ss - 3)];
                $oddslist ['ball'] [$s+1] [13] = $odds [10]['h' . ($ss - 2)];
                $oddslist ['ball'] [$s+1] [14] = $odds [10]['h' . ($ss - 1)];
            }
        }
        return $oddslist;
    }
}
