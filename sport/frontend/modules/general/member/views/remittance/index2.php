<html>

<head>
    <title>其他支付</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/jquery-1.7.2.min.js"></script>
    <script language="javascript" type="text/javascript">
        var getId = function(Id) {
            return document.getElementById(Id);
        }

        function next_checkNum_img() {
            var verify = document.getElementById('checkNum_img');
            verify.setAttribute('src', '/?r=member/index/captcha&' + Math.random());
            return false;
        }

        //数字验证 过滤非法字符
        function clearNoNum(obj) {
            //先把非数字的都替换掉，除了数字和.
            obj.value = obj.value.replace(/[^\d.]/g, "");
            //必须保证第一个为数字而不是.
            obj.value = obj.value.replace(/^\./g, "");
            //保证只有出现一个.而没有多个.
            obj.value = obj.value.replace(/\.{2,}/g, ".");
            //保证.只出现一次，而不能出现两次以上
            obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
            if (obj.value != '') {
                var re = /^\d+\.{0,1}\d{0,2}$/;
                if (!re.test(obj.value)) {
                    obj.value = obj.value.substring(0, obj.value.length - 1);
                    return false;
                }
            }
        }

        function showType() {
            if (getId('InType').value == '0') {
                getId('v_type').style.display = '';
            } else if (getId('InType').value == 'WX') {
                getId('v_Name').placeholder = '请输入微信帐号';
                getId('IntoBank').value = "微信";
                getId('IntoType').value = getId('InType').value;
                getId('zfgxm').style.display = "flex";
            } else if (getId('InType').value == 'ZFB') {
                getId('tr_v').style.display = '';
                getId('v_Name').placeholder = '请输入支付宝帐号';
                getId('IntoBank').value = "支付宝";
                getId('IntoType').value = getId('InType').value;
                getId('zfgxm').style.display = "flex";
            } else if (getId('InType').value == 'CFT') {
                getId('tr_v').style.display = '';
                getId('v_Name').placeholder = '请输入财付通帐号';
                getId('IntoBank').value = "财付通";
                getId('IntoType').value = getId('InType').value;
                getId('zfgxm').style.display = "flex";
            } else if (getId('InType').value == 'UNI') {
                getId('tr_v').style.display = '';
                getId('v_Name').placeholder = '请输入云闪付帐号';
                getId('IntoBank').value = "云闪付";
                getId('IntoType').value = getId('InType').value;
                getId('zfgxm').style.display = "flex";
            } else {
                getId('IntoType').value = getId('InType').value;
            }
        }

        function SubInfo() {
            var m = <?php echo $min_huikuan_money; ?>;
            var hk = getId('v_amount').value;
            if (hk == '') {
                alert('请输入转账金额');
                getId('v_amount').focus();
                return false;
            } else {
                hk = hk * 1;
                if (hk < m) {
                    alert("转账金额最底为" + m + "元");
                    getId('v_amount').select();
                    return false;
                }
            }
            if (getId('IntoBank').value == '') {
                alert('为了更快确认您的转账,请选择转入银行');
                return false;
            }
            if (getId('cn_date').value == '') {
                alert('请选择汇款日期');
                return false;
            }
            if (getId('InType').value == '') {
                alert('为了更快确认您的转账,请选择汇款方式');
                return false;
            }
            if (getId('InType').value == '0') {
                if (getId('v_type').value != '' && getId('v_type').value != '请输入其它汇款方式') {
                    getId('IntoType').value = getId('v_type').value;
                } else {
                    alert('请输入其它汇款方式');
                    return false;
                }
            }
            if (getId('InType').value == 'WX') {
                if (getId('v_Name').value != '' && getId('v_Name').value != '请输入微信帐号' && getId('v_Name').value.length > 1 && getId('v_Name').value.length < 20) {

                } else {
                    alert('为了更快确认您的转账,请微信帐号信息');
                    return false;
                }
                if (getId('v_name2').value == '' && getId('v_name2').value.length > 20) {
                    alert('为了更快确认您的转账,请输入支付方姓名');
                    return false;
                }
            }
            if (getId('InType').value == 'ZFB') {
                if (getId('v_Name').value != '' && getId('v_Name').value != '请输入支付宝帐号' && getId('v_Name').value.length > 1 && getId('v_Name').value.length < 20) {

                } else {
                    alert('为了更快确认您的转账,请输入支付宝帐号信息');
                    return false;
                }
                if (getId('v_name2').value == '' && getId('v_name2').value.length > 20) {
                    alert('为了更快确认您的转账,请输入支付方姓名');
                    return false;
                }
            }
            if (getId('InType').value == 'CFT') {
                if (getId('v_Name').value != '' && getId('v_Name').value != '请输入财付通帐号' && getId('v_Name').value.length > 1 && getId('v_Name').value.length < 20) {

                } else {
                    alert('为了更快确认您的转账,请输入财付通帐号信息');
                    return false;
                }
                if (getId('v_name2').value == '' && getId('v_name2').value.length > 20) {
                    alert('为了更快确认您的转账,请输入财付通姓名');
                    return false;
                }
            }
            if (getId('InType').value == 'UNI') {
                if (getId('v_Name').value != '' && getId('v_Name').value != '请输入云闪付帐号' && getId('v_Name').value.length > 1 && getId('v_Name').value.length < 20) {

                } else {
                    alert('为了更快确认您的转账,请输入云闪付帐号信息');
                    return false;
                }
                if (getId('v_name2').value == '' && getId('v_name2').value.length > 20) {
                    alert('为了更快确认您的转账,请输入云闪付姓名');
                    return false;
                }
            }
            if (getId('vlcodes').value == '') {
                alert('请输入验证码');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "/?r=member/remittance/remittancedo",
                data: $('#form1').serialize(),
                dataType: "json",
            }).done(function(result) {
                if (result.status) {
                    alert('提交成功！');
                    window.location.href = "/?r=member/transaction-log/bank&type=hk";
                } else {
                    alert(result.msg);
                    window.location.href = "/";
                }
            }).fail(function(error) {
                alert(error.responseText);
            });
        }

        function currenTime() {
            var curDate = new Date();
            var curHours = curDate.getHours();
            var curMinutes = curDate.getMinutes();
            var curSeconds = curDate.getSeconds();
            $("#s_h").val(curHours);
            $("#s_i").val(curMinutes);
            $("#s_s").val(curSeconds);
        }
        setTimeout('currenTime()');
        $(function() {
            $(".d-btn").click(function() {
                $('#InType').val($(this).attr('in-data'));
                btn_index = $(this).parent('li').index();
                if ($(".sm_hide").eq(btn_index).css('display') == 'none') {
                    $(".sm_hide").eq(btn_index).show().siblings(".sm_hide").hide();
                } else {
                    $(".sm_hide").hide();
                }
                showType();
                $(this).toggleClass("btn_color").parent().siblings().children().removeClass("btn_color");
                $(this).siblings().toggleClass("down_icon").parent().siblings().children().removeClass("down_icon");

            })
            // alert("亲爱的贵宾请注意\r公司银行帐号不定期更换\r请每次存款前，务必先至 [公司入款] 查看账号\r入款至已过期帐号，公司无法查收，恕不负责！");
            $(".d-btn").eq(0).click()
        })
    </script>
