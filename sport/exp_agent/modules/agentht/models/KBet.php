<?php
namespace app\modules\agentht\models;

use yii\db\ActiveRecord;
/**
 * KBet
 * KBet is the model behind the agents_list.
 */
class KBet extends ActiveRecord{

    /**
     * 查询用户id
     * @param type $agent_id    代理ID
     * @param type $type        注单类型   全部赛事,单式，足球，篮球，排球，网球，棒球，其他，冠军
     * @param type $uid         注单的某个用户id
     * @param type $matchId     比赛Id
     * @param type $sTime       选取注单的开始时间
     * @param type $eTime       选取注单的结束时间
     * @param type $ballSort    注单中赛事的类型
     * @param type $tfId        注单的订单号
     * @return type
     */
    public static function selectOrderId($agent_id,$type,$uid='',$matchId='',$sTime='',$eTime='',$ballSort='',$tfId=''){
        $data = (new \yii\db\Query())
            ->select('k.id')
            ->from('k_bet as k')
            ->innerJoin('user_list as u',"k.user_id=u.user_id and u.top_id=$agent_id")
            ->where(['!=','k.lose_ok',0])
            ->andWhere(['k.status'=>0]);
        switch ($type){
            case "足球":
                $data=$data->andWhere(['or',
                    ['k.ball_sort'=>'足球早餐'],
                    ['k.ball_sort'=>'足球单式'],
                    ['k.ball_sort'=>'足球滚球'],
                    ['k.ball_sort'=>'足球上半场']
                ]);
                break;
            case "篮球":
                $data=$data->andWhere(['or',
                    ['k.ball_sort'=>'篮球早餐'],
                    ['k.ball_sort'=>'篮球单式'],
                    ['k.ball_sort'=>'篮球滚球'],
                    ['k.ball_sort'=>'篮球单节']
                ]);
                break;
            case "网球":
                $data=$data->andWhere(['or',
                    ['k.ball_sort'=>'网球早餐'],
                    ['k.ball_sort'=>'网球单式'],
                ]);
                break;
            case "排球":
                $data=$data->andWhere(['or',
                    ['k.ball_sort'=>'排球早餐'],
                    ['k.ball_sort'=>'排球单式'],
                ]);
                break;
            case "棒球":
                $data=$data->andWhere(['or',
                    ['k.ball_sort'=>'棒球早餐'],
                    ['k.ball_sort'=>'棒球单式'],
                ]);
                break;
            case "冠军":
                $data=$data->andWhere(['k.ball_sort'=>'冠军']);
                break;
            case "单式":
                $data=$data->andWhere(['!=','k.ball_sort','冠军']);
                break;
            case "其他":
                $data=$data->andWhere(['or',
                    ['k.ball_sort'=>'其他早餐'],
                    ['k.ball_sort'=>'其他单式'],
                ]);
                break;
            default :
                $data;
                break;
        }

        if($uid != ''){
            $data = $data->andWhere(['k.user_id'=>$uid]);
        }
        if($matchId){
            $data = $data->andWhere(['k.match_id'=>trim($matchId)]);
        }
        if($sTime){
            $data = $data->andWhere(['>=','k.bet_time',$sTime]);
        }
        if($eTime){
            $data =$data->andWhere(['<=','k.bet_time',$eTime]);
        }
        if($ballSort){
            $data = $data->andWhere(['k.ball_sort'=>  urldecode($ballSort)]);
        }
        if($tfId){
            $data = $data->andWhere(['k.order_num'=>$tfId]);
        }
        $data = $data->orderBy(['k.bet_time'=>SORT_DESC]);
        //->all();
        return $data;
    }

    /**
     * 查询k_bet表中的注单信息
     * @param type $orderId  注单的Id
     * @return type
     */
    public static function selectOrderData($orderId){
        $data = (new \yii\db\Query())
            ->select('*')
            ->from('k_bet')
            ->where(['id'=>$orderId])
            ->orderBy(['id'=>SORT_DESC])
            ->all();
        return $data;
    }

