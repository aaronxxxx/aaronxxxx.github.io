<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\modules\live\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/public/84686/css/common_2.css" rel="stylesheet" type="text/css">
        <script src="/public/84686/js/live.js"></script>
        <link href="/public/84686/css/yxlm.css" rel="stylesheet" type="text/css">
        <script src="/public/84686/js/jquery-1.8.3.min.js"></script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="content-page-main-right clearfix  mt10">
        <div class="ab-top"></div>
        <div class="ab-mid">
            <h2>
                <img src="/public/84686/images/live-title.png"></h2>
            <div class="content-page-main-listBox content-page-live clearfix">
                <ul class="page-live-con">

                    <li>
                        <a href="javascript:void(0);" onclick="return submitlive(1, <?= $uid; ?>);" class="aLoginCheck live-pho">
                            <img src="/public/84686/images/live-ct.png" alt="">
                        </a>
                        <a href="javascript:void(0);" onclick="return submitlive(1, <?= $uid; ?>);" class="live-gogame-btn live-btn-attr aLoginCheck">立即游戏 &gt;</a>
                        <a href="javascript://" onclick="window.open('myliverule.html','Rule','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,top=2,width=1024,height=640');" class="live-rule-btn live-btn-attr">游戏规则 &gt;</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="return submitlive(2, <?= $uid; ?>);" class="aLoginCheck live-pho">
                            <img src="/public/84686/images/live-ag.png" alt=""></a>
                        <a href="javascript:void(0);" onclick="return submitlive(2, <?= $uid; ?>);" class="live-gogame-btn live-btn-attr aLoginCheck">立即游戏 &gt;</a>
                        <a href="javascript://" onclick="window.open('myliverule.html','Rule','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,top=2,width=1024,height=640');" class="live-rule-btn live-btn-attr">游戏规则 &gt;</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="return submitlive(3, <?= $uid; ?>);" class="aLoginCheck live-pho">
                            <img src="/public/84686/images/live-bbin.png" alt=""></a>
                        <a href="javascript:void(0);" onclick="return submitlive(3, <?= $uid; ?>);" class="live-gogame-btn live-btn-attr aLoginCheck">立即游戏 &gt;</a>
                        <a href="javascript://" onclick="window.open('myliverule.html','Rule','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,top=2,width=1024,height=640');" class="live-rule-btn live-btn-attr">游戏规则 &gt;</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="return submitlive(4, <?= $uid; ?>);" class="aLoginCheck live-pho">
                            <img src="/public/84686/images/live-xtd.png" alt=""></a>
                        <a href="javascript:void(0);" onclick="return submitlive(4, <?= $uid; ?>);" class="live-gogame-btn live-btn-attr aLoginCheck">立即游戏 &gt;</a>
                        <a href="javascript://" onclick="window.open('myliverule.html','Rule','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,top=2,width=1024,height=640');" class="live-rule-btn live-btn-attr">游戏规则 &gt;</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="return submitlive(5,<?= $uid; ?>);" class="aLoginCheck live-pho">
                            <img src="/public/84686/images/live-og.png" alt=""></a>
                        <a href="javascript:void(0);" onclick="return submitlive(5,<?= $uid; ?>);" class="live-gogame-btn live-btn-attr aLoginCheck">立即游戏 &gt;</a>
                        <a href="javascript://" onclick="window.open('myliverule.html','Rule','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,top=2,width=1024,height=640');" class="live-rule-btn live-btn-attr">游戏规则 &gt;</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="return submitlive(6, <?= $uid; ?>);" class="aLoginCheck live-pho">
                            <img src="/public/84686/images/live-mg.png" alt=""></a>
                        <a href="javascript:void(0);" onclick="return submitlive(6, <?= $uid; ?>);" class="live-gogame-btn live-btn-attr aLoginCheck">立即游戏 &gt;</a>
                        <a href="javascript://" onclick="window.open('myliverule.html','Rule','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,top=2,width=1024,height=640');" class="live-rule-btn live-btn-attr">游戏规则 &gt;</a>
                    </li>
                    <span class="justify_fix"></span>
                </ul>
            </div>
        </div>
        <div class="ab-bot"></div>
    </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>