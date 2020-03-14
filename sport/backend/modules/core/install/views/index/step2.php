<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>安装向导-环境检查</title>
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
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 33%"></div>
                </div>
                <p><b>安装协议</b> » <b>环境检查</b> » 数据库建立与设置 » 安装结果</p>
            </dd>
            <dd id="ddright">
                <div id="title">环境检查</div>
                <div id="content">
                    <table border="0" style="width:100%;" class="table_striped table_hover">
                        <tr>
                            <th colspan="3" scope="row">服务器环境检查</th>
                        </tr>
                        <tr>
                            <td scope="row">HTTP 服务器</td>
                            <td style="text-align:center"><?=$server ?></td>
                            <td style="text-align:center"><span class="bingo"></span></td>
                        </tr>
                        <tr>
                            <td scope="row">PHP 版本支持</td>
                            <td style="text-align:center"><?=$phpver[0] ?></td>
                            <td style="text-align:center">
                                <?php
                                    if($phpver[1]) {
                                        echo '<span class="bingo"></span>';
                                    } else {
                                        echo '<span class="error"></span>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">exp_backend路径</td>
                            <td style="text-align:center"><?=$webpath ?></td>
                            <td style="text-align:center"><span class="bingo"></span></td>
                        </tr>
                        <tr>
                            <th colspan="3" scope="col">组件支持检查</th>
                        </tr>
                        <tr>
                            <td scope="row" style="width:200px">gd2</td>
                            <td style="text-align:center"><?=$gd2[0];?></td>
                            <td style="text-align:center">
                                <?php
                                if($gd2[1]) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">mysqli</td>
                            <td style="text-align:center"><?=$mysqli[0];?></td>
                            <td style="text-align:center">
                                <?php
                                if($mysqli[1]) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">pdo_mysql</td>
                            <td style="text-align:center"><?=$pdo_mysql[0];?></td>
                            <td style="text-align:center">
                                <?php
                                if($pdo_mysql[1]) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3" scope="row">权限检查</th>
                        </tr>
                        <tr>
                            <td scope="row">exp_backend</td>
                            <td style="text-align:center"><?=$exp_backend[0];?></td>
                            <td style="text-align:center">
                                <?php
                                if($exp_backend[1]) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3" scope="row">函数检查</th>
                        </tr>
                        <tr>
                            <td scope="row">chmod</td>
                            <td style="text-align:center">文件权限设置</td>
                            <td style="text-align:center">
                                <?php
                                if($chmod) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">curl</td>
                            <td style="text-align:center">用于连接应用中心</td>
                            <td style="text-align:center">
                                <?php
                                if($curl) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">allow_url_fopen</td>
                            <td style="text-align:center">用于连接应用中心</td>
                            <td style="text-align:center">
                                <?php
                                if($allow_url_fopen) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">gethostbyname</td>
                            <td style="text-align:center">用于解析DNS</td>
                            <td style="text-align:center">
                                <?php
                                if($gethostbyname) {
                                    echo '<span class="bingo"></span>';
                                } else {
                                    echo '<span class="error"></span>';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="bottom">
                    <input type="button" name="next" id="netx" value="下一步" onclick="javascript:location.href='/?r=install/index/step3'" />
                </div>
            </dd>
        </dl>
    </div>
</body>
</html>