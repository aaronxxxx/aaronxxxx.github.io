<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>登录</title>
        <link href="/public/common/css/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" language="javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" language="javascript" src="/public/common/js/layer/layer.js"></script>
    </head>
    <body class="loginbg">
    <div class="login-form">
        <h2>登录</h2>
        <form action="/?r=passport/login/login-handler" id="form1">
            <div class="form-area">
                <div class="group">
                    <input type="text" class="form-control" placeholder="账户" name="manage_name" maxlength="16">
                    <i class="fa fa-user fa-fw"></i>
                </div>
                <div class="group">
                    <input type="password" class="form-control" placeholder="密码" name="manage_pass" maxlength="20">
                    <i class="fa fa-key fa-fw"></i>
                </div>
                <div class="group">
                    <input type="text" class="form-control code" placeholder="验证码" onkeyup="value=value.replace(/[^\d]/g,\'\') " name="yzm" maxlength="4">
                    <i class="fa fa-pencil fa-fw"></i>  <img src="/?r=passport/login/captcha" id="vPic" class="codeimg">
                </div>
                <div class="group">
                <?php 
                    if($isqrcode == '1'){
                    require_once('GoogleAuthenticator.php');
                    $ga = new PHPGangsta_GoogleAuthenticator();
                    $qrCodeUrl = $ga->getQRCodeGoogleUrl('server', $secret);
                    echo "<img src=".$qrCodeUrl.">";
                    }
                    echo '<input type="text" class="form-control" maxlength="6" onkeyup="value=value.replace(/[^\d]/g,\'\') " placeholder="安全码" name="code">
                    <i class="fa fa-hand-paper-o fa-fw"></i>';
                ?>
                </div>
                <?php
                    if(Yii::$app->params['securityCodeEnable']) {
                ?>
                        <div class="group">
                            <input type="text" class="form-control" placeholder="安全码" name="code">
                            <i class="fa fa-hand-paper-o fa-fw"></i>
                        </div>
                <?php
                    }
                ?>
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
          
            verify.setAttribute('src','/?r=passport/login/captcha&'+Math.random());
        });
        $(document).keydown(function(event){
            if(event.keyCode==13){
                $("#login").click();
            }
        });
            $("#login").click(function (e) {
            e.preventDefault();
            var name = $("input[name=manage_name]").val();
            var pass = $("input[name=manage_pass]").val();
            var yzm = $("input[name=yzm]").val();
            if($.trim(name)==''){
                alert('请输入账号');
                return false;
            }
            if($.trim(pass)==''){
                alert('请输入密码');
                return false;
            }
            if($.trim(yzm)==''){
                alert('请输入验证码');
                return false;
            }
                $('.btn-default').attr("disabled",true);
                $.ajax({
                type: "POST",
                url:$('#form1').attr('action'),
                data:$('#form1').serialize(),
                dataType:'json',
                error:function (e) {
                    console.log(e);
                    alert('出错了，请稍后再试');
                },
                success:function (data) {
                    if(data.status){
                        location.href = '/';
                    }else{
                        layer.alert(data.msg, function (index) {
                            layer.closeAll();
                        });
                        $('.btn-default').attr("disabled",false);
                    }

                }
            })
        })
    })
</script>