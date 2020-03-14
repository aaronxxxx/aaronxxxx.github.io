<main class="bgwhite">
<script src="/public/aomen/js/financial.js"></script>
    <?php if( $data['code'] == 1){ ?>
        <input type="hidden" name="" id="inputNavTitle" value="修改登入密码">
    <?php } elseif ($data['code'] == 2){ ?>
        <input type="hidden" name="" id="inputNavTitle" value="修改取款密码">
    <?php  } else{ ?>
        <input type="hidden" name="" id="inputNavTitle" value="">
    <?php } ?>
   <div class="userInfo">
        <form id="mdfPsdForm" class="mdfPsdForm" action="/?r=mobile/user/do-update-pwd&code=<?= $data['code']?>" method="post">
            <input class="mdfInput pt-2 pb-2" type="password" name="oldLoginpwd" id="oldLoginpwd" placeholder="  请输入当前密码">
            <div class="rg_err">
                    <div></div>
                    <span></span>
            </div>
            <input class="mdfInput pt-2 pb-2" type="password" name="newLoginpwd" id="newLoginpwd" placeholder="  设置新的密码">
            <div class="rg_err">
                    <div></div>
                    <span></span>
            </div>
            <input class="mdfInput pt-2 pb-2" type="password" name="rnewLoginpwd" id="rnewLoginpwd" placeholder="  输入确认密码">
            <div class="rg_err">
                    <div></div>
                    <span></span>
            </div>
            <div class="btn text-center" id="pwdBtn" onclick="changePwd();">提 交</div>
        </form>
    </div>
</main>