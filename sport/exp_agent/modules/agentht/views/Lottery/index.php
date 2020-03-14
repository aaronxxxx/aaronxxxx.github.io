<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：下属会员 <?=$user_name?> 彩票报表信息
                </span>
                </font>
                <a href="/?r=agentht/agent/report-type&user_name=<?=$user_name?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一页</span></a>
            </td>
        </tr>
    </table>
    <div id="pageMain" align="center">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                            <form name="select_form" id="select_form" method="get" action="/?r=agentht/lottery/index" onsubmit="return check();">
                                <input type="hidden" name="r" value="agentht/lottery/index">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
                                <tbody>
                                    <tr  class="trinput font14 mgb10 inputct">
                                        <td >
                                            <br>
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
                        <br>
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35 " id=editProduct >
                            <tbody>
                                <tr >
                                    <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注笔数</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注金额</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注结果</strong></td>
                                    <td style="width: 21%" align="center"><strong>赢取金额</strong></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="3D彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=d3&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">3D彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['d3_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['d3_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['d3_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['d3_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="排列三" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=p3&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">排列三</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['p3_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['p3_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['p3_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['p3_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="上海时时乐" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=t3&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">上海时时乐</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['t3_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['t3_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['t3_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['t3_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="重庆时时彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=cq&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">重庆时时彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cq_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cq_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cq_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cq_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="天津时时彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=tj&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">天津时时彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tj_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tj_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tj_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tj_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="广西十分彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=gxsf&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">广西十分彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gxsf_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gxsf_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gxsf_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gxsf_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="广东十分彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=gdsf&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">广东十分彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gdsf_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gdsf_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gdsf_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gdsf_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="天津十分彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=tjsf&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">天津十分彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tjsf_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tjsf_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tjsf_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['tjsf_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="重庆十分彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=cqsf&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">重庆十分彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cqsf_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cqsf_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cqsf_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['cqsf_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="北京快乐8" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=bjkn&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">北京快乐8</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjkn_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjkn_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjkn_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjkn_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="广东十一选五" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=gd11&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">广东十一选五</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gd11_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gd11_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gd11_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['gd11_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="北京PK拾" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=bjpk&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">北京PK拾</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjpk_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjpk_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjpk_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['bjpk_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="极速赛车" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=ssrc&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">极速赛车</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ssrc_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ssrc_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ssrc_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ssrc_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="幸运飞艇" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=mlaft&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">幸运飞艇</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['mlaft_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['mlaft_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['mlaft_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['mlaft_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="腾讯分分彩" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=ts&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">腾讯分分彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ts_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ts_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ts_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['ts_result']; ?></td>
                                </tr>
								<tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="老PK拾" style="color: #F37605;" href="/?r=agentht/lottery/detail&type=orpk&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>&user_id=<?php echo $user_id; ?>">老PK拾</a>
                                    </td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['orpk_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['orpk_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['orpk_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['orpk_result']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">总计</td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['all_count']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['all_money']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['all_win']; ?></td>
                                    <td align="center" valign="middle"><?php echo $lottery_list['all_result']; ?></td>
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