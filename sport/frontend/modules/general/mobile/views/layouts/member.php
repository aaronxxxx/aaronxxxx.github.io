<?php

use yii\helpers\Html;
// header- 上一頁 +title + 首頁    + footer
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-title" content="<?= Html::encode($this->title) ?>">
    <link rel="shortcut icon" href="<?= Yii::getAlias('@themeRoot') ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::getAlias('@themeRoot') ?>/assets/images/favicon.ico">
    <link href="/public/aomen/css/normalize.css" rel="stylesheet" />
    <link href="/public/aomen/css/astyle.css?1576663200" rel="stylesheet" />
    <link href="/public/aomen/css/amember.css?1576663200" rel="stylesheet" />
    <script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // header 标题
            $("#navTitle").text($('#inputNavTitle').val());
        });
    </script>
</head>

<body>
    <header>
        <nav class="d-flex justify-content-between align-items-center">
            <div class="navitem navPrevious">
                <a onclick="history.back()"><img src="/public/aomen/images/log/header-back.png" alt="上一页" srcset=""></a>
            </div>
            <div class="navitem">
                <span id="navTitle"></span>
            </div>
            <div class="navitem navHome">
                <a href="/?r=mobile/disp/index"><img src="/public/aomen/images/log/header-home.png" alt="" srcset=""></a>
            </div>
        </nav>
    </header>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    <footer class="d-flex justify-content-between align-items-center">
        <section class="footerItem">
            <a href="/?r=mobile/disp/index">
                <div class="icon"><img src="/public/aomen/images/index/footer-home.png" alt=""></div>
                <p>首页</p>
            </a>
        </section>
        <section class="footerItem">
            <a href="/?r=mobile/financial/index">
                <div class="icon"><img src="/public/aomen/images/index/footer-money.png" alt=""></div>
                <p>财务中心</p>
            </a>
        </section>
        <section class="footerItem">
            <a href="/?r=mobile/user/user-hall">
                <div class="icon"><img src="/public/aomen/images/index/footer-member.png" alt=""></div>
                <p>会员中心</p>
            </a>
        </section>
        <section class="footerItem">
            <a href="/?r=mobile/disp/ftbk">
                <div class="icon"> <img src="/public/aomen/images/index/footer-betting.svg" alt=""></div>
                <p>前往投注</p>
            </a>
        </section>
    </footer>
</body>
<script src="/public/aomen/js/login.js"></script>
<script src="/public/layer/layer_mobile.js"></script>
<script src="<?= Yii::getAlias('@themeRoot') ?>/assets/js/http.js"></script>
<script src="/public/aomen/js/index.js"></script>
<link href="/public/aomen/pickadate/classic.css" rel="stylesheet" />
<link href="/public/aomen/pickadate/classic.date.css" rel="stylesheet" />
<script src="/public/aomen/pickadate/picker.min.js"></script>
<script src="/public/aomen/pickadate/picker.date.js"></script>

</html>
<?php $this->endPage() ?>