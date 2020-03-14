<?php
use yii\widgets\LinkPager;
?>
<body>
<div class="pro_title pd10">
    代理管理：代理报表信息
</div>
    <div id="pageMain">
        <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/report/index" >
            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
            ~
            <input class="laydate-icon" name="e_time" id="e_time" value="<?= $time['e_time'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
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
            <br> <br>
            代理名：<input name="user_group" value="<?= $user_group; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            忽略代理名：<input name="user_ignore_group" value="<?= $user_ignore_group; ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="gtype" type="hidden" id="gtype" value="">
            <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
            <br><br>
        </form>
        <table width="100%"  id=editProduct class="font13n dailis skintable" >
            <tbody>
                <tr class="dailitr">
                    <td style="width: 14%" align="center" height="25"><strong>代理用户名</strong></td>
                    <!-- <td style="width: 14%" align="center"><strong>真人流水/真人盈利</strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong>彩票流水/彩票盈利</strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong>六合流水/六合盈利</strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong>极速六合流水/极速六合盈利</strong></td> -->
                    <td style="width: 14%" align="center"><strong>賽事流水/賽事盈利</strong></td>
                    <td style="width: 14%" align="center"><strong>合计流水/合计盈利</strong></td>
                </tr>
                <?php
                if ($agents_list) {
                    foreach ($agents_list as $key => $value) {
                        ?>
                        <tr align="center" onmouseover="this.style.backgroundColor =' #EBEBEB'" onmouseout="this.style.backgroundColor =' #ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                            <td height="40" align="center" valign="middle">
                                <a style="color: #F37605;" href="#/agent/report/one-agent&id=<?= $value['id'] ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><?= $value['agents_name'] ?></a>
                            </td>
                            <!-- <td align="center" valign="middle"><?= round($value['live_bet_money'],2) ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= round($value['live_win'],2) ?></td> -->
                            <!-- <td align="center" valign="middle"><?= round($value['lottery_bet_money'],2) ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= round($value['lottery_win'],2) ?></td> -->
                            <!-- <td align="center" valign="middle"><?= round($value['six_bet_money'],2) ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= round($value['six_win'],2) ?></td> -->
                            <!-- <td align="center" valign="middle"><?= round($value['spsix_bet_money'],2) ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= round($value['spsix_win'],2) ?></td> -->
                            <td align="center" valign="middle"><?= round($value['event_bet_money'],2) ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= round($value['event_win'],2) ?></td>
                            <td align="center" valign="middle"><?= round($value['bet_money'],2) ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= round($value['win_money'],2) ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>

                <tr class="dailitr">
                    <td style="width: 14%" align="center" height="25"><strong>本页总计</strong></td>
                    <!-- <td style="width: 14%" align="center"><strong><?=$sumTotal['live_bet_money']?>/<?=$sumTotal['live_win']?></strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong><?=$sumTotal['lottery_bet_money']?>/<?=$sumTotal['lottery_win']?></strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong><?=$sumTotal['six_bet_money']?>/<?=$sumTotal['six_win']?></strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong><?=$sumTotal['spsix_bet_money']?>/<?=$sumTotal['spsix_win']?></strong></td> -->
                    <td style="width: 14%" align="center"><strong><?=$sumTotal['event_bet_money']?>/<?=$sumTotal['event_win']?></strong></td>
                    <td style="width: 14%" align="center"><strong><?=$sumTotal['bet_money']?>/<?=$sumTotal['win_money']?></strong></td>
                </tr>

                        <tr><td colspan="7"> <?php
        if ($agents_list) {
            echo LinkPager::widget(['pagination' => $pages]);
        }
        ?></td></tr>
            </tbody>
        </table>
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>