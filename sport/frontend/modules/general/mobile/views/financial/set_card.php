<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include 'member_top.php' ?>
    <div class="tabinner">
        <div class="charge">
            <form id="form1" name="setcard" method="post" action="/?r=member/withdraw/set-card" class="tabinnerItem">
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">取款密码:</p>
                    <input class="r_ip" type="password" name="qk_pwd" id="qk_pwd" placeholder="请输入取款密码" tabindex="1">
                </div>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">开户姓名:</p>
                    <input class="r_ip" type="text" name="pay_name" id="pay_name" placeholder="请输入开户姓名">
                </div>
            <?php
                if ($userlist['trade_type'] != 1 && $userlist['trade_type'] != 2) {
            ?>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">借记卡类:</p>
                    <select id="pay_card" class="r_slt inputSelect" name="pay_card" tabindex="2">
                        <option value="中国工商银行" selected="selected">中国工商银行</option>
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
                        <option value="光大银行">光大银行</option>
                        <option value="其它银行">其它银行</option>
                    </select>
                    <div class="r_tg"></div>
                    <div class="r_bi DEFAULT" for="fast"></div>
                </div>
                <div class="d-flex inputitem text-end pay_card_other" style="display:none">
                    <p class="r_lb">其他银行:</p>
                    <input class="r_ip" type="text" value="">
                </div>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">借记卡号:</p>
                    <input class="r_ip" type="text" name="pay_num" id="pay_num" value="" tabindex="3">
                </div>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">开户地区:</p>
                    <select id="add1" name="add1" class="r_slt inputSelect" tabindex="4">
                        <option value="北京" selected="selected">北京</option>
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
                    <div class="r_tg"></div>
                    <div class="r_bi DEFAULT" for="fast"></div>
                </div>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">开户市:</p>
                    <input class="r_ip" type="text" name="add2" id="add2" placeholder="开户所在城市" tabindex="5">
                </div>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">开户网点:</p>
                    <input class="r_ip" type="text" name="add3" id="add3" placeholder="开户网点" tabindex="6">
                </div>
            <?php
                } else {
            ?>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">交易方式:</p>
                    <input type="text" class="r_ip" value="<?= $tradeType[$userlist['trade_type']] ?>" disabled>
                    <input type="hidden" name="pay_card" id="pay_card" value="<?= $tradeType[$userlist['trade_type']] ?>">
                </div>
                <div class="d-flex inputitem text-end">
                    <p class="r_lb">交易帐号/地址:</p>
                    <input type="text" class="r_ip" name="pay_num" id="pay_num" value="" maxlength="50">
                    <input type="hidden" name="add1" id="add1" value="<?= $tradeType[$userlist['trade_type']] ?>">
                    <input type="hidden" name="add2" id="add2" value="交易">
                    <input type="hidden" name="add3" id="add3" value="方式">
                </div>
            <?php
                }
            ?>
                <div class="suoming">
                    <input type="checkbox" name="readrule" checked="checked" id="readrule" tabindex="8" />
                    <span>我已查看提款须知，并已清楚了解了</span>
                </div>
                <div class="suoming">
                    <input type="checkbox" checked="checked" name="readrule2" id="readrule2" tabindex="9" />
                    <span>绑定此取款信息</span>
                </div>
                <div class="btn">
                    <input onclick="check_submit()" type="button" class="next ban" id="btn" value="提交" tabindex="10" />
                </div>

            </form>
        </div>
    </div>

</main>
<script>
    $(function() {
        $('#finance .financeitem').eq(1).addClass('act').siblings().removeClass('act');
        $("#pay_card").click(function() {
            if ($("#pay_card option:selected").text() == "其它银行") {
                $(".pay_card_other").show();
            } else {
                $(".pay_card_other").hide();
            }
        });
        $(".pay_card_other input").bind("input propertychange", function() {
            $("#pay_card option:selected").val($(".pay_card_other input").val());
        });
    })

    function check_submit() {
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
        $.ajax({
            type: "POST",
            url: "/?r=mobile/financial/set-card",
            data: $('#form1').serialize(),
            dataType: 'json',
        }).done(function(msg) {
            if (msg == "0") {
                alert('提交成功！');
                window.location.href = "/?r=mobile/financial/withdraw";
            } else {
                alert(msg.msg);
            }
        }).fail(function(error) {
            alert(error.responseText);
        });

    }
</script>