<script src="/public/member/js/live_exchange.js"></script>
<div id="MACenterContent">
    <div class="MNav">
        <span class="mbtn active">额度转换</span>
        <a href="/?r=member/deposit/index" class="mbtn">线上存款</a>
        <a href="/?r=member/remittance/index" class="mbtn">银行汇款</a>
        <a href="/?r=member/remittance/index2" class="mbtn">其他支付</a>
        <a href="/?r=member/withdraw/index" class="mbtn">线上取款</a>
    </div>
    <div id="MMainData" class="transaction_box">
        <h1 class="transaction_title">目前额度</h1>
        <div class="mybalance">
            <div class="mybalance_box">
                <p>主账户</p>
                <dl>
                    <dt><?= $user['name']; ?></dt>
                    <dd>
                        余额:
                        <span id="credit">
                            <?= $user['money']; ?>
                        </span>
                    </dd>
                </dl>
            </div>
            <p class="balance_time">更新时间:<span><?= date("Y-m-d H:i:s", time()) ?></span></p>
        </div>
        <div class="balance">
            <!-- AI -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>AI</dt>
                        <dd>
                            <span id="name_ai">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_ai">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','21','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','22','credit_ai')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_ai">
                        正在同步中...
                    </span>
                </p>
            </div>
            <?php /*
            <!-- IG -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>IG</dt>
                        <dd>
                            <span id="name_ig">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_ig">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','21','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','22','credit_ig')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_ig">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- VG棋牌 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>VG棋牌</dt>
                        <dd>
                            <span id="name_kg">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_kg">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','15','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','16','credit_kg')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_kg">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- VR彩票 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>VR彩票</dt>
                        <dd>
                            <span id="name_vr">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_vr">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','19','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','20','credit_vr')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_vr">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- AGIN国际厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>AGIN国际厅</dt>
                        <dd>
                            <span id="name_agin">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_agin">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','3','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','4','credit_agin')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_agin">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- AG极速厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>AG极速厅</dt>
                        <dd>
                            <span id="name_ag">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_ag">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','1','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','2','credit_ag')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_ag">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- BBIN波音厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>BBIN波音厅</dt>
                        <dd>
                            <span id="name_ag_bbin">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_ag_bbin">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','5','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','6','credit_ag_bbin')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_ag_bbin">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- DS贵宾厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>DS贵宾厅</dt>
                        <dd>
                            <span id="name_ds">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_ds">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','7','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','8','credit_ds')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_ds">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- OG东方厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>OG东方厅</dt>
                        <dd>
                            <span id="name_og">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_og">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','13','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','14','credit_og')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_og">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- MG旗靓厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>MG旗靓厅</dt>
                        <dd>
                            <span id="name_ag_mg">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_ag_mg">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','11','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','12','credit_ag_mg')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_ag_mg">
                        正在同步中...
                    </span>
                </p>
            </div>
            <!-- PT厅 -->
            <div class="balances">
                <div class="balance_box">
                    <dl>
                        <dt>PT厅</dt>
                        <dd>
                            <span id="name_pt">
                                正在同步中...
                            </span>
                        </dd>
                    </dl>
                    <p class="balance_money">
                        余额:
                        <span id="credit_pt">
                            正在同步中...
                        </span>
                    </p>
                    <ul>
                        <li><button onclick="return confirmChangeAllMoney('in','17','<?= (int) $user['money']; ?>')">转入</button></li>
                        <li><button onclick="return confirmChangeAllMoney('out','18','credit_pt')">转出</button></li>
                    </ul>
                </div>
                <p class="balance_time">
                    更新时间:
                    <span id="time_pt">
                        正在同步中...
                    </span>
                </p>
            </div>
            */ ?>
        </div>
    </div>
    <div class="conversion_box">
        <div class="left_box pay_bg">
            <h2>额度转换</h2>
            <a href="/?r=member/transaction-log/bank&type=zz">-查询转账记录-</a>
        </div>
        <div class="right_box">
            <ul class="conversion_change">
                <li class="conversion_change active">转入</li>
                <li class="conversion_change">转出</li>
            </ul>
            <script>
                $(document).ready(function() {
                    $(".conversion_change li").first().click(function() {
                        $(this).addClass("active");
                        $(this).siblings().removeClass("active");
                        $(".money_out_box").css("display", "block");
                        $(".money_in_box").css("display", "none");
                    });
                    $(".conversion_change li").last().click(function() {
                        $(this).addClass("active");
                        $(this).siblings().removeClass("active");
                        $(".money_in_box").css("display", "block");
                        $(".money_out_box").css("display", "none");
                    });
                });
            </script>
            <div class="money_out_box money_box">
                <select name="zz_type_in" id="zz_type_in">
                    <!-- <option value="15">我的钱包 转至 VG棋牌</option>
                    <option value="19">我的钱包 转至 VR彩票</option>
                    <option value="3">我的钱包 转至 AGIN国际厅</option>
                    <option value="1">我的钱包 转至 AG极速厅</option>
                    <option value="5">我的钱包 转至 BBIN波音厅</option>
                    <option value="7">我的钱包 转至 DS贵宾厅</option>
                    <option value="13">我的钱包 转至 OG东方厅</option>
                    <option value="11">我的钱包 转至 MG旗靓厅</option>
                    <option value="17">我的钱包 转至 PT厅</option> -->
                    <option value="21">我的钱包 转至 AI厅</option>
                </select>
                <input type="text" name="zz_money_in" id="zz_money_in" placeholder="转账金额" onkeyup="if (isNaN(this.value)) execCommand('undo')" />
                <span>最低转账金额:<?= $min_limit ?></span>
                <input type="button" id="btn_int" class="confirm_btn" onclick="return confirmChangeMoney('in');" value="确认转账" />
            </div>
            <div class="money_in_box  money_box" style="display:none">
                <select name="zz_type_out" id="zz_type_out">
                    <!-- <option value="16">VG棋牌 转至 我的钱包</option>
                    <option value="20">VR彩票 转至 我的钱包</option>
                    <option value="4">AGIN国际厅 转至 我的钱包</option>
                    <option value="2">AG极速厅 转至 我的钱包</option>
                    <option value="6">BBIN波音厅 转至 我的钱包</option>
                    <option value="8">DS贵宾厅 转至 我的钱包</option>
                    <option value="14">OG东方厅 转至 我的钱包</option>
                    <option value="12">MG旗靓厅 转至 我的钱包</option>
                    <option value="18">PT厅 转至 我的钱包</option> -->
                    <option value="22">AI厅 转至 我的钱包</option>
                </select>
                <input type="text" name="zz_money_out" id="zz_money_out" placeholder="转账金额" onkeyup="if (isNaN(this.value))execCommand('undo')" />
                <span>最低转账金额:<?= $min_limit ?></span>
                <input type="button" id="btn_out" class="confirm_btn" onclick="return confirmChangeMoney('out');" value="确认转账" />
            </div>
        </div>
    </div>
</div>
<script>
    $('#MACenter').attr('data-current', 'mytransaction');
</script>