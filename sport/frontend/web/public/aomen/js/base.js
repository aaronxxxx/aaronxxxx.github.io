$(function(){
	/*click*/
	function clicks(w,l,i,addclass){
		$(w).on("click",l,function(){
			var me=$(this);
			if(me.find(i).is(":hidden")){
				me.addClass(addclass).siblings().removeClass(addclass);
				$(i).hide();
				me.find(i).show()
			}else{
				me.removeClass(addclass);
				me.find(i).hide()
			}		
		})	
	}
	clicks(".lottery","li",".lottery-info","on");
	clicks(".lottery2","li",".lottery-info2","on");
	/*点击更多*/
	$(".h-more").click(function(){
		var l=$(".layout");
		if(l.is(":hidden")){
			l.show();
		}else{
			l.hide();
		}
	})
	/*首页导航*/
	$("nav").on("click","li",function(){
		var me=$(this),
			nav2=me.find(".nav");
		if(nav2.is(":hidden")){
			nav2.show();
		}else{
			nav2.hide();
		}	
	})
	/*我的账户*/
	$(".m-tit").click(function(){
		var me=$(this);
	 	var info=me.next(".info-con");
		$(".m-tit").removeClass("on");
		me.addClass("on");
		if(info.is(":hidden")){
			info.show();
		}else{
			info.hide();
		}
	})
	/*六合彩*/
	function click2(g,t,i,addclass){
		$(g).on("click",t,function(){
			var me=$(this),
			i1=me.next(i),
			g1=$(g),
			t1=$(t,g),
			i2=$(i);
			if(i1.is(":hidden")){
				t1.removeClass("on");
				me.addClass(addclass);
				i2.hide();
				i1.show()
			}else{
				me.removeClass(addclass);
				i1.hide()
			}
		})
		
	}



	click2(".game-info",".p-t",".p-info","on");
	click2(".game-info", ".p-t", ".p-info5", "on");



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
        $(this).attr({ maxlength: "5" });
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
        $(this).attr({ maxlength: "5" });
        return true;
    } else {
        return false;
    }
});

