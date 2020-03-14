    <?php
    require_once('../PublicConf.class.php');
    require_once('config.php');
    //ini_set("display_errors", "On");
    header("Content-type: text/html; charset=utf-8");

    $config = new PublicConf('shunjie');

    //获取配置信息
    $configdata = $config->get_config();
    $configext = configExt($configdata, 'prod');
    $uid = $_GET['user_id'];
    $user_name = trim($_GET['user_name']);
    
    if (empty($uid) || empty($user_name)) {
        echo "缺少参数";
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>顺捷支付</title>
        <link type="text/css" rel="stylesheet" href="/static3/css/index.css" />
        <link type="text/css" rel="stylesheet" href="/static3/css/pay.css" />
        <script type="text/javascript" src="/static3/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="/static3/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            <div class="tittle_box">
                <a href="javascript:history.back()"></a>
                <h1>顺捷支付</h1>
            </div>
        </header>
        <main>
            <form id="mainForm" class="form-horizontal" action="paySubmit.php" method="POST">
                <div class="pay_box">
                    <h2><?= $user_name ?><span>账户充值</span></h2>
                    <input type="text" id='totalAmount' name="totalAmount" placeholder="金额">
                    <p>支持小数点两位金额；单笔<?php echo  $configdata['money_Lowest']; ?>~<?php echo  $configdata['money_limits']; ?>元。</p>
                </div>
                <div class="pay_check_box">
                    <div class="sort_box">
                        <ul id="myTab">
                            <!--<li class="active">
                                <a id="GATEWAY-tab" data-toggle="tab" href="#GATEWAY" role="tab" aria-controls="GATEWAY" aria-selected="true" onclick="show_bank(this)" name="GATEWAY">网关支付</a>
                            </li>-->
                            <li>
                                <a id="QRCODE-tab" data-toggle="tab" href="#QRCODE" role="tab" aria-controls="QRCODE" aria-selected="false" onclick="show_bank(this)" name="QRCODE">手机扫码</a>
                            </li>
                            <li>
                                <a id="WAP-tab" data-toggle="tab" href="#WAP" role="tab" aria-controls="WAP" aria-selected="false" onclick="show_bank(this)" name="WAP">H5网页</a>
                            </li>
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
                            ?>
                        </div>
                    </div>
                    <button class="pay_submitBtn" type="button" onclick="check_suc(this)">确认支付</button>
                </div>
                <input type="hidden" name="user_name" value="<?= substr($user_name, 0, 10) ?>">
                <!--用户名-->
                <input type="hidden" name="uid" value="<?= $uid ?>">
                <!--回传参数-->
                <input type="hidden" id="payType" name="payType" value="GATEWAY">
                <!--支付類型(預設網關)-->
            </form>
        </main>

        <script>
            function show_bank(ths) {
                var tag_name = $(ths).attr("name");
                $('#payType').val(tag_name);
            }

            function check_suc(obj) {
                var money = $('#totalAmount').val();
                var str = /^[0-9]+(\.[0-9]{1,2})?$/;		//限制小数点只能有两位数
                //var result = (money.toString()).indexOf("."); //限制小數點

                if (isNaN(money) || money == "") {
                    alert('金额输入有误！');
                    return false;
                }
                if (money < <?php echo  $configdata['money_Lowest']; ?>) {
                    alert("单笔充值最小金额" + <?php echo  $configdata['money_Lowest'] ?> + "元！");
                    return false;
                }
                if (money > <?php echo  $configdata['money_limits']; ?>) {
                    alert("单笔充值最高金额" + <?php echo  $configdata['money_limits'] ?> + "元！");
                    return false;
                }
                if (! str .test(money)){
                    alert('输入金额的小数点后只能保留两位！');return false;
                }
                /*if (result != -1) {
                    alert("请勿输入带有小数点金额！");
                    return false;
                }*/
                var checked = $('input[name="bankCode"]:checked').val();

                if (typeof(checked) == 'undefined') {
                    alert('请选择支付方式');
                    return
                }
                $(obj).attr('disabled', 'true');
                $(obj).text('正在提交，请稍后');
                $('#mainForm').submit();
            }
        </script>

    </body>

    </html>