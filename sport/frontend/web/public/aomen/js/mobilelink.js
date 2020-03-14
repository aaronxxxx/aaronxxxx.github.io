$(document).ready(
function () {
    /**
	 * 对接
	 */
    getDateTimeval = self.setInterval("getDateMainlist()", 200);
});

function getDateMainlist() {
    //用户信息
    getUserData();
    //获取余额
    getBalancedynamic();
    //游戏信息
    getGameinformation("#specialCode");
    //获取公告
    //	getAnnouncement("CN");

    clearInterval(clearInterval(getDateTimeval));//停止请求 

    //下注明细获取类型
    $("select[id = 'gameDetailsType']").change(function () {
        var gamedetailsStatus = $("select[id = 'gamedetailsStatus']").val();
        var game_DetailsType_xzmx = $("select[id = 'gameDetailsType']").val();
        if (game_DetailsType_xzmx == "") {
            getBetDetails(gameinformationGameNo, "", "xzmx", "");
        } else {
            getBetDetails(gameinformationGameNo, "&type=" + game_DetailsType_xzmx, "xzmx", gamedetailsStatus);
        }
    });

    //下注明细获取状态
    $("select[id = 'gamedetailsStatus']").change(function () {
        var game_DetailsType_xzmx = $("select[class = 'gameStatus']").val();
        var gamedetailsStatus = $("select[id = 'gamedetailsStatus']").val();
        if (gamedetailsStatus == "") {
            getBetDetails(gameinformationGameNo, "", "xzmx", "");
        } else {
            getBetDetails(gameinformationGameNo, "&type=" + game_DetailsType_xzmx, "xzmx", gamedetailsStatus);
        }
    });


    //结算报表获取类型
    $("select[id = 'gamedetailsTypes']").change(function () {
        var game_DetailsType_jsbb = $("select[id = 'gamedetailsTypes']").val();
        if (game_DetailsType_jsbb == "") {
            getBetDetails(getDetailslssue, "", "jsbb", "");
        } else {
            getBetDetails(getDetailslssue, "&type=" + game_DetailsType_jsbb, "jsbb", "");
        }
    });
}

//心跳;定时刷新页面
function openwin() {
    var HeartbeatDate = [];
    //	$.ajax({
    //		url: "lottoRefresh",
    //		timeout :30000,
    //		async: false,
    //		type: "POST",
    //		success: function (lotteryresultsData){
    //			if(lotteryresultsData['kickOutTypeList'] != undefined){
    //				if(lotteryresultsData['kickOutTypeList'][0] == "REPEAT_LOGIN"){
    //					mainshortPrompt("此账号重复登入，会话已过期！");
    //					clearInterval(clearInterval(openwintim));//报错停止心跳
    //				}else if(lotteryresultsData['kickOutTypeList'][0] == "PLAY_LOGIN"){
    //					mainshortPrompt("会话已过期，请重新登录");
    //					clearInterval(clearInterval(openwintim));//报错停止心跳
    //				}

    //			}
    //			HeartbeatDate = lotteryresultsData['updateDataList'];
    //		},error : function(){
    //			mainshortPrompt("刷新页面失败，连接服务超时！");
    //			clearInterval(clearInterval(openwintim));
    //	     }

    //});

    if (HeartbeatDate != undefined) {
        for (var i = 0; i < HeartbeatDate.length; i++) {
            if (HeartbeatDate[i] == "ODDS") {
                //赔率信息
                if (heartbeatVal == "TEMA_A" || heartbeatVal == "TEMA_B") {
                    getWholeOdds("tmdivs", heartbeatVal);
                } else if (heartbeatVal == "ZHENGMA_A" || heartbeatVal == "ZHENGMA_B") {
                    getWholeOdds("zmdivs", heartbeatVal);
                } else if (heartbeatVal == "ZHENGTE_1" || heartbeatVal == "ZHENGTE_2" || heartbeatVal == "ZHENGTE_3" || heartbeatVal == "ZHENGTE_4" || heartbeatVal == "ZHENGTE_5" || heartbeatVal == "ZHENGTE_6") {
                    getWholeOdds("zmtdivs", heartbeatVal);
                } else if (heartbeatVal == "SERIAL_2_2" || heartbeatVal == "SERIAL_2_TE" || heartbeatVal == "SERIAL_TE" || heartbeatVal == "SERIAL_3_2_3" || heartbeatVal == "SERIAL_3_2" || heartbeatVal == "SERIAL_3_3") {
                    getLIANMA_Odds("duplex_tractorsForm", heartbeatVal);
                } else if (heartbeatVal == "GUOGUAN") {
                    getWholeOdds("clearance", heartbeatVal);
                } else if (heartbeatVal == "SHENXIAO_TE") {
                    getWholeOdds("texiaoTable", heartbeatVal);
                } else if (heartbeatVal == "TEMA_TOUWEI") {
                    getTEMATOUWEI_dds();
                } else if (heartbeatVal == "WUXING") {
                    getWUXINGBANBO_dds();
                } else if (heartbeatVal == "BANBO") {
                    getWUXINGBANBO_dds();
                } else if (heartbeatVal == "QIMA") {
                    getQIMA_dds();
                } else if (heartbeatVal == "SHENXIAO_1_Y" || heartbeatVal == "SHENXIAO_1_N") {
                    getWholeOdds("aShaw", heartbeatVal);
                } else if (heartbeatVal == "WEISHU_Y" || heartbeatVal == "WEISHU_N") {
                    getWholeOdds("MantissaTadle", heartbeatVal);
                } else if (heartbeatVal == "SHENXIAO6_2" || heartbeatVal == "SHENXIAO6_3" || heartbeatVal == "SHENXIAO6_4" || heartbeatVal == "SHENXIAO6_5" || heartbeatVal == "SHENXIAO6_6") {
                    getWholeOdds("sixShaw", heartbeatVal);
                } else if (heartbeatVal == "SHENXIAOLIAN_Y_2" || heartbeatVal == "SHENXIAOLIAN_Y_3" || heartbeatVal == "SHENXIAOLIAN_Y_4" || heartbeatVal == "SHENXIAOLIAN_Y_5" || heartbeatVal == "SHENXIAOLIAN_N_2" || heartbeatVal == "SHENXIAOLIAN_N_3" || heartbeatVal == "SHENXIAOLIAN_N_4" || heartbeatVal == "SHENXIAOLIAN_N_5") {
                    getWholeOdds("evenZodiac", heartbeatVal);
                } else if (heartbeatVal == "WEISHULIAN_Y_2" || heartbeatVal == "WEISHULIAN_Y_3" || heartbeatVal == "WEISHULIAN_Y_4" || heartbeatVal == "WEISHULIAN_N_2" || heartbeatVal == "WEISHULIAN_N_3" || heartbeatVal == "WEISHULIAN_N_4") {
                    getWholeOdds("evenMantissa", heartbeatVal);
                } else if (heartbeatVal == "BUZHONG_5" || heartbeatVal == "BUZHONG_6" || heartbeatVal == "BUZHONG_7" || heartbeatVal == "BUZHONG_8" || heartbeatVal == "BUZHONG_9" || heartbeatVal == "BUZHONG_10") {
                    getWholeOdds("notIn", heartbeatVal);
                } else if (heartbeatVal == "ZHONG1_5" || heartbeatVal == "ZHONG1_6" || heartbeatVal == "ZHONG1_7" || heartbeatVal == "ZHONG1_8" || heartbeatVal == "ZHONG1_9" || heartbeatVal == "ZHONG1_10") {
                    getWholeOdds("selectInOne", heartbeatVal);
                } else if (heartbeatVal == "TEPING_1" || heartbeatVal == "TEPING_2" || heartbeatVal == "TEPING_3" || heartbeatVal == "TEPING_4" || heartbeatVal == "TEPING_5") {
                    getWholeOdds("turpinIn", heartbeatVal);
                }

            } else if (HeartbeatDate[i] == "PLAYER_INFO") {
                //用户信息
                getUserData();
            } else if (HeartbeatDate[i] == "GAME_INFO") {
                //游戏信息
                if (kuaijiedivid == "#specialCode") {
                    getGameinformation("#specialCode");
                } else if (kuaijiedivid == "#areCode") {
                    getGameinformation("#areCode");
                } else if (kuaijiedivid == "#zhengteDatele") {
                    getGameinformation("#zhengteDatele");
                } else if (kuaijiedivid == "") {
                    getGameinformation("");
                }
                getMustdata(heartbeatVal);
            } else if (HeartbeatDate[i] == "BALANCE_UPDATE") {
                //余额
                getBalancedynamic();
            } else if (HeartbeatDate[i] == "ANNOUNCEMENT") {
                //获取公告
                //getAnnouncement("CN");
            }
        }
    }
}
var openwintim = self.setInterval("openwin()", 5000);

