<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "sys_Agent_online".
 *
 * @property integer $id
 * @property string $manage_name
 * @property string $session_str
 * @property string $logintime
 * @property string $onlinetime
 * @property string $loginip
 * @property string $loginbrowser
 */
class SysAgentOnline extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_agent_online';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manage_name', 'session_str', 'logintime', 'onlinetime', 'loginip', 'loginbrowser'], 'required'],
            [['logintime', 'onlinetime'], 'safe'],
            [['manage_name', 'loginip'], 'string', 'max' => 16],
            [['session_str'], 'string', 'max' => 32],
            [['loginbrowser'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manage_name' => '代理名稱',
            'session_str' => '登錄時候產生的guid',
            'logintime' => '登錄時間',
            'onlinetime' => '在線時間',
            'loginip' => '登錄 IP',
            'loginbrowser' => '登錄瀏覽器',
        ];
    }
}