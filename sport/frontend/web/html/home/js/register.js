$(function () {
    $(window.parent.parent.document).find("#main_index").height(800);
    $(window.parent.document).find("#mbody").height(800);
    
    // 注册验证
    $("#regbtn").click(function () {
        var username = $("#username").val();
        var agent_name = $("#agent_name").val();
        var pwd = $("#pwd").val();
        var chkpwd = $("#chkpwd").val();
        var withdraw_pwd = $("#pwd1").val() + $("#pwd2").val() +
                $("#pwd3").val() + $("#pwd4").val();
        var real_name = $("#real_name").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var pararms = $("#myFORM").serialize();

        if (username === '') {
            alert("账号不能为空");
            return false;
        } else if (pwd === '' || withdraw_pwd === '') {
            alert("密码不能为空");
            return false;
        } else if (chkpwd === ''  ) {
            alert("确认密码不能为空");
            return false;
        } else if(chkpwd !== pwd){
            alert("两次密码输入不一致");
            return false;
        } else if (real_name === '') {
            alert("真实姓名不能为空");
            return false;
        } else if (phone === '') {
            alert("手机不能为空");
            return false;
        } else if (email === '') {
            alert("邮箱不能为空");
            return false;
        }

        $.post("/?r=passport/user-api/register", {
            name: username,
            pwd: pwd,
            withdraw_pwd: withdraw_pwd,
            real_name: real_name,
            phone: phone,
            email: email,
            agent_name:agent_name,
            pararms:pararms
        },
                function (result) {
                    if (result.code === 0) {
                        alert("注册成功");
                        document.write("<script>window.top.document.location.reload();</script>");
                    } else {
                        alert(result.msg);
                    }
                }, "json");
    });
});