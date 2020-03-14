var bool = auto_new = false;
var sound_off = 0;
var fp = 0;
var un = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';

//限制只能输入1-9纯数字 
function digitOnly($this) {
    var n = $($this);
    var r = /^\+?[1-9][0-9]*$/;
    if (!r.test(n.val())) {
        n.val("");
    }
}

$(document).ready(function () {
    getLoginedInfo();
    $("#number").click();
    $('.tabinner').eq(0).show().siblings('.tabinner').hide();
    $('#tab .item').click(function () {
        $("form[name='orders']")[0].reset()
        removeBet();
        var tabinner = $(this).find('a').data('href');
        $(this).addClass('act').siblings().removeClass('act');
        $('.tabinnerArea').find(tabinner).show().siblings().hide();
    });
});

function reset() {
    document.orders.reset();

}

//盘口信息
function loadinfo() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if (data.kl8.opentime > 0 && nowTime > '09:00' && nowTime < '23:55') {
            $("#open_qihao").html(data.kl8.number);
            endtime(data.kl8.opentime);
            auto(1);
            if (un != 0) {
                clearInterval(un);
            }
            un = setInterval(updateOpenTime, 20000);
        } else if (!(nowTime > '09:00' && nowTime < '23:55')) {
            $('#tabinnerBet').html('' +
                '<div style="padding: 30px 10px 10px 10px; text-align: center; font-size: 26px;">' +
                '目前休盘，请等待下一期开盘。' +
                '</div>')
            auto();
            var today = new Date();
            Date.prototype.addDays = function (days) {
                var date = this.getDate() + days;
                return date;
            }
            var d = today.addDays(1);
            var m = today.getMonth();
            m += 1;
            var y = today.getFullYear();
            // $("#autoinfo").html(today.addDays(1))
            $(".tabLabel").html('' +
                '<div style="padding: 10px; text-align: center; font-size: 26px; width: 100%; display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;-webkit-box-align: end;-ms-flex-align: end;align-items: flex-end;">' +
                '<div class="open-label" style="font-size: 24px;">下次開盤時間: </div>' +
                '<div class="open-date" style="font-size: 36px; font-weight: bold;">' + y + "/" + m + "/" + d + '　' + '09:05' + '</div>' +
                '</div>')
        } else {
            is_fenpan = true;
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("<b style='display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;height: 100%;'>封盘</b>");
            $("#autoinfo").html("<div style='font-size: 20px; -webkit-box-align: center;-ms-flex-align: center;align-items: center;'>已经封盘，请稍后进行投注！</div>");
        }
    }, "json");
}

//时间校准
function updateOpenTime() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        clearTimeout(fp);
        endtime(data.kl8.opentime);
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
    var cqc_color = $('#cqc_time').css('color');
    $('#resultOpenTime').html(getIS(iTime));
    if (iTime < 0) {
        window.location.reload();
    } else {
        iTime--;
        if (iTime > 60) {
            $('#cqc_time').html(getIS(iTime - 60));
        }
        if (iTime < 120 && iTime > 0) {
            $('#cqc_time').html(getIS(iTime - 60));
            if (cqc_color != 'red') {
                $('#cqc_time').css('color', 'red');
            }
        }
        if (iTime <= 60 && iTime > 0) {
            $('#cqc_time').html(getIS(iTime));
            if (cqc_color != 'blue') {
                $('#cqc_time').css('color', '#006600');
                $('#cqc_text').html('距离开奖:');
            }
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("<b style='display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;height: 100%;'>封盘</b>");
        }
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}

//更新开奖号码
function auto(ball) {
    html = '';
    var res_str = '',
        res_str1 = '';
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if ($("#numbers").html() != data.kl8.numbers) {
            $('#numbers').html(data.kl8.numbers);
            for (var i = 0; i < data.kl8.hm.length; i++) {
                if (i < 10) {
                    res_str += '<li class="ballc_' + data.kl8.hm[i] + '">' + data.kl8.hm[i] + '</li>';
                } else {
                    res_str1 += '<li class="ballc_' + data.kl8.hm[i] + '">' + data.kl8.hm[i] + '</li>';
                }
            }
            $('#autoinfo_result').html(res_str + res_str1);
            $('#autoinfo1').html(res_str);
            $('#autoinfo2').html(res_str1);
            $('.label .lotteryResultBtn').css({
                'max-height': '50px',
                'margin-top': 'auto'
            });
            //   $('#autoinfo').html(res_str);

        }
        if ($("#open_qihao").html() - data.kl8.numbers != 1) {
            xhm = setTimeout("auto(1)", 20000);
        }
    }, "json");
}

