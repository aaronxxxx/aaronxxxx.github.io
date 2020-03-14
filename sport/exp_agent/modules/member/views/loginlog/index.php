<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>登錄IP列表頁面</title>
    </head>


    <body>
        <form id="form1" name="form1" method="post" action="?r=member/loginlog/search" onsubmit="return check();" class="trinput  font13 pd10">      
            <div class="chaxunip">

                <p>
                    <span>請您輸入要查詢的IP：</span>
                    <textarea name="ip" cols="80" rows="2" id="ip"><?php echo $ip ?></textarea>

                    <label>多個IP可以用以,隔開</label>
                </p>

                <p>
                    <span>請輸入查詢會員名稱：</span>

                    <textarea name="username" cols="80" rows="2" id="username"><?php echo $username; ?></textarea>

                    <label>多個會員可用,隔開</label></td>

                </p>
                <p> <input type="button" name="submitbtn" id="submitbtn" value="查詢" /></p>
            </div>
        </form>

        <table width="100%" border="1"  cellspacing="0" cellpadding="0"  id=editProduct class="font14 skintable line35" >
            <tr align="center">
                <td width="29%"><strong>IP</strong></td>
                <td width="26%"><strong>登錄時間</strong></td>
                <td width="22%"><strong>會員名稱</strong></td>
                <td width="23%"><strong>登錄網址</strong></td>
            </tr>
            <?php
            foreach ($rs as $key => $row) {
                ?>
                <tr onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" style="background-color:#FFFFFF;">
                    <td align="center"><?php echo $row['ip'] ?><br/><?php echo $row['ip_address'] ?></td>
                    <td align="center"><?php echo $row['login_time'] ?></td>
                    <td align="center"><a href="?r=member/user&uid=<?php echo $row['uid'] ?>"><?php echo $row['username'] ?></a></td>
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
            alert("登錄IP 和 會員名稱 至少要填一樣");
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