<body class="login">
    <section class="content">
        <div class="container">
            <nav>
                <div class="nav" role="tablist">
                    <a class="nav-item nav-link loginTab active" href="/?r=site/index/login" role="tab">登陸</a>
                    <a class="nav-item nav-link registerTab" href="/?r=site/index/reg" role="tab">註冊</a>
                </div>
            </nav>
            <div class="tab-content">
                <div class="tab-pane fade login show active" id="login" role="tabpanel">
                    <div class="group">
                        <form name="form1" id="myFORM" method="post">
                            <label class="form-group text" for="login_account">
                                <span class="label">請輸入用戶名</span>
                                <input class="input" id="login_account" type="text" required>
                            </label>
                            <label class="form-group text" for="login_password">
                                <span class="label">請輸入登入密碼</span>
                                <input class="input" id="login_password" type="password" required>
                            </label>
                            <label class="form-group text" id="check-code-wrapper">
                                <span class="label">請輸入驗證碼</span>
                                <input class="input" id="rmNum" type="text" autocomplete="off" required>
                                <img class="yzm" id="vPic" onclick="getKey()">
                            </label>
                            <input class="submit" id="login-box" type="button" value="登入">
                        </form>
                        <div class="line"></div>
                        <div class="note">
                            <div class="image"></div>
                            <p>如果您忘記密碼<br>
                                請聯繫服務人員</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>