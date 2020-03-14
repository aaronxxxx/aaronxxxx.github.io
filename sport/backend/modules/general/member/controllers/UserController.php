<?php
namespace app\modules\general\member\controllers;

use YII;
use app\common\base\BaseController;
use app\modules\general\member\models\ar\UserList;
use app\modules\general\member\models\ar\UserGroup;
use app\modules\general\member\models\ar\HistoryBank;
use app\modules\general\sysmng\models\ar\SysConfig;

class UserController extends BaseController
{
	public function init(){
		parent::init();
		$this->layout=false;//关闭layout页面结构布局
		$this->enableCsrfValidation=false;//关闭csrf验证
	}

    public function actionIndex($uid)
    {
		$userLevel = array();
    	$usergroup=UserGroup::find()->orderBy(['id' => SORT_ASC])->asArray()->all();
    	$userAG = UserList::find()
            ->select("u.*,l.*")
            ->from("user_list u")
            ->leftJoin("live_user l","u.user_id=l.user_id")
            ->where(['u.user_id'=>$uid])
            ->andwhere(['l.live_type'=>'AG'])
            ->asArray()->one();
    	if(empty($userAG)){
    		$userAG=UserList::find()->where(['user_id'=>$uid])->asArray()->one();
    	}
    	$userBBin=UserList::find()
            ->select("u.*,l.*")
            ->from("user_list u")
            ->leftJoin("live_user l","u.user_id=l.user_id")
            ->where(['u.user_id'=>$uid])
            ->andWhere(['l.live_type'=>'AG_BBIN'])
			->asArray()->one();
		//20190108 註解
		// $userLevel=Yii::$app->db->createCommand("select * from user_level order by id asc")->queryAll();
        return $this->render('index', [
            'userAG'=>$userAG,
            'userBBin'=>$userBBin,
			'usergroup'=>$usergroup,
			'userLevel'=>$userLevel
        ]);
    }

    public function actionSaveinfo()
    {
    	$post = Yii::$app->request->post();

    	$ask = $post['ask'];
    	$why = $post['why'];
    	$answer = $post['answer'];
    	$birthday = $post['birthday'];
    	$mobile = $post['mobile'];
    	$email = $post['email'];
    	$pay_name = $post['pay_name'];
    	$pay_bank = $post['pay_card'];
    	$pay_address = $post['pay_address'];
    	$pay_num = $post['pay_num'];
    	$hf_pay_num = $post['hf_pay_num'];
		$username = $post['hf_username'];
		// $lid = $post['lid'];
    	$gid = $post['gid'];
    	$uid = $post['uid'];
    	$QQ = $post['QQ'];
    	$live_user_name = @$post['live_username'];
    	$live_password = @$post['live_password'];
		// $live_user_name_tyc = $post['live_username_tyc'];
		// $live_password_tyc = $post['live_password_tyc'];
		$oddlists = isset($post['oddlists']) ? $post['oddlists'] : '';
		$trade_type = $post['trade_type'];

    	$userone = UserList::findOne(['user_id' => $uid]);

    	$userone->ask = $ask;
    	$userone->answer = $answer;
    	$userone->birthday = $birthday;
    	$userone->tel = $mobile;
    	$userone->email = $email;
		$userone->group_id = $gid;
		// $userone->level_id =  lid;
    	$userone->remark = $why;
    	$userone->qq = $QQ;
    	// $userone->pay_name = $pay_name; // 不允许修改真人姓名
    	$userone->pay_bank = $pay_bank;
    	$userone->pay_address = $pay_address;
		$userone->pay_num = $pay_num;
		$userone->trade_type = $trade_type;
    	$userone->save();

		$count = HistoryBank::find()->where(['uid'=>$uid])->count();

        if ($count <= 0) {
            $historybank = new HistoryBank();
            $historybank->uid = $uid;
            $historybank->username = $username;
            $historybank->pay_card = $pay_bank;
            $historybank->pay_num = $pay_num;
            $historybank->pay_address = $pay_address;
            $historybank->pay_name = $pay_name;
            $historybank->save();
		}

		return true;
    }

    public function actionSetgroup($uid)
    {
    	$get=Yii::$app->request->get();
    	$uid=$get["uid"];
    	//$rs=UserList::find()->select("u.user_id,u.user_name,g.group_name")->from("user_list u")->leftJoin("user_group g","u.group_id=g.group_id")->where(['u.user_id'=>$uid])->asArray()->one();
    	$rs=UserList::find()->select("u.*,g.*")->from("user_list u")->leftJoin("user_group g","u.group_id=g.group_id")->where(['u.user_id'=>$uid])->asArray()->one();
    	//print_r($rs);
    	$usergroup=UserGroup::find()->orderBy(['id' => SORT_ASC])->asArray()->all();
    	$data=['rs'=>$rs,'usergroup'=>$usergroup];
    	return $this->render('group',$data);
    }

    public function actionSavegroup()
    {
    	$post=Yii::$app->request->post();

    	$uid=$post["uid"];
    	$group_select=$post["group_select"];

    	$userlist=UserList::findOne(['user_id'=>$uid]);
    	$userlist->group_id=$group_select;
    	$userlist->save();
    	return true;
    }

    public function actionSetpwd($uid)
    {
    	$get=Yii::$app->request->get();
    	$uid=$get["uid"];
		$rs=UserList::find()->where(['user_id'=>$uid])->asArray()->one();
    	$data=['rs'=>$rs];
    	return $this->render('pwd',$data);
    }

    public function actionSavepwd()
    {
    	$post=Yii::$app->request->post();
        $sysconfig=SysConfig::find()->select(['add_pass'])->asarray()->one();
    	$uid=$post["uid"];
    	$password=$post["password"];
    	$userlist=UserList::findOne(['user_id'=>$uid]);
    	$userlist->user_pass_naked=$password;
    	$userlist->user_pass=md5($password.$sysconfig['add_pass']);
        $userlist->online=0;
        $userlist->Oid='';
    	$userlist->save();
    	return true;
    }

    public function actionSaveqkpwd()
    {
    	$post=Yii::$app->request->post();

    	$uid=$post["uid"];
    	$password=$post["qk_pwd"];

    	$userlist=UserList::findOne(['user_id'=>$uid]);
    	$userlist->qk_pass=md5($password);
    	$userlist->save();
    	return true;
    }

    public function actionSavedlpwd()
    {
    	$post=Yii::$app->request->post();

    	$uid=$post["uid"];
    	$password=$post["qk_pwd"];

    	$userlist=UserList::findOne(['user_id'=>$uid]);
    	$userlist->dl_pwd=md5($password);
    	$userlist->save();
    	return true;
    }
}
