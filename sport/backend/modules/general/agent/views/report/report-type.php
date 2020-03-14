<?php

use yii\widgets\LinkPager;
?>
<body>

               <div class="pro_title pd10">
                    代理管理：下属会员报表信息
                </div>

    <div id="pageMain" align="center">
        <div class="pd10 flg">
                        <form class="trinput font14" name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/report/report-type" onsubmit="return check();">
                            <input type="hidden" name="user_id" value="<?= $user_id; ?>">

                            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
                            ~
                            <input class="laydate-icon" name="e_time" id="e_time" value="<?= $time['e_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
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
                            <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
                        </form>
                   </div>
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" class="font12 skintable line35" id=editProduct   idth="100%" >
                            <tbody>
                                <tr>
                                    <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注笔数</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注金额</strong></td>
                                    <td style="width: 21%" align="center"><strong>下注结果</strong></td>
                                    <td style="width: 21%" align="center"><strong>赢取金额</strong></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="彩票游戏" style="color: #F37605;" href="#/agent/lottery/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>">彩票游戏</a>
                                    </td>
                                    <td align="center" valign="middle"><?= $row_game['bet_count_lottery']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_money_lottery']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['win_lottery']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['result_lottery']; ?></td>
                                </tr>
                                <!-- <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="六合彩" style="color: #F37605;" href="#/agent/six/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>">六合彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?= $row_game['bet_count_six']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_money_six']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['win_six']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['result_six']; ?></td>
                                </tr> -->
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="极速六合彩" style="color: #F37605;" href="#/agent/spsix/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>">极速六合彩</a>
                                    </td>
                                    <td align="center" valign="middle"><?= $row_game['bet_count_spsix']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_money_spsix']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['win_spsix']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['result_spsix']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="真人娱乐" style="color: #F37605;" href="#/agent/live/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>">真人娱乐</a>
                                    </td>
                                    <td align="center" valign="middle"><?= $row_game['bet_count_live']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_money_live']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_result_live']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['result_live']; ?></td>
                                </tr>
                                <!-- <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">
                                        <a title="賽事" style="color: #F37605;" href="#/agent/event/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>">賽事</a>
                                    </td>
                                    <td align="center" valign="middle"><?= $row_game['bet_count_event']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_money_event']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['win_event']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['result_event']; ?></td>
                                </tr> -->
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle">总计</td>
                                    <td align="center" valign="middle"><?= $row_game['bet_count_all']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['bet_money_all']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['win_all']; ?></td>
                                    <td align="center" valign="middle"><?= $row_game['result_all']; ?></td>
                                </tr>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。如果是正数，说明赢钱，如果是负数，则为输钱。</td>
                                </tr>
                            </tbody>
                        </table>

    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>