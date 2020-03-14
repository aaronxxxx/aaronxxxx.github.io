$(function () {
   // $(window.parent.parent.document).find("#main_index").height(800);
   // $(window.parent.document).find("#mbody").height(800);
    
    
    $('#yzm').bind('keypress',function(event){             // 绑定回车事件
        if(event.keyCode === 13) {
            $("#btnlogin").click();
        }
    });
    
    // 验证码
    $("#rmNum").click(function(){
        this.src = this.src.toString();
    });

    // 登录验证
    $("#btnlogin").click(login);
    
    getLoginedInfo();                                      // 获取用户登录后的信息
    
});
/**
 * 获取用户信息
 * @returns {undefined}
 */
function getLoginedInfo() {
    $.post("/?r=mobile/index/json",{},
    function(res){
        $("#zzkf").attr("href",res.zzkf);
        $("#zzkf2").attr("href",res.zzkf);
        $("#pcClient").attr("href",res.pcClient);
        $("#web_name").html(res.web_name);
        if(res.name !== ''){
            $("#weidenglu").hide();
            $("#user").show();
            $("#h_menber").html(res.name);
            $("#centerAmount").html(res.money);
            $("#pay_name").val(res.pay_name);
            $("#cn_date").val(res.day);
            $("#s_h").val(res.day2);
            $("#s_i").val(res.day3);
            $("#s_s").val(res.day4);
        }
        if(res.msg !== ''){
            alert(res.msg);
            window.location.href = "/?r=mobile/disp/index";
        }
    },"json");
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

    $.post("/?r=mobile/user/do-login", {
        cmd: 'login',
        name: name,
        pwd:  pwd,
        verifyCode: yzm
    }, function (rst) {
        console.log(rst);
        if (rst.code === 0) {
            alert('登陆成功！');
            window.location.href = "../../index.html";
        } else {
            alert(rst.msg);
            $("#yzm").val('').focus();
            $("#rmNum").click();
        }
    }, "json");
}

