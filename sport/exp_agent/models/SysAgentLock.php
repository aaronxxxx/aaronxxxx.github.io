<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "sys_manage_online".
 *
 * @property integer $id
 * @property string $manage_name
 * @property string $session_str
 * @property string $logintime
 * @property string $onlinetime
 * @property string $loginip
 * @property string $loginbrowser
 */
class SysAgentLock extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_agent_lock';
    }
}