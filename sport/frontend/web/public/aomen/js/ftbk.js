// header樣式
var header = $('header').height(),
    footer = $('footer').height(),
    href = '/?r=mobile/disp/index';
$('.ftbk').css({
    'padding-top': header,
    'padding-bottom': footer
});
$('.logo').html(`<div class="backBtn d-flex flex-flow-column justify-content-center align-items-center h-100" onclick="window.location.href='${href}'">
                    <img src="/public/aomen/images/log/header-back.png" alt="上一页" srcset="">
                    <span>回上页</span>
                 </div>
                 <a href="/?r=mobile/disp/ftbk-history" class="listBtn d-flex flex-flow-column justify-content-center align-items-center" style="color:#c29c51;margin-left:10px;">
                    <img src="/public/aomen/images/index/record.png">
                    <span>投注记录</span>
                 </a>`);

// 生成結構
function body() {
    $.get("/themes/saiban/assets/yuntsai/files/new.json", function (data) {

        //PK
        for (var i = 0; i < data.pk.length; i++) {

            //根據項目注入
            if ($('#pkSwiper .pkID-' + i).length < 1) {
                $('#pkSwiper').append($('#mobileCopyUse .ftbk_Pkcard').clone());
                $('#pkSwiper .ftbk_Pkcard:last').addClass('pkID-' + i);
            }
            //指定項目
            var thisPkItem = $('#pkSwiper .pkID-' + i);
            thisPkItem.attr('data-game-type', 1);
            thisPkItem.find('[data-id=vs]').html(data.pk[i].home.name + ' VS ' + data.pk[i].customer.name);
            thisPkItem.find('[data-id=no]').html('编号:' + data.pk[i].no);

            /* 透過先行指定變數的作法，減輕行數，一次指定需給予數值*/
            //轉為後台判別，前台僅作顯示

            thisPkItem.find('[data-id=rangfen]').html(data.pk[i].home.name + ' 让 ' + data.pk[i].customer.name + ' ' + data.pk[i].rangfen + ' 票');
            thisPkItem.find('[data-id=avatar1]').attr('src', data.pk[i].home.imgUrl);
            thisPkItem.find('[data-id=name1]').html(data.pk[i].home.name).attr('data-name-id', data.pk[i].home.id);
            thisPkItem.find('[data-id=odds1]').html(data.pk[i].home.rate);
            thisPkItem.find('[data-id=avatar2]').attr('src', data.pk[i].customer.imgUrl);
            thisPkItem.find('[data-id=name2]').html(data.pk[i].customer.name).attr('data-name-id', data.pk[i].customer.id);
            thisPkItem.find('[data-id=odds2]').html(data.pk[i].customer.rate);

            var $btnTools = thisPkItem.find('.ftbk_card_body .item');

            // 左邊個人連結
            $btnTools.find('[data-icon=pk1] a.btn').each(
                function (index, e) {
                    if (data.pk[i].home.url[index] != null && data.pk[i].home.url[index].length > 0) {
                        $(this).attr('onclick', 'openUCWindow(' + '"' + data.pk[i].home.url[index] + '"' + ', "")');
                        $(this).find('img').attr('src', '/public/aomen/images/index/anal0' + (index + 1) + '.png');
                    } else if (data.pk[i].home.url[index] == null || data.pk[i].home.url[index].length == 0) {
                        return false;
                    }
                });

            // 右邊個人連結
            $btnTools.find('[data-icon=pk2] a.btn').each(
                function (index, e) {
                    if (data.pk[i].customer.url[index] != null && data.pk[i].customer.url[index].length > 0) {
                        $(this).attr('onclick', 'openUCWindow(' + '"' + data.pk[i].customer.url[index] + '"' + ', "")');
                        $(this).find('img').attr('src', '/public/aomen/images/index/anal0' + (index + 1) + '.png');
                    } else if (data.pk[i].customer.url[index] == null || data.pk[i].customer.url[index].length == 0) {
                        return false;
                    }
                });
            // Pk暫停下注
            if (data.pk[i].home.status == '2') {
                thisPkItem.find('[data-button=left]').prop('disabled', true).css('background', 'grey');
            } else {
                thisPkItem.find('[data-button=left]').prop('disabled', false).css('background', '#FBD207');
            }
            if (data.pk[i].customer.status == '2') {
                thisPkItem.find('[data-button=right]').prop('disabled', true).css('background', 'grey');
            } else {
                thisPkItem.find('[data-button=right]').prop('disabled', false).css('background', '#FBD207');
            }
        };

        //Multiple
        for (var i = 0; i < data.multi.length; i++) {

            if ($('#multiSwiper .multiID-' + i).length < 1) {
                $('#multiSwiper').append($('#mobileCopyUse .ftbk_Multicard').clone());
                $('#multiSwiper .ftbk_Multicard:last').addClass('multiID-' + i);
            }
            //指定項目
            var thisMultiItem = $('#multiSwiper .multiID-' + i);
            thisMultiItem.attr('data-game-type', 2);
            thisMultiItem.find('[data-id=title]').html(data.multi[i].title);
            thisMultiItem.find('[data-id=no]').html('编号:' + data.multi[i].no);

            // 生成項目類型
            thisMultiItem.find('.row').html('');
            var $cloneOne = $('#mobileCopyUse .ftbk_Multicard .figure-group');
            for (var o = 0; o < data.multi[i].item.length; o++) {
                $cloneOne.attr('data-name-id', data.multi[i].item[o][0]);
                $cloneOne.find('[data-id=item]').html(data.multi[i].item[o][2]);
                $cloneOne.find('[data-id=item-peilu]').html(data.multi[i].item[o][3]);
                // Multi暫停下注
                if (data.multi[i].item[o][1] == '2') {
                    $cloneOne.find('[data-button=multi]').prop('disabled', true).parent().css('background', 'grey');
                } else if (data.multi[i].item[o][1] == '1') {
                    $cloneOne.find('[data-button=multi]').prop('disabled', false).parent().css('background', '#FBD207');
                }
                thisMultiItem.find('.row').append($cloneOne.clone());
            }
        }

        // swiper.init
        var mySwiper = new Swiper('.ftbk_container', {
            autoHeight: true,
            navigation: {
                nextEl: '.btn_next',
                prevEl: '.btn_prev',
            }
        });

        betClick();

    }, "json");
};

