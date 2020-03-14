<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>登陆IP列表页面</title>
    </head>


    <body>
        <form id="form1" name="form1" method="post" action="/#/member/loginlog/search" onsubmit="return check();" class="trinput  font13 pd10">      
            <div class="chaxunip">

                <p>
                    <span>请您输入要查询的IP地址：</span>
                    <textarea name="ip" cols="80" rows="2" id="ip"><?php echo $ip ?></textarea>

                    <label>多个IP可以用 , 隔开</label>
                </p>

                <p>
                    <span>请您输入要查询的会员名称：</span>

                    <textarea name="username" cols="80" rows="2" id="username"><?php echo $username; ?></textarea>

                    <label>多个会员可以用 , 隔开</label></td>

                </p>
                <p> <input type="button" name="submitbtn" id="submitbtn" value="查询" /></p>
            </div>
        </form>

        <table width="100%" border="1"  cellspacing="0" cellpadding="0"  id=editProduct class="font14 skintable line35" >
            <tr align="center">
                <td width="29%"><strong>IP地址</strong></td>
                <td width="26%"><strong>登陆时间</strong></td>
                <td width="22%"><strong>会员名称</strong></td>
                <td width="23%"><strong>登陆网址</strong></td>
            </tr>
            <?php
            foreach ($rs as $key => $row) {
                ?>
                <tr onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" style="background-color:#FFFFFF;">
                    <td align="center"><?php echo $row['ip'] ?><br/><?php echo $row['ip_address'] ?></td>
                    <td align="center"><?php echo $row['login_time'] ?></td>
                    <td align="center"><a href="/#/member/user&uid=<?php echo $row['uid'] ?>"><?php echo $row['username'] ?></a></td>
                    <td align="center"><?php echo $row['www'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>

<script>
    function check() {
        if ($("#ip").val() == "" && $("#username").val() == "") {
            alert("登陆IP 和 会员名称 至少要填一样");
            return false;
        }
        return true;
    }
</script>

<script>
    $(function () {
        $('#submitbtn').bind('click', function (e) {
            location.href = $('#form1').attr('action') + "&" + $('#form1').serialize();
        });
    });
</script>