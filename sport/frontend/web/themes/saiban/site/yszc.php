<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-sport.jpg") no-repeat center center;
        background-size: cover;
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

            </div>

            <?php include('themes/saiban/assets/yuntsai/includes/footer-js.php') ?>

        </section>
    </div>
</div>