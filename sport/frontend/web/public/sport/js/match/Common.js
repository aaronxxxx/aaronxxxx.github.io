var time=time_s;  		//120秒自动刷新
var refresh_id = null;
$(document).ready(function(){
	Refresh(); //自动刷新
});

function Refresh(){
	var league = $("#val_name").val();
	var type = $("#val_type").val();
	var url = $("#val_url").val();
	var page = $("#val_page").val();
	if (refresh_id !== null) {
		clearTimeout(refresh_id);
	}
	time=time-1;
	if(time < 1){
		shuaxin(eval(league),type,url,page);
	}else{
            $("#refreshTime").html(time);
	}
        refresh_id = setTimeout("Refresh()",1000);
    }

function shuaxin(league,type,url,page){
	time=time_s;
	loaded(league,type,url,page);
}


//选择联赛
function chk_league(){
	var type = $("#val_type").val();
	var url = $("#val_url").val();
	var page = $("#val_page").val();
	var name='';
	var checkboxs= $("input[name='league_name']");
	for(var i=0;i<checkboxs.length;i++) {
		if(checkboxs[i].checked){
			name += checkboxs[i].value+"|";
		}
	}
	var names = name.substring(0,name.length-1);
	var selectnames = names.split('|');
	loaded(selectnames,type,url,page);
	$("#legView").hide();
}

function killerrors() {
	return true;
}
window.onerror = killerrors;