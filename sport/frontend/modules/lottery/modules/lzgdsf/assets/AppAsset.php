<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\modules\lottery\modules\gdsf\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
//     public $sourcePath = '@cqsf/assets';
	public $sourcePath = '@lottery/assets';
	
    public $css = [
    	'lottery/gdsf/gdsf.css',
    ];
    
    public $js = [
		'lottery/gdsf/gdsf.js',
    ];
    
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    
    public $depends = [
    	'frontend\modules\lottery\assets\AppAsset',
    ];
    
    public $publishOptions = [
        'except' => [
            'AppAsset.php',
        ],
        'forceCopy' => YII_DEBUG
    ];
}
