<?php

namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;


/**
 * Default controller for the `live` module
 */
class ReportController extends BaseController
{
	/**
	 * 初始化处理方法
	 */
	public function init() {
		parent::init();
		$this->layout = false;
	}

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $start_order_time = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $end_order_time = $this->getParam('e_time', date('Y-m-d H:i:s'));
		$game_type = $this->getParam('game_type');
		$userstr = trim($this->getParam('user_str'));
		$date_month = $this->getParam('date_month');
		switch ($game_type)
		{
			case "AG_BBIN":
				$gametype="AG_BBIN,BBIN";
				break;
			case "AG_MG":
				$gametype="AG_MG,NMG";
				break;
			case "AG_OG":
				$gametype="AG_OG,OG";
				break;
			case "AG":
				$gametype="AG";
				break;
			case "AGIN":
				$gametype="AGIN";
				break;
			case "DS":
				$gametype="DS";
				break;
			case "OG":
				$gametype="OG";
				break;
		    	case "VR":
				$gametype="VR";
				break;
			case "KG":
				$gametype="KG";
				break;
			case "YOPLAY":
				$gametype="YOPLAY";
				break;
			default:
				$gametype="";
		}
		// 总记录条数
		$sumrs=LiveOrder::getLiveOrderCount($userstr,$gametype,$start_order_time,$end_order_time);

		$pagination = new Pagination(['totalCount' => $sumrs['count'],'pageSize'=>50]);

		$rs=LiveOrder::getLiveOrder($userstr,$gametype,$start_order_time,$end_order_time,$pagination->offset,$pagination->limit);

        $arrGameTypes = $this->module->params['gametype'];
        $arrPayTypes = $this->module->params['gamecode'];
    	// 总记录统计
    	foreach ($rs as $key=>$value){
    		$live_username=$rs[$key]['live_username'];
    		$liveuser=LiveUser::findOne(['live_username'=>$live_username]);
    		$userone = $liveuser->userList;
    		$user_name=$userone->attributes['user_name'];
    		$rs[$key]['user_name']=$user_name;
    		$rs[$key]['live_type']=empty($arrGameTypes[$rs[$key]["live_type"]]) ? $rs[$key]["live_type"] : $arrGameTypes[$rs[$key]["live_type"]];
    		$rs[$key]['bet_info']=empty($arrPayTypes[$rs[$key]["bet_info"]]) ? $rs[$key]["bet_info"] : $arrPayTypes[$rs[$key]["bet_info"]];
    		
    	}

        return $this->render('index', [
            'start_order_time'=>$start_order_time,
            'end_order_time'=>$end_order_time,
            'game_type'=>$game_type,
            'user_str'=>$userstr,
            'date_month'=>$date_month,
            'rs'=>$rs,
            'pagination' => $pagination,
            'total_bet_money'=>$sumrs["bet_money"],
            'total_live_win'=>$sumrs["live_win"],
            'total_valid_bet_amount'=>$sumrs["valid_bet_amount"],
        ]);
    }
}
