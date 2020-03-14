<?php
namespace app\modules\general\member\controllers;

use app\modules\live\models\LiveOrder;
use app\modules\live\models\LiveUser;
use app\modules\lottery\models\ar\OrderLottery;
use app\modules\lottery\models\ar\OrderLotterySub;
use app\modules\lottery\models\ar\UserGroup;
use app\modules\six\models\SixLotteryOrder;
use Yii;
use yii\helpers\ArrayHelper;
use app\common\base\BaseController;
use app\modules\core\common\filters\LoginFilter;
use app\modules\core\common\filters\UserFilter;
use app\modules\general\member\models\ar\UserList;
use app\modules\general\member\models\BankTransaction\Money;
use app\modules\general\member\models\BankTransaction\MoneyLog;
use app\modules\general\member\models\WithdrawPwdForm;
use app\modules\general\member\models\WithdrawSetCardForm;
use app\modules\general\member\models\ar\SysConfig;
use app\modules\general\member\models\ar\UserDama;
use app\modules\general\member\models\ar\UserDamaLog;

/**
 * 银行取款
 * WithdrawController
 */
class WithdrawController extends BaseController
{
    private $_data = [];
    private $_req = null;
    private $_session = null;
    private $_params = null;
    public $enableCsrfValidation = false;

    public function init() {
        parent::init();
        $this->_req = Yii::$app->request;
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;

        $this->getView()->title = '线上取款';
        $this->layout = 'main';
    }

    public function behaviors(){
        return ArrayHelper::merge([
            [
                'class' => LoginFilter::className(),
                'only' => ['set-card','tikuan']
            ],
            [
                'class' => UserFilter::className(),
                'only' => ['tikuan']
            ],
        ], parent::behaviors());
    }

    /**
     * 主页
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户信息,判断用户是否已经设置银行卡信息
     * 未设置，则跳转至设置银行卡信息页面，已设置则跳转至取款页面。
     */
    public function actionIndex()
    {
        if (! Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }

        $sysconfig = SysConfig::find()->limit(1)->one();
        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::getUserNewsByUserId($user_id); //获取用户信息,判断是否已经设置银行卡信息
        $pay_bank = $user['pay_bank'];
        $username = $user['user_name'];
        $pay_name = $user['pay_name'];

        if ($pay_bank == '未填写' || $pay_bank == '') {
            $tradeType = [
                1 => 'USDT',
                2 => 'ETH_USDT'
            ];

            return $this->render('index', [
                'tradeType' => $tradeType,
                'username' => $username,
                'pay_name' => $pay_name,
                'trade_type' => $user['trade_type']
            ]);
        }

        if ($user['trade_type'] != 1 && $user['trade_type'] != 2) {
            $replace = str_pad('', (int) (strlen($user['pay_num'])-10), "*", STR_PAD_LEFT);
            $user['pay_num'] = substr($user['pay_num'], 0, 6 ) . $replace . substr($user['pay_num'], -4);
        }

        return $this->render('tikuan', [
            'user' => $user,
            'min_money' => $sysconfig['min_qukuan_money']
        ]);
    }

    /**
     * 设置银行卡信息页面
     * 用户未设置过银行卡信息时，需要进行的银行卡设置页面
     * @return type
     */
    public function actionSetCard()
    {
        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $postNews = Yii::$app->request->post();
        $model = new WithdrawSetCardForm;
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews
        ];

