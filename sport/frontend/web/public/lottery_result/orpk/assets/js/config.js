function popup() {
    $("body").append("<div id='popup' style='display:none;'><div class='pupbox'><button id='pupbtn' style='display:none'></button><a href='#' id='downbtn'></a><img src=''/></div></div>"), setTimeout(function () {
        $("#popup").css("height", $("body").height())
    }, 500), $("#popup").on("click", function (t) {
        t.stopPropagation();
        var o = $(t.target);
        if ("popup" == o.attr("id") || "pupbtn" == o.attr("id")) {
            $("#popup").hide(), $("html,body").css({
                overflow: "visible"
            });
            var s = (new Date).getDate();
            localStorage.setItem("pupday", s)
        }
    })
}

// pop web href remove
function pupout(t) {
    var o = localStorage.getItem("pupday");
    null == o && (o = "0");
    var s = (new Date).getDate(),
        e = window.location.origin.split("//")[1].split(":")[0].replace("m.", "");
    1 * o != 1 * s && popup(), void 0 != t && "" != t && -1 == t.indexOf(e) || ($("#downbtn").attr("href", ""), $(".app_ver").find("a").attr("href", ""))
}

function pupajax() {
    $.ajax({
        type: "get",
        url: config.publicUrl + "parameters/getNoAdvertisingDomain.do",
        async: !0,
        data: "",
        success: function (t) {
            "string" == typeof t && (t = JSON.parse(t)), hideList = t.result.data.domainList, operationDomain(hideList)
        },
        error: function () {
            // console.log("域名请求出错了")
        }
    })
}

function operationDomain(t) {
    pupout(t)
}

function adddesktop() {
    // $("body").append("<div id='deskbox'><div class='desk1'><span></span></div><div class='desk2'><span></span></div></div>"), $("body").width() >= 569 && ($(".desk1>span").css("right", "21%"), $("body,html").css("transform", "initial"));
    // var t = "",
    //     o = navigator.userAgent.toLowerCase();
    // window.location.pathname.split("html/")[0];
    // /Android|Linux/.test(o) ? t = "load_andriod" : /iphone|ipad|ipod/.test(o) ? t = "load_ios" : /Windows Phone/.test(o) && (t = "load_ios"), "load_ios" == t ? $(".desk1").css("display", "none") : "load_andriod" == t && $(".desk2").css("display", "none"), $("#deskbox").on("click", "div>span", function () {
    //     $("#deskbox").hide(), localStorage.setItem("desktop", !0)
    // })
}

