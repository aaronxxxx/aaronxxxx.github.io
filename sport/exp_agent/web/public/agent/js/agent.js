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
        var remark = $('#remark').val();
        if (agents_name.length < 1) {
            $.dialog.notify("请输入用户名！");
            return false;
        }
        if (remark.length < 1) {
            $.dialog.notify("审核完毕的代理备注不能为空！");
            return false;
        }
        $.post('/?r=agent/index/agents-news',{
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
            remark:remark,
        },
        function(result){
            if(result.status) {
                $.dialog.notify(result.msg);
                location.href = "#/agent/index/agents-news&id="+agents_id+"&t="+new Date().getTime();
            }else{
                $.dialog.notify(result.msg);
            }
        },'json')
    });
    
    $('#add_button').click(function(){
        var agent_level = $('#agent_level').val();
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
        var remark = $('#remark').val();
        if (agents_name.length < 1) {
            $.dialog.notify("请输入用户名！");
            return false;
        }
        $.post('/?r=agent/index/add-agent',{
            agent_level:agent_level,
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
            remark:remark,
        },
        function(res){
            if(res.status) {
                $.dialog.notify(res.msg);
                location.href = "#/agent/index/list-type&remark=0&t="+new Date().getTime();
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
            $.dialog.notify('请您选择要执行的相关操作！');
            return false;
        } else {
            if (action == '1' || action == '2') {
                $.post("/?r=agent/index/quanxian", {
                    s_action: s_action,
                    uid: val,
                },
                        function (result) {
                            if(result.status) {
                                $.dialog.notify(result.msg);
                                location.href = "#/agent/index/list&t="+new Date().getTime();
                            }else{
                                $.dialog.notify(result.msg);
                            }
                        }, "json");
            }
            if (action == "3") {
                if (confirm('确认通过该会员代理资格？取消则表示不同意该会员成为代理！')) {
                    $.post("/?r=agent/index/quanxian", {
                        s_action: s_action,
                        uid: val,
                    },
                            function (result) {
                                if(result.status) {
                                    $.dialog.notify(result.msg);
                                    location.href = "#/agent/index/list&t="+new Date().getTime();
                                }else{
                                    $.dialog.notify(result.msg);
                                }
                            }, "json");
                }
            }
            if (action == "4") {
               $.dialog.confirm('确认删除该代理吗？',function(){
                   $.post("/?r=agent/index/quanxian", {
                           s_action: s_action,
                           uid: val,
                       },
                       function (result) {
                           if(result.status) {
                               $.dialog.notify(result.msg);
                               location.href = "#/agent/index/list&t="+new Date().getTime();
                           }else{
                               $.dialog.notify(result.msg);
                           }
                       }, "json");
               })
            }
            if (action == "5") {
                window.location.href="#/agent/index/setpassword&uid="+val;
            }
            if(action=="6"){
                var agentlevel=prompt("請輸入總代理ID（0代表无上级）");
                if(agentlevel==""||agentlevel==null){

                }else{
                    $.ajax({
                        url:"/?r=agent/index/set-agentlevel",
                        type:'POST',
                        data:{uid:val,agentlevel:agentlevel},
                        error: function($e){
                            alert('服務器未響應！');
                        },
                        success:function($html){
                            window.location.reload();
                            alert($html);
//                 				alert("操作成功了！！！");
                        }
                    });
                }
            }
        }
    } else {
        $.dialog.notify("您未选中任何复选框！");
        return false;
    }
 
 
}