        if (!$model->load($this->_data) || !$model->validate()) {
            $msg = $model->getErrors();

            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    return $this->out(false,$value);    // 返回表单验证的错误信息
                }
            }
        }

        $r = UserList::setPayCard($user_id, $postNews);

        if ($r) {
            return $this->out(true, '修改成功！');
        }

        return $this->out(false, '取款密码错误');
    }

    /**
     * 提款动作
     * 对前端会员传递过来的参数进行验证
     * 验证规则：格式，真实姓名，余额，打码量。
     * @return type
     */
    public function actionTikuan()
    {
        $model = new WithdrawPwdForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews = Yii::$app->request->post()
        ];

        if (!$model->load($this->_data) || !$model->validate()) {
            $msg = $model->getErrors();

            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    return $this->out(false, $value);    // 返回表单验证的错误信息
                }
            }
        }

        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $user = UserList::getUserNewsByUserId($user_id);

        // 获取用户信息,先行判斷相關驗證
        if ($user['mz'] != md5($user['pay_name'])) {
            return $this->out(false, '真实姓名异常，请联系客服！');
        }

        $qk_pass = $postNews['qk_pwd'];

        if ($user['money'] < $postNews['pay_value']) {
            return $this->out(false, '余额不足');
        }

        if ($user['qk_pass'] != md5($qk_pass)) {
            return $this->out(false, '取款密码错误');
        }

        $kl8 = UserList::getLottery_kl8($user_id);

        if (! $kl8) {
            return $this->out(false, '该账户存在异常订单，不予提款，详情请联系客服');
        }

        /**
         * 20191227 更新打碼量算法
         * 取打碼log裡的更新日期當計算起點 現在時間當終點
         * 計算這段時間的總下注額以及總存款額(包括後台人工新增)
         * 兩個金額做比較
         */
        $userdama['dama_value'] = 0;
        $userdama['order_time'] = $user['regtime'];

        // 取最後一次提款紀錄
        $money = Money::find()
            ->where(['type' => ['用户提款']])
            ->andWhere(['status' => '成功'])
            ->andWhere(['user_id' => $user_id])
            ->orderBy(['update_time' => SORT_DESC])
            ->asArray()
            ->one();

        if ($money) {
            $userdama['order_time'] = $money['update_time'];
        }

        $userDama = UserDama::find()
            ->where(['user_id' => $user_id])
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
            ->andWhere(['user_id' => $user_id])
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

        $dama = $money['money'] * $drawing_odds['drawing_odds'] + $userdama['dama_value'];
        $r = $this->_getCondition($user_id, $userdama['order_time']);

        if ($r < $dama) {
            $damaLog = new UserDamaLog();
            $damaLog->user_id = $user_id;
            $damaLog->type = '用户提款';
            $damaLog->drawing_odds = $drawing_odds['drawing_odds'];
            $damaLog->dama_old = $r;
            $damaLog->dama_new = $r;
            $damaLog->dama_value_old = $dama;
            $damaLog->dama_value_new = $dama;
            $damaLog->order_time = $userdama['order_time'];
            $damaLog->create_time = date('Y-m-d H:i:s');
            $damaLog->save();

            return $this->out(false, '打码量不足');
        }

        /* 20191227 更新打碼量算法
        $update_time = Money::find()->select(['order_value','update_time'])
            ->where(['type'=>['后台充值','银行汇款','在线支付']])
            ->andWhere(['status'=>'成功'])
            ->andWhere(['user_id'=>$user_id])
            ->orderBy(['update_time'=>SORT_DESC])
            ->limit(1)
            ->asArray()
            ->one();
        if(empty($update_time)){
            return $this->out(false,'打码量不足');
        }
        $r = $this->_getCondition($user_id,$update_time['update_time']);
        $drawing_odds = UserGroup::find()->select('drawing_odds')->where(['group_id'=>$user['group_id']])->asArray()->one();
        if($r < $update_time['order_value']*$drawing_odds['drawing_odds']){
            return $this->out(false,'打码量不足');
        }
        */
        // $a = MoneyLog::find()
        //     ->select('count(id) as num')
        //     ->where(['and', ['>', 'update_time', date("Y-m-d h:i:s", strtotime("-1 day"))], ['<', 'update_time', date('Y-m-d h:i:s',time())]])
        //     ->andWhere(['<', 'order_value',0])
        //     ->asArray()
        //     ->one();
        // if ($a['num'] > 2) {
        //     return $this->out(false, '24小时之内只能提款3次！');
        // }

        $r1 = Money::addTKorder($user, $postNews['pay_value']);

        if ($r1) {
            $r2 = UserList::saveMoney($user_id, $postNews['pay_value']);

            if ($r2) {
                MoneyLog::addMoenyLog($user_id, $user['user_name'], $postNews['pay_value'], $user['money']);

                if ($userDama) {
                    $userDama->dama_value = 0;
                    $userDama->order_time = date('Y-m-d H:i:s');
                    $userDama->save();
                } else {
                    $insert = new UserDama();
                    $insert->user_id = $user_id;
                    $insert->dama_value = 0;
                    $insert->order_time = date('Y-m-d H:i:s');
                    $insert->save();
                }

                $money = Money::find()
                    ->where(['type' => ['用户提款']])
                    ->andWhere(['user_id' => $user_id])
                    ->orderBy(['update_time' => SORT_DESC])
                    ->asArray()
                    ->one();

                $damaLog = new UserDamaLog();
                $damaLog->user_id = $user_id;
                $damaLog->type = '用户提款';
                $damaLog->order_num = $money['order_num'];
                $damaLog->drawing_odds = $drawing_odds['drawing_odds'];
                $damaLog->dama_old = $r;
                $damaLog->dama_new = 0;
                $damaLog->dama_value_old = $dama;
                $damaLog->dama_value_new = 0;
                $damaLog->order_time = $userdama['order_time'];
                $damaLog->create_time = date('Y-m-d H:i:s');
                $damaLog->save();

                return $this->out(true, '提交成功！');
            }

            return $this->out(false, '金额变动失败');
        }

        return $this->out(false, '添加取款订单失败');
    }

    /**
     * 获取打码量方法  （后期由各自模块人员提供）
     * @param $userid
     * @param $update_time
     * @return string
     */
    public function _getCondition($userid,$update_time){
        $touzhu1 = 0;
        // $rs1 = (new \yii\db\Query())->select('sum(bet_money) as s')->from("k_bet")->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
        //     ->andWhere(['status' => [1, 2, 4, 5]])->limit(1)->one(); //体育单式注单总金额
        // if (!$rs1 || !$rs1["s"]) {
        //     $touzhu1 = 0;
        // } else {
        //     $touzhu1 = $rs1["s"];
        // }
        $rs2 = OrderLottery::find()->select(['sum(bet_money) as s'])->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2]])->limit(1)->asArray()->one(); //彩票注单总金额
        if (!$rs2 || !$rs2["s"]) {
            $touzhu2 = 0;
        } else {
            $touzhu2 = $rs2["s"];
        }
        $rs3 = SixLotteryOrder::find()->select(['sum(bet_money_total) as s'])->where(['user_id' => $userid])->andWhere(['>', 'bet_time', $update_time])
            ->andWhere(['status' => [1, 2]])->limit(1)->asArray()->one(); //六合彩投注总金额
        if (!$rs3 || !$rs3["s"]) {
            $touzhu3 = 0;
        } else {
            $touzhu3 = $rs3["s"];
        }
        $touzhu4 = 0;
        // $rs4 = (new \yii\db\Query())->select('sum(bet_money) as s')->from("k_bet_cg_group")->where(['user_id' => $userid])
        //     ->andWhere(['>', 'bet_time', $update_time])->andWhere(['status' => [1, 2]])->limit(1)->one(); //体育串关投注总金额
        // if (!$rs4 || !$rs4["s"]) {
        //     $touzhu4 = 0;
        // } else {
        //     $touzhu4 = $rs4["s"];
        // }
        $rs = LiveUser::find()->select(['live_username'])->where(['user_id' => $userid])->andWhere(['live_type' => 'AG'])->asArray()->one();
        $rs5 = LiveOrder::find()->select(["IFNULL(SUM(IF(live_order.valid_bet_amount>0,live_order.valid_bet_amount,0)),0) s"])->where(['live_username' => $rs['live_username']])
            ->andWhere(['>', 'order_time', $update_time])->asArray()->one();  //真人投注总金额
        if (!$rs5 || !$rs5["s"]) {
            $touzhu5 = 0;
        } else {
            $touzhu5 = $rs5["s"];
        }
        $lottery_he = OrderLottery::getHe($update_time,date('Y-m-d H:i:s'),$userid);
        $six_he = SixLotteryOrder::getDrawSum($userid,$update_time,date('Y-m-d H:i:s'));
        $condition = sprintf("%.2f", ($touzhu1 + $touzhu2 + $touzhu3 + $touzhu4 + $touzhu5 -$lottery_he - $six_he));
        return $condition;
    }

}