<?php
namespace app\modules\general\deploy\Util;

use app\modules\general\deploy\models\LotterySchedule;
use Yii;

class DeplayUtils {

    /**
     * lottery开奖表类型
     * @return array
     */
    public static function _getLotteryType(){
        return [
            'lottery_result_bjkn'=>'北京快乐8',
            'lottery_result_bjpk'=>'北京PK拾',
            'lottery_result_cq'=>'重庆时时彩',
            'lottery_result_cqsf'=>'重庆十分彩',
            'lottery_result_d3'=>'福彩3D',
            'lottery_result_gd11'=>'广东十一选五',
            'lottery_result_gdsf'=>'广东十分彩',
            'lottery_result_gxsf'=>'广西十分彩',
            'lottery_result_p3'=>'排列三',
            'lottery_result_t3'=>'上海时时乐',
            'lottery_result_tj'=>'极速时时彩',
            'lottery_result_tjsf'=>'天津十分彩'
        ];
    }

    public function _getLotterySum(){
        return [
            'lottery_result_bjkn'=>'179',
            'lottery_result_bjpk'=>'179',
            'lottery_result_cq'=>'120',
            'lottery_result_cqsf'=>'97',
            'lottery_result_d3'=>'1',
            'lottery_result_gd11'=>'84',
            'lottery_result_gdsf'=>'84',
            'lottery_result_gxsf'=>'50',
            'lottery_result_p3'=>'1',
            'lottery_result_t3'=>'23',
            'lottery_result_tj'=>'84',
            'lottery_result_tjsf'=>'84'
        ];
    }

    /**
     * 获取最后一期期数（指定日）
     * @param $type     彩票类型
     * @param $time     时间
     * @return mixed
     */
    public static function _getqishu($type,$time){
        $datetime = $time.' 00:02:00';
        if($time == date('Y-m-d')){
            $datetime2 = date('Y-m-d H:i:s');
        }else{
            $time = date('Y-m-d',strtotime("$time +1 day"));
            $datetime2 = $time.' 00:02:00';
        }
        $qishu = LotterySchedule::find()->select('qishu')
            ->from($type)
            ->where(['and',['>','datetime',$datetime],['<','datetime',$datetime2]]);
        $qishu = $qishu->orderBy('qishu desc');
        $qishu = $qishu->asArray()->one();
        return $qishu;
    }

    /**
     * 获取指定日前一期的期数
     * @param $type     彩票类型
     * @param $time     时间
     * @return mixed
     */
    public static function _getqishu2($type,$time){
        $datetime = $time.' 00:00:00';
        $qishu = LotterySchedule::find()->select('qishu')
            ->from($type)
            ->where(['<','datetime',$datetime]);
        $qishu = $qishu->orderBy('qishu desc');
        $qishu = $qishu->asArray()->one();
        return $qishu;
    }
    /**
     * 获取一天的总期数
     * @param $type     彩票类型
     * @param $time     时间
     * @return mixed
     */
    public static function _getCountnum($type,$time){
        $datetime = $time.' 00:02:00';
        if($time == date('Y-m-d')){
            $datetime2 = date('Y-m-d H:i:s');
        }else{
            $time = date('Y-m-d',strtotime("$time +1 day"));
            $datetime2 = $time.' 00:02:00';
        }
        $sum = LotterySchedule::find()->select('count(id) as sum')
            ->from($type)
            ->where(['and',['>','datetime',$datetime],['<','datetime',$datetime2]])
            ->asArray()->one();
        return $sum;
    }

    /**
     * 福彩3D和排列三是否漏采
     * @param $table    表名
     * @return array    lose:丢失的期号；static:采集状态
     */
    public static function _getP3D3lose($table){
        $lose = '';$static = '正常';
        $sql="SELECT CONVERT(qishu,SIGNED) AS qishu,CONCAT('第',CONVERT(right(qishu,3),SIGNED),'期') AS newqishu,CONVERT(right(qishu,3),SIGNED) AS newqs,'' AS qishu2 
              FROM $table WHERE DATE_FORMAT(CASE WHEN datetime IS NULL THEN create_time ELSE datetime END,'%Y')=DATE_FORMAT(CURDATE(),'%Y')ORDER BY qishu DESC";
        $r = Yii::$app->db->createCommand($sql)->queryAll();
        $arr = [];
        foreach ($r as $k1) {
            array_unshift($arr,$k1['newqs']);
        }
        for($i=1; $i<$r[0]['newqs']; $i++ ){
            if(!in_array($i,$arr)){
                $lose .= '第'.$i.'期,';
                $static = '异常';
            }
        }
        return [$lose,$static];
    }

