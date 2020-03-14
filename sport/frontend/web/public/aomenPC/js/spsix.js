// 籌碼
$("#chipChangeBtn p").toggle(function () {
    $("#chipChangeBox").show();
}, function () {
    $("#chipChangeBox").hide();
});
// 籌碼設置
$("#chipChangeBox").find("select").change(function () {
    var num = $(this).data('num');
    if (num == "chip1") {
        var x = $(this).val();
        var y = $(this).find(" :selected").text();
        $("#chip1").find('input').val(x);
        $("#chip1").find('span').text(y);
        // console.log($("#chip1").find('input').val());
    } else if (num == "chip2") {
        var x = $(this).val();
        var y = $(this).find(" :selected").text();
        $("#chip2").find('input').val(x);
        $("#chip2").find('span').text(y);
    } else if (num == "chip3") {
        var x = $(this).val();
        var y = $(this).find(" :selected").text();
        $("#chip3").find('input').val(x);
        $("#chip3").find('span').text(y);
    } else if (num == "chip4") {
        var x = $(this).val();
        var y = $(this).find(" :selected").text();
        $("#chip4").find('input').val(x);
        $("#chip4").find('span').text(y);
    } else if (num == "chip5") {
        var x = $(this).val();
        var y = $(this).find(" :selected").text();
        console.log(y);
        $("#chip5").find('input').val(x);
        $("#chip5").find('span').text(y);
    } else {
        alert("!!")
    }
});

// 籌碼相加
$(".chipItem").click(function () {
    $('.chipItem').removeClass('active');
    $(this).addClass('active');
    var o = $('#chipVal').val();
    if (isNaN(parseInt(o))) {
        o = 0;
    }
    var x = $(this).find('input').val();
    var sum = parseInt(o) + parseInt(x);
    // console.log(x);
    $("#chipVal").val(sum);
});