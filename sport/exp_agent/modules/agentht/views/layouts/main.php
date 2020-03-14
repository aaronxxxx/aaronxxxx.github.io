<?php
use yii\helpers\Html;
$this->beginPage();
$vertime = "Y-m-d H:i:s";
$time_limit = strtotime($vertime) - time();
if ($time_limit < 259200 && $time_limit >= 172800) {
    $time_day = "三天內到期";
} elseif ($time_limit < 172800 && $time_limit >= 86400) {
    $time_day = "兩天內到期";
} elseif ($time_limit < 86400 && $time_limit >= 0) {
    $time_day = "一天內到期";
} else {
    $time_day = "已經到期";
}
?>
<!DOCTYPE html /public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>代理管理系統</title>
    <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="public/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="/public/common/css/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" language="javascript" src="/public/common/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/layer/layer.js"></script>
    <script type="text/javascript" language="javascript" src="/public/agent/js/set-date.js"></script>
    <script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.dialog.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.validate.min.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.validate.methods.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.validate.messages_zh.js"></script>
    <script type="text/javascript" language="javascript" src="public/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" language="javascript" src="public/datetimepicker/js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".dropdown-toggle").click(function () {
                $(this).next(".submenu").toggle();
                $(this).find(".drop-icon").toggleClass("drop-iconchk");
            })

        })
        function copyToClipboard() {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($('#agentURL').attr('in-data')).select();
            document.execCommand("copy");
            $temp.remove();
            $.dialog.notify("已複製至您的剪貼簿。");
        }
    </script>

</head>
<body>
<!--頭部start-->
<div class="hd">

    <a href="javascript:void(0)" class="navbar-brand">
        <span>代理管理系統</span>
    </a>
    <div class="nava">
        <?php if( Yii::$app->session['S_AGENT_LEVEL'] == 0 ) { ?>
            <!-- <a href="/?r=agentht/agent/cards-list">儲值卡管理</a> -->
            <a href="/?r=finance/agents/index">代理轉款功能</a>
            <a href="/?r=agent/index/list">代理詳細列表</a>
            <a href="/?r=agentht/agent/sum-report">總代理結算紀錄</a>
        <?php } else { ?>
            <!-- <a href="https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=http://www.iforcast.com/?r=mobile/disp/register&agentname=<?=Yii::$app->session['S_AGENT_NAME']?>" target="_blank" >会员注册QRCODE(手机)</a> -->
                <a href="https://chart.googleapis.com/chart?chs=450x450&cht=qr&chl=http://www.iforcast.com/?r=passport/site/reg&agentname=<?=Yii::$app->session['S_AGENT_NAME']?>" target="_blank" >会员注册QRCODE(PC)</a>
            <a href="/?r=finance/default/index">會員轉款功能</a>
            <a href="/?r=member/index">會員詳細列表</a>
            <?php } ?>
            <a href="/?r=agentht/agent/report">代理報表</a>
            <a href="/?r=agentht/agent/jiesuan">結算明細</a>
            <a href="/?r=agentht/agent/cqk">存取報表</a>
            <a href="/?r=agentht/agent/set-pass">修改密碼</a>
            <?php if( Yii::$app->session['S_AGENT_LEVEL'] != 0 ) { ?>
                <a href="/?r=agentht/order/event">未結算注單</a>
            <?php }?>
            <a href="/?r=agent/cash/index">請款申請</a>
            <a href="/?r=agentht/agent/out">退出登入</a>
    </div>
</div>
<!--頭部end-->
<!--body start-->
<div  class="">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
</div>
<!--body end-->

</body>
</html>