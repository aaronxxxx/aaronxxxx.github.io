<?php

use yii\widgets\LinkPager;

//echo '111';exit;
?>
<body>
  
     <div class="pro_title ">代理管理：代理報表信息</div>
    <div id="pageMain" align="center">
    
                        <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="?r=agent/report/one-agent" >
                            <div class="mgauto middle">
                            <input type="hidden" name="id" value="<?= $id; ?>">
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
                      </div> 
                        </form>
                        <table width="100%"  cellspacing="0" cellpadding="0"  class="font13n dailis skintable" id=editProduct >
                            <tbody>
                            <br>
                            <tr  class="dailitr">
                                <td style="width: 15%" align="center" height="25"><strong>代理用戶名</strong></td>
                                <td style="width: 17%" align="center"><strong>體育流水/體育盈利</strong></td>
                                <td style="width: 17%" align="center"><strong>真人流水/真人盈利</strong></td>
                                <td style="width: 17%" align="center"><strong>彩票流水/彩票盈利</strong></td>
                                <td style="width: 17%" align="center"><strong>越南彩流水/越南彩盈利</strong></td>
                                <td style="width: 17%" align="center"><strong>合計流水/合計盈利</strong></td>
                            </tr>
                            <?php
                            if ($user_list) {
                                foreach ($user_list as $key => $value) {
                                    ?>
                                    <tr align="center" onmouseover="this.style.backgroundColor = '#EBEBEB'" onmouseout="this.style.backgroundColor = '#ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                                        <td height="40" align="center" valign="middle">
                                            <a style="color: #F37605;" href="?r=agent/report/report-type&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_id=<?= $value['user_id'] ?>"><?= $value['user_name'] ?></a>
                                        </td>
                                        <td align="center" valign="middle"><?= $value['sport_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['sport_win'] ?></td>
                                        <td align="center" valign="middle"><?= $value['live_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['live_win'] ?></td>
                                        <td align="center" valign="middle"><?= $value['lottery_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['lottery_win'] ?></td>
                                        <td align="center" valign="middle"><?= $value['six_bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['six_win'] ?></td>
                                        <td align="center" valign="middle"><?= $value['bet_money'] ?>&nbsp;&nbsp;/&nbsp;&nbsp;<?= $value['win_money'] ?></td>
                                    </tr>    
                                    <?php
                                }
                            }
                            ?>
                                    <tr>
                                        <td colspan="6">
                                       <?php
        if ($user_list) {
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