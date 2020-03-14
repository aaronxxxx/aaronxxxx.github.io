<?php

use yii\helpers\Html;
// header- 上一頁 +title + 首頁   
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
    <link rel="stylesheet" href="/public/aomen/css/login.css?1576663200">
    <script src="/public/aomen/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript">
        // function next_checkNum_img() {
        //     document.getElementById("rmNum").src = "/?r=mobile/index/captcha&"+Math.random();
        //     return false;
        // }
        // $("#loginbox #uname,#loginbox #pwd").keydown(function (e) {
        //     if ($.inArray(this.id, ["uname", "pwd"]) > -1 && e.keyCode == 13) login();
        // });
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
    <footer></footer>
</body>
<script src="/public/layer/layer.js"></script>
<script src="/public/aomen/js/login.js"></script>
<script src="<?= Yii::getAlias('@themeRoot') ?>/assets/js/http.js"></script>

</html>
<?php $this->endPage() ?>