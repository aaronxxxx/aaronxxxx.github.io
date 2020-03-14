<!-- 主内容 -->
<div id="main">
    <!--财务中心：提款-->
    <div class="all">
        <div class="f_mb">
            <div class="f_acti"></div>
            <span id="h_menber"><?= $userlist['user_name'] ?></span> <a class="f_rfs" href="javascript:;" onclick="refreshWallet()"></a>
        </div>
        <div class="f_list">
            <div class="f_item" wallet="main">
                <span class="fl">中心钱包(<span id="currencyShow">CNY</span>):</span> <span class="fn" style="display: inline;" id="centerAmount"><?= $userlist['money'] ?></span>
                <div class="ld" style="display: none;"></div>
            </div>
        </div>
    </div>
    <div class="f_ctrl">
        <div class="f_ent">
            <a class="f_cei " href="/?r=mobile/financial/index"></a>
            <div class="f_cet">存款</div>
        </div>
        <div class="f_ent">
            <a class="f_cei fcw fcd_on" href="/?r=mobile/financial/withdraw"></a>
            <div class="f_cet">提款</div>
        </div>
        <div class="f_ent">
            <a class="f_cei fch" href="/?r=mobile/financial/vip"></a>
            <div class="f_cet">贵宾报表</div>
        </div>
    </div>
    <div class="f_bg">
        <div class="f_sd"></div>
        <div class="f_ag w">
            <div></div>
        </div>
    </div>
    <div class="deposit_pan" id="bankInfo">
        <div id="pointInfo" class="deposit_pan prb2 s2" style="height: auto;">
            <div class="mm">
                <div class="status">
                    <span class="">亚洲用户请输入以下资料1111</span>
                </div>
                <form id="form1" name="setcard" method="post" action="/?r=member/withdraw/set-card">
                    <div class="row2">
                        <div class="r_lb">取款密码:</div>
                        <input class="r_ip" type="password" name="qk_pwd" id="qk_pwd" placeholder="请输入取款密码" tabindex="1">
                    </div>
                    <div class="row2">
                        <div class="r_lb">开户姓名:</div>
                        <input class="r_ip" type="text" name="pay_name" id="pay_name" value="" disabled="disabled">
                    </div>
                    <div class="row2">
                        <div class="r_lb">借记卡类:</div>
                        <select id="pay_card" class="r_slt" name="pay_card" tabindex="2">
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
                    <div class="row2 pay_card_other" style="display:none">
                        <div class="r_lb">其他银行:</div>
                        <input class="r_ip" type="text" value="">
                    </div>
                    <div class="row2">
                        <div class="r_lb">借记卡号:</div>
                        <input class="r_ip" type="text" name="pay_num" id="pay_num" value="" tabindex="3">
                    </div>
                    <div class="row2">
                        <div class="r_lb">开户地区:</div>
                        <select id="add1" name="add1" class="r_slt" tabindex="4">
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
                    <div class="row2">
                        <div class="r_lb">开户市:</div>
                        <input class="r_ip" type="text" name="add2" id="add2" placeholder="开户所在城市" tabindex="5">
                    </div>
                    <div class="row2">
                        <div class="r_lb">开户网点:</div>
                        <input class="r_ip" type="text" name="add3" id="add3" placeholder="开户网点" tabindex="6">
                    </div>
                    <div class="suoming">
                        <input type="checkbox" name="readrule" checked="checked" id="readrule" tabindex="8" /><span style="vertical-align:middle;">我已查看提款须知，并已清楚了解了</span>
                    </div>
                    <div class="suoming mgtop0">
                        <input type="checkbox" checked="checked" name="readrule2" id="readrule2" tabindex="9" /><span style="vertical-align:middle;">绑定此取款信息</span>
                    </div>
                    <input onclick="check_submit()" type="button" class="next ban" id="btn" value="提交" tabindex="10" />
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>

</body>
<script>
    $(function() {
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

</html>