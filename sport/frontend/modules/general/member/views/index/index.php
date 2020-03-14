<div id="MACenterContent">
    <div class="USER_box">
        <div class="USER_box_left">
            <span>
                <?php echo $user['name']; ?>
            </span>
        </div>
        <div class="USER_box_right">
            <div class="USER_moneybox">
                <span>餘額：</span>
                <h2>
                    <?php echo $user['money']; ?>
                </h2>
            </div>
            <ul>
                <li><a href="/?r=member/index/modify-login-pwd">修改密碼</a></li>
                <li><a href="/?r=member/index/modify-withdraw-pwd">修改取款密碼</a></li>
                <li><a href="javascript:void(0)" class="USER_logout login_out">登出</a></li>
            </ul>
            <span style="display:block;text-align:center;color:#fff;">
                <?php echo $user['login_time']; ?>
            </span>
        </div>

    </div>
</div>

<script>
    $('#MACenter').attr('data-current', 'myAccount');
    //登出
	$('.login_out').click(function () {
		$.post('/?r=passport/user-api/logout', {},
			function (rst) {
                // window.location.reload();
                window.location.href = '/?r=site/index';
			},
			"html");
	})
</script>