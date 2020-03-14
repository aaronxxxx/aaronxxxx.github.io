<?php

namespace app\modules\game\models;

use Yii;

/**
 * This is the model class for table "game_type".
 *
 * @property string $id
 * @property string $skey
 * @property string $en_name
 * @property string $cn_name1
 * @property string $cn_name2
 * @property string $type
 * @property string $url
 */
class GameType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skey', 'en_name', 'cn_name1', 'cn_name2', 'type', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'skey' => 'Skey',
            'en_name' => 'En Name',
            'cn_name1' => 'Cn Name1',
            'cn_name2' => 'Cn Name2',
            'type' => 'Type',
            'url' => 'Url',
        ];
    }
	public static function getGameType($flash_id){//获取MG游戏代号
       $flash_id=preg_replace('/^(.+)(V90)$/i','$1',trim($flash_id));
	   $low_flashId=strtolower($flash_id);
	   $hd=GameType::find()
	       ->where(['or','id=:flashId','skey=:lflashId','en_name=:flashId'])
		   ->addParams([':flashId' => $flash_id])
		   ->addParams([':lflashId' => $low_flashId])
		   ->asArray()
		   ->one();
	   if(isset($hd['type'])){
		   return $hd['type'];
	   }else{
		   return false;
	   }
		
	}
}
