<html>

<head>
    <title>银行汇款</title>
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
            } else if (getId('InType').value == '网银转账' || getId('InType').value == '银行柜台' || getId('InType').value == 'ATM') {
                getId('tr_v').style.display = '';
                getId('v_Name').placeholder = '请输入汇款人姓名';
                getId('IntoType').value = getId('InType').value;
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
                    alert("转账金额最底为：" + m + "元");
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
            if (getId('InType').value == '网银转账' || getId('InType').value == '银行柜台' || getId('InType').value == 'ATM') {
                if (getId('v_Name').value != '' && getId('v_Name').value != '请输入汇款人姓名' && getId('v_Name').value.length > 1 && getId('v_Name').value.length < 20) {
                    var tName = getId('v_Name').value;
                    var yy = tName.length;
                    for (var xx = 0; xx < yy; xx++) {
                        var zz = tName.substring(xx, xx + 1);
                        if (zz != '·') {
                            if (!isChinese(zz)) {
                                alert('请输入中文持卡人姓名,如有其他疑问,请联系在线客服');
                                return false;
                            }
                        }
                    }
                } else {
                    alert('为了更快确认您的转账,网银转账请输入持卡人姓名');
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
        //是否是中文
        function isChinese(str) {
            return /[\u4E00-\u9FA0]/.test(str);
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
        // alert("亲爱的贵宾请注意\r公司银行帐号不定期更换\r请每次存款前，务必先至 [公司入款] 查看账号\r入款至已过期帐号，公司无法查收，恕不负责！");
    </script>
</head>

<body>
    <div id="MACenterContent">
        <div class="MNav">
            <a href="/?r=member/live/index" class="mbtn">额度转换</a>
            <a href="/?r=member/deposit/index" class="mbtn">线上存款</a>
            <span class="active mbtn">银行汇款</span>
            <a href="/?r=member/remittance/index2" class="mbtn">其他支付</a>
            <a href="/?r=member/withdraw/index" class="mbtn">线上取款</a>
        </div>
        <div id="MMainData" class="pay_cont">
            <div class="title_box">
                <h2>- 汇款转账详细账户资料 -</h2>
                <div class="title_table">
                    <table class="rwd-table">
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

                        ?>
                                <tr class="table_cont">
                                    <td data-th="支付类型">网银</td>
                                    <td data-th="银行名称"><?= $value['bank_name'] ?></td>
                                    <td data-th="银行帐号">
                                        <span class="copy_text" type="text" data-clipboard-target="data-clipboard-target"><?= $value['bank_number'] ?></span>
                                        <button class="copy_btn" type="button" data-clipboard="data-clipboard">复制</button>
                                    </td>
                                    <td data-th="开户名">
                                        <span class="copy_text" type="text" data-clipboard-target="data-clipboard-target"><?= $value['bank_xm'] ?></span>
                                        <button class="copy_btn" type="button" data-clipboard="data-clipboard">复制</button>
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
            <div class="main_box">
                <div class="ps_textbox">
                    <h3>温馨提示：</h3>
                    <p>一、请在金额转出之后务必填写网页下方的汇款信息表格，以便我们财务人员能及时为您确认添加金额到您的会员账户。</p>
                    <p>二、本公司最低汇款金额为<?php echo $min_huikuan_money; ?>元，公司赠送银行汇款红利给会员（例:汇款金额10万元赠送1%即1000元，按百赠送）。</p>
                    <p>三、如您是跨行转帐，请您在转帐时选择跨行快速汇款或跨行加急汇款（避免公司不能及时查收您的款项）。</p>
                </div>
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
                                    <option value="">请选择汇款方式</option>
                                    <option value="银行柜台">银行柜台</option>
                                    <option value="网银转账">网银转账</option>
                                    <option value="ATM">ATM</option>
                                    <option value="0">其它[手动输入]</option>
                                </select>

                                <input id="v_type" name="v_type" type="text" size="19" placeholder="请输入其它汇款方式" onfocus="javascript:getId('v_type').select();" style="display:none;margin:5px 0 10px" />
                                <input type="hidden" id="IntoType" name="IntoType" value="" />
                            </div>
                            <div>
                                <select id="IntoBank" name="IntoBank">
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
                                    <option value="其他">其他</option>
                                </select>
                            </div>
                            <h4>汇款日期</h4>
                            <div>
                                <input name="cn_date" type="text" id="cn_date" size="10" maxlength="10" value="<?= date("Y-m-d", time()) ?>" style="width:110px;margin-right:2px" />
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
                            <div>
                                <input name="v_Name" type="text" id="v_Name" onfocus="javascript:this.select();" placeholder="支付方姓名" />
                            </div>
                            <div class="bottom_box">
                                <input name="vlcodes" type="text" id="vlcodes" size="5" maxlength="4" onfocus="next_checkNum_img()" style="width:212px;" placeholder="验证码" />
                                <img src="/?r=member/index/captcha" alt="点击更换" name="checkNum_img" id="checkNum_img" class="checkNum_img" onclick="next_checkNum_img()" />
                            </div>
                            <div>
                                <input name="SubTran" type="button" class="confirm_btn" id="SubTran" onclick="SubInfo();" value="提交信息" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#MACenter').attr('data-current', 'mytransaction');
    </script>
</body>

</html>