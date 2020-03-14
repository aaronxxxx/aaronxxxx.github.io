<!--财务中心：贵宾报表-->
<div class="all">
    <div class="f_mb">
        <div class="f_acti"></div>
        <span id="f_member"></span> <a class="f_rfs" href="javascript:;" onclick="refreshWallet()"></a>
    </div>
    <div class="f_list">

        <div class="f_item" wallet="main">
            <span class="fl">中心钱包(<span id="currencyShow">CNY</span>):</span> <span class="fn" style="display: inline;" id="centerAmount"></span>
            <div class="ld" style="display: none;"></div>
        </div>


    </div>
</div>

<div class="f_ctrl">
    <div class="f_ent">
        <a class="f_cei " href="/?r=mobile/financial/index"></a>
        <div class="f_cet">存款</div>
    </div>
    <div class="f_ent">
        <a class="f_cei fcw" href="/?r=mobile/financial/withdraw"></a>
        <div class="f_cet">提款</div>
    </div>
    <div class="f_ent">
        <a class="f_cei fch  fch_on" href="/?r=mobile/financial/vip"></a>
        <div class="f_cet">贵宾报表</div>
    </div>
</div>
<div class="f_bg">
    <div class="f_sd"></div>
    <div class="f_ag h">
        <div></div>
    </div>
</div>
<div class="deposit_pan">
<div class="mm3">
<div class="h_form">
<div class="h_row">
<form id="historyForm">
    <select class="h_slt" name="trantype" onchange="lx(this.value);">
        <option value="4">-------------彩票投注记录------------</option>
        <option value="3">-------------视讯直播记录------------</option>
        <option value="5">-------------金额交易记录------------</option>
        <option value="2">-------------盈利统计记录------------</option>
    </select>
    <div class="h_tg"></div>
</form>
</div>
</div>
<div id="MACenterContent">
    <div class="h_row">
        <select class="h_slt" name="trantype" onchange="cx(this.value);">
            <option value="today" >----------------今日交易---------------</option>
            <option value="history" selected="selected">----------------历史交易---------------</option>    
        </select>
        <div class="h_tg"></div>
    </div>
    
    <div class="MPanel" style="display: block;">
        <table class="MMain" border="1">
            <tr class="title_tr">
                <th width="20%">日期</th>
                <th width="30%">下注金额</th>
                <th width="30%">未结算金额</th>
                <th width="20%">结果</th>
            </tr>
            <tr align="right" class="MColor1">
                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time1"]); ?>"><?php echo ($arr["time1"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time1"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time1"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time1"]); ?></td>
            </tr>
            <tr align="right" class=" MColor2">

                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time2"]); ?>"><?php echo ($arr["time2"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time2"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time2"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time2"]); ?></td>
            </tr>
            <tr align="right" class="MColor1">

                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time3"]); ?>"><?php echo ($arr["time3"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time3"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time3"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time3"]); ?></td>
            </tr>
            <tr align="right" class=" MColor2">

                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time4"]); ?>"><?php echo ($arr["time4"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time4"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time4"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time4"]); ?></td>
            </tr>
            <tr align="right" class="MColor1">

                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time5"]); ?>"><?php echo ($arr["time5"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time5"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time5"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time5"]); ?></td>
            </tr>
            <tr align="right" class=" MColor2">

                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time6"]); ?>"><?php echo ($arr["time6"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time6"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time6"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time6"]); ?></td>
            </tr>
            <tr align="right" class="MColor1">

                <td style="text-align: center;">
                    <a class="pagelink" href="/?r=mobile/lottery/lottery&time=<?php echo ($arr["time7"]); ?>"><?php echo ($arr["time7"]); ?></a>
                </td>
                <td style="text-align: center;"><?php echo ($arr2["time7"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr3["time7"]); ?></td>
                <td style="text-align: center;"><?php echo ($arr4["time7"]); ?></td>
            </tr>
            <tr>
                <td style="text-align: center;">总计</td>
                <td style="text-align: center;" align="right"><?php echo ($arr2["time_sum"]); ?></td>
                <td style="text-align: center;" align="right"><?php echo ($arr3["time_sum"]); ?></td>
                <td style="text-align: center;" align="right"><?php echo ($arr4["time_sum"]); ?></td>
            </tr>
        </table>   
        <div style="height: 100px;"></div>
    </div>           
</div> 
</div></div>