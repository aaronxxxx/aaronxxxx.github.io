<?php
namespace app\modules\core\common\models;

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
class SysManageOnline extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_manage_online';
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
            'manage_name' => '管理员',
            'session_str' => '登陆时候产生的guid',
            'logintime' => '登陆时间',
            'onlinetime' => '在线时间',
            'loginip' => '登陆 IP',
            'loginbrowser' => '登陆浏览器',
        ];
    }

    public static function deleteallbyname($name)
    {
        SysManageOnline::deleteAll('manage_name = :manage_name', [':manage_name' => $name]);
    }

    public static function deleteallbydate()
    {
        $logintime = date('Y-m-d H:i:s',strtotime('-12 hour'));
        SysManageOnline::deleteAll('logintime <= :logintime', [':logintime' => $logintime]);
    }
}
