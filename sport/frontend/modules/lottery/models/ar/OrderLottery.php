<?php

namespace app\modules\lottery\models\ar;

use Yii;

/**
 * This is the model class for table "lottery_schedule".
 *
 * @property string $id
 * @property string $lottery_type
 * @property string $qishu
 * @property string $kaipan_time
 * @property string $fenpan_time
 * @property string $kaijiang_time
 * @property string $state
 * @property string $type
 */
class OrderLottery extends \yii\db\ActiveRecord
{
    //彩票 --和
    public static function getHe($s_time,$e_time,$id){
        if($id){
            $sql = "SELECT sum(IF(o_sub.is_win=2,o_sub.bet_money,0)) as bet_he
                FROM user_list u,order_lottery o,order_lottery_sub o_sub
                WHERE u.user_id in($id) AND o.order_num=o_sub.order_num AND o.user_id=u.user_id";
            if ($s_time) {
                $sql.=" and o.bet_time>='" . $s_time . "'";
            }
            if ($e_time)
                $sql.=" and o.bet_time<='" . $e_time . "'";
            $sql.=" group by o.user_id order by o_sub.id desc";
            $data = self::findBySql($sql)->asArray()->one();
            return $data['bet_he'];
        }
        return 0;
    }
	
	public static function getNewSchedule($lotteryName=null)
	{

		$currenttime=date('H:i:s', time());
		$query=self::find()
		->where('lottery_type=:lottery_type and kaipan_time<=:kaipan_time and kaijiang_time>:kaijiang_time', [':lottery_type' => $lotteryName,':kaipan_time'=>$currenttime,':kaijiang_time'=>$currenttime])
		->orderBy('id');
		
// 		$comman=$query->createCommand();
// 		echo $comman->sql;
		$rsarr=$query->asArray()->one();
		return $rsarr;

	}
	
	public static function getSumBetMoney($lottery_type,$qishu,$user_id)
	{
		$sql = "SELECT sum(bet_money) total_money FROM order_lottery WHERE Gtype='" . $lottery_type . "' and lottery_number='" . $qishu . "' and user_id='" . $user_id . "'";
		$query=self::findBySql($sql);
		$total=$query->scalar();
		return $total;
	}
	public static function getLotteryinfo($user_id,$lotteryName=null){
		$sql = self::find()->where(['user_id'=>$user_id,'Gtype' => $lotteryName])->orderBy('id DESC')->limit(25);
		$result = $sql->asArray()->all();
		return $result;
	}
}
