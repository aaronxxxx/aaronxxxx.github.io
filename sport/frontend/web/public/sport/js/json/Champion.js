//冠军
function loaded(league,type,url){
    $.ajax({
        type:"post",
        url:url+"&type="+type,
        data:{matchName:league},
        success:function(data){
            $("body").html(data);
        },
        error:function(){
            alert("获取数据失败，请您刷新重试！");
        } 
        }); 
    }
    