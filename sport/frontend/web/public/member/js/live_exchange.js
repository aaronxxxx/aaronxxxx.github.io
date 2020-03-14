$(function () {
    // setTimeout("queryBalance(1,$('#name_ag'),$('#credit_ag'),$('#time_ag'))", 100);
    // setTimeout("queryBalance(2,$('#name_agin'),$('#credit_agin'),$('#time_agin'))", 100);
    // setTimeout("queryBalance(3,$('#name_ag_bbin'),$('#credit_ag_bbin'),$('#time_ag_bbin'))", 100);
    // setTimeout("queryBalance(4,$('#name_ds'),$('#credit_ds'),$('#time_ds'))", 100);
    // setTimeout("queryBalance(5,$('#name_ag_og'),$('#credit_ag_og'),$('#time_ag_og'))", 100);
    // setTimeout("queryBalance(6,$('#name_ag_mg'),$('#credit_ag_mg'),$('#time_ag_mg'))", 100);
    // setTimeout("queryBalance(7,$('#name_og'),$('#credit_og'),$('#time_og'))", 100);
    // setTimeout("queryBalance('8',$('#name_kg'),$('#credit_kg'),$('#time_kg'))", 100);
    // setTimeout("queryBalance('9',$('#name_pt'),$('#credit_pt'),$('#time_pt'))", 100);
    // setTimeout("queryBalance('10',$('#name_vr'),$('#credit_vr'),$('#time_vr'))", 100);
    setTimeout("queryBalance('11',$('#name_ai'),$('#credit_ai'),$('#time_ai'))", 100);
});

function redreshChangeMoney() {
    $('#credit').html('正在同步中');
    $('#credit_ag').html('正在同步中');
    $('#credit_agin').html('正在同步中');
    $('#credit_ag_bbin').html('正在同步中');
    $('#credit_ds').html('正在同步中');
    $('#credit_ag_og').html('正在同步中');
    $('#credit_ag_mg').html('正在同步中');
    $('#credit_og').html('正在同步中');
    $('#credit_kg').html('正在同步中');
    $('#credit_pt').html('正在同步中');
    $('#credit_vr').html('正在同步中');
    $.post("/?r=mobile/index/json", {},
        function (res) {
            if (res.name !== '') {
                $("#credit").html(res.money);
            }
        }, "json");
    // setTimeout("queryBalance(1,$('#name_ag'),$('#credit_ag'),$('#time_ag'))", 100);
    // setTimeout("queryBalance(2,$('#name_agin'),$('#credit_agin'),$('#time_agin'))", 100);
    // setTimeout("queryBalance(3,$('#name_ag_bbin'),$('#credit_ag_bbin'),$('#time_ag_bbin'))", 100);
    // setTimeout("queryBalance(4,$('#name_ds'),$('#credit_ds'),$('#time_ds'))", 100);
    // setTimeout("queryBalance(5,$('#name_ag_og'),$('#credit_ag_og'),$('#time_ag_og'))", 100);
    // setTimeout("queryBalance(6,$('#name_ag_mg'),$('#credit_ag_mg'),$('#time_ag_mg'))", 100);
    // setTimeout("queryBalance(7,$('#name_og'),$('#credit_og'),$('#time_og'))", 100);
    // setTimeout("queryBalance('8',$('#name_kg'),$('#credit_kg'),$('#time_kg'))", 100);
    // setTimeout("queryBalance('9',$('#name_pt'),$('#credit_pt'),$('#time_pt'))", 100);
    // setTimeout("queryBalance('10',$('#name_vr'),$('#credit_vr'),$('#time_vr'))", 100);
    setTimeout("queryBalance('11',$('#name_ai'),$('#credit_ai'),$('#time_ai'))", 100);
}
/**
 * 校验转账参数并处理转账业务,转入各厅
 * @param {string} tran_type    操作类型
 * @returns {boolean}           true: 通过 false: 未通过
 */
function confirmChangeMoney(tran_type) {
    if (!confirm("确定转账吗？")) {
        return false;
    }

    var zz_type = str2int($('#zz_type_' + tran_type).val()); // 转账类型
    var zz_money = str2int($('#zz_money_' + tran_type).val()); // 转账金额

    // if (!checkChangeMoney(zz_money, zz_type)) {
    //     return false;
    // }

    $.ajax({
        async: true,
        type: "POST",
        url: "/?r=live/exchange-api/index",
        data: {
            credit: $('#zz_money_' + tran_type).val(),
            type: $('#zz_type_' + tran_type).val()
        },
        dataType: "json",
        beforeSend: function () {
            $("#btn_int").attr({
                disabled: "disabled"
            });
            $("#btn_out").attr({
                disabled: "disabled"
            });
            $.blockUI({
                message: '转账中,请稍候...'
            });
        },
        success: function (data) {
            if (data.code === 0) {
                console.log('log');
                alert('转账成功');
            } else {
                alert(data.msg);
            }

            document.write("<script>window.location.href = '/?r=member/live/index';</script>");
        },
        complete: function () {
            $.unblockUI();
            $("#btn_int").removeAttr("disabled");
            $("#btn_out").removeAttr("disabled");
        },
        error: function (error) {
            //alert(error.responseText);
        }
    });
}

/**
 * 校验转账参数并处理转账业务,转入各厅
 * @param {string} tran_type    操作类型
 * @returns {boolean}           true: 通过 false: 未通过
 */
