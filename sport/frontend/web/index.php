<?php
//判断是否开启防攻击 开启后拒绝所有请求并加入黑名单
//Winhooks Test @0321 15:30
require(__DIR__ . '/../common/services/DDosService.php');
\app\common\services\DDosService::run();

//site路由重定向
require(__DIR__ . '/../common/services/SiteService.php');
\app\common\services\SiteService::testagent();
\app\common\services\SiteService::redirect();

//yii初始化
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../config/bootstrap.php');
$config = require(__DIR__ . '/../config/web.php');

//设置主题目录
Yii::setAlias('themeRoot', isset($config['params']['theme'])?'/themes/'.$config['params']['theme']:'/themes/default');
$application = new yii\web\Application($config);
$application->run();