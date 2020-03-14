<?php
namespace app\modules\core\passport\controllers;

use app\common\base\BaseController;
use app\common\clients\AdminClient;
use app\common\helpers\LogUtils;
use app\modules\core\common\models\UserList;
use app\modules\live\models\LiveOrder;
use Exception;
use Yii;

/**Index controller*/
class IndexController extends BaseController
{
    public $code;

    public function init()
    {//初始化函数
        parent::init();
        $this->layout = "main";
    }

    public function actionIndex()
    {//网站(默认)主页)
        return $this->render("index");
    }

    public function actionMsgs()
    {
        try {
            $tknum = Yii::$app->db->createCommand("select count(id) as s from money where  type='用户提款' and status='未结算'")->queryScalar(); //提款
            $hknum = Yii::$app->db->createCommand("select count(id) as s from money where order_value>0 and type='银行汇款' and status='未结算'")->queryScalar(); //汇款
            $cknum = Yii::$app->db->createCommand("select count(id) as s from money where order_value>0 and type='在线支付' and status='未结算'")->queryScalar(); //汇款
            $ernum = Yii::$app->db->createCommand("select count(id) as s from user_list where status='异常'")->queryScalar();
            $dlnum = Yii::$app->db->createCommand("select COUNT(id) dlnum  from agents_list where remark is null")->queryScalar();
            $data = [
                'dlnum' => $dlnum,
                'tknum' => $tknum,
                'hknum' => $hknum,
                'cknum' => $cknum,
                'ernum' => $ernum,
            ];
            return $this->outData($data);
        } catch (Exception $e) {
            LogUtils::error($e->getMessage());
            return $this->out(false, '获取系统消息数据失败');
        }
    }

