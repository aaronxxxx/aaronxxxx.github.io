function handleOrientationChange(e) {
    window.location.reload()
}

function excutenum() {
    return Math.floor(10 * Math.random())
}

function loadoverpage() {
    var e = localStorage.getItem("overpage");
    if (null == e) return !1;
    0 == $("#sortable").length ? $(".headTitle #" + e).click() : $("#sortable #" + e).click()
}
var animate = {},
    tools = {},
    intervalSsc = null,
    animateID = {},
    pubmethod = {},
    publicHeadOrf = {},
    title = $("title").text(),
    strTitle = title.split("-")[0];
$(function () {
    tools.loadCZ();
    var e = new Date;
    setInterval(function () {
        Math.abs(new Date - e) > 1e4 && (config.ifdebug || window.location.reload()), e = new Date
    }, 1e3), setTimeout(function () {
        config.ifFirstLoad = !0
    }, 3e3)
}), window.onload = function () {
    loadoverpage()
};
var mql = window.matchMedia("(orientation: portrait)");
mql.addListener(handleOrientationChange);
var indexObj = {};
indexObj.YM = function () {
    var e = window.location.href,
        t = e = e.split("//")[1].split("/")[0].split(".");
    "www" == t[0] ? "m" == (e = t[1]) && (e = t[2]) : "www" != t[0] && "m" == (e = t[0]) && (e = t[1]);
    var i = window.location.hostname.split("."),
        a = i[i.length - 1];
    return "192" == e && (e = "1680218", a = "com"), e + "." + a
}, $("#headdivbox").load("../layout/head.html", function () {
    $("#beginTime").dateTools();
    var e = new Date;
    $("#yearmothnday").val(e.getFullYear()), $("#showtime").text((e.getMonth() + 1 < 10 ? "0" + (e.getMonth() + 1) : e.getMonth() + 1) + "月" + e.getDate() + "日"), $("#headdivbox #caizhong_name").find("span").html(strTitle + "<i></i>")
}), $("#footerDiv").load("../layout/footer.html", function () {
    "" != window.location.search && ($("#aboutMess #headdivbox #titlespan").text(strTitle).find("i").css("display", "none"), $("#aboutMess #headdivbox").find(".top_menu_more").css("display", "none"))
}), animate.loadingList = function (e, t) {
    t ? ($(e).find("#loadingbox").remove(), $(e).find("div").eq(0).before('<div id="loadingbox">Loading...</div>'), $("#loadingbox").stop().animate({
        height: "0.2rem"
    }, 500)) : setTimeout(function () {
        $("#loadingbox").stop().animate({
            height: "0"
        }, 500)
    }, 500)
}, animate.pk10OpenAnimate = function (e) {
    var t = 600;
    $(e).find(".numberbox li");
    $(e).find(".cuttime").hide(), $(e).find(".opentyle").show(), intervalPk10 = setInterval(function () {
        var i = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            a = [];
        t--;
        for (var n = 0; n < 10; n++) {
            var s = Math.floor(Math.random() * i.length);
            a[n] = i[s], i.splice(s, 1)
        }
        for (var o = "", r = 0; r < 10; r++) {
            var l = a[r] < 10 ? "nub0" + a[r] : "nub" + a[r];
            o += 9 == r ? "<li style='margin-right: 0px;' class='li_after " + l + "'></li>" : "<li class='" + l + "'></li>"
        }
        $(e).find(".numberbox").empty(), $(e).find(".numberbox").append(o)
    }, 100), animateID[e] = intervalPk10
}, animate.pk10AnimateEnd = function (e, t) {
    var t = t,
        i = (e = e).length,
        a = 0,
        n = $(t).find(".numberbox");
    $(n).empty();
    var s = setInterval(function () {
        var t = "";
        if (a < i) {
            a == i - 1 && (t = "li_after");
            var o = "<li class='nub" + e[a] + " " + t + "'><i style='font-size:10px; display:none'>" + e[a] + "</i></li>";
            $(n).append(o), a += 1
        } else clearInterval(s)
    }, 100);
    $(t).find(".opentyle").hide(), $(t).find(".cuttime").show()
}, animate.sscAnimate = function (e) {
    var t = 600;
    $(e).find(".opentyle").show(), $(e).find(".cuttime").hide(), intervalSsc = setInterval(function () {
        var i = $(e).find(".sscli li");
        $(e).find(".sscli li:last-child").css({
            "margin-right": "0"
        });
        var a = i.length;
        t--;
        for (var n = 0; n < a; n++) {
            $(e).find("li").eq(n).css({
                paddingTop: "0"
            }), $(e).find("li").eq(n).css({
                lineHeight: "0"
            }), $(e).find("li").eq(n).text(excutenum());
            var s = 50 * excutenum();
            $(e).find("li").eq(n).stop().animate({
                paddingTop: "0.15rem"
            }, s), $(e).find("li").eq(n).stop().animate({
                lineHeight: "0.45rem"
            }, 100)
        }
    }, 100), animateID[e] = intervalSsc, config.ifdebug && console.log("动画ID" + JSON.stringify(animateID[e]))
}, animate.sscAnimateEnd = function (e, t) {
    for (var i = 0, a = e.length; i < a; i++) {
        i < e.length && $(t).find("#pk10num").find("li:last-child").css({
            "margin-right": "0"
        }), $(t).find("li").eq(i).css({
            paddingTop: "0px"
        }), $(t).find("li").eq(i).text(e[i]);
        var n = 50 * excutenum();
        $(t).find("li").eq(i).stop().animate({
            lineHeight: "0.25rem"
        }, n)
    }
    $(t).find(".opentyle").hide(), $(t).find(".cuttime").show()
}, animate.kuai3Animate = function (e) {
    var t = 600;
    $(e).find(".opentyle").show(), $(e).find(".cuttime").hide(), intervalSsc = setInterval(function () {
        t--;
        for (var i = 0, a = $(e).find(".numberbox li").length; i < a; i++) {
            var n = tools.excutenum1_6();
            $(e).find(".numberbox li").eq(i).className = "num" + 1 * n + 1;
            var s = 1 * n,
                o = tools.kuaicase(1 * tools.excutenum1_6() + 1);
            $(e).find(".numberbox li").eq(i).stop().animate({
                backgroundPositionY: o
            }, s)
        }
    }, 100), animateID[e] = intervalSsc
}, animate.kuai3AnimateEnd = function (e, t) {
    for (var i = 0, a = e.length; i < a; i++) {
        $(t).find(".numberbox li").eq(i).css({
            paddingTop: "0px"
        }), $(t).find(".numberbox li")[i].className = "num" + e[i], $($(t).find(".numberbox li")[i]).css({
            "background-position-y": ""
        });
        var n = 50 * excutenum();
        $(t).find(".numberbox li").eq(i).stop().animate({
            lineHeight: "36px"
        }, n)
    }
    $(t).find(".opentyle").hide(), $(t).find(".cuttime").show()
}, animate.cqncAnimate = function (e) {
    var t = 600,
        i = $(e).find(".numberbox");
    $(".opening").show(), $(".clock").hide(), intervalSsc = setInterval(function () {
        var e = [1, 2, 3, 4, 5, 6, 7, 8],
            a = [];
        t--;
        for (var n = 0; n < 10; n++) {
            var s = Math.floor(Math.random() * e.length);
            a[n] = e[s], e.splice(s, 1)
        }
        for (var o = "", r = 0; r < 10; r++) o += "<li class='ncnum0" + a[r] + "'></li>";
        $(i).empty(), $(i).append(o), 100 == t && $("#waringbox").show(300)
    }, 100), animateID[e] = intervalSsc
}, animate.cqncAnimateEnd = function (e, t) {
    var t = t,
        i = e.length,
        a = 0,
        n = $(t).find(".numberbox");
    $(n).html("");
    var s = setInterval(function () {
        if (a < i) {
            var t = "<li class='ncnum" + e[a] + "'><i style='font-size:10px;display:none'>" + e[a] + "</i></li>";
            $(n).append(t), a++
        } else clearInterval(s)
    }, 100);
    $(t).find(".opentyle").hide(), $(t).find(".cuttime").show()
}, tools.excutenum1_6 = function () {
    return Math.floor(6 * Math.random())
}, tools.kuaicase = function (e) {
    switch (e) {
        case 1:
            return "0px";
        case 2:
            return "-43px";
        case 3:
            return "-86px";
        case 4:
            return "-129px";
        case 5:
            return "-172px";
        case 6:
            return "-215px"
    }
}, tools.cutTime = function (e, t, i) {
    var a = e.replace("-", "/"),
        t = t.replace("-", "/");
    a = a.replace("-", "/"), t = t.replace("-", "/");
    var n = $(i).find(".hour"),
        s = $(i).find(".minute"),
        o = $(i).find(".second"),
        r = $(i).find(".opentyle"),
        l = $(i).find(".cuttime"),
        d = new Date(a),
        u = (d - new Date(t)) / 1e3,
        c = (d - new Date(t)) / 1e3,
        f = setInterval(function () {
            var e = u / c;
            if (e < 1 && NaN != e) {
                var t = (e + "").split(".")[1].substr(0, 2);
                t = t.length < 2 ? t + "0" : t, $(i).find(".redpro ").css({
                    width: t + "%"
                })
            }
            if (u > 1) {
                u -= 1;
                var a = Math.floor(u / 3600),
                    d = Math.floor(u / 60 % 60),
                    h = Math.floor(u % 60);
                    
                $(n).text(a < 10 ? "0" + a : a), $(s).text(d < 10 ? "0" + d : d), $(o).text(h < 10 ? "0" + h : h), a <= 0 ? $(".hourid").hide() : $(".hourid").show()
            } else $(r).show(), $(l).hide(), clearInterval(f), method.indexLoad(i)
        }, 1e3)
}, tools.typeOf = function (e, t) {
    if ("sumBigSmall" == e) switch (1 * t) {
        case -1:
            return "小";
        case 0:
            return "和";
        case 1:
            return "大"
    } else if ("sumSingleDouble" == e) switch (1 * t) {
        case -1:
            return "双";
        case 0:
            return "和";
        case 1:
            return "单"
    } else if ("singleDoubleCount" == e) switch (1 * t) {
        case -1:
            return "双多";
        case 0:
            return "单双和";
        case 1:
            return "单多"
    } else if ("frontBehindCount" == e) switch (1 * t) {
        case -1:
            return "后多";
        case 0:
            return "和";
        case 1:
            return "前多"
    } else if ("sumBsSd" == e) switch (1 * t) {
        case 1:
            return "大单";
        case 2:
            return "大双";
        case 3:
            return "小单";
        case 4:
            return "小双";
        case 5:
            return "和"
    } else if ("sumWuXing" == e) switch (1 * t) {
        case 1:
            return "金";
        case 2:
            return "木";
        case 3:
            return "水";
        case 4:
            return "火";
        case 5:
            return "土"
    } else if ("state" == e) switch (1 * t) {
        case 1:
            return "单双";
        case 2:
            return "大小";
        case 3:
            return "龙虎"
    } else if ("san" == e) switch (1 * t) {
        case 0:
            return "杂六";
        case 1:
            return "半顺";
        case 2:
            return "顺子";
        case 3:
            return "对子";
        case 4:
            return "豹子"
    } else if ("lhh" == e) switch (1 * t) {
        case 0:
            return "龙";
        case 1:
            return "虎";
        case 2:
            return "和"
    } else if ("qiu" == e) switch (1 * t) {
        case 1:
            return "第一球";
        case 2:
            return "第二球";
        case 3:
            return "第三球";
        case 4:
            return "第四球";
        case 5:
            return "第五球";
        case 6:
            return "总和";
        case 12:
            return "龙虎"
    } else if ("qiuklsf" == e) switch (1 * t) {
        case 1:
            return "第一球";
        case 2:
            return "第二球";
        case 3:
            return "第三球";
        case 4:
            return "第四球";
        case 5:
            return "第五球";
        case 6:
            return "第六球";
        case 7:
            return "第七球";
        case 8:
            return "第八球";
        case 9:
            return "总和"
    } else if ("qiusyxw" == e) switch (1 * t) {
        case 1:
            return "第一球";
        case 2:
            return "第二球";
        case 3:
            return "第三球";
        case 4:
            return "第四球";
        case 5:
            return "第五球";
        case 6:
            return "和值";
        case 7:
            return "尾数"
    } else if ("gxqiuklsf" == e) switch (1 * t) {
        case 1:
            return "第一球";
        case 2:
            return "第二球";
        case 3:
            return "第三球";
        case 4:
            return "第四球";
        case 5:
            return "第五球";
        case 6:
            return "总和"
    } else if ("qiuonebig" == e) switch (1 * t) {
        case 1:
            return "第一名";
        case 2:
            return "第二名";
        case 3:
            return "第三名";
        case 4:
            return "第四名";
        case 5:
            return "第五名";
        case 11:
            return "总和";
        case 12:
            return "龙虎"
    } else if ("lai" == e) switch (1 * t) {
        case 1:
            return "总来";
        case 0:
            return "没来"
    } else if ("qiuqiu" == e) switch (1 * t) {
        case 1:
            return "一";
        case 2:
            return "二";
        case 3:
            return "三";
        case 4:
            return "四";
        case 5:
            return "五";
        case 11:
            return "总和"
    } else if ("qiuqiu1" == e) switch (1 * t) {
        case 1:
            return "第一球";
        case 2:
            return "第二球";
        case 3:
            return "第三球";
        case 4:
            return "第四球";
        case 5:
            return "第五球";
        case 11:
            return "总和"
    } else if ("liangm" == e) switch (1 * t) {
        case 0:
            return "号码出现次数";
        case 1:
            return "第一球";
        case 2:
            return "第二球";
        case 3:
            return "第三球";
        case 4:
            return "第四球";
        case 5:
            return "第五球";
        case 6:
            return "总和"
    } else if ("statedsyxw" == e) switch (1 * t) {
        case 1:
            return "单";
        case 2:
            return "双";
        case 3:
            return "大";
        case 4:
            return "小";
        case 5:
            return "和";
        case 6:
            return "龙";
        case 7:
            return "虎"
    } else if ("stated" == e) switch (1 * t) {
        case 1:
            return "单";
        case 2:
            return "双";
        case 3:
            return "大";
        case 4:
            return "小";
        case 5:
            return "龙";
        case 6:
            return "虎";
        case 7:
            return "尾大";
        case 8:
            return "尾小";
        case 9:
            return "合单";
        case 10:
            return "合双";
        case 11:
            return "总和"
    } else if ("dxh" == e) switch (1 * t) {
        case 0:
            return "大";
        case 1:
            return "小";
        case 2:
            return "和"
    } else if ("seafood" == e) switch (1 * t) {
        case 1:
            return "鱼";
        case 2:
            return "虾";
        case 3:
            return "葫芦";
        case 4:
            return "金钱";
        case 5:
            return "蟹";
        case 6:
            return "鸡"
    } else if ("dxtc" == e) switch (1 * t) {
        case 0:
            return "大";
        case 1:
            return "小";
        case 2:
            return "通吃"
    } else if ("zhdx" == e) switch (1 * t) {
        case 0:
            return "大";
        case 1:
            return "小";
        case 2:
            return "和"
    } else if ("dsh" == e) switch (1 * t) {
        case 0:
            return "单";
        case 1:
            return "双";
        case 2:
            return "和"
    } else if ("rank" == e) switch (1 * t) {
        case 1:
            return "冠军";
        case 2:
            return "亚军";
        case 3:
            return "第三名";
        case 4:
            return "第四名";
        case 5:
            return "第五名";
        case 6:
            return "第六名";
        case 7:
            return "第七名";
        case 8:
            return "第八名";
        case 9:
            return "第九名";
        case 10:
            return "第十名";
        case 11:
            return "冠亚和"
    }
}, tools.loadDate = function () {
    var e = "",
        t = new Date,
        i = t.getDate();
    $("#top_menu").empty();
    for (var a = 1 * i; a > 0; a--) {
        var n = "";
        a == t.getDate() && (n = "checked onday"), e += '<a href="javascript:;" class="btn ' + n + '"><span>' + a + "<i></i></span></a>"
    }
    $("#top_menu").append(e)
}, tools.checkDay = function (e) {
    $("#top_menu").find(".checked").removeClass("checked");
    var t = $("#top_menu").find(".btn");
    $(t).each(function () {
        e == $(this).text() && $(this).addClass("checked")
    })
}, tools.classGetDate_ssc = function (e, t, i) {
    t = void 0 == t || "" == t ? tools.getDate("ymd") : t, i = void 0 == i || "" == i ? config.periods : i, "dsdxls" == e ? sscFunObj.dsdxls.listData() : "dsdxlz" == e ? sscFunObj.dsdxlz.dsdxlzsData(t) : "lishihmtj" == e ? sscFunObj.lshmtj.listData() : "longhuzs" == e ? sscFunObj.lhzs.listData(t, "") : "luzufx" == e ? sscFunObj.lzfx.getlist(t) : "guyahelz" == e ? sscFunObj.gyhlz.getlist(t) : "todayhaomatj" == e ? sscFunObj.jrhmtj.getdata(t) : "singtaizs" == e ? sscFunObj.singtaizs.getlist(t, "") : "hmqhlz" == e ? sscFunObj.hmlz.listData(t) : "lenrefx" == e ? sscFunObj.lrfx.listData(t) : "haomazs" != e && "wezizs" != e || sscFunObj.wzzs.getlist(t, "")
},


