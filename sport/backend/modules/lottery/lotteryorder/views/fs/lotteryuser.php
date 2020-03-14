<?php
use yii\widgets\LinkPager;
?>
<div id="pageMain">
    <div class="trinput tabft13">
        <form name="form1" method="get" id="gridSearchForm" action="#/lotteryorder/fs/index">
            <div class="middle">
                <select name="js" id="js">
                    <!-- <option value="0,1" style="color:#FF9900;" <?=$_GET['js']=='0,1' ? 'selected' : ''?>>全部注单</option> -->
                    <option value="0" style="color:#FF0000;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未反水注单</option>
                    <option value="1" style="color:#000000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已反水注单</option>
                </select>
                &nbsp;&nbsp;
                会员：<input name="username" type="text" id="username" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}?>" size="15">
                &nbsp;&nbsp;
                日期：<input id="s_time" name="s_time" type="text" value="<?=$time['s_time'];?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">
                ~
                <input id="e_time" name="e_time" type="text" value="<?=$time['e_time'];?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:false,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})">

                反水比例：<input placeholder="(輸入1為0.1%)" name="rate" type="text" id="rate" value="<?php if(isset($_GET['rate'])){echo $_GET['rate'];}else{echo '';}?>" size="15">
                &nbsp;&nbsp;
                <input type="button" id="gridSearchBtn" name="Submit" value="查询" />
                <?php if($_GET['js']=='0'){?>
                    修改密码 : <input name="superpassword" type="password" id="superpassword" value="" size="15">
                    <input type="button" id="Fs" onclick="setAllFs()" value="确认反水" />
                <?php }?>
            </div>
        </form>
    </div>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35 mgt10">
        <tr class="namecolor">
            <td height="25" align="center" style="width: 14%;"><strong>游戏名称</strong></td>
            <td align="center" style="width: 20%;"><strong>用户名(真实名字)</strong></td>
            <td align="center" style="width: 16%;"><strong>下注笔数</strong></td>
            <td align="center" style="width: 16%;"><strong>下注金额</strong></td>
            <td align="center" style="width: 16%;"><strong>应反水金额</strong></td>
            <td align="center" style="width: 16%;"><strong>已反水金额</strong></td>
        </tr>
        <?php
            $all_user_id = "";
            $winMoney = $betMoney = $bet_count = $fs = $fsed = 0;
            if($lists){
                foreach($lists as $key=>$val){
                    $all_user_id = $all_user_id . $val['user_id'] . ",";
        ?>
        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
            <td height="40" align="center" valign="middle">全部彩票</td>
            <td align="center" valign="middle">
                <a title="" style="color: #F37605;" href="#/lotteryorder/index/fs-order&p=1&s_time=<?=urlencode($time['s_time'])?>&amp;e_time=<?=urlencode($time['e_time'])?>&amp;rate=<?=$time['rate'];?>&amp;js=<?=$time['js']?>&amp;type=ALL_LOTTERY&amp;username=<?= $val['user_name'];?>">
                    <?= $val['user_name'];?></a>(<?= $val['pay_name'];?>)
            </td>
            <td align="center" valign="middle"><?=$val['bet_count'];$bet_count+=$val['bet_count'];?></td>
            <td align="center" class="bet_total" valign="middle"><?=$val['bet_money_total'];$betMoney+=$val['bet_money_total'];?></td>
            <td align="center" class="allmoney" valign="middle"><?php 
            echo $val['bet_money_total']*$rate/1000;
            $fs += $val['bet_money_total']*$rate/1000;
            ?></td>
            <td align="center" valign="middle"><?=round($val['sum_fs'],2);$fsed+=round($val['sum_fs'],2);?></td>
        </tr>
        <?php
                }
            }
        ?>
        <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#fff'" style="background-color:rgb(255, 255, 255); line-height:20px;">
            <td height="40" align="center" valign="middle">总计</td>
            <td align="center" valign="middle">
                -
            </td>
            <td align="center" valign="middle"><?=$bet_count?></td>
            <td align="center" class="bet_total" valign="middle"><?=$betMoney?></td>
            <td align="center" class="allmoney" valign="middle"><?php 
            echo $fs;
            ?></td>
            <td align="center" valign="middle"><?=$fsed?></td>
        </tr>
        <tr >
            <td colspan="6" align="center" valign="middle">当前页总投注金额:<?= $betMoney;?>元 &nbsp;&nbsp;   当前页<font color="#FF0000">平台</font>赢取金额:<?= $winMoney;?>元</td>
        </tr>
        <tr >
            <td colspan="6" align="center" valign="middle"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
        </tr>
    </table>
    <input id="all_user_id" type="hidden" value="<?php echo $all_user_id; ?>"/>
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
    });

    function setAllFs() {
        $("#Fs").attr("disabled", "disabled"); //按钮失效
        var s_time = $("#s_time").val();
        var e_time = $("#e_time").val();
        var all_user_id = $("#all_user_id").val();
        var rate = $("#rate").val();
        var superpassword = $("#superpassword").val();
        $.ajax({
                type:'POST',
                url:'/?r=lotteryorder/fs/set-all-fs',
                data:{
                    "s_time":s_time,
                    "e_time":e_time,
                    "all_user_id":all_user_id,
                    "rate":rate,
                    "superpassword":superpassword,
                },
                success:function (data) {
                    if(data == '1')
                    {
                        alert('反水成功');
                        window.location.reload();
                    }
                    else if(data == '-1'){
                        alert('修改密码错误');
                    }
                    else{
                        alert('提交表单出错了!');
                        window.location.reload();
                    }
                    console.log(data);
                },
                error:function () {
                    alert('提交表单出错了');
                }
            });
    }
</script>
