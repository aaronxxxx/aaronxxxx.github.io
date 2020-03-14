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
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="/public/publics/js/jquery-1.7.2.min.js"></script>
        <script src="/public/layer/layer.js"></script>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href="/public/moduleresous/css/6448live.css" rel="stylesheet" type="text/css"/>
        <script src="/public/buyugame/js/openWindow.js"></script>
    </head>
    <style>
    .ele-live-obg{position: relative;}
    .ele-live-obg > .livePlay{position:absolute;padding:17px 59px;top:-150px;left:10px;background:url("/public/moduleresous/images/6448live/btnPlay.png");cursor: pointer;}
    .ele-live-obg > .btnLive{position:absolute;padding:17px 59px;top:-150px;right:10px;background:url("/public/moduleresous/images/6448live/btnLiveR.png");cursor: pointer;}

    </style>
    <body>
        <?php $this->beginBody() ?>
        <!--原来的live star-->
        <div id="page-container" >
            <div id="page-body">
                <div class="ele-live-wrap" style="width:900px">
                    <div class="ele-live-align" style="overflow: hidden;">
						<!--AGIN-->
                        <a data-hall="sa" id="js-live-sa" class="ele-live-sa js-is-rotate change-bg-pos ele-current" style="width: 280px; left: 0px; top: 0px; opacity: 1; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg">
                                <div class="livePlay" onclick="return submitLive(2, <?= $uid; ?>);"></div>
                                <div class="btnLive" onclick="javascript: if(loginCheck()){layer_savemoney('/?r=member/live/transport&amp;type=agin');}"></div>
                                <!-- <div class="btnLive" onclick="javascript: if(loginCheck()){openWindowConvert('/?r=member/live/transport&type=agin','');}"></div> -->
                            </span>
                        </a>
						<!--DS-->
                        <a  data-hall="ab" id="js-live-ab"  class="ele-live-ab js-is-rotate change-bg-pos" style="width: 280px; left: 404px; top: 0px; opacity: 1; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg">
                                <div class="livePlay" onclick="return submitLive(4, <?= $uid; ?>);"></div>

                                <div class="btnLive" onclick="javascript: if(loginCheck()){layer_savemoney('/?r=member/live/transport&type=ds');}"></div>
                                <!-- <div class="btnLive" onclick="javascript: if(loginCheck()){openWindowConvert('/?r=member/live/transport&type=ds','');}"></div> -->
                            </span>
                        </a>
						<!--AG-->
                        <a data-hall="ag"  id="js-live-ag" class="ele-live-ag js-is-rotate change-bg-pos" style="width: 280px; left: 280px; top: 0px; opacity: 1; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg">
                                <div class="livePlay" onclick="return submitLive(1, <?= $uid; ?>);" ></div>
                                <div class="btnLive"  onclick="javascript: if(loginCheck()){layer_savemoney('/?r=member/live/transport&type=ag');}" ></div>
                                <!-- <div class="btnLive"  onclick="javascript: if(loginCheck()){openWindowConvert('/?r=member/live/transport&type=ag','');}" ></div> -->
                            </span>
                        </a>
						<!--OG-->
                        <a  data-hall="og"  id="js-live-og" class="ele-live-og js-is-rotate change-bg-pos" style="width: 280px; left: 528px; top: 0px; opacity: 1; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg">
                                <div class="livePlay"  onclick="return submitLive(7, <?= $uid; ?>);"></div>
                                <div class="btnLive"  onclick="javascript: if(loginCheck()){layer_savemoney('/?r=member/live/transport&type=og');}"></div>
                                <!-- <div class="btnLive"  onclick="javascript: if(loginCheck()){openWindowConvert('/?r=member/live/transport&type=og','');}"></div> -->
                            </span>
                        </a>
						<!--AG_BBIN-->
                        <a data-hall="bb"  id="js-live-bb" class="ele-live-bb change-bg-pos" style="width: 280px; top: 0px; opacity: 1; left: 0px; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg">
                                <div class="livePlay"  onclick="return submitLive(3, <?= $uid; ?>);"></div>
                                <div class="btnLive"  onclick="javascript: if(loginCheck()){layer_savemoney('/?r=member/live/transport&type=ag_bbin');}"></div>
                                <!-- <div class="btnLive"  onclick="javascript: if(loginCheck()){openWindowConvert('/?r=member/live/transport&type=ag_bbin','');}"></div> -->
                            </span>
                        </a>
                        <!--AG_OG
                        <a href="javascript:void(0);" onclick="return submitLive(5, );" data-hall="og" class="ele-live-og js-is-rotate change-bg-pos" style="width: 280px; left: 528px; top: 0px; opacity: 1; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg"></span>
                        </a>-->

                        <!--AG_MG-->
                        <a  data-hall="gd"  id="js-live-gd" class="ele-live-gd js-is-rotate change-bg-pos" style="width: 280px; left: 652px; top: 0px; opacity: 1; background-color: rgb(0, 0, 0);">
                            <span class="ele-live-cbg"></span>
                            <span class="ele-live-obg">
                                <div class="livePlay" onclick="return submitLive(6, <?= $uid; ?>);"></div>
                                <div class="btnLive"  onclick="javascript: if(loginCheck()){layer_savemoney('/?r=member/live/transport&type=ag_mg');}"></div>
                                <!-- <div class="btnLive"  onclick="javascript: if(loginCheck()){openWindowConvert('/?r=member/live/transport&type=ag_mg','');}"></div> -->
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <script>
            function loginCheck() {
                var pass = false;
                $.ajax({
                    async:false,
                    url:'/?r=passport/user-api/login-check',
                    dataType:'json',
                    success:function (data) {
                        if(data.status) {
                            pass = true;
                        } else {
                            alert('请先登录！');
                        }
                    }
                });
                return pass;
            }

                (function () {
                    var liveTop = {
                        $elements: $('.ele-live-align a'),
                        cur_width: parseInt("280", 10),
                        other_width: 0,
                        isOpeningDone: false,
                        isLogin: "N",
                        init: function () {
                            $("body").append($("#ele-livelogin-overlay").detach());
                            liveTop.setPicWidth();
                            liveTop.openingAnimation();
                            liveTop.picEffect();
                        },
                        /**
                         *
                         * 視訊廳開場
                         **/
                        openingAnimation: function () {
                            var aDelayAdd = 200,
                                    aDelay = 0,
                                    eleCount = liveTop.$elements.length;

                            liveTop.$elements.each(function () {
                                $(this)
                                        .css({
                                            top: '-650px',
                                            opacity: 0
                                        })
                                        .delay(aDelay)
                                        .animate({
                                            top: 0,
                                            opacity: 1
                                        }, function () {
                                            $(this).find('i').delay(220 * eleCount).fadeOut(250);
                                        });
                                aDelay += aDelayAdd;
                            });

                            // 開場動畫結束後
                            liveTop.$elements.promise().done(function () {
                                liveTop.isOpeningDone = true;
                                liveTop.$elements.css('background-color', '#000');
                            });
                        },
                        /**
                         *
                         * 依照開放的遊戲數目各別設定寬度與定位
                         **/
                        setPicWidth: function () {
                            var gamesOrder, max;

                            liveTop.other_width = (900 - liveTop.cur_width) / (liveTop.$elements.length - 1);

                            // 只開放BB視訊
                            if (liveTop.$elements.length === 1) {
                                liveTop.$elements.addClass('is-only-bb');
                            }

                            // 開放三款以上遊戲時，改變圖片定位
                            if (liveTop.$elements.length > 2) {
                                liveTop.$elements.addClass('change-bg-pos');
                            }

                            for (gamesOrder = 0, max = liveTop.$elements.length; gamesOrder < max; gamesOrder++) {
                                if (gamesOrder === 0) {
                                    liveTop.$elements.eq(gamesOrder).width(liveTop.cur_width);
                                    continue;
                                }
                                liveTop.$elements.eq(gamesOrder)
                                        .width(liveTop.cur_width)
                                        .css('left', liveTop.cur_width + liveTop.other_width * (gamesOrder - 1));
                            }
                        },
                        /**
                         *
                         * 圖片滑入效果
                         * 預設current bbin
                         **/
                        picEffect: function () {
                            var curIndex = 0,
                                    prevIndex = '';

                            if (liveTop.$elements.length > 1) {
                                $('.ele-live-wrap a:first-of-type').addClass('ele-current');
                            }

                            liveTop.$elements.on('hover', function (event) {
                                var leftGameOrder;

                                if (liveTop.isOpeningDone === false) {
                                    return false;
                                }

                                if (event.type === "mouseenter") {
                                    $('.ele-live-wrap a:first-of-type').removeClass('ele-current');
                                    $(this).addClass('ele-current');

                                    if ($(this).index() === curIndex) {
                                        return false;
                                    }

                                    prevIndex = curIndex;
                                    curIndex = $(this).index();

                                    // 目前 current 的遊戲圖
                                    if (curIndex !== 0) {
                                        liveTop.$elements.eq(curIndex).stop().animate({
                                            left: liveTop.other_width * curIndex
                                        });
                                    }

                                    // current 遊戲圖的左側
                                    if ((curIndex - prevIndex) > 0) {
                                        for (leftGameOrder = 0; leftGameOrder < curIndex; leftGameOrder++) {
                                            liveTop.$elements.eq(leftGameOrder).stop().animate({
                                                left: liveTop.other_width * leftGameOrder
                                            });
                                        }
                                    }

                                    // 上一張 current 的遊戲圖
                                    if ((curIndex - prevIndex) < 0) {
                                        liveTop.$elements.eq(prevIndex).stop().animate({
                                            left: liveTop.cur_width + liveTop.other_width * (prevIndex - 1)
                                        });
                                    }

                                    return false;
                                }

                                liveTop.$elements.removeClass('ele-current');
                            });

                            $('.ele-live-align').mouseleave(function () {
                                // Reset
                                var gamesOrder, max;

                                if (liveTop.isOpeningDone === false) {
                                    return false;
                                }

                                curIndex = 0;
                                prevIndex = '';

                                if (liveTop.$elements.length > 1) {
                                    $('.ele-live-wrap a:first-of-type').addClass('ele-current');
                                }

                                for (gamesOrder = 1, max = liveTop.$elements.length; gamesOrder < max; gamesOrder++) {
                                    liveTop.$elements.eq(gamesOrder).stop().animate({
                                        left: liveTop.cur_width + liveTop.other_width * (gamesOrder - 1)
                                    });
                                }
                            });
                        },
                    };
                    liveTop.init();
                }());

            </script>
        </div>
   <!--原来的live end-->
   
   
        <!--4v7live star-->
        <div id="mainBody_bg"  style="display: none">

            <div class="mainBody">
                <div id="page-container">
                    <div id="page-body">
                        <div class="livecasino" id="livecasino">
                            <div class="main_left">
                                <div class="action">
                                    <a href="javascript:void(0);" onclick="return submitLive(3, <?= $uid; ?>);" data-hall="bb" class="btn bb_star" data-game="3" data-toggle="game"><div class="gamehover main_left_hover" style="display: none;"></div></a>
                                </div>
                            </div>

                            <div class="main_middle">
                                <div class="action">


                                    <a href="javascript:void(0);" onclick="return submitLive(2, <?= $uid; ?>);" data-hall="sa" class="btn ag_star" data-game="1" data-toggle="game"><div class="gamehover main_middle_hover" style="display: none;"></div></a>

                                </div>
                            </div>


                            <div class="main_right">
                                <div class="action">
                                    <a href="javascript:void(0);"onclick="return submitLive(4, <?= $uid; ?>);" data-hall="ab" class="btn mg_star" data-game="8" data-toggle="game"><div class="gamehover main_right_hover" style="display: none;"></div></a>

                                </div>
                                <!-- content* -->										
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(function () {
                    $('.main_left').mouseover(function () {
                        $('.main_left_hover').css('display', 'block');
                    });
                    $('.main_left').mouseout(function () {
                        $('.main_left_hover').css('display', 'none');
                    });

                    $('.main_right').mouseover(function () {
                        $('.main_right_hover').css('display', 'block');
                    });
                    $('.main_right').mouseout(function () {
                        $('.main_right_hover').css('display', 'none');
                    });

                    $('.main_middle').mouseover(
                            function () {
                                $('.main_middle_hover').css('display',
                                        'block');
                            });
                    $('.main_middle').mouseout(function () {
                        $('.main_middle_hover').css('display', 'none');
                    });
                });
            </script>

        </div>
        <!--4v7live end-->
        
         <!--6448live star-->
         <div id="main-wrap" class="clearfix" style="display:none;">
            <!--真人娱乐主体区 start-->
            <div id="common-main-box" class="whole-auto clearfix">
                <div class="pd-23 clearfix" id="live-pho-show">
                    <ul>                       
                        <li>
                            <div class="live-pho-bbin live-pho-attr">
                                <a href="javascript:void(0);" onclick="return submitLive(2, <?= $uid; ?>);" class="aLoginCheck">
                                    <img src="/public/moduleresous/images/6448live/live-title-agin.png?=826"><br>
                                    <img src="/public/moduleresous/images/6448live/begin-btn.png?=826">
                                </a>			
                            </div>
                        </li>
						<li>
                            <div class="live-pho-mg live-pho-attr">
                                <a href="javascript:void(0);" onclick="return submitLive(4, <?= $uid; ?>);" class="aLoginCheck">
                                    <img src="/public/moduleresous/images/6448live/live-title-ds.png?=826"><br>
                                    <img src="/public/moduleresous/images/6448live/begin-btn.png?=826">
                                </a>				
                            </div>
                        </li>
                        <li>
                            <div class="live-pho-ag live-pho-attr">
                                <a href="javascript:void(0);" onclick="return submitLive(3, <?= $uid; ?>);" class="aLoginCheck">
                                    <img src="/public/moduleresous/images/6448live/live-title-bbin.png?=826"><br>
                                    <img src="/public/moduleresous/images/6448live/begin-btn.png?=826">
                                </a>				
                            </div>
                        </li>
						<li>
                            <div class="live-pho-og live-pho-attr">
                                <a href="javascript:void(0);" onclick="return submitLive(5, <?= $uid; ?>);" class="aLoginCheck">
                                    <img src="/public/moduleresous/images/6448live/live-title-og.png?=826"><br>
                                    <img src="/public/moduleresous/images/6448live/begin-btn.png?=826">
                                </a>				
                            </div>
                        </li>
                      
                        <li>
                            <div class="live-pho-ct live-pho-attr">
                                <a href="javascript:void(0);" onclick="return submitLive(1, <?= $uid; ?>);" class="aLoginCheck">
                                    <img src="/public/moduleresous/images/6448live/live-title-agq.png?=826"><br>
                                    <img src="/public/moduleresous/images/6448live/begin-btn.png?=826">
                                </a>				
                            </div>
                        </li>
						<li>
                            <div class="live-pho-xtd live-pho-attr">
                                <a href="javascript:void(0);" onclick="return submitLive(6, <?= $uid; ?>);" class="aLoginCheck live-btn"></a>				
                            </div>
                        </li>  
                    </ul>
                </div>
            </div>	
        </div>
         <!--6448live end-->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>