<?php

use yii\widgets\LinkPager;
?>
<body>

    <div class="pro_title pd10"> 代理管理：下属会员 <?= $all['user_name']; ?>-<?= $type['name']; ?> 报表信息            <a href="#/agent/lottery/index&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一页</span></a>
   </div>
    
    <div id="pageMain" align="center">
   
   <div class="mgauto middle mgb10">
                        <form class="trinput font14 mgb10" name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/lottery/detail" onsubmit="return check();">
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

                        <table width="100%"  cellspacing="0" cellpadding="0" class="font12 skintable line35 pdt10 " id=editProduct   idth="100%" >
                            <tbody>
                                <tr>
                                    <td align="center"><strong>订单号</strong></td>
                                    <td align="center"><strong>彩票类别</strong></td>
                                    <td align="center"><strong>彩票期号</strong></td>
                                    <td align="center"><strong>投注玩法</strong></td>
                                    <td align="center"><strong>投注内容</strong></td>
                                    <td align="center"><strong>投注金额</strong></td>
                                    <td align="center"><strong>反水</strong></td>
                                    <td align="center"><strong>赔率</strong></td>
                                    <td height="25" align="center"><strong>输赢结果</strong></td>
                                    <td align="center"><strong>投注时间</strong></td>
                                    <td height="25" align="center"><strong>状态</strong></td>
                                </tr>
                                <?php
                                if ($lottery_list) {
                                    foreach ($lottery_list as $key => $value) {
                                        ?>
                                        <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                            <td height="40" align="center" valign="middle"><?= $value['order_sub_num'] ?></td>
                                            <td align="center" valign="middle"><?= $type['name']; ?></td>
                                            <td align="center" valign="middle"><?= $value['qishu'] ?></td>
                                            <td align="center" valign="middle"><?= $value['rtype_str'] ?></td>
                                            <td align="center" valign="middle" style="max-width: 100px;"><?= $value['contentName'] ?></td>
                                            <td align="center" valign="middle"><?= $value['bet_money_one'] ?></td>
                                            <td align="center" valign="middle"><?= $value['fs'] ?></td>
                                            <td align="center" valign="middle"><?= $value['rate'] ?></td>
                                            <td align="center" valign="middle"><?= $value['money_result'] ?></td>
                                            <td><?= $value['bet_time'] ?></td>
                                            <td>
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
                                    <td height="25" align="center" valign="middle" colspan="11">
                                        当前页总投注金额:<?= $all['money'] ?>元    当前页投注结果:<?= $all['sy'] ?>元   当前页赢取金额:<?= $all['money']-$all['sy']; ?>元
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="11" style="border:0px!important;">  <?php
                        if ($lottery_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?></td>
                                </tr>
                            </tbody>
                        </table>
                      
                  
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>