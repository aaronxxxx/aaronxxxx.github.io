<?php
use yii\widgets\LinkPager;
?>
<script language="JavaScript" src="/public/lottery/js/orderlist.js"></script>
<div>
<div class="pro_title pd10">彩票注单查询</div>
    <form name="form1" id="gridSearchForm" method="get" action="#/lotteryorder/index">
            <div class="trinput pd10 tabft13">
                <div class="middle">
                    <input type="hidden" name="type" value="<?= $_GET['type']?$_GET['type']:'ALL_LOTTERY' ?>" />
                    <select name="js" id="js">
                        <option value="0" style="color:#FF9900;" <?= $_GET['js'] == '0' ? 'selected' : '' ?>>未结算注单</option>
                        <option value="1" style="color:#FF0000;" <?= $_GET['js'] == '1' ? 'selected' : '' ?>>已结算注单</option>
                        <option value="2" style="color:#FF0000;" <?= $_GET['js'] == '2' ? 'selected' : '' ?>>已重算注单</option>
                        <option value="3" style="color:#FF0000;" <?= $_GET['js'] == '3' ? 'selected' : '' ?>>作废注单</option>
                        <option value="0,1,2,3" <?= $_GET['js'] == '0,1,2,3' ? 'selected' : '' ?>>全部注单</option>
                    </select>
                    会员：<input name="username" type="text" id="username" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}  ?>" size="12" />
                    日期：<input name="s_time" type="text" id="s_time" value="<?= $s_time?>" class="date_day_time" readonly />
                    ~
                    <input name="e_time" id="e_time" value="<?= $e_time?>" class="date_day_time" readonly>
                    期数：<input name="qishu" type="text" id="qishu" value="<?php if(isset($_GET['qishu'])){echo $_GET['qishu'];}  ?>" size="12" />
                    订单号：<input name="tf_id" type="text" class="w170" id="tf_id" value="<?php if(isset($_GET['tf_id'])){echo $_GET['tf_id'];}  ?>" size="12" />
                    &nbsp;
                    <input type="button" id="gridSearchBtn" name="Submit" value="搜索" />
                </div>
            </div>

    </form>
    <form name="form2" method="post" action="/?r=lotteryorder/index/plzuofei">
        <table width="100%" border="0" cellpadding="5" id="orderlist" cellspacing="1" class="font12 skintable line35">
            <tr class="t-title dailitr">
                <td align="center"><strong>订单号</strong></td>
                <td align="center"><strong>彩票类别</strong></td>
                <td align="center"><strong>彩票期号</strong></td>
                <td align="center"><strong>投注玩法</strong></td>
                <td align="center"><strong>投注内容</strong></td>
                <td align="center"><strong>投注金额</strong></td>
                <td align="center"><strong>反水</strong></td>
                <td align="center"><strong>赔率</strong></td>
                <td height="25" align="center"><strong>可赢金额</strong></td>
                <td height="25" align="center"><strong>结果</strong></td>
                <td align="center"><strong>投注时间</strong></td>
                <td align="center"><strong>投注账号</strong></td>
                <td height="25" align="center"><strong>状态</strong>
                    <input type="button" value="批量作废" onclick='cancelOrder_all()'><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
                </td>
            </tr>
            <?php
            if($list){
                foreach($list as $key => $rows) {
            ?>
                <tr align="center" onMouseOver="this.style.backgroundColor='<?=$rows['is_win']>0 ? '#FFE1E1':'#EBEBEB'?>'" onMouseOut="this.style.backgroundColor='<?=$rows['is_win']>0 ? '#FFE1E1':'#FFFFFF'?>'" style="background-color:<?=$rows['is_win']>0 ? '#FFE1E1':'#FFFFFF';?>; line-height:20px;">
                    <td height="25" class="order_sub_num" align="center" valign="middle"><?=  $rows['order_sub_num']?></td>
                    <td align="center" valign="middle">
                        <?php
                        $typename = \app\modules\lottery\lotteryorder\model\OrderLottery::rtype($rows['Gtype']);
                        echo $typename ?>
                    </td>
                    <td align="center" valign="middle"><?= $rows['lottery_number'] ?></td>
                    <td align="center" valign="middle"><?= $rows['rtype_str'] ?></td>
                    <td align="center" valign="middle"><?= $rows['quick_type'] ?> - <?= $rows['number'] ?></td>
                    <td align="center" valign="middle" class="bet_money"><?= $rows['bet_money'] ?></td>
                    <td align="center" valign="middle"><?= $rows['fs'] ?></td>
                    <td align="center" valign="middle"><?= $rows['bet_rate'] ?></td>
                    <td align="center" valign="middle"><?= $rows['win'] ?></td>
                    <td align="center" valign="middle" class="win_money">
                        <?php
                                if ($rows['is_win'] == "1") {
                                    echo $rows['win'] + $rows['fs'];
                                } elseif ($rows['is_win'] == "2") {
                                    echo $rows['bet_money'];
                                } elseif ($rows['is_win'] == "0" && $rows['fs'] > 0) {
                                    echo $rows['fs'];
                                }else{
                                    echo 0;
                                }
                        ?>
                    </td>
                    <td><?= substr($rows['bet_time'], 5) ?></td>
                    <td>
                        <?php
                            $username = \app\modules\lottery\lotteryorder\model\OrderLottery::username($rows['user_id']);
                        ?>
                        <a style="color: #F37605;" href="#/lotteryorder/index/lotteryuser&type=ALL_LOTTERY&js=0,1,2,3&username=<?=$username?>&s_time=<?= urlencode(isset($_GET["s_time"])?$_GET["s_time"]:date('Y-m-d 00:00:00')) ?>&e_time=<?= urlencode(isset($_GET["e_time"])?$_GET["e_time"]:date('Y-m-d H:i:s')) ?>&qishu=<?= isset($_GET["qishu"])?$_GET["qishu"]:''?>"><?= $username ?></a>
                    </td>
                    <td class="win_status">
                        <?php if ($rows['status'] == 0) { ?><font color="#0000FF">未结算</font>--
                            <a onclick='cancelOrder_lottery("<?= $rows['id'] ?>","<?= $rows['order_sub_num'] ?>")' title="作废该单"><font color="#ffcccc">作废</font></a>
                            <input name="uid[]" type="checkbox" id="uid[]" value="<?= $rows["id"] ?>"/>
                        <?php } ?>
                        <?php if ($rows['status'] == 1) { ?><font color="#FF0000">已结算</font><?php } ?>
                        <?php if ($rows['status'] == 2) { ?><font color="#FF0000">已重算</font><?php } ?>
                        <?php if ($rows['status'] == 3) { ?><font color="#FFcccc">作废</font><?php } ?>
                    </td>
                </tr>
            <?php
                }
            }
            ?>
            <tr class="ctinfo">
                <td colspan="13" align="center" valign="middle">当前页总投注金额:<font id="bet_money"><?= $bet_money ?></font>元 &nbsp;&nbsp;   当前页赢取金额:<font id="win_money"><?= round($bet_money - $t_sy,2) ?></font>元</td>
            </tr>
            <tr >
                <td colspan="13" align="center" valign="middle"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
            </tr>
        </table>
    </form>
</div>
<script>
    $(function(){
        setTimeout(function () {
            window.location.reload();
        },<?= $reload*1000;?>)
    })
</script>