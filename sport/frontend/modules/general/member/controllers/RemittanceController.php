<?php
namespace app\modules\general\member\controllers;

use app\modules\core\common\filters\LoginFilter;
use app\modules\core\common\filters\UserFilter;
use app\modules\general\member\models\ar\SysConfig;
use Yii;
use app\common\base\BaseController;
use app\modules\general\member\models\ar\UserList;
use app\modules\general\member\models\BankTransaction\Money;
use app\modules\general\member\models\BankTransaction\SysHuikuanList;
use app\modules\general\member\models\RemittanceForm;
use yii\helpers\ArrayHelper;

/**
 * 银行汇款
 * RemittanceController 
 */
class RemittanceController extends BaseController {
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
        
        $this->getView()->title = '银行汇款存款';
        $this->layout = 'main';
    }

    public function behaviors(){
        return ArrayHelper::merge([
            [
                'class' => LoginFilter::className(),
                'only' => ['remittancedo']
            ],
            [
                'class' => UserFilter::className(),
                'only' => ['remittancedo']
            ],
        ], parent::behaviors());
    }

    /**
     * 主页 (汇款页面) 
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户信息，传至汇款页面（会员资料信息，最低汇款金额）
     * 20190108 : 根據會員群組做分類， 查詢使用 like  |id|  
     */
    public function actionIndex(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }
        
        $uid = $this->_session[$this->_params['S_USER_ID']];
        
        $username = UserList::getUserNewsByUserId($uid);                        //获取用户名
        $arr = SysHuikuanList::find()->where(['like', 'group_set', '|'.$username['group_id'].'|'])->andwhere(['bank_status'=>'1'])->asArray()->all();
        $username = $username['user_name'];
        $sysconfig=SysConfig::find()->limit(1)->one();
        return $this->render('index', ['arr'=>$arr,'username'=>$username,'min_huikuan_money'=>$sysconfig['min_huikuan_money']]);
    }

    /**
     * 网银:1 微信:2 支付宝:3 財付通:4
     * 主页 (汇款页面)
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户信息，传至微信支付宝页面
     *  20190108 : 根據會員群組做分類， 查詢使用 like  |id| ，無項目則該組別不顯示
     */
    public function actionIndex2(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }
        
        $uid = $this->_session[$this->_params['S_USER_ID']];

        $username = UserList::getUserNewsByUserId($uid);                        //获取用户名
        // $arr = SysHuikuanList::getHuikuanList($username['group_id']);

        $arr = SysHuikuanList::find()->where(['like', 'group_set', '|'.$username['group_id'].'|'])->andwhere(['bank_status'=>'1'])->asArray()->all();

        $weixin = SysHuikuanList::find()->where(['like', 'group_set', '|'.$username['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '2'])->asArray()->all();
        $zfb = SysHuikuanList::find()->where(['like', 'group_set', '|'.$username['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '3'])->asArray()->all();
        $cft = SysHuikuanList::find()->where(['like', 'group_set', '|'.$username['group_id'].'|'])->andwhere(['bank_status'=>'1'])->andwhere([ 'bank_type' => '4'])->asArray()->all();

        $username = $username['user_name'];
        $sysconfig=SysConfig::find()->limit(1)->one();
        return $this->render('index2', ['arr'=>$arr, 'weixin'=>$weixin, 'zfb'=>$zfb, 'cft'=>$cft, 'username'=>$username,'min_huikuan_money'=>$sysconfig['min_huikuan_money']]);
    }
    /**
     * 汇款支付动作
     * 会员提交汇款信息，验证信息后，生成对应的订单，对会员金额进行操作
     * @return json
     */
    public function actionRemittancedo(){
        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $model = new RemittanceForm();
        $formName = (string) $model->formName();
        $this->_data = [
            $formName => $postNews = Yii::$app->request->post()
        ];
        if (!$model->load($this->_data) || !$model->validate()) {
            $msg = $model->getErrors();
            foreach ($msg as $k => $v) {
                foreach ($v as $key => $value) {
                    return $this->out(false,$value);
                }
            }
        }
        foreach ($postNews as $k=>$v){
            $postNews[$k] = $this->_getNewString($v);
        }
        if($postNews['InType'] == '网银转账'){
            $postNews['InType'] .= "=>持卡人姓名：".$postNews["v_Name"];
        }elseif($postNews['InType'] == '0'){
            $postNews['InType'] = $postNews["IntoType"];
        }elseif($postNews['InType'] == 'ZFB'){
            $postNews['IntoBank'] = "支付宝";
            $postNews['InType'] = "支付宝支付=>支付宝帐号：".$postNews["v_Name"]."  支付方姓名=》".$postNews['v_name2'];
        }elseif($postNews['InType'] == 'WX'){
            $postNews['IntoBank'] = "微信";
            $postNews['InType'] = "微信支付=>微信帐号：".$postNews["v_Name"]."  支付方姓名=》".$postNews['v_name2'];
        }elseif($postNews['InType'] == 'CFT'){
            $postNews['IntoBank'] = "财付通";
            $postNews['InType'] = "财付通支付=>财付通帐号：".$postNews["v_Name"]."  支付方姓名=》".$postNews['v_name2'];
        }else{
            $postNews['InType'] .= "=>汇款人姓名：".$postNews["v_Name"];
        }
        $user = UserList::getUserNewsByUserId($user_id);                        //获取用户金额
        $user_money = $user['money'];
        $user_name = $user['user_name'];
        $r = Money::addHKorder($user_id,$user_name,$user_money, $postNews);     //汇款动作
        if($r){
            return $this->out(true);
        }
        return $this->out(false,'操作失败');
    }

    public function _getNewString($string){
        $arr = str_split($string);
        foreach($arr as $k=>$v){
            if($v == '>'){
                $arr[$k] = 'gt';
            }else if ($v == '<'){
                $arr[$k] = 'lt';
            }
        }
        return implode('',$arr);
    }
}