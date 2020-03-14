<?php
namespace app\modules\spsix\models;

use yii\db\ActiveRecord;

/**
 * SpsixLotteryOrderSub is the model behind the six_lottery_order_sub.
 */
class SpsixLotteryOrderSub extends ActiveRecord {
    public static function tableName()
    {
        return '{{spsix_lottery_order_sub}}';
    }
    /**
     * 添加订单信息
     * @param type $datereg                 单号
     * @param type $bet_info                号码，如1,2,3,单,双,大,小
     * @param type $bet_rate                下注赔率
     * @param type $bet_money_one           下注金额
     * @param type $win_money               可赢金额
     * @param type $fs_money                反水金额
     * @param type $balance                 下单后账号还有多少钱
     * @return type
     */
    static public function AddSixOrder($datereg,$bet_info,$bet_rate,$bet_money_one,$win_money,$fs_money,$balance,$gid,$params){
        if (($gid == 'SPbside') && (0 < intval($bet_info))) {
            $fs_money = 0;
        }
		if($bet_info){
			$_arr=explode(',',$bet_info);
			foreach($_arr as $k=>$v){
				$val=trim($v);
				if(is_numeric($val)){
					 $_arr[$k]=str_pad($val,2,'0',STR_PAD_LEFT);
				}
                if(!in_array($_arr[$k] ,$params[$gid],true)){//验证号码是否符合规则
                    return false;
                }
			}
            if(count($_arr)!=count(array_unique($_arr))){//过滤号码是否有重复
                return false;
            }
			$bet_info=implode(',',$_arr);
		}
		else{
            if(!in_array($bet_info ,$params[$gid],true)){
                return false;
            }
        }
        $subdata = new SpsixLotteryOrderSub;
        $subdata['order_num'] = $datereg;
        $subdata['number'] = $bet_info;
        $subdata['bet_rate'] = $bet_rate;
        $subdata['bet_money'] = $bet_money_one;
        $subdata['win'] = $win_money;
        $subdata['fs'] = $fs_money;
        $subdata['balance'] = $balance;
        $subdata->save();
        return $subdata['id'];
    }
    /**
     * 增加子订单号
     * @param type $id_sub          该表ID
     * @param type $datereg_sub     子订单号
     */
    static public function UpdateSixOrder($id_sub,$datereg_sub){
        $subdata = SpsixLotteryOrderSub::find()
                    ->where(['id'=>$id_sub])
                    ->one();
        $subdata['order_sub_num'] = $datereg_sub;
        $r = $subdata->save();
        return $r;
    }
    /**
     * 删除订单明细
     * @param type $id_sub      订单ID
     */
    static public function DelSixOrder($id_sub){
        $r = SpsixLotteryOrderSub::findOne($id_sub);
        $r->delete();
    }
}
