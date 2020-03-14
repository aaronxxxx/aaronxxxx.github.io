function xiaZhu(type, formId, orderFormId) {
    if (type == 'CH') {
        var verify = CH(); //连码
        if (!verify) {
            return false;
        }
    } else if (type == 'NX') {
        var verify = NX(); //合肖
        if (!verify) {
            return false;
        }
    } else if (type == 'NAP') {
        var verify = NAP(); //正码过关
        if (!verify) {
            return false;
        }
    } else if (type == 'LX') {
        var verify = LX(); //连肖，连码
        if (!verify) {
            return false;
        }
    } else if (type == 'NOTIN') {
        var verify = NOTIN(); //自选不中
        if (!verify) {
            return false;
        }
    }
    $.ajax({
        url: $('#' + formId).attr('action'),
        data: $("#" + formId).serialize(),
        type: 'POST',
        success: function (res) {
            //判断是否登录
            if (res == '未登录，请先登录') {
                layer.confirm('还未登录,是否现在登录？', {
                        btn: ['确定', '取消']
                    },
                    function () {
                        var $url = window.location.href;
                        var $index = $url.indexOf('/?r=');
                        if (parseInt($index) >= 0) {
                            $url = $url.substr($index);
                            $url = $url.replace('/?r=', '[]');
                        }
                        top.location = '/?r=mobile/disp/login&url=' + $url;
                    },
                    function (index) {
                        layer.close(index);
                    });
                return false;
            }
            layer.confirm(res,
                {
                    area:['80%','auto'],
                    title:' ',
                    skin:'layer-betView',
                }
                , function (index) {
                //如果有错则关闭所有弹出框
                if (res.length <= 20) {
                    layer.closeAll();
                    layer.alert('未知错误，请稍后再下注!');
                    return false;
                }
                var money = $('#gold').val();
                if (!money || isNaN(money) || money == 0) {
                    layer.alert('下注金额不能为空且只能为数字!');
                    return false;
                }
                var status = confirm('确定要下注吗？');
                if (status && money) {
                    if ($("#min").attr('min') * 1 > money * 1) {
                        layer.alert('下注金额不能低于最低限额!');
                        return false;
                    }
                    if ($("#max").attr('max') * 1 < money * 1) {
                        layer.alert('超过当期下注最大金额，请联系管理人员');
                        return false;
                    }
                    $.ajax({
                        url: $("#" + orderFormId).attr('action'),
                        data: $("#" + orderFormId).serialize(),
                        type: 'POST',
                        dataType: 'json',
                        success: function (res) {
                            layer.alert(res.msg, function () {
                                window.location.reload();
                            });
                        }
                    });
                }
             
            });
        }
    });
}
//连码
function CH() {
    var checkName = 'num[]';
    var rtype = $("input[name='rtype']:checked").val();
    var nums = $("input[name='rtype']:checked").attr('nums');
    var num = [];
    $('input[name="' + checkName + '"]:checked').each(function () {
        num.push($(this).val());
    });
    //判断是否选择了玩法
    if (rtype == 'undefined' || rtype == null) {
        layer.alert('请选择玩法！');
        return false;
    }
    //判断选择的玩法对应该选的号码个数
    if (num.length < nums) {
        layer.alert('尚未选满' + nums + '个号码！');
        return false;
    }
    return true;
}
//合肖
function NX() {
    var checkName = 'lt_nx[]';
    var rtype = $("input[name='rtype']:checked").val();
    var num = [];
    $('input[name="' + checkName + '"]:checked').each(function () {
        num.push($(this).val());
    });
    //判断是否选择了玩法
    if (rtype == 'undefined' || rtype == null) {
        layer.alert('请选择玩法！');
        return false;
    }
    //判断判断是否选择了号码
    if (num.length <= 0) {
        layer.alert('请选择生肖！');
        return false;
    } else if ('NX_IN' == rtype && num.length < 2) {
        layer.alert('请选择两个生肖！');
        return false;
    }
    return true;
}
//正码过关
function NAP() {
    var num = [];
    $("input[type=radio]:checked").each(function () {
        num.push($(this).val());
    });
    if (num.length < 2) {
        layer.alert('请选择二组以上玩法，若只要单一下注请前往正码1-6投注！');
        return false;
    }
    return true;
}
//连肖；连尾
function LX() {
    var rtype = $("input[type=radio]:checked").val();
    if (rtype == '' || rtype == null || rtype == 'undefined' || !rtype.substr(2, 1)) {
        layer.alert('请选择玩法');
        return false;
    }
    var checkName = rtype.substr(0, 2).toLowerCase() + '[]';
    var num = [];
    $('input[name="' + checkName + '"]:checked').each(function () {
        num.push($(this).val());
    });
    if (num.length < rtype.substr(2, 1)) {
        layer.alert('尚未选满' + rtype.substr(2, 1) + '个生肖或者尾数！');
        return false;
    }
    return true;
}
//自选不中
function NOTIN() {
    var rtype = $("input[type=radio]:checked").val();
    var nums = $("input[type=radio]:checked").attr('num');
    var checkName = 'num[]';
    if (rtype == '' || rtype == null || rtype == 'undefined' || isNaN(nums)) {
        layer.alert('请选择玩法');
        return false;
    }
    var num = [];
    $('input[name="' + checkName + '"]:checked').each(function () {
        num.push($(this).val());
    });
    if (num.length != nums) {
        layer.alert('请选择' + $("input[type=radio]:checked").attr('num') + '个号码！');
        return false;
    }
    return true;
}