<?php
namespace app\modules\general\member\controllers;

use Yii;
use yii\data\Pagination;
use app\common\base\BaseController;
use app\modules\general\member\models\News\SysAnnouncement;

/**
 * 公告中心---最新信息
 * AnnouncementController
 */
class AnnouncementController extends BaseController {
    
    public function init() {
        parent::init();

        $this->layout = 'main';
    }
    /**
     * 会员中心 最新信息
     * 判断登入状态，未登入时，跳转至，未登入提示页面
     * 登入后，获取用户信息，传至最新信息页面
     * @return type
     */
    public function actionNew() {
        if (!Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
            return $this->redirect('no_login.php');
        }
        $msg = SysAnnouncement::getNotice();
        $new = $msg->asArray()->all();
        $pages = '';
        if(empty($new[0])){
            $msg = array('0'=>array('content'=>''));//当无符合条件的公告信息时返回该数组
        }else{
            $pages = new Pagination(['totalCount' => count($msg->asArray()->all()), 'pageSize' => 10]);
            $msg = $msg->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        }
        return $this->render('new', ['msg' => $msg,'pages'=>$pages]);
    }
    /**
     * 最新公告信息(公告栏使用)
     * @return type
     */
    public function actionNotice(){
        $this->layout = false;
        $msg = SysAnnouncement::getNotice();
        if(empty($msg)){
            $msg = array('0'=>array('content'=>''));//当无符合条件的公告信息时返回该数组
        }else{
            $msg = $msg->asArray()->all();
        }
        return $this->render('notice', ['msg' => $msg]);
    }
}