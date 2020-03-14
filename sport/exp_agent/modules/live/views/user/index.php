<?php 
use yii\widgets\LinkPager;
?>

  <script type="text/javascript" language="javascript" src="/public/live/js/live_order.js"></script>
<div id="pageMain">


            <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/live/user/index" onSubmit="return check();" class="trinput font14 pd10">
                    <div class="pro_title pd10">平台帐号列表</div>
                     <input type="hidden" name="r" value="live/user/index"/>
                        <p>
                            <span>
                              美东时间： <input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $start_order_time; ?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                                    ~
                                    <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $end_order_time; ?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">

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
                            </span>
                        </p>

                        <p>
                            <span>
                            平台类型：
                                                <select name="game_type" id="live_type" onChange="onurlchange()" >
                                                    <option value="ALL"  <?php echo $game_type == 'ALL' ? 'selected' : ''; ?>>全部</option>
                                                    <option value="AG"  <?php echo $game_type == 'AG' ? 'selected' : ''; ?>>AG</option>
                                                    <option value="AGIN"  <?php echo $game_type == 'AGIN' ? 'selected' : ''; ?>>AGIN</option>
                                                    <option value="AG_BBIN"  <?php echo $game_type == 'AG_BBIN' ? 'selected' : ''; ?>>AG_BBIN</option>
                                                    <option value="DS"  <?php echo $game_type == 'DS' ? 'selected' : ''; ?>>DS</option>
                                                    <option value="AG_MG"  <?php echo $game_type == 'AG_MG' ? 'selected' : ''; ?>>AG_MG</option>
                                                    <option value="AG_OG"  <?php echo $game_type == 'AG_OG' ? 'selected' : ''; ?>>AG_OG</option>
                                                    <option value="OG"  <?php echo $game_type == 'OG' ? 'selected' : ''; ?>>OG</option>
                                                    <option value="KG"  <?php echo $game_type == 'KG' ? 'selected' : ''; ?>>KG</option>
                                                </select>
                            &nbsp;&nbsp;
                            用户名：<input name="user_str" value="<?php echo $user_str; ?>" style="width: 160px;" type="text"> (多个用户用 , 隔开)&nbsp;&nbsp;(存在查询会员名，时间条件失效)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <input type="button" name="Submit" value="搜索" id="submitbtn"/>
                            </span>
                        </p>

                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35" >
                    <tr>
                        <td style="width: 5%;" align="center"><strong>编号</strong></td>
                        <td style="width: 8%;" align="center" height="25"><strong>用户名</strong></td>
                        <td style="width: 10%;" align="center"><strong>平台类型</strong></td>
                        <td style="width: 6%;" align="center"><strong>平台账号</strong></td>
                        <td style="width: 8%;" align="center"><strong>账号金额</strong></td>
                        <td style="width: 8%;" align="center"><strong>财务操作</strong></td>
                        <td style="width: 8%;" align="center"><strong>更新日期</strong></td>
                    </tr>

                    <?php

                    foreach ($rs as $key=>$value){
                            ?>
                            <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
                                <td align="center" valign="middle"><?php echo $value["id"]; ?></td>
                                <td  align="center" valign="middle"><?php echo $value['userList']['user_name']; ?></td>
                                <td align="center" valign="middle"><?php echo $value["live_type"]; ?></td>
                                <td align="center" valign="middle"><?php echo $value['live_username']; ?></td>
                                <td align="center" valign="middle"><a href="javascript:showMoneyDialog('<?= $value['userList']['user_name']; ?>')" title='点击查看当前真人账户余额'><?php echo $value['live_money']; ?></a></td>
                                <td align="center" valign="middle"><a href='/#/live/user/transfer&uid=<?= $value['user_id'] ?>&hall=<?php echo $value["live_type"];?>'>转入转出</a></td>
                                <td align="center" valign="middle"><?= $value['update_time'] ?></td>
                            </tr>
                            <?php
                    }
                    ?>
                    <tr >
                        <td colspan="11" align="center" valign="middle"><?php echo LinkPager::widget(['pagination' => $pagination,]); ?></td>
                    </tr>
                </table>

</div>
<script>
    function showMoneyDialog(name) {
        layer.open({
            type: 2,
            title: '查询真人实时余额',
            area: ['600px', '340px'],
            content: '/?r=live/order/money&name='+name
        });
    }
function onurlchange(){
	location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
}
$(function(){
	$('#submitbtn').bind('click', function (e) {
		location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
		});
});
</script>