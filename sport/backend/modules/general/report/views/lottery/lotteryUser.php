<?php

use yii\widgets\LinkPager;
?>

<form name="gridSearchForm" id="gridSearchForm" method="get" action="#/report/lottery/lottery-user"class="trinput font14" onSubmit="return check();">
    <div class="mgb10">
        <a title="返回上一页" style="color: #F37605;" class="font15"  href="#/report/lottery/index&s_time=<?= urlencode($getDatas['s_time']) ?>&e_time=<?= urlencode($getDatas['e_time']) ?>&user_group=<?= $getDatas['user_group'] ?>&user_ignore_group=<?= $getDatas['user_ignore_group'] ?>">返回上一页</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="color: #F37605;"><?= $getDatas['ggtype'] ?></b>
    </div>
    <div>

    </div>

   日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?=$getDatas['s_time']?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
                    ~
    <input class="laydate-icon" name="e_time" id="e_time" value="<?=$getDatas['e_time']?>" onfocus="WdatePicker({isShowClear:true,readOnly:true,dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
    &nbsp;&nbsp;
    <input type="button" value="今日" onclick="setDate('today')"/>
    <input type="button" value="昨日" onclick="setDate('yesterday')"/>
    <input type="button" value="本周" onclick="setDate('thisWeek')"/>
    <input type="button" value="上周" onclick="setDate('lastWeek')"/>
    <input type="button" value="本月" onclick="setDate('thisMonth')"/>
    <input type="button" value="上月" onclick="setDate('lastMonth')"/>
    <input type="button" value="最近7天" onclick="setDate('lastSeven')"/>
    <input type="button" value="最近30天" onclick="setDate('lastThirty')"/>
    <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
        <option value="" selected>选择月份</option>
        <option value="1"  >1月</option>
        <option value="2"  >2月</option>
        <option value="3"  >3月</option>
        <option value="4"  >4月</option>
        <option value="5"  >5月</option>
        <option value="6"  >6月</option>
        <option value="7"  >7月</option>
        <option value="8"  >8月</option>
        <option value="9"  >9月</option>
        <option value="10" >10月</option>
        <option value="11" >11月</option>
        <option value="12" >12月</option>
    </select>
    <div>
        <br>

        用户名：<input name="user_group" value="<?= $getDatas['user_group'] ?>" style="width: 200px;" type="text"> (多个用户用 , 隔开)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        忽略用户名：<input name="user_ignore_group" value="<?= $getDatas['user_ignore_group'] ?>" type="text" style="width: 200px;"> (多个用户用 , 隔开)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="gtype" type="hidden" value="<?= $getDatas['gtype']?>"/>
        <input type="button"  id="gridSearchBtn" name="Submit" value="搜索"></div>
</form>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font14 skintable line35 mgt10">
    <tr>
        <td align="center" style="width: 20%;"><strong>用户名(真实名字)</strong></td>
        <td align="center" style="width: 16%;"><strong>下注笔数</strong></td>
        <td align="center" style="width: 16%;"><strong>下注金额</strong></td>
        <td align="center" style="width: 16%;"><strong>下注结果</strong></td>
        <td align="center" style="width: 16%;"><strong>赢取金额</strong></td>
    </tr>
    <?php if (!empty($lotteryData)) {
        foreach ($lotteryData as $rows) {
            ?>
            <tr align="center" onMouseOver="this.style.backgroundColor = '#EBEBEB'" onMouseOut="this.style.backgroundColor = '#FFFFFF'" style="background-color:#FFFFFF; line-height:20px;">
                <td align="center" valign="middle"><a title="<?= $rows['user_name'] ?>" style="color: #F37605;" href="#/lotteryorder/index&p=1&type=<?= $getDatas["gtype"] ?>&s_time=<?= urlencode($getDatas['s_time']) ?>&e_time=<?= urlencode($getDatas['e_time']) ?>&username=<?= $rows['user_name'] ?>&js=0,1,2,3"><?= $rows['user_name'] ?></a>(<?= $rows['pay_name'] ?>)</td>
                <td align="center" valign="middle"><?= $rows['bet_count'] ?></td>
                <td align="center" valign="middle"><?= round($rows['bet_money_total'],2) ?></td>
                <td align="center" valign="middle"><?= round($rows['win_total'],2) ?></td>
                <td align="center" valign="middle"><?= round(($rows['bet_money_total'] - $rows['win_total'] - $rows['bet_he']),2) ?></td>    <!-- 20180301@robin add "- $rows['bet_he']" -->
            </tr>
        <?php }
    }
    ?>
    <tr >
        <td colspan="6" align="center" valign="middle">当前页总投注金额:<?= $t_allmoney ?>元 &nbsp;&nbsp;   当前页投注结果:<?= $t_sy ?>元&nbsp;&nbsp;
            当前页结果为和：<?= $he;?> 元  当前页<font color="#FF0000">后台赢利</font>金额:<?= $t_allmoney - $t_sy - $he ?>元</td>
    </tr>
    <?php
    if($pages){
        ?>
        <tr>
            <td colspan="6" align="center" valign="middle"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
        </tr>
        <?php
    }
    ?>
</table>
      