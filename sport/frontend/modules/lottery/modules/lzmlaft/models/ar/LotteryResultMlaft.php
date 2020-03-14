<?php

namespace app\modules\lottery\modules\lzmlaft\models\ar;

use Yii;

/**
 * This is the model class for table "lottery_result_mlaft".
 *
 * @property string $id
 * @property string $qishu
 * @property string $create_time
 * @property string $datetime
 * @property string $state
 * @property string $prev_text
 * @property integer $ball_1
 * @property integer $ball_2
 * @property integer $ball_3
 * @property integer $ball_4
 * @property integer $ball_5
 */
class LotteryResultMlaft extends \yii\db\ActiveRecord
{
	public static function getKJResult()
	{
        $lastResult = "select * from lottery_result_mlaft where datetime <= NOW() order by datetime desc limit 1";
        $rsarr = self::findBySql($lastResult)->asArray()->one();
        return $rsarr;
	}

	public static function getResultList($qishu_query=null,$query_time=null)
	{
		if($qishu_query==null){
            // $query_time = date ( "Ymd", strtotime($query_time) );//跨天需要另外的參數
            $rslist=self::find()->where('DATE_FORMAT(datetime,"%Y-%m-%d") = :query_time', [':query_time' => $query_time])->orderBy(['qishu' => SORT_DESC,])
			->asArray()
			->all();
			return $rslist;
		}else{
			$rslist=self::find()->where('DATE_FORMAT(datetime,"%Y-%m-%d") = :query_time and qishu=:qishu', [':query_time' => $query_time,':qishu'=>$qishu_query])->orderBy(['qishu' => SORT_DESC,])
			->asArray()
			->all();
			return $rslist;
		}
	}
	//pk10 露珠图  $type:1:大小,0:单双
    public static function _pk10($list=array()){
        if(!is_array($list)||(count($list)==0)){
            $arr=array();
            for($i=0;$i<6;$i++){
                for($j=0;$j<35;$j++){
                    $arr[$i][$j]=array();
                }
            }
            $return=array(
                '1'=>$arr
            );
            return $return;
        }
        //横向列表
        $m_arr=array();
        $s_arr=array();
        $max=count($list)-1;
        $isSingle=$list[0]['longhuhe'];
        foreach($list as $k=>$v){
            $cilent_s=$v['longhuhe'];

                if($cilent_s == $isSingle){
                    $s_arr[]=$v;
                }else{
                    $m_arr[]=$s_arr;
                    $s_arr=array($v);
                    $isSingle=$cilent_s;
                }
            }
            if($max==$k){//最后的一组别忘了存入数组,不然会莫名丢了一组
                $m_arr[]=$s_arr;
            }

        	//print_r($m_arr);exit;
        $n_arr=self::mid($m_arr);
        //	print_r($n_arr);exit;
       // return $this->modify($n_arr);
    }
}
