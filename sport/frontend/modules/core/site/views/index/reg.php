<body class="login">
    <section class="content">
        <div class="container">
            <nav>
                <div class="nav" role="tablist">
                    <a class="nav-item nav-link loginTab" href="/?r=site/index/login" role="tab">登陸</a>
                    <a class="nav-item nav-link registerTab active" href="/?r=site/index/reg" role="tab">註冊</a>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane fade register show active" id="register" role="tabpanel">
                    <div class="group">
                        <form name="form1" id="myFORM" method="post">
                            <label class="form-group text">
                                <span class="label">請輸入用戶名</span>
                                <input id="reg_username" name="reg_username" type="text" maxlength="12" class="input" autocomplete="off" required autofocus>
                                <input id="is_user_name" type="hidden" value="1">
                            </label>
                            <label class="form-group text">
                                <span class="label">請輸入登入密碼</span>
                                <input id="reg_password" name="password" type="password" maxlength="12" class="input" required>
                            </label>
                            <label class="form-group text">
                                <span class="label">請確認登入密碼</span>
                                <input id="reg_passwd" name="repassword" type="password" maxlength="12" class="input" required>
                            </label>
                            <div class="form-group text">
                                <span class="label">取款密碼</span>
                                <div class="selectBox">
                                    <input type="number" id="pwd1" name="pwd1" min="0" max="9">
                                    <input type="number" id="pwd2" name="pwd2" min="0" max="9">
                                    <input type="number" id="pwd3" name="pwd3" min="0" max="9">
                                    <input type="number" id="pwd4" name="pwd4" min="0" max="9">
                                </div>
                            </div>
                            <label class="form-group text">
                                <span class="label">請輸入真實姓名</span>
                                <input id="real_name" name="real_name" type="text" maxlength="50" class="input" required>
                                <input id="is_real_name" type="hidden" value="1">
                            </label>
                            <label class="form-group text">
                                <span class="label">請輸入手機號碼</span>
                                <input id="phone" name="phone" type="text" maxlength="20" class="input" required>
                                <input id="is_phone" type="hidden" value="1">
                            </label>
                            <label class="form-group text">
                                <span class="label">請輸入電子信箱</span>
                                <input id="email" type="email" maxlength="256" class="input" required>
                                <input id="is_mail" type="hidden" value="1">
                            </label>
                            <label class="form-group text">
                                <div class="checkGroup">
                                    <input name="agree" id='check1' type="checkbox">
                                    <span>已滿18歲，且同意本站用戶註冊協議</span>
                                </div>
                            </label>
                            <label class="form-group text" id="check-code-wrapper">
                                <span class="label">請輸入驗證碼</span>
                                <input class="input" id="rmNum" type="text" autocomplete="off" required>
                                <img class="yzm" id="vPic" onclick="getKey()">
                            </label>
                            <input id="btn-submit" name="OK2" class="submit" type="button" value="註冊">
                        </form>
                        <div class="line"></div>
                        <div class="note">
                            <div class="image"></div>
                            <div>
                                <span>已擁有帳號？</span>
                                <a href="javascript:;" onclick="window.location.href='/?r=site/index/login'">登入</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>