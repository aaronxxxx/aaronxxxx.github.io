<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tbody><tr class="dailitr">
        <td align="center"><strong>子订单号</strong></td>
        <td align="center"><strong>彩票类别</strong></td>
        <td align="center"><strong>彩票期号</strong></td>
        <td align="center"><strong>投注玩法</strong></td>
        <td align="center"><strong>投注内容</strong></td>
        <td align="center"><strong>投注金额</strong></td>
        <td align="center"><strong>反水</strong></td>
        <td align="center"><strong>赔率</strong></td>
        <td align="center"><strong>可赢金额</strong></td>
        <td align="center"><strong>结果</strong></td>
        <td align="center"><strong>投注时间</strong></td>
        <td align="center"><strong>投注账号</strong></td>
        <td align="center"><strong>状态</strong></td>
    </tr>
    <tr align="center">
        <td height="25" align="center" valign="middle"><?=$list['order_sub_num'];?></td>
        <td align="center" valign="middle"><?=$_GET['about'];?></td>
        <td align="center" valign="middle"><?=$list['lottery_number'];?></td>
        <td align="center" valign="middle"><?=$list['rtype_str']?></td>
        <td align="center" valign="middle" style="max-width:115px"><?=$list['quick_type'];?>-<?=$list['number'];?></td>
        <td align="center" valign="middle"><?=$list['bet_money'];?></td>
        <td align="center" valign="middle"><?=$list['fs'];?></td>
        <td align="center" valign="middle"><?=$list['bet_rate'];?></td>
        <td align="center" valign="middle"><?=$list['win'];?></td>
        <td align="center" valign="middle">
            <?php
            if ($list['is_win'] == "1") {
                echo $list['win'] + $list['fs'];
            } elseif ($list['is_win'] == "2") {
                echo $list['bet_money'];
            } elseif ($list['is_win'] == "0" && $list['fs'] > 0) {
                echo $list['fs'];
            }else{
                echo 0;
            }
            ?>
            </td>
        <td ><?=$list['bet_time'];?></td>
        <td><?=$list['user_name'];?></td>
        <td >
            <font color="#0000FF" data="<?=$list['status'];?>"><?=$status[$list['status']];?></font>
        </td>
    </tr>
    </tbody>
</table>
         
