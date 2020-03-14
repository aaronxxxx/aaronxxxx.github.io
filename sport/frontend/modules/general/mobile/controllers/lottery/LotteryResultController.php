<?php

namespace app\modules\general\mobile\controllers\lottery;

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
use app\modules\core\common\models\SysConfig;
class LotteryResultController extends \app\common\base\BaseController {
	private $_assetUrl = '';
	public function init() {
		parent::init ();
		$this->layout = 'lottery';
	}
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
					'type_lottery' => 'fc3d',
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
					'type_lottery' => 'pl3',
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
					'type_lottery' => 'shssl',
					'rslist' => $rslist 
			] );
		} else if ($gtype == 'CQ') {
			$sysconfig=SysConfig::find()->select(['sport_show_row'])->asarray()->one()['sport_show_row'];
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultCq::getResultList ( $qishu_query, $query_time );
			if($sysconfig ==-1){
				return $this->render ( 'sub_result/b5', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '重庆时时彩',
					'type_lottery' => 'cqssc',
					'rslist' => $rslist 
				] );
			}else{
				return $this->render ( 'sub_result/cqssc', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '重庆时时彩',
					'rslist' => $rslist 
				] );
			}
		} else if ($gtype == 'TJ') {
			$sysconfig=SysConfig::find()->select(['sport_show_row'])->asarray()->one()['sport_show_row'];
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultTj::getResultList ( $qishu_query, $query_time );
			if($sysconfig ==-1){
				return $this->render ( 'sub_result/b5', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '极速时时彩',
					'type_lottery' => 'tjssc',
					'rslist' => $rslist 
				] );
			}
			else{
				return $this->render ( 'sub_result/tjssc', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '极速时时彩',
					'rslist' => $rslist 
				] );
			}
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
					'type_lottery' => 'ts5',
					'rslist' => $rslist 
				] );
		}  else if ($gtype == 'GDSF') {
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
			$sysconfig=SysConfig::find()->select(['sport_show_row'])->asarray()->one()['sport_show_row'];
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultBjpk::getResultList ( $qishu_query, $query_time );
			if($sysconfig ==-1){
				return $this->render ( 'sub_result/orignbjpk', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '北京PK拾',
					'rslist' => $rslist 
				] );
			}
			else{
				return $this->render ( 'sub_result/bjpk', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '北京PK拾',
					'rslist' => $rslist 
				] );
			}
			
		} else if ($gtype == 'SSRC') {
			$sysconfig=SysConfig::find()->select(['sport_show_row'])->asarray()->one()['sport_show_row'];
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultSsrc::getResultList ( $qishu_query, $query_time );
			if($sysconfig ==-1){
				return $this->render ( 'sub_result/ssrc-original', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '极速赛车',
					'rslist' => $rslist 
				] );
			}
			else{
				return $this->render ( 'sub_result/ssrc', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '极速赛车',
					'rslist' => $rslist 
					
				] );
			}
		}else if ($gtype == 'ORPK') {
			$sysconfig=SysConfig::find()->select(['sport_show_row'])->asarray()->one()['sport_show_row'];
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultOrpk::getResultList ( $qishu_query, $query_time );
			if($sysconfig ==-1){
				return $this->render ( 'sub_result/orpk-original', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '老PK拾',
					'rslist' => $rslist 
				] );
			}
			else{
				return $this->render ( 'sub_result/orpk', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '老PK拾',
					'rslist' => $rslist 
				] );
			}
			
		} 
		else if ($gtype == 'MLAFT') {
			$sysconfig=SysConfig::find()->select(['sport_show_row'])->asarray()->one()['sport_show_row'];
			if ($s_time == null) {
				$query_time = date ( "Y-m-d", time () );
			} else {
				$query_time = $s_time;
			}
			$rslist = LotteryResultMlaft::getResultList ( $qishu_query, $query_time );
			if($sysconfig ==-1){
				return $this->render ( 'sub_result/mlaft-original', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '幸运飞艇',
					'rslist' => $rslist 
				] );
			}
			else{
				return $this->render ( 'sub_result/mlaft', [
					'lotterytype' => $gtype,
					's_time' => $s_time,
					'qishu_query' => $qishu_query,
					'query_time' => $query_time,
					'lottery_name' => '幸运飞艇',
					'rslist' => $rslist 
					
				] );
			}
		}
		 else {
			echo "hello World";exit();
		}
	}
}
