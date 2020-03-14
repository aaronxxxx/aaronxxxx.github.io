<?php
include_once("website.php");
?>
<!DOCTYPE html>
<html class="first zh-cn "><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?=$web_site['web_name']?>---线路通畅检查中心</title>
        <link href="css/dh.css" rel="stylesheet">
    </head>
    <body oncontextmenu="return false">
        <div id="mainBody">
            <div id="page-header">
                <div class="header-bg clearfix">
                    <div class="header clearfix">
                        <div class="header-logo">                                                                          
                            <div id="ele-logo-wrap"></div>
                        </div>
                        <div class="wangtou"></div>
                        <div class="online"></div>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="address">
                    <div class="innercenter">
                        <div class="list fw">
<script language="javascript">
    tim = 1
    setInterval("tim++", 100)
    var autourl = new Array()
    autourl[1] = '<?= $web_site['check_url1'] ?>';
    autourl[2] = '<?= $web_site['check_url2'] ?>';
    autourl[3] = '<?= $web_site['check_url3'] ?>';
    autourl[4] = '<?= $web_site['check_url4'] ?>';
    autourl[5] = '<?= $web_site['check_url5'] ?>';
    autourl[6] = '<?= $web_site['check_url6'] ?>';
    autourl[7] = '<?= $web_site['check_url7'] ?>';
    autourl[8] = '<?= $web_site['check_url8'] ?>';
    function butt() {
        document.write("<form name=autof>")
        document.write("<a onclick='' class='l listtitle'></a><a onclick='window.parent.location.reload()' class='r mr5 refresh'></a><div class='cl'></div>")
        for (var i = 1; i < autourl.length; i++) {
            document.write("<ul><li>")
            document.write("<input type=text name='url" + i + "' class='urll' value='http://" + autourl[i] + "'>")
            document.write("<input type=text name='txt" + i + "' class='urlll' value='测速'>")
            document.write("<input type=button onclick=window.open(this.form.url" + i + ".value) class='urllll'>")
            document.write("</li><div class='cl'></div></ul>");
        }
        document.write("</form>");
    }
    butt()
    function auto(url, b) {
        document.forms[0]["url" + b].value = url
        if (tim > 200)
        {
            document.forms[0]["txt" + b].value = "超时"
        } else
        {
            document.forms[0]["txt" + b].value = tim / 10 + "秒"
        }
    }
    function run() {
        for (var i = 1; i < autourl.length; i++) {
            document.write("<img src=http://" + autourl[i] + " width=1 height=1 onerror=auto('http://" + autourl[i] + "'," + i + ")>")
        }
    }
    run()
</script>
                        </div>
                        <div class="main_right">
                            <div class="qq_online">
                                <a href="tencent://message/?uin=23230789&Site=web&Menu=yes" target="_blank"><img border="0" src="images/qq_online.png"></a>
                            </div>
                            <div class="kf_online">
                                <a href="http://messenger3.providesupport.com/messenger/1rhq9cawuhk6e0ggxizj0js3nx.html"><img border="0" src="images/kf_online.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="page-footer"></div>
            <div id="sd2yZE" style="display:none">
                <script type="text/javascript" src="safe-standard.js"></script>
            </div>
        </div>
    </body>
</html>