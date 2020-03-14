<?php

namespace app\modules\lottery\lotteryorder\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\general\sysmng\models\ar\SysConfig;
use app\modules\general\admin\models\ManageLog;
use app\modules\lottery\lotteryorder\model\OrderLottery;
use app\modules\live\models\UserList;
use app\common\services\ServiceFactory;
use app\modules\live\models\MoneyLog;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `live` module
 */
class FsController extends BaseController
{
	/**
	 * 初始化处理方法
	 */
	public function init() {
		parent::init();
		$this->layout = false;
	}
	public function actionIndex(){
        $time['s_time'] = $this->getParam('s_time', date("Y-m-d 00:00:00",strtotime("-1 day")));
        $time['e_time'] = $this->getParam('e_time', date("Y-m-d 23:59:59",strtotime("-1 day")));
        $rate = $this->getParam('rate','0');
        $time['rate'] = $rate;
        $time['js'] = $js = $this->getParam('js','0,1');    //0=未反水,1=以反水,0,1=全部
        $username = $this->getParam('username','');
        $status = ['in','o_sub.status',[1]];// 只輸出已結算的單
        $bid = array();
        if($username){
            $uid = OrderLottery::uid($username);
            $bid[0]=$uid;
        }else{
            $uids = OrderLottery::uids($status,$time['s_time'],$time['e_time']);
            foreach ($uids as $key =>$value){
                foreach ($value as $k=>$v){
                    $bid[$key] = $v;
                }
            }
        }
        $list = OrderLottery::FsByUser($bid,$time['s_time'],$time['e_time'],$status,$js);
        $pages = new Pagination(['totalCount' =>count($list->asArray()->all()), 'pageSize' => '20']);
        $lists = $list->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('lotteryuser',array(
            'username'=>$username,
            'lists' => $lists,
            'pages' => $pages,
            'time'=>$time,
            'rate'=>$rate,
        ));
    }
    public function actionSetAllFs(){
        $all_user_id = $this->getParam("all_user_id", "");
        $s_time = $this->getParam("s_time", "");
        $e_time = $this->getParam("e_time", "");
        $rate = $this->getParam("rate", "");
        $superpassword = $this->getParam("superpassword", "");
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '-1';
        }
        $user_list = explode(",", $all_user_id);
    	foreach ($user_list as $key=>$value){
    		$this->SetFsMoney($value, $rate, $s_time, $e_time);
        }
        $str ='对'.$all_user_id.'时间'.$s_time.'~'.$e_time.'进行反水,比率:'.$rate/1000;
        ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str,Yii::$app->getSession()->get('ssid'));
    	return "1";
    }

    public function SetFsMoney($liveusername,$rate,$start_order_time,$end_order_time)
	{
        $status = ['in','o_sub.status',[1]];// 只輸出已結算的單
		$list = OrderLottery::FsByUser($liveusername,$start_order_time,$end_order_time,$status,0)->asArray()->one(); //有效投注
        //return var_dump($list);
        $bet_money_total = $list["bet_money_total"]; //總未反水金額
		$fsrate=$rate;
		$sum_fs_money = $bet_money_total / 1000 * $fsrate;
		$sum_fs_money = number_format($sum_fs_money, 2, '.', '');
		if($sum_fs_money==0){
			return false; // liveorder 中没有效投注金额
        }
        $userList = UserList::find()->where('user_id=:liveusername',[':liveusername'=>$liveusername])->asArray()->one();
        //return var_dump($userList);
		$money=$userList["money"];
		$uid = $userList['user_id'];
		$user_name = $userList['user_name']; 
		$now=date("Y-m-d H:i:s");
        $gametype = "彩票";
		//$reason = "对用户" . $user_name . "的账户金额增加了" . $sum_fs_money . ",理由:" . $gametype . "反水增加金额";   //  管理员工日志  manage_log
		$order = date("YmdHis") . $uid . "_" . $user_name;
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
        
        $countRow=OrderLottery::updateStatusByFsAll($liveusername,$rate,$start_order_time,$end_order_time);
		return true; // 反水成功
	}

}
