<?php
class PublicConf{
    private $mysqli;
    private $fields='merchant_id,merchant_userNO,merchant_username,pay_key,public_key,first_code,f_url,user_key,money_Lowest,odds,money_Lowest';//查询默认字段
    private $fileName = '';//日志文件名
    private $toORback = '';//提交还回调 【to】 提交 【back】 回调
    private $typeId = '';//智付类型id
    private $notifyStr = '';//异步通知返回给支付平台的字符串
    private $typeName = '';//支付平台名称
	private $host_port = '180.178.35.114:3309';//远程ip+端口
	private $username = 'root';
	private $password = 'q1w2e3r4t5y6u7i8o9p0354';
	private $dbname = 'casino_db';
	
    /**
     * 链接数据库
     * @param $file_name 文件日志名
     * @param $to_or_back 提交或者回调
     */
    public function __construct($file_name,$to_or_back='to'){
        ini_set("display_errors","Off");//是否开启报错 调试模式为On 正式上线则为Off
        header("content-Type: text/html; charset=UTF-8");
        $pay_arr = array(
            //type_id对应表的pay_type
            'zhifu'=>array('type_name'=>'智付','type_id'=>1,'notify_str'=>'success'),
            'youfu'=>array('type_name'=>'优付','type_id'=>2,'notify_str'=>'success'),
            'yinbao'=>array('type_name'=>'银宝','type_id'=>3,'notify_str'=>'ok'),
            'xunhuibao'=>array('type_name'=>'讯汇宝','type_id'=>4,'notify_str'=>'success'),
            'xinbeifu'=>array('type_name'=>'新贝付','type_id'=>5,'notify_str'=>'OK'),
            'tonghuika'=>array('type_name'=>'通汇卡','type_id'=>6,'notify_str'=>'success'),
            'ruifu'=>array('type_name'=>'锐付','type_id'=>7,'notify_str'=>'checkok'),
            'rongEfu'=>array('type_name'=>'融E付','type_id'=>8,'notify_str'=>'ok'),
            'qianwang'=>array('type_name'=>'千网','type_id'=>9,'notify_str'=>'opstate=0'),
            'OKfu'=>array('type_name'=>'OK付','type_id'=>10,'notify_str'=>'success'),
            'mobao'=>array('type_name'=>'魔宝','type_id'=>11,'notify_str'=>'SUCCESS'),
            'jiufu'=>array('type_name'=>'久付','type_id'=>12,'notify_str'=>'SUCCESS'),
            'huanxun'=>array('type_name'=>'环迅','type_id'=>13,'notify_str'=>'success'),
            'baofu'=>array('type_name'=>'宝付','type_id'=>14,'notify_str'=>'OK'),
            'hlbPay'=>array('type_name'=>'合利宝','type_id'=>15,'notify_str'=>'SUCCESS'),
            'xunbao'=>array('type_name'=>'讯宝','type_id'=>16,'notify_str'=>'success'),
            'shanfu'=>array('type_name'=>'闪付','type_id'=>17,'notify_str'=>'success'),
            'qifu'=>array('type_name'=>'启付','type_id'=>18,'notify_str'=>'0'),
            'zhihuifu'=>array('type_name'=>'智汇付','type_id'=>19,'notify_str'=>'success'),
            'xunfutong'=>array('type_name'=>'讯付通','type_id'=>20,'notify_str'=>'0'), 
            'aiyifu'=>array('type_name'=>'爱益付','type_id'=>21,'notify_str'=>'success'),
            'jiupao'=>array('type_name'=>'九炮','type_id'=>22,'notify_str'=>'success'),
            'jichongbao'=>array('type_name'=>'即充宝','type_id'=>23,'notify_str'=>'success'),
            'duodebao'=>array('type_name'=>'多得宝','type_id'=>24,'notify_str'=>'success'),
            'jinfuka'=>array('type_name'=>'金付卡','type_id'=>25,'notify_str'=>'SUCCESS'),
            'fuqian'=>array('type_name'=>'付乾','type_id'=>26,'notify_str'=>'ok'),
            'huiyunfu'=>array('type_name'=>'汇耘富','type_id'=>27,'notify_str'=>'SUCCESS'),
            'huixin'=>array('type_name'=>'汇鑫','type_id'=>28,'notify_str'=>'ok'),
            'meifubao'=>array('type_name'=>'美付宝','type_id'=>29,'notify_str'=>'SUCCESS'),
            'weifutong'=>array('type_name'=>'威富通','type_id'=>30,'notify_str'=>'success'),
            'likefu'=>array('type_name'=>'立刻付','type_id'=>31,'notify_str'=>'ok'),
            'AUSTPAY'=>array('type_name'=>'国际付','type_id'=>32,'notify_str'=>'<result>yes</result>'),
			'renxin'=>array('type_name'=>'仁信','type_id'=>33,'notify_str'=>'ok'),
            'zhihui'=>array('type_name'=>'智汇','type_id'=>34,'notify_str'=>'success'),
            'xiongmao'=>array('type_name'=>'熊猫','type_id'=>35,'notify_str'=>'success'),
        );
        $this->fileName = $file_name;
        $this->toORback = $to_or_back;
        $this->typeId = $pay_arr[$file_name]['type_id'];
        $this->notifyStr = $pay_arr[$file_name]['notify_str'];
        $this->typeName = $pay_arr[$file_name]['type_name'];

        $this->mysqli = new Mysqli($this->host_port,$this->username,$this->password,$this->dbname);
        if(mysqli_connect_errno()){
            exit("<script language=javascript>alert('服务器带着小姨子跑了，请联系客服');history.back();</script>");
        }
        $this->mysqli->query("set names utf8");

    }
    /**
     * 获取配置信息
     * @param int $submit_type 支付类型 0通用1网银2微信3支付宝
     * @param bool|false $save_log 是否保存日志
     * @return bool
     */
    public function get_config($submit_type=0,$save_log = false){
        $sql="select ".$this->fields." from pay_set where pay_type = ".$this->typeId." and submit_type=".$submit_type." and b_start = 1 and money_Already < money_limits ";
        $query = $this->mysqli->query($sql);
        //var_dump($query);exit;
        if($query->num_rows <=0){
            if($save_log){
               $this->write_log('配置获取失败',true);
            }else{
                exit("<script language=javascript>alert('数据异常，可能未开启，请联系客服');history.back();</script>");
            }
        }
        $configdata = $query->fetch_assoc();
        return $configdata;
    }

