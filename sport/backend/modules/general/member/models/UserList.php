<?php

namespace app\modules\general\member\models;

use Yii;
// use yii\data\Pagination;
// use app\models\Pagination;
use app\common\data\Pagination;
use yii\helpers\ArrayHelper;
use app\modules\general\member\models\InsertLog;
/**
 * This is the model class for table "user_list".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $Oid
 * @property string $user_name
 * @property string $user_pass
 * @property string $user_pass_naked
 * @property string $qk_pass
 * @property integer $top_id
 * @property string $money
 * @property string $total_bets
 * @property string $ask
 * @property string $answer
 * @property string $loginip
 * @property string $OnlineTime
 * @property string $logintime
 * @property string $loginaddress
 * @property string $regtime
 * @property string $regip
 * @property string $regaddress
 * @property string $logouttime
 * @property string $online
 * @property integer $lognum
 * @property string $status
 * @property integer $group_id
 * @property string $sex
 * @property string $birthday
 * @property string $tel
 * @property string $email
 * @property integer $qq
 * @property string $othercon
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $address
 * @property string $pay_name
 * @property string $pay_address
 * @property string $pay_num
 * @property string $pay_bank
 * @property string $remark
 * @property string $loginurl
 * @property string $regurl
 * @property string $is_allow_live
 * @property integer $allow_total_money
 */
