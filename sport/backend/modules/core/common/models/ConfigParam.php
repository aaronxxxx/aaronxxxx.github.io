<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:41
 */

namespace app\modules\core\common\models;


use yii\db\ActiveRecord;

class ConfigParam extends ActiveRecord
{
    public static function tableName()
    {
        return 'config_p';
    }

    public function loadMessageConfig()
    {
        return [
            'title' => $this->find()->where(['parameter_key' => 'REGSTER_TITLE'])->asArray()->one(),
            'content' => $this->find()->where(['parameter_key' => 'REGSTER_CONTENT'])->asArray()->one(),
            'enable' => $this->find()->where(['parameter_key' => 'REGSTER_ENABLE'])->asArray()->one(),
            'from' => $this->find()->where(['parameter_key' => 'REGSTER_FROM'])->asArray()->one(),
        ];
    }

    public function updateMessageConfig($param)
    {
        $titleModel = $this->find()->where(['parameter_key' => 'REGSTER_TITLE'])->one();
        $titleModel->parameter_value = $param['msg_title'];
        $titleModel->save();
        $contentModel = $this->find()->where(['parameter_key' => 'REGSTER_CONTENT'])->one();
        $contentModel->parameter_value = $param['msg_info'];
        $contentModel->save();
        $enableModel = $this->find()->where(['parameter_key' => 'REGSTER_ENABLE'])->one();
        $enableModel->parameter_value = $param['type'];
        $enableModel->save();
        $fromModel = $this->find()->where(['parameter_key' => 'REGSTER_FROM'])->one();
        $fromModel->parameter_value = $param['from'];
        $fromModel->save();
        return [
            'title' => $titleModel,
            'content' => $contentModel,
            'enable' => $enableModel,
            'from' => $fromModel
        ];
    }
}