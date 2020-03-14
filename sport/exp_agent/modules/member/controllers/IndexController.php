<?php
namespace app\modules\member\controllers;
use app\common\base\BaseController;
use app\modules\member\models\ar\AgentsList;
use app\modules\member\models\ar\HistoryBank;
use app\modules\member\models\ar\HistoryLogin;
use app\modules\member\models\ar\KBet;
use app\modules\member\models\ar\KBetCg;
use app\modules\member\models\ar\KBetCgGroup;
use app\modules\member\models\ar\LiveUser;
use app\modules\member\models\ar\Money;
use app\modules\member\models\ar\MoneyLog;
use app\modules\member\models\ar\OrderLottery;
use app\modules\member\models\ar\OrderLotterySub;
use app\modules\member\models\ar\SixLotteryOrder;
use app\modules\member\models\ar\UserLog;
use app\modules\member\models\ar\UserMsg;
use app\modules\member\models\ar\UserAddForm;
use app\modules\member\models\UserGroup;
use app\modules\member\models\UserList;
use app\modules\agentht\models\ar\SysConfig;
use Yii;
use yii\helpers\ArrayHelper;

class IndexController extends BaseController{

    private $_data = [];

    public function init(){
        parent::init();
        $this->layout='main';//關閉layout頁面結構佈局
        $this->enableCsrfValidation=false;//關閉csrf驗證
        if (empty(Yii::$app->session['S_AGENT_ID'])) {
            return $this->redirect('/?r=agentht/agent/index');
        }
        if ( Yii::$app->session['S_AGENT_LEVEL'] == 0 ) {
            return $this->redirect('/?r=agent/index/list');
        }
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $total=UserList::total();
        $userGroup = UserGroup::getUserGroupList();//獲取用戶分組列表
        //print_r($userGroup); exit;
        $arr = [];
        if(!empty($get['tel'])){
            $arr=['type'=>'tel','key'=>$get['tel']];
        }
        if(!empty($get['status'])){
            $arr=['status'=>$get['status']];
        }
        $arr = ArrayHelper::merge($get, $arr);
        $users=UserList::getUsersList($arr);
        //print_r($users); exit;
        return $this->render('index', [
            'user_group'=>isset($arr['user_group'])?$arr['user_group']:'',
            'type'=>isset($arr['type'])?$arr['type']:'',
            'key'=>isset($arr['key'])?$arr['key']:'',
            'total'=>$total,
            'userUroup'=>$userGroup,
            'users'=>$users['users'],
            'pagination' => $users['pagination']
        ]);
    }

     /**
     * 新增會員
     * @return type
     */
    public function actionAddUser() {
        $getNews = Yii::$app->request->get();
        $usergroup=UserGroup::find()->orderBy(['id' => SORT_ASC])->asArray()->all();
        if (isset($getNews['code']) && $getNews['code'] == 1) {
            return $this->render('add-user', [
                'usergroup'=>$usergroup
            ]);
        }
        $postNews = Yii::$app->request->post();
        $user_form = new UserAddForm();
        $formName = (string) $user_form->formName();
        $this->_data = [
            $formName => $postNews
        ];        
        if (!$user_form->load($this->_data) || !$user_form->validate()) {
            $msg = $user_form->getErrors();
            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    return $this->out(false, $value);
                }
            }
        }

        $r = UserList::find()->where(['user_name' => $user_form['user_name']]);
        $arr = $r->asArray()->one();
        if (isset($arr['id'])) {
            return $this->out(false, '該賬號已經存在！');
        }
        $sysconfig=SysConfig::find()->select(['add_pass'])->asarray()->one();
        $md5pwd = md5($user_form['user_pass'].$sysconfig['add_pass']);
        $str = time('s');
        $oid = strtolower(substr(md5($str), 0, 10) . substr(md5($user_form['user_name']), 0, 10) . 'hh' . rand(0, 9));
        $user_id = $this->_get_user_id();
        $userlist = new UserList;
        $userlist->user_id = $user_id;
        $userlist->Oid = $oid;
        $userlist->device_type = 0;
        $userlist->user_name = $user_form['user_name'];
        $userlist->user_pass = $md5pwd;
        $userlist->user_pass_naked = $user_form['user_pass'];
        $userlist->qk_pass =  md5($user_form['qk_pass']);
        $userlist->pay_name = $user_form['pay_name'];
        $userlist->top_id = Yii::$app->session['S_AGENT_ID'];
        $userlist->tel = $user_form['tel'];
        $userlist->qq = $user_form['qq'];
        $userlist->email = $user_form['email'];
        $userlist->loginip = '';
        $userlist->regip = '';
        $userlist->logintime = date('Y-m-d H:i:s');
        $userlist->OnlineTime = date('Y-m-d H:i:s');
        $userlist->logouttime = date('Y-m-d H:i:s');
        $userlist->regtime = date('Y-m-d H:i:s');
        $userlist->online = '0';
        $userlist->lognum = '1';
        $userlist->ask = '0';
        $userlist->answer = '0';
        $userlist->group_id = $user_form['group_id'];
        $userlist->loginurl = '';
        $userlist->regurl = '';
        $userlist->mz = md5($user_form['pay_name']);
        $userlist->remark = !empty($user_form['why']) ? $user_form['why'] : '0';
        $userlist->sum_top_id = Yii::$app->session['S_AGENT_LEVEL'];
