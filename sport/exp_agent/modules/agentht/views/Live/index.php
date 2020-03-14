<?php

use yii\widgets\LinkPager;
?>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：下属会员 <?php echo $all['user_name']; ?> 真人游戏报表信息
                </span>
                </font>
                <a href="/?r=agentht/agent/report-type&user_name=<?php echo $all['user_name']; ?>&user_id=<?php echo $user_id; ?>&s_time=<?php echo $time['s_time'] ?>&e_time=<?php echo $time['e_time'] ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一页</span></a>
            </td>
        </tr>
    </table>
    <div id="pageMain"  align="center">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td valign="top" align="center">
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                            <form name="select_form" id="select_form" method="get" action="/?r=agentht/live/index" onsubmit="return check();">
                                <input type="hidden" name="r" value="agentht/live/index">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <tbody>
                                <tr class="trinput font14 mgb10 inputct">
                                    <td>
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
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35" id=editProduct >
                            <tbody>
                                <tr >
                                    <td style="width: 8%" align="center" height="25"><strong>真人类型</strong></td>
                                    <td style="width: 12%" align="center"><strong>订单号</strong></td>
                                    <td style="width: 12%" align="center"><strong>投注玩法</strong></td>
                                    <td style="width: 15%" align="center"><strong>投注内容</strong></td>
                                    <td style="width: 8%" align="center"><strong>投注金额</strong></td>
                                    <td style="width: 8%" align="center"><strong>赢取金额</strong></td>
                                    <td style="width: 15%" align="center"><strong>投注时间</strong></td>
                                    <td style="width: 12%" align="center"><strong>真人账户</strong></td>
                                </tr>
                                <?php
                                if ($live_list) {
                                    foreach ($live_list as $key => $value) {
                                        ?>
                                        <tr style="background-color: #fff">
                                            <td align="center" height="25"><?php echo $value['game_type']; ?></td>
                                            <td align="center"><?php echo $value['order_num']; ?></td>
                                            <td align="center"><?php echo $value['live_type']; ?></td>
                                            <td align="center"><?php echo $value['bet_info']; ?></td>
                                            <td align="center"><?php echo $value['bet_money']; ?></td>
                                            <td align="center"><?php echo $value['live_win']; ?></td>
                                            <td align="center"><?php echo $value['order_time']; ?></td>
                                            <td align="center"><?php echo $value['live_username']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle" colspan="9">
                                        当前页总投注金额:<?php echo $all['money'] ?>元    当前页赢取金额:<?php echo $all['sy'] ?>元
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if ($live_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>