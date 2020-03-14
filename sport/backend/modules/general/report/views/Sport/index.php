<?php
$date = array("今日"=>"today","昨日"=>"yesterday","本周"=>"thisWeek","上周"=>"lastWeek",
            "本月"=>"thisMonth","上月"=>"lastMonth","最近7天"=>"lastSeven","最近30天"=>"lastThirty");
$ballType = ["ft"=>"足球","bk"=>"篮球","tn"=>"网球","bs"=>"棒球","vb"=>"排球",
    "gj"=>"冠军","ds"=>"单式","op"=>"其他","cg"=>"串关"];

//用户名和忽略用户名
$userNames=implode(",",$user_group);
$userIgnoreNames = implode(",",$user_ignore_group);
?>
<body>
    <div class="pro_title pd10">报表明细：sport报表信息</div>
    <form name="gridSearchForm" id="gridSearchForm" class="trinput inputct font14" method="get" action="#/report/sport/index" onsubmit="return check();">
        日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?=$time['s_time']?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
        ~
        <input class="laydate-icon" name="e_time" id="e_time" value="<?=$time['e_time']?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
        &nbsp;&nbsp
        <?php foreach($date as $k=>$v){?>
        <input type="button" value="<?=$k?>" onclick="setDate('<?=$v?>')">
       <?php }?>
        <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
            <option value="">选择月份</option>
            <?php for($i=1;$i<=12;$i++){?>
            <option value="<?=$i?>"><?=$i?>月</option>
           <?php }?>
        </select>
        <br><br>
        用户名：<input name="user_group" value='<?=$userNames?>' style="width: 200px;" type="text"> (多个用户用 , 隔开)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        忽略用户名：<input name="user_ignore_group" value='<?=$userIgnoreNames?>' type="text" style="width: 200px;"> (多个用户用 , 隔开)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="gtype" type="hidden" id="gtype" value="">
        <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
        <br><br>
    </form>
    <table width="100%"   cellspacing="0" cellpadding="0"  id=editProduct  class="font14 skintable line35"  >
        <tbody>
        <tr >
            <td style="width: 16%" align="center" height="25"><strong>游戏名称</strong></td>
            <td style="width: 21%" align="center"><strong>下注笔数</strong></td>
            <td style="width: 21%" align="center"><strong>下注金额</strong></td>
            <td style="width: 21%" align="center"><strong>下注结果</strong></td>
            <td style="width: 21%" align="center"><strong>赢取金额</strong></td>
        </tr>
        <?php
        $allCount = $allMoney = $winMoney =0;
        foreach($result as $k=>$v){if($k!="ds"){?>
        <tr align="center">
            <td height="25" align="center" valign="middle">
                <?php if($k=="cg"){?>
                <a title="<?=$ballType[$k]?>" style="color: #F37605;" href="#/sport/order/cg&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&username=<?=$userNames?>"><?=$ballType[$k]?></a>
                <?php }else{?>
                <a title="<?=$ballType[$k]?>" style="color: #F37605;" href="#/report/sport/user&type=<?=$k?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_group=<?=$userNames?>&user_ignore_group=<?=$userIgnoreNames?>"><?=$ballType[$k]?></a>
             <?php }?>
            <td align="center" valign="middle"><?= $v['bet_count']; ?></td>
            <td align="center" valign="middle"><?= $v['bet_money']; ?></td>
            <td align="center" valign="middle"><?= $win[$k]['win_money']?></td>
            <td align="center" valign="middle"><?= $v['bet_money'] - $win[$k]['win_money']; ?></td>
        </tr>
        <?php $allCount += $v['bet_count'];
            $allMoney += $v['bet_money'];
            $winMoney += $win[$k]['win_money'];
        }}?>
        <tr align="center">
            <td height="25" align="center" valign="middle">总计</td>
            <td align="center" valign="middle"><?= $allCount;?></td>
            <td align="center" valign="middle"><?= $allMoney;?></td>
            <td align="center" valign="middle"><?= $winMoney;?></td>
            <td align="center" valign="middle"><?= $allMoney - $winMoney;?></td>
        </tr>
        <tr align="center">
            <td height="45" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。如果是正数，说明<font color="#FF0000">(会员)</font>输钱，如果是负数，则为<font color="#FF0000">(会员)</font>赢钱。</td>
        </tr>
        <tr align="center">
            <td height="25" align="center" valign="middle">
                <a title="单式" style="color: #F37605;" href="#/report/sport/user&type=ds&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>&user_group=<?=$userNames ?>&user_ignore_group=<?= $userIgnoreNames ?>">单式</a>
            </td>
            <td align="center" valign="middle"><?= $result['ds']['bet_count']; ?></td>
            <td align="center" valign="middle"><?= $result['ds']['bet_money']; ?></td>
            <td align="center" valign="middle"><?= $win['ds']['win_money']; ?></td>
            <td align="center" valign="middle"><?= $result['ds']['bet_money'] - $win['ds']['win_money']; ?></td>
        </tr>
        <tr align="center">
            <td height="45" align="center" valign="middle" colspan="5">赢取金额=下注金额-下注结果。如果是正数，说明<font color="#FF0000">(会员)</font>输钱，如果是负数，则为<font color="#FF0000">(会员)</font>赢钱。</td>
        </tr>
        </tbody>
    </table>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>