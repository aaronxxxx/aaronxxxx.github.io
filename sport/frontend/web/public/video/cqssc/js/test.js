$(document).ready(function () {
    function Auto() {
        $.get("../../../file/lottery.json?_=" + Math.random(), function (data) {
            var html = '';
            var Bs = '';
            var Ds = '';
            var totalNum = 0;
            for (var i = 0; i < data.cqssc.hm.length; i++) {
                html += '<div class="box beforebg"><span class="catch num' + data.cqssc.hm[i] + '"></span></div>'
            }
            $('#numBig').html(html);
            $('#litNum').html(html);
            for (var i = 0; i < data.cqssc.hm.length; i++) {
                Bs += '<div class="box perspectiveView"><span class="flip afterbg out" style="display: none;"></span><span class="flip ' + (data.cqssc.hm[i] >= 5 ? 'bigbg' : 'smallbg') + ' in"></span></div>'
            }
            $('.tl').html(Bs);
            for (var i = 0; i < data.cqssc.hm.length; i++) {
                Ds += '<div class="box perspectiveView"><span class="flip afterbg out" style="display: none;"></span><span class="flip ' + (data.cqssc.hm[i] % 2 == 0 ? 'doublebg' : 'singlebg') + ' in"></span></div>'
            }
            $('.bl').html(Ds);
            for (var i = 0; i < data.cqssc.hm.length; i++) {
                totalNum += parseInt(data.cqssc.hm[i]);
            };
            $('#preDrawIssue').html(data.cqssc.numbers);
            $('#sumNum').html(totalNum);
            $('#sumSingleDouble').html((totalNum % 2 == 0 ? '双' : '单'));
            $('#sumBigSmall').html((totalNum >= 23 ? '大' : '小'));
            if (parseInt(data.cqssc.hm[0]) > parseInt(data.cqssc.hm[4])) {
                $('#dragonTiger').html('龙')
            } else if (parseInt(data.cqssc.hm[0]) < parseInt(data.cqssc.hm[4])) {
                $('#dragonTiger').html('虎')
            } else {
                $('#dragonTiger').html('和')
            }
            if (data.cqssc.opentime > 0) {
                endtime(data.cqssc.opentime);
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
        endtime(data.cqssc.opentime);
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
    } else {
        iTime--;
        if (iTime > 18) {
            $('.bluefont').html(getIS(iTime - 18));
        }
        if (iTime < 48 && iTime > 0) {
            $('.bluefont').html(getIS(iTime - 18));
            if (cqc_color != 'red') {
                $('.bluefont').css('color', 'red');
            }
        }
        if (iTime <= 18 && iTime > 0) {
            $('.bluefont').html(getIS(iTime));
            if (cqc_color != 'blue') {
                $('.bluefont').css('color', '#006600');
            }
        }
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}