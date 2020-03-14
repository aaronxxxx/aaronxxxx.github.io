//其他
function loaded(league,type,url,page){
   $.ajax({
        type:"post",
        url:url+"&page="+page,
        data:{matchName:league},
        success:function(data){
           $("body").html(data);
        },
        error:function(){
            alert("获取数据失败，请您刷新重试！");
        }
    });
}