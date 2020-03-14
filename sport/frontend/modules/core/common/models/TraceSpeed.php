<?php

namespace app\modules\core\common\models;

use Yii;

/**
 * This is the model class for table "trace_speed".
 *
 * @property integer $id
 * @property string $action
 * @property string $second
 * @property string $createTime
 */
class TraceSpeed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trace_speed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime'], 'safe'],
            [['action', 'second'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action' => 'Action',
            'second' => 'Second',
            'createTime' => 'Create Time',
        ];
    }
}