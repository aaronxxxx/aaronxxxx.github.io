<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-sport.jpg") no-repeat center center;
        background-size: cover;
    }
</style>
<?php require('themes/saiban/site/kf.php') ?>
<!-- #########################################################################################################################
                                            運                      彩
    ######################################################################################################################### -->
<div class="pageBox">
    <div class="pages">
        <section id="lobby" class="ng-scope">

            <?php include('themes/saiban/assets/yuntsai/includes/head.php') ?>

            <div id="sport" class="sidebar-outer">
                <section id="sidebar">
                    <div class="sidebar-wrapper sidebar-close">
                        <div class="card">
                            <div class="card-top">
                                <a href="javascript:;" onclick="openWindow('/?r=event/index/history','',960,655)" class="btn history-btn button">
                                    <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/icon005.png" alt="">下单紀錄
                                </a>
                            </div>
                            <div class="card-bottom">
                                <div class="btn-group">
                                    <button type="button" class="btn scrollToID button" data-target="pk-mode">
                                        <i class="icon">
                                            <img draggable="false" src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/icon004.png" alt="">
                                        </i>
                                        <span>单笔</span>
                                    </button>
                                    <button type="button" class="btn scrollToID button" data-target="multi-mode">
                                        <i class="icon">
                                            <img draggable="false" src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/icon004.png" alt="">
                                        </i>
                                        <span>混合</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="sport_content">
                    <div class="container pk-mode" data-type="pk-mode">
                        <div class="main-title col-12">
                            <h2 class="heading2">单笔投注</h2>
                        </div>
                        <div class="lists col-12">
                            <ul id="pkGroup" class="lists-group col-12 list-unstyled p-0">
                                <li class="media col-12">
                                    <div class="media-header">
                                        <div class="title col-12 d-flex align-items-center justify-content-between px-0">
                                            <div>
                                                <h3 id="vs" class="heading3"></h3>
                                                <h4 id="project" class="media-rangfen"></h4>
                                            </div>
                                            <p class="pkid">编号:<span></span></p>
                                        </div>
                                    </div>
                                    <div class="media-body col-12">
                                        <div class="d-flex">
                                            <div class="figure-group col d-flex">
                                                <figure class="figure d-flex flex-column">
                                                    <div class="pic imgLiquidFill" data-imgLiquid-horizontalAlign="50%" data-imgLiquid-verticalAlign="50%">
                                                        <img id="pk_img1" draggable="false" src="" alt="">
                                                    </div>
                                                    <figcaption class="pk_name1"></figcaption>
                                                </figure>
                                                <div class="card col d-flex flex-column">
                                                    <div class="card-header col-auto d-flex justify-content-between">
                                                        <h4 class="heading4 pk_name1"></h4>
                                                        <div id="pk_peilu1" class="odds"></div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p id="pk_jieshao1"></p>
                                                    </div>
                                                    <div class="card-footer col-auto">
                                                        <div class="tools col-12">
                                                            <div class="col" data-icon="pk">
                                                                <a class="btn" href="javascript:;" onclick=""><img draggable="false" src="" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn order-btn button" data-button="layer"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center justify-content-center">
                                                <div class="comity-body">
                                                    <div class="rangfen-img">
                                                        <div class="d-flex justify-content-between"><img src="/themes/saiban/assets/images/sport/arrow.png" alt="" /></div>
                                                    </div>
                                                    <div class="rangfen-num d-flex align-items-center justify-content-center">
                                                        <span>让</span><span class="red"><strong id="rangfen1"></strong></span><span>票</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="figure-group col d-flex">
                                                <figure class="figure d-flex flex-column">
                                                    <div class="pic imgLiquidFill" data-imgLiquid-horizontalAlign="50%" data-imgLiquid-verticalAlign="50%">
                                                        <img id="pk_img2" draggable="false" src="" alt="">
                                                    </div>
                                                    <figcaption class="pk_name2"></figcaption>
                                                </figure>
                                                <div class="card col d-flex flex-column">
                                                    <div class="card-header col-auto d-flex justify-content-between">
                                                        <h4 class="heading4 pk_name2"></h4>
                                                        <div id="pk_peilu2" class="odds"></div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p id="pk_jieshao2"></p>
                                                    </div>
                                                    <div class="card-footer col-auto">
                                                        <div class="tools col-12">
                                                            <div class="col" data-icon="multi">
                                                                <a class="btn" href="javascript:;" onclick=""><img draggable="false" src="" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn order-btn button" data-button="layer"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="container multi-mode" data-type="multi-mode">
                        <div class="main-title col-12">
                            <h2 class="heading2">混合投注</h2>
                        </div>
                        <div class="lists col-12">
                            <ul id="multiGroup" class="lists-group col-12 list-unstyled p-0">
                                <li class="media col-12">
                                    <div class="media-header color-dark" style="background: url(/themes/saiban/assets/images/sport/tittle_bg.png) center center / cover no-repeat rgb(223, 223, 223);">
                                        <div class="title col-12 px-0">
                                            <h3 id="multi_1" class="heading3"></h3>
                                            <p class="pkid">编号:<span></span></p>
                                        </div>
                                    </div>
                                    <div class="media-body col-12">
                                        <div class="row">
                                            <div class="figure-group col-12">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-6">
                                                        <p data-id="item"></p>
                                                    </div>
                                                    <div class="col-3">
                                                        <p>
                                                            <label>赔率:</label>
                                                            <span class="red odds" data-id="item-peilu"></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-3 p-0">
                                                        <button type="button" class="btn order-btn button" data-button="layer"></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <?php include('themes/saiban/assets/yuntsai/includes/footer-js.php') ?>

        </section>
    </div>
</div>