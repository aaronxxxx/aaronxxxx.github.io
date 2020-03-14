<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:56
 */

namespace app\modules\general\admin\controllers;

use app\modules\core\common\models\SysManageOnline;
use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use app\modules\general\admin\models\SysManageOnlineSearch;
use Yii;
use yii\base\Exception;
use app\common\helpers\UAUtils;

class OnlineController extends BaseController
{

    public function actionList() {
        $this->layout = false;
        $searchModel = new SysManageOnlineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionDelete() {
        try{
            $sessionstr = Yii::$app->request->post('sessionstr');
            $all = SysManageOnline::find()->where([
                'session_str' => $sessionstr
            ])->all();
            if(count($all) > 0) {
                foreach ($all as $one) {
                    $one->delete();
                }
            }
            return $this->out(true, "删除成功");
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, "删除失败");
        }
    }
    public function GetIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "none";
        }
        return $cip;
    }

    public function actionCheck() {
        try{
            $ssid = Yii::$app->getSession()->get('ssid');
            $ip = $this->GetIP();
            $loginbrowser = UAUtils::getClientBrowser();
            $user = SysManageOnline::find()->where([
                'session_str' => $ssid,
                'loginip'=>$ip,
                'loginbrowser'=>$loginbrowser
            ])->one();
            if(empty($user)){
                Yii::$app->user->logout(true);
                return $this->outCode(true, null, -1);
                
            } else {
                return $this->outCode(true, null, 1);
            }
        }catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, null);
        }
    }

}