    /**
     * 首页获取统计数据
     * @return string
     */
    public function actionGetdata()
    {
        $today = date("Y-m-d");
        //会员总数 2019/01/22 修正為點擊查詢
        // $hyzs = Yii::$app->db->createCommand('select count(id) as s from user_list')->queryScalar();
        //首次提款会员总数
        $sql = "select * from 
        (SELECT u.id,u.user_id,count(m.id),left(m.update_time,10) as update_time FROM `user_list` as u INNER JOIN `money` as m on u.user_id=m.user_id WHERE m.status = '成功' AND m.type IN ('用户提款') GROUP BY u.id) 
        as todayList 
        where update_time = curdate()";
        $ftms = Yii::$app->db->createCommand($sql)->queryAll(); //找出只有存过一次的会员与记录
        $ftms = count($ftms);
        //首次存款会员总数
        $sql = "select * from 
        (SELECT u.id,u.user_id,count(m.id),left(m.update_time,10) as update_time FROM `user_list` as u INNER JOIN `money` as m on u.user_id=m.user_id WHERE m.status = '成功' AND m.type IN ('后台充值','银行汇款','在线支付') GROUP BY u.id) 
        as todayList 
        where update_time = curdate()";
        $fcms = Yii::$app->db->createCommand($sql)->queryAll(); //找出只有存过一次的会员与记录
        $fcms = count($fcms);
        //今日充值會員 today-save-money-member
        $tsmm = Yii::$app->db->createCommand("select (user_id) from money where `status`='成功' and (`type`='在线支付' or `type`='后台充值' or `type`='银行汇款') and date(update_time) = curdate() GROUP BY user_id")->queryAll();
        $tsmm = count($tsmm);
        //今日出款會員 today-ti-money-member
        $ttmm = Yii::$app->db->createCommand("select (user_id) from money where `status`='成功' and (`type`='用户提款') and date(update_time) = curdate() GROUP BY user_id")->queryAll();
        $ttmm = count($ttmm);
        //今日新增会员数
        $jrhy = Yii::$app->db->createCommand("select count(id) as s from user_list where regtime like ('" . $today . "%')")->queryScalar();
        //今日曾经在线会员数
        $cjdl_count = Yii::$app->db->createCommand("select count(id) as s from user_list where onlinetime like ('" . $today . "%')")->queryScalar();
        //注单总数 2019/01/22 修正為點擊查詢
        $bet_count = 0;
        //彩票(today)
        $cp_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from order_lottery t1,order_lottery_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE()")->queryScalar();
        $bet_count += $cp_order_count;
        //六合彩(today)
        $lhc_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from six_lottery_order t1,six_lottery_order_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE()")->queryScalar();;
        $bet_count += $lhc_order_count;
        //極速六合彩(today)
        $splhc_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from spsix_lottery_order t1,spsix_lottery_order_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE()")->queryScalar();;
        $bet_count += $splhc_order_count;

        $tixian_today = $cunkuan_today = 0;
        $moneyList = Yii::$app->db->createCommand("select order_value from money where `status`='成功' and (`type`='在线支付' or `type`='用户提款') and update_time like('" . $today . "%')")->queryAll();
        foreach ($moneyList as $rows) {
            if ($rows['order_value'] < 0) {
                $tixian_today++;
            } else {
                $cunkuan_today++;
            }
        }
        $huikuan_today = Yii::$app->db->createCommand("select count(id) as s from money where `status`='成功' and `type`='银行汇款' and `update_time` like('" . $today . "%')")->queryScalar();
        $dlnum = Yii::$app->db->createCommand("select COUNT(id) dlnum  from agents_list where remark is null")->queryScalar();
        $expired_time = date("Y-m-d H:i:s", time() - 3600);
        UserList::updateAll(['online' => 0, 'Oid' => null], "TIMESTAMPDIFF(SECOND,logouttime,:expired_time)>0", [':expired_time' => $expired_time]);
        $onlineUser = Yii::$app->db->createCommand("select COUNT(id) from user_list where `online`='1'")->queryScalar();
        $pcUser = Yii::$app->db->createCommand("select COUNT(id) from user_list where `online`='1' and `device_type` = 0")->queryScalar();
        $mobileUser = Yii::$app->db->createCommand("select COUNT(id) from user_list where `online`='1' and `device_type` = 1")->queryScalar();
        //圓餅圖 2019/01/22 修正為 注单总数 點擊查詢
        // $betData = [];
        // $betData = $this->_betStatistics($cp_order_count, $lhc_order_count,$splhc_order_count);
        //var_dump($cp_order_count);
        return $this->outData([
            // 'hyzs' => empty($hyzs) ? 0 : $hyzs,
            'ftms' => empty($ftms) ? 0 : $ftms,
            'tsmm' => empty($tsmm) ? 0 : $tsmm,
            'ttmm' => empty($ttmm) ? 0 : $ttmm,
            'fcms' => empty($fcms) ? 0 : $fcms,
                'jrhy' => empty($jrhy) ? 0 : $jrhy,
                'cjdl_count' => empty($cjdl_count) ? 0 : $cjdl_count,
                // 'bet_count' => empty($bet_count) ? 0 : $bet_count,
                'tixian_today' => empty($tixian_today) ? 0 : $tixian_today,
                'cunkuan_today' => empty($cunkuan_today) ? 0 : $cunkuan_today,
                'huikuan_today' => empty($huikuan_today) ? 0 : $huikuan_today,
                'dlnum' => empty($dlnum) ? 0 : $dlnum,
                'onlineUser' => empty($onlineUser) ? 0 : $onlineUser,
                'pcUser'=>empty($pcUser)?0:$pcUser,
                'mobileUser'=>empty($mobileUser)?0:$mobileUser,
                'betData' => empty($betData) ? [] : $betData
            ]);
    }


