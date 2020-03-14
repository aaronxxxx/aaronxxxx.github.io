<?php
use yii\widgets\LinkPager;
?>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
    <tr>
        <td height="24">
            <font>
                <span class="pro_title">
                    代理管理：下属会员 <?php echo $all['user_name'] ?> 賽事报表信息
                </span>
            </font>
            <a href="/?r=agentht/agent/report-type&user_name=<?php echo $all['user_name'] ?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一页</span></a>
        </td>
    </tr>
</table>
<div id="pageMain"  align="center">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
        <tr>
            <td valign="top">
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                    <form name="select_form" id="select_form" method="get" action="/?r=agentht/event/index" onsubmit="return check();">
                        <input type="hidden" name="r" value="agentht/event/index">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="hidden" name="user_name" value="<?php echo $all['user_name']; ?>">
                        <tbody>
                        <tr class="trinput font14 mgb10 inputct">
                            <td>
                                <br>

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
                                <input type="submit" name="Submit" value="搜索">
                            </td>
                        </tr>
                        </tbody>
                    </form>
                </table>
                <br>
                <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35 mgt10" id=editProduct >
                    <tbody>
                    <tr >
                        <td align="center" height="25"><strong>订单号</strong></td>
                        <td align="center"><strong>賽事名稱</strong></td>
                        <td align="center"><strong>比賽類型</strong></td>
                        <td align="center"><strong>彩票期号</strong></td>
                        <td align="center"><strong>讓分</strong></td>
                        <td align="center"><strong>投注内容</strong></td>
                        <td align="center"><strong>投注金额</strong></td>
                        <td align="center"><strong>反水</strong></td>
                        <td align="center"><strong>赔率</strong></td>
                        <td align="center"><strong>输赢结果</strong></td>
                        <td align="center"><strong>投注时间</strong></td>
                        <td align="center"><strong>状态</strong></td>
                    </tr>
                    <?php
                    $betMoney = $winMoney = 0;
                    if ($event_list) {
                        foreach ($event_list as $key => $value) {
                            ?>
                            <tr style="background-color: #fff">
                                <td align="center" height="25"><?php echo $value['order_num']; ?></td>
                                <td align="center"><?php echo $value['title']; ?></td>
                                <td align="center"><?php echo $gameType[$value['game_type']]; ?></td>
                                <td align="center"><?php echo $value['qishu']; ?></td>
                                <td align="center"><?php echo $value['bet_handicap']; ?></td>
                                <td align="center"><?php echo $value['game_item_id']; ?></td>
                                <td align="center"><?php echo $value['bet_money']; $betMoney += $value['bet_money']; ?></td>
                                <td align="center"><?php echo $value['fs']; ?></td>
                                <td align="center"><?php echo $value['bet_rate']; ?></td>

                                <td align="center" valign="middle"><?= $value['win_total'] ?>
                                    <?php
                                    if ($value['status'] == 2 && $value['is_win'] == 2) {
                                        $winMoney += $value['bet_money'] - $value['win_total'];
                                    } elseif ($value['status'] == 1) {
                                        $winMoney += $value['win_total'];
                                    } else {
                                        $winMoney += $value['bet_money'];
                                    }
                                    ?>
                                </td>
                                <td align="center" valign="middle"><?php echo $value['bet_time']; ?></td>
                                <td align="center" valign="middle">
                                    <?php
                                    if ($value['status'] == 0) {
                                        echo '<font color="#0000FF">未结算</font>';
                                    }
                                    if ($value['status'] == 1) {
                                        echo '<font color="#FF0000">已结算</font>';
                                    }
                                    if ($value['status'] == 2) {
                                        echo '<font color="#FF0000">已重算</font>';
                                    }
                                    if ($value['status'] == 3) {
                                        echo '<font color="#FFcccc">作废</font>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                        <td height="25" align="center" valign="middle" colspan="12">
                            当前页总投注金额:<?php echo $all['money']; ?>元    当前页投注结果:<?php echo $all['sy']; ?>元   当前页赢取金额:<?php echo $all['money'] - $all['sy']; ?>元
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                if ($event_list) {
                    echo LinkPager::widget(['pagination' => $pages]);
                }
                ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
