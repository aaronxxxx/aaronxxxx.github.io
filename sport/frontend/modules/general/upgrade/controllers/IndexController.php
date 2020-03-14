<?php

namespace app\modules\general\upgrade\controllers;

use Alchemy\Zippy\Zippy;
use app\common\base\BaseController;
use app\common\helpers\LogUtils;
use Exception;
use Yii;

class IndexController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->layout = false;
    }

    public function actionIndex() {
        $update = false;
        $version = file_get_contents(Yii::$app->basePath."/config/version");
        $xml = simplexml_load_file($this->module->params['upgradeUrl']);
        $updateVersion = $xml->frontend->version;
        if($version < $updateVersion) {
            $update = true;
        }
        return $this->render('index', [
            'version'=>$version,
            'updateVersion'=>$updateVersion,
            'update'=>$update
        ]);
    }

    public function actionUpdate() {
        try {
            $version = file_get_contents(Yii::$app->basePath."/config/version");
            $xml = simplexml_load_file($this->module->params['upgradeUrl']);
            $updateVersion = $xml->frontend->version;
            if($version < $updateVersion) {
                $url = $xml->frontend->url;
                $filename = time();
                file_put_contents("file/$filename.zip", file_get_contents($url));
                $zippy = Zippy::load();
                $archive = $zippy->open("file/$filename.zip");
                $archive->extract('../');
                file_put_contents(Yii::$app->basePath."/config/version", $updateVersion);
                return $this->out(true, '更新成功');
            } else {
                return $this->out(true, '当前版本是最新版本');
            }
        } catch (Exception $e) {
            LogUtils::error_log($e);
            return $this->out(false, '更新失败');
        }
    }
}