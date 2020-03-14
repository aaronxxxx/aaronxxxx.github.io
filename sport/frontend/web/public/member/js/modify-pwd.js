$(function () {
    // 表單 label 字暫留效果
    $('#JS-forgetpwd-form').find('label').InputLabels();
});

/**
 * 登入表單效果
 * @param _o object {
 *     Opacity : 標題透明度
 *     MS      : 標題顯示速度
 *   }
 */
$.fn.InputLabels = function (_o) {
    var o = {
        'Opacity': 0.5,
        'MS': 300,
        'next': false
    };
    $.extend(o, _o);

    return this.each(function () {
        var label = $(this);
        var input = o.next ? $(this).next('input[name=' + $(this).attr('name') + ']') : $('input[name=' + $(this).attr('name') + ']');
        var show = true;

        // 預防瀏覽器記帳密機制
        setTimeout(function () {
            this.opacity = (input.val() === "") ? 1.0 : 0;
            label.css('opacity', this.opacity);
        }, 300);

        label.click(function () {
            input.trigger('focus');
        });

        input.focus(function () {
            if (input.val() === "") {
                setOpacity(o.Opacity);
            }
        }).blur(function () {
            if (input.val() === "") {
                if (!show) {
                    label.css({opacity: 0.0}).show();
                }
                setOpacity(1.0);
            } else {
                setOpacity(0.0);
            }
        }).keydown(function (e) {
            if ((e.keyCode === 16) || (e.keyCode === 9) || (e.keyCode === 13))
                return;
            if (show) {
                label.hide();
                show = false;
            }
        });

        var setOpacity = function (opacity) {
            label.stop().animate({'opacity': opacity}, o.MS);
            show = (opacity > 0.0);
        };
    });
};

var password_old = document.chgFORM.pwd_old,
    password = document.chgFORM.pwd,
    REpassword = document.chgFORM.pwd_confirm;

//ADVANCED
$(".password_adv").passStrength({
    userid: "#userid",
    shortPass_txt: '密码强度：太短',
    badPass_txt: '密码强度：弱',
    goodPass_txt: '密码强度：很好',
    strongPass_txt: '密码强度：强',
    samePassword_txt: '帐号与密码不能相同'
});

function SubChk(pLen) {
    if (password_old.value === '') {
        password_old.focus();
        alert("旧密码请务必输入");
        return false;
    } else if (password.value === '') {
        password.focus();
        alert("密码请务必输入");
        return false;
    } else if (password.value.length > 0 && password.value.length < pLen) {
        password.focus();
        alert('密码长度不能少于' + pLen + '个字符');
        return false;
    } else if ($('#memAccTable').find('.top_badPass')[0]) {
        password.focus();
        alert($('#memAccTable').find('.top_badPass').text());
        return false;
    } else if (/[^a-z0-9]/g.test(password.value)) {
        password.focus();
        alert('密码须符合0~9及a~z字符');
        return false;
    } else if (password.value.length > 12) {
        password.focus();
        alert('密码长度不能多于12个字符');
        return false;
    } else if (REpassword.value === '') {
        REpassword.focus();
        alert("确认密码请务必输入");
        return false;
    } else if (password.value !== REpassword.value) {
        REpassword.focus();
        alert("密码与确认不一致,请重新输入");
        return false;
    }
    
    return true;
}