    /* 2019/01/22 新增點擊查詢資訊 */
    public function actionInfo()
    {
        $post=Yii::$app->request->post();
        $case = $post['type'];
        $result = array();
        $ExcludeGroup = $this->_getExcludeGroup();
        switch($case){
            case "hyzs": //会员总数
                $result['result'] = Yii::$app->db->createCommand('select count(id) as s from user_list')->queryScalar();
                return $this->outData($result);
                break;

            case "bet_count": //注单总数
                //彩票(today)
                $cp_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from order_lottery t1,order_lottery_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE()")->queryScalar();
                //六合彩(today)
                $lhc_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from six_lottery_order t1,six_lottery_order_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE()")->queryScalar();;
                //極速六合彩(today)
                $splhc_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from spsix_lottery_order t1,spsix_lottery_order_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE()")->queryScalar();;
                $betData = [];
                $betData = $this->_betStatistics($cp_order_count, $lhc_order_count,$splhc_order_count,$ExcludeGroup);
                $result['betData'] = $betData;
                $result['result'] = array_sum( array_column($betData, 'value') );
                return $this->outData($result);
                break;

            default:
                return $this->out(false, '获取資料失敗');

        }

    }

        /**
        * 获取各厅额度
        * @return string
     */
    public function actionHallbalance()
    {
        try {
            $adminClient = new AdminClient();
            $hall_balance = $adminClient->getHallLimitBalance();
            $hall_balance['user_live_all'] = array_sum($hall_balance);
            $sql = "SELECT sum(money) as money
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name <> '测试组会员'";
            $user_all_money = Yii::$app->db->createCommand($sql)->queryAll()[0]['money'];
            $hall_balance['user_money_all'] = $user_all_money;
            return $this->outData($hall_balance);
        } catch (Exception $e) {
            return $this->out(false, '获取各厅的限额数据失败');
        }
    }
    public function actionUserbalance()
    {
        $result = array();
        try {
            $sql = "SELECT sum(money) as money
            FROM user_list as ul 
            INNER JOIN user_group as ug on ul.group_id= ug.group_id
            WHERE ug.group_name <> '测试组会员'";
            $user_all_money = Yii::$app->db->createCommand($sql)->queryAll()[0]['money'];
            $result['user_money_all'] = $user_all_money;//user 全部金額(排除測試會員組)
            $sql = "SELECT sum(live_money) as money
            FROM live_user";
            $live_all_money = Yii::$app->db->createCommand($sql)->queryAll()[0]['money'];
            $result['live_money_all'] = $live_all_money;//user 全部金額(排除測試會員組)
            return $this->outData($result);
        } catch (Exception $e) {
            return $this->out(false, '获取資料失敗');
        }
    }

