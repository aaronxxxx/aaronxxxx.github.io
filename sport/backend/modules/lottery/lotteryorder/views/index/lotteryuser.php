<?php
use yii\widgets\LinkPager;
?>
<div id="pageMain">
    <div class="trinput tabft13">
        <form name="form1" method="get" id="gridSearchForm" action="#/lotteryorder/index/lotteryuser">
            <div class="middle">
                <select name="js" id="js">
                    <option value="0" style="color:#FF9900;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未结算注单</option>
                    <option value="1" style="color:#FF0000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已结算注单</option>
                    <option value="2" style="color:#FF0000;" <?=$_GET['js']=='2' ? 'selected' : ''?>>已重算注单</option>
                    <option value="3" style="color:#FF0000;" <?=$_GET['js']=='3' ? 'selected' : ''?>>作废注单</option>
                    <option value="0,1,2,3" <?=$_GET['js']=='0,1,2,3' ? 'selected' : ''?>>全部注单</option>
                </select>
                &nbsp;&nbsp;
                会员：<input name="username" type="text" id="username" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}?>" size="15">
                &nbsp;&nbsp;
                日期：日期：<input id="s_time" name="s_time" type="text" value="<?=$time['s_time'];?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                ~
                <input id="e_time" name="e_time" type="text" value="<?=$time['e_time'];?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">

                期数：<input name="qishu" type="text" id="qishu" value="<?php if(isset($_GET['qishu'])){echo $_GET['qishu'];}?>" size="15">
                <select name="excludegroup" id="excludegroup">
                        <option value="0" style="color:#FF9900;" <?= $excludegroup == '0' ? 'selected' : '' ?>>全部会员组</option>
                        <option value="1" style="color:#FF0000;" <?= $excludegroup == '1' ? 'selected' : '' ?>>排除测试会员组</option>
                </select>
                &nbsp;&nbsp;

                <input type="button" id="gridSearchBtn" name="Submit" value="搜索" />
            </div>
        </form>
    </div>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10">
        <tr class="namecolor">
            <td height="25" align="center" style="width: 14%;"><strong>游戏名称</strong></td>
            <td align="center" style="width: 20%;"><strong>用户名(真实名字)</strong></td>
            <td align="center" style="width: 16%;"><strong>下注笔数</strong></td>
            <td align="center" style="width: 16%;"><strong>下注金额</strong></td>
            <td align="center" style="width: 16%;"><strong>下注结果</strong></td>
            <td align="center" style="width: 16%;"><strong>赢取金额</strong></td>
        </tr>
        <?php
            $winMoney = $betMoney = 0;
            if($lists){
                foreach($lists as $key=>$val){
        ?>
        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
            <td height="40" align="center" valign="middle">全部彩票</td>
            <td align="center" valign="middle">
                <a title="" style="color: #F37605;" href="#/lotteryorder/index&p=1&s_time=<?=urlencode($time['s_time'])?>&amp;e_time=<?=urlencode($time['e_time'])?>&amp;qishu=<?=$time['qishu'];?>&amp;js=<?=$time['js']?>&amp;type=ALL_LOTTERY&amp;username=<?= $val['user_name'];?>">
                    <?= $val['user_name'];?></a>(<?= $val['pay_name'];?>)
            </td>
            <td align="center" valign="middle"><?=$val['bet_count']?></td>
            <td align="center" class="bet_total" valign="middle"><?=$val['bet_money_total'];$betMoney+=$val['bet_money_total'];?></td>
            <td align="center" class="allmoney" valign="middle"><?=$val['win_total'];$winMoney +=$val['bet_money_total']-$val['win_total'];?></td>
            <td align="center" valign="middle"><?=round($val['bet_money_total']-$val['win_total'],2)?></td>
        </tr>
        <?php
                }
            }
        ?>
        <tr >
            <td colspan="6" align="center" valign="middle">当前页总投注金额:<?= $betMoney;?>元 &nbsp;&nbsp;   当前页<font color="#FF0000">平台</font>赢取金额:<?= $winMoney;?>元</td>
        </tr>
        <tr >
            <td colspan="6" align="center" valign="middle"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
        </tr>
    </table>
    
</div>
<script>
    var bet_total = 0;
    var allmoney = 0;
    $(function(){
        $('.bet_total').each(function(){
            bet_total += parseInt($(this).html());
            allmoney += parseInt(bet_total-$(this).siblings('.allmoney').html());
        });
        $('#allmoney').html(allmoney);
        $('#bet_total').html(bet_total);
    })
</script>
