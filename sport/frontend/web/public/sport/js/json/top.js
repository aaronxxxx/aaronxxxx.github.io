$(document).ready(function(){
    showtime();
    reloadtop()
});

//显示时间
function showtime(){
    var obj = new Date();
    var y = obj.getFullYear();
    var m = obj.getMonth()+1;
    var d = obj.getDate();
    var h = obj.getHours();
    var i = obj.getMinutes();
    var s = obj.getSeconds();
    if(m<10)m="0"+m;
    if(d<10)d="0"+d;
    if(h<10)h="0"+h;
    if(i<10)i="0"+i;
    if(s<10)s="0"+s;
    var time = y+'年'+m+'月'+d+'日 '+h+':'+i+':'+s;
    $("#head_date").html(time);
    setTimeout(showtime,1000);
}

//刷新头部
function reloadtop() {
    $.ajax({
        type:"post",
        url:"/?r=sport/top/top&timestamp=" + new Date().getTime(),
        dataType:'json',
        success:function(data){
            $("#username").html(data.msg.username);
            $("#grounderFootball").html(data.msg.grounderFootball);
            $('#grounderBasketball').html(data.msg.grounderBasketball);
            $('#todayFootball').html(data.msg.todayF);
            $('#todayBasketball').html(data.msg.todayB);
            $('#todayTennis').html(data.msg.todayT);
            $('#todayVolleyball').html(data.msg.todayV);
            $('#todayBaseball').html(data.msg.todayBS);
            $('#todayOther').html(data.msg.todayO);
            $('#morningFootball').html(data.msg.morningF);
            $('#morningBasketball').html(data.msg.morningB);
            $('#morningTennis').html(data.msg.morningT);
            $('#morningBaseball').html(data.msg.morningBS);
            $('#morningVolleyball').html(data.msg.morningV);
            $('#morningOther').html(data.msg.morningO);
            $("#loading").hide();
            $("#loaded").show();
        },
        error:function(){
            alert("获取数据失败，请您刷新重试！");
        }
    });

    setTimeout(reloadtop,60*10*1000);
}