tools.classGetDate_pk10 = function (e, t, i) {
    if (t = void 0 == t || "" == t ? "" : t, i = void 0 == i || "" == i ? config.periods : i, "haomazs" == e || "wezizs" == e)
     pk10FunObj.wzzs.getlist(t, "");
    else if ("luzufx" == e) pk10FunObj.lzfx.getlist(t);
    else if ("hmqhlz" == e) pk10FunObj.hmqhlz.hmqhlzData(t);
    else if ("lenrefx" == e) pk10FunObj.lerefx.getdata();
    else if ("guyahelz" == e) pk10FunObj.gyhlz.getlist(t);
    else if ("guyahezs" == e) pk10FunObj.gyhzs.listData(t, "");
    else if ("dsdxls" == e) pk10FunObj.dsdxlsObj.dsdxlsData();
    else if ("longhutj" == e) pk10FunObj.longhutjObj.longhutjData();
    else if ("longhulz" == e) pk10FunObj.lhlz.lhlzsData(t);
    else if ("haomagltj" == e) {
        var a = $("#gltjhmNum li[class='hmglNumAct']").text(),
            i = ifChecked().issue;
        pk10FunObj.hmgltj.gltjData(i, a, t)
    } else "todayhaomatj" == e ? pk10FunObj.jrhmtj.getdata(t) : "gyhlmlishi" == e ? pk10FunObj.gyhlmlsObj.gyhlmlsData() : "dsdxlz" == e && pk10FunObj.dsdxlz.dsdxlzsData(t)
}


