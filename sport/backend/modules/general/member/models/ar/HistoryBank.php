<?php

namespace app\modules\general\member\models\ar;

/**
 * This is the model class for table "history_bank".
 *
 * @property integer $id
 * @property string $uid
 * @property string $username
 * @property string $pay_card
 * @property string $pay_num
 * @property string $pay_address
 * @property string $pay_name
 * @property string $addtime
 */
class HistoryBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history_bank';
    }

     /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
             [['uid', 'username', 'pay_card', 'pay_num', 'pay_address', 'pay_name'], 'required'],
             [['uid'], 'integer'],
             [['addtime'], 'safe'],
             [['username', 'pay_num', 'pay_name'], 'string', 'max' => 20],
             [['pay_card', 'pay_address'], 'string', 'max' => 45],
         ];
     }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'username' => 'Username',
            'pay_card' => 'Pay Card',
            'pay_num' => 'Pay Num',
            'pay_address' => 'Pay Address',
            'pay_name' => 'Pay Name',
            'addtime' => 'Addtime',
        ];
    }
}
