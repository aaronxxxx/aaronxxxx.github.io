$(function () {
    var m = parseFloat($('#min_savemoney').val());
    $('.d_btn_list2 div').click(function () {
        $(this).addClass('sl2').siblings().removeClass('sl2');
        $('.payfs>div:eq(' + $(this).index() + ')').show().siblings().hide();

        if ($("#online").is(":hidden")) {
            $(".f_ag div").addClass("chkico");
        } else {
            $(".f_ag div").removeClass("chkico");
        }
    })
    $("#hksubmit").click(function () {
        var amount =parseFloat( $("#amount").val());
        if (amount <m ) {
            alert("最低金额为" + m + "元");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/?r=member/remittance/remittancedo",
            data: $('#form2').serialize(),
            dataType: 'json'
        }).done(function (msg) {
            if (msg.status) {
                alert('提交成功！');
                window.location.href = "/?r=mobile/financial/vip&type=hk";
            } else {
                alert(msg.msg);
            }
        }).fail(function (error) {
            alert(error.responseText);
        });
    });
    $("#zfbBtn").click(function () {
        getZfbPayInfo(m);
    });
    $("#wxBtn").click(function () {
        getWxPayInfo(m);
    });
    $("#cftBtn").click(function () {
        getCftPayInfo(m);
    });
    // tab
    $('#tab .chargeitem').click(function () {
        var tabinner = $(this).find('a').attr('href');
        $(this).addClass('act').siblings('.chargeitem').removeClass('act');
        $('#tabinner').find(tabinner).show().siblings('.tabinnerItem').hide();
    });




});

function getZfbPayInfo(m) {
    var amount1 = $("#zfb_PaySele").val();
    var number = $("#zfb_acc_val").val();
    amount1 = amount1 * 1;
    if (amount1 < m) {
        alert("最低金额为" + m + "元");
        return false;
    }
    if (number == '') {
        alert("帐号不能为空！");
        return false;
    }
    if (confirm("金额与账户确认正确并提交订单，确认？")) {
        $.post("/?r=mobile/financial/zfb", {
            zfb_PaySele: amount1,
            zfb_acc_val: number,
        }, function (code) {
            console.log(code);
            if (code == 0) {
                alert('提交成功！');
                window.location.href = "/?r=mobile/financial/vip&type=hk";
            } else {
                alert(code);

            }
        }, "html");
    }
}

function getWxPayInfo(m) {
    var amount1 = $("#wx_PaySele").val();
    var number = $("#wx_acc_val").val();
    amount1 = amount1 * 1;
    if (amount1 < m) {
        alert("最低金额为" + m + "元");
        return false;
    }
    if (number == '') {
        alert("帐号不能为空！");
        return false;
    }
    if (confirm("金额与账户确认正确并提交订单，确认？")) {
        $.post("/?r=mobile/financial/wx", {
            wx_PaySele: amount1,
            wx_acc_val: number,
        }, function (code) {
            console.log(code);
            if (code == 0) {
                alert('提交成功！');
                window.location.href = "/?r=mobile/financial/vip&type=hk";
            } else {
                alert(code);

            }
        }, "html");
    }
}

function getCftPayInfo(m) {
    var amount1 = $("#cft_PaySele").val();
    var number = $("#cft_acc_val").val();
    console.log(amount1);
    console.log(number);
    amount1 = amount1 * 1;
    if (amount1 < m) {
        alert("最低金额为" + m + "元");
        return false;
    }
    if (number == '') {
        alert("帐号不能为空！");
        return false;
    }
    if (confirm("金额与账户确认正确并提交订单，确认？")) {
        $.post("/?r=mobile/financial/cft", {
            cft_PaySele: amount1,
            cft_acc_val: number,
        }, function (code) {
            if (code == 0) {
                alert('提交成功！');
                window.location.href = "/?r=mobile/financial/vip&type=hk";
            } else {
                alert(code);

            }
        }, "html");
    }
}

function refreshWallet() {
    window.location.reload();
}