class UserList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_name', 'user_pass', 'qk_pass', 'ask', 'answer', 'remark'], 'required'],
            [['user_id', 'top_id', 'lognum', 'group_id', 'qq', 'allow_total_money'], 'integer'],
            [['money', 'total_bets'], 'number'],
            [['OnlineTime', 'logintime', 'regtime', 'logouttime', 'birthday'], 'safe'],
            [['remark'], 'string'],
            [['Oid', 'ask', 'answer', 'email', 'country', 'province', 'city', 'pay_num', 'pay_bank'], 'string', 'max' => 50],
            [['user_name'], 'string', 'max' => 16],
            [['user_pass', 'user_pass_naked', 'qk_pass'], 'string', 'max' => 32],
            [['loginip', 'regip', 'tel', 'pay_name'], 'string', 'max' => 20],
            [['loginaddress', 'regaddress', 'othercon', 'address', 'pay_address', 'loginurl', 'regurl'], 'string', 'max' => 100],
            [['online'], 'string', 'max' => 1],
            [['status'], 'string', 'max' => 4],
            [['sex'], 'string', 'max' => 2],
            [['is_allow_live'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'Oid' => 'Oid',
            'user_name' => 'User Name',
            'user_pass' => 'User Pass',
            'user_pass_naked' => 'User Pass Naked',
            'qk_pass' => 'Qk Pass',
            'top_id' => 'Top ID',
            'money' => 'Money',
            'total_bets' => 'Total Bets',
            'ask' => 'Ask',
            'answer' => 'Answer',
            'loginip' => 'Loginip',
            'OnlineTime' => 'Online Time',
            'logintime' => 'Logintime',
            'loginaddress' => 'Loginaddress',
            'regtime' => 'Regtime',
            'regip' => 'Regip',
            'regaddress' => 'Regaddress',
            'logouttime' => 'Logouttime',
            'online' => 'Online',
            'lognum' => 'Lognum',
            'status' => 'Status',
            'group_id' => 'Group ID',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'tel' => 'Tel',
            'email' => 'Email',
            'qq' => 'Qq',
            'othercon' => 'Othercon',
            'country' => 'Country',
            'province' => 'Province',
            'city' => 'City',
            'address' => 'Address',
            'pay_name' => 'Pay Name',
            'pay_address' => 'Pay Address',
            'pay_num' => 'Pay Num',
            'pay_bank' => 'Pay Bank',
            'remark' => 'Remark',
            'loginurl' => 'Loginurl',
            'regurl' => 'Regurl',
            'is_allow_live' => 'Is Allow Live',
            'allow_total_money' => 'Allow Total Money',
        ];
	}
	/*
	* 抓取特殊會員用的方法
	*/
	public static  function getUsersDiffList($arr=NULL){//会员查询条件1(按用户组、用户名字段)
	    $condition=array(//初始化参数
			'user_group'=>0,	// 用户所属的分组
			'type'=>'user_name',// 搜索类型值得 （用户名，ip等）
			'key'=>'',			// 搜索关键词
			'cpage'=>1,			// 当前第几个分页
			'online'=>'',		// 用户是否在线
	    	'status'=>'',		// 账户是否异常或禁用
	    	'havepay'=>'',		// 判断用户是否曾经充值过
	    );
		if(is_array($arr)){//填充条件
		   $condition=array_merge($condition,$arr);
		}
		if($condition['diff_type']=='ftms'){//今日首次提款会员数量
			$sql = "select * from 
			(SELECT u.id,u.user_id,count(m.id),left(m.update_time,10) as update_time FROM `user_list` as u INNER JOIN `money` as m on u.user_id=m.user_id WHERE m.status = '成功' AND m.type IN ('用户提款') GROUP BY u.id) 
			as todayList 
			where update_time = curdate()";
			$ftms = Yii::$app->db->createCommand($sql)->queryAll(); //找出只有提过一次的会员与记录
			$id=array('-1');
			foreach ($ftms as $key => $value) {
				if(date('Y-m-d',strtotime($ftms[$key]['update_time'])) == date('Y-m-d'))
				{
					array_push($id, $ftms[$key]['user_id']);
				} 
			}
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id");
			$hd->andWhere(array('in', 'user_id', $id));
			
		}elseif($condition['diff_type']=='fcms'){//今日首次存款会员数量
			$sql = "select * from 
			(SELECT u.id,u.user_id,count(m.id),left(m.update_time,10) as update_time FROM `user_list` as u INNER JOIN `money` as m on u.user_id=m.user_id WHERE m.status = '成功' AND m.type IN ('后台充值','银行汇款','在线支付') GROUP BY u.id) 
			as todayList 
			where update_time = curdate()";
			$fcms = Yii::$app->db->createCommand($sql)->queryAll(); //找出只有存过一次的会员与记录
			$id=array('-1');
			foreach ($fcms as $key => $value) {	
				if(date('Y-m-d',strtotime($fcms[$key]['update_time'])) == date('Y-m-d'))
				{
					array_push($id, $fcms[$key]['user_id']);
				} 
			}
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id");
			$hd->andWhere(array('in', 'user_id', $id));
		}elseif($condition['diff_type']=='jrhy')	//今日註冊會員
		{
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id");
			$hd->andWhere( array( 'like', 'regtime', date("Y-m-d") ) );
		}elseif($condition['diff_type']=='tsmm') //今日充值會員
		{
			$tsmm = Yii::$app->db->createCommand("select (user_id) from money where `status`='成功' and (`type`='在线支付' or `type`='后台充值' or `type`='银行汇款') and date(update_time) = curdate() GROUP BY user_id")->queryAll();
			$tsmm = array_column($tsmm, 'user_id');
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id");
			$hd->andWhere( array( 'in', 'user_id',  $tsmm) );
		}elseif($condition['diff_type']=='ttmm') //今日提現會員
		{
			$ttmm = Yii::$app->db->createCommand("select (user_id) from money where `status`='成功' and (`type`='用户提款') and date(update_time) = curdate() GROUP BY user_id")->queryAll();
			$ttmm = array_column($ttmm, 'user_id');
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id");
			$hd->andWhere( array( 'in', 'user_id',  $ttmm) );
		}
		



		$count=$hd->count();  // 统计总记录数
			$pagination = new Pagination(['totalCount' => $count,'pagesize'=>50]);//分页：总数,每页条数
			$users=$hd
			->offset($pagination->offset)
			->limit($pagination->limit)
			->asArray()
			->all();
		return ['users'=>$users,'pagination'=>$pagination];
	}
	public static  function getUsersList($arr=NULL){//会员查询条件1(按用户组、用户名字段)
	    $condition=array(//初始化参数
			'user_group'=>0,	// 用户所属的分组
			'type'=>'user_name',// 搜索类型值得 （用户名，ip等）
			'key'=>'',			// 搜索关键词
			'cpage'=>1,			// 当前第几个分页
			'online'=>'',		// 用户是否在线
	    	'status'=>'',		// 账户是否异常或禁用
	    	'havepay'=>'',		// 判断用户是否曾经充值过
	    );
		if(is_array($arr)){//填充条件
		   $condition=array_merge($condition,$arr);
		}
		
		if($condition['havepay']==1){
			//20190108註解會員階層，withdraw 為 當日提取次數加總
			$hd=UserList::find()
			->select("u.*,b.group_name,w.total as withdraw")//,lv.level_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id")
			->leftJoin("money as m","u.user_id=m.user_id")
			->leftJoin("( select (user_id),count(id) as total from money where `status`='成功' and (`type`='用户提款') and date(update_time) = curdate() GROUP BY user_id ) w","u.user_id=w.user_id");
			// ->leftJoin("user_level lv","u.level_id=lv.level_id");
			$hd->andWhere(['m.status'=>'成功']);
			$hd->andWhere(['>','order_value',0]);
			// u.user_id=m.user_id  where m.order_value>0 and m.status='成功'
		} else if($condition['havepay']=='0'){
			//20190114新增無儲值人員
			$hd=UserList::find()
			->select("u.*,b.group_name,w.total as withdraw, p.total as paytime")//,lv.level_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id")
			->leftJoin("money as m","u.user_id=m.user_id")
			->leftJoin("( select (user_id),count(id) as total from money where `status`='成功' and (`type`='用户提款' ) and date(update_time) = curdate() GROUP BY user_id ) w","u.user_id=w.user_id")
			->leftJoin("( select (user_id),count(id) as total from money where `status`='成功' and (`type`='后台充值' or `type`='在线支付' or `type`='银行汇款') GROUP BY user_id ) as p","u.user_id=p.user_id");
			$hd->andWhere(['p.total'=>null]);
		} else{
			$hd=UserList::find()
			->select("u.*,b.group_name,m.total as withdraw")//,lv.level_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id")
			->leftJoin("( select (user_id),count(id) as total from money where `status`='成功' and (`type`='用户提款') and date(update_time) = curdate() GROUP BY user_id ) m","u.user_id=m.user_id");
			// ->leftJoin("user_level lv","u.level_id=lv.level_id");
		}



		if(!empty($condition['user_group'])){
			$hd=$hd->andwhere(['u.group_id'=>$condition['user_group']]);
		}
		if(!empty($condition['key'])){
			$hd=$hd->andWhere(['like','u.'.$condition['type'],$condition['key']]);
		}
		if(!empty($condition['online'])){
//			$expired_time=date("Y-m-d H:i:s",time()-1200);
//			UserList::updateAll(['online'=>0],"TIMESTAMPDIFF(SECOND,logouttime,:expired_time)>0",[':expired_time' => $expired_time]);
			$hd=$hd->andWhere(['or',['u.online'=>1],['!=','u.Oid',null]]);
		}
		if(!empty($condition['status'])){
			$hd=$hd->andWhere(['u.status'=>$condition['status']]);
		}

		if(!empty($condition['overage'])){
			$hd->orderBy(['money'=>SORT_DESC]);
		}else{
			$hd->orderBy(['regtime'=>SORT_DESC]);
		}

		$count=$hd->count();  // 统计总记录数
		// $command=$hd->createCommand();  // 统计总记录数
		// echo $command->sql;exit();
		$pagination = new Pagination(['totalCount' => $count,'pagesize'=>50]);//分页：总数,每页条数
// 		$pagination->page=$condition['cpage'];
// echo $pagination->offset;echo "======".$pagination->limit;
		$users=$hd
		       ->offset($pagination->offset)
			   ->limit($pagination->limit)
			   ->asArray()
			   ->all();
		//return ['users'=>$users,'link'=>$pagination->link()];
		return ['users'=>$users,'pagination'=>$pagination];
	}
	
	public static function  total(){//统计4类会员的资金总额
		$status=['','正常','停用','异常'];
		foreach($status as $v){//统计各分组用户资金
			$total[]=number_format(round(self::_sumMoney($v),2),2,'.','');
		}
		return $total;
	}
	public static function handle($uid_ar=array(),$cmd=NULL){//会员批量操作
		if(!is_array($uid_ar)){
			return false;
		};
		switch($cmd){
			case 1:_h_freeze($uid_ar);break;//冻结帐号
			case 2:_h_unfreeze($uid_ar);break;//解冻帐号
			case 3:_h_offline($uid_ar);break;//下线
			case 6:_h_delte($uid_ar);break;
			
		}
	}
	
	//----辅助函数----------------------------------------------------------
	private static function _sumMoney($status=''){//统计用户组总金额
		$hd=UserList::find()->select("sum(money) as all_money");
	    if($status){
			$hd=$hd->where('status=:status',[':status'=>$status]);
		}
		$money=$hd->asArray()->one();
	    return $money['all_money']?:0;
	}
	//用户操作事务函数组
	private static function _h_freeze($uid_arr){//(HID:1)冻结用户
         $hd=UserList::find()->where(['in','id',$uid_arr]);
		 $hd->status="停用";
		 $hd->remark="concat_ws('，',remark,'管理员：'" . $_SESSION['login_name'] ." ' 停用此账户')";
		 $hd->save();
	}
	private static function _h_unfreeze($uid_arr){//(HID:0)解冻用户
	     $hd=UserList::find()->where(['in','id',$uid_arr]);
		 $hd->status="正常";
		 $hd->remark="concat_ws('，',remark,'管理员：'" . $_SESSION['login_name'] ." ' 停用此账户')";
		 $hd->save();
	
	}
	private static function _h_modifyPassword($uid_arr){//(HID:5)修改用户密码
	     //该功能暂时不开启
	}
	private static function _h_offline($uid_arr){//(HID:3)强制下线
	     $hd=UserList::find()->where(['in','id',$uid_arr]);
		 $hd->online=0;
		 $hd->Oid='';
		 $hd->save();
	}
	private static function _h_delete($uid_arr){//(HID:6)删除用户
		
	}
}
