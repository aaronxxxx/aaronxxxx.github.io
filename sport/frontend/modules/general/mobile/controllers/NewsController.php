<?php

namespace app\modules\general\mobile\controllers;

use Yii;
use app\common\base\BaseController;
use app\modules\general\mobile\models\user\UserList;
use app\modules\general\mobile\models\News\SysAnnouncement;
use app\modules\general\mobile\models\News\UserMsg;

/**
 * IndexController
 */
class NewsController extends BaseController {
    private $_session = null;
    private $_params = null;

    /**
     * 初始化处理方法
     */
    public function init() {
        parent::init();

        $this->getView()->title = '手机界面';
        $this->_session = Yii::$app->session;
        $this->_params = Yii::$app->params;
        $this->layout = 'member';
    }
    
    public function actionNews(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo '<script language="javascript" charset="utf-8">';
            echo 'alert("对不起请先登陆！");window.location.href="/?r=mobile/disp/login"';
            echo '</script>';
        }
        $msg = SysAnnouncement::getNotice();                                    //系统信息
        $uid = $this->_session[$this->_params['S_USER_ID']];
//        $usernews = UserList::getUserNewsByUserID($uid);
        $arr = UserMsg::getUserMassageList($uid);       
        $msg2 = $arr[0];                                                        //个人信息
        $page_list = $arr[1];
        foreach ($msg2 as $key => $value) {
            if($value['islook'] == 0){
                $msg2[$key]['islook'] = '未读';
            }else{
                $msg2[$key]['islook'] = '已读';
            }
        }
        return $this->render('News',['msg'=>$msg,'msg2' => $msg2,'page_list'=>$page_list]);
    }
    
    public function actionOneNew(){
        if (!$this->_session->has($this->_params['S_USER_ID'])) {
            return $this->redirect('/?r=mobile/disp/index');
        }
        $code = Yii::$app->request->get('code');
        $mid = Yii::$app->request->get('mid');
        if($code == 1){
            $msg = SysAnnouncement::getNoticeById($mid);
            return $this->render('onenotic', ['msg' => $msg]);
        }
        if($code == 2){
            $msg = UserMsg::getOneMsg($mid);
            $r = UserMsg::updateMsgislook($mid);
            if($r){ return $this->render('onenew', ['msg' => $msg]);}
        }
        return '查看失败';
    }
    /**
     * 删除单个信息
     */
    public function actionDel(){
        $mid = Yii::$app->request->get('mid');
        $r = UserMsg::delMsg($mid);
        if($r){
            $this->redirect('/?r=mobile/news/news');
        }else{
            return '删除失败';
        }
    }
}
