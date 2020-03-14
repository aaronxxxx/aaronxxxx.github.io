<?php
namespace app\modules\agent\models;

use yii\db\ActiveRecord;
/**
 * KBet
 * KBet is the model behind the agents_list.
 */
class KBet extends ActiveRecord{
    
    public static function getBetMoneyAndCount($s_time, $e_time, $gType, $id) {
        $sql_where = '';
        if ($gType == '足球') {
            $sql_where = " and (ball_sort='足球早餐' or ball_sort='足球單式' or ball_sort='足球滾球' or ball_sort='足球上半場') ";
        } else if ($gType == '籃球') {
            $sql_where = " and (ball_sort='籃球早餐' or ball_sort='籃球單式' or ball_sort='籃球滾球' or ball_sort='籃球單節') ";
        } else if ($gType == '網球') {
            $sql_where = " and (ball_sort='網球早餐' or ball_sort='網球單式') ";
        } else if ($gType == '排球') {
            $sql_where = " and (ball_sort='排球早餐' or ball_sort='排球單式') ";
        } else if ($gType == '棒球') {
            $sql_where = " and (ball_sort='棒球早餐' or ball_sort='棒球單式') ";
        } else if ($gType == '冠軍') {
            $sql_where = " and ball_sort='冠軍' ";
        } else if ($gType == '單式') {
            $sql_where = " and ball_sort !='冠軍' ";
        } else if ($gType == '其他') {
            $sql_where = " and (ball_sort='其他早餐' or ball_sort='其他單式') ";
        }
        $sql="select count(id) as bet_count,IFNULL(SUM(IFNULL(bet_money, 0)), 0) AS bet_money "
                . "from k_bet where bet_time>='$s_time' and bet_time<='$e_time' and user_id=$id ";
        $sql .= $sql_where;
        $sql .= " and status!=0 and status!=3 and `check`!=0 limit 0,1";
        $rs = KBet::findBySql($sql)->asArray()->one();
        return $rs;
    }
    
    public static function getWin($s_time, $e_time, $gType, $id) {
        $sql_where = '';
        if ($gType == '足球') {
            $sql_where = " and (ball_sort='足球早餐' or ball_sort='足球單式' or ball_sort='足球滾球' or ball_sort='足球上半場') ";
        } else if ($gType == '籃球') {
            $sql_where = " and (ball_sort='籃球早餐' or ball_sort='籃球單式' or ball_sort='籃球滾球' or ball_sort='籃球單節') ";
        } else if ($gType == '網球') {
            $sql_where = " and (ball_sort='網球早餐' or ball_sort='網球單式') ";
        } else if ($gType == '排球') {
            $sql_where = " and (ball_sort='排球早餐' or ball_sort='排球單式') ";
        } else if ($gType == '棒球') {
            $sql_where = " and (ball_sort='棒球早餐' or ball_sort='棒球單式') ";
        } else if ($gType == '冠軍') {
            $sql_where = " and ball_sort='冠軍' ";
        } else if ($gType == '單式') {
            $sql_where = " and ball_sort !='冠軍' ";
        } else if ($gType == '其他') {
            $sql_where = " and (ball_sort='其他早餐' or ball_sort='其他單式') ";
        }
        $sql="select SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money from k_bet "
                . "where bet_time>= '$s_time' and bet_time<='$e_time' and user_id=$id ";
        $sql .=$sql_where;
        $sql .=" and status!=0 and status!=3 and `check`!=0 LIMIT 0,1";
        $rs = KBet::findBySql($sql)->asArray()->one();
        return $rs;
    }
    
    public static function getOrderId($s_time, $e_time, $gType, $id) {
        $sql_where = '';
        if ($gType == '足球') {
            $sql_where = " and (ball_sort='足球早餐' or ball_sort='足球單式' or ball_sort='足球滾球' or ball_sort='足球上半場') ";
        } else if ($gType == '籃球') {
            $sql_where = " and (ball_sort='籃球早餐' or ball_sort='籃球單式' or ball_sort='籃球滾球' or ball_sort='籃球單節') ";
        } else if ($gType == '網球') {
            $sql_where = " and (ball_sort='網球早餐' or ball_sort='網球單式') ";
        } else if ($gType == '排球') {
            $sql_where = " and (ball_sort='排球早餐' or ball_sort='排球單式') ";
        } else if ($gType == '棒球') {
            $sql_where = " and (ball_sort='棒球早餐' or ball_sort='棒球單式') ";
        } else if ($gType == '冠軍') {
            $sql_where = " and ball_sort='冠軍' ";
        } else if ($gType == '單式') {
            $sql_where = " and ball_sort !='冠軍' ";
        } else if ($gType == '其他') {
            $sql_where = " and (ball_sort='其他早餐' or ball_sort='其他單式') ";
        }
        $sql="select id from k_bet "
                . "where 1=1 and user_id=$id and bet_time>='$s_time' and bet_time<='$e_time' ";
        $sql .=$sql_where;
        $sql .= "and status!=0 and status!=3 and `check`!=0 order by bet_time desc";
        $rs = KBet::findBySql($sql)->asArray()->all();
        return $rs;
    }
    
    public static function getOrderDelail($arr_id){
        $r = KBet::find()
                ->select([
                    'user_id',
                    'order_num',
                    'ball_sort',
                    'point_column',
                    'match_name',
                    'master_guest',
                    'match_id',
                    'bet_info',
                    'bet_money',
                    'bet_point',
                    'bet_win',
                    'win',
                    'bet_time',
                    'bet_time_et',
                    'match_time',
                    'match_endtime',
                    'status',
                    'balance',
                    'assets',
                    'ip',
                    'www',
                    'fs'
                    ])
                ->from('k_bet')
                ->where(['in','id',$arr_id])
                ->orderBy('id desc');
        return $r;
    }
}