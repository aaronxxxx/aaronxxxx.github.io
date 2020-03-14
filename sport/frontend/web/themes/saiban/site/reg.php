<link href="<?= Yii::getAlias('@themeRoot') ?>/assets/css/register.css" rel="stylesheet" />
<style>
    #banner {
        background: #272f3a url("<?= Yii::getAlias('@themeRoot') ?>/assets/images/banner-reg.jpg") no-repeat center center;
        background-size: cover;
    }

    #content {
        padding-top: 0;
    }
</style>
<script>
    $(function() {
        var register_phone = "<?php echo $register_phone; ?>";
        var register_qq = "<?php echo $register_qq; ?>";
        var register_email = "<?php echo $register_email; ?>";
        var register_name = "<?php echo $register_name; ?>";
        if (register_phone != "1") {
            $('#js-phone').hide();
            $('#is_phone').val('2');
        }
        if (register_qq != "1") {
            $('#js-qq').hide();
            $('#is_qq').val('2');
        }
        if (register_email != "1") {
            $('#js-email').hide();
            $('#is_email').val('2');
        }
        if (register_name == "1") {
            uniqueUserRealName();
        }
        /* 修改從url get agentname
        getAgentsInfo();*/
        $('.agree.is-checked i').click(function() {
            if ($('.agree.is-checked i').css("background-color") == 'rgb(88, 88, 88)') {
                $('.agree.is-checked i').css("background-color", "rgb(200, 200, 200)");
            } else {
                $('.agree.is-checked i').css("background-color", "rgb(88, 88, 88)");
            }
        })
    })
    /**
     * 获取代理信息
     * @returns {}
     */
    function getAgentsInfo() {
        $.post("/?r=passport/user-api/agents", {},
            function(rst) {
                $("#agent_name").val(rst.data.user.agents_name);
            },
            "json");
    }

    function uniqueUserRealName() {
        $("#real_name").bind('input propertychange', function() {
            var v = $("#real_name").val();
            $.get("/?r=passport/user-api/unique-user-real-name", {
                name: v,
            }, function(r) {
                if (r.code == 0) { //不存在相同真实姓名
                    $('#is_real_name').val('1'); //注册凭证，不可删除
                    //页面变化自己写
                    if (v == "") {
                        $(".realremind").html('必须与提款的银行户口相同，否则无法提款').css('color', 'red');
                    } else {
                        $(".realremind").html('真实姓名可注册').css('color', 'green');
                    }
                } else { //存在相同真实姓名
                    $('#is_real_name').val('2'); //注册凭证，不可删除
                    //页面变化自己写
                    $(".realremind").html('真实姓名已存在！').css('color', 'red');
                }
            }, "json");
        });
    }
