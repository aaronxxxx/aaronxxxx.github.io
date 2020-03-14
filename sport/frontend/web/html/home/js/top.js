$(function () {
    initUserNameField();                                   // 初始化用户名域
    initUserPwdField();                                    // 初始化用户密码域
    
    $('#yzm').bind('keypress',function(event){             // 绑定回车事件
        if(event.keyCode === 13) {
            $("#btnlogin").click();
        }
    });
    
    // 验证码
    $("#rmNum").click(function(){
//        this.src = this.src.toString();
        var verify=document.getElementById('rmNum');
        verify.setAttribute('src','/?r=site/captcha&'+Math.random());
    });
    
    // 登录验证
    $("#btnlogin").click(login);
    
    getLoginedInfo();                                      // 获取用户登录后的信息
    window.setInterval("getLoginedInfo()",30000);
});

/**
 * 初始化用户名域
 * @returns {}
 */
function initUserNameField() {
    $("#name").val('用户名');
    $("#name").focus(function () {
        $(this).val("");
    }).blur(function () {
        if ($(this).val() === "") {
            $(this).val("用户名");
        }
    });
}

/**
 * 初始化用户密码域
 * @returns {}
 */
function initUserPwdField() {
    $("#showPwd").focus(function() {
        var text_value = $(this).val();
        if (text_value == this.defaultValue) {
            $("#showPwd").hide();
            $("#pwd").show().focus();
        }
    });
    $("#pwd").blur(function() {
        var text_value = $(this).val();
        if (text_value == "") {
        $("#showPwd").show();
        $("#pwd").hide();
    }
    });
}

/**
 * 获取用户登录后的
 * 信息
 * @returns {}
 */
function getLoginedInfo() {
    $.post($("#loginform").attr("action"), {},
        function (rst) {
            if (rst.code == 3) {
                alert(rst.msg);
                window.top.location.reload();
            }
            if (rst.code !== 0) {
                return ;
            }
            
            $("#login").hide();
            $("#account-info").show();

            $("#login_name").html(rst.data.user.name);
            $("#user_money").html(rst.data.user.money);
            $("#msg_num").html(rst.data.user.msg_num);
        }, 
    "json");
}

/**
 * 字段校验及登录
 * @returns {Boolean}
 */
function login() {
    var name = $("#name").val();
    var pwd = $("#pwd").val();
    var yzm = $("#yzm").val();
    if (name === '' || name === '用户名') {
        alert("用户名不能为空");
        return false;
    } else if (pwd === '' || pwd === '密码') {
        alert("密码不能为空");
        return false;
    } else if (yzm === '') {
        alert("验证码不能为空");
        return false;
    }

    $.post($("#loginform").attr("action"), {
        cmd: 'login',
        name: name,
        pwd:  pwd,
        verifyCode: yzm
    }, function (rst) {
        if (rst.code === 0) {
            $("#loginform").hide();
            $(".loginok").show();

            $("#login_name").html(rst.data.user.name);
            $("#user_money").html(rst.data.user.money);
            $("#msg_num").html(rst.data.user.msg_num);
            window.top.location.reload();
        } else {
            alert(rst.msg);
            $("#yzm").val('').focus();
            $("#rmNum").click();
        }
    }, "json");
}

/**
 * 退出登录
 * @returns {}
 */
function logout() {
    $.post($("#logout").attr("href"), {}, 
        function (rst) {
            window.location.reload();
        }, 
    "html");
}