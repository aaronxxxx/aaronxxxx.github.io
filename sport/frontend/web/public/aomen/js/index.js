var lottery = [{
        code: 'mlaft',
        name: '幸运飞艇'
    },
    {
        code: 'tjssc',
        name: '极速时时彩'
    },
    {
        code: 'ssrc',
        name: '极速赛车'
    },
    {
        code: 'ts',
        name: '腾讯分分彩'
    },
    {
        code: 'cqssc',
        name: '重庆时时彩'
    },
    {
        code: 'bjpk10',
        name: '北京pk10'
    },
    {
        code: 'bjkl8',
        name: '北京快乐8'
    },
    {
        code: 'gxsfc',
        name: '广西十分彩'
    },
    {
        code: 'gdkl10',
        name: '广东十分彩'
    },
    {
        code: 'tjkl10',
        name: '天津十分彩'
    },
    {
        code: 'cqkl10',
        name: '重庆十分彩'
    },
    {
        code: 'gd11x5',
        name: '广西11选5'
    },
    {
        code: 'shssl',
        name: '上海时时乐'
    },
    {
        code: 'fc3d',
        name: '福彩3D'
    },
    {
        code: 'pl3',
        name: '排列三'
    },
    {
        code: 'orpk',
        name: '老PK拾'
    }
];
var six = [{
        code: 'spsix',
        name: '极速六合彩'
    },
    {
        code: 'six',
        name: '香港六合彩'
    },
    {
        code: 'coming',
        name: '即将上线'
    },
];
var live = [{
        code: 'agin',
        name: 'AG国际厅'
    },
    {
        code: 'og',
        name: 'OG'
    },
    {
        code: 'ds',
        name: 'DS'
    },
];
var game = [{
        code: 'agGame',
        name: 'AG电子'
    },
    {
        code: 'agGameYo',
        name: 'YOPLAY'
    },
    {
        code: 'pt',
        name: 'PT电子'
    },
    {
        code: 'ag_mg',
        name: 'MG电子'
    },
];

// 首頁二級
function gamebox() {
    var lot_list = '',
        lothref = '/?r=mobile/lottery/webclose/index&type=',
        six_list = '',
        live_list = '',
        game_list = '',
        sport_list = '';

    for (var i = 0; i < lottery.length; i++) {
        if (lottery[i].code == 'coming' || lottery[i].code == 'upgrade') {
            lot_list += '<div class="card"><a>';
            lot_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/' + lottery[i].code + '.png" alt="">';
            lot_list += '</div><p>' + lottery[i].name + '</p></div></a></div>';
        } else {
            lot_list += '<div class="card"><a href="' + lothref + lottery[i].code + '">';
            lot_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/gamelist/gameicon/' + lottery[i].code + '.png" alt="">';
            lot_list += '</div><p>' + lottery[i].name + '</p></div></a></div>';
        }
    }
    for (var i = 0; i < six.length; i++) {
        if (six[i].code == 'coming' || six[i].code == 'upgrade') {
            six_list += '<div class="card"><a>';
            six_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/' + six[i].code + '.png" alt="">';
            six_list += '</div><p>' + six[i].name + '</p></div></a></div>';
        } else {
            six_list += '<div class="card"><a href="/?r=' + six[i].code + '/disp/index">';
            six_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/gamelist/gameicon/' + six[i].code + '.png" alt="">';
            six_list += '</div><p>' + six[i].name + '</p></div></a></div>';
        }
    }
    for (var i = 0; i < live.length; i++) {
        if (live[i].code == 'coming' || live[i].code == 'upgrade') {
            live_list += '<div class="card"><a>';
            live_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/' + live[i].code + '.png" alt="">';
            live_list += '</div><p>' + live[i].name + '</p></div></a></div>';
        } else {
            live_list += '<div class="card"><a onclick="javascript: if(loginCheck()){layer_savemoney(\'/?r=member/live/transport&type=' + live[i].code + '\');}">';
            live_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/gamelist/gameicon/' + live[i].code + '.png" alt="">';
            live_list += '</div><p>' + live[i].name + '</p></div></a></div>';
        }
    }
    for (var i = 0; i < game.length; i++) {
        if (game[i].code == 'coming' || game[i].code == 'upgrade') {
            game_list += '<div class="card"><a>';
            game_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/' + game[i].code + '.png" alt="">';
            game_list += '</div><p>' + game[i].name + '</p></div></a></div>';
        } else {
            game_list += '<div class="card"><a onclick="javascript: if(loginCheck()){layer_savemoney(\'/?r=member/live/transport&type=' + game[i].code + '\');}">';
            game_list += '<div class="cardinner"><div class="icon"><img src="/public/aomen/images/index/gamelist/gameicon/' + game[i].code + '.png" alt="">';
            game_list += '</div><p>' + game[i].name + '</p></div></a></div>';
        }
    }
    $('#tabLottery .tabbox').html(lot_list);
    $('#tabSix .tabbox').html(six_list);
    $('#tabLive .tabbox').html(live_list);
    $('#tabGame .tabbox').html(game_list);
}


