window.App = function () {
	function _bindEvent() {
		$(".date_day_time").bind('click', function (e) {
			WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})
		});

		$(".date_day").bind('click', function (e) {
			WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd'})
		});

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
					$.dialog.notify('提交的表单信息不完整123');
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

		$('#gridSearchBtn').bind('click', function (e) {
			location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize() + "&t=" + new Date().getTime();;
		});

		$('.select-on-check-all').bind('click', function () {
			var check = $(this).is(":checked");
			if(check) {
				$('input[type="checkbox"][name="selection[]"]').each(function (ckb) {
					$(this).prop('checked', true);
				});
			} else {
				$('input[type="checkbox"][name="selection[]"]').each(function (ckb) {
					$(this).prop('checked', false);
				});
			}
		});
	}
	return {
		bindEvent : _bindEvent
	}
}();

$.ajaxSetup({
	cache:false
});

document.oncontextmenu = function(e){
	return false;
};