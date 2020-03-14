        $(function () {
            getAgentsInfo();
            var register_phone = "<?php echo $register_phone;?>";
            var register_qq = "<?php echo $register_qq;?>";
            var register_email = "<?php echo $register_email;?>";
            var register_name = "<?php echo $register_name;?>";
            if(register_phone != "1"){
                $('#js-phone').hide();
            }
            if(register_qq != "1"){
                $('#js-qq').hide();
            }
            if(register_email != "1"){
                $('#js-email').hide();
            }
            if(register_name == "1"){
                uniqueUserRealName();
            }
            $('input[name=user_name]').keyup(function() {
                this.value = this.value.replace(/[^a-zA-Z0-9]/g,'');
                }).focus(function(){
                    $(this).blur(function(){ this.value = (/[^a-zA-Z0-9]/g.test(this.value)) ? '' : this.value; });
                });
            $('input[name=real_name]').keyup(function() {
                this.value = this.value.replace( /[^\u4e00-\u9fa5a-zA-Z]/,'');
                }).focus(function(){
                    $(this).blur(function(){ this.value = ( /[^\u4e00-\u9fa5a-zA-Z]/.test(this.value)) ? '' : this.value; });
                });
            $('input[name=withdrawal_code]').keyup(function() {
                this.value = this.value.replace(/[^0-9]+/,'');
                }).focus(function(){
                    $(this).blur(function(){ this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value; });
                });
            $('input[name=phone]').keyup(function() {
                this.value = this.value.replace(/[^0-9]+/,'');
                }).focus(function(){
                    $(this).blur(function(){ this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value; });
                });
            $('input[name=qq]').keyup(function() {
                this.value = this.value.replace(/[^0-9]+/,'');
                }).focus(function(){
                    $(this).blur(function(){ this.value = (/[^0-9]+/.test(this.value)) ? '' : this.value; });
                });
            $('#user_name').bind('input propertychange', function () {
                    var username = $("#user_name").val();
                    var reg = /^[a-zA-Z\d]\w{2,10}[a-zA-Z\d]$/; //帐号
                    if (username == '' ) {
                        $(".remind").html('');
                        return false;
                    }
                    if (username.length < 4 || username.length > 12 ) {
                        $(".remind").html('用户名为4-12个字符').css('color','red');
                        return false;
                    }
                    if(!reg.test(username)){
                        $(".remind").html('账号为数字、英文或两者组合').css('color','red');
                        return false;
                    }
                    $.get("/?r=passport/user-api/unique-user-name",{
                        name:username,
                    },function(r){
                        if(r.code == 0){//不存在相同用户名
                            $(".remind").html('');
                        }else{//存在相同用户名
                            $(".remind").html('账号已存在').css('color','red');
                        }
                    }, "json");
                });
            $('#password').bind('input propertychange', function () {
                var password = $("#password").val();
                var reg =  /^[a-zA-Z\d]\w{4,10}[a-zA-Z\d]$/;
                if (password == '' ) {
                    $(".reminds").html('');
                    return false;
                }
                if (password.length < 6 || password.length > 12 ) {
                    $(".reminds").html('密码为6-12个字符').css('color','red');
                    return false;
                }
                if (password.length > 6 || password.length < 12 ) {
                    $(".reminds").html('');
                    return false;
                }
                if(!reg.test(password)){
                    $(".reminds").html('密码只能是数字、英文或两者组合').css('color','red');
                    return false;
                }
            });
            $('#passwordchk').bind('input propertychange', function () {
                var passwordchk = $("#passwordchk").val();
                var reg = /^\w{6,12}$/;
                if (passwordchk == '' ) {
                    $(".remindss").html('');
                    return false;
                }
                if (passwordchk.length < 6 || passwordchk.length > 12 ) {
                    $(".remindss").html('密码为6-12个字符').css('color','red');
                    return false;
                }
                if (passwordchk.length > 6 || passwordchk.length < 12 ) {
                    $(".remindss").html('');
                    return false;
                }
                if(!reg.test(password)){
                    $(".reminds").html('密码只能是数字、英文或两者组合').css('color','red');
                    return false;
                }
            });
            $('#withdrawal_code').bind('input propertychange', function () {
                var withdrawal_code = $("#withdrawal_code").val();
                if (withdrawal_code == '' ) {
                    $(".reminded").html('');
                    return false;
                }
                if (withdrawal_code.length < 4) {
                    $(".reminded").html('密码为4个数字').css('color','red');
                    return false;
                }
                if (withdrawal_code.length == 4) {
                    $(".reminded").html('').css;
                    return false;
                }
            });
            $('#real_name').bind('input propertychange', function () {
                var real_name = $("#real_name").val();
                var de = /^[a-zA-Z\u4e00-\u9fa5 ]{1,20}$/;               
                if (real_name == '' ) {
                    $(".reminde").html('');
                    return false;
                }
                if(!de.test(real_name)){
                    $(".reminde").html('姓名只能是中文或者英文').css('color','red');
                    return false;
                }                
            });
            $('#phone').bind('input propertychange', function () {
                var phone = $("#phone").val();
                var de = /^1[34578]\d{9}$/;
                if (phone == '' ) {
                    $(".reminding").html('');
                    return false;
                }
                 if(!de.test(phone)){
                    $(".reminding").html('请填写正确的号码').css('color','red');
                    return false;
                }
                 if(de.test(phone)){
                    $(".reminding").html('');
                    return false;
                }
            });

            $('#qq').bind('input propertychange', function () {
                var qq = $("#qq").val();
                if (qq == '' ) {
                    $(".remindt").html('');
                    return false;
                }
                if (qq.length < 6 || qq.length > 15) {
                    $(".remindt").html('请填写qq号').css('color','red');
                    return false;
                }
                if (qq.length > 6 || qq.length < 15) {
                    $(".remindt").html('');
                    return false;
                }
            });

            $('#email').bind('input propertychange', function () {
                var email = $("#email").val();
                /*var ds=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;*/
                if (email == '' ) {
                    $(".remindh").html('');
                    return false;
                }
               /* if(!ds.test(email)){
                    $(".remindh").html('请填写正确的邮箱').css('color','red');
                    return false;
                }*/
                if(ds.test(email)){
                    $(".remindh").html('');
                    return false;
                }
            });            
            $("#reg").click(function () {
                var agent_name = $("#agent_name").val();
                var user_name = $("#user_name").val();
                var password = $("#password").val();
                var passwordchk = $("#passwordchk").val(); //确认密码
                var withdrawal_code = $("#withdrawal_code").val();
                var real_name = $("#real_name").val();
                var phone = $("#phone").val();
                var qq = $("#qq").val();
                var email = $("#email").val();
                var pararms = $("#regform").serialize();
                if (user_name == "") {
                    showTip("请输入会员账号", 1);
                    return false;
                }
                if (user_name.length<4) {
                    showTip("会员账号长度太短,请设置4-12位之间",1);
                    return false;
                }
                if (user_name.length>12) {
                    showTip("会员账号长度太长,请设置4-12位之间",1);
                    return false;
                }
                if (!(/^[a-zA-Z\d]\w{2,10}[a-zA-Z\d]$/).test(user_name)) {
                    showTip("账号必须以字母开头,由英文字母和数字组成的4-12位字符",1);
                    return false;
                }
                if (password == "") {
                    showTip("请输入密码", 1);
                    return false;
                }
                if (password.length < 6||passwordchk.length<6) {
                    showTip("密码长度太短,请设置6-12位之间", 1);
                    return false;
                }
                if (password.length > 12 || passwordchk.length > 12) {
                   showTip("密码长度太长,请设置6-12位之间", 1);
                   return false;
                }
                if (passwordchk == "") {
                    showTip("请输入确认密码", 1);
                    return false;
                }
                if (passwordchk != password) {
                    showTip("两次密码输入不一致", 1);
                    return false;
                }
                if(register_phone == "1"){
                    if(!(/^1[34578]\d{9}$/.test(phone))){
                        showTip('请输入有效的手机号码！', 1);
                        return false;
                    }
                }
                /*if(register_email == 1){
                    var ema = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    if(!(ema.test(email))){
                        showTip('邮箱输入有误，请重填！', 1);
                        return false;
                    }
                }*/
                if(register_qq == "1"){
                    if(qq==""){
                        showTip('请输入QQ号！', 1);
                        return false;
                    }
                }                
                if (real_name == "") {
                    showTip("请输入您的真实姓名", 1);
                    return false;
                }
                if($("#is_user_name").val()!=1){
                    showTip("真实姓名已存在", 1);
                    return false;                    
                }
                if (withdrawal_code == "") {
                   showTip("请输入您的取款密码", 1);
                    return false;
                }
                if (withdrawal_code.length<4) {
                   showTip("取款密码太短,密码长度为4位", 1);
                   return false;
                }
                if (withdrawal_code.length>4) {
                   showTip("取款密码太长,密码长度不超过4位", 1);
                  return false;
                }
                $.post("/?r=mobile/user/register", {
                    name: user_name,
                    pwd: password,
                    withdraw_pwd: withdrawal_code,
                    real_name: real_name,
                    phone: phone,
                    qq:qq,
                    email:email,
                    agent_name:agent_name,
                    pararms:pararms
                }, function (result) {
                    if (result.code == '0') {
                        alert("注册成功");
                        window.location.href = "/?r=mobile/disp/index";
                    } else {
                        console.log(result.msg);
                        alert(result.msg);
                        clear();
                    }
                }, "json");
            })
        })
        //清空文本框
        function clear() {
            $("input[type='text']").each(function (index) {
                $(this).val("");
            });

            $("input[type='password']").each(function (index) {
                $(this).val("");
            });
        }
        /**
         * 获取代理信息
         * @returns {}
         */
        function getAgentsInfo() {
            $.post("/?r=passport/user-api/agents", {},
                function (rst) {
                    $("#agent_name").val(rst.data.user.agents_name);
                },
            "json");
        }
        /**
         * 对判断真实姓名进行判断
         */
        function uniqueUserRealName(){
            $("#real_name").bind('input propertychange',function(){
                var v = $("#real_name").val();
                $.get("/?r=passport/user-api/unique-user-real-name",{
                    name:v,
                },function(r){
                    if(r.code == 0){//不存在相同真实姓名
                        //页面变化自己写
                        $("#is_user_name").val('1');
                        $(".reminde").html('真实姓名可使用').css('color','green');
                    }else{//存在相同真实姓名
                        //页面变化自己写
                        $("#is_user_name").val('2');
                        $(".reminde").html('真实姓名已存在').css('color','red');
                    }
                }, "json");
            });
        }