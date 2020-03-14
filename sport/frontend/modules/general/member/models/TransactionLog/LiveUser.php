<?php
namespace app\modules\general\member\models\TransactionLog;

use app\modules\general\member\models\Pagination;
use yii\db\ActiveRecord;

/**
 * LiveUser is the model behind the live_user.
 */
class LiveUser extends ActiveRecord{
    /**
     * 
     * @global type $mysqli
     * @param type $dayStart
     * @param type $dayEnd
     * @param type $user_group
     * @param type $statusString
     * @return type
     */
    public static function getLiveBetMoneyAndCount($dayStart,$dayEnd,$user_group="",$statusString=""){
        $oneDayStart =  date($dayStart.' 00:00:00', strtotime("-12 hours"));
        $oneDayEnd =  date($dayEnd.' 23:59:59', strtotime("-12 hours"));

        //20180321@robin mark
        //$sql = "SELECT count(lo.id) bet_count,IFNULL(SUM(IF(lo.bet_money>0,lo.bet_money,0)),0) bet_money_total,
            //IFNULL(SUM(IF(lo.valid_bet_amount>0,lo.valid_bet_amount,0)),0) val_money_total, SUM(live_win) win_total
                    //FROM live_user l,live_order lo
                    //WHERE l.live_username=lo.live_username
                    /*AND l.live_type=lo.game_type        */        
                    //AND lo.order_time >= '".$oneDayStart."' AND lo.order_time <='".$oneDayEnd."'
                    //";

        $sql = "SELECT count(lo.id) bet_count,IFNULL(SUM(IF(lo.bet_money>0,lo.bet_money,0)),0) bet_money_total,
                IFNULL(SUM(IF(lo.valid_bet_amount>0,lo.valid_bet_amount,0)),0) val_money_total, IFNULL(SUM(IF(lo.live_win is not null,lo.live_win,0)),0) win_total
                FROM live_order lo 
                WHERE lo.order_time >= '".$oneDayStart."' AND lo.order_time <='".$oneDayEnd."'";

        if($user_group != ""){
            //$sql .= " AND l.user_id = $user_group";        //20180321@robin mark
            $sql .= "AND lo.live_username IN (Select DISTINCT live_username From live_user Where user_id=$user_group)";     //20180321@robin add
        }

        if($statusString != ""){
            $sql .= $statusString;
        }

        $sql .= " LIMIT 0,1";

        $query	= LiveUser::findBySql($sql)->asArray()->all();
        return $query[0];
    }
    
    public static function getLiveDetail($start_time,$end_time,$user_id){
        $sql = "SELECT l.order_num,l.order_time,l.live_type,l.bet_info,l.bet_money,l.valid_bet_amount,l.live_win,l.game_type "
            /*. "FROM live_user u ,live_order l"*/         //20180324@robin mark
            ."FROM live_order l"
            . " WHERE l.order_time>='$start_time' "
            . "and l.order_time<='$end_time' "
            . "AND l.live_username IN (Select DISTINCT u.live_username From live_user u Where user_id='$user_id')";       //20180324@robin add
            /*. "AND l.live_username=u.live_username "*/   //20180324@robin mark
            /*. "AND l.game_type=u.live_type "*/           //20180319@robin mark
            /*. "AND u.user_id='$user_id' ";*/             //20180324@robin mark
        $query	= LiveUser::findBySql($sql)->asArray()->all();
        $sum = count($query);
        $page_obj = new Pagination($sum); 
        $sql = "SELECT l.order_num,l.order_time,l.live_type,l.bet_info,l.bet_money,l.valid_bet_amount,l.live_win,l.game_type "
              . "FROM live_order l"                      //20180324@robin add
            /*. "FROM live_user u ,live_order l" */      //20180324@robin mark
            . " WHERE l.order_time>='$start_time' "
            . "and l.order_time<='$end_time' "
            /*. "AND l.live_username=u.live_username "*/  //20180324@robin mark
            /* . "AND l.game_type=u.live_type "   */       //20180319@robin mark
            /*. "AND u.user_id='$user_id' $page_obj->limit ";*/
              . "AND l.live_username IN (Select DISTINCT u.live_username From live_user u Where user_id='$user_id') $page_obj->limit";
        $query	= LiveUser::findBySql($sql)->asArray()->all();
        $page_list = $page_obj->fpage(array(3,4,5,6,7));
        return array($query,$page_list);
    }

}
