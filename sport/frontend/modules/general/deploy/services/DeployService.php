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
use app\common\helpers\LogUtils;
use app\common\base\BaseService;
use app\modules\core\common\models\SysManage;
use app\modules\general\deploy\models\MysqlBack;
use app\modules\general\member\models\ar\MoneyLog;
use app\modules\live\models\LiveRpcConfig;
use app\modules\general\deploy\Util\DeplayUtils;

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
            $configs = require(Yii::$app->basePath . "/config/configs.php");
            $cjDomain = "http://127.0.0.1";
            if(empty($json['cjDomain'])){
                $resouceDomain = "'http://" . $json['resouceDomain'] . ":82'";
                $resouceDomain = "'resouceDomain' =>$resouceDomain ";
                $securityCodeUrl = "'http://" . $json['securityCodeUrl'] . "'";
                $securityCodeUrl = "'securityCodeUrl' =>$securityCodeUrl ";
                $securityCodeEnable = "'securityCodeEnable' =>true ";
                if (!$json['securityCodeEnable']) {
                    $securityCodeEnable = "'securityCodeEnable' =>false ";
                }
                foreach ($configs as $k => $v) {
                    if($k == 'cjDomain'){
                        $cjDomain = $v;
                    }
                }
            }else{
                foreach ($configs as $k => $v) {
                    if($k == 'resouceDomain'){
                        $resouceDomain = "'resouceDomain' => '$v' ";
                    } else if($k == 'securityCodeUrl'){
                        $securityCodeUrl = "'securityCodeUrl' => '$v'";
                    } else if($k == 'securityCodeEnable'){
                        if($v == 1){
                            $securityCodeEnable = "'securityCodeEnable' => true ";
                        }else{
                            $securityCodeEnable = "'securityCodeEnable' => false ";
                        }
                    }
                }
                $cjDomain = "http://" . $json['cjDomain'] . "";
            }
            $cjDomain = "'cjDomain' =>'$cjDomain' ";
            $configs = "<?php \r\n";
            $configs .= "return [ \r\n";
            $configs .= "$resouceDomain,\r\n";
            $configs .= "$securityCodeUrl,\r\n";
            $configs .= "$securityCodeEnable,\r\n";
            $configs .= "$cjDomain,\r\n";
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
            if(!$admin){
                return 2;
            }
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
            $moneylogIds = [];
            $moneylogId = MoneyLog::find()
                ->select('m.id')
                ->from('money_log as m')
                ->innerJoin('user_list as u','m.user_id = u.user_id')
                ->orderBy('m.id desc')
                ->limit('100')
                ->asArray()
                ->all();
            foreach ($moneylogId as $value) {
                array_unshift($moneylogIds,$value['id']);
            }
