<?php use yii\widgets\LinkPager;?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
    <tr class="trinput font14 mgb10">
        <td height="24" style="width: 250px;">
            <span class="pro_title">
                代理管理：代理报表信息-lottery
            </span>
        </td>
        <td>
            <input type="button" value="六合彩" onclick="setType('six')"/>
            <input type="button" value="极速六合彩" onclick="setType('spsix')"/>
            <input type="button" value="彩票" onclick="setType('lottery')"/>
            <input type="button" value="賽事" onclick="setType('event')"/>
        </td>
    </tr>
</table>
<div id="pageMain" style="margin-top: 20px;">
    <form name="form1" method="get" id="gridSearchForm" action="/?r=agentht/order/lottery" id="form1">
        <input type="hidden" name="r" value="agentht/order/lottery">
        <table width="100%" class="mgb10">
            <tbody>
            <tr class="trinput inputct">
                <td align="center" bgcolor="#FFFFFF">

                    日期：<input id="s_time" name="s_time" type="text" value="<?= $time['s_time']?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                    ~
                    <input id="e_time" name="e_time" type="text" value="<?= $time['e_time']?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                    订单号：<input name="order_sub_num" type="text" id="order_sub_num" value="<?= $time['order_sub_num']?>" />
                    期数：<input id="qishu" type="text" size="15" value="<?= $time['qishu']?>" name="qishu">
                    会员：<input id="user_name" type="text" size="15" value="<?= $time['user']?>" name="user_name">
                    &nbsp;
                    <input type="submit" id="gridSearchBtn" name="Submit" value="搜索">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <table width="100%" border="0" cellpadding="5" id="orderlist" cellspacing="1" class="font12 skintable line35">
        <tr class="t-title dailitr">
            <td align="center"><strong>订单号</strong></td>
            <td align="center"><strong>彩票期号</strong></td>
            <td align="center"><strong>投注玩法</strong></td>
            <td align="center"><strong>投注内容</strong></td>
            <td align="center"><strong>投注金额</strong></td>
            <td align="center"><strong>反水</strong></td>
            <td align="center"><strong>赔率</strong></td>
            <td height="25" align="center"><strong>可赢金额</strong></td>
            <td align="center"><strong>投注时间</strong></td>
            <td align="center"><strong>投注账号</strong></td>
        </tr>
        <?php
        if($list){
            foreach($list as $key => $rows) {
                ?>
                <tr align="center" onMouseOver="this.style.backgroundColor='<?=$rows['is_win']>0 ? '#FFE1E1':'#EBEBEB'?>'" onMouseOut="this.style.backgroundColor='<?=$rows['is_win']>0 ? '#FFE1E1':'#FFFFFF'?>'" style="background-color:<?=$rows['is_win']>0 ? '#FFE1E1':'#FFFFFF';?>; line-height:20px;">
                    <td height="25" align="center" valign="middle"><?=  $rows['order_sub_num']?></td>
                    <td align="center" valign="middle"><?= $rows['lottery_number'] ?></td>
                    <td align="center" valign="middle"><?= $rows['rtype_str'] ?></td>
                    <td align="center" valign="middle"><?= $rows['quick_type'] ?> - <?= $rows['number'] ?></td>
                    <td align="center" valign="middle" class="bet_money"><?= $rows['bet_money'] ?></td>
                    <td align="center" valign="middle"><?= $rows['fs'] ?></td>
                    <td align="center" valign="middle"><?= $rows['bet_rate'] ?></td>
                    <td align="center" valign="middle"><?= $rows['win'] ?></td>
                    <td><?= substr($rows['bet_time'], 5) ?></td>
                    <td><?= $rows['user_name'] ?></td>
                <tr>
                    <td colspan="11" style="padding: 0px;">
<!--                    <img class="img-img" src="--><?//=Yii::$app->params['resouceDomain']?><!--/order/--><?//=substr($rows['order_sub_num'],0,8)?><!--/--><?//=$rows['order_sub_num']?><!--.jpg">-->
                </tr>
                <?php
            }
        }
        ?>
        <tr class="ctinfo">
            <td colspan="13" align="center" valign="middle">当前页总投注金额:<font id="bet_money"><?= $bet_money ?></font>元</td>
        </tr>
        <tr >
            <td colspan="13" align="center" valign="middle">
                <?php if($list) echo LinkPager::widget(['pagination' => $pages]); ?>
            </td>
        </tr>
    </table>
</div>
<script>
    function setType(type){
        if(type == 'six'){
            window.location.href="/?r=agentht/order/six";
        }
        if(type == 'spsix'){
            window.location.href="/?r=agentht/order/spsix";
        }
        if(type == 'lottery'){
            window.location.href="/?r=agentht/order/lottery";
        }
        if(type == 'event'){
            window.location.href="/?r=agentht/order/event";
        }
    }
</script>