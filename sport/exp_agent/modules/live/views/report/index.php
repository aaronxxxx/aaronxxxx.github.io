<?php

use yii\widgets\LinkPager;
?>

<script type="text/javascript" language="javascript" src="/public/live/js/laydate/laydate.js"></script> 
<script type="text/javascript" language="javascript" src="/public/live/js/live_order.js"></script> 
<div id="pageMain">
    <div class="font14 trinput" >
                <form name="form1" id="form1" method="get" action="/index.php?r=live/order/index" onSubmit="return check();"> 
                    <div class="pro_title pd10">真人注单</div>      
                        <input type="hidden" name="r" value="live/order/index"/>
                        <p>
                            <span>
                                &nbsp;&nbsp;
                                <input type="button" value="更新注单" onclick="updateOrder();"></input>&nbsp;&nbsp;
                                美东时间： <input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $start_order_time; ?>" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"> 
                                ~
                                <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $end_order_time; ?>" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
                                <script>
                                //日期范围限制
                                    var start = {
                                        elem: '#s_time',
                                        format: 'YYYY-MM-DD hh:mm:ss',
                                        min: '2000-06-16', //设定最小日期为当前日期
                                        max: '2099-06-16', //最大日期
                                        istime: true,
                                        istoday: false,
                                        choose: function (datas) {
                                            end.min = datas; //开始日选好后，重置结束日的最小日期
                                            end.start = datas //将结束日的初始值设定为开始日
                                        }
                                    };
                                    var end = {
                                        elem: '#e_time',
                                        format: 'YYYY-MM-DD  hh:mm:ss',
                                        min: '2000-06-16',
                                        max: '2099-06-16',
                                        istime: true,
                                        istoday: false,
                                        choose: function (datas) {
                                            start.max = datas; //结束日选好后，充值开始日的最大日期
                                        }
                                    };
                                    laydate(start);
                                    laydate(end);
                                </script>
                                <input type="button" value="今日" onclick="setDate('today')"/>
                                <input type="button" value="昨日" onclick="setDate('yesterday')"/>
                                <input type="button" value="本周" onclick="setDate('thisWeek')"/>
                                <input type="button" value="上周" onclick="setDate('lastWeek')"/>
                                <input type="button" value="本月" onclick="setDate('thisMonth')"/>
                                <input type="button" value="上月" onclick="setDate('lastMonth')"/>
                                <input type="button" value="最近7天" onclick="setDate('lastSeven')"/>
                                <input type="button" value="最近30天" onclick="setDate('lastThirty')"/>
                                <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                                    <option value=""   <?php echo $date_month == '' ? 'selected' : ''; ?>>选择月份</option>
                                    <option value="1"  <?php echo $date_month == 1 ? 'selected' : ''; ?>>1月</option>
                                    <option value="2"  <?php echo $date_month == 2 ? 'selected' : ''; ?>>2月</option>
                                    <option value="3"  <?php echo $date_month == 3 ? 'selected' : ''; ?>>3月</option>
                                    <option value="4"  <?php echo $date_month == 4 ? 'selected' : ''; ?>>4月</option>
                                    <option value="5"  <?php echo $date_month == 5 ? 'selected' : ''; ?>>5月</option>
                                    <option value="6"  <?php echo $date_month == 6 ? 'selected' : ''; ?>>6月</option>
                                    <option value="7"  <?php echo $date_month == 7 ? 'selected' : ''; ?>>7月</option>
                                    <option value="8"  <?php echo $date_month == 8 ? 'selected' : ''; ?>>8月</option>
                                    <option value="9"  <?php echo $date_month == 9 ? 'selected' : ''; ?>>9月</option>
                                    <option value="10" <?php echo $date_month == 10 ? 'selected' : ''; ?>>10月</option>
                                    <option value="11" <?php echo $date_month == 11 ? 'selected' : ''; ?>>11月</option>
                                    <option value="12" <?php echo $date_month == 12 ? 'selected' : ''; ?>>12月</option>
                                </select>

                            </span>
                        </p>
                        <p>
                            <span>
                       
                            
                                平台类型：
                                <select name="game_type" id="live_type" onChange="self.form1.submit()" >
                                    <option value="ALL"  <?php echo $game_type == 'ALL' ? 'selected' : ''; ?>>全部</option>
                                    <option value="AG"  <?php echo $game_type == 'AG' ? 'selected' : ''; ?>>AG</option>
                                    <option value="AGIN"  <?php echo $game_type == 'AGIN' ? 'selected' : ''; ?>>AGIN</option>
                                    <option value="AG_BBIN"  <?php echo $game_type == 'AG_BBIN' ? 'selected' : ''; ?>>BBIN</option>
                                    <option value="DS"  <?php echo $game_type == 'DS' ? 'selected' : ''; ?>>DS</option>
                                    <option value="AG_MG"  <?php echo $game_type == 'AG_MG' ? 'selected' : ''; ?>>MG</option>
                                    <option value="AG_OG"  <?php echo $game_type == 'AG_OG' ? 'selected' : ''; ?>>OG</option>
                                </select>
                                &nbsp;&nbsp;
                                用户名：<input name="user_str" value="<?php echo $user_str; ?>" style="width: 160px;" type="text"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="submit" name="Submit" value="搜索" />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(温馨提示：点击平台账号可查询会员真人账户金额)
                            </span>
                        </p>

                </form>
    </div>
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
                            <td align="center" valign="middle"><a href="javascript:showMoneyDialog('<?=$value['user_name']; ?>')" title='点击查看当前真人账户余额'><?php echo $value['live_username']; ?></a></td>
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

                    <tr >
                        <td colspan="12" align="center" valign="middle">
                            <?php
                            echo LinkPager::widget(['pagination' => $pagination,]);
                            ?>
                        </td>
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
</script>