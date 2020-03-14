<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>

<div class="pro_title pd10">给网站会员发布短消息</div>
<form id="userMsgForm" class="need_validate addhistorybank" role="form" method="post" action="?r=message/user/add">
    <div class="form-group">
        <label for="msg_title">消息标题：</label>
        <input type="text" class="form-control" id="msg_title" name="msg_title" placeholder="请输入消息标题" data-rule-required="true" data-msg-required="请输入消息标题">
    </div>
    <div class="form-group">
        <label for="msg_info">消息内容：</label>
        <textarea class="form-control" id="msg_info" name="msg_info" placeholder="请输入消息内容" data-rule-required="true" data-msg-required="请输入消息内容"></textarea>
    </div>
    <div class="form-group">
        <label for="user_name">会员名称：</label>
        <textarea class="form-control" id="user_name" name="user_name" placeholder="请输入会员名称"></textarea>
    </div>
    <div class="form-group">
        <input name="type" type="radio" value="login" >在线会员 &nbsp;&nbsp;
        <input name="type" type="radio" value="all" >所有会员 &nbsp;&nbsp;
        <input name="type" type="radio" value="user_g" >会员组 &nbsp;&nbsp;
        会员组：
        <select name="group" id="group">
            <?php
            foreach ($userGroups as $userGroup) {
                echo "<option value='".$userGroup['group_id']."'>".$userGroup['group_name']."</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="msg_from">发布者：</label>
        <input type="text" class="form-control" id="msg_from" name="msg_from" placeholder="请输入发布者">
    </div>
    <button type="button" class="btn btn-primary" onclick="submitForm()">发布</button>
</form>
<script>
    function submitForm(){
        var form = $('#userMsgForm');
        if(form.valid()) {
            var len = $(":radio:checked").length;
            if(len==0 && $("#user_name").val()==""){
                $.dialog.notify('请输入会员名称');
                $("#user_name").select();
                return;
            }
            if($(":radio:checked").val()=="user_g" && $("#group").val()==0 && $("#user_name").val()==""){
                $.dialog.notify('请选择会员组');
                return;
            }
            $.post(form.attr('action'), form.serialize(), function(data){
                data = $.parseJSON(data);
                if(data.status){
                    $.dialog.notify(data.msg == null ? '保存成功' : data.msg);
                }else{
                    $.dialog.notify(data.msg);
                }
            });
        } else {
            $.dialog.notify('提交的表单信息不完整');
        }
    }
</script>