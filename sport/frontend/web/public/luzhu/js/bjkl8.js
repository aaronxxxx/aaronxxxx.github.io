var fp = un = 0;

//各彩种倒数时间
function fenpan() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        cqssc(data.cqssc.fengpan, data.cqssc.opentime);
        bjpk10(data.pk10.fengpan, data.pk10.opentime);
        orpk(data.orpk.fengpan, data.orpk.opentime);
        ssrc(data.ssrc.fengpan, data.ssrc.opentime);
        mlaft(data.mlaft.fengpan, data.mlaft.opentime);
        gxsfc(data.gxsf.fengpan, data.gxsf.opentime);
        cqsfc(data.cqsfc.fengpan, data.cqsfc.opentime);
        gd(data.gd11.fengpan, data.gd11.opentime);
        gdsfc(data.gdsfc.fengpan, data.gdsfc.opentime);
        tjsfc(data.tjsf.fengpan, data.tjsf.opentime);
        shssl(data.shssl.fengpan, data.shssl.opentime);
        tjssc(data.tjssc.fengpan, data.tjssc.opentime);
        ts5(data.ts5.fengpan, data.ts5.opentime);
        bjkl8(data.kl8.fengpan, data.kl8.opentime);
        clearTimeout(fp);
        endtime(data.kl8.opentime, data.kl8.fengpan);
        if (data.kl8.opentime > 30) {

        } else {
            clearInterval(un);
        }
        if ($("#prevGameNo").text() != data.kl8.numbers) {
            twoside();
            dropmap();
            var html = '';
            for (var i = 0; i < data.kl8.hm.length; i++) {
                html += '<span id="result' + data.kl8.hm[i] + '" class="number num' + data.kl8.hm[i] + '"></span>'
            }
            $(".numresult").html(html);
            $("#prevGameNo").html(data.kl8.numbers);
        }
    }, "json");
}

//盘口信息
function loadinfo() {
    fenpan();
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if (data.kl8.opentime > 0 && nowTime > '09:00' && nowTime < '23:55') {
            un = setInterval(fenpan, 3000);
            $("#currGameNo").html(data.kl8.number);
            twoside();
            dropmap();
        } else if (!(nowTime > '09:00' && nowTime < '23:55')) {
            $('#html_content').append('<div class="mask"><div class="maskBox"><div class="maskImg"></div><span class="maskMsg">目前休盘，请期待下一盘</span><hr><span class="maskOpen">下此开奖时间：<span class="maskTime">次日09:05</span></span><div></div>');
        } else {
            $(".bet_odds").html("-");
            $(".amount").html("封盘");
            $("#autoinfo").html("已经封盘，请稍后进行投注！");
            return false;
        }
    }, "json");
}

//两面长龙
function twoside() {
    $('#changlong').load('/?r=lottery/lzkl8/index/ajaxchanglong');
}

//露珠图异步刷新
$w = 1, $type = 1;

function dropmap() {
    $('#lz_disp').load('/?r=lottery/lzkl8/index/order-list', {
        'w': $w,
        'tp': $type
    });
}

//投注提交
function order() {
    $('.btn-red').attr("disabled", true);
    var betjsonstr = "{";
    cou = m = 0, txt = '', c = true;
    for (var i = 1; i < 9; i++) {
        if (i == 1) {
            for (var s = 1; s < 81; s++) {
                if ($(".ball_" + i + "_" + s).val() != "" && $(".ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 2) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($(".ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    layer.alert("[选二]请选择" + i + "个号码!");
                    $('.btn-red').attr("disabled", false);
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    $('.btn-red').attr("disabled", false);
                    layer.alert('请填写下注金额!');
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 3) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($(".ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    layer.alert("[选三]请选择" + i + "个号码!");
                    $('.btn-red').attr("disabled", false);
                    return false;
                }

                var m = $("#kuaijiexiazhu_input").val();

                if (m == "" || m == null) {
                    layer.alert('请填写下注金额!');
                    $('.btn-red').attr("disabled", false);
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 4) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($(".ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    layer.alert("[选四]请选择" + i + "个号码!");
                    $('.btn-red').attr("disabled", false);
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    layer.alert('请填写下注金额!');
                    $('.btn-red').attr("disabled", false);
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 5) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    layer.alert("[选五]请选择" + i + "个号码!");
                    $('.btn-red').attr("disabled", false);
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    layer.alert('请填写下注金额!');
                    $('.btn-red').attr("disabled", false);
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 6) {
            for (var s = 1; s < 6; s++) {
                if ($(".ball_" + i + "_" + s).val() != "" && $(".ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($(".ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 7) {
            for (var s = 1; s < 4; s++) {
                if ($(".ball_" + i + "_" + s).val() != "" && $(".ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($(".ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 8) {
            for (var s = 1; s < 6; s++) {
                if ($(".ball_" + i + "_" + s).val() != "" && $(".ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($(".ball_" + i + "_" + s).val()) + "\",";
                }
            }
        }
    }

    betjsonstr = betjsonstr.substr(0, betjsonstr.length - 1);
    betjsonstr = betjsonstr + "}";

    if (cou <= 0) {
        $('.btn-red').attr("disabled", false);
        layer.alert('请输入下注金额!!!');
        return false;
    }
    $.post("/?r=lottery/lzkl8/index/prepare-order", {
        data: betjsonstr
    }, function (data) {
        $('.btn-red').attr("disabled", false);
        if (data.status == false) {
            layer.alert(data.msg);
            return false;
        } else {
            layer.confirm("共 ￥" + data.summoney + " / " + data.sumbetball + " 笔，确定下注吗？<br />下注明细如下：<br />" + data.ballmsg,
                function () {
                    layer.closeAll();
                    cq_cancel();
                    $.post("/?r=lottery/lzkl8/index/insert-order", {
                        data: betjsonstr
                    }, function (data) {
                        if (data.code == '10') {
                            layer.msg("操作成功", {
                                icon: 1
                            });
                            parent.window.ajaxlogin();
                            $('.selected-bet').removeClass('selected-bet');
                            $('.selectedinput').removeClass('selectedinput');
                            $('input').removeAttr("checked");
                        } else {
                            layer.msg("操作失败", {
                                icon: 0
                            });
                        }
                    }, "json");
                }
            )
        }
    }, 'json');
}