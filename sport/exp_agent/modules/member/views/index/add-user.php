
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" ><font >&nbsp;<span class="pro_title">用戶管理：新增用戶</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><br>

<form action="?r=member/index/add-user" method="post" name="form1" id="form1">
<table width="90%" align="center"  cellspacing="0" cellpadding="0" class="settable" >
  <tr>
    <td class="pdrgt15">用戶名</td>
    <td><input name="user_name" type="text" id="user_name" value=""></td>
  </tr>
  <tr>
    <td class="pdrgt15">密碼</td>
    <td><input name="user_pass" type="password" id="user_pass" value=""></td>
  </tr>
  <tr>
    <td class="pdrgt15">取款密碼</td>
    <td><input name="qk_pass" type="password" id="qk_pass" value=""></td>
  </tr>
  <tr>
    <td class="pdrgt15">手機</td>
    <td><input type="text" name="tel" id="tel" value="" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">email</td>
    <td><input type="text" name="email" id="email" value="" ></td>
  </tr>
  <tr>
    <td class="pdrgt15">QQ</td>
    <td><input type="text" name="qq" id="qq" value="" ></td>
  </tr>  
  <tr>
    <td class="pdrgt15">真實姓名</td>
    <td><input type="text" name="pay_name" value="" id="pay_name"></td>
  </tr>
  <tr>
<!--    <td class="pdrgt15">帳戶類型</td>-->
<!--    <td><input type="radio" name="account_type" value="0" id="at1"><label for="at1"> 儲值卡會員(無法後台加款)</label><br>-->
<!--    <input type="radio" name="account_type" value="1" id="at2"><label for="at2"> 信用會員</label>-->
<!--    </td>-->
  </tr>
    <tr>
    <td class="pdrgt15">所屬會員組</td>
    <td><label>
      <select name="group_id" id="group_id">
<?php
foreach($usergroup as $key=>$value){
?>
        <option value="<?= $value['group_id']?>" ><?= $value['group_name']?></option>
<?php
}
?>
      </select>
    </label></td>
  </tr>
    <td class="pdrgt15">備註：</td>
    <td><textarea name="why" cols="80" rows="5" id="why"></textarea></td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
  	  <input type="button" value="確認提交" id="add_button"> 　 
  	  <input type="button" value="返回列表" onClick="javascript:history.go(-1)"></td>
  </tr>
</table>
</form></td>
  </tr>
</table>

<script>
$(function(){
  $('#add_button').click(function(){
        var user_name = $('#user_name').val();
        var user_pass = $('#user_pass').val();
        var qk_pass = $('#qk_pass').val();
        var pay_name = $('#pay_name').val();
        var qq = $('#qq').val();
        var tel = $('#tel').val();
        var group_id = $('#group_id').val();
        var email = $('#email').val();
        var why = $('textarea#why').val();
        // var account_type = $("[name='account_type']:checked").val();

        if (user_name.length < 1) {
            $.dialog.notify("請輸入用戶名！");
            return false;
        }
        if (user_pass.length < 1) {
            $.dialog.notify("請輸入密碼！");
            return false;
        }
        // if ( $("[name='account_type']:checked").length < 1) {
        //     $.dialog.notify("請輸入會員類型！");
        //     return false;
        // }
        $.post('/?r=member/index/add-user',{
            user_name:user_name,
            user_pass:user_pass,
            qk_pass:qk_pass,
            pay_name:pay_name,
            qq:qq,
            group_id:group_id,
            email:email,
            tel:tel,
            why:why,
            // account_type:account_type
        },
        function(res){
            console.log(res);
            if(res.status==1){
                $.dialog.notify("添加成功！");
                window.location.href="?r=member/index";
            }else{
                $.dialog.notify(res.msg);
            }
        },'json')
    });
})
</script>