function confirmChangeAllMoney(tran_type, changeid, money) {
    if (!confirm("确定转账吗？")) {
        return false;
    }
    var zz_type = changeid; //str2int($('#zz_type_' + tran_type).val());                    // 转账类型
    if (tran_type == 'in') {
        var zz_money = parseInt(money); //str2int($('#zz_money_' + tran_type).val());                  // 转账金额
        if (zz_money == 0) {
            alert('主帐户余额不足');
            return false;
        }
    } else {
        if (isNaN($('#' + money).html())) {
            alert('系统忙碌中,请稍后');
            return false;
        }
        var zz_money = parseInt($('#' + money).html()); // 转账金额
    }

    if (!checkChangeMoney(zz_money, zz_type)) {
        return false;
    }

    $.ajax({
        async: true,
        type: "POST",
        url: "/?r=live/exchange-api/index",
        data: {
            credit: zz_money,
            type: zz_type
        },
        dataType: "json",
        beforeSend: function () {
            $("#btn_int").attr({
                disabled: "disabled"
            });
            $("#btn_out").attr({
                disabled: "disabled"
            });
            $.blockUI({
                message: '转账中,请稍候...'
            });
        },
        success: function (data) {
            console.log(data);
            if (data.code === 0) {
                alert('转账成功');
                redreshChangeMoney();
            } else {
                alert(data.msg);
            }
        },
        complete: function () {
            $.unblockUI();
            $("#btn_int").removeAttr("disabled");
            $("#btn_out").removeAttr("disabled");
        },
        error: function (error) {
            console.log(error);
            //alert(error.responseText);
        }
    });
}

/**
 * 提交转换时校验
 * @param {int} zz_money    转账金额
 * @param {int} zz_type     转账类型
 * @returns {boolean}       true: 通过 false: 未通过
 */
function checkChangeMoney(zz_money, zz_type) {
    if (!zz_money || zz_money === -1) {
        alert('请输入转账金额。');
        return false;
    }

    var regu = /^[-]{0,1}[0-9]{1,}$/;
    if (!regu.test(zz_money)) {
        alert('请输入整数。');
        return false;
    }

    if (!checkAccount(zz_type)) {
        return false;
    } else if (!checkMoney(zz_type, zz_money)) {
        return false;
    }

    return true;
}

/**
 * 校验账户
 * @param {int} zz_type     转账类型
 * @returns {boolean}       true: 通过 false: 未通过
 */
function checkAccount(zz_type) {
    var ret = false;

    $.ajax({
        async: false,
        type: 'post',
        url: '/?r=live/exchange-api/check-account',
        data: {
            type: zz_type
        },
        dataType: "json",
        beforeSend: function () {
            // ...
        },
        success: function (data) {
            if (data === 'undefinded' || data.code === 'undefinded') {
                return false;
            }

            ret = data.code === 0 ? true : false;
            if (ret === false) {
                alert(data.msg);
            }
        },
        complete: function () {
            // ...
        },
        error: function (msg) {
            console.log(msg);
            //alert(msg);
            return false;
        }
    });

    return ret;
}

/**
 * 校验金额
 * @param {int} zz_type     转账类型
 * @param {int} zz_money    转账金额
 * @returns {boolean}       true: 通过 false: 未通过
 */
function checkMoney(zz_type, zz_money) {
    var ret = false;

    $.ajax({
        async: false,
        type: 'post',
        url: '/?r=live/exchange-api/check-money',
        data: {
            type: zz_type,
            credit: zz_money
        },
        dataType: "json",
        beforeSend: function () {
            // ...
        },
        success: function (data) {
            if (data === 'undefinded' || data.code === 'undefinded') {
                return false;
            }

            ret = data.code === 0 ? true : false;
            if (ret === false) {
                if (data.code === 4) {
                    if (!data.balance) {
                        alert('厅最可转入额度为0');
                        return false;
                    }
                    if (confirm("厅最大转入额度为:" + data.balance + ",请问是否转入" + data.balance + "?")) {
                        confirmChangeAllMoney('in', zz_type, data.balance);
                    } else {
                        return false;
                    }
                } else {
                    alert(data.msg);
                }
            }
        },
        complete: function () {
            // ...
        },
        error: function (msg) {
            //alert(msg);
            return false;
        }
    });

    return ret;
}

/**
 * 查询余额
 * @param {int} type    1: AG 2: AGIN 3: AG BBIN 4: DS 5: OG 6: AG MG
 * @param {dom} nNode   真人用户名节点对象
 * @param {dom} mNode   真人余额节点对象
 * @param {dom} tNode   时间节点对象
 * @returns {}
 */
function queryBalance(type, nNode, mNode, tNode) {
    $.ajax({
        async: true,
        type: 'post',
        url: '/?r=live/query-balance-api/index',
        data: {
            type: type
        },
        dataType: "json",
        error: function (msg) {
            //alert(msg);
        },
        success: function (data) {
            if (data === 'undefinded' || data.code === 'undefinded') {
                return false;
            }

            var name = data.data.name === '' ? '额度转换后自动开通' : data.data.name;
            name = name === null ? '额度转换后自动开通' : name;

            var balance = data.code !== 0 ? '正在同步中...' : data.data.balance;
            balance = isNaN(balance) === true ? '正在同步中...' : Number(balance).toFixed(2);

            var time = data.data.time === '' ? '正在同步中...' : data.data.time;
            time = time === null ? '' : data.data.time;

            if (nNode === null || mNode === null || tNode === null) {
                return false;
            }

            nNode.html(name);
            mNode.html(balance);
            tNode.html(time);
        }
    });
}