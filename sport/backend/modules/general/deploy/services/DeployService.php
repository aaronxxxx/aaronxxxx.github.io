<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/28
 * Time: 15:07
 */

namespace app\modules\general\deploy\services;

use Yii;
use Exception;
use app\common\base\BaseService;
use app\modules\core\common\models\SysManage;

class DeployService extends BaseService
{
    /**
     * 修改配置文件
     * 图片ip地址、安全码端口、安全码开关、后台管理员登录白名单
     * @param $json     json格式数据包
     * @return int      状态码  1：成功  2：失败
     */
    public function configs($json) {
        try {
            //$json = file_get_contents(Yii::$app->basePath . '/config/params.json');
            $json = json_decode($json, true);
            $resouceDomain = "'http://" . $json['resouceDomain'] . ":82'";
            $resouceDomain = "'resouceDomain' =>$resouceDomain ";
            $securityCodeUrl = "'http://119.42.144.74:" . $json['securityCodeUrl'] . "'";
            $securityCodeUrl = "'securityCodeUrl' =>$securityCodeUrl ";
            $securityCodeEnable = "'securityCodeEnable' =>true ";
            if (!$json['securityCodeEnable']) {
                $securityCodeEnable = "'securityCodeEnable' =>false ";
            }
            $configs = "<?php \r\n";
            $configs .= "return [ \r\n";
            $configs .= "$resouceDomain,\r\n";
            $configs .= "$securityCodeUrl,\r\n";
            $configs .= "$securityCodeEnable,\r\n";
            $configs .= "]\r\n";
            $configs .= "?>";
            file_put_contents(Yii::$app->basePath . "/config/configs.php", $configs);
            if(isset($json['whitelist']) && !empty($json['whitelist'])){
                $whitle_ip = '';
                $arr = explode(',',$json['whitelist']);
                foreach($arr as $key=>$val){
                    $whitle_ip .= "'".$val."',";
                }
                $whitle_ip = rtrim($whitle_ip, ",");
                $whitlelist = "<?php \r\n";
                $whitlelist .= "return [ \r\n";
                $whitlelist .= "$whitle_ip \r\n";
                $whitlelist .= "]\r\n";
                $whitlelist .= "?>";
                file_put_contents(Yii::$app->basePath ."/config/whitelist.php", $whitlelist);
            }else{
                $whitlelist = "<?php \r\n";
                $whitlelist .= "return [ \r\n";
                $whitlelist .= " \r\n";
                $whitlelist .= "]\r\n";
                $whitlelist .= "?>";
                file_put_contents(Yii::$app->basePath ."/config/whitelist.php", $whitlelist);
            }
            return 1;
        } catch (Exception $e) {
            return 2;
        }
    }
    /**
     * 修改配置文件
     * 修改php的后台连接db密码
     * @param $json     json格式数据包
     * @return int      状态码  1：成功  2：失败
     */
    public function dbpwd($json){
        try {
            //$json = file_get_contents(Yii::$app->basePath . '/config/params.json');
            $json = json_decode($json, true);
            $pwd = $json['pwd'];
            $db = "<?php \r\n";
            $db .= "return [ \r\n";
            $db .= "'class' => 'yii\db\Connection', \r\n";
            $db .= "'dsn' => 'mysql:host=127.0.0.1;port=3309;dbname=casino_db', \r\n";
            $db .= "'username' => 'root', \r\n";
            $db .= "'password' => '".$pwd."', \r\n";
            $db .= "'charset' => 'utf8', \r\n";
            $db .= "'enableSchemaCache' => true, \r\n";
            $db .= "'schemaCache' => 'cache', \r\n";
            $db .= "]\r\n";
            $db .= "?>";
            file_put_contents(Yii::$app->basePath . "/config/db.php", $db);
            return 1;
        } catch (Exception $e) {
            return 2;
        }
    }

    /**
     * 重置管理员密码
     * （重置后数数据库密码默认为：123456）
     * @param $name 管理员姓名
     * @return int  状态码  1：成功  2：失败
     */
    public function resetpwd($name){
        try {
            $admin =  SysManage::find()->where(['manage_name'=> $name])->one();
            $admin->manage_pass = 'dae275bdd53dafe0a7ece2ef62138e15';
            $admin->save();
            return 1;
        }catch (Exception $e){
            return 2;
        }
    }

    /**
     * 清除指定时间内的数据    (固定保留三个月的有效数据)
     * @return int             状态码  1：成功  2：失败
     */
    public function clean(){
        $endTime= date("Y-m-d H:i:s",time());
        $startTime = date("Y-m-d H:i:s",strtotime("-3 month"));
        try {
            $connection = Yii::$app->db;
            $command = $connection->createCommand('DELETE FROM agents_money_log WHERE do_time<=:startTime or do_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM history_bank WHERE addtime<=:startTime or addtime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM history_login WHERE login_time<=:startTime or login_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM live_fs_list WHERE fstime<=:startTime or fstime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM live_log WHERE do_time<=:startTime or do_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM live_order WHERE order_time<=:startTime or order_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_bjkn WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_bjpk WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_cq WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_cqsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_d3 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_gd11 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_gdsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_gxsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_lhc WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_p3 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_t3 WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_tj WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM lottery_result_tjsf WHERE datetime<=:startTime or datetime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM money WHERE update_time<=:startTime or update_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM money_log WHERE update_time<=:startTime or update_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE order_lottery,order_lottery_sub FROM order_lottery,order_lottery_sub WHERE order_lottery.order_num=order_lottery_sub.order_num and (order_lottery.bet_time<=:startTime or order_lottery.bet_time>=:endTime)');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE six_lottery_order,six_lottery_order_sub FROM six_lottery_order,six_lottery_order_sub WHERE six_lottery_order.order_num=six_lottery_order_sub.order_num and (six_lottery_order.bet_time<=:startTime or six_lottery_order.bet_time>=:endTime)');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM pay_error_log WHERE update_time<=:startTime or update_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM six_lottery_log WHERE create_time<=:startTime or create_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM sys_announcement WHERE end_time<=:startTime or end_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM user_log WHERE edtime<=:startTime or edtime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM user_msg WHERE msg_time<=:startTime or msg_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM six_lottery_log WHERE create_time<=:startTime or create_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            return 1;
        } catch (Exception $e) {
            return 2;
        }
    }


}