</script>
<?php require('kf.php') ?>
<div id="content">
    <div class="wrapper">
        <div id="register">
            <div class="reg-banner"></div>
            <div class="reg-right">
                <div>
                    <form class="form-horizontal" name="form1" id="myFORM" method="post">
                        <fieldset class="first-child">
                            <legend>账户注册</legend>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    会员帐号
                                </label>
                                <div class="control-div">
                                    <input id="reg_username" name="reg_username" type="text" maxlength="12" class="form-control" placeholder="4 - 12 字元，限英文、数字" required autofocus />
                                    <input id="is_user_name" type="hidden" value="1">
                                </div>
                                <div class="control-info remind">4 - 12 字元，限英文、数字</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    会员密码
                                </label>
                                <div class="control-div">
                                    <input id="reg_password" name="password" type="password" maxlength="12" class="form-control" placeholder="6 - 12 字元，限英文、数字" required />
                                </div>
                                <div class="control-info reminds">6 - 12 字元，限英文、数字</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    确认密码
                                </label>
                                <div class="control-div">
                                    <input id="reg_passwd" name="repassword" type="password" maxlength="12" class="form-control" placeholder="请再次确认密码" required />
                                </div>
                                <div class="control-info remindss">请再次确认密码</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    取款密码
                                </label>
                                <div class="control-div">
                                    <div class="selectBox">
                                        <select name="pwd1" id="pwd1">
                                            <option label="-" value="-" selected="selected">-</option>
                                            <option label="0" value="0">0</option>
                                            <option label="1" value="1">1</option>
                                            <option label="2" value="2">2</option>
                                            <option label="3" value="3">3</option>
                                            <option label="4" value="4">4</option>
                                            <option label="5" value="5">5</option>
                                            <option label="6" value="6">6</option>
                                            <option label="7" value="7">7</option>
                                            <option label="8" value="8">8</option>
                                            <option label="9" value="9">9</option>
                                        </select>
                                        <select name="pwd2" id="pwd2">
                                            <option label="-" value="-" selected="selected">-</option>
                                            <option label="0" value="0">0</option>
                                            <option label="1" value="1">1</option>
                                            <option label="2" value="2">2</option>
                                            <option label="3" value="3">3</option>
                                            <option label="4" value="4">4</option>
                                            <option label="5" value="5">5</option>
                                            <option label="6" value="6">6</option>
                                            <option label="7" value="7">7</option>
                                            <option label="8" value="8">8</option>
                                            <option label="9" value="9">9</option>
                                        </select>
                                        <select name="pwd3" id="pwd3">
                                            <option label="-" value="-" selected="selected">-</option>
                                            <option label="0" value="0">0</option>
                                            <option label="1" value="1">1</option>
                                            <option label="2" value="2">2</option>
                                            <option label="3" value="3">3</option>
                                            <option label="4" value="4">4</option>
                                            <option label="5" value="5">5</option>
                                            <option label="6" value="6">6</option>
                                            <option label="7" value="7">7</option>
                                            <option label="8" value="8">8</option>
                                            <option label="9" value="9">9</option>
                                        </select>
                                        <select name="pwd4" id="pwd4">
                                            <option label="-" value="-" selected="selected">-</option>
                                            <option label="0" value="0">0</option>
                                            <option label="1" value="1">1</option>
                                            <option label="2" value="2">2</option>
                                            <option label="3" value="3">3</option>
                                            <option label="4" value="4">4</option>
                                            <option label="5" value="5">5</option>
                                            <option label="6" value="6">6</option>
                                            <option label="7" value="7">7</option>
                                            <option label="8" value="8">8</option>
                                            <option label="9" value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-info">请输入取款密​​码</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    出入金方式
                                </label>
                                <div class="control-div">
                                    <div class="selectBox">
                                        <select name="trade_type" id="trade_type">
                                            <option label="-" value="-" selected="selected">-</option>
                                            <option label="USDT" value="1">USDT</option>
                                            <option label="ETH_USDT" value="2">ETH_USDT</option>
                                            <option label="其他" value="3">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-info remindss">请选择交易方式</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    推荐代码
                                </label>
                                <div class="control-div">
                                    <input type="text" id="agent_name" name="agent_name" class="form-control" value="<?= $agentname ?: null ?>" <?= $agentname ? 'readonly' : null ?>>
                                </div>
                                <div class="control-info">限英文、数字，如无请留空</div>
                            </div>
                        </fieldset>
                        <fieldset id="fieldset-more-option" style="display: none">
                            <legend>会员资料</legend>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    真实姓名
                                </label>
                                <div class="control-div">
                                    <input id="real_name" name="real_name" type="text" maxlength="50" class="form-control" placeholder="必须与提款的银行户口相同，否则无法提款" required />
                                    <input id="is_real_name" type="hidden" value="1">
                                </div>
                                <div class="control-info realremind">必须与提款的银行户口相同，否则无法提款</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    手机号码
                                </label>
                                <div class="control-div">
                                    <input id="phone" name="phone" type="text" maxlength="20" class="form-control" placeholder="请输入您的手机号码" required />
                                    <input id="is_phone" type="hidden" value="1">
                                </div>
                                <div class="control-info reminding">请输入您的手机号码</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    QQ号码
                                </label>
                                <div class="control-div">
                                    <input id="qq" name="qq" type="text" maxlength="20" class="form-control" placeholder="请输入您的QQ号码" required />
                                </div>
                                <div class="control-info remindt">请输入您的QQ号码</div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">
                                    <i class="fa fa-star fa-required"></i>
                                    电子邮箱
                                </label>
                                <div class="control-div">
                                    <input id="email" type="email" maxlength="256" class="form-control" placeholder="请输入您的电子邮箱" required />
                                    <input id="is_mail" type="hidden" value="1">
                                </div>
                                <div class="control-info remindh">请输入您的电子邮箱</div>
                            </div>
                        </fieldset>
                        <fieldset class="last-fieldset">
                            <div class="form-group">
                                <div class="control-div">
                                    <label>
                                        <input name="agree" id='check1' type="checkbox" />
                                        已满18岁，且同意本站
                                    </label>
                                    <a class="agreement">用户注册协议</a>
                                </div>
                            </div>
                            <div class="btnGrounp">
                                <button id="btn-submit" name="OK2" class="btn btn-default">立即注册</button>
                                <button id="btn-reset" type="reset">重置</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>