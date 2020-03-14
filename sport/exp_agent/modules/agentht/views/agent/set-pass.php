<?php

use yii\widgets\LinkPager;
?>
<body>

    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：修改密码
                </span>
                </font>
            </td>
        </tr>
    </table>
    <div id="pageMain"  align="center">
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" >
            <form name="pwd_form" id="pwd_form" method="post" action="/?r=agentht/agent/set-pass" >
                <tbody>
                    <tr>
                        <td height="24" align="center" nowrap="">
                            <form action="#" method="post" name="set_pass">
                                <p>&nbsp;</p>
                                <table width="661"  align="center"  class="settable bordercolor">
                                    <tbody>
                                        <tr>
                                            <td class="pdrgt15">代理名</td>
                                            <td><?php echo $agents_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td width="172" class="pdrgt15">代理密码</td>
                                            <td width="473"><input name="dl_pwd1" type="password" id="dl_pwd1" value=""></td>
                                        </tr>
                                        <tr>
                                            <td class="pdrgt15">代理密码</td>
                                            <td><input name="dl_pwd2" type="password" id="dl_pwd2" value=""></td>
                                        </tr>
                                        <tr>
                                            <td class="pdrgt15">操作</td>
                                            <td><input type="button" id="set_pass" value="提交"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </form>
        </table>
    </div>
</body>
<script type="text/javascript" language="javascript">
    $(function () {
        $('#set_pass').click(function () {
            var pwd1 = $('#dl_pwd1').val();
            var pwd2 = $('#dl_pwd2').val();
            if (pwd1 == '') {
                alert('密码不能为空！！');
                return false;
            }
            if (pwd1.length > 12) {
                alert('密码长度不能超过12位！！');
                return false;
            }
            if (pwd1 != pwd2) {
                alert('两次密码不一致！！');
                return false;
            }
            $('#pwd_form').submit();
        });
    });
</script>