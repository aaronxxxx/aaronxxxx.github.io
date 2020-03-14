<?php

namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;

/**
 * 电子游艺
 * Class EgameController
 * @package app\modules\live\controllers
 */
class PeController extends BaseController
{
	/**
	 * 初始化处理方法
	 */
	public function init() {
		parent::init();
		$this->layout = false;
	}

    /**
     * 查看电子游艺注单
     * @param s_time 起始时间
     * @param e_time 结束时间
     * @param game_type 平台类型
     * @param user_str 用户名
     * @return [
     *      start_order_time 起始时间
     *      end_order_time 结束时间
     *      game_type 平台类型
     *      user_str 用户名
     *      rs 列表数据
     *      pagination 分页数据
     *      total_bet_money 下注总额
     *      total_live_win 赢取总额
     *      total_valid_bet_amount 有效投注总额
     * ]
     */
    public function actionIndex()
    {   
		$start_order_time = $this->getParam('s_time', date('Y-m-d 00:00:00'));
		$end_order_time = $this->getParam('e_time', date('Y-m-d H:i:s'));
		$game_type = $this->getParam('game_type', "");
		$userstr = trim($this->getParam('user_str', ""));
    	switch ($game_type)
		{
			case "Bb_Sport":
				$gametype="Bb_Sport";
				break;
            case "SBTA":
                $gametype="SBTA";
                break;
			default:
				$gametype="";
		}
		// 获取总记录数及聚合信息
		$sumrs=LiveOrder::getPEOrderCount($userstr,$gametype,$start_order_time,$end_order_time);
		$pagination = new Pagination(['totalCount' => $sumrs["count"],'pageSize'=>50]);
		$rs=LiveOrder::getPEOrder($userstr,$gametype,$start_order_time,$end_order_time,$pagination->offset,$pagination->limit);
        $arrGameTypes = $this->module->params['gametype'];
        $arrPayTypes = $this->module->params['gamecode'];
        $ogcodes = $this->module->params['ogcode'];
    	// 总记录统计
    	foreach ($rs as $key=>$value){
    		$live_username=$rs[$key]['live_username'];
    		$liveuser=LiveUser::findOne(['live_username'=>$live_username]);
            $user_name = '未知';
            if(!empty($liveuser)) {
                $userone = $liveuser->userList;
                if(!empty($userone)) {
                    $user_name=$userone->attributes['user_name'];
                }
            }
    		$rs[$key]['user_name']=$user_name;
            if(!empty($arrGameTypes[$rs[$key]["live_type"]])) {
                $rs[$key]['live_type'] = $arrGameTypes[$rs[$key]["live_type"]];
            }
            if($rs[$key]["game_type"] == "AG_OG" || $rs[$key]["game_type"] == "OG" ) {
                if(!empty($rs[$key]["bet_info"]) && strlen($rs[$key]["bet_info"]) > 2) {
                    $code = substr($rs[$key]["bet_info"], 0, 3);
                    if(!empty($ogcodes[$code])) {
                        $rs[$key]['bet_info'] = $ogcodes[$code];
                    }
                }
            } else {
                if(!empty($arrPayTypes[$rs[$key]["bet_info"]])) {
                    $rs[$key]['bet_info'] = $arrPayTypes[$rs[$key]["bet_info"]];
                }
            }
    	}
        return $this->render('index', [
            'start_order_time'=>$start_order_time,
            'end_order_time'=>$end_order_time,
            'game_type'=>$game_type,
            'user_str'=>$userstr,
            'rs'=>$rs,
            'pagination' => $pagination,
            'total_bet_money'=>$sumrs["bet_money"],
            'total_live_win'=>$sumrs["live_win"],
            'total_valid_bet_amount'=>$sumrs["valid_bet_amount"],
        ]);
    }

}
