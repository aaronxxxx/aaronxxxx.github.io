<?php

namespace app\modules\lottery\controllers;

use YII;

class RuleController extends \yii\web\Controller {
	
	private $_assetUrl = '';
	public function init() {
		parent::init ();
		$this->layout = 'rule';
	}
	/*
	 * 游戏规则
	 * */
	public function actionIndex($gtype = null) {
		if ($gtype == 'D3') {
			return $this->render ('fc3d');
		} else if ($gtype == 'P3') {
			return $this->render ('pl3');
		}else if ($gtype == 'T3') {
			return $this->render ('shssl');
		} else if ($gtype == 'CQ') {
			return $this->render ('cqssc');
		} else if ($gtype == 'TJ'){
			return $this->render ('tjssc');
		}else if ($gtype == 'GDSF') {
			return $this->render ('gdsf');
		} else if ($gtype == 'GXSF') {
			return $this->render ('gxsf');
		} else if ($gtype == 'TJSF') {
			return $this->render ('tjsf');
		} else if ($gtype == 'CQSF') {
			return $this->render ('cqsf');
		} else if ($gtype == 'GD11') {
			return $this->render ('gd11');
		} else if ($gtype == 'BJKN') {
			return $this->render ('bjkn');
		} else if ($gtype == 'BJPK') {
			return $this->render ('pk10');
		} else if ($gtype == 'ORPK') {
			return $this->render ('orpk');
		} else if ($gtype == 'SSRC') {
			return $this->render ('ssrc');
		} else if ($gtype == 'MLAFT') {
			return $this->render ('mlaft');
		} else if ($gtype == 'TS') {
			return $this->render ('ts');
		}
		else{
			return $this->render ('index');
		}
	}
}