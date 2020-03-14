<?php

use yii\helpers\Html;
// header- logo + 註冊 登入 + footer
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
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/aos.css" rel="stylesheet" />
    <link href="/public/aomen/css/swiper.min.css" rel="stylesheet" />
    <link href="/public/aomen/css/astyle.css?1576663200" rel="stylesheet" />
    <script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/public/aomen/img/am66789_57.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/public/aomen/img/am66789_72.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/public/aomen/img/am66789_114.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/public/aomen/img/am66789_144.png">
    <link rel="apple-touch-startup-image" sizes="1024x748" href="/public/aomen/img/am66789_144.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" sizes="768x1004" href="/public/aomen/img/am66789_114.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" sizes="640x920" href="/public/aomen/img/am66789_72.png" media="screen and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)">
    <link rel="apple-touch-startup-image" sizes="320x460" href="/public/aomen/img/am66789_57.png" media="screen and (max-device-width: 320)">
</head>

<body>
    <div class="index">
        <header>
            <nav class="d-flex justify-content-between align-items-center">
                <div class="logo d-flex justify-content-start align-items-center">
                    <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/logo.png" alt="logo">
                </div>
                <ul class="d-flex align-items-center usernameinfo" id="weidenglu">
                    <li class="iconNav">
                        <a href="/?r=mobile/disp/register">
                            <img src="/public/aomen/images/index/header-reg.png" alt="">
                            <p>注册</p>
                        </a>
                    </li>
                    <li class="iconNav">
                        <a href="/?r=mobile/disp/login">
                            <img src="/public/aomen/images/index/header-log.png" alt="">
                            <p>登入</p>
                        </a>
                    </li>
                </ul>
                <ul class="d-flex flex-flow-column justify-content-center align-items-stretch usernameinfo" id="user" style="display: none">
                    <li class="d-flex justify-content-start align-items-center logined">
                        <div class="userNavicon"><img src="/public/aomen/images/index/header-man.png" alt=""></div>
                        <p id="h_menber"></p>
                    </li>
                    <li class="d-flex justify-content-start align-items-center logined">
                        <div class="userNavicon"><img src="/public/aomen/images/index/header-money.png" alt=""></div>
                        <p id="centerAmount"></p>
                    </li>
                </ul>
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
                    <div class="icon"><img src="/public/aomen/images/index/footer-betting.svg" alt=""></div>
                    <p>前往投注</p>
                </a>
            </section>
        </footer>
    </div>
</body>
<script src="<?= Yii::getAlias('@themeRoot') ?>/assets/js/aos.js"></script>
<script src="/public/aomen/js/swiper.jquery.min.js"></script>
<script src="/public/aomen/js/login.js"></script>
<script src="<?= Yii::getAlias('@themeRoot') ?>/assets/js/http.js"></script>
<script src="/public/layer/layer.js"></script>
<script type="text/javascript">
    $(function() {
        // 代理判定
        <?php if (!empty($intr)) {
            ?>
            AddAgentsInfo("<?php echo $intr ?>");
        <?php
        } ?>
        // var mySwiper = new Swiper('.banner_img', {
        //     autoplay: 5000,
        //     loop: true,
        //     pagination: '.swiper-pagination',
        //     paginationClickable: true
        // });
        service();
        AOS.init();
    });

    function service() {
        $.ajax({
            type: "GET",
            url: "/?r=passport/user-api/onlinekf",
            success: function(res) {
                $('#customerService').attr('href', res);
            }
        })
    }
</script>

</html>
<?php $this->endPage() ?>