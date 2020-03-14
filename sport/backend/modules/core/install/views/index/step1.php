<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>安装向导-安装协议</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/public/install/css/index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $( "input[type=checkbox]" ).change(function() {
                if ( $( this ).prop( "checked" ) ) {
                    $("#netx").prop("disabled",false);
                }
                else{
                    $("#netx").prop("disabled",true);
                }
            });
        })
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
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p><b>安装协议</b> » 环境检查 » 数据库建立与设置 » 安装结果</p>
            </dd>
            <dd id="ddright">
                <div id="title">管理后台系统安装协议</div>
                <div id="content">
                    <textarea readonly><?= Yii::$app->modules['install']->params['agreement'] ?></textarea>
                </div>
                <div id="bottom">
                    <label>
                        <input type="checkbox"/>
                        我已阅读并同意此协议
                    </label>
                    <input type="button" name="next" id="netx" value="下一步" disabled="disabled" onclick="javascript:location.href='/?r=install/index/step2'" />
                </div>
            </dd>
        </dl>
    </div>
</body>
</html>