, tools.classGetDate_syxw = function (e, t, i) {
    t = void 0 == t || "" == t ? "" : t, i = void 0 == i || "" == i ? config.periods : i, "wezizs" == e ? syxwFunObj.jbzs.getlist(t, "") : "luzufx" == e ? syxwFunObj.lzfx.getlist(t) : "singtaizs" == e ? syxwFunObj.dwzs.getlist(t, "") : "dsdxls" == e ? syxwFunObj.dsdxls.listData() : "dsdxlz" == e ? syxwFunObj.dsdxlz.listData(t) : "todayhaomatj" == e ? syxwFunObj.jrhmtj.listData() : "zonghelz" == e ? syxwFunObj.zhlz.listData(t) : "longhuzs" == e ? syxwFunObj.lhzs.listData(t, "") : "hezhizs" == e && syxwFunObj.hzzs.listData(t, "")
}, tools.classGetDate_kuai = function (e, t, i) {
    t = void 0 == t || "" == t ? "" : t, i = void 0 == i || "" == i ? config.periods : i, "haomalz" == e ? kuai3FunObj.dewdrop.getdata(t) : "locationzs" == e ? kuai3FunObj.wzzs.getlist(t, "") : "sizezs" == e ? kuai3FunObj.market.getmarket(t, "") : "lishihm" == e ? kuai3FunObj.lishi.getlishi() : "hezhizspl" == e ? kuai3FunObj.hezhizspl.gethezhi(t, "") : "jibenzs" == e ? kuai3FunObj.jibenzs.getjiben(t, "") : "zonghelz" == e ? kuai3FunObj.zonghe.getzong(t) : "qiyuzs" == e && kuai3FunObj.qiyuzs.getqiyu(t, "")
}, pubmethod.initAdata = function () {
    var e = new Date;
    $("#yearmothnday").val(e.getFullYear()), $("#showtime").text((e.getMonth() + 1 < 10 ? "0" + (e.getMonth() + 1) : e.getMonth() + 1) + "月" + e.getDate() + "日"), $(".headTitle").on("click", "div,button", function (e) {
        $(".tabBox").removeClass("hasheight"), $(".sort").removeClass("bgsize"), localStorage.setItem("overpage", $(this).attr("id")), $(this).addClass("checkedbl").siblings().removeClass("checkedbl"), $("#sortable").find("#" + $(this).attr("id")).addClass("checkedbl").siblings().removeClass("checkedbl"), $(this).find("span i").css({
            width: "0"
        }), $(this).find("span i").animate({
            width: "100%"
        }, "1000"), $(".drawCodebox").css({
            left: "7rem",
            display: "none"
        }), $("." + $(this).attr("id")).css({
            display: "block"
        }), $("." + $(this).attr("id")).stop().animate({
            left: "0rem"
        }, "100"), "haomazs" == $(this).attr("id") ? ($(".haomazs .Pattern").hide(), $(".haomazsbgcls").show(), $(".Pattern .hamafb").addClass("checkspan").siblings().removeClass("checkspan"), $(".weizilodiv").show()) : ($(".haomazs .Pattern").show(), $(".haomazsbgcls").hide());
        var t = $(this).attr("id"),
            i = window.location.pathname;
        if (-1 != i.indexOf("pk10") || -1 != i.indexOf("aozxy10") || -1 != i.indexOf("xyft") || -1 != i.indexOf("jisusaiche")) {
            tools.classGetDate_pk10(t, "", "");
            n = "#" + (a = $(".headTitle_view .headTitle .checkedbl").attr("id")) + "_sm";
            "haomagltj" == a || "longhutj" == a || "gyhlmlishi" == a || "hmqhlz" == a || "longhulz" == a || "lenrefx" == a || "wezizs" == a || "guyahelz" == a ? ($("#explainBtn_wfsm").show(), $(n).addClass("displayblock").siblings("div").addClass("displaynone"), $(n).siblings("div").removeClass("displayblock")) : ($("#explainBtn_wfsm").hide(), $(n).addClass("displaynone").siblings("div").addClass("displaynone"))
        } else if (-1 != i.indexOf("ssc_") || -1 != i.indexOf("aozxy5")) {
            tools.classGetDate_ssc(t, "", "");
            n = "#" + (a = $("#sortable .checkedbl").attr("id")) + "_sm";
            "longhuzs" == a || "wezizs" == a || "lenrefx" == a || "singtaizs" == a ? ($("#explainBtn_wfsm").show(), $(n).addClass("displayblock").siblings("div").addClass("displaynone"), $(n).siblings("div").removeClass("displayblock")) : ($("#explainBtn_wfsm").hide(), $(n).addClass("displaynone").siblings("div").addClass("displaynone"))
        } else if (-1 != i.indexOf("11_")) {
            tools.classGetDate_syxw(t, "", "");
            var a = $("#sortable .checkedbl").attr("id"),
                n = "#" + a + "_sm";
            "dsdxlz" == a || "singtaizs" == a || "hezhizs" == a || "wezizs" == a || "longhuzs" == a || "luzufx" == a || "zonghelz" == a ? ($("#explainBtn_wfsm").show(), $(n).addClass("displayblock").siblings("div").addClass("displaynone"), $(n).siblings("div").removeClass("displayblock")) : ($("#explainBtn_wfsm").hide(), $(n).addClass("displaynone").siblings("div").addClass("displaynone"))
        } else if (-1 != i.indexOf("k3_")) {
            tools.classGetDate_kuai(t, "", "");
            var s = $("#sortable .checkedbl").attr("id"),
                o = "#" + s + "_pm";
            "haomalz" == s || "locationzs" == s || "sizezs" == s || "hezhizspl" == s || "jibenzs" == s || "qiyuzs" == s || "zonghelz" == s ? ($("#explainBtn_plok").show(), $(o).removeClass("displaynone").addClass("displayblock").siblings("div").addClass("displaynone"), $(o).siblings("div").removeClass("displayblock")) : ($("#explainBtn_plok").hide(), $(o).addClass("displaynone").siblings("div").addClass("displaynone"))
        }
        oddscrollleft = ""
    }), $(".rightdiv").on("click", "span", function () {
        method.selectedBS($(this), !1)
    }), $(".numbtn").on("touchstart", "li", function () {
        method.selectedHm($(this), !1)
    }), $(".dansdxbtn").on("touchstart", "li", function () {
        method.selectedHm($(this), !1)
    }), $(".lhdzlDiv").on("touchstart", "span", function () {
        method.selectedLHD($(this), !1)
    }), $("#top_menu").on("touchstart", ".btn", function () {
        $(this).addClass("checked").siblings().removeClass("checked");
        var e = $("#yearmothnday").val(),
            t = $("#showtime").text();
        t = t.split("月");
        var i = $(this).find("span").text();
        $("#showtime").text(t[0] + "月" + i + "日"), animate.loadingList("body", !0), method.loadOther(e + "-" + t[0] + "-" + i)
    })
}, tools.bigOrSmall = function (e, t, i, a) {
    var n = $(e).attr("id");
    $(e).siblings().removeClass("spanchecked"), t || $(e).addClass("spanchecked"), "gjlh" == n ? ($("#numlist .haomali").removeClass("displayblock").addClass("displaynone"), $("#numlist .longhuli").removeClass("displaynone").addClass("displayblock")) : ($("#numlist .haomali").removeClass("displaynone").addClass("displayblock"), $("#numlist .longhuli").removeClass("displayblock").addClass("displaynone")), $("#numlist .haomali li").each(function (e) {
        var t = $(this).text(),
            a = (t *= 1) % 2 == 0,
            s = t >= i;
        "xshm" == n ? (tools.hadCode(lotCode, "klsf") ? $(this).text() >= 19 ? ($(this).find("span").removeClass(), $(this).find("span").addClass("rednum")) : ($(this).find("span").removeClass(), $(this).find("span").addClass("bluenum")) : tools.hadCode(lotCode, "bjkl8") ? $(this).text() > 40 ? ($(this).find("span").removeClass(), "10047" == lotCode && (20 == e || (e - 20) % 21 == 0) ? $(this).find("span").addClass("Orange") : $(this).find("span").addClass("bluenum")) : ($(this).find("span").removeClass(), 20 == e || (e - 20) % 21 == 0 ? $(this).find("span").addClass("Orange") : $(this).find("span").addClass("lightblue")) : tools.hadCode(lotCode, "gxklsf") ? ($(this).find("span").removeClass(), 1 == t || 4 == t || 7 == t || 10 == t || 13 == t || 16 == t || 19 == t ? $(this).find("span").addClass("rednum") : 3 == t || 6 == t || 9 == t || 12 == t || 15 == t || 18 == t || 21 == t ? $(this).find("span").addClass("greennum") : $(this).find("span").addClass("bluenum")) : ($(this).find("span").removeClass(), $(this).find("span").addClass("bluenum")), $(this).find("i").show()) : "xsdx" == n ? ($(this).find("i").hide(), $(this).find("span").removeClass(), s ? tools.hadCode(lotCode, "shiyi5") ? 11 == t ? $(this).find("span").addClass("blueCount") : $(this).find("span").addClass("bluebig") : tools.hadCode(lotCode, "bjkl8") ? t > 40 ? $(this).find("span").addClass("bluebig") : $(this).find("span").addClass("bluesm") : tools.hadCode(lotCode, "gxklsf") && 21 == t ? $(this).find("span").addClass("blueCount") : $(this).find("span").addClass("bluebig") : $(this).find("span").addClass("bluesm")) : "xsds" == n && ($(this).find("i").hide(), $(this).find("span").removeClass(), a ? $(this).find("span").addClass("blueeve") : tools.hadCode(lotCode, "shiyi5") ? 11 == t ? $(this).find("span").addClass("blueCount") : $(this).find("span").addClass("bluesig") : tools.hadCode(lotCode, "gxklsf") && 21 == t ? $(this).find("span").addClass("blueCount") : $(this).find("span").addClass("bluesig"))
    })
}, tools.repeatAjaxt = {
    kuai3: function (e) {
        clearInterval(animateID[e]), setTimeout(function () {
            headMethod.loadHeadData($(e).find(".nextIssue").val(), e)
        }, 1e3)
    }
}, tools.replaceUnde = function (e) {
    $(e).each(function (e) {
        "undefined" == $(this).text() && $(this).text("")
    })
}, tools.geturlData = function (e) {
    alert(window.location.href)
}, tools.hadCode = function (e, t) {
    var i = ["10001", "10012", "10037"],
        a = ["10002", "10003", "10004", "10010", "10036", "10050", "10056"],
        n = ["10005", "10011", "10034", "10053"],
        s = ["10009"],
        o = ["10007", "10026", "10027", "10028", "10029", "10030", "10031", "10032", "10033", "10052"],
        r = ["10006", "10008", "10015", "10016", "10017", "10018", "10019", "10020", "10021", "10022", "10023", "10024", "10025", "10055"],
        l = ["10013", "10014", "10047", "10054"],
        d = ["10038"],
        u = !1;
    return "pk10" == t ? $(i).each(function (t) {
        e == this && (u = !0)
    }) : "ssc" == t ? $(a).each(function (t) {
        e == this && (u = !0)
    }) : "klsf" == t ? $(n).each(function (t) {
        e == this && (u = !0)
    }) : "cqnc" == t ? $(s).each(function (t) {
        e == this && (u = !0)
    }) : "kuai3" == t ? $(o).each(function (t) {
        e == this && (u = !0)
    }) : "shiyi5" == t ? $(r).each(function (t) {
        e == this && (u = !0)
    }) : "bjkl8" == t ? $(l).each(function (t) {
        e == this && (u = !0)
    }) : "gxklsf" == t && $(d).each(function (t) {
        e == this && (u = !0)
    }), u
}, tools.parseObj = function (e) {
    var t = null;
    return "object" != typeof e ? t = JSON.parse(e) : (t = JSON.stringify(e), t = JSON.parse(t)), t
}, tools.ifOnDay = function () {
    var e = !1;
    return $("#top_menu").find(".checked").find("span").text() == $("#top_menu").find(".onday").find("span").text() && (e = !0), e
}, tools.subStr = function (e) {
    return (e = e + "").length < 7 ? e : e.substr(1 * e.length - 6, 1 * e.length - 1)
};
var cZ = {
    toRMC: [{
        name: "香港彩",
        href: "http://m.6hch.com/"
    }, {
        name: "北京PK10",
        href: "../pk10/index.html"
    }, {
        name: "重庆时时彩",
        href: "../ssc_cq/index.html"
    }, {
        name: "极速赛车",
        href: "../jisusaiche/index.html"
    }, {
        name: "极速时时彩",
        href: "../ssc_jisu/index.html"
    }, {
        name: "江苏快3",
        href: "../k3_jsks/index.html"
    }, {
        name: "极速飞艇",
        href: "../xyft/index.html"
    }, {
        name: "新疆时时彩",
        href: "../ssc_xj/index.html"
    }, {
        name: "广西快乐十分",
        href: "../gxklsf/index.html"
    }, {
        name: "天津时时彩",
        href: "../ssc_tj/index.html"
    }, {
        name: "PC蛋蛋幸运28",
        href: "../Egxy28/index.html"
    }],
    toJSC: [{
        name: "极速赛车",
        href: "../jisusaiche/index.html"
    }, {
        name: "极速飞艇",
        href: "../xyft/index.html"
    }, {
        name: "极速时时彩",
        href: "../ssc_jisu/index.html"
    }, {
        name: "极速快3",
        href: "../k3_jisu/index.html"
    }, {
        name: "极速快乐十分",
        href: "../klsf_jisu/index.html"
    }, {
        name: "极速快乐8",
        href: "../jisukl8/index.html"
    }, {
        name: "极速11选5",
        href: "../11_jisuef/index.html"
    }],
    toGPC: [{
        name: "十一运夺金",
        href: "../11_syydj/index.html"
    }, {
        name: "重庆幸运农场",
        href: "../xync/index.html"
    }, {
        name: "广东快乐十分",
        href: "../gdklsf/index.html"
    }, {
        name: "天津快乐十分",
        href: "../tianjinklsf/index.html"
    }, {
        name: "北京快乐8",
        href: "../bjkl8/index.html"
    }, {
        name: "重庆七星彩",
        href: "../ssc_cqqxc/index.html"
    }, {
        name: "腾讯分分彩",
        href: "../ffc_tencent/index.html"
    }, {
        name: "江苏快3",
        href: "../k3_jsks/index.html"
    }, {
        name: "吉林快3",
        href: "../k3_jlft/index.html"
    }, {
        name: "河北快3",
        href: "../k3_hebft/index.html"
    }, {
        name: "安徽快3",
        href: "../k3_ahft/index.html"
    }, {
        name: "内蒙古快3",
        href: "../k3_nmgft/index.html"
    }, {
        name: "福建快3",
        href: "../k3_fjft/index.html"
    }, {
        name: "湖北快3",
        href: "../k3_hubft/index.html"
    }, {
        name: "北京快3",
        href: "../k3_bjft/index.html"
    }, {
        name: "广西快3",
        href: "../k3_gxft/index.html"
    }, {
        name: "广东11选5",
        href: "../11_gdsyxw/index.html"
    }, {
        name: "上海11选5",
        href: "../11_shef/index.html"
    }, {
        name: "安徽11选5",
        href: "../11_ahef/index.html"
    }, {
        name: "江西11选5",
        href: "../11_jxef/index.html"
    }, {
        name: "吉林11选5",
        href: "../11_jlef/index.html"
    }, {
        name: "广西11选5",
        href: "../11_gxef/index.html"
    }, {
        name: "湖北11选5",
        href: "../11_hbef/index.html"
    }, {
        name: "辽宁11选5",
        href: "../11_lnef/index.html"
    }, {
        name: "江苏11选5",
        href: "../11_jsef/index.html"
    }, {
        name: "浙江11选5",
        href: "../11_zjef/index.html"
    }, {
        name: "内蒙古11选5",
        href: "../11_nmgef/index.html"
    }],
    toJWC: [{
        name: "澳洲幸运5",
        href: "../aozxy5/index.html"
    }, {
        name: "澳洲幸运8",
        href: "../aozxy8/index.html"
    }, {
        name: "澳洲幸运10",
        href: "../aozxy10/index.html"
    }, {
        name: "澳洲幸运20",
        href: "../aozxy20/index.html"
    }, {
        name: "台湾宾果",
        href: "../taiwanbg/index.html"
    }],
    toQGC: [{
        name: "福彩双色球",
        href: "../fcssq/index.html"
    }, {
        name: "福彩3D",
        href: "../fc3D/index.html"
    }, {
        name: "福彩七乐彩",
        href: "../fc7lc/index.html"
    }, {
        name: "超级大乐透",
        href: "../cjdlt/index.html"
    }, {
        name: "体彩排列3",
        href: "../tcpl3/index.html"
    }, {
        name: "体彩排列5",
        href: "../tcpl5/index.html"
    }, {
        name: "体彩七星彩",
        href: "../tc7xc/index.html"
    }]
};
tools.openAllCz = function (e) {
    $("#navList").css({
        top: "-1.2rem",
        opacity: "0.1"
    }), $(".whiteTip").css("transform", "rotate(0deg)"), e ? ($("html,body").css("height", "100%"), $("#headdivbox").css({
        display: "none"
    }), $("#cZList").css({
        display: "block"
    }), $(".bodybox").css({
        height: "100%"
    }), $(".pagediv").css({
        height: "0",
        overflow: "hidden",
        minHeight: "0"
    }), $("#cZList").stop().animate({
        height: "100%"
    }, 500)) : ($("html,body").css("height", "initial"), $("#headdivbox").css({
        display: "block"
    }), $("#cZList").stop().animate({
        height: "0"
    }, 200, null, function () {
        $(".bodybox").css({
            height: "auto"
        }), $(".pagediv").css({
            height: "auto",
            overflowY: "scroll",
            minHeight: "0"
        })
    }))
}, tools.loadCZ = function () {
    var e = "",
        t = "",
        i = "",
        a = "",
        n = "";
    $(cZ.toRMC).each(function () {
        e += '<li><a href="' + this.href + '">' + this.name + "</a></li>"
    }), $(cZ.toJSC).each(function () {
        t += '<li><a href="' + this.href + '">' + this.name + "</a></li>"
    }), $(cZ.toGPC).each(function () {
        i += '<li><a href="' + this.href + '">' + this.name + "</a></li>"
    }), $(cZ.toJWC).each(function () {
        a += '<li><a href="' + this.href + '">' + this.name + "</a></li>"
    }), $(cZ.toQGC).each(function () {
        n += '<li><a href="' + this.href + '">' + this.name + "</a></li>"
    });
    var s = '<div id="cZList"><div class="backbtn"><span>返回</span><span>所有彩种</span><span>&nbsp;</span></div><div class="toRMC" id="toRMC"><div class="title">热门彩</div><div class="content"><ul>' + e + '</ul></div></div><div class="toRMC" id="toJSC"><div class="title">极速彩</div><div class="content"><ul>' + t + '</ul></div></div><div class="toRMC" id="toGPC"><div class="title">高频彩</div><div class="content"><ul>' + i + '</ul></div></div><div class="toRMC" id="toJWC"><div class="title">境外彩</div><div class="content"><ul>' + a + '</ul></div></div><div class="toRMC" id="toQGC"><div class="title">全国彩</div><div class="content"><ul>' + n + "</ul></div></div></div>";
    $("body").append(s)
}, tools.noChinesFont = function (e) {
    return !/[\u4E00-\u9FA5]/.test(e)
}, tools.repeatAjax = function (e, t) {
    setTimeout(function () {
        headMethod.loadHeadData(e, t)
    }, "1000")
}, tools.repeatAjaxOBj = function (e) {
    setTimeout(function () {
        headMethod.loadHeadData(e)
    }, "1000")
}, pubmethod.creatHead = {
    pk10: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount);
            $(t).find(".nextIssue").val();
            $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue);
            for (var a = "", n = 0, s = $(".longhu").find("li").length; n < s; n++) switch (n) {
                case 0:
                    a += "<li>" + ("0" == i.firstDT ? "龙" : "虎") + "</li>";
                    break;
                case 1:
                    a += "<li>" + ("0" == i.secondDT ? "龙" : "虎") + "</li>";
                    break;
                case 2:
                    a += "<li>" + ("0" == i.thirdDT ? "龙" : "虎") + "</li>";
                    break;
                case 3:
                    a += "<li>" + ("0" == i.fourthDT ? "龙" : "虎") + "</li>";
                    break;
                case 4:
                    a += "<li class='li_after'>" + ("0" == i.fifthDT ? "龙" : "虎") + "</li>";
                    break;
                case 5:
                    a += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>冠亚和：</li><li guanyaheli li_after>" + i.sumFS + "</li>";
                    break;
                case 6:
                    a += "<li guanyaheli li_after>" + ("0" == i.sumBigSamll ? "大" : "小") + "</li>";
                    break;
                case 7:
                    a += "<li guanyaheli li_after style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(a), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), config.ifdebug && console.log("倒计时：:" + JSON.stringify(i.drawTime)), tools.cutTime(i.drawTime, i.serverTime, t);
            var o = i.preDrawCode.split(",");
            animate.pk10AnimateEnd(o, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    ssc: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount);
            $(t).find(".nextIssue").val();
            $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue);
            var a = $(".longhu").find("li"),
                n = "",
                s = i.dragonTiger;
            s = "0" == s ? "龙" : "1" == s ? "虎" : "2" == s ? "和" : "";
            for (var o = 0, r = a.length; o < r; o++) switch (o) {
                case 0:
                    n += "<li class='li_after'>" + s + "</li>";
                    break;
                case 1:
                    n += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 2:
                    n += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 3:
                    n += "<li  class='guanyaheli li_after'>" + ("0" == i.sumBigSmall ? "大" : "小") + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(n), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), tools.cutTime(i.drawTime, i.serverTime, t);
            var l = i.preDrawCode.split(",");
            animate.sscAnimateEnd(l, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    bjkl8: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount);
            $(t).find(".nextIssue").val();
            $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue), void 0 !== $("#drawTime").val() && ($(t).find("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $(t).find("#preDrawIssue").val(i.preDrawIssue));
            for (var a = "", n = 0, s = $(".longhu").find("li").length; n < s; n++) switch (n) {
                case 0:
                    a += "<li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 1:
                    a += "<li  class='guanyaheli li_after' style='margin-right:0'>" + tools.typeOf("sumBigSmall", i.sumBigSmall) + "</li>";
                    break;
                case 2:
                    a += "<li  class='guanyaheli li_after'>" + tools.typeOf("sumSingleDouble", i.sumSingleDouble) + "</li>";
                    break;
                case 3:
                    a += "<li  class='guanyaheli li_after'>" + tools.typeOf("sumWuXing", i.sumWuXing) + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(a), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), tools.cutTime(i.drawTime, i.serverTime, t);
            var o = i.preDrawCode.split(",");
            animate.sscAnimateEnd(o, t), tools.bjkl8BagColor(o, t), $(t).find("#pk10num").find("li:last-child").css({
                background: "#FA8E19"
            }), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    egxy28: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount);
            $(t).find(".nextIssue").val();
            $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue), void 0 !== $("#drawTime").val() && $("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8));
            for (var a = "", n = 0, s = $(".longhu").find("li").length; n < s; n++) switch (n) {
                case 0:
                    a += "<li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 1:
                    a += "<li  class='guanyaheli li_after' style='margin-right:0'>" + tools.typeOf("sumBigSmall", i.sumBigSmall) + "</li>";
                    break;
                case 2:
                    a += "<li  class='guanyaheli li_after'>" + tools.typeOf("sumSingleDouble", i.sumSingleDouble) + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(a), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), tools.cutTime(i.drawTime, i.serverTime, t);
            var o = i.preDrawCode.split(",");
            o.push(i.sumNum), animate.sscAnimateEnd(o, t), $(t).find("#pk10num").find("li:last-child").css({
                background: "red"
            }), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    klsf: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount), $(t).find("#pk10num li").each(function () {
                $(this).text() >= 19 && $(this).css("background", "red")
            }), $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue), void 0 !== $("#drawTime").val() && ($(t).find("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $(t).find("#nextIssue").val(i.drawIssue), $(t).find("#preDrawIssue").val(i.preDrawIssue));
            var a = $(".longhu").find("li"),
                n = "",
                s = i.dragonTiger;
            s = "0" == s ? "龙" : "1" == s ? "虎" : "2" == s ? "和" : "";
            for (var o = 0, r = a.length; o < r; o++) switch (o) {
                case 0:
                    n += "<li class=''>" + ("0" == i.firstDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 1:
                    n += "<li class=''>" + ("0" == i.secondDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 2:
                    n += "<li class=''>" + ("0" == i.thirdDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 3:
                    n += "<li class=''>" + ("0" == i.fourthDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 4:
                    n += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 5:
                    n += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 6:
                    n += "<li  class='guanyaheli li_after'>" + tools.typeOf("dxh", i.sumBigSmall) + "</li>";
                    break;
                case 7:
                    n += "<li  class='li_after' style='width:0.5rem'>" + ("0" == i.lastBigSmall ? "尾大" : "尾小") + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(n), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), config.ifdebug && console.log("倒计时：:" + JSON.stringify(i.drawTime));
            var l = i.preDrawCode.split(",");
            animate.sscAnimateEnd(l, t), tools.klsfBagColor(l, t), tools.cutTime(i.drawTime, i.serverTime, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    gxklsf: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount);
            l = i.preDrawCode.split(",");
            tools.gxklsfBagColor(l, t), $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue), void 0 !== $("#drawTime").val() && $(t).find("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8));
            var a = $(".longhu").find("li"),
                n = "",
                s = i.firstDragonTiger;
            s = "0" == s ? "龙" : "1" == s ? "虎" : "2" == s ? "和" : "";
            for (var o = 0, r = a.length; o < r; o++) switch (o) {
                case 0:
                    n += "<li class=''>" + ("0" == i.firstDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 1:
                    n += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 2:
                    n += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 3:
                    n += "<li  class='guanyaheli li_after'>" + tools.typeOf("dxh", i.sumBigSmall) + "</li>";
                    break;
                case 4:
                    n += "<li  class='li_after' style='width:0.5rem'>" + ("0" == i.lastBigSmall ? "尾大" : "尾小") + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(n), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), config.ifdebug && console.log("倒计时：:" + JSON.stringify(i.drawTime));
            var l = i.preDrawCode.split(",");
            animate.sscAnimateEnd(l, t), tools.cutTime(i.drawTime, i.serverTime, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    syx5: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount), $(t).find(".nextIssue").val(i.drawIssue), $(t).find("#nextIssue").val(i.drawIssue), $(t).find("#sumNum").val(i.sumNum), $(t).find("#sumSingleDouble").val(tools.typeOf("dsh", i.sumSingleDouble)), $(t).find("#sumBigSmall").val(tools.typeOf("zhdx", i.sumBigSmall)), $(t).find(".drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $(t).find(".preDrawIssue").text(i.preDrawIssue);
            var a = $(".longhu").find("li"),
                n = "",
                s = i.dragonTiger;
            s = "0" == s ? "龙" : "1" == s ? "虎" : "2" == s ? "和" : "";
            for (var o = 0, r = a.length; o < r; o++) switch (o) {
                case 0:
                    n += "<li class=''>" + tools.typeOf("san", i.behindThree) + "</li>";
                    break;
                case 1:
                    n += "<li class=''>" + tools.typeOf("san", i.betweenThree) + "</li>";
                    break;
                case 2:
                    n += "<li class=''>" + tools.typeOf("san", i.lastThree) + "</li>";
                    break;
                case 3:
                    n += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 4:
                    n += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 5:
                    n += "<li  class='guanyaheli li_after'>" + tools.typeOf("dxh", i.sumBigSmall) + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(n), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), config.ifdebug && console.log("倒计时：:" + JSON.stringify(i.drawTime));
            var l = i.preDrawCode.split(",");
            animate.sscAnimateEnd(l, t), tools.cutTime(i.drawTime, i.serverTime, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    jsk3: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount), tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue);
            for (var a = "", n = 0, s = $(".longhu").find("li").length; n < s; n++) switch (n) {
                case 0:
                    a += "<li class='li_after'>总和：</li><li class='li_after'>" + i.sumNum + "</li>";
                    break;
                case 1:
                    a += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 2:
                    a += "<li  class='guanyaheli li_after'>" + ("0" == i.sumBigSmall ? "大" : "小") + "</li>"
            }
            $(".longhu").empty(""), $(".longhu").append(a), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), config.ifdebug && console.log("倒计时：:" + JSON.stringify(i.drawTime)), $(t).find(".drawTime").val(i.drawTime), $(t).find(".drawIssue").val(i.drawIssue), tools.cutTime(i.drawTime, i.serverTime, t);
            var o = i.preDrawCode.split(",");
            animate.kuai3AnimateEnd(o, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    cqnc: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount), $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue);
            var a = $(".longhu").find("li"),
                n = "",
                s = i.dragonTiger;
            s = "0" == s ? "龙" : "1" == s ? "虎" : "2" == s ? "和" : "";
            for (var o = 0, r = a.length; o < r; o++) switch (o) {
                case 0:
                    n += "<li class=''>" + ("0" == i.firstDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 1:
                    n += "<li class=''>" + ("0" == i.secondDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 2:
                    n += "<li class=''>" + ("0" == i.thirdDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 3:
                    n += "<li class=''>" + ("0" == i.fourthDragonTiger ? "龙" : "虎") + "</li>";
                    break;
                case 4:
                    n += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 5:
                    n += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 6:
                    n += "<li  class='guanyaheli li_after'>" + tools.typeOf("dxh", i.sumBigSmall) + "</li>";
                    break;
                case 7:
                    n += "<li  class='li_after' style='width:0.5rem'>" + ("0" == i.lastBigSmall ? "尾大" : "尾小") + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(n), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), config.ifdebug && console.log("倒计时：:" + JSON.stringify(i.drawTime));
            var l = i.preDrawCode.split(",");
            animate.cqncAnimateEnd(l, $(t)), tools.cutTime(i.drawTime, i.serverTime, t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    },
    qgc: function (e, t) {
        var i = tools.parseObj(e);
        if ("100002" == i.result.businessCode) throw new Error("error");
        if (0 == i.errorCode) {
            if (0 != i.result.businessCode) throw new Error("error");
            if (i = i.result.data, tools.operatorTime("" == i.drawTime ? "0" : i.drawTime, i.serverTime) <= 0) throw new Error("error");
            $(t).find(".drawCountnum").text(i.drawCount), $(t).find(".sdrawCountnext").text(1 * i.totalCount - 1 * i.drawCount);
            $(t).find(".nextIssue").val();
            $(t).find(".nextIssue").val(i.drawIssue), $(t).find(".preDrawIssue").text(i.preDrawIssue), void 0 !== $("#drawTime").val() && ($("#drawTime").val(i.drawTime.substr(i.drawTime.length - 8, 8)), $("#nextDate").val(i.drawTime.substr(0, 10)), $(t).find("#preDrawIssue").val(i.preDrawIssue));
            var a = $(".longhu").find("li"),
                n = "",
                s = i.dragonTiger;
            s = "0" == s ? "龙" : "1" == s ? "虎" : "2" == s ? "和" : "";
            for (var o = 0, r = a.length; o < r; o++) switch (o) {
                case 0:
                    n += "<li class='li_after'>" + s + "</li>";
                    break;
                case 1:
                    n += "<li class='verline li_after'>|</li><li class='guanyahe li_after'>总和：</li><li class='guanyaheli li_after'>" + i.sumNum + "</li>";
                    break;
                case 2:
                    n += "<li  class='guanyaheli li_after' style='margin-right:0'>" + ("0" == i.sumSingleDouble ? "单" : "双") + "</li>";
                    break;
                case 3:
                    n += "<li  class='guanyaheli li_after'>" + ("0" == i.sumBigSmall ? "大" : "小") + "</li>"
            }
            $(".longhu").html(""), $(".longhu").append(n), $(t).find(".cuttime").css({
                opacity: "0",
                "margin-right": "100%"
            }), setTimeout(function () {
                $(t).find(".cuttime").animate({
                    opacity: "1"
                }, 200)
            }, 1e3), $(t).find(".redpro").animate({
                width: "0"
            }, 500), setTimeout(function () {
                $(t).find(".redpro").animate({
                    width: "100%"
                }, 600)
            }, 1e3), tools.cutTime(i.drawTime, i.serverTime, t);
            var l = i.preDrawCode.split(",");
            animate.sscAnimateEnd(l, t), tools.resetRed(t), setTimeout(function () {
                tools.ifToday() && method.loadOther("")
            }, 1e3), clearInterval(animateID[t]), delete animateID[t]
        }
    }
}, pubmethod.ajaxHead = {
    bjpk10: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            // url: config.publicUrl + "pks/getLotteryPksInfo.do?issue=" + e,
            // url: "https://www.kbcp88.com/?r=lottery/lottery-result/json-results&gtype=BJPK&t=" + $.now(),
            url: "/?r=lottery/lottery-result/json-results&gtype=BJPK",
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                void 0 == animateID[t] && animate.pk10OpenAnimate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    pk10: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "pks/getLotteryPksInfo.do?issue=" + e,
            // url: "https://www.kbcp88.com/?r=lottery/lottery-result/json-results&gtype=BJPK&t=" + $.now(),
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                void 0 == animateID[t] && animate.pk10OpenAnimate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    ssc: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "CQShiCai/getBaseCQShiCai.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                void 0 == animateID[t] && animate.sscAnimate("#headerData")
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    bjkl8: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "LuckTwenty/getBaseLuckTewnty.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                $(t).find("#pk10num li").each(function () {
                    $(this).css("background", "#0092dd")
                }), void 0 == animateID[t] && animate.sscAnimate("#headerData")
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    egxy28: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "LuckTwenty/getPcLucky28.do?issue=" + e,
            type: "GET",
            beforeSend: function () {
                $(t).find("#pk10num li").each(function () {
                    $(this).css("background", "#19A6DA")
                }), void 0 == animateID[t] && animate.sscAnimate("#headerData")
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    klsf: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "klsf/getLotteryInfo.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                $(t).find("#pk10num li").each(function () {
                    $(this).css("background", "#0092dd")
                }), void 0 == animateID[t] && animate.sscAnimate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    gxklsf: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "gxklsf/getLotteryInfo.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                $(t).find("#pk10num li").each(function () {
                    $(this).css("background", "#0092dd")
                }), void 0 == animateID[t] && animate.sscAnimate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    syx5: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "ElevenFive/getElevenFiveInfo.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                void 0 == animateID[t] && animate.sscAnimate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    jsk3: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "lotteryJSFastThree/getBaseJSFastThree.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                void 0 == animateID[t] && animate.kuai3Animate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    cqnc: function (e, t) {
        var e = void 0 == e ? "" : e,
            i = !1;
        $.ajax({
            url: config.publicUrl + "klsf/getLotteryInfo.do?issue=" + e,
            type: "GET",
            data: {
                lotCode: lotCode
            },
            beforeSend: function () {
                void 0 == animateID[t] && animate.cqncAnimate(t)
            },
            success: function (i) {
                try {
                    headMethod.headData(i, t)
                } catch (i) {
                    tools.repeatAjax(e, t)
                }
            },
            error: function (a) {
                tools.repeatAjax(e, t), i = !0
            },
            complete: function (a, n) {
                (i = !1) || "timeout" == n && tools.repeatAjax(e, t)
            }
        })
    },
    qgc: function (e) {
        var t = e.url,
            i = e.id,
            a = e.lotCode,
            n = !1;
        config.ifdebug && console.log("obj：" + JSON.stringify(e)), $.ajax({
            url: t,
            type: "GET",
            data: {
                lotCode: a
            },
            beforeSend: function () {
                void 0 == animateID[i] && animate.sscAnimate(i)
            },
            success: function (t) {
                try {
                    headMethod.headData(t, i)
                } catch (t) {
                    tools.repeatAjaxOBj(e)
                }
            },
            error: function (t) {
                tools.repeatAjaxOBj(e), n = !0
            },
            complete: function (t, i) {
                (n = !1) || "timeout" == i && tools.repeatAjaxOBj(e)
            }
        })
    }
}, tools.ifToday = function () {
    // var e = $("#showtime").text();
    // return e = e.split("月")[1].split("日")[0], !(!(tools.getDate("d") == e) || !config.ifFirstLoad)
}, tools.getDate = function (e) {
    var t = "",
        i = new Date,
        a = i.getFullYear(),
        n = i.getMonth() + 1,
        s = i.getDate(),
        o = i.getHours(),
        r = i.getMinutes(),
        l = i.getSeconds();
    return "ymd" == e ? t = a + "-" + n + "-" + s : "ymdhms" == e ? t = a + "-" + n + "-" + s + " " + o + ":" + r + ":" + l : "d" == e && (t = s), t
}, tools.catchUndefined = function (e) {
    $(e).find("li").each(function () {
        "undefined" == $(this).text() && $(this).text("")
    })
}, tools.bjkl8BagColor = function (e, t) {
    $(t).find(".sscli li").css("background", "#19A6DA");
    for (var i = 0, a = e.length; i < a; i++) e[i] >= 41 && $(t).find("li").eq(i).css("background", "#0092DD")
}, tools.klsfBagColor = function (e, t) {
    for (var i = 0, a = e.length; i < a; i++) e[i] >= 19 && $(t).find("li").eq(i).css("background", "red")
}, tools.gxklsfBagColor = function (e, t) {
    for (var i = 0; i < e.length; i++) 1 == e[i] || 4 == e[i] || 7 == e[i] || 10 == e[i] || 13 == e[i] || 16 == e[i] || 19 == e[i] ? $(t).find("#pk10num").find("li").eq(i).css("background", "red") : 3 != e[i] && 6 != e[i] && 9 != e[i] && 12 != e[i] && 15 != e[i] && 18 != e[i] && 21 != e[i] || $(t).find("#pk10num").find("li").eq(i).css("background", "#02CB44")
},


tools.setPK10TB = function () {
    pk10jiuchuo = setInterval(function () {
        -1 != $("#videobox").css("z-index") && ("00:00" != $(".animate iframe").contents().find(".countdownnum").text() ? (tools.insertVideo(), config.ifdebug && console.log("纠错....")) : config.ifdebug && (console.log("开始开奖了...."), console.log("停止纠错....")))
    }, 5e3)
},


tools.operatorTime = function (e, t) {
    var i = e.replace("-", "/"),
        t = t.replace("-", "/");
    return i = i.replace("-", "/"), t = t.replace("-", "/"), (new Date(i) - new Date(t)) / 1e3
}, 


tools.insertVideo = function () {
    var e = 3600 * $("#headerData").find(".hour").text()
     + 60 * $("#headerData").find(".minute").text()
      + 1 * $("#headerData").find(".second").text() - 1;
    "-1" == e && (e = 0), $("iframe")[0].contentWindow.startcountdown(e);
    var t = "",
        i = $("#pk10num").find("li");
    $(i).each(function () {
        t += $(this).text() + ","
    });
    var a = null;
    a = t.length < 11 ? "5,6,3,4,8,7,9,10,2,1" : t.substring(0, t.length - 1), $("iframe")[0].contentWindow.showcurrentresult(a), $(".animate iframe").contents().find("#currentdrawid").text($("#headerData").find(".drawCountnum").text()), $(".animate iframe").contents().find("#nextdrawtime").text($("#headerData").find(".preDrawIssue").text());
    i = $("#headerData .longhu").find("li");
    $(".animate iframe").contents().find("#stat1_1").text($(i).eq(7).text()), $(".animate iframe").contents().find("#stat1_2").text($(i).eq(8).text()), $(".animate iframe").contents().find("#stat1_3").text($(i).eq(9).text()), $(".animate iframe").contents().find("#stat2_1").text($(i).eq(0).text()), $(".animate iframe").contents().find("#stat2_2").text($(i).eq(1).text()), $(".animate iframe").contents().find("#stat2_3").text($(i).eq(2).text()), $(".animate iframe").contents().find("#stat2_4").text($(i).eq(3).text()), $(".animate iframe").contents().find("#stat2_5").text($(i).eq(4).text())
},


tools.testWWW = function () {
    -1 != window.location.href.indexOf("1680100.com") && ($(".footer_up").find(".computer_ver").attr("onclick", "javascript:window.location.href='http://www.1680100.com/html/public/home.html'"), $(".main_image").empty().append("<img style='float:left;width:100%' src='../../img/NOprBanner.jpg'/>"), $("#toRMC .content").find("li").each(function () {
        "香港彩" == $(this).text() && $(this).find("a").attr("href", "http://m.6hch001.com")
    }), $(".flicking_con").hide())
}, tools.resetRed = function (e) {
    var t = $(e).find(".sscli li").length;
    $(e).find(".sscli li").each(function (e) {
        "10039" == lotCode || "10042" == lotCode ? e != t - 1 ? $(this).css("background-color", "red") : $(this).css("background-color", "#0092dd") : "10040" == lotCode ? e == t - 1 || e == t - 2 ? $(this).css("background-color", "#0092dd") : $(this).css("background-color", "red") : "10041" == lotCode || "10043" == lotCode ? $(this).css("background-color", "red") : "10044" == lotCode ? $(this).css("background-color", "red") : "10045" == lotCode && (e <= 3 ? $(this).css("background-color", "#0092dd") : $(this).css("background-color", "#19a6da"))
    })
}, tools.setTimefun = function () {
    setTimeout(function () {
        !$("#videobox").length < 1 && $("iframe")[0].contentWindow.ifopen && $("iframe")[0].contentWindow.k3v.stopVideo(createData())
    }, 1e3)
}, tools.setTimefun_cqnc = function () {
    setTimeout(function () {
        if (!$("#videobox").length < 1 && $("iframe")[0].contentWindow.ifopen) {
            var e = createData();
            if (e.codearr.length < 8) return void setTimeout(function () {
                tools.setTimefun_cqnc()
            }, 500);
            $("iframe")[0].contentWindow.stopanimate(e.codearr, e.counttime)
        }
    }, 1e3)
}, tools.setTimefun_shiyixw = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        $("iframe")[0].contentWindow.k3v.stopVideo(tools.getDataStr())
    }, 3e3)
}, tools.getDataStr = function () {
    var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
        t = [];
    return $("#headerData").find("#pk10num li").each(function () {
        t.push(parseInt($(this).text()))
    }), {
        preDrawCode: t,
        sumNum: $("#sumNum").val(),
        sumBigSmall: $("#sumBigSmall").val(),
        sumSingleDouble: $("#sumSingleDouble").val(),
        drawIssue: $(".nextIssue").val(),
        drawTime: $(".drawTime").val(),
        preDrawTime: e
    }
}, tools.bjkl8DataStr = function () {
    var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
        t = [];
    return $("#headerData").find("#pk10num li").each(function () {
        t.push(parseInt($(this).text()))
    }), {
        preDrawCode: t,
        drawIssue: $("#preDrawIssue").val(),
        drawTime: $("#drawTime").val(),
        preDrawTime: e
    }
}, tools.setTimefun_bjkl8 = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        $("iframe")[0].contentWindow.syxwV.stopVid(tools.bjkl8DataStr()), $("iframe")[0].contentWindow.syxwV.bgMusic()
    }, 3e3)
}, tools.pcEggDataStr = function () {
    var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
        t = [];
    return $("#headerData").find("#pk10num li").each(function (e) {
        e < 3 && t.push(parseInt($(this).text()))
    }), {
        numArr: t,
        nextIssue: $(".nextIssue").val(),
        drawTime: $("#drawTime").val(),
        preDrawTime: e
    }
}, tools.setTimefun_pcEgg = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        $("iframe")[0].contentWindow.pcEgg.stopVid(tools.pcEggDataStr())
    }, 3e3)
}, tools.gdklsfDataStr = function () {
    var e = 3600 * $("#timebox").find(".hour").text() + 60 * $("#timebox").find(".minute").text() + 1 * $("#timebox").find(".second").text() - 2,
        t = [];
    return $("#headerData").find("#pk10num li").each(function () {
        t.push(parseInt($(this).text()))
    }), {
        arr: t,
        thisIssue: $("#preDrawIssue").val(),
        nextIssue: $("#nextIssue").val(),
        nextTime: $("#drawTime").val(),
        countdown: e
    }
}, tools.setTimefun_gdklsf = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        var e = tools.gdklsfDataStr();
        $("iframe")[0].contentWindow.fun.Trueresult(e.arr), $("iframe")[0].contentWindow.fun.fillHtml(e.thisIssue, e.nextIssue, e.nextTime, e.countdown)
    }, 3e3)
}, tools.gxklsfDataStr = function () {
    var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
        t = [];
    return $("#headerData").find("#pk10num li").each(function () {
        t.push(parseInt($(this).text()))
    }), {
        numArr: t,
        thisIssue: $(".preDrawIssue").text(),
        nextIssue: $(".nextIssue").val(),
        drawTime: $("#drawTime").val(),
        cutdonwTime: e
    }
}, tools.setTimefun_gxklsf = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        var e = tools.gxklsfDataStr();
        $("iframe")[0].contentWindow.gxklsf.stopVid(e)
    }, 3e3)
}, tools.fc3dDataStr = function () {
    var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
        t = [];
    return $("#headerData").find("#pk10num li").each(function () {
        t.push(parseInt($(this).text()))
    }), {
        preDrawCode: t,
        drawIssue: $("#preDrawIssue").val(),
        drawTime: $("#drawTime").val(),
        preDrawTime: e
    }
}, tools.setTimefun_fc3d = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        $("iframe")[0].contentWindow.fc3d.stopVid(tools.fc3dDataStr())
    }, 3e3)
}, tools.fcssqDataStr = function () {
    var e = $("#timebox").find(".hour").text() + ":" + $("#timebox").find(".minute").text() + ":" + $("#timebox").find(".second").text(),
        t = [];
    return $("#headerData").find("#pk10num li").each(function () {
        t.push(parseInt($(this).text()))
    }), {
        preDrawCode: t,
        drawIssue: $("#preDrawIssue").val(),
        data: $("#nextDate").val(),
        drawTime: $("#drawTime").val(),
        preDrawTime: e
    }
}, tools.setTimefun_fcssq = function () {
    !$("#videobox").length < 1 && "block" != $(".opentyle").css("display") && $("iframe")[0].contentWindow.ifopen && setTimeout(function () {
        $("iframe")[0].contentWindow.ssq.stopVid(tools.fcssqDataStr())
    }, 3e3)
}, 

