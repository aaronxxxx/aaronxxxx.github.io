<?php
namespace app\modules\general\member\controllers;

use app\common\base\BaseController;
use app\modules\general\member\models\ar\AgentsList;
use app\modules\general\member\models\ar\HistoryBank;
use app\modules\general\member\models\ar\HistoryLogin;
use app\modules\general\member\models\ar\LiveUser;
use app\modules\general\member\models\ar\Money;
use app\modules\general\member\models\ar\MoneyLog;
use app\modules\general\member\models\ar\OrderLottery;
use app\modules\general\member\models\ar\OrderLotterySub;
use app\modules\general\member\models\ar\SixLotteryOrder;
use app\modules\general\member\models\ar\UserLog;
use app\modules\general\member\models\ar\UserMsg;
use app\modules\general\member\models\UserGroup;
use app\modules\general\member\models\UserList;
use app\modules\general\member\models\LotteryBuildAdd;
use app\modules\general\member\models\UserDama;
use app\modules\general\member\models\UserDamaLog;
use Yii;
use yii\helpers\ArrayHelper;

class IndexController extends BaseController
{
    public function init(){
        parent::init();
        $this->layout=false;//关闭layout页面结构布局
        $this->enableCsrfValidation=false;//关闭csrf验证
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $total=UserList::total();
        $userGroup = UserGroup::getUserGroupList();//获取用户分组列表
        $arr = [];
        if(!empty($get['tel'])){
            $arr=['type'=>'tel','key'=>$get['tel']];
        }
        if(!empty($get['status'])){
            $arr=['status'=>$get['status']];
        }
        $arr = ArrayHelper::merge($get, $arr);
        $users=UserList::getUsersList($arr);
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

    public function actionLureLottery(){
        $get = Yii::$app->request->get();
        $userGroup = UserGroup::getUserGroupList();//获取用户分组列表
        $arr = [];
        if(!empty($get['tel'])){
            $arr=['type'=>'tel','key'=>$get['tel']];
        }
        if(!empty($get['status'])){
            $arr=['status'=>$get['status']];
        }

        $arr = ArrayHelper::merge($get, $arr);
        $users=LotteryBuildAdd::get_lotterybuildadd_list($arr);
        //$userid = array_column($users['users'], 'user_id');
        return $this->render('lurelottery', [
            'user_group'=>isset($arr['user_group'])?$arr['user_group']:'',
            'type'=>isset($arr['type'])?$arr['type']:'',
            'key'=>isset($arr['key'])?$arr['key']:'',
            'userUroup'=>$userGroup,
            'users'=>$users['users'],
            'pagination' => $users['pagination']
        ]);
    }
    public function actionUpdateLureLottery(){
        $post = Yii::$app->request->post();
        if(!empty($post['user_id']) && !empty($post['lottery_type']) && isset($post['check']) ){
            $OneuserBuildAdd=LotteryBuildAdd::findone(['user_id'=>$post['user_id']]);
            switch ($post['lottery_type']) {
                case 'ssrc':
                    $OneuserBuildAdd->ssrc_flag = $post['check'];
                    break;
                case 'tjssc':
                    $OneuserBuildAdd->tj_flag = $post['check'];
                    break;
                case 'orpk':
                    $OneuserBuildAdd->orpk_flag = $post['check'];
                    break;
                case 'spsix':
                    $OneuserBuildAdd->spsix_flag = $post['check'];
                    break;
                default:
                    # code...
                    break;
            }
            // $OneuserBuildAdd->$post['lottery_type'].'_flag' = $post['check'];
            $OneuserBuildAdd->save();
            return json_encode([0,'操作成功了！']);
        }
        else
        {
            return json_encode([1,'操作失敗了！']);
        }
    }
    public function actionDifferent(){
        $get = Yii::$app->request->get();
        $total=UserList::total();
        $userGroup = UserGroup::getUserGroupList();//获取用户分组列表
        $arr = [];
        if(!empty($get['tel'])){
            $arr=['type'=>'tel','key'=>$get['tel']];
        }
        if(!empty($get['status'])){
            $arr=['status'=>$get['status']];
        }
        $arr = ArrayHelper::merge($get, $arr);
        $users=UserList::getUsersDiffList($arr);
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
    public function actionActive(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        $remark = date('Y-m-d H:i:s').'_被启用了';
        UserList::updateAll(['status'=>'正常','remark'=>$remark],['and', ['in','user_id',$uidarr], ['or', ['status' => '停用'], ['status' => '异常']]]);
        foreach ($uidarr as $key=>$value){
            if($value!="") {
                $oneuser=UserList::findone(['user_id'=>$value]);
                $money=$oneuser->money;
                $datereg = date('YmdHis') . '_' . $oneuser->user_name;
                $currenttime=date('Y-m-d H:i:s');

                $moneylog=new MoneyLog();
                $moneylog->user_id=$value;
                $moneylog->order_num=$datereg;
                $moneylog->about='启用会员插入0金钱';
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
        UserList::updateAll(['status'=>'停用','remark'=>$remark,'online'=>0,'Oid'=>''],['and', ['in','user_id',$uidarr], ['or', ['status' => '正常'],['status' => '异常']]]);
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
        $remark = date('Y-m-d H:i:s').'_被允许转账到真人';
        UserList::updateAll(['is_allow_live'=>1,'remark'=>$remark], ['in','user_id',$uidarr]);
        return true;
    }

    public function actionDisabletransfertolive(){
        $post=Yii::$app->request->post();
        $uidstr=$post['uidstr'];
        $uidarr=explode(",", $uidstr);
        $remark = date('Y-m-d H:i:s').'_被不允许转账到真人';
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
                return '该代理ID不存在，请输入代理ID而不是代理名称，请查询后再输入。';  // 该代理ID不存在，请输入代理ID而不是代理名称，请查询后再输入。
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
        OrderLottery::updateAll(['status'=>3], ['in','user_id',$uidarr]);
        SixLotteryOrder::updateAll(['status'=>3], ['in','user_id',$uidarr]);
        return true;
    }

    public function actionDel()
    {
        $post = Yii::$app->request->post();
        $uidstr = $post['uidstr'];
        $uidarr = explode(",", $uidstr);

        UserList::deleteAll(['in', 'user_id', $uidarr]);
        HistoryBank::deleteAll(['in', 'uid', $uidarr]);
        HistoryLogin::deleteAll(['in', 'uid', $uidarr]);
        Money::deleteAll(['in', 'user_id', $uidarr]);

        $olids = $sloids = "";
        // 彩票订单
        $orderlottery = OrderLottery::find()->select('order_num')->where(['user_id' => $uidarr])->asArray()->all();

        foreach ($orderlottery as $key => $value) {
            $olids[] = $value['order_num'];
        }

        if (! empty($olids)) {
            OrderLotterySub::deleteAll(['in', 'order_num', $olids]);
            OrderLottery::deleteAll(['in', 'user_id', $uidarr]);
        }

        // 六合彩订单
        $sixlotteryorder = SixLotteryOrder::find()->select('order_num')->where(['user_id' => $uidarr])->asArray()->all();

        foreach ($sixlotteryorder as $key => $value) {
            $sloids[] = $value['order_num'];
        }

        if (! empty($sloids)) {
            OrderLotterySub::deleteAll(['in', 'order_num', $sloids]);
            OrderLottery::deleteAll(['in', 'user_id', $uidarr]);
        }

        UserMsg::deleteAll(['in', 'user_id', $uidarr]);
        MoneyLog::deleteAll(['in', 'user_id', $uidarr]);
        LiveUser::deleteAll(['in', 'user_id', $uidarr]);
        UserLog::deleteAll(['in', 'user_id', $uidarr]);
        UserDama::deleteAll(['in', 'user_id', $uidarr]);
        UserDamaLog::deleteAll(['in', 'user_id', $uidarr]);

        return true;
    }

    public function actionShowDama()
    {
        $post = Yii::$app->request->post();

        $user = UserList::find()
            ->where(['user_id' => $post['id']])
            ->asArray()
            ->one();

        if (! $user) {
            return false;
        }

        $userdama['dama_value'] = 0;
        $userdama['order_time'] = $user['regtime'];

        // 取最後一次提款紀錄
        $money = Money::find()
            ->where(['type' => ['用户提款']])
            ->andWhere(['status' => '成功'])
            ->andWhere(['user_id' => $user['user_id']])
            ->orderBy(['update_time' => SORT_DESC])
            ->asArray()
            ->one();

        if ($money) {
            $userdama['order_time'] = $money['update_time'];
        }

        $userDama = UserDama::find()
            ->where(['user_id' => $user['user_id']])
            ->one();

        if ($userDama) {
            $userdama['dama_value'] = $userDama->dama_value;

            if ($userDama->order_time) {
                $userdama['order_time'] = $userDama->order_time;
            }
        }

        $money = Money::find()
            ->select('sum(order_value + zsjr) as money')
            ->where(['>', 'update_time', $userdama['order_time']])
            ->andWhere(['type' => ['银行汇款', '在线支付']])
            ->andWhere(['status' => '成功'])
            ->andWhere(['user_id' => $user['user_id']])
            ->asArray()
            ->one();

        if (! isset($money['money'])) {
            $money['money'] = 0;
        }

        $drawing_odds = UserGroup::find()
            ->select('drawing_odds')
            ->where(['group_id' => $user['group_id']])
            ->asArray()
            ->one();

        $result['dama'] = $money['money'] * $drawing_odds['drawing_odds'] + $userdama['dama_value'];
        $result['r'] = UserDama::_getCondition($user['user_id'], $userdama['order_time']);

        return json_encode($result);
    }

    public function actionClearDama()
    {
        $post = Yii::$app->request->post();
        $uidarr = array_filter(explode(",", $post['uidstr']));

        $fieldArray = [
            'user_id',
            'dama_value',
            'order_time',
            'modify_time'
        ];

        foreach ($uidarr as $key => $val) {
            $valueArray[] = [
                'user_id' => $val,
                'dama_value' => 0,
                'order_time' => date('Y-m-d H:i:s'),
                'modify_time' => date('Y-m-d H:i:s')
            ];
        }

        $duplicatie_update_field = [];

        foreach ($fieldArray as $key => $val) {
            $duplicatie_update_field[] = $val . " = VALUES(" . $val . ")";
        }

        $db = Yii::$app->db;
        $sql = $db->queryBuilder->batchInsert('user_dama', $fieldArray, $valueArray);
        $db->createCommand($sql . ' ON DUPLICATE KEY UPDATE ' . implode(', ', $duplicatie_update_field))
            ->execute();

        // 新增log
        $fieldArray = [
            'user_id',
            'type',
            'dama_new',
            'dama_value_new',
            'create_time'
        ];

        foreach ($uidarr as $key => $val) {
            $logArray[] = [
                'user_id' => $val,
                'type' => '后台清零',
                'dama_new' => 0,
                'dama_value_new' => 0,
                'create_time' => date('Y-m-d H:i:s')
            ];
        }

        $db = Yii::$app->db;
        $sql = $db->queryBuilder->batchInsert('user_dama_log', $fieldArray, $logArray);
        $db->createCommand($sql)->execute();

        return true;
    }
}