// 開啟下單彈窗
function betClick() {
    $('[data-id=bet]').on('click', function () {
        var Pk_rangfen = $(this).parents('.ftbk_Pkcard').find('[data-id=rangfen]').text(),
            Pk_no = $(this).parents('.ftbk_Pkcard').find('[data-id=no]').text().replace('编号:', ''),
            Pk_vs = $(this).attr('data-button') == 'left' ? $(this).parents('.ftbk_card_body').find('[data-id=name1]').text() : 'right' ? $(this).parents('.ftbk_card_body').find('[data-id=name2]').text() : '',
            type = $(this).parents('.ftbk_Pkcard').attr('data-game-type') == '1' ? '单笔投注' : '2' ? '混合投注' : '',
            Pk_odds = $(this).attr('data-button') == 'left' ? $(this).parents('.ftbk_card_body').find('[data-id=odds1]').text() : 'right' ? $(this).parents('.ftbk_card_body').find('[data-id=odds2]').text() : '',
            Multi_rangfen = $(this).parents('.ftbk_Multicard').find('[data-id=title]').text(),
            Multi_no = $(this).parents('.ftbk_Multicard').find('[data-id=no]').text().replace('编号:', ''),
            Multi_vs = $(this).parents('.figure-group').find('[data-id=item]').text(),
            Multi_odds = $(this).parents('.figure-group').find('[data-id=item-peilu]').text(),
            list_name_id = $(this).attr('data-button') == 'left' ? $(this).parents('.ftbk_card_body').find('[data-id=name1]').attr('data-name-id') : 'right' ? $(this).parents('.ftbk_card_body').find('[data-id=name2]').attr('data-name-id') : 'multi' ? $(this).parents('.figure-group').attr('data-name-id') : '';
        if ($(this).attr('data-button') == 'left') {
            list_name_id = $(this).parents('.ftbk_card_body').find('[data-id=name1]').attr('data-name-id')
        } else if ($(this).attr('data-button') == 'right') {
            list_name_id = $(this).parents('.ftbk_card_body').find('[data-id=name2]').attr('data-name-id')
        } else if ($(this).attr('data-button') == 'multi') {
            list_name_id = $(this).parents('.figure-group').attr('data-name-id')
        } else {
            return false;
        }
        $.ajax({
            async: false,
            url: '/?r=passport/user-api/login-check',
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    $('#betName').html($('#h_menber').html());
                    $('#betMoney').html($('#centerAmount').html());
                    layer.open({
                        type: 1,
                        title: false,
                        area: '100%',
                        closeBtn: 0,
                        content: $('#onemore'),
                        success: function () {
                            switch (type) {
                                case '单笔投注':
                                    $('.layui-layer [data-id=no]').html(Pk_no);
                                    $('.layui-layer [data-id=type]').html(type).attr('data-game-type', '1');
                                    $('.layui-layer .rangfen').html(Pk_rangfen);
                                    $('.layui-layer [data-id=vs]').html(Pk_vs).attr('data-name-id', list_name_id);
                                    $('.layui-layer [data-id=odds]').html(Pk_odds);
                                    break;
                                case '混合投注':
                                    $('.layui-layer [data-id=no]').html(Multi_no);
                                    $('.layui-layer [data-id=type]').html(type).attr('data-game-type', '2');
                                    $('.layui-layer .rangfen').html(Multi_rangfen);
                                    $('.layui-layer [data-id=vs]').html(Multi_vs).attr('data-name-id', list_name_id);
                                    $('.layui-layer [data-id=odds]').html(Multi_odds);
                                    break;
                            }
                            $('main').hide();
                        },
                        end: function () {
                            $('.backBtn').attr("onclick", "window.location.href='/?r=mobile/disp/index'");
                            $('main').show();
                        }
                    });
                    $('[data-id=money]').keyup(function () {
                        if ($(this).val() == '') {
                            return false;
                        } else {
                            $('[data-id=total]').html('获利预估：' + $(this).val() * $('[data-id=odds]').text())
                            $('.mb_bet .bet').attr('data-button-id', 'betting_confirm')
                        }
                    });
                    $('.backBtn').attr("onclick", "layer.closeAll()");
                } else {
                    alert('请先登录！');
                    location.href = '/?r=mobile/disp/login';
                }
            }
        });
    });
}

