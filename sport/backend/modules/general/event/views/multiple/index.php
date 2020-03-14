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

<div class="pro_title">多项目</div>
<button class="btn btn-sm" style="margin-bottom: 10px;" onclick="javascript:location.href='#/event/official/index'">返回赛事列表</button>
&emsp;
<button class="btn btn-sm btn-primary pull-right" style="margin-bottom: 10px;" onclick="javascript:location.href='#/event/multiple/add&oid=<?= $oid ?>'">新增资料</button>
<table class="font12 skintable line35" width="100%" cellspacing="1" cellpadding="5">
    <tbody>
    <tr class="dailitr">
        <td align="center">
            <strong>期数</strong>
        </td>
        <td align="center">
            <strong>状态</strong>
        </td>
        <td align="center">
            <strong>赛事名称</strong>
        </td>
        <td align="center">
            <strong>类型</strong>
        </td>
        <td align="center">
            <strong>标题</strong>
        </td>
        <td align="center">
            <strong>开盘时间</strong>
        </td>
        <td align="center">
            <strong>封盘时间</strong>
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
                        echo '启用';
                    } else {
                        echo '停用';
                    }
                ?>
                </td>
                <td valign="middle" align="center"><?= $val['official_title'] ?></td>
                <td valign="middle" align="center"><?= $type[$val['type']] ?></td>
                <td valign="middle" align="center"><?= $val['title'] ?></td>
                <td valign="middle" align="center"><?= $val['kaipan_time'] ?></td>
                <td valign="middle" align="center"><?= $val['fenpan_time'] ?></td>
                <td valign="middle" align="center">
                    <a href="#/event/multiple/edit&id=<?= $val['id'] ?>" class="btn btn-default btn-xs">编辑</a>&emsp;
                <?php
                    if ( !($val['kaipan_time'] <= date("Y-m-d H:i:s") && $val['kaijiang_time'] >= date("Y-m-d H:i:s")) ) {
                ?>
                    <a class="btn btn-default btn-xs" onclick="ajaxDelete(<?= $val['id'] ?>)">刪除</a>
                <?php
                    }
                ?>
                </td>
            </tr>
    <?php
        }
    ?>
    </tbody>
</table>

<?= LinkPager::widget(['pagination' => $pages]) ?>

<script>
    function ajaxDelete(id) {
        if (confirm('确定要刪除吗?') == true) {
            $.ajax({
                url: '?r=event/multiple/delete',
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
    }
</script>
