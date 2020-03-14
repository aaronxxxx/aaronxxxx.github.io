<?php
namespace app\modules\general\activity\models;

use Yii;

class ThemeSetting extends \yii\db\ActiveRecord
{
    static public function getAll()
    {
        $sql = "SELECT * FROM `theme_setting` WHERE type = 4 ORDER BY `sort`, `title`";
        $result = ThemeSetting::findBySql($sql)->asArray()->all();

        return $result;
    }
}
