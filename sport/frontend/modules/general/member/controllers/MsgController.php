<?php
namespace app\modules\general\member\controllers;

use Yii;
use app\common\base\BaseController;
use yii\data\Pagination;
use app\modules\general\member\models\News\UserMsg;

/**
 * 个人信息（阅读，删除）
 * MsgController
 */
class MsgController extends BaseController {
    private $_session = null;
    private $_params = null;
    
    public function init() {
        parent::init();

        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->layout = 'main';
    }

    /**
     * 主页
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户信息，传至信息显示页面
     */
    public function actionIndex(){
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }
        $user_id = $this->_session[$this->_params['S_USER_ID']];
        $arr = UserMsg::getUserMassageList($user_id);
        $pages = new Pagination(['totalCount' => count($arr->asArray()->all()), 'pageSize' => 10]);
        $msg = $arr->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        foreach ($msg as $key => $value) {
            if($value['islook'] == 0){
                $msg[$key]['islook'] = '未读';
            }else{
                $msg[$key]['islook'] = '已读';
            }
        }
        return $this->render('index', ['msg' => $msg,'pages'=>$pages]);
    }
    
    /**
     * 获取指定会员指定信息的详细内容
     */
    public function actionNews(){
        $mid = Yii::$app->request->get('mid');
        $data = UserMsg::getOneMsg($mid);
        $r = UserMsg::updateMsgislook($mid);
        if($r){ return $this->render('news', ['msg' => $data]);     }
        return '查看失败';
    }
    /**
     * 删除指定会员的单个信息
     */
    public function actionDel(){
        $mid = Yii::$app->request->get('mid');
        $r = UserMsg::delMsg($mid);
        if($r){ $this->redirect('/?r=member/msg/index');  }
        return '删除失败';
    }
}