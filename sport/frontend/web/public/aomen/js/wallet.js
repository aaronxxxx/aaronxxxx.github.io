

$(function(){

	refreshWallet();
	
});

function refreshWallet(){

	$("#f_member").html(USERNAME);
	$(".ld").css({"display":"block"});
	$(".fn").css({"display":"none"});
	//set memberName
	$(".f_rfs").addClass("onrf");
 
	
	 getWallet();
	 
	 
}


// 钱包加载结束动画
function walletAnimateEnd(totalWallet){
	
	$(".ld").css({"display":"none"});
	$(".fn").css({"display":"inline"});
	$(".f_rfs").removeClass("onrf");

}


// 显示所有游戏厅余额
function getWallet()
{

	var el = $("#balanceList");
	if($("#centerAmount").length == 0)
	{
		el.html("");
		var html ='<div class="f_item" wallet="main">'
			+'<span class="fl">'
			   +'中心钱包:'
			+'</span>'
		    +'<span class="fn" style="display: none;" id="centerAmount">'
		        +'0.00'
		    +'</span>'
			+'<div class="ld" style="display: inline;"></div>'
		+'</div>';
		el.append(html);
	}
	
	$.ajax({
        type: "GET",
        url: "/"+ SERVICE_NAME +"/rest/userCentralService/balance?v="+ (window.VERSION || new Date().getTime()),
        async:true,
        success: function(data,textStatus, request){
        	var balanceCount = parseFloat(data ? data : "0");
        	$("#currencyShow").html(CURRENCY);
        	$("#centerAmount").html(numeral(balanceCount).format('0,0.00'));
        	$("#centerAmount").parent().children(".ld").css({"display":"none"});
        	$("#centerAmount").parent().children(".fn").css({"display":"inline"});
        	
        	if($("#balanceList").length > 0){
	        	// 查询所有游戏厅应用信息
	        	var data = queryGameStatus() ;
	        	$.each(data,function(i,v){
	        		
	        		// 游戏状态  0 关闭，1 开启 ， 2 维护
	        		if(v["status"] == 1 && v["id"] != 11 && v["id"] != 12 && v["id"] != 13 && v["id"] != 7 )
	        		{
	        			// 游戏开启才查询余额
	        			showHallBlance(v["id"]);
	                    
	        		}else if(v["status"] == 2 && v["id"] != 11 && v["id"] != 12 && v["id"] != 13 && v["id"] != 7 )
	        		{
	      
	        			if($("#bl_"+ v["id"]).length == 0)
	        			{
		        			html ='<div class="f_item">'
		        				+'<span class="fl">'
		        				   + GAMES_ID[v["id"]] +"："
		        				+'</span>'
		        			    +'<span class="fn" style="display: none;" id="bl_'+ v["id"] +'">'
		        			       + BLANCE["gameErr"]
		        			    +'</span>'
		        				+'<div class="ld" style="display: inline;"></div>'
		        			+'</div>';
		        			el.append(html);
	        			}
	        			
	        			$("#bl_"+ v["id"]).parent().children(".ld").css({"display":"none"});
	        			$("#bl_"+ v["id"]).parent().children(".fn").css({"display":"inline"});
	        		}
	        	});
        	}else
        	{
        		
        		walletAnimateEnd();
        	}
        	

	    },
	    error:function(data,textStatus, request){
	    	walletAnimateEnd();
	    }
    });
            	


}


function showHallBlance(id){
	
	var el = $("#balanceList");
	if($("#bl_"+ id).length == 0)
	{
		var html ='<div class="f_item">'
			+'<span class="fl">'
			   + GAMES_ID[id] +"："
			+'</span>'
		    +'<span class="fn" style="display: none;" id="bl_'+ id +'">'
		       + ''
		    +'</span>'
			+'<div class="ld" style="display: inline;"></div>'
		+'</div>';
		el.append(html);
	}
	
	$(".f_rfs").addClass("onrf");
	
	$.ajax({
        type: "POST",
        url: "/"+ SERVICE_NAME +"/rest/application/balance?v="+ (window.VERSION || new Date().getTime()),
        data:'{"gameId":'+ id +'}',
        async:true,
        success: function(data, textStatus, request){ 
        	check403AndForward(data,request);
            $("#bl_"+ id).html((!data.status ? BLANCE["queryerr"] : numeral(parseFloat(data["balance"] ? data["balance"] : "0")).format('0,0.00')));
            $("#bl_"+ id).parent().children(".ld").css({"display":"none"});
			$("#bl_"+ id).parent().children(".fn").css({"display":"inline"});
  
            $(".f_rfs").removeClass("onrf");
	    },
	    error:function(data, textStatus, request){
	    	
	    	check403AndForward(data,request);
	    	$("#bl_"+ id).html(A_MSG["apiErr"]);
	    	$(".f_rfs").removeClass("onrf");
	    }
    });
}

