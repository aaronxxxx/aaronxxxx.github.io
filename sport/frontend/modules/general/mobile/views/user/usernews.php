<main style="background:#f2f2f2">
    <input type="hidden" name="" id="inputNavTitle" value="贵宾资料">
    <div class="userInfo">
        <ul>
            <li class="item d-flex">
                <p class="label text-end">帐号:</p>
                <p class="text"><?= $user['user_name']?></p>
            </li>
            <li class="item d-flex">
                <p class="label text-end">姓名:</p>
                <p class="text"><?= $user['pay_name']?></p>
            </li>
            <li class="item d-flex">
                <p class="label text-end">馀额:</p>
                <p class="text"><?= $user['money']?></p>
            </li>
            <li class="item d-flex">
                  <p class="label text-end">会员等级:</p>
                <p class="text"><?= $user['pay_name']?></p>
            </li>
            <li class="item d-flex">
                <p class="label text-end">银行类型:</p>
                <p class="text"><?= $user['pay_bank']?></p>
            </li>
            <li class="item d-flex">
                <p class="label text-end">卡号:</p>
                <p class="text"><?= $user['pay_num']?></p>
            </li>
            <li class="item d-flex">
                <p class="label text-end">开户行:</p>
                <p class="text"><?= $user['pay_address']?></p>
            </li>
            <li class="item d-flex">
                <p class="label text-end">登录密码:</p>
                <a class="a_text" href="/?r=mobile/user/update-pwd&code=1">修改密码</a>
            </li>
            <li class="item d-flex">
                <p class="label text-end">取款密码:</p>
                <a class="a_text" href="/?r=mobile/user/update-pwd&code=2">修改密码</a>
            </li>
        </ul>
        <div class="btn" onclick="javascript:location.href='/?r=mobile/user/logout'">
            <input type="button" value="安全退出" onclick="">
        </div>
    </div>
</main>