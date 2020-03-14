<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-sport.jpg") no-repeat center center;
        background-size: cover;
    }

    #content {
        padding-top: 0;
    }
</style>
<?php require('kf.php') ?>
<div id="content">
    <div class="wrapper">
        <iframe src="/public/sport/html/index.html" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" width="100%" height="870" style="width: 1000px; display: block; margin: 0 auto;" allowtransparency="true"></iframe>
    </div>
</div>