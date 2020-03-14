<?php

use yii\helpers\Html;
// header- 上一頁 +會員名稱+會員金額   footer
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=640,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="<?= Yii::getAlias('@themeRoot') ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="<?= Yii::getAlias('@themeRoot') ?>/assets/images/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="<?= Html::encode($this->title) ?>">
    <!-- <link rel="shortcut icon" sizes="16x16" href="/public/aomen/img/icon-16x16.png">
        <link rel="shortcut icon" sizes="196x196" href="/public/aomen/img/icon-196x196.png">
        <link rel="apple-touch-icon-precomposed" href="/public/aomen/img/icon-152x152.png"> -->
    <link href="/public/aomen/css/normalize.css" rel="stylesheet" />
    <link href="/public/aomen/css/game.css" rel="stylesheet" />
    <script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
    <script src="/public/aomen/js/login.js"></script>
    <script src="<?= Yii::getAlias('@themeRoot') ?>/assets/js/http.js"></script>
    <script src="/public/layer/layer_mobile.js"></script>
</head>

<body>
    <script>
        $(document).ready(function() {
            var header = $('header').height(),
                footer = $('footer').height();
            $('main').css({
                'padding-top': header,
                'padding-bottom': footer
            });
        });
    </script>
    <header>
        <nav class="d-flex justify-content-between align-items-center">
            <div class="navitem navPrevious">
                <a onclick="history.back()"><img src="/public/aomen/images/log/header-back.png" alt="上一页" srcset=""></a>
            </div>
            <div class="navitem">
                <ul class="usernameinfo" id="user">
                    <li class="d-flex">
                        <div class="userNavicon"><img src="/public/aomen/images/index/header-man.png" alt=""></div>&nbsp;
                        <p id="h_menber"></p>
                    </li>
                    <li class="d-flex">
                        <div class="userNavicon"><img src="/public/aomen/images/index/header-money.png" alt=""></div>&nbsp;
                        <p id="centerAmount"></p>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    <footer class="d-flex align-items-center">
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
            <a href="/?r=mobile/quota/index">
                <div class="icon"><img src="/public/aomen/images/index/footer-trans.png" alt=""></div>
                <p>额度转换</p>
            </a>
        </section>
        <section class="footerItem">
            <a href="/?r=mobile/user/user-hall">
                <div class="icon"><img src="/public/aomen/images/index/footer-member.png" alt=""></div>
                <p>会员中心</p>
            </a>
        </section>
        <section class="footerItem">
            <a href="/?r=mobile/disp/game-center">
                <div class="icon"> <img src="/public/aomen/images/index/footer-game.png" alt=""></div>
                <p>游戏中心</p>
            </a>
        </section>
    </footer>
</body>

</html>
<?php $this->endPage() ?>