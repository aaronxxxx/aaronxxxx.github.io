<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：下属会员 <?= $user_name?> 报表信息
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
                            <form name="select_form" id="select_form" method="get" action="/?r=agentht/agent/report-type" onsubmit="return check();">
                                <input type="hidden" name="r" value="agentht/agent/report-type">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
                                <tbody>
                                    <tr class="trinput font14 mgb10 inputct">
                                        <td >

                                            &nbsp;&nbsp;
                                            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $time['s_time'] ?>" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly="readonly">
                                            ~
                                            <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $time['e_time'] ?>" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" readonly="readonly">
                                            &nbsp;&nbsp;
                                            <input type="button" value="今日" onclick="setDate('today' )">
                                            <input type="button" value="昨日" onclick="setDate('yesterday' )">
                                            <input type="button" value="本周" onclick="setDate('thisWeek' )">
                                            <input type="button" value="上周" onclick="setDate('lastWeek' )">
                                            <input type="button" value="本月" onclick="setDate('thisMonth' )">
                                            <input type="button" value="上月" onclick="setDate('lastMonth' )">
                                            <input type="button" value="最近7天" onclick="setDate('lastSeven' )">
                                            <input type="button" value="最近30天" onclick="setDate('lastThirty' )">
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
                        <br>
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35" id=editProduct >
                            <tbody>
                                <tr >
                                    <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注笔数</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注金额</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注结果</strong></td>
                                    <td style="width: 21%" align="center"><strong>赢取金额</strong></td>
                                </tr>
                                <?php /* ?>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="彩票游戏" style="color: #F37605;" href="/?r=agentht/lottery/index&user_name=<?= $user_name?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>">彩票游戏</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_count_lottery']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_money_lottery']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['win_lottery']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['result_lottery']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="六合彩" style="color: #F37605;" href="/?r=agentht/six/index&user_name=<?= $user_name?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>">六合彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_count_six']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_money_six']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['win_six']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['result_six']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="极速六合彩" style="color: #F37605;" href="/?r=agentht/spsix/index&user_name=<?= $user_name?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>">极速六合彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_count_spsix']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_money_spsix']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['win_spsix']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['result_spsix']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="真人电子" style="color: #F37605;" href="/?r=agentht/live/index&user_name=<?= $user_name?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>">真人电子</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_count_live'] + $row_game['bet_count_game']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_money_live'] + $row_game['bet_money_game']; ?></td>
                                    <td align="center" valign="middle">----</td>
                                    <td align="center" valign="middle"><?php echo $row_game['result_live'] + $row_game['result_game']; ?></td>
                                </tr>
                                <?php */ ?>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="賽事" style="color: #F37605;" href="/?r=agentht/event/index&user_name=<?= $user_name?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>">賽事</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_count_event']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_money_event']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['win_event']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['result_event']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">总计</td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_count_all']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['bet_money_all']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['win_all']; ?></td>
                                    <td align="center" valign="middle"><?php echo $row_game['result_all']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。如果是正数，说明赢钱，如果是负数，则为输钱。</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>