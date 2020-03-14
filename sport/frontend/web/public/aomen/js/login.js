$(function () {
  //  $(window.parent.parent.document).find("#main_index").height(800);
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
    getMsgInfo()
});
/**
 * 获取用户信息
 * @returns {undefined}
 */
function getLoginedInfo() {
    $.post("/?r=mobile/index/json",{},
    function(res){
        //$("#zzkf").attr("href",res.zzkf);
        //$("#zzkf2").attr("href",res.zzkf);
        $("#pcClient").attr("href",res.pcClient);
        $("#web_name").html(res.web_name);
		$("title").html(res.web_name);
        if(res.name !== ''){
            $("#weidenglu").hide();
            $("#user").show();
            $("#h_menber").html(res.name);
            $("#f_member").html(res.name);
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
function loginState(){
    $.post("/?r=passport/user-api/login",{});
}
$(document).ready(function () {
    //获取登录状态
    setInterval("getLoginedInfo()",30000);
});
$(function () {
    getLoginedInfo();
    setInterval("loginState()",30000);
});

/**
 * 字段校验及登录
 * @returns {Boolean}
 */
function login() {
    var name = $("#name").val();
    var pwd = $("#pwd").val();
    var talk_user = $("#talk_user").val();
    // var yzm = $("#yzm").val();
    if (name === '' || name === '用户名') {
        layer.msg("用户名不能为空",{icon:5,time:1000});
        return false;
    } else if (pwd === '' || pwd === '密码') {
		layer.msg("密码不能为空",{icon:5,time:1000});
        return false;
    }
    // else if (yzm === '') {
	// 	layer.msg("验证码不能为空",{icon:5,time:1000});
    //     return false;
    // }

    $.post("/?r=mobile/user/do-login", {
        cmd: 'login',
        name: name,
        pwd:  pwd,
        talk_user:talk_user,
      //  verifyCode: yzm,
		gourl:$('#url').val()
    }, function (rst) {
        if (rst.code == 0) {
			var $gourl="/?r=mobile/disp/index";
			if(rst.url!=''){
				$gourl=rst.url;
			}
			layer.msg('登陆成功！',{icon:6,time:1000},function(){
				window.location.href = $gourl;
			});
        } else {
            layer.msg(rst.msg,{icon:0,time:1000});
           // $("#yzm").val('').focus();
            $("#rmNum").click();
        }
    }, "json");
}
/**
 * 获取公告信息
 * @returns {}
 */
function getMsgInfo() {
    $.post("/?r=passport/user-api/json", {},
        function (rst) {
            $("#msg").html(rst);
        },
        "json");
}
function getMsg() {
    $.post("/?r=passport/user-api/json", {},
        function (rst) {
            alert(rst);
        },
        "json");
}

/**
 * 获取代理
 */
function AddAgentsInfo($intr) {
    $.post("/?r=passport/user-api/add-agents", {
            intr: $intr,
        },
        function (rst) {
            //alert(rst);
            //console.log(rst);
        },
        "html");
}

/**
 * 登入確認
 */

function loginCheck() {
    var pass = false;
    $.ajax({
        async:false,
        url:'/?r=passport/user-api/login-check',
        dataType:'json',
        success:function (data) {
            if(data.status) {
                pass = true;
            } else {
                alert('请先登录！');
                location.href = '/?r=mobile/disp/login';
            }
        }
    });
    return pass;
}