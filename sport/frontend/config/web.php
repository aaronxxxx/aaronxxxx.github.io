<?php

$params = require(__DIR__ . '/params.php');
$params['services'] = require(__DIR__ . '/services.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-Hans',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kdoeodndpdpe+_+=-(gtjtjt0_0egeeee)am,..)qqq)',
			 'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'view' => [
            'class' => 'app\views\FrontView',
        ]
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
	'defaultRoute'=>'site',
];

//生成模块配置信息
if(is_dir(dirname(__DIR__)."/modules")) {
    if(file_exists(dirname(__DIR__)."/modules/modules.lock")) {
        $config['modules'] = json_decode(file_get_contents(dirname(__DIR__)."/modules/modules.lock"), true);
    } else {
        foreach(glob(dirname(__DIR__)."/modules/*") as $moduleDir) {
            if(is_dir($moduleDir)) {
                $moduleName = basename($moduleDir);
                $file = $moduleDir."/".ucfirst($moduleName).'Module.php';
                if(file_exists($file)){
                    $config['modules'][$moduleName] = [
                        'class' => 'app\modules\\'.$moduleName.'\\'.ucfirst($moduleName).'Module',
                    ];
                }else{
                    foreach(glob($moduleDir."/*") as $subModuleDir) {
                        if(is_dir($subModuleDir)) {
                            $subModuleName = basename($subModuleDir);
                            $file = $subModuleDir."/".ucfirst($subModuleName).'Module.php';
                            if(file_exists($file)){
                                $config['modules'][$subModuleName] = [
                                    'class' => 'app\modules\\'.$moduleName.'\\'.$subModuleName.'\\'.ucfirst($subModuleName).'Module',
                                ];
                            }
                        }
                    }
                }
            }
        }
        file_put_contents(dirname(__DIR__)."/modules/modules.lock", json_encode($config['modules']));
    }
}

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['61.131.72.15', '127.0.0.1', '::1']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
