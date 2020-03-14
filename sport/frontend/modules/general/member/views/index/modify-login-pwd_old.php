<?php

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="/public/member/css/modify-pwd.css" rel="stylesheet" type="text/css" /> -->
    <link href="/public/member/css/standard.css" rel="stylesheet" type="text/css" />
    <link href="/public/member/css/web.css?332255?332244" rel="stylesheet" type="text/css" />
    <script src="/public/member/js/jquery-1.7.2.min.js"></script>
    <script src="/public/member/js/web.js"></script>
    <script src="/public/member/js/modify-pwd.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <div id="MACenter">
        <div id="MAContent">
            <div id="MAHeader">
                <div class="welcom_text">会员中心</div>
                <div id="est_bg">
                    北京时间：
                    <span id="EST_reciprocal"></span>
                </div>
            </div>

            <div id="MAMain">
                <div id="MACenterContent">
                    <div class="USER_box">
                        <div class="USER_box_left">
                            <span>
                                修改登入密码
                            </span>
                        </div>
                        <div class="USER_box_right">
                            <div class="tittlebox">
                                <a href="/?r=member/index/index"></a>
                                <h2>请输入密码</h2>
                            </div>
                            <?php $this->beginBody() ?>
                            <form id="JS-forgetpwd-form" name="chgFORM" method="post" onsubmit="return SubChk(6);">
                                <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">

                                <div class="user_table">
                                    <p class="error_tex pad_top20">
                                        *密码规则：须为6~12码英文或数字且符合0~9或a~z字符
                                    </p>
                                    <input name="pwd_old" type="password" placeholder="旧密码" size="12" maxlength="12" />
                                    <input name="pwd" type="password" placeholder="新密码" size="12" maxlength="12" />
                                    <input name="pwd_confirm" type="password" placeholder="确认新密码" maxlength="12" size="12" />
                                    <p class="error_tex"><?= Html::encode($msg) ?></p>
                                    <div class="twobtn_box">
                                        <a class="back_btn" href="/?r=member/index/index">取消</a>
                                        <input class="confirm_btn" type="submit" name="OK" value="确认" />
                                    </div>
                                </div>
                            </form>
                            <?php $this->endBody() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="MALeft">
            <div class="sidebar">
                <div id="sidebar-mem"></div>
                <a href="/?r=member/index/index" id="myAccount" class="">
                    我的帐户
                </a>
                <a href="/?r=member/remittance/index" id="mytransaction" class="">
                    银行交易
                </a>
                <a href="/?r=member/remittance/index2" id="myothrt_pay" class="">
                    其他支付
                </a>
                <a href="/?r=member/transaction-log/bank" id="myrecord" class="">
                    交易记录
                </a>
            </div>
            <div class="sidebar">
                <div id="sidebar-pay"></div>
                <a href="/?r=member/deposit/index" id="online_in">线上存款</a>
                <!-- <div id="MADeposit" onmouseover="mover(this);" onmouseout="mout(this);">
                    <a href="/?r=member/deposit/index">线上存款</a>
                </div> -->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var url_href = $('#MACenter').data('current')
            // var _url_href = window.location.href;
            // var url_href = '/?r=' + _url_href.split('?r=', 2).pop();
            var anchor = $("#MALeft a");
            console.log(url_href);
            anchor.each(function() {
                if ($(this).attr('id') == url_href) {
                    $(this).css({
                        "background": "linear-gradient(to left, #04A9FF, #2C7EEB, #04A9FF)",
                        "text-shadow": "0 0 2px rgba(0, 0, 0, 0.8)"
                    });
                    // $(this).attr('data-active', 'active');
                    return false;
                }
            })
        })
        $('#MACenter').attr('data-current', 'myAccount');
    </script>
</body>

</html>

<?php $this->endPage() ?>