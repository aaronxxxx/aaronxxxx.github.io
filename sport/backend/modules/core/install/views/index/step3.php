<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>安装向导-数据库建立与设置</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/public/install/css/index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function initEnv() {
            if($('#server').length == 0) {
                alert('请检查数据库环境是否启用');
                return;
            }
            if($('#server').val().trim() == "" || $('#port').val().trim() == "" || $('#dbuser').val().trim() == "" || $('#dbpwd').val().trim() == "" || $('#username').val().trim() == "" || $('#password').val().trim() == "" || $('#repassword').val().trim() == "") {
                alert('表单信息填写不完整');
                return;
            }
            if($('#password').val().trim() != $('#repassword').val().trim()) {
                alert('密码不一致');
                return;
            }
            $('#nextBtn').prop('disabled', true);
            $.ajax({
                type:'POST',
                url:'/?r=install/index/init-env',
                data:$('#myform').serialize(),
                dataType:'json',
                success:function (data) {
                    $('#nextBtn').prop('disabled', false);
                    if(data.status) {
                        location.href = "/?r=install/index/step4";
                    } else {
                        alert(data.msg);
                    }
                },
                error:function () {
                    $('#nextBtn').prop('disabled', false);
                    alert('提交表单出错了');
                }
            });
        }
    </script>
</head>
<body>
    <div class="setup">
        <dl>
            <dt></dt>
            <dd id="ddleft">
                <div id="headerimg">
                    <img src="/public/install/images/install.png"/>
                    <strong>安装程序</strong>
                </div>
                <div class="left">安装进度：</div>
                <div class="progress" style="margin: 10px 10px 0 0;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%"></div>
                </div>
                <p><b>安装协议</b> » <b>环境检查</b> » <b>数据库建立与设置</b> » 安装结果</p>
            </dd>
            <dd id="ddright">
                <div id="title">数据库建立与设置</div>
                <div id="content">
                    <form id="myform">
                        <?php
                        if ($hasMysql) {
                            ?>
                            <div>
                                <label for="dbtype">数据库类型：</label>
                                <input type="radio" checked id="dbtype" name="dbtype" value="mysql" style="margin:0 0 20px 30px;"/> MySQL
                            </div>
                            <div>
                                <label for="server">数据库主机：</label>
                                <input type="text" name="server" id="server" style="width:350px;margin:0 0 20px 30px;" placeholder="127.0.0.1" />
                            </div>
                            <div>
                                <label for="port">数据库端口：</label>
                                <input type="text" name="port" id="port" style="width:350px;margin:0 0 20px 30px;" placeholder="3306" />
                            </div>
                            <div>
                                <label for="dbuser">数据库账号：</label>
                                <input type="text" name="dbuser" id="dbuser" style="width:350px;margin:0 0 20px 30px;" />
                            </div>
                            <div>
                                <label for="dbpwd">数据库密码：</label>
                                <input type="password" name="dbpwd" id="dbpwd" style="width:350px;margin:0 0 20px 30px;" />
                            </div>
                            <?php
                        } else {
                                echo '请检查数据库环境配置是否正确';
                            }
                        ?>
                        <div class="title" style="margin-bottom: 10px;">网站设置</div>
                        <div>
                            <label for="username">管理员名称：</label>
                            <input type="text" name="username" id="username" value="" style="width:200px;margin:0 0 20px 30px;" />
                            <small>英文,数字,汉字或._的组合</small>
                        </div>
                        <div>
                            <label for="password">管理员密码：</label>
                            <input type="password" name="password" id="password" value="" style="width:200px;margin:0 0 20px 30px;" />
                            <small>8位或更长的数字或字母组合</small>
                        </div>
                        <div>
                            <label for="repassword">确认密码：</label>
                            <input type="password" name="repassword" id="repassword" value="" style="width:200px;margin:0 0 10px 44px;" />
                        </div>
                    </form>
                </div>
                <div id="bottom">
                    <input type="button" name="next" id="nextBtn" value="下一步" onclick="initEnv();" />
                </div>
            </dd>
        </dl>
    </div>
</body>
</html>