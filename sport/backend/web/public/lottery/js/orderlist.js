function check() {
    if ($("#tf_id").val().length > 5) {
        $("#status").val("0,1");
    }
    return true;
}

function ckall() {
    for (var i = 0; i < document.form2.elements.length; i++) {
        var e = document.form2.elements[i];
        if (e.name != 'checkall')
            e.checked = document.form2.checkall.checked;
    }
}

function cancelOrder_lottery(id,order_sub_num) {
    var sResult = prompt("请在下面输入作废的理由", "");
    if (sResult != null) {
		$.ajax({
                'url':'?r=lotteryorder/index/zuofei',
                async:true,
                type:'GET',
                data:{id:id,cancel_reason:sResult,order_sub_num:order_sub_num},
                success: function(data){
					if(data=='0'){
						$.dialog.notify('作废成功');
                        window.location.reload();
					}else if(data=='-1'){
                        $.dialog.notify('结算接口连接异常！');
                    }else{
						$.dialog.notify('作废失败');
					}
                }
            });
    }
}

function cancelOrder_all() {
    var len = document.form2.elements.length;
    var num = false,str="",order_sub_num="";
    for(var i=0;i<len;i++){
        var e = document.form2.elements[i];
        if(e.checked && e.name=='uid[]'){
            order_sub_num +=$(e).parent().parent().find('.order_sub_num').text()+',';
            str+=e.value+",";
            num = true;
        }
    }
    if (num) {
        var sResult = prompt("请在下面输入作废的理由", "");
        if (sResult != null) {
            $.post("?r=lotteryorder/index/plzuofei",{"aid":str,cancel_reason:sResult,order_sub_num:order_sub_num},function(data){
                $.dialog.notify('操作完成');
                window.location.reload();
            });
        }
    } else {
        alert("您未选中任何复选框");
        return false;
    }
}