//            MoneyLog::deleteAll(['not in','id',$moneylogIds]);
            $connection->createCommand()->delete('money_log', ['not in','id',$moneylogIds])->execute();
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
			$command = $connection->createCommand('DELETE FROM trace_log WHERE log_time<=:startTime or log_time>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            $command = $connection->createCommand('DELETE FROM trace_speed WHERE createTime<=:startTime or createTime>=:endTime');
            $command->bindParam(':startTime', $startTime);
            $command->bindParam(':endTime', $endTime);
            $command->execute();
            return 1;
        } catch (Exception $e) {
            return 2;
        }
    }

    /**
     * 修改真人配置
     * @param $namePrefix  真人名前缀
     * @param $clientName  客户端名
     * @param $serverFolder
     * @return int 1：成功 2：失败
     */
    public function LiveConfig($namePrefix,$clientName,$serverFolder){
        try{
            $data = LiveRpcConfig::find()->one();
            $data['live_name_prefix'] = $namePrefix;
            $data['rpc_client_name'] = $clientName;
            $data['rpc_server_folder'] = $serverFolder;
            $val = explode("=",$data['og_rpc_domain']);
            $data['og_rpc_domain'] = $val[0].'='.$clientName;
            if($data->save()){
                return 1;
            }else{
                return 2;
            }

        }catch(Exception $e){
            LogUtils::error_log($e);
            return 2;
        }
    }
    /*返回最后一次全局备份时间、最后一次增量备份时间*/
    public function returnTime(){
        $model = new MysqlBack();
        $all = $model->trimPath('D:/backend/mysqlbak/all');
        $dirIncrement = $model->trimPath('D:/backend/mysqlbak/increment/'.date('Ymd'));
        $time = [];
        $time['all'] = '';
        $time['increment'] = '';
        if(is_dir($all)){
            $time['all'] = $model->dir_size("$all");
        }
        if(is_dir($dirIncrement)){
            $time['increment'] = $model->dir_size("$dirIncrement");
        }
        $time = json_encode($time);
        return $time;
    }

    /**
     * 网站开奖检测
     * 指定时间段内，客户端存在的各个彩种间的条数，以及滚球文件的最后写入时间
     * @param $time         查询时间
     * @param $num          固定数值
     * @return int|json   客户端查询失败|客户端查询成功
     */
    public function checknews($t,$num){
        $json_arr = [];
        try{
            $arr = DeplayUtils::_getLotteryType();
            foreach ($arr as $key => $value) {
                if($key == 'lottery_result_p3' || $key == 'lottery_result_d3'){//福彩3D和排列三漏采的期号
                    $r = DeplayUtils::_getP3D3lose($key);
                    $lose = $r[0];$static=$r[1];
                } elseif($key == 'lottery_result_bjkn' || $key == 'lottery_result_bjpk'){//北京PK拾和北京快乐8
                    $qishi_min = DeplayUtils::_getqishu2($key,$t);
                    if($key=='lottery_result_bjkn'){
                        $qishi_max['qishu'] = $qishi_min['qishu'];
                        $qishi_min['qishu']= 815069;
                    }else{
                        $qishi_max = DeplayUtils::_getqishu($key,$t);
                    }
                    $r = DeplayUtils::_getBjknBjpklose($key,$value,$qishi_min['qishu'],$qishi_max['qishu'],$t);
                    $lose = $r[0];$static=$r[1];
                } elseif($key == 'lottery_result_gxsf'){
                    $r = DeplayUtils::_getGxsf($key,$t);
                    $lose = $r[0];$static=$r[1];
                }else{
                    $len=3;$start_qihao  ='001';
                    if($key =='lottery_result_gd11'||$key =='lottery_result_gdsf'||$key=='lottery_result_gxsf'||$key=='lottery_result_t3'){
                        $len = 2;$start_qihao  ='01';
                    }
                    $r = DeplayUtils::_getLotteryLose($key,$value,$t,$len,$start_qihao);
                    $lose = $r[0];$static=$r[1];
                }
                $sum = DeplayUtils::_getCountnum($key,$t);
                $qishu = DeplayUtils::_getqishu($key,$t);
                $json_arr[$key]['last_qishu'] = $qishu['qishu'];
                $json_arr[$key]['sum'] = $sum['sum'];
                $json_arr[$key]['static'] = $static;
                $json_arr[$key]['lose'] = $lose;
                $json_arr[$key]['type'] = $key;
            }
            $json = json_encode($json_arr, JSON_UNESCAPED_UNICODE);
            return $json;
        }catch (\yii\db\Exception $e){
            return 2;
        }
    }

    /**
     * 人工结算接口检测
     * @return bool     true：正常，false：失败
     */
    public function checkJs(){
        $settleDomain = Yii::$app->params['settleDomain']; //人工结算地址
        $ch = curl_init($settleDomain);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($ch);
        $code =  curl_getinfo($ch, CURLINFO_HTTP_CODE); // 200
        curl_close($ch);
        if($code != 200){
            return false;
        }
        return true;
    }
}