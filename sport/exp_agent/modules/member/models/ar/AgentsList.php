<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "agents_list".
 *
 * @property integer $id
 * @property string $agents_name
 * @property string $agents_pass
 * @property string $loginip
 * @property string $logintime
 * @property string $regtime
 * @property string $online
 * @property integer $lognum
 * @property string $status
 * @property string $birthday
 * @property string $tel
 * @property string $email
 * @property integer $qq
 * @property string $othercon
 * @property string $remark
 * @property string $agents_type
 * @property string $total_1_1
 * @property string $total_1_2
 * @property string $total_2_1
 * @property string $total_2_2
 * @property string $total_3_1
 * @property string $total_3_2
 * @property string $total_4_1
 * @property string $total_4_2
 * @property string $total_5_1
 * @property string $total_5_2
 * @property string $total_1_scale
 * @property string $total_2_scale
 * @property string $total_3_scale
 * @property string $total_4_scale
 * @property string $total_5_scale
 * @property string $settlement
 */
class AgentsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agents_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agents_name', 'agents_pass', 'remark'], 'required'],
            [['logintime', 'regtime', 'birthday'], 'safe'],
            [['lognum', 'qq'], 'integer'],
            [['remark'], 'string'],
            [['total_1_1', 'total_1_2', 'total_2_1', 'total_2_2', 'total_3_1', 'total_3_2', 'total_4_1', 'total_4_2', 'total_5_1', 'total_5_2', 'total_1_scale', 'total_2_scale', 'total_3_scale', 'total_4_scale', 'total_5_scale'], 'number'],
            [['agents_name'], 'string', 'max' => 16],
            [['agents_pass'], 'string', 'max' => 32],
            [['loginip', 'tel'], 'string', 'max' => 20],
            [['online'], 'string', 'max' => 3],
            [['status'], 'string', 'max' => 4],
            [['email', 'othercon'], 'string', 'max' => 100],
            [['agents_type', 'settlement'], 'string', 'max' => 10],
            [['agents_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agents_name' => 'Agents Name',
            'agents_pass' => 'Agents Pass',
            'loginip' => 'Loginip',
            'logintime' => 'Logintime',
            'regtime' => 'Regtime',
            'online' => 'Online',
            'lognum' => 'Lognum',
            'status' => 'Status',
            'birthday' => 'Birthday',
            'tel' => 'Tel',
            'email' => 'Email',
            'qq' => 'Qq',
            'othercon' => 'Othercon',
            'remark' => 'Remark',
            'agents_type' => 'Agents Type',
            'total_1_1' => 'Total 1 1',
            'total_1_2' => 'Total 1 2',
            'total_2_1' => 'Total 2 1',
            'total_2_2' => 'Total 2 2',
            'total_3_1' => 'Total 3 1',
            'total_3_2' => 'Total 3 2',
            'total_4_1' => 'Total 4 1',
            'total_4_2' => 'Total 4 2',
            'total_5_1' => 'Total 5 1',
            'total_5_2' => 'Total 5 2',
            'total_1_scale' => 'Total 1 Scale',
            'total_2_scale' => 'Total 2 Scale',
            'total_3_scale' => 'Total 3 Scale',
            'total_4_scale' => 'Total 4 Scale',
            'total_5_scale' => 'Total 5 Scale',
            'settlement' => 'Settlement',
        ];
    }
}
