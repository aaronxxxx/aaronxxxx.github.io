<?php

namespace app\modules\general\sysmng\models\ar;

use Yii;

/**
 * This is the model class for table "{{%sys_huikuan_list}}".
 *
 * @property integer $id
 * @property string $bank_name
 * @property string $bank_number
 * @property string $bank_xm
 * @property string $bank_city
 */
class SysHuikuanList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_huikuan_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name', 'bank_number', 'bank_xm', 'bank_city'], 'required'],
            [['bank_name', 'bank_number', 'bank_xm', 'bank_city'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bank_name' => Yii::t('app', '银行类型'),
            'bank_number' => Yii::t('app', '银行账号'),
            'bank_xm' => Yii::t('app', '开户姓名'),
            'bank_city' => Yii::t('app', '开户银行'),
        ];
    }

    /**
     * @inheritdoc
     * @return SysHuikuanListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SysHuikuanListQuery(get_called_class());
    }
    
    public static function countSyshklist(){
    	$rs=SysHuikuanList::find()->select("count(*) as count")->asArray()->one();
    	return $rs;
    	
    }
    public static function findSyshklist($pageoffset,$pagelimit){
    	$rs=SysHuikuanList::find()->limit($pagelimit)->offset($pageoffset)->orderBy(['id' => SORT_DESC])->asArray()->all();
    	
    	return $rs;
    	 
    }
}
