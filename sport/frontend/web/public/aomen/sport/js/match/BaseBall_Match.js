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
                $.post("/?r=sport/baseball/baseball-match",
                {ball_sort:typename_in,touzhuxiang:match_name_in,match_id:match_id_in,point_column:point_column_in,
					ben_add:ben_add_in,is_lose:is_lose,xx:xx_in,touzhutype:touzhutype,rand:Math.random()}
                    ,function(data){
                        bet(data.msg);}, "json");
                }
}
