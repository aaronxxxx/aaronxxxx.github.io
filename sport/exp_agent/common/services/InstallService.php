<?php
namespace app\common\services;

class InstallService
{
    /**
     *检查是否已安装向导
     */
    public static function checkInstalled() {
        $file = dirname(__DIR__)."/../install.lock";
        $requestUri = $_SERVER["REQUEST_URI"];
        if(!file_exists($file) && (strpos($requestUri, "install/index") === false)) {
            header('Location: /?r=install/index/step1');
            return false;
        }
        return true;
    }
}