<?php
namespace app\modules\live\controllers;

use app\modules\live\common\LiveUserUtil;
use app\common\base\BaseController;
use app\common\data\Pagination;
use app\common\helpers\LogUtils;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveRpcConfig;
use app\modules\live\models\LiveUser;
use app\modules\live\models\UserList;
use app\modules\live\services\AiService;
use app\modules\live\services\KgService;
use app\modules\live\services\PtService;
use app\modules\live\services\OgService;
use app\modules\live\services\VrService;
use app\modules\live\util\LiveHallUtil;
use app\modules\live\util\LiveServiceUtil;
use Exception;

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
				$gametype = "AG_BBIN,BBIN";
				break;
			case "AG_MG":
				$gametype = "AG_MG,NMG";
				break;
			case "AG_OG":
				$gametype = "AG_OG";
				break;
			case "AG":
				$gametype = "AG";
				break;
			case "AGIN":
				$gametype = "AGIN";
				break;
			case "DS":
				$gametype = "DS";
				break;
            case "OG":
                $gametype = "OG";
                break;
			case "VR":
                $gametype = "VR";
                break;
			default:
				$gametype = "AG_BBIN,BBIN,AG_MG,NMG,AG_OG,OG,AG,AGIN,DS,VR,AI";
        }

		//获取总记录数及聚合信息
		$sumrs = LiveOrder::getLiveOrderCount($userstr, $gametype, $start_order_time, $end_order_time);
		$pagination = new Pagination(['totalCount' => $sumrs['count'], 'pageSize'=>50]);
		$rs = LiveOrder::getLiveOrder($userstr, $gametype, $start_order_time, $end_order_time, $pagination->offset, $pagination->limit);
    	$arrGameTypes = $this->module->params['gametype'];
    	$arrPayTypes = $this->module->params['gamecode'];
        $ogcodes = $this->module->params['ogcode'];

    	// 总记录统计
    	foreach ($rs as $key => $value) {
            $user_name = '未知';
    		$live_username = $rs[$key]['live_username'];
            $liveuser = LiveUser::findOne(['live_username' => $live_username]);

            if (!empty($liveuser)) {
                $userone = $liveuser->userList;

                if (!empty($userone)) {
                    $user_name = $userone->attributes['user_name'];
                }
            }

            $rs[$key]['user_name'] = $user_name;

            if (!empty($arrGameTypes[$rs[$key]["live_type"]])) {
                $rs[$key]['live_type'] = $arrGameTypes[$rs[$key]["live_type"]];
            }

            if ($rs[$key]["game_type"] == "AG_OG" || $rs[$key]["game_type"] == "OG" ) {
                if (!empty($rs[$key]["bet_info"]) && strlen($rs[$key]["bet_info"]) > 2) {
                    $code = substr($rs[$key]["bet_info"], 0, 3);

                    if (!empty($ogcodes[$code])) {
                        $rs[$key]['bet_info'] = $ogcodes[$code];
                    }
                }
            } else {
                if (!empty($arrPayTypes[$rs[$key]["bet_info"]])) {
                    $rs[$key]['bet_info'] = $arrPayTypes[$rs[$key]["bet_info"]];
                }
            }

            if ($rs[$key]['game_type'] == 'AI') {
                $rs[$key]['live_type'] = $value['live_th'] . ' ' . $value['live_type'];
            }
        }

        return $this->render('index', [
            'start_order_time' => $start_order_time,
            'end_order_time' => $end_order_time,
            'game_type' => $game_type,
            'user_str' => $userstr,
            'rs' => $rs,
            'pagination' => $pagination,
            'total_bet_money' => $sumrs["bet_money"],
            'total_live_win' => $sumrs["live_win"],
            'total_valid_bet_amount' => $sumrs["valid_bet_amount"],
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

    public function actionBalance()
    {
        try {
            $num = $this->getParam('num');
            $name = $this->getParam('name');
            $rpc_config = LiveRpcConfig::getLiveRpcConfig();
            $liveuser_pre = $rpc_config["live_name_prefix"];
            $livearr = LiveHallUtil::getLiveHallArr();
            $liveType = $livearr[$num];
            $pwd = LiveUser::getLiveUserPwd($liveuser_pre.$name, $liveType);
            $service=LiveServiceUtil::getAllLiveHallService();
            $dsService=$service["ds_srv"];
            $agService=$service["ag_srv"];
            $userone = UserList::findOne(['user_name'=>$name]);

            switch ($num) {
                case 4: //ds
					$live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $ret = $dsService->queryBalance ( $live_config['name'], $pwd );
                    break;
                case 7: //og
                    $live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $client = new OgService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['og_server_class'], $rpc_config['rpc_client_name']);
                    $ret = $client->queryBalance($rpc_config['rpc_client_name'], $live_config['cagent'], 1, $live_config['name'], $live_config['pwd']);
                    break;
                case 8: //kg
                    $live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $client = new KgService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['kg_server_class']);
                    $ret = $client->queryBalance($rpc_config['rpc_client_name'], $live_config['name']);
                    break;
                case 9://pt
                    $live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $client = new PtService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['pt_server_class']);
                    $ret = $client->queryBalance($rpc_config['rpc_client_name'], $live_config['name']);
                    break;
                case 10: //vr
                    $live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $client = new VrService('http://'.$rpc_config['rpc_server_domain'].$rpc_config['vr_server_class'], $rpc_config['rpc_client_name']);
                    $ret = $client->queryBalance($rpc_config['rpc_client_name'], 1, $live_config['name']);
                    break;
                case 11: // ai
                    $live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $client = new AiService();
                    $agent = $client->agentLogin();

                    if (! $agent) {
                        $ret['status'] = false;
                        break;
                    }

                    $ret['data'] = $client->queryBalance($agent['token'], $live_config['ai_userid']);

                    if (is_numeric($ret['data']) && $ret['data'] >= 0) {
                        $ret['status'] = true;
                    }

                    break;
                default:
                    $actype = 1;
                    $live_config = LiveHallUtil::getQueryBalanceParamsByLiveType($userone['user_id'], $liveType);
                    $agentType = $live_config['cagent'];
                    $ret = $agService->queryBalance($agentType, $actype, $liveuser_pre.$name, $pwd );
                    break;
            }

            if ($ret['status'] == true) {
                $ret = $ret['data'];
            } else {
                $ret = -1;
            }

            if ($ret >= 0) {
                // 更新真人帐号中的金额
                $liveuser = LiveUser::findOne([
                    'live_username' => $live_config['name'],
                    'live_type' => $liveType
                ]);

                if (!empty($liveuser)) {
                    $liveuser->live_money = $ret;
                    $liveuser->save();
                }
            }

            return $this->outData([
                'name' => $live_config['name'],
                'balance' => $ret >= 0 ? $ret : '数据同步中...'
            ]);
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return $this->out(false, "查询失败");
        }
	}
}
