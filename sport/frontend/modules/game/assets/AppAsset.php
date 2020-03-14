<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\game\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@game/assets';
    
    public $css = [
        'css/standard.css',
        'css/game.css',
    ];
    
    public $js = [
        'js/game.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
    
    public $publishOptions = [
        'except' => [
            'AppAsset.php',
        ],
        'forceCopy' => YII_DEBUG
    ];
}
