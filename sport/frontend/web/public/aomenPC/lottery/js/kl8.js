var bool = auto_new = false;
var sound_off = 0;
var fp = 0;
var un = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var is_fenpan = true;
var min_money = 1;
var max_money = 99999999;


var links = $("link");
var path=links[0].href;
path=path.substring(0,path.lastIndexOf('/'));
path=path.substring(0,path.lastIndexOf('/'));


$(function () {
    $('#cqc_sound').bind('click', function () {//绑定声音按钮
        var e = $(this);
        if (e.attr('off') == '1') {//声音开启
            e.attr('off', '0');
            e.children('img').attr('src', path+'/images/on.png');
            sound_off = 0;
        } else {//关闭
            e.attr('off', '1');
            e.children('img').attr('src', path+'/images/off.png');
            sound_off = 1;
        }
    });
});

function reset() {
    document.orders.reset();
}

//限制只能输入1-9纯数字 
function digitOnly($this) {
    var n = $($this);
    var r = /^\+?[1-9][0-9]*$/;
    if (!r.test(n.val())) {
        n.val("");
    }
}
function updateOpenTime() {
	$.get("/?r=lottery/kl8/index/get-front-info",function(data){
        if (data.isopen > 0 && (data.opentime > 20 && data.opentime < 240)) {
            clearTimeout(fp);
            endtime(data.opentime);
            $("#open_qihao").html(data.number);
        }
    }, "json");
}
//盘口信息
function loadinfo() {
	$.get("/?r=lottery/kl8/index/get-front-info",function(data){
        if (data.opentime > 0) {
            is_fenpan = false;
            if (!data.isopen) {
                is_fenpan = true;
            }
            $("#open_qihao").html(data.number);
            ball_odds = data.oddslist;
            loadodds(data.oddslist);
            endtime(data.opentime);
            auto(1);
            min_money = data.min_money;
            max_money = data.max_money;
            if (un != 0) {
                clearInterval(un);
            }
            un = setInterval(updateOpenTime, 10000);
            hm_odds(1);
        } else {
            is_fenpan = true;
            $(".bian_td_odds").html("-");
            $(".bian_td_inp").html("封盘");
            $("#autoinfo").html("已经封盘，请稍后进行投注！");
            $.jBox.alert('当前彩票已经封盘，请稍后再进行下注！<br><br>北京快乐8开盘时间为：每日09:00 - 23:55', '提示');
            return false;
        }
    }, "json");
}
//更新赔率
function loadodds(oddslist) {
    if (oddslist == null || oddslist == "" || is_fenpan) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        return false;
    }
    for (var i = 1; i < 9; i++) {
        if (i == 1) {
            for (var s = 1; s < 81; s++) {
                odds = oddslist.ball[i][1];
                $("#ball_" + i + "_h" + s).html(odds);
                loadinput(i, s);
            }
            if (i == 1) {
                $("#note_p").html("<font color='#000'>选一中一赔率为:</font><font color='red'><B>" + oddslist.ball[i][1] + "</B></font>");
            }
        } else if (i == 6) {
            for (var s = 1; s < 6; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_" + i + "_h" + s).html(odds);
                loadinput(i, s);
            }
        } else if (i == 7) {
            for (var s = 1; s < 4; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_" + i + "_h" + s).html(odds);
                loadinput(i, s);
            }
        } else if (i == 8) {
            for (var s = 1; s < 4; s++) {
                odds = oddslist.ball[i][s];
                $("#ball_" + i + "_h" + s).html(odds);
                loadinput(i, s);
            }
        }
    }

}
//号码赔率
function hm_odds(ball) {
    if (ball_odds == null || ball_odds == "" || is_fenpan) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        return false;
    }
    for (var s = 1; s < 81; s++) {
        odds = ball_odds.ball[ball][1];
        $("#ball_1_h" + s).html(odds);
        loadinput(ball, s);
    }
    if (ball == 1) {
        $("#note_p").html("<font color='#000'>选一中一赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][1] + "</B></font>");
    }
    if (ball == 2) {
        $("#note_p").html("<font color='#000'>选二中二赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][1] + "</B></font>");
    }
    if (ball == 3) {
        $("#note_p").html("<font color='#000'>选三中二赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][2] + "</B></font>;&nbsp;&nbsp<font color='#000'>选三中三赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][1] + "</B></font>");
    }
    if (ball == 4) {
        $("#note_p").html("<font color='#000'>选四中二赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][3] + "</B></font>;&nbsp;&nbsp<font color='#000'>选四中三赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][2] + "</B></font>;&nbsp;&nbsp<font color='#000'>选四中四赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][1] + "</B></font>");
    }
    if (ball == 5) {
        $("#note_p").html("<font color='#000'>选五中三赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][3] + "</B></font>;&nbsp;&nbsp<font color='#000'>选五中4赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][2] + "</B></font>;&nbsp;&nbsp<font color='#000'>选五中五赔率为:</font><font color='red'><B>" + ball_odds.ball[ball][1] + "</B></font>");
    }
    for (var i = 0; i < 5; i++) {
        if (i == ball - 1) {
            $('#menu_hm > li').eq(i).removeClass("current_n").addClass("current");
        } else {
            $('#menu_hm > li').eq(i).removeClass("current").addClass("current_n");
        }
    }

}

