<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>


<div class="pro_title pd10">管理：编辑管理员</div>
<form id="sysManageForm">
    <input name="id" type="hidden" size="30" value="<?=$sysManage->id?>"/>
    <table width="90%" align="center" class="settable">
        <tr>
            <td width="172" align="right" class="pdr10">登陆名称</td>
            <td width="473">
                <input name="login_name" type="text" size="30" value="<?=$sysManage->manage_name?>" <?php if($sysManage->id) echo 'readonly' ?>/>
            </td>
        </tr>
        <tr>
            <td width="172" align="right" class="pdr10">登陆密码</td>
            <td width="473">
                <input name="login_pwd" type="password" size="30" value=""/>
            </td>
        </tr>
        <tr>
            <td align="right" class="pdr10">权限设置</td>
            <td>
                <?php
                $temp_i=0;
                foreach($qx as $key => $t)
                {
                    $temp_i++;
                ?>
                    <input type="checkbox" name="quanxian[]"  <?php if(strpos($sysManage->purview,$t)){?> checked  <?php }?>  value="<?=$t?>"> <?=$t?>
                <?php
                    if($temp_i%5==0) echo "<br />";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td align="right" class="pdr10">登陆限制</td>
            <td><input type="checkbox" name="onlylogin"  <?php if($sysManage->login_one==1){?> checked  value="<?=$sysManage->login_one?><?php }?>  ">只允许一个地方登陆
            </td>
        </tr>
        <tr>
            <td align="right" class="pdr10">操作</td>
            <td>
                <input type="button" onclick="submitForm();" value="提交"/>&nbsp;   &nbsp;
    <input type="button" value="取消"  onClick="javascript:history.go(-1);"/>
        </td>
        </tr>
        </table>
        </form>
        <script>
    function submitForm() {
        var form = $('#sysManageForm');
        var purview = '';
        var purviews = [];
        var id = form.find('input[name=id]').val();
        var manage_name = form.find('input[name=login_name]').val();
        var manage_pass = form.find('input[name=login_pwd]').val();
        var login_one = form.find('input[name=onlylogin]').is(':checked');
        var user_name = '<?php echo $username;?>';
        form.find('input[name^=quanxian]').each(function (i, obj) {
            if($(obj).is(":checked")) {
                purviews.push($(obj).val());
                purview += ('|'+$(obj).val());
            }
        });
        if(manage_name == null || $.trim(manage_name) == "") {
            $.dialog.notify('登录名不能为空');
            return;
        }
        if(purviews.length == 0) {
            $.dialog.notify('请选择要分配的权限');
            return;
        }

        $.ajax({
            type: "POST",
            url: "?r=admin/manage/update",
            data: {user_name :user_name ,id : id, manage_name: manage_name, login_one : login_one ? 1 : 0, purview : purview, manage_pass : manage_pass}
        }).done(function (data) {
            data = $.parseJSON(data);
            $.dialog.notify(data.msg, function () {
                //location.href = "#/admin/manage/list";
            });
        }).fail(function (error) {
            $.dialog.notify(error.responseText);
        })
    }
</script>