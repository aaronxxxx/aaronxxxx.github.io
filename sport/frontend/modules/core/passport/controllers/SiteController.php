<?php
namespace app\modules\core\passport\controllers;

use app\common\base\BaseController;
use app\common\helpers\MobileDetect;
use app\modules\core\common\models\SysConfig;
use app\modules\core\common\models\UserList;
use app\modules\core\passport\models\ThemeSetting;
use app\modules\event\models\EventOfficial;
use app\modules\event\models\EventPlayer;
use app\modules\event\models\EventTwopk;
use app\modules\event\models\EventMultiple;
use app\modules\event\models\EventMultipleOdds;
use app\modules\event\models\EventOrder;
use Yii;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    private $_session = null;
    private $_params = null;

    /**
     * 初始化方法
     */
     public function init() {
        parent::init();
        $url = $this->_prefix_url();
        $arr = explode('.',$url);
        if(isset($arr[3])){
            $port = explode(':',$arr[3]);
            if(!isset($port[1])){
                //echo '访问方式为IP+80端口';
                //exit;
            }

        }

        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        if(isset($_SESSION['S_AGENT_ID'])){
            Yii::$app->session[Yii::$app->params['S_AGENT_ID']] = $_SESSION['S_AGENT_ID'];
        }
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
            $oid = Yii::$app->session[Yii::$app->params['S_USER_OID']];
            $data = UserList::find()
                ->where(['user_id' => $uid])
                ->one();
            if($data){
               $data->logouttime = date('Y-m-d H:i:s');
                if($data['status'] != '正常'){
                    $data->Oid = '';
                }
                $data->save();
            }
            if($oid != $data['Oid']){
                Yii::$app->session->remove(Yii::$app->params['S_USER_ID']);
                Yii::$app->session->remove(Yii::$app->params['S_USER_OID']);
            }
        }
    }

    public function beforeAction($action)
    {
        $sysConfig = SysConfig::find()->one();
        if(!empty($sysConfig) && !empty($sysConfig['close']) && $sysConfig['close'] == 1) {
            $this->redirect('?r=passport/close');
            return false;
        }
        return parent::beforeAction($action);
    }

    /**
     * 主页
     */
    public function actionIndex($ua=''){
        //$cookies = Yii::$app->request->cookies;
        if (isset($_COOKIE['deviceType'])) {
            $deviceType = $_COOKIE['deviceType'];
        }else{
            $detect=new MobileDetect();
            $deviceType = ($detect->isMobile() ? 'M':'PC');
        }
        if(isset($_GET['code'])){

            $deviceType = 'PC';
        }
        if($deviceType=='M'){//移动版
            $this->redirect('/?r=mobile/disp/index');
        }else{//PC版
            //$this->layout = false;
            return $this->render('index');
        }
    }

    //新運彩
    public function actionEvent()
    {
        if (! Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }

        // 期數判斷該顯示哪個賽事
        $qishu = Yii::$app->request->get('qishu');

        if (! $qishu) {
            $eventOfficial = EventOfficial::find()
                ->where(['status' => 1])
                ->andWhere(['<=', 'kaipan_time', date("Y-m-d H:i:s")])
                ->andWhere(['>=', 'fenpan_time', date("Y-m-d H:i:s")])
                ->orderBy(['kaipan_time' => SORT_DESC])
                ->asArray()
                ->one();

            $qishu = isset($eventOfficial['qishu']) ? $eventOfficial['qishu'] : null;
        }

        return $this->render('event', [
            'title' => '新運彩',
            'qishu' => $qishu
        ]);
    }

    //新運彩歷史紀錄
    public function actionEventHistory()
    {
        $this->layout = false;

        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }

        $userId = Yii::$app->session->get('uid');

        $eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();

        foreach ($eventPlayer as $key => $val) {
            $player[$val['id']] = $val['title'];
        }

        //待優化
        $list = EventOrder::getAllByUser($userId);

        if (!$list) {
            echo "
                <script>
                    alert('您尚未有投注纪录');
                    window.close();
                </script>";
            exit;
        }

        foreach ($list as $key => $val) {
            if ($val['game_type'] == 1) {
                $eventTwopk = EventTwopk::find()
                    ->where(['id' => $val['game_id']])
                    ->asArray()
                    ->one();

                $list[$key]['game_item_id'] = $player[$val['game_item_id']];

                if ($val['bet_handicap'] < 0 ) {
                    $list[$key]['rangfen'] = $player[$val['game_item_id']]. ' 让 ' . abs($val['bet_handicap']);
                } else {
                    if ($val['game_item_id'] == $eventTwopk['player1']) {
                        $list[$key]['rangfen'] = $player[$eventTwopk['player2']]. ' 让 ' . $val['bet_handicap'];
                    } else {
                        $list[$key]['rangfen'] = $player[$eventTwopk['player1']]. ' 让 ' . $val['bet_handicap'];
                    }
                }
           } else {
                $eventMultipleOdds = EventMultipleOdds::find()
                    ->where(['id' => $val['game_item_id']])
                    ->asArray()
                    ->one();

                $list[$key]['game_item_id'] = $eventMultipleOdds['title'];
           }
        }

        return $this->render('eventhistory', ['list' => $list]);
    }

    public function actionYoplayeven(){//YOPLAY EVEN
        return $this->render('yoplayeven',['title' => 'YOPLAY EVEN']);
    }

    public function actionLottery(){//彩票游戏
        return $this->render('lottery',['title' => '彩票游戏']);
    }

    public function actionPrelottery(){//彩票游戏前導頁
        return $this->render('prelottery',['title' => '彩票游戏']);
    }

    public function actionSix(){//香港彩票
        return $this->render('six',['title' => '六合彩']);
    }

	public function actionSpsix(){//极速六合彩
        return $this->render('spsix',['title' => '极速六合彩']);
    }
    public function actionSport(){//体育
        return $this->render('sport',['title' => '体育']);
    }

    public function actionGame(){//电子游艺
        return $this->render('game',['title' => '电子游艺']);
    }

    public function actionLive(){//真人娱乐
        return $this->render('live',['title' => '真人娱乐']);
    }

    public function actionActivity(){//优惠活动
        $list = [];
        $list = ThemeSetting::getAll();

        return $this->render('activity', ['title' => '优惠活动', 'list' => $list]);
    }

	  public function actionChessgame(){//棋類遊戲前導頁
        return $this->render('chessgame',['title' => '棋類遊戲']);
    }

	/*省多多*/
    public function actionDesign(){//免费设计
        return $this->render('design',['title' => '免费设计']);
    }

    public function actionPrice(){//免费报价
        return $this->render('price',['title' => '免费报价']);
    }

    public function actionCompany(){//装修案例
        return $this->render('company',['title' => '装修案例']);
    }

    public function actionRenderings(){//效果图
        return $this->render('renderings',['title' => '效果图']);
    }

    public function actionAgentjoin(){//代理加盟
        return $this->render('agentjoin',['title' => '代理加盟']);
    }

    /*
     * 注册
     */
    public function actionReg()
    {
        $agentname = Yii::$app->request->get('agentname');

        if (isset($_COOKIE['deviceType'])) {
            $deviceType = $_COOKIE['deviceType'];
        } else {
            $detect = new MobileDetect();
            $deviceType = ($detect->isMobile() ? 'M' : 'PC');
        }

        if (isset($_GET['code'])) {
            $deviceType = 'PC';
        }

        if ($deviceType == 'M') {
            // 移动版
            if ($agentname) {
                $this->redirect('/?r=mobile/disp/register&agentname=' . $agentname);
            } else {
                $this->redirect('/?r=mobile/disp/register');
            }
        } else {
            // PC版
            $sysConfig = SysConfig::find()->one();
            $register_phone = $sysConfig['register_phone'];
            $register_qq = $sysConfig['register_qq'];
            $register_email = $sysConfig['register_email'];
            $register_name = $sysConfig['register_name'];

            return $this->render('reg',[
                'title' => '注册',
                'register_phone' => $register_phone,
                'register_qq' => $register_qq,
                'register_email' => $register_email,
                'register_name' => $register_name,
                'agentname' => $agentname
            ]);
        }
    }

    /*
    *代理协议
    */
    public function actionDlxy(){
        return $this->render('dlxy',['title' => '代理协议']);
    }
    /*
    *责任博彩
    */
    public function actionProblem(){
        return $this->render('problem',['title' => '责任博彩']);
    }
    /*
    *常见问题
    */
    public function actionCjwt(){
        return $this->render('cjwt',['title' => '常见问题']);
    }
    /*
    *存款帮助
    */
    public function actionCk(){
        return $this->render('ck',['title' => '存款帮助']);
    }
    /*
    *取款帮助
    */
    public function actionQk(){
        return $this->render('qk',['title' => '取款帮助']);
    }
    /*
    *代理方案
    */
    public function actionDlhz(){
        return $this->render('dlhz',['title' => '代理方案']);
    }
    /*
    *联系我们
    */
    public function actionContact(){
        return $this->render('contact',['title' => '联系我们']);
    }
    /*
    *代理注册
    */
    public function actionDailizhuche(){
        return $this->render('dailizhuche',['title' => '代理注册']);
    }
    /*
    *忘记密码
    */
    public function actionWangjipwd(){
        return $this->render('wangjipwd',['title' => '忘记密码']);
    }
    /*
   *隐私政策
   */
    public function actionYszc(){
        return $this->render('yszc',['title' => '隐私政策']);
    }
    /*
    *备用网址
    */
    public function actionBywz(){
        $row = SysConfig::find()
            ->where(["id"=>1])
            ->one();
        return $this->render('bywz',['arr'=>$row,'title' => '备用网址']);
    }

    /*
    *关于我们
    */
    public function actionAboutus(){
        return $this->render('aboutus',['title' => '关于我们']);
    }


    /*
    *联系我们
    */
    public function actionLxwm(){
        return $this->render('lxwm',['title' => '联系我们']);
    }

    /*
    *代理注册
    */
     public function actionDailireg(){
        return $this->render('dailireg',['title' => '代理注册']);
     }

     /*
     *新手上路
     */
     public function actionXssl(){
        return $this->render('xssl',['title' => '新手上路']);
     }

    public function _prefix_url(){
        $port     = ($_SERVER['SERVER_PORT']==80) ? '' : ':'.$_SERVER['SERVER_PORT'];
        $server_name = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'].$port :
            getenv('SERVER_NAME').$port;
        return $server_name;
    }
    /*
    * 注册验证码方法
    * @return array
    */
    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaNewAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x42261F, // 背景颜色
                'maxLength' => 4, // 最大显示个数
                'minLength' => 4, // 最少显示个数
                'padding' => 2, // 间距
                'height' => 40, // 高度
                'width' => 106, // 宽度
                'foreColor' => 0xffffff, // 字体颜色
                'offset' => 4, // 设置字符偏移量 有效果
                'transparent' => false, // 显示为透明，当关闭该选项，才显示背景颜色
//                'controller' => 'login',                                        // 拥有这个动作的controller
            ],
        ];
    }
}
