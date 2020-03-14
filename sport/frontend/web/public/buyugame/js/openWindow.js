function openWindowConvert(url, title) {
    openWindow(url, title, 843, 300);
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
}

// layer 網頁版彈窗
var width = $(window).width(),
    windowWidth = width / 100 * 40 + 'px',
    spaceW = width / 100 * 30 + 'px',
    phone = location.search,
    phone_str = phone.split("/");

function layer_savemoney(live_url) {
    //layer.closeAll();
    console.log(windowWidth , spaceW);
    var loading = layer.load(3, {
        shade: [0.5, '#000'] //0.1透明度的白色背景
    });
    $.ajax({
        async: true,
        url: live_url,
        success: function (data) {
            layer.close(loading);
            var css_file = 'text-align: center;cursor: pointer;background: linear-gradient(to bottom,#fafbfb,#dfdede);border-radius: 5px 5px 0 0;color: #000;height: 40px;line-height: 40px;font-size: 25px;padding:0;'; //標題欄的css
            layer.open({
                title: ['快速转账', css_file],
                type: 1,
                shade: 0.5,
                content: data,
                area: [windowWidth, '260px'],
                offset: ['100px',''],
                skin: 'l-all window_width' //可放class 
            });
            play_game();
            redreshChangeMoney();
        }
    });
}

function play_game() {
    if (phone_str[0] === '?r=mobile') {
        $(".mobilePlayBtn").siblings(".webPlayBtn").css("display", "none");
        $(".mobilePlayBtn").css("display", "block");
    } else {
        $(".webPlayBtn").siblings(".mobilePlayBtn").css("display", "none");
        $(".webPlayBtn").css("display", "block");
    }
}