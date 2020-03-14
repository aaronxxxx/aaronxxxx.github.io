$(function () {
    // headTitle 寬度
    var window_width = $(window).width();
    $("#headTitle").css({'width':window_width,'padding':'0'});
    //初始化数据及监听事件
    pubmethod.initAdata();
    //初始化数据
    method.indexLoad(boxId);
    ifishad = true; //判断是否是刷新页
    tools.loadDate(); //初始化时间控件
    document.addEventListener('touchstart', function () {
        if (($("iframe")[0].contentWindow.ifopen)) {
            $("iframe")[0].contentWindow.videoTools.sounds.play("sound");
        }
    }, false);
    //弹出播放视频
    $("#startVideo").on("click", function () {
        startVideo();
        $("iframe")[0].contentWindow.ifopen = true;
        if (($("iframe")[0].contentWindow.ifopen)) {
            $("iframe")[0].contentWindow.videoTools.sounds.play("sound");
        }
    });
    //关闭视频
    $("#videobox .closevideo").on("click", function () {
        clearInterval(pk10jiuchuo);
        $(".content").animate({
            "top": "-80%"
        }, 200, function () {
            $("#videobox").css({
                "z-index": "-1",
                "position": "fixed"
            });
        });
        $("iframe")[0].contentWindow.ifopen = false;
        $("iframe")[0].contentWindow.videoTools.sounds.stop("sound");
    });
    method.loadOther(""); //加载列表及其他数据
    setTimeout(function () {
        config.ifFirstLoad = true;
    }, 4000);
});
(function () {
    var supportOrientation = (typeof window.orientation === 'number' &&
        typeof window.onorientationchange === 'object');
    var init = function () {
        var htmlNode = document.body.parentNode,
            orientation;
        var updateOrientation = function () {
            if (supportOrientation) {
                orientation = window.orientation; //得到屏幕旋转参数
                if (($("#videobox").find(".content").css("top") == "0px")) {
                    startVideo();
                }
            }
        };
        if (supportOrientation) {
            window.addEventListener('orientationchange', updateOrientation, false);
        } else {
            //监听resize事件
            window.addEventListener('resize', updateOrientation, false);
        }
        updateOrientation();
    };
    window.addEventListener('DOMContentLoaded', init, false);
})();

function startVideo() {
    $("#videobox").animate({
        "z-index": "999999"
    }, 10, function () {
        var W = $(".animate").width();
        var H = W * 880 / 1310;
        $(".content").css({
            "height": H + 35
        });
        $(".content").animate({
            "top": "0"
        }, 500, function () {
            iframe(); //加载动画界面
            isfirthload = false;
            tools.insertVideo(); //向视频中添加数据
            tools.setPK10TB(); //启动纠错
        });
    });
}

function bodyHtmlvis() {
    //  setTimeout(function() {
    //      $("html,body").css("overflow", "visible");
    //  }, 1);
}