</head>

<body>
    <div id="MACenterContent">
        <div class="MNav">
            <a href="/?r=member/live/index" class="mbtn">额度转换</a>
            <a href="/?r=member/deposit/index" class="mbtn">线上存款</a>
            <a href="/?r=member/remittance/index" class="mbtn">银行汇款</a>
            <span class="mbtn active">其他支付</span>
            <a href="/?r=member/withdraw/index" class="mbtn">线上取款</a>
        </div>
        <div id="MMainData" class="pay_cont">
            <div class="title_box">
                <h2>- 汇款转账详细账户资料 -</h2>
                <div class="title_table">
                    <table class="rwd-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>支付类型</th>
                            <th>银行名称</th>
                            <th>银行帐号</th>
                            <th>开户名</th>
                            <th>开户行所在城市</th>
                        </tr>
                        <?php
                        foreach ($arr as $key => $value) {
                            if ($value['bank_type'] == 1) {
                            } else {
                        ?>
                                <tr class="table_cont">
                                    <td data-th="支付类型">
                                        <?php
                                        switch ($value['bank_type']) {
                                            case 2:
                                                echo "微信";
                                                break;
                                            case 3:
                                                echo "支付宝";
                                                break;
                                            case 4:
                                                echo "财付通";
                                                break;
                                            case 5:
                                                echo "云闪付";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td data-th="银行名称"><?= $value['bank_name'] ?></td>
                                    <td data-th="银行帐号">
                                        <span class="copy_text" type="text" data-clipboard-target="data-clipboard-target"><?= $value['bank_number'] ?></span>
                                        <button class="copy_btn" type="button" data-clipboard="data-clipboard">複製</button>
                                    </td>
                                    <td data-th="开户名">
                                        <span class="copy_text" type="text" data-clipboard-target="data-clipboard-target"><?= $value['bank_xm'] ?></span>
                                        <button class="copy_btn" type="button" data-clipboard="data-clipboard">複製</button>
                                    </td>
                                    <td data-th="开户行所在城市"><?= $value['bank_city'] ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <script>
                            $.extend({
                                clipboard: function(btn, target) {
                                    $(btn).on('click', function() {
                                        var tagName = $(this).siblings(target).prop("tagName");
                                        if (tagName == "INPUT") {
                                            var target_value = $(this).siblings(target);
                                            $(this).siblings(target).select();
                                            document.execCommand("Copy");
                                            alert("Copied the text: " + target_value.val());
                                        } else {

                                            var target_value = $(this).siblings(target);
                                            $('body').append('<input type="text" name="copytext" value="' + target_value.text() + '" style="position: absolute; width: 1px; height: 1px; padding: 0; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;" />');
                                            $('input[name="copytext"]').select();
                                            document.execCommand("Copy");
                                            alert("已复制: " + target_value.text());
                                        }
                                    })
                                    return btn, target;
                                }
                            });
                            $.clipboard("[data-clipboard]", "[data-clipboard-target]");
                        </script>
                    </table>
                </div>
            </div>
            <div>
                <ul class="all_link_box">
                    <?php if (!empty($weixin)) { ?>
                        <li class="w25">
                            <a href="javascript:void(0)" class="d-btn green-wechat" in-data="WX"><span class="green-wechat-icon">微信扫码支付</span></a>
                            <span></span>
                        </li>
                    <?php }
                    if (!empty($zfb)) { ?>
                        <li class="w25">
                            <a href="javascript:void(0)" class="d-btn LightBlue-alipay" in-data="ZFB"><span class="LightBlue-alipay-icon">支付宝扫码支付</span></a>
                            <span></span>
                        </li>
                    <?php }
                    if (!empty($cft)) { ?>
                        <li class="w25">
                            <a href="javascript:void(0)" class="d-btn Cft" in-data="CFT"><span class="Cft-icon">财付通扫码支付</span></a>
                            <span></span>
                        </li>
                    <?php }
                    if (!empty($uni)) { ?>
                        <li class="w25">
                            <a href="javascript:void(0)" class="d-btn Uni" in-data="UNI"><span class="Uni-icon">云闪付扫码支付</span></a>
                            <span></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="main_box">
                <div class="ps_textbox">
                    <br>
                    <h3>温馨提示：</h3>
                    <p>一、请在金额转出之后务必填写网页下方的汇款信息表格，以便我们财务人员能及时为您确认添加金额到您的会员账户。</p>
                    <p>二、本公司最低汇款金额为<?php echo $min_huikuan_money; ?>元，公司赠送银行汇款红利给会员（例:汇款金额10万元赠送1%即1000元，按百赠送）。</p>
                    <p>三、如您是跨行转帐，请您在转帐时选择跨行快速汇款或跨行加急汇款（避免公司不能及时查收您的款项）。</p>
                </div>
            </div>
            <div class="btn-group">

                <?php if (!empty($weixin)) { ?>
                    <!-- 微信支付二維顯示 -->
                    <div class="qrcode-box sm_hide" style="display:none">
                        <div class="leftbox">
                            <div>
                                <?php
                                foreach ($weixin as $key => $value) {
                                ?>
                                    <img src="<?php echo $value['img_url'] ?>" width="140px" />
                                <?php
                                }
                                ?>
                            </div>
                            <span>微信二维码</span>
                        </div>
                        <div class="rightbox">
                            <h2>扫描二维码</h2>
                            <p>开启微信→扫一扫</p>
                            <span></span>
                            <p>左方“二维码”扫描→输入金额→点击付钱</p>
                            <span></span>
                            <p>确认支付，提交存款信息。</p>
                            <p class="warning">【注：存款人姓名请填写微信昵称】</p>
                            <br>
                            <p class="warning">【请记得提交入款订单哦】</p>
                        </div>
                    </div>
                <?php }
                if (!empty($zfb)) { ?>
                    <!-- 支付寶支付二維顯示 -->
                    <div class="qrcode-box sm_hide" style="display:none">
                        <div class="leftbox">
                            <div>
                                <?php
                                foreach ($zfb as $key => $value) {
                                ?>
                                    <img src="<?php echo $value['img_url'] ?>" width="140px" />
                                <?php
                                }
                                ?>
                            </div>
                            <span>支付宝二维码</span>
                        </div>
                        <div class="rightbox">
                            <h2>扫描二维码</h2>
                            <p>开启支付宝→扫一扫</p>
                            <span></span>
                            <p>左方“二维码”扫描→输入金额→点击付钱</p>
                            <span></span>
                            <p>确认支付，提交存款信息。</p>
                            <p class="warning">【注：存款人姓名请填写支付宝昵称】</p>
                            <br>
                            <p class="warning">【请记得提交入款订单哦】</p>
                        </div>
                    </div>
                <?php }
                if (!empty($cft)) { ?>
                    <!-- 財付通二維顯示 -->
                    <div class="qrcode-box sm_hide" style="display:none">
                        <div class="leftbox">
                            <div>
                                <?php
                                foreach ($cft as $key => $value) {
                                ?>
                                    <img src="<?php echo $value['img_url'] ?>" width="140px" />
                                <?php
                                }
                                ?>
                            </div>
                            <span>财付通二维码</span>
                        </div>
                        <div class="rightbox">
                            <h2>扫描二维码</h2>
                            <p>开启财付通→扫一扫</p>
                            <span></span>
                            <p>左方“二维码”扫描→输入金额→点击付钱</p>
                            <span></span>
                            <p>确认支付，提交存款信息。</p>
                            <p class="warning">【注：存款人姓名请填写财付通昵称】</p>
                            <br>
                            <p class="warning">【请记得提交入款订单哦】</p>
                        </div>
                    </div>
                <?php }
                if (!empty($uni)) { ?>
                    <!-- 云闪付二維顯示 -->
                    <div class="qrcode-box sm_hide" style="display:none">
                        <div class="leftbox">
                            <div>
                                <?php
                                foreach ($uni as $key => $value) {
                                ?>
                                    <img src="<?php echo $value['img_url'] ?>" width="140px" />
                                <?php
                                }
                                ?>
                            </div>
                            <span>云闪付二维码</span>
                        </div>
                        <div class="rightbox">
                            <h2>扫描二维码</h2>
                            <p>开启云闪付→扫一扫</p>
                            <span></span>
                            <p>左方“二维码”扫描→输入金额→点击付钱</p>
                            <span></span>
                            <p>确认支付，提交存款信息。</p>
                            <p class="warning">【注：存款人姓名请填写云闪付昵称】</p>
                            <br>
                            <p class="warning">【请记得提交入款订单哦】</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="main_box">
                <div class="otherpay_box">
                    <div class="leftbox">
                        <p>此存款信息只是您汇款详情的提交，并非代表存款，您需要自己通过ATM或网银转帐到本公司提供的账户后，填写提交此信息，待工作人员审核充值！</p>
                        <br>
                        <br>
                        <h3>汇款信息提交说明：</h3>
                        <br>
                        <p>(1).请按表格填写准确的汇款转账信息,确认提交后相关财务人员会即时为您查询入款情况!</p>
                        <br>
                        <p>(2).请您在转账金额后面加个尾数,例如:转账金额 1000.66 或 1000.88 等,以便相关财务人员更快确认您的转账金额并充值!</p>
                        <br>
                        <p>(3).如有任何疑问,您可以联系 在线客服,为您提供365天×24小时不间断的友善和专业客户咨询服务!</p>
                    </div>
                    <div class="rightbox">
                        <form id="form1" name="form1" action="/?r=member/remittance/remittancedo" method="post">
                            <p class="user_name"><?php echo $username; ?></p>
                            <div>
                                <input name="v_amount" type="text" id="v_amount" onkeyup="clearNoNum(this);" placeholder="存款金额" />
                            </div>
                            <div>
                                <select id="InType" name="InType" onchange="showType();">
                                    <option value="">请选择支付类型</option>
                                    <option value="ZFB">支付宝支付</option>
                                    <option value="WX">微信支付</option>
                                    <option value="CFT">财付通支付</option>
                                    <option value="UNI">云闪付支付</option>
                                </select>
                                <input id="v_type" name="v_type" type="text" size="19" value="请输入其它汇款方式" onfocus="javascript:getId('v_type').select();" style="display:none;margin-bottom:10px" />
                                <input type="hidden" id="IntoType" name="IntoType" value="" />
                            </div>
                            <div style="display:none">
                                <select id="IntoBank" name="IntoBank" style="width:100%;">
                                    <option value="" selected="selected">请选择转入银行</option>
                                    <option value="微信">微信</option>
                                    <option value="支付宝">支付宝</option>
                                    <option value="财付通">财付通</option>
                                    <option value="云闪付">云闪付</option>
                                </select>
                            </div>
                            <h4>支付日期</h4>
                            <div>
                                <input name="cn_date" type="text" id="cn_date" maxlength="10" value="<?= date("Y-m-d", time()) ?>" style="width:110px;margin-right:2px" />
                                <select name="s_h" id="s_h" style="margin-right:2px;width:60px;">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select>
                                <span>时</span>
                                <select name="s_i" id="s_i" style="margin-right:2px;width:60px;">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                </select>
                                <span>分</span>
                                <select name="s_s" id="s_s" style="margin-right:2px;width:60px;">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                </select>
                                <span>秒</span>
                            </div>
                            <div id="tr_v">
                                <input name="v_Name" type="text" id="v_Name" style="width:100%" onfocus="javascript:this.select();" placeholder="支付方账号" />
                            </div>
                            <div id="zfgxm" style="display:none">
                                <input name="v_name2" type="text" id="v_name2" style="width:100%;" placeholder="支付方姓名" />
                            </div>
                            <div class="bottom_box">
                                <input name="vlcodes" type="text" id="vlcodes" size="5" maxlength="4" onfocus="next_checkNum_img()" style="width:212px;" placeholder="验证码" />
                                <img src="/?r=member/index/captcha" alt="点击更换" name="checkNum_img" id="checkNum_img" class="checkNum_img" onclick="next_checkNum_img()" />
                            </div>
                            <div>
                                <input name="SubTran" type="button" class="confirm_btn" id="SubTran" onclick="SubInfo();" style="width:100%" value="提交信息" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#MACenter').attr('data-current', 'myothrt_pay');
    </script>
</body>

</html>