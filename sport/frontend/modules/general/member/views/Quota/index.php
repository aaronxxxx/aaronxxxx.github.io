<div id="MACenterContent">
    <div id="MNav">
        <span class="mbtn">额度转换</span>
        <div class="navSeparate"></div>
        <a href="/?r=member/deposit/index" class="mbtn">线上存款</a>
        <div class="navSeparate"></div>
        <a href="/?r=member/remittance/index" class="mbtn">银行汇款</a>
        <div class="navSeparate"></div>
        <a href="/?r=member/withdraw/index" class="mbtn">线上取款</a>
    </div>
    <div id="MMainData" style="margin-top: 8px;">
        <h2 class="MSubTitle">目前额度</h2>
        <table class="MMain" border="1" style="margin-bottom: 8px;">
            <thead>
                <tr>
                    <th style="width: 25%;" nowrap="">类型</th>
                    <th style="width: 25%;" nowrap="">帐户</th>
                    <th style="width: 25%;" nowrap="">余额</th>
                    <th style="width: 25%;" nowrap="">更新时间</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="25%" style="text-align: center;" class="">主账户</td>
                    <td width="25%" style="text-align: center;" class="">aa1313</td>
                    <td width="25%" style="text-align: center;" class="">
                        <span id="credit">
                            959.00
                        </span>
                    </td>
                    <td width="25%" style="text-align: center;" class="">
                        2016-01-15 18:10:07
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" class="">AG极速娱乐场</td>
                    <td style="text-align: center;" class="">
                        <span id="name_ag">额度转换后自动开通</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="credit_ag">正在同步中...</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="time_ag"></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center;" class="">AG国际娱乐场</td>
                    <td style="text-align: center;" class="">
                        <span id="name_agin">额度转换后自动开通</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="credit_agin">正在同步中...</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="time_agin"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" class="">BBIN娱乐场</td>
                    <td style="text-align: center;" class="">
                        <span id="name_ag_bbin">额度转换后自动开通</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="credit_ag_bbin">正在同步中...</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="time_ag_bbin"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">DS娱乐场</td>
                    <td style="text-align: center;">
                        <span id="name_ds">额度转换后自动开通</span>
                    </td>
                    <td style="text-align: center;">
                        <span id="credit_ds">正在同步中...</span>
                    </td>
                    <td style="text-align: center;">
                        <span id="time_ds"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" class="">OG娱乐场</td>
                    <td style="text-align: center;" class="">
                        <span id="name_og">额度转换后自动开通</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="credit_og">正在同步中...</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="time_og"></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;" class="">MG娱乐场</td>
                    <td style="text-align: center;" class="">
                        <span id="name_mg">额度转换后自动开通</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="credit_mg">正在同步中...</span>
                    </td>
                    <td style="text-align: center;" class="">
                        <span id="time_mg"></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2 class="MSubTitle">额度转换</h2>
        <table class="MMain MNoBorder" style="width: auto;">
            <tbody><tr>
                    <td nowrap="" class="">钱包转账：</td>
                    <td class="">
                        <a href="javascript: f_com.MChgPager({method: 'liveHistory'});">
                            查询转账记录
                        </a>
                    </td>
                </tr>
                <tr>
                    <td nowrap="" class="">
                        我的钱包&nbsp;&nbsp;&nbsp;&nbsp;->
                    </td>
                    <td class="">
                        <select name="zz_type_in" id="zz_type_in">
                            <option value="1">
                                AG极速娱乐场
                            </option>
                            <option value="3">
                                AG国际娱乐场
                            </option>
                            <option value="5">
                                BBIN娱乐场
                            </option>
                            <option value="7">
                                DS娱乐场
                            </option>
                            <option value="9">
                                OG娱乐场
                            </option>
                            <option value="11">
                                MG娱乐场
                            </option>
                        </select>
                    </td>
                    <td nowrap="" class="">
                        转账金额：
                    </td>
                    <td class="">
                        <input type="text" name="zz_money_in" id="zz_money_in" onkeyup="if (isNaN(this.value))
                                execCommand('undo')">
                        &nbsp;
                        <span style="color: #ff0000;">最低转账金额:20</span>
                    </td>
                    <td class="">
                        <input type="button" onclick="confirmChangeMoney(20, 29000, 38450, 47550, 46850, 46648, 46250, 'in')" value="确认转账">
                    </td>
                </tr>
                <tr>
                    <td class="">
                        <select name="zz_type_out" id="zz_type_out">
                            <option value="2">
                                AG极速娱乐场
                            </option>
                            <option value="4">
                                AG国际娱乐场
                            </option>
                            <option value="6">
                                BBIN娱乐场
                            </option>
                            <option value="8">
                                DS娱乐场
                            </option>
                            <option value="10">
                                OG娱乐场
                            </option>
                            <option value="12">
                                MG娱乐场
                            </option>
                        </select>
                    </td>
                    <td nowrap="" class="">
                        ->&nbsp;&nbsp;&nbsp;&nbsp;我的钱包
                    </td>
                    <td nowrap="" class="">
                        转账金额：
                    </td>
                    <td class="">
                        <input type="text" name="zz_money_out" id="zz_money_out" onkeyup="if (isNaN(this.value))
                                execCommand('undo')">
                        &nbsp;
                        <span style="color: #ff0000;">最低转账金额:20</span>
                    </td>
                    <td class="">
                        <input type="button" onclick="confirmChangeMoney(20, 29000, 38450, 47550, 46850, 46648, 46250, 'out')" value="确认转账">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>