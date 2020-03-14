<script src="/public/member/js/live_exchange.js"></script>
<div id="MACenterContent">
    <div id="MNav">
        <span class="mbtn">额度转换</span>
        <div class="navSeparate"></div>
        <a href="/?r=mobile/deposit/index" class="mbtn">线上存款</a>
        <div class="navSeparate"></div>
        <a href="/?r=mobile/remittance/index" class="mbtn">银行汇款</a>
        <div class="navSeparate"></div>
        <a href="/?r=mobile/withdraw/index" class="mbtn">线上取款</a>
    </div>
    <div id="MMainData" style="margin-top: 8px;">
        <h2 class="MSubTitle">目前额度</h2>
        <h2>亲爱的用户您好,如果您想要投注体育赛事,请将金额转入AG_BBIN娱乐场</h2>
        <table class="MMain" border="1" style="margin-bottom: 8px;">
            <thead>
                <tr>
                    <th style="width: 25%;" nowrap>类型</th>
                    <th style="width: 25%;" nowrap>帐户</th>
                    <th style="width: 25%;" nowrap>余额</th>
                    <th style="width: 25%;" nowrap>更新时间</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="25%" style="text-align: center;">主账户</td>
                    <td width="25%" style="text-align: center;"><?= $user['name']; ?></td>
                    <td width="25%" style="text-align: center;">
                        <span id="credit">
                            <?= $user['money']; ?>
                        </span>
                    </td>
                    <td width="25%" style="text-align: center;">
                        <?= date("Y-m-d H:i:s", time()) ?>
                    </td>
                    <!--
                    <td>
                        <input type="button" id="btn_update_all_hall" value="一键更新" />
                    </td>
                    -->
                </tr>
                <tr>
                    <td style="text-align: center;">AG极速厅</td>
                    <td style="text-align: center;">
                        <span id="name_ag">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_ag">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_ag">
                            正在同步中...
                        </span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;">AGIN国际厅</td>
                    <td style="text-align: center;">
                        <span id="name_agin">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_agin">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_agin">
                            正在同步中...
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">BBIN波音厅</td>
                    <td style="text-align: center;">
                        <span id="name_ag_bbin">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_ag_bbin">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_ag_bbin">
                            正在同步中...
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">DS贵宾厅</td>
                    <td style="text-align: center;">
                        <span id="name_ds">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_ds">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_ds">
                            正在同步中...
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">AG_OG娱乐场</td>
                    <td style="text-align: center;">
                        <span id="name_ag_og">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_ag_og">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_ag_og">
                            正在同步中...
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">MG娱乐场</td>
                    <td style="text-align: center;">
                        <span id="name_ag_mg">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_ag_mg">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_ag_mg">
                            正在同步中...
                        </span>
                    </td>
                </tr>


                <tr>
                    <td style="text-align: center;">OG东方厅</td>
                    <td style="text-align: center;">
                        <span id="name_og">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_og">
                            正在同步中...
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_og">
                            正在同步中...
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2 class="MSubTitle">额度转换</h2>
        <table class="MMain MNoBorder" style="width: auto;">
            <tr>
                <td nowrap>钱包转账：</td>
                <td>
                    <a href="/?r=mobile/transaction-log/bank&type=zz">查询转账记录</a>
                </td>
            </tr>
            <tr>
                <td nowrap>我的钱包&nbsp;&nbsp;&nbsp;&nbsp;-></td>
                <td>
                    <select name="zz_type_in" id="zz_type_in">
                        <option value="1">AG极速厅</option>
                        <option value="3">AG国际厅</option>
                        <option value="5">BBIN厅</option>
                        <option value="7">DS厅</option>
                        <option value="9">AG_OG厅</option>
                        <option value="11">MG厅</option>
                        <option value="13">OG厅</option>
                    </select>
                </td>
                <td nowrap>
                    转账金额：
                </td>
                <td>
                    <input type="text" name="zz_money_in" id="zz_money_in" onkeyup="if (isNaN(this.value))
                                execCommand('undo')" />
                    &nbsp;<span style="color: #ff0000;">最低转账金额:<?= $min_limit ?></span>
                </td>
                <td>
                    <input type="button" id="btn_int" onclick="return confirmChangeMoney('in');" 
                           value="确认转账" />
                </td>
            </tr>
            <tr>
                <td>
                    <select name="zz_type_out" id="zz_type_out">
                        <option value="2">AG极速厅</option>
                        <option value="4">AG国际厅</option>
                        <option value="6">BBIN厅</option>
                        <option value="8">DS厅</option>
                        <option value="10">AG_OG厅</option>
                        <option value="12">MG厅</option>
                        <option value="13">OG厅</option>
                    </select>
                </td>
                <td nowrap>->&nbsp;&nbsp;&nbsp;&nbsp;我的钱包</td>
                <td nowrap>
                    转账金额：
                </td>
                <td>
                    <input type="text" name="zz_money_out" id="zz_money_out" onkeyup="if (isNaN(this.value))
                                execCommand('undo')" />
                    &nbsp;<span style="color: #ff0000;">最低转账金额:<?= $min_limit ?></span>
                </td>
                <td>
                    <input type="button" id="btn_out" onclick="return confirmChangeMoney('out');" 
                           value="确认转账" />
                </td>
            </tr>
        </table>
    </div>
</div>