var bool = auto_new = false;
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
    $('#tab .item4').css('width', '23%');
    $('#tab .item').click(function () {
        removeBet();
        var tabinner = $(this).find('a').data('href');
        $(this).addClass('act').siblings().removeClass('act');
        $('.tabinnerArea').find(tabinner).show().siblings().hide();
    });
});

function reset() {
    document.orders.reset();
    removeBet()
}

//盘口信息
function loadinfo() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if (data.gdsfc.opentime > 0 && nowTime > '08:40' && nowTime < '23:00') {
            $("#open_qihao").html(data.gdsfc.number);
            endtime(data.gdsfc.opentime);
            auto(1);
            if (un != 0) {
                clearInterval(un);
            }
            un = setInterval(updateOpenTime, 20000);
        } else if (!(nowTime > '08:40' && nowTime < '23:00')) {
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
                '<div class="open-date" style="font-size: 36px; font-weight: bold;">' + y + "/" + m + "/" + d + '　' + '09:00' + '</div>' +
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
        endtime(data.gdsfc.opentime);
    }, "json");
}

//封盘时间
function getIS(s) {
    var i = Math.floor(s / 60);
    if (i < 10)
        i = '0' + i;
    var ss = s % 60;
    if (ss < 10)
        ss = '0' + ss;
    return i + ":" + ss;
}

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
    var res_str = '';
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if ($("#numbers").html() != data.gdsfc.numbers) {
            $("#numbers").html(data.gdsfc.numbers);
            for (var i = 0; i < data.gdsfc.hm.length; i++) {
                res_str += '<li class="ballc_' + data.gdsfc.hm[i] + '">' + data.gdsfc.hm[i] + '</li>';
            }
            $('#autoinfo').html(res_str);
        }
        if ($("#open_qihao").html() - data.gdsfc.numbers != 1) {
            xhm = setTimeout("auto(1)", 10000);
        }
    }, "json");
}

//投注提交
function order() {
    var betjsonstr = "{";
    cou = m = 0, txt = '', c = true;

    for (var i = 1; i < 10; i++) {
        if (i == 9) {
            for (var s = 1; s < 9; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else {
            for (var s = 1; s < 36; s++) {
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
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.post("/?r=lottery/lzgdsf/index/prepare-order", {
        data: betjsonstr,
        _csrf: csrfToken
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
                    $.post("/?r=lottery/lzgdsf/index/insert-order", {
                        data: betjsonstr,
                        _csrf: csrfToken
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
                            $('#kuaijiexiazhu_input').val("");
                            $('.chiplist li').removeClass('imgchk');
                            $('.p-info ul li .selected-bet').removeClass('selected-bet')
                            $('.p-info ul li .selected-bet').next().next().children('input').val("");
                        } else {
                            layer.msg("操作失败。", {
                                icon: 0
                            });
                            return false;
                            $('#kuaijiexiazhu_input').val("");
                            $('.chiplist li').removeClass('imgchk');
                            $('.p-info ul li .selected-bet').removeClass('selected-bet')
                            $('.p-info ul li .selected-bet').next().next().children('input').val("");
                        }
                    }, "json");
                },
                cancel: function (index) {
                    reset();
                    layer.close(index);
                }
            });

            // function(index){
            //     if(clickOne ==0){
            //         clickOne++;
            //     }else{
            //         return false;
            //     }
            //     document.orders.reset();removeBet();
            //     layer.close(index);
            //     $.post("/?r=lottery/lzgdsf/index/insert-order", {data: betjsonstr, _csrf: csrfToken}, function (data) {
            //         if (data.code == 10) {
            //             layer.msg("操作成功。", {icon: 1});
            //             $.post("/?r=mobile/index/json",{},
            //                  function(res){
            //                      if(res.name !== ''){
            //                          $("#user_money").html(res.money);
            //                      }
            //                  },"json");
            //             $('#kuaijiexiazhu_input').val("");
            //             $('.chiplist li').removeClass('imgchk');
            //             $('.p-info ul li .selected-bet').removeClass('selected-bet')
            //             $('.p-info ul li .selected-bet').next().next().children('input').val("");
            //         } else {
            //             layer.msg("操作失败。", {icon: 0});
            //             return false;
            //             $('#kuaijiexiazhu_input').val("");
            //             $('.chiplist li').removeClass('imgchk');
            //             $('.p-info ul li .selected-bet').removeClass('selected-bet')
            //             $('.p-info ul li .selected-bet').next().next().children('input').val("");
            //         }
            //     }, "json");
            // });
        }

    }, "json");
}