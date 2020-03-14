<?php

namespace app\modules\general\member\models\ar;

use Yii;

/**
 * This is the model class for table "user_list".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $Oid
 * @property string $user_name
 * @property string $user_pass
 * @property string $user_pass_naked
 * @property string $qk_pass
 * @property integer $top_id
 * @property string $money
 * @property string $total_bets
 * @property string $ask
 * @property string $answer
 * @property string $loginip
 * @property string $OnlineTime
 * @property string $logintime
 * @property string $loginaddress
 * @property string $regtime
 * @property string $regip
 * @property string $regaddress
 * @property string $logouttime
 * @property string $online
 * @property integer $lognum
 * @property string $status
 * @property integer $group_id
 * @property string $sex
 * @property string $birthday
 * @property string $tel
 * @property string $email
 * @property integer $qq
 * @property string $othercon
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $address
 * @property string $pay_name
 * @property string $pay_address
 * @property string $pay_num
 * @property string $pay_bank
 * @property string $remark
 * @property string $loginurl
 * @property string $regurl
 * @property string $is_allow_live
 * @property integer $allow_total_money
 */
class UserList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_list';
    }

//     /**
//      * @inheritdoc
//      */
//     public function rules()
//     {
//         return [
//             [['user_id', 'user_name', 'user_pass', 'qk_pass', 'ask', 'answer', 'remark'], 'required'],
//             [['user_id', 'top_id', 'lognum', 'group_id', 'qq', 'allow_total_money'], 'integer'],
//             [['money', 'total_bets'], 'number'],
//             [['OnlineTime', 'logintime', 'regtime', 'logouttime', 'birthday'], 'safe'],
//             [['remark'], 'string'],
//             [['Oid', 'ask', 'answer', 'email', 'country', 'province', 'city', 'pay_num', 'pay_bank'], 'string', 'max' => 50],
//             [['user_name'], 'string', 'max' => 16],
//             [['user_pass', 'user_pass_naked', 'qk_pass'], 'string', 'max' => 32],
//             [['loginip', 'regip', 'tel', 'pay_name'], 'string', 'max' => 20],
//             [['loginaddress', 'regaddress', 'othercon', 'address', 'pay_address', 'loginurl', 'regurl'], 'string', 'max' => 100],
//             [['online'], 'string', 'max' => 1],
//             [['status'], 'string', 'max' => 4],
//             [['sex'], 'string', 'max' => 2],
//             [['is_allow_live'], 'string', 'max' => 10],
//         ];
//     }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'Oid' => 'Oid',
            'user_name' => 'User Name',
            'user_pass' => 'User Pass',
            'user_pass_naked' => 'User Pass Naked',
            'qk_pass' => 'Qk Pass',
            'top_id' => 'Top ID',
            'money' => 'Money',
            'total_bets' => 'Total Bets',
            'ask' => 'Ask',
            'answer' => 'Answer',
            'loginip' => 'Loginip',
            'OnlineTime' => 'Online Time',
            'logintime' => 'Logintime',
            'loginaddress' => 'Loginaddress',
            'regtime' => 'Regtime',
            'regip' => 'Regip',
            'regaddress' => 'Regaddress',
            'logouttime' => 'Logouttime',
            'online' => 'Online',
            'lognum' => 'Lognum',
            'status' => 'Status',
            'group_id' => 'Group ID',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'tel' => 'Tel',
            'email' => 'Email',
            'qq' => 'Qq',
            'othercon' => 'Othercon',
            'country' => 'Country',
            'province' => 'Province',
            'city' => 'City',
            'address' => 'Address',
            'pay_name' => 'Pay Name',
            'pay_address' => 'Pay Address',
            'pay_num' => 'Pay Num',
            'pay_bank' => 'Pay Bank',
            'remark' => 'Remark',
            'loginurl' => 'Loginurl',
            'regurl' => 'Regurl',
            'is_allow_live' => 'Is Allow Live',
            'allow_total_money' => 'Allow Total Money',
        ];
    }
}
