<script src="/public/spsix/js/jquery.cookie.js" type="text/javascript"></script>
<?php use yii\widgets\LinkPager; ?>

<div class="pro_title pd10"> 代理管理：下属会员 <?= $all['user_name'] ?> 賽事报表信息 <a href="#/agent/report/report-type&user_id=<?= $user_id; ?>&s_time=<?= urlencode($time['s_time']) ?>&e_time=<?= urlencode($time['e_time']) ?>"><span style="color:#ff9966;margin-left: 30px;">返回上一页</span></a> </div>

<div id="pageMain" align="center">
    <div class="mgauto middle">
        <form class="trinput font14 " name="gridSearchForm" id="gridSearchForm" method="get" action="#/agent/event/index" onsubmit="return check();">
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <br>
            &nbsp;&nbsp;
            日期：<input class="laydate-icon" name="s_time" id="s_time" value="<?= $time['s_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
            ~
            <input class="laydate-icon" name="e_time" id="e_time" value="<?= $time['e_time'] ?>" onfocus="WdatePicker({isShowClear: true, readOnly: true, dateFmt: 'yyyy-MM-dd HH:mm:ss '})" readonly="readonly">
            &nbsp;&nbsp;
            <input type="button" value="今日" onclick="setDate('today')">
            <input type="button" value="昨日" onclick="setDate('yesterday')">
            <input type="button" value="本周" onclick="setDate('thisWeek')">
            <input type="button" value="上周" onclick="setDate('lastWeek')">
            <input type="button" value="本月" onclick="setDate('thisMonth')">
            <input type="button" value="上月" onclick="setDate('lastMonth')">
            <input type="button" value="最近7天" onclick="setDate('lastSeven')">
            <input type="button" value="最近30天" onclick="setDate('lastThirty')">
            <select name="date_month" id="date_month" onchange="onChangeMonth(this.value)">
                <option value="" selected="">选择月份</option>
                <option value="1">1月</option>
                <option value="2">2月</option>
                <option value="3">3月</option>
                <option value="4">4月</option>
                <option value="5">5月</option>
                <option value="6">6月</option>
                <option value="7">7月</option>
                <option value="8">8月</option>
                <option value="9">9月</option>
                <option value="10">10月</option>
                <option value="11">11月</option>
                <option value="12">12月</option>
            </select>
            <input type="button" id="gridSearchBtn" name="Submit" value="搜索">
        </form>
    </div>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tbody>
    <tr class="dailitr">
        <td><strong>订单号</strong></td>
        <td><strong>賽事名稱</strong></td>
        <td><strong>比賽類型</strong></td>
        <td><strong>期号</strong></td>
        <td><strong>讓分</strong></td>
        <td><strong>投注内容</strong></td>
        <td><strong>投注金额</strong></td>
        <td><strong>反水</strong></td>
        <td><strong>赔率</strong></td>
        <td><strong>输赢结果</strong></td>
        <td><strong>投注时间</strong></td>
        <td><strong>状态</strong></td>
    </tr>
    <?php
    $betMoney = $winMoney = 0;
    if ($event_list) {
    foreach ($event_list as $key => $val) {
        ?>
        <tr align="center" <?php if ($val['status'] != 1 && $val['is_win'] == 2) { echo 'style="background:#f75050"';} ?>>
            <td><?= $val['order_num'] ?></td>
            <td><?= $val['title'] ?></td>
            <td><?= $gameType[$val['game_type']] ?></td>
            <td><?= $val['qishu'] ?></td>
            <td><?= $val['bet_handicap'] ?></td>
            <td><?= $val['game_item_id'] ?></td>
            <td><?= $val['bet_money']; $betMoney += $val['bet_money']; ?></td>
            <td><?= $val['fs'] ?></td>
            <td><?= $val['bet_rate'] ?></td>
            <td>
                <?= $val['win_total'] ?>
                <?php
                if ($val['status'] == 2 && $val['is_win'] == 2) {
                    $winMoney += $val['bet_money'] - $val['win_total'];
                } elseif ($val['status'] == 1) {
                    $winMoney += $val['win_total'];
                } else {
                    $winMoney += $val['bet_money'];
                }
                ?>
            </td>
            <td><?= $val['bet_time'] ?></td>
            <td>
                <?php
                if ($val['status'] == 0) {
                    echo '<font color="#0000FF">未结算</font>';
                }
                if ($val['status'] == 1) {
                    echo '<font color="#FF0000">已结算</font>';
                }
                if ($val['status'] == 2) {
                    echo '<font color="#FF0000">已重算</font>';
                }
                if ($val['status'] == 3) {
                    echo '<font color="#FFcccc">作废</font>';
                }
                ?>
            </td>
        </tr>
        <?php
        }
    }
    ?>
    <tr class="ctinfo">
        <td valign="middle" align="center" colspan="15">当前页总投注金额:<?= $betMoney; ?>元 当前页赢取金额:<?= $winMoney; ?>元</td>
    </tr>
    </tbody>
</table>
    <?php
    if ($event_list) {
        echo LinkPager::widget(['pagination' => $pages]);
    }
    ?>
<script>
    function reload_view() {
        window.location.reload();
    }
    //读取cookie中的是否显示图片状态值
    if ($.cookie('img_show') == 'block') {
        $("#img_show").find("option[value='block']").attr("selected", true);
        $('.img-img').css('display', 'block');
    }
    //图片显示与隐藏切换 并把设置值保存到cookie中
    $(document).on('change', '#img_show', function() {
        var status = $('#img_show option:selected').val(); //选中的值
        $('.img-img').css('display', status);
        $.cookie('img_show', status);
    })
</script>