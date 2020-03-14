<?php

namespace app\modules\general\sysmng\models\ar;

use yii\db\ActiveRecord;

/**
 * SysConfig is the model behind the sys_config.
 */
class UserLevel extends ActiveRecord {

    /*
     * 修改彩票下注金额限制
     *  @param e $group_id    用户组ID
     *  @param type $bets     下注金额限制
     */
    static public function updateLevel($insert){
        $result = false;

            foreach ($insert as $key=>$val){

                $data = UserLevel::findOne(array('level_id'=>$val['level_id']));
                if($data) {
                    $data->level_name = $val['level_name'];
                    $data->day_bet = $val['day_bet'];
                    $data->day_recharge = $val['day_recharge'];
                    $data->qishu_max_bet = $val['qishu_max_bet'];
                    $data->day_withdraw = $val['day_withdraw'];
                    $data->over_fee = $val['over_fee'];
                    $result = $data->save();
                }

                
            }

        
        return $result;
    }

}
