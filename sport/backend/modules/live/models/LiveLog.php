<?php

namespace app\modules\live\models;

use YII;
use yii\db\ActiveRecord;

use yii\db\Query;


/**
 * LiveUser is the model behind the live_user.
 */
class LiveLog extends ActiveRecord {

    public function getUserList() {
        return $this->hasOne(UserList::className(), ['user_id' => 'user_id']);
    }

    public static function getLiveLogCount($userstr,$gametype,$start_order_time,$end_order_time,$status){
    	$query=LiveLog::find();
    	if($gametype!=null||$gametype!=""){
    		$gametypearr=explode(',',$gametype);
    		$query->andwhere(['live_type'=>$gametypearr]);
    	}
        if($status!=null||$status!=""){
    		$statusarr=explode(',',$status);
    		$query->andWhere(['in','status',$statusarr]);
    	}
    	if($userstr!=null||$userstr!=""){
    		$userarr=explode(',',$userstr);
    		$ulQuery=UserList::find()->select("user_id")->andWhere(['in','user_name',$userarr])->asArray()->all();
    	    if(empty($ulQuery)){
    			$useridarr=array();
    		}else{
    			foreach ($ulQuery as $key=>$value){
    				$useridarr[]=$value["user_id"];
    			}
    		}
    		$query->andWhere(['in','user_id',$useridarr]);
    	}
    	if($start_order_time!=null||$start_order_time!=""){
    		$query->andWhere(['>=', 'add_time', $start_order_time]);
    	}
    	if($end_order_time!=null||$end_order_time!=""){
    		$query->andWhere(['<=', 'add_time', $end_order_time]);
    	}

		$livelogcount=$query->count();
    	return $livelogcount;
    }

    public static function getLiveLogList($userstr,$gametype,$start_order_time,$end_order_time,$status,$pageoffset,$pagelimit){

    	$query=LiveLog::find();
    	if($gametype!=null||$gametype!=""){
    		$gametypearr=explode(',',$gametype);
    		$query->andwhere(['live_type'=>$gametypearr]);
    	}
    	if($status!=null||$status!=""){
    		$statusarr=explode(',',$status);
    		$query->andWhere(['in','status',$statusarr]);
    	}
    	 if($userstr!=null||$userstr!=""){
    		$userarr=explode(',',$userstr);
    		$ulQuery=UserList::find()->select("user_id")->andWhere(['in','user_name',$userarr])->asArray()->all();
    	    if(empty($ulQuery)){
    			$useridarr=array();
    		}else{
    			foreach ($ulQuery as $key=>$value){
    				$useridarr[]=$value["user_id"];
    			}
    		}
    		$query->andWhere(['in','user_id',$useridarr]);
    	}
    	if($start_order_time!=null||$start_order_time!=""){
    		$query->andWhere(['>=', 'add_time', $start_order_time]);
    	}
    	if($end_order_time!=null||$end_order_time!=""){
    		$query->andWhere(['<=', 'add_time', $end_order_time]);
    	}

    	$query->orderBy(['id' => SORT_DESC]);
    	$query->limit($pagelimit)->offset($pageoffset);

    	$rs=$query->with('userList')->asArray()->all();
    	return $rs;
// 		$comman=$query->createCommand();
// 		echo $comman->sql;exit();
    }

    public static function getBetMoneyAndCount($s_time, $e_time, $gType, $rType, $inUserString='') {
        $r = LiveOrder::find()
            ->select(['count(id) as bet_count', 'IFNULL(SUM(IFNULL(zz_money,0)),0) as bet_money'])
            ->from('live_log')
            ->where(['and', ['>=', 'add_time', $s_time], ['<=', 'add_time', $e_time]])
            ->andWhere(['like', 'result', '[成功]']);
        if ($gType == "AG" || $gType == "AGIN" || $gType == "AG_BBIN" || $gType == "AG_MG" || $gType == "DS" || $gType == "AG_OG" || $gType == "OG") {
            $r->andWhere(['live_type' => $gType]);
        }
        if ($gType == "AG") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>1]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>2]);
            }
        } elseif ($gType == "AGIN") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>3]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>4]);
            }
        } elseif ($gType == "AG_BBIN") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>5]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>6]);
            }
        }elseif ($gType == "DS") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>7]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>8]);
            }
        }  elseif ($gType == "AG_MG") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>11]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>12]);
            }
        } elseif ($gType == "AG_OG") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>9]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>10]);
            }
        } elseif ($gType == "OG") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>13]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>14]);
            }
        } elseif ($gType == "VR") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>19]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>20]);
            }
        } elseif ($gType == "PT") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type'=>17]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type'=>18]);
            }
        } elseif ($gType == "AI") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type' => 21]);
            } elseif ($rType == "转出") {
                $r->andWhere(['zz_type' => 22]);
            }
        }

        if ($gType == "All") {
            if ($rType == "转入") {
                $r->andWhere(['zz_type' => [1,3,5,7,9,11,13,15,17,19,21]]);
            } else {
                $r->andWhere(['zz_type' => [2,4,6,8,10,12,14,16,18,20,22]]);
            }
        }
        if ($inUserString != '') {
            $r->andWhere(['in','user_id',$inUserString]);
        }
        $r = $r->asArray()->one();
        return $r;
    }

    /**
     * 创建live log
     * @param array $params 参数
     * @return boolean      true: 创建成功 false: 创建失败
     */
    public static function createLiveLog($params) {
        $log = new LiveLog();
        $log->live_type = $params['live_type'];
        $log->zz_type = $params['zz_type'];
        $log->user_id = $params['user_id'];
        $log->live_username = $params['name'];
        $log->zz_money = $params['credit'];
        $log->status = $params['status'];
        $log->result = $params['result'];
        $log->add_time = date('Y-m-d H:i:s', time());
        $log->do_time = date('Y-m-d H:i:s', time());
        $log->order_num = $params['billno'];
        return $log->save();
    }
}
