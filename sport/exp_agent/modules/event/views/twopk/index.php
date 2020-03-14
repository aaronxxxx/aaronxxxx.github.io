<?php use yii\widgets\LinkPager;?>

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

<div class="pro_title">兩方比賽</div>
<button class="btn btn-sm" style="margin-bottom: 10px;" onclick="javascript:location.href='#/event/official/index'">返回赛事列表</button>
&emsp;
<button class="btn btn-sm btn-primary pull-right" style="margin-bottom: 10px;" onclick="javascript:location.href='#/event/twopk/add&oid=<?= $oid ?>'">新增資料</button>
<table class="font12 skintable line35" width="100%" cellspacing="1" cellpadding="5">
    <tbody>
    <tr class="dailitr">
        <td align="center">
            <strong>自订编号</strong>
        </td>
        <td align="center">
            <strong>狀態</strong>
        </td>
        <td align="center">
            <strong>賽事名稱</strong>
        </td>
        <td align="center">
            <strong>類型</strong>
        </td>
        <td align="center">
            <strong>内容</strong>
        </td>
        <td align="center">
            <strong>開盤時間</strong>
        </td>
        <td align="center">
            <strong>封盤時間</strong>
        </td>
        <td align="center">
            <strong>操作</strong>
        </td>
    </tr>
    <?php
        foreach ($list as $key => $val) {
    ?>
            <tr align="center" style="background-color: rgb(255, 255, 255); line-height: 20px;" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#EBEBEB'">

                <td valign="middle" align="center"><?= $val['qishu'] ?></td>
                <td valign="middle" align="center">
                <?php
                    if ($val['status'] == 1) {
                        echo '啟用';
                    } else {
                        echo '停用';
                    }
                ?>
                </td>
                <td valign="middle" align="center"><?= $val['title'] ?></td>
                <td valign="middle" align="center"><?= $type[$val['type']] ?></td>
                <td valign="middle" height="40" align="center"><?= $player[$val['player1']] ?> VS <?= $player[$val['player2']] ?></td>
                <td valign="middle" align="center"><?= $val['kaipan_time'] ?></td>
                <td valign="middle" align="center"><?= $val['fenpan_time'] ?></td>
                <td valign="middle" align="center">
                    <a href="#/event/twopk/edit&id=<?= $val['id'] ?>" class="btn btn-default btn-xs">编辑</a>&emsp;
                    <a class="btn btn-default btn-xs" onclick="ajaxDelete(<?= $val['id'] ?>)">刪除</a>
                </td>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pages]) ?>

<script>
    function ajaxDelete(id)
    {
        $.ajax({
            url: '?r=event/twopk/delete',
            type: 'post',
            data: {id: id},
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
