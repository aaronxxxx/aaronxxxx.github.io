<?php

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/public/member/css/standard.css">
    <link rel="stylesheet" href="/public/member/css/jquery-ui-1.8.21.custom.css">
    <link rel="stylesheet" href="/public/member/css/web.css?332255?332244">
    <script src="/public/js/jquery-1.7.2.min.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div id="MACenter">
        <div id="loading">
            <div class="loading_img"></div>
            <span>載入中</span>
        </div>
        <div id="MAContent">
            <div id="MAHeader">
                <div class="welcom_text">會員中心</div>
                <div id="est_bg">
                    時間：
                    <span id="EST_reciprocal"></span>
                </div>
            </div>
            <div id="MAMain">
                <?= $content ?>
            </div>
            <div class="clear"></div>
        </div>
        <label class="mbMenu" for="mbMenu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </label>
        <input id="mbMenu" type="checkbox" hidden>
        <div id="MALeft">
            <div>
                <div class="sidebar">
                    <div id="sidebar-mem"></div>
                    <a href="/?r=member/index/index" id="myAccount">我的帳戶</a>
                    <a href="/?r=member/remittance/index" id="mytransaction">銀行交易</a>
                    <a href="/?r=member/remittance/index2" id="myothrt_pay">其他支付</a>
                    <a href="/?r=member/transaction-log/bank" id="myrecord">交易紀錄</a>
                    <a href="/?r=member/deposit/index" id="online_in">線上存款</a>
                </div>
                <div class="sidebar">
                    <div id="sidebar-game"></div>
                    <a href="/?r=game/login/index&type=AI" target="_blank">二元期權</a>
                    <a href="/?r=lottery/lzorpk/index" target="_blank">官方彩票</a>
                    <a href="/?r=spsix/index/index&rtype=SPbside" target="_blank">急速六合彩</a>
                </div>
                <div class="sidebar">
                    <div id="sidebar-home"></div>
                    <a href="/?r=site/index">回首頁</a>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
<script src="/public/member/js/jquery.blockUI.min.js"></script>
<script src="/public/member/js/jquery.cookie.js"></script>
<script src="/public/member/js/web.js"></script>
<script>
    $(document).ready(function() {
        var url_href = $('#MACenter').data('current');
        var anchor = $("#MALeft a");
        anchor.each(function() {
            if ($(this).attr('id') == url_href) {
                $(this).css({
                    "background": "linear-gradient(to left, gold, goldenrod, gold)",
                    "text-shadow": "0 0 2px rgba(0, 0, 0, 0.8)"
                });
                return false;
            }
        })
        $(window).load(function() {
            $('#loading').delay(800).fadeOut(300);
        });
        var windowHeight = $(window).innerHeight();
        $('#MACenter').height(windowHeight);
    })
</script>

</html>
<?php $this->endPage() ?>