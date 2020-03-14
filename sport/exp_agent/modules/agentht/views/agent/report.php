<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：代理会员报表信息
                </span>
                </font>
            </td>
        </tr>
    </table>
    <div id="pageMain"  align="center">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                            <form name="select_form" id="select_form" method="get" action="/?r=agentht/agent/report" onsubmit="return check();">
                                <input type="hidden" name="r" value="agentht/agent/report">
                                <tbody>
                                    <tr  class="trinput font14 mgb10 inputct">
                                        <td  >
                                            &nbsp;&nbsp;
                                            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
                                            ~
                                            <input class="laydate-icon" name="e_time" id="e_time" value="<?= $time['e_time'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
                                            &nbsp;&nbsp;
                                            <input type="button" value="今日" onclick="setDate('today')">
                                            <input type="button" value="昨日" onclick="setDate('yesterday')">
                                            <input type="button" value="本周" onclick="setDate('thisWeek')">
                                            <input type="button" value="上周" onclick="setDate('lastWeek')">
                                            <input type="button" value="本月" onclick="setDate('thisMonth')">
                                            <input type="button" value="上月" onclick="setDate('lastMonth')">
                                            <input type="button" value="最近7天" onclick="setDate('lastSeven')">
                                            <input type="button" value="最近30天" onclick="setDate('lastThirty')">
                                            <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                                                <option value="" selected="">选择月份</option>
                                                <option value="1">1月</option>
                                                <option value="2">2月</option>
                                                <option value="3">3月</option>
                                                <option value="4">4月</option>
                                                <option value="5">5月</option>
                                                <option value="6">6月</option>
                                                <option value="7">7月</option>
                                                <option value="8">8月</option>
                                                <option value="9">9月</option>
                                                <option value="10">10月</option>
                                                <option value="11">11月</option>
                                                <option value="12">12月</option>
                                            </select>
											<input type="submit" name="Submit" value="搜索">
                                        </td>
                                    </tr>
                                </tbody>
                            </form>
                        </table>
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35" id=editProduct >
                            <tbody><br><tr >
                                <td style="width: 15%" align="center" height="25"><strong>代理用户名</strong></td>
                                <!-- <td style="width: 13%" align="center"><strong>真人流水/真人盈利</strong></td> -->
                                <!-- <td style="width: 13%" align="center"><strong>彩票流水/彩票盈利</strong></td> -->
                                <!-- <td style="width: 13%" align="center"><strong>六合流水/六合盈利</strong></td> -->
                                <!-- <td style="width: 13%" align="center"><strong>极速六合流水/极速六合盈利</strong></td> -->
                                <td style="width: 13%" align="center"><strong>賽事流水/賽事盈利</strong></td>
                                <td style="width: 17%" align="center"><strong>合计流水/合计盈利</strong></td>
                            </tr>
                            <?php
                            if ($agent_news) {
                                foreach ($agent_news as $key => $value) {
                                ?>
                                <tr align="center" onmouseover="this.style.backgroundColor ='#EBEBEB'" onmouseout="this.style.backgroundColor ='#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                                    <td height="40" align="center" valign="middle">
                                        <a style="color: #F37605;" href="/?r=agentht/agent/agents-list&aid=<?php echo $value['id'] ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>"><?php echo $value['agents_name'] ?></a>
                                    </td>
                                    <!-- <td align="center" valign="middle"><?php echo $value['live_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo $value['live_win'] ?></td> -->
                                    <!-- <td align="center" valign="middle"><?php echo $value['lottery_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo $value['lottery_win'] ?></td> -->
                                    <!-- <td align="center" valign="middle"><?php echo $value['six_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo $value['six_win'] ?></td> -->
                                    <!-- <td align="center" valign="middle"><?php echo $value['spsix_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo $value['spsix_win'] ?></td> -->
                                    <td align="center" valign="middle"><?php echo $value['event_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo $value['event_win'] ?></td>
                                    <td align="center" valign="middle"><?php echo $value['bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo $value['win_money'] ?></td>
                                </tr>
                                    <?php
                                }
                            }
                            ?>
            </tbody>
        </table>
    </td>
</tr>
</tbody>
</table>
</div>
</body>