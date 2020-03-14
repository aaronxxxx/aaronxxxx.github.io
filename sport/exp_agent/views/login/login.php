<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>登录</title>
        <link href="/public/common/css/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" language="javascript" src="/public/common/js/jquery-1.7.2.min.js"></script>
    </head>
    <body>
    <div class="login-form">
        <h2>登录</h2>
        <form action="/?r=login/login-handler" id="form1">
            <div class="form-area">
                <div class="group">
                    <input type="text" class="form-control" placeholder="账户" name="manage_name">
                    <i class="fa fa-user fa-fw"></i>
                </div>
                <div class="group">
                    <input type="password" class="form-control" placeholder="密码" name="manage_pass">
                    <i class="fa fa-key fa-fw"></i>
                </div>
                <div class="group">
                    <input type="text" class="form-control code" placeholder="验证码" name="yzm">
                    <i class="fa fa-pencil fa-fw"></i>  <img src="/?r=login/captcha" id="vPic" class="codeimg">
                </div>
                <button  type="button" class="btn btn-default btn-block" id="login">登录</button>
            </div>
        </form>
    </div>
    </body>
</html>
<script>
    $(function () {
        $("#vPic").click(function(){
            var verify=document.getElementById('vPic');
            verify.setAttribute('src','/?r=login/captcha&'+Math.random());
        });
        $("#login").click(function (e) {
            e.preventDefault();
            var name = $("input[name=manage_name]").val();
            var pass = $("input[name=manage_pass]").val();
            if(name=='' || name=='undefined'){
                alert('请输入账号');
                return false;
            }
            if(pass=='' || pass=='undefined'){
                alert('请输入密码');
                return false;
            }
            $.ajax({
                type: "POST",
                url:$('#form1').attr('action'),
                data:$('#form1').serialize(),
                dataType:'json',
                error:function () {
                    alert('出错了，请稍后再试');
                },
                success:function (data) {
                    alert(data.msg);
                    if(data.status==1){
                        location.href = '/?r=index/index';
                    }
                }
            })
        })
    })
</script>