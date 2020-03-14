<?php

namespace app\modules\live\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * LiveOrder is the model behind the live_user.
 */
class LiveOrder extends ActiveRecord {

    public static function getLiveOrderCount($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null){

        $eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
		
		$query=(new Query())->select('COUNT(*) as count,sum(bet_money) as bet_money,sum(valid_bet_amount) as valid_bet_amount,sum(live_win) as live_win')
		->from('live_order')->where(['not in', 'live_type', $eGames])
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}
	
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
	
		$query->orderBy(['order_time' => SORT_DESC]);
		$rs=$query->one();
		
		return $rs;

	}

	
	
	public static function getLiveOrderSum($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null){

        $eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
	
		$query=(new Query())->select("sum(bet_money) as bm ,sum(valid_bet_amount) as vm ,sum(live_win) as lm")
		->from('live_order')->where(['not in', 'live_type', $eGames])
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}
	
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
	
		$query->orderBy(['order_time' => SORT_DESC]);
		$rs=$query->one();
	
		return $rs["count"];

	}
	
	public static function getLiveOrder($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null,$pageoffset,$pagelimit){
		$eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
		$query=static ::find()->where(['not in', 'live_type', $eGames])
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);

		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();

			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}

			$query->andWhere(['in','live_username',$userarr]);
		}
		
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
		
		$query->orderBy(['order_time' => SORT_DESC]);
		$query->limit($pagelimit)->offset($pageoffset);

		$rs=$query->asArray()->all();
		return $rs;

	}
	
	
	public static function getEgameOrderCount($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null){

        $eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
	
		$query=(new Query())->select('COUNT(*) as count,sum(bet_money) as bet_money,sum(valid_bet_amount) as valid_bet_amount,sum(live_win) as live_win')
		->from('live_order')->where(['in', 'live_type', $eGames])
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}
	
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
	
		$query->orderBy(['order_time' => SORT_DESC]);
		$rs=$query->one();
	
		return $rs;

	}
	
	public static function getEgameOrderSum($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null){

        $eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
	
		$query=(new Query())->select("sum(bet_money) as bm ,sum(valid_bet_amount) as vm ,sum(live_win) as lm")
		->from('live_order')->where(['in', 'live_type', $eGames])
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}
	
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
	
		$query->orderBy(['order_time' => SORT_DESC]);
		$rs=$query->one();
	
		return $rs["count"];

	}
	
	public static function getEgameOrder($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null,$pageoffset,$pagelimit){
        $eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
		$query=static ::find()->where(['in', 'live_type', $eGames])
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}
	
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
	
		$query->orderBy(['order_time' => SORT_DESC]);
		$query->limit($pagelimit)->offset($pageoffset);
	
		$rs=$query->asArray()->all();
		return $rs;
	}
	
	
	public static function getLiveOrderQuery($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null){


        $eGames = array_values(Yii::$app->getModule('live')->params['egametype']);
		$eGamesStr=implode("','",$eGames);

		$sql="select * from live_order where live_type not in ('".$eGamesStr."') and order_time BETWEEN '".$start_order_time."' and '".$end_order_time."'";


		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
		
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}

			$userstr=implode("','",$userarr);
			$sql.=" and live_username in ('".$userstr."')";
			
		}
		if($gametype!=null||$gametype!=""){
			$sql.=" and game_type in ('".$gametype."')";
		}
		$sql.=" order by order_time desc";

		$command = Yii::$app->db->createCommand($sql);
		$rs = $command->queryAll();
		return $rs;
	}
	
	public static function getSumGbyLivename($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null,$status=null,$pageoffset,$pagelimit){

		$query=LiveOrder::find()->select('COUNT(*) as count,live_username,sum(bet_money) as bet_money,sum(valid_bet_amount) as valid_bet_amount,sum(live_win) as live_win,game_type')
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}

		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
		
		if($status!==""){
			if($status==1){
				$query->andwhere(['live_status'=>$status]);
			}else{
				$query->andwhere(['or','live_status=0','live_status is null']);
			}
		}

        $query->groupBy('live_username');
		$query->orderBy(['valid_bet_amount' => SORT_DESC]);
		$query->offset($pageoffset)->limit($pagelimit);
	
		$rs=$query->asArray()->all();
		return $rs;
	}
	
	public static function getSumGbyLivenameCount($userstr=null,$gametype=null,$start_order_time=null,$end_order_time=null,$status=null){

		$query=LiveOrder::find()->select('COUNT(*) as count,sum(bet_money) as bet_money,sum(valid_bet_amount) as valid_bet_amount,sum(live_win) as live_win')
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);
			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
	
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$userarr[]=$liveusers[$key]->attributes['live_username'];
			}
	
			$query->andWhere(['in','live_username',$userarr]);
		}
	
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
		if($status!==""){
			if($status==1){
				$query->andwhere(['live_status'=>$status]);
			}else{
				$query->andwhere(['or','live_status=0','live_status is null']);
			}
		}
		
		$query->groupBy('live_username');
		$query->orderBy(['valid_bet_amount' => SORT_DESC]);
	
		$subQuery=LiveOrder::find()->select('count(*) as count')->from(['temp' => $query]);
		$rs=$subQuery->asArray()->one();
		return $rs["count"];
	}
	
	public static function getSumOrderByLivename($liveusername=null,$gametype=null,$start_order_time=null,$end_order_time=null,$status=null){


		$query=LiveOrder::find()->select('COUNT(*) as count,live_username,sum(bet_money) as bet_money,sum(valid_bet_amount) as valid_bet_amount,sum(live_win) as live_win')
		->andWhere(['between', 'order_time', $start_order_time, $end_order_time]);
	
		if($liveusername!=null||$liveusername!=""){
			$query->andWhere(['live_username'=>$liveusername]);
		}

		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['game_type'=>$gametypearr]);
		}
		
		if($status!==""){
			if($status==1){
				$query->andwhere(['live_status'=>$status]);
			}else{
				$query->andwhere(['or','live_status=0','live_status is null']);
			}
		}
		
		$query->groupBy('live_username');
		$query->orderBy(['valid_bet_amount' => SORT_DESC]);

		$rs=$query->asArray()->one();
		return $rs;
	}
	
	public static function updateStatusByFs($liveusername=null,$gametype=null,$start_order_time=null,$end_order_time=null){
        $gametype = explode(",", $gametype);
		if($liveusername!=null||$liveusername!=""){
			$countRow = LiveOrder::updateAll(['live_status'=>1],['and', ['live_username'=>$liveusername], ['>=', 'order_time', $start_order_time], ['<=', 'order_time', $end_order_time], ['game_type'=>$gametype], ['or', ['live_status'=>0], ['live_status'=>null]]]);
		}else{
            $countRow = LiveOrder::updateAll(['live_status'=>1],['and', ['>=', 'order_time', $start_order_time], ['<=', 'order_time', $end_order_time], ['game_type'=>$gametype], ['or', ['live_status'=>0], ['live_status'=>null]]]);
		}
		return $countRow;
	}

    public static function getLiveOrderResult($code, $live_name_arr = [], $s_time, $e_time){
        $r = LiveOrder::find()
            ->select(['count(id) as bet_count','sum(bet_money) as bet_money','sum(valid_bet_amount) as valid_bet_amount','sum(live_win) as live_win'])
            ->from('live_order')
            ->where(['and', ['>=', 'order_time', $s_time], ['<=', 'order_time', $e_time]]);
        $r->andWhere(['in','live_username',$live_name_arr]);
        if($code === 0){
            $r->andWhere(['not in','live_type', Yii::$app->getModule('live')->params['egametype']]);
        }
        if($code === 1){
            $r->andWhere(['in','live_type', Yii::$app->getModule('live')->params['egametype']]);
        }
        return $r->asArray()->one();
    }
}
