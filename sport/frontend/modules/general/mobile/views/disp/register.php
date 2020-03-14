<script>
    $(function() {
        // getAgentsInfo();
        var register_phone = "<?php echo $register_phone; ?>";
        var register_qq = "<?php echo $register_qq; ?>";
        // 電子信箱改為微信
        var register_weChat = "<?php echo $register_email; ?>";
        var register_name = "<?php echo $register_name; ?>";
        if (register_phone != "1") {
            $('#phone').parent().hide();
        }
        if (register_qq != "1") {
            $('#qq').parent().hide();
        }
        if (register_weChat != "1") {
            $('#weChat').parent().hide();
        }
        if (register_name != "1") {
            $('#real_name').parent().hide();
        } else if (register_name == '1') {
            uniqueUserRealName();
        }
        $('input[name=user_name]').keyup(function() {
            this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
        }).focus(function() {
            $(this).blur(function() {
                this.value = (/[^a-zA-Z0-9]/g.test(this.value)) ? '' : this.value;
            });
        });
        // $('input[name=real_name]').keyup(function() {
        //     this.value = this.value.replace( /[^\u4e00-\u9fa5a-zA-Z]/,'');
        //     }).focus(function(){
        //         $(this).blur(function(){ this.value = ( /[^\u4e00-\u9fa5a-zA-Z]/.test(this.value)) ? '' : this.value; });
        //     });
        $('input[name=withdrawal_code]').keyup(function() {
            this.value = this.value.replace(/[^0-9]+/, '');
        }).focus(function() {
            $(this).blur(function() {
                this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value;
            });
        });
        $('input[name=phone]').keyup(function() {
            this.value = this.value.replace(/[^0-9]+/, '');
        }).focus(function() {
            $(this).blur(function() {
                this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value;
            });
        });
        $('input[name=qq]').keyup(function() {
            this.value = this.value.replace(/[^0-9]+/, '');
        }).focus(function() {
            $(this).blur(function() {
                this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value;
            });
        });
        $('#user_name').bind('input propertychange', function() {
            var username = $("#user_name").val();
            var reg = /^[a-zA-Z\d]\w{2,10}[a-zA-Z\d]$/; //帐号
            if (username == '') {
                $(".remind").html('');
                return false;
            }
            if (username.length < 4 || username.length > 12) {
                $(".remind").html('用户名为4-12个字符').css('color', 'red');
                return false;
            }
            if (!reg.test(username)) {
                $(".remind").html('账号为数字、英文或两者组合').css('color', 'red');
                return false;
            }
            $.get("/?r=passport/user-api/unique-user-name", {
                name: username,
            }, function(r) {
                if (r.code == 0) { //不存在相同用户名
                    $(".remind").html('');
                } else { //存在相同用户名
                    $(".remind").html('账号已存在').css('color', 'red');
                }
            }, "json");
        });
        $('#password').bind('input propertychange', function() {
            var password = $("#password").val();
            var reg = /^[a-zA-Z\d]\w{4,10}[a-zA-Z\d]$/;
            if (password == '') {
                $(".reminds").html('');
                return false;
            }
            if (password.length < 6 || password.length > 12) {
                $(".reminds").html('密码为6-12个字符').css('color', 'red');
                return false;
            }
            if (password.length > 6 || password.length < 12) {
                $(".reminds").html('');
                return false;
            }
            if (!reg.test(password)) {
                $(".reminds").html('密码只能是数字、英文或两者组合').css('color', 'red');
                return false;
            }
        });
        $('#passwordchk').bind('input propertychange', function() {
            var passwordchk = $("#passwordchk").val();
            var reg = /^\w{6,12}$/;
            if (passwordchk == '') {
                $(".remindss").html('');
                return false;
            }
            if (passwordchk.length < 6 || passwordchk.length > 12) {
                $(".remindss").html('密码为6-12个字符').css('color', 'red');
                return false;
            }
            if (passwordchk.length > 6 || passwordchk.length < 12) {
                $(".remindss").html('');
                return false;
            }
            if (!reg.test(password)) {
                $(".reminds").html('密码只能是数字、英文或两者组合').css('color', 'red');
                return false;
            }
        });
        $('#withdrawal_code').bind('input propertychange', function() {
            var withdrawal_code = $("#withdrawal_code").val();
            if (withdrawal_code == '') {
                $(".reminded").html('');
                return false;
            }
            if (withdrawal_code.length < 4) {
                $(".reminded").html('密码为4个数字').css('color', 'red');
                return false;
            }
            if (withdrawal_code.length == 4) {
                $(".reminded").html('').css;
                return false;
            }
        });
        // $('#real_name').bind('input propertychange', function () {
        //     var real_name = $("#real_name").val();
        //     var de = /^[a-zA-Z\u4e00-\u9fa5 ]{1,20}$/;
        //     if (real_name == '' ) {
        //         $(".reminde").html('');
        //         return false;
        //     }
        //     if(!de.test(real_name)){
        //         $(".reminde").html('姓名只能是中文或者英文').css('color','red');
        //         return false;
        //     }
        // });
        $('#phone').bind('input propertychange', function() {
            var phone = $("#phone").val();
            var de = /^1[34578]\d{9}$/;
            if (phone == '') {
                $(".reminding").html('');
                return false;
            }
            if (!de.test(phone)) {
                $(".reminding").html('请填写正确的号码').css('color', 'red');
                return false;
            }
            if (de.test(phone)) {
                $(".reminding").html('');
                return false;
            }
        });

        $('#qq').bind('input propertychange', function() {
            var qq = $("#qq").val();
            if (qq == '') {
                $(".remindt").html('');
                return false;
            }
            if (qq.length < 6 || qq.length > 15) {
                $(".remindt").html('请填写qq号').css('color', 'red');
                return false;
            }
            if (qq.length > 6 || qq.length < 15) {
                $(".remindt").html('');
                return false;
            }
        });

        $('#weChat').bind('input propertychange', function() {
            var weChat = $("#weChat").val();
            var ds = /^[a-zA-Z]([-_a-zA-Z0-9]{5,19})+$/;
            if (weChat == '') {
                $(".remindh").html('');
                return false;
            }
            /* if(!ds.test(email)){
                 $(".remindh").html('请填写正确的邮箱').css('color','red');
                 return false;
             }*/
            if (ds.test(weChat)) {
                $(".remindh").html('');
                return false;
            }
        });
        $("#reg").click(function() {
            var agent_name = $("#agent_name").val();
            var user_name = $("#user_name").val();
            var password = $("#password").val();
            var passwordchk = $("#passwordchk").val(); //确认密码
            var withdrawal_code = $("#withdrawal_code").val();
            var real_name = $("#real_name").val();
            var phone = $("#phone").val();
            var qq = $("#qq").val();
            var weChat = $("#weChat").val();
            var trade_type = $("#trade_type").val();
            var verifyCode = $("#verifyCode").val();
            var pararms = $("#regform").serialize();
            if (user_name == "") {
                alert("请输入会员账号", 1);
                return false;
            }
            if (user_name.length < 4) {
                alert("会员账号长度太短,请设置4-12位之间", 1);
                return false;
            }
            if (user_name.length > 12) {
                alert("会员账号长度太长,请设置4-12位之间", 1);
                return false;
            }
            if (!(/^[a-zA-Z\d]\w{2,10}[a-zA-Z\d]$/).test(user_name)) {
                alert("账号必须以字母开头,由英文字母和数字组成的4-12位字符", 1);
                return false;
            }
            if (password == "") {
                alert("请输入密码", 1);
                return false;
            }
            if (password.length < 6 || passwordchk.length < 6) {
                alert("密码长度太短,请设置6-12位之间", 1);
                return false;
            }
            if (password.length > 12 || passwordchk.length > 12) {
                alert("密码长度太长,请设置6-12位之间", 1);
                return false;
            }
            if (passwordchk == "") {
                alert("请输入确认密码", 1);
                return false;
            }
            if (passwordchk != password) {
                alert("两次密码输入不一致", 1);
                return false;
            }
            // if (register_phone == "1") {
            //     if (!(/^1[34578]\d{9}$/.test(phone))) {
            //         alert('请输入有效的手机号码！', 1);
            //         return false;
            //     }
            // }
            // if (register_weChat == '1') {
            //     if (!(/^[a-zA-Z\d_\d-]{5,}$/.test(weChat))) {
            //         alert('微信输入有误，请重填！', 1);
            //         return false;
            //     }
            // }
            // if (register_qq == "1") {
            //     if (qq == "") {
            //         alert('请输入QQ号！', 1);
            //         return false;
            //     }
            // }
            // if (real_name == "") {
            //     alert("请输入您的真实姓名", 1);
            //     return false;
            // }
            // if ($("#is_user_name").val() != 1) {
            //     alert("真实姓名已存在", 1);
            //     return false;
            // }
            if (withdrawal_code == "") {
                alert("请输入您的取款密码", 1);
                return false;
            }
            if (withdrawal_code.length < 4) {
                alert("取款密码太短,密码长度为4位", 1);
                return false;
            }
            if (withdrawal_code.length > 4) {
                alert("取款密码太长,密码长度不超过4位", 1);
                return false;
            }
            if (trade_type == '') {
                alert("交易方式不能为空");
                return false;
            }
            if (verifyCode == "") {
                alert("请输入验证码", 1);
                return false;
            }

            $.post("/?r=mobile/user/register", {
                name: user_name,
                pwd: password,
                withdraw_pwd: withdrawal_code,
                real_name: real_name,
                phone: phone,
                qq: qq,
                email: weChat,
                agent_name: agent_name,
                trade_type: trade_type,
                verifyCode: verifyCode,
                pararms: pararms
            }, function(result) {
                if (result.code == '0') {
                    alert("注册成功");
                    window.location.href = "/?r=mobile/disp/index";
                } else {
                    console.log(result.msg);
                    alert(result.msg);
                    clear();
                    getverifyCode();
                }
            }, "json");
        })
    })
    //清空文本框
    function clear() {
        $("input[type='text']").each(function(index) {
            $(this).val("");
        });

        $("input[type='password']").each(function(index) {
            $(this).val("");
        });
    }

    function getverifyCode() {
        console.log('vPic');
        var verify = document.getElementById('vPic');
        verify.setAttribute('src', '/?r=mobile/index/captcha&' + Math.random());
    }
    /**
     * 获取代理信息
     * @returns {}
     */
    function getAgentsInfo() {
        $.post("/?r=passport/user-api/agents", {},
            function(rst) {
                $("#agent_name").val(rst.data.user.agents_name);
            },
            "json");
    }
    /**
     * 对判断真实姓名进行判断
     */
    function uniqueUserRealName() {
        $("#real_name").bind('input propertychange', function() {
            var v = $("#real_name").val();
            $.get("/?r=passport/user-api/unique-user-real-name", {
                name: v,
            }, function(r) {
                if (r.code == 0) { //不存在相同真实姓名
                    //页面变化自己写
                    $("#is_user_name").val('1');
                    $(".reminde").html('真实姓名可使用').css('color', 'green');
                } else { //存在相同真实姓名
                    //页面变化自己写
                    $("#is_user_name").val('2');
                    $(".reminde").html('真实姓名已存在').css('color', 'red');
                }
            }, "json");
        });
    }
