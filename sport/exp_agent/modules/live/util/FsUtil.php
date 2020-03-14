<?php

namespace app\modules\live\util;

use app\common\services\ServiceFactory;
use app\modules\live\models\LiveFsList;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;
use app\modules\live\models\MoneyLog;
use app\modules\live\models\UserList;

class FsUtil
{
	public function SetFsMoney($liveusername,$gametype,$start_order_time,$end_order_time)
	{
		// 有效投注金额
		$sumrs=LiveOrder::getSumOrderByLivename($liveusername,$gametype,$start_order_time,$end_order_time,$fs_type=0);
		$sum_valid_money = $sumrs["valid_bet_amount"];
		// 真人用户信息 反水倍率%
		$liveuser=LiveUser::getUserByNameHall($liveusername,$gametype);
		$fsrate=$liveuser["fs_rate"];
		$sum_fs_money = $sum_valid_money / 100 * $fsrate;
		$sum_fs_money = number_format($sum_fs_money, 2, '.', '');
		if($sum_fs_money==0){
			return false; // liveorder 中没有效投注金额
		}
		$userlist=$liveuser->userList;
		$money=$liveuser->userList["money"];
		$uid = $liveuser->userList['user_id'];
		$user_name = $liveuser->userList['user_name'];
		 
		$now=date("Y-m-d H:i:s");
		// 反水日志记录
		$live_fs_list=new LiveFsList();
		$live_fs_list->USERNAME_LIVE=$liveusername;
		$live_fs_list->USERNAME=$user_name;
		$live_fs_list->VALIDMONEY=$sum_valid_money;
		$live_fs_list->FSMONEY=$sum_fs_money;
		$live_fs_list->FS_RATE=$fsrate;
		$live_fs_list->ADDTIME=$now;
		$live_fs_list->FSTIME=$now;
		$live_fs_list->live_type=$gametype;
		 
		$live_fs_list->save();
		$id=$live_fs_list->attributes["id"];
		 
		//$reason = "对用户" . $user_name . "的账户金额增加了" . $sum_fs_money . ",理由:" . $gametype . "反水增加金额";   //  管理员工日志  manage_log
		$order = date("YmdHis") . $id . "_" . $user_name;
		$about="[".$gametype."自动反水]";
		// 用户账户余额变动记录日志
		$money_log=new MoneyLog();
		$money_log->user_id=$uid;
		$money_log->order_num=$order;
		$money_log->about=$about;
		$money_log->update_time=$now;
		$money_log->type="后台充值";
		$money_log->order_value=$sum_fs_money;
		$money_log->assets=$money;
		$money_log->balance=$money+$sum_fs_money;
		$money_log->save();
		// 更新用户账户余额
		$user=UserList::find()->where(['user_id'=>$uid])->one();
		$user->money=$money+$sum_fs_money;
		$user->save();
		// 用户金额充值变动记录
        $moneyService = ServiceFactory::get('finance', 'moneyService');
        $moneyService->saveMoney([
            'user_id' => $uid,
            'order_num' => $order,
            'order_value' => $sum_fs_money,
            'assets' => $money,
            'status' => '成功',
            'about' => $gametype . "反水-用于活动",
            'type' => "后台充值",
        ]);
		$countRow=LiveOrder::updateStatusByFs($liveusername,$gametype,$start_order_time,$end_order_time);
		 
		return true; // 反水成功
	}
}