// 游戏中心
function gamecenter() {
    var lot_list = '',
        lothref = '/?r=mobile/lottery/webclose/index&type=',
        six_list = '';
    for (var i = 0; i < lottery.length; i++) {
        if (lottery[i].code == 'coming' || lottery[i].code == 'upgrade') {

        } else if (lottery[i].code == '') {

        } else {
            lot_list += '<li class="subItem pt-3 pb-3"><a class="d-flex justify-content-between" href="' + lothref + lottery[i].code + '">';
            lot_list += '<div class="icon"><img src="/public/aomen/images/index/gamelist/gameicon/' + lottery[i].code + '.png"></div>';
            lot_list += ' <p class="text pt-4">' + lottery[i].name + '</p><div class="arrow"></div></a></li>';
        }
    }
    for (var i = 0; i < six.length; i++) {
        if (six[i].code == 'coming' || six[i].code == 'upgrade') {

        } else if (lottery[i].code == '') {

        } else {
            six_list += '<li class="subItem pt-3 pb-3"><a class="d-flex justify-content-between" href="/?r=' + six[i].code + '/disp/index">';
            six_list += '<div class="icon"><img src="/public/aomen/images/index/gamelist/gameicon/' + six[i].code + '.png"></div>';
            six_list += ' <p class="text pt-4">' + six[i].name + '</p><div class="arrow"></div></a></li>';
        }
    }
    $('#g_center_lottery ul').html(lot_list);
    $('#g_center_six ul').html(six_list);
}



var width = $(window).width(),
    windowWidth = width / 100 * 80 + 'px',
    spaceW = width / 100 * 10 + 'px',
    phone = location.search,
    phone_str = phone.split("/");

function play_game() {
    if (phone_str[0] === '?r=mobile') {
        $(".mobilePlayBtn").siblings(".webPlayBtn").css("display", "none");
        $(".mobilePlayBtn").css("display", "block");
    } else {
        $(".webPlayBtn").siblings(".mobilePlayBtn").css("display", "none");
        $(".webPlayBtn").css("display", "block");
    }
}

function layer_savemoney(live_url) {
    var loading = layer.open({
        type: 3,
    });
    $.ajax({
        async: true,
        url: live_url,
        success: function (data) {
            layer.close(loading);
            var title = 'background: linear-gradient(to bottom, #a77f41 0%, #5b3506 50%, #a77f41 100%);color:#fff;font-size:24px;';
            layer.open({
                title: ['快速转账', title],
                type: 1,
                shade: 0.5,
                content: data,
                area: ['80%', '400px'],
                skin: 'layui-m-layer-trans',
            });
            redreshChangeMoney();
            play_game();
        }
    });
}

// 立即游戏 function
function submitLive(live_id, uid) {
    if (isNaN(Number(live_id)) || isNaN(Number(uid))) {
        alert('参数类型错误');
        return false;
    } else if (uid === '' || uid <= 0) {
        alert('请先登录！');
        return false;
    }
    window.open("/?r=live/login/index&type=" + live_id, "_blank");
    return true;
}

// app 下载
function imgAlert(url) {
    layer.closeAll();
    layer.open({
        type: 1,
        className: 'imgAlert', //这样你就可以在css里面控制该弹层的风格了
        content: '<img src="' + url + '">',
        anim: 'up',
    })
}

// 公告彈窗
$(window).on('load', function () {
    var title = $('.phone-box .heading').text();
    var content = $('.layer-content').html();
    // var index = layer.open({
    //     type: 1,
    //     title: title,
    //     // title: '平台公告',
    //     content: content,
    //     move: false,
    //     area: ['600px', '1000px'],
    //     scrollbar: false,
    //     closeBtn: 1,
    //     anim: 5
    // });
    collapse();
})

function collapse() {
    $('#accordion .collapse').hide();
    $('#accordion .card:first-child .card').addClass('active');
    $('#accordion .card:first-child .collapse').show();
    $('#accordion .btn').click(function (event) {
        $('.card').removeClass('active');
        $(this).parents('.card').addClass('active');
        $(this).parents('.card-header').siblings('.collapse').slideDown();
        $(this).parents('.card').siblings().find('.collapse').slideUp();
    });
}

// 開啟非投不可
function ftbk() {
    window.location.href = "/?r=mobile/disp/ftbk"
}
