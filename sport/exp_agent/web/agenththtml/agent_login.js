$(function () {
//    alert('aa');
    //验证码刷新（兼容性问题，需要添加随机值 Math.random()）
    $("#yzm2").click(function () {
//        this.src = this.src.toString();
        var verify = document.getElementById('yzm2');
        verify.setAttribute('src', '/?r=agentht/index/captcha&' + Math.random());
    });
    //登入
    $('#login_button').click(function () {
        var agent_name = $("#agent_name").val();
        var agent_pass = $("#agent_password").val();
        var yzm = $('#yzm').val();
//        alert(yzm);
        if(agent_name === ''){
            alert('账户不能为空！！');
            return false;
        }
        if(agent_pass === ''){
            alert('密码不能为空！！');
            return false;
        }
        if(yzm === ''){
            alert('验证码不能为空！！');
            return false;
        }
        if(yzm.length != 4){
            alert('验证码位数输入有误！！');
            return false;
        }
        $.post('/?r=agentht/agent/login',{
            agents_name:agent_name,
            agents_pass:agent_pass,
            yzm:yzm
        },function(res){
           console.log(res);
            if(res.code == 0){
                alert('登入成功！！');
                window.location.href="/?r=agentht/index/index"; 
            }else{
                alert(res.msg);
                $("#yzm").val('').focus();
                $("#yzm2").click();
            }
        },'json')
        
        
    });


});
