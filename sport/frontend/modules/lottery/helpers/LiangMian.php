<?php
namespace app\modules\lottery\helpers;

/**
 * Created by PhpStorm.
 * User: hsc
 * Date: 2016/11/9
 * Time: 17:57
 * $lists 数组
 * $which 第几球
 * 两面长龙 队列
 * 第几球大小单双
 */
class LiangMian{
    //第几球大
    //规则为大于$middle
    function ball_big($lists,$which,$middle){
        $ball_big = 0;
        for($b_b=0;$b_b<count($lists);$b_b++){
            if($lists[$b_b]['ball_'.$which] > $middle){
                $ball_big = $b_b + 1;
            }else{
                $ball_big = $b_b;
                break;
            }
        }
        return $ball_big;
    }
    //第几球大小
    //规则为小于$middle
    function ball_small($lists,$which,$middle){
        $ball_small= 0;
        for($b_b=0;$b_b<count($lists);$b_b++){
            if($lists[$b_b]['ball_'.$which] < $middle){
                $ball_small = $b_b + 1;
            }else{
                $ball_small = $b_b;
                break;
            }
        }
        return $ball_small;
    }
    //第几球 单
    function ball_single($lists,$which){
        $ball_single = 0;
        for($s=0;$s<count($lists);$s++){
            if($lists[$s]['ball_'.$which] % 2 ==1){
                $ball_single = $s + 1;
            }else{
                $ball_single = $s;
                break;
            }
        }
        return $ball_single;
    }
    //第几球 双
    function ball_double($lists,$which){
        $ball_double = 0;
        for($d=0;$d<count($lists);$d++){
            if($lists[$d]['ball_'.$which] % 2 == 0){
                $ball_double = $d + 1;
            }else{
                $ball_double = $d;
                break;
            }
        }
        return $ball_double;
    }
    //总和大
    //大于$middle
    function count_big($lists,$BallCount,$middle){
        $count_big = 0;
        for($i=0;$i<count($lists);$i++){
            $ball_count = 0;
            for($j=1;$j<=$BallCount;$j++){
                $ball_count += $lists[$i]['ball_'.$j];
            }
            if($ball_count > $middle){
                $count_big  =  $i + 1;
            }else{
                $count_big = $i;
                break;
            }
        }
        return $count_big;
    }
    //总和小
    //小于$middle
    function count_small($lists,$BallCount,$middle){
        $count_small = 0;
        for($i=0;$i<count($lists);$i++){
            $ball_count = 0;
            for($j=1;$j<=$BallCount;$j++){
                $ball_count += $lists[$i]['ball_'.$j];
            }
            if($ball_count < $middle){
                $count_small  =  $i + 1;
            }else{
                $count_small = $i;
                break;
            }
        }
        return $count_small;
    }
    //总和单
    function count_single($lists,$BallCount){
         $count_single = 0;
        for($i=0;$i<count($lists);$i++){
            $ball_count = 0;
            for($j=1;$j<=$BallCount;$j++){
                $ball_count += $lists[$i]['ball_'.$j];
            }
            if($ball_count%2 ==1){
                $count_single = $i + 1;
            }else{
                $count_single = $i;
                break;
            }
        }
        return $count_single;
    }
    //总和双
    function count_double($lists,$BallCount){
        $count_double = 0;
        for($i=0;$i<count($lists);$i++){
            $ball_count = 0;
            for($j=1;$j<=$BallCount;$j++){
                $ball_count += $lists[$i]['ball_'.$j];
            }
            if($ball_count%2 ==0){
                $count_double = $i + 1;
            }else{
                $count_double = $i;
                break;
            }
        }
        return $count_double;
    }
    //龙
    //$first 第一球
    //$last  第二球
    function long($lists,$first,$last){
        $count_long = 0;
        for($long=0;$long<count($lists);$long++){
            if($lists[$long]['ball_'.$first]>$lists[$long]['ball_'.$last]){
                $count_long = $long + 1;
            }else{
                $count_long = $long;
                break;
            }
        }
        return $count_long;
    }
    //虎
    //$first 第一球
    //$last  第二球
    function hu($lists,$first,$last){
        $hu = 0;
        for($long=0;$long<count($lists);$long++){
            if($lists[$long]['ball_'.$first] < $lists[$long]['ball_'.$last]){
                $hu = $long + 1;
            }else{
                $hu = $long;
                break;
            }
        }
        return $hu;
    }
    //和
    //$first 第一球
    //$last  第二球
    function he($lists,$first,$last){
        $he = 0;
        for($long=0;$long<count($lists);$long++){
            if($lists[$long]['ball_'.$first] == $lists[$long]['ball_'.$last]){
                $he = $long + 1;
            }else{
                $he = $long;
                break;
            }
        }
        return $he;
    }
    //pk10
    //冠亚大
    function pk10GuanYaDa($list){
        $count_big=0;
        for($i=0;$i<count($list);$i++){  //长龙总和大
            if(($list[$i]['ball_1'] + $list[$i]['ball_2'] ) > 11){
                $count_big  =  $i + 1;
            }else{
                $count_big = $i;
                break;
            }
        };
        return $count_big;
    }
    //pk10
    //冠亚小
    function pk10GuanYaXiao($list){
        $count_small = 0;
        for($i_s=0;$i_s<count($list);$i_s++){
            if(($list[$i_s]['ball_1'] + $list[$i_s]['ball_2'] ) <11){
                $count_small =  $i_s + 1;
            }else{
                $count_small = $i_s;
                break;
            }
        };
        return $count_small;
    }
    //pk10冠亚单
    function pk10GuanYaDan($list){
        $count_single = 0;
        for($i_single=0;$i_single<count($list);$i_single++){
            $single_count = $list[$i_single]['ball_1'] + $list[$i_single]['ball_2'];
            if($single_count != 11){
                if($single_count%2 ==1){
                    $count_single = $i_single + 1;
                }else{
                    $count_single = $i_single;
                    break;
                }
            }else{
                $count_single = $i_single-1;
                break;
            }

        }
        return $count_single;
    }
    //pk10冠亚双
    function pk10GuanYaShuang($list){
        $count_double = 0;
        for($i_double=0;$i_double<count($list);$i_double++){
            $double_count = $list[$i_double]['ball_1'] + $list[$i_double]['ball_2'];
            if($double_count != 11){
                if($double_count%2 == 0){
                    $count_double = $i_double +1;
                }else{
                    $count_double = $i_double;
                    break;
                }
            }else{
                $count_double = $i_double;
                break;
            }
        }
        return $count_double;
    }
    //pk10 龙
    function pk10Long($list,$first){
        $last = 11 - $first;
        $c_long = 0;
        for($long=0;$long<count($list);$long++){
            if($list[$long]['ball_'.$first] > $list[$long]['ball_'.$last]){
                $c_long = $long + 1;
            }else{
                $c_long = $long;
                break;
            }
        }
        return $c_long;
    }
    function pk10Hu($list,$first){
        $last = 11 - $first;
        $c_long = 0;
        for($long=0;$long<count($list);$long++){
            if($list[$long]['ball_'.$first] < $list[$long]['ball_'.$last]){
                $c_long = $long + 1;
            }else{
                $c_long = $long;
                break;
            }
        }
        return $c_long;
    }
}