function next_checkNum_img() {
    document.getElementById("checkNum_img").src = "/?r=member/index/captcha&" + Math.random();
    return false;
}
// 複製
function copyToClipBoard(msg) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(msg).select();
    document.execCommand("copy");
    $temp.remove();
    alert("已複製至您的剪貼簿。");
}
// 下載圖片
function DownloadImage(thisimg) {
    var img = thisimg.src;
    timeout = setTimeout(function () {
        var a = document.createElement('a');
        var event = new MouseEvent('click');
        a.download = name || 'QRcode';
        a.href = img;
        a.dispatchEvent(event);
    }, 1000);
}

function check_submit2() {
    // m = <?= $min_money;?>;
    var m = $('#min_money').val();
    if ($("#qk_pwd").val() == "") {
        alert("请输入您注册时设置的取款密码");
        $("#qk_pwd").focus();
        return false;
    }
    var re = /^[1-9]+[0-9]*]*$/;
    if (!re.test($("#pay_value").val())) {
        alert("提款金额必须为正整数");
        return false;
    }
    var num = $("#pay_value").val();
    if (parseInt(num) < parseInt(m)) {
        alert("最低提款金额为" + m + "元");
        $("#pay_value").select();
        return false;
    }
    var money = $("#hyye").html() * 1;
    if (num > money) {
        alert("对不起，您的余额不足");
        return false;
    }
    var yzm = $("#yzm2").val();
    if (yzm.length < 4) {
        alert("请您输入验证码");
        $("#yzm2").val('').focus();
        return false;
    }
    $.ajax({
        type: "POST",
        url: "/?r=member/withdraw/tikuan",
        data: $('#tikuanform').serialize(),
        dataType: 'json'
    }).done(function (msg) {
        if (msg) {
            alert(msg.msg);
            window.location.href = "/?r=mobile/financial/vip&type=qk";
        } else {
            alert(msg.msg);
            $("#yzm2").val('').focus();
            $("#checkNum_img").click();
        }
    }).fail(function (error) {
        alert(error.responseText);
    });

}

function lx(type) {
    switch (type) {
        case '2':
            window.location.href = "/?r=mobile/money-log/index";
            break;
        case '3':
            window.location.href = "/?r=mobile/live/live";
            break;
        case '4':
            window.location.href = "/?r=mobile/lottery/lottery";
            break;
        case '5':
            window.location.href = "/?r=mobile/financial/vip";
            break;
    }
}
// 金额交易记录
function cx(type) {
    switch (type) {
        case 'ck':
            window.location.href = "/?r=mobile/financial/vip";
            break;
        case 'hk':
            window.location.href = "/?r=mobile/financial/vip&type=hk";
            break;
        case 'qk':
            window.location.href = "/?r=mobile/financial/vip&type=qk";
            break;
        case 'zz':
            window.location.href = "/?r=mobile/financial/vip&type=zz";
            break;
        case 'today':
            window.location.href = "/?r=mobile/lottery/lottery";
            break;
        case 'history':
            window.location.href = "/?r=mobile/lottery/lottery-date";
            break;
    }
}

function changePwd() {
    var old_pwd = $("#oldLoginpwd").val();
    var new_pwd = $("#newLoginpwd").val();
    var new_pwd2 = $("#rnewLoginpwd").val();
    if (old_pwd === '') {
        alert("请您输入当前密码");
        return false;
    } else if (new_pwd === '') {
        alert("为您的账号设置新的密码");
        return false;
    } else if (new_pwd2 === '') {
        alert("输入您的确认密码");
        return false;
    } else if (new_pwd !== new_pwd2) {
        alert("两次密码输入不一致");
        return false;
    }
    $.post($("#mdfPsdForm").attr("action"), {
        oldLoginpwd: old_pwd,
        pwd: new_pwd
    }, function (rst) {
        console.log(rst);
        if (rst.code === 0) {
            alert('修改成功！');
            // window.location.href = "/?r=mobile/user/user-news";
        } else {
            alert(rst.msg);
        }
    }, "json");

}