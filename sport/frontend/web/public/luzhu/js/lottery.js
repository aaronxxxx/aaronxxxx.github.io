var pl3_time = fc3d_time = gxsfc_time = bjkl8_time = shssl_time = gd_time = gdsfc_time = tjsfc_time = cqsfc_time = cqssc_time = bjpk10_time = orpk_time = ssrc_time = mlaft_time = tjssc_time = ts5_time = 0;

$(function () {
    //只能输入数字
    $(".bet-content input[type='text']").keydown(function () {
        var e = $(this).event || window.event;
        var code = parseInt(e.keyCode);
        if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8) {
            return true;
        } else {
            return false;
        }
    });

    //第几球
    $('.qiulei a').click(function () {
        if ($(this).hasClass('on')) {
            return false;
        } else {
            $('.selected-bet').parent('.bet-item').find("input[type='text']").val('');
            $('.selected-bet').removeClass('selected-bet');
            $(this).addClass('on').siblings().removeClass('on');
        }
        var name = $(".qiulei a.on").html();
        $("#panname").html(name); //当前选中的第几球赋值

        $('.zhongleitab').eq($(this).index()).show().siblings('.zhongleitab').hide();
        $('.zhongleitab').eq($(this).index()).siblings('.zhongleitab').find('.inp1[type="checkbox"]:checked').attr("checked", false);
        $('.zhongleitab').eq($(this).index()).siblings('.zhongleitab').find('.amount-input').removeClass("selectedinput").val("");
        $('.luzhuct').eq($(this).index()).show().siblings('.luzhuct').hide();

    })
    //快捷金额图片选中添加
    // $('.chiplist li').click(function () {
    //     $(this).addClass('imgchk').siblings().removeClass('imgchk');
    // });
    //露珠图切换
    $("#count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图切广东11选5
    $("#gd11x5_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#gd11x5_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#gd11x5_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图极速时时彩
    $("#tjssc_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#tjssc_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#tjssc_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图重庆快乐十分
    $("#cqklsf_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#cqklsf_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#cqklsf_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图广东快乐十分
    $("#gdklsf_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#gdklsf_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#gdklsf_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图天津快乐十分
    $("#tjklsf_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#tjklsf_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#tjklsf_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图上海时时乐
    $("#shssl_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#shssl_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#shssl_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })
    //露珠图江西十分彩
    $("#gxsf_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#gxsf_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });
    $("#gxsf_longhu").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $longhu = 1;
        longhumap();
    })

    //露珠图北京快乐8
    $("#bjkl8_count_isbig").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 1;
        dropmap();
    });
    $("#bjkl8_count_issingle").click(function () {
        $(this).addClass('kon').siblings().removeClass('kon');
        $(this).parents(".luzhuct").find(".luzhusan").eq($(this).index()).show().siblings('.luzhusan').hide();
        $type = 0;
        dropmap();
    });

    $('.zhongleitab .bet-item').click(function () {
        var flaseORtrue = $(this).find(".amount-input").is(':focus');
        if (!flaseORtrue) {
            var money = $('#kuaijiexiazhu_input').val();
            $(this).find(".amount-input").val(money);
            $(this).find(".fontBlue").toggleClass("selected-bet");
            $(this).find(".bet_odds").toggleClass("selected-bet");
            if ($(this).children('.selected-bet').length == 0) {
                $(this).find("input[type='text']").val('');
            }
            $(this).find(".amount-input").toggleClass("selectedinput");
            if ($(this).find('.selected-bet').length > 0) {
                $(this).find(".inp1[type='checkbox']").attr("checked", true);
            } else {
                $(this).find(".inp1[type='checkbox']").attr("checked", false);
            }
        }
    });
    $('.zhongleitab .bet-item').hover(function () {
        $(this).addClass('hovercolor');
    }, function () {
        $(this).removeClass('hovercolor');
    });
    $(".amount-input").keyup(function () {
        this.value = this.value.replace(/[^\d.]/g, "");
        this.value = this.value.replace(/^\./g, "");
        this.value = this.value.replace(/\.{2,}/g, ".");
        this.value = this.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    })

    //1-4 5-8切换
    $('.danqiu li').click(function () {
        $(this).addClass('dn').siblings().removeClass('dn');
        $('.danqiuct').eq($(this).index()).show().siblings('.danqiuct').hide();
    })
    $('.layui-layer-btn0').live('click', function () {
        $(this).off('click');
    })
});

function set_money(set_money) {
    var input_money = $('#kuaijiexiazhu_input').val();
    if (input_money == '' || input_money == 'undefined') {
        input_money = "0";
    };
    $('#kuaijiexiazhu_input').val(set_money + +input_money);
    on_input();
    $('#Text1').val(set_money + +input_money);
};

function on_input() {
    var oninput_num = $('#kuaijiexiazhu_input').val();
    $('.selectedinput').val(oninput_num);
    $('#Text1').val(oninput_num);
}

function text_val(val) {
    val.value = val.value.replace(/[^\d.]/g, "");
    val.value = val.value.replace(/^\./g, "");
    val.value = val.value.replace(/\.{2,}/g, ".");
    val.value = val.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
    var ipnut_var = $(val).val();
    $('#kuaijiexiazhu_input').val(ipnut_var);
    $('.selectedinput').val(ipnut_var);
}
//==================================  华丽的分割线   =============================
function getIS(s) {
    var i = Math.floor(s / 60);
    if (i < 10)
        i = '0' + i;
    var ss = s % 60;
    if (ss < 10)
        ss = '0' + ss;
    return i + ":" + ss;
}
/**
 * 打开用户中心窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @returns {}
 */
function openUCWindow(url, title) {
    openWindow(url, title, 1020, 570);
}

function cq_cancel() {
    $('.amount-input').val("");
    $('#kuaijiexiazhu_input').val("");
    $('#Text1').val("");
    $('.selected-bet').removeClass('selected-bet');
    $(".inp1[type='checkbox']").attr("checked", false);
    $('.selectedinput').removeClass('selectedinput');
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
//限制只能输入1-9纯数字
function digitOnly($this) {
    var n = $($this);
    var r = /^\+?[1-9][0-9]*$/;
    if (!r.test(n.val())) {
        n.val("");
    }
}
//lottery_type 防止重复读秒
function fc3d(fengpan, kaijiang) {
    if (fc3d_time != 0) {
        clearTimeout(fc3d_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#fc3d').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#fc3d").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(fc3d_time);
        //fenpan();
    } else {
        kaijiang--;
        fc3d_time = setTimeout("fc3d(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function pl3(fengpan, kaijiang) {
    if (pl3_time != 0) {
        clearTimeout(pl3_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#pl3').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#pl3").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(pl3_time);
        //fenpan();
    } else {
        kaijiang--;
        pl3_time = setTimeout("pl3(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function cqssc(fengpan, kaijiang) {
    if (cqssc_time != 0) {
        clearTimeout(cqssc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#cqssc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#cqssc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(cqssc_time);
        //fenpan();
    } else {
        kaijiang--;
        cqssc_time = setTimeout("cqssc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function bjpk10(fengpan, kaijiang) {
    if (bjpk10_time != 0) {
        clearTimeout(bjpk10_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#bjpk10').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#bjpk10").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(bjpk10_time);
        //fenpan();
    } else {
        kaijiang--;
        bjpk10_time = setTimeout("bjpk10(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function orpk(fengpan, kaijiang) {
    if (orpk_time != 0) {
        clearTimeout(orpk_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#orpk').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#orpk").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(orpk_time);
        //fenpan();
    } else {
        kaijiang--;
        orpk_time = setTimeout("orpk(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function ssrc(fengpan, kaijiang) {
    if (ssrc_time != 0) {
        clearTimeout(ssrc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#ssrc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#ssrc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(ssrc_time);
        //fenpan();
    } else {
        kaijiang--;
        ssrc_time = setTimeout("ssrc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function mlaft(fengpan, kaijiang) {
    if (mlaft_time != 0) {
        clearTimeout(mlaft_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#mlaft').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#mlaft").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(mlaft_time);
        //fenpan();
    } else {
        kaijiang--;
        mlaft_time = setTimeout("mlaft(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function gxsfc(fengpan, kaijiang) {
    if (gxsfc_time != 0) {
        clearTimeout(gxsfc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#gxsfc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#gxsfc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(gxsfc_time);
        //fenpan();
    } else {
        kaijiang--;
        gxsfc_time = setTimeout("gxsfc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function cqsfc(fengpan, kaijiang) {
    if (cqsfc_time != 0) {
        clearTimeout(cqsfc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#cqsfc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#cqsfc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(cqsfc_time);
        //fenpan();
    } else {
        kaijiang--;
        cqsfc_time = setTimeout("cqsfc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function gd(fengpan, kaijiang) {
    if (gd_time != 0) {
        clearTimeout(gd_time);
    }
    if (fengpan > 0) {
        fengpan--;
        //$('#gdsfc').html(getIS(fengpan));
        $('#gd11x5').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        //$("#gdsfc").html("封盘");
        $("#gd11x5").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(gd_time);
        //fenpan();
    } else {
        kaijiang--;
        gd_time = setTimeout("gd(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function gdsfc(fengpan, kaijiang) {
    if (gdsfc_time != 0) {
        clearTimeout(gdsfc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#gdsfc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#gdsfc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(gdsfc_time);
        //fenpan();
    } else {
        kaijiang--;
        gdsfc_time = setTimeout("gdsfc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function tjsfc(fengpan, kaijiang) {
    if (tjsfc_time != 0) {
        clearTimeout(tjsfc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#tjsfc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#tjsfc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(tjsfc_time);
        //fenpan();
    } else {
        kaijiang--;
        tjsfc_time = setTimeout("tjsfc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function bjkl8(fengpan, kaijiang) {
    if (bjkl8_time != 0) {
        clearTimeout(bjkl8_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#bjkl8').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#bjkl8").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(bjkl8_time);
        //fenpan();
    } else {
        kaijiang--;
        bjkl8_time = setTimeout("bjkl8(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function shssl(fengpan, kaijiang) {
    if (shssl_time != 0) {
        clearTimeout(shssl_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#shssl').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#shssl").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(shssl_time);
        //fenpan();
    } else {
        kaijiang--;
        shssl_time = setTimeout("shssl(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function tjssc(fengpan, kaijiang) {
    if (tjssc_time != 0) {
        clearTimeout(tjssc_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#tjssc').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#tjssc").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(tjssc_time);
        //fenpan();
    } else {
        kaijiang--;
        tjssc_time = setTimeout("tjssc(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

function ts5(fengpan, kaijiang) {
    if (ts5_time != 0) {
        clearTimeout(ts5_time);
    }
    if (fengpan > 0) {
        fengpan--;
        $('#ts5').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $("#ts5").html("封盘");
    }
    if (kaijiang < 0 && kaijiang > -50) {
        clearTimeout(ts5_time);
        //fenpan();
    } else {
        kaijiang--;
        ts5_time = setTimeout("ts5(" + fengpan + " ," + kaijiang + ")", 1000);
    }
}

//封盘时间
function endtime(iTime, fengpan) {
    if (fengpan > 0) {
        fengpan--;
        $('#freezeTime').html(getIS(fengpan));
    }
    if (fengpan == 0 || fengpan < 0) {
        $(".bet_odds").html("-");
        $(".amount").html("封盘");
    }
    if (iTime < 0 && iTime > -50) {
        window.location.reload();
    } else {
        iTime--;
        if (iTime > 0) {
            $('#dealingTime').html(getIS(iTime));
        }
        fp = setTimeout("endtime(" + iTime + " ," + fengpan + ")", 1000);
    }
}

//当前时间
function p(s) {
    return s < 10 ? '0' + s : s;
}
var myDate = new Date();
var h = myDate.getHours(); //获取当前小时数(0-23)
var m = myDate.getMinutes(); //获取当前分钟数(0-59)
var s = myDate.getSeconds();
var nowTime = p(h) + ':' + p(m) + ":" + p(s);