//获取用户信息
function getUserData() {
    //	$.ajax({
    //		url: "lottoGetPlayerInfo",
    //		timeout : 30000,
    //		async: false,
    //		type: "POST",
    //		success: function (userData) {
    //			userDataval = userData['player'];
    //			if(userDataval == undefined){
    //				getUserData();
    //			}
    //		},error : function(XMLHttpRequest, textStatus, errorThrown){
    //			alert("获取用户信息 失败，连接服务超时！");
    //     } 
    //});
    $("#userData span[id = 'userCash']").text(Digit(userDataval['playerBalance'], 0));
    $("#userData span[id = 'userTray']").text("(" + userDataval['tray'] + "盘)");
    $("#userData span[id = 'userName']").text(userDataval['userName'] + "[" + userDataval['tray'] + "盘]");
    //	$("#userData span[id = 'userTray']").attr("style","color:#FE4949;");
    //	$("#userData span[id = 'userCash']").attr("style","color:#FE4949;");
}
//会员资料
function member_Profile() {
    var memberHtml = "";
    for (var i = 0; i < memberType_Val.length; i++) {
        if (memberType_Val[memberType_Val[i]] != "BANBO" || memberType_Val[memberType_Val[i]] != "LIANGMIAN") {
            memberHtml += "<tr id= 'change'><td>" + memberType_CN[memberType_Val[i]] + "</td><td>" + userDataval["minBetMap"][memberType_Val[i]] + "</td><td>" + userDataval["maxBetMap"][memberType_Val[i]] + "</td><td>" + userDataval["maxMatchMap"][memberType_Val[i]] + "</td><td>" + userDataval["commMap"][memberType_Val[i]] + "</td></tr>"
        }
    }
    if (memberHtml != "") {
        $("th[id = 'handicap_Type']").text("盘口信息：" + userDataval["tray"]);
        $("tbody[id = 'member_value']").html(memberHtml);
    } else {
        $("tbody[id = 'member_value']").html("<tr><td  style = 'text-align:center; colspan = '5'>获取盘口信息失败!</td></tr>");
    }

}
//获取结算报表
function getBalancesheet() {
    $.ajax({
        url: "lottoGetReport",
        timeout: 30000,
        async: false,//改为同步方式
        type: "POST",
        success: function (BalancesheetData) {
            BalancesheetValue = BalancesheetData['lottoReportPoList'];
        }, error: function () {
            mainshortPrompt("获取结算报表失败，连接服务超时！");
        }
    });
    getBalancesheet_Date();
}
//结算报表页面效果
function getBalancesheet_Date() {
    var status_Date = "";
    var balancesheetHtml = "";
    var jieguoHtml = "";
    var zhudanshu = 0;
    var tzje = 0;
    var youjin = 0;
    var jieguo = 0;
    var youxiaoje = 0;
    if (BalancesheetValue != null) {
        if (BalancesheetValue.length > 0) {
            for (var i = 0; i < BalancesheetValue.length; i++) {
                var balancesheet_gameNo = BalancesheetValue[i]['gameNo'];
                var balancesheet_playerInfoId = BalancesheetValue[i]['playerInfoId'];
                var balancesheet_betAmount = BalancesheetValue[i]['betAmount'];
                var balancesheet_availableStakeAmount = BalancesheetValue[i]['availableStakeAmount'];
                var balancesheet_commAmount = BalancesheetValue[i]['commAmount'];
                var balancesheet_winLoss = BalancesheetValue[i]['winLoss'];
                var balancesheet_betCount = BalancesheetValue[i]['betCount'];
                var balancesheet_winLossTime = BalancesheetValue[i]['winLossTime'];
                var balancesheet_status = BalancesheetValue[i]['status'];
                zhudanshu += balancesheet_betCount
                tzje += balancesheet_betAmount;
                youjin += balancesheet_commAmount;
                jieguo += balancesheet_winLoss;
                youxiaoje += balancesheet_availableStakeAmount;
                if (balancesheet_status == 10) {
                    status_Date = "注单处理中";
                } else if (balancesheet_status == 15) {
                    status_Date = "下注成功";
                } else if (balancesheet_status == 20) {
                    status_Date = "已结算";
                } else if (balancesheet_status == 30) {
                    status_Date = "未结算";
                }

                if (balancesheet_winLoss < 0) {
                    jieguoHtml = "<span style = 'color: #F00;'>" + Digit(balancesheet_winLoss, 2) + "</span>";
                } else if (balancesheet_winLoss > 0) {
                    jieguoHtml = "<span style = 'color: #165AE6;'>" + Digit(balancesheet_winLoss, 2) + "</span>";
                } else {
                    jieguoHtml = "<span style = 'color: #2F9E13;'>" + Digit(balancesheet_winLoss, 2) + "</span>";
                }

                balancesheetHtml += "<tr id= 'change'><td id = 'balancesheet_gameNo'>" + balancesheet_gameNo + "</td><td>" + balancesheet_winLossTime + "</td><td>" + balancesheet_betCount + "</td><td>" + Digit(balancesheet_betAmount, 2) + "</td><td>" + Digit(balancesheet_commAmount, 2) + "</td><td>" + jieguoHtml + "</td></tr>";
            }
        } else {
            balancesheetHtml += "<tr><td style = 'text-align:center;' colspan = '6' >暂时还没有结算报表!</td></tr>";
        }
    } else {
        balancesheetHtml += "<tr><td style = 'text-align:center;' colspan = '6' >暂时还没有结算报表!</td></tr>";
    }
    $("tbody[id = 'clearingId']").html(balancesheetHtml);
    $("td[id = 'zhudanshu']").text(zhudanshu);
    $("td[id = 'touzhujine']").text(Digit(tzje, 2));
    $("td[id = 'youjin']").text(Digit(youjin, 2));
    //$("td[id = 'youxiaoje']").text(Digit(youxiaoje,2));
    $("td[id = 'jieguo']").text(Digit(jieguo, 2));

    //点击结算报表获取期号kkk详细信息
    $("#clearingId tr").click(function () {
        getDetailslssue = $(this).find("td").eq(0).text();
        if (getDetailslssue != "") {
            for (var i = 0; i < GuidepageType.length; i++) {
                document.getElementById(GuidepageType[i]).style.display = 'none';
            }
            document.getElementById('xxjsbbdivs').style.display = 'block';
            getBetDetails(getDetailslssue, "", "jsbb", "");
        }
    });

}

//获取下注明细信息 
function getBetDetails(details_Issue, details_Category, type, status) {

    detailValues = {};
    DetailslssueValue = {};
    var uraVal = "";
    if (details_Category != "") {
        if (status != "") {
            uraVal = "lottoGetReportDetail?gameNo=" + details_Issue + details_Category + "&status=" + status;
        } else {
            uraVal = "lottoGetReportDetail?gameNo=" + details_Issue + details_Category + "";
        }
    } else {
        if (status != "") {
            uraVal = "lottoGetReportDetail?gameNo=" + details_Issue + details_Category + "&status=" + status;
        } else {
            uraVal = "lottoGetReportDetail?gameNo=" + details_Issue + details_Category + "";
        }

    }
    $.ajax({
        url: uraVal,
        async: false,//改为同步方式
        type: "POST",
        timeout: 30000,
        success: function (detailData) {
            detailValues = detailData['lottoReportPo'];//下注明细
            DetailslssueValue = detailData['gameInfoPojo'];//开奖结果
        }, error: function () {
            mainshortPrompt("获取下注明细信息失败，连接服务超时！");
        }
    });
    getBetDetails_Date(type);
}
//下注明细页数显示
function getBetDetails_Date(type) {
    if (detailValues != undefined || detailValues != null) {
        var detail_Num = 0;
        var pagecount = detailValues["lottoReportDetailPoList"].length;
        var pageslist = 0;
        var pages = 0;
        var ech = [];
        pages = Math.ceil(pagecount / 20);
        var pagecountHtml = "<a id = 'homePage' style = 'color:#376FB5'>首页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a id = 'Previous' style = 'color:#376FB5'>上一页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a id = 'Next' style = 'color:#376FB5'>下一页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a id = 'lastPage' style = 'color:#376FB5'>末页</a>&nbsp;&nbsp;&nbsp;&nbsp;第&nbsp;<span id = 'pages_list' style = 'color:#CD0000;'></span>/" + pages + "&nbsp;页";
        if (type == "xzmx") {
            $("li[id = 'pagesNo']").html(pagecountHtml);
            var pagesNoval = 1;
            //下注明细分页选择页数
            $("#pagesNo a").click(function () {
                $("#pagesNo a").css("color", "#376FB5");
                $(this).css("color", "red");
                var pageNoId = $(this).attr("id");
                if (pageNoId == "homePage") {//首页
                    pagesNoval = 1;
                } else if (pageNoId == "Previous") {//上一页
                    if (pagesNoval > 1) {
                        pagesNoval = parseInt(pagesNoval - 1);
                    }
                } else if (pageNoId == "Next") {//下一页
                    if (pagesNoval < pages) {
                        pagesNoval = parseInt(pagesNoval + 1);
                    }
                } else if (pageNoId == "lastPage") {//末页
                    pagesNoval = parseInt(pages);
                }
                getDetails_DateHtml(pagesNoval, type);
            });
            if (gameinformationStatus == "GAME_START" || gameinformationStatus == "GAME_BASICS_END" || gameinformationStatus == "GAME_ZHENG_END") {
                if (pagecount > 0) {
                    getDetails_DateHtml(1, type);
                } else {
                    getDetails_DateHtml(0, type);
                }
            } else {
                getDetails_DateHtml(0, type);
            }
        } else if (type == "jsbb") {
            $("li[id = 'settlementpagesNo']").html(pagecountHtml);
            var pagesNoval = 1;
            //下注明细分页选择页数
            $("#settlementpagesNo a").click(function () {
                $("#settlementpagesNo a").css("color", "#376FB5");
                $(this).css("color", "red");
                var pageNoId = $(this).attr("id");
                if (pageNoId == "homePage") {//首页
                    pagesNoval = 1;
                } else if (pageNoId == "Previous") {//上一页
                    if (pagesNoval > 1) {
                        pagesNoval = parseInt(pagesNoval - 1);
                    }
                } else if (pageNoId == "Next") {//下一页
                    if (pagesNoval < pages) {
                        pagesNoval = parseInt(pagesNoval + 1);
                    }
                } else if (pageNoId == "lastPage") {//末页
                    pagesNoval = parseInt(pages);
                }
                getDetails_DateHtml(pagesNoval, type);
            });

            if (pagecount > 0) {
                getDetails_DateHtml(1, type);
            } else {
                getDetails_DateHtml(0, type);
            }
        }
    } else {
        getDetails_DateHtml(0, type);
    }
}

