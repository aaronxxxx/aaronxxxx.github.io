<?php
use yii\widgets\LinkPager;
?>
<body>
<div class="pro_title pd10">
    代理管理：代理報表信息
</div>
    <div id="pageMain">
        <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/report/sum-report" >
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
            <input id="gridSearchBtn" type="button" name="Submit" value="搜尋">
        </form>
        <br>
        <table width="100%"  class="font13n dailis skintable">
            <tbody>
                <tr  class="t-title dailitr" align="center">
                    <td width="15%" height="20"><strong>公司名稱</strong></td>
                    <td width="12%"><strong>流水總額</strong></td>
                    <td width="12%"><strong>盈利總額</strong></td>
                    <td width="12%"><strong>代理結算費用</strong></td>
                    <td width="12%"><strong>公司淨利</strong></td>
                </tr>
                <tr class="t-title dailitr" align="center">
                    <td width="15%" height="20"><?=$company?></td>
                    <td><?=$betMoney?></td>
                    <td><?=$winMoney?></td>
                    <td><?=$settle?></td>
                    <td><?=$company_proift?></td>
                </tr>
                
            </tbody>
        </table>
        <br>
        <table width="100%"  class="font13n dailis skintable">
            <tbody>
                <tr  class="t-title dailitr" align="center">
                    <td width="15%" height="20"><strong>代理名</strong></td>
                    <td width="10%"><strong>流水總額</strong></td>
                    <td width="10%"><strong>盈利總額</strong></td>
                    <td width="10%"><strong>分成比例%</strong></td>
                    <td width="10%"><strong>退水比例%</strong></td>
                    <td width="10%"><strong>結算金額</strong></td>
                    <td width="10%"><strong>結算日期</strong></td>
                    <td width="10%"><strong>公司淨利</strong></td>
                    <td width="10%"><strong>結算類型</strong></td>
                </tr>
                <?php
                if ($agent_money_list) {
                    foreach ($agent_money_list as $key => $value) {
                        ?>
                        <tr  class="t-title dailitr" align="center">
                            <td width="15%" height="20"><?= $value['agents_name']?></td>
                            <td width="10%"><?= $value['ledger']?></td>
                            <td width="10%"><?= $value['profig']?></td>
                            <td width="10%"><?= $value['ratio']?></td>
                            <td width="10%"><?= $value['refund_scale']?></td>
                            <td width="10%"><?= $value['money']?></td>
                            <td width="10%"><?= $value['s_time']?></td>
                            <td width="10%"><?= $value['company_profit']?></td>
                            <td width="10%"><?= $value['settlement_type']?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>