/**
 * 打开用户中心窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @returns {}
 */
function openUCWindow(url, title) {
    openWindow(url, title, 1020, 570);
}

/**
 * 打开窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @param {int} width       窗口宽度
 * @param {int} height      窗口高度
 * @returns {}
 */
function openWindow(url, title, width, height) {
    var iTop = (window.screen.availHeight - 30 - height) / 2; // 获得窗口的垂直位置
    var iLeft = (window.screen.availWidth - 10 - width) / 2; // 获得窗口的水平位置
    window.open(url, title, 'height=' + height + ',,innerHeight=' + height +
        ',width=' + width + ',innerWidth=' + width + ',top=' + iTop +
        ',left=' + iLeft +
        ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no').focus();
    // window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
}


$(document).ready(function () {
    layer.config({
        path: '/themes/saiban/assets/js/layer/layer.js' //layer.js所在的目录，可以是绝对目录，也可以是相对目录
    });
})

$(window).on('load', function () {
    // 生成結構
    body();
    // 點擊送出功能
    $('.mb_bet .bet').on('click', function () {
        var data = $(this).attr('data-button-id'),
            type = $('.layui-layer [data-id="type"]').attr('data-game-type'),
            pkid = $('.layui-layer [data-id="no"]').text(),
            money = $('.layui-layer [data-id="money"]').val(),
            item = $('.layui-layer [data-id="vs"]').attr('data-name-id'),
            text = $('.layui-layer [data-id="remarks"]').val();
        if (data == 'betting_confirm') {
            $.ajax({
                type: "post",
                url: "/?r=event/index/insert-order",
                data: {
                    game_type: type,
                    game_id: pkid,
                    bet_money: money,
                    game_item_id: item,
                    message: text
                },
                dataType: "json",
                success: function (result) {
                    if (result.code == 10) {
                        alert("投注成功");
                        layer.closeAll();
                        document.location.reload();
                    } else {
                        alert(result.msg);
                    }
                }
            });
        } else {
            return false;
        }

    });
})