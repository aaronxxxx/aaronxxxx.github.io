// 足球滚球
function loaded(league,type,url){
   $.ajax({
        type:"post",
        url:"/?r=sport/football/football-live",
        data:{matchName:league},
        success:function(data){
           $("body").html(data);
        },
        error:function(){
        	alert("获取数据失败，请重新获取！");
        }
    });
}