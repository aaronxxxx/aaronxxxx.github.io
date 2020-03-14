<?php
namespace app\modules\six\models;

use yii\db\ActiveRecord;

/**
 * 六合彩开奖结果
 * LotteryResultLhc is the model behind the lottery_result_lhc.
 */
class LotteryResultLhc extends ActiveRecord {

    /**
     * 查询开奖结果
     * @param string $qishu 期数 为空则为查询全部
     * @param string $limit 查询条数，为空则为查询全部
     * @param string $time 起始时间
     * @return array|ActiveRecord[]
     */
    static public function getSixResult($qishu='',$limit='',$time=''){
        $rows = LotteryResultLhc::find()
            ->orderBy(array('qishu'=>SORT_DESC));
        if(!empty($qishu)){
            $rows->andWhere('qishu=:qishu',[':qishu'=>$qishu]);
        }
        if(!empty($time)){
            $rows->andWhere('create_time>=:create_time',[':create_time'=>$time]);
        }
        if(!empty($limit)){
            $rows->limit($limit);
        }
         $result = $rows->asArray()->all();
        return $result;
    }
    
    static public function getSixResultByQishu($qishu){
    	$rows=LotteryResultLhc::find()->asArray()->where(['qishu'=>$qishu])->all();
        if($rows){
            return $rows[0];
        }
    	return false;
    }
}
