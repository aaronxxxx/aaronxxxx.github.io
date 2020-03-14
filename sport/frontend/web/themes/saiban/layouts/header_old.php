<!DOCTYPE html>
<html>

<head>
    <title>预言家娱乐城</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="https://cdn.weibo-hk.com/Web.Portal/EB004-01.Portal/Content/Views/Shared/images/favicon.ico" />
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/font-awesome5.min.css" rel="stylesheet" />
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/site.css" rel="stylesheet" />
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/custom.css" rel="stylesheet" />
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/aos.css" rel="stylesheet" />
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/swiper.min.css" rel="stylesheet" />
    <link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/style.css" rel="stylesheet" />
</head>

<body class="layout">

    <header id="header" class="header">
        <div class="header-wrapper">
            <a href="./" class="header-logo">
                <img src="<?= Yii::getAlias('@themeRoot') ?>/assets/images/sport/logo.png" alt="">
            </a>
            <div class="header-account">
                <div id="account-box">
                    <div id="loginbox">
                        <form name="LoginForm" id="LoginForm" action="javascript:void(0);" method="post">
                            <div class="form-group">
                                <div class="form-inline form-group-item">
                                    <input id="login_account" type="text" placeholder="帐号" required autofocus />
                                    <div class="account-btn">
                                        <a href="javascript:void(0)" onclick="Go_forget_pwd()" class="forget-btn">忘记帐号？</a>
                                    </div>
                                </div>
                                <div class="form-inline form-group-item">
                                    <input id="login_password" type="password" placeholder="密码" required />
                                    <div class="account-btn">
                                        <a href="javascript:void(0)" onclick="Go_forget_pwd()" class="forget-btn">忘记密码？</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="check-code-wrapper" class="form-group-item">
                                    <input id="rmNum" type="text" placeholder="验证码" autocomplete="off" required />
                                    <img id="vPic" onclick="getKey();" />
                                </div>
                                <div class="btn-wrapper form-group-item">
                                    <button id="login-box" class="login-btn">登入</button>
                                    <button id="reg-btn" class="reg-btn" type="button">注册</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="userinfoss" style="display:none;">
                        <ul id="account-nav">
                            <li>
                                <a href="javascript: openUCWindow('/?r=member/withdraw/index', '线上取款');" title="线上取款">线上取款</a>
                            </li>
                            <li class="deposit">
                                <a href="javascript: openUCWindow('/?r=member/deposit/index', '线上存款');" title="线上存款">线上存款</a>
                            </li>
                            <li class="transaction">
                                <a href="javascript: openUCWindow('/?r=member/transaction-log/bank', '交易纪录');" title="交易纪录">交易纪录</a>
                            </li>
                            <li class="changempw" title="修改取款密碼">
                                <a href="javascript: openUCWindow('/?r=member/index/modify-withdraw-pwd', '修改取款密码');" title="修改取款密码">修改取款密码</a>
                            </li>
                        </ul>
                        <ul id="account-info">
                            <li>
                                帐号 :
                                <span id="user_name" class="account"></span>
                            </li>
                            <li>
                                帐户余额 :
                                <span id="user_money" class="account"></span>
                            </li>
                            <div id="action-box">
                                <a class="login-btn login_out" href="javascript:void(0);">登出</a>
                                <a href="javascript: openUCWindow('/?r=member/index/index', '会员中心');" title="会员中心" class="reg-btn">会员中心</a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>