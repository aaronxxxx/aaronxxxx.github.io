<?php

namespace app\modules\general\sysmng\models;

use Yii;


class ThemeSetting extends \yii\db\ActiveRecord
{

    static public function getBannerID($type){
        $sql = "SELECT * FROM `theme_setting` WHERE type = '$type' ORDER BY `sort` DESC ";
        $r = ThemeSetting::findBySql($sql)->asArray()->all();
        return $r;
    }
}
