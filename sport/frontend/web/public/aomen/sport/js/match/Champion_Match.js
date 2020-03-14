function setbet(match_id,tid,match_title,url){
	var touzhutype = 2;//touzhutype = 2为冠军
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
            //var match_title = arguments[2]? arguments[2] : "冠军";
		$.post(url,
			{match_id:match_id,tid:tid,match_type:match_title,touzhutype:touzhutype,rand:Math.random()},
				 function(data){
				bet(data.msg);},
			"json");
			}
}
