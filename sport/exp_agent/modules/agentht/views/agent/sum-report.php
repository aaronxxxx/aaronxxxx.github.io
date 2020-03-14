<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
    <tr>
        <td height="24">
            <font>
                <span class="pro_title">
                    總代理管理：總代理結算紀錄
                </span>
            </font>
        </td>
    </tr>
</table>
<div id="pageMain"  align="center">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
        <tr>
            <td valign="top">
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                    <form name="select_form" id="select_form" method="get" action="/?r=agentht/agent/sum-report" onsubmit="return check();">
                        <input type="hidden" name="r" value="agentht/agent/sum-report">
                        <tbody>
                        <tr  class="trinput font14 mgb10 inputct">
                            <td  >
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
        <table width="100%"  class="font13n dailis skintable">
            <tbody>
                <tr  class="t-title dailitr" align="center">
                    <td colspan="4" width="15%" height="20"><strong>公司結算金額(進項)</strong></td>
                    <td colspan="1" width="15%" height="20"><strong>結算金額(平衡)</strong></td>
                </tr>
                <tr  class="t-title dailitr" align="center">
                    <td width="15%" height="20"><strong>總代理名稱</strong></td>
                    <td width="12%"><strong>總流水總額</strong></td>
                    <td width="12%"><strong>總盈利總額</strong></td>
                    <td width="12%"><strong>總盈利總額</strong></td>
                    <td width="12%"><strong>總代理獲利</strong></td>
                </tr>
                <tr class="t-title dailitr" align="center">
                    <td width="15%" height="20"><?=$company?></td>
                    <td><?=$betMoney?></td>
                    <td><?=$winMoney?></td>
                    <td><?=$settle?></td>
                    <td><?=$settle-array_sum(array_column($agents_news, 'money'))?></td>
                </tr>
                
            </tbody>
        </table>
        <br>
        <table width="100%"  class="font13n dailis skintable">
            <tbody>
                <tr  class="t-title dailitr" align="center">
                    <td colspan="4" width="15%" height="20"><strong>子代理結算金額(出項)</strong></td>
                </tr>
                <tr  class="t-title dailitr" align="center">
                    <td width="15%" height="20"><strong>子代理名稱</strong></td>
                    <td width="12%"><strong>流水總額</strong></td>
                    <td width="12%"><strong>盈利總額</strong></td>
                    <td width="12%"><strong>子代理獲利</strong></td>
                </tr>
                <?php
                if ($agents_news) {
                    foreach ($agents_news as $key => $value) {
                        ?>
                        <tr  class="t-title dailitr" align="center">
                            <td width="15%" height="20"><?= $value['agents_name']?></td>
                            <td width="10%"><?= $value['ledger']?></td>
                            <td width="10%"><?= $value['profig']?></td>
                            <td width="10%"><?= $value['money']?></td>
                        </tr>
                        <?php }?>
                        <tr  class="t-title dailitr" align="center">
                            <td width="15%" height="20">總和</td>
                            <td width="10%"><?= array_sum(array_column($agents_news, 'ledger'))?></td>
                            <td width="10%"><?= array_sum(array_column($agents_news, 'profig'))?></td>
                            <td width="10%"><?= array_sum(array_column($agents_news, 'money'))?></td>
                        </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>