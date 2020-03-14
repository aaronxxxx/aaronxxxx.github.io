<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>安装向导-安装结果</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/public/install/css/index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
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
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
                <p><b>安装协议</b> » <b>环境检查</b> » <b>数据库建立与设置</b> » <b>安装结果</b></p>
            </dd>
            <dd id="ddright">
                <div id="title">安装结果</div>
                <div id="content">
                    您已经安装好exp_backend了，不能重复安装。
                </div>
                <div id="bottom">
                    <input type="button" name="next" id="netx" value="退出" onclick="javascript:location.href='/'" >
                </div>
            </dd>
        </dl>
    </div>
</body>
</html>