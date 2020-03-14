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
    $('#tab .item').css('width', '29%');
    $('.tabinner').eq(0).show().siblings('.tabinner').hide();
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
        if (data.fc3d.opentime > 0) {
            $("#open_qihao").html(data.fc3d.number);
            endtime(data.fc3d.opentime);
            auto(1);
            if (un != 0) {
                clearInterval(un);
            }
            un = setInterval(updateOpenTime, 20000);
        } else {
            is_fenpan = true;
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("<b style='display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;height: 100%;'>封盘</b>");
            $("#autoinfo").html("已经封盘，请稍后进行投注！");
            $.jBox.alert('当前彩票已经封盘，请稍后再进行下注！<br><br>3D开盘时间为：每日00:00 - 20:00', '提示');
            return false;
        }
    }, "json");
}

//时间校准
function updateOpenTime() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        clearTimeout(fp);
        endtime(data.fc3d.opentime);
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
    if (iTime <= 0) {
    } else {
        iTime--;
        if (iTime > 1800) {
            $('#cqc_time').html(getIS(iTime - 1800));
            $('#resultOpenTime').html(getIS(iTime));
            if (cqc_color != 'red') {
                $('#cqc_time').css('color', 'red');
                if (iTime >= 61800) {
                    $('#cqc_time').css('font-size', '15px');
                } else {
                    $('#cqc_time').css('font-size', '20px');
                }
            }
        }
        if (iTime <= 1800 && iTime > 0) {
            $('#cqc_time').html(getIS(iTime));
            if (cqc_color != 'blue') {
                $('#cqc_time').css('color', '#006600');
                $('#cqc_text').html('距离开奖:');
            }
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("<b style='display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;height: 100%;'>封盘</b>");
        }
        $("#sss").html(iTime);
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}

//更新开奖号码
function auto(ball) {
    var res_str = '';
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        $("#numbers").html(data.fc3d.numbers);
        for (var i = 0; i < data.fc3d.hm.length; i++) {
            res_str += '<li class="ballc_' + data.fc3d.hm[i] + '">' + data.fc3d.hm[i] + '</li>';
        }
        $('#autoinfo').html(res_str);
    }, "json");
}

//投注提交
function order() {
    var betjsonstr = "{";
    cou = m = 0, txt = '', c = true;
    for (var i = 1; i < 10; i++) {
        if (i == 4) {
            for (var s = 1; s < 8; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 5) {
            for (var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else if (i == 6) {
            for (var s = 1; s < 11; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + parseInt($("#ball_" + i + "_" + s).val()) + "\",";
                }
            }
        } else {
            for (var s = 1; s < 15; s++) {
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
    $.post("/?r=lottery/lzfc3d/index/prepare-order", {
        data: betjsonstr,
        _csrf: csrfToken
    }, function (data) {
        $(".submit").attr("onclick", "order();");
        if (data.status == false) {
            layer.alert(data.msg);
            return false;
        } else {
            // layer.confirm("共 ￥" + data.summoney + " / " + data.sumbetball + " 笔，确定下注吗？<br />下注明细如下：<br />" + data.ballmsg,
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
                    $.post("/?r=lottery/lzfc3d/index/insert-order", {
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
            //     function(index){
            //         if(clickOne ==0){
            //             clickOne++;
            //         }else{
            //             return false;
            //         }
            //         document.orders.reset();removeBet();
            //         layer.close(index);
            //         $.post("/?r=lottery/lzfc3d/index/insert-order", {data: betjsonstr, _csrf: csrfToken}, function (data) {
            //             if (data.code == 10) {
            //                 layer.msg("操作成功。", {icon: 1});
            //                 $.post("/?r=mobile/index/json",{},
            //                      function(res){
            //                          if(res.name !== ''){
            //                              $("#user_money").html(res.money);
            //                          }
            //                      },"json");
            //                 $('#kuaijiexiazhu_input').val("");
            //                 $('.chiplist li').removeClass('imgchk');
            //                 $('.p-info ul li .selected-bet').removeClass('selected-bet')
            //                 $('.p-info ul li .selected-bet').next().next().children('input').val("");
            //             } else {
            //                 layer.msg("操作失败。", {icon: 0});
            //                 return false;
            //                 $('#kuaijiexiazhu_input').val("");
            //                 $('.chiplist li').removeClass('imgchk');
            //                 $('.p-info ul li .selected-bet').removeClass('selected-bet')
            //                 $('.p-info ul li .selected-bet').next().next().children('input').val("");
            //             }
            //         }, "json");
            //     });
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