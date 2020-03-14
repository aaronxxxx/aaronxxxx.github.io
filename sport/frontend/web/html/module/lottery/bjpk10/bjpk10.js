var bool = auto_new = false;
var fp = 0;
var un = 0;
var ball_odds = cl_hao = cl_dx = cl_ds = cl_zhdx = cl_zhds = cl_lh = '';
var is_fenpan = true;
var min_money = 1;
var max_money = 99999999;
//限制只能输入1-9纯数字 
function digitOnly($this) {
    var n = $($this);
    var r = /^\+?[1-9][0-9]*$/;
    if (!r.test(n.val())) {
        n.val("");
    }
}
function reset() {
    document.orders.reset();
}
function updateOpenTime() {
	$.get("/?r=lottery/pk10/index/get-front-info",function(data){
        if (data.isopen > 0 && ((data.opentime > 40 && data.opentime < 240) || (data.opentime > 20 && data.opentime < 30))) {
            clearTimeout(fp);
            endtime(data.opentime);
            $("#open_qihao").html(data.number);
        }
    }, "json");
}
//盘口信息
function loadinfo() {
	dropmap();
	loadhminfo();
	loaddsinfo();
	loaddxinfo();
	
	$.get("/?r=lottery/pk10/index/get-front-info",function(data){
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
            $.jBox.alert('当前彩票已经封盘，请稍后再进行下注！<br><br>北京PK拾开盘时间为：09:02 - 23:57', '提示');
            return false;

        }
    }, "json");
}
// 更新号码 
var hm=ds=dx='';
var snm=inm='';
function loadhminfo() {
	$.get("/?r=lottery/pk10/index/get-h-m-chart",function(data){
		for (var i = 0; i < 5; i++) {
			inm=i+1;
			$("#hmqs_"+inm).html(data[i]["numbers"]);
	        for (var s = 0; s < 10; s++) {
	        	snm=s+1;
	            $("#hm_"+inm+"_"+snm).html(data[i].hm[s]);
	        }
		}
    }, "json");
}
//更新单双
function loaddsinfo() {
	$.get("/?r=lottery/pk10/index/get-d-s-chart",function(data){
		for (var i = 0; i < 5; i++) {
			inm=i+1;
			$("#dsqs_"+inm).html(data[i]["numbers"]);
	        for (var s = 0; s < 10; s++) {
	        	snm=s+1;
	            $("#ds_"+inm+"_"+snm).html(data[i].hm[s]);
	            if(data[i].hm[s]=='\u5355'){
	            	$("#ds_"+inm+"_"+snm).attr("class","blu");
	            }else{
	            	$("#ds_"+inm+"_"+snm).attr("class","red");
	            }
	        }
		}
    }, "json");
}
//更新大小
function loaddxinfo() {
	$.get("/?r=lottery/pk10/index/get-d-x-chart",function(data){
		for (var i = 0; i < 5; i++) {
			inm=i+1;
			$("#dxqs_"+inm).html(data[i]["numbers"]);
	        for (var s = 0; s < 10; s++) {
	        	snm=s+1;
	            $("#dx_"+inm+"_"+snm).html(data[i].hm[s]);
	            if(data[i].hm[s]=='\u5c0f'){
	            	$("#dx_"+inm+"_"+snm).attr("class","blu");
	            }else{
	            	$("#dx_"+inm+"_"+snm).attr("class","red");
	            }
	        }
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
    for (var i = 1; i < 12; i++) {
        if (i == 11) {
            for (var s = 1; s < 22; s++) {
                odds = oddslist.ball[i][s];
               
                $("td"+"#ball_" + i + "_h" + s).each(function(){
                	$(this).html(odds);
                });
                loadinput(i, s);
            }
        } else if (i == 1||i == 2||i == 3||i == 4||i == 5||i == 6||i == 7||i == 8||i == 9||i == 10) {
            for (var s = 1; s < 17; s++) {
                odds = oddslist.ball[i][s];
                $("td"+"#ball_" + i + "_h" + s).each(function(){
                	$(this).html(odds);
                });
                
                loadinput(i, s);
            }
        } else if (i < 6) {
            for (var s = 15; s < 17; s++) {
                odds = oddslist.ball[i][s];
                $("td"+"#ball_" + i + "_h" + s).each(function(){
                	$(this).html(odds);
                });
                loadinputs(i, s);
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
    for (var s = 1; s < 15; s++) {
        odds = ball_odds.ball[ball][s];
        $("#ball_1_h" + s).html(odds);
        loadinput(ball, s);
    }
    for (var i = 0; i < 10; i++) {
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

    $("td"+"#ball_" + ball + "_t" + s).each(function(){
    	$(this).html(n);
    });
}
function loadinputs(ball, s) {
    b = "ball_" + ball + "_" + s;
    n = "<input name=\"" + b + "\" id=\"" + b + "\" class=\"inp1\" onkeyup=\"digitOnly(this)\" onfocus=\"this.className='inp1m'\" onblur=\"this.className='inp1';\" type=\"text\" maxLength=\"5\"/>"
    $("td"+"#ball_" + ball + "_t" + s).each(function(){
    	$(this).html(n);
    });
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
        sMinute = iMinute.toString();
    }
    iSecond = parseInt(iTime % 60);
    if (iSecond >= 0 && iSecond < 10) {
        sSecond = "0" + iSecond;
    }
    if (iSecond >= 10) {
        sSecond = iSecond.toString();
    }
    sTime = sMinute + sSecond;
    if (iTime == 0) {
        $("#look").html('<embed width="0" height="0" src="js/2.swf" type="application/x-shockwave-flash" hidden="true" />');
        var xnumbers = parseInt($("#numbers").html());
        //var numinfo= xnumbers+1+'正在开奖...';
        var numinfo = '<span>正在开奖...</span>';
        $("#autoinfo").html(numinfo);
        var i = 0;
        $('.kick').each(function () {
            var e = $(this).children('img');
            e.prop('src', '../images/open_3/x.png');
            i++;
        });
    }
    if (iTime == 30) {
        $(".bian_td_odds").html("-");
        $(".bian_td_inp").html("封盘");
        $("#look").html('<embed width="0" height="0" src="js/1.swf" type="application/x-shockwave-flash" hidden="true" />');
        is_fenpan = true;
    }

    if (iTime < 0) {
        clearTimeout(fp);
        loadinfo();
    } else {
        iTime--;
        var t = 'time';
        if (iTime < 30) {
            is_fenpan = true;
            t = 'times';
        }
        $('#cqc_time').html(getIS(iTime));
        $("#sss").html(iTime);
        $('.colon > img').attr('src', '../images/' + t + '/10.png');
        $('.minute > span > img').eq(0).attr('src', '../images/' + t + '/' + sTime.substr(0, 1) + '.png');
        $('.minute > span > img').eq(1).attr('src', '../images/' + t + '/' + sTime.substr(1, 1) + '.png');
        $('.second > span > img').eq(0).attr('src', '../images/' + t + '/' + sTime.substr(2, 1) + '.png');
        $('.second > span > img').eq(1).attr('src', '../images/' + t + '/' + sTime.substr(3, 1) + '.png');
        fp = setTimeout("endtime(" + iTime + ")", 1000);
    }
}
//更新开奖号码
function auto(ball) {
	$.get("/?r=lottery/pk10/index/get-k-j-result", function(data){
        $("#numbers").html(data.numbers);
        var openqihao = $("#open_qihao").html();
        if (auto_new == false || openqihao - data.numbers == 1) {
            var numinfo = '';
            if (typeof data.hms == "object") {
                numinfo = numinfo + '冠亚军和：<span>' + data.hms[0] + '</span><span>' + data.hms[1] + '</span><span>' + data.hms[2] + '</span>1V10龙虎：<span>' + data.hms[3] + '</span>2V9龙虎：<span>' + data.hms[4] + '</span>3V8龙虎：<span>' + data.hms[5] + '</span>4V7龙虎：<span>' + data.hms[6] + '</span>5V6龙虎：<span>' + data.hms[7] + '</span>';
            }
            
            var rsdata="";
            for(var key in data.hm){
            	 rsdata = rsdata + data.hm[key] +", ";
            }
            rsdata=rsdata.substring(0,rsdata.length-2)
            $("#autoinfo").html(rsdata);
            
            var i = 0;
            var fun = 8;
            $('.kick').each(function () {
            	var e = $(this)
                var nu = data.hm[i];
                
                if (typeof nu !== 'undefined') {
                    setTimeout(function () {
                    	e.html(nu);
                    }, fun * 600);
                }
                i++;
                fun--;
            });
            auto_new = true;
            if (openqihao - data.numbers != 1) {
                xhm = setTimeout("auto(1)", 3000);
            }
        } else {
            xhm = setTimeout("auto(1)", 3000);
        }
        var auto_top = '<table width="100%" border="0" cellspacing="1" cellpadding="0" class="clbian"><tr class="clbian_tr_title"><td colspan="2">开奖结果</td></tr><tr class="clbian_tr_title"><td>开奖期数</td><td>开奖号码</td></tr>';
        for (var key in data.hmlist) {
            auto_top = auto_top + '<tr class="clbian_tr_txt"><td class="qihao">' + key + '</td><td class="haoma">' + data.hmlist[key] + '</td></tr>'
        }
        auto_top = auto_top + '</table>'
        //$("#auto_list").html(auto_top);
        //$(parent.leftFrame.document).find("#auto_list").html(auto_top);
    }, "json");
}
//投注提交
function order() {
	var betjsonstr="{";
    var tt = $("input.inp1");
    var mix = min_money;
    cou = m = 0, txt = '', c = true;
    var max_true = true;
    for (var i = 1; i < 12; i++) {
        if (i == 11) {
            for (var s = 1; s < 22; s++) {
                if ($("#ball_" + i + "_" + s).val() != "" && $("#ball_" + i + "_" + s).val() != null) {
                    cou++;
                    betjsonstr=betjsonstr+"\""+"ball_" + i + "_" + s+"\":\""+parseInt($("#ball_" + i + "_" + s).val())+"\",";
                }
            }
        } else {
            for (var s = 1; s < 17; s++) {
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
		$.jBox.tip("请输入下注金额!!!");
		return false;
	}else{
		$(".submit").attr("onclick","");
	}
	
	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	$.post("/?r=lottery/pk10/index/prepare-order",{data:betjsonstr,_csrf:csrfToken},function(data){
		$(".submit").attr("onclick","order();");
		if(data.code=='6'){
			$.jBox.tip("您还未来登入！");return false;
		}
		if(data.code=='1'){
			$.jBox.tip("请输入有效的投注金额。");return false;
		}else if(data.code=='2'){
			$.jBox.tip("单注金额受限");return false;
		}else if(data.code=='3'){
			$.jBox.tip("账户余额不足!");return false;
		}else if(data.code=='4'){
			$.jBox.tip("超过当期下注最大金额，请联系管理人员。");return false;
		}else if(data.code=='5'){
			$.jBox.tip("已经封盘了，超出了投注时间");return false;
		}else{
			if (confirm(data.msg)){
				document.orders.reset();
				$.post("/?r=lottery/pk10/index/insert-order",{data:betjsonstr,_csrf:csrfToken}, function(data){
					if(data==null){
						$.jBox.tip("操作成功。");
					}else{
						$.jBox.tip("操作失败。");return false;
					}
		        	
		        }, "json"); 
		       
			}
		}
	
	}, "json"); 
}
