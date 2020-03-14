<?php

use yii\widgets\LinkPager;
?>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#CCCCCC" class="mgt10">
        <tr>
            <td height="24">
                <font>
                <span class="pro_title">
                    代理管理：下属会员信息
                </span>
                </font>
                <a href="/?r=agentht/agent/agents-list2&Oid=1" style="font-size: 13px;margin-left: 50px;color: #f34541">查询在线下属会员信息</a>
            </td>
        </tr>
    </table>
    <div id="pageMain" align="center">
        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
            <tbody>
                <tr>
                    <td valign="top">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0"  class="font13 skintable line35 mgt10" id=editProduct >
    <tbody>
        <tr>
            <td style="width: 15%" align="center" height="25"><strong>代理用户名</strong></td>
            <td style="width: 17%" align="center"><strong>真实姓名</strong></td>
            <td style="width: 17%" align="center"><strong>最近登入时间</strong></td>
            <td style="width: 17%" align="center"><strong>注册时间</strong></td>
            <td style="width: 17%" align="center"><strong>当前余额</strong></td>
            <td style="width: 17%" align="center"><strong>在线状态</strong></td>
        </tr>
        <?php
        if ($user_list) {
            foreach ($user_list as $key => $value) {
                ?>
                <tr align="center" onmouseover="this.style.backgroundColor ='#EBEBEB'" onmouseout="this.style.backgroundColor =' #ffffff'" style="line-height: 20px; background-color: rgb(255, 255, 255);">
                    <td height="40" align="center" valign="middle">
                        <a style="color: #F37605;" href="#"><?php echo $value['user_name'] ?></a>
                    </td>
                    <td align="center" valign="middle"><?php echo $value['pay_name'] ?></td>
                    <td align="center" valign="middle"><?php echo $value['logintime'] ?></td>
                    <td align="center" valign="middle"><?php echo $value['regtime'] ?></td>
                    <td align="center" valign="middle"><?php echo $value['money'] ?></td>
                    <?php
                    if ($value['Oid'] == '') {
                        ?>
                        <td align="center" valign="middle">离线</td>
                        <?php
                    } else {
                        ?>
                        <td align="center" valign="middle" style="color: red">在线</td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </tbody>
</table>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        if ($user_list) {
            echo LinkPager::widget(['pagination' => $pages]);
        }
        ?>
    </div>
</body>