//投注提交
function order() {
    var betjsonstr = "{";
    cou = m = 0, txt = '', c = true;
    for (var i = 1; i < 9; i++) {
        if (i == 1) {
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 2) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).prop("checked") == true) {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    alert("[选二]请选择" + i + "个号码!");
                    location.reload();
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 3) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).prop("checked") == true) {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    alert("[选三]请选择" + i + "个号码!");
                    location.reload();
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 4) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).prop("checked") == true) {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    alert("[选四]请选择" + i + "个号码!");
                    location.reload();
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 5) {
            var ck = 0;
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).prop("checked") == true) {
                    ck++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#kuaijiexiazhu_input").val()) + "\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    alert("[选五]请选择" + i + "个号码!");
                    location.reload();
                    return false;
                }
                var m = $("#kuaijiexiazhu_input").val();
                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                } else {
                    cou++;
                }
            }
        } else if (i == 6) {
            for (var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 7) {
            for (var s = 1; s < 4; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 8) {
            for (var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        }
    }

    betjsonstr = betjsonstr.substr(0, betjsonstr.length - 1);
    betjsonstr = betjsonstr + "}";

    if (cou <= 0) {
        layer.msg("请输入下注金额!!!", {
            icon: 0
        });
        return false;
    } else {
        $(".submit").attr("onclick", "");
    }
    var clickOne = 0;
    $.post("/?r=lottery/lzkl8/index/prepare-order", {
        data: betjsonstr
    }, function (data) {
        $(".submit").attr("onclick", "order();");
        if (data.status == false) {
            layer.alert(data.msg);
            return false;
        } else {
            //layer.confirm("共 ￥" + data.summoney + " / " + data.sumbetball + " 笔，确定下注吗？<br />下注明细如下：<br />" + data.ballmsg,
            layer.open({
                skin: 'layer_confirm',
                title: [''],
                area: ['90%', 'auto'],
                content: '共 ￥<span style="color:red;">' + data.summoney + '/ ' + data.sumbetball + ' </span>笔，确定下注吗？<br />下注明细如下：<br /><span style="color:red;">' + data.ballmsg + '</span>',
                btn: ['确认', '取消'],
                yes: function (index) {
                    document.orders.reset();
                    removeBet();
                    layer.close(index);
                    $.post("/?r=lottery/lzkl8/index/insert-order", {
                        data: betjsonstr
                    }, function (data) {
                        if (data.code == 10) {
                            layer.msg("操作成功。", {
                                icon: 1
                            });
                            $.post("/?r=mobile/index/json", {},
                                function (res) {
                                    if (res.name !== '') {
                                        $("#user_money").html(res.money);
                                    }
                                }, "json");
                            $('.chiplist li').removeClass('imgchk');
                            $('.bet-item .fontBlue').removeClass('selected-bet');
                        } else {
                            layer.msg("操作失败。", {
                                icon: 0
                            });
                            return false;
                            $('.chiplist li').removeClass('imgchk');
                            $('.bet-item .fontBlue').removeClass('selected-bet');
                        }
                    }, "json");
                },
                cancel: function (index) {
                    reset();
                    layer.close(index);
                }
            });
            // function (index) {
            //     if (clickOne == 0) {
            //         clickOne++;
            //     } else {
            //         return false;
            //     }
            //     document.orders.reset();
            //     removeBet();
            //     layer.close(index);
            //     $.post("/?r=lottery/lzkl8/index/insert-order", {
            //         data: betjsonstr
            //     }, function (data) {
            //         if (data.code == 10) {
            //             layer.msg("操作成功。", {
            //                 icon: 1
            //             });
            //             $.post("/?r=mobile/index/json", {},
            //                 function (res) {
            //                     if (res.name !== '') {
            //                         $("#user_money").html(res.money);
            //                     }
            //                 }, "json");
            //             $('.chiplist li').removeClass('imgchk');
            //             $('.bet-item .fontBlue').removeClass('selected-bet');
            //         } else {
            //             layer.msg("操作失败。", {
            //                 icon: 0
            //             });
            //             return false;
            //             $('.chiplist li').removeClass('imgchk');
            //             $('.bet-item .fontBlue').removeClass('selected-bet');
            //         }
            //     }, "json");
            // });
        }
    }, "json");
}

function getSwfId(id) { //与as3交互 跨浏览器
    if (navigator.appName.indexOf("Microsoft") != -1) {
        return window[id];
    } else {
        return document[id];
    }
}