<?php

use yii\widgets\LinkPager;
?>

<script type="text/javascript" language="javascript" src="/public/live/js/live_order.js"></script> 
<div id="pageMain">
 
                <form name="form1" id="form1" method="get" action="#/live/log/index" onSubmit="return check();">
                    <div class="font12 trinput" >
                        <span>
                                <input type="hidden" name="r" value="live/log/index"/>
                                <select name="status" id="status" onChange="onurlchange()">
                                    <option value="0,1,2,4" <?php echo $status == '0,1,2,4' ? 'selected' : '' ?>>全部记录</option>
                                    <option value="4" style="color:#FF0000;" <?php echo $status == '4' ? 'selected' : '' ?>>待审核记录</option>
                                    <option value="0" style="color:#FF9900;" <?php echo $status == '0' ? 'selected' : '' ?>>未结算记录</option>
                                    <option value="1" style="color:#FF0000;" <?php echo $status == '1' ? 'selected' : '' ?>>成功记录</option>
                                    <option value="2" style="color:#FF0000;" <?php echo $status == '2' ? 'selected' : '' ?>>失败记录</option>

                                </select>
                                &nbsp;&nbsp;
                                <select name="game_type" id="live_type" onChange="onurlchange()" >
                                    <option value="ALL"  <?php echo $game_type == 'ALL' ? 'selected' : ''; ?>>所有平台</option>
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
                                日期： <input class="laydate-icon" name="s_time" id="s_time" value="<?php echo $start_order_time; ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})"> 
                                ~
                                <input class="laydate-icon" name="e_time" id="e_time" value="<?php echo $end_order_time; ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})">

                                &nbsp;&nbsp;
                                用户名：<input name="user_str" value="<?php echo $user_str; ?>" style="width: 160px;" type="text"> (多个用户用 , 隔开)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <input type="button" name="Submit" value="搜索" id="submitbtn"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(温馨提示：点击平台账号可查询会员真人账户金额)
                        </span>
                    </div>
                </form>
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10" >
                    <tr class="t-title dailitr">
                        <td align="center"><strong>订单号</strong></td>
                        <td align="center"><strong>游戏类型</strong></td>

                        <td align="center"><strong>平台账号</strong></td>
                        <td align="center"><strong>用户名</strong></td>
                        <td align="center"><strong>账转类型</strong></td>
                        <td align="center"><strong>账转金额</strong></td>
                        <td align="center"><strong>现金系统</strong></td>
                        <td align="center"><strong>提交时间</strong></td>
                        <td align="center"><strong>执行时间</strong></td>
                        <td height="25" align="center"><strong>行执结果</strong></td>
                    </tr>
                    <?php
                    $in_normal_total = $out_normal_total = 0;
                    foreach ($rs as $key => $value) {
                        if ($value['zz_type'] % 2 !== 0) {
							$bgcolor="#FFFFFF";
                            $zzType = "系统 => " . $value['live_type'];
                            $value['zz_type'] = "转入";
                            if (strpos($value["result"], "[成功]") !== false) {
                                $in_normal_total+=$value['zz_money'];
                            }
                        } elseif ($value['zz_type'] % 2 === 0) {
							$bgcolor="#ffe1e1";
                            $zzType = $value['live_type'] . " => 系统";
                            $value['zz_type'] = "转出";
                            if (strpos($value["result"], "[成功]") !== false) {
                                $out_normal_total+=$value['zz_money'];
                            }
                        }
                        ?>
                        <tr  align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor ='<?php echo $bgcolor;?>'" style="background-color:<?php echo $bgcolor;?>; line-height:20px;">
                            <td  align="center" valign="middle"><?php echo $value['order_num'] ?></td>
                            <td align="center" valign="middle"><?php echo $value["live_type"]; ?></td>

                            <td align="center" valign="middle">
                                <a href="javascript:showMoneyDialog('<?= $value['userList']['user_name']; ?>')" title='点击查看当前真人账户余额'>
    <?php echo $value['live_username'] ?>
                                </a>
                            </td>
                            <td align="center" valign="middle"><?php echo $value['userList']['user_name']; ?></td>
                            <td align="center" valign="middle"><?php echo $value['zz_type']; ?></td>
                            <td align="center" valign="middle"><?php echo $value['zz_money'] ?></td>
                            <td align="center" valign="middle">
                                <a href="/#/live/log/check&action=1&userid=<?php echo $value["user_id"]; ?>&username=<?php echo $value['userList']['user_name']; ?>" target="_blank">
                                    <span style="color:#F37605;">核查会员</span></a>
                            </td>

                            <td align="center" valign="middle"><?php echo $value['add_time'] ?></td>
                            <td align="center" valign="middle"><?php echo $value['do_time'] ?></td>
                            <td align="center" valign="middle">
                                <?php echo $value['result'] ?>
                                <?php if ($value['status'] == 4) {
                                    ?>
                                    <br/>
                                    <input type="button" value="审核通过" onclick="confirm_zz('<?php echo $value['id'] ?>')"/>
                                    <input type="button" value="审核拒绝" onclick="confuse_zz('<?php echo $value['id'] ?>', '<?php echo $value['user_id'] ?>')"/>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr >
                        <td colspan="10" align="center" valign="middle">当前页成功转入金额:<?php echo $in_normal_total ?>。&nbsp;&nbsp;  当前页成功转出金额:<?php echo $out_normal_total ?>。&nbsp;&nbsp;   <br/>当前页总盈利金额:<?php echo ($in_normal_total - $out_normal_total) ?>。(如果是正数，说明赢钱，如果是负数，则为输钱)</td>
                    </tr>
                    <tr >
                        <td colspan="10" align="center" valign="middle">                                                        
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
    function onurlchange(){
    location.href = $('#form1').attr('action') + "&" + $('#form1').serialize();
    }
    $(function(){
    $('#submitbtn').bind('click', function (e) {
    location.href = $('#form1').attr('action') + "&" + $('#form1').serialize();
    });
    });
</script>