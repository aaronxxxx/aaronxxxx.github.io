<?php

namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\common\helpers\LogUtils;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveRpcConfig;
use app\modules\live\models\LiveUser;
use app\modules\live\models\UserList;
use app\modules\live\services\CjService;
use app\modules\live\services\KgService;
use app\modules\live\services\OgService;
use app\modules\live\util\LiveHallUtil;
use app\modules\live\util\LiveServiceUtil;
use Exception;
use Yii;
use yii\web\Cookie;

class OrderController extends BaseController
{

	public function init() {
		parent::init();
		$this->layout = false;
	}

    /**
     * 查看真人注单
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
		$userstr = $this->getParam('user_str', "");
		switch ($game_type)
		{
			case "AG_BBIN":
				$gametype="AG_BBIN,BBIN";
				break;
			case "AG_MG":
				$gametype="AG_MG,NMG";
				break;
			case "AG_OG":
				$gametype="AG_OG";
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
			default:
				$gametype="AG_BBIN,BBIN,AG_MG,NMG,AG_OG,OG,AG,AGIN,DS";
		}
		//获取总记录数及聚合信息
		$sumrs = LiveOrder::getLiveOrderCount($userstr,$gametype,$start_order_time,$end_order_time);
		$pagination = new Pagination(['totalCount' => $sumrs['count'],'pageSize'=>50]);
		$rs=LiveOrder::getLiveOrder($userstr,$gametype,$start_order_time,$end_order_time,$pagination->offset,$pagination->limit);
    	$arrGameTypes = $this->module->params['gametype'];
    	$arrPayTypes = $this->module->params['gamecode'];
    	$arrDsinfo = $this->module->params['dsinfo'];
        $ogcodes = $this->module->params['ogcode'];
    	// 总记录统计
    	foreach ($rs as $key=>$value){
            $user_name = '未知';
    		$live_username=$rs[$key]['live_username'];
    		$liveuser=LiveUser::findOne(['live_username'=>$live_username]);
            if(!empty($liveuser)) {
                $userone = $liveuser->userList;
                if(!empty($userone)) {
                    $user_name = $userone->attributes['user_name'];
                }
            }
    		$rs[$key]['user_name']=$user_name;
            if(!empty($arrGameTypes[$rs[$key]["live_type"]])) {
                $rs[$key]['live_type'] = $arrGameTypes[$rs[$key]["live_type"]];
            }
            if($rs[$key]["game_type"] == "AG_OG" || $rs[$key]["game_type"] == "OG" ) {
                if(!empty($rs[$key]["bet_info"]) && strlen($rs[$key]["bet_info"]) > 3) {
                    $code = substr($rs[$key]["bet_info"], 0, 3);
                    if(!empty($ogcodes[$code])) {
                        $rs[$key]['bet_info'] = $ogcodes[$code];
                    }
                }
            } elseif ($rs[$key]["game_type"] == "DS"){
                $dsArr = explode(',',$rs[$key]['bet_info']);
                $info = '';
                foreach ($dsArr as $k => $v){
                    $info .= $arrDsinfo[$v].',';
                }
                $rs[$key]['bet_info'] = rtrim($info, ",");
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

    /**
     * 更新注单接口
     */
    public function actionUpdateOrders()
    {
        try {
            system(Yii::getAlias("@webroot")."/public/live/ClientResume.exe");
            $this->out(true);
        } catch (Exception $e) {
            $this->out(false);
        }
    }

    /**
     * 真人实时金额-弹出框页面
     * @return string
     */
    public function actionMoney()
    {
        return $this->render('money', [
            'live_name' => $this->getParam('name', '')
        ]);
    }

    /**
     * 真人实时金额-列表页面
     * @return string
     */
    public function actionMoneyonly()
    {
        return $this->render('moneyonly');
    }

	public function actionBalance() {
        try {
            $num = $this->getParam('num');
            $name = $this->getParam('name');
            $rs = LiveRpcConfig::getLiveRpcConfig();
            $liveuser_pre = $rs["live_name_prefix"];
            $livearr = LiveHallUtil::getLiveHallArr();
            $liveType = $livearr[$num];
            $pwd = LiveUser::getLiveUserPwd($liveuser_pre.$name, $liveType);
            $rs=LiveRpcConfig::getLiveRpcConfig();
            $liveuser_pre=$rs["live_name_prefix"];  // 真人用户前缀
            $service=LiveServiceUtil::getAllLiveHallService();
            $dsService=$service["ds_srv"];
            $agService=$service["ag_srv"];
            if ($num == 4) {//ds
                $ret = $dsService->queryBalance ( $liveuser_pre.$name, $pwd );
            } else if($num == 7) {//og
                $client = new OgService($rs['og_rpc_domain']);
                $ret = $client->queryBalance($liveuser_pre.$name, $pwd);
                if(!$client->getStatus()) {
                    $ret = -1;
                }
            } else if($num == 8) {//kg
                $client = new KgService($rs['og_rpc_domain']);
                $ret = $client->queryBalance($liveuser_pre.$name);
                if(!$client->getStatus()) {
                    $ret = -1;
                }
            } else {
                $actype = 1;
                $userone = UserList::findOne(['user_name'=>$name]);
                $uid = $userone['user_id'];
                $query_params = LiveHallUtil::getQueryBalanceParamsByLiveType($uid, $liveType);
                $agentType = $query_params['cagent'];
                $ret = $agService->queryBalance ( $agentType, $actype, $liveuser_pre.$name, $pwd );
            }
            if (strpos ( $ret, '异常' ) !== false || strpos ( $ret, '失败' ) !== false) {
                $ret = -1;
            }
            if($ret >= 0) {
                // 更新真人帐号中的金额
                $liveuser = LiveUser::findOne ( [
                    'live_username' => $liveuser_pre.$name,
                    'live_type' => $liveType
                ] );
                if (!empty($liveuser)) {
                    $liveuser->live_money = $ret;
                    $liveuser->save ();
                }
            }
            return $this->outData([
                'name' => $liveuser_pre.$name,
                'balance' => $ret >=0 ? $ret : '数据同步中...'
            ]);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return $this->out(false, "查询失败");
        }
	}

	public function actionResetAgOrder() {
        $cookies = Yii::$app->request->cookies;
        if($cookies->has('time')){
            return $this->out(1, '操作太频繁，请稍后再试');
        }else{
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new Cookie([
                'name' => 'time',
                'value' => 1,
                'expire'=>time()+900    //15分钟有效期
            ]));
            $reset_type = $this->getParam('reset_time', 5);
            $client = new CjService();
            $client->resetAgLiveOrder($reset_type);
            return $this->out($client->getStatus(), $client->getStatus() ? '重置成功' : '已重置');
        }
    }
}
