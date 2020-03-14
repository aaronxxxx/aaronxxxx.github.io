<?php

use yii\widgets\LinkPager; ?>
<div id="pageMain">
  
<form name="gridSearchForm" id="gridSearchForm" method="get" action="#/report/lottery/detail" onSubmit="return check();" class="trinput inputct fone14">
    <div class="mgb10"><a title="返回上一页" style="color: #F37605;"  href="#/report/lottery/index&s_time=<?= urlencode($datas['s_time']) ?>&e_time=<?= urlencode($datas['e_time']) ?>&user_group=<?= $user_group ?>&user_ignore_group=<?= $user_ignore_group ?>">返回上一页</a>
    </div>
</form>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font13  skintable line35 mgt10">
    <tr>
        <td align="center"><strong>订单号</strong></td>
        <td align="center"><strong>彩票类别</strong></td>
        <td align="center"><strong>彩票期号</strong></td>
        <td align="center"><strong>投注玩法</strong></td>
        <td align="center"><strong>投注内容</strong></td>
        <td align="center"><strong>投注金额</strong></td>
        <td align="center"><strong>反水</strong></td>
        <td align="center"><strong>赔率</strong></td>
        <td height="25" align="center"><strong>输赢结果</strong></td>
        <td align="center"><strong>投注时间</strong></td>
        <td align="center"><strong>投注账号</strong></td>
        <td height="25" align="center"><strong>状态</strong></td>
    </tr>
    <?php if ($lotteryData) {
        foreach ($lotteryData as $key => $rows) {
            ?>
            <tr align="center" onMouseOver="this.style.backgroundColor='<?=$rows['is_win']>0 ? '#f75050':'#EBEBEB'?>'" onMouseOut="this.style.backgroundColor='<?=$rows['is_win']>0 ? '#f75050':'#FFFFFF'?>'" style="background-color:<?=$rows['is_win']>0 ? '#f75050':'#FFFFFF';?>; line-height:20px;">
                <td height="40" align="center" valign="middle"><?= $rows['order_sub_num'] ?></td>
                <td align="center" valign="middle"><?= $datas['name'] ?></td>
                <td align="center" valign="middle"><?= $rows['qishu'] ?></td>
                <td align="center" valign="middle"><?= $rows['rtype_str'] ?></td>
                <td align="center" valign="middle" style="max-width: 100px;"><?= $rows['quick_type'] ?> - <?= $rows['number'] ?></td>
                <td align="center" valign="middle"><?= $rows['bet_money_one'] ?></td>
                <td align="center" valign="middle"><?= $rows['fs'] ?></td>
                <td align="center" valign="middle"><?= $rows['bet_rate_one'] ?></td>
                <td align="center" valign="middle"><?php
                    if ($rows['is_win'] == "1") {
                        echo $rows['win'] + $rows['fs'];
                    } elseif ($rows['is_win'] == "2") {
                        echo $rows['bet_money'];
                    } elseif ($rows['is_win'] == "0" && $rows['fs'] > 0) {
                        echo $rows['fs'];
                    }else{
                        echo 0;
                    }
                    ?></td>
                <td><?= $rows['bet_time'] ?></td>
                <td><?=$_GET['user_group']?></td>
                <td><?php if ($rows['status'] == 0) { ?><font color="#0000FF">未结算</font><?php } ?>
                    <?php if ($rows['status'] == 1) { ?><font color="#FF0000">已结算</font><?php } ?>
            <?php if ($rows['status'] == 2) { ?><font color="#FF0000">已重算</font><?php } ?>
            <?php if ($rows['status'] == 3) { ?><font color="#FFcccc">作废</font><?php } ?></td>
            </tr>
<?php }
}
?>
    <tr style="background-color:#FFFFFF;">
        <td colspan="12" align="center" valign="middle">当前页总投注金额:<?= $bet_money ?>元 &nbsp;&nbsp;   当前页赢取金额:<?= $bet_money - $t_sy ?>元</td>
    </tr>
    <tr style="background-color:#FFFFFF;">
        <td colspan="12" align="center" valign="middle"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
    </tr>

</table>
     
</div>