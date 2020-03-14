<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-game.jpg") no-repeat center center;
        background-size: cover;
    }

    #content {
        padding-top: 30px;
    }
</style>
<?php require('kf.php') ?>
<div id="content">
    <div class="wrapper">
        <iframe src="/public/buyugame/game.html" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="100%" height="780" style="width: 1000px; display: block; margin: 0 auto;" allowtransparency="true"></iframe>
    </div>
</div>