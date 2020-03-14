<?php

namespace app\modules\live\models;

use yii\db\ActiveRecord;

/**
 * LiveRpcConfig is the model behind the live_rpc_config.
 */
class LiveFsList extends ActiveRecord {
	public static function getSumFsMoney($liveusername,$gametype,$start_order_time,$end_order_time){
		
		if($gametype==""){
			$query=LiveFsList::find()->select("SUM(FSMONEY) as fs_already_money")->where(['USERNAME_LIVE'=>$liveusername]);
		}else{
			//$gametypearr=explode(',',$gametype);
			$query=LiveFsList::find()->select("SUM(FSMONEY) as fs_already_money")->where(['USERNAME_LIVE'=>$liveusername,'live_type'=>$gametype]);
		}

		/*if($start_order_time!=null||$start_order_time!=""){        //20180302@robin mark begin
			$query->andWhere(['>=', 'FSTIME', $start_order_time]);
		}
		if($end_order_time!=null||$end_order_time!=""){
			$query->andWhere(['<=', 'FSTIME', $end_order_time]);
		}*/                                                          //20180302@robin mark end
//		$r = $query->createCommand()->getrawSql();return $r;
		$rs=$query->asArray()->one();
		
		return $rs["fs_already_money"];	
	}
	//getFsCount
	public static function getFsCount($userstr,$gametype,$start_order_time,$end_order_time){
		$query=static::find()->select("count(*) as count");
		if($start_order_time!=null||$start_order_time!=""){
			$query->andWhere(['>=', 'FSTIME', $start_order_time]);
		}
		if($end_order_time!=null||$end_order_time!=""){
			$query->andWhere(['<=', 'FSTIME', $end_order_time]);
		}
		
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['in','live_type',$gametypearr]);
		}
		
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);

			$userlists = UserList::find()->where(['in','user_name',$userarr])->with('liveUser')->all();
            $livenamearr = [];
			foreach ($userlists as $key=>$userlist){
				$liveusers=$userlist->liveUser;
				$livenamearr[]=$liveusers[$key]->attributes['live_username'];
			}
			$query->andWhere(['in','USERNAME_LIVE',$livenamearr]);
		}
		
		$rs=$query->asArray()->one();
		return $rs["count"];
	}
	
	//getFsCount
	public static function getFsRecord($userstr,$gametype,$start_order_time,$end_order_time,$pageoffset,$pagelimit){
		$query=static::find();
		if($start_order_time!=null||$start_order_time!=""){
			$query->andWhere(['>=', 'FSTIME', $start_order_time]);
		}
		if($end_order_time!=null||$end_order_time!=""){
			$query->andWhere(['<=', 'FSTIME', $end_order_time]);
		}
		
		if($gametype!=null||$gametype!=""){
			$gametypearr=explode(',',$gametype);
			$query->andwhere(['in','live_type',$gametypearr]);
		}
		
		if($userstr!=null||$userstr!=""){
			$userarr=explode(',',$userstr);	
			$query->andWhere(['in','USERNAME',$userarr]);
		}
		$query->orderBy(['FSTIME' => SORT_DESC,]);
		$query->offset($pageoffset)->limit($pagelimit);
		$rs=$query->asArray()->all();
		return $rs;
	}
}
