<?php
namespace app\modules\general\mobile\controllers;

use app\modules\core\common\models\LoginState;
use app\modules\core\common\models\SysConfig;
use app\modules\general\mobile\models\user\UserList;
use app\modules\lottery\models\ar\WebClose;
use Yii;
use app\common\base\BaseController;

/**
 * IndexController
 */
class IndexController extends BaseController {
    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();
		LoginState::Check();
        $this->enableCsrfValidation = false;                                    // 关闭csrf验证
        $this->getView()->title = '手机界面';
        $this->layout = false;
    }
    public function actionJson(){
        $arr['name'] = '';
        $arr['msg'] = '';
        $sysconfig=SysConfig::find()->limit(1)->asArray()->one();
		if(isset($sysconfig['service_url'])){
        	$arr['zzkf'] = $sysconfig['service_url'];
		}elseif(isset($sysconfig['serviceurl'])){
			$arr['zzkf'] = $sysconfig['serviceurl'];
		}else{
			$arr['zzkf']='';
		}
        $arr['web_name'] = $sysconfig['web_name'];
        $arr['pcClient'] = "http://".$_SERVER['HTTP_HOST']."/?r=site/index&code=1";
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
            $oid = Yii::$app->session[Yii::$app->params['S_USER_OID']];
            $usernews = UserList::getUserNewsByUserID($uid);
            $arr['name'] = $usernews['user_name'];
            $arr['money'] = $usernews['money'];
            $arr['pay_name'] = $usernews['pay_name'];
            $arr['day'] = date("Y-m-d");
            $arr['day2'] = date("H");
            $arr['day3'] = date("i");
            $arr['day4'] = date("s");
            if($oid != $usernews['Oid']){
                Yii::$app->session->remove(Yii::$app->params['S_USER_ID']);
                Yii::$app->session->remove(Yii::$app->params['S_USER_OID']);
                $arr['name'] = '';
                $arr['money'] = '';
                $arr['pay_name'] = '';
                $arr['msg']='账号长期未操作强制登出！';
            }
        }
        return json_encode($arr);
    }
    public function actionIsLogin(){
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $getNews = Yii::$app->request->get();
            if($getNews['code'] == 1){//财务中心
                return $this->redirect('/?r=mobile/financial/index');
            }
            if($getNews['code'] == 2){//贵宾报表
                return $this->redirect('/?r=mobile/financial/vip');
            }
        }
        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
        echo '<script language="javascript" charset="utf-8">';
        echo 'alert("对不起请先登陆！");window.location.href="/?r=mobile/disp/login"';
        echo '</script>';
    }
    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaNewAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor' => 0x42261F, // 背景颜色
                'maxLength' => 4, // 最大显示个数
                'minLength' => 4, // 最少显示个数
                'padding' => 2, // 间距
                'height' => 45, // 高度
                'width' => 106, // 宽度
                'foreColor' => 0xffffff, // 字体颜色
                'offset' => 4, // 设置字符偏移量 有效果
                'transparent' => false, // 显示为透明，当关闭该选项，才显示背景颜色
            ],
        ];
    }
    public function actionAjaxgetwebclose(){
        $lottery_type = $_POST['lotter_type'];
        $Lottery_set = WebClose::getWebClose($lottery_type);
        return json_encode($Lottery_set);
    }
}