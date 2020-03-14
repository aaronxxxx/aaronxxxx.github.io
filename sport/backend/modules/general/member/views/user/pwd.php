<HTML>
    <HEAD>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
        <TITLE>设置账户密码</TITLE>
    </HEAD>
    <body>
        <table width="100%"  cellspacing="0" cellpadding="0"  id=editProduct>
            <tr>
                <td><font >&nbsp;<span class="pro_title">用户管理：设置密码</span></font></td>
            </tr>
            <tr>
                <td height="24" align="center" nowrap bgcolor="#FFFFFF">
                <form action="set_pwd.php?action=save&uid=<?php echo $rs["user_id"] ?>" method="post"  name="form1" id="form1" >
                <input type="hidden" name="uid" value="<?php echo $rs["user_id"] ?>" />
                    <input type="hidden" name="uname" value="<?php echo $rs["user_name"] ?>" />
                        <p>&nbsp;</p>
                        <table width="661" align="center" class="settable bordercolor">
                            <tr>
                                <td class="pdrgt15">用户名</td>
                                <td><?php echo $rs["user_name"] ?></td>
                            </tr>
                            <tr>
                                <td width="172" class="pdrgt15">登陆密码</td>
                                <td width="473"><input type="password" name="password" id="password" value=""/></td>
                            </tr>
                            <tr>
                                <td class="pdrgt15">确认密码</td>
                                <td><input  name="password1" type="password" id="password1" value=""/></td>
                            </tr>
                            <tr>
                                <td class="pdrgt15">操作</td>
                                <td><input type="button" value="提交" onclick="updatelogin();"/> <input type="button" value="返回列表" onclick="javascript:window.location.href='/#/member/index'"/></td>
                            </tr>
                        </table>
                    </form></td>
            </tr>
            <tr>
                <td height="24" align="center" nowrap bgcolor="#FFFFFF">
                <form action="set_pwd.php?action=saveqk&uid=<?php echo $rs["user_id"] ?>" method="post" name="form2" id="form2">
                <input type="hidden" name="uid" value="<?php echo $rs["user_id"] ?>" />
                    <input type="hidden" name="uname" value="<?php echo $rs["user_name"] ?>" />
                        <p>&nbsp;</p>
                        <table width="661" align="center" class="settable bordercolor">
                            <tr>
                                <td class="pdrgt15">用户名</td>
                                <td><?php echo $rs["user_name"] ?></td>
                            </tr>
                            <tr>
                                <td width="172" class="pdrgt15">提款密码</td>
                                <td width="473"><input name="qk_pwd" type="password" id="qk_pwd" value=""/></td>
                            </tr>
                            <tr>
                                <td class="pdrgt15">确认密码</td>
                                <td><input  name="qk_pwd1" type="password" id="qk_pwd1" value=""/></td>
                            </tr>
                            <tr>
                                <td class="pdrgt15">操作</td>
                                <td><input type="button" value="提交" onclick="updateqk();"/> <input type="button" value="返回列表" onclick="javascript:window.location.href='/#/member/index'"/></td>
                            </tr>
                        </table>
                    </form></td>
            </tr>
            <?php
            if (@$rs["is_daili"]) {
                ?>
                <tr>
                    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
                    <form action="set_pwd.php?action=savedl&uid=<?php echo $rs["user_id"] ?>" method="post"  name="form3" id="form3">
                    <input type="hidden" name="uid" value="<?php echo $rs["user_id"] ?>" />
                            <p>&nbsp;</p>
                            <table width="661" border="1" align="center" >
                                <tr>
                                    <td class="pdrgt15">用户名</td>
                                    <td><?php echo $rs["user_name"] ?></td>
                                </tr>
                                <tr>
                                    <td width="172" bgcolor="#F0FFFF">代理密码</td>
                                    <td width="473"><input name="dl_pwd" type="password" id="dl_pwd" value=""/></td>
                                </tr>
                                <tr>
                                    <td class="pdrgt15">代理密码</td>
                                    <td><input  name="dl_pwd1" type="password" id="dl_pwd1" value=""/></td>
                                </tr>
                                <tr>
                                    <td class="pdrgt15">操作</td>
                                    <td><input type="hidden" value="提交" onclick="updatedl();"/> <input type="button" value="返回列表" onclick="javascript:window.location.href='/#/member/index'"/></td>
                                </tr>
                            </table>
                     </form></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
    <script language="javascript">
        function check_sub1() {
            var p1 = document.getElementById("password").value;
            var p2 = document.getElementById("password1").value;
            if (p1.length < 1) {
                alert('请输入密码');
                document.getElementById("password").focus();
                return false;
            }

            if (p1 != p2) {
                alert("两次密码输入不一致");
                document.getElementById("password1").select();
                return false;
            }

            return true;
        }

        function check_sub2() {
            var p1 = document.getElementById("qk_pwd").value;
            var p2 = document.getElementById("qk_pwd1").value;
            if (p1.length < 1) {
                alert('请输入取款密码');
                document.getElementById("qk_pwd").focus();
                return false;
            }

            if (p1 != p2) {
                alert("两次密码输入不一致");
                document.getElementById("qk_pwd1").focus();
                return false;
            }

            return true;
        }

        function check_sub3() {
            var p1 = document.getElementById("dl_pwd").value;
            var p2 = document.getElementById("dl_pwd1").value;
            if (p1.length < 1) {
                alert('请输入代理密码');
                document.getElementById("dl_pwd").focus();
                return false;
            }

            if (p1 != p2) {
                alert("两次密码输入不一致");
                document.getElementById("dl_pwd1").select();
                return false;
            }

            return true;
        }
    </script>
<script>
function updatelogin(){
	var flag=check_sub1();
	if(flag==true){
		$.ajax({
			url:"/?r=member/user/savepwd",
			type:'POST',
			data:$('#form1').serialize(),
			error: function($e){
				alert('服务器未响应！');
			},
			success:function($html){
				alert("操作成功了！！！");
			}
		});
	}
}
function updateqk(){
	var flag=check_sub2();
	if(flag==true){
		$.ajax({
			url:"/?r=member/user/saveqkpwd",
			type:'POST',
			data:$('#form2').serialize(),
			error: function($e){
				alert('服务器未响应！');
			},
			success:function($html){
				alert("操作成功了！！！");
			}
		});
	}
}
function updatedl(){
	var flag=check_sub3();
	if(flag==true){
		$.ajax({
			url:"/?r=member/user/savedlpwd",
			type:'POST',
			data:$('#form2').serialize(),
			error: function($e){
				alert('服务器未响应！');
			},
			success:function($html){
				alert("操作成功了！！！");
			}
		});
	}
}
</script>