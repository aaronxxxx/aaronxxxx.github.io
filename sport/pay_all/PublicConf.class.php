<?php
require_once 'hprose/Hprose.php';
class PublicConf
{
    private $mysqli;
    private $fields = 'merchant_id,merchant_userNO,merchant_username,pay_key,public_key,first_code,f_url,user_key,money_Lowest,odds,money_Lowest,pay_domain'; //查询默认字段
    private $fileName = ''; //日志文件名
    private $toORback = ''; //提交还回调 【to】 提交 【back】 回调
    private $typeId = ''; //智付类型id
    private $notifyStr = ''; //异步通知返回给支付平台的字符串
    private $typeName = ''; //支付平台名称
    private $url = "http://57350.cc";



    /**
     * 链接数据库
     * @param $file_name 文件日志名
     * @param $to_or_back 提交或者回调
     */
    public function __construct($file_name, $to_or_back = 'to')
    {
        ini_set("display_errors", "On"); //是否开启报错 调试模式为On 正式上线则为Off
        header("content-Type: text/html; charset=UTF-8");
        $pay_arr = array(
            //type_id对应表的pay_type
            'ipaylive' => array('type_name' => '法币充值(测试支付)', 'type_id' => 1, 'notify_str' => 'success'),
            'fabi_ipaylive' => array('type_name' => '法币充值', 'type_id' => 2, 'notify_str' => 'success'),
            'cbs' => array('type_name' => '虚拟币充值', 'type_id' => 3, 'notify_str' => 'success')
        );
        $this->fileName = $file_name;
        $this->toORback = $to_or_back;
        $this->typeId = $pay_arr[$file_name]['type_id'];
        $this->notifyStr = $pay_arr[$file_name]['notify_str'];
        $this->typeName = $pay_arr[$file_name]['type_name'];
    }

    /**
     * 
     * @param int $submit_type 支付类型 0通用1网银2微信3支付宝
     * @param bool|false $save_log 是否保存日志
     * @return bool
     */
    public function test()
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        print_r($client->getPayNews($this->typeId, $submit_type = 0));
    }

    /**
     * 获取配置信息
     * @param int $submit_type 支付类型 0通用1网银2微信3支付宝
     * @param bool|false $save_log 是否保存日志
     * @return bool
     */
    public function get_config($submit_type = 0, $save_log = false)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $client->begin();
        $configdata = $client->getPayNews($this->typeId, $submit_type);
        $configdata = $configdata[0];
        return $configdata;
    }

    /**
     * 儲存充值回調
     */
    public function save_deposit_callback($jsonstr, $ordernum)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $data = [
            'order_num' => $ordernum,
            'content' => $jsonstr,
            'create_time' => date('Y-m-d H:i:s')
        ];
        $client->savaDepositCallback($data);
    }

    /**
     * 儲存充值回調
     */
    public function save_withdrawal_callback($jsonstr)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $data = [
            'content' => $jsonstr,
            'create_time' => date('Y-m-d H:i:s')
        ];
        $client->savaWithdrawalCallback($data);
    }


    /**
     **虛擬幣充值交易操作
     */
    public function syunibiDepositTransaction($orderinfo)
    {
        $this->write_log("開始寫入資料庫");

        //开启任务机制锁，防止进程并发
        $lock_id = rand(100000, 999999);
        $this->lock($orderinfo['order_no'], $lock_id);
        $oid = $this->read($orderinfo['order_no']);
        if ($lock_id != $oid) {
            return array('status' => 0, 'msg' => '任务ID不同');
        }

        //重复订单检查
        $cheackOrder = $this->find_order($orderinfo['order_no']);
        if (!empty($cheackOrder)) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '订单重复');
        }
        $this->write_log("查询订单OK");

        //查询会员资料
        $userinfo = $this->find_user_jcb($orderinfo['user_id']);
        if (empty($userinfo)) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '查无用户资讯');
        }
        $this->write_log("查询用户OK");

        $userMoney = $userinfo['money'];
        $rechargeAmount = $orderinfo['order_money'] * $orderinfo['odds'];
        $balance = $userMoney + $rechargeAmount;

        //新增日志(money_log)
        $log_result = $this->insert_money_log($userinfo['user_id'], $orderinfo['order_money'], $orderinfo['order_no'], $userMoney, $balance, $orderinfo['odds']);
        if (!$log_result) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '日志添加失败!');
        }
        $this->write_log("新增日志OK");


        //更新用户余额
        $user_result = $this->update_user($orderinfo['order_money'], $userinfo['user_id'], $orderinfo['odds']);
        if (!$user_result) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '账户金额更新失败!');
        }
        $this->write_log("更新用户OK");

        //新增成功交易訂單紀錄
        $addMoneyOrder = $this->add_money_order($orderinfo['order_no'], $rechargeAmount, $userinfo['user_id'], $userinfo['user_name'], $orderinfo['coinName'], $userMoney, $balance);
        if (!$addMoneyOrder) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '新增交易訂單失敗!');
        }
        $this->write_log("新增訂單OK");

        $this->deleteLock($orderinfo['order_no']);

        return array('status' => 1, 'msg' => '交易成功!');
    }


    /**
     **虛擬幣出金交易操作
     */
    public function syunibiWithdrawalTransaction($orderinfo)
    {
        $this->write_log("開始寫入資料庫");

        //开启任务机制锁，防止进程并发
        $lock_id = rand(100000, 999999);
        $this->lock($orderinfo['order_no'], $lock_id);
        $oid = $this->read($orderinfo['order_no']);
        if ($lock_id != $oid) {
            return array('status' => 0, 'msg' => '任务ID不同');
        }


        // 订单检查
        $cheackOrder = $this->find_agents_order($orderinfo['order_no']);
        if (empty($cheackOrder)) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '查无此订单');
        }
        if ($cheackOrder['status'] != '3') {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '订单非交易中状态');
        }
        if ($cheackOrder['money'] != $orderinfo['order_money']) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '金额异常');
        }
        $this->write_log("查询订单OK");


        // 查询代理资讯
        $agentsinfo = $this->find_agents_info($cheackOrder['agents_id']);
        if (empty($agentsinfo)) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '查无代理资讯');
        }
        if ($agentsinfo['status'] != '正常') {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '代理已停用');
        }
        $this->write_log("查询代理OK");


        $agentsMoney = $agentsinfo['money'];
        $rechargeAmount = $orderinfo['order_money'];
        $balance = $agentsMoney + $rechargeAmount;


        // 新增日志(money_log)
        $log_result = $this->insert_agents_money_log($agentsinfo['id'], $orderinfo['order_money'], $orderinfo['order_no'], $agentsMoney, $balance, 1);
        if (!$log_result) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '日志添加失败!');
        }
        $this->write_log("新增日志OK");


        //更新代理余额
        $agents_result = $this->update_agents($rechargeAmount, $agentsinfo['id']);
        if (!$agents_result) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '账户金额更新失败!');
        }
        $this->write_log("更新代理金额OK");


        //更新出金订单
        $updateAgentsCsah = $this->update_agents_cash(1, $cheackOrder['id']);
        if (empty($updateAgentsCsah)) {
            $this->deleteLock($orderinfo['order_no']);
            return array('status' => 0, 'msg' => '更新订单失敗!');
        }
        $this->write_log("更新訂單OK");

        $this->deleteLock($orderinfo['order_no']);

        return array('status' => 1, 'msg' => '代理出金成功!');
    }

    // 查询代理出金订单存在与否
    public function find_agents_order($order_no) {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $oderinfo = $client->findAgentsOrder($order_no);
        return $oderinfo;
    }

    // 查询代理资讯存在与否
    public function find_agents_info($id) {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $oderinfo = $client->findAgentsInfo($id);
        return $oderinfo;
    }

    /**
     * 添加成功交易订单
     * @param $order_no 订单号
     * @param $order_money 订单金额
     * @param $uid 用户Id
     * @param $username 用户名
     * @param string $pay_type 支付类型
     */

    public function add_money_order($order_no, $order_money, $uid, $username, $pay_type = '网银', $assets, $balance)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $data = array(
            'user_id' => $uid,
            'order_num' => $order_no,
            'status' => '成功',
            'about' => $pay_type . "虚拟币充值",
            'pay_card' => $pay_type,
            'pay_num' => '1',
            'pay_address' => '空',
            'type' => '在线支付',
            'pay_name' => $username . "账户充值",
            'sxf' => '0',
            'order_value' => $order_money,
            'zsjr' => '0',
            'assets' => $assets,
            'balance' => $balance,
            'date' => date('Y-m-d h:i:s')
        );
        $result = $client->addOrder($data);
        return $result;
    }

     /**
     * 取得出入金匯率
     * @param $selectMode 指定入金或出金
     */
    public function get_rate($selectMode)
    {
        if ($selectMode == 'in') {
            $selectMode = 'in_rate';
        }
        else if ($selectMode == 'out') {
            $selectMode = 'out_rate';
        }
        else {
            return '參數錯誤';
        }
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $rate = $client->getRate($selectMode);
        return $rate;
    }

    /**
     * 取得会员虚拟币交易型态
     * @param $selectMode 指定入金或出金
     */
    public function get_trade_type($username)
    {   
        if (empty($username)) {
            return '无效的会员名称';
        }
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $rate = $client->getTradeType($username);
        return $rate;
    }


    /**
     * 添加本地备份订单
     * @param $order_no 订单号
     * @param $order_money 订单金额
     * @param $uid 用户Id
     * @param $username 用户名
     * @param string $pay_type 支付类型
     */

    public function order_bak($order_no, $order_money, $uid, $username, $pay_type = '网银')
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $data = array(
            'user_id' => $uid,
            'order_num' => $order_no,
            'status' => '失败',
            'about' => $this->typeName . "在线支付" . $order_money . "RMB",
            'pay_card' => $pay_type,
            'pay_num' => '1',
            'pay_address' => '空',
            'type' => '在线支付',
            'pay_name' => $username . "账户充值",
            'sxf' => '0',
            'order_value' => $order_money,
            'zsjr' => '0',
            'assets' => 0,
            'balance' => 0,
            'date' => null,
        );
        $client->addOrder($data);
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
    public function do_asynchronous($params)
    {
        $this->write_log("開始寫入資料庫");
        //开启任务机制锁，防止进程并发
        $lock_id = rand(100000, 999999);
        $this->lock($params['order_no'], $lock_id);
        $oid = $this->read($params['order_no']);
        if ($lock_id != $oid) return array('status' => 0, 'msg' => '任务ID不同');
        //查询订单
        $orderdata = $this->find_order($params['order_no']);
        if ($orderdata['status'] != '失败') {
            $this->deleteLock($params['order_no']);
            return array('status' => 1, 'msg' => '数据异常，或重复支付');
        }
        if ($params['order_money'] >= ($orderdata['order_value'] + 1) || $params['order_money'] <= ($orderdata['order_value'] - 1)) {
            $this->deleteLock($params['order_no']);
            return array('status' => 0, 'msg' => '金额异常'); //比较入库的金额是否和回调金额一致
        }

        $this->write_log("查询订单OK");   //Robin add

        //查询用户
        $params['user_id'] = $orderdata['user_id'];
        $userdata =  $this->find_user($orderdata['user_id']);
        if (empty($userdata)) {
            $this->deleteLock($params['order_no']);
            return array('status' => 0, 'msg' => '用户不存在');
        }

        $balance = $userdata['money'] + sprintf("%.2f", $orderdata['order_value'] / $params['odds']);
        $money = sprintf("%.2f", $orderdata['order_value'] / $params['odds']);

        $this->write_log("查询用户OK");

        //新增日志		
        $log_result = $this->insert_fabi_money_log($params['user_id'], $orderdata['order_value'], $params['order_no'], $userdata['money'], $balance, $params['odds']);
        if (!$log_result) {
            $this->deleteLock($params['order_no']);
            return array('status' => 0, 'msg' => '日志添加失败!');
        }

        $this->write_log("新增日志OK");

        //更新订单
        //$order_result = $this->update_order($balance,$userdata['money'],$params['order_time'],$params['user_id'],$params['order_no'],$params['odds'],$money);
        $order_result = $this->update_order($balance, $userdata['money'], $money, $params);
        if (!$order_result) {
            $this->deleteLock($params['order_no']);
            return array('status' => 0, 'msg' => '订单更新失败!');
        }

        $this->write_log("更新订单OK");

        //更新用户
        $user_result = $this->fabi_update_user($money, $params['user_id']);
        if (!$user_result) {
            $this->deleteLock($params['order_no']);
            return array('status' => 0, 'msg' => '账户金额更新失败!');
        }
        $this->deleteLock($params['order_no']);

        $this->write_log("更新用户OK");

        return array('status' => 1, 'msg' => '交易成功!');
    }

    /**
     * 查询用户信息
     * @param $uid 用户id
     */
    public function find_user($uid)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $userdata = $client->getUserNewsByUserid($uid);
        return $userdata;
    }

    /**
     * 查询订单
     * @param $order_no 订单号
     * @return array
     */
    public function find_order($order_no)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $moneydata = $client->selectOrder($order_no);
        return $moneydata;
    }

    /**
     * 更新用户金额
     * @param $totalAmount 金额
     * @param $uid 用户id
     */
    public function update_user($totalAmount, $uid, $odds)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $money = $totalAmount * $odds;
        return $client->updateUserMoney($money, $uid);
    }

    /**
     * 更新用户金额(法幣專用)
     * @param $totalAmount 金额
     * @param $uid 用户id
     */
    public function fabi_update_user($totalAmount, $uid)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $money = $totalAmount;
        return $client->updateUserMoney($money, $uid);
    }

    /**
     * 更新代理金额
     * @param $totalAmount 金额
     * @param $id 代理id
     */
    public function update_agents($totalAmount, $id)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        return $client->updateAgentsMoney($totalAmount, $id);
    }


    /**
     * 更新订单
     * @param $balance 充值后金额
     * @param $usermoney 充值前金额
     * @param $order_time 订单时间
     * @param $uid 用户id
     * @param $order_no 订单号
     */
    //public function update_order($balance,$usermoney,$order_time,$uid,$order_no,$odds,$money){
    public function update_order($balance, $usermoney, $money, array $order_ifno)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $arr = [
            //'about' => $this->typeName . "在线支付" . $money . "元",
            'order_value' =>  $money,
            'assets' => $usermoney,
            'balance' => $balance,
            'date' => $order_ifno['order_time'],
            'user_id' => $order_ifno['user_id'],
            'order_num' => $order_ifno['order_no']
        ];

        if (isset($order_ifno['pay_card'])) {
            $arr['pay_card'] = $order_ifno['pay_card'];
        }
        return $client->updateOrder($arr);
    }

    /**
     * 更新出金订单
     * @param $balance 充值后金额
     * @param $usermoney 充值前金额
     * @param $order_time 订单时间
     * @param $uid 用户id
     * @param $order_no 订单号
     */
        public function update_agents_cash($status, $order_id)
        {
            $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
            $arr = [
                'status' => $status,
                'order_id' => $order_id,
                'modify_time' => date('Y-m-d H:i:s'),
            ];
            return $client->updateAgentsCash($arr);
        }

    /**
     * 生成日志表数据
     * @param $uid 用户id
     * @param $totalAmount 订单金额
     * @param $order_no 订单号
     * @param $usermoney 充值前金额
     * @param $balance 充值后金额
     */
    public function insert_money_log($uid, $totalAmount, $order_no, $usermoney, $balance, $odds)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $arr = array(
            'user_id' => $uid,
            'order_value' => $totalAmount * $odds,
            'order_num' => $order_no,
            'update_time' => date('Y-m-d H:i:s'),
            'about' => $this->typeName . "在线充值",
            'type' => "在线充值",
            'assets' => $usermoney,
            'balance' => $balance,
        );
        return $client->addMoneyLog($arr);
    }

    /**
     * for法币充值(用除的)
     */
    public function insert_fabi_money_log($uid, $totalAmount, $order_no, $usermoney, $balance, $odds)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $arr = array(
            'user_id' => $uid,
            'order_value' => $totalAmount / $odds,
            'order_num' => $order_no,
            'update_time' => date('Y-m-d H:i:s'),
            'about' => $this->typeName . "在线充值" . $totalAmount . 'RMB',
            'type' => "在线充值",
            'assets' => $usermoney,
            'balance' => $balance,
        );
        return $client->addMoneyLog($arr);
    }

    /**
     * 生成日志表数据(for 代理出金用)
     * @param $uid 用户id
     * @param $totalAmount 订单金额
     * @param $order_no 订单号
     * @param $usermoney 充值前金额
     * @param $balance 充值后金额
     */
    public function insert_agents_money_log($uid, $totalAmount, $order_no, $agentsmoney, $balance, $odds)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $arr = array(
            'user_id' => $uid,
            'order_value' => $totalAmount * $odds,
            'order_num' => $order_no,
            'update_time' => date('Y-m-d H:i:s'),
            'about' => "总代出金给代理",
            'type' => "代理出金",
            'assets' => $agentsmoney,
            'balance' => $balance,
        );
        return $client->addMoneyLog($arr);
    }
    /**
     * 保存日志
     * @param $str 数据
     * @param $is_echo 是否输出字符串
     */
    public function write_log($str, $is_echo = false)
    {
        //定义日志路径
        $base_path = str_replace('\\', '/', realpath(dirname(__FILE__) . '/')) . "/paylog";
        if (!is_dir($base_path)) mkdir($base_path);
        if ($this->toORback == 'to') {
            file_put_contents($base_path . '/' . date('Y-m-j') . '-' . $this->fileName . 'To.log', '【' . date('y-m-d H:i:s') . '支付订单信息】:' . $str . "\r\n", FILE_APPEND);
        } else {
            file_put_contents($base_path . '/' . date('Y-m-j') . '-' . $this->fileName . 'Back.log', '【' . date('y-m-d H:i:s') . '返回结果】:' . $str . "\r\n", FILE_APPEND);
        }
        if ($is_echo) {
            echo $this->notifyStr;
            exit;
        }
    }
    /**
     * @param $string 加解密字符串
     * @param $operation 解密-D 加密-E
     * @param string $key 加密秘钥
     * @return string
     */
    public function encrypt($string, $operation, $key = '')
    {
        $key = md5($key);
        $key_length = strlen($key);
        $string = $operation == 'D' ? base64_decode(str_replace(' ', '+', $string)) : substr(md5($string . $key), 0, 8) . $string;
        $string_length = strlen($string);
        $rndkey = $box = array();
        $result = '';
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($key[$i % $key_length]);
            $box[$i] = $i;
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'D') {
            if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
                return substr($result, 8);
            } else {
                exit("<script language=javascript>alert('用户解密失败，请联系客服处理');history.back();</script>");
            }
        } else {
            return urlencode(str_replace('=', '', base64_encode($result)));
        }
    }
    //特殊字符url转码
    public function appendParam(&$sb, $name, $val, $charset = false, $and = true)
    {
        if ($and) {
            $sb .= "&";
        } else {
            $sb .= "?";
        }
        $sb .= $name . "=";
        if (is_null($val)) {
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
    public function do_asynchronous_jcb($params)
    {
        //查询用户
        $userdata =  $this->find_user_jcb($params['username']);
        if (empty($userdata)) return array('status' => 0, 'msg' => '用户不存在');
        //print_r($userdata);exit;    
        //查询订单
        $orderdata = $this->find_order_jcb($params['order_no']);
        if ($orderdata['status'] == '成功') return array('status' => 0, 'msg' => '数据异常，或重复支付');
        //更新订单
        $balance = $userdata['money'] + $params['order_money'];
        $uid = $userdata['user_id'];
        $order_result = $this->update_order_jcb($uid, $params['order_money'], $params['username'], $balance, $userdata['money'], $params['order_time'], $params['order_no']);
        if (!$order_result) return array('status' => 0, 'msg' => '订单更新失败!');
        //新增日志
        $log_result = $this->insert_money_log($uid, $params['order_money'], $params['order_no'], $userdata['money'], $balance, $params['odds']);
        if (!$log_result) return array('status' => 0, 'msg' => '日志添加失败!');
        //更新用户
        $user_result = $this->update_user_jcb($params['order_money'], $userdata['user_id']);
        if (!$user_result) return array('status' => 0, 'msg' => '账户金额更新失败!');
        return array('status' => 1);
    }
    /**
     * 查询用户信息
     * @param $username 用户名
     */
    public function find_user_jcb($username)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $userdata = $client->getUserNewsByUsername($username);
        return $userdata;
    }
    /**
     * 查询订单
     * @param $order_no 订单号
     * @return array
     */
    public function find_order_jcb($order_no)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $moneydata = $client->selectOrder($order_no);
        return $moneydata;
    }
    /**
     * 更新用户金额
     * @param $totalAmount 金额
     * @param $uid 用户id
     */
    public function update_user_jcb($totalAmount, $uid)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        return $client->updateUserMoney($totalAmount, $uid);
    }
    /**
     * 更新订单
     * @param $balance 充值后金额
     * @param $usermoney 充值前金额
     * @param $order_time 订单时间
     * @param $uid 用户id
     * @param $order_no 订单号
     */
    public function update_order_jcb($uid, $order_amount, $pay_name, $balance, $usermoney, $order_time, $order_no)
    {
        $client = new \Hprose\Http\Client($this->url . "/?r=pay/index/index", false);
        $data = array(
            'user_id' => $uid,
            'order_num' => $order_no,
            'status' => '成功',
            'about' => $this->typeName . "在线支付" . $order_amount . "元",
            'pay_card' => '网银',
            'pay_num' => '1',
            'pay_address' => '空',
            'type' => '在线支付',
            'pay_name' => $this->typeName . "账户充值",
            'sxf' => '0',
            'order_value' => $order_amount,
            'zsjr' => '0',
            'assets' => $usermoney,
            'balance' => $balance,
            'date' => $order_time,
        );
        return $client->addOrder($data);
    }

    /**
     * 写入任务锁 ID
     * @param $order
     * @param $id
     */
    public function lock($order, $id)
    {
        if ($orderLock = fopen($order . '.txt', 'a')) {
            $canWrite = flock($orderLock, LOCK_EX);
            if ($canWrite) {
                fwrite($orderLock, $id);
                fclose($orderLock);
            } else {
                $this->write_log('并发控制文件被锁定');
                exit;
            }
        }
    }

    /**
     * 读取任务锁ID
     * @param $order
     * @return bool|string
     */
    public function read($order)
    {
        $queueId = file_get_contents($order . '.txt');
        return substr($queueId, 0, 6);
    }

    /**
     * 删除订单锁文件
     * @param $order
     */
    public function deleteLock($order)
    {
        if (unlink($order . '.txt')) {
            $this->write_log($order . "刪除成功");
        } else {
            $this->write_log($order . "刪除失敗");
        }
    }

    /*
	 * 產生QRCode
	 * @param $url QRCode內容-連結URL
     * @param $widthHeight QRCode 高度&寬度
	*/
    function generateQRwithGoogle($url, $widthHeight = '300', $EC_level = 'L', $margin = '0')
    {
        $url = urlencode($url);
        echo '<img src="http://chart.apis.google.com/chart?chs=' . $widthHeight . 'x' . $widthHeight . '&cht=qr&chld=' . $EC_level . '|' . $margin . '&chl=' . $url . '" alt="QR code" widthHeight="' . $widthHeight . '" widthHeight="' . $widthHeight . '"/>';
    }
}