    /**
     * 添加本地备份订单
     * @param $order_no 订单号
     * @param $order_money 订单金额
     * @param $uid 用户Id
     * @param $username 用户名
     * @param string $pay_type 支付类型
     */

    public function order_bak($order_no,$order_money,$uid,$username,$pay_type='网银'){
        $sql = "INSERT INTO `money`(`user_id`,`order_num`,`status`,`about`,`update_time`,`pay_card`,`pay_num`,`pay_address`,`type`,`pay_name`,`sxf`,`order_value`,`zsjr`) VALUES(".$uid.",'".$order_no."','失败','".$this->typeName."在线支付".$order_money."元','".date('Y-m-d H:i:s')."','".$pay_type."',1,'空','在线支付','".$username."账户充值','0.00',".$order_money.",'0.00'".")";
        $query = $this->mysqli->query($sql);
        if ($query == false ){
            exit("<script language=javascript>alert('订单本地处理失败，请联系客服');history.back();</script>");
        }
        $this->mysqli->close();
    }

    /**
     **相应的数据库操作
     * @param $params
     * user_id 用户id
     * order_no 订单号
     * order_money 订单金额
     * order_time 订单时间
     * @return array
     */
    public function do_asynchronous($params){
//        print_r($params);exit;
//        $params['user_id'] = 126595649;
//        $params['order_no'] = 'AGX20170327181040U126595649';
//        $params['order_money'] = '111';
        //查询用户
        $userdata =  $this->find_user($params['user_id']);
        if(empty($userdata)) return array('status'=>0,'msg'=>'用户不存在');
        //查询订单
        $orderdata = $this->find_order($params['order_no']);
        if($orderdata['status'] != '失败') return array('status'=>0,'msg'=>'数据异常，或重复支付');
       // if($orderdata['order_value']!= $params['order_money'])return array('status'=>0,'msg'=>'金额异常');//比较入库的金额是否和回调金额一致
	   if($params['order_money'] >= ($orderdata['order_value']+1) || $params['order_money'] <= ($orderdata['order_value']-1))return array('status'=>0,'msg'=>'金额异常');//比较入库的金额是否和回调金额一致
        //更新用户
        $user_result = $this->update_user($orderdata['order_value'],$params['user_id'],$params['odds']);
        if(!$user_result) return array('status'=>0,'msg'=>'账户金额更新失败!');
        //更新订单
        $balance = $userdata['money']+$orderdata['order_value']*$params['odds'];
        $money =$orderdata['order_value']*$params['odds'];
        $order_result = $this->update_order($balance,$userdata['money'],$params['order_time'],$params['user_id'],$params['order_no'],$params['odds'],$money);
        if(!$order_result) return array('status'=>0,'msg'=>'订单更新失败!');
        //新增日志
        $log_result = $this->insert_money_log($params['user_id'],$orderdata['order_value'],$params['order_no'],$userdata['money'],$balance,$params['odds']);
        if(!$log_result) return array('status'=>0,'msg'=>'日志添加失败!');
        return array('status'=>1);
    }

