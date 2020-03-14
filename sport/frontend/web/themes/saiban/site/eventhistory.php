<!DOCTYPE html>
<html lang="zh-Hans-CN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>SPORT</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="/themes/saiban/assets/js/layer/skin/layer.css" />
    <link rel="stylesheet" href="/themes/saiban/assets/js/layer/skin/skinself/style.css" />
    <link rel="stylesheet" href="/themes/saiban/assets/js/malihu-custom-scrollbar-plugin/3.15/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="/themes/saiban/assets/css/layout.css" />
    <link rel="stylesheet" href="/themes/saiban/assets/css/style.css" />
    <link rel="stylesheet" href="/themes/saiban/assets/css/font-awesome5.min.css" rel="stylesheet" />
    <style>
        html,
        body {
            overflow: hidden;
        }

        html,
        body,
        #betting_list {
            height: 100%;
        }

        .mCustomScrollbar {
            padding-bottom: 10px;
        }

        .mCSB_container_wrapper {
            margin-right: 0;
            margin-bottom: 0;
        }

        .mCustomScrollbar .mCSB_scrollTools.mCSB_scrollTools_vertical {
            position: fixed;
            right: 0;
            height: calc(100vh - 86px);
            bottom: 0;
            top: auto;
        }

        .mCSB_container_wrapper>.mCSB_container {
            padding-bottom: 10px;
        }

        .mCustomScrollBox.mCS-minimal-dark+.mCSB_scrollTools+.mCSB_scrollTools.mCSB_scrollTools_horizontal {
            width: 100%;
            margin: 0;
        }
    </style>
</head>

<body>
    <div id="betting_list">
        <div class="list_confirm_head">
            <h2 class="heading2">下单纪录</h2>
        </div>
        <div class="list_confirm_content">
            <div class="list_confirm_item_container">
                <?php
                foreach ($list as $key => $val) {
                    ?>
                    <div class="list_confirm_item" data-hidden="false">
                        <ul class="confirm_item_header">
                            <li class="header_left">单号:<span data-id="number" style="color: rgb(91, 91, 91);"><?= $val['order_num'] ?></span></li>
                            <li class="header_mid">
                                <span>赛事:<strong data-id="title" style="color: rgb(91, 91, 91);"><?= $val['title'] ?></strong></span>
                                <span>項目:<strong data-id="project" style="color: rgb(91, 91, 91);"><?= $val['game_item_id'] ?></strong></span>
                                <span>投注金额:<strong data-id="money" style="color: rgb(91, 91, 91);"><?= $val['bet_money'] ?></strong></span>
                                <?php
                                    if ($val['status'] == 0) {
                                        ?>
                                    <span data-id="result" class="result-wait" style="color: rgb(91, 91, 91);">尚未开奖</span>
                                <?php
                                    } elseif ($val['status'] == 1 && $val['is_win'] == 1) {
                                        ?>
                                    <span data-id="result" class="result-yes" style="color: rgb(255, 255, 255);">中奖</span>
                                <?php
                                    } elseif ($val['status'] == 1 && $val['is_win'] == 0) {
                                        ?>
                                    <span data-id="result" class="result-no" style="color: rgb(255, 255, 255);">已开奖</span>
                                <?php
                                    }
                                    ?>
                            </li>
                            <li class="header_right">
                                <i class="fas fa-caret-down"></i>
                                <span>查看明细</span>
                            </li>
                        </ul>
                        <div class="confirm_item_body" style="display: none;">
                            <div class="body_container">
                                <ul class="body_intro">
                                    <?php
                                        if ($val['game_type'] == 1) {
                                            ?>
                                        <li>让票:<span data-id="rangfen" style="color: rgb(91, 91, 91);"><?= $val['rangfen'] ?></span></li>
                                    <?php
                                        }
                                        ?>
                                    <li>赔率:<span data-id="odds" style="color: rgb(255, 71, 71);"><?= $val['bet_rate'] ?></span></li>
                                    <li>编号:<span data-id="id" style="color: rgb(91, 91, 91);"><?= $val['qishu'] ?></span></li>
                                    <li>下单時間:<span data-id="time" style="color: rgb(91, 91, 91);"><?= $val['bet_time'] ?></span></li>
                                    <li>开奖结果:<span data-id="win"><?= $val['win_total'] > 0 ? $val['win_total'] : 0; ?></span></li>
                                </ul>
                                <textarea readonly class="body_textarea" data-id="text" style="color: rgb(91, 91, 91);"><?= $val['message'] ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- <div class="list_confirm_footer">
            <div class="record_btn_box">
                <button type="button" class="cancel_btn" data-button="layer-close">关闭</button>
            </div>
        </div> -->
    </div>
    <script type="text/javascript" src="/themes/saiban/assets/js/jquery-1.8.3.min.js"></script>
    <script src="/themes/saiban/assets/js/layer/layer.js"></script>
    <script src="/themes/saiban/assets/js/imgLiquid-min.js"></script>
    <script src="/themes/saiban/assets/js/jquery.easing.min.js"></script>
    <script src="/themes/saiban/assets/js/malihu-custom-scrollbar-plugin/3.15/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- <script src="/themes/saiban/assets/js/main-dist.js"></script> -->
</body>
<script>
    $(document).ready(function() {
        // 按鈕開關效果
        $('.confirm_item_header').on('click', function() {
            var thisBody = $(this).siblings('.confirm_item_body');
            if (thisBody.css('display') == 'block') {
                $('.confirm_item_body').slideUp();
            } else {
                $('.confirm_item_body').slideUp();
                thisBody.slideDown();
            }
        });
    })
    $(window).on("load", function() {
        var macos = /(Mac|iPhone|iPod|iPad)/i.test(navigator.platform);

        if (!macos) {
            scrollbarCustom()
        } else {
            $('body').addClass('macos')
        }

        function scrollbarCustom() {
            // mCustomScrollbar init
            $(".list_confirm_content").mCustomScrollbar({
                autoHideScrollbar: true, // 自動隱藏 Scrollbar
                axis: 'yx', // 卷軸軸向 x , y , yx
                theme: "minimal-dark", // Scrollbar 外觀
                scrollButtons: {
                    enable: true // Scrollbar 上下左右的箭頭是否顯示
                },
                mouseWheel: {
                    scrollAmount: 300, // 卷軸滑動速度
                    normalizeDelta: true
                }
            });

            // textarea use mCustomScrollbar Bug fixed
            $(".list_confirm_item").mouseenter(function() {
                $(this).find("textarea").mouseenter(function() {
                    $(this).focus();
                })
            })
        }
    });
</script>

</html>