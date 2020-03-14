<?php
namespace app\modules\six\helpers;

use Yii;
/**
*辅助函数
 */
class DataValid{

    /**
     * 对数据进行效验，效验以下内容：
     * 数据是否超过可选择数量
     */
    function data_count_valid($data, $gid) {

        foreach($data['totalArray'] as $k){
            $k = preg_replace('/\s+/', '', $k); //去空白
            $arr[] = explode(',',$k);
        }

        if($gid == 'CH'){
            switch ($data['ch_name']) {
                case "四全中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>4){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>4){ return false;}
                    }
                    return true;
                case "三全中":
                case "三中二":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>3){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>3){ return false;}
                    }
                    return true;
                case "二全中":
                case "二中特":
                case "特串":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>2){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>2){ return false;}
                    }
                    return true;
            }
        }elseif(($gid == 'LX') || ($gid == 'LF')){
            switch ($data['lx_name']) {
                case "五肖连":
                case "五尾碰":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>5){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>5){ return false;}
                    }
                    return true;
                case "四肖连":
                case "四尾碰":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>4){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>4){ return false;}
                    }
                    return true;
                case "三肖连":
                case "三尾碰":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>3){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>3){ return false;}
                    }
                    return true;
                case "二肖连":
                case "二尾碰":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>2){return false;}
                        }
                    }else{
                        if(count($arr[0])<>2){return false;}
                    }
                    return true;
            }
        }elseif($gid == 'NI'){
            switch ($data['ni_name']) {
                case "十二不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>12){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>12){ return false;}
                    }
                    return true;
                case "十一不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>11){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>11){ return false;}
                    }
                    return true;
                case "十不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>10){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>10){ return false;}
                    }
                    return true;
                case "九不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>9){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>9){ return false;}
                    }
                    return true;
                case "八不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>8){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>8){ return false;}
                    }
                    return true;
                case "七不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>7){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>7){ return false;}
                    }
                    return true;
                case "六不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>6){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>6){ return false;}
                    }
                    return true;
                case "五不中":
                    if(count($arr)>1){
                        foreach($arr as $k){
                            if(count($k)<>5){ return false;}
                        }
                    }else{
                        if(count($arr[0])<>5){ return false;}
                    }
                    return true;
            }
        }
    }
    /**
     * 对数据进行效验，效验以下内容：
     * 1.数据是否超过可选择数量
     * 2.数据是否不在數組列中
     * 3.数据是否重複
     */
    function data_nap_valid($data, $gid) {

        $flg = 0;
        for ($i =1;$i<=6;$i++){
            if (!isset($data['game'.$i])) {
            }else{
                $flg++;      //計算筆數
                $game[$i] = substr($data['game'.$i],0,9);
                $code_type = ['正码一','正码二','正码三','正码四','正码五','正码六'];
                $mix_type = ['单','双','大','小','和单','和双','和大','和小','尾大','尾小','红波','绿波','蓝波'];
                if(in_array(substr($data['game'.$i],0,9),$code_type)) {
                    if(in_array(substr($data['game'.$i],10),$mix_type)) {
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }
        if (count($game) != count(array_unique($game))) {
            return false;
        }
        if($flg<2){ return false;}
        return true;
    }

}