    private function _betStatistics($cp_order_count, $lhc_order_count, $splhc_order_count,$ExcludeGroup)
    {
        $result = [];
        try {
            $sql = "SELECT count(id)
            FROM live_order
            WHERE order_time > curdate()
            AND game_type='KG'";
            $chese_order_count = Yii::$app->db->createCommand($sql)->queryScalar();
            $pe_order_count = LiveOrder::getPeOrderCount(null,null,date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"));
            $live_order_count = LiveOrder::getLiveOrderCount(null,null,date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"));
            $egame_order_count = LiveOrder::getEgameOrderCount(null,null,date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"));
            array_push($result, ['value' => $live_order_count['count'] - $ExcludeGroup['live_order_count'], 'title' => '真人游戏注单', 'color' => $this->_getColor(3), 'colors' => $this->_getColors(3)]);
            array_push($result, ['value' => $chese_order_count - $ExcludeGroup['chese_order_count'], 'title' => '棋牌游戏', 'color' => $this->_getColor(4), 'colors' => $this->_getColors(4)]);
            array_push($result, ['value' => $egame_order_count['count'] - $ExcludeGroup['egame_order_count'], 'title' => '电子游戏注单', 'color' => $this->_getColor(5), 'colors' => $this->_getColors(5)]);
            array_push($result, ['value' => $cp_order_count - $ExcludeGroup['cp_order_count'], 'title' => '彩票注单', 'color' => $this->_getColor(0), 'colors' => $this->_getColors(0)]);
            array_push($result, ['value' => $pe_order_count['count'] - $ExcludeGroup['pe_order_count'], 'title' => '体育注单', 'color' => $this->_getColor(6), 'colors' => $this->_getColors(6)]);
            array_push($result, ['value' => $lhc_order_count - $ExcludeGroup['lhc_order_count'], 'title' => '六合彩注单', 'color' =>  $this->_getColor(1), 'colors' => $this->_getColors(1)]);
            array_push($result, ['value' => $splhc_order_count - $ExcludeGroup['splhc_order_count'], 'title' => '极速六合彩注单', 'color' =>  $this->_getColor(2), 'colors' => $this->_getColors(2)]);

        } catch (Exception $e) {
            LogUtils::error($e->getMessage());
        }
        
        //var_dump($result);
        return $result;
    }

    private function _getColor($num)
    {
        if ($num == 0) return '#4F81BD';
        else if ($num == 1) return '#C0504D';
        else if ($num == 2) return '#9BBB59';
        else if ($num == 3) return '#8064A2';
        else if ($num == 4) return '#88857D';
        else if ($num == 5) return '#f5c583';
        else if ($num == 6) return '#E3DF31';
    }
    private function _getColors($num)
    {
        if ($num == 0) return '#5555FF';
        else if ($num == 1) return '#865850';
        else if ($num == 2) return '#fc7eb6';
        else if ($num == 3) return '#f17e3c';
        else if ($num == 4) return '#338b9f';
        else if ($num == 5) return '#f5c583';
        else if ($num == 6) return '#d54f4d';
    }
    public function actionTest(){
        self::_getExcludeGroup();
    }
    private function _getExcludeGroup() //統計排除會員組的數據
    {
        $member_count = 0 ; //排除會員總數
        $cp_order_count = 0; //彩票(today)
        $lhc_order_count = 0; //六合彩(today)
        $splhc_order_count = 0; //極速六合彩(today)
        $chese_order_count = 0;
        $pe_order_count = 0;
        $live_order_count = 0;
        $egame_order_count = 0;
        $sql = "SELECT ul.user_id 
        FROM user_list as ul 
        INNER JOIN user_group as ug on ul.group_id= ug.group_id
        WHERE ug.group_name = '测试组会员'";
        $userid = Yii::$app->db->createCommand($sql)->queryAll(); //找出這個'测试组会员'會員組的所有id
        $member_count = count($userid);
        if( !$userid ){     //假設沒資料
            return false;
        }
        else{
            $userid = implode(',',array_column($userid, 'user_id'));
            //彩票(today)
            $cp_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from order_lottery t1,order_lottery_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE() and t1.user_id IN ($userid)")->queryScalar();
            //六合彩(today)
            $lhc_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from six_lottery_order t1,six_lottery_order_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE() and t1.user_id IN ($userid)")->queryScalar();
            //極速六合彩(today)
            $splhc_order_count = Yii::$app->db->createCommand("select count(t2.id) as s from spsix_lottery_order t1,spsix_lottery_order_sub t2 where t1.order_num=t2.order_num and t1.bet_time > CURDATE() and t1.user_id IN ($userid)")->queryScalar();
            $chese_order_count = 0; //最後補上
            $pe_order_count = LiveOrder::getPeOrderCount($userid,null,date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"))['count'];
            $live_order_count = LiveOrder::getLiveOrderCount($userid,null,date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"))['count'];
            $egame_order_count = LiveOrder::getEgameOrderCount($userid,null,date("Y-m-d 00:00:00"),date("Y-m-d 23:59:59"))['count'];
        }
        return ([
            'member_count' => $member_count,
            'cp_order_count' => $cp_order_count,
            'lhc_order_count' => $lhc_order_count,
            'splhc_order_count' => $splhc_order_count,
            'chese_order_count' => $chese_order_count,
            'pe_order_count' => $pe_order_count,
            'live_order_count' => $live_order_count,
            'egame_order_count' => $egame_order_count,
        ]);


    }
}
