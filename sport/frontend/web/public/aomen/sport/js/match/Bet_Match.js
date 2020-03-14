
//typename_in游戏类型	
//touzhuxiang_in游戏玩法	
//match_id_in比赛ID	
//point_column_in下注类型（如Match_DsSpl=单双-双）	
//ben_add_in//计算输赢，ben_add为1时减本金，否则不减
//is_lose_in	如果为1，说明是滚球，需要等待确认（注，篮球滚球不需要确认）
//xx_in 玩法信息，如单，双  不入数据库
//touzhutype 1未串关，0为单式
function setbet(typename_in,match_name_in,match_id_in,point_column_in,ben_add_in,is_lose,xx_in,tztype){
            if(!$("#username").val()){ //没有登录
                layer.confirm('还未登录,是否现在登录？',{btn:['确定','取消']},
							function(){
								var $url=window.location.href;
								var $index=$url.indexOf('/?r=');
								if(parseInt($index)>=0){
									$url=$url.substr($index);
									$url=$url.replace('/?r=','[]');    
                                                                        $url=$url.replace(/&/g,'{}');  
								}
								top.location='/?r=mobile/disp/login&url='+$url;
							},function(index){
								layer.close(index);
						});
            }else{          
	touzhutype = tztype;
	$.post("/?r=sport/football/football-match",
        {ball_sort:typename_in,touzhuxiang:match_name_in,match_id:match_id_in,point_column:point_column_in,
			ben_add:ben_add_in,is_lose:is_lose,xx:xx_in,touzhutype:touzhutype,rand:Math.random()}
        ,function(data){ 
            bet(data.msg);},
        "json"); 
    }
}
