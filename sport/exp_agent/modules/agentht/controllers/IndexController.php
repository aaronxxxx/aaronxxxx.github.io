<?php
namespace app\modules\agentht\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\modules\agentht\models\AgentsList;

class IndexController extends Controller {
    
    private $_resp = [];

    public function init() {//初始化函数
        parent::init();
        $this->enableCsrfValidation = false;                                                //关闭表单验证
        $this->layout = 'main';
        $this->_resp = [
            'code' => 0, //code :  0 成功，1 失败
            'data' => [],
            'msg' => ''
        ];
    }
    
    /**
     * 代理后台首页
     */
    public function actionIndex() {
        if(!empty(Yii::$app->session['S_AGENT_ID'])){
            return $this->redirect('/?r=agentht/agent/agents-list');
        }else{
            return $this->redirect('/?r=agentht/agent/index');
        }
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
                'height' => 40, // 高度
                'width' => 106, // 宽度
                'foreColor' => 0xffffff, // 字体颜色
                'offset' => 4, // 设置字符偏移量 有效果
                'transparent' => true, // 显示为透明，当关闭该选项，才显示背景颜色
//                'controller' => 'login',                                        // 拥有这个动作的controller
            ],
        ];
    }
}
