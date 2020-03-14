<?php

namespace app\modules\member\models\ar;

use Yii;

/**
 * This is the model class for table "k_bet".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $order_num
 * @property string $ball_sort
 * @property string $point_column
 * @property string $match_name
 * @property string $master_guest
 * @property string $match_id
 * @property string $bet_info
 * @property string $match_showtype
 * @property string $match_rgg
 * @property string $match_dxgg
 * @property string $match_nowscore
 * @property integer $match_type
 * @property string $bet_money
 * @property integer $ben_add
 * @property double $bet_point
 * @property string $bet_win
 * @property string $win
 * @property string $bet_time
 * @property string $bet_time_et
 * @property string $match_time
 * @property string $match_endtime
 * @property integer $status
 * @property integer $lose_ok
 * @property string $update_time
 * @property string $sys_about
 * @property string $MB_Inball
 * @property string $TG_Inball
 * @property string $balance
 * @property string $Match_HRedCard
 * @property string $Match_GRedCard
 * @property string $assets
 * @property string $ip
 * @property string $www
 * @property string $match_coverdate
 * @property string $fs
 * @property integer $check
 * @property string $bet_yx
 * @property double $bet_reb
 * @property string $game_type
 */
class KBet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'k_bet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'balance'], 'required'],
            [['user_id', 'match_type', 'ben_add', 'status', 'lose_ok', 'Match_HRedCard', 'Match_GRedCard', 'check'], 'integer'],
            [['bet_money', 'bet_point', 'bet_win', 'win', 'balance', 'assets', 'fs', 'bet_yx', 'bet_reb'], 'number'],
            [['bet_time', 'bet_time_et', 'match_endtime', 'update_time', 'match_coverdate'], 'safe'],
            [['order_num', 'www'], 'string', 'max' => 50],
            [['ball_sort', 'match_rgg', 'match_dxgg', 'game_type'], 'string', 'max' => 10],
            [['point_column', 'match_id', 'match_time', 'ip'], 'string', 'max' => 20],
            [['match_name', 'master_guest', 'bet_info'], 'string', 'max' => 100],
            [['match_showtype', 'match_nowscore'], 'string', 'max' => 5],
            [['sys_about'], 'string', 'max' => 200],
            [['MB_Inball', 'TG_Inball'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_num' => 'Order Num',
            'ball_sort' => 'Ball Sort',
            'point_column' => 'Point Column',
            'match_name' => 'Match Name',
            'master_guest' => 'Master Guest',
            'match_id' => 'Match ID',
            'bet_info' => 'Bet Info',
            'match_showtype' => 'Match Showtype',
            'match_rgg' => 'Match Rgg',
            'match_dxgg' => 'Match Dxgg',
            'match_nowscore' => 'Match Nowscore',
            'match_type' => 'Match Type',
            'bet_money' => 'Bet Money',
            'ben_add' => 'Ben Add',
            'bet_point' => 'Bet Point',
            'bet_win' => 'Bet Win',
            'win' => 'Win',
            'bet_time' => 'Bet Time',
            'bet_time_et' => 'Bet Time Et',
            'match_time' => 'Match Time',
            'match_endtime' => 'Match Endtime',
            'status' => 'Status',
            'lose_ok' => 'Lose Ok',
            'update_time' => 'Update Time',
            'sys_about' => 'Sys About',
            'MB_Inball' => 'Mb  Inball',
            'TG_Inball' => 'Tg  Inball',
            'balance' => 'Balance',
            'Match_HRedCard' => 'Match  Hred Card',
            'Match_GRedCard' => 'Match  Gred Card',
            'assets' => 'Assets',
            'ip' => 'Ip',
            'www' => 'Www',
            'match_coverdate' => 'Match Coverdate',
            'fs' => 'Fs',
            'check' => 'Check',
            'bet_yx' => 'Bet Yx',
            'bet_reb' => 'Bet Reb',
            'game_type' => 'Game Type',
        ];
    }
}
