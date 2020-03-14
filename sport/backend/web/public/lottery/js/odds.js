$(function () {
    /*//只能输入数字和小数点
    $(document).on("keydown","input[name='aOdds[]'],input[type='text']",function () {
        var e = $(this).event || window.event;
        var key = parseInt(e.keyCode);
            if((key > 95 && key < 106) || (key > 47 && key < 60) || key == 8 || key == 46 || key == 110 || key == 190 ){
            return true;
        } else {
            return false;
        }
    });*/
})
function checkNumber() {
    $("input[name='aOdds[]'],input[type='text']").attr("type","number").attr("min","0");
}