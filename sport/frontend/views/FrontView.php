<?php
namespace app\views;

use Yii;
use yii\base\Theme;
use yii\web\View;

class FrontView extends View
{

    public function init()
    {
        parent::init();
        $this->setTheme();
    }

    public function setTheme()
    {
        $currentTheme = isset(Yii::$app->params['theme'])?Yii::$app->params['theme']:'default';
        $config = [
            'basePath' => '@app/web/themes/'.$currentTheme,
            'baseUrl' => '@app/web/themes/'.$currentTheme,
            'pathMap' => [
                '@app/views' => '@app/web/themes/'.$currentTheme,
                '@app/modules' => '@app/web/themes/'.$currentTheme
            ],
        ];
        $this->theme = new Theme($config);
    }

}
