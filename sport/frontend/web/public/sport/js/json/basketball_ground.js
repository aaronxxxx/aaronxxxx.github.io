// JavaScript Document 滚球篮球
function loaded(league,type,url){
   $.ajax({
        type:"post",
        url:"/?r=sport/basketball/basketball-live",
        data:{matchName:league},
        success:function(data){
           $("body").html(data);
        },
        error:function(){
          alert("获取数据失败，请重新连接!");
        }
    });
}