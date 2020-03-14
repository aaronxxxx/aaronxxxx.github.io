<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-lottery.jpg") no-repeat center center;
        background-size: cover;
    }
</style>
<?php require('kf.php') ?>
<div id="content">
    <div class="wrapper">
        <iframe src="/public/lottery/lottery.html" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto" height="930" allowtransparency="true" style="width: 1000px; margin: 0 auto; display: block;"></iframe>
    </div>
</div>