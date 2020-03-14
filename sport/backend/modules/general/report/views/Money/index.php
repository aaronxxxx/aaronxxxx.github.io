<?php

use yii\widgets\LinkPager;
?>
<body>


    <div class="pro_title pd10">    报表金额明细</div>
    <div id="pageMain" >

        <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/report/money/index"  class="trinput font14 ">

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

        <table width="100%" border="0" cellpadding="4" cellspacing="1" class="font14 skintable line35 mgt10 mgb10 relat">
            <tr >
                <td><strong>收入项目</strong></td>
                <td  ><strong>收入金额</strong></td>
                <td  ><strong>支出项目</strong></td>
                <td  ><strong>支持金额</strong></td>
            </tr>
            <tr   >
                <td   height="25"><strong>公司汇款</strong></td>
                <td ><strong><?= $money['yyhh']; ?></strong><a class="righta" href="#/finance/default/huikuan&status=成功&start_time=<?= urlencode($time['s_time']); ?>&end_time=<?= urlencode($time['e_time']);  ?>">详情</a></td>
                <td  ><strong>会员取款</strong></td>
                <td ><strong><?= $money['yhtk']; ?></strong><a class="righta" href="#/finance/fund/tixian&status=成功&time_start=<?= urlencode($time['s_time']);  ?>&time_end=<?= urlencode($time['e_time']);  ?>">详情</a></td>
            </tr>
            <tr   >
                <td   height="25"><strong>在线存款</strong></td>
                <td ><strong><?= $money['zzck']; ?></strong><a class="righta" href=".#/finance/fund/money-save&status=在线支付&time_start=<?= urlencode($time['s_time']); ?>&time_end=<?= urlencode($time['e_time']);  ?>">详情</a></td>
                <td   height="25"><strong>赠送金额</strong></td>
                <td ><strong><?= $money['zsjr']; ?></strong></td>
            </tr>
            <!-- <tr   >
                <td  ><strong>第三方手续费</strong></td>
                <td ><strong><?= $money['sxf1']; ?></strong></td>
                <td  ><strong>提款手续费</strong></td>
                <td ><strong><?= $money['sxf2']; ?></strong></td>
            </tr> -->
            <tr   >
                <td  ><strong>反水</strong></td>
                <td ><strong><?= $money['fs']; ?></strong></td>
                <td  ></td>
                <td ><strong></td>
            </tr>
        </table>
        <p>项目入款（公司汇款+在线存款）：<span style="color:green;"><?= $money['yyhh'] + $money['zzck']; ?></span></p>
        <p>会员虚拟入款（返水+赠送金额）：<span style="color:green;"><?= $money['zsjr'] + $money['fs']; ?></span></p>
        <p>实际收入（公司汇款+在线存款-会员取款）：<span style="color:green;"><?= $money['yyhh'] + $money['zzck'] - $money['yhtk']; ?></span></p>
        <p style="color: red">注：第三方支付的手续费统一按1%进行计算，由于各种第三方支付的手续费率和算法不一样，这不服数据仅供参考</p>
        <p style="color: red">注：为确保数据准确性，网站内部测试账户请添加到“测试会员组”</p>
    </div>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>