$(function () {
    $('#update_button').click(function () {
        var agents_id = $("#agents_id").val();
        var agents_name = $('#agents_name').val();
        var agent_url = $('#agent_url').val();
        var agents_type = $('#agents_type').val();
        var birthday = $('#birthday').val();
        var tel = $('#tel').val();
        var email = $('#email').val();
        var qq = $('#qq').val();
        var othercon = $('#othercon').val();
        var total_1_2 = $('#total_1_2').val();
        var total_1_scale = $('#total_1_scale').val();
        var total_2_1 = $('#total_2_1').val();
        var total_2_2 = $('#total_2_2').val();
        var total_2_scale = $('#total_2_scale').val();
        var total_3_1 = $('#total_3_1').val();
        var total_3_2 = $('#total_3_2').val();
        var total_3_scale = $('#total_3_scale').val();
        var total_4_1 = $('#total_4_1').val();
        var total_4_2 = $('#total_4_2').val();
        var total_4_scale = $('#total_4_scale').val();
        // var total_5_1 = $('#total_5_1').val();
        // var total_5_2 = $('#total_5_2').val();
        // var total_5_scale = $('#total_5_scale').val();
        var refunded_scale = $('#refunded_scale').val();
        // var PK10_return_water = $('#PK10_return_water').val();
        var remark = $('#remark').val();
        if (agents_name.length < 1) {
            $.dialog.notify("請輸入用戶名！");
            return false;
        }
        if (remark.length < 1) {
            $.dialog.notify("審核完畢的總代理備註不能為空！");
            return false;
        }
        $.post('/?r=agent/sum-index/agents-news',{
                code:1,
                agents_id:agents_id,
                agents_name:agents_name,
                agent_url:agent_url,
                agents_type:agents_type,
                birthday:birthday,
                tel:tel,
                email:email,
                qq:qq,
                othercon:othercon,
                total_1_2:total_1_2,
                total_1_scale:total_1_scale,
                total_2_1:total_2_1,
                total_2_2:total_2_2,
                total_2_scale:total_2_scale,
                total_3_1:total_3_1,
                total_3_2:total_3_2,
                total_3_scale:total_3_scale,
                total_4_1:total_4_1,
                total_4_2:total_4_2,
                total_4_scale:total_4_scale,
                // total_5_1:total_5_1,
                // total_5_2:total_5_2,
                // total_5_scale:total_5_scale,
                refunded_scale:refunded_scale,
                // PK10_return_water:PK10_return_water,
                remark:remark,
            },
            function(result){
                if(result.status) {
                    $.dialog.notify(result.msg);
                    location.href = "#/agent/sum-index/agents-news&id="+agents_id+"&t="+new Date().getTime();
                }else{
                    $.dialog.notify(result.msg);
                }
            },'json')
    });

    $('#add_button').click(function(){
        var agents_name = $('#agents_name').val();
        var agents_pass = $('#agents_pass').val();
        var agent_url = $('#agent_url').val();
        var agents_type = $('#agents_type').val();
        var birthday = $('#birthday').val();
        var tel = $('#tel').val();
        var email = $('#email').val();
        var qq = $('#qq').val();
        var othercon = $('#othercon').val();
        var total_1_2 = $('#total_1_2').val();
        var total_1_scale = $('#total_1_scale').val();
        var total_2_1 = $('#total_2_1').val();
        var total_2_2 = $('#total_2_2').val();
        var total_2_scale = $('#total_2_scale').val();
        var total_3_1 = $('#total_3_1').val();
        var total_3_2 = $('#total_3_2').val();
        var total_3_scale = $('#total_3_scale').val();
        var total_4_1 = $('#total_4_1').val();
        var total_4_2 = $('#total_4_2').val();
        var total_4_scale = $('#total_4_scale').val();
        // var total_5_1 = $('#total_5_1').val();
        // var total_5_2 = $('#total_5_2').val();
        // var total_5_scale = $('#total_5_scale').val();
        var refunded_scale = $('#refunded_scale').val();
        // var PK10_return_water = $('#PK10_return_water').val();
        var remark = $('#remark').val();
        var limit_money = $('#limit_money').val();
        if (agents_name.length < 1) {
            $.dialog.notify("請輸入用戶名！");
            return false;
        }
        $.post('/?r=agent/sum-index/add-agent',{
                agent_level:0,
                agents_name:agents_name,
                agents_pass:agents_pass,
                agent_url:agent_url,
                agents_type:agents_type,
                birthday:birthday,
                tel:tel,
                email:email,
                qq:qq,
                othercon:othercon,
                total_1_2:total_1_2,
                total_1_scale:total_1_scale,
                total_2_1:total_2_1,
                total_2_2:total_2_2,
                total_2_scale:total_2_scale,
                total_3_1:total_3_1,
                total_3_2:total_3_2,
                total_3_scale:total_3_scale,
                total_4_1:total_4_1,
                total_4_2:total_4_2,
                total_4_scale:total_4_scale,
                // total_5_1:total_5_1,
                // total_5_2:total_5_2,
                // total_5_scale:total_5_scale,
                refunded_scale:refunded_scale,
                // PK10_return_water:PK10_return_water,
                remark:remark,
                limit_money:limit_money,
            },
            function(res){
                if(res.status) {
                    $.dialog.notify(res.msg);
                    location.href = "#/agent/sum-index/list&t="+new Date().getTime();
                }else{
                    $.dialog.notify(res.msg);
                }
            },'json')
    });
});

function agent_check() {
    var len = document.form2.elements.length;
    var num = false;
    var s_action = $('#s_action').val();
    var val = Array();

    $('input[name="uid[]"]:checked').each(function () {
        val.push($(this).val());
    });
    for (var i = 0; i < len; i++) {
        var e = document.form2.elements[i];
        if (e.checked && e.name == 'uid[]') {
            num = true;
            break;
        }
    }
    if (num) {
        var action = document.getElementById("s_action").value;
        if (action == "0") {
            $.dialog.notify('請您選擇要執行的相關操作！');
            return false;
        } else {
            if (action == '1' || action == '2') {
                $.post("/?r=agent/sum-index/quanxian", {
                        s_action: s_action,
                        uid: val,
                    },
                    function (result) {
                        if(result.status) {
                            $.dialog.notify(result.msg);
                            location.href = "#/agent/sum-index/list&t="+new Date().getTime();
                        }else{
                            $.dialog.notify(result.msg);
                        }
                    }, "json");
            }
            if (action == "3") {
                if (confirm('確認通過該會員總代理資格？取消則表示不同意該會員成為總代理！')) {
                    $.post("/?r=agent/sum-index/quanxian", {
                            s_action: s_action,
                            uid: val,
                        },
                        function (result) {
                            if(result.status) {
                                $.dialog.notify(result.msg);
                                location.href = "#/agent/sum-index/list&t="+new Date().getTime();
                            }else{
                                $.dialog.notify(result.msg);
                            }
                        }, "json");
                }
            }
            if (action == "4") {
                $.dialog.confirm('確認刪除該總代理嗎？',function(){
                    $.post("/?r=agent/sum-index/quanxian", {
                            s_action: s_action,
                            uid: val,
                        },
                        function (result) {
                            if(result.status) {
                                $.dialog.notify(result.msg);
                                location.href = "#/agent/sum-index/list&t="+new Date().getTime();
                            }else{
                                $.dialog.notify(result.msg);
                            }
                        }, "json");
                })
            }
            if (action == "5") {
                window.location.href="#/agent/sum-index/setpassword&uid="+val;
            }
        }
    } else {
        $.dialog.notify("您未選中任何復選框！");
        return false;
    }


}

