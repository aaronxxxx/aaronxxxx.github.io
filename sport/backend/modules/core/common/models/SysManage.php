<?php
namespace app\modules\core\common\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "sys_manage".
 *
 * @property integer $id
 * @property string $manage_name
 * @property string $manage_pass
 * @property integer $login_one
 * @property integer $bindcomputer
 * @property string $purview
 */
class SysManage extends ActiveRecord implements IdentityInterface{

    public static function tableName()
    {
        return 'sys_manage';
    }

    public function rules()
    {
        return [
            [['manage_name', 'manage_pass', 'login_one', 'purview'], 'required'],
            [['login_one', 'bindcomputer'], 'integer'],
            [['manage_name'], 'string', 'max' => 16],
            [['manage_pass'], 'string', 'max' => 32],
            [['purview'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manage_name' => '管理员',
            'manage_pass' => '密码',
            'login_one' => '多地登陆',
            'bindcomputer' => '是否绑定',
            'purview' => '权限',
        ];
    }

    /**
     * 获取对应用户id的权限列表
     */
    static public function getPurview($uid){
        $result = SysManage::find()
            ->select(['purview'])
            ->where(array('id'=>$uid))
            ->asArray()
            ->one();
        return $result;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        // return static::findOne(['access_token' => $token]);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        // return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        // return $this->getAuthKey() === $authKey;
    }
}