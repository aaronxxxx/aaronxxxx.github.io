config.ifdebug=1
var headMethod = {};
var boxId = "#headerData";
var lotCode = lotCode.pk10;
headMethod.loadHeadData = function(issue, boxId) {
	pubmethod.ajaxHead.pk10(issue, boxId);
	setTimeout(function(){
        var idss = $(".headTitle .checkedbl").attr("id");
        tools.classGetDate_pk10(idss, "", "")
    },3000)
}
headMethod.headData = function(jsondata, id) { 
	var data = tools.parseObj(jsondata);
	data = data.result.data;
	var timeResult = tools.operatorTime(data.drawTime==""?"0":data.drawTime, data.serverTime);//得到时间差
	//console.log("timeResult="+timeResult);
	//console.log("data.drawTime="+data.drawTime);
	//console.log("data.serverTime="+data.serverTime);
	tools.publicPk10(jsondata, id, data, timeResult);//提取出开奖视频公共部分 (e, t, i, a)
	method.listData();
}