    /**
     * 查询用户信息
     * @param $uid 用户id
     */
    public function find_user($uid){
        $sql = 'select user_id,user_name,money from user_list where user_id=\'' . $uid . '\' limit 1';
        $query = $this->mysqli->query($sql);
        $userdata = $query->fetch_assoc();
        if($query->num_rows <= 0)return false;
        return $userdata;
    }

    /**
     * 查询订单
     * @param $order_no 订单号
     * @return array
     */
    public function find_order($order_no){
        $sql = 'select * from money where order_num=\'' . $order_no . '\'and status = 0 limit 1';
        $query = $this->mysqli->query($sql);
        $moneydata = $query->fetch_assoc();
        if($query->num_rows <= 0)return false;
        return $moneydata;
    }

    /**
     * 更新用户金额
     * @param $totalAmount 金额
     * @param $uid 用户id
     */
    public function update_user($totalAmount,$uid,$odds){
        //增加帐户余额
        $sql = 'update user_list set money=money+'.($totalAmount*$odds).' where user_id='.$uid;
        //echo $sql;exit;
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows < 1 )return false;
        return true;
    }

    /**
     * 更新订单
     * @param $balance 充值后金额
     * @param $usermoney 充值前金额
     * @param $order_time 订单时间
     * @param $uid 用户id
     * @param $order_no 订单号
     */
    public function update_order($balance,$usermoney,$order_time,$uid,$order_no,$odds,$money){
        //更新订单
        $sql = "update money set `status`='成功',`about`='".$this->typeName."在线支付".$money."元',`update_time`='".date('Y-m-d H:i:s')."',type='在线支付',order_value=".$money.",`assets`=".$usermoney.",`balance`=".$balance.",`date`='".$order_time."' where user_id=".$uid." and order_num='" . $order_no."'";
        //echo $sql;exit;
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows < 1 ) return false;
        return true;
    }

    /**
     * 生成日志表数据
     * @param $uid 用户id
     * @param $totalAmount 订单金额
     * @param $order_no 订单号
     * @param $usermoney 充值前金额
     * @param $balance 充值后金额
     */
    public function insert_money_log($uid,$totalAmount,$order_no,$usermoney,$balance,$odds){
        //生成日志
        $sql = "INSERT INTO `money_log`(`user_id`,`order_value`,`order_num`,`update_time`,`about`,`type`,`assets`,`balance`) VALUES(".$uid.",'".($totalAmount*$odds)."','".$order_no."','".date('Y-m-d H:i:s')."','".$this->typeName."在线充值','该订单在线冲值操作成功','".$usermoney."','".$balance."')";
    
        $query = $this->mysqli->query($sql);
        $this->mysqli->close();
        if ($query  == false)return false;
        return true;
    }
    /**
     * 保存日志
     * @param $str 数据
     * @param $is_echo 是否输出字符串
     */
    public function write_log($str,$is_echo=false){
        //定义日志路径
        $base_path = str_replace( '\\' , '/' , realpath(dirname(__FILE__).'/'))."/paylog";
        if (!is_dir($base_path)) mkdir($base_path);
        if($this->toORback == 'to'){
            file_put_contents($base_path.'/'.date('Y-m-j').'-'.$this->fileName.'To.log','【'.date('y-m-d H:i:s').'支付订单信息】:'.$str."\r\n",FILE_APPEND);
        }else{
            file_put_contents($base_path.'/'.date('Y-m-j').'-'.$this->fileName.'Back.log','【'.date('y-m-d H:i:s').'返回结果】:'.$str."\r\n",FILE_APPEND);
        }
        if($is_echo) {
            echo $this->notifyStr;
            exit;}
    }
    /**
     * @param $string 加解密字符串
     * @param $operation 解密-D 加密-E
     * @param string $key 加密秘钥
     * @return string
     */
    public function encrypt($string,$operation,$key=''){
        $key=md5($key);
        $key_length=strlen($key);
        $string=$operation=='D'?base64_decode(str_replace(' ','+',$string)):substr(md5($string.$key),0,8).$string;
        $string_length=strlen($string);
        $rndkey=$box=array();
        $result='';
        for($i=0;$i<=255;$i++){
            $rndkey[$i]=ord($key[$i%$key_length]);
            $box[$i]=$i;
        }
        for($j=$i=0;$i<256;$i++){
            $j=($j+$box[$i]+$rndkey[$i])%256;
            $tmp=$box[$i];
            $box[$i]=$box[$j];
            $box[$j]=$tmp;
        }
        for($a=$j=$i=0;$i<$string_length;$i++){
            $a=($a+1)%256;
            $j=($j+$box[$a])%256;
            $tmp=$box[$a];
            $box[$a]=$box[$j];
            $box[$j]=$tmp;
            $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
        }
        if($operation=='D'){
            if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){
                return substr($result,8);
            }else{
                exit("<script language=javascript>alert('用户解密失败，请联系客服处理');history.back();</script>");
            }
        }else{
            return urlencode(str_replace('=','',base64_encode($result)));
        }
    }
    //特殊字符url转码
    public function appendParam(& $sb, $name, $val, $charset = false,$and = true)
    {
        if ($and) {
            $sb .= "&";
        } else {
            $sb .= "?";
        }
        $sb .= $name."=";
        if (is_null($val))
        {
            $val = "";
        }
        if (!$charset) {
            $sb .= $val;
        } else {
            $sb .= urlencode($val);
        }
    }
    /**
     * 获取当前IP
     */
    public function  getClientIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    /*
     *即充宝需要调用的所有
     * **相应的数据库操作
     * @param $params
     * user_name 用户名
     * order_no 订单号
     * order_money 订单金额
     * order_time 订单时间
     * @return array 
     *      */
       public function do_asynchronous_jcb($params){
        //查询用户
        $userdata =  $this->find_user_jcb($params['username']);
        if(empty($userdata)) return array('status'=>0,'msg'=>'用户不存在');
        //print_r($userdata);exit;    
        //查询订单
        $orderdata = $this->find_order_jcb($params['order_no']);
        if($orderdata['status'] == '成功') return array('status'=>0,'msg'=>'数据异常，或重复支付');
        //print_r($orderdata);exit;
        //更新用户
        $user_result = $this->update_user_jcb($params['order_money'],$userdata['user_id']);
        if(!$user_result) return array('status'=>0,'msg'=>'账户金额更新失败!');
        //var_dump($user_result);exit;
        //更新订单
        $balance = $userdata['money']+$params['order_money'];
        $uid = $userdata['user_id'];
        $order_result = $this->update_order_jcb($uid,$params['order_money'],$params['username'],$balance,$userdata['money'],$params['order_time'],$params['order_no']);
        if(!$order_result) return array('status'=>0,'msg'=>'订单更新失败!');
        //新增日志
        $log_result = $this->insert_money_log($uid,$params['order_money'],$params['order_no'],$userdata['money'],$balance,$params['odds']);
        if(!$log_result) return array('status'=>0,'msg'=>'日志添加失败!');
        return array('status'=>1);
    }
     /**
     * 查询用户信息
     * @param $username 用户名
     */
     public function find_user_jcb($username){
        $sql = 'select user_id,money from user_list where user_name=\'' . $username . '\' limit 1';
        $query = $this->mysqli->query($sql);
        $userdata = $query->fetch_assoc();
        if($query->num_rows <= 0)return false;
        return $userdata;
    }
       /**
     * 查询订单
     * @param $order_no 订单号
     * @return array
     */
    public function find_order_jcb($order_no){
        $sql = 'select * from money where order_num=\'' . $order_no . '\' limit 1';
        $query = $this->mysqli->query($sql);
        $moneydata = $query->fetch_assoc();
        return $moneydata;
    }
     /**
     * 更新用户金额
     * @param $totalAmount 金额
     * @param $uid 用户id
     */
    public function update_user_jcb($totalAmount,$uid){
        //增加帐户余额
        $sql = 'update user_list set money=money+'.$totalAmount.' where user_id='.$uid;
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows < 1 )return false;
        return true;
    }
        /**
     * 更新订单
     * @param $balance 充值后金额
     * @param $usermoney 充值前金额
     * @param $order_time 订单时间
     * @param $uid 用户id
     * @param $order_no 订单号
     */
    public function update_order_jcb($uid,$order_amount,$pay_name,$balance,$usermoney,$order_time,$order_no){
        //更新订单
        $sql = "insert into money(user_id,order_num,status,about,update_time,pay_card,pay_num,pay_address,type,pay_name,sxf,order_value,assets,balance,zsjr,date)"
        ."value(".$uid.",'".$order_no."','成功','即充宝支付".$order_amount."元','".$order_time."','网银','1','null','在线支付','".$pay_name."账户充值',0,".$order_amount.",".$usermoney.",".$balance.",0,'".$order_time."')";
        //echo $sql;exit;
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows<1)return false;
        return true;
    }
}