//更新投注框
function loadinput(ball, s) {
    b = "ball_" + ball + "_" + s;
    n = "<input name=\"" + b + "\" id=\"" + b + "\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"5\"/>"
    n2 = "<input name=\"" + b + "\" id=\"" + b + "\" class=\"inp1\" type=\"checkbox\" />"
    if (ball < 6 && ball > 1) {
        $("#ball_1_t" + s).html(n2);
        $("#xia_money").html("下注金额:");
        $("#glod_money").html("<input name=\"ball_xx\" id=\"ball_xx\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"5\"/>");
    } else if (ball > 5) {
        $("#ball_" + ball + "_t" + s).html(n);
    } else if (ball == 1) {
        $("#ball_1_t" + s).html(n);
        $("#xia_money").html("");
        $("#glod_money").html("");
    }
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
    var iMinute, iSecond;
    var sMinute = "", sSecond = "", sTime = "";
    iMinute = parseInt((iTime / 60) % 60);
    if (iMinute == 0) {
        sMinute = "00";
    }
    if (iMinute > 0 && iMinute < 10) {
        sMinute = "0" + iMinute;
    }
    if (iMinute > 10) {
        sMinute = iMinute;
    }
    iSecond = parseInt(iTime % 60);
    if (iSecond >= 0 && iSecond < 10) {
        sSecond = "0" + iSecond;
    }
    if (iSecond >= 10) {
        sSecond = iSecond;
    }
    sTime = sMinute + sSecond;
    if (iTime == 0) {
    	$("#look").html('<embed width="0" height="0" src='+path+'"/images/swf/2.swf" type="application/x-shockwave-flash" hidden="true" />');
        var xnumbers = parseInt($("#numbers").html());
        //var numinfo= xnumbers+1+'正在开奖...';
        var numinfo = '<span>正在开奖...</span>';
        $("#autoinfo").html(numinfo);
        var i = 0;
        $('.open_number > img ').each(function () {
            var e = $(this);
            e.prop('src', path+'/images/Ball_4/0.png');
            i++;
        });
    }
    if (iTime == 10) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        $("#look").html('<embed width="0" height="0" src='+path+'"/images/swf/1.swf" type="application/x-shockwave-flash" hidden="true" />');
        is_fenpan = true;
    }
    if (iTime < 0) {
        clearTimeout(fp);
        loadinfo();
    } else {
        iTime--;
        var t = 'time';

        if (iTime > 10) {
            $('#cqc_time').html(getIS(iTime - 10));
            if (cqc_color != 'red') {
                $('#cqc_time').css('color', 'red');
            }

            if (iTime == 16) {//离开赛还有16秒，播放声音
                var isIE10 = /MSIE\s+10.0/i.test(navigator.userAgent) && (function () {
                    "use strict";
                    return this === undefined;
                }());
                var isIE9 = /MSIE\s+9.0/i.test(navigator.userAgent) && (function () {
                    "use strict";
                    return this === undefined;
                }());
                if (!sound_off && !isIE10 && !isIE9) {
                   // getSwfId('swfcontent').Pten();
                }
            }
        }

        if (iTime <= 10 && iTime > 0) {
            $('#cqc_time').html(getIS(iTime));
            if (cqc_color != 'blue') {
                $('#cqc_time').css('color', '#006600');
            }
        }

        if (iTime < 10) {
            is_fenpan = true;
            t = 'times';
        }
        $("#sss").html(iTime);

        //$('.colon > img').attr('src','../images/'+t+'/10.png');
        //$('.minute > span > img').eq(0).attr('src','../images/'+t+'/'+sTime.substr(0,1)+'.png');
        //$('.minute > span > img').eq(1).attr('src','../images/'+t+'/'+sTime.substr(1,1)+'.png');
        //$('.second > span > img').eq(0).attr('src','../images/'+t+'/'+sTime.substr(2,1)+'.png');
        //$('.second > span > img').eq(1).attr('src','../images/'+t+'/'+sTime.substr(3,1)+'.png');
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}
//更新开奖号码
function auto(ball) {
	$.get("/?r=lottery/kl8/index/get-k-j-result", function(data){
        $("#numbers").html(data.numbers);
        var openqihao = $("#open_qihao").html();
        if (auto_new == false || openqihao - data.numbers == 1 || openqihao - data.numbers > 1) {
            var numinfo = '';
            if (typeof data.hms === "object") {
                numinfo = numinfo + '总和：<span><font>' + data.hms[0] + '</font></span>&nbsp;&nbsp;&nbsp;&nbsp;和值：<span><font>' + data.hms[1] + '</font></span>&nbsp;&nbsp;<span><font>' + data.hms[2] + '</font></span><br>上中下：<span><font>' + data.hms[3] + '</font></span>&nbsp;&nbsp;奇和偶：<span><font>' + data.hms[4] + '</font></span>';
            }
            
            $("#autoinfo").html(numinfo);
            if ($.ua().isIe7) {
                $("#autoinfo span font").css('font-size', '12px');
            }
            var i = 0;
            var fun = 20;
            $('.open_number > img ').each(function () {
                var e = $(this);
                var nu = data.hm[i];
                
                if (typeof nu !== 'undefined') {
                	var links = $("link");
                	var path=links[0].href;
                	path=path.substring(0,path.lastIndexOf('/'));
                	path=path.substring(0,path.lastIndexOf('/'));
                    setTimeout(function () {
                        e.prop('src', path+'/images/Ball_4/' + nu + '.png');
                    }, fun * 600);
                }
                i++;
                fun--;
            });
            auto_new = true;
            if (openqihao - data.numbers != 1) {
                xhm = setTimeout("auto(1)", 5000);
            }
        } else {
            xhm = setTimeout("auto(1)", 5000);
        }
//        var auto_top = '<table width="100%" border="0" cellspacing="1" cellpadding="0" class="clbian"><tr class="clbian_tr_title"><td colspan="2">开奖结果</td></tr><tr class="clbian_tr_title"><td>开奖期数</td><td>开奖号码</td></tr>';
//        for (var key in data.hmlist) {
//            auto_top = auto_top + '<tr class="clbian_tr_txt"><td class="qihao">' + key + '</td><td class="haoma">' + data.hmlist[key] + '</td></tr>'
//        }
//        auto_top = auto_top + '</table>'
        //$("#auto_list").html(auto_top);
        //$(parent.leftFrame.document).find("#auto_list").html(auto_top);
    }, "json");
}
//投注提交
function order() {
//    if ($(window.parent.frames["topFrame"].document).find("#user_money").length > 0 && $(window.parent.frames["topFrame"].document).find("#user_money").html() == "" || $(window.parent.frames["topFrame"].document).find("#username").length != 0) {
//        alert("您还未登录，请先登录再投注。");
//        return;
//    }
	var betjsonstr="{";
    var tt = $("input.inp1");
    var mix = min_money;
    cou = m = 0, txt = '', c = true;
    var max_true = true;
    for (var i = 1; i < 9; i++) {
        if (i == 1) {
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_" + i + "_" + s).val())+"\",";
                }
            }
        } else if (i == 2) {
            var ck = 0;
            var xNum = "";
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_xx").val())+"\",";
                }
            }

            if (ck != 0) {
                if (ck != i) {
                    confirm("[选二]请选择" + i + "个号码!");
                    return false;
                }

                var m = $("#ball_xx").val();
                
                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                }else{
                	 cou++;
                }
            }

        } else if (i == 3) {
            var ck = 0;
            var xNum = "";
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_xx").val())+"\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    confirm("[选三]请选择" + i + "个号码!");
                    return false;
                }

                var m = $("#ball_xx").val();

                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                }else{
                	 cou++;
                }
            }

        } else if (i == 4) {
            var ck = 0;
            var xNum = "";
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_xx").val())+"\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    confirm("[选四]请选择" + i + "个号码!");
                    return false;
                }

                var m = $("#ball_xx").val();

                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                }else{
                	 cou++;
                }
            }
        } else if (i == 5) {
            var ck = 0;
            var xNum = "";
            for (var s = 1; s < 81; s++) {
                if ($("#ball_" + i + "_" + s).attr("checked") == "checked") {
                    ck++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_xx").val())+"\",";
                }
            }
            if (ck != 0) {
                if (ck != i) {
                    confirm("[选五]请选择" + i + "个号码!");
                    return false;
                }

                var m = $("#ball_xx").val();

                if (m == "" || m == null) {
                    confirm("请填写下注金额!");
                    return false;
                }else{
                	 cou++;
                }
            }
        } else if (i == 6) {
            for (var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_" + i + "_" + s).val())+"\",";
                }
            }
        } else if (i == 7) {
            for (var s = 1; s < 4; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_" + i + "_" + s).val())+"\",";
                }
            }
        } else if (i == 8) {
            for (var s = 1; s < 6; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_" + i + "_" + s).val())+"\",";
                }
            }
        }
    }

    betjsonstr=betjsonstr.substr(0,betjsonstr.length-1);
	betjsonstr=betjsonstr+"}";
	
	if (cou <= 0) {
		layer.msg("请输入下注金额!!!", {icon: 0}); 
		return false;
	}else{
		//$(".submit").attr("onclick","");
	}
    
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.post("/?r=lottery/kl8/index/prepare-order",{data:betjsonstr,_csrf:csrfToken},function(data){
    	//$(".submit").attr("onclick","order();");
    	if(data.code=='6'){
    		alert("您还未来登入！");return false;
    	}
    	if(data.code=='1'){
    		layer.msg("请输入有效的投注金额。", {icon: 0}); return false;
    	}else if(data.code=='2'){
    		layer.msg("单注金额受限", {icon: 0}); return false;
    	}else if(data.code=='3'){
    		layer.msg("账户余额不足!", {icon: 0}); return false;
    	}else if(data.code=='4'){
    		layer.msg("超过当期下注最大金额，请联系管理人员。", {icon: 0}); return false;
    	}else if(data.code=='5'){
    		layer.msg("已经封盘了，超出了投注时间", {icon: 0}); return false;
    	}else{
        	layer.confirm(data.msg, {btn:['确认','取消']}, 
            		function(index){
		    			document.orders.reset();
		    			layer.close(index);
		    			$.post("/?r=lottery/kl8/index/insert-order",{data:betjsonstr,_csrf:csrfToken}, function(data){
		    				if(data==null){
		    					layer.msg("操作成功。", {icon: 1});
                                $.post("/?r=passport/user-api/login",'', function(rst){
                                    $("body",parent.document).find('#user_money').html(rst.data.user.money);
                                },"json");
		    				}else{
		    					layer.msg("操作失败。", {icon: 0}); return false;
		    				}
		    	        }, "json"); 
            		}, 
            		function(){
            			
            		});
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