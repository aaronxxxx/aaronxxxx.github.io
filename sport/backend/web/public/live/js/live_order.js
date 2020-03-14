function updateOrder() {
    if(!confirm("确定要更新注单吗？")) {
            return false;
    }
    $.post("/index.php?r=live/order/update-orders", function(data){
        $.dialog.notify('正在更新中...');
    });
}
