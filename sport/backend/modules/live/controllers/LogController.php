<?php
namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\live\models\LiveLog;
use app\modules\live\models\MoneyLog;
use app\modules\live\models\UserList;

/**
 * Default controller for the `live` module
 */
class LogController extends BaseController
{
	/**
	 * 初始化处理方法
	 */
	public function init() {
		parent::init();
		$this->layout = false;
	}

	public function actionIndex()
	{
        $start_order_time = $this->getParam('s_time',date('Y-m-d 00:00:00'));
        $end_order_time = $this->getParam('e_time',date('Y-m-d H:i:s'));
        $game_type = $this->getParam('game_type', 'ALL');
        $userstr = trim($this->getParam('user_str',''));
        $status = $this->getParam('status','');

		$gametype="";
		if ($game_type == "ALL") {
			$gametype = "";
		}else{
			$gametype=$game_type;
		}

		if($status==""){
			$status="0,1,2,4";
		}

		// 总记录条数
		$livelogCount=LiveLog::getLiveLogCount($userstr,$gametype,$start_order_time,$end_order_time,$status);

		$pagination = new Pagination(['totalCount' => $livelogCount,'pageSize'=>50]);

		$rs=LiveLog::getLiveLogList($userstr,$gametype,$start_order_time,$end_order_time,$status,$pagination->offset,$pagination->limit);

		return $this->render('index', [
            'start_order_time'=>$start_order_time,
            'end_order_time'=>$end_order_time,
            'game_type'=>$game_type,
            'user_str'=>$userstr,
            'status'=>$status,
            'rs'=>$rs,
            'pagination' => $pagination,
        ]);
	}

	public function actionCheck($username)
	{
		$userrs=UserList::getUserByNname($username);
		$userid=$userrs["user_id"];
		// 总记录条数
		$countrs=MoneyLog::getMoneyLogCount($userid);

		$pagination = new Pagination(['totalCount' => $countrs['count'],'pageSize'=>50]);

		$rs=MoneyLog::getMoneyLogList($userid,$pagination->offset,$pagination->limit);

		return $this->render('check', [
            'username'=>$username,
            'rs'=>$rs,
            'pagination' => $pagination,
        ]);
	}

	public function actionDetail($username)
	{
		$userrs=UserList::getUserByNname($username);
		$userid=$userrs["user_id"];
		// 总记录条数
		$countrs=MoneyLog::getMoneyLogCount($userid);

		$pagination = new Pagination(['totalCount' => $countrs['count'],'pageSize'=>50]);

		$rs=MoneyLog::getMoneyLogList($userid,$pagination->offset,$pagination->limit);

		return $this->render('check', [
            'username'=>$username,
            'rs'=>$rs,
            'pagination' => $pagination,
        ]);
	}
}