tools.publicPk10 = function (e, t, i, a) {
    //console.log("a="+a);
    if (a <= 0) throw new Error("error");
    config.ifdebug // && console.log("已经请求到最新数据..."),
     !$("#videobox").length < 1 && -1 != $("#videobox").css("z-index") ? 
     ($("iframe")[0].contentWindow.finishgame(i.preDrawCode),
      setTimeout(function () {
        pubmethod.creatHead.pk10(e, t)
    }, 3e3), setTimeout(function () {
        tools.insertVideo()
    }, 1e4)) : pubmethod.creatHead.pk10(e, t)
}

, tools.publicJsft = function (e, t, i, a) {
    for (var n = i.preDrawCode.split(","), s = [], o = 0; o < n.length; o++) {
        if (1 != n[o].charAt(0)) r = n[o].charAt(1);
        else var r = n[o];
        s.push(r)
    }
    var l = s.toString();
    if (a <= 0) throw config.ifdebug && console.log("没请求到新数据...下期开奖号码相同..."), new Error("error");
    config.ifdebug && console.log("已经请求到最新数据...2"), !$("#videobox").length < 1 && -1 != $("#videobox").css("z-index") ? ($("iframe")[0].contentWindow.finishgame(l, a), setTimeout(function () {
        pubmethod.creatHead.pk10(e, t)
    }, 3e3), setTimeout(function () {
        tools.insertVideo()
    }, 1e4)) : pubmethod.creatHead.pk10(e, t)
}, $("body").on("click", "#beginTime", function () {
    $("#dateshadow").css("height", $("body").height() + "px")
});