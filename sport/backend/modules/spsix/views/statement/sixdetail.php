<?php use yii\widgets\LinkPager;?>
<div id="pageMain">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody><tr>
            <td valign="top">
                <form name="form1" id="form1" method="get" action="">
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                        <tbody>
                        <?if($group!=''){?>
                            <tr>
                                <td bgcolor="#FFFFFF" align="left">
                                    <a href="/?r=spsix/statement/six-detail" style="color: #F37605;" title="返回上一页">返回上一页</a>
                                </td>
                            </tr>
                        <? }?>
                        <tr>
                            <td align="left" bgcolor="#FFFFFF">
                                &nbsp;&nbsp;
                                日期：<input name="s_time" type="text" id="s_time" value="<?=$startTime;?>"  size="10" maxlength="10" readonly="readonly" style="width: 120px;">
                                ~
                                <input name="e_time" type="text" id="e_time" value="<?=$endTime;?>"  size="10" maxlength="10" readonly="readonly" style="width: 140px;">
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
                                    <?php foreach ($monthArray as $key=>$val){?>
                                        <option value="<?=$key?>" <?= $key==$month ? 'selected':"";?>><?=$val;?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#FFFFFF">
                                &nbsp;&nbsp;
                                用户名：<input name="user_in" value="<?=$userIn;?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                忽略用户名：<input name="user_nin" value="<?=$userNin;?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="hidden" name="r" value="spsix/statement/six-detail">
                                <input type="hidden" name="group" value="<?=$group;?>">
                                <input type="submit" name="Submit" value="搜索">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <tbody><tr class="namecolor">
                        <?php if($group!='num'){?>
                            <td align="center" height="25"><strong>游戏名称</strong></td>
                            <td align="center"><strong>下注笔数</strong></td>
                        <?php } ?>
                        <?php if($group=='user'){?>
                            <td align="center">用户名(真实名字)</td>
                        <?php } ?>
                        <?php if($group=='num'){?>
                            <td align="center">订单号</td>
                            <td align="center">彩票类别</td>
                            <td align="center">彩票期号</td>
                            <td align="center">投注玩法</td>
                            <td align="center">投注内容</td>
                            <td align="center">投注金额</td>
                            <td align="center">反水</td>
                            <td align="center">赔率</td>
                            <td align="center">输赢结果</td>
                            <td align="center">投注时间</td>
                            <td align="center">投注账号</td>
                            <td align="center">状态</td>
                        <?php }else{?>
                            <td align="center"><strong>下注金额</strong></td>
                            <td align="center"><strong>下注结果</strong></td>
                            <td align="center"><strong>赢取金额</strong></td>
                        <?php } ?>
                    </tr>
                    <?php
                    $betMoney = $betResult = 0;
                    foreach ($data as $key=>$val){ ?>
                        <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                            <?php if($group==''){?>
                                <td height="25" align="center" valign="middle">
                                    <a title="极速六合彩" style="color: #F37605;" href="/?r=spsix/statement/six-detail&s_time=<?=$startTime;?>&e_time=<?=$endTime;?>&user_in=<?=$userIn;?>&user_nin=<?=$userNin;?>&date_month=<?=$month;?>&group=user">极速六合彩</a>
                                </td>
                            <?php }?>
                            <?php if($group=='user'){?>
                                <td height="25" align="center" valign="middle">极速六合彩</td>
                                <td align="center" valign="middle"><a title="极速六合彩" style="color: #F37605;" href="/?r=spsix/statement/six-detail&s_time=<?=$startTime;?>&e_time=<?=$endTime;?>&user_in=<?=$userIn;?>&user_nin=<?=$userNin;?>&date_month=<?=$month;?>&group=num&user=<?=$val['user_name'];?>"><?=$val['user_name'];?></a>(<?=$val['pay_name']?>)</td>
                            <?php } ?>
                            <?php if($group=='num'){?>
                                <td align="center" valign="middle"><?=$val['order_sub_num'];?></td>
                                <td align="center" valign="middle">极速六合彩</td>
                                <td align="center" valign="middle"><?=$val['lottery_number'];?></td>
                                <td align="center" valign="middle"><?=$val['rtype_str'];?></td>
                                <td align="center" valign="middle"><?=$val['number'];?></td>
                                <td align="center" valign="middle"><?=$val['bet_money'];?></td>
                                <td align="center" valign="middle"><?=$val['fs'];?></td>
                                <td align="center" valign="middle"><?=$val['bet_rate'];?></td>
                                <td align="center" valign="middle"><?= $val['is_win_total'] ? $val['is_win_total']:0;?></td>
                                <td align="center" valign="middle"><?=$val['bet_time'];?></td>
                                <td align="center" valign="middle"><?=$val['user_name'];?></td>
                                <td align="center" valign="middle"style="color: <?php echo $val['status']==1 ? "#FF0000":"#0000FF";?>"><?=$status[$val['status']];?></td>
                            <?php }else{?>
                                <td align="center" valign="middle"><?=$val['count_total'];?></td>
                                <td align="center" valign="middle"><?= $val['bet_money'] ? $val['bet_money']:0;;?></td>
                                <td align="center" valign="middle"><?= $val['is_win_total'] ? $val['is_win_total']:0;?></td>
                                <td align="center" valign="middle"><?=$val['bet_money']-$val['is_win_total'];?></td>
                            <?php } ?>
                        </tr>
                    <?php
                        $betMoney += $val['bet_money'];
                        $betResult += $val['is_win_total'];
                    }?>
                    <?php if($group==''){?>
                        <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                            <td height="25" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。如果是正数，说明赢钱，如果是负数，则为输钱。</td>
                        </tr>
                    <?php }else if($group=='user'){?>
                        <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                            <td height="25" align="center" valign="middle" colspan="6">当前页总投注金额:<?=$betMoney?>元    当前页投注结果:<?=$betResult;?>元   当前页赢取金额:<?=$betMoney-$betResult;?>元</td>
                        </tr>
                    <?php }else{?>
                    <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                        <td height="25" align="center" valign="middle" colspan="12">当前页总投注金额:<?=$betMoney?>元    当前页投注结果:<?=$betResult;?>元   当前页赢取金额:<?=$betMoney-$betResult;?>元</td>
                    </tr>
                    <? } ?>
                    </tbody>
                </table>
                <?= LinkPager::widget(['pagination' => $pages]); ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>