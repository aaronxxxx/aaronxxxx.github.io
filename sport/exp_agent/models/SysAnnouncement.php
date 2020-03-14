<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_announcement".
 *
 * @property integer $id
 * @property string $content
 * @property string $type
 * @property string $create_date
 * @property string $end_time
 * @property integer $is_show
 * @property integer $sort
 * @property integer $fid
 */
class SysAnnouncement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_announcement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['content', 'end_time', 'sort'], 'required'],
            ['content', 'required', 'message' => '公告内容不能为空'],
            ['end_time', 'required', 'message' => '结束时间不能为空'],
            ['sort', 'required', 'message' => '排序不能为空'],
            [['create_date', 'end_time'], 'safe'],
            [['is_show', 'sort', 'fid'], 'integer'],
            [['content'], 'string', 'max' => 5000],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '公告内容',
            'type' => '公告类型',
            'create_date' => '公告创建时间',
            'end_time' => '结束时间',
            'is_show' => '是否显示',
            'sort' => '排序',
            'fid' => 'Fid',
        ];
    }
}