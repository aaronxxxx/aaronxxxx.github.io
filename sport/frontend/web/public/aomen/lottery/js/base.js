$(function () {
	/*click*/
	function clicks(w, l, i, addclass) {
		$(w).on("click", l, function () {
			var me = $(this);
			if (me.find(i).is(":hidden")) {
				me.addClass(addclass).siblings().removeClass(addclass);
				$(i).hide();
				me.find(i).show()
			} else {
				me.removeClass(addclass);
				me.find(i).hide()
			}
		})
	}
	clicks(".lottery", "li", ".lottery-info", "on");
	clicks(".lottery2", "li", ".lottery-info2", "on");

	/*六合彩*/
	function click2(g, t, i, addclass) {
		$(g).on("click", t, function () {
			var me = $(this),
				i1 = me.next(),
				g1 = $(g),
				t1 = me;
			i2 = $(i);
			if (i1.is(":hidden")) {
				$(".p-t").removeClass(addclass);
				t1.addClass(addclass);
				i2.hide();
				i1.show();
			} else {
				t1.removeClass(addclass);
				i1.hide();
			}
		})
	}

	click2(".game-info", ".p-t", ".p-info", "on");



	/*点击更多*/
	$(".h-more").click(function () {
		var l = $(".layout");
		if (l.is(":hidden")) {
			l.show();
		} else {
			l.hide();
		}
	})
	/*首页导航*/
	$("nav").on("click", "li", function () {
		var me = $(this),
			nav2 = me.find(".nav");
		if (nav2.is(":hidden")) {
			nav2.show();
		} else {
			nav2.hide();
		}
	})
	/*我的账户*/
	$(".m-tit").click(function () {
		var me = $(this);
		var info = me.next(".info-con");
		$(".m-tit").removeClass("on");
		me.addClass("on");
		if (info.is(":hidden")) {
			info.show();
		} else {
			info.hide();
		}
	})

	//只能输入数字
	$(".infos input[type='text']").keydown(function () {
		var e = $(this).event || window.event;
		var code = parseInt(e.keyCode);
		if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8) {
			return true;
		} else {
			return false;
		}

	});

})


//清空文本框
function ClearOrder() {
	$(".infos input[type='text']").each(function (index) {
		$(this).val("");
	});


	$(".p-info input[type='text']").each(function (index) {
		$(this).val("");
	});

	//连码
	$(".lianma-info input[type='checkbox']").each(function (index) {
		$(this).attr("checked", false);
	});


	//正码
	$(".game-info input[type='radio']").each(function (index) {
		$(this).attr("checked", false);
	});



}


/***************************六合彩********************************************************/

//文本框只能输入数字最多只能是5位
$(".p-info input[type='text']").keydown(function () {
	var e = $(this).event || window.event;
	var code = parseInt(e.keyCode);
	if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8) {
		$(this).attr({
			maxlength: "5"
		});
		return true;
	} else {
		return false;
	}
});

//半半波
$(".banbo-info input[type='text']").keydown(function () {
	var e = $(this).event || window.event;
	var code = parseInt(e.keyCode);
	if (code >= 96 && code <= 105 || code >= 48 && code <= 57 || code == 8) {
		$(this).attr({
			maxlength: "5"
		});
		return true;
	} else {
		return false;
	}
});
//当前时间
function p(s) {
	return s < 10 ? '0' + s : s;
}
var myDate = new Date();
var h = myDate.getHours(); //获取当前小时数(0-23)
var m = myDate.getMinutes(); //获取当前分钟数(0-59)
var s = myDate.getSeconds();
var nowTime = p(h) + ':' + p(m) + ":" + p(s);



/**
 * 获取用户信息
 * getLoginedInfo()
 */
function getLoginedInfo() {
	$.post("/?r=mobile/index/json", {},
		function (res) {
			if (res.name !== '') {
				$("#centerAmount").html(res.money);
				$('#h_menber').html(res.name);
			}
		}, "json");
}

/**
 * 获取彩票项目
 */
function lotteryName() {
	var _lotteryName = $('#lotteryName').val();
	$('#gameName').text(_lotteryName);
	document.title = _lotteryName;
}

// 开奖结果
function result_type_select(result)
{
    //給你寫按鈕效果
    $('#result_type').val(result.id);           //寫入目前點選欄位
    $("thead th").hide();                       //隱藏全部欄位
    $("tbody td").hide();                       //隱藏全部內容
    $("#th_time").show();                          //開啟時間欄位
    $("#th_quishu").show();                        //開啟期數欄位
    $("td[name='time']").show();                //開啟時間內容
    $("td[name='quishu']").show();              //開啟期數內容
    $("#th_"+result.id).show();                 //開啟點選欄位
    $("td[name='sub_"+result.id+"']").show();   //開啟點選內容
}