<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\message\controllers;

use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use app\modules\general\message\models\SysAnnouncement;
use app\modules\general\message\models\SysAnnouncementSearch;
use Yii;
use yii\base\Exception;

class BulletinController extends BaseController
{
    public $layout = false;

    public function actionIndex() {
        $model = new SysAnnouncement();
        $id = Yii::$app->request->get('id');
        $model->is_show = 1;
        if($id != null) {
            $model = $this->findModel($model, $id);
        }
        return $this->render("index", [
            'model' => $model
        ]);
    }

    public function actionAdd() {
        try{
            $model = new SysAnnouncement();
            $params = Yii::$app->request->bodyParams;
            if(isset($params['id']) && $params['id'] != "") {
                $model = $this->findModel($model, $params['id']);
            }
            $model->load(Yii::$app->request->post(), '');
            $model->save();
            return $this->out(true, null);
        }catch (Exception $e){
            LogUtils::error($e->getMessage());
            return $this->out(false, '保存失败');
        }
    }

    public function actionList() {
        $searchModel = new SysAnnouncementSearch();
        $type = Yii::$app->request->get('type','');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$type);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'type' => $type
        ]);
    }

    public function actionDelete() {
        try{
            $model = new SysAnnouncement();
            $sysAnnouncement = $this->findModel($model, $this->getParam('id'));
            $sysAnnouncement->delete();
            return $this->out(true, "删除成功");
        }catch (Exception $e) {
            return $this->out(false, "删除失败");
        }
    }

    public function actionAllDelete() {
        $ids = $this->getParam("ids");
        if($ids != null) {
            $ids = explode(",", $ids);
            if(count($ids) > 0) {
                SysAnnouncement::deleteAll(['id'=>$ids]);
            }
        }
        return $this->out(true, "删除成功");
    }

}