    /**
     * 北京PK拾和北京快乐8是否漏采
     * @param $key          表名
     * @param $type         类型
     * @param $qishi_min    当日第一期期数
     * @param $qishi_max    当前时间最后一期期数
     * @param $time         查询时间
     * @return array
     */
    public static function _getBjknBjpklose($key,$type,$qishi_min,$qishi_max,$time){
        $lose = '';$static = '正常';
        if($time == date('Y-m-d')){
            $arr = self::_getU($type);
            $num = $arr[1];
        }else{
            $arr = self::_getLotterySum();
            $num = $arr["$key"];
        }
        $sql = "SELECT if(B.qishu IS NULL,($qishi_max-1)+A.qishu,B.qishu) AS qishu, CONCAT('第',A.qishu,'期') AS newqishu, 
CONVERT(A.qishu,SIGNED) AS newqs, B.qishu AS qishu2 
FROM lottery_schedule A LEFT JOIN (SELECT qishu,CASE WHEN MOD(qishu-$qishi_min,179)=0 THEN 179 ELSE MOD(qishu-$qishi_min,179) 
END AS newqishu,datetime FROM $key WHERE qishu >= (SELECT if(count(*)=0,$qishi_max,qishu) 
FROM $key WHERE MOD(qishu-$qishi_min, 179) = 1 AND DATE_FORMAT(datetime,'%Y-%m-%d')='$time' LIMIT 1) 
AND qishu <= (SELECT if(count(*)=0,($qishi_max-MOD($qishi_max-$qishi_min, 179))+179,qishu+(179-1)) FROM $key 
WHERE MOD(qishu-$qishi_min, 179) = 1 AND DATE_FORMAT(datetime,'%Y-%m-%d')='$time' LIMIT 1) ORDER BY qishu DESC ) B ON A.qishu=B.newqishu 
WHERE lottery_type='$type' AND A.qishu <= (SELECT CASE WHEN newqishu=0 THEN 0 ELSE CASE WHEN $num-newqishu >= 1 THEN $num ELSE newqishu END 
END AS newqishu FROM (SELECT CASE WHEN COUNT(*)=0 THEN 0 
ELSE CASE WHEN MOD(MAX(qishu)-$qishi_min,179)=0 THEN 179 ELSE MOD(MAX(qishu)-$qishi_min,179) END 
END AS newqishu FROM $key WHERE qishu >= (SELECT if(count(*)=0,$qishi_max,qishu) FROM $key 
WHERE MOD(qishu-$qishi_min, 179) = 1 AND DATE_FORMAT(datetime,'%Y-%m-%d')='$time' LIMIT 1) 
AND qishu <= (SELECT if(count(*)=0,($qishi_max-MOD($qishi_max-$qishi_min, 179))+179,qishu+(179-1)) 
FROM $key WHERE MOD(qishu-$qishi_min, 179) = 1 AND DATE_FORMAT(datetime,'%Y-%m-%d')='$time' LIMIT 1) ORDER BY qishu DESC LIMIT 1) AS C) 
ORDER BY CONVERT(A.qishu,SIGNED) DESC";
        $r = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($r as $k=>$v) {
            if(empty($v['qishu2'])){
                $lose .= $v['newqishu'].',';
                $static = '异常';
            }
        }
        return [$lose,$static];
    }

