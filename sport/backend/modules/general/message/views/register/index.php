<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>


<div class="pro_title pd10">给注册会员发布站内信息</div>
<form id="registerMsgForm" class="need_validate addhistorybank" role="form" method="post" action="?r=message/register/update">
    <div class="form-group ">
        <label for="msg_title">消息标题：</label>
        <input type="text" class="form-control" id="msg_title" name="msg_title" value="<?= $title['parameter_value'] ?>" placeholder="请输入消息标题" data-rule-required="true" data-msg-required="请输入消息标题">
    </div>
    <div class="form-group">
        <label for="msg_info">消息内容：</label>
        <textarea class="form-control" id="msg_info" name="msg_info" placeholder="请输入消息内容" data-rule-required="true" data-msg-required="请输入消息内容"><?= $content['parameter_value'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="from">发送者：</label>
        <input type="text" class="form-control" id="from" name="from" value="<?= $from['parameter_value'] ?>" placeholder="请输入消息发送者">
    </div>
    <div class="form-group">
        <label>是否启用：</label>
        <div>
            <input name="type" type="radio" value="off" <?php if($enable['parameter_value']=="off" || $enable['parameter_value']!="on"){echo "checked";}?> >关闭自动发送
            <input name="type" type="radio" value="on" <?php if($enable['parameter_value']=="on"){echo "checked";}?> >开启自动发送
        </div>
    </div>
    <button type="button" class="btn btn-primary form_ajax_submit_btn" data-targetid="registerMsgForm">保存</button>
</form>