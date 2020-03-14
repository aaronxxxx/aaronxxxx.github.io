<?php

namespace app\modules\core\install\controllers;

use app\modules\core\install\helpers\FileUtils;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class BaseController extends Controller
{

    public function init()
    {
        $this->layout = false;
        $file = Yii::$app->basePath."/install.lock";
        $requestUri = Yii::$app->request->url;
        if(file_exists($file) && (strpos($requestUri, "install/index/info") === false)) {
            $this->goBack('?r=install/index/info');
        }
    }

    public function checkServer() {
        $path = Yii::$app->basePath;
        $checkResult = [
            'server' => '',
            'phpver' => [PHP_VERSION, true],
            'webpath' => $path,
            'gd2' => ['', ''],
            'mysqli' => ['', ''],
            'pdo_mysql' => ['', ''],
            'exp_backend' => ['', ''],
            'chmod' => function_exists('chmod') ? true : false,
            'curl' => function_exists('curl_init') ? true : false,
            'allow_url_fopen' => (bool) ini_get('allow_url_fopen') ? true : false,
            'gethostbyname' => function_exists('gethostbyname') ? true : false,
        ];
        $serverArray = $GLOBALS[strtoupper("_SERVER")];
        if (isset($serverArray['SERVER_SOFTWARE'])) {
            $checkResult['server'] = $serverArray['SERVER_SOFTWARE'];
        }
        if (version_compare(PHP_VERSION, '5.5.0') < 0) {
            $checkResult['phpver'][1] = false;
        }
        if (function_exists("gd_info")) {
            $info = gd_info();
            $checkResult['gd2'][0] = $info['GD Version'];
            $checkResult['gd2'][1] = $checkResult['gd2'][0] ? true : false;
        }
        if (function_exists("mysqli_get_client_info")) {
            $checkResult['mysqli'][0] = strtok(mysqli_get_client_info(), '$');
            $checkResult['mysqli'][1] = $checkResult['mysqli'][0] ? true : false;
        }
        if (class_exists("PDO", false)) {
            if (extension_loaded('pdo_mysql')) {
                $checkResult['pdo_mysql'][0] = ' ';
                $checkResult['pdo_mysql'][1] = $checkResult['pdo_mysql'][0] ? true : false;
            }
        }
        $s = FileUtils::GetFilePerms($path);
        $o = FileUtils::GetFilePermsOct($path);
        $checkResult['exp_backend'][0] = $s . ' | ' . $o;
        if (substr($s, 0, 1) == '-') {
            $checkResult['exp_backend'][1] = (substr($s, 1, 1) == 'r' && substr($s, 2, 1) == 'w' && substr($s, 4, 1) == 'r' && substr($s, 7, 1) == 'r') ? true : false;
        } else {
            $checkResult['exp_backend'][1] = (substr($s, 1, 1) == 'r' && substr($s, 2, 1) == 'w' && substr($s, 3, 1) == 'x' && substr($s, 4, 1) == 'r' && substr($s, 7, 1) == 'r' && substr($s, 6, 1) == 'x' && substr($s, 9, 1) == 'x') ? true : false;
        }
        return $checkResult;
    }

    public function getParam($name, $def = null) {
        if(Yii::$app->request->isGet) {
            return Yii::$app->request->get($name, $def);
        } else {
            return Yii::$app->request->post($name, $def);
        }
    }

    public function out($status, $msg = null) {
        return Json::encode([
            'status' => $status,
            'msg' => $msg
        ]);
    }

}