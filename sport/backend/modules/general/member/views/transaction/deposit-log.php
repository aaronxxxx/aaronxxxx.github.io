<script src="/public/spsix/js/jquery.cookie.js" type="text/javascript"></script>
<?php use yii\widgets\LinkPager; ?>

<div class="pro_title">会员存款交易记录</div>
<form method="post" id="searchForm" action="/?r=agent/event/order/index">
    <div class="trinput inputct pd10">
        <div class="mgauto middle">
            日期：
            <input type="text" name="startTime" id="startTime" value="<?= $startTime ?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})">
            ~
            <input type="text" name="endTime" id="endTime" value="<?= $endTime ?>" class="laydate-icon" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})">&nbsp;
            订单号：<input type="text" name="orderNum" id="orderNum" value="<?= $orderNum ?>">&nbsp;
            <input type="button" id="searchBtn" value="搜索">
        </div>
    </div>
</form>
<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12 skintable line35">
    <tbody>
        <tr class="dailitr">
            <td><strong>订单号</strong></td>
            <td><strong>Json內容</strong></td>
            <td><strong>收到时间</strong></td>
        </tr>
    <?php
        foreach ($list as $key => $val) {
    ?>
        <tr align="center">
            <td width="23%" style="word-wrap:break-word;word-break:break-all;"><?= $val['order_num'] ?></td>
            <td width="65%" style="word-wrap:break-word;word-break:break-all;"><?= $val['content'] ?></td>
            <td width="12%" style="word-wrap:break-word;word-break:break-all;"><?= $val['create_time'] ?></td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pages]) ?>

<script>
    $('#searchBtn').click(function() {
        var formData = $("#searchForm").serialize();
        window.location.href = '/#/member/transaction/deposit-log&' + formData;
    });
</script>