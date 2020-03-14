<?php

use yii\widgets\LinkPager;
?>
<body>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="mgt10 mgb10">
        <tbody>
            <tr>
                <td height="24">
                    <font>
                    <span class="pro_title">
                        代理管理：查看结算明细
                    </span>
                    </font>
                </td>
            </tr>
        </tbody>
    </table>
    <form name="form2" method="post" action="" style="margin:0 0 0 0;">
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" >
            <tbody>
                <tr>
                    <td height="24" nowrap="" bgcolor="#FFFFFF"  align="center">
                        <table width="100%" border="1" class="font13 skintable line35" cellspacing="0" cellpadding="0"  id="editProduct" >       
                            <tbody>
                                <tr  class="t-title" align="center">
                                    <td width="15%" height="20"><strong>代理名</strong></td>
                                    <td width="12%"><strong>流水总额</strong></td>
                                    <td width="12%"><strong>盈利总额</strong></td>
                                    <td width="12%"><strong>分成比例%</strong></td>
                                    <td width="12%"><strong>算结金额</strong></td>
                                    <td width="11%"><strong>结算开始日期</strong></td>
                                    <td width="11%"><strong>结算结束日期</strong></td>
                                    <td width="15%"><strong>操作时间</strong></td>
                                </tr>
                                <?php
                                if ($account_list) {
                                    foreach ($account_list as $key => $value) {
                                        ?>
                                        <tr align="center" onmouseover="this.style.backgroundColor =' #EBEBEB'" onmouseout="this.style.backgroundColor =' #ffffff'" style="background-color: rgb(255, 255, 255);">
                                            <td style="height: 35px;"><?php echo $value['agents_name'] ?></td>
                                            <td><?php echo $value['ledger'] ?></td>
                                            <td><?php echo $value['profig'] ?></td>
                                            <td><?php echo $value['ratio'] ?></td>
                                            <td><?php echo $value['money'] ?></td>
                                            <td><?php echo $value['s_time'] ?></td>
                                            <td><?php echo $value['e_time'] ?></td>
                                            <td><?php echo $value['do_time'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        if ($account_list) {
                            echo LinkPager::widget(['pagination' => $pages]);
                        }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>