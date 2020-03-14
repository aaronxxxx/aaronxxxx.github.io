<?php

use yii\widgets\LinkPager;
?>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：下属会员报表信息
                </span>
                </font>
            </td>
        </tr>
    </table>
    <div id="pageMain"  align="center">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td valign="top" align="center">
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
                            <form name="select_form" id="select_form" method="get" action="/?r=agentht/agent/cqk" onsubmit="return check();">
                                <input type="hidden" name="r" value="agentht/agent/cqk">
                                <tbody>
                                    <tr class="trinput inputct">
                                        <td align="center">
                                            <br>
                                            状态:
                                            <select name="agent_status" id="agent_status">
                                                <option value="成功" <?php echo $all['agent_status'] == '成功' ? 'selected' : ''; ?>>成功</option>
                                                <option value="失败" <?php echo $all['agent_status'] == '失败' ? 'selected' : ''; ?>>失败</option>
                                                <option value="未结算" <?php echo $all['agent_status'] == '未结算' ? 'selected' : ''; ?>>未结算</option>
                                                <option value="所有状态" <?php echo $all['agent_status'] == '所有状态' ? 'selected' : ''; ?>>所有状态</option>
                                            </select>
                                            &nbsp;&nbsp;
                                            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly"> 
                                            ~
                                            <input class="laydate-icon" name="e_time" id="e_time" value="<?= $time['e_time'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
                                            &nbsp;&nbsp;
                                            &nbsp;&nbsp;
                                            用户名：<input name="user_group" value="<?php echo $all['user_group']; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
                                            <input type="submit" name="Submit" value="搜索">
                                        </td>
                                    </tr>
                                </tbody>
                            </form>
                        </table>
                        <br>
                        <table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35" id=editProduct >
                            <tbody>
                                <tr >
                                    <td align="center" height="25"><strong>会员名称</strong></td>
                                    <td align="center"><strong>类型</strong></td>
                                    <td align="center"><strong>系统订单号</strong></td>
                                    <td align="center"><strong>汇款银行</strong></td>
                                    <td align="center"><strong>金额</strong></td>
                                    <td  align="center"><strong>提交时间</strong></td>
                                </tr>
                                <?php
                                if ($report_list) {
                                    foreach ($report_list as $key => $value) {
                                        $color = '';
                                        if ($value['type'] == '用户提款') {
                                            $color = " style='color:#FF0000;'";
                                        } elseif ($value['type'] == '银行汇款') {
                                            $color = "style='color:#FF9900;'";
                                        }
                                        ?>
                                        <tr  style="background-color: #fff">
                                            <td align="center" height="25"><?php echo $value['user_name']; ?></td>
                                            <td align="center" >
                                                <span <?php echo $color; ?>><?php echo $value['type']; ?></span>(<?php echo $value['status'] ?>)
                                            </td>
                                            <td align="center" height="45">
                                                <?php
                                                echo $value['order_num'];
                                                echo empty($value['about']) ? '' : "<br><span style='color:#FF0000;'>" . $value['about'] . "</span>";
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $value['order_value'] > 0 ? $value['pay_card'] : '';
                                                ?>
                                            </td>
                                            <td align="center">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="33%" style="color:#999999;" align="left"><?php echo $value['assets'] ?></td>
                                                        <td width="34%" style="color:#225d9c;" align="center">
                                                            <?php
                                                            echo $value['order_value'] > 0 ? $value['order_value'] : -$value['order_value'];
                                                            ?>
                                                        </td>
                                                        <td width="33%" style="color:#999999;" align="right"><?php echo $value['balance'] ?></td>       
                                                    </tr>
                                                </table>

                                            </td>
                                            <td  align="center"><?php echo $value['update_time']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                <tr align="center" style="background-color:#FFFFFF; line-height:20px;">
                                    <td height="45" align="left" valign="middle" colspan="6">
                                        总金额:<span style="color:#0000FF"><?= $all['online_money'] + $all['backend_money'] - ($all['qk_money'] + $all['qk_admin_money']) + $all['hk_money']; ?></span>
                                        存款(在线+后台):<span style="color:#006600;"><?= $all['online_money'] + $all['backend_money']; ?>(<?= $all['online_money']; ?>+<?= $all['backend_money']; ?>)</span> 
                                        取款(在线+后台):<span style="color:#FF0000;"><?= -($all['qk_money'] + $all['qk_admin_money']); ?>(<?= $all['qk_money']; ?>+<?= $all['qk_admin_money']; ?>)</span> 
                                        汇款:<span style="color:#CC9900;"><?= $all['hk_money']; ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if ($report_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>