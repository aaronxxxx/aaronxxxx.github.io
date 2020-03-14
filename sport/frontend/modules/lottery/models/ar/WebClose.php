<?php

namespace app\modules\lottery\models\ar;

use Yii;

/**
 * This is the model class for table "web_close".
 *
 * @property string $id
 * @property string $sign
 * @property integer $close
 * @property string $name
 * @property string $end_close_time
 */
class WebClose extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_close';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['close'], 'integer'],
            [['end_close_time'], 'safe'],
            [['sign'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 10]
        ];
    }
	public static function getWebClose($lottery)
    {
        $web_close=self::find()->asArray()->where(['sign' => "$lottery"])->one();
    	return $web_close;
    }
    public static function getLotteryTypeClose($lottery)
    {
        $web_close=self::find()
            ->select('close')
            ->asArray()->where(['sign' => "$lottery"])->one();
        return $web_close['close'];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '编号'),
            'sign' => Yii::t('app', '彩票标识'),
            'close' => Yii::t('app', '是否关闭(0:开启,1:关闭)'),
            'name' => Yii::t('app', '彩票中文名'),
            'end_close_time' => Yii::t('app', '开启时间'),
        ];
    }
}
