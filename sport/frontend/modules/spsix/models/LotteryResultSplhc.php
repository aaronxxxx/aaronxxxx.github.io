<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * 极速六合彩开奖结果
 * LotteryResultSplhc is the model behind the lottery_result_splhc.
 */
class LotteryResultSplhc extends ActiveRecord {
    /**
     * 查询开奖结果
     * @param string $qishu 期数 为空则为查询全部
     * @param string $limit 查询条数，为空则为查询全部
     * @param string $time 起始时间
     * @return array|ActiveRecord[]
     */

    static public function getSixResult($qishu='',$limit='',$time=''){
        $rows = LotteryResultSplhc::find()
            ->orderBy(array('qishu'=>SORT_DESC));
        if(!empty($qishu)){
            $rows->andWhere('qishu=:qishu',[':qishu'=>$qishu]);
        }
        // if(!empty($time)){
            $rows->andWhere('create_time>=:create_time',[':create_time'=>date("Y-m-d 00:00:00")]);

            //避免預開獎號 顯示
            $rows->andWhere('datetime <= NOW()');
        // }
        if(!empty($limit)){
            $rows->limit($limit);
        }
         $result = $rows->asArray()->all();
        return $result;
    }
    
    static public function getSixResultByQishu($qishu){
    	$rows=LotteryResultSplhc::find()->asArray()->where(['qishu'=>$qishu])->all();
        if($rows){
            return $rows[0];
        }
    	return false;
    }
}
