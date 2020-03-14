<?php
require(__DIR__ . '/../common/services/InstallService.php');
$isInstall = \app\common\services\InstallService::checkInstalled();
if(!$isInstall) {
    return;
}
// comment out the following two lines when deployed to production
//Winhooks Test @0321 14:50
defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
