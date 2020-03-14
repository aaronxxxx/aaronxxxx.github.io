<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <input type="hidden" id="min_money" value="<?= $min_money; ?>">
    <script src="/public/aomen/js/financial.js"></script>
    <?php include 'member_top.php' ?>
    <div class="charge">
        <form name="tikuanform" id="tikuanform" method="post" action="">
            <ul class="drawForm text-center">
                <li class="title">请填写提现表单</li>
                <li class="inputitem"><input type="password" name="qk_pwd" id="qk_pwd" placeholder="请输入取款密码" tabindex="1" maxlength="20"></li>
                <li class="inputitem"><input type="text" name="pay_value" id="pay_value" placeholder="最低取款金额:<?= $min_money; ?>" tabindex="2" maxlength="15"></li>
                <li class="inputitem pr"><input type="text" id="yzm2" tabindex="3" name="vlcodes" placeholder="验证码"><img src="/?r=member/index/captcha" alt="点击更换" name="checkNum_img" id="checkNum_img" onclick="next_checkNum_img()" /></li>
            </ul>
            <div class="btnArea">
                <div class="btn">
                    <input type="button" onclick="check_submit2()" value="提交表单">
                </div>
            </div>
        </form>
    </div>

</main>
<script>
    // 控制member_top的tab
    $(function() {
        $('#finance .financeitem').eq(1).addClass('act').siblings().removeClass('act');
    });
</script>