//        $userlist->account_type = $user_form['account_type'];
        //$userlist->save();
        if( $userlist->save() ){
            return $this->out(true, '添加成功！');
        } else {
            return $this->out(false, '添加失敗，請重新再試！');
        }
    }

     /**
     * 獲得一個唯一的 user_id（註冊動作時調用）
     * @return type
     */
    function _get_user_id() {
        $id = UserList::find()->select('id')->orderBy('id desc')->asArray()->one();
        $user_id = $id['id'] + 1;
        $data = UserList::find()
            ->where(['user_id' => $user_id])
            ->one();
        while ($data['user_id'] != NULL) {
            list($tmp1, $tmp2) = explode(' ', microtime());
            $m = sprintf('%.0f', (floatval($tmp1) + floatval($tmp2)) * 1000);
            $m = substr($m,5);
            $user_id = $id['id'] + $m;
            $data = UserList::find()
                ->where(['user_id' => $user_id])
                ->one();
        }
        return $user_id;
    }

    public function actionActive(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        $remark = date('Y-m-d H:i:s').'_被啟用了';
        UserList::updateAll(['status'=>'正常','remark'=>$remark],['and', ['in','user_id',$uidarr], ['or', ['status' => '停用'], ['status' => '異常']]]);
        foreach ($uidarr as $key=>$value){
            if($value!="") {
                $oneuser=UserList::findone(['user_id'=>$value]);
                $money=$oneuser->money;
                $datereg = date('YmdHis') . '_' . $oneuser->user_name;
                $currenttime=date('Y-m-d H:i:s');

                $moneylog=new MoneyLog();
                $moneylog->user_id=$value;
                $moneylog->order_num=$datereg;
                $moneylog->about='啟用會員插入0金錢';
                $moneylog->update_time=$currenttime;
                $moneylog->order_value=0;
                $moneylog->assets=$money;
                $moneylog->balance=$money;
                $moneylog->save();
            }
        }
        return true;
    }

    public function actionStop(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        $remark = date('Y-m-d H:i:s').'_被停用了';
        UserList::updateAll(['status'=>'停用','remark'=>$remark,'online'=>0,'Oid'=>''],['and', ['in','user_id',$uidarr], ['or', ['status' => '正常'],['status' => '異常']]]);
        return true;
    }

    public function actionOutline(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        UserList::updateAll(['online'=>0,'Oid'=>''],['and', ['in','user_id',$uidarr]]);
        return true;
    }

    public function actionAbletransfertolive(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        $remark = date('Y-m-d H:i:s').'_被允許轉賬到真人';
        UserList::updateAll(['is_allow_live'=>1,'remark'=>$remark], ['in','user_id',$uidarr]);
        return true;
    }

    public function actionDisabletransfertolive(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        $remark = date('Y-m-d H:i:s').'_被不允許轉賬到真人';
        UserList::updateAll(['is_allow_live'=>2,'remark'=>$remark], ['in','user_id',$uidarr]);
        return true;
    }

    public function actionSetAgentid(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $agentid=$post['agentid'];
        $uidarr=explode(",", $uidstr);
        if(!empty($agentid)) {
            $agent=AgentsList::findOne(['id'=>$agentid]);
            if(empty($agent)){
                return '該代理ID不存在，請輸入代理ID而不是代理名稱，請查詢後再輸入。';  // 該代理ID不存在，請輸入代理ID而不是代理名稱，請查詢後再輸入。
            }
        }
        UserList::updateAll(['top_id'=>$agentid], ['in','user_id',$uidarr]);
        return '操作成功了！';
    }

    public function actionSetBetMaxmoney(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $money=$post['money'];
        $uidarr=explode(",", $uidstr);
        UserList::updateAll(['allow_total_money'=>$money], ['in','user_id',$uidarr]);
        return true;
    }

    public function actionClearBetorders(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        KBet::updateAll(['status'=>3], ['in','user_id',$uidarr]);
        KBetCg::updateAll(['status'=>3], ['in','user_id',$uidarr]);
        OrderLottery::updateAll(['status'=>3], ['in','user_id',$uidarr]);
        SixLotteryOrder::updateAll(['status'=>3], ['in','user_id',$uidarr]);
        return true;
    }

    public function actionDel(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);

        UserList::deleteAll(['in','user_id',$uidarr]);
        HistoryBank::deleteAll(['in','uid',$uidarr]);
        HistoryLogin::deleteAll(['in','uid',$uidarr]);
        Money::deleteAll(['in','user_id',$uidarr]);
        KBet::deleteAll(['in','user_id',$uidarr]);

        $olids=$sloids="";
        // 彩票訂單
        $orderlottery=OrderLottery::find()->select('order_num')->where(['user_id'=>$uidarr])->asArray()->all();
        foreach($orderlottery as $key=>$value){
            $olids[]=$value['order_num'];
        }
        if(!empty($olids)){
            OrderLotterySub::deleteAll(['in','order_num',$olids]);
            OrderLottery::deleteAll(['in','user_id',$uidarr]);
        }

        // 越南彩訂單
        $sixlotteryorder=SixLotteryOrder::find()->select('order_num')->where(['user_id'=>$uidarr])->asArray()->all();
        foreach($sixlotteryorder as $key=>$value){
            $sloids[]=$value['order_num'];
        }
        if(!empty($sloids)){
            OrderLotterySub::deleteAll(['in','order_num',$sloids]);
            OrderLottery::deleteAll(['in','user_id',$uidarr]);
        }

        UserMsg::deleteAll(['in','user_id',$uidarr]);
        KBetCg::deleteAll(['in','user_id',$uidarr]);
        KBetCgGroup::deleteAll(['in','user_id',$uidarr]);
        MoneyLog::deleteAll(['in','user_id',$uidarr]);
        LiveUser::deleteAll(['in','user_id',$uidarr]);
        UserLog::deleteAll(['in','user_id',$uidarr]);

        return true;
    }
}