//下注明细页面数据动态显示
function getDetails_DateHtml(pagesNo_Num, type) {
    if (pagesNo_Num == 0 || detailValues == undefined || detailValues == null) {
        if (type == "jsbb") {
            $("span[id = 'details_NoteSingle' ] b").text(0);// 注单数
            $("span[id = 'details_Wager'] b").text(0);// 下注金额
            $("span[id = 'details_Commission' ] b").text(0);// 佣金
            $("span[id = 'details_Winnings' ] b").text(0);// 可赢金额
            $("tbody[id = 'settlement_value']").html("<tr><td style = 'text-align:center;' colspan = '11'>结算报表为空！</td></tr>");
        } else if (type == "xzmx") {
            $("li[id = 'pagesNo']").text("");
            $("span[id = 'details_NoteSingle' ] b").text(0);// 注单数
            $("span[id = 'details_Wager'] b").text(0);// 下注金额
            $("span[id = 'details_Commission' ] b").text(0);// 佣金
            $("span[id = 'details_Winnings' ] b").text(0);// 可赢金额
            $("div[id = 'datails_value']").html("<ul class = 'fw700 pageno'><li style = 'text-align:center;' colspan = '11'>下注明细为空！</li></ul>");
        }
    } else if (pagesNo_Num > 0) {
        var detailsHtml = "";
        var settlementHtml = "";
        var jieguoHtml = "";
        var detail_Values = detailValues["lottoReportDetailPoList"];
        var i = 0;
        var pagecount = detail_Values.length;
        var pagecount_Num = 0;
        var nn = 0;
        if (pagesNo_Num == 1) {
            i = 0;
            if (pagecount > 20) {
                pagecount_Num = 20;
            } else {
                pagecount_Num = pagecount;
            }

        } else {
            i = ((pagesNo_Num - 1) * 20);
            pagecount_Num = pagecount;
        }
        for (i; i < pagecount_Num; i++) {
            nn++;
            if (nn <= 20) {
                var detail_betOn = detail_Values[i]['betOn'];
                var detail_betTypeCN = detail_Values[i]['betType'];
                var detail_betgameOnCN = detail_Values[i]['gameNo'];

                if (detail_Values[i]['status'] == 10) {
                    var detail_status = "注单处理中";
                } else if (detail_Values[i]['status'] == 15) {
                    var detail_status = "下注成功";
                } else if (detail_Values[i]['status'] == 20) {
                    var detail_status = "已结算";
                } else if (detail_Values[i]['status'] == 30) {
                    var detail_status = "未结算";
                }
                var detail_betType = getBettypeCN(detail_betOn);
                var detail_betTypeCnvalue = [];
                for (var k = 0; k < detail_betTypeCN.length; k++) {
                    detail_betTypeCnvalue
							.push(detail_betType[detail_betTypeCN[k]]);
                }
                if (detail_Values[i]["secondaryOdds"] > 0) {
                    var oddsValue = detail_Values[i]['mainOdds'] + "/" + detail_Values[i]["secondaryOdds"];
                } else {
                    var oddsValue = detail_Values[i]['mainOdds'];
                }
                detailsHtml +=
					"<section  class='bet-model rel'>" +
					"<nav id = 'detailsUl'  class='fw700 nav_ul'>" +
					"<ul ><li>" +
					"<span id = 'detailJia' name = 'jia" + (i + 1) + "'class='abs  btn-le tc'><input class = 'ben-jiajian' type='image' src='./mobileimages/jiaimg.png' /></span>" +
					"<span id = 'detailJian' name = 'jian" + (i + 1) + "'class='abs  btn-le tc' style = 'display: none;'><input class = 'ben-jiajian' type='image' src='./mobileimages/jian.png' /></span>" +
					"</li><li class = 'bets_topli'>" +
					"<span class='btn-le'>" + betOn_NO_CN[detail_Values[i]['betOn']] + "：" + detail_betTypeCnvalue + " @<span style = 'color:red;'>" + oddsValue + "</span></span>" +
					"</li><li class = 'bets_dili'>" +
					"<span class='btn-le'>下注：" + detail_Values[i]['betAmount'] + "</span>" +
					"<span >可赢：" + Digit(detail_Values[i]['estimateWin'], 2) + "</span>" +
					"</li></ul></nav>" +
					"<ul name = 'detail" + (i + 1) + "' class = 'bet-type-xzmxs' style = 'display: none;'>" +
					"<li><p>注单号：" + detail_Values[i]['uuid'] + "</p>" +
					"<p>期数：" + detail_betgameOnCN + "</p>" +
					"<p><span>玩法：" + betOn_NO_CN[detail_Values[i]['betOn']] + "：" + detail_betTypeCnvalue + "</span></p>" +
					"<p>赔率：" + oddsValue + "</p>" +
					"<p>佣金：" + detail_Values[i]['commAmount'] + "</p>" +
					"<p>状态：" + detail_status + "</p>" +
					"<p>下注时间：" + detail_Values[i]['betTime'] + "</p>" +
					"<p>下注金额：" + detail_Values[i]['betAmount'] + "</p>" +
					"<p>可赢金额：" + Digit(detail_Values[i]['estimateWin'], 2) + "</p></li></ul></section>";
                if (detail_Values[i]['winLoss'] < 0) {
                    jieguoHtml = "<span style = 'color: #F00;'>" + Digit(detail_Values[i]['winLoss'], 2) + "</span>";
                } else if (detail_Values[i]['winLoss'] > 0) {
                    jieguoHtml = "<span style = 'color: #165AE6;'>" + Digit(detail_Values[i]['winLoss'], 2) + "</span>";
                } else {
                    jieguoHtml = "<span style = 'color: #2F9E13;'>" + Digit(detail_Values[i]['winLoss'], 2) + "</span>";
                }
                settlementHtml +=
					"<section  class='bet-model rel'>" +
					"<nav id = 'settlementUl'  class='fw700 nav_ul'>" +
					"<ul ><li>" +
					"<span id = 'detailJia' name = 'jsjia" + (i + 1) + "'class='abs  btn-le tc'><input class = 'ben-jiajian' type='image' src='./mobileimages/jiaimg.png' /></span>" +
					"<span id = 'detailJian' name = 'jsjian" + (i + 1) + "'class='abs  btn-le tc' style = 'display: none;'><input class = 'ben-jiajian' type='image' src='./mobileimages/jian.png' /></span>" +
					"</li><li class = 'bets_topli'>" +
					"<span class='btn-le'>" + betOn_NO_CN[detail_Values[i]['betOn']] + "：" + detail_betTypeCnvalue + " @<span style = 'color:red;'>" + oddsValue + "</span></span>" +
					"</li><li class = 'bets_dili'>" +
					"<span class='btn-le'>下注：" + detail_Values[i]['betAmount'] + "</span>" +
					"<span >结果：" + jieguoHtml + "</span>" +
					"</li></ul></nav>" +
					"<ul name = 'jsbbs" + (i + 1) + "' class = 'bet-type-xzmxs' style = 'display: none;'>" +
					"<li><p>注单号：" + detail_Values[i]['uuid'] + "</p>" +
					"<p>期数：" + detail_betgameOnCN + "</p>" +
					"<p><span>玩法：" + betOn_NO_CN[detail_Values[i]['betOn']] + "：" + detail_betTypeCnvalue + "</span></p>" +
					"<p>赔率：" + oddsValue + "</p>" +
					"<p>时间：" + detail_Values[i]['betTime'] + "</p>" +
					"<p>佣金：" + detail_Values[i]['commAmount'] + "</p>" +
					"<p>状态：" + detail_status + "</p>" +
					"<p>下注金额：" + detail_Values[i]['betAmount'] + "</p>" +
					"<p>结果：" + jieguoHtml + "</p></li></ul></section>";

                var details_betestimateWin = 0;
                var details_Wager = 0;
                var details_Commission = 0;
                for (var s = 0; s < pagecount; s++) {
                    if (type == "xzmx") {
                        details_betestimateWin += detail_Values[s]['estimateWin'];
                    } else if (type == "jsbb") {
                        details_betestimateWin += detail_Values[s]['winLoss'];
                    }
                    details_Wager += detail_Values[s]['betAmount'];
                    details_Commission += detail_Values[s]['commAmount'];
                }
                if (Digit(details_betestimateWin, 2) < 0) {
                    $("span[id = 'details_Winnings' ] b").attr("style", "color: #F00;");
                } else if (Digit(details_betestimateWin, 2) > 0) {
                    $("span[id = 'details_Winnings' ] b").attr("style", "color: #165AE6;");
                } else {
                    $("span[id = 'details_Winnings' ] b").attr("style", "color: #2F9E13;");
                }
                $("span[id = 'details_NoteSingle' ] b").text(pagecount);// 注单数
                $("span[id = 'details_Wager'] b").text(Digit(details_Wager, 2));// 下注金额
                $("span[id = 'details_Commission' ] b").text(Digit(details_Commission, 2));// 佣金
                $("span[id = 'details_Winnings' ] b").text(Digit(details_betestimateWin, 2));// 结果、可以金额
            }
        }
        if (type == "jsbb") {
            var jsbbresultHtml = "";
            var jsbbshengxiaoHtml = "";
            var resultlist_jsbb = DetailslssueValue['resultList']
            var shengxiaolist_jsbb = DetailslssueValue['shengXiaoList'];
            jsbbresultHtml += "<span>" + resultlist_jsbb[0] + "</span><span>" + resultlist_jsbb[1] + "</span><span>" + resultlist_jsbb[2] + "</span><span>" + resultlist_jsbb[3] + "</span><span>"
						+ resultlist_jsbb[4] + "</span><span>" + resultlist_jsbb[5] + "</span>" + "+<span>" + resultlist_jsbb[6] + "</span>";
            for (var j = 0; j < (shengxiaolist_jsbb.length - 1) ; j++) {
                jsbbshengxiaoHtml += "<span>" + betType_NO_CN[shengxiaolist_jsbb[j]] + "</span>    ";
            }
            jsbbshengxiaoHtml += "+" + "<span>  " + betType_NO_CN[shengxiaolist_jsbb[6]] + "</span>";
            $("#settlement td[id = 'jsbbNo']").html("<b style = 'color: #333;'>" + DetailslssueValue['gameNo'] + "</b>");
            $("#settlement li[id = 'qihaospan']").html(jsbbresultHtml);
            $("#settlement li[id = 'jsbbSx']").html(jsbbshengxiaoHtml);

            $("span[id = 'pages_list']").text(pagesNo_Num);
            $("div[id = 'settlement_value']").html(settlementHtml);
            // 结算报表开奖结果效果
            $("li[id = 'qihaospan']").children("span").each(function (idx, ele) {
                for (var i = 0; i < redWave.length; i++) {
                    if ($(ele).text() == redWave[i]) {
                        $(this).attr("class", "ball ball-red");
                    }
                }
                for (var i = 0; i < blueWave.length; i++) {
                    if ($(ele).text() == blueWave[i]) {
                        $(this).attr("class", "ball ball-blue");
                    }
                }
                for (var i = 0; i < greenWave.length; i++) {
                    if ($(ele).text() == greenWave[i]) {
                        $(this).attr("class", "ball ball-green");
                    }
                }
            });
        } else if (type == "xzmx") {
            $("span[id = 'pages_list']").text(pagesNo_Num);
            $("div[id = 'details_Time']").text("当前期号：" + detail_betgameOnCN);
            $("div[id = 'datails_value']").html(detailsHtml);
        }
    } else {
        alert("获取失败");
    }
    //xzmx	
    $("#detailsUl span[id = 'detailJia']").click(function () {
        var detailsulId = $(this).attr("name");
        $("ul[name = 'detail" + detailsulId.substring(3) + "']").show();
        $(this).hide();
        $("span[name = 'jian" + detailsulId.substring(3) + "']").show();
    });
    $("#detailsUl span[id = 'detailJian']").click(function () {
        var detailsulId = $(this).attr("name");
        $("ul[name = 'detail" + detailsulId.substring(4) + "']").hide();
        $(this).hide();
        $("span[name = 'jia" + detailsulId.substring(4) + "']").show();
    });
    //jsbb
    $("#settlementUl span[id = 'detailJia']").click(function () {
        var detailsulId = $(this).attr("name");
        $("ul[name = 'jsbbs" + detailsulId.substring(5) + "']").show();
        $(this).hide();
        $("span[name = 'jsjian" + detailsulId.substring(5) + "']").show();
    });
    $("#settlementUl span[id = 'detailJian']").click(function () {
        var detailsulId = $(this).attr("name");
        $("ul[name = 'jsbbs" + detailsulId.substring(6) + "']").hide();
        $(this).hide();
        $("span[name = 'jsjia" + detailsulId.substring(6) + "']").show();
    });
}
function getBettypeCN(detail_betOn) {
    //类型和类别
    var detail_betType = {};
    if (detail_betOn == "TEMA_A" || detail_betOn == "TEMA_B" || detail_betOn == "ZHENGTE_1" || detail_betOn == "ZHENGTE_2" || detail_betOn == "ZHENGTE_3" || detail_betOn == "ZHENGTE_4" || detail_betOn == "ZHENGTE_5" || detail_betOn == "ZHENGTE_6" ||
		detail_betOn == "SERIAL_3_3" || detail_betOn == "SERIAL_3_2" || detail_betOn == "SERIAL_3_2_3" || detail_betOn == "SERIAL_2_2" || detail_betOn == "SERIAL_2_TE" || detail_betOn == "SERIAL_2_TE_TE" || detail_betOn == "SERIAL_TE" || detail_betOn == "GUOGUAN" ||
		detail_betOn == "SHENXIAO_TE" || detail_betOn == "BANBO" || detail_betOn == "SHENXIAO6_2" || detail_betOn == "SHENXIAO6_3" || detail_betOn == "SHENXIAO6_4" || detail_betOn == "SHENXIAO6_5" || detail_betOn == "SHENXIAO6_6" || detail_betOn == "SHENXIAO_1_Y" || detail_betOn == "SHENXIAO_1_N" ||
		detail_betOn == "SHENXIAOLIAN_Y_2" || detail_betOn == "SHENXIAOLIAN_Y_2" || detail_betOn == "SHENXIAOLIAN_Y_3" || detail_betOn == "SHENXIAOLIAN_Y_4" || detail_betOn == "SHENXIAOLIAN_Y_5" || detail_betOn == "SHENXIAOLIAN_N_2" || detail_betOn == "SHENXIAOLIAN_N_3" || detail_betOn == "SHENXIAOLIAN_N_4" ||
		detail_betOn == "SHENXIAOLIAN_N_5" || detail_betOn == "BUZHONG_5" || detail_betOn == "BUZHONG_6" || detail_betOn == "BUZHONG_7" || detail_betOn == "BUZHONG_8" || detail_betOn == "BUZHONG_9" || detail_betOn == "BUZHONG_10" || detail_betOn == "ZHONG1_5" || detail_betOn == "ZHONG1_6" || detail_betOn == "ZHONG1_7" ||
		detail_betOn == "ZHONG1_8" || detail_betOn == "ZHONG1_9" || detail_betOn == "ZHONG1_10" || detail_betOn == "TEPING_1" || detail_betOn == "TEPING_2" || detail_betOn == "TEPING_3" || detail_betOn == "TEPING_4" || detail_betOn == "TEPING_5") {
        detail_betType = betType_NO_CN;
    } else if (detail_betOn == "ZHENGMA_A" || detail_betOn == "ZHENGMA_B") {
        detail_betType = betType_ZM_CN;
    } else if (detail_betOn == "TEMA_TOU") {
        detail_betType = betType_TMTOU_CN;
    } else if (detail_betOn == "TEMA_WEI" || detail_betOn == "WEISHU_Y" || detail_betOn == "WEISHU_N" || detail_betOn == "WEISHULIAN_Y_2" || detail_betOn == "WEISHULIAN_Y_3" || detail_betOn == "WEISHULIAN_Y_4" || detail_betOn == "WEISHULIAN_N_2" || detail_betOn == "WEISHULIAN_N_3" || detail_betOn == "WEISHULIAN_N_4") {
        detail_betType = betType_TMWEI_CN;
    } else if (detail_betOn == "WUXING") {
        detail_betType = betType_WH_CN;
    } else if (detail_betOn == "QIMA_ODD") {
        detail_betType = betType_QM1_CN;
    } else if (detail_betOn == "QIMA_EVEN") {
        detail_betType = betType_QM2_CN;
    } else if (detail_betOn == "QIMA_BIG") {
        detail_betType = betType_QM3_CN;
    } else if (detail_betOn == "QIMA_SMALL") {
        detail_betType = betType_QM4_CN;
    }
    return detail_betType;
}
//获取开奖结果
function getLotteryresults() {
    $.ajax({
        url: "lottoGetGameInfoList",
        timeout: 30000,
        async: false,
        type: "POST",
        success: function (lotteryresultsData) {
            lotteryresultsValue = lotteryresultsData['gameInfoPojoList'];
        }, error: function () {
            mainshortPrompt("获取开奖结果失败，连接服务超时！");
        }
    });


    if (lotteryresultsValue != undefined) {
        var detail_Num = 0;
        var pagecount = lotteryresultsValue.length;
        var pages = 0;
        var ech = [];
        pages = Math.ceil(pagecount / 15);
        var pagecountHtml = "『 <span id ='results_pagesval'>";
        if (pages > 10) {
            pagecountHtml += "<a style = 'color:#376FB5'>" + (ss + 1) + "</a>&nbsp;&nbsp;";
        } else {
            for (var ss = 0; ss < pages; ss++) {
                pagecountHtml += "<a style = 'color:#376FB5'>" + (ss + 1) + "</a>&nbsp;&nbsp;";
            }
        }
        pagecountHtml += "</span>』&nbsp;&nbsp;总共<span style = 'color:red;'>" + pages + "</span>页";
        $("h3[id = 'results_pagesNo']").html(pagecountHtml);
        //开奖结果分页选择页数
        $("#results_pagesval a").click(function () {
            $("#results_pagesval a").css("color", "#376FB5");
            $(this).css("color", "red");
            getresults_DateHtml(parseInt($(this).text()));
        });

        if (pagecount > 0) {
            getresults_DateHtml(1);
        } else {
            getresults_DateHtml(0);
        }
    } else {
        getresults_DateHtml(0);
    }
}
//开奖结果分页页面显示
function getresults_DateHtml(pagesNo_Num) {
    var lotteryHtml = "";
    var i = 0;
    var nn = 0;
    if (lotteryresultsValue.length > 0) {
        var pagecount = lotteryresultsValue.length;
        var pagecount_Num = 0;
        var nn = 0;
        if (pagesNo_Num <= 1) {
            i = 0;
            if (pagecount > 15) {
                pagecount_Num = 15;
            } else {
                pagecount_Num = pagecount;
            }

        } else {
            i = ((pagesNo_Num - 1) * 15);
            pagecount_Num = pagecount;
        }
        for (i; i < pagecount_Num; i++) {
            nn++;
            if (nn <= 15) {
                var haoma = lotteryresultsValue[i]["resultList"];
                var shengxiao = lotteryresultsValue[i]["shengXiaoList"];

                lotteryHtml += "<section class='bet-model rel'>" +
                    "<h3>" +
                        "<span style = 'font-size: 16px;color: #0E0D0D;'>第" + lotteryresultsValue[i]["gameNo"] + "期</span>" +
                        "<span class = 'abs btn-r tc'>" + lotteryresultsValue[i]["closeTime"] + "</span>" +
                    "</h3>" +
                    "<ul >" +
                        "<li>";
                for (var k = 0; k < haoma.length; k++) {
                    for (var s = 0; s < redWave.length; s++) {
                        if (k == 6) {
                            if (haoma[k] == redWave[s]) {
                                lotteryHtml += "+<span id = 'bet1' class = 'ball ball-red'>" + haoma[k] + "</span>";
                            } else if (haoma[k] == blueWave[s]) {
                                lotteryHtml += "+<span id = 'bet1' class = 'ball ball-blue'>" + haoma[k] + "</span>";
                            } else if (haoma[k] == greenWave[s]) {
                                lotteryHtml += "+<span id = 'bet1' class = 'ball ball-green' >" + haoma[k] + "</span>";
                            }
                        } else {
                            if (haoma[k] == redWave[s]) {
                                lotteryHtml += "<span id = 'bet1' class = 'ball ball-red'>" + haoma[k] + "</span>";
                            } else if (haoma[k] == blueWave[s]) {
                                lotteryHtml += "<span id = 'bet1' class = 'ball ball-blue'>" + haoma[k] + "</span>";
                            } else if (haoma[k] == greenWave[s]) {
                                lotteryHtml += "<span id = 'bet1' class = 'ball ball-green' >" + haoma[k] + "</span>";
                            }
                        }

                    }
                }
                lotteryHtml += "</li>" +
                "<li style ='line-height: 25px;'>" +
                "<span>" + betType_NO_CN[shengxiao[0]] + "," + betType_NO_CN[shengxiao[1]] + "," + betType_NO_CN[shengxiao[2]] + "," + betType_NO_CN[shengxiao[3]] + "," + betType_NO_CN[shengxiao[4]] + "," + betType_NO_CN[shengxiao[5]] + "+" + betType_NO_CN[shengxiao[6]] + "</span>" +
                "|<span>" + lotteryresultsValue[i]["zh"] + "</span>" +
                "|<span>" + betType_NO_CN[lotteryresultsValue[i]["ds"]] + "</span>" +
                "|<span>" + betType_NO_CN[lotteryresultsValue[i]["dx"]] + "</span>" +
                "|<span>" + betType_NO_CN[lotteryresultsValue[i]["hds"]] + "</span>" +
                "|<span>总" + betType_NO_CN[lotteryresultsValue[i]["zhds"]] + "</span>" +
                "|<span>总" + betType_NO_CN[lotteryresultsValue[i]["zhdx"]] + "</span>" +
                "</li>" +
            "</ul>" +
        "</section>";
            }
        }
    } else {
        lotteryHtml += " <ul><li style='text-align:center;'>当前没有开奖结果!</li></ul>";
    }
    $("div[id = 'lottery_value']").html(lotteryHtml);
}
//提交异步请求数据到action
function submitData(betPoData, betAdaptData) {
    var aj = $.ajax({
        url: 'lottoWager',
        data: {
            betData: JSON.stringify(betPoData),
            betAdapt: JSON.stringify(betAdaptData)
        },
        type: 'post',
        cache: false,
        timeout: 30000,
        dataType: 'json',
        success: function (data) {
            if (data != null) {
                betStatus(data['returnPo'].returnCode, data['returnPo'].betOn, data['returnPo'].betType, data['returnPo'].retunMsg);
                //var datelottopolist = data['lottoReportDetailPoList'];
                //getInstantbets(datelottopolist);
            } else {
                shortPromptrun("无响应，请查看注单状态!", null);
                //Enternum = 0;
            }

        },
        error: function () {
            shortPromptrun("下注失败，连接服务异常请查看注单状态！", null);
            //Enternum = 0;
        }
    });
}
//返回下注状态信息
function betStatus(returnCode, returnOn, returnType, retunMsg) {
    var betTypeCNArr = [];
    Enternum = 0;
    if (returnOn != null && returnType != null) {
        var betOnCN = "";
        var betTypeArr = [];
        var bettypearr = "";
        bettypearr = (returnType.replace(/\]/g, "").replace(/\"/g, "").replace(/\[/g, ""));
        betTypeArr = (bettypearr.split(","));
        betOnCN = betOn_NO_CN[returnOn];
        for (var j = 0; j < betTypeArr.length; j++) {
            if (returnOn == "QIMA_ODD") {
                betTypeCNArr.push(betType_QM1_CN[(betTypeArr[j])]);
            } else if (returnOn == "QIMA_EVEN") {
                betTypeCNArr.push(betType_QM2_CN[(betTypeArr[j])]);
            } else if (returnOn == "QIMA_BIG") {
                betTypeCNArr.push(betType_QM3_CN[(betTypeArr[j])]);
            } else if (returnOn == "QIMA_SMALL") {
                betTypeCNArr.push(betType_QM4_CN[(betTypeArr[j])]);
            } else if (returnOn == "ZHENGMA_A" || returnOn == "ZHENGMA_B") {
                betTypeCNArr.push(betType_ZM_CN[(betTypeArr[j])]);
            } else if (returnOn == "TEMA_TOU") {
                betTypeCNArr.push(betType_TMTOU_CN[(betTypeArr[j])]);
            } else if (returnOn == "TEMA_WEI" || returnOn == "WEISHU_Y" || returnOn == "WEISHU_N" || returnOn == "WEISHULIAN_Y_2" || returnOn == "WEISHULIAN_Y_3"
				|| returnOn == "WEISHULIAN_Y_4" || returnOn == "WEISHULIAN_N_2" || returnOn == "WEISHULIAN_N_3" || returnOn == "WEISHULIAN_N_4") {
                betTypeCNArr.push(betType_TMWEI_CN[(betTypeArr[j])]);
            } else if (returnOn == "WUXING") {
                betTypeCNArr.push(betType_WH_CN[(betTypeArr[j])]);
            } else {
                betTypeCNArr.push(betType_NO_CN[(betTypeArr[j])]);
            }
        }
    }
    if (returnCode == 0) {
        shortPromptrun("下注成功!", 3);
        getBalancedynamic();
        //		kjzdwsho();
    } else if (returnCode == 5001) {
        shortPromptrun("下注失败，下注超时!", 12);
    } else if (returnCode == 5002) {
        alert("下注失败，余额不足!");
        shortPromptrun("下注失败，余额不足!", 12);
    } else if (returnCode == 5003) {
        shortPromptrun("下注失败，超过台红!", 12);
    } else if (returnCode == 5004) {
        shortPromptrun("下注失败，获取用户失败；请重新登录!", 10);
    } else if (returnCode == 5005) {
        shortPromptrun("下注失败，香港彩权限未开通，请联系上级!", null);
    } else if (returnCode == 5006) {
        shortPromptrun("下注失败，游戏期号与台桌不一致!", null);
    } else if (returnCode == 5007) {
        shortPromptrun("下注失败，已封盘!", 5);
    } else if (returnCode == 5008) {
        shortPromptrun("下注失败，不存在的下注类型!", null);
    } else if (returnCode == 5009) {
        shortPromptrun("下注失败，" + betOnCN + ":" + betTypeCNArr + "  超过限红下限!", null);
    } else if (returnCode == 5010) {
        shortPromptrun("下注失败， " + betOnCN + ":" + betTypeCNArr + "  超过限红上限!", null);
    } else if (returnCode == 5011) {
        shortPromptrun("下注失败，" + betOnCN + ":" + betTypeCNArr + "  超过最大可赢!", null);
    } else if (returnCode == 5012) {
        shortPromptrun("下注失败，在无操作超时!", null)
    } else if (returnCode == 5050) {
        shortPromptrun("下注失败，参数错误!", null);
    } else if (returnCode == 5051) {
        shortPromptrun("下注失败!", null);
    } else if (returnCode == 5052) {
        shortPromptrun("下注失败，数据错误!", null);
    } else if (returnCode == 7703) {
        shortPromptrun("下注失败，错误的参数!", null);
    } else if (returnCode == 5031) {
        shortPromptrun("赔率已变动是否适应赔率?");
    } else if (returnCode == 5013) {
        shortPromptrun("超过公司最大下注额,还可下注" + retunMsg, null);
    } else if (returnCode == 5014) {
        shortPromptrun("超过分公司最大下注额,还可下注" + retunMsg, null);
    }
}
//获取余额
function getBalancedynamic() {
    //	$.ajax({
    //		url: "lottoGetBalance",
    //		timeout : 30000,
    //		async: false,//改为同步方式
    //		type: "POST",
    //		success: function (BalancetData){
    //			BalancetDataValue = BalancetData['balance'];
    //			if(BalancetDataValue == undefined){
    //				getBalancedynamic()
    //			}
    //		},error : function(){
    //			mainshortPrompt("获取余额信息失败，连接服务超时！"); 
    //	     } 
    //});
    $("#userData span[id = 'userCash']").text(Digit(BalancetDataValue, 0));
    //	$("#userData b[id = 'userCash']").attr("style","color:#FE4949;");
}

//获取游戏信息
function getGameinformation(gameinformation_Type) {
    //$.ajax({
    //	url: "lottoGetGameInfo",
    //	timeout : 30000,
    //	async: false,
    //	type: "POST",
    //	success: function (GameInfoData) {
    //		gameinformationDate = GameInfoData['gameInfoPojo'];
    //		if(gameinformationDate == undefined){
    //			getGameinformation("#specialCode");
    //		}else{
    //			shaw_INT = GameInfoData['shengXiaoMap'];
    //		}
    //	},error : function(XMLHttpRequest, textStatus, errorThrown){  
    //		mainshortPrompt("获取游戏信息失败，连接服务超时！");
    //     } 
    //});
    shaw_Display(shaw_INT);
    gameinformationGameNo = gameinformationDate["gameNo"];
    $("span[id= 'lssueTips']").text(gameinformationGameNo);
    getgameinformaion_DateHtml(gameinformation_Type);
}

//生肖动态的效果
function shaw_Display(shaw_INT) {
    var sxshowid = ["shu_no", "ma_no", "niu_no", "yang_no", "hu_no", "hou_no", "tu_no", "ji_no", "long_no", "gou_no", "she_no", "zhu_no"];
    var sxshowdiv = ["#texiaoTable", "#aShaw", "#sixShaw", "#evenZodiac"];
    var sxshuthml = "";
    var sxshuthml2 = "";
    var sxmathml = "";
    var sxmathml2 = "";
    var sxniuthml = "";
    var sxniuthml2 = "";
    var sxyangthml = "";
    var sxyangthml2 = "";
    var sxhuthml = "";
    var sxhuthml2 = "";
    var sxhouthml = "";
    var sxhouthml2 = "";
    var sxtuthml = "";
    var sxtuthml2 = "";
    var sxjithml = "";
    var sxjithml2 = ""
    var sxlongthml = "";
    var sxlongthml2 = "";
    var sxgouthml = "";
    var sxgouthml2 = "";
    var sxshethml = "";
    var sxshethml2 = "";
    var sxzhuthml = "";
    var sxzhuthml2 = "";
    if (shaw_INT != undefined) {
        for (var i = 0; i < shaw_INT['SHU'].length; i++) {
            if (shaw_INT['SHU'][i] != 49) {
                sxshuthml2 += "<span>" + shaw_INT['SHU'][i] + "</span>";
            }
            sxshuthml += "<span>" + shaw_INT['SHU'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'shu_no']").html(sxshuthml);
        $("#aShaw div[id = 'shu_no']").html(sxshuthml);
        $("#sixShaw div[id = 'shu_no']").html(sxshuthml2);
        $("#texiaoTable div[id = 'shu_no']").html(sxshuthml);

        for (var i = 0; i < shaw_INT['MA'].length; i++) {
            sxmathml += "<span>" + shaw_INT['MA'][i] + "</span>";
            if (shaw_INT['MA'][i] != 49) {
                sxmathml2 += "<span>" + shaw_INT['MA'][i] + "</span>";
            }
        }
        $("#evenZodiac div[id = 'ma_no']").html(sxmathml);
        $("#aShaw div[id = 'ma_no']").html(sxmathml);
        $("#sixShaw div[id = 'ma_no']").html(sxmathml2);
        $("#texiaoTable div[id = 'ma_no']").html(sxmathml);

        for (var i = 0; i < shaw_INT['NIU'].length; i++) {
            if (shaw_INT['NIU'][i] != 49) {
                sxniuthml2 += "<span>" + shaw_INT['NIU'][i] + "</span>";
            }
            sxniuthml += "<span>" + shaw_INT['NIU'][i] + "</span>";
        }

        $("#evenZodiac div[id = 'niu_no']").html(sxniuthml);
        $("#aShaw div[id = 'niu_no']").html(sxniuthml);
        $("#sixShaw div[id = 'niu_no']").html(sxniuthml2);
        $("#texiaoTable div[id = 'niu_no']").html(sxniuthml);

        for (var i = 0; i < shaw_INT['YANG'].length; i++) {
            if (shaw_INT['YANG'][i] != 49) {
                sxyangthml2 += "<span>" + shaw_INT['YANG'][i] + "</span>";
            }
            sxyangthml += "<span>" + shaw_INT['YANG'][i] + "</span>";
        }

        $("#evenZodiac div[id = 'yang_no']").html(sxyangthml);
        $("#aShaw div[id = 'yang_no']").html(sxyangthml);
        $("#sixShaw div[id = 'yang_no']").html(sxyangthml2);
        $("#texiaoTable div[id = 'yang_no']").html(sxyangthml);


        for (var i = 0; i < shaw_INT['HU'].length; i++) {
            if (shaw_INT['HU'][i] != 49) {
                sxhuthml2 += "<span>" + shaw_INT['HU'][i] + "</span>";
            }
            sxhuthml += "<span>" + shaw_INT['HU'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'hu_no']").html(sxhuthml);
        $("#aShaw div[id = 'hu_no']").html(sxhuthml2);
        $("#sixShaw div[id = 'hu_no']").html(sxhuthml2);
        $("#texiaoTable div[id = 'hu_no']").html(sxhuthml);
        for (var i = 0; i < shaw_INT['HOU'].length; i++) {
            if (shaw_INT['HOU'][i] != 49) {
                sxhouthml2 += "<span>" + shaw_INT['HOU'][i] + "</span>";
            }
            sxhouthml += "<span>" + shaw_INT['HOU'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'hou_no']").html(sxhouthml);
        $("#aShaw div[id = 'hou_no']").html(sxhouthml);
        $("#sixShaw div[id = 'hou_no']").html(sxhouthml2);
        $("#texiaoTable div[id = 'hou_no']").html(sxhouthml);
        for (var i = 0; i < shaw_INT['TU'].length; i++) {
            if (shaw_INT['TU'][i] != 49) {
                sxtuthml2 += "<span>" + shaw_INT['TU'][i] + "</span>";
            }
            sxtuthml += "<span>" + shaw_INT['TU'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'tu_no']").html(sxtuthml);
        $("#aShaw div[id = 'tu_no']").html(sxtuthml);
        $("#sixShaw div[id = 'tu_no']").html(sxtuthml2);
        $("#texiaoTable div[id = 'tu_no']").html(sxtuthml);
        for (var i = 0; i < shaw_INT['JI'].length; i++) {
            if (shaw_INT['JI'][i] != 49) {
                sxjithml2 += "<span>" + shaw_INT['JI'][i] + "</span>";
            }
            sxjithml += "<span>" + shaw_INT['JI'][i] + "</span>";
        }

        $("#evenZodiac div[id = 'ji_no']").html(sxjithml);
        $("#aShaw div[id = 'ji_no']").html(sxjithml);
        $("#sixShaw div[id = 'ji_no']").html(sxjithml2);
        $("#texiaoTable div[id = 'ji_no']").html(sxjithml);

        for (var i = 0; i < shaw_INT['LONG'].length; i++) {
            if (shaw_INT['LONG'][i] != 49) {
                sxlongthml2 += "<span>" + shaw_INT['LONG'][i] + "</span>";
            }
            sxlongthml += "<span>" + shaw_INT['LONG'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'long_no']").html(sxlongthml);
        $("#aShaw div[id = 'long_no']").html(sxlongthml);
        $("#sixShaw div[id = 'long_no']").html(sxlongthml2);
        $("#texiaoTable div[id = 'long_no']").html(sxlongthml);
        for (var i = 0; i < shaw_INT['GOU'].length; i++) {
            if (shaw_INT['GOU'][i] != 49) {
                sxgouthml2 += "<span>" + shaw_INT['GOU'][i] + "</span>";
            }
            sxgouthml += "<span>" + shaw_INT['GOU'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'gou_no']").html(sxgouthml);
        $("#aShaw div[id = 'gou_no']").html(sxgouthml);
        $("#sixShaw div[id = 'gou_no']").html(sxgouthml2);
        $("#texiaoTable div[id = 'gou_no']").html(sxgouthml);
        for (var i = 0; i < shaw_INT['SHE'].length; i++) {
            if (shaw_INT['SHE'][i] != 49) {
                sxshethml2 += "<span>" + shaw_INT['SHE'][i] + "</span>";
            }
            sxshethml += "<span>" + shaw_INT['SHE'][i] + "</span>";
        }
        $("#evenZodiac div[id = 'she_no']").html(sxshethml);
        $("#aShaw div[id = 'she_no']").html(sxshethml);
        $("#sixShaw div[id = 'she_no']").html(sxshethml2);
        $("#texiaoTable div[id = 'she_no']").html(sxshethml);

        for (var i = 0; i < shaw_INT['ZHU'].length; i++) {
            if (shaw_INT['ZHU'][i] != 49) {
                sxzhuthml2 += "<span>" + shaw_INT['ZHU'][i] + "</span>";
            }
            sxzhuthml += "<span>" + shaw_INT['ZHU'][i] + "</span>";
        }

        $("#evenZodiac div[id = 'zhu_no']").html(sxzhuthml);
        $("#aShaw div[id = 'zhu_no']").html(sxzhuthml);
        $("#sixShaw div[id = 'zhu_no']").html(sxzhuthml2);
        $("#texiaoTable div[id = 'zhu_no']").html(sxzhuthml);

    } else {
        alert("获取生肖信息失败");
    }


    for (var h = 0; h < sxshowid.length; h++) {
        for (var k = 0; k < sxshowdiv.length; k++) {
            $(sxshowdiv[k] + " div[id='" + sxshowid[h] + "']").children("span").each(function (idx, ele) {
                for (var i = 0; i < redWave.length; i++) {
                    if (parseInt($(ele).text()) == redWave[i]) {
                        $(this).attr("class", "ball ball-red");
                    }
                }
                for (var i = 0; i < blueWave.length; i++) {
                    if (parseInt($(ele).text()) == blueWave[i]) {
                        $(this).attr("class", "ball  ball-blue");
                    }
                }
                for (var i = 0; i < greenWave.length; i++) {
                    if (parseInt($(ele).text()) == greenWave[i]) {
                        $(this).attr("class", "ball ball-green");
                    }
                }
            });
        }
    }
}

//游戏信息页面数据动态显示
function getgameinformaion_DateHtml(gameinformation_Type) {
    gameinformationStatus = gameinformationDate["status"];//状态 
    var gameinformationCloseTime = gameinformationDate["reciprocalCloseTime"]//距离封盘倒计时
    var gameinformationZmaTime = gameinformationDate["reciprocalZmTime"];//正码距离封盘倒计时
    var gameinformationTmTime = gameinformationDate["reciprocalTmTime"]//特码距离封盘倒计时
    var gameinformationOpenTime = gameinformationDate["reciprocalOpenTime"]//距离开盘倒计时
    maxtime = 0;
    switch (gameinformationStatus) {
        //开局状态
        case "BETTING":
            FPTS = "NO";
            if (gameinformation_Type == "#specialCode") {
                g_countdown = gameinformationOpenTime;
                maxText = "特码距离开盘";
            } else if (gameinformation_Type == "#areCode") {
                g_countdown = gameinformationOpenTime;
                maxText = "正码距离开盘";
            } else if (gameinformation_Type == "#zhengteDatele") {
                g_countdown = gameinformationOpenTime;
                maxText = "距离开盘";
            } else if (gameinformation_Type == "") {
                g_countdown = gameinformationOpenTime;
                maxText = "距离开盘";
                $("span[id = 'time']").show();
            }
            break;
        case "REST":
            //休盘状态
            g_countdown = 0;
            FPTS = "NO";
            maxText = "已封盘";
            break;
        case "CLOSED":
            //封盘状态
            g_countdown = 0;
            FPTS = "NO";
            $("span[id = 'time']").text("已封盘");
            break;
        case "MAINTAINING":
            //维护状态
            g_countdown = 0;
            FPTS = "NO";
            maxText = "已封盘";
            break;
        case "GAME_START":
            //开始接受注单
            FPTS = "";
            if (gameinformation_Type == "#specialCode") {
                g_countdown = gameinformationTmTime;
                maxText = "特码距离封盘";
            } else if (gameinformation_Type == "#areCode") {
                g_countdown = gameinformationZmaTime;
                maxText = "正码距离封盘";
            } else if (gameinformation_Type == "#zhengteDatele") {
                g_countdown = gameinformationCloseTime;
                maxText = "距离封盘";
            } else if (gameinformation_Type == "") {
                g_countdown = gameinformationCloseTime;
                maxText = "距离封盘";
            }
            break;
        case "GAME_BASICS_END":
            //基本下注方式关闭
            if (gameinformation_Type == "#specialCode") {
                FPTS = "";
                g_countdown = gameinformationTmTime;
                maxText = "特码距离开盘";
            } else if (gameinformation_Type == "#areCode") {
                g_countdown = gameinformationZmaTime;
                FPTS = "";
                maxText = "正码距离封盘";
            } else if (gameinformation_Type == "#zhengteDatele" || gameinformation_Type == "") {
                g_countdown = gameinformationCloseTime;
                FPTS = "NO";
                maxText = "距离封盘";
            }
            break;
        case "GAME_ZHENG_END":
            //正码下注方式关闭
            if (gameinformation_Type == "#specialCode") {
                g_countdown = gameinformationTmTime;
                FPTS = "";
                maxText = "特码距离封盘";
            } else if (gameinformation_Type == "#areCode") {
                g_countdown = gameinformationZmaTime;
                FPTS = "NO";
                maxText = "正码距离封盘";
            } else if (gameinformation_Type == "#zhengteDatele" || gameinformation_Type == "") {
                g_countdown = gameinformationCloseTime;
                FPTS = "";
                maxText = "距离封盘";
            }
            break;
        case "ANNOUNCING":
            //发送结算中
            g_countdown = 0;
            FPTS = "NO";
            $("span[id = 'time']").text("已封盘");
            break;
        case "ANNOUNCED":
            //结算完成
            g_countdown = 0;
            FPTS = "NO";
            $("span[id = 'time']").text("已封盘");
            break;
    }

    if (countdown_timer != null) {
        window.clearInterval(countdown_timer);
    }

    if (g_countdown > 0) {
        var intDiff = g_countdown;//倒计时总秒数量
        countdownTimer(intDiff);
    } else {
        // art.dialog.close();
        $("span[id = 'time']").text("已封盘");
        FPTS = "NO";
    }

}

function getLIANMA_Odds(betOnPageId, betType) {
    if (betType == "SERIAL_2_2" || betType == "SERIAL_3_3" || betType == "SERIAL_TE") {
        var getDataval = {};
        $.post("lottoGetOdds?oddsType=" + betType + "", function (getOddsData) {
            getDataval = getOddsData['odds'];
            for (var i = 0; i < ball_No.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[ball_No[i]];
                }
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[id = '" + ball_No[i] + "']").text(getDoss);// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[name = '" + ball_No[i] + "']").text("");// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[id = '" + ball_No[i] + "']").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        });
    } else if (betType == "SERIAL_2_TE") {
        var getDataval = {};
        $.post("lottoGetOdds?oddsType=SERIAL_2_TE", function (getOddsData) {
            getDataval = getOddsData['odds'];
            for (var i = 0; i < ball_No.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[ball_No[i]];
                }
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[id = '" + ball_No[i] + "']").text(getDoss);// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[id = '" + ball_No[i] + "']").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        });
        $.post("lottoGetOdds?oddsType=SERIAL_2_TE_TE", function (getOddsData) {
            getDataval = getOddsData['odds'];
            for (var i = 0; i < ball_No.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[ball_No[i]];
                }
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[name = '" + ball_No[i] + "']").text(getDoss);// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[name = '" + ball_No[i] + "']").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        });
    } else if (betType == "SERIAL_3_2") {
        var getDataval = {};
        $.post("lottoGetOdds?oddsType=SERIAL_3_2", function (getOddsData) {
            getDataval = getOddsData['odds'];
            for (var i = 0; i < ball_No.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[ball_No[i]];
                }
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[name = '" + ball_No[i] + "']").text(getDoss);// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[name = '" + ball_No[i] + "']").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        });
        $.post("lottoGetOdds?oddsType=SERIAL_3_2_3", function (getOddsData) {
            getDataval = getOddsData['odds'];
            for (var i = 0; i < ball_No.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[ball_No[i]];
                }
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[id = '" + ball_No[i] + "']").text(getDoss);// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + ball_No[i] + "'] p[id = '" + ball_No[i] + "']").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        });
    }
}
//获取赔率
function getWholeOdds(betOnPageId, betType) {
    var getDataval = {};
    var type_NO_var;
    if (betType == "ZHENGMA_A") {
        type_NO_var = zm_NO;
    } else if (betType == "TEMA_A" || betType == "ZHENGTE_1" || betType == "ZHENGTE_2" || betType == "ZHENGTE_3" || betType == "ZHENGTE_4" || betType == "ZHENGTE_5" || betType == "ZHENGTE_6") {
        type_NO_var = tema_NO;
    } else if (betType == "ZHENGMA_B" || betType == "TEMA_B" || betType == "SERIAL_3_3" || betType == "SERIAL_3_2" || betType == "SERIAL_3_2_3" || betType == "SERIAL_2_2" || betType == "SERIAL_2_TE" || betType == "SERIAL_2_TE_TE" ||
			betType == "SERIAL_TE" || betType == "BUZHONG_5" || betType == "BUZHONG_6" || betType == "BUZHONG_7" || betType == "BUZHONG_8" || betType == "BUZHONG_9" || betType == "BUZHONG_10" || betType == "ZHONG1_5" || betType == "ZHONG1_6" ||
			betType == "ZHONG1_7" || betType == "ZHONG1_8" || betType == "ZHONG1_9" || betType == "ZHONG1_10" || betType == "TEPING_1" || betType == "TEPING_2" || betType == "TEPING_3" || betType == "TEPING_4" || betType == "TEPING_5" || betType == "TEPING_6") {
        type_NO_var = ball_No;
    } else if (betType == "GUOGUAN") {
        type_NO_var = gg_NO;
    } else if (betType == "SHENXIAO_TE" || betType == "SHENXIAO6_2" || betType == "SHENXIAO6_3" || betType == "SHENXIAO6_4" || betType == "SHENXIAO6_5" || betType == "SHENXIAO6_6" || betType == "SHENXIAO_1_Y" || betType == "SHENXIAO_1_N" ||
		betType == "SHENXIAOLIAN_Y_2" || betType == "SHENXIAOLIAN_Y_3" || betType == "SHENXIAOLIAN_Y_4" || betType == "SHENXIAOLIAN_Y_5" || betType == "SHENXIAOLIAN_N_2" || betType == "SHENXIAOLIAN_N_3" ||
		betType == "SHENXIAOLIAN_N_4" || betType == "SHENXIAOLIAN_N_5") {
        type_NO_var = shaw_Order;
    } else if (betType == "WEISHU_Y" || betType == "WEISHU_N" || betType == "WEISHULIAN_Y_2" || betType == "WEISHULIAN_Y_3" || betType == "WEISHULIAN_Y_4" || betType == "WEISHULIAN_N_2" || betType == "WEISHULIAN_N_3" ||
			betType == "WEISHULIAN_N_4") {
        type_NO_var = tail_Number;
    }
    $.post("lottoGetOdds?oddsType=" + betType + "", function (getOddsData) {
        getDataval = getOddsData['odds'];
        if (getDataval == undefined) {
            getWholeOdds("tmdivs", "TEMA_A");
        } else {
            for (var i = 0; i < type_NO_var.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[type_NO_var[i]];
                }
                $("#" + betOnPageId + " li[id ='" + type_NO_var[i] + "'] p").text(getDoss);// 获取页面赔率
                $("#" + betOnPageId + " li[id ='" + type_NO_var[i] + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        }
    });
}
//获取特码头尾赔率
function getTEMATOUWEI_dds() {
    //获取特码头赔率
    var getDataval = {};
    $.post("lottoGetOdds?oddsType=TEMA_TOU", function (getOddsData) {
        getDataval = getOddsData['odds'];
        for (var i = 0; i < tmtou_NO.length; i++) {
            if (FPTS == "NO") {
                var getDoss = "--"
            } else {
                var getDoss = getDataval[tmtou_NO[i]];
            }
            $("#specialTouwei li[name ='" + (i) + "'] p").text(getDoss);// 获取页面赔率
            $("#specialTouwei li[name ='" + (i) + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
        }
    });
    $.post("lottoGetOdds?oddsType=TEMA_WEI", function (getOddsData) {
        getDataval = getOddsData['odds'];
        for (var i = 0; i < tmwei_NO.length; i++) {
            if (FPTS == "NO") {
                var getDoss2 = "--"
            } else {
                var getDoss2 = getDataval[tmwei_NO[i]];
            }
            $("#specialTouwei li[name ='" + (i + 5) + "'] p").text(getDoss2);// 获取页面赔率
            $("#specialTouwei li[name ='" + (i + 5) + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
        }
    });
}


//获取五行半波赔率
function getWUXINGBANBO_dds(whbbType) {
    if (whbbType == "WUXING") {
        //获取特肖特赔率
        var getDataval = {};
        $.post("lottoGetOdds?oddsType=WUXING", function (getOddsData) {
            getDataval = getOddsData['odds'];
            for (var i = 0; i < wh_NO.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval[wh_NO[i]];
                }
                $("#fiveTable li[id ='" + wh_NO[i] + "'] p").text(getDoss);// 获取页面赔率
                $("#fiveTable li[id ='" + wh_NO[i] + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }

        });
    } else if (whbbType == "BANBO") {
        //获取特肖特赔率
        var getDataval2 = {};
        $.post("lottoGetOdds?oddsType=BANBO", function (getOddsData) {
            getDataval2 = getOddsData['odds'];
            for (var i = 0; i < bb_NO.length; i++) {
                if (FPTS == "NO") {
                    var getDoss = "--"
                } else {
                    var getDoss = getDataval2[bb_NO[i]];
                }
                $("#halfWave li[id ='" + bb_NO[i] + "'] p").text(getDoss);// 获取页面赔率
                $("#halfWave li[id ='" + bb_NO[i] + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
            }
        });
    }
}

//获取七码赔率
function getQIMA_dds() {
    //获取七码赔率
    var getDataval = {};
    $.post("lottoGetOdds?oddsType=QIMA_ODD", function (getOddsData) {
        getDataval = getOddsData['odds'];
        for (var i = 0; i < qm_NO_EN.length; i++) {
            if (FPTS == "NO") {
                var getDoss = "--"
            } else {
                var getDoss = getDataval[qm_NO_EN[i]];
            }
            $("#sevenYards li[name ='" + (i) + "'] p").text(getDoss);// 获取页面赔率
            $("#sevenYards li[name ='" + (i) + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
        }
    });
    $.post("lottoGetOdds?oddsType=QIMA_EVEN", function (getOddsData) {
        getDataval = getOddsData['odds'];
        for (var i = 0; i < qm_NO_EN.length; i++) {
            if (FPTS == "NO") {
                var getDoss = "--"
            } else {
                var getDoss = getDataval[qm_NO_EN[i]];
            }
            $("#sevenYards li[name ='" + (i + 8) + "'] p").text(getDoss);// 获取页面赔率
            $("#sevenYards li[name ='" + (i + 8) + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
        }
    });
    $.post("lottoGetOdds?oddsType=QIMA_BIG", function (getOddsData) {
        getDataval = getOddsData['odds'];
        for (var i = 0; i < qm_NO_EN.length; i++) {
            if (FPTS == "NO") {
                var getDoss = "--"
            } else {
                var getDoss = getDataval[qm_NO_EN[i]];
            }
            $("#sevenYards li[name ='" + (i + 16) + "'] p").text(getDoss);// 获取页面赔率
            $("#sevenYards li[name ='" + (i + 16) + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
        }
    });
    $.post("lottoGetOdds?oddsType=QIMA_SMALL", function (getOddsData) {
        getDataval = getOddsData['odds'];
        for (var i = 0; i < qm_NO_EN.length; i++) {
            if (FPTS == "NO") {
                var getDoss = "--";
            } else {
                var getDoss = getDataval[qm_NO_EN[i]];
            }
            $("#sevenYards li[name ='" + (i + 24) + "'] p").text(getDoss);// 获取页面赔率
            $("#sevenYards li[name ='" + (i + 24) + "'] p").attr("style", "color:#FF0000;font-weight:bold;font-size:14px");//给赔率变色
        }
    });
}
