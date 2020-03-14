<?php
use yii\widgets\LinkPager;
?>
<body>
<div class="pro_title pd10">
    代理管理：代理報表信息
</div>
    <div id="pageMain">
        <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/report/sum-index" >
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
                <option value="" selected="">選擇月份</option>
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
            代理名：<input name="user_group" value="<?= $user_group; ?>" style="width: 200px;" type="text"> (多個用戶用 , 隔開)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            忽略代理名：<input name="user_ignore_group" value="<?= $user_ignore_group; ?>" type="text" style="width: 200px;"> (多個用戶用 , 隔開)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="gtype" type="hidden" id="gtype" value="">
            <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
            <br><br>
        </form>
        <table width="100%"  id=editProduct class="font13n dailis skintable" >
            <tbody>
                <tr class="dailitr">
                    <td style="width: 15%" align="center" height="25"><strong>代理用戶名</strong></td>
                    <!-- <td style="width: 17%" align="center"><strong>體育流水/體育盈利</strong></td>-->
                    <!-- <td style="width: 17%" align="center"><strong>真人流水/真人盈利</strong></td> -->
                    <!-- <td style="width: 17%" align="center"><strong>彩票流水/彩票盈利</strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong>六合流水/六合盈利</strong></td> -->
                    <!-- <td style="width: 14%" align="center"><strong>极速六合流水/极速六合盈利</strong></td> -->
                    <td style="width: 14%" align="center"><strong>賽事流水/賽事盈利</strong></td>
                    <td style="width: 17%" align="center"><strong>合計流水/合計盈利</strong></td>
                </tr>
                <?php
                if ($agents_list) {
                    foreach ($agents_list as $key => $value) {
                        ?>
                        <tr align="center" onmouseover="this.style.backgroundColor =' #EBEBEB'" onmouseout="this.style.backgroundColor =' #ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                            <td height="40" align="center" valign="middle">
                                <a style="color: #F37605;" href="#/agent/report/index&agent_level=<?= $value['id'] ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><?= $value['agents_name'] ?></a>
                            </td>
                            <!-- <td align="center" valign="middle"><?= $value['sport_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['sport_win'] ?></td>-->
                            <!-- <td align="center" valign="middle"><?= $value['live_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['live_win'] ?></td> -->
                            <!-- <td align="center" valign="middle"><?= $value['lottery_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['lottery_win'] ?></td>  -->
                            <!-- <td align="center" valign="middle"><?= $value['six_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['six_win'] ?></td> -->
                            <!-- <td align="center" valign="middle"><?= $value['spsix_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['spsix_win'] ?></td> -->
                            <td align="center" valign="middle"><?= $value['event_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['event_win'] ?></td>
                            <td align="center" valign="middle"><?= $value['bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['win_money'] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                        <tr><td colspan="7"> <?php
        if ($agents_list) {
            echo LinkPager::widget(['pagination' => $pages]);
        }
        ?></td></tr>
            </tbody>
        </table>
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/sum_agent.js"></script>