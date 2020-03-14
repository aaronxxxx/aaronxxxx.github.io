<?php
namespace app\modules\lottery\helpers;

use app\modules\lottery\models\ar\UserList;
use Yii;
use app\modules\lottery\models\ar\UserGroup;
/**
*辅助函数
 */
class DataValid{
    /**
     *当期最大金额 -  一期最大金额
     */
    function count_one( $data) {
        $bet_money_total = self::sum_bet_money ( $data );
        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $ugul=UserList::getUserInfo($userid);
        $maxMoney=$ugul['allow_total_money'];
        if ($bet_money_total > $maxMoney && $maxMoney > 0) {
            return false;
        }else{
            return true;
        }
    }
    //投注总金额不超过用户余额
    function user_money_limit($data) {
        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $bet_money_total = self::sum_bet_money ( $data );
        $userinfo=UserList::getUserInfo($userid);
        $assets=$userinfo['money'];

        $balance = $assets - $bet_money_total;
        if ($balance < 0) {
            return false;
        }
        return true;
    }
    /**
     * 对数据进行效验，效验以下内容：
     * 数据是否为空
     * 数据是否为数字
     * 数据是否为正数
     * 只要一项出错，则返回数据效验失败
     */
    function data_except_valid($data) {
        if(count($data)>0){
            $names = array_keys ( $data );
            if (count ( $data ) < 1) {
                return false; // 没有选择数据，请重新下注。
            }
            for($i = 0; $i < count ( $data ); $i ++) {
                $bet_money_temp = $data [$names [$i]];
                if (! is_numeric ( $bet_money_temp ) || ! is_int ( $bet_money_temp * 1 ) || (0 > intval ( $bet_money_temp ))) {
                    return false;
                }
            }
        }else{
            return false;
        }
        return true;
    }
    /**
     * 只適用北京快樂8
     * 对数据进行效验，效验以下内容：
     * 数据是否超过可选择数量
     */
    function data_count_valid($data) {
        $i = 0;

        foreach ($data as $k => $v) {
            $arr = explode('_', $k);

            if ($i == 0) {
                $this->_server = $arr[1];
            } else {
                if ($this->_server != $arr[1]) {
                    return false;
                }
            }

            $i ++;
        }

        if ($this->_server < 6) {
            if (count($data) != $this->_server) {
                return false;
            }
        }

        return true;
    }

    //验证用户组所在的最大最小金额
    function bet_scope_limit($data,$lotterytype) {
        $userid=Yii::$app->session[Yii::$app->params['S_USER_ID']];
        $ugul=UserGroup::getUserGroupInfo($userid);
        $lowestMoney=$ugul[strtolower ($lotterytype) . '_lower_bet'];
        $maxMoney=$ugul[strtolower ($lotterytype) . '_max_bet'];
        foreach ( $data as $key => $value ) {
            if ($value < $lowestMoney || $value > $maxMoney) {
                return false;
            }
        }
        return true;
    }
    //统计总和
    //当前调用 十二个彩种的控制器调用
    public static function sum_bet_money($data){
        $bet_money_total=0;
        foreach ($data as $key=>$value){
            $bet_money_total+=$value;
        }
        return $bet_money_total;
    }
    /*
     * 字符串转数组
     * 案例：{"ball_9_1":"50","ball_9_2":"50"} 转出：Array ( [ball_9_1] => 50 [ball_9_2] => 50 )
     * */
    public static function object_array($array){
        if(is_object($array)){
            $array = (array)$array;
        }
        if(is_array($array)){
            foreach($array as $key=>$value){
                $array[$key] = self::object_array($value);
            }
        }
        return $array;
    }
}