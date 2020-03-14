<?php

namespace app\modules\member\models;

use Yii;
// use yii\data\Pagination;
// use app\models\Pagination;
use app\common\data\Pagination;
use yii\helpers\ArrayHelper;
use app\modules\member\models\InsertLog;
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
	public static  function getUsersList($arr=NULL){//會員查詢筆件1(按用戶組、用戶名字段)
	    $condition=array(//初始化參數
			'user_group'=>0,	// 用戶所屬的分組
			'type'=>'user_name',// 搜索類型值得 （用戶名，ip等）
			'key'=>'',			// 搜索關鍵詞
			'cpage'=>1,			// 當前第幾個分頁
			'online'=>'',		// 用戶是否在線
	    	'status'=>'',		// 賬戶是否異常或禁用
	    	'havepay'=>'',		// 判斷用戶是否曾經充值過
	    );
		if(is_array($arr)){//填充筆件
		   $condition=array_merge($condition,$arr);
		}
		
		if($condition['havepay']==1){
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id")
			->leftJoin("money as m","u.user_id=m.user_id");
			$hd->andWhere(['m.status'=>'成功']);
			$hd->andWhere(['>','order_value',0]);
			// u.user_id=m.user_id  where m.order_value>0 and m.status='成功'
		}else{
			$hd=UserList::find()
			->select("u.*,b.group_name")
			->from("user_list u")
			->leftJoin("user_group b","u.group_id=b.group_id");
		}

		$hd=$hd->andwhere(['u.top_id'=>Yii::$app->session['S_AGENT_ID']]);

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

		$count=$hd->count();  // 統計總記錄數
		//$command=$hd->createCommand();  // 統計總記錄數
		//echo $command->sql;exit();
		$pagination = new Pagination(['totalCount' => $count,'pagesize'=>50]);//分頁：總數,每頁筆數
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
	public static function  total(){//統計4類會員的資金總額
		$status=['','正常','停用','異常'];
		foreach($status as $v){//統計各分組用戶資金
			$total[]=number_format(round(self::_sumMoney($v),2),2,'.','');
		}
		return $total;
	}
	public static function handle($uid_ar=array(),$cmd=NULL){//會員批量操作
		if(!is_array($uid_ar)){
			return false;
		};
		switch($cmd){
			case 1:_h_freeze($uid_ar);break;//凍結帳號
			case 2:_h_unfreeze($uid_ar);break;//解凍帳號
			case 3:_h_offline($uid_ar);break;//下線
			case 6:_h_delte($uid_ar);break;
			
		}
	}
	
	//----輔助函數----------------------------------------------------------
	private static function _sumMoney($status=''){//統計用戶組總金額
		$hd=UserList::find()->select("sum(money) as all_money");
	    if($status){
			$hd=$hd->where('status=:status',[':status'=>$status]);
		}
		$hd=$hd->andwhere(['top_id'=>Yii::$app->session['S_AGENT_ID']]);
		$money=$hd->asArray()->one();
	    return $money['all_money']?:0;
	}
	//用戶操作事務函數組
	private static function _h_freeze($uid_arr){//(HID:1)凍結用戶
         $hd=UserList::find()->where(['in','id',$uid_arr])->andwhere(['top_id'=>Yii::$app->session['S_AGENT_ID']]);
		 $hd->status="停用";
		 $hd->remark="concat_ws('，',remark,'管理員：'" . $_SESSION['login_name'] ." ' 停用此賬戶')";
		 $hd->save();
	}
	private static function _h_unfreeze($uid_arr){//(HID:0)解凍用戶
	     $hd=UserList::find()->where(['in','id',$uid_arr])->andwhere(['top_id'=>Yii::$app->session['S_AGENT_ID']]);
		 $hd->status="正常";
		 $hd->remark="concat_ws('，',remark,'管理員：'" . $_SESSION['login_name'] ." ' 停用此賬戶')";
		 $hd->save();
	
	}
	private static function _h_modifyPassword($uid_arr){//(HID:5)修改用戶密碼
	     //該功能暫時不開啟
	}
	private static function _h_offline($uid_arr){//(HID:3)強制下線
	     $hd=UserList::find()->where(['in','id',$uid_arr])->andwhere(['top_id'=>Yii::$app->session['S_AGENT_ID']]);
		 $hd->online=0;
		 $hd->Oid='';
		 $hd->save();
	}
	private static function _h_delete($uid_arr){//(HID:6)刪除用戶
		
	}
}