function bodyHtmlhide() {
    //  setTimeout(function() {
    //      $("html,body").css("overflow", "hidden");
    //  }, 100);
}
//判断是否是刷新页
var ifishad = false;
//主体方法类
var method = {};
var isfirthload = true;
var pk10weizzsdata = "";
//加载其他数据
method.loadOther = function (date) {
    //处理所选日期不为当日时不加载列表数据
    if (date == "") {
        if (!tools.ifOnDay()) {
            return;
        }
    }
    method.listData(date); //重新请求list数据
    //此处需要慢一步因为数据需要时时放入数据库分析
    setTimeout(function () {
        method.todayData(date); //加载双面统计     
    }, 1000);
    setTimeout(function () {
        method.longData(date); //长龙提醒         
    }, 2000);
    var showpage = $(".headTitle .checkedbl").attr("id");
    if (date != "") {
        var setdate = date.split("-");
        date = setdate[0] + "-" + setdate[1] * 1 + "-" + (setdate[2] * 1 < 10 ? "0" + setdate[2] * 1 : setdate[2] * 1)
    }
    tools.classGetDate_pk10(showpage, date, "")
}
//入口加载数据
method.indexLoad = function (id) {
    var nextIssue = $(id).find(".nextIssue").val();
    var id = "#" + $(id).attr("id");
    headMethod.loadHeadData(nextIssue, id); //页面启动时加载数据第一次加载不传参
}
//请求list数据
method.listData = function (date) {
    $.ajax({
        // url: config.publicUrl + "pks/getPksHistoryList.do?date=" + date,  //外連API
        url: "/?r=lottery/lottery-result/json-history-data&gtype=BJPK" ,
        type: "GET",
        data: {
            "lotCode": lotCode
        },
        beforeSend: function () {
            if (!ifishad) {
                $("#numlist").html("<span class='loading'>努力加载中...</span>");
            }
        },
        success: function (data) {
            method.createHtmlList(data);
            //关闭加载动画
            animate.loadingList("body", false);
        },
        error: function (data) {
            if (config.ifdebug) {
                console.log("data error");
            }
        }
    });
}
//今日双面/号码统计
method.todayData = function (date) {
    $.ajax({
        // url: config.publicUrl + "pks/getPksDoubleCount.do?date=" + date,  //外連API
        // url: "json/getPksDoubleCount.json",  //外連API
        url: "/?r=lottery/lottery-result/json-history-data&gtype=BJPK",
        type: "GET",
        data: {
            "lotCode": lotCode
        },
        success: function (data) {
            method.loadTodayData(data);
        },
        error: function (data) {
            if (config.ifdebug) {
            //    console.log("todayData data error");
            }
        }
    });
}
//长龙提醒
method.longData = function (date) {
    $.ajax({
        // url: config.publicUrl + "pks/getPksLongDragonCount.do?date=" + date,  //外連API
        url: "/?r=lottery/lottery-result/json-history-data&gtype=BJPK",
        type: "GET",
        data: {
            "lotCode": lotCode
        },
        success: function (data) {
            method.loadLongData(data);
        },
        error: function (data) {
            if (config.ifdebug) {
                console.log("data error");
            }
        }
    });
}
method.createHtmlList = function (jsondata) {
    var data = null;
    if (typeof jsondata != "object") {
        data = JSON.parse(jsondata);
    } else {
        data = JSON.stringify(jsondata);
        data = JSON.parse(data);
    }
    if (data.errorCode == 0) {
        if (data.result.businessCode == 0) {
            data = data.result.data;
            //1：为开奖号码TAB添加数据---start
            $("#numlist").empty();
            $("#haomafblist").empty();
            $(data).each(function (index) {
                if (index >= 200) { //只显示200条列表数据
                    return
                }
                var divhtml = "";
                divhtml += '<div class="listline bortop001">';
                divhtml += '<div class="leftspan leftspanw">';
                divhtml += '<span class="boxflex">';
                var drawTime = this.preDrawTime;
                drawTime = drawTime.substring((drawTime.length) - 8, (drawTime.length) - 3);
                divhtml += '<span class="graytime">' + drawTime + '</span>';
                divhtml += '<span class="graytime">' + tools.subStr(this.preDrawIssue) + '</span>';
                divhtml += '</span>';
                divhtml += '</div>';
                divhtml += '<div class="rightspan">';
                divhtml += '<div class="rightdiv padl0">';
                divhtml += '<ul id="" class="pk10li haomali listli">';
                var preDrawCode = this.preDrawCode.split(",");
                $(preDrawCode).each(function (index) {
                    if (index == preDrawCode.length - 1) {
                        divhtml += '<li class="nubb' + this + ' li_after"><i>' + this + '</i></li>';
                    } else {
                        divhtml += '<li class="nubb' + this + '"><i>' + this + '</i></li>';
                    }
                });
                divhtml += '</ul>';
                divhtml += '<ul id="" class="pk10li longhuli listli lhlist displaynone">';
                var stylestr = "style='color:";
                if (!(preDrawCode.length <= 1)) {
                    var sumBigSamll = this.sumBigSamll == "0" ? "大" : "小";
                    var sumSingleDouble = this.sumSingleDouble == "0" ? "单" : "双";
                    var firstDT = this.firstDT == "0" ? "longbg" : "hubg";
                    var secondDT = this.secondDT == "0" ? "longbg" : "hubg";
                    var thirdDT = this.thirdDT == "0" ? "longbg" : "hubg";
                    var fourthDT = this.fourthDT == "0" ? "longbg" : "hubg";
                    var fifthDT = this.fifthDT == "0" ? "longbg" : "hubg";
                }
                divhtml += "<li  style='color:#f12d35'>" + this.sumFS + "</li>";
                divhtml += "<li>" + sumBigSamll + "</li>";
                divhtml += "<li>" + sumSingleDouble + "</li>";
                divhtml += "<li class='" + firstDT + "'></li>";
                divhtml += "<li class='" + secondDT + "'></li>";
                divhtml += "<li class='" + thirdDT + "'></li>";
                divhtml += "<li class='" + fourthDT + "'></li>";
                divhtml += "<li class='" + fifthDT + " li_after'></li>";
                divhtml += '</ul>';
                divhtml += '</div>';
                divhtml += '</div>';
                divhtml += '</div>';
                $("#numlist").append(divhtml);
                $("#haomafblist").append(divhtml);
            });
            method.selectedBS($(".rightdiv").find(".spanchecked"), true); //执行标题是不是选重
            //1：为开奖号码TAB添加数据---end
            //1：为开奖号码TAB添加数据---start
            //1：为开奖号码TAB添加数据---end
        } else {
            console.log("数据请求失败！");
        }
    }
}
//筛选号码大小单双
method.selectedBS = function (obj, ifload) {
    var id = $(obj).attr("id");
    $(obj).siblings().removeClass("spanchecked");
    if (!ifload) {
        $(obj).addClass("spanchecked");
    }
    if (id == "gjlh") {
        $("#numlist .haomali").removeClass("displayblock").addClass("displaynone");
        $("#numlist .longhuli").removeClass("displaynone").addClass("displayblock");
    } else {
        $("#numlist .haomali").removeClass("displaynone").addClass("displayblock");
        $("#numlist .longhuli").removeClass("displayblock").addClass("displaynone");
    }
    $("#numlist .haomali li").each(function (index) {
        var number = $(this).text();
        //是否为单双
        var ifds = number % 2 == 0 ? true : false;
        //是否为大小
        var ifdx = number >= 6 ? true : false;
        if (id == "xshm") {

            $(this).removeClass();
            //样式名为numsm+01到10
            switch (number) {
                case "01":
                    $(this).addClass("nubb01");
                    break;
                case "02":
                    $(this).addClass("nubb02");
                    break;
                case "03":
                    $(this).addClass("nubb03");
                    break;
                case "04":
                    $(this).addClass("nubb04");
                    break;
                case "05":
                    $(this).addClass("nubb05");
                    break;
                case "06":
                    $(this).addClass("nubb06");
                    break;
                case "07":
                    $(this).addClass("nubb07");
                    break;
                case "08":
                    $(this).addClass("nubb08");
                    break;
                case "09":
                    $(this).addClass("nubb09");
                    break;
                case "10":
                    $(this).addClass("nubb10");
                    break;
            };
            if ((index + 1) % 10 == 0) {
                $(this).addClass("nubb" + number + " li_after");
            }
        } else if (id == "xsdx") {
            $(this).removeClass();

            if (ifdx) {
                $(this).addClass("numbig");
                if ((index + 1) % 10 == 0) {
                    $(this).addClass("numbig li_after");
                }
            } else {
                $(this).addClass("numsm");
                if ((index + 1) % 10 == 0) {
                    $(this).addClass("numsm li_after");
                }
            }
        } else if (id == "xsds") {
            $(this).removeClass();
            if (ifds) {
                $(this).addClass("nums");
                if ((index + 1) % 10 == 0) {
                    $(this).addClass("nums li_after");
                }
            } else {
                $(this).addClass("numd");
                if ((index + 1) % 10 == 0) {
                    $(this).addClass("numd li_after");
                }
            }
        }
    });

}
//号码分布
method.selectedHm = function (obj, ifload) {
    var ifmyself = $(obj).hasClass("lichecked");
    if ($(obj).parent().parent().attr("class") == "dansdxbtn") {
        $(".numbtn").find("li").removeClass("lichecked");
        if ($(obj).hasClass("lichecked")) {
            $(obj).removeClass("lichecked");
        } else {
            $(obj).addClass("lichecked");
        }
        var dansdxbtn = $(obj).text();
        if (dansdxbtn == "单") {
            $(".dansdxbtn li:nth-child(2)").removeClass("lichecked");
        } else if (dansdxbtn == "双") {
            $(".dansdxbtn li:nth-child(1)").removeClass("lichecked");
        } else if (dansdxbtn == "大") {
            $(".dansdxbtn li:nth-child(4)").removeClass("lichecked");
        } else if (dansdxbtn == "小") {
            $(".dansdxbtn li:nth-child(3)").removeClass("lichecked");
        }
    } else {
        $(".dansdxbtn").find("li").removeClass("lichecked");
        if ($(obj).hasClass("lichecked")) {
            $(obj).removeClass("lichecked");
        } else {
            $(obj).addClass("lichecked").siblings().removeClass("lichecked");
        }
        //得到一个当前遍历的li中的号码
        if ($(".numbtn").find(".lichecked").text()) {
            $("#haomafblist li").addClass("selectedOpacity");
            $("#haomafblist li").each(function () {
                if ($(this).text() == $(".numbtn").find(".lichecked").text()) {
                    $(this).removeClass("selectedOpacity").siblings();
                }
            });
        } else {
            $("#haomafblist li").removeClass("selectedOpacity");
        }

    }
    var dannum = $(".dansdxbtn li:nth-child(1)").hasClass("lichecked"); //单号选中
    var shuangnum = $(".dansdxbtn li:nth-child(2)").hasClass("lichecked"); //双号选中
    var danum = $(".dansdxbtn li:nth-child(3)").hasClass("lichecked"); //大号选中
    var xiaonum = $(".dansdxbtn li:nth-child(4)").hasClass("lichecked"); //小号选中

    $("#haomafblist li").each(function () {
        var number = $(this).text();
        //是否为单双
        var ifds = number % 2 == 0 ? true : false;
        //是否为大小
        var ifdx = number >= 6 ? true : false;
        //如果为真，说明是双数，如果为假说明是单数
        //判断是否同时选中，如果同时选中， 那么有一个为真就要显示
        //双重条件执行
        if (dansdxbtn == "单") { //当前按钮为单
            if (ifmyself) {
                if (danum) { //大号被选中，否则小号被选中
                    if (ifdx) { //显示大号和单数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else if (xiaonum) { //小号被选中
                    if (!ifdx) { //显示小号和单数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    $(this).removeClass("selectedOpacity");
                }
            } else {
                if (danum) { //大号被选中，否则小号被选中
                    if (ifdx && !ifds) { //显示大号和单数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                } else if (xiaonum) { //小号被选中
                    if (!ifdx && !ifds) { //显示小号和单数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    if (!ifds) {
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                }
            }
        } else if (dansdxbtn == "双") { //当前按钮为双
            if (ifmyself) {
                if (danum) { //大号被选中，否则小号被选中
                    if (ifdx) { //显示大号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                } else if (xiaonum) { //小号被选中
                    if (!ifdx) { //显示小号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    $(this).removeClass("selectedOpacity");
                }
            } else {
                if (danum) { //大号被选中，否则小号被选中
                    if (ifdx && ifds) { //显示大号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                } else if (xiaonum) { //小号被选中
                    if (!ifdx && ifds) { //显示小号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    if (ifds) { //显示小号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                }
            }
        } else if (dansdxbtn == "大") { //当前按钮为大
            if (ifmyself) {
                if (dannum) { //单号被选中，否则双号被选中
                    if (!ifds) { //显示大号和单数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                } else if (shuangnum) { //双号被选中
                    if (ifds) { //显示大号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    $(this).removeClass("selectedOpacity");
                }
            } else {
                if (dannum) { //单号被选中，否则双号被选中
                    if (ifdx && !ifds) { //显示大号和单数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                } else if (shuangnum) { //双号被选中
                    if (ifdx && ifds) { //显示大号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    if (ifdx) { //显示大号和双数
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                }
            }
        } else if (dansdxbtn == "小") { //当前按钮为小
            if (ifmyself) {
                if (dannum) { //单号被选中，否则双号被选中
                    if (!ifds) { //显示小号和单号
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else if (shuangnum) { //双号被选中
                    if (ifds) { //显示小号和双号
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    $(this).removeClass("selectedOpacity");
                }
            } else {
                if (dannum) { //单号被选中，否则双号被选中
                    if (!ifdx && !ifds) { //显示小号和单号
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }

                } else if (shuangnum) { //双号被选中
                    if (!ifdx && ifds) { //显示小号和双号
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                } else {
                    if (!ifdx) { //显示小号
                        $(this).removeClass("selectedOpacity");
                    } else {
                        $(this).addClass("selectedOpacity");
                    }
                }
            }
        }
    });

    //  console.log($(obj).parent().parent().attr("class"));
}
//今日双面数据
method.loadTodayData = function (jsondata) {
    if (typeof jsondata != "object") {
        data = JSON.parse(jsondata);
    } else {
        data = JSON.stringify(jsondata);
        data = JSON.parse(data);
    }
    if (data.errorCode == 0) {
        if (data.result.businessCode == 0) {
            data = data.result.data;
            var todydata = [{
                data: [
                    data.firstSingleCount,
                    data.firstDoubleCount,
                    data.firstBigCount,
                    data.firstSmallCount,
                    data.firstDragonCount,
                    data.firstTigerCount
                ]
            }, {
                data: [
                    data.secondSingleCount,
                    data.secondDoubleCount,
                    data.secondBigCount,
                    data.secondSmallCount,
                    data.secondDragonCount,
                    data.secondTigerCount
                ]
            }, {
                data: [
                    data.thirdSingleCount,
                    data.thirdDoubleCount,
                    data.thirdBigCount,
                    data.thirdSmallCount,
                    data.thirdDragonCount,
                    data.thirdTigerCount
                ]
            }, {
                data: [
                    data.fourthSingleCount,
                    data.fourthDoubleCount,
                    data.fourthBigCount,
                    data.fourthSmallCount,
                    data.fourthDragonCount,
                    data.fourthTigerCount
                ]
            }, {
                data: [
                    data.fifthSingleCount,
                    data.fifthDoubleCount,
                    data.fifthBigCount,
                    data.fifthSmallCount,
                    data.fifthDragonCount,
                    data.fifthTigerCount
                ]
            }, {
                data: [
                    data.sixthSingleCount,
                    data.sixthDoubleCount,
                    data.sixthBigCount,
                    data.sixthSmallCount
                ]
            }, {
                data: [
                    data.seventhSingleCount,
                    data.seventhDoubleCount,
                    data.seventhBigCount,
                    data.seventhSmallCount
                ]
            }, {
                data: [
                    data.eighthSingleCount,
                    data.eighthDoubleCount,
                    data.eighthBigCount,
                    data.eighthSmallCount
                ]
            }, {
                data: [
                    data.ninthSingleCount,
                    data.ninthDoubleCount,
                    data.ninthBigCount,
                    data.ninthSmallCount
                ]
            }, {
                data: [
                    data.tenthSingleCount,
                    data.tenthDoubleCount,
                    data.tenthBigCount,
                    data.tenthSmallCount
                ]
            }, {
                data: [
                    data.sumSingleCount,
                    data.sumDoubleCount,
                    data.sumBigCount,
                    data.sumSmallCount
                ]
            }];
            $("#liangmianbox").empty();
            $(todydata).each(function (index) {
                var tdthml = "";
                $(this.data).each(function () {
                    tdthml += "<td>" + this + "</td>";
                });
                var rank = tools.typeOf("rank", (index + 1));
                var head = "";
                if (index == 0) {
                    head = "head1";
                } else if (index == 1) {
                    head = "head2";
                }
                var iflh = "";
                if (!(index >= 5)) {
                    iflh = "<td>龙</td><td>虎</td>";
                }
                var listbox = '<div class="lianmlist">' +
                    '<div  class="head ' + head + '">' + rank + '</div>' +
                    '<table cellpadding="0" cellspacing="0" border="0">' +
                    '<tr class="tr1">' +
                    '<td>单</td>' +
                    '<td>双</td>' +
                    '<td>大</td>' +
                    '<td>小</td>' + iflh + '</tr>' +
                    '<tr class="tr2">' + tdthml + '</tr>' +
                    '</table>' +
                    '</div>';

                $("#liangmianbox").append(listbox);
            });
        } else {
            //              alert("数据加载异常！");
        }
    }
}
//长龙连开提醒
method.loadLongData = function (jsondata) {
    if (typeof jsondata != "object") {
        data = JSON.parse(jsondata);
    } else {
        data = JSON.stringify(jsondata);
        data = JSON.parse(data);
    }
    if (data.errorCode == 0) {
        if (data.result.businessCode == 0) {
            data = data.result.data;
            if (config.ifdebug) {
        //        console.log("长龙连开提醒长度:" + data.length + "结果数据：" + JSON.stringify(data));
            }
            $("#longDrag").empty("");
            for (var i = 0, len = data.length; i < len; i++) {
                var rank = tools.typeOf("rank", data[i].rank);
                var state = tools.typeOf("stated", data[i].state);
                var counthtml = data[i].count >= 5 ? "<span style='color:#f11821'>" + data[i].count + "</span>" : "<span>" + data[i].count + "</span>";
                var html = "<li><span>" + rank + "</span>：<span>" + state + "</span>" + counthtml + "期</li>";
                if (data[i].rank == 11 || data[i].rank == 1 || data[i].rank == 2) {
                    html = "<li><span>" + rank + "</span>：<span>" + state + "</span>" + counthtml + "期</li>";
                }
                $("#longDrag").append(html);
            }
        } else {
            //          alert("数据加载失败！");
        }
    }

}

function iframe() {
    if (isfirthload) {
        $('.animate iframe').contents().find("#preloader").show();
        //加载初始界面
        $('.animate').find(".loading").fadeOut("slow");
        $('.animate').find(".loading_jisusc").fadeOut("slow");
        $('.animate').find(".loading_azxy10").fadeOut("slow");
    }
    var W = $(".animate").width();
    var H = W * 880 / 1310;
    var zoomW = (W / 1310);
    setTimeout(function () {
        $('.animate iframe').contents().find("html").css("zoom", zoomW) // 父级宽/1310*100  取0.0000
        var contnetH = $('.animate iframe').contents().find(".container").height();
        $(".animate").animate({
            "height": H + 50
        }, 600);
        $('.animate iframe').animate({
            "height": H + 50
        }, 600);
        $(".content").animate({
            "height": H + 35
        }, 600);
    }, 1);
    setTimeout(function () {
        $('.animate iframe').contents().find(".container").fadeIn('slow');
        $('.animate iframe').contents().find("#preloader").fadeOut('slow');
    }, 1000);
}

//  自定义排序

document.oncontextmenu = function (e) {
    //或者return false;
    e.preventDefault();
};
var elementsld;
var touch = {};
touch.current = 0;
touch.lenght = 4;

function move(elem, targetW, current) {
    elem.animate({
        translate3d: targetW * current + "px,0,0"
    }, 300, 'steps', function () {});
}

//var sort = Sortable.create(document.getElementById('sortable'), {
//  disabled: true,
//  animation: 150,
//  onStart: function() {
//      Zepto("#sortable").removeClass("animationframes")
//  },
//  onEnd: function() {
//
//      sort.options.disabled = true
//      longtap = false
//      console.log(elementsld);
//      elementsld.css("background-color", "");
//      touchmove = true
//
//  }
//})

var longtap = false
jQuery('#sortable button').on("taphold", function (e) {
    elementsld = $(this);
    elementsld.css({
        "color": "#666"
    });
    longtap = true;
    //          this.bind('contextmenu', function (e) {
    //              e.preventDefault();
    //          },false)
})
Zepto('#sortable button').on('touchstart', function (e) {
    setTimeout(function () {
        if (longtap) {
            console.log('longtap')
            sort.options.disabled = false
            sort._onTapStart(e)
        }
    }, 1000);
})

//所有弹出框取消按钮隐藏弹出窗
$(".reset").on("click", function () {
    $(".gotop").css("height", "0rem");
    $(".loteyPage").removeClass("gotop");
    $(".or_").each(function (index) {
        if ($(this).hasClass("check_tj")) {
            $(this).removeClass("check_tj").removeClass("or_")
        } else {
            $(this).addClass("check_tj").removeClass("or_")
        }
    })
    bodyHtmlvis();
});

//展开今日号码统计的筛选
$(".checkClick").on("click", function () {
    $('#gcCheckqisho').addClass("gotop");
    $(".gotop").css("height", $("body").height());
    bodyHtmlhide();
})
$("#sortable").on("click", "button", function () {
    localStorage.setItem("overpage", $(this).attr("id"));
    $(this).addClass("checkedbl").siblings().removeClass("checkedbl");
    $(".headTitle").find("#" + $(this).attr("id")).addClass("checkedbl").siblings().removeClass("checkedbl");
    $(".drawCodebox").css({
        "left": "7rem",
        "display": "none"
    });
    $("." + $(this).attr("id")).css({
        "display": "block"
    });
    $("." + $(this).attr("id")).stop().animate({
        "left": "0rem"
    }, "100");
    if ($(this).attr("id") == "haomazs") {
        $(".haomazs .Pattern").hide();
        $(".haomazsbgcls").show();
        $(".weizilodiv").show()
    } else {
        $(".haomazs .Pattern").show();
        $(".haomazsbgcls").hide()
    }
    $(".tabBox").removeClass("hasheight");
    $(".gotop").css("height", "0rem");
    $("#touchlongmove").removeClass("gotop")
    $(".sort").removeClass("bgsize");
    $(".ListHead").css("min-height", "0")
    bodyHtmlvis();
    var objid = $(this).attr("id");
    tools.classGetDate_pk10(objid, "", "");
    $(".Pattern .hamafb").addClass("checkspan").siblings().removeClass("checkspan");
    //显示对应玩法说明介绍
    var curcheckCaiz = $("#sortable .checkedbl").attr("id");
    var showId_wfsm = "#" + curcheckCaiz + "_sm";
    if (curcheckCaiz == "haomagltj" || curcheckCaiz == "longhutj" || curcheckCaiz == "gyhlmlishi" || curcheckCaiz == "hmqhlz" || curcheckCaiz == "longhulz" || curcheckCaiz == "lenrefx" || curcheckCaiz == "wezizs" || curcheckCaiz == "guyahelz") {
        $("#explainBtn_wfsm").show();
        $(showId_wfsm).addClass("displayblock").siblings("div").addClass("displaynone");
        $(showId_wfsm).siblings("div").removeClass("displayblock");
    } else {
        $("#explainBtn_wfsm").hide();
        $(showId_wfsm).addClass("displaynone").siblings("div").addClass("displaynone");
    }

    //把选中的放到视图上
    $(".headTitle>button").each(function (i, el) {
        if ($(el).hasClass("checkedbl")) {
            newscrollleft = $(el).offset().left * 1;
            if (newscrollleft > 1 || newscrollleft < -1) {
                oddscrollleft = oddscrollleft * 1 + newscrollleft * 1;
                $(".headTitle_view").scrollLeft(Math.abs(oddscrollleft));
            }
        }
    })
});
//展开拖选列表
var oddscrollleft = "";
$(".sort").on("click", function () {
    $("body,html").scrollTop(0);
    $(".tabBox").toggleClass("hasheight")
    if ($(".tabBox").hasClass("hasheight")) {
        $(".sort").addClass("bgsize");
        $("#touchlongmove").addClass("gotop");
        $(".gotop").css("height", $("body").height());
        bodyHtmlhide();
        $(".ListHead").css("min-height", "4rem")
    } else {
        bodyHtmlvis()
        $(".ListHead").css("min-height", "auto");
        $(".gotop").css("height", "0rem");
        $("#touchlongmove").removeClass("gotop");
        $(".sort").removeClass("bgsize");
        $("#kaijianghm").siblings().remove();
        $("#kaijianghm").after($("#sortable").html());
        $(".headTitle>button").each(function (i, el) {
            if ($(el).hasClass("checkedbl")) {
                newscrollleft = $(el).offset().left * 1;
                if (newscrollleft > 1 || newscrollleft < -1) {
                    oddscrollleft = oddscrollleft * 1 + newscrollleft * 1;
                    $(".headTitle_view").scrollLeft(Math.abs(oddscrollleft));
                }
            }
        })
    }
});
//条件选择
$("#gcCheckqisho .Page_content").on("click", "ul>li", function () {
    $(this).toggleClass("check_tj or_");
});
//全选 与清空----今日号码统计
$("#gcCheckqisho").on("click", ".checkAll,.noAll", function () {
    if ($(this).attr("class") == "checkAll") { //全选 
        $("#gcCheckqisho li").addClass("check_tj")
    } else {
        $("#gcCheckqisho li").removeClass("check_tj")
    }
})

//确认勾选的条件更新dom
$("#gcCheckqisho").on("click", ".sure", function () {
    $(".gotop").css("height", "0rem");
    $(".loteyPage").removeClass("gotop");
    $(".or_").removeClass("or_");
    $(".marginTop>li").each(function (i, el) {
        if ($(el).hasClass("check_tj")) {
            $(".item_" + $(el).attr("data-text")).show()
        } else {
            $(".item_" + $(el).attr("data-text")).hide()
        }
    });
    if ($(".show_zonkai").hasClass("check_tj")) {
        $(".zongkai_item").show()
    } else {
        $(".zongkai_item").hide()
    }
    if ($(".show_weikai").hasClass("check_tj")) {
        $(".weikai_item").show()
    } else {
        $(".weikai_item").hide()
    }
    bodyHtmlvis();
})
//-------------------------------------------------单双大小历史
//综合查看-个体查看切换
$(".navTab").on("click", "span", function () {
    if (!$(this).find("i").hasClass("iActClass")) {
        $(this).find("i").addClass("iActClass").parent("span").siblings().find("i").removeClass()
    }
    var ifZonghe = $(this).attr("id"); //id="personCheck"个体查看 ，id="zhCheck"综合查看
    if (ifZonghe == "personCheck") {
        $("#zhkanList").css("display", "none");
        $("#personList").css("display", "block");
    } else {
        $("#zhkanList").css("display", "block");
        $("#personList").css("display", "none");
    }
})
//1-10名次选择
$("#minciBox").find("ul").find("li").on("click", function () {
    if (!$(this).hasClass("minciLiAct")) {
        $(this).addClass("minciLiAct").siblings().removeClass();
    }
    //显示对应名次表格
    var iminci = $(this).find("i").text();
    var hasDisplaynone = $("#tbody" + iminci).hasClass("displaynone");
    if (hasDisplaynone) {
        $("#tbody" + iminci).removeClass().siblings("tbody").addClass("displaynone");
    }
})

//个体查看-单双大小切换
$("#dsdxBox").find("ul").find("li").on("click", function () {
    if (!$(this).hasClass("dsdxActcolor")) {
        $(this).addClass("dsdxActcolor").siblings().removeClass();
    }
    //显示单双大小表格
    var idsdx = $(this).find("i").text();
    var hasDisplaynone = $("#gtbody" + idsdx).hasClass("displaynone");
    if (hasDisplaynone) {
        $("#gtbody" + idsdx).removeClass().siblings("tbody").addClass("displaynone");
    }
})
//路珠分析最新一期闪动
function animate_lz() {
    var p = 0;
    var result = $(".lz_content>div>.lz_item>table>tbody>.tablebox td:first-child p:last-child");
    result.css("font-weight", "bold");
    var timeOutId = setTimeout(function () {
        result.fadeOut(100).fadeIn(100);
        p++;
        if (p == 1) {
            timeOutId = setInterval(arguments.callee, 600);
        }
        if (p == 30) {
            window.clearInterval(timeOutId);
            //result.css("font-weight", "normal");
        }
    }, 1000);
    $(function () {
        var setTime = setInterval(function () {
            if ($(".tb").length != 0) {
                clearInterval(setTime)
            }
            $(".tb").css({
                "color": "#fff",
                "background": "#ED2842"
            });
        }, 200)
    })
}
//号码前后，龙虎路珠分析最新一期闪动
function animate_lz_hmqh() {
    var p = 0;
    var result = $(".lz_content>div .lz_item>table>tbody>.tablebox td:first-child p:last-child");
    result.css("font-weight", "bold");
    var timeOutId = setTimeout(function () {
        result.fadeOut(100).fadeIn(100);
        p++;
        if (p == 1) {
            timeOutId = setInterval(arguments.callee, 600);
        }
        if (p == 30) {
            window.clearInterval(timeOutId);
            //result.css("font-weight", "normal");
        }
    }, 1000);
    $(function () {
        var setTime = setInterval(function () {
            if ($(".tb").length != 0) {
                clearInterval(setTime)
            }
            $(".tb").css({
                "color": "#fff",
                "background": "#ED2842"
            });
        }, 200)
    })
}

//得到系统时间
function getDateStr(AddDayCount) {
    var dd = new Date();
    dd.setDate(dd.getDate() + AddDayCount); //获取AddDayCount天后的日期
    var y = dd.getFullYear();
    var m = dd.getMonth() + 1; //获取当前月份的日期
    var d = dd.getDate();
    return y + "-" + m + "-" + d;
}
//路珠筛选
$(".checkclick_lz").on("click", function () {
    bodyHtmlhide();
    $("#zhfx_lz").addClass("gotop");
    $(".gotop").css("height", $("body").height());
})
//路珠显示模式选择
$(".Pattern").on("click", "span", function () {
    var $this = $(this);
    $this.addClass("checkspan").siblings().removeClass("checkspan");
    if ($this.hasClass("zonghu")) { //综合
        $(".zhms_mod").addClass("showms").siblings(".Page_content").removeClass("showms");

    } else if ($this.hasClass("danxms")) { //单选
        $(".dans_mod").addClass("showms").siblings(".Page_content").removeClass("showms");

    } else { // 双面
        $(".lmms_mod").addClass("showms").siblings(".Page_content").removeClass("showms");
    }
    showlz_listitem()
})
$("#zhfx_lz").on("click", ".marginTop li", function () {
    if ($(".showms").hasClass("dans_mod")) {
        $(this).addClass("check_tj or_").siblings(".check_tj").removeClass("check_tj").addClass("or_")
    } else {
        $(this).toggleClass("check_tj or_")
    }
})
$("#zhfx_lz").on("click", ".mosh li", function () {
    if ($(".showms").hasClass("lmms_mod")) {
        $(this).addClass("check_tj or_").siblings(".check_tj").removeClass("check_tj").addClass("or_")
    } else {
        $(this).toggleClass("check_tj or_")
    }
})

//今天 昨天 前天选择路珠 
$(".luzufx .checkday").on("click", "span", function () {
    $(this).addClass("checkspan").siblings().removeClass("checkspan");
    var $this = $(this),
        date_lz = "";
    if ($this.hasClass("today_lz")) {
        date_lz = getDateStr(0) //notime=true
    } else if ($this.hasClass("yestoday_lz")) {
        date_lz = getDateStr(-1)
    } else {
        date_lz = getDateStr(-2)
    }
    pk10FunObj.lzfx.getlist(date_lz)
})
//今天 昨天 前天选择 冠亚和路珠 
$(".guyahelz .checkday").on("click", "span", function () {
    $(this).addClass("checkspan").siblings().removeClass("checkspan");
    var $this = $(this),
        date_lz = "";
    if ($this.hasClass("today_lz")) {
        date_lz = getDateStr(0) //notime=true
    } else if ($this.hasClass("yestoday_lz")) {
        date_lz = getDateStr(-1)
    } else {
        date_lz = getDateStr(-2)
    }
    pk10FunObj.gyhlz.getlist(date_lz)
})
//筛选条件公共部分
function showlz_listitem() {
    $(".lz_title").hide();
    var rankarr = $("#zhfx_lz .showms .marginTop .check_tj");
    for (var i = 0; i < rankarr.length; i++) {
        var thclass = $(rankarr[i]).attr("data-text");
        $("#zhfx_lz .showms .mosh .check_tj").each(function (i, el) {
            var thclas2 = $(this).attr("data-text");
            //          console.log(thclas2)
            $("." + thclas2).each(function (i, er) {
                if ($(er).hasClass(thclass)) {
                    $(er).show();
                }
            })
        })
    }
}
//确定筛选条件
$("#zhfx_lz").on("click", ".sure", function () {
    $(".gotop").css("height", "0rem");
    $(".loteyPage").removeClass("gotop");
    $(".or_").removeClass("or_");
    showlz_listitem();
    bodyHtmlvis();
})
//全选 与清空  -----路珠分析
$("#zhfx_lz").on("click", ".checkAll,.noAll", function () {
    if ($(".zonghu").hasClass("checkspan")) { //综合模式
        if ($(this).attr("class") == "checkAll") { //全选 
            $("#zhfx_lz .zhms_mod li").addClass("check_tj")
        } else {
            $("#zhfx_lz .zhms_mod li").removeClass("check_tj")
        }
    } else if ($(".danxms").hasClass("checkspan")) { //单选模式
        if ($(this).attr("class") == "checkAll") { //全选 
            $("#zhfx_lz .dans_mod  li").addClass("check_tj")
        } else {
            $("#zhfx_lz .dans_mod  li").removeClass("check_tj")
        }
    } else { //双面模式
        if ($(this).attr("class") == "checkAll") { //全选 
            $("#zhfx_lz .lmms_mod li").addClass("check_tj")
        } else {
            $("#zhfx_lz .lmms_mod li").removeClass("check_tj")
        }
    }
})
////////////////////龙虎路珠界面
//今天，明天，前天
$("#timeUl li").on("click", function () {
    $(this).addClass("todayAct").siblings("li").removeClass("todayAct");
    var dateTime = $(".todayAct").attr("id");
    if (dateTime == "today") {
        pk10FunObj.lhlz.lhlzsData(getDateStr(0));
    } else if (dateTime == "yesterday") {
        pk10FunObj.lhlz.lhlzsData(getDateStr(-1));
    } else if (dateTime == "qianday") {
        pk10FunObj.lhlz.lhlzsData(getDateStr(-2));
    }

})
//点击筛选，弹出选择框
$("#shaixuanBtn").on("click", function () {
    showFun();
    bodyHtmlhide();
})
//多选名次
$("#lhlzmcul").find("li").on("click", function () {
    $(this).toggleClass("hmqhlzHMAct or_e");
})
//全选
$(".allxuan").on("click", function () {
    $("#lhlzmcul li").addClass("hmqhlzHMAct");
})
//清空
$(".clearall").on("click", function () {
    $("#lhlzmcul li").removeClass("hmqhlzHMAct");
})
//取消按钮
$("#cancelBtn").on("click", function () {
    removeclaOr();
    hideFun();
    bodyHtmlvis();
})
//龙虎路珠筛选名次
function checklhlzMinci() {
    var atcArr = $("#lhlzmcul").find(".hmqhlzHMAct"); //选中的名次
    $(".tablelist").hide();
    $(atcArr).each(function (index, el) {
        var valueNum = $(el).attr("value");
        var id = "#" + valueNum;
        $(id).show();
    })
}
//取消按钮 eva
function removeclaOr() {
    $(".or_e").each(function () {
        if ($(this).hasClass("hmqhlzHMAct")) {
            $(this).removeClass("hmqhlzHMAct").removeClass("or_e")
        } else {
            $(this).addClass("hmqhlzHMAct").removeClass("or_e")
        }
    })
    $(".or_e").removeClass("or_e")
}
//确定按钮
$("#sureBtn").on("click", function () {
    hideFun();
    checklhlzMinci();
    bodyHtmlvis();
    $(".or_e").removeClass("or_e");
})

function showFun() {
    $("#lhlzshaxBox").css({
        "height": $("body").height(),
        "top": "0"
    });
    bodyHtmlhide();
}

function hideFun() {
    $("#lhlzshaxBox").css({
        "height": "0",
        "top": "-20rem"
    });
    bodyHtmlvis();
}
//号码前后路珠
//今天，明天，前天
$("#timeUl li").on("click", function () {
    $(this).addClass("hmqhlxdayAct").siblings("li").removeClass("hmqhlxdayAct");
    var dateTime = $(".hmqhlxdayAct").attr("id");
    if (dateTime == "qhlztoday") {
        pk10FunObj.hmqhlz.hmqhlzData(getDateStr(0));
    } else if (dateTime == "qhlzyesterday") {
        pk10FunObj.hmqhlz.hmqhlzData(getDateStr(-1));
    } else if (dateTime == "qhlzqianday") {
        pk10FunObj.hmqhlz.hmqhlzData(getDateStr(-2));
    }
})
//点击筛选，弹出选择框
$("#hmqhlzsxBtn").on("click", function () {
    showFun_qhlz();
})
//多选名次
$("#hmqhlzmcul").find("li").on("click", function () {
    $(this).toggleClass("hmqhlzHMAct or_e");
})
//全选
$(".qhlzallxuan").on("click", function () {
    $("#hmqhlzmcul li").addClass("hmqhlzHMAct");
})
//清空
$(".qhlzclearall").on("click", function () {
    $("#hmqhlzmcul li").removeClass("hmqhlzHMAct");
})

//取消按钮
$("#hmqhlzNBtn").on("click", function () {
    bodyHtmlvis();
    hideFun_qhlz();
    removeclaOr();
})
//确定按钮
$("#hmqhlzYBtn").on("click", function () {
    hideFun_qhlz();
    checkhmqhlzHm();
    $(".or_e").removeClass("or_e");
})
//、、、、、、、、、、、、、、、、、、、、、、、、、、、---------------------------------位置走势
//查看
$(".lookshjtj").on("click", function (e) {
    e.preventDefault();
    var showcls = $(".wezizs .Pattern .checkspan").attr("class").replace(" ", "").replace("checkspan", "");
    var elm = $(".table_" + showcls).find(".clospan")
    $("html,body").animate({
        scrollTop: $(".footer").offset().top
    }, 500);
})
$(".wezizs").on("click", ".Pattern span", function (e) {
    var shoclass = $(this).attr("class").replace(" ", "").replace("checkspan", "");
    $(".table_" + shoclass).show().siblings().hide();
    if ($(e.target).hasClass("hamafb")) {
        $(".wzzslodiv").show()
    } else {
        $(".wzzslodiv").hide()
    }
    //  if(shoclass == "hamafb") {
    orshowConten() // 过滤一下条件筛选 
    //      $(".wezizs canvas").remove()
    //      setTimeout(function() {
    //          chartOfBaseTrend.weizhiLine("trend_table2") //会制线
    //      }, 500)

    //  }
})
//$("td:not([class])").find("span").hide()   遗漏
$("#tiaojian_wzzs").on("click", ".marginTop>li", function () {
    $(this).toggleClass("check_tj or_");
})

function fancongshow() { //遗漏分层
    if ($(".wezizs .hamafb").hasClass("checkspan")) {
        var tr = $(".table_hamafb tbody tr");
        tr = tr.slice(0, tr.length - 6)
        var trLen = tr.length;
        var tdcount = tr.filter(":first").children("td").size();
        for (var i = 2; i < tdcount; i++) {
            for (var j = 0; j <= trLen; j++) {
                var $td = tr.eq(j).children("td").eq(i);
                if ($td.hasClass("hot")) {
                    break;
                }
                $td.addClass("fancongcls");
            }
        }
        return false;
    } else if ($(".wezizs .sttz").hasClass("checkspan")) {
        var tr = $(".table_sttz tbody tr");
    } else if ($(".wezizs .lu012").hasClass("checkspan")) {
        var tr = $(".table_lu012 tbody tr");
    } else if ($(".wezizs .spj").hasClass("checkspan")) {
        var tr = $(".table_spj tbody tr");
    }
    tr = tr.slice(0, tr.length - 6)
    var trLen = tr.length;
    var tdcount = tr.filter(":first").children("td").size();
    for (var i = 2; i < tdcount; i++) {
        for (var j = 0; j <= trLen; j++) {
            var $td = tr.eq(j).children("td").eq(i);
            if ($td.hasClass("numodd") || $td.hasClass("numeven")) {
                break;
            }
            $td.addClass("fancongcls");
        }
    }
}

function orshowConten() { //位置走势 table 的筛选条件
    if ($(".yilo").hasClass("check_tj")) {
        $("td:not([class])").find("span").show();
        $(".showspan span").show()
    } else {
        $("td:not([class])").find("span").hide();
        $(".fancongcls span").hide()
        $(".showspan span").hide()

    }
    if ($(".caix").hasClass("check_tj")) {
        if ($(".hamafb").hasClass("checkspan")) {
            $("canvas").remove();
            setTimeout(function () {
                chartOfBaseTrend.weizhiLine("trend_table2") //会制线
            }, 500)
        }
    } else {
        $(".table_conBox canvas").hide()
    }
    if ($(".fancong").hasClass("check_tj")) {
        fancongshow()
    } else {
        $(".fancongcls").addClass("showspan")
        $(".fancongcls").removeClass("fancongcls")
    }
    if ($(".fgx").hasClass("check_tj")) {
        $(".line_wzzs").remove();
        if ($(".wezizs .hamafb").hasClass("checkspan")) {
            var tr = $(".table_hamafb tbody tr");
        } else if ($(".wezizs .sttz").hasClass("checkspan")) {
            var tr = $(".table_sttz tbody tr");
        } else if ($(".wezizs .lu012").hasClass("checkspan")) {
            var tr = $(".table_lu012 tbody tr");
        } else if ($(".wezizs .spj").hasClass("checkspan")) {
            var tr = $(".table_spj tbody tr");
        }
        for (var i = 2; i < tr.length - 6; i += 5) {
            $(tr[i]).after("<tr class='line_wzzs'><td></td></tr>")
        }

    } else {
        $(".line_wzzs").remove()
    }

}
$("#tiaojian_wzzs").on("click", ".sure", function () {
    $(".gotop").css("height", "0rem");
    $("#tiaojian_wzzs").removeClass("gotop");
    $(".or_").removeClass("or_");
    bodyHtmlvis();
    orshowConten();
})
$(".table_conditions").on("click", "p>span", function () {
    var cla = $(this).attr("class");
    if (cla == "weai") {
        $("#rank_wzzs").addClass("gotop");
    } else if (cla == "shjian") {
        $("#periods_wzzs").addClass("gotop");
    } else if (cla == "tiaojian") {
        $("#tiaojian_wzzs").addClass("gotop")
    }
    $(".gotop").css("height", $("body").height());
    bodyHtmlhide();
})

$("#periods_wzzs").on("click", ".pk10rank>ul>li", function (e) {
    //  debugger;
    $(this).addClass("checked").siblings().removeClass("checked");
    var tex = $(this).attr("data-text");
    if (tex == "0") {
        //getDateStr(-1)
        pk10FunObj.wzzs.getlist(getDateStr(0), "")
    } else if (tex == "1") {
        pk10FunObj.wzzs.getlist(getDateStr(-1), "")
    } else if (tex == "2") {
        pk10FunObj.wzzs.getlist(getDateStr(-2), "")
    } else {
        pk10FunObj.wzzs.getlist("", tex)
    }
    $(".shjian").text($(this).text())
    $(".gotop").css("height", "0rem");
    $("#periods_wzzs").removeClass("gotop")
    bodyHtmlvis();
})

function checkhmqhlzHm() {
    var atcArr = $("#hmqhlzmcul").find(".hmqhlzHMAct"); //选中的名次
    $(".tablelist").hide();
    $(atcArr).each(function (index, el) {
        var valueNum = $(el).attr("value");
        var id = "#" + valueNum;
        $(id).show();
    })
}

function showFun_qhlz() {
    bodyHtmlhide();
    $("#hmqhlzshaxBox").css({
        "height": $("body").height(),
        "top": "0"
    });
}

function hideFun_qhlz() {
    bodyHtmlvis()
    $("#hmqhlzshaxBox").css({
        "height": "0",
        "top": "-20rem"
    });
}

// 号码规律统计

//选中1-10号码切换
$("#gltjhmNum li").on("click", function () {
    $(this).addClass("hmglNumAct").siblings().removeClass("hmglNumAct");
    var liLen = $("#gltjhmNum li").length;
    code = $("#gltjhmNum li[class='hmglNumAct']").text();
    periods = ifChecked().issue;
    time = ifChecked().time;
    pk10FunObj.hmgltj.gltjData(periods, code, time);
    //显示对同位号码球
    $(".circle" + code).removeClass("defalut_circle");
    for (var i = 1; i < 11; i++) {
        if (i != code) {
            $(".circle" + i).addClass("defalut_circle")
        }
    }
})
//今天点击
$("#todayBtn").on("click", function () {
    showgltjFun();
})
//取消按钮
$("#gltjBtn").on("click", function () {
    hidegltjFun();
})
//今天 昨天  前天 30  60  90选择
$("#gltjul li").on("click", function () {
    $(this).addClass("timesAtc").siblings().removeClass("timesAtc");
    $("#todayBtn p").text($(".timesAtc").text());
    hidegltjFun();
    code = $("#gltjhmNum li[class='hmglNumAct']").text();
    periods = ifChecked().issue;
    time = ifChecked().time;
    pk10FunObj.hmgltj.gltjData(periods, code, time);
})
//图标、数据切换
$(".tusjbox span").on("click", function () {
    $(this).addClass("tubiaocheck").siblings().removeClass("tubiaocheck");
    //切换图表，数据内容
    var iftubiaoCheck = $(".tubiaocheck").text();
    if (iftubiaoCheck == "图表") {
        $("#tblist").removeClass("displaynone");
        $("#datelist").removeClass().addClass("displaynone")
    } else if (iftubiaoCheck == "数据") {
        $("#tblist").removeClass().addClass("displaynone");
        $("#datelist").removeClass("displaynone")
    }
})
//数据----单双大小，号码分布
$(".qihsj").find("span").on("click", function () {
    $(this).addClass("gltjHMfb").siblings("span").removeClass("gltjHMfb");
    //切换单双大小，号码分布
    var ifdsdxShow = $(".gltjHMfb").attr("id");
    if (ifdsdxShow == "dsdxId") {
        $("#sjdsdxList").removeClass("displaynone");
        $(".sjhmfbList").addClass("displaynone");
    } else if (ifdsdxShow == "hmfbId") {
        $("#sjdsdxList").addClass("displaynone");
        $(".sjhmfbList").removeClass("displaynone");
        $("canvas").remove()
        setTimeout(function () {
            chartOfBaseTrend.haomagltj("trend_table2_hmgltj") //会制线
        }, 500)
    }

})

function showgltjFun() {
    $("#gltjshowBox").css({
        "height": $("body").height(),
        "top": "0"
    });
    bodyHtmlhide();

}

function hidegltjFun() {
    $("#gltjshowBox").css({
        "height": "0",
        "top": "-20rem"
    });
    bodyHtmlvis();
}

function ifChecked() {
    var id = $("#gltjul li[class='timesAtc']").attr("id");
    var num = $("#gltjhmNum").find("li[class='hmglNumAct']").text();
    var issue = null;
    var time = null;
    if (id == "gltjToday") {
        time = getDateStr(0);
    } else if (id == "gltjYesterday") {
        time = getDateStr(-1);
    } else if (id == "gltjQianday") {
        time = getDateStr(-2);
    } else if (id == "gltjThirty") {
        issue = "30";
    } else if (id == "gltjSixty") {
        issue = "60";
    } else if (id == "gltjNinety") {
        issue = "90";
    }
    return {
        num: num,
        issue: issue,
        time: time
    }
}

function getDateStr(AddDayCount) {
    var dd = new Date();
    dd.setDate(dd.getDate() + AddDayCount); //获取AddDayCount天后的日期
    var y = dd.getFullYear();
    var m = dd.getMonth() + 1; //获取当前月份的日期
    var d = dd.getDate();
    return y + "-" + m + "-" + d;
}

function typeOf(num, type) {
    if (type == "spj") {
        switch (num * 1) {
            case -1:
                return "降";
                break;
            case 0:
                return "平";
                break;
            case 1:
                return "升";
                break;
        }
    }
}
//冠亚和走势
//今天点击
$("#gyhtodayBtn").on("click", function () {
    showgyhFun();
})
//取消按钮
$("#gyhBtn").on("click", function () {
    hidegyhFun();
})
//今天 昨天  前天 30  60  90选择
$("#gyhul li").on("click", function () {
    $(this).addClass("gyhtimesAtc").siblings().removeClass("gyhtimesAtc");
    var texts = $(this).text();
    setTimeout(function () {
        $("#gyhtodayBtn span").text(texts);
    }, 500)
    hidegyhFun();
    var dateTime = $(".gyhtimesAtc").attr("id");
    if (dateTime == "gyhToday") {
        pk10FunObj.gyhzs.listData(getDateStr(0), "");
    } else if (dateTime == "gyhYesterday") {
        pk10FunObj.gyhzs.listData(getDateStr(-1), "");
    } else if (dateTime == "gyhQianday") {
        pk10FunObj.gyhzs.listData(getDateStr(-2), "");
    } else if (dateTime == "gyhShirty") {
        pk10FunObj.gyhzs.listData("", "30");
    } else if (dateTime == "gyhSixty") {
        pk10FunObj.gyhzs.listData("", "60");
    } else if (dateTime == "gyhNinety") {
        pk10FunObj.gyhzs.listData("", "90");
    }
})
//筛选
$("#gyhsxBtn").on("click", function () {
    sxshwoGyh();
    bodyHtmlhide();
})
//筛选取消
$(".reset_gyh").on("click", function () {
    removeclaOr();
    sxhideGyh();
    bodyHtmlvis();
})
//筛选确定
$(".sure_gyh").on("click", function () {
    sxhideGyh();
    bodyHtmlvis();
    $(".or_e").removeClass("or_e");
})
//筛选遗漏等值
$("#tiaojian_gyh .marginTop li").on("click", function () {
    $(this).toggleClass("hmqhlzHMAct or_e");
})
//查看
$(".gyhcksjtj").on("click", function (e) {
    e.preventDefault();
    $("html,body").animate({
        scrollTop: $(".clospan_gyh").offset().top
    }, 500);
})
//
$("#tiaojian_gyh").on("click", ".sure_gyh", function () {
    orshowConten_gyh();
})

function fancongshow_gyh() { //遗漏分层
    var tr = $(".gyhdateBox tbody tr");
    tr = tr.slice(0, tr.length - 5)
    var trLen = tr.length;
    var tdcount = tr.filter(":first").children("td").size();
    for (var i = 1; i < tdcount; i++) {
        for (var j = 0; j <= trLen; j++) {
            var $td = tr.eq(j).children("td").eq(i);
            if ($td.hasClass("hot_gyh")) {
                break;
            }
            $td.addClass("fancongcls_gyh");
        }
    }
}

function orshowConten_gyh() { //走势 table 的筛选条件
    //遗漏值
    if ($(".yilo_gyh").hasClass("hmqhlzHMAct")) {
        $(".yilou").find("span").show();
        $(".showspan span").show()
    } else {
        $(".yilou").find("span").hide();
        $(".fancongcls_gyh span").hide()
        $(".showspan span").hide()
    }
    //分层
    if ($(".fancong_gyh").hasClass("hmqhlzHMAct")) {
        fancongshow_gyh()
    } else {
        $(".fancongcls_gyh").addClass("showspan")
        $(".fancongcls_gyh").removeClass("fancongcls_gyh")
    }
    //分割线
    if ($(".fgx_gyh").hasClass("hmqhlzHMAct")) {
        $(".line_gyh").remove();
        var tr = $(".gyhdateBox tbody tr");
        for (var i = 2; i < tr.length - 5; i += 5) {
            $(tr[i]).after("<tr class='line_gyh'><td></td></tr>")
        }
    } else {
        $(".line_gyh").remove()
    }
    //拆线
    if ($(".caix_gyh").hasClass("hmqhlzHMAct")) {
        $("canvas").remove();
        setTimeout(function () {
            chartOfBaseTrend.guanyaheLine("trend_table2_gyhzs") //会制线
        }, 500)
    } else {
        $("canvas").remove();
    }
}

function showgyhFun() {
    $("#gyhshowBox").css({
        "height": $("body").height(),
        "top": "0"
    });
    bodyHtmlhide();
}

function hidegyhFun() {
    $("#gyhshowBox").css({
        "height": "0",
        "top": "-20rem"
    });
    bodyHtmlvis();
}

function sxshwoGyh() {
    $("#tiaojian_gyh").css({
        "height": $("body").height(),
        "top": "0"
    });
    bodyHtmlhide();
}

function sxhideGyh() {
    $("#tiaojian_gyh").css({
        "height": "0",
        "top": "-20rem"
    });
    bodyHtmlvis();
}
//玩法说明
$("#explainBtn_wfsm").on("click", function () {
    showExplain_smwf();
})
$(".closesm").on("click", function () {
    hideExplain_smwf();
})

function showExplain_smwf() {
    $(".explian_smwf").css({
        "height": $("body").height(),
        "top": "0"
    });
    bodyHtmlhide();
}

function hideExplain_smwf() {
    $(".explian_smwf").css({
        "height": "0",
        "top": "-20rem"
    });
    bodyHtmlvis();
}
//单双大小路珠
//今天，明天，前天
$("#timeUl_dsdxlz").on("click", "li", function () {
    $(this).addClass("todayAct_dsdxlz").siblings("li").removeClass("todayAct_dsdxlz");
    var dateTime = $(".todayAct_dsdxlz").attr("id");
    if (dateTime == "today_dsdxlz") {
        pk10FunObj.dsdxlz.dsdxlzsData(getDateStr(0));
    } else if (dateTime == "yesterday_dsdxlz") {
        pk10FunObj.dsdxlz.dsdxlzsData(getDateStr(-1));
    } else if (dateTime == "qianday_dsdxlz") {
        pk10FunObj.dsdxlz.dsdxlzsData(getDateStr(-2));
    }

})
//点击筛选，弹出选择框
$("#shaixuanBtn_dsdxlz").on("click", function () {
    showFun_dsdxlz();
})
//多选名次
$("#dsdxlzmcul").find("li").on("click", function () {
    $(this).toggleClass("hmqhlzHMAct or_e");
})
//全选
$(".allxuan_dsdxlz").on("click", function () {
    $("#dsdxlzmcul li").addClass("hmqhlzHMAct");
})
//清空
$(".clearall_dsdxlz").on("click", function () {
    $("#dsdxlzmcul li").removeClass("hmqhlzHMAct");
})
//大小，单双
$(".sxlz_dsdxlz").on("click", "span", function () {
    $(this).addClass("state_dsdx or_e2").siblings("span").removeClass("state_dsdx").addClass("or_e2");
})

//取消按钮
$("#cancelBtn_dsdxlz").on("click", function () {
    hideFun_dsdxlz();
    removeclaOr();
    $(".or_e2").each(function () {
        if ($(this).hasClass("state_dsdx")) {
            $(this).removeClass("state_dsdx")
        } else {
            $(this).addClass("state_dsdx")
        }
    })
    $(".or_e2").removeClass("or_e2");
})
//确定按钮
$("#sureBtn_dsdxlz").on("click", function () {
    hideFun_dsdxlz();
    showSxend(); //显示筛选条件内容
    $(".or_e").removeClass("or_e");
    $(".or_e2").removeClass("or_e2");
})

function showSxend() {
    $("#dsdxlzlist .lz_title").hide();
    var atcArr = $("#dsdxlzmcul").find(".hmqhlzHMAct"); //选中的名次
    $(atcArr).each(function (index, el) {
        var valueNum = $(el).attr("value");
        var classShow = "." + valueNum;
        var table_List = $("#dsdxlzlist").find(classShow);
        var thisIs = $(".state_dsdx").attr("id");
        if (thisIs == "daxiao") {
            $(table_List).each(function () {
                if ($(this).hasClass("daxiaoShow")) {
                    $("#dsdxlzlist").find(this).show();
                } else {
                    $("#dsdxlzlist").find(this).hide();
                }
            })
        } else if (thisIs == "danshaung") {
            $(table_List).each(function () {
                if ($(this).hasClass("dansuShow")) {
                    $("#dsdxlzlist").find(this).show();
                } else {
                    $("#dsdxlzlist").find(this).hide();
                }
            })
        }
    })
}

function showFun_dsdxlz() {
    $("#dsdxlzshaxBox").css({
        "height": $("body").height(),
        "top": "0"
    });
    bodyHtmlhide();
}

function hideFun_dsdxlz() {
    $("#dsdxlzshaxBox").css({
        "height": "0",
        "top": "-20rem"
    });
    bodyHtmlvis();
}
//号码前后，龙虎路珠分析最新一期闪动
function animate_lz_dsdxlz() {
    var p = 0;
    var result = $(".dsdxlz_content>div>.lz_item>table>tbody>.tablebox td:first-child p:last-child");
    result.css("font-weight", "bold");
    var timeOutId = setTimeout(function () {
        result.fadeOut(100).fadeIn(100);
        p++;
        if (p == 1) {
            timeOutId = setInterval(arguments.callee, 600);
        }
        if (p == 30) {
            window.clearInterval(timeOutId);
        }
    }, 1000);
    $(function () {
        var setTime = setInterval(function () {
            if ($(".tb").length != 0) {
                clearInterval(setTime)
            }
            $(".tb").css({
                "color": "#fff",
                "background": "#ED2842"
            });
        }, 200)
    })
}
$(function () {
    //  pk10FunObj.dsdxlz.dsdxlzsData("")
    //  pk10FunObj.lzfx.init();
    //  pk10FunObj.gyhlz.init();
    //  pk10FunObj.jrhmtj.init();
    //  pk10FunObj.lerefx.init();
    //  pk10FunObj.wzzs.init();
    //  pk10FunObj.dsdxlsObj.dsdxlsData();
    //  pk10FunObj.longhutjObj.longhutjData();
    //  pk10FunObj.gyhlmlsObj.gyhlmlsData();
    //  pk10FunObj.lhlz.lhlzsData();
    //  pk10FunObj.hmqhlz.hmqhlzData();
    //  pk10FunObj.gyhzs.listData("", "30");
    //  //  chartOfBaseTrend.weizhiLine() //会制线
    //  var code = $("#gltjhmNum li[class='hmglNumAct']").text();
    //  var periods = ifChecked().issue;
    //  pk10FunObj.hmgltj.gltjData(periods, code,"");
})
// table 分页公共------------------------------------------------------------
function listettablearr(dataarr) { //  公共存储table分页数据
    if (dataarr.length <= config.showrows) {
        $(".lomorediv").hide()
    } else {
        if ($(".haomazs").css("display") != "none") {
            if ($(".hamafb").hasClass("checkspan")) {
                $(".lomorediv").show().attr("data-text", 0);
                $(".nextlo").show();
            } else {
                $(".lomorediv").hide();
            }
        } else {
            $(".lomorediv").show().attr("data-text", 0);
            $(".nextlo").show();
        }
    }
    pk10tabledata = [];
    for (var i = 0, les = Math.ceil(dataarr.length / config.showrows); i < les; i++) {
        var temarr = [];
        temarr.push(dataarr.slice(i * config.showrows, (i + 1) * config.showrows));
        pk10tabledata.push(temarr);
    }
    $(".prevlo").hide().parent().attr("data-text", 0)
}
var wzzstablefooter = "" //wzzs table footer
var gyhzsfooter = "" //冠亚和走势 footerdata
var pk10tabledata = ""; //tabel data 分页

//click加载分页数据----------------------------------------------位置走势
$(".wzzslodiv").on("click", "span", function (e) {
    var $this = $(this);
    var maxpage = pk10tabledata.length;
    var pagenum = $(this).parent().attr("data-text") * 1;
    if ($this.attr("id") == "wzzslo_left") {
        if (pagenum - 1 == 0) {
            $(this).hide();
        }
        $(this).siblings().css("display", "inline-block").parent().attr("data-text", pagenum -= 1);

    } else if ($this.attr("id") == "wzzslo_right") {
        if (pagenum + 2 == maxpage) {
            $(this).hide();
        }
        $(this).siblings().css("display", "inline-block").parent().attr("data-text", pagenum += 1);
    }
    eachconten_pk10(pk10tabledata[pagenum][0]);
    $("html,body").animate({
        scrollTop: $(".haomazs").offset().top
    }, 500);
});

function eachconten_pk10(arr) { //位置走势
    var html = "<tr>";
    var numrank = $("#rank_wzzs ul .checked").attr("data-text") * 1;
    $(arr).each(function (index) {
        var numarr = this.drawCode;
        //      console.log(numrank)
        var febu = this.array.slice(0, 10);
        html += " <td>" + this.preIssue + "</td><td class='tabred'><span>" + numarr[numrank] + "</span></td>"
        for (var i = 0; i < febu.length; i++) {
            if (febu[i] * 1 > 0) {
                html += "<td class='hot'><span name='hotSpan'>" + febu[i] + "</span></td>"
            } else {
                html += "<td><span>" + Math.abs(febu[i]) + "</span></td>"
            }
        }
        html += "</tr>";
    })
    $("#trend_table2 tbody").html(html + wzzstablefooter);
    orshowConten();; //绘图
};
$("#rank_wzzs").on("click", "li", function () {
    $(".gotop").css("height", "0rem");
    $("#rank_wzzs").removeClass("gotop");
    bodyHtmlvis();
    $(this).addClass("checked").siblings().removeClass("checked");
    $(".weai").text($(this).text()).attr("data-text", $(this).attr("data-text"))
    rank_pk10 = $(this).attr("data-text") * 1;
    pk10FunObj.wzzs.createHtmlList(pk10weizzsdata, rank_pk10);
})
//--------------------------------------冠亚和走势
function eachcontengyhzs(arr) {
    $(".gyhdateBox tbody").empty();
    $(arr).each(function (index) {
        if (lotCode == 10037) {
            var eachlength = config.showrows
        } else {
            var eachlength = 200
        }
        if (index > eachlength) {
            return
        }
        var preIssue = "<td>" + this.preIssue + "</td>";
        var missingtd = "";
        var sum = this.gySum;;
        $(this.missing).each(function (index) {
            var title = "";
            var bgqiu = "";
            var yilou = sum;
            if (this * 1 > 0) {
                title = "title='0' class='hot_gyh'";
                bgqiu = "style='background:" + color[1] + "'";
            } else {
                yilou = Math.abs(this);
                title = "class='yilou'";
            }
            if (index > 16) {
                return;
            }
            missingtd += "<td " + title + "><span " + bgqiu + ">" + yilou + "</span></td>";
        });
        var tr = "<tr class='yiloutr'>" + preIssue + "" + missingtd + "</tr>";
        $(".gyhdateBox tbody").append(tr);
    });
    $(".gyhdateBox tbody").append(gyhzsfooter);
}
$(".gyhzslodiv").on("click", "span", function (e) {
    var $this = $(this);
    var maxpage = pk10tabledata.length;
    var pagenum = $(this).parent().attr("data-text") * 1;
    if ($this.attr("id") == "gyhzslo_left") {
        if (pagenum - 1 == 0) {
            $(this).hide();
        }
        $(this).siblings().css("display", "inline-block").parent().attr("data-text", pagenum -= 1);

    } else if ($this.attr("id") == "gyhzslo_right") {
        if (pagenum + 2 == maxpage) {
            $(this).hide();
        }
        $(this).siblings().css("display", "inline-block").parent().attr("data-text", pagenum += 1);
    }
    eachcontengyhzs(pk10tabledata[pagenum][0]);
    $("html,body").animate({
        scrollTop: $(".headTitle").offset().top
    }, 500);
    orshowConten_gyh();
});

var pk10FunObj = {
    jrhmtj: { //今日号码统计
        init: function () {
            this.getdata()
        },
        getdata: function (date) {
            date = date == undefined ? "" : date;
            $.ajax({
                url: config.publicUrl + "pks/queryToDayNumberLawOfStatistics.do?date=" + date,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    pk10FunObj.jrhmtj.createHtml(data)
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("todayData data error");
                    }
                }
            });
        },
        createHtml: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            if (data.errorCode == 0) {
                var html = "";
                var arr = data.result.data;
                var text = "";
                for (var i = 0; i < arr.length; i++) {
                    if (i == 0) {
                        text = "冠军"
                    } else if (i == 1) {
                        text = "亚军"
                    } else if (i == 2) {
                        text = "第三"
                    } else if (i == 3) {
                        text = "第四"
                    } else if (i == 4) {
                        text = "第五"
                    } else if (i == 5) {
                        text = "第六"
                    } else if (i == 6) {
                        text = "第七"
                    } else if (i == 7) {
                        text = "第八"
                    } else if (i == 8) {
                        text = "第九"
                    } else if (i == 9) {
                        text = "第十"
                    }
                    html += "<div class='item_" + (i + 1) + " item_'><span class='item_title'>" + text + "</span><ul class='num_item'>";
                    html += "<li class='li_first'>号码</li><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li> <li>7</li><li>8</li><li>9</li><li>10</li></ul>";
                    var zonkai = "<ul class='zongkai_item'><li class='li_first'>总开</li>",
                        weikai = "<ul class='weikai_item'><li class='li_first'>未开</li>";
                    for (var c = 0; c < arr[i].list.length; c++) {
                        var $this = arr[i].list[c];
                        if ($this.accumulate >= 15 && $this.accumulate <= 30) {
                            var cla1 = "rednum_tj"
                        } else if ($this.accumulate >= 31 && $this.accumulate <= 40) {
                            var cla1 = "bluenum_tj"
                        } else if ($this.accumulate >= 41 && $this.accumulate <= 50) {
                            var cla1 = "greennum_tj"
                        } else {
                            var cla1 = ""
                        }
                        if ($this.missing >= 15 && $this.missing <= 30) {
                            var cla2 = "rednum_tj"
                        } else if ($this.missing >= 31 && $this.missing <= 40) {
                            var cla2 = "bluenum_tj"
                        } else if ($this.missing >= 41 && $this.missing <= 50) {
                            var cla2 = "greennum_tj"
                        } else {
                            var cla2 = ""
                        }
                        zonkai += "<li class='" + cla1 + "'>" + $this.accumulate + "</li>";
                        weikai += "<li class='" + cla2 + "'>" + $this.missing + "</li>";
                    }
                    html += zonkai + "</ul>" + weikai + "</ul></div>"
                }
                //              debugger
            }
            $(".todayhaomatj .showconten").html(html)
        }
    },
    lzfx: { //路珠分析 
        init: function () {
            this.getlist("")
        },
        getlist: function (date) {
            if (date == "") {
                $(".today_lz").addClass("checkspan").siblings().removeClass("checkspan");
            }
            $.ajax({
                url: config.publicUrl + "pks/queryComprehensiveRoadBead.do",
                type: "GET",
                data: {
                    "lotCode": lotCode,
                    "date": date
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.lzfx.addlzTable(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        addlzTable: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            //rank:名次,1-10分别为第一——第十名,11为冠亚和
            //state形态:如1.单双;2.大小;3.龙虎
            //totals：长度为2的数组,数组第一个元素表示单、大、龙;第二个元素表示双、小、虎
            //roadBeads:数组,数组的元素值为0或1,1表示单、大、龙;0表示双、小、虎
            //向不同的box中填值1到5有大小单双龙虎三种类型  6-11到有2个类型，没有龙虎
            //data ajax返回的数据，state==1 单双 state==2 大小 state==3 龙虎    11 = 冠亚和单双  12 冠亚和大小
            //          console.log(dataarr);
            //          return;
            $(".luzufx .lz_content").html("");
            var classe = "";
            for (var i = 0; i < data.result.data.length; i++) {
                var state = data.result.data[i].state;
                if (state == 1) {
                    var text1 = "双";
                    var text2 = "单";
                    var abc = "单双"
                    classe = "dansuShow"
                } else if (state == 2) {
                    var text1 = "小";
                    var text2 = "大";
                    var abc = "大小";
                    classe = "daxiaoShow"
                } else if (state == 3) {
                    var text1 = "虎";
                    var text2 = "龙";
                    var abc = "龙虎";
                    classe = "longhuShow"
                }
                //              else if(state == 11) {
                //                  var text1 = "单";
                //                  var text2 = "双";
                //                  var abc = "单双"; //冠亚和
                //                  classe = "ganyudanxShow"
                //              } else if(state == 12) {
                //                  var text1 = "大";
                //                  var text2 = "小";
                //                  var abc = "大小"; ///冠亚和
                //                  classe = "guanyudaxiaoshow"
                //              }
                var html2, html3;
                var rank = data.result.data[i].rank
                //              if(rank == 11 && state == 1) {
                //                  classe = "ganyudanxShow"
                //              } else if(rank == 11 && state == 2) {
                //                  classe = "guanyudaxiaoshow"
                //              }
                var html = "<div class='lz_title " + classe + " ball_" + rank + "'><div class='left'><span>今日累计:</span>";
                var html3 = "<div class='lz_item'><table class='lz_table_con' border='0' cellpadding='1' cellspacing='1'><tbody><tr class='tablebox'><td>"
                data.result.data[i].roadBeads = data.result.data[i].roadBeads.reverse()
                for (var c = 0, textCount = 0, text2Count = 0, text3Count = 0; c < data.result.data[i].roadBeads.length; c++) {
                    if (c >= 200) { //当极速冠亚和路珠数据太多，只展示最新200条
                        break
                    }
                    var num = data.result.data[i].roadBeads[c];
                    if (num == 0) {
                        num = text1;
                        textCount += 1;
                    } else if (num == 1) {
                        num = text2;
                        text2Count += 1;
                    } else if (num == 2) {
                        num = text3;
                        text3Count += 1;
                    }
                    if (c == 0) {
                        html3 += "<p>" + num + "</p>";
                    }
                    if (c > 0 & data.result.data[i].roadBeads[c - 1] == data.result.data[i].roadBeads[c]) {
                        html3 += "<p>" + num + "</p>";
                    } else if (c > 0 & data.result.data[i].roadBeads[c - 1] != data.result.data[i].roadBeads[c]) {
                        html3 += "</td><td><p>" + num + "</p>";
                    }

                }
                var MAcount = "";

                if (rank == 1) {
                    MAcount = "冠军"
                } else if (rank == 2) {
                    MAcount = "亚军"
                } else if (rank == 3) {
                    MAcount = "第三名"
                } else if (rank == 4) {
                    MAcount = "第四名"
                } else if (rank == 5) {
                    MAcount = "第五名"
                } else if (rank == 6) {
                    MAcount = "第六名"
                } else if (rank == 7) {
                    MAcount = "第七名"
                } else if (rank == 8) {
                    MAcount = "第八名"
                } else if (rank == 9) {
                    MAcount = "第九名"
                } else if (rank == 10) {
                    MAcount = "第十名"
                } else if (rank == 11) {
                    MAcount = "冠亚和"
                }

                //              if(text3 == "") {
                var html2 = "<span>" + text1 + "（" + data.result.data[i].totals[1] + "）</span><span>" + text2 + "（" + data.result.data[i].totals[0] + "）</span></div>" +
                    "<div class='right'><span class='weizi'>" + MAcount + "</span><span class='mosh'>" + abc + "</span><span class='zxi'>最新    &darr;</span></div>"
                //              } else {
                //                  var html2 = "<span>" + text1 + "（" + textCount + "）</span><span>" + text2 + "（" + text2Count + "）</span><span>" + text3 + "（" + text3Count + "）</span></div>" +
                //                      "<div class='right'><span>" + MAcount + "</span> &nbsp;<span>" + abc + "</span><span class='zxi'>最新    &darr;</span></div></div>"
                //              }

                var html4 = "</td></tr></tbody></table></div></div>"

                $(".luzufx .lz_content").append(html + html2 + html3 + html4);
            }
            $(".tablebox>td>p:contains('大')").css("color", "red");
            $(".tablebox>td>p:contains('双')").css("color", "red");
            $(".tablebox>td>p:contains('龙')").css("color", "red");
            showlz_listitem();
            animate_lz();
        }
    },
    dsdxlsObj: { //单双大小历史
        dsdxlsData: function () {
            $.ajax({
                url: config.publicUrl + "pks/queryHistoryDataForDsdx.do",
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.dsdxlsObj.dsdxliHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        dsdxliHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            var getiTr = "";
            $("#tableBox tbody").empty();
            $(dataarr).each(function (index) {
                var $td0 = $(this)[0];
                var getiTd = "";
                var tddate = "<td >" + $td0.date + "</td>";
                //综合查看模式
                for (var i = 0; i < 10; i++) {
                    var td = "td" + i,
                        tr = "tr" + i;
                    td = "<td " + ">" + $td0.list[i].bigCount + "</td><td " + ">" + $td0.list[i].smallCount + "</td><td " + ">" + $td0.list[i].singleCount + "</td><td " + ">" + $td0.list[i].doubleCount + "</td>";
                    tr = "<tr style='height:38px'>" + tddate + "" + td + "</tr>";
                    $("#tbody" + i).append(tr);
                }
                //个体查看模式
                for (var j = 0; j < 4; j++) {
                    //j单双大小四个表格
                    getiTd = "getiTd" + j;
                    var ifdsdx = "";
                    for (var i = 0; i < $td0.list.length; i++) {
                        if (j == 0) {
                            ifdsdx = $td0.list[i].singleCount
                        } else if (j == 1) {
                            ifdsdx = $td0.list[i].doubleCount
                        } else if (j == 2) {
                            ifdsdx = $td0.list[i].bigCount
                        } else {
                            ifdsdx = $td0.list[i].smallCount
                        }
                        getiTd += "<td>" + ifdsdx + "</td>";
                    }
                    getiTr = "<tr style='height:38px'>" + tddate + "" + getiTd + "</tr>";
                    $("#gtbody" + j).append(getiTr);
                }
            })
        }
    },
    longhutjObj: { //龙虎统计
        longhutjData: function () {
            $.ajax({
                url: config.publicUrl + "pks/queryHistoryDataForDt.do",
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.longhutjObj.cltjHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        cltjHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            $(dataarr).each(function (index) {
                var tddate = "<td>" + $(this)[0].date + "</td>";
                var firstDragon = "<td height='33'>" + $(this)[0].firstDragon + "</td>";
                var firstTiger = "<td>" + $(this)[0].firstTiger + "</td>";
                var secondDragon = "<td>" + $(this)[0].secondDragon + "</td>";
                var secondTiger = "<td>" + $(this)[0].secondTiger + "</td>";
                var thirdDragon = "<td>" + $(this)[0].thirdDragon + "</td>";
                var thirdTiger = "<td>" + $(this)[0].thirdTiger + "</td>";
                var fourthDragon = "<td>" + $(this)[0].fourthDragon + "</td>";
                var fourthTiger = "<td>" + $(this)[0].fourthTiger + "</td>";
                var fifthDragon = "<td>" + $(this)[0].fifthDragon + "</td>";
                var fifthTiger = "<td>" + $(this)[0].fifthTiger + "</td>";
                var tr = "<tr>" + tddate + "" + firstDragon + "" + firstTiger + "" + secondDragon + "" + secondTiger + "" + thirdDragon + "" + thirdTiger + "" + fourthDragon + "" + fourthTiger + "" + fifthDragon + "" + fifthTiger + "</tr>";
                $("#longhutjBox").find("tbody").append(tr);
            })
        },
    },
    gyhlmlsObj: { //冠亚和两面历史
        gyhlmlsData: function () {
            $.ajax({
                url: config.publicUrl + "pks/queryHistoryDataForGyh.do",
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.gyhlmlsObj.gyhlmlsHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        gyhlmlsHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            $(dataarr).each(function () {
                var tddate = "<td>" + this.date + "</td>";
                var gyhBig = "<td>" + this.gyhBig + "</td>";
                var gyhSmall = "<td>" + this.gyhSmall + "</td>";
                var gyhSingle = "<td>" + this.gyhSingle + "</td>";
                var gyhDouble = "<td>" + this.gyhDouble + "</td>";
                var tr = "<tr height='40'>" + tddate + "" + gyhBig + "" + gyhSmall + "" + gyhSingle + "" + gyhDouble + "</tr>"
                $("#gyhlmlsBox").find("tbody").append(tr);
            })
        }
    },
    lhlz: { //龙虎路珠
        lhlzsData: function (time) {
            time = time == undefined ? "" : time; //如果请求数据time为undefined处理为""
            if (time == "") {
                $("#today").addClass("todayAct hmqhlxdayAct").siblings().removeClass("todayAct hmqhlxdayAct");
            }
            $.ajax({
                url: config.publicUrl + "pks/queryComprehensiveRoadBead.do?date=" + time,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.lhlz.lhlzHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        lhlzHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            $("#lhlzlist").find(".lhlzItems").empty();
            $(dataarr).each(function (index) {
                //挑选rank=1-5，state=3(龙虎)的数据即可
                if (this.rank <= 5 && this.state == 3) {
                    pk10FunObj.lhlz.forRank(this.rank, this)
                    if (index == 14) {
                        animate_lz_hmqh();
                    }
                } else {
                    return;
                }
            });
        },
        forRank: function (rank, data) {
            //rank:名次,1-10分别为第一——第十名
            //state形态:如1.单双;2.大小;3.龙虎
            //totals：长度为2的数组,数组第一个元素表示 龙;第二个元素表示 虎
            //roadBeads:数组,数组的元素值为0或1,  1表示  龙;  0表示   虎
            var longdata = data.totals[0];
            var hudata = data.totals[1];
            var roadBeads = data.roadBeads;
            var lhlzMinci = pk10FunObj.lhlz.typeOf_lhlz(data.rank, "rank");
            var ifdisplay = "";
            if (rank * 1 > 2) {
                ifdisplay = "displaynone"
            } else {
                ifdisplay = "displayblock"
            }
            var htmlstr = "",
                headHtml = "",
                bodystart = "",
                bodyend = "",
                tdhtml = "";
            headHtml = "<div id='t" + (rank - 1) + "' class='tablelist " + ifdisplay + "'><div class='itemHead'>" +
                "<div class='l_jrlj'>今日累计：<span class='lspan'>龙（<i class='longNum'>" + longdata + "</i>）</span><span class='rspan'>虎（<i class='huNum'>" + hudata + "</i>）</span></div>" +
                "<div class='r_new'><span>" + lhlzMinci + "</span><span>龙虎</span><span>最新 &darr;</span></div></div>";
            bodystart = "<div class='itemBody'>" +
                "<div class='lz_item'>" +
                "<table class='lz_table_con' border='0' cellpadding='1' cellspacing='1'>" +
                "<tbody><tr class='tablebox'>";
            bodyend = "</tr></tbody></table></div></div></div>";
            htmlstr = headHtml + "" + bodystart + "" + bodyend;
            $("#lhlzlist").find(".lhlzItems").append(htmlstr);
            $(roadBeads.reverse()).each(function (index) {
                if (index >= 200) { //当极速号码前后路珠系列数据太多，只展示最新200条
                    return
                }
                var tdTtems = "",
                    pitems = "";
                var longOrhu = (this == 1) ? "龙" : "虎";
                if (index > 0) {
                    if (roadBeads[index] != roadBeads[index - 1]) {
                        //前后不一样，则另起一样新td
                        tdTtems = "<td><p>" + longOrhu + "</p></td>";
                        $("#t" + (rank - 1) + " .tablebox").append(tdTtems);
                    } else {
                        //如果一样则新加p标签
                        pitems = "<p>" + longOrhu + "</p>"
                        $("#t" + (rank - 1) + " .tablebox").find("td:last-child").append(pitems)
                    }
                } else {
                    tdhtml = "<td><p>" + longOrhu + "</p></td>";
                    $("#t" + (rank - 1) + " .tablebox").append(tdhtml);
                }
            });
            checklhlzMinci();
        },
        typeOf_lhlz: function (num, type) {
            if (type == "rank") {
                switch (num * 1) {
                    case 1:
                        return "冠军";
                        break;
                    case 2:
                        return "亚军";
                        break;
                    case 3:
                        return "第三名";
                        break;
                    case 4:
                        return "第四名";
                        break;
                    case 5:
                        return "第五名";
                        break;
                }
            } else if (type == "code") {
                switch (num * 1) {
                    case 1:
                        return "号码1";
                        break;
                    case 2:
                        return "号码2";
                        break;
                    case 3:
                        return "号码3";
                        break;
                    case 4:
                        return "号码4";
                        break;
                    case 5:
                        return "号码5";
                        break;
                    case 6:
                        return "号码6";
                        break;
                    case 7:
                        return "号码7";
                        break;
                    case 8:
                        return "号码8";
                        break;
                    case 9:
                        return "号码9";
                        break;
                    case 10:
                        return "号码10";
                        break;
                }
            }
        }

    },
    gyhlz: { //冠亚和路珠
        init: function () {
            this.getlist("")
        },
        getlist: function (date) {
            if (date == "") {
                $(".today_lz").addClass("checkspan").siblings().removeClass("checkspan");
            }
            $.ajax({
                url: config.publicUrl + "pks/queryComprehensiveRoadBead.do",
                type: "GET",
                data: {
                    "lotCode": lotCode,
                    "date": date
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.gyhlz.addlzTable(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        addlzTable: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            //rank:名次,1-10分别为第一——第十名,11为冠亚和
            //state形态:如1.单双;2.大小;3.龙虎
            //totals：长度为2的数组,数组第一个元素表示单、大、龙;第二个元素表示双、小、虎
            //roadBeads:数组,数组的元素值为0或1,1表示单、大、龙;0表示双、小、虎
            //向不同的box中填值1到5有大小单双龙虎三种类型  6-11到有2个类型，没有龙虎
            //data ajax返回的数据，state==1 单双 state==2 大小 state==3 龙虎    11 = 冠亚和单双  12 冠亚和大小
            //          console.log(dataarr);
            //          return;
            $(".guyahelz .lz_content").html("");
            var classe = "";
            for (var i = 0; i < data.result.data.length; i++) {
                var state = data.result.data[i].state;
                if (state == 1) {
                    var text1 = "单";
                    var text2 = "双";
                    var abc = "单双"
                    classe = "dansuShow"
                } else if (state == 2) {
                    var text1 = "大";
                    var text2 = "小";
                    var abc = "大小";
                    classe = "daxiaoShow"
                }
                var html2, html3;
                var rank = data.result.data[i].rank
                if (rank != 11) {
                    continue
                }
                var html = "<div class='lz_title " + classe + " ball_" + state + "'><div class='left'><span>今日累计:</span>";
                var html3 = "<div class='lz_item'><table class='lz_table_con' border='0' cellpadding='1' cellspacing='1'><tbody><tr class='tablebox'><td>"
                data.result.data[i].roadBeads = data.result.data[i].roadBeads.reverse()
                for (var c = 0, textCount = 0, text2Count = 0, text3Count = 0; c < data.result.data[i].roadBeads.length; c++) {
                    if (c >= 200) { //当极速冠亚和路珠数据太多，只展示最新200条
                        break
                    }
                    var num = data.result.data[i].roadBeads[c];
                    if (num == 0) {
                        num = text1;
                        textCount += 1;
                    } else if (num == 1) {
                        num = text2;
                        text2Count += 1;
                    } else if (num == 2) {
                        num = text3;
                        text3Count += 1;
                    }
                    if (c == 0) {
                        html3 += "<p>" + num + "</p>";
                    }
                    if (c > 0 & data.result.data[i].roadBeads[c - 1] == data.result.data[i].roadBeads[c]) {
                        html3 += "<p>" + num + "</p>";
                    } else if (c > 0 & data.result.data[i].roadBeads[c - 1] != data.result.data[i].roadBeads[c]) {
                        html3 += "</td><td><p>" + num + "</p>";
                    }

                }
                //              var   MAcount = "冠亚和"
                var html2 = "<span>" + text1 + "（" + data.result.data[i].totals[1] + "）</span><span>" + text2 + "（" + data.result.data[i].totals[0] + "）</span></div>" +
                    "<div class='right'><span class='weizi'>冠亚和</span><span class='mosh'>" + abc + "</span><span class='zxi'>最新    &darr;</span></div>"

                var html4 = "</td></tr></tbody></table></div></div>"

                $(".guyahelz .lz_content").append(html + html2 + html3 + html4);
            }
            $(".tablebox>td>p:contains('大')").css("color", "red");
            $(".tablebox>td>p:contains('双')").css("color", "red");
            $(".tablebox>td>p:contains('龙')").css("color", "red");
            animate_lz();
        }
    },
    lerefx: { //冷热分析 
        init: function () {
            this.getdata()
        },
        getdata: function () {
            $.ajax({
                url: config.publicUrl + "pks/queryDrawCodeHeatState.do",
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    pk10FunObj.lerefx.createHtml(data)
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("todayData data error");
                    }
                }
            });
        },
        createHtml: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            if (data.errorCode == 0) {
                var html = "";
                var arr = data.result.data;
                var text = "";
                for (var i = 0; i < arr.length; i++) {
                    if (i == 0) {
                        text = "冠军"
                    } else if (i == 1) {
                        text = "亚军"
                    } else if (i == 2) {
                        text = "第三名"
                    } else if (i == 3) {
                        text = "第四名"
                    } else if (i == 4) {
                        text = "第五名"
                    } else if (i == 5) {
                        text = "第六名"
                    } else if (i == 6) {
                        text = "第七名"
                    } else if (i == 7) {
                        text = "第八名"
                    } else if (i == 8) {
                        text = "第九名"
                    } else if (i == 9) {
                        text = "第十名"
                    }
                    html += "<div class='item_lere" + (i + 1) + " item_'><span class='item_title'>" + text + "</span><ul class='num_item'>";
                    html += "<li class='li_first'>热号</li>";
                    var zonkai = "<ul class='zongkai_item'><li class='li_first'>温号</li>",
                        weikai = "<ul class='weikai_item'><li class='li_first'>冷号</li>",
                        hotNum = "";
                    var hotarr = arr[i].list[0].list;
                    var weiarr = arr[i].list[1].list;
                    var coldarr = arr[i].list[2].list;
                    for (var q = 0; q < hotarr.length; q++) {
                        hotNum += "<li class='hotnum'><span>" + hotarr[q].drawCode + "</span><span class='spanclass'>" + hotarr[q].count + "</span></li>";
                    }
                    for (var w = 0; w < weiarr.length; w++) {
                        zonkai += "<li class='hotnum'>" + weiarr[w].drawCode + "</li>";
                    }
                    for (var e = 0; e < coldarr.length; e++) {
                        weikai += "<li class='hotnum'>" + coldarr[e].drawCode + "</li>";
                    }
                    html += hotNum + "</ul>" + zonkai + "</ul>" + weikai + "</ul></div>"
                }
            }
            $(".lenrefx .showconten").html(html)
        }
    },
    hmqhlz: { //号码前后路珠
        hmqhlzData: function (time) {
            time = time == undefined ? "" : time; //如果请求数据time为undefined处理为""
            if (time == "") {
                $("#qhlztoday").addClass("todayAct hmqhlxdayAct").siblings().removeClass("todayAct hmqhlxdayAct")
            }
            $.ajax({
                url: config.publicUrl + "pks/queryFbRoadBead.do?date=" + time,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.hmqhlz.hmqhlzHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        hmqhlzHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            $("#hmqhlzlist").find(".hmqhlzItems ").empty();
            $(dataarr).each(function (index) {
                pk10FunObj.hmqhlz.forRank(this.code, this)
            });
        },
        forRank: function (code, data) {
            //  debugger
            //rank:名次,1-10分别为号码1-10
            //state形态:如1.单双;2.大小;3.龙虎 4.前后
            //totals：长度为2的数组,数组第一个元素表示 前;第二个元素表示 后
            //roadBeads:数组,数组的元素值为0或1,  1表示  前;  0表示   后
            var qiandata = data.totals[0];
            var houdata = data.totals[1];
            var roadBeads = data.roadBeads;
            var lhlzMinci = pk10FunObj.lhlz.typeOf_lhlz(data.code, "code");
            var ifdisplay = "";
            if (code * 1 > 2) {
                ifdisplay = "displaynone"
            } else {
                ifdisplay = "displayblock"
            }
            var htmlstr = "",
                headHtml = "",
                bodystart = "",
                bodyend = "",
                tdhtml = "";
            headHtml = "<div id='hm" + code + "' class='tablelist " + ifdisplay + "'><div class='itemHead'>" +
                "<div class='l_jrlj'>今日累计：<span class='lspan'>前（<i class='longNum'>" + qiandata + "</i>）</span><span class='rspan'>后（<i class='huNum'>" + houdata + "</i>）</span></div>" +
                "<div class='r_new'><span>" + lhlzMinci + "</span><span>前后</span><span>最新 &darr;</span></div></div>";
            bodystart = "<div class='itemBody'>" +
                "<div class='lz_item'>" +
                "<table class='lz_table_con' border='0' cellpadding='1' cellspacing='1'>" +
                "<tbody><tr class='tablebox'>";
            bodyend = "</tr></tbody></table></div></div></div>";
            htmlstr = headHtml + "" + bodystart + "" + bodyend;
            $("#hmqhlzlist").find(".hmqhlzItems").append(htmlstr);
            $(roadBeads.reverse()).each(function (index) {
                if (index >= 200) { //当极速号码前后路珠系列数据太多，只展示最新200条
                    return
                }
                var tdTtems = "",
                    pitems = "";
                var qianOrhou = (this == 1) ? "前" : "后";
                if (index > 0) {
                    if (roadBeads[index] != roadBeads[index - 1]) {
                        //前后不一样，则另起一样新td
                        tdTtems = "<td><p>" + qianOrhou + "</p></td>";
                        $("#hm" + code + " .tablebox").append(tdTtems);
                    } else {
                        //如果一样则新加p标签
                        pitems = "<p>" + qianOrhou + "</p>"
                        $("#hm" + code + " .tablebox").find("td:last-child").append(pitems)
                    }
                } else {
                    tdhtml = "<td><p>" + qianOrhou + "</p></td>";
                    $("#hm" + code + " .tablebox").append(tdhtml);
                }
            })
            checkhmqhlzHm();
            if (code == 10) {
                animate_lz_hmqh();
            }
        }

    },
    wzzs: { //位置走势
        init: function () {
            this.getlist("", 30)
        },
        getlist: function (time, periods) {
            //请求路珠list数据传入参数：time:时间；periods：期数
            time = time == undefined ? "" : time; //如果请求数据time为undefined处理为""
            periods = periods == undefined ? "" : periods; //如果请求数据periods为undefined处理为""
            if ((time == "" || time == getDateStr(0)) && periods == "") {
                $(".shjian").text("今天");
                $("#periods_wzzs ul li:first").addClass("checked").siblings().removeClass("checked")
            }
            $.ajax({ //pks/queryLocationTrend.do?date=2016-11-08&periods=30
                url: config.publicUrl + "pks/queryLocationTrend.do?date=" + time + "&periods=" + periods,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    pk10weizzsdata = data;
                    //执行数据请求
                    var data_text = $(".weai").attr("data-text");
                    var rank_pk10 = data_text == undefined ? 0 : data_text;
                    pk10FunObj.wzzs.createHtmlList(data, rank_pk10);
                },
                error: function (data) {
                    setTimeout(function () {
                        loadotherData() //重新请求list数据
                    }, 1000);
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        createHtmlList: function (jsondata, numrank) {
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data[numrank];
            // console.log(dataarr);
            // console.log(bodyList);
            listettablearr(dataarr.bodyList);
            $(".prevlo").hide();
            /*preIssue 开奖期数
            drawCode 数组，开始号码
            rank 名次,1-10名
            array  遗漏值，数组中小于零的值表示当前遗漏值，大于零表示当前名次在该号码上连接出现的次数
            appearCount 出现次数,数组长度为22
            averageMissingValues 平均遗漏值,数组长度为22
            currentMissingValues 当前遗漏值,数组长度为22
            maxAppearValues 最大连续出现值,数组长度为22
            maxMissingValues 最大遗漏值,数组长度为22*/

            $(".wezizs #chartLinediv").html("");
            var html = "",
                html2 = "",
                html3 = "",
                html4 = "";
            html += " <table  class='table_hamafb displaynone' id='trend_table2'>"
            html += "<thead><tr><th>期号</th><th>号码</th><th>1</th><th>2</th>"
            html += "<th>3</th><th>4</th><th>5</th>"
            html += "<th>6</th><th>7</th><th>8</th><th>9</th><th>10</th></tr></thead><tbody><tr>"

            html2 += "<table class='table_sttz displaynone'>"
            html2 += "<thead><tr><th>期数</th><th>号码</th><th colspan='2'>奇偶</th>"
            html2 += "<th colspan='2'>大小</th><th colspan='2'>质合</th></tr></thead><tbody><tr>"

            html3 += "<table class='table_lu012 displaynone'><thead><tr><th>期号</th><th class='short'>号码</th><th>0</th><th>1</th><th>2</th></tr></thead><tbody><tr>"

            html4 += "<table class='table_spj displaynone'><thead><tr><th>期号</th><th class='short'>号码</th><th>升</th><th>平</th><th>降</th></tr></thead><tbody><tr>"

            $(dataarr.bodyList).each(function (index) {
                var numarr = this.drawCode;
                var febu = this.array.slice(0, 10);
                var sttz = this.array.slice(10, 16);
                var lu012 = this.array.slice(16, 19);
                var spj = this.array.slice(19);
                if (lotCode == 10037) {
                    var eachlength = config.showrows
                } else {
                    var eachlength = 200
                }
                if (index < eachlength) {
                    html += " <td>" + this.preIssue + "</td><td class='tabred'><span>" + numarr[numrank] + "</span></td>"
                    for (var i = 0; i < febu.length; i++) {
                        if (febu[i] * 1 > 0) {
                            html += "<td class='hot'><span name='hotSpan'>" + febu[i] + "</span></td>"
                        } else {
                            html += "<td><span>" + Math.abs(febu[i]) + "</span></td>"
                        }
                    }
                    html += "</tr>";
                }

                html2 += "<td>" + this.preIssue + "</td> <td class='tabred'><span>" + numarr[numrank] + "</span></td>"
                $(sttz).each(function (ind) {
                    var value = "";
                    if (this * 1 > 0) {
                        if (ind == 0) {
                            value = "<td class='numeven'><span>奇</span></td>";
                        } else if (ind == 1) {
                            value = "<td class='numodd'><span>偶</span></td>";
                        } else if (ind == 2) {
                            value = "<td class='numeven'><span>大</span></td>";
                        } else if (ind == 3) {
                            value = "<td class='numodd'><span>小</span></td>";
                        } else if (ind == 4) {
                            value = "<td class='numeven'><span>质</span></td>";
                        } else if (ind == 5) {
                            value = "<td class='numodd'><span>合</span></td>";
                        } else {
                            value = Math.abs(this);
                        }
                    } else {
                        value = "<td><span>" + Math.abs(this) + "</span></td>";
                    }
                    html2 += value

                })
                html2 += "</tr>"

                html3 += "<td>" + this.preIssue + "</td> <td class='tabred'><span>" + numarr[numrank] + "</span></td>"
                $(lu012).each(function (ind) {
                    var value = "";
                    if (this * 1 > 0) {
                        if (ind == 0) {
                            value = "<td class='numeven'><span>0</span></td>";
                        } else if (ind == 1) {
                            value = "<td class='numodd'><span>1</span></td>";
                        } else if (ind == 2) {
                            value = "<td class='numeven'><span>2</span></td>";
                        } else {
                            value = Math.abs(this);
                        }
                    } else {
                        value = "<td><span>" + Math.abs(this) + "</span></td>";
                    }
                    html3 += value

                })
                html3 += "</tr>"

                html4 += "<td>" + this.preIssue + "</td> <td class='tabred'><span>" + numarr[numrank] + "</span></td>"
                $(spj).each(function (ind) {
                    var value = "";
                    if (this * 1 > 0) {
                        if (ind == 0) {
                            value = "<td class='numeven'><span>升</span></td>";
                        } else if (ind == 1) {
                            value = "<td class='numodd'><span>平</span></td>";
                        } else if (ind == 2) {
                            value = "<td class='numeven'><span>降</span></td>";
                        } else {
                            value = Math.abs(this);
                        }
                    } else {
                        value = "<td><span>" + Math.abs(this) + "</span></td>";
                    }
                    html4 += value

                })
                html4 += "</tr>"

            })
            //sum
            var appearCount_febu = dataarr.title.appearCount.slice(0, 10)
            var averageMissingValues_febu = dataarr.title.averageMissingValues.slice(0, 10)
            var currentMissingValues_febu = dataarr.title.currentMissingValues.slice(0, 10);
            var maxAppearValues_febu = dataarr.title.maxAppearValues.slice(0, 10)
            var maxMissingValues_febu = dataarr.title.maxMissingValues.slice(0, 10)

            var appearCount_sttz = dataarr.title.appearCount.slice(10, 16)
            var averageMissingValues_sttz = dataarr.title.averageMissingValues.slice(10, 16)
            var currentMissingValues_sttz = dataarr.title.currentMissingValues.slice(10, 16);
            var maxAppearValues_sttz = dataarr.title.maxAppearValues.slice(10, 16)
            var maxMissingValues_sttz = dataarr.title.maxMissingValues.slice(10, 16)

            var appearCount_lu012 = dataarr.title.appearCount.slice(16, 19)
            var averageMissingValues_lu012 = dataarr.title.averageMissingValues.slice(16, 19)
            var currentMissingValues_lu012 = dataarr.title.currentMissingValues.slice(16, 19);
            var maxAppearValues_lu012 = dataarr.title.maxAppearValues.slice(16, 19)
            var maxMissingValues_lu012 = dataarr.title.maxMissingValues.slice(16, 19)

            var appearCount_spj = dataarr.title.appearCount.slice(19)
            var averageMissingValues_spj = dataarr.title.averageMissingValues.slice(19)
            var currentMissingValues_spj = dataarr.title.currentMissingValues.slice(19);
            var maxAppearValues_spj = dataarr.title.maxAppearValues.slice(19)
            var maxMissingValues_spj = dataarr.title.maxMissingValues.slice(19)
            html += "</tr>";
            var tr1 = "<tr class='clospan'><td colspan='2'>数据统计</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>";
            html2 += "</tr><tr class='clospan'><td colspan='2'>数据统计</td><td colspan='2'>奇偶</td><td colspan='2'>大小</td><td colspan='2'>质和</td></tr>"
            html3 += "<tr class='clospan'><td colspan='2'>数据统计</td><td>0</td><td>1</td><td>2</td></tr>"
            html4 += "<tr class='clospan'><td colspan='2'>数据统计</td><td>升</td><td>平</td><td>降</td></tr>"

            tr1 += "<tr><td colspan='2'>总次数</td>"
            var tr2 = "<tr><td colspan='2'>平均遗漏</td>"
            var tr3 = "<tr><td colspan='2'>当前遗漏</td>"
            var tr4 = "<tr><td colspan='2'>最大连出</td>"
            var tr5 = "<tr><td colspan='2'>最大遗漏</td>"

            var tr1_1 = "<tr><td colspan='2'>总次数</td>"
            var tr2_1 = "<tr><td colspan='2'>平均遗漏</td>"
            var tr3_1 = "<tr><td colspan='2'>当前遗漏</td>"
            var tr4_1 = "<tr><td colspan='2'>最大连出</td>"
            var tr5_1 = "<tr><td colspan='2'>最大遗漏</td>"

            var tr1_2 = "<tr><td colspan='2'>总次数</td>"
            var tr2_2 = "<tr><td colspan='2'>平均遗漏</td>"
            var tr3_2 = "<tr><td colspan='2'>当前遗漏</td>"
            var tr4_2 = "<tr><td colspan='2'>最大连出</td>"
            var tr5_2 = "<tr><td colspan='2'>最大遗漏</td>"

            var tr1_3 = "<tr><td colspan='2'>总次数</td>"
            var tr2_3 = "<tr><td colspan='2'>平均遗漏</td>"
            var tr3_3 = "<tr><td colspan='2'>当前遗漏</td>"
            var tr4_3 = "<tr><td colspan='2'>最大连出</td>"
            var tr5_3 = "<tr><td colspan='2'>最大遗漏</td>"

            for (var k = 0; k < appearCount_febu.length; k++) {
                tr1 += " <td>" + Math.abs(appearCount_febu[k]) + "</td>"
                tr2 += " <td>" + Math.abs(averageMissingValues_febu[k]) + "</td>"
                tr3 += " <td>" + Math.abs(currentMissingValues_febu[k]) + "</td>"
                tr4 += " <td>" + Math.abs(maxAppearValues_febu[k]) + "</td>"
                tr5 += " <td>" + Math.abs(maxMissingValues_febu[k]) + "</td>"
            }
            for (var l = 0; l < appearCount_sttz.length; l++) {
                tr1_1 += " <td>" + Math.abs(appearCount_sttz[l]) + "</td>"
                tr2_1 += " <td>" + Math.abs(averageMissingValues_sttz[l]) + "</td>"
                tr3_1 += " <td>" + Math.abs(currentMissingValues_sttz[l]) + "</td>"
                tr4_1 += " <td>" + Math.abs(maxAppearValues_sttz[l]) + "</td>"
                tr5_1 += " <td>" + Math.abs(maxMissingValues_sttz[l]) + "</td>"
            }

            for (var m = 0; m < appearCount_lu012.length; m++) {
                tr1_2 += " <td>" + Math.abs(appearCount_lu012[m]) + "</td>"
                tr2_2 += " <td>" + Math.abs(averageMissingValues_lu012[m]) + "</td>"
                tr3_2 += " <td>" + Math.abs(currentMissingValues_lu012[m]) + "</td>"
                tr4_2 += " <td>" + Math.abs(maxAppearValues_lu012[m]) + "</td>"
                tr5_2 += " <td>" + Math.abs(maxMissingValues_lu012[m]) + "</td>"
            }

            for (var n = 0; n < appearCount_spj.length; n++) {
                tr1_3 += " <td>" + Math.abs(appearCount_spj[n]) + "</td>"
                tr2_3 += " <td>" + Math.abs(averageMissingValues_spj[n]) + "</td>"
                tr3_3 += " <td>" + Math.abs(currentMissingValues_spj[n]) + "</td>"
                tr4_3 += " <td>" + Math.abs(maxAppearValues_spj[n]) + "</td>"
                tr5_3 += " <td>" + Math.abs(maxMissingValues_spj[n]) + "</td>"
            }
            var trtab = "</tr>"
            wzzstablefooter = tr1 + trtab + tr2 + trtab + tr3 + trtab + tr4 + trtab + tr5 + trtab
            html += wzzstablefooter + "</tbody></table>";
            html2 += tr1_1 + trtab + tr2_1 + trtab + tr3_1 + trtab + tr4_1 + trtab + tr5_1 + trtab + "</tbody></table>";
            html3 += tr1_2 + trtab + tr2_2 + trtab + tr3_2 + trtab + tr4_2 + trtab + tr5_2 + trtab + "</tbody></table>";
            html4 += tr1_3 + trtab + tr2_3 + trtab + tr3_3 + trtab + tr4_3 + trtab + tr5_3 + trtab + "</tbody></table>";
            $(".wezizs #chartLinediv").html(html + html2 + html3 + html4);
            //          $(".wezizs canvas").remove()
            //          setTimeout(function() {
            //              chartOfBaseTrend.weizhiLine("trend_table2") //会制线
            //          }, 500)
            var shoclass = $(".wezizs .Pattern .checkspan").attr("class").replace(" ", "").replace("checkspan", "");
            $(".table_" + shoclass).show().siblings().hide();
            orshowConten();
        }

    },
    hmgltj: { //号码规律统计
        gltjData: function (periods, code, time) {
            var code = $("#gltjhmNum .hmglNumAct").text();
            code = code == undefined ? "1" : code;
            periods = periods == undefined ? config.periods : periods;
            time = time == undefined ? "" : time
            //          var time = ifChecked().time == undefined ? "" : ifChecked().time;
            //          var num = ifChecked().num == undefined ? "" : ifChecked().num;
            //          var periods = periods == undefined ? "30" : ifChecked().issue;
            $.ajax({
                url: config.publicUrl + "pks/queryNumberLawOfStatistics.do?periods=" + periods + "&code=" + code + "&date=" + time,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.hmgltj.gltjHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        //格式化数据
        gltjHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            pk10FunObj.hmgltj.listdata(dataarr)
        },
        listdata: function (dataarr) {
            /*preIssue 开奖期数
            preDrawTime 开奖时间
            preDrawCode 开始号码
            code 参考号码,如.号码1
            codeIndex 参考号码的位置,从0开始
            displayCode 本期应该显示号码
            changeState 形态.-1.降;0.平;1.升
            singleState 单双形态.1.单;0双
            bigState 大小形态.1.大;0.小
            diagramList 数组，分别表示参考号码，对应的1-10号码在同位出现的次数*/
            $("#tbSqur").empty();
            $("#sjdsdxList").empty();
            $(".sjhmfbList").find("table").empty();
            //图标，柱状图
            var diagramList = dataarr.diagramList;
            var liHtml = "";
            var array = []; //排序找到数组最大值
            for (var i = 0; i < diagramList.length; i++) {
                array[i] = diagramList[i];
            }
            array = array.sort(function (a, b) {
                return b - a
            });
            var arrBigist = array[0];
            if (arrBigist < 10) {
                arrBigist = 10;
            } else {
                arrBigist = Math.ceil(arrBigist / 10) * 10; //向上取整 13--20,做分母
            }
            $(diagramList).each(function (i, el) {
                var elW = "";
                var hmNum = (i + 1) < 10 ? ("0" + (i + 1)) : (i + 1);
                elW = (el / arrBigist) * 100;
                if (el == 0) {
                    el = ""; //统计次数=0时，隐藏次数条中的i标签
                }
                if (elW >= 92) {
                    elW = 92;
                }
                liHtml += '<li><i class="codenum">' + hmNum + '</i>' +
                    '<span class="gayPip" style="width:' + elW + '%"><i class="kainum">' + el + '</i></span>' +
                    '</li>';
            })

            //数据-单双大小，号码分布
            var dsdxUl = "",
                hmfbUl = "";
            $(dataarr.tableList).each(function (i, obg) {
                //单双大小
                var predraw = this.preDrawCode;
                var styleColor1 = "",
                    styleColor2 = "",
                    styleColor3 = "";
                var displayCode = this.displayCode;
                var spj = typeOf(this.changeState, "spj");
                var ifds = this.singleState == "1" ? "单" : "双";
                var ifdx = this.bigState == "1" ? "大" : "小";
                var preIssue = (this.preIssue + "");
                preIssue = preIssue.substr(preIssue.length - 4, 4);
                if (ifds == "双") {
                    styleColor1 = "color:#ff2600"
                } else {
                    styleColor1 = "color:#999"
                }
                if (ifdx == "大") {
                    styleColor2 = "color:#ff2600"
                } else {
                    styleColor2 = "color:#999"
                }
                if (spj == "升") {
                    styleColor3 = "color:#ff2600"
                } else {
                    styleColor3 = "color:#999"
                }
                dsdxUl += "<ul><li><span>" + preIssue + "</span>" + this.preDrawTime + "</li><li>" + displayCode + "</li><li style='" + styleColor3 + "'>" + spj + "</li><li style='" + styleColor1 + "'>" + ifds + "</li><li style='" + styleColor2 + "'>" + ifdx + "</li></ul>";

                //号码分布
                var tdlist = "";
                //同位号码颜色变换
                var colornums = $(".hmglNumAct").text();
                var twhrbg = "";
                $(predraw).each(function (index) {
                    if (this == colornums) {
                        twhrbg = "circle" + this
                    } else {
                        twhrbg = "defalut_circle circle" + this
                    }
                    if (this == displayCode) {
                        qiubg = "lineBall" + this;
                        tdlist += '<td class="hot"><span name="hotSpan" class="' + twhrbg + " " + qiubg + '">' + this + '</span></td>'
                    } else {
                        qiubg = "";
                        tdlist += '<td><span class="' + twhrbg + " " + qiubg + '">' + this + '</span></td>'
                    }
                })
                hmfbUl += '<tr><td style="width:38%"><span>' + preIssue + '</span>' + this.preDrawTime + '</td>' + tdlist + '</tr>'

            })

            //号码分布
            $("#tbSqur").append(liHtml);
            $("#sjdsdxList").append(dsdxUl);
            $(".sjhmfbList").find("table").append(hmfbUl);
            $("canvas").remove()
            setTimeout(function () {
                chartOfBaseTrend.haomagltj("trend_table2_hmgltj") //会制线
            }, 500)

        }
    },
    gyhzs: { //冠亚和走势
        //请求路珠list数据传入参数：time:时间；periods：期数
        listData: function (time, periods) {
            time = time == undefined ? "" : time; //如果请求数据time为undefined处理为""
            periods = periods == undefined ? "" : periods; //如果请求数据periods为undefined处理为""
            if ((time == "" || time == getDateStr(0)) && periods == "") {
                $("#gyhtodayBtn span").text("今天");
                $("#gyhshowBox ul li:first").addClass("gyhtimesAtc").siblings().removeClass("gyhtimesAtc")
            }
            $.ajax({
                url: config.publicUrl + "pks/queryGysumTrend.do?date=" + time + "&periods=" + periods,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.gyhzs.gyhHtmlList(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        //构建路珠开奖记录数据
        gyhHtmlList: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            pk10FunObj.gyhzs.forRank_gyh(dataarr);
        },
        forRank_gyh: function (data) {
            /*preIssue 开奖期数
            preDrawTime 开奖时间
            preDrawCode 开始号码
            gySum 冠亚和值
            missing 遗漏值，数组中小于零的值表示当前遗漏值，大于零表示冠亚和连接出现的次数
            appearCount 出现次数,数组长度为17
            averageMissingValues 平均遗漏值,数组长度为17
            maxMissingValues 最大遗漏值,数组长度为17
            maxAppearValues 最大连接出现值,数组长度为17*/
            var lsitHtml = "",
                yilouHtml = "";
            $(".gyhdateBox tbody").empty();
            listettablearr(data.list)
            $(data.list).each(function (index) {
                if (lotCode == 10037) {
                    var eachlength = config.showrows
                } else {
                    var eachlength = 200
                }
                if (index > eachlength) {
                    return
                }
                var preIssue = "<td>" + this.preIssue + "</td>";
                var missingtd = "";
                var sum = this.gySum;;
                $(this.missing).each(function (index) {
                    var title = "";
                    var bgqiu = "";
                    var yilou = sum;
                    if (this * 1 > 0) {
                        title = "title='0' class='hot_gyh'";
                        bgqiu = "style='background:" + color[1] + "'";
                    } else {
                        yilou = Math.abs(this);
                        title = "class='yilou'";
                    }
                    if (index > 16) {
                        return;
                    }
                    missingtd += "<td " + title + "><span " + bgqiu + ">" + yilou + "</span></td>";
                });
                var tr = "<tr class='yiloutr'>" + preIssue + "" + missingtd + "</tr>";
                $(".gyhdateBox tbody").append(tr);

            });
            var sjtjtr = "<tr><th>数据统计</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th></tr>";
            var tr1 = "<td>出现总数</td>";
            var tr2 = "<td>平均遗漏</td>";
            var tr3 = "<td>最大连出</td>";
            var tr4 = "<td>最大遗漏</td>";
            $(data.title).each(function () {
                //循环第一行
                $(this.appearCount).each(function () {
                    tr1 += "<td>" + Math.abs(this) + "</td>";
                });
                //循环第二行
                $(this.averageMissingValues).each(function () {
                    tr2 += "<td>" + Math.abs(this) + "</td>";
                })

                //循环第三行
                $(this.maxAppearValues).each(function () {
                    tr3 += "<td>" + Math.abs(this) + "</td>";
                })
                //循环第四行
                $(this.maxMissingValues).each(function () {
                    tr4 += "<td>" + Math.abs(this) + "</td>";
                })
            });
            gyhzsfooter = sjtjtr + "<tr class='clospan_gyh'>" + tr1 + "</tr><tr class='clospan_gyh'>" + tr2 + "</tr><tr class='clospan_gyh'>" + tr3 + "</tr><tr class='clospan_gyh'>" + tr4 + "</tr>"
            $(".gyhdateBox tbody").append(gyhzsfooter);

            orshowConten_gyh();
        }
    },
    dsdxlz: { //单双大小路珠
        dsdxlzsData: function (time) {
            time = time == undefined ? "" : time; //如果请求数据time为undefined处理为""
            if (time == "") {
                $("#today_dsdxlz").addClass("todayAct_dsdxlz").siblings().removeClass("todayAct_dsdxlz");
            }
            $.ajax({
                url: config.publicUrl + "pks/queryComprehensiveRoadBead.do?date=" + time,
                type: "GET",
                data: {
                    "lotCode": lotCode
                },
                success: function (data) {
                    //执行数据请求
                    pk10FunObj.dsdxlz.addlzTable_dsdxlz(data);
                },
                error: function (data) {
                    if (config.ifdebug) {
                        console.log("data error");
                    }
                }
            });
        },
        addlzTable_dsdxlz: function (jsondata) {
            var data = null;
            if (typeof jsondata != "object") {
                data = JSON.parse(jsondata);
            } else {
                data = JSON.stringify(jsondata);
                data = JSON.parse(data);
            }
            var dataarr = data.result.data;
            //rank:名次,1-10分别为第一——第十名,11为冠亚和
            //state形态:如1.单双;2.大小;3.龙虎
            //totals：长度为2的数组,数组第一个元素表示单、大、龙;第二个元素表示双、小、虎
            //roadBeads:数组,数组的元素值为0或1,1表示单、大、龙;0表示双、小、虎
            //向不同的box中填值1到5有大小单双龙虎三种类型  6-11到有2个类型，没有龙虎
            //data ajax返回的数据，state==1 单双 state==2 大小 state==3 龙虎    11 = 冠亚和单双  12 冠亚和大小
            $(".dsdxlz .dsdxlz_content").html("");
            var classe = "";
            for (var i = 0; i < data.result.data.length; i++) {
                //          	debugger
                var state = data.result.data[i].state;
                if (state == 1) {
                    var text1 = "单";
                    var text2 = "双";
                    var abc = "单双"
                    classe = "dansuShow"
                } else if (state == 2) {
                    var text1 = "小";
                    var text2 = "大";
                    var abc = "大小";
                    classe = "daxiaoShow"
                } else if (state == 3) {
                    var text1 = "虎";
                    var text2 = "龙";
                    var abc = "龙虎";
                    classe = "longhuShow displaynone"
                } else if (state == 11) {
                    var text1 = "单";
                    var text2 = "双";
                    var abc = "单双"; //冠亚和
                    classe = "ganyudanxShow"
                } else if (state == 12) {
                    var text1 = "大";
                    var text2 = "小";
                    var abc = "大小"; ///冠亚和
                    classe = "guanyudaxiaoshow"
                }
                var html2, html3;
                var rank = data.result.data[i].rank
                if (rank == 11 && state == 1) {
                    classe = "ganyudanxShow"
                } else if (rank == 11 && state == 2) {
                    classe = "guanyudaxiaoshow"
                }
                var html = "<div class='lz_title " + classe + " t" + (rank - 1) + "'><div class='left'><span>今日累计:</span>";
                var html3 = "<div class='lz_item'><table class='lz_table_con' border='0' cellpadding='1' cellspacing='1'><tbody><tr class='tablebox'><td>"
                data.result.data[i].roadBeads = data.result.data[i].roadBeads.reverse()
                for (var c = 0, textCount = 0, text2Count = 0, text3Count = 0; c < data.result.data[i].roadBeads.length; c++) {
                    if (c >= 200) { //当极速冠亚和路珠数据太多，只展示最新200条
                        break
                    }
                    var num = data.result.data[i].roadBeads[c];
                    if (num == 0) {
                        num = text1;
                        textCount += 1;
                    } else if (num == 1) {
                        num = text2;
                        text2Count += 1;
                    } else if (num == 2) {
                        num = text3;
                        text3Count += 1;
                    }
                    if (c == 0) {
                        html3 += "<p>" + num + "</p>";
                    }
                    if (c > 0 & data.result.data[i].roadBeads[c - 1] == data.result.data[i].roadBeads[c]) {
                        html3 += "<p>" + num + "</p>";
                    } else if (c > 0 & data.result.data[i].roadBeads[c - 1] != data.result.data[i].roadBeads[c]) {
                        html3 += "</td><td><p>" + num + "</p>";
                    }
                }
                var MAcount = "";
                if (rank == 1) {
                    MAcount = "冠军"
                } else if (rank == 2) {
                    MAcount = "亚军"
                } else if (rank == 3) {
                    MAcount = "第三名"
                } else if (rank == 4) {
                    MAcount = "第四名"
                } else if (rank == 5) {
                    MAcount = "第五名"
                } else if (rank == 6) {
                    MAcount = "第六名"
                } else if (rank == 7) {
                    MAcount = "第七名"
                } else if (rank == 8) {
                    MAcount = "第八名"
                } else if (rank == 9) {
                    MAcount = "第九名"
                } else if (rank == 10) {
                    MAcount = "第十名"
                } else if (rank == 11) {
                    MAcount = "冠亚和"
                }
                var html2 = "<span>" + text1 + "（" + data.result.data[i].totals[1] + "）</span><span>" + text2 + "（" + data.result.data[i].totals[0] + "）</span></div>" +
                    "<div class='right'><span class='weizi'>" + MAcount + "</span><span class='mosh'>" + abc + "</span><span class='zxi'>最新    &darr;</span></div>"

                var html4 = "</td></tr></tbody></table></div></div>"
                $(".dsdxlz .dsdxlz_content").append(html + html2 + html3 + html4);
            }
            $(".tablebox>td>p:contains('大')").css("color", "red");
            $(".tablebox>td>p:contains('双')").css("color", "red");
            $(".tablebox>td>p:contains('龙')").css("color", "red");
            $("#dsdxlzlist .dansuShow ").hide();
            showSxend(); //显示筛选条件内容
            animate_lz_dsdxlz();
        },
        typeOf_dsdxlz: function (num, type) {
            if (type == "rank") {
                switch (num * 1) {
                    case 1:
                        return "冠军";
                        break;
                    case 2:
                        return "亚军";
                        break;
                    case 3:
                        return "第三名";
                        break;
                    case 4:
                        return "第四名";
                        break;
                    case 5:
                        return "第五名";
                        break;
                    case 6:
                        return "第六名";
                        break;
                    case 7:
                        return "第七名";
                        break;
                    case 8:
                        return "第八名";
                        break;
                    case 9:
                        return "第九名";
                        break;
                    case 10:
                        return "第十名";
                        break;
                    case 11:
                        return "冠亚和";
                        break;
                }
            }
        }
    }

}