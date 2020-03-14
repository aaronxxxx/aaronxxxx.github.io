<body>

                 <div class="pro_title pd10">用戶管理：設置密碼</div>
                    <form class="trinput font14 " method="post" name="form1">
                        <input name="id" type="hidden" value="<?= $uid ?>">
                        <input name="code" type="hidden" value="1">
                        <p>&nbsp;</p>
                        <table width="661" border="1" align="center" bordercolor="#333333" class="font12 skintable line35" style="border-collapse:collapse;color:#000;">
                            <tbody>
                                <tr class="hang">
                                    <td bgcolor="#F0FFFF">用戶名</td>
                                    <td><?= $agents_name ?></td>
                                </tr>
                                <tr class="hang">
                                    <td width="172" bgcolor="#F0FFFF">登陸密碼</td>
                                    <td width="473"><input type="password" name="password" id="password" value=""></td>
                                </tr>
                                <tr class="hang">
                                    <td bgcolor="#F0FFFF">確認密碼</td>
                                    <td><input name="password1" type="password" id="password1" value=""></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#F0FFFF">操作</td>
                                    <td>
                                        <input type="button" value="提交" id="passbutton">
                                        <a href="?r=agent/sum-index/list"><input type="button" value="返回"></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
</body>
<script language="javascript">
    $(function () {
        $('#passbutton').click(function () {
            var p1 = $('#password').val();
            var p2 = $('#password1').val();
            if (p1.length < 1) {
                alert('請輸入密碼');
                document.getElementById("password").focus();
                return false;
            }
            if (p1 != p2) {
                alert("兩次密碼輸入不一致");
                document.getElementById("password1").select();
                return false;
            }
            $.post('/?r=agent/sum-index/dopass', {
                code: 1,
                password: p2,
                id:<?= $uid; ?>
            },
                    function (result) {
                        if(result.status) {
                            $.dialog.notify(result.msg);
                            location.href = "?r=agent/sum-index/list&t="+new Date().getTime();
                        }else{
                            $.dialog.notify(result.msg);
                        }
                    }, 'json');
        });
    });
</script>