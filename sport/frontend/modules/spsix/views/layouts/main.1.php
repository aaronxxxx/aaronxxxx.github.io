<?php
use yii\helpers\Html;
use app\modules\spsix\helpers\Zodiac;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=640,user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>1111</title>
    <link href="/public/aomenPC/css/sp_pitaya.css" rel="stylesheet">
    <link href="/public/aomenPC/css/result.css" rel="stylesheet">
    <link href="/public/aomenPC/css/AlertBox.css" rel="stylesheet">
    <link href="/public/aomenPC/css/ConfirmBox.css" rel="stylesheet">
    <link href="/public/aomenPC/css/contextmenu.css" rel="stylesheet">
    <link href="/public/aomenPC/css/sp_view.css" rel="stylesheet">
    <link href="/public/aomenPC/css/jquery.GoldUI.css" rel="stylesheet">
    <link href="/public/aomenPC/css/flipclock.css" rel="stylesheet">
    <link href="/public/aomenPC/css/sp_tpl.css" rel="stylesheet">
    <link href="/public/aomenPC/css/zindex.css" rel="stylesheet">
    <link href="/public/aomenPC/css/jquery.slideMenu.css" rel="stylesheet">
    <script>
        _resultX = <?php $zodiac = new Zodiac();echo json_encode($zodiac->getLetterArr());?>
    </script>
</head>
<body style="overflow-x: hidden">
<script src="/public/jquery/jquery-1.8.3.min.js"></script>
<script src="/public/aomenPC/js/AlertBox.js"></script>
<script src="/public/aomenPC/js/C2R.js"></script>
<script src="/public/aomenPC/js/ConfirmBox.js"></script>
<script src="/public/aomenPC/js/Lang.js"></script>
<script src="/public/aomenPC/js/Lunar_sp.js"></script>
<script src="/public/aomenPC/js/group_menu.js"></script>
<script src="/public/aomenPC/js/jquery.GoldUI.js"></script>
<script src="/public/aomenPC/js/jquery.contextmenu.js"></script>
<script src="/public/aomenPC/js/ltOrder_sp.js"></script>
<script src="/public/aomenPC/js/lt_show_sp.js"></script>
<script src="/public/aomenPC/js/lt_ch_show.js"></script>
<script src="/public/aomenPC/js/lt_lx_show.js"></script>
<script src="/public/aomenPC/js/lt_nap_show.js"></script>
<script src="/public/aomenPC/js/lt_ni_show.js"></script>
<script src="/public/aomenPC/js/lt_nx_show.js"></script>
<script src="/public/aomenPC/js/marquee.js"></script>
<script src="/public/aomenPC/js/memberCenter.js"></script>
<script src="/public/aomenPC/js/mobileStyle.js"></script>
<script src="/public/aomenPC/js/overMenu.js"></script>
<script src="/public/aomenPC/js/package.js"></script>
<script src="/public/aomenPC/js/sound.js"></script>
<script src="/public/aomenPC/js/superfish.js"></script>
<script src="/public/aomenPC/js/timeclock.js"></script>
<script src="/public/aomenPC/js/view.js"></script>
<script src="/public/aomenPC/js/zindexSort.js"></script>
<script src="/public/aomenPC/js/jquery.slideMenu.js"></script>
<script src="/public/aomenPC/js/flipclock.js"></script>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
