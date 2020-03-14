<?php
use yii\widgets\LinkPager; ?>
<div id="pageMain">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody><tr>
            <td valign="top">
                <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/report/spsix/six-detail">
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="trinput font14">
                        <tbody>

                        <tr>
                            <td align="left" bgcolor="#FFFFFF" class="pd10">
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
                                    <?php foreach ($monthArray as $key => $val) { ?>
                                        <option value="<?= $key ?>" <?= $key == '选择月份' ? 'selected' : ""; ?>><?= $val; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#FFFFFF">
                                用户名：<input name="user_in" value="<?= $getDatas['user_in']; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                忽略用户名：<input name="user_nin" value="<?= $getDatas['user_nin']; ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="r" value="report/spsix/six-detail">
                                <input type="hidden" name="group" value="<?= $group; ?>">
                                <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font14 skintable line35 mgt10">
                    <tbody><tr >
                        <td align="center" height="25"><strong>游戏名称</strong></td>
                        <td align="center"><strong>下注笔数</strong></td>
                        <td align="center"><strong>下注金额</strong></td>
                        <td align="center"><strong>下注结果</strong></td>
                        <td align="center"><strong>赢取金额</strong></td>
                    </tr>
                    <?php
                    $betMoney = $betResult = 0;
                    foreach ($data as $key => $val) {
                        ?>
                        <tr align="center">
                                <td height="25" align="center" valign="middle">
                                    <a title="六合彩" style="color: #F37605;" href="#/report/spsix/six-detail-user&s_time=<?= urlencode($time['s_time']); ?>&e_time=<?= urlencode($time['e_time']); ?>&user_in=<?= $getDatas['user_in']; ?>&user_nin=<?= $getDatas['user_nin']; ?>&group=user">极速六合彩</a>
                                </td>
                                <td align="center" valign="middle"><?= $val['count_total']; ?></td>
                                <td align="center" valign="middle"><?= $val['bet_money'] ? $val['bet_money'] : 0; ?></td>
                                <td align="center" valign="middle"><?= $val['is_win_total'] ? $val['is_win_total'] : 0; ?></td>
                                <td align="center" valign="middle"><?= $val['bet_money'] - $val['is_win_total']; ?></td>
                        </tr>
                        <?php
                        $betMoney += $val['bet_money'];
                        $betResult += $val['is_win_total'];
                    }
                    ?>
                        <tr align="center">
                            <td height="25" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。如果是正数，说明赢钱，如果是负数，则为输钱。</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>