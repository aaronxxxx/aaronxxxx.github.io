<?php

use yii\widgets\LinkPager;
?>
<script type="text/javascript" language="javascript" src="/public/live/js/live_order.js"></script> 
<div id="pageMain">
   
                <form name="gridSearchForm" id="gridSearchForm" method="get" action="/#/live/order/index" onSubmit="return check();">
                    <div  class="font13 trinput">
                         <div class="pro_title pd10">反水列表</div>


                        <input type="hidden" name="r" value="live/fs/record"/>
                        <p>
                         
                                美东时间： <input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $start_order_time; ?>" onClick="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})"> 
                                ~
                                <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $end_order_time; ?>" onClick="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">

                                <input type="button" value="今日" onclick="setDate('today')"/>
                                <input type="button" value="昨日" onclick="setDate('yesterday')"/>
                                <input type="button" value="本周" onclick="setDate('thisWeek')"/>
                                <input type="button" value="上周" onclick="setDate('lastWeek')"/>
                                <input type="button" value="本月" onclick="setDate('thisMonth')"/>
                                <input type="button" value="上月" onclick="setDate('lastMonth')"/>
                                <input type="button" value="最近7天" onclick="setDate('lastSeven')"/>
                                <input type="button" value="最近30天" onclick="setDate('lastThirty')"/>
                                <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                                    <option value="">选择月份</option>
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

                        </p>
                        <p>
                        
                                平台类型：
                                <select name="game_type" id="live_type" onChange="onurlchange();" >
                                    <option value="ALL"  <?php echo $game_type == 'ALL' ? 'selected' : ''; ?>>全部</option>
                                    <option value="AG"  <?php echo $game_type == 'AG' ? 'selected' : ''; ?>>AG</option>
                                    <option value="AGIN"  <?php echo $game_type == 'AGIN' ? 'selected' : ''; ?>>AGIN</option>
                                    <option value="AG_BBIN"  <?php echo $game_type == 'AG_BBIN' ? 'selected' : ''; ?>>AG_BBIN</option>
                                    <option value="DS"  <?php echo $game_type == 'DS' ? 'selected' : ''; ?>>DS</option>
                                    <option value="AG_MG"  <?php echo $game_type == 'AG_MG' ? 'selected' : ''; ?>>AG_MG</option>
                                    <option value="AG_OG"  <?php echo $game_type == 'AG_OG' ? 'selected' : ''; ?>>AG_OG</option>
                                    <option value="OG"  <?php echo $game_type == 'OG' ? 'selected' : ''; ?>>OG</option>
                                    <option value="KG"  <?php echo $game_type == 'KG' ? 'selected' : ''; ?>>KG</option>
                                    <option value="YOPLAY"  <?php echo $game_type == 'YOPLAY' ? 'selected' : ''; ?>>YOPLAY</option>
                                    <option value="VR"  <?php echo $game_type == 'VR' ? 'selected' : ''; ?>>VR</option>
                                </select>
                                &nbsp;&nbsp;
                                用户名：<input name="user_str" value="<?php echo $user_str; ?>" style="width: 160px;" type="text"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" id="submitbtn" name="Submit" value="搜索" />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(温馨提示：点击平台账号可查询会员真人账户金额)
                            </td
                        </p>

                    </div>
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10" >
                    <tr class="namecolor">
                        <td style="width: 14%" align="center" height="25"><strong>用户名</strong></td>
                        <td style="width: 20%" align="center"><strong>真人会员账号</strong></td>
                        <td style="width: 12%" align="center"><strong>有效金额</strong></td>
                        <td style="width: 12%" align="center"><strong>反水金额</strong></td>
                        <td style="width: 12%" align="center"><strong>反水比例</strong></td>
                        <td style="width: 15%" align="center"><strong>反水日期</strong></td>
                        <td style="width: 15%" align="center"><strong>执行时间</strong></td>
                    </tr>
                    <?php
                    foreach ($rs as $key => $row) {
                        ?>

                        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" 
                            onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF;">
                            <td  align="center" valign="middle"><?= $row["USERNAME"] ?></td>
                            <td align="center" valign="middle"><?= $row['USERNAME_LIVE'] ?></td>
                            <td align="center" valign="middle"><?= $row['VALIDMONEY'] ?></td>
                            <td align="center" valign="middle"><?= $row['FSMONEY'] ?></td>
                            <td align="center" valign="middle"><?= $row['FS_RATE'] ?>%</td>
                            <td align="center" valign="middle"><?= substr($row['FSTIME'], 0, 10) ?></td>
                            <td align="center" valign="middle"><?= $row['ADDTIME'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr >
                        <td colspan="11" align="center" valign="middle">
                            <?php
                            echo LinkPager::widget(['pagination' => $pagination,]);
                            ?>
                        </td>
                    </tr>
                </table>

        
</div>
<script>
function onurlchange(){
	location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
}
$(function(){
	$('#submitbtn').bind('click', function (e) {
		location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
		});
});
</script>