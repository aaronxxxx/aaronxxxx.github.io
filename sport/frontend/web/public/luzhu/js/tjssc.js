var fp = un = 0;

//各彩种倒数时间
function fenpan() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        // cqssc(data.cqssc.fengpan, data.cqssc.opentime);
        // bjpk10(data.pk10.fengpan, data.pk10.opentime);
        orpk(data.orpk.fengpan, data.orpk.opentime);
        ssrc(data.ssrc.fengpan, data.ssrc.opentime);
        // mlaft(data.mlaft.fengpan, data.mlaft.opentime);
        // gxsfc(data.gxsf.fengpan, data.gxsf.opentime);
        // cqsfc(data.cqsfc.fengpan, data.cqsfc.opentime);
        // gd(data.gd11.fengpan, data.gd11.opentime);
        // gdsfc(data.gdsfc.fengpan, data.gdsfc.opentime);
        // tjsfc(data.tjsf.fengpan, data.tjsf.opentime);
        // shssl(data.shssl.fengpan, data.shssl.opentime);
        tjssc(data.tjssc.fengpan, data.tjssc.opentime);
        // ts5(data.ts5.fengpan, data.ts5.opentime);
        // bjkl8(data.kl8.fengpan, data.kl8.opentime);
        clearTimeout(fp);
        endtime(data.tjssc.opentime, data.tjssc.fengpan);
        if (data.tjssc.opentime > 30) {

        } else {
            clearInterval(un);
        }
        if ($("#prevGameNo").text() != data.tjssc.numbers) {
            twoside();
            dropmap();
            var html = '';
            for (var i = 0; i < data.tjssc.hm.length; i++) {
                html += '<span id="result' + data.tjssc.hm[i] + '" class="number num' + data.tjssc.hm[i] + '"></span>'
            }
            $(".numresult").html(html);
            $("#prevGameNo").html(data.tjssc.numbers);
        }
    }, "json");
}

//盘口信息
function loadinfo() {
    fenpan();
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if (data.tjssc.opentime > 0) {
            un = setInterval(fenpan, 3000);
            $("#currGameNo").html(data.tjssc.number);
            twoside();
            dropmap();
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
    $('#changlong').load('/?r=lottery/lztjssc/index/ajaxchanglong');
}

//露珠图异步刷新
$w = 1, $type = 1;

function dropmap() {
    if ($type == 1 && $("#count_isbig").hasClass('kon') || $type == 0 && $("#count_issingle").hasClass('kon')) {
        $('#lz_disp').load('/?r=lottery/lztjssc/index/order-list', {
            'w': $w,
            'tp': $type
        });
    }
}

//总和龙虎
$longhu = 1;

function longhumap() {
    $('#lz_disp').load('/?r=lottery/lztjssc/index/longhu', {
        'longhu': $longhu
    });
}

//单球露珠图
function luzhutu() {
    $('#lz_disp').load('/?r=lottery/lztjssc/index/luzhutu', {
        'w': $w,
        'tp': $type
    });
}

//露珠图切换
$(function () {
    $('.qiulei>a').click(function () {
        if ($(this).index() > 1 && $(this).index() < 7) {
            var index_of = $(this).index();
            var Arr1 = new Array("第一球大小", "第二球大小", "第三球大小", "第四球大小", "第五球大小");
            var Arr2 = new Array("第一球单双", "第二球单双", "第三球单双", "第四球单双", "第五球单双");
            var Arr3 = new Array("第一球开奖结果", "第二球开奖结果", "第三球开奖结果", "第四球开奖结果", "第五球开奖结果");
            $('#count_ball').hide();
            $('#which_ball').show();
            $('#ball_isbig').html(Arr1[index_of - 2]);
            $('#ball_issingle').html(Arr2[index_of - 2]);
            $('#ball_longhu').html(Arr3[index_of - 2]);
            $('#ball_isbig').addClass('kon').siblings().removeClass('kon');
            $type = 1;
            $w = index_of - 1;
            luzhutu();
        }
        if ($(this).index() < 2) {
            $('#count_ball').show();
            $('#which_ball').hide();
            $('#count_isbig').addClass('kon').siblings().removeClass('kon');
            $type = 1;
            dropmap();
        }
    })
});
$("#ball_isbig").live('click', function () {
    $(this).addClass('kon').siblings().removeClass('kon');
    $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
    $type = 1;
    luzhutu();
});
$("#ball_issingle").live('click', function () {
    $(this).addClass('kon').siblings().removeClass('kon');
    $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
    $type = 0;
    luzhutu();
});
$("#ball_longhu").live('click', function () {
    $(this).addClass('kon').siblings().removeClass('kon');
    $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
    $type = 2;
    luzhutu();
})

//投注提交
function order() {
    $('.btn-red').attr("disabled", true);
    var betjsonstr = "{";
    cou = m = 0, txt = '', c = true;
    for (var i = 1; i < 11; i++) {
        if (i == 6) {
            var money = 0
            for (var s = 1; s < 8; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                    money += parseInt($(this).val() * 1);
                });
                if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
                var money = 0;
            }
        } else if (i == 7 || i == 8 || i == 9) {
            var money = 0
            for (var s = 1; s < 6; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                    money += parseInt($(this).val() * 1);
                });
                if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
                var money = 0;
            }
        } else if (i == 10) {
            var money = 0
            for (var s = 1; s < 16; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                    money += parseInt($(this).val() * 1);
                });
                if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
                var money = 0;
            }
        } else {
            var money = 0
            for (var s = 1; s < 15; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                    money += parseInt($(this).val() * 1);
                });
                if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
                var money = 0;
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
    $.post("/?r=lottery/lztjssc/index/prepare-order", {
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
                    $.post("/?r=lottery/lztjssc/index/insert-order", {
                        data: betjsonstr
                    }, function (data) {
                        if (data.code == '10') {
                            layer.msg("操作成功", {
                                icon: 1
                            });
                            parent.window.ajaxlogin();
                            $('.selected-bet').removeClass('selected-bet');
                            $('.selectedinput').removeClass('selectedinput');
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