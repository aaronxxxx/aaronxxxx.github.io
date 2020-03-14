<main class="home">
    <!-- <script src="/public/aomen/js/index.js"></script>
    <script src="/public/aomen/js/live_exchange_transport.js"></script>
    <script src="/public/aomen/js/jquery.blockUI.min.js"></script> -->
    <section class="indexSection indexSection1">
        <div class="bg"></div>
        <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/index_tex02.png" alt="" class="title title1" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1100">
        <div class="bottom">
            <div class="line" data-aos="mb-height" data-aos-duration="1000" data-aos-delay="300" data-aos-anchor-placement="center-bottom"></div>
            <a href="/?r=mobile/disp/ftbk" class="next" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300" data-aos-anchor-placement="top-bottom">立即前往</a>
        </div>
    </section>
    <section class="indexSection indexSection2">
        <div class="bg"></div>
        <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/index_tex03.png" alt="" class="title title2" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1100" data-z-index="4">
        <div class="bottom" data-z-index="4">
            <div class="line" data-aos="mb-height" data-aos-duration="1000" data-aos-delay="300" data-aos-anchor-placement="center-bottom"></div>
            <a href="/?r=mobile/disp/ftbk" class="next" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300" data-aos-anchor-placement="top-bottom">立即前往</a>
        </div>
    </section>
    <section class="indexSection indexSection3">
        <div class="bg"></div>
        <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/index_tex01.png" alt="" class="title title3" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1100">
        <div class="bottom">
            <div class="line" data-aos="mb-height" data-aos-duration="1000" data-aos-delay="300" data-aos-anchor-placement="center-bottom"></div>
            <a href="/?r=mobile/disp/ftbk" class="next" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300" data-aos-anchor-placement="top-bottom">立即前往</a>
        </div>
    </section>
    <!-- <div id="wrapper"> -->
    <!--焦点图-->
    <!-- <div class="swiper-container banner_img">
            <div class="swiper-wrapper">
                <?php foreach ($banner as $key => $value) { ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $value['img_url']; ?>" />
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-pagination"></div>
        </div> -->
    <!-- 公告訊息 -->
    <!-- <div class="marquee d-flex">
            <div class="notice-icon ml-2">
                <img src="/public/aomen/images/index/announce.png" alt="">
            </div>
            <div class="notice-marquee d-flex justify-content-center align-items-center">
                <marquee scrollamount="5" scrolldelay="80" class="recent_news_scroll" direction="left" nowarp="" id="msg" onclick="getMsg();"> </marquee>
            </div>
        </div> -->
    <!-- <div class="content"> -->
    <!-- 第一排 tabinner -->
    <!-- <div class="tabInner">
                <div id="tabLottery" class="tabarea">
                    <div class="tabbox d-flex flex-wrap justify-content-between"></div>
                </div>
                <div id="tabSix" class="tabarea">
                    <div class="tabbox d-flex flex-wrap justify-content-between"></div>
                </div>
                <div id="tabLive" class="tabarea">
                    <div class="tabbox d-flex flex-wrap justify-content-between"></div>
                </div>
            </div> -->
    <!-- 第二排tabinner -->
    <!-- <div class="tabInner">
                <div id="tabGame" class="tabarea">
                    <div class="tabbox d-flex flex-wrap justify-content-between"></div>
                </div>
            </div>
            <div class="tab menu d-flex justify-content-between">
                <div class="card sport-card">
                    <a href="#tabSport">
                        <div class="cardinner">
                            <div class="icon"><img src="/public/aomen/images/index/gamelist/ftbk.png" alt=""></div>
                            <p>体育</p>
                        </div>
                    </a>
                </div>
                <div class="card" onclick="">
                    <a href="">
                        <div class="cardinner">
                            <div class="icon"><img src="/public/aomen/images/index/upgrade.png" alt=""></div>
                            <p>升级中</p>
                        </div>
                    </a>
                </div>
            </div> -->
    <!-- 第三排tabinner -->
    <!-- <div class="tabInner">
                <div id="tabSport" class="tabarea">
                    <div class="tabbox d-flex flex-wrap justify-content-between">
                        <div class="card">
                        <?php
                        if (Yii::$app->session->has(Yii::$app->params['S_USER_ID'])) {
                            ?>
                            <a onclick="javascript: if(loginCheck()){ftbk()}">
                                <div class="cardinner">
                                    <div class="icon">
                                        <img src="/public/aomen/images/index/gamelist/gameicon/ftbk.png" alt="">
                                    </div>
                                    <p>非投不可</p>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="contentBottom d-flex flex-wrap justify-content-between">
                <li class="item">
                    <a href="/?r=passport/site/index&code=1">
                        <div class="icon"><img src="/public/aomen/images/index/icon computer.png" alt=""></div>
                        <p class="bolder">电脑版</p>
                    </a>
                </li>
                <li class="item">
                    <a onclick="imgAlert('<?php echo $app_qrcode; ?>');">
                        <div class="icon"><img src="/public/aomen/images/index/icon app.png" alt=""></div>
                        <p class="bolder">APP下载</p>
                    </a>
                </li>
                <li class="item">
                    <a id="customerService" href="">
                        <div class="icon"><img src="/public/aomen/images/index/icon customer.png" alt=""></div>
                        <p class="bolder">在线客服</p>
                    </a>
                </li>
            </ul> -->
    <!-- </div> -->
    <!-- 公司資訊 -->
    <!-- <div class="comInfo ">
            <div class="d-flex justify-content-between">
                <div class="item">
                    <div class="icon"><img src="/public/aomen/images/index/AD-gicc.png" alt=""></div>
                    <p>GICC 牌照</p>
                </div>
                <div class="item">
                    <div class="icon"><img src="/public/aomen/images/index/AD-hatafe.png" alt=""></div>
                    <p>赫塔菲</p>
                </div>
                <div class="item">
                    <div class="icon"><img src="/public/aomen/images/index/AD-shi.png" alt=""></div>
                    <p>西甲</p>
                </div>
                <div class="item">
                    <div class="icon"><img src="/public/aomen/images/index/AD-18.png" alt=""></div>
                    <p>满18周岁</p>
                </div>
            </div>
            <?php if ($service_qq == '') { ?>
            <?php } else { ?>
                <div id="service_qq_box" class="mt-4 text-center serviceQQ">
                    <p>客服QQ號：<span id="serviceQQ"><?php echo $service_qq ?></span> </p>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center footernode">
                <p style="line-height:51px;">Copyright©2017</p>
                <div class="flag"><img src="/public/aomen/images/index/copyright-china.png" alt=""></div>
                <p style="line-height:51px;">简体中文</p>
            </div>
        </div> -->
    <!-- </div> -->
</main>
<!-- <script>
    $(document).ready(function() {
        gamebox();
        $('.tab .card').toggle(function() {
            var id = $(this).find('a').attr('href');
            $('.tab').find('.act').removeClass('act');
            $(this).addClass('act');
            $('.tabInner').children('.tabarea').hide();
            $('.tabInner').find(id).slideDown("slow");
        }, function() {
            var id = $(this).find('a').attr('href');
            $(this).removeClass('act');
            $('.tabInner').children('.tabarea').slideUp();
        });
        var header = $('header').height() + 30,
            footer = $('footer').height();
        $('main').css({
            'padding-top': header,
            'padding-bottom': footer
        });
    });
</script> -->