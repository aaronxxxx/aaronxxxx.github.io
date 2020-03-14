<style>
    .ui-datepicker {
        font-size: 20px !important;
    }
</style>
<main>
    <input type="hidden" name="" id="inputNavTitle" value="财务中心">
    <input type="hidden" id="min_savemoney" value="<?= $min_huikuan_money; ?>">
    <link rel="stylesheet" href="/public/aomen/css/jquery-ui.min.css">
    <script src="/public/aomen/js/jqueryUi.min.js"></script>
    <script src="/public/aomen/js/financial.js"></script>
    <?php include 'member_top.php' ?>
    <div class="charge">
        <ul id="tab" class="tab d-flex justify-content-between pt-3 pb-3">
            <li class="chargeitem act">
                <a href="#online">
                    <div class="chargeitemInner text-center">在线支付</div>
                </a>
            </li>
            <?php if (!empty($tradition)) { ?>
                <li class="chargeitem">
                    <a href="#bank">
                        <div class="chargeitemInner text-center">银行汇款</div>
                    </a>
                </li>
            <?php }
                                                    if (!empty($zfb)) { ?>
                <li class="chargeitem">
                    <a href="#alipay">
                        <div class="chargeitemInner text-center">支付宝</div>
                    </a>
                </li>
            <?php }
                                                    if (!empty($weixin)) { ?>
                <li class="chargeitem">
                    <a href="#wechatpay">
                        <div class="chargeitemInner text-center">微信</div>
                    </a>
                </li>
            <?php }
                                                    if (!empty($cft)) { ?>
                <li class="chargeitem">
                    <a href="#qqpay">
                        <div class="chargeitemInner text-center">QQ钱包</div>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div id="tabinner" class="tabinner">
            <!-- 在線支付 -->
            <div id="online" class="tabinnerItem" style="display:block;">
                <ul>
                    <?php foreach ($urlarr as $val) { ?>
                        <li class="item">
                            <a href="<?= $val['payurl'] ?>"> <?= $val['pay_name'] ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- 在線支付end 銀行匯款 -->
            <div id="bank" class="tabinnerItem" style="display:none;">
                <?php if (!empty($tradition)) { ?>
                    <form id="form2" name="form2" action="/?r=member/remittance/remittancedo" method="post">
                        <ul class="inputArea">
                            <?php foreach ($tradition as $key => $value) {  ?>
                                <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                    <p>开户名:</p>
                                    <input type="text" value="<?php echo $value['bank_xm'] ?>" readonly="readonly">
                                    <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?php echo $value['bank_xm'] ?>');return;">
                                </li>
                                <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                    <p>银行名称:</p>
                                    <input type="text" value="<?php echo $value['bank_name'] ?>" readonly="readonly">
                                    <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?php echo $value['bank_name'] ?>');return;">
                                </li>
                                <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                    <p>银行帐号:</p>
                                    <input type="text" value="<?php echo $value['bank_number'] ?>" readonly="readonly">
                                    <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?php echo $value['bank_number'] ?>');return;">
                                </li>
                            <?php } ?>
                            <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                <p>汇款金额:</p>
                                <input type="text" placeholder="0.00" name="v_amount" id="amount">
                            </li>
                            <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                <p>汇款银行:</p>
                                <select class="inputSelect" id="IntoBank" name="IntoBank">
                                    <option value="" selected="selected">请选择转入银行</option>
                                    <option value="中国工商银行">中国工商银行</option>
                                    <option value="中国建设银行">中国建设银行</option>
                                    <option value="中国农业银行">中国农业银行</option>
                                    <option value="深圳发展银行">深圳发展银行</option>
                                    <option value="中信银行">中信银行</option>
                                    <option value="招商银行">招商银行</option>
                                    <option value="交通银行">交通银行</option>
                                    <option value="中国民生银行">中国民生银行</option>
                                    <option value="中国光大银行">中国光大银行</option>
                                    <option value="东亚银行">东亚银行</option>
                                    <option value="平安银行">平安银行</option>
                                    <option value="中国银行">中国银行</option>
                                    <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                                    <option value="兴业银行">兴业银行</option>
                                    <option value="广发银行">广发银行</option>
                                    <option value="华夏银行">华夏银行</option>
                                    <option value="浦发银行">浦发银行</option>
                                    <option value="渤海银行">渤海银行</option>
                                    <option value="宁波银行">宁波银行</option>
                                    <option value="北京银行">北京银行</option>
                                    <option value="南京银行">南京银行</option>
                                    <option value="上海银行">上海银行</option>
                                    <option value="北京农村信用社">北京农村信用社</option>
                                    <option value="浙商银行">浙商银行</option>
                                    <option value="杭州银行">杭州银行</option>
                                    <option value="上海农村商业银行">上海农村商业银行</option>
                                    <option value="南洋商业银行">南洋商业银行</option>
                                    <option value="河北银行">河北银行</option>
                                    <option value="支付宝">支付宝</option>
                                    <option value="其他">其他</option>
                                </select>
                            </li>
                            <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                <p>汇款日期:</p>
                                <input type="text" id="datepicker" name="cn_date">
                                <select id="hour" name="s_h">
                                    <?php for ($i = 1; $i < 24; $i++) {
                                                                                                                echo ('<option value="' . $i . '">' . $i . '</option>');
                                                                                                            } ?>
                                </select>
                                <span>时</span>
                                <select id="min" name="s_i">
                                    <?php for ($i = 1; $i < 60; $i++) {
                                                                                                                echo ('<option value="' . $i . '">' . $i . '</option>');
                                                                                                            } ?>
                                </select>
                                <span>分</span>
                                <input type="hidden" name="s_s" id="s_s" value="10">
                                <!--汇款时间-- 秒 -->
                                <input type="hidden" name="v_site" id="v_site" value="手机汇款">
                                <!--汇款地点-- 手机 -->
                                <input type="hidden" name="InType" id="InType" value="手机汇款">
                                <!--汇款方式-- 手机 -->
                            </li>
                            <li class="d-flex justify-content-start align-items-center inputitem text-end">
                                <p>汇款人名:</p>
                                <input type="text" name="v_Name" id="v_Name">
                            </li>
                            <li class="d-flex justify-content-start align-items-center inputitem text-end pr">
                                <p>验证码:</p>
                                <input type="text" name="vlcodes" id="vlcodes" size="5" maxlength="4" onfocus="next_checkNum_img()">
                                <img src="/?r=member/index/captcha" alt="点击更换" name="checkNum_img" id="checkNum_img" onclick="next_checkNum_img()" />
                            </li>
                        </ul>
                        <div class="btn">
                            <input type="button" id="hksubmit" class="text-center" value="开始充值">
                        </div>
                    </form>
                <?php } ?>
            </div>
            <!-- 銀行匯款end  支付寶-->
            <div id="alipay" class="tabinnerItem" style="display:none;">
                <?php if (!empty($zfb)) { ?>
                    <form id="form4" name="form4" action="/?r=mobile/financial/zfb" method="post">
                        <ul class="inputArea ">
                            <li class="d-flex inputitem text-end">
                                <p class="inputbox inputText" style="width: 100%;">
                                    请按住二维码三至五秒，把二维码存入手机相册，然后在支付宝打开扫一扫，从右上角相册选取。存完钱回到本页面提交。
                                </p>
                            </li>
                        </ul>
                        <?php foreach ($zfb as $key => $value) { ?>
                            <ul class="inputArea banks accordions">

                                <li class="d-flex inputitem banks-name">
                                    <p>银行名称:</p>
                                    <div class='inputbox'>
                                        <span><?= $value['bank_name'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <img src="/public/aomen/images/member/icon-arrows-down.png" alt="">
                                    </div>
                                </li>
                                <ul class="inpitArea banks-infos">
                                    <li class="d-flex inputitem">
                                        <p>银行名称:</p>
                                        <div class='inputbox'>
                                            <?= $value['bank_name'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_name'] ?>');return;">
                                        </div>
                                    </li>
                                    <li class="d-flex inputitem">
                                        <p>银行账号:</p>
                                        <div class='inputbox text-end'>
                                            <?= $value['bank_number'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_number'] ?>');return;">
                                        </div>
                                    </li>
                                    <li class="d-flex inputitem">
                                        <p>开户名:</p>
                                        <div class='inputbox text-end'>
                                            <span><?= $value['bank_xm'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_xm'] ?>');return;">
                                        </div>
                                    </li>

                                    <li class="d-flex inputitem">
                                        <p>二维码:</p>
                                        <div class='inputbox inputImg'><img id="QRcode" src="<?php echo $value['img_url']; ?>" alt="Smiley face" height="200" width="200" onmousedown="DownloadImage(this);" /></div>
                                    </li>
                                </ul>
                            </ul>
                        <?php } ?>
                        <ul class="inputArea banks-input">

                            <li class="d-flex inputitem">
                                <p>存款金额:</p>
                                <input type="text" id="zfb_PaySele" name="zfb_PaySele" placeholder="0.00" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')">
                            </li>
                            <li class="d-flex inputitem">
                                <p>支付宝:</p>
                                <input type="text" name="zfb_acc_val" id="zfb_acc_val" placeholder="输入会员支付宝账号">
                            </li>

                            <div class="btn">
                                <input type="button" id="zfbBtn" value="开始充值">
                            </div>
                        </ul>
                    </form>
                <?php } ?>
            </div>
            <!-- 支付寶end  微信 -->
            <div id="wechatpay" class="tabinnerItem" style="display:none;">
                <?php if (!empty($weixin)) { ?>
                    <form id="form3" name="form3" action="/?r=mobile/financial/wx" method="post">
                        <ul class="inputArea ">
                            <li class="d-flex inputitem text-end">
                                <p class="inputbox inputText" style="width: 100%;">
                                    请按住二维码三至五秒，把二维码存入手机相册，然后在支付宝打开扫一扫，从右上角相册选取。存完钱回到本页面提交。
                                </p>
                            </li>
                        </ul>
                        <?php foreach ($weixin as $key => $value) { ?>
                            <ul class="inputArea banks accordions">

                                <li class="d-flex inputitem banks-name">
                                    <p>银行名称:</p>
                                    <div class='inputbox'>
                                        <span><?= $value['bank_name'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <img src="/public/aomen/images/member/icon-arrows-down.png" alt="">
                                    </div>
                                </li>
                                <ul class="inpitArea banks-infos">
                                    <li class="d-flex inputitem">
                                        <p>银行名称:</p>
                                        <div class='inputbox'>
                                            <?= $value['bank_name'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_name'] ?>');return;">
                                        </div>
                                    </li>

                                    <li class="d-flex inputitem">
                                        <p>银行账号:</p>
                                        <div class='inputbox text-end'>
                                            <?= $value['bank_number'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_number'] ?>');return;">
                                        </div>
                                    </li>
                                    <li class="d-flex inputitem">
                                        <p>开户名:</p>
                                        <div class='inputbox text-end'>
                                            <span><?= $value['bank_xm'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_xm'] ?>');return;">
                                        </div>
                                    </li>

                                    <li class="d-flex inputitem text-end">
                                        <p>二维码<?php echo $key + 1; ?>:</p>
                                        <div class='inputbox inputImg'><img id="QRcode" src="<?php echo $value['img_url']; ?>" alt="Smiley face" height="200" width="200" onmousedown="DownloadImage(this);" /></div>
                                    </li>
                                </ul>
                            </ul>
                        <?php } ?>
                        <ul class="inputArea banks-input">
                            <li class="d-flex inputitem">
                                <p>存款金额:</p>
                                <input type="text" id="wx_PaySele" name="wx_PaySele" placeholder="0.00" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')">
                            </li>
                            <li class="d-flex inputitem">
                                <p>微信:</p>
                                <input type="text" id="wx_acc_val" placeholder="输入会员微信账号">
                            </li>

                            <div class="btn">
                                <input type="button" id="wxBtn" value="开始充值">
                            </div>
                        </ul>
                    </form>
                <?php } ?>
            </div>
            <!-- 微信end   qq支付-->
            <div id="qqpay" class="tabinnerItem" style="display:none;">
                <?php if (!empty($cft)) { ?>
                    <form id="form3" name="form3" action="/?r=mobile/financial/cft" method="post">
                        <ul class="inputArea ">
                            <li class="d-flex inputitem text-end">
                                <p class="inputbox inputText" style="width: 100%;">
                                    请按住二维码三至五秒，把二维码存入手机相册，然后在支付宝打开扫一扫，从右上角相册选取。存完钱回到本页面提交。
                                </p>
                            </li>
                        </ul>
                        <?php foreach ($cft as $key => $value) { ?>
                            <ul class="inputArea banks accordions">
                                <li class="d-flex inputitem banks-name">
                                    <p>银行名称:</p>
                                    <div class='inputbox'>
                                        <span><?= $value['bank_name'] ?></span>
                                    </div>
                                    <div class="icon">
                                        <img src="/public/aomen/images/member/icon-arrows-down.png" alt="">
                                    </div>
                                </li>
                                <ul class="inpitArea banks-infos">
                                    <li class="d-flex inputitem">
                                        <p>银行名称:</p>
                                        <div class='inputbox'>
                                            <?= $value['bank_name'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_name'] ?>');return;">
                                        </div>
                                    </li>
                                    <li class="d-flex inputitem">
                                        <p>银行账号:</p>
                                        <div class='inputbox text-end'>
                                            <?= $value['bank_number'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_number'] ?>');return;">
                                        </div>
                                    </li>
                                    <li class="d-flex inputitem">
                                        <p>开户名:</p>
                                        <div class='inputbox text-end'>
                                            <span><?= $value['bank_xm'] ?></span>
                                            <input type="button" class="copyBtn" value="复制" onclick="copyToClipBoard('<?= $value['bank_xm'] ?>');return;">
                                        </div>
                                    </li>

                                    <li class="d-flex inputitem text-end">
                                        <p>二维码<?php echo $key + 1; ?>:</p>
                                        <div class='inputbox inputImg'><img id="QRcode" src="<?php echo $value['img_url']; ?>" alt="Smiley face" height="200" width="200" onmousedown="DownloadImage(this);" /></div>
                                    </li>
                                </ul>
                            </ul>
                        <?php } ?>
                        <ul class="inputArea banks-input">

                            <li class="d-flex inputitem">
                                <p>存款金额:</p>
                                <input type="text" id="cft_PaySele" name="cft_PaySele" placeholder="0.00" onkeyup="this.value=this.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3')">
                            </li>
                            <li class="d-flex inputitem">
                                <p>财付通:</p>
                                <input type="text" id="cft_acc_val" placeholder="输入会员财付通账号">
                            </li>

                            <div class="btn">
                                <input type="button" id="cftBtn" value="开始充值">
                            </div>
                        </ul>
                    </form>
                <?php } ?>
            </div>
            <!-- qq支付end -->

            <script>
                var allPanels = $('.accordions > .banks-infos').hide();
                // $('.accordions:first-of-type > .banks-infos').show();
                console.log('123')
                $('.accordions > .banks-name').click(function() {
                    $(this).parent().siblings().children('.banks-infos').slideUp();
                    $(this).siblings('.banks-infos').slideDown();
                    $(this).parent().siblings().removeClass('active')
                    $(this).parent().addClass('active');
                    return false;
                });
            </script>
        </div>
    </div>
</main>
<script>
    // 控制member_top的tab
    $(function() {
        $('#finance .financeitem').eq(0).addClass('act').siblings().removeClass('act');
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
        });
    });

    function copyToClipBoard(msg) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(msg).select();
        document.execCommand("copy");
        $temp.remove();
        alert("已複製至您的剪貼簿。");
    }
</script>