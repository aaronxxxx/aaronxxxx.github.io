<?php
namespace app\modules\core\site\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\core\common\models\UserList;
use app\modules\core\common\models\SysConfig;

/**
 * Index controller
 */
class IndexController extends BaseController
{
    private $_session = null;
    private $_params = null;

    /**
     * 初始化方法
     */
    public function init()
    {
        parent::init();

        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;

        if (isset($_SESSION['S_AGENT_ID'])) {
            Yii::$app->session[Yii::$app->params['S_AGENT_ID']] = $_SESSION['S_AGENT_ID'];
        }

        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $uid = Yii::$app->session[Yii::$app->params['S_USER_ID']];
            $oid = Yii::$app->session[Yii::$app->params['S_USER_OID']];
            $data = UserList::find()
                ->where(['user_id' => $uid])
                ->one();

            if ($data) {
               $data->logouttime = date('Y-m-d H:i:s');

                if ($data['status'] != '正常') {
                    $data->Oid = '';
                }

                $data->save();
            }

            if ($oid != $data['Oid']) {
                Yii::$app->session->remove(Yii::$app->params['S_USER_ID']);
                Yii::$app->session->remove(Yii::$app->params['S_USER_OID']);
            }
        }
    }

    public function beforeAction($action)
    {
        $sysConfig = SysConfig::find()->one();

        if (!empty($sysConfig) && !empty($sysConfig['close']) && $sysConfig['close'] == 1) {
            $this->redirect('?r=site/close');
            return false;
        }

        return parent::beforeAction($action);
    }

    // 首頁
    public function actionIndex()
    {
        return $this->render('index');
    }

    // 會員登入頁
    public function actionLogin()
    {
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $this->redirect('?r=member/index/index');
        }

        return $this->render('login');
    }

    // 會員註冊頁
    public function actionReg()
    {
        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            $this->redirect('?r=member/index/index');
        }

        $agentname = Yii::$app->request->get('agentname');

        $sysConfig = SysConfig::find()->one();
        $register_phone = $sysConfig['register_phone'];
        $register_qq = $sysConfig['register_qq'];
        $register_email = $sysConfig['register_email'];
        $register_name = $sysConfig['register_name'];

        return $this->render('reg', [
            'agentname' => $agentname,
            'register_phone' => $register_phone,
            'register_qq' => $register_qq,
            'register_email' => $register_email,
            'register_name' => $register_name
        ]);
    }
}