function checkadddesk() {
    var t = localStorage.getItem("desktop");
    null != t && t || adddesktop()
}
var config = {
        publicUrl: "//api.api68.com/",
        imgUrl: "//images.img861.com/",
        ifdebug: 1,
        ifFirstLoad: !1,
        ifScalse: .782,
        periods: 30,
        showrows: 60
    },
    constant = {
        pk10: {
            totalIssue: 179
        },
        cqssc: {
            totalIssue: 120
        },
        tjssc: {
            totalIssue: 84
        },
        xjssc: {
            totalIssue: 96
        },
        gdklsf: {
            totalIssue: 84
        },
        syydj: {
            totalIssue: 78
        },
        gdsyxw: {
            totalIssue: 84
        },
        jsks: {
            totalIssue: 82
        },
        xync: {
            totalIssue: 97
        }
    },
    lotCode = {
        pk10: 10001,
        jisusaiche: 10037,
        xyft: 10035,
        cqssc: 10002,
        cqqxc: 10050,
        tjssc: 10003,
        xjssc: 10004,
        jisussc: 10036,
        gdklsf: 10005,
        gdsyxw: 10006,
        gxklsf: 10038,
        jsksan: 10007,
        sdsyydj: 10008,
        cqxync: 10009,
        aozxy5: 10010,
        aozxy8: 10011,
        aozxy10: 10012,
        aozxy20: 10013,
        bjkl8: 10014,
        twbg: 10047,
        jxef: 10015,
        jsef: 10016,
        ahef: 10017,
        shef: 10018,
        lnef: 10019,
        hbef: 10020,
        cqef: 10021,
        gxef: 10022,
        jlef: 10023,
        nmgef: 10024,
        zjef: 10025,
        gxft: 10026,
        jlft: 10027,
        hebft: 10028,
        nmgft: 10029,
        ahft: 10030,
        fjft: 10031,
        hubft: 10032,
        bjft: 10033,
        tjklsf: 10034,
        fcssq: 10039,
        cjdlt: 10040,
        fcsd: 10041,
        fcqlc: 10042,
        pailie3: 10043,
        pailie5: 10044,
        qxc: 10045,
        egxy28: 10046,
        jisuklsf: 10053,
        jisuef: 10055,
        jisuksan: 10052,
        jisukl8: 10054,
        txffc: 10056
    },
    RecommTime = {
        pk10: ["10:55-15:00", "17:55-23:50"],
        aozxy10: ["10:55-15:00", "17:55-23:50"],
        jisusaiche: ["10:55-15:00", "17:55-23:50", "01:00-03:30"],
        xyft: ["10:55-15:00", "17:55-23:50", "01:00-03:30"],
        cqssc: ["10:55-15:00", "17:55-23:50"],
        tjssc: ["10:55-15:00", "17:55-23:00"],
        xjssc: ["10:55-15:00", "17:55:00-23:50"],
        aozxy5: ["10:55-15:00", "17:55-23:50", "01:00-03:30"],
        jisussc: ["10:55-15:00", "17:55-23:50", "01:00-03:30"],
        gdklsf: ["10:50-15:00", "17:50-23:00"],
        aozxy8: ["10:50-15:00", "17:50-23:50"],
        tjklsf: ["10:50-15:00", "17:50-23:00"],
        cqxync: ["10:50-15:00", "17:50-23:50"],
        egxy28: ["10:50-15:00", "17:50-23:50"],
        gdsyxw: ["10:55-15:00", "17:50-23:00"],
        jxef: ["10:50-15:00", "17:50-23:00"],
        jsef: ["10:50-15:00", "17:50-22:00"],
        ahef: ["10:50-15:00", "17:50-22:00"],
        shef: ["10:55-15:00", "17:50-22:50"],
        lnef: ["10:50-15:00", "17:50-22:30"],
        hbef: ["10:50-15:00", "17:50-22:00"],
        gxef: ["10:50-15:00", "17:50-22:50"],
        jlef: ["10:50-15:00", "17:50-21:30"],
        nmgef: ["10:50-15:00", "17:50-23:00"],
        zjef: ["10:55-15:00", "17:50-22:30"],
        sdsyydj: ["10:50-15:00", "17:50-23:00"],
        jsksan: ["10:50-15:00", "17:50-22:00"],
        gxft: ["10:50-15:00", "17:50-22:30"],
        jlft: ["10:50-15:00", "17:50-21:30"],
        hebft: ["10:50-15:00", "17:50-22:00"],
        nmgft: ["10:50-15:00", "17:50-22:00"],
        ahft: ["10:50-15:00", "17:50-22:00"],
        fjft: ["10:50-15:00", "17:50-22:00"],
        hubft: ["10:50-15:00", "17:50-22:00"],
        bjft: ["10:50-15:00", "17:50-23:50"]
    };
pupajax(), $(document).scroll(function () {
    $(this).scrollTop() > 20 && ($("#navList").css({
        top: "-1.2rem",
        opacity: "0.1"
    }), $(".whiteTip").css("transform", "rotate(0deg)"))
}), checkadddesk(), $("#deskout").click(function () {
    $("#deskbox").length > 0 ? $("#deskbox").show() : adddesktop()
});
var or_load = !0,
    loadtimeout;
$("body,html").on("touchstart", function () {
    or_load = !1, clearTimeout(loadtimeout), loadtimeout = setTimeout(function () {
        or_load = !0
    }, 3e4)
}), setInterval(function () {
    or_load && window.location.reload()
}, 3e5);