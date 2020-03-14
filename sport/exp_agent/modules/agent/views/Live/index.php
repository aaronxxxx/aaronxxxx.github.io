<?php

use yii\widgets\LinkPager;
?>
<body>

    
    <div class="pro_title pd10"> 代理管理：下屬會員 <?= $all['user_name']; ?> live報表信息    <a href="?r=agent/report/report-type&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一頁</span></a>
       </div>
    <div id="pageMain" align="center">
      
                        <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="?r=agent/live/index" >
                            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                            <br>
                            &nbsp;&nbsp;
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
                            <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
                        </form>
                        <br>
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" class="font12 skintable line35" id=editProduct   idth="100%" >
                            <tbody>
                                <tr>
                                    <td style="width: 8%" align="center" height="25"><strong>真人類型</strong></td>
                                    <td style="width: 12%" align="center"><strong>訂單號</strong></td>
                                    <td style="width: 12%" align="center"><strong>投注玩法</strong></td>
                                    <td style="width: 15%" align="center"><strong>投注內容</strong></td>
                                    <td style="width: 8%" align="center"><strong>投注金額</strong></td>
                                    <td style="width: 8%" align="center"><strong>贏取金額</strong></td>
                                    <td style="width: 15%" align="center"><strong>投注時間</strong></td>
                                    <td style="width: 12%" align="center"><strong>真人賬戶</strong></td>
                                </tr>
                                <?php
                                if ($live_list) {
                                    foreach ($live_list as $key => $value) {
                                        ?>
                                        <tr style="background-color: #fff">
                                            <td align="center" height="25"><?= $value['game_type']; ?></td>
                                            <td align="center"><?= $value['order_num']; ?></td>
                                            <td align="center"><?= $value['live_type']; ?></td>
                                            <td align="center"><?= $value['bet_info']; ?></td>
                                            <td align="center"><?= $value['bet_money']; ?></td>
                                            <td align="center"><?= $value['live_win']; ?></td>
                                            <td align="center"><?= $value['order_time']; ?></td>
                                            <td align="center"><?= $value['live_username']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="25" align="center" valign="middle" colspan="9">
                                        當前頁總投注金額:<?= $all['money'] ?>元    當前頁贏取金額:<?= $all['sy'] ?>元
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if ($live_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?>
                
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>