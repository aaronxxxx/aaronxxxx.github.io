<?php

namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\live\models\LiveUser;
use app\modules\live\models\UserList;

/**
 * Default controller for the `live` module
 */
class UserController extends BaseController
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
        $start_order_time = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $end_order_time = $this->getParam('e_time', date('Y-m-d H:i:s'));
		$gametype = $this->getParam('game_type', '');
		$userstr = trim($this->getParam('user_str', ''));

	    if ($gametype == "ALL") {
			$gametype = "AG,AGIN,DS,AG_BBIN,AG_MG,AG_OG,OG,KG";
		}
		
		// 总记录条数
		$liveuserCount=LiveUser::getLiveUserCount($userstr,$gametype,$start_order_time,$end_order_time);
	
		$pagination = new Pagination(['totalCount' => $liveuserCount,'pageSize'=>50]);

		// 总记录条数
		$rsList=LiveUser::getLiveUserList($userstr,$gametype,$start_order_time,$end_order_time,$pagination->offset,$pagination->limit);

		$pagination = new Pagination(['totalCount' => $liveuserCount,'pageSize'=>50]);

		return $this->render('index', [
            'start_order_time'=>$start_order_time,
            'end_order_time'=>$end_order_time,
            'game_type'=>$gametype,
            'user_str'=>$userstr,
            'rs'=>$rsList,
            'pagination' => $pagination,
        ]);
	}
	
	public function actionTransfer($uid,$hall)
	{
		$rsuser=UserList::getUserById($uid);
		$data=['rsuser'=>$rsuser,'hall'=>$hall];
		return $this->render('transfer',$data);
		
	}
}
