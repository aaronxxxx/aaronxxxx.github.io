<?php

namespace app\modules\lottery\controllers;

use YII;
use app\modules\lottery\modules\lzfc3d\models\ar\LotteryResultD3;
use app\modules\lottery\modules\lzpl3\models\ar\LotteryResultP3;
use app\modules\lottery\modules\lzshssl\models\ar\LotteryResultT3;
use app\modules\lottery\modules\lzcqssc\models\ar\LotteryResultCq;
use app\modules\lottery\modules\lztjssc\models\ar\LotteryResultTj;
use app\modules\lottery\modules\lzts5\models\ar\LotteryResultTs;
use app\modules\lottery\modules\lzgdsf\models\ar\LotteryResultGdsf;
use app\modules\lottery\modules\lzgxsf\models\ar\LotteryResultGxsf;
use app\modules\lottery\modules\lztjsf\models\ar\LotteryResultTjsf;
use app\modules\lottery\modules\lzcqsf\models\ar\LotteryResultCqsf;
use app\modules\lottery\modules\lzgd11\models\ar\LotteryResultGd11;
use app\modules\lottery\modules\lzkl8\models\ar\LotteryResultBjkn;
use app\modules\lottery\modules\lzpk10\models\ar\LotteryResultBjpk;
use app\modules\lottery\modules\lzorpk\models\ar\LotteryResultOrpk;
use app\modules\lottery\modules\lzssrc\models\ar\LotteryResultSsrc;
use app\modules\lottery\modules\lzmlaft\models\ar\LotteryResultMlaft;
use app\modules\lottery\modules\lzcqssc\util\BallUtil; //CQ 開獎規則
error_reporting(0);
class LotteryResultController extends \yii\web\Controller {

	public function init() {
		parent::init ();
		$this->layout = 'lotteryresult';
	}
	/*
	 * 历史开奖
	 * param:彩票类型、时间、期号
	 * */
	public function actionIndex($gtype = null, $s_time = null, $qishu_query = null) {
		if ($gtype == "D3") {
			$query_time = date ( 'Y-m-d', strtotime ( '-6 day' ) ) . ' 00:00:00';
			$rslist = LotteryResultD3::getResultList ( $qishu_query, $query_time );
			$query_time = date ( "Y-m-d", time () );
			return $this->render ( 'sub_result/b3', [
					'lotterytype' => $gtype,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '3D彩',
					'rslist' => $rslist 
			] );
		} elseif ($gtype == "P3") {
			$query_time = date ( 'Y-m-d', strtotime ( '-6 day' ) ) . ' 00:00:00';
			$rslist = LotteryResultP3::getResultList ( $qishu_query, $query_time );
			$query_time = date ( "Y-m-d", time () );
			return $this->render ( 'sub_result/b3', [
					'lotterytype' => $gtype,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '排列三',
					'rslist' => $rslist 
			] );
		} elseif ($gtype == "T3") {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			
			$rslist = LotteryResultT3::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/b3', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '上海时时乐',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'CQ') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultCq::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/b5', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '重庆时时彩',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'TJ') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultTj::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/b5', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '极速时时彩',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'GDSF') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultGdsf::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/gdsf', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '广东十分彩',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'GXSF') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultGxsf::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/gxsf', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '广西十分彩',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'TJSF') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultTjsf::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/tjsf', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '天津十分彩',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'CQSF') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultCqsf::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/cqsf', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '重庆十分彩',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'GD11') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultGd11::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/gd11', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '广东11选5',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'BJKN') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultBjkn::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/bjkn', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '北京快乐8',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'BJPK') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultBjpk::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/bjpk', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '北京PK拾',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'ORPK') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultOrpk::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/orpk', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '老PK拾',
					'rslist' => $rslist 
			] );
		}  else if ($gtype == 'SSRC') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultSsrc::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/ssrc', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '极速赛车',
					'rslist' => $rslist 
			] );
		}  else if ($gtype == 'MLAFT') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultMlaft::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/mlaft', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '幸运飞艇',
					'rslist' => $rslist 
			] );
		}  else if ($gtype == 'TS') {
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultTs::getResultList ( $qishu_query, $query_time );
			return $this->render ( 'sub_result/b5', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '腾讯分分彩',
					'rslist' => $rslist 
			] );
		}
		else {
			echo "hello World";exit();
		}
	}


}