    static public function getBetMoneyAndCount($s_time, $e_time, $gType, $id) {
        $sql_where = '';
        if ($gType == '足球') {
            $sql_where = " and (ball_sort='足球早餐' or ball_sort='足球单式' or ball_sort='足球滚球' or ball_sort='足球上半场') ";
        } else if ($gType == '篮球') {
            $sql_where = " and (ball_sort='篮球早餐' or ball_sort='篮球单式' or ball_sort='篮球滚球' or ball_sort='篮球单节') ";
        } else if ($gType == '网球') {
            $sql_where = " and (ball_sort='网球早餐' or ball_sort='网球单式') ";
        } else if ($gType == '排球') {
            $sql_where = " and (ball_sort='排球早餐' or ball_sort='排球单式') ";
        } else if ($gType == '棒球') {
            $sql_where = " and (ball_sort='棒球早餐' or ball_sort='棒球单式') ";
        } else if ($gType == '冠军') {
            $sql_where = " and ball_sort='冠军' ";
        } else if ($gType == '单式') {
            $sql_where = " and ball_sort !='冠军' ";
        } else if ($gType == '其他') {
            $sql_where = " and (ball_sort='其他早餐' or ball_sort='其他单式') ";
        }
        $sql="select count(id) as bet_count,IFNULL(SUM(IFNULL(bet_money, 0)), 0) AS bet_money "
                . "from k_bet where bet_time>='$s_time' and bet_time<='$e_time' and user_id=$id ";
        $sql .= $sql_where;
        $sql .= " and status!=0 and status!=3 and `check`!=0 limit 0,1";
        $rs = KBet::findBySql($sql)->asArray()->one();
        return $rs;
    }
    
    static public function getWin($s_time, $e_time, $gType, $id) {
        $sql_where = '';
        if ($gType == '足球') {
            $sql_where = " and (ball_sort='足球早餐' or ball_sort='足球单式' or ball_sort='足球滚球' or ball_sort='足球上半场') ";
        } else if ($gType == '篮球') {
            $sql_where = " and (ball_sort='篮球早餐' or ball_sort='篮球单式' or ball_sort='篮球滚球' or ball_sort='篮球单节') ";
        } else if ($gType == '网球') {
            $sql_where = " and (ball_sort='网球早餐' or ball_sort='网球单式') ";
        } else if ($gType == '排球') {
            $sql_where = " and (ball_sort='排球早餐' or ball_sort='排球单式') ";
        } else if ($gType == '棒球') {
            $sql_where = " and (ball_sort='棒球早餐' or ball_sort='棒球单式') ";
        } else if ($gType == '冠军') {
            $sql_where = " and ball_sort='冠军' ";
        } else if ($gType == '单式') {
            $sql_where = " and ball_sort !='冠军' ";
        } else if ($gType == '其他') {
            $sql_where = " and (ball_sort='其他早餐' or ball_sort='其他单式') ";
        }
        $sql="select SUM(IF(win>0,win,0)+IF(fs>0,fs,0)) AS win_money from k_bet "
                . "where bet_time>= '$s_time' and bet_time<='$e_time' and user_id=$id ";
        $sql .=$sql_where;
        $sql .=" and status!=0 and status!=3 and `check`!=0 LIMIT 0,1";
        $rs = KBet::findBySql($sql)->asArray()->one();
        return $rs;
    }
    
    static public function getOrderId($s_time, $e_time, $gType, $id) {
        $sql_where = '';
        if ($gType == '足球') {
            $sql_where = " and (ball_sort='足球早餐' or ball_sort='足球单式' or ball_sort='足球滚球' or ball_sort='足球上半场') ";
        } else if ($gType == '篮球') {
            $sql_where = " and (ball_sort='篮球早餐' or ball_sort='篮球单式' or ball_sort='篮球滚球' or ball_sort='篮球单节') ";
        } else if ($gType == '网球') {
            $sql_where = " and (ball_sort='网球早餐' or ball_sort='网球单式') ";
        } else if ($gType == '排球') {
            $sql_where = " and (ball_sort='排球早餐' or ball_sort='排球单式') ";
        } else if ($gType == '棒球') {
            $sql_where = " and (ball_sort='棒球早餐' or ball_sort='棒球单式') ";
        } else if ($gType == '冠军') {
            $sql_where = " and ball_sort='冠军' ";
        } else if ($gType == '单式') {
            $sql_where = " and ball_sort !='冠军' ";
        } else if ($gType == '其他') {
            $sql_where = " and (ball_sort='其他早餐' or ball_sort='其他单式') ";
        }
        $sql="select id from k_bet "
                . "where 1=1 and user_id=$id and bet_time>='$s_time' and bet_time<='$e_time' ";
        $sql .=$sql_where;
        $sql .= "and status!=0 and status!=3 and `check`!=0 order by bet_time desc";
        $rs = KBet::findBySql($sql)->asArray()->all();
        return $rs;
    }
    
    static public function getOrderDelail($arr_id){
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