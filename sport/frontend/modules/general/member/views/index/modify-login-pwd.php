<?php
use yii\helpers\Html;
?>

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
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var url_href = $('#MACenter').data('current')
        var anchor = $("#MALeft a");

        anchor.each(function() {
            if ($(this).attr('id') == url_href) {
                $(this).css({
                    "background": "linear-gradient(to left, #04A9FF, #2C7EEB, #04A9FF)",
                    "text-shadow": "0 0 2px rgba(0, 0, 0, 0.8)"
                });

                return false;
            }
        })
    })

    $('#MACenter').attr('data-current', 'myAccount');
</script>