    public static function _getGxsf($key,$time){
        $lose = '';$static = '正常';
        $sql_qishu ="SELECT left(qishu,LENGTH(qishu)-2) AS partqs FROM lottery_result_gxsf
                        WHERE DATE_FORMAT(datetime,'%Y-%m-%d')= '$time' AND qishu like '%01'
                        ORDER BY qishu DESC";
        $r = Yii::$app->db->createCommand($sql_qishu)->queryOne();
        $like = $r['partqs'].'%';
        if($time == date('Y-m-d')){
            $arr = self::_getU('广西十分彩');
            $num = $arr[1];
        }else{
            $arr = self::_getLotterySum();
            $num = $arr["$key"];
        }
        $sql = "SELECT CONCAT(REPLACE(CURDATE(),'-',''),A.qishu) AS qishu, CONCAT('第',A.qishu,'期') AS newqishu,
CONVERT(A.qishu,SIGNED) AS newqs, B.qishu AS qishu2 FROM lottery_schedule A LEFT JOIN (SELECT qishu, RIGHT(qishu, 2) AS newqishu, datetime 
FROM $key WHERE DATE_FORMAT(datetime,'%Y-%m-%d')= '$time' AND qishu like '$like') B ON A.qishu = B.newqishu 
WHERE lottery_type = '广西十分彩' AND A.qishu <= (SELECT CASE WHEN COUNT(*)=0 THEN 0 ELSE CASE WHEN $num-qishu >= 1 THEN $num ELSE qishu END 
END AS qishu FROM (SELECT CONVERT(RIGHT(qishu, 2),SIGNED) AS qishu FROM $key 
WHERE DATE_FORMAT(datetime,'%Y-%m-%d')= '$time' AND qishu like '$like' ORDER BY qishu DESC LIMIT 1) AS C) ORDER BY qishu DESC";
        $r = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($r as $k=>$v) {
            if(empty($v['qishu2'])){
                $lose .= $v['newqishu'].',';
                $static = '异常';
            }
        }
        return [$lose,$static];
    }

    /**
     * 检测彩票开奖结果是否漏采
     * @param $key      表名
     * @param $type     彩种类型
     * @param $time     查询时间
     * @return array
     */
    public static function _getLotteryLose($key,$type,$time,$len,$start_qihao){
        $lose = '';$static = '正常';
        $arr = self::_getU($type);
        $count = $arr[0];$factqs = $arr['1'];
        if($time == date('Y-m-d')){
            $arr = self::_getU($type);
            $factqs = $arr[1];
        }else{
            $arr = self::_getLotterySum();
            $factqs = $arr["$key"];
        }
        $sql = "SELECT CONCAT(REPLACE('$time','-',''),A.qishu) AS qishu, CONCAT('第',A.qishu,'期') AS newqishu,CONVERT(A.qishu,SIGNED) AS newqs, B.qishu AS qishu2 
                 FROM lottery_schedule A LEFT JOIN 
                 (SELECT qishu, RIGHT(qishu, $len) AS newqishu, datetime FROM $key WHERE qishu >= CONCAT(REPLACE('$time', '-', ''), '$start_qihao') AND qishu <= CONCAT(REPLACE('$time', '-', ''), '$count')) B 
                 ON A.qishu = B.newqishu 
                 WHERE lottery_type = '$type'
                 AND A.qishu <= (SELECT CASE WHEN COUNT(*)=0 THEN 0 
                              ELSE 
                                    CASE WHEN $factqs-qishu >= 1 THEN $factqs
                                    ELSE qishu END 
                                END AS qishu 
            FROM (SELECT CONVERT(RIGHT(qishu, $len),SIGNED) AS qishu FROM $key 
            WHERE left(qishu,LENGTH(qishu)-$len)=replace('$time','-','') ORDER BY qishu DESC LIMIT 1) AS C) ORDER BY qishu DESC";
        $r = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($r as $k=>$v) {
            if(empty($v['qishu2'])){
                $lose .= $v['newqishu'].',';
                $static = '异常';
            }
        }
        return [$lose,$static];
    }

    function _getU($type){
        $sql = "select count(*) count_qishu from lottery_schedule WHERE lottery_type='$type'";
        $r1 = Yii::$app->db->createCommand($sql)->queryOne();
        $sql = "SELECT if(count(*)=0,0,qishu) AS factqs FROM lottery_schedule 
                 WHERE lottery_type = '$type' 
                 AND (NOW() >= CONCAT(DATE_FORMAT(NOW(), '%Y-%m-%d'), ' ', kaijiang_time) 
                 AND NOW() <= DATE_ADD(CONCAT(DATE_FORMAT(NOW(), '%Y-%m-%d'), ' ', kaijiang_time), INTERVAL 10 MINUTE))
                 ORDER BY id ASC";
        $r2 = Yii::$app->db->createCommand($sql)->queryOne();
        return [$r1['count_qishu'],$r2['factqs']];
    }
}