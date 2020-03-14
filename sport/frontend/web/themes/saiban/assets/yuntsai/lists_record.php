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
    <link rel="stylesheet" href="/themes/saiban/assets/css/layout.css" />
    <link rel="stylesheet" href="/themes/saiban/assets/css/style.css" />
    <link rel="stylesheet" href="/themes/saiban/assets/css/font-awesome5.min.css" rel="stylesheet" />
</head>

<body style="background-color:#1E1E1E">
    <div id="betting_list">
        <div class="list_confirm_head">
            <h2 class="heading2">下单纪录</h2>
        </div>
        <div class="list_confirm_content">
            <div class="list_confirm_item">
                <ul class="confirm_item_header">
                    <li class="header_left">单号:<span data-id="number"></span></li>
                    <li class="header_mid">
                        <span>赛事:<strong data-id="title"></strong></span>
                        <span>項目:<strong data-id="project"></strong></span>
                        <span>投注金额:<strong data-id="money"></strong></span>
                        <span data-id="result"></span>
                    </li>
                    <li class="header_right">
                        <i class="fas fa-caret-down"></i>
                        <span>查看明细</span>
                    </li>
                </ul>
                <div class="confirm_item_body">
                    <div class="body_container">
                        <ul class="body_intro">
                            <li>让票:<span data-id="rangfen"></span></li>
                            <li>赔率:<span data-id="odds"></span></li>
                            <li>编号:<span data-id="id"></span></li>
                            <li>下单時間:<span data-id="time"></span></li>
                            <li>开奖结果:<span data-id="win"></span></li>
                        </ul>
                        <div class="body_textarea" data-id="text"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="list_confirm_footer">
            <div class="record_btn_box">
                <button type="button" class="cancel_btn" data-button="layer-close">关闭</button>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/themes/saiban/assets/js/jquery-1.8.3.min.js"></script>
    <script src="/themes/saiban/assets/js/layer/layer.js"></script>
    <script src="/themes/saiban/assets/js/imgLiquid-min.js"></script>
    <script src="/themes/saiban/assets/js/jquery.easing.min.js"></script>
    <script src="/themes/saiban/assets/js/main-dist.js"></script>
</body>
<script>
    $(document).ready(function() {
        $.get("/themes/saiban/assets/yuntsai/files/history.json", function(data) {
            var body = $('#betting_list .list_confirm_content'),
                body_item = $('#betting_list .list_confirm_content .list_confirm_item:first-of-type');
            //生成結構
            for (var i = 0; i < data.length; i++) {
                var type = data[i].type;
                body.append(body_item.clone());
                $('#betting_list .list_confirm_content .list_confirm_item').attr('data-hidden', false);
                $('#betting_list .list_confirm_content .list_confirm_item:first-of-type').attr('data-hidden', true);
                switch (type) {
                    // Pk型
                    case 'pk':
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=number]').html('000000' + [i]).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=title]').html(data[i].title).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=project]').html(data[i].project).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=money]').html(data[i].money).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=rangfen]').html(data[i].rangfen).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=odds]').html(data[i].odds).css('color', '#FF4747');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=id]').html(data[i].id).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=time]').html(data[i].time).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=text]').html(data[i].text).css('color', '#5B5B5B');
                        // 判斷有無開獎或中獎
                        switch (data[i].result) {
                            case '中奖':
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=result]').html(data[i].result).addClass('result-yes').css('color', '#FFFFFF');
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=win]').html(data[i].money * data[i].odds);
                                break;
                            case '已开奖':
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=result]').html(data[i].result).addClass('result-no').css('color', '#FFFFFF');
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=win]').html('0');
                                break;
                            case '尚未开奖':
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=result]').html(data[i].result).addClass('result-wait').css('color', '#5B5B5B');
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=win]').html('-');
                                break;
                        };
                        break;
                        // 多項目型
                    case 'multi':
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=number]').html('000000' + [i]).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=title]').html(data[i].title).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=project]').html(data[i].project).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=money]').html(data[i].money).css('color', '#5B5B5B');
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=rangfen]').parent('li').hide();
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=odds]').html(data[i].odds);
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=id]').html(data[i].id);
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=time]').html(data[i].time);
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=text]').html(data[i].text);
                        // 判斷有無開獎或中獎
                        switch (data[i].result) {
                            case '中奖':
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=result]').html(data[i].result).addClass('result-yes').css('color', '#FFFFFF');
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=win]').html(data[i].money * data[i].odds);
                                break;
                            case '已开奖':
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=result]').html(data[i].result).addClass('result-no').css('color', '#FFFFFF');
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=win]').html('0');
                                break;
                            case '尚未开奖':
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=result]').html(data[i].result).addClass('result-wait').css('color', '#5B5B5B');
                                $('#betting_list .list_confirm_content .list_confirm_item:last-of-type [data-id=win]').html('-');
                                break;
                        };
                        $('#betting_list .list_confirm_content .list_confirm_item:last-of-type .body_textarea').css('height', '86px');
                        break;
                }
            }
            // 按鈕開關效果
            $('.list_confirm_item').on('click', function() {
                var thisBody = $(this).find('.confirm_item_body');
                if (thisBody.css('display') == 'block') {
                    $('.confirm_item_body').slideUp();
                } else {
                    $('.confirm_item_body').slideUp();
                    thisBody.slideDown();
                }
            });
        });
    })
</script>

</html>