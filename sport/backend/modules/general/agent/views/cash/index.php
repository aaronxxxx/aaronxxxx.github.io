<?php use yii\widgets\LinkPager; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> <?= Yii::$app->session->getFlash('success') ?></h4>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<div class="pro_title pd10">
    請款申請: 查看請款信息
</div>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
    <td>
        <table width="100%" cellspacing="0" cellpadding="0" class="font13 dailis skintable" idth="100%">
            <tr class="t-title dailitr">
                <td><strong>單號</strong></td>
                <td><strong>代理ID</strong></td>
                <td><strong>代理名</strong></td>
                <td><strong>提領方式</strong></td>
                <td><strong>交易帳號</strong></td>
                <td><strong>提領金額</strong></td>
                <td><strong>申請時間</strong></td>
                <td><strong>狀態</strong></td>
                <td><strong>相關操作</strong></td>
            </tr>
            <?php
                foreach ($list as $key => $value) {
            ?>
                <tr>
                    <td><?= $value['order_num'] ?></td>
                    <td><?= $value['agents_id'] ?></td>
                    <td><?= $value['agents_name'] ?></td>
                    <td><?= $type[$value['type']] ?></td>
                    <td><?= $value['account'] ?></td>
                    <td><?= $value['money'] ?></td>
                    <td><?= $value['create_time'] ?></td>
                    <td><?= $status[$value['status']] ?></td>
                    <td class="trinput mgb5">
                    <?php
                        if ($value['status'] == 0) {
                    ?>
                        <input type="button" class="mgb5" onclick="ajaxConfirm(<?= $value['id'] ?>)"value="申請審核"><br>
                        <input type="button" onclick="ajaxCancel(<?= $value['id'] ?>)" value="申請作廢">
                    <?php
                        }
                    ?>
                    </td>
                </tr>
            <?php
                }
            ?>
        </table>
    </td>
</table>

<?= LinkPager::widget(['pagination' => $pages]) ?>

<script>
    function ajaxConfirm(id) {
        $.ajax({
            url: '?r=agent/cash/confirm',
            type: 'post',
            data: {
                id: id
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }

    function ajaxCancel(id) {
        $.ajax({
            url: '?r=agent/cash/cancel',
            type: 'post',
            data: {
                id: id
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }

    function ajaxDelete(id) {
        $.ajax({
            url: '?r=agent/cash/delete',
            type: 'post',
            data: {
                id: id
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }
</script>