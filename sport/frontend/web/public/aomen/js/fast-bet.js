/* 
* @Date:   2016-08-29 16:00:00
* @Last Modified by:   anchen
* @Last Modified time: 2016-10-13 18:04:58
*/

//快速下注点击金额事情	
	function set_money(set_money){
		var input_money = $('#kuaijiexiazhu_input').val();
		if(input_money == '' || input_money == 'undefined'){
			input_money = "";
		};
		var a = parseInt(set_money + + input_money)
		$('#kuaijiexiazhu_input').val(a);
		on_input();
		//if($('.bet-item').children().eq(0).hasClass('selected-bet') == true){
		  $('.selected-bet').next().next().children('.GoldQQ').val(a);
		//}
	};
	  
   function on_input(){
		var input_money = $('#kuaijiexiazhu_input').val();
		if($('.bet-item').children().eq(0).hasClass('selected-bet')){
		  $(this).next().next().children(".GoldQQ").val(input_money);
		}
	}
	
	//快速下注50/100/500/1000样式的切换
	$('.chiplist li').click(function () {
		$(this).addClass('imgchk').siblings().removeClass('imgchk');
	});
	
	//快速下注投注金额
	 $('#tabs-container #bet-item span').click(function () {
		 if($(this).index() == 0) {
			 $(this).toggleClass("selected-bet");
		}
		if($(this).hasClass('selected-bet') == false){
		  $(this).next().next().children(".GoldQQ").val("");
		} 
		else{
			var money = $('#kuaijiexiazhu_input').val();
			$(this).next().next().children(".GoldQQ").val(money);
			}
	});

	//自定义金额事件-文本输propertychange入框只要当前对象属性发生改变，都会触发事件
	$('#kuaijiexiazhu_input').bind('input propertychange', function () {
		var mineMoney= parseInt($("#kuaijiexiazhu_input").val());
		$('#bet-item .selected-bet').next().next().children('.GoldQQ').val(mineMoney);
		if ($(this).val() == "") {
			$('.bet-item .selected-bet').next().next().children('.GoldQQ').val("");
		};
	});	
	$('#kuaijiexiazhu_input').focus(function() {
		$('.chiplist li').removeClass('imgchk')
	})
	//取消点击按钮事情
	 $("#res1").click(function() {
		$('#kuaijiexiazhu_input').val("");
		$('.chiplist li').removeClass('imgchk');
		$('.bet-item .fontBlue').removeClass('selected-bet');
		$('.bet-item .selected-bet').removeClass('selected-bet');
		$('.bet-item .selected-bet').next().next().children('.GoldQQ').val("");
	})

   
	
	