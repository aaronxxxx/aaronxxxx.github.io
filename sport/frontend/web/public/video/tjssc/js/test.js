$(document).ready(function () {
    function Auto() {
        $.get("../../../file/lottery.json?_=" + Math.random(), function (data) {
            var html = '';
            var Bs = '';
            var Ds = '';
            var totalNum = 0;
            for (var i = 0; i < data.tjssc.hm.length; i++) {
                html += '<div class="box beforebg"><span class="catch num' + data.tjssc.hm[i] + '"></span></div>'
            }
            $('#numBig').html(html);
            $('#litNum').html(html);
            for (var i = 0; i < data.tjssc.hm.length; i++) {
                Bs += '<div class="box perspectiveView"><span class="flip afterbg out" style="display: none;"></span><span class="flip ' + (data.tjssc.hm[i] >= 5 ? 'bigbg' : 'smallbg') + ' in"></span></div>'
            }
            $('.tl').html(Bs);
            for (var i = 0; i < data.tjssc.hm.length; i++) {
                Ds += '<div class="box perspectiveView"><span class="flip afterbg out" style="display: none;"></span><span class="flip ' + (data.tjssc.hm[i] % 2 == 0 ? 'doublebg' : 'singlebg') + ' in"></span></div>'
            }
            $('.bl').html(Ds);
            for (var i = 0; i < data.tjssc.hm.length; i++) {
                totalNum += parseInt(data.tjssc.hm[i]);
            };
            $('#qishu .qishu').html(data.tjssc.number);
            $('#preDrawIssue').html(data.tjssc.numbers);
            $('#sumNum').html(totalNum);
            $('#sumSingleDouble').html((totalNum % 2 == 0 ? '双' : '单'));
            $('#sumBigSmall').html((totalNum >= 23 ? '大' : '小'));
            if (parseInt(data.tjssc.hm[0]) > parseInt(data.tjssc.hm[4])) {
                $('#dragonTiger').html('龙')
            } else if (parseInt(data.tjssc.hm[0]) < parseInt(data.tjssc.hm[4])) {
                $('#dragonTiger').html('虎')
            } else {
                $('#dragonTiger').html('和')
            }
            if (data.tjssc.opentime > 0) {
                endtime(data.tjssc.opentime);
                un = setInterval(updateOpenTime, 20000);
                if (un != 0) {
                    clearInterval(un);
                }
            } else {
                return false;
            }
        },"json");
    }
    Auto();
})
//时间校准
function updateOpenTime() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        clearTimeout(fp);
        endtime(data.tjssc.opentime);
    }, "json");
}

function getIS(s) {
    var i = Math.floor(s / 60);
    if (i < 10)
        i = '0' + i;
    var ss = s % 60;
    if (ss < 10)
        ss = '0' + ss;
    return i + ":" + ss;
}

//封盘时间
function endtime(iTime) {
    var cqc_color = $('.bluefont').css('color');
    if (iTime < 0) {
        window.location.reload();
        // (FlipClock) 小於 0 以 0 計
        clock = $("[data-flipclock]").FlipClock(0, {
            clockFace: "MinuteCounter",
            countdown: true,
            autostart: false
        });

    } else {
        iTime--;
        if (iTime > 18) {
            $('.bluefont').html(getIS(iTime - 18));

            clock = $("[data-flipclock]").FlipClock(iTime, {
              clockFace: "MinuteCounter",
              countdown: true,
            });

        }
        if (iTime < 48 && iTime > 0) {
            $('.bluefont').html(getIS(iTime - 18));
            if (cqc_color != 'red') {
                $('.bluefont').css('color', 'red');
            }
            
            clock = $("[data-flipclock]").FlipClock(iTime, {
                clockFace: "MinuteCounter",
                countdown: true,
            });

        }
        if (iTime <= 18 && iTime > 0) {
            $('.bluefont').html(getIS(iTime));
            if (cqc_color != 'blue') {
                $('.bluefont').css('color', '#006600');
            }

            clock = $("[data-flipclock]").FlipClock(iTime, {
                clockFace: "MinuteCounter",
                countdown: true,
            });

        }
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}