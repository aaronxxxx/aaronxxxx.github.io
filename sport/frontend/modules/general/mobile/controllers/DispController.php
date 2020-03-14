<?php
namespace app\modules\general\mobile\controllers;

use Yii;
use app\common\base\BaseController;
use yii\data\Pagination;
use app\modules\general\member\models\ar\SysConfig;
use app\modules\general\mobile\models\ThemeSetting;    //樣式設定(輪播圖片)
use app\modules\general\mobile\models\user\UserList;
use app\modules\event\models\EventOfficial;
use app\modules\event\models\EventPlayer;
use app\modules\event\models\EventTwopk;
use app\modules\event\models\EventMultiple;
use app\modules\event\models\EventMultipleOdds;
use app\modules\event\models\EventOrder;
/**
 * IndexController
 */
class DispController extends BaseController {
    public $enableCsrfValidation = false;
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
        $this->getView()->title = '手机登陆注册页面';
        $this->layout = 'main';
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
	//注册
    public function actionRegister(){
        $this->layout = 'login';
        $sysConfig = SysConfig::find()->one();
        $register_phone = $sysConfig['register_phone'] != '1' ? '0':'1';;
        $register_qq = $sysConfig['register_qq'] != '1' ? '0':'1';
        $register_email = $sysConfig['register_email'] != '1' ? '0':'1';;
        $register_name = $sysConfig['register_name'] != '1' ? '0':'1';;
        $agentname = Yii::$app->request->get('agentname');

        return $this->render('register',[
            'register_phone'=>$register_phone,
            'register_qq'=>$register_qq,
            'register_email'=>$register_email,
            'register_name'=>$register_name,
            'agentname' => $agentname
        ]);
    }

    public function actionIndex(){//移动端首页
        $sysconfig=SysConfig::find()->limit(1)->one();
        $sysconfig['service_qq'] = isset($sysconfig['service_qq']) ? $sysconfig['service_qq'] :'';
        $sysconfig['app_qrcode'] = isset($sysconfig['app_qrcode']) ? $sysconfig['app_qrcode'] :'';
        $banner = ThemeSetting::getBanner();   //取得輪播圖
        $banner = count($banner) >0 ?  $banner  :[];//判斷輪播圖是否為空
        $app_qrcode = $sysconfig['app_qrcode'];   //取得QRcode
        $app_qrcode = count($app_qrcode) >0 ? $app_qrcode  :'/public/aomen/images/index/coming.png'; //判斷qrcode是否為空值
        return $this->render('index',[
            'service_qq'=>$sysconfig['service_qq'], //客服QQ
            'banner' => $banner, // 輪播
            'app_qrcode' => $app_qrcode, //QRcode
        ]);
    }
/**
* 優惠活動
*/
public function actionActivity(){
    $offer_activity = ThemeSetting::getActivity();   //取得優惠活動
    $offer_activity = count($offer_activity) >0 ?  $offer_activity  :[];//判斷優惠活動是否沒資料
    return $this->render('activity',[
        'offer_activity' => $offer_activity,
    ]);
}
    /**
    *登陆操作
    */
    public function actionLogin(){
        $this->layout = 'login';
        $params = Yii::$app->request->get();
		$gourl='';
        $name = '';
        $talk_user = '';
		if(isset($params['url'])&&!empty($params['url'])){
                    $gourl = $params['url'];
		}

        if(isset($_GET['talk_user'])&&!empty($_GET['talk_user'])){
            $talk_user = $_GET['talk_user'];
            //checkout $talk_user take name
            $userList = UserList::findOne(['auth_talk' => $talk_user]);
            if(isset($userList['user_name'])&&!empty($userList['user_name'])){
                $name = $userList['user_name'];
            }
        }

		return $this->render('login',array('gourl'=>$gourl,'name'=>$name,'talk_user'=>$talk_user));
    }
    /**
    * 游戏中心
    */
    public function actionGameCenter(){//遊戲中心
        $sysconfig=SysConfig::find()->limit(1)->one();
        $sysconfig['service_url'] = isset($sysconfig['service_url']) ? $sysconfig['service_url'] :'#';
        $this->layout = 'member';
        // 判斷後台客服是否有填 http://
        if(strpos($sysconfig['service_url'],'http')  !== false){
            return $this->render('gamecenter',['zzkf'=>$sysconfig['service_url']]);
        }else{
            $sysconfig['service_url'] = 'http://'.$sysconfig['service_url'];
            return $this->render('gamecenter',['zzkf'=>$sysconfig['service_url']]);
        }
    }


    // 非投不可
    public function actionFtbk()
    {
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
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

        return $this->render('ftbk', [
            'qishu' => $qishu
        ]);
    }

    // 非投不可歷史紀錄
    public function actionFtbkHistory()
    {
        $this->layout = false;

        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }

        $userId = Yii::$app->session->get('uid');
        $date = Yii::$app->request->get('date', '');

        $eventPlayer = EventPlayer::find()
            ->asArray()
            ->all();

        foreach ($eventPlayer as $key => $val) {
            $player[$val['id']] = $val['title'];
        }

        //待優化
        $eventOrder = EventOrder::getAllByUserPagination($userId, $date);

        if (!$eventOrder) {
            echo "
                <script>
                    alert('您尚未有投注纪录');
                    window.close();
                </script>";
            exit;
        }

        $pages = new Pagination([
            'totalCount' => $eventOrder->count(),
            'pageSize' => 5
        ]);
        $list = $eventOrder
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();

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

        return $this->render('ftbkhistory', [
            'pages' => $pages,
            'date' => $date ? '日期：' . $date : null,
            'list' => $list
        ]);
    }
}
