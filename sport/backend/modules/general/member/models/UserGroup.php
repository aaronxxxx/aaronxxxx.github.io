<?php

namespace app\modules\general\member\models;

use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $group_name
 * @property string $total_bets
 * @property string $default_group
 * @property string $sports_bet
 * @property string $sports_bet_reb
 * @property string $cq_bet
 * @property string $cq_bet_reb
 * @property string $jx_bet
 * @property string $jx_bet_reb
 * @property string $tj_bet
 * @property string $tj_bet_reb
 * @property string $bjpk_bet
 * @property string $bjpk_bet_reb
 * @property string $bjkn_bet
 * @property string $bjkn_bet_reb
 * @property string $gdsf_bet
 * @property string $gdsf_bet_reb
 * @property string $tjsf_bet
 * @property string $tjsf_bet_reb
 * @property string $gxsf_bet
 * @property string $gxsf_bet_reb
 * @property string $cqsf_bet
 * @property string $cqsf_bet_reb
 * @property string $gd11_bet
 * @property string $gd11_bet_reb
 * @property string $lhc_bet
 * @property string $lhc_bet_reb
 * @property string $d3_bet
 * @property string $d3_bet_reb
 * @property string $p3_bet
 * @property string $p3_bet_reb
 * @property string $t3_bet
 * @property string $t3_bet_reb
 * @property string $sports_lower_bet
 * @property string $cq_lower_bet
 * @property string $jx_lower_bet
 * @property string $tj_lower_bet
 * @property string $bjpk_lower_bet
 * @property string $bjkn_lower_bet
 * @property string $gdsf_lower_bet
 * @property string $gxsf_lower_bet
 * @property string $tjsf_lower_bet
 * @property string $cqsf_lower_bet
 * @property string $gd11_lower_bet
 * @property string $lhc_lower_bet
 * @property string $d3_lower_bet
 * @property string $p3_lower_bet
 * @property string $t3_lower_bet
 * @property string $sports_max_bet
 * @property string $cq_max_bet
 * @property string $jx_max_bet
 * @property string $tj_max_bet
 * @property string $bjpk_max_bet
 * @property string $bjkn_max_bet
 * @property string $gdsf_max_bet
 * @property string $gxsf_max_bet
 * @property string $tjsf_max_bet
 * @property string $cqsf_max_bet
 * @property string $gd11_max_bet
 * @property string $lhc_max_bet
 * @property string $d3_max_bet
 * @property string $p3_max_bet
 * @property string $t3_max_bet
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
            [['total_bets', 'sports_bet', 'sports_bet_reb', 'cq_bet', 'cq_bet_reb', 'jx_bet', 'jx_bet_reb', 'tj_bet', 'tj_bet_reb', 'bjpk_bet', 'bjpk_bet_reb', 'bjkn_bet', 'bjkn_bet_reb', 'gdsf_bet', 'gdsf_bet_reb', 'tjsf_bet', 'tjsf_bet_reb', 'gxsf_bet', 'gxsf_bet_reb', 'cqsf_bet', 'cqsf_bet_reb', 'gd11_bet', 'gd11_bet_reb', 'lhc_bet', 'lhc_bet_reb', 'd3_bet', 'd3_bet_reb', 'p3_bet', 'p3_bet_reb', 't3_bet', 't3_bet_reb', 'sports_lower_bet', 'cq_lower_bet', 'jx_lower_bet', 'tj_lower_bet', 'bjpk_lower_bet', 'bjkn_lower_bet', 'gdsf_lower_bet', 'gxsf_lower_bet', 'tjsf_lower_bet', 'cqsf_lower_bet', 'gd11_lower_bet', 'lhc_lower_bet', 'd3_lower_bet', 'p3_lower_bet', 't3_lower_bet', 'sports_max_bet', 'cq_max_bet', 'jx_max_bet', 'tj_max_bet', 'bjpk_max_bet', 'bjkn_max_bet', 'gdsf_max_bet', 'gxsf_max_bet', 'tjsf_max_bet', 'cqsf_max_bet', 'gd11_max_bet', 'lhc_max_bet', 'd3_max_bet', 'p3_max_bet', 't3_max_bet'], 'number'],
            [['group_name'], 'string', 'max' => 20],
            [['default_group'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'group_name' => 'Group Name',
            'total_bets' => 'Total Bets',
            'default_group' => 'Default Group',
            'sports_bet' => 'Sports Bet',
            'sports_bet_reb' => 'Sports Bet Reb',
            'cq_bet' => 'Cq Bet',
            'cq_bet_reb' => 'Cq Bet Reb',
            'jx_bet' => 'Jx Bet',
            'jx_bet_reb' => 'Jx Bet Reb',
            'tj_bet' => 'Tj Bet',
            'tj_bet_reb' => 'Tj Bet Reb',
            'bjpk_bet' => 'Bjpk Bet',
            'bjpk_bet_reb' => 'Bjpk Bet Reb',
            'bjkn_bet' => 'Bjkn Bet',
            'bjkn_bet_reb' => 'Bjkn Bet Reb',
            'gdsf_bet' => 'Gdsf Bet',
            'gdsf_bet_reb' => 'Gdsf Bet Reb',
            'tjsf_bet' => 'Tjsf Bet',
            'tjsf_bet_reb' => 'Tjsf Bet Reb',
            'gxsf_bet' => 'Gxsf Bet',
            'gxsf_bet_reb' => 'Gxsf Bet Reb',
            'cqsf_bet' => 'Cqsf Bet',
            'cqsf_bet_reb' => 'Cqsf Bet Reb',
            'gd11_bet' => 'Gd11 Bet',
            'gd11_bet_reb' => 'Gd11 Bet Reb',
            'lhc_bet' => 'Lhc Bet',
            'lhc_bet_reb' => 'Lhc Bet Reb',
            'd3_bet' => 'D3 Bet',
            'd3_bet_reb' => 'D3 Bet Reb',
            'p3_bet' => 'P3 Bet',
            'p3_bet_reb' => 'P3 Bet Reb',
            't3_bet' => 'T3 Bet',
            't3_bet_reb' => 'T3 Bet Reb',
            'sports_lower_bet' => 'Sports Lower Bet',
            'cq_lower_bet' => 'Cq Lower Bet',
            'jx_lower_bet' => 'Jx Lower Bet',
            'tj_lower_bet' => 'Tj Lower Bet',
            'bjpk_lower_bet' => 'Bjpk Lower Bet',
            'bjkn_lower_bet' => 'Bjkn Lower Bet',
            'gdsf_lower_bet' => 'Gdsf Lower Bet',
            'gxsf_lower_bet' => 'Gxsf Lower Bet',
            'tjsf_lower_bet' => 'Tjsf Lower Bet',
            'cqsf_lower_bet' => 'Cqsf Lower Bet',
            'gd11_lower_bet' => 'Gd11 Lower Bet',
            'lhc_lower_bet' => 'Lhc Lower Bet',
            'd3_lower_bet' => 'D3 Lower Bet',
            'p3_lower_bet' => 'P3 Lower Bet',
            't3_lower_bet' => 'T3 Lower Bet',
            'sports_max_bet' => 'Sports Max Bet',
            'cq_max_bet' => 'Cq Max Bet',
            'jx_max_bet' => 'Jx Max Bet',
            'tj_max_bet' => 'Tj Max Bet',
            'bjpk_max_bet' => 'Bjpk Max Bet',
            'bjkn_max_bet' => 'Bjkn Max Bet',
            'gdsf_max_bet' => 'Gdsf Max Bet',
            'gxsf_max_bet' => 'Gxsf Max Bet',
            'tjsf_max_bet' => 'Tjsf Max Bet',
            'cqsf_max_bet' => 'Cqsf Max Bet',
            'gd11_max_bet' => 'Gd11 Max Bet',
            'lhc_max_bet' => 'Lhc Max Bet',
            'd3_max_bet' => 'D3 Max Bet',
            'p3_max_bet' => 'P3 Max Bet',
            't3_max_bet' => 'T3 Max Bet',
        ];
    }
	public static function getUserGroupList(){//获取用户分组列表
		$lists=UserGroup::find()
		       ->orderBy("id asc")
			   ->asArray()
			   ->all();
	    return $lists;
	}
}
