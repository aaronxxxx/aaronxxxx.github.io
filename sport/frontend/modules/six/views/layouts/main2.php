<?php
use yii\helpers\Html;
use app\modules\six\helpers\Zodiac;
//use app\modules\six\assets\AppAsset;
//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <title><?=$this->title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=640,user-scalable=no">
        <meta content="yes" name="apple-mobile-web-app-capable">
        <meta content="black" name="apple-mobile-web-app-status-bar-style">
        <meta content="telephone=no" name="format-detection">
        <meta content="email=no" name="format-detection">
        <link href="/public/aomen/css/lottery.css" rel="stylesheet" />
        <link href="/public/aomen/css/jquery.goldui.css" rel="stylesheet" />
        <link href="/public/aomen/css/AlertBox.css" rel="stylesheet" />
        <link rel="stylesheet" href="/public/aomen/css/ConfirmBox.css" />
        <link rel="stylesheet" href="/public/aomen/css/result.css" />
        <script src="/public/aomen/js/six/Lang.js"></script>
        <!-- <script src="/public/aomen/js/six/Lunar_sp.js"></script> -->
        <script src="/public/aomen/js/six/group_menu.js"></script>
        <script src="/public/aomen/js/six/jquery-1.7.2.min.js"></script>
        <script src="/public/aomen/js/six/jquery.GoldUI.js"></script>
        <script src="/public/aomen/js/six/jquery.contextmenu.js"></script>
        <script src="/public/aomen/js/six/ltOrder.js"></script>
        <script src="/public/aomen/js/six/lt_show.js"></script>
        <script src="/public/aomen/js/six/lt_ch_show.js"></script>
        <script src="/public/aomen/js/six/lt_lx_show.js"></script>
        <script src="/public/aomen/js/six/lt_nap_show.js"></script>
        <script src="/public/aomen/js/six/lt_ni_show.js"></script>
        <script src="/public/aomen/js/six/lt_nx_show.js"></script>
        <!-- <script src="/public/aomen/js/marquee.js"></script> -->
        <script src="/public/aomen/js/six/memberCenter.js"></script>
        <script src="/public/aomen/js/six/mobileStyle.js"></script>
        <script src="/public/aomen/js/six/overMenu.js"></script>
        <script src="/public/aomen/js/six/package.js"></script>
        <script src="/public/aomen/js/six/sound.js"></script>
        <script src="/public/aomen/js/six/superfish.js"></script>
        <!-- <script src="/public/aomen/js/timeclock.js"></script> !! -->
        <script src="/public/aomen/js/six/view.js"></script>
        <script src="/public/aomen/js/six/zindexSort.js"></script>
        <script src="/public/aomen/js/six/lang_cn.js"></script>
        <script src="/public/jquery/jquery-1.8.3.min.js"></script>
        <script src="/public/layer/layer.js"></script>
        <script src="/public/aomen/js/six/base.js"></script>
        <script src="/public/aomen/js/six/six.js"></script>
        <link href="/public/aomen/css/fast_bet_lhai.css" rel="stylesheet" type="text/css"/>
        <script src="/public/aomen/js/fast_bet_lhai.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () { 
                $('#gameName').html($('#lotteryName').val());
                $("#hit").click(function () {
                    $(".mengfixd").show();
                });
                $("#close").click(function () {
                    $(".mengfixd").hide();
                })
                getLoginedInfo();
                var header = $('header').height(),
                      footer = $('footer').height(),
                      btnH = $('.btns ').height(),
                      labelH=$('.label').height(),
                      contentH = $('.content').height();
                    $('main.sixMain').css({'padding-top':header,'padding-bottom':footer+(btnH*2)},);
                    $('.btns').css('bottom',footer);
            });
        </script>
    </head>
    <body>
        <header>
            <nav class="d-flex justify-content-between align-items-center pl-4 pr-4">
                <div class="navitem navPrevious">
                    <a onclick="history.back()"><img src="/public/aomen/images/log/header-back.png" alt="上一页" srcset=""></a>
                </div>
                <div class="navitem">
                    <ul class="usernameinfo" id="user">
                        <li class="d-flex userNav">     
                            <div class="userNavicon"><img src="/public/aomen/images/index/header-man.png" alt=""></div>&nbsp;
                            <p id="h_menber"></p>
                        </li>
                        <li class="d-flex userNav">
                            <div class="userNavicon"><img src="/public/aomen/images/index/header-money.png" alt=""></div>&nbsp;
                            <p id="centerAmount"></p>
                        </li>
                    </ul>
                </div>               
            </nav>
        </header>
        <!--开奖结果弹出窗-->
        <div class="mengfixd" style="display:none;">
            <div class="openresult">
                <h2>开奖结果 <span id="close">×</span></h2>
                <div class="jieguo">
                    <div class="bet-model mg0" id="kjresult"></div>
                </div>
            </div>
        </div>
	<?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
            <footer class="d-flex align-items-center">
                <section class="footerItem">
                    <a href="/?r=mobile/disp/index">
                        <div class="icon"><img src="/public/aomen/images/index/footer-home.png" alt=""></div>
                        <p>首页</p>
                    </a>
                </section>
                <section class="footerItem">
                    <a href="/?r=mobile/financial/index">
                        <div class="icon"><img src="/public/aomen/images/index/footer-money.png" alt=""></div>
                        <p>财务中心</p>
                    </a>
                </section>
                <section class="footerItem">
                    <a href="/?r=mobile/quota/index">
                        <div class="icon"><img src="/public/aomen/images/index/footer-trans.png" alt=""></div>
                        <p>额度转换</p>
                    </a>
                </section>
                <section class="footerItem">
                    <a href="/?r=mobile/user/user-hall">
                        <div class="icon"><img src="/public/aomen/images/index/footer-member.png" alt=""></div>
                        <p>会员中心</p>
                    </a>
                </section>
                <section class="footerItem">
                    <a href="#">
                        <div class="icon"> <img src="/public/aomen/images/index/footer-game.png" alt=""></div>
                        <p>游戏中心</p>
                    </a>
                </section>
           </footer>
    </body>
</html>
<?php $this->endPage() ?>
