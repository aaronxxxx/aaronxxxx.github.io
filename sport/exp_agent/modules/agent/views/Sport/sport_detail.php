<?php

use yii\widgets\LinkPager;
?>
<body>


    <div class="pro_title pd10">
        代理管理：下屬會員 <?= $all['user_name']; ?>-<?= $type['name']; ?> 報表信息

        <a href="?r=agent/sport/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一頁</span></a>
    </div>

    <div id="pageMain" align="center">

        <div class="mgauto middle pd10">
            <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="?r=agent/sport/detail" onsubmit="return check();">
                <input type="hidden" name="type" value="<?= $type['type']; ?>">
                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
               
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
        </div>
        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" class="font12 skintable line35" id=editProduct   idth="100%" >
            <tbody>
                <tr>
                    <td align="center"><strong>訂單號</strong></td>
                    <td align="center"><strong>體育類別</strong></td>
                    <td align="center"><strong>聯賽名</strong></td>
                    <td align="center"><strong>主客隊</strong></td>
                    <td align="center"><strong>投注詳細信息</strong></td>
                    <td align="center"><strong>投注金額</strong></td>
                    <td align="center"><strong>反水</strong></td>
                    <td align="center"><strong>賠率</strong></td>
                    <td height="25" align="center"><strong>輸贏結果</strong></td>
                    <td align="center"><strong>投注時間</strong></td>
                    <td height="25" align="center"><strong>狀態</strong></td>
                </tr>
                <?php
                $t_allmoney = $t_sy = 0;
                if ($sport_list) {
                    foreach ($sport_list as $key => $value) {
                        $t_allmoney+=$value['bet_money'];
                        $t_sy+=$value['win'];
                        ?>
                        <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                            <td height="40" align="center" valign="middle"><?= $value['order_num'] ?></td>
                            <td align="center" valign="middle"><?= $type['name']; ?></td>
                            <td align="center" valign="middle"><?= $value['match_name'] ?></td>
                            <td align="center" valign="middle"><?= $value['master_guest'] ?></td>
                            <td align="center" valign="middle" style="max-width: 100px;"><?= $value['bet_info'] ?></td>
                            <td align="center" valign="middle"><?= $value['bet_money'] ?></td>
                            <td align="center" valign="middle"><?= $value['fs'] ?></td>
                            <td align="center" valign="middle"><?= $value['bet_point'] ?></td>
                            <td align="center" valign="middle"><?= $value['win'] + $value['fs']; ?></td>
                            <td>北京:<?= $value['bet_time'] ?><br>美東:<?= $value['bet_time_et'] ?></td>
                            <td>
                                <?php
                                if ($value['status'] == 0) {
                                    echo "<font color='#0000FF'>未結算</font>";
                                }
                                if ($value['status'] == 1) {
                                    echo '<font color="#FF0000">贏</font>';
                                }
                                if ($value['status'] == 2) {
                                    echo '<font color="#00CC00">輸</font>';
                                }
                                if ($value['status'] == 3) {
                                    echo '<font >注單無效</font>';
                                }
                                if ($value['status'] == 4) {
                                    echo '<font color="#FF0000">贏一半</font>';
                                }
                                if ($value['status'] == 5) {
                                    echo '<font color="#00CC00">輸一半</font>';
                                }
                                if ($value['status'] == 6) {
                                    echo '<font >進球無效</font>';
                                }
                                if ($value['status'] == 7) {
                                    echo '<font >紅卡無效</font>';
                                }
                                if ($value['status'] == 8) {
                                    echo '<font >和局</font>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                    <td height="25" align="center" valign="middle" colspan="11">
                        當前頁總投注金額:<?= $t_allmoney; ?>元    當前頁投注結果:<?= $t_sy; ?>元   當前頁贏取金額:<?= $t_allmoney - $t_sy; ?>元
                    </td>
                </tr>
                <tr>
                    <td colspan="11">
                        <?php
                        if ($sport_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?>  
                    </td>
                </tr>
            </tbody>
        </table>


    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>