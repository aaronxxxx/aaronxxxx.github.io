<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-event.jpg") no-repeat center center;
        background-size: cover;
    }
    .pageBox{
        padding-top: 45px;
        background: #464646;
    }
</style>
<?php require('kf.php') ?>
<!-- #########################################################################################################################
                                            運                      彩
    ######################################################################################################################### -->
<div class="pageBox">
    <div class="pages">
        <section id="lobby" class="ng-scope">

            <?php include('themes/saiban/assets/yuntsai/includes/head.php') ?>

            <div id="sport" class="sidebar-outer">

                <section id="sidebar">
                    <?php include('themes/saiban/assets/yuntsai/includes/sidebar.php') ?>
                </section>

                <section id="sport_content">
                    <?php include('themes/saiban/assets/yuntsai/includes/content.php') ?>
                </section>
                <input type="hidden" name="qishu" id="qishu" value="<?= $qishu ?>">
            </div>

            <?php include('themes/saiban/assets/yuntsai/includes/footer-js.php') ?>

        </section>
    </div>
</div>