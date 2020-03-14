/* 
 * @Date:   2016-08-29 16:00:00
 * @Last Modified by:   mq
 * @Last Modified time: 2016-08-29 09:54:56
 */

//添加样式
$(document).ready(function () {
	$('.p-info ul li').addClass('bet-item');
	$('#tabinnerBet').find('span.bian_td_lab,span.bian_td_odds, .bian_td_inp').click(function(){
		var betLi = $(this).parent('li'),
			money = $('#kuaijiexiazhu_input').val();
		if(betLi.hasClass('selectBet')){
			betLi.find('input[type="checkbox"]').prop("checked", false);
			betLi.removeClass('selectBet');
			betLi.find('.bian_td_inp input.inp1').val('');
		}else{
			betLi.find('input[type="checkbox"]').prop("checked", true);
			betLi.addClass('selectBet');
			betLi.find('.bian_td_inp input.inp1').val(money);
		}
	});
});
// 移除下注
function removeBet() {
	$('#tabinnerBet').find('.selectBet').removeClass('selectBet'); //下注效果取消
	$('#tabinnerBet').find('.inp1').val(''); //清空下注栏位
	$('#kuaijiexiazhu_input').val(''); // 清空筹码栏位
}
$(function () {
	$("li.bet-item").each(function () {
		$(this).find("span").first().addClass("fontBlue");
	});
});

//快速下注点击金额事情	
function set_money(set_money) {
	var input_money = $('#kuaijiexiazhu_input').val();
	if (input_money == '' || input_money == 'undefined') {
		input_money = "";
	};
	var a = parseInt(set_money + +input_money)
	$('#kuaijiexiazhu_input').val(a);
	if ($('#ball_xx2').length > 0) {
		$('#ball_xx2').val(a);
		$('#ball_xx3').val(a);
		$('#ball_xx4').val(a);
		$('#ball_xx5').val(a);
	}
	on_input();
	// if ($('#tabinnerBet .selectBet').hasClass('selected-bet')) {
	// 	$('.bet-item .selected-bet').next().next().children('.inp1').val(a);
	// }
	$('#tabinnerBet').find('.selectBet').children('.bian_td_inp').children('.inp1').val(a);
};

function on_input() {
	var input_money = $('#kuaijiexiazhu_input').val();
	if ($('.fontBlue').hasClass('selected-bet')) {
		$(this).next().next().children(".inp1").val(input_money);
	}
}

//快速下注50/100/500/1000样式的切换
$('.chiplist li').click(function () {
	$(this).addClass('imgchk').siblings().removeClass('imgchk');
});


//牛牛、龙虎快速投注金额
$('#tabs-container2 .p-info ul li span').click(function () {
	if ($(this).index() == 0) {
		$(this).toggleClass("selected-bet");
	}
	if ($(this).hasClass('selected-bet') == false) {
		$(this).next().next().children(".inp1").val("");
	} else {
		var money = $('#kuaijiexiazhu_input').val();
		$(this).next().next().children(".inp1").val(money);
	}
});
//前中后三球投注金额
$('#tabs-container3 .p-info ul li span').click(function () {
	if ($(this).index() == 0) {
		$(this).toggleClass("selected-bet");
	}
	if ($(this).hasClass('selected-bet') == false) {
		$(this).next().next().children(".inp1").val("");
	} else {
		var money = $('#kuaijiexiazhu_input').val();
		$(this).next().next().children(".inp1").val(money);
	}
});
//广西十分彩投注金额
$('#tabs-container4 .p-info ul li span').click(function () {
	if ($(this).index() == 0) {
		$(this).toggleClass("selected-bet");
	}
	if ($(this).hasClass('selected-bet') == false) {
		$(this).next().next().children(".inp1").val("");
	} else {
		var money = $('#kuaijiexiazhu_input').val();
		$(this).next().next().children(".inp1").val(money);
	}
});
//排列3投注金额
$('#tabs-container33 .p-info ul li span').click(function () {
	if ($(this).index() == 0) {
		$(this).toggleClass("selected-bet");
	}
	if ($(this).hasClass('selected-bet') == false) {
		$(this).next().next().children(".inp1").val("");
	} else {
		var money = $('#kuaijiexiazhu_input').val();
		$(this).next().next().children(".inp1").val(money);
	}
});

//自定义金额事件-文本输propertychange入框只要当前对象属性发生改变，都会触发事件
$('#kuaijiexiazhu_input').bind('input propertychange', function () {
	var mineMoney = parseInt($("#kuaijiexiazhu_input").val());
	$('.bet-item .selected-bet').next().next().children('.inp1').val(mineMoney);
	if ($(this).val() == "") {
		$('.bet-item .selected-bet').next().next().children('.inp1').val("");
	};
});
$('#kuaijiexiazhu_input').focus(function () {
	$('.chiplist li').removeClass('imgchk')
})
//取消点击按钮事情
$("#res1").click(function () {
	$('#kuaijiexiazhu_input').val("");
	$('.chiplist li').removeClass('imgchk');
	$('.bet-item .fontBlue').removeClass('selected-bet');
	$('.bet-item .selected-bet').next().next().children('.inp1').val("");
})