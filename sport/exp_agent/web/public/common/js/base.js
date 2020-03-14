window.App = function () {
	function _bindEvent() {
		$(".date_day_time").bind('click', function (e) {
			WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})
		});
		/*$(".date_day_time").datetimepicker({
			language:"zh-CN",
			minView:0,
			maxView:4,
			startView:2,
			autoclose:true,
			//startDate:new Date(),
			todayBtn:true,
			format:"yyyy-mm-dd hh:ii:ss"
		}).attr("readonly","readonly");*/

		$(".date_day_minute").datetimepicker({
			language:"zh-CN",
			minView:0,
			maxView:4,
			startView:2,
			autoclose:true,
			//startDate:new Date(),
			todayBtn:true,
			format:"yyyy-mm-dd hh:ii"
		}).attr("readonly","readonly");

		$(".date_day").bind('click', function (e) {
			WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd'})
		});
		/*$(".date_day").datetimepicker({
			language:"zh-CN",
			minView:2,
			maxView:4,
			startView:2,
			autoclose:true,
			todayBtn:true,
			format:"yyyy-mm-dd"
		}).attr("readonly","readonly");*/

		$(".date_month").datetimepicker({
			language:"zh-CN",
			minView:3,
			maxView:3,
			startView:3,
			autoclose:true,
			todayBtn:true,
			format:"mm/yyyy"
		}).attr("readonly","readonly");

		$(".date_year").datetimepicker({
			language:"zh-CN",
			minView:4,
			maxView:4,
			startView:4,
			autoclose:true,
			todayBtn:true,
			format:"yyyy"
		}).attr("readonly","readonly");

		$("form.need_validate").validate();

		$(".form_reset_btn").bind("click",function(e){
			var o = $(e.target);
			if(o.data("target")){
				var tform=$(o.data("target"));
				tform.find("textarea").val("");
				tform.find("input[type='text'],input[type='hidden'],input[type='password']").val("");
				tform.find("select").val("");
				tform.find(":checkbox:checked").removeAttr("checked");
			}
		});

		$(".form_submit_btn").bind("click",function(e){
			var target = $(e.target);
			if(target.data("targetid")){
				$("#" + target.data("targetid")).submit();
			}
		});

		$(".form_ajax_submit_btn").bind("click",function(e){
			var o = $(e.target);
			var tmp = o.text();
			if(o.data("targetid")){
				var form = $("#" + o.data("targetid"));
				if(form.valid()){
					o.text('提交中');
					o.prepend("<i class='fa fa-spinner fa-spin'></i> ");
					o.addClass('disabled');
					var url = null;
					if(form.attr('action')){
						url = form.attr('action');
					}
					if(o.data("url")){
						url = o.data("url");
					}
					$.post(url, form.serialize(), function(data){
						data = $.parseJSON(data);
						if(data.status){
							$.dialog.notify(data.msg == null ? '保存成功' : data.msg);
							if(o.data("redirect")){
								setTimeout(function(){
									location.href = o.data("redirect");
								},1200);
							}
						}else{
							$.dialog.notify(data.msg);
						}
						o.empty();
						o.text(tmp);
						o.removeClass('disabled');
					});
				}else{
					$.dialog.notify('提交的表单信息不完整');
				}
			}else{
				o.text('提交中');
				o.prepend("<i class='fa fa-spinner fa-spin'></i> ");
				o.addClass('disabled');
				$.post(o.data("url"),{},function(data){
					if(data.status){
						$.dialog.notify(data.msg == null ? '更新成功' : data.msg);
						if(o.data("redirect")){
							setTimeout(function(){
								location.href = o.data("redirect");
							},1200);
						}
					}else{
						$.dialog.notify(data.msg);
					}
					o.empty();
					o.text(tmp);
					o.removeClass('disabled');
				});
			}
		});

		$(".ajax_confirm_btn").bind("click",function(e){
			var o = $(e.target);
			o.data('loading-text', '<i class="fa fa-spinner fa-spin"></i> 处理中');
			var tip = o.data("tip");
			if(!tip) tip = "你确定要执行该操作吗?";
			$.dialog.confirm(tip, function(data){
				if(data){
					var url = o.data("url");
					$.ajaxRequest({
						type : "POST",
						url : url,
						dataType : 'json',
						beforeSend : function() {
							o.button('loading');
						},
						success : function(data) {
							if(data.msg)
								$.dialog.notify(data.msg);

							if(data.status){
								if(o.data("redirect")){
									setTimeout(function(){
										location.href = o.data("redirect");
									}, 1500);
								}
							}
						},
						complete : function() {
							o.button('reset');
						}
					});
				}
			});
		});

		$('#gridSearchBtn').bind('click', function (e) {
			location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
		});
	}
	return {
		bindEvent : _bindEvent
	}
}();

$.ajaxSetup({
	cache:false
});

$.extend({
	ajaxRequest : function(_ops) {
		$.ajax({
			dataType : 'json',
			type : _ops.type ? _ops.type : "GET",
			url : _ops.url,
			data : $.extend(true, {}, _ops.data),
			async : _ops.async == null ? true : _ops.async,
			beforeSend : function(xhr) {
				xhr.setRequestHeader("Accept", "application/json");
				// xhr.setRequestHeader("Content-Type", "application/json");
				if (_ops.beforeSend) {
					_ops.beforeSend(xhr);
				}
			},
			error : function(xhr, msg) {
				if (msg == "error") {
					var st = xhr.status;
					switch (st) {
						case 500:
							var ct = xhr.getResponseHeader("content-type") || "";
							if (!(this.dataType == "json" && ct.indexOf("json") >= 0)) {
								break;
							}
							var ex = $.parseJSON(xhr.responseText);
							if (_ops.exception) {
								_ops.exception(ex);
							} else {
								alert("发生错误：" + ex.message);
							}
							break;
						case 404:
							if (_ops.notfound) {
								_ops.notfound();
							} else {
								alert("所请求资源不存在！");
							}
							break;
						case 401:
							if (_ops.unauthorized) {
								_ops.unauthorized();
							} else {
								alert("没有权限！");
							}
							break;
						case 400:
							break;
						default:
						//alert("发生未知错误！");
					}
				} else if (msg == "timeout") {
					if (_ops.timeout) {
						_ops.timeout();
					} else {
						alert("请求超时！");
					}
				}
				if (_ops.error) {
					_ops.error(msg);
				}
			},
			success : function(data) {
				if (_ops.success) {
					_ops.success(data);
				} else {
					if(data && data.msg) {
						$.dialog.notify(data.msg);
					}
				}
			},
			complete : function() {
				if (_ops.complete) {
					_ops.complete();
				}
			}
		});
	}
});

document.oncontextmenu = function(e){
	return false;
};