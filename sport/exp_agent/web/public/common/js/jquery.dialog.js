jQuery.dialog = {
    destroy:function(id){
        $(id).remove();
    },
    notify:function(message,callback){
        var me = this;
        var dialog = "<div id='dialog-notify' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>"+
						"<div class='modal-dialog modal-sm'>"+
							"<div class='modal-content'>"+
								"<div class='modal-header'>"+
									"<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"+
									"<h5 class='modal-title' id='mySmallModalLabel'>提示</h5>"+
								"</div>"+
								"<div id='dialog-notify-body' class='modal-body'>"+message+"</div>"+
							"</div>"+
						"</div>"+
					"</div>";
        if($('#dialog-notify').length==0){
        	$("body").append(dialog);
        }else{
        	$("#dialog-notify-body").text(message);
        }
        $('#dialog-notify').modal({
		  	keyboard: false,
		  	backdrop: false
		});
        setTimeout(function(){
        	$('#dialog-notify').modal('hide');
        	if(callback){
        		callback();
        	}
        	//me.destroy('#dialog-notify');
        },1500);
    },
    alert:function(){
    	var title,message,callback;
    	if(arguments.length==1){
    		title = '提示';
    		message = arguments[0];
    		callback = null;
    	}
    	if(arguments.length==2 && typeof(arguments[0]) == 'string' && typeof(arguments[1]) == 'string'){
    		title = arguments[0];
    		message = arguments[1];
    		callback = null;
    	}
    	if(arguments.length==2 && typeof(arguments[0]) == 'string' && typeof(arguments[1]) == 'function'){
    		title = '提示';
    		message = arguments[0];
    		callback = arguments[1];
    	}
    	if(arguments.length==3){
    		title = arguments[0];
    		message = arguments[1];
    		callback = arguments[2];
    	}
        var me = this;
        var dialog = "<div id='dialog-alert' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>"+
						"<div class='modal-dialog modal-sm'>"+
							"<div class='modal-content'>"+
								"<div class='modal-header'>"+
									"<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"+
									"<h5 id='dialog-alert-title' class='modal-title' id='mySmallModalLabel'>"+title+"</h5>"+
								"</div>"+
								"<div id='dialog-alert-body' class='modal-body'>"+message+"</div>"+
								"<div class='modal-footer'>"+
						        	"<button type='button' class='btn btn-primary btn-block'>确 定</button>"+
						        "</div>"+
							"</div>"+
						"</div>"+
					"</div>";
        if($('#dialog-alert').length==0){
        	$("body").append(dialog);
        }else{
        	$("#dialog-alert-title").text(title);
        	$("#dialog-alert-body").text(message);
        }
        $('#dialog-alert').modal({
		  	keyboard: false,
		  	backdrop: true
		});
        $("#dialog-alert button").off();
        $("#dialog-alert button").one('click', function(){
        	$('#dialog-alert').modal('hide');
            if(callback){
            	callback();
            }
        });
    },
    confirm:function(){
    	var title,message,callback,btnok,btnno;
    	btnok = '确 定';
    	btnno = '取 消';
    	if(arguments.length==1){
    		title = '提示';
    		message = arguments[0];
    		callback = null;
    	}
    	if(arguments.length==2 && typeof(arguments[0]) == 'string' && typeof(arguments[1]) == 'string'){
    		title = arguments[0];
    		message = arguments[1];
    		callback = null;
    	}
    	if(arguments.length==2 && typeof(arguments[0]) == 'string' && typeof(arguments[1]) == 'function'){
    		title = '提示';
    		message = arguments[0];
    		callback = arguments[1];
    	}
    	if(arguments.length==3){
    		title = arguments[0];
    		message = arguments[1];
    		callback = arguments[2];
    	}
    	if(arguments.length==5){
    		title = arguments[0];
    		message = arguments[1];
    		callback = arguments[2];
    		btnok = arguments[3];
    		btnno = arguments[4];
    	}
        var me = this;
        var dialog = "<div id='dialog-confirm' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>"+
						"<div class='modal-dialog modal-sm'>"+
							"<div class='modal-content'>"+
								"<div class='modal-header'>"+
									"<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"+
									"<h5 id='dialog-confirm-title' class='modal-title' id='mySmallModalLabel'>"+title+"</h5>"+
								"</div>"+
								"<div id='dialog-confirm-body' class='modal-body'>"+message+"</div>"+
								"<div class='modal-footer'>"+
						        	"<button id='dialog-confirm-btn-success' type='button' class='btn btn-danger'>"+btnok+"</button>"+
						        	"<button id='dialog-confirm-btn-cancel' type='button' class='btn btn-default'>"+btnno+"</button>"+
						        "</div>"+
							"</div>"+
						"</div>"+
					"</div>";

        if($('#dialog-confirm').length==0){
        	$("body").append(dialog);
        }else{
        	$("#dialog-confirm-title").text(title);
        	$("#dialog-confirm-body").text(message);
        	$("#dialog-confirm-btn-success").text(btnok);
        	$("#dialog-confirm-btn-cancel").text(btnno);
        }
        $('#dialog-confirm').modal({
		  	keyboard: false,
		  	backdrop: true
		});
        $("#dialog-confirm-btn-success").off();
        $("#dialog-confirm-btn-success").one('click', function(){
        	$('#dialog-confirm').modal('hide');
            if(callback){
            	callback(true);
            }
        });
        $("#dialog-confirm-btn-cancel").off();
        $("#dialog-confirm-btn-cancel").one('click', function(){
        	$('#dialog-confirm').modal('hide');
            if(callback){
            	callback(false);
            }
        });
    },
    show:function(_opt){
    	_opt = _opt || {};
    	_opt = $.extend({
    		modalCls:'modal-md',
		  	backdrop: false,
			keyboard: false
    	},_opt);
    	if(_opt.url.indexOf('?') != -1) {
    		_opt.url = _opt.url + "&isajax=1";
    	} else {
    		_opt.url = _opt.url + "?isajax=1";
    	}
        var me = this;
        var dialog = "<div id='dialog-show' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>"+
						"<div class='modal-dialog "+_opt.modalCls+"'>"+
							"<div class='modal-content'>"+
							"</div>"+
						"</div>"+
					"</div>";
        if($('#dialog-show').length==0){
        	$("body").append(dialog);
        }
        $('#dialog-show>.modal-dialog').removeClass('modal-sm,modal-md,modal-lg').addClass(_opt.modalCls);
        $('#dialog-show').modal({
		  	keyboard: _opt.keyboard,
		  	backdrop: _opt.backdrop
		}).find('.modal-content').load(_opt.url);
        $("#dialog-show").undelegate(".modal-footer>.btn-ok","click");
        $("#dialog-show").delegate(".modal-footer>.btn-ok","click",function(e){
        	var tmp;
        	var o = $(e.target);
        	var form = $("#dialog-show form");
			if(_opt.beforeClosed){
				if(!_opt.beforeClosed()) return;
			}
        	if(form.attr('action')){
        		if(form.valid()){
					$.ajax({
						dataType : 'json',
						type : 'POST',
						url : form.attr('action'),
						data : form.serialize(),
						beforeSend : function(xhr) {
							tmp = o.text();
							if(tmp) {
								o.text('提交中');
								o.prepend("<i class='fa fa-spinner fa-spin'></i> ");
								o.addClass('disabled');
							}
						},
						success : function(data) {
							if(data.status){
								me.notify(data.msg==null?'更新成功':data.msg);
	        					$('#dialog-show').modal('hide');
	        	                if(_opt.callback){
	        	                	_opt.callback(data);
	        	                }
	        				}else{
	        					me.notify(data.msg);
	        				}
						},
						error : function(xhr, msg) {
							if (msg == "error") {
								me.notify("请求异常！");
							} else if (msg == "timeout") {
								me.notify("请求超时！");
							}
						},
						complete : function() {
							if(tmp) {
			    				o.empty();
			    				o.text(tmp);
			    				o.removeClass('disabled');
							}
						}
					});
            	}
        	}else{
        		$('#dialog-show').modal('hide');
				if(_opt.callback){
					_opt.callback(true);
				}
        	}
        });
        $("#dialog-show").undelegate(".modal-footer>.btn-default","click");
        $("#dialog-show").delegate(".modal-footer>.btn-default","click",function(){
        	$('#dialog-show').modal('hide');
        	if(_opt.callback){
            	_opt.callback(false);
            }
        });
        $('#dialog-show').one('loaded.bs.modal', function (e) {
        	$("#dialog-show .need_validate").validate();
        	$("#dialog-show .date_day_time").datetimepicker({
        		language:"zh-CN",
        		minView:0,
        		maxView:4,
        		startView:2,
        		autoclose:true,
        		//startDate:new Date(),
        		todayBtn:true,
        		format:"yyyy-mm-dd hh:ii:ss"
        	}).attr("readonly","readonly");
        	$("#dialog-show .date_day").datetimepicker({
        		language:"zh-CN",
        		minView:2,
        		maxView:4,
        		startView:2,
        		autoclose:true,
        		todayBtn:true,
        		format:"yyyy-mm-dd"
        	}).attr("readonly","readonly");
        	$("#dialog-show .date_month").datetimepicker({
        		language:"zh-CN",
        		minView:3,
        		maxView:3,
        		startView:3,
        		autoclose:true,
        		todayBtn:true,
        		format:"mm/yyyy"
        	}).attr("readonly","readonly");
        	$("#dialog-show .date_year").datetimepicker({
        		language:"zh-CN",
        		minView:4,
        		maxView:4,
        		startView:4,
        		autoclose:true,
        		todayBtn:true,
        		format:"yyyy"
        	}).attr("readonly","readonly");
        });
    },
    popup:function(data){
    	var isArray = $.isArray(data);
    	var isObj = $.isPlainObject(data);
    	if(isArray) {
    		if($('#popup-gallery').length == 0) {
    			var popuptag = "<div id='popup-gallery'></div>";
    			$("body").append(popuptag);
    		}
    		$('#popup-gallery').empty();
    		for(var i=0;i<data.length;i++){
    			$('#popup-gallery').append("<a title='"+(data[i].title?data[i].title:'')+"' href='"+data[i].image+"'></a>");
    		}
    		$('#popup-gallery').magnificPopup({
    	        delegate: 'a',
    	        type: 'image',
    	        tLoading: '加载图片中...',
    	        mainClass: 'mfp-img-mobile',
    	        gallery: {
    	            enabled: true,
    	            navigateByImgClick: true,
    	            preload: [0,1]
    	        },
    	        image: {
    	            tError: '图片加载失败...',
    	            titleSrc: function(item) {
    	                return item.el.attr('title') == null ? '' : item.el.attr('title');
    	            }
    	        }
    	    });
    		$('#popup-gallery > a:first').click();
    	}
    	if(isObj) {
    		if($('#popup-image').length == 0) {
    			var popuptag = "<a id='popup-image' title='"+(data.title?data.title:'')+"' href='"+data.image+"'></a>";
    			$("body").append(popuptag);
    		}else{
    			$('#popup-image').attr('title',data.title);
    			$('#popup-image').attr('href',data.image);
    		}
    		$('#popup-image').magnificPopup({
    	        type: 'image',
    	        tLoading: '加载图片中...',
    	        closeOnContentClick: false,
    	        closeBtnInside: true,
    	        alignTop: false,
    	        image: {
    	            tError: '图片加载失败...',
    	            verticalFit: false,
    	            titleSrc: function(item) {
    	                return item.el.attr('title') == null ? '' : item.el.attr('title');
    	            }
    	        }
    	    });
    		$('#popup-image').click();
    	}
    },
    progress:function(message){
    	if(!message){
    		message = "正在努力执行...";
    	}
        var me = this;
        var dialog = "<div id='dialog-progress' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>"+
						"<div class='modal-dialog modal-sm'>"+
							"<div class='modal-content'>"+
								"<div id='dialog-progress-body' class='modal-body'>"+
									"<small id='dialog-progress-message' class='text-success'>" + message + "</small>" +
									"<div class='progress' style='margin:0;'>"+
										"<div id='dialog-progress-bar' class='progress-bar progress-bar-success' role='progressbar'></div>"+
								    "</div>"+
								"</div>"+
							"</div>"+
						"</div>"+
					"</div>";
        if($('#dialog-progress').length==0){
        	$("body").append(dialog);
        }else{
        	$("#dialog-progress-message").text(message);
        }
        var t = 0;
        var schedule = setInterval(function(){
        	t+=1;
        	$('#dialog-progress-bar').text(t + '%');
        	$('#dialog-progress-bar').css('width', t + '%');
        	if(t==100){
        		t=0;
        	}
        }, 500);
        $('#dialog-progress').modal({
		  	keyboard: false,
		  	backdrop: false
		});
        $('#dialog-progress').bind('close',function(){
        	clearInterval(schedule);
        	$('#dialog-progress').modal('hide');
        });
        return $('#dialog-progress');
    }
};