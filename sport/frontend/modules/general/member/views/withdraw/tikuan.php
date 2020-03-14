<html>

<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script language="javascript" type="text/javascript">
        function next_checkNum_img() {
            var verify = document.getElementById('checkNum_img');
            verify.setAttribute('src', '/?r=member/index/captcha&' + Math.random());
            return false;
        }

        function check_submit() {
            var m = <?= $min_money; ?>;
            if ($("#qk_pwd").val() == "") {
                alert("请输入您注册时设置的取款密码");
                $("#qk_pwd").focus();
                return false;
            }
            var re = /^[1-9]+[0-9]*]*$/;
            if (!re.test($("#pay_value").val())) {
                alert("提款金额必须为正整数");
                return false;
            }
            var num = $("#pay_value").val();
            if (num < m) {
                alert("最低提款金额为" + m + "元");
                $("#pay_value").select();
                return false;
            }
            var money = $("#hyye").html() * 1;
            if (num > money) {
                alert("对不起，您的余额不足");
                return false;
            }
            var yzm = $("#vlcodes").val();
            if (yzm.length < 4) {
                alert("请您输入验证码");
                $("#vlcodes").select();
                return false;
            }

            $.post("/?r=member/withdraw/tikuan", {
                qk_pwd: $('#qk_pwd').val(),
                pay_value: $('#pay_value').val(),
                vlcodes: $('#vlcodes').val(),
            }, function(result) {
                if (result.status) {
                    alert(result.msg);
                    window.location.href = "/?r=member/transaction-log/bank&type=qk";
                } else {
                    alert(result.msg);
                }
            }, 'json');

        }
    </script>



</head>

<body>
    <div id="MACenterContent">
        <div class="MNav">
            <a href="/?r=member/live/index" class="mbtn">额度转换</a>
            <a href="/?r=member/deposit/index" class="mbtn">线上存款</a>
            <a href="/?r=member/remittance/index" class="mbtn">银行汇款</a>
            <a href="/?r=member/remittance/index2" class="mbtn">其他支付</a>
            <span class="mbtn active">线上取款</span>
        </div>
        <div id="MMainData" class="pay_cont">
            <div class="title_box">
                <h3><?php echo $user['user_name']; ?></h3>
                <div class="title_data">
                    <table>
                        <tr>
                            <td>当前余额:</td>
                            <td id="hyye"><?php echo $user["money"]; ?></td>
                        </tr>
                    <?php
                        if ($user["trade_type"] != 1 && $user["trade_type"] != 2) {
                    ?>
                        <tr>
                            <td>银行名称:</td>
                            <td><?php echo $user["pay_bank"]; ?></td>
                        </tr>
                        <tr>
                            <td>银行账号:</td>
                            <td><?php echo $user["pay_num"]; ?></td>
                        </tr>
                        <tr>
                            <td>开户地址:</td>
                            <td><?php echo $user["pay_address"]; ?></td>
                        </tr>
                    <?php
                        } else {
                    ?>
                        <tr>
                            <td>交易方式:</td>
                            <td><?= $user["pay_bank"]; ?></td>
                        </tr>
                        <tr>
                            <td>交易帐号/地址:</td>
                            <td><?= $user["pay_num"]; ?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </table>
                </div>
            </div>
            <div class="main_box">
                <div class="otherpay_box">
                    <div class="leftbox">
                        <p>提款须知：</p>
                        <br>
                        <p>(1).银行账户持有人姓名必须与在注册时输入的姓名一致，否则无法申请提款。</p>
                        <br>
                        <p>(2).大陆各银行帐户均可申请提款。</p>
                        <br>
                        <p>(3).每个会员账户（北京时间）24小时内只免费提供三次提款。</p>
                        <br>
                        <p>(4).买彩后未经全额投注（存款金额一倍流水）提款申请不予受理。</p>
                        <br>
                        <p>(5).每位客户只可以使用一张银行卡进行提款,如需要更换银行卡请与客服人员联系.否则提款将被拒绝。</p>
                        <br>
                        <p>(6).为保障客户资金安全，本娱乐城有可能需要用户提供电话单，银行对账单或其它资料验证，以确保客户资金不会被冒领。 </p>
                        <br>
                        <br>
                        <p>到账时间：</p>
                        <br>
                        <p>5-15分钟到账急速到账时间</p>
                    </div>
                    <div class="rightbox">
                        <form name="tikuanform" id="tikuanform" method="post" action="">
                            <p style="text-align:center;font-size:14px;">- 请认真填写取款表单 -</p>
                            <div>
                                <input name="qk_pwd" type="password" id="qk_pwd" maxlength="30" placeholder="取款密码" />
                            </div>
                            <div>
                                <input name="pay_value" type="text" id="pay_value" onkeyup="if(isNaN(value))execCommand('undo')" maxlength="8" placeholder="取款金额" />
                                <p style="padding-top:4px;">最低取款金额:<?= $min_money; ?></p>
                            </div>
                            <div class="bottom_box">
                                <input name="vlcodes" type="text" id="vlcodes" size="5" maxlength="4" onfocus="next_checkNum_img()" placeholder="验证码" style="width:212px;" />
                                <img src="/?r=member/index/captcha" alt="点击更换" name="checkNum_img" id="checkNum_img" onclick="next_checkNum_img()" class="checkNum_img" />
                            </div>
                            <div>
                                <input onclick="check_submit()" type="button" class="confirm_btn" id="btn" value="提交" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#MACenter').attr('data-current', 'mytransaction');
    </script>
</body>

</html>