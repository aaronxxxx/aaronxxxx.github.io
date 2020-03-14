<?php

use yii\widgets\LinkPager;
?>

<script type="text/javascript" language="javascript" src="/public/live/js/live_order.js"></script> 
<div id="pageMain">

    <form name="gridSearchForm" id="gridSearchForm" method="get" action="#/live/pe/index" onSubmit="return check();" class="trinput">
        <div class="pro_title pd10">体育注单
        <?php
        //use Yii;
        //var_dump(array_values(Yii::$app->getModule('live')->params['pe']));
        ?>
        </div>

        <input type="hidden" name="r" value="live/pe/index"/>
        <div class="trinput pd10 font13">
            <input type="button" value="更新注单" onclick="updateOrder();"></input>&nbsp;&nbsp;
            美东时间： <input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $start_order_time; ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})"> 
            ~
            <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $end_order_time; ?>" onClick="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
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

        </div>
        <div class="trinput pd10 font13">
            平台类型：
            <select name="game_type" id="live_type" onChange="onurlchange()" >
                <option value="ALL"  <?php echo $game_type == 'ALL' ? 'selected' : ''; ?>>全部</option>
                <option value="Bb_Sport"  <?php echo $game_type == 'Bb_Sport' ? 'selected' : ''; ?>>BBIN体育</option>
                <option value="SBTA"  <?php echo $game_type == 'SBTA' ? 'selected' : ''; ?>>AG体育</option>
            </select>
            &nbsp;&nbsp;
            用户名：<input name="user_str" value="<?php echo $user_str; ?>" style="width: 160px;" type="text"> (多个用户用 , 隔开)
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" name="submitbtn" value="搜索" id="submitbtn"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(温馨提示：点击平台账号可查询会员真人账户金额)
        </div>


    </form>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10" >
        <tr class="t-title dailitr">
            <td align="center"><strong>编号</strong></td>
            <td align="center"><strong>会员账号</strong></td>
            <td align="center"><strong>平台账号</strong></td>
            <td align="center"><strong>单号</strong></td>
            <td align="center"><strong>下注时间</strong></td>
            <td align="center"><strong>游戏类型</strong></td>
            <td align="center"><strong>下注内容</strong></td>
            <td align="center"><strong>下注金额</strong></td>
            <td align="center"><strong>有效投注</strong></td>
            <td align="center"><strong>结果</strong></td>
            <td align="center"><strong>游戏平台</strong></td>
        </tr>
        <?php
        $curr_bet_money = $curr_live_win = $curr_valid_bet_amount = 0;
        foreach ($rs as $key => $value) {

            $curr_bet_money += $value['bet_money'];
            $curr_live_win += $value['live_win'];
            $curr_valid_bet_amount += $value['valid_bet_amount'];
            ?>
            <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
                <td  align="center" valign="middle"><?php echo $key + 1; ?></td>
                <td align="center" valign="middle"><?php echo $value['user_name']; ?></td>
                <td align="center" valign="middle"><a href="javascript:showMoneyDialog('<?= $value['user_name']; ?>')" title='点击查看当前真人账户余额'><?php echo $value['live_username']; ?></a></td>
                <td align="center" valign="middle"><?php echo $value['order_num']; ?></td>
                <td align="center" valign="middle"><?php echo $value['order_time']; ?></td>
                <td align="center" valign="middle"><?php echo $value["live_type"]; ?></td>
                <td align="center" valign="middle"><?php echo $value["bet_info"]; ?></td>
                <td align="center" valign="middle"><?php echo $value['bet_money'] ?></td>
                <td align="center" valign="middle"><?php echo $value['valid_bet_amount'] ?></td>
                <td align="center" valign="middle"><?php echo $value['live_win'] ?></td>
                <td align="center" valign="middle"><?php echo $value['game_type'] ?></td>
            </tr>

            <?php
        }
        ?>
        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
            <td  align="right" colspan="7"><strong>当页:</strong></td>
            <td align="center" valign="middle"><?php echo $curr_bet_money ?></td>
            <td align="center" valign="middle"><?php echo $curr_valid_bet_amount ?></td>
            <td align="center" valign="middle"><?php echo $curr_live_win ?></td>
            <td align="center" valign="middle"></td>
        </tr>

        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#ffffff'" style="background-color:#FFFFFF; line-height:20px;">
            <td  align="right" colspan="7"><strong>总计:</strong></td>
            <td align="center" valign="middle"><?php echo $total_bet_money ?></td>
            <td align="center" valign="middle"><?php echo $total_valid_bet_amount ?></td>
            <td align="center" valign="middle"><?php echo $total_live_win ?></td>
            <td align="center" valign="middle"></td>
        </tr>


    </table>
    <?php
    echo LinkPager::widget(['pagination' => $pagination,]);
    ?>
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
    function onurlchange() {
        location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
    }
    $(function () {
        $('#submitbtn').bind('click', function (e) {
            location.href = $('#gridSearchForm').attr('action') + "&" + $('#gridSearchForm').serialize();
        });
    });
</script>