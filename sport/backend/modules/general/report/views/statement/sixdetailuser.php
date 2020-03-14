<?php
use yii\widgets\LinkPager; ?>
<div id="pageMain">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody><tr>
            <td valign="top">
                <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/report/statement/six-detail">
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="trinput font14">
                        <tbody>
                        <tr>
                            <td bgcolor="#FFFFFF" align="left" class="pd10">
                                <a href="#/report/statement/six-detail&s_time=<?= urlencode($time['s_time']); ?>&e_time=<?= urlencode($time['e_time']); ?>&user_in=<?= $getDatas['user_in']; ?>&user_nin=<?= $getDatas['user_nin']; ?>" style="color: #F37605;" title="返回上一页">返回上一页</a>
                            </td>
                        </tr>
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
                                <input type="hidden" name="r" value="report/statement/six-detail">
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
                        <td align="center"><strong>用户名(真实名字)</strong></td>
                        <td align="center">下注笔数</td>
                        <td align="center"><strong>下注金额</strong></td>
                        <td align="center"><strong>下注结果</strong></td>
                        <td align="center"><strong>赢取金额</strong></td>
                    </tr>
                    <?php
                    $betMoney = $betResult = 0;
                    foreach ($data as $key => $val) {
                        ?>
                        <tr align="center">
                                <td height="25" align="center" valign="middle">六合彩</td>
                                <td align="center" valign="middle"><a title="六合彩" style="color: #F37605;" href="#/six/index/order&start_time=<?= urlencode($time['s_time']); ?>&ent_time=<?= urlencode($time['e_time']); ?>&user_name=<?= $val['user_name']; ?>&qishu=&status=0,1,2,3"><?= $val['user_name']; ?></a>(<?= $val['pay_name'] ?>)</td>
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
                            <td height="25" align="center" valign="middle" colspan="6">当前页总投注金额:<?= $betMoney ?>元    当前页投注结果:<?= $betResult; ?>元   当前和局金额:<?=$draw; ?>元    当前页赢取金额:<?= $betMoney - $betResult; ?>元</td>
                        </tr>

                    </tbody>
                </table>
                <?= LinkPager::widget(['pagination' => $pages]); ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>