<?php use yii\widgets\LinkPager;?>
<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
    <tr class="trinput font14 mgb10">
        <td height="24" style="width: 250px;">
            <span class="pro_title">
                代理管理：代理报表信息-spsix
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
    <form name="form1" method="get" id="gridSearchForm" action="/?r=agentht/order/spsix" id="form1">
        <input type="hidden" name="r" value="agentht/order/spsix">
        <table width="100%" class="mgb10">
            <tbody>
                <tr class="trinput inputct">
                    <td align="center">
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
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
        <tbody><tr class="dailitr">
            <td align="center"><strong>子订单号</strong></td>
            <td align="center"><strong>彩票期号</strong></td>
            <td align="center"><strong>投注玩法</strong></td>
            <td align="center"><strong>投注内容</strong></td>
            <td align="center"><strong>投注金额</strong></td>
            <td align="center"><strong>反水</strong></td>
            <td align="center"><strong>赔率</strong></td>
            <td align="center"><strong>可赢金额</strong></td>
            <td align="center"><strong>投注时间</strong></td>
            <td align="center"><strong>投注账号</strong></td>
        </tr>
        <?php
        $betMoney = $winMoney = 0;
        if($list){
            foreach ($list as $key=>$val){?>
                <tr align="center">
                    <td height="25" align="center" valign="middle"><?=$val['order_sub_num'];?></td>
                    <td align="center" valign="middle">极速六合彩</td>
                    <td align="center" valign="middle"><?=$val['qishu'];?></td>
                    <td align="center" valign="middle" style="max-width:115px"><?=$val['number'];?></td>
                    <td align="center" valign="middle"><?=$val['bet_money'];$betMoney+=$val['bet_money'];?></td>
                    <td align="center" valign="middle"><?=$val['fs'];?></td>
                    <td align="center" valign="middle"><?=$val['bet_rate'];?></td>
                    <td align="center" valign="middle"><?=$val['win_sub'];?></td>
                    <td ><?=$val['bet_time'];?></td>
                    <td><?=$val['user_name'];?></td>
                </tr>
                <tr>
                    <td colspan="15" style="padding: 0px;">
<!--                   <img class="img-img" src="/order/--><?//=substr($val['order_sub_num'],0,8)?><!--/--><?//=$val['order_sub_num']?><!--.jpg">-->
                </tr>
            <?php  }
        }?>
        <tr class="ctinfo">
            <td valign="middle" align="center" colspan="10">当前页总投注金额:<?=$betMoney;?>元</td>
        </tr>
        </tbody>
    </table>
    <?= LinkPager::widget(['pagination' => $pages]); ?>
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