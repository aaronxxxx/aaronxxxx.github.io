<?php

namespace app\modules\live\models;

use yii\db\ActiveRecord;


/**
 * LiveUser is the model behind the live_user.
 */
class LiveUser extends ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'live_user';
	}
	
    public function getUserList() {
        return $this->hasOne(UserList::className(), ['user_id' => 'user_id']);
    }
    
    public static function getLiveUserCount($userstr,$gametype,$start_order_time,$end_order_time){

    	$query=LiveUser::find();
    	
    	if($gametype!=null||$gametype!=""){
    		$gametypearr=explode(',',$gametype);
    		$query->andwhere(['live_type'=>$gametypearr]);
    	}
    	// ['>', 'age', 10]
    	$useridarr="";
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
    		$query->andWhere(['>=', 'update_time', $start_order_time]);
    	}
    	if($end_order_time!=null||$end_order_time!=""){
    		$query->andWhere(['<=', 'update_time', $end_order_time]);
    	}
    	
		$liveusercount=$query->count();
    	return $liveusercount;
    }
    
    public static function getLiveUserList($userstr,$gametype,$start_order_time,$end_order_time,$pageoffset,$pagelimit){

    	$query=LiveUser::find();
    
    	if($gametype!=null||$gametype!=""){
    		$gametypearr=explode(',',$gametype);
    		$query->andwhere(['live_type'=>$gametypearr]);
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
    	}else{
            if($start_order_time!=null||$start_order_time!=""){
                $query->andWhere(['>=', 'update_time', $start_order_time]);
            }
            if($end_order_time!=null||$end_order_time!=""){
                $query->andWhere(['<=', 'update_time', $end_order_time]);
            }
        }

    
    	$query->orderBy(['id' => SORT_DESC]);
    	$query->limit($pagelimit)->offset($pageoffset);
    	
    	
    	$rs=$query->with('userList')->asArray()->all();
    	return $rs;
// 		$comman=$query->createCommand();
// 		echo $comman->sql;exit();
    }
    
    public static function getLiveUserPwd($live_name,$hall_type){
    	$liveuser=static::findOne(['live_username' => $live_name,'live_type' => $hall_type]);
   	// 	$rs=static::find()->where(['live_username' => $live_name])->andWhere(['live_type' => $hall_type])->one();
    	$live_password="";
  		if(!empty($liveuser)){
  			$live_user=$liveuser->attributes['live_password'];
    		$live_password=$liveuser->attributes['live_password'];
  		}
    	return $live_password;

    }
    
    public static function getUserByNameHall($live_name,$gametype=null){

//     	if($gametype!=null||$gametype!=""){
//     		$gametypearr=explode(',',$gametype);
    		
//     		$gametypearr=['AG','AGIN'];
//      		$liveuser=static::findOne([['live_username' => $live_name],['in','live_type',$gametypearr]]);
     		
//      		print_r($liveuser);exit();
// 			//$liveuser=static::find()->where(['live_username' => $live_name])->andWhere(['in','live_type',$gametypearr])->asArray()->all();
//     	}else{
//     		$liveuser=static::findOne(['live_username' => $live_name]);
//     	}

    	
    	
		if($gametype!=""){
			$gametypearr=explode(',',$gametype);
			$liveuser=static::findOne(['live_username' => $live_name,'live_type'=>$gametypearr]);
		}else{
			$liveuser=static::findOne(['live_username' => $live_name]);
		}
		
    	
    	return $liveuser;
    
    }
    
    public static function updateLiveUserById($luid,$fsrate){
    	$liveuser=LiveUser::findOne(['id' => $luid]);
    	$liveuser->fs_rate=$fsrate;
    	$affectrows=$liveuser->update();
    	if($affectrows>0){
    		return true;
    	}
    	return false;
    
    }
    
    public static function updateLiveUserByGametype($gametype,$fsrate){
    	
    	if($gametype==""){
    		$affectrows=LiveUser::updateAll(['fs_rate'=>$fsrate]);
    	}else{
    		$affectrows=LiveUser::updateAll(['fs_rate'=>$fsrate],['live_type'=>$gametype]);
    	}
    	
    	//echo $affectrows;exit();
    	if($affectrows>0){
    		return true;
    	}
    	return false;
    
    }

    public static function getLiveUserNameByUserId($userIds = [])
    {
        $query = LiveUser::find()->select(['live_username'])->where(['in', 'user_id', $userIds]);
        return $query->asArray()->all();
    }
    
}
