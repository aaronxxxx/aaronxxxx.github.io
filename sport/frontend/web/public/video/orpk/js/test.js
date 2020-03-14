$(document).ready(function () {
    function Auto() {
        $.get("../../../file/lottery.json?_=" + Math.random(), function (data) {
            $('#an-btn3').attr("onclick","finishgame("+'"'+data.orpk.hm[0]+','+data.orpk.hm[1]+','+data.orpk.hm[2]+','+data.orpk.hm[3]+','+data.orpk.hm[4]+','+data.orpk.hm[5]+','+data.orpk.hm[6]+','+data.orpk.hm[7]+','+data.orpk.hm[8]+','+data.orpk.hm[9]+'"'+")");
            $('#nextdrawtime').html(data.orpk.numbers);
            $('#stat1_1').html(parseInt(data.orpk.hm[0]) + parseInt(data.orpk.hm[1]));
            $('#stat1_2').html((parseInt(data.orpk.hm[0]) + parseInt(data.orpk.hm[1])) > 11 ? '大' : '小');
            $('#stat1_3').html((parseInt(data.orpk.hm[0]) + parseInt(data.orpk.hm[1])) % 2 == 0 ? '双' : '单');
            $('#stat2_1').html(parseInt(data.orpk.hm[0]) > parseInt(data.orpk.hm[9]) ? '龙' : '虎');
            $('#stat2_2').html(parseInt(data.orpk.hm[1]) > parseInt(data.orpk.hm[8]) ? '龙' : '虎');
            $('#stat2_3').html(parseInt(data.orpk.hm[2]) > parseInt(data.orpk.hm[7]) ? '龙' : '虎');
            $('#stat2_4').html(parseInt(data.orpk.hm[3]) > parseInt(data.orpk.hm[6]) ? '龙' : '虎');
            $('#stat2_5').html(parseInt(data.orpk.hm[4]) > parseInt(data.orpk.hm[5]) ? '龙' : '虎');
            if (data.orpk.opentime > 0) {
                $('#an-btn3').click();
                endtime(data.orpk.opentime);
                un = setInterval(updateOpenTime, 20000);
                if (un != 0) {
                    clearInterval(un);
                }
            } else {
                $('#an-btn1').click();
            }
        },"json");
    }
    Auto();
})
//时间校准
function updateOpenTime() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        clearTimeout(fp);
        endtime(data.orpk.opentime);
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