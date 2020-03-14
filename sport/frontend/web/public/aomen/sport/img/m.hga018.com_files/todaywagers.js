function todaywagers(){
	var _self = this;
	var parentClass;
	var _mc = new Object();
	_self.paramHash = new Object();
	_self.paramHash["errorMsg"] = "";
	_self.classname = "todaywagers.js";
	
	var xmlnode;
	var div_show;
	var noTodayWagersObj;
	var total_accountsObj;
	var bottom_topObj;
	var sportsdropdownObj;
	var allsportsObj;
	var danAry = new Array();
	var _amout_gold = 0;
	var _nowPage = 1;
	var _pageCount = 10;
	var _scrollHeightLimit = 100;
	
	_self.setParentclass=function(parentclass){
		parentClass=parentclass;
	}
	
	_self.getThis=function(varible){
		return eval(varible);
	}
	
	_self.setPrivate=function(varible,val){
		eval(varible+"='"+val+"'");
	}
	
	//init
	_self.init=function(){
		_self.initTitleEvent();
		
		noTodayWagersObj = document.getElementById("noTodayWagers");
		total_accountsObj = document.getElementById("total_accounts");
		bottom_topObj = document.getElementById("bottom_top");
		
		sportsdropdownObj = document.getElementById("sportsdropdown");
		util_initGtypeOption(sportsdropdownObj, _top["gtype_array"]);
		_self.addEventListener("SelectEvent.ONCHANGE",_self.loadTodayWager,sportsdropdownObj);
		
		allsportsObj = document.getElementById("allsports");
		_self.addEventListener("MouseEvent.CLICK",_self.showViewMore,allsportsObj);
		_self.addEventListener("exitEventHandler",_self.exitEventHandler);
		_self.addEventListener("reloadEventHandler", function(){});

		_self.initDataClass();
		
		amout_goldObj = document.getElementById("amout_gold");
		
	}
	
	//exit
	_self.exitEventHandler=function(url){
			//alert("exit==>"+param);
			var ret = _self.clearTimer();
			if(ret&&url!=""){
					loadHtml_loading(url, true);
			}
	}
	
	_self.initTitleEvent=function(){
		//_mc["title_todaywagers"] = document.getElementById("title_todaywagers");
		_mc["title_cancelwagers"] = document.getElementById("title_cancelwagers");
		_mc["title_history"] = document.getElementById("title_history");
		
		//_mc["title_todaywagers"].url = "todaywagers";
		_mc["title_cancelwagers"].url = "cancelwagers";
		_mc["title_history"].url = "history_data";
		
		//_self.addEventListener("MouseEvent.CLICK",_self.goToPageHandler,_mc["title_todaywagers"]);
		_self.addEventListener("MouseEvent.CLICK",_self.goToPageHandler,_mc["title_cancelwagers"]);
		_self.addEventListener("MouseEvent.CLICK",_self.goToPageHandler,_mc["title_history"]);
	}
	
	_self.initDataClass=function(){

				dataClass["header"] = extendsClass(_top["MovieClipClass"], header);
				dataClass["header"].init();
				dataClass["bottom"] = extendsClass(_top["MovieClipClass"], bottom);
				dataClass["bottom"].init();

		
		dataClass["header"].setParentclass(_self);
		dataClass["bottom"].setParentclass(_self);
		dataClass["header"].setBackPage("home");
		//_self.loadTodayWager();
		
		_self.clearTimer();
		_self.createTimer();
	}
	
	_self.loadTodayWager=function(){
		_self.paramHash["LS"] = _top["userData"].shortlangx;
		_self.paramHash["id"] = _top["userData"].mid;
		_self.paramHash["selGtype"] = sportsdropdownObj.value;
		_self.paramHash["chk_cw"] = "N";
		
		
		var urlHash = new Array();
		urlHash["uid"] =  _top["userData"].uid;
		//urlHash["mid"] =  _top["userData"].mid;
		urlHash["langx"] = _top["userData"].langx;
		urlHash["LS"] = _top["userData"].shortlangx;
		urlHash["selGtype"] = _self.paramHash["selGtype"];
		urlHash["chk_cw"] = _self.paramHash["chk_cw"];
		
		
		var getHTML = new loadingRequest();
		getHTML.addEventListener("LoadComplete",_self.loadTodayWagerComplete);
		getHTML.loadURL("app/member/get_today_wagers.php","POST",convertParam(urlHash));
	}
	
	_self.loadTodayWagerComplete=function(xml){
		_self.paramHash["errorMsg"] = showConnectMsg(xml);
		if(alertConnectMsg(_self.paramHash["errorMsg"]))	return;
		
		xmlnode=parseXml(xml);
		
		var xmdObj = new Object();
		
		xmdObj["code"] = xmlnode.Node(xmlnode.Root[0],"code");
		
		if(xmdObj["code"].innerHTML == "todaywagers"){
			
				div_show = document.getElementById("div_show");
				
				if(div_show==null) return;
				div_show.innerHTML = "";
				
				danAry = new Array();
				_amout_gold = 0;
				//_nowPage = 1;
				
				_self.doParseTodayWagers();
		}
	}
	
	_self.doParseTodayWagers=function(){
		var xmdObj = new Object();
		
		xmdObj["code"] = xmlnode.Node(xmlnode.Root[0],"code");
		
		if(xmdObj["code"].innerHTML == "todaywagers"){
			xmdObj["amout_gold"] = xmlnode.Node(xmlnode.Root[0],"amout_gold").innerHTML;
			xmdObj["wagers"] = xmlnode.Node(xmlnode.Root[0],"wagers",false);
			
			var tmp_screen = "";
			//var from = (_nowPage-1) * _pageCount;
			var from = 0;
			var limit = _nowPage * _pageCount;
			var totalLength = xmdObj["wagers"].length;
			
			if(totalLength >= 1){//
				_self.showNoTodayWagers(false);
				
				if(limit > totalLength)	limit = totalLength;
				_amout_gold=xmdObj["amout_gold"];
				for(var i=from; i<limit; i++){
					xmdObj["wagers_sub"] = xmlnode.Node(xmdObj["wagers"][i],"wagers_sub",false);
					
					w_id = xmlnode.Node(xmdObj["wagers"][i],"w_id").innerHTML;
					addtime = xmlnode.Node(xmdObj["wagers"][i],"addtime").innerHTML;
					oddf_type = xmlnode.Node(xmdObj["wagers"][i],"oddf_type").innerHTML;
					gtype = xmlnode.Node(xmdObj["wagers"][i],"gtype").innerHTML;
					w_ms = xmlnode.Node(xmdObj["wagers"][i],"w_ms").innerHTML;
					wtype = xmlnode.Node(xmdObj["wagers"][i],"wtype").innerHTML;
					gold = xmlnode.Node(xmdObj["wagers"][i],"gold").innerHTML;
					win_gold = xmlnode.Node(xmdObj["wagers"][i],"win_gold").innerHTML;
					win_gold = showTxt(win_gold);
					gold = showTxt(gold);
					//cancel_line = xmlnode.Node(xmdObj["wagers"][i],"cancel_line").innerHTML;
					
					//_amout_gold += gold * 1;
					
					var div_model = "";
										if(xmdObj["wagers_sub"].length >= 1){//P
						var p_title_model = document.getElementById("p_title_model").innerHTML;
						p_title_model = p_title_model.replace("<XMP>","").replace("</XMP>","").replace("<xmp>","").replace("</xmp>","");
						p_title_model = p_title_model.replace(/\*NUM\*/g,xmdObj["wagers_sub"].length);
						div_model += p_title_model;
						
						var p_tmp_screen = "";
						for(var j=0; j<xmdObj["wagers_sub"].length; j++){
							league = xmlnode.Node(xmdObj["wagers_sub"][j],"league").innerHTML;
							team_h_show = xmlnode.Node(xmdObj["wagers_sub"][j],"team_h_show").innerHTML;
							team_c_show = xmlnode.Node(xmdObj["wagers_sub"][j],"team_c_show").innerHTML;
							team_ratio = xmlnode.Node(xmdObj["wagers_sub"][j],"team_ratio").innerHTML;
							ratio = xmlnode.Node(xmdObj["wagers_sub"][j],"ratio").innerHTML;
							org_score = xmlnode.Node(xmdObj["wagers_sub"][j],"org_score").innerHTML;
							score = xmlnode.Node(xmdObj["wagers_sub"][j],"score").innerHTML;
							result = xmlnode.Node(xmdObj["wagers_sub"][j],"result").innerHTML;
							pname = xmlnode.Node(xmdObj["wagers_sub"][j],"pname").innerHTML;
							ioratio = xmlnode.Node(xmdObj["wagers_sub"][j],"ioratio").innerHTML;
							ball_act_class = xmlnode.Node(xmdObj["wagers_sub"][j],"ball_act_class").innerHTML;
							ball_act_ret = xmlnode.Node(xmdObj["wagers_sub"][j],"ball_act_ret").innerHTML;
							date = xmlnode.Node(xmdObj["wagers_sub"][j],"date").innerHTML;							
							wtype_sub = xmlnode.Node(xmdObj["wagers_sub"][j],"wtype_sub").innerHTML;
							ms_sub = xmlnode.Node(xmdObj["wagers_sub"][j],"ms_sub").innerHTML;
							if(date != "")
							{
								var data_str = date.split("-");
								data_st = data_str[1].trim()+"-"+data_str[0].trim();
								tmp_league = (data_st == "")?league:(data_st+" "+league);
							}
							else 	tmp_league = league;
								
							var p_details_model = document.getElementById("p_details_model").innerHTML;
							p_details_model = p_details_model.replace("<XMP>","").replace("</XMP>","").replace("<xmp>","").replace("</xmp>","");
							p_details_model = p_details_model.replace(/\*GTYPE\*/g,gtype);
							p_details_model = p_details_model.replace(/\*W_MS\*/g,ms_sub);
							p_details_model = p_details_model.replace(/\*WTYPE\*/g,wtype_sub);
							p_details_model = p_details_model.replace(/\*LEAGUE\*/g,tmp_league);
							//p_details_model = p_details_model.replace(/\*LEAGUE\*/g,league);
							p_details_model = p_details_model.replace(/\*TEAM_H_SHOW\*/g,team_h_show);
							p_details_model = p_details_model.replace(/\*TEAM_C_SHOW\*/g,team_c_show);
							if(team_h_show == "" && team_c_show == ""){
								p_details_model = p_details_model.replace(/\*TEAM_ACT\*/g,"display:none;");
							}else{
								p_details_model = p_details_model.replace(/\*TEAM_ACT\*/g,"display:;");
							}
							p_details_model = p_details_model.replace(/\*TEAM_RATIO\*/g,team_ratio);
							
							
							
							
							p_details_model = p_details_model.replace(/\*ORG_SCORE\*/g,(""));
							p_details_model = p_details_model.replace(/\*SCORE\*/g,score);
							
		
							
							if (ball_act_class=="cancel"){
									p_details_model = p_details_model.replace(/\*ANNOUCEMENT\*/g,"annoucement_4");
									//p_details_model = p_details_model.replace(/\*RESULT\*/g,ball_act_ret);
							}
							p_details_model = p_details_model.replace(/\*RESULT\*/g,result);
							p_details_model = p_details_model.replace(/\*PNAME\*/g,pname);
							p_details_model = p_details_model.replace(/\*IORATIO\*/g,ioratio);
							p_tmp_screen += p_details_model;
						}						
						div_model += p_tmp_screen;
						
						var p_bottom_model = document.getElementById("p_bottom_model").innerHTML;
						p_bottom_model = p_bottom_model.replace("<XMP>","").replace("</XMP>","").replace("<xmp>","").replace("</xmp>","");
						p_bottom_model = p_bottom_model.replace(/\*TID\*/g,w_id);
						p_bottom_model = p_bottom_model.replace(/\*W_ID\*/g,w_id);
						p_bottom_model = p_bottom_model.replace(/\*ADDTIME\*/g,addtime);
						p_bottom_model = p_bottom_model.replace(/\*ODDF_TYPE\*/g,oddf_type);
					
						if(ball_act_ret == ""){
							div_model = div_model.replace(/\*ANNOUCEMENT\*/g,"annoucement_1");
							p_bottom_model = p_bottom_model.replace(/\*BALL_ACT\*/g,"display:none;");
							p_bottom_model = p_bottom_model.replace(/\*BALL_ACT_CLASS\*/g,"");
							p_bottom_model = p_bottom_model.replace(/\*BALL_ACT_RET\*/g,"");
						}else{
							danAry.push(w_id);
							div_model = div_model.replace(/\*ANNOUCEMENT\*/g,"annoucement_3");
							p_bottom_model = p_bottom_model.replace(/\*BALL_ACT\*/g,"display:;");
							p_bottom_model = p_bottom_model.replace(/\*BALL_ACT_CLASS\*/g,ball_act_class);
							p_bottom_model = p_bottom_model.replace(/\*BALL_ACT_RET\*/g,ball_act_ret);
						}
						//p_bottom_model = p_bottom_model.replace(/\*GOLD\*/g,formatThousand(util_formatNumber(gold)));
						//p_bottom_model = p_bottom_model.replace(/\*WIN_GOLD\*/g,formatThousand(util_formatNumber(win_gold)));
						if (!isNaN(win_gold*1)){
     				  p_bottom_model = p_bottom_model.replace(/\*WIN_GOLD\*/g,(win_gold == "-")?"0":showTxt(util_formatNumber(win_gold)));
     				 }else{
      			  p_bottom_model = p_bottom_model.replace(/\*WIN_GOLD\*/g,(win_gold == "-")?"0":showTxt(win_gold));
     			  }
     			  if (!isNaN(gold*1)){
     				  p_bottom_model = p_bottom_model.replace(/\*GOLD\*/g,(gold == "-")?"0":showTxt(util_formatNumber(gold)));
     				 }else{
      			  p_bottom_model = p_bottom_model.replace(/\*GOLD\*/g,(gold == "-")?"0":showTxt(gold));
     			  }
						div_model += p_bottom_model;
					}else{
						league = xmlnode.Node(xmdObj["wagers"][i],"league").innerHTML;
						team_h_show = xmlnode.Node(xmdObj["wagers"][i],"team_h_show").innerHTML;
						team_c_show = xmlnode.Node(xmdObj["wagers"][i],"team_c_show").innerHTML;
						team_ratio = xmlnode.Node(xmdObj["wagers"][i],"team_ratio").innerHTML;
						ratio = xmlnode.Node(xmdObj["wagers"][i],"ratio").innerHTML;
						org_score = xmlnode.Node(xmdObj["wagers"][i],"org_score").innerHTML;
						score = xmlnode.Node(xmdObj["wagers"][i],"score").innerHTML;
						result = xmlnode.Node(xmdObj["wagers"][i],"result").innerHTML;
						pname = xmlnode.Node(xmdObj["wagers"][i],"pname").innerHTML;
						ioratio = xmlnode.Node(xmdObj["wagers"][i],"ioratio").innerHTML;
						ball_act_class = xmlnode.Node(xmdObj["wagers"][i],"ball_act_class").innerHTML;
						ball_act_ret = xmlnode.Node(xmdObj["wagers"][i],"ball_act_ret").innerHTML;
						
						div_model = document.getElementById("normal_model").innerHTML;
						div_model = div_model.replace("<XMP>","").replace("</XMP>","").replace("<xmp>","").replace("</xmp>","");
						div_model = div_model.replace(/\*TID\*/g,w_id);
						div_model = div_model.replace(/\*W_ID\*/g,w_id);
						div_model = div_model.replace(/\*ADDTIME\*/g,addtime);
						div_model = div_model.replace(/\*ODDF_TYPE\*/g,oddf_type);
						div_model = div_model.replace(/\*GTYPE\*/g,gtype);
						div_model = div_model.replace(/\*W_MS\*/g,w_ms);
						div_model = div_model.replace(/\*WTYPE\*/g,wtype);
						div_model = div_model.replace(/\*LEAGUE\*/g,league);
						div_model = div_model.replace(/\*TEAM_H_SHOW\*/g,team_h_show);
						div_model = div_model.replace(/\*TEAM_C_SHOW\*/g,team_c_show);
						if(team_h_show == "" && team_c_show == ""){
							div_model = div_model.replace(/\*TEAM_ACT\*/g,"display:none;");
						}else{
							div_model = div_model.replace(/\*TEAM_ACT\*/g,"display:;");
						}
						div_model = div_model.replace(/\*TEAM_RATIO\*/g,team_ratio);
						
						
						
						
						div_model = div_model.replace(/\*ORG_SCORE\*/g,(""));
						div_model = div_model.replace(/\*SCORE\*/g,score);
					
					
					
						div_model = div_model.replace(/\*PNAME\*/g,pname);
						//alert(ioratio);
						div_model = div_model.replace(/\*IORATIO\*/g,ioratio<0?"<font class='ior_blue'>"+ioratio+"</font>":ioratio);
						//alert("["+ball_act_ret+"]["+ball_act_class+"]");
						if(ball_act_ret == "" ){
							div_model = div_model.replace(/\*ANNOUCEMENT\*/g,"annoucement_1");
							div_model = div_model.replace(/\*BALL_ACT\*/g,"display:none;");
							div_model = div_model.replace(/\*BALL_ACT_CLASS\*/g,"");
							div_model = div_model.replace(/\*BALL_ACT_RET\*/g,"");
						}else{ 
							danAry.push(w_id);
							if (ball_act_class!="dan_red"){
								div_model = div_model.replace(/\*ANNOUCEMENT\*/g,"annoucement_1");
							
							}else{
								div_model = div_model.replace(/\*ANNOUCEMENT\*/g,"annoucement_3");
								}
								div_model = div_model.replace(/\*BALL_ACT\*/g,"display:;");
								div_model = div_model.replace(/\*BALL_ACT_CLASS\*/g,ball_act_class);
								div_model = div_model.replace(/\*BALL_ACT_RET\*/g,ball_act_ret);
							
						}
						div_model = div_model.replace(/\*RESULT\*/g,result);
						//div_model = div_model.replace(/\*GOLD\*/g,formatThousand(util_formatNumber(gold)));
						//div_model = div_model.replace(/\*WIN_GOLD\*/g,formatThousand(util_formatNumber(win_gold)));
						if (!isNaN(win_gold*1)){
     				  div_model = div_model.replace(/\*WIN_GOLD\*/g,(win_gold == "-")?"0":showTxt(util_formatNumber(win_gold)));
     				 }else{
      			  div_model = div_model.replace(/\*WIN_GOLD\*/g,(win_gold == "-")?"0":showTxt(win_gold));
     			  }
     			  if (!isNaN(gold*1)){
     				  div_model = div_model.replace(/\*GOLD\*/g,(gold == "-")?"0":showTxt(util_formatNumber(gold)));
     				 }else{
      			  div_model = div_model.replace(/\*GOLD\*/g,(gold == "-")?"0":showTxt(gold));
     			  }
					}
					
					tmp_screen += div_model;
				}
				amout_goldObj.innerHTML = _amout_gold;
				
				div_show.innerHTML = tmp_screen;
				
				if(div_show.scrollHeight >= _scrollHeightLimit){
					bottom_topObj.style.display = "";
				}else{
					bottom_topObj.style.display = "none";
				}
				
				var totalPage = Math.ceil(totalLength / _pageCount);
				if(_nowPage >= totalPage)	allsportsObj.style.display = "none";
				
				for(var k=0; k< danAry.length; k++){
					var divObj = document.getElementById("div_"+danAry[k]);
					_self.addEventListener("MouseEvent.CLICK",_self.reloadHandler,divObj);
				}
			}else{//
				_self.showNoTodayWagers(true);
			}
		}
		
		dataClass["bottom"].checkShowTop();
		setLoadingVisible(false);
	}
	
	_self.showViewMore=function(){
		_nowPage++;
		_self.doParseTodayWagers();
	}
	
	_self.showNoTodayWagers=function(isOk){
		if(isOk){
			noTodayWagersObj.style.display = "";
			allsportsObj.style.display = "none";
			total_accountsObj.style.display = "none";
			bottom_topObj.style.display = "none";
		}else{
			noTodayWagersObj.style.display = "none";
			allsportsObj.style.display = "";
			total_accountsObj.style.display = "";
			bottom_topObj.style.display = "";
		}
	}
	
	_self.createTimer=function(){
		_.timerObj = new Object();
		_.timerObj["timer"] = new Timer(CONFIG_TODAY_WAGERS);
		_.timerObj["timer"].setParentclass(_self);
		_.timerObj["timer"].init();
		_.timerObj["timer"].addEventListener("TimerEvent.TIMER",_self.timerRun);
		_.timerObj["timer"].addEventListener("TimerEvent.TIMER_COMPLETE",_self.timerFinish);
		_.timerObj["timer"].startTimer();
	}
	
	_self.clearTimer=function(){
		if(_.timerObj != null){
			if(_.timerObj["timer"] != null){
				_.timerObj["timer"].clearObj();
				_.timerObj["timer"] = null;
			}
		}
		return true;
	}
	
	_self.timerRun=function(count){
		_self.loadTodayWager();
	}
	
	_self.timerFinish=function(count){
		
	}
	
	_self.reloadHandler=function(mouseEvent){
		//_self.loadTodayWager();
		_self.clearTimer();
		_self.createTimer();
	}
	
	//goToPageHandler
	_self.goToPageHandler=function(mouseEvent,targetObj){
		//alert(targetObj.url);
		var ret = _self.clearTimer();
		if(ret){
				var url = "tpl/"+_top["userData"].langx+"/"+targetObj.url+".html";
				loadHtml_loading(url,true);
		}
	}
}
//extends
dataClass["todaywagers"] = extendsClass(_top["MovieClipClass"],todaywagers);
dataClass["todaywagers"].init();