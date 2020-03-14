<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>站内信详情</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=640,user-scalable=no">
    <link href="/public/aomen/css/comn.css" rel="stylesheet" />
    <link href="/public/aomen/css/member.css" rel="stylesheet" />
    <script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
            $(function () {
                getLoginedInfo();
            });
            /**
            * 获取用户信息
            * @returns {undefined}
            */
           function getLoginedInfo() {
               $.post("/?r=mobile/index/json",{},
               function(res){
                   $("#pcClient").attr("href",res.pcClient);
                   $("#web_name").html(res.web_name);
               },"json");
           }
    </script>
</head>
<body>

    <div class="dl_app" id="dlapp_div">
        <div class="dl_app_close" id="app_div_close"></div>
        <div class="dl_app_mid">
            <div class="dl_app_logo"></div>
            <div class="dl_app_txt">全站IOS客户端<br>
                支持手机存提款+所有游戏</div>
        </div>
        <div class="dl_app_btn" id="app_div_dl">
            <div class="dl_app_icon"></div>
            <div class="dl_app_dl">免费下载</div>
        </div>
    </div>

    <!-- 头部和导航 -->
    <div id="hheader">
        <div class="head">
            <a class="h_rt" href="javascript:;" onclick="history.go(-1);"></a><span id="mName">消息管理</span><a class="h_hp" href="/?r=mobile/disp/index"> </a>
        </div>
    </div>

    <!-- 主内容 -->
    <div id="main">
        <div class="all">
            <div class="d_btn_list">
                <div class="d_btn sl" msg_type="inbox">&nbsp;收件箱&nbsp;</div>
            </div>
            <div class="msg_am">
                <div class="show" id="msg_s_detail" style="display: block;">
                    <div class="brd_top"></div>
                    <div class="msg_title" data="subject"><?= $msg['msg_title']?></div>
                    <div class="msg_date2">
                        发送人：<span data="date"><?= $msg['msg_from']?></span>
                    </div>
                    <div class="msg_date2">
                        时间：<span data="date"><?= $msg['msg_time']?></span>
                    </div>
                    <div class="msg_cnt2" data="content"><?= $msg['msg_info']?></div>
                    <a href="/?r=mobile/news/del&mid=<?= $msg['msg_id'] ?>"><div class="msg_dlt" type_id="inbox"></div></a>
                    <input type="hidden" data="id" value="84326">
                    <a href="/?r=mobile/news/news" class="next" type_id="inbox">返回</a>
                    <form id="inboxForm">
                        <input type="hidden" name="pageindex" value="1"> <input type="hidden" name="pagesize" value="10">
                    </form>
                </div>
            </div>
        </div>
    </div>

