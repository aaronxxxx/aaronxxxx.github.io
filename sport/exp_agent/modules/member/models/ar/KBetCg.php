<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "k_bet_cg".
 *
 * @property integer $id
 * @property integer $gid
 * @property integer $user_id
 * @property string $ball_sort
 * @property string $point_column
 * @property string $match_name
 * @property string $master_guest
 * @property string $match_id
 * @property string $bet_info
 * @property string $bet_money
 * @property double $bet_point
 * @property integer $ben_add
 * @property string $bet_time
 * @property string $bet_time_et
 * @property string $match_endtime
 * @property string $match_showtype
 * @property string $match_rgg
 * @property string $match_dxgg
 * @property string $match_nowscore
 * @property integer $status
 * @property string $update_time
 * @property string $sys_about
 * @property string $MB_Inball
 * @property string $TG_Inball
 * @property integer $check
 */
class KBetCg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_bet_cg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'user_id', 'ben_add', 'status', 'check'], 'integer'],
            [['user_id'], 'required'],
            [['bet_money', 'bet_point'], 'number'],
            [['bet_time', 'bet_time_et', 'match_endtime', 'update_time'], 'safe'],
            [['ball_sort', 'match_showtype', 'match_rgg', 'match_dxgg', 'match_nowscore'], 'string', 'max' => 10],
            [['point_column', 'match_id'], 'string', 'max' => 20],
            [['match_name', 'master_guest', 'bet_info'], 'string', 'max' => 100],
            [['sys_about'], 'string', 'max' => 200],
            [['MB_Inball', 'TG_Inball'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'Gid',
            'user_id' => 'User ID',
            'ball_sort' => 'Ball Sort',
            'point_column' => 'Point Column',
            'match_name' => 'Match Name',
            'master_guest' => 'Master Guest',
            'match_id' => 'Match ID',
            'bet_info' => 'Bet Info',
            'bet_money' => 'Bet Money',
            'bet_point' => 'Bet Point',
            'ben_add' => 'Ben Add',
            'bet_time' => 'Bet Time',
            'bet_time_et' => 'Bet Time Et',
            'match_endtime' => 'Match Endtime',
            'match_showtype' => 'Match Showtype',
            'match_rgg' => 'Match Rgg',
            'match_dxgg' => 'Match Dxgg',
            'match_nowscore' => 'Match Nowscore',
            'status' => 'Status',
            'update_time' => 'Update Time',
            'sys_about' => 'Sys About',
            'MB_Inball' => 'Mb  Inball',
            'TG_Inball' => 'Tg  Inball',
            'check' => 'Check',
        ];
    }
}
