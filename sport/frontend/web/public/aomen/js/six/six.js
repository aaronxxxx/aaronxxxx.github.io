
$.get("/?r=six/index/ajax&rtype=home", function(data,hm){
    var result = data;
    var result2 = JSON.parse(result);
    var sp_result = result2.kjresult[0];
    if(result2.kjresult.length == 0){
        console.log('error!');
    }else{
        var str =sp_result.ball_1 +',' +sp_result.ball_2 +','+sp_result.ball_3 +','+sp_result.ball_4 +','+sp_result.ball_5+', '+sp_result.ball_6 +','+sp_result.ball_7;
    }
  
    $('#sp_lottery_result').append(str);              
});
$(document).ready(function(){
    open_result('six');
});