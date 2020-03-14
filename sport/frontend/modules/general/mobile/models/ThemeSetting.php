<?php
namespace app\modules\general\mobile\models;

use yii\db\ActiveRecord;

class ThemeSetting extends ActiveRecord{
    static public function getBanner(){// 抓輪播圖
        $data = ThemeSetting::find()
                ->Where(['type' => '1' ])
                ->orderby(['sort'=>SORT_DESC])
                ->asArray()
                ->all();
        return $data;
    }
    static public function getAppQrCode(){ //抓QRcode
        $data = ThemeSetting::find()
                ->Where(['type' => '3' ])
                ->orderby(['sort'=>SORT_DESC])
                ->asArray()
                ->all();
        return $data;
    }
    static public function getActivity(){ //抓優惠活動
        $data = ThemeSetting::find()
                ->Where(['type' => '2' ])
                ->orderby(['sort'=>SORT_DESC])
                ->asArray()
                ->all();
        return $data;
    }
}