</script>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="注册">
    <form id="regform" method="post">
        <div class="inputArea">
            <ul class="regArea">
                <li class="inputItem d-flex">
                    <span class="regLabel">用户名</span>
                    <input type="text" placeholder="请输入4-12位英文、数字及两者组合" id="user_name" name="user_name" maxlength="12">
                </li>
                <li class="inputItem d-flex">
                    <span class="regLabel">密码</span>
                    <input type="password" placeholder="请输入6-12位英文、数字及两者组合" id="password" name="password" maxlength="12">
                </li>
                <li class="inputItem d-flex">
                    <span class="regLabel">确认密码</span>
                    <input class="bd_a ibg2" type="password" placeholder="请输入6-12位英文、数字及两者组合" id="passwordchk" name="passwordchk" maxlength="12">
                </li>
                <li class="inputItem d-flex" style="display: none">
                    <span class="regLabel">真实姓名</span>
                    <input type="text" placeholder="请输入与您银行户口相同的真实姓名" id="real_name" name="real_name" maxlength="18">
                    <input type="hidden" name="" value="1" id="is_user_name">
                </li>
                <li class="inputItem d-flex">
                    <span class="regLabel">取款密码</span>
                    <input type="text" placeholder="请输入取款密码" id="withdrawal_code" name="withdrawal_code" maxlength="4">
                </li>
                <li class="inputItem d-flex" style="display: none">
                    <span class="regLabel">手机号</span>
                    <input type="text" placeholder="请输入手机号" id="phone" name="phone" maxlength="11">
                </li>
                <li class="inputItem d-flex" style="display: none">
                    <span class="regLabel">QQ号</span>
                    <input type="text" placeholder="请输入QQ号" id="qq" name="qq" maxlength="15">
                </li>
                <li class="inputItem d-flex" style="display: none">
                    <span class="regLabel">微信号</span>
                    <input type="text" placeholder="请输入微信号" id="weChat" name="weChat">
                </li>
                <li class="inputItem d-flex">
                    <span class="regLabel">出入金方式</span>
                    <select name="trade_type" id="trade_type">
                        <option value="1">USDT</option>
                        <option value="2">ETH_USDT</option>
                        <option value="3">其他</option>
                    </select>
                </li>
                <li class="inputItem d-flex">
                    <span class="regLabel">推荐代码</span>
                    <input type="text" name="agent_name" id="agent_name" value="<?= $agentname ?: null ?>" <?= $agentname ? 'readonly' : null ?> placeholder="英文、数字及两者组合，如无请留空">
                </li>
                <!-- <li class="inputItem d-flex">
                    <span class="regLabel">邮箱</span>
                    <input type="text" placeholder="请输入邮箱" id="email" name="email">
                </li> -->
                <li class="inputItem d-flex verifyBox">
                    <span class="regLabel">验证码</span>
                    <input type="text" placeholder="请输入验证码" id="verifyCode" name="verifyCode">
                    <div class="yzmimg"> <img id="vPic" src="/?r=mobile/index/captcha" onclick="getverifyCode();"></div>
                </li>
                <li class="inputItem d-flex">

                </li>
            </ul>
            <div class="agree d-flex justify-content-center">
                <input type="checkbox" id="check" checked="checked" name="agree" value="Y">
                <span>&nbsp;我已年满18岁,且在此网站所有活动没有抵触所在国家</span>
            </div>
        </div>
        <div class="btnArea">
            <ul>
                <li class="btnItem login" style="list-style: none;">
                    <input type="button" class="bd_b" value="注册" id='reg'>
                </li>
                <li class="btnItem logined">
                    <p>已有账号&emsp;
                        <a href="/?r=mobile/disp/login">前往登录</a>&emsp;
                        <a class="forgetPwd" href="javascript:;" onclick="alert('请与客服联系')">忘记密码?</a>
                    </p>
                </li>
            </ul>
        </div>
    </form>
</main>