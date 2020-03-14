<script src="/public/spsix/js/jquery.cookie.js" type="text/javascript"></script>
<?php use yii\widgets\LinkPager; ?>

<div class="pro_title">請款申請交易紀錄</div>
<form method="post" id="searchForm" action="/?r=event/order/index">
    <div class="trinput inputct pd10">
        <div class="mgauto middle">
            <select name="result" id="result">
                <option value="-1" <?php if ($result == '-1') {echo 'selected';} ?>>全部</option>
                <option value="1" <?php if ($result == 1) {echo 'selected';} ?>>提现成功</option>
                <option value="0" <?php if ($result == 0) {echo 'selected';} ?>>提现失敗</option>
            </select>&nbsp;
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
            <td><strong>状态码</strong></td>
            <td><strong>Json內容</strong></td>
            <td><strong>訊息內容</strong></td>
            <td><strong>提现结果</strong></td>
            <td><strong>操作时间</strong></td>
        </tr>
    <?php
        foreach ($list as $key => $val) {
    ?>
        <tr align="center">
            <td><?= $val['order_num'] ?></td>
            <td><?= $val['status'] ?></td>
            <td><?= $val['json_content'] ?></td>
            <td><?= $val['message'] ?></td>
            <td><?= $val['result'] == 0 ? '提现失敗' : '提现成功'; ?></td>
            <td><?= $val['create_time'] ?></td>
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
        window.location.href = '/#/agent/cash/log&' + formData;
    });
</script>