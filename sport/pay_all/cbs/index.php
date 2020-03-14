    <?php
    require_once('../PublicConf.class.php');
    require_once('config.php');
    //ini_set("display_errors", "On");
    header("Content-type: text/html; charset=utf-8");

    $config = new PublicConf('cbs');

    //获取配置信息
    $configdata = $config->get_config();
    $configext = configExt($configdata, 'prod');
    $uid = $_GET['user_id'];
    $user_name = trim($_GET['user_name']);
    $trade_type = $config->get_trade_type($user_name);
    $gateway = $configext["config"]["request_gateway"];
    $Token = trim($configext["config"]["token"]);
    $address = array();

    if (empty($uid) || empty($user_name)) {
        exit('缺少参数');
    }

    $parameter = [
        'uID' => $user_name,
        'coinName' => $trade_type
    ];

    $url_new = $gateway . '/New?uID=' . $user_name . '&coinName=' . $trade_type;
    $new_result = curlGet($url_new, $Token);

    if (empty($new_result['data']) || $new_result['status'] != '0') {
        echo '错误:' . $new_result['status'] . '  描述:' . $new_result['message'];
        exit;
    }


    $url_get = $gateway . '/Get?uID=' . $user_name . '&coinName=' . $trade_type;
    $get_result = curlGet($url_get, $Token);

    if (empty($get_result['data']) || $get_result['status'] != '0') {
        echo '错误代号：' . $get_result['status'] . '  描述：' . $get_result['message'];
        exit;
    }

    if ($get_result['data']['addressList']['0']['coinName'] == 'ETH_USDT') {
        $address[] = $get_result['data']['addressList']['0']['address'];
        $address[] = $get_result['data']['addressList']['0']['contract'];
    } else if ($get_result['data']['addressList']['0']['coinName'] == 'USDT') {
        $address[] = $get_result['data']['addressList']['0']['address'];
    } else {
        exit('发生不知名的错误！请关闭再重新选取交易！');
    }
    //var_dump($address);exit;

    function curlGet($url, $authorization) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: bearer ' . $authorization,	
        ]);
        
        $result = curl_exec($ch);
        
        if(curl_errno($ch)) {
            echo 'Curl error: ', curl_error($ch), "\n";
        }
        
        curl_close($ch);
        
        return json_decode($result, true);
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>虚拟币充值</title>
        <link type="text/css" rel="stylesheet" href="/static3/css/index.css" />
        <link type="text/css" rel="stylesheet" href="/static3/css/pay.css" />
        <script type="text/javascript" src="/static3/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="/static3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            <div class="tittle_box">
                <a href="javascript:history.back()"></a>
                <h1>虚拟币充值</h1>
            </div>
        </header>
        <main>
            <form id="mainForm" class="form-horizontal" action="paySubmit.php" method="POST">
                <!--<div class="pay_box">
                    <h2><?= $user_name ?><span>账户充值</span></h2>
                    <input type="text" id='totalAmount' name="totalAmount" placeholder="金额">
                    <p>仅支持整数金额；单笔<?php echo  $configdata['money_Lowest']; ?>~<?php echo  $configdata['money_limits']; ?>元。</p>
                </div>-->
                <div class="pay_check_box">
                    <div class="sort_box">
                        <ul id="myTab">
                            <!--<li class="active">
                                <a id="GATEWAY-tab" data-toggle="tab" href="#GATEWAY" role="tab" aria-controls="GATEWAY" aria-selected="true" onclick="show_bank(this)" name="GATEWAY">网关支付</a>
                            </li>
                            <li>
                                <a id="QRCODE-tab" data-toggle="tab" href="#QRCODE" role="tab" aria-controls="QRCODE" aria-selected="false" onclick="show_bank(this)" name="QRCODE">手机扫码</a>
                            </li>-->
                            <!--<li>
                                <a id="WAP-tab" data-toggle="tab" href="#WAP" role="tab" aria-controls="WAP" aria-selected="false" onclick="show_bank(this)" name="WAP">H5网页</a>
                            </li>-->
                        </ul>
                    </div>
                    <div class="check_box" id="myTabContent">
                        <div class="tab-pane active" id="GATEWAY" role="tabpanel" aria-labelledby="GATEWAY-tab">
                            <?php
                            if (count($configext['bankCode'] > 0)) {
                                foreach ($configext['bankCode'] as $key1 => $value1) {
                                    if ($value1['img'] != '') {
                                        echo '<div>';
                                        echo '<input type="radio" name="bankCode" id="' . $value1['img'] . '" value="' . $key1 . '">';
                                        echo '<label class="' . $value1['img'] . '" for="' . $value1['img'] . '"></label>';
                                        echo '</div>';
                                    } else {
                                        echo '<div>' . $value1['name'] . '</div>';
                                    }
                                }
                            } else {
                                echo '<div class="span2">';
                                echo '<label class="radio">';
                                echo '查無銀行列表';
                                echo '</label>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="tab-pane" id="QRCODE" role="tabpanel" aria-labelledby="profile-tab">
                            <?php
                            if (count($configext['type'] > 0)) {
                                foreach ($configext['type'] as $key1 => $value1) {
                                    if ($value1['type'] == 'pc') {
                                        if ($value1['img'] != '') {
                                            echo '<div>';
                                            echo '<input type="radio" name="bankCode" id="' . $value1['img'] . '" value="' . $key1 . '">';
                                            echo '<label class="' . $value1['img'] . '" for="' . $value1['img'] . '"></label>';
                                            echo '</div>';
                                        } else {
                                            echo '<div>' . $value1['name'] . '</div>';
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="tab-pane" id="WAP" role="tabpanel" aria-labelledby="contact-tab">
                            <?php
                            if (count($configext['type'] > 0)) {
                                foreach ($configext['type'] as $key1 => $value1) {
                                    if ($key1 == $trade_type) {
                                        if ($value1['type'] == 'mobile') {
                                            if ($value1['img'] != '') {
                                                echo '<div>';
                                                echo '<input type="radio" name="bankCode" id="' . $value1['img'] . '" value="' . $key1 . '">';
                                                echo '<label class="' . $value1['img'] . '" for="' . $value1['img'] . '"></label>';
                                                echo '</div>';
                                            } else {
                                                echo '<div>' . $value1['name'] . '</div>';
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                        if ($trade_type == 'USDT') {
                            echo "<div class = pay> address：" . $address['0'] . "</div>";
                        }
                        else if ($trade_type == 'ETH_USDT') {
                            echo "<div class = pay> address：" . $address['0'] . "</div>";
                            echo "<div class = pay> Contract：" . $address['1'] . "</div>";
                        }
                        else {
                            echo "<div class = pay>尚未设定支付类别</div>";
                        }
                    ?>
                </div>
                <input type="hidden" name="user_name" value="<?= substr($user_name, 0, 10) ?>">
                <!--用户名-->
                <input type="hidden" name="uid" value="<?= $uid ?>">
                <!--回传参数-->
                <input type="hidden" id="payType" name="payType" value="GATEWAY">
                <!--支付類型(預設網關)-->
            </form>
        </main>

    </body>

    </html>