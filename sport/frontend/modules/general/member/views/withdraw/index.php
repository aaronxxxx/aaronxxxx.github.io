<html>

<head>
    <title>取款</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="/public/js/jquery-1.7.2.min.js"></script>
    <script language="javascript">
        $(function() {
            $("#pay_card").click(function() {
                if ($("#pay_card option:selected").text() == "其它银行") {
                    $("#list-name-for-select").show();
                } else {
                    $("#list-name-for-select").hide();
                }
            });
            $("#list-name-for-select").bind("input propertychange", function() {
                $("#pay_card option:selected").val($("#list-name-for-select").val());
            });
        })

        function check_submit() {
            var chenked1 = $("input[name='readrule']:checked").val();
            var chenked2 = $("input[name='readrule2']:checked").val();
            if (chenked1 != 1) {
                alert("请勾选协议！");
                return false;
            }
            if (chenked2 != 2) {
                alert("请勾选协议！");
                return false;
            }
            if ($("#qk_pwd").val() == "") {
                alert("请输入您注册时设置的取款密码");
                $("#qk_pwd").focus();
                return false;
            }
            if ($("#pay_name").val() == "") {
                alert("请填写好你的开户姓名");
                $("#pay_name").focus();
                return false;
            }
            if ($("#pay_num").val() == "") {
                alert("请填写好你的银行卡号");
                $("#pay_num").focus();
                return false;
            }
            if ($("#add2").val() == "") {
                alert("请填写好你银行开户行所在的地区");
                $("#add2").focus();
                return false;
            }
            if ($("#add3").val() == "") {
                alert("请填写好你的开户行名称");
                $("#add3").focus();
                return false;
            }
            $.post('/?r=member/withdraw/set-card', {
                qk_pwd: $("#qk_pwd").val(),
                pay_name: $("#pay_name").val(),
                pay_card: $("#pay_card").val(),
                pay_num: $("#pay_num").val(),
                add1: $("#add1").val(),
                add2: $("#add2").val(),
                add3: $("#add3").val(),
                vlcodes: $("#vlcodes").val()
            }, function(result) {
                if (result.status) {
                    alert(result.msg);
                    window.location.href = "/?r=member/withdraw/index";
                } else {
                    alert(result.msg);
                }
            }, 'json')
        }

        function next_checkNum_img() {
            var verify = document.getElementById('checkNum_img');
            verify.setAttribute('src', '/?r=member/index/captcha&' + Math.random());
            return false;
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
                <h2>- 新会员首次取款请完善个人资料 -</h2>
            </div>
            <div class="main_box">
                <div class="otherpay_box">
                    <div class="leftbox">
                        <p>提款须知：</p>
                        <br>
                        <p>(1).银行账户持有人姓名必须与在本娱乐城注册时输入的姓名一致，否则无法申请提款。</p>
                        <br>
                        <p>(2).大陆各银行帐户均可申请提款。</p>
                        <br>
                        <p>(3).每个会员账户（北京时间）24小时内只免费提供三次提款。</p>
                        <br>
                        <p>(4).买彩后未经全额投注（存款金额一倍流水）提款申请不予受理。</p>
                        <br>
                        <p>(5).每位客户只可以使用一张银行卡进行提款,如需要更换银行卡请与客服人员联系.否则提款将被拒绝。</p>
                        <br>
                        <p>(6).为保障客户资金安全，本娱乐城有可能需要用户提供电话单，银行对账单或其它资料验证，以确保客户资金不会被冒领。</p>
                        <br>
                        <p>到账时间：</p>
                        <p>5-15分钟急速到账时间</p>
                    </div>
                    <div class="rightbox">
                        <p class="user_name"><?= $username ?><span class="ps">(亚洲用户请输入以下资料)</span></p>
                        <form id="form1" name="form1" method="post" action="/?r=member/withdraw/set-card">
                            <div>
                                <input name="qk_pwd" type="password" id="qk_pwd" maxlength="30" placeholder="取款密码" />
                            </div>
                            <div>
                                <input name="pay_name" type="text" id="pay_name" placeholder="开户姓名">
                            </div>
                        <?php
                            if ($trade_type != 1 && $trade_type != 2) {
                        ?>
                            <div>
                                <select id="pay_card" name="pay_card">
                                    <option value="" selected="selected">借记卡种类</option>
                                    <option value="中国工商银行">中国工商银行</option>
                                    <option value="中国招商银行">中国招商银行</option>
                                    <option value="中国农业银行">中国农业银行</option>
                                    <option value="中国建设银行">中国建设银行</option>
                                    <option value="中国民生银行">中国民生银行</option>
                                    <option value="中国交通银行">中国交通银行</option>
                                    <option value="深圳发展银行">深圳发展银行</option>
                                    <option value="中国邮政银行">中国邮政银行</option>
                                    <option value="中国银行">中国银行</option>
                                    <option value="兴业银行">兴业银行</option>
                                    <option value="中信银行">中信银行</option>
                                    <option value="广大银行">广大银行</option>
                                    <option value="">其它银行</option>
                                </select>
                                <input type="text" style="display:none;margin:5px 0 10px;" id="list-name-for-select" placeholder="请输入其它银行类型">
                            </div>
                            <div>
                                <input name="pay_num" type="text" id="pay_num" maxlength="19" placeholder="借记卡号" />
                            </div>
                            <div>
                                <select id="add1" name="add1">
                                    <option value="" selected="selected">开户地区</option>
                                    <option value="北京">北京</option>
                                    <option value="上海">上海</option>
                                    <option value="天津">天津</option>
                                    <option value="广东">广东</option>
                                    <option value="重庆">重庆</option>
                                    <option value="河北">河北</option>
                                    <option value="河南">河南</option>
                                    <option value="江苏">江苏</option>
                                    <option value="浙江">浙江</option>
                                    <option value="山东">山东</option>
                                    <option value="山西">山西</option>
                                    <option value="广西">广西</option>
                                    <option value="福建">福建</option>
                                    <option value="内蒙古">内蒙古</option>
                                    <option value="黑龙江">黑龙江</option>
                                    <option value="辽宁">辽宁</option>
                                    <option value="吉林">吉林</option>
                                    <option value="新疆">新疆</option>
                                    <option value="甘肃">甘肃</option>
                                    <option value="宁夏">宁夏</option>
                                    <option value="陕西">陕西</option>
                                    <option value="湖北">湖北</option>
                                    <option value="湖南">湖南</option>
                                    <option value="江西">江西</option>
                                    <option value="四川">四川</option>
                                    <option value="贵州">贵州</option>
                                    <option value="云南">云南</option>
                                    <option value="西藏">西藏</option>
                                    <option value="青海">青海</option>
                                    <option value="海南">海南</option>
                                    <option value="安徽">安徽</option>
                                    <option value="香港">香港</option>
                                    <option value="澳门">澳门</option>
                                    <option value="其他">其他</option>
                                </select>
                            </div>
                            <div>
                                <input name="add2" type="text" id="add2" placeholder="开户市" />
                            </div>
                            <div>
                                <input name="add3" type="text" id="add3" placeholder="开户网点" />
                            </div>
                        <?php
                            } else {
                        ?>
                            <input type="text" class="user_pay_name" disabled value="交易方式: <?= $tradeType[$trade_type] ?>">
                            <input type="text" name="pay_num" id="pay_num" maxlength="50" placeholder="交易帐号/地址">
                            <input type="hidden" name="pay_card" id="pay_card" value="<?= $tradeType[$trade_type] ?>">
                            <input type="hidden" name="add1" id="add1" value="<?= $tradeType[$trade_type] ?>">
                            <input type="hidden" name="add2" id="add2" value="交易">
                            <input type="hidden" name="add3" id="add3" value="方式">
                        <?php
                            }
                        ?>
                            <div class="bottom_box">
                                <input name="vlcodes" type="text" id="vlcodes" size="5" maxlength="4" onfocus="next_checkNum_img()" style="width:212px;" placeholder="验证码" />
                                <img src="/?r=member/index/captcha" alt="点击更换" name="checkNum_img" id="checkNum_img" class="checkNum_img" onclick="next_checkNum_img()" />
                            </div>
                            <div style="padding-top:10px">
                                <input type="checkbox" class="checkbox" name="readrule" id="readrule" value="1" />
                                <label for="readrule">我已查看提款须知，并已清楚了解了</label>
                            </div>
                            <div>
                                <input type="checkbox" class="checkbox" name="readrule2" id="readrule2" value="2" />
                                <label for="readrule2">绑定此取款信息</label>
                            </div>
                            <div>
                                <input type="button" onclick="check_submit()" value="提交" class="confirm_btn" />
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