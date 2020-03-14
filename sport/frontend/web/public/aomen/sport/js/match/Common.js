function go(url){
	location.href=url;
}
var time=time_s;  		//120秒自动刷新
var refresh_id = null;

$(document).ready(function(){
	Refresh(); //自动刷新
});

function Refresh(){
        if (refresh_id !== null) {
            clearTimeout(refresh_id);
        }
	time=time-1;
	if(time < 1){
		location.reload();
	}else{
            $("#sx_f5").html(time);
            $("#order_sx_f5").html(time);
	}
        
        refresh_id = setTimeout("Refresh()",1000);
    }


function formatNumber(num,exponent){
	if(num > 0){
		return parseFloat(num).toFixed(exponent);
	}else{
		return '';
	}
}  

function shuaxin(){
	time=time_s;
	$this.window.location.reload();
}

function shuaxin1(){
	time=time_s
	$this.window.location.reload();
}

function check_one(lsm){
        var league = lsm+"'"+","+"'";
	//document.getElementById("league").value	=	lsm;
	loaded(league);
}

function set_num(num,fid,zid){
	var fsum	=	window.parent.leftFrame.document.getElementById(fid).innerHTML.match(/([0-9]{1,})/ig);
	var zsum	=	window.parent.leftFrame.document.getElementById(zid).innerHTML.match(/([0-9]{1,})/ig);
	fsum		=	fsum*1;
	zsum		=	zsum*1;
	fsum		=	fsum-zsum+num;
	window.parent.leftFrame.document.getElementById(fid).innerHTML	=	fsum+"";
	window.parent.leftFrame.document.getElementById(zid).innerHTML	=	num+"";
}

function _attachEvent(obj, evt, func, eventobj) {
	eventobj = !eventobj ? obj : eventobj;
	if(obj.addEventListener){
		obj.addEventListener(evt, func, false);
	}else if(eventobj.attachEvent){
		obj.attachEvent('on' + evt, func);
	}
}

function killerrors() {
	return true;
}
window.onerror = killerrors;