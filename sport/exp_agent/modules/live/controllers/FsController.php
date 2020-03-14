<?php

namespace app\modules\live\controllers;

use app\common\base\BaseController;
use app\common\data\Pagination;
use app\modules\live\models\LiveFsList;
use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;
use app\modules\live\util\FsUtil;

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
	
    public function actionIndex()
    {
        $start_order_time = $this->getParam('s_time', date('Y-m-d 00:00:00', strtotime("-1 day")));
        $end_order_time = $this->getParam('e_time', date('Y-m-d 23:59:59', strtotime("-1 day")));
        $game_type = $this->getParam('game_type','');
        $userstr = $this->getParam('user_str','');
        $fs_type = $this->getParam('fs_type','');
		$userstr=trim($userstr);
		
		if($fs_type===""){
			$fs_type=0;
		}
       	if ($game_type == "AG_BBIN") {
    		$gametype="AG_BBIN,BBIN";
    	} elseif ($game_type == "AG") {
    		$gametype="AG";
    	} elseif ($game_type == "AGIN") {
    		$gametype="AGIN,NYX,TTG,BG,XIN";
    	} elseif ($game_type == "AG_OG") {
    		$gametype="AG_OG";
    	} elseif ($game_type == "OG") {
            $gametype="OG";
        }  elseif ($game_type == "AG_MG") {
    		$gametype="NMG,MG,AG_MG";
    	} elseif ($game_type == "DS") {
    		$gametype="DS";
    	} elseif ($game_type == "KG") {
            $gametype="KG";
        } else{
            $gametype="AG";		// ALL 默认
            $game_type="AG";
    	}

		// 总记录条数
		$orderGbynameCount=LiveOrder::getSumGbyLivenameCount($userstr,$gametype,$start_order_time,$end_order_time,$fs_type);

		$pagination = new Pagination(['totalCount' => $orderGbynameCount,'pageSize'=>50]);
		
		$rs=LiveOrder::getSumGbyLivename($userstr,$gametype,$start_order_time,$end_order_time,$fs_type,$pagination->offset,$pagination->limit);
    	// 总记录统计
    	foreach ($rs as $key=>$value){
			$liveusername=$value["live_username"];

			$liveuser=LiveUser::getUserByNameHall($liveusername,$gametype);
			$rs[$key]["user_name"]=$liveuser['userList']['user_name'];
			$rs[$key]["fs_rate"] = $liveuser["fs_rate"];
			$rs[$key]["user_id"] = $liveuser["id"];
			$rs[$key]["fs_total_money"] = number_format(($value["valid_bet_amount"] / 100) * $liveuser["fs_rate"], 2, '.', '');
			$rs[$key]["fs_already_money"]=LiveFsList::getSumFsMoney($liveusername,$gametype,$start_order_time,$end_order_time);
    	}
        return $this->render('index', [
            'start_order_time'=>$start_order_time,
            'end_order_time'=>$end_order_time,
            'game_type'=>$game_type,
            'user_str'=>$userstr,
            'fs_type'=>$fs_type,
            'rs'=>$rs,
            'pagination' => $pagination,
        ]);
    }
        
    public function actionRecord()
    {
        $start_order_time = $this->getParam('s_time', date('Y-m-d 00:00:00'));
        $end_order_time = $this->getParam('e_time', date('Y-m-d H:i:s'));
    	$game_type = $this->getParam('game_type', '');
    	$userstr = trim($this->getParam('user_str', ''));

        if ($game_type == "AG_BBIN") {
    		$gametype="AG_BBIN,BBIN";
    	} elseif ($game_type == "AG") {
    		$gametype="AG";
    	} elseif ($game_type == "AGIN") {
    		$gametype="AGIN";
    	} elseif ($game_type == "AG_OG") {
    		$gametype="AG_OG";
    	} elseif ($game_type == "OG") {
            $gametype="OG";
        } elseif ($game_type == "AG_MG") {
    		$gametype="NMG,MG,AG_MG";
    	} elseif ($game_type == "DS") {
    		$gametype="DS";
    	} elseif ($game_type == "KG") {
            $gametype="KG";
        }else{
    		$gametype="";		// ALL
    		$game_type="ALL";
    	}

    	// 总记录条数
    	$fsCount=LiveFsList::getFsCount($userstr,$gametype,$start_order_time,$end_order_time);
    	
    	$pagination = new Pagination(['totalCount' => $fsCount,'pageSize'=>50]);
    	
    	$rs=LiveFsList::getFsRecord($userstr,$gametype,$start_order_time,$end_order_time,$pagination->offset,$pagination->limit);

    	return $this->render('record', [
            'start_order_time'=>$start_order_time,
            'end_order_time'=>$end_order_time,
            'game_type'=>$game_type,
            'user_str'=>$userstr,
            'rs'=>$rs,
            'pagination' => $pagination,
        ]);
    }
    
    public function actionSetFs()
    {
    	$id = $this->getParam('id');
    	$fsrate = $this->getParam('fsrate');
    	if (is_numeric($fsrate) && $fsrate < 100) {
    		$flag=LiveUser::updateLiveUserById($id,$fsrate);
    		echo $flag==true ? $fsrate : "设置反水失败";
    	} else {
    		echo "输入的反水比例不符合规定";
    	}
    }
    
    public function actionSetFsByGametype()
    {
    	$gametype = $this->getParam('gametype');
    	$fsrate = $this->getParam('fsrate');
    	if($gametype=="ALL"){
    		$gametype="";
    	}
    	if (is_numeric($fsrate) && $fsrate < 100) {
    		$flag=LiveUser::updateLiveUserByGametype($gametype,$fsrate);
    		echo $flag==true ? $fsrate : "设置反水失败";
    	} else {
    		echo "输入的反水比例不符合规定";
    	}
    }
    
    public function actionSetOneFs()
    {
        $game_type = $this->getParam("game_type", "");
        if ($game_type == "AG_BBIN") {
            $gametype="AG_BBIN,BBIN";
        } elseif ($game_type == "AG") {
            $gametype="AG";
        } elseif ($game_type == "AGIN") {
            $gametype="AGIN,NYX,TTG,BG,XIN";
        }  elseif ($game_type == "AG_OG") {
            $gametype="AG_OG";
        } elseif ($game_type == "OG") {
            $gametype="OG";
        } elseif ($game_type == "AG_MG") {
            $gametype="NMG,MG,AG_MG";
        } elseif ($game_type == "DS") {
            $gametype="DS";
        }else{
            $gametype="";
        }
    	$fsUtil = new FsUtil();
    	$flag = $fsUtil->SetFsMoney($this->getParam("liveuser", ""), $gametype, $this->getParam("s_time", ""), $this->getParam("e_time", ""));
    	if($flag){
    		return "1";
    	}else{
    		return "2";
    	}
    }
    
    public function actionSetAllFs()
    {
        $game_type = $this->getParam("game_type", "");
        if ($game_type == "AG_BBIN") {
            $gametype="AG_BBIN,BBIN";
        } elseif ($game_type == "AG") {
            $gametype="AG";
        } elseif ($game_type == "AGIN") {
            $gametype="AGIN,NYX,TTG,BG,XIN";
        }  elseif ($game_type == "AG_OG") {
            $gametype="AG_OG";
        } elseif ($game_type == "OG") {
            $gametype="OG";
        } elseif ($game_type == "AG_MG") {
            $gametype="NMG,MG,AG_MG";
        } elseif ($game_type == "DS") {
            $gametype="DS";
        }else{
            $gametype="";
        }
    	$liveusername = $this->getParam("liveuser", "");
    	$liveuserlist = explode(",", $liveusername);
    	$fsUtil = new FsUtil();
    	foreach ($liveuserlist as $key=>$value){
    		$fsUtil->SetFsMoney($value, $gametype, $this->getParam("s_time", ""), $this->getParam("e_time", ""));
    	}
    	return "1";
    }
}
