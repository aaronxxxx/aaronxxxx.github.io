<?php
use yii\widgets\LinkPager;
$date = array("今日"=>"today","昨日"=>"yesterday","本周"=>"thisWeek","上周"=>"lastWeek",
    "本月"=>"thisMonth","上月"=>"lastMonth","最近7天"=>"lastSeven","最近30天"=>"lastThirty");
$ballType = ["ft"=>"足球","bk"=>"篮球","tn"=>"网球","bs"=>"棒球","vb"=>"排球",
    "gj"=>"冠军","ds"=>"单式","op"=>"其他","cg"=>"串关"];
?>
<body>
    <div class="pro_title pd10"> 报表明细：sport报表信息
        <a href="#/report/sport/index&user_group=<?= $getDatas['user_group']; ?>&user_ignore_group=<?= $getDatas['user_ignore_group']; ?>&s_time=<?= urlencode($getDatas['s_time']) ?>&e_time=<?= urlencode($getDatas['e_time']) ?>">
            <span style="color:#ff9966;margin-left: 30px;">返回上一页</span></a>
</div>
    <form name="gridSearchForm" id="gridSearchForm" method="get" class="trinput  font14" action="#/report/sport/user" onsubmit="return check();">
        <input type="hidden" name="type" value="<?= $ballType[$getDatas['type']]; ?>">
        日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?=$getDatas['s_time']?>"
                  onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})"
                  readonly="readonly">
        ~
        <input class="laydate-icon" name="e_time" id="e_time" value="<?=$getDatas['e_time']?>"
               onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss '})"
               readonly="readonly">&nbsp;
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
        用户名：<input name="user_group" value="<?= $getDatas['user_group']; ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
        忽略用户名：<input name="user_ignore_group" value="<?= $getDatas['user_ignore_group']; ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="gtype" type="hidden" id="gtype" value="">
        <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
        <br><br>
    </form>
    <table width="100%"   cellspacing="0" cellpadding="0"  id=editProduct  class="font14 skintable line35"  ><tbody>
        <tr >
            <td align="center" height="25"><strong>游戏名称</strong></td>
            <td align="center" height="25"><strong>用户名(真实名字)</strong></td>
            <td align="center"><strong>下注笔数</strong></td>
            <td align="center"><strong>下注金额</strong></td>
            <td align="center"><strong>下注结果</strong></td>
            <td align="center"><strong>赢取金额</strong></td>
        </tr>
        <?php
        $allMoney = $winOrLose = 0;
        foreach ($sportLists as $key => $value) {?>
        <tr align="center">
            <td align="center" valign="middle"><?= $ballType[$getDatas['type']]?></td>
            <td height="25" align="center" valign="middle">
                <a title="" style="color: #F37605;"
                   href="#/sport/order/single-order&type=<?= $ballType[$getDatas['type']]; ?>&s_time=<?= urlencode($getDatas['s_time']) ?>&e_time=<?= urlencode($getDatas['e_time']) ?>&username=<?= $value['user_name'] ?>">
                    <?= $value['user_name'] ?>
                </a>
                (<?= $value['pay_name'] ?>)
            </td>
            <td align="center" valign="middle"><?= $value['bet_count'] ?></td>
            <td align="center" valign="middle"><?= $value['bet_money_total'] ?></td>
            <td align="center" valign="middle"><?= $value['win_total'] ?></td>
            <td align="center" valign="middle"><?= ($value['bet_money_total'] - $value['win_total']) ?></td>
        </tr>
        <?php
        $allMoney += $value['bet_money_total'];
        $winOrLose += $value['win_total'];
        } ?>
        <tr align="center">
            <td height="45" align="center" valign="middle" colspan="6">
                当前页总投注金额:<?= $allMoney; ?>元
                当前页投注结果:<?= $winOrLose; ?>元
                当前页赢取金额:<?= $allMoney - $winOrLose; ?>元。
            </td>
        </tr>
        </tbody>
    </table>
    <?php echo LinkPager::widget(['pagination' => $pages]); ?>
</body>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>