<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>


          <div class="pro_title pd10">管理员管理：设置密码</div>
      
            <form>
                <p>&nbsp;</p>
                <div class="trinput font15 addgents  mgauto " style="width: 661px;padding: 0;float: inherit;">
                    <div class="item">
                        <span class="name">管理员</span>
                       <?=$userName?>
                    </div>
                    <div class="item">
                       <span class="name">密码</span>
                        <input id="password" type="password" name="password" value=""/>
                    </div>
                    <div class="item">
                        <span class="name">确认密码</span>
                        <input id="password2" type="password"  name="password2" value=""/>
                    </div>
                    <div class="item">
                        <span class="name">操作</span>
                        <input type="button" onclick="submitForm()" value="提交"/>
                    </div>
                </div>
                <input type="hidden" id="userId" name="userId" value="<?=$userId?>">
            </form>
      

<script language="javascript">
    function submitForm(){
        var p1 = $('#password').val();
        var p2 = $('#password2').val();
        if(p1.length < 1){
            alert('请输入密码');
            $('#password').focus();
            return;
        }
        if(p1 != p2){
            alert("两次密码输入不一致");
            $('#password2').focus();
            return;
        }
        var userId = $('#userId').val();
        $.ajax({
            url:'?r=admin/manage/setpwd',
            data:{p1:p1,p2:p2,userId:userId},
            dataType:'json'
        }).done(function (data) {
            alert(data.msg);
        }).fail(function (error) {
            alert(